<?php
namespace Admin\Controller;
class BasicController extends AdminController{
	public function _initialize(){
		$action = array(
				'permission'=>array('profile', 'changePassword', 'ajax_checkUsername'),
				//'allow'=>array('index')
		);
		B('Admin\\Behaviors\\Authenticate', '', $action);
	}

	/**
	 * 修改个人资料
	 * 		-只有修改昵称部分
	 */
	public function index(){
		$id = 1;
		if(IS_POST){
			$data = I('post.info');
			$data['beizhu'] = I('post.beizhu', '', '');
			$result = D('Basic')->where(array('id'=>$id))->save($data);
			if($result){
				$this->ajaxReturn(array('statusCode'=>200,'closeCurrent'=>'true','message'=>'操作成功'));
			}else{
				$this->ajaxReturn(array('statusCode'=>300,'message'=>'修改失败'));
			}
		}else{
			$detail = D('Basic')->where(array('id'=>$id))->find();
			$this->assign('Detail', $detail);
			$this->display();
		}
	}
}