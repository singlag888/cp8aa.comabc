<?php
namespace Home\Controller;
use Think\Controller;
class InterfaceController extends Controller
{

	public function article(){
        header( "Content-type: text/html; charset=utf-8" );


        $post = I('post.');
        if ($post){
            //$model = D("Admin/Article");

            //验证规则
            $DB = D('Admin/Article');
            if(!$DB->create($post)){
                //如果不通过 ，输出错误报告
                exit($DB->getError());
            }else{
                $result = $DB->add_content($post);
            }
            if($result){
                exit('Success');
            }else{
                exit('Error');
            }
        }else{
            echo '没有参数';
        }
    }

    
}