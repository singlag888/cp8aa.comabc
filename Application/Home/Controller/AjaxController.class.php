<?php
namespace Home\Controller;
use Common\Model\ArticleCategoryModel;
use Common\Model\ArticleTypeModel;
use Common\Model\BasicModel;
use Common\Model\ResultModel;
use Common\Model\SeoModel;
use Common\Model\TimeModel;
use Common\Model\TypeModel;
use Think\Controller;
use Common\Model\ArticleModel;
class AjaxController extends CommonController {

    private $categorys;
    function __construct()
    {
        parent::__construct();
        if(!$this->categorys = F('category_content')){
            $ArticleCategory = new ArticleCategoryModel();
            $ArticleCategory->file_cache();
            $this->categorys = F('category_content');
        }
    }

    public function result(){
        $Type = new ArticleTypeModel();
        $catid = (int)I('post.id');
        $this->assign('resultInfo', $this->getResult($catid));
        $this->types = $Type->getManyType();
        $this->display();
    }
    public function resultInfo(){
        $catid = (int)I('post.id');
        $next = I('post.next');
        $Result = new ResultModel();
        $nextInfo = $Result->One(array('type_id'=>$catid,'expect'=>$next));
        if(empty($nextInfo)){
            echo json_encode(array('msgCode'=>0));
            exit();
        }
        $Type = new ArticleTypeModel();
        $resultInfo = $this->getResult($catid,$next);
        $this->assign('resultInfo', $resultInfo);
        $this->types = $Type->getManyType();
        $html = $this->fetch();
        echo json_encode(array('msgCode'=>1, 'html'=>$html,'remainTime'=>$resultInfo['other']['remainTime']));
        exit();
    }


    private function getResult($catid,$nextid=false){
        if(empty($catid)) return false;
        $time = time();
        $Result = new ResultModel();
        $Time = new TimeModel();
        if($nextid){
            $resultInfo = $Result->One(array('type_id'=>$catid,'expect'=>$nextid));
        }else{
            $resultInfo = $Result->One(array('type_id'=>$catid));
        }

        $date = date('Y-m-d');
        $resultCount = $Result->where(array('type_id'=>$catid, 'riqi'=>$date))->count();
        $timeCount = $Time->where(array('type_id'=>$catid, 'riqi'=>$date))->count();
        $timeInfo = $Time->One(array('type_id'=>$catid,'opentime'=>array('elt',$time), array('kjtime'=>array('egt', $time))));
        $min = 0;
        $sec = 0;
        $remainTime = 0;
        if(false == empty($timeInfo)){
            $remainTime = $timeInfo['kjtime']-$time;
            $min = (int)($remainTime/60);
            $min = $min<10?'0'.$min:$min;
            $sec = (int)($remainTime%60);
            $sec = $sec<10?'0'.$sec:$sec;
        }

        return array(
            'resultInfo'=>$resultInfo,
            'timeInfo'=>$timeInfo,
            'categoryInfo'=>$this->categorys[$catid],
            'other'=>array('resultCount'=>$resultCount,'timeCount'=>$timeCount,'remainTime'=>$remainTime, 'min'=>$min, 'sec'=>$sec),
        );
    }

    public function gettest($catid){
        if(empty($catid)) return false;
        $time = time();
        $Result = new ResultModel();
        $Time = new TimeModel();
        $resultInfo = $Result->One(array('type_id'=>$catid));
        $date = date('Y-m-d');
        $resultCount = $Result->where(array('type_id'=>$catid, 'riqi'=>$date))->count();
        $timeCount = $Time->where(array('type_id'=>$catid, 'riqi'=>$date))->count();
        $timeInfo = $Time->One(array('type_id'=>$catid,'opentime'=>array('elt',$time), array('kjtime'=>array('egt', $time))));
        $min = 0;
        $sec = 0;
        $remainTime = 0;
        if(false == empty($timeInfo)){
            $remainTime = $timeInfo['kjtime']-$time;
            $min = (int)($remainTime/60);
            $min = $min<10?'0'.$min:$min;
            $sec = (int)($remainTime%60);
            $sec = $sec<10?'0'.$sec:$sec;
        }

        return array(
            'resultInfo'=>$resultInfo,
            'timeInfo'=>$timeInfo,
            'categoryInfo'=>$this->categorys[$catid],
            'other'=>array('resultCount'=>$resultCount,'timeCount'=>$timeCount,'remainTime'=>$remainTime, 'min'=>$min, 'sec'=>$sec),
        );
    }
}