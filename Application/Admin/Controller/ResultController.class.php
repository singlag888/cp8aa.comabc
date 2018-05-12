<?php
namespace Admin\Controller;

/**
 * 文章管理
 * @author Lain
 *
 */
class ResultController extends AdminController {
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
		$this->controller = 'Result';
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
		$db = D('Result');
    	$categorys = $this->categorys;
		//取出所在分类
		$this->catid = $catid = I('get.catid','','intval');
		if(!$catid)
			$this->ajaxReturn(array('statusCode'=>300,'message'=>'缺少必要的参数'));
		
		// 检索条件
		$map['status'] = 1;
		//取出子集下的文章
		$map['type_id'] = array('in', $categorys[$catid]['arrchildid']);
		$map['_string'] = 1;
			
   	 	if(isset($_POST['start_time']) && $_POST['start_time']) {
			$this->start_time = $_POST['start_time'];
			$start_time = strtotime($_POST['start_time']);
			$map['_string'] .= " AND `ctime` > '$start_time'";
		}
		if(isset($_POST['end_time']) && $_POST['end_time']) {
			$this->end_time = $_POST['end_time'];
			$end_time = strtotime($_POST['end_time']) + 3600*24;
			$map['_string'] .= " AND `ctime` < '$end_time'";
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
		
		$totalCount = $db->where($map)->count();
		$page ['totalCount'] = $totalCount;
		
		// 取数据
		$page_list = $db->where($map)->page($page['pageCurrent'], $page['pageSize'])->order($order)->select();
		
		$this->assign('page_list', $page_list);
		$this->assign('page', $page);
		$this->assign('categorys', $categorys);
		$this->display ();
	}
	public function time(){
		//取出文章分类
		//$this->categoryList = list_to_tree($this->categorys,'catid','parentid');
		foreach ($this->categorys as $key => $category){
			$data[$key] = $category;
			$data[$key]['name'] = $category['catname'];
			if($category['type'] == 0){	//内部栏目, 显示列表
				$data[$key]['url'] = U($this->controller.'/timemanage?catid='.$category['catid']);
			}
		}
		$nodes = list_to_tree($data, 'catid', 'parentid', 'children');
		$this->assign('json_nodes', json_encode($nodes));

		$this->display();
	}

	//文章内容管理
	public function timemanage(){
		$db = D('Time');
		$categorys = $this->categorys;
		//取出所在分类
		$this->type = $type = I('get.catid','','intval');
		if(!$type)
			$this->ajaxReturn(array('statusCode'=>300,'message'=>'缺少必要的参数'));

		// 检索条件
		$map['status'] = 1;
		//取出子集下的文章
		$map['type_id'] = array('in', $categorys[$type]['arrchildid']);
		$map['_string'] = 1;

		if(isset($_POST['start_time']) && $_POST['start_time']) {
			$this->start_time = $_POST['start_time'];
			$start_time = strtotime($_POST['start_time']);
			$map['_string'] .= " AND `ctime` > '$start_time'";
		}
		if(isset($_POST['end_time']) && $_POST['end_time']) {
			$this->end_time = $_POST['end_time'];
			$end_time = strtotime($_POST['end_time']) + 3600*24;
			$map['_string'] .= " AND `ctime` < '$end_time'";
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

		$totalCount = $db->where($map)->count();
		$page ['totalCount'] = $totalCount;

		// 取数据
		$page_list = $db->where($map)->page($page['pageCurrent'], $page['pageSize'])->order($order)->select();

		$this->assign('page_list', $page_list);
		$this->assign('page', $page);
		$this->assign('categorys', $categorys);
		$this->display ();
	}
}