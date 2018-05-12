<?php
namespace Admin\Controller;
use Admin\Controller\AdminController;

/**
 * 文章管理
 * @author Lain
 *
 */
class ArticleController extends AdminController {
	private $categorys;
	private $controller = '';
	//初始化
	public function _initialize(){
		$action = array(
				//'permission'=>array('changePassword'),
				//'allow'=>array('index')
		);
		B('Admin\\Behaviors\\Authenticate', '', $action);
		
		//获取栏目信息
		if(!$this->categorys = F('category_content')){
			D('ArticleCategory')->file_cache();
			$this->categorys = F('category_content');
		}
		$this->controller = 'Article';
		$this->assign('controller', $this->controller);
	}
    public function index(){
    	//取出文章分类
    	//$this->categoryList = list_to_tree($this->categorys,'catid','parentid');
    	foreach ($this->categorys as $key => $category){
    		$data[$key] = $category;
    		$data[$key]['name'] = $category['catname'];
    		if($category['type'] == 0){	//内部栏目, 显示列表
    			$data[$key]['url'] = U($this->controller.'/manage?catid='.$category['catid']);
    		}else{		//单网页, 显示编辑页
    			$data[$key]['url'] = U($this->controller.'/pageEdit?catid='.$category['catid']);
    			$data[$key]['icon'] = 'Public/images/page_edit.png';
    		}
    	}
    	$nodes = list_to_tree($data, 'catid', 'parentid', 'children');
    	$this->assign('json_nodes', json_encode($nodes));
    	
    	$this->display();
    }
    
    //文章内容管理
    public function manage(){
		$db = D('Article');
    	$categorys = $this->categorys;
		//取出所在分类
		$this->catid = $catid = I('get.catid','','intval');
		if(!$catid)
			$this->ajaxReturn(array('statusCode'=>300,'message'=>'缺少必要的参数'));
		
		// 检索条件
		$map['status'] = 99;
		//取出子集下的文章
		$map['catid'] = array('in', $categorys[$catid]['arrchildid']);
		$map['_string'] = 1;
			
   	 	if(isset($_POST['start_time']) && $_POST['start_time']) {
			$this->start_time = $_POST['start_time'];
			$start_time = strtotime($_POST['start_time']);
			$map['_string'] .= " AND `inputtime` > '$start_time'";
		}
		if(isset($_POST['end_time']) && $_POST['end_time']) {
			$this->end_time = $_POST['end_time'];
			$end_time = strtotime($_POST['end_time']) + 3600*24;
			$map['_string'] .= " AND `inputtime` < '$end_time'";
		}

		if(I('post.keyword')) {
			
			$type_array = array('title','description','username');
			$this->keyword = $keyword = I('post.keyword');
			$this->searchtype = $searchtype = I('post.searchtype');
			if($searchtype < 3) {
				$searchtype = $type_array[$searchtype];
				$map[$searchtype] = array('like', "%$keyword%");
			} elseif($searchtype == 3) {
				$keyword = intval($_POST['keyword']);
			}
		}
		//排序
		if(I('post.orderField')){
			$this->orderField = $orderField = I('post.orderField');
			$this->orderDirection = $orderDirection = I('post.orderDirection') ? I('post.orderDirection') : 'asc';
			$order = $orderField . ' ' . $orderDirection;
		}else{
			$order = 'id desc';
		}
		
		// 分页相关
		$page['pageCurrent'] = max(1 , I('post.pageCurrent'));
		$page['pageSize']= I('post.pageSize') ? I('post.pageSize') : 30 ;
		
		$totalCount = D('Article')->where($map)->count();
		$page ['totalCount'] = $totalCount;
		
		// 取数据
		$page_list = $db->where($map)->page($page['pageCurrent'], $page['pageSize'])->order($order)->select();
		
		$this->assign('page_list', $page_list);
		$this->assign('page', $page);
		$this->assign('categorys', $categorys);
		$this->display ();
	}

	public function add(){
		$catid = I('get.catid','','intval');
		if(IS_POST){
			$info = I('post.info');
			//$info['content'] = trim_script(addslashes($_POST['info']['content']));
			//后台发布不用审核
			$info['status'] = 99;
			$info['catid'] = $catid;
			$info['content'] = I('post.content','', '');

			//验证规则
			$DB = D('Article');
			if(!$DB->create($info)){
				//如果不通过 ，输出错误报告
				$this->ajaxReturn(array('statusCode'=>300,'message'=>$DB->getError()));
			}else{
				$result = $DB->add_content($info);
			}
			if($result){
				$this->ajaxReturn(array('statusCode'=>200,'closeCurrent'=>true,'divid'=>'layout_'.$this->controller,'message'=>'保存成功'));
			}else{
				$this->ajaxReturn(array('statusCode'=>300,'message'=>'保存失败ERROR:003'));
			}
		}else{
			$this->assign('catid', $catid);
			$this->assign('categorys',$this->categorys);
			$this->typeList = D('ArticleType')->select();
			$this->display('edit');
		}
	}
	public function edit(){
		$db = D('Article');
		$id = I('get.id','','intval');
		
		//取出该文章信息
		$detail = $db->getDetail($id);
		if(!$detail){
			$this->ajaxReturn(array('statusCode'=>300,'message'=>'文章不存在'));
		}
		if(IS_POST){
			//验证规则
			$info = I('post.info');
			$info['content'] = I('post.content','', '');
			if(!$db->create($info, 2)){
				//如果不通过 ，输出错误报告
				$this->ajaxReturn(array('statusCode'=>300,'message'=>D('Article')->getError()));
			}else{
				$result = $db->edit_content($info, $id);
			}
	
			if($result){
				$this->ajaxReturn(array('statusCode'=>200,'closeCurrent'=>true,'message'=>'保存成功','divid'=>'layout_'.$this->controller));
			}else{
				$this->ajaxReturn(array('statusCode'=>300,'message'=>'保存失败ERROR:003'));
			}
		}else{
			$this->assign('catid', $detail['catid']);
			$this->assign('Detail', $detail);
			$this->assign('categorys',$this->categorys);
			$this->typeList = D('ArticleType')->select();
			$this->display();
		}
	}
	//批量删除文章
	public function delete(){
		$db = D('Article');
		$ids = I('get.ids');  //获取ids字符串  '1130,1127'
		if(!$ids)
			$this->ajaxReturn(array('statusCode'=>300,'message'=>'请选择要删除的文章'));
		$idsList = explode(',', $ids);
		//循环删除文章
		foreach ($idsList as $id){
			//删除内容
			$db->delete_content($id);
			//其他相关操作
		}
		$this->ajaxReturn(array('statusCode'=>200,'message'=>'删除成功','divid'=>'layout_'.$this->controller));
		
	}
    //文章分类列表
    public function category(){
    	$tree = new \Lain\Phpcms\tree();
    	$tree->icon = array('&nbsp;&nbsp;&nbsp;│ ','&nbsp;&nbsp;&nbsp;├─ ','&nbsp;&nbsp;&nbsp;└─ ');
    	$tree->nbsp = '&nbsp;&nbsp;&nbsp;';
    	
    	$result = $this->categorys;
    	if(!empty($result)){
    		foreach ($result as $r){
    			$categoryList[$r['catid']] = $r;
    			$categoryList[$r['catid']]['typename'] = $r['type'] == 1 ? '单网页' : '内部栏目';
    			$categoryList[$r['catid']]['str_manage'] = '<a class="btn btn-green" href="'.U($this->controller.'/categoryAdd?parentid='.$r['catid']).'" data-toggle="dialog" data-width="420" data-height="520" data-id="dialog-mask" data-mask="true">添加子类</a> <a class="btn btn-green" href="'.U($this->controller.'/categoryEdit?catid='.$r['catid']).'" data-toggle="dialog" data-width="820" data-height="620" data-id="dialog-mask" data-mask="true">编辑</a> <a href="'.U($this->controller.'/categoryDelete?catid='.$r['catid']).'" class="btn btn-red" data-toggle="doajax" data-confirm-msg="确定要删除该栏目吗？">删</a> ';
    		}
    	}
    	$str  = "<tr target='rid' rel='\$catid'>
    				<td>\$catid</td>
    				<td>\$spacer\$catname</td>
    				<td>\$typename</td>
    				<td>\$listorder</td>
    				<td align='center'>\$str_manage</td>
				</tr>";
    	$tree->init($categoryList);
    	$this->categoryList = $tree->get_tree(0, $str);
    	$this->display();
    }
    //更新栏目缓存 
    public function categoryCache(){
    	D('ArticleCategory')->public_cache();
    	$this->ajaxReturn(array('statusCode'=>200,'message'=>'更新缓存成功','tabid'=>$this->controller.'_category'));
    }
    public function categoryAdd(){
        $parentid = I('get.parentid') ? I('get.parentid') : 0;
    	if(IS_POST){
    		$DB = D('ArticleCategory');
    		$info = I('post.info');
    		$setting = I('post.setting');
    		$info['setting'] = serialize($setting);
			$info['description'] = I('post.description','', '');
    		if(!$DB->create($info)){
    			$this->ajaxReturn(array('statusCode'=>300,'message'=>$DB->getError()));
    		}else{
    			$catid = $DB->add($info);
    			//如果是单网页, 则需要添加到page表
    			$data['title'] = $info['catname'];
    			$data['catid'] = $catid;
    			D('Page')->add($data);
    		}
    		if($catid){
    			//更新缓存
    			$DB->public_cache();
    			$this->ajaxReturn(array('statusCode'=>200,'closeCurrent'=>true,'message'=>'保存成功','tabid'=>$this->controller.'_category'));
    		}else{
    			$this->ajaxReturn(array('statusCode'=>300,'message'=>'保存失败。ErrorNo:0003'));
    		}
    	}else{
    	    $this->assign('parentid', $parentid);
    		$this->display('categoryEdit');
    	}
    }
    /*
     * 栏目分类编辑
    */
    public function categoryEdit(){

    	$DB = D('ArticleCategory');
    	if(IS_POST){
    		$catid = I('post.catid','','intval');
    		$info = I('post.info');
    		$setting = I('post.setting');
    		$info['setting'] = serialize($setting);
			$info['description'] = I('post.description','', '');
    		if(!$DB->create($info)){
    			$this->ajaxReturn(array('statusCode'=>300,'message'=>$DB->getError()));
    		}else{
    			$result = $DB->where('catid='.$catid)->save($info);
    		}
    		if($result){
    			//更新缓存
    			$DB->public_cache();
    			$this->ajaxReturn(array('statusCode'=>200,'closeCurrent'=>true,'message'=>'保存成功','tabid'=>$this->controller.'_category'));
    		}else{
    			$this->ajaxReturn(array('statusCode'=>300,'message'=>'保存失败。ErrorNo:0003'));
    		}
    	}else{
    		$this->catid = $catid = I('get.catid','','intval');
    		$detail = $DB->where('catid='.$catid)->find();

    		$setting = unserialize($detail['setting']);
    		
    		$this->assign('setting', $setting);
    		$this->assign('Detail', $detail);
			$this->assign('parentid', $detail['parentid']);
			$this->display();
    	}
    }
    
    /*
     * 删除栏目分类
    */
    public function categoryDelete(){
    	$DB = D('ArticleCategory');
    	$catid = I('get.catid','','intval');
    	if (!$catid)
    		$this->ajaxReturn(array('statusCode'=>300,'message'=>'参数错误'));
    	//判断栏目是否有文章
    	//删除子栏目
    	$delete_catids = $DB->delete_child($catid);
    	//删除栏目
    	$DB->where('catid='.$catid)->delete();
    	//更新缓存
    	$DB->public_cache();
    	$this->ajaxReturn(array('statusCode'=>200,'message'=>'删除成功','tabid'=>$this->controller.'_category'));
    	
    }
    
    //单网页编辑
    public function pageEdit(){
		$catid = I('get.catid','','intval');
		//$this->catid = $catid = I('get.catid','','intval');
		
		//取出该文章信息
		$detail = D('Page')->where('catid='.$catid)->find();
		if(!$detail){
			$this->ajaxReturn(array('statusCode'=>300,'message'=>'文章不存在'));
		}
		
		if(IS_POST){
			//验证规则
			$info = I('post.info');
			if(!D('Page')->create($info)){
				//如果不通过 ，输出错误报告
				$this->ajaxReturn(array('statusCode'=>300,'message'=>D('Page')->getError()));
			}else{
				D('Page')->where('catid='.$catid)->save($info);
			}
	
			$this->ajaxReturn(array('statusCode'=>200,'closeCurrent'=>true,'message'=>'保存成功'));
		}else{
			$this->assign('catid', $detail['catid']);
			$this->assign('Detail', $detail);
			$this->display();
		}
	}


	public function type(){
		$db = D('ArticleType');
		$map = array();
		// 分页相关
		$page['pageCurrent'] = max(1 , I('post.pageCurrent'));
		$page['pageSize']= I('post.pageSize') ? I('post.pageSize') : 30 ;

		$totalCount = $db->where($map)->count();
		$page ['totalCount'] = $totalCount;
		// 取数据
		$page_list = $db->where($map)->page($page['pageCurrent'], $page['pageSize'])->order(array('id ASC'))->select();

		$this->assign('page_list', $page_list);
		$this->assign('page', $page);
		$this->display ();
	}

	public function typeadd(){
		if(IS_POST){
			$DB = D('ArticleType');
			$info = I('post.info');
			$info['inputtime'] = time();
			$result = $DB->add($info);
			if($result){
				$this->ajaxReturn(array('statusCode'=>200,'closeCurrent'=>true,'message'=>'保存成功','tabid'=>$this->controller.'_type'));
			}else{
				$this->ajaxReturn(array('statusCode'=>300,'message'=>'保存失败。ErrorNo:0003'));
			}
		}else{
			$this->display('typeedit');
		}
	}
	/*
     * 栏目分类编辑
    */
	public function typeedit(){
		$id = (int)I('get.id');
		if(empty($id)) $this->ajaxReturn(array('statusCode'=>300,'message'=>'非法操作。ErrorNo:0003'));
		$DB = D('ArticleType');
		if(IS_POST){
			$info = I('post.info');
			$info['inputtime'] = time();
			$result = $DB->where(array('id'=>$id))->save($info);
			if($result){
				$this->ajaxReturn(array('statusCode'=>200,'closeCurrent'=>true,'message'=>'保存成功','tabid'=>$this->controller.'_type'));
			}else{
				$this->ajaxReturn(array('statusCode'=>300,'message'=>'保存失败。ErrorNo:0003'));
			}
		}else{
			$detail = $DB->where(array('id'=>$id))->find();
			$this->assign('Detail', $detail);
			$this->display();
		}
	}

	/*
     * 删除栏目分类
    */
	public function typedel(){
		$DB = D('ArticleType');
		$id = I('get.id','','intval');
		if (!$id) $this->ajaxReturn(array('statusCode'=>300,'message'=>'参数错误'));
		$DB->where(array('id'=>$id))->delete();
		$this->ajaxReturn(array('statusCode'=>200,'message'=>'删除成功','tabid'=>$this->controller.'_type'));

	}
}