<?php
namespace Admin\Controller;
class SeoController extends AdminController{
	public function _initialize(){
		$action = array(
				'permission'=>array('profile', 'changePassword', 'ajax_checkUsername'),
				//'allow'=>array('index')
		);
		B('Admin\\Behaviors\\Authenticate', '', $action);
	}
	public function index(){
		$DB = D('Seo');
		//初始化
		$map = array();
		$order = 'id ASC';

		// 分页相关
		$page['pageCurrent'] = max(1 , I('post.pageCurrent'));
		$page['pageSize']= I('post.pageSize') ? I('post.pageSize') : 30 ;
		$totalCount = $DB->where($map)->count();
		$page ['totalCount'] = $totalCount;
		$page_list = $DB->where($map)->page($page['pageCurrent'], $page['pageSize'])->order($order)->select();

		$this->assign('page_list', $page_list);
		$this->assign('page', $page);
		$this->display();
	}
	public function edit(){
		$DB = D('Seo');
		$id = (int)I('get.id');
		if(empty($id)) $this->ajaxReturn(array('statusCode'=>300,'message'=>'非法操作'));
		if(IS_POST){
			//验证规则
			$info = $_POST['info'];
			$result = $DB->where(array('id'=>$id))->save($info);
			if($result){
				$this->ajaxReturn(array('statusCode'=>200,'closeCurrent'=>true,'message'=>'保存成功','tabid'=>'Seo_index'));
			}else{
				$this->ajaxReturn(array('statusCode'=>300,'message'=>'保存失败ERROR:003'));
			}
		}
		$this->Detail = $DB->where(array('id'=>$id))->find();
		$this->display();
	}
	public function add(){
		$DB = D('Seo');
		if(IS_POST){
			//验证规则
			$info = $_POST['info'];
			$info['ctime'] = time();
			$result = $DB->add($info);
			if($result){
				$this->ajaxReturn(array('statusCode'=>200,'closeCurrent'=>true,'message'=>'保存成功','tabid'=>'Seo_index'));
			}else{
				$this->ajaxReturn(array('statusCode'=>300,'message'=>'保存失败ERROR:003'));
			}
		}
		$this->display('edit');
	}

	

    
}