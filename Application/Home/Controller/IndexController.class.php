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
class IndexController extends CommonController {

    private $categorys;
    private $daoHangList;
    function __construct()
    {
        parent::__construct();
        if(!$this->categorys = F('category_content')){
            $ArticleCategory = new ArticleCategoryModel();
            $ArticleCategory->file_cache();
            $this->categorys = F('category_content');
        }
        $this->daoHangList = D('Link')->where(array('type'=>2,'status'=>99))->order('sort DESC')->select();
        $this->beiYongDaoHangList = D('Link')->where(array('type'=>3,'status'=>99))->order('sort DESC')->select();
        $this->assign('daoHangList', $this->daoHangList);
        $this->assign('beiYongDaoHangList', $this->beiYongDaoHangList);

        $this->assign('categorys', $this->categorys);
    }

    public function index(){
        $Article = new ArticleModel();
        $Type = new ArticleTypeModel();
        $Seo = new SeoModel();
        $typeInfo = $Type->One();
        /*$typeInfo['data'] = $Article->getManyNews(array('status'=>99,'type'=>$typeInfo['id']));
        $this->assign('typeInfo', $typeInfo);*/
        $resultArray = array();
        foreach($this->categorys as $key=>$value){
            $resultArray[$key] = $this->getResult($value['catid']);
        }
        $this->assign('resultArray', $resultArray);
        $dataArray = array();
        foreach($this->categorys as $key=>$value){
            $dataArray[$key]['cateInfo'] = $value;
            $dataArray[$key]['typeInfo'] = $typeInfo;
            $dataArray[$key]['data'] = $Article->getManyNews(array('status'=>99,'catid'=>$value['catid'],'type'=>$typeInfo['id']));
        }
        $this->seoInfo = $Seo->createSeo(__FUNCTION__);
        $this->types = $Type->getManyType();
        $this->cacheTypes = $Type->types();
        $this->assign('dataArray', $dataArray);
        $this->linkList = D('Link')->where(array('type'=>1,'status'=>99))->order('sort DESC')->select();
        $this->display();
    }
    public function lists(){
        $cat = I('get.catpinyin');
        $type = I('get.typepinyin');
        $ArticleCategory = new ArticleCategoryModel();
        $ArticleType = new ArticleTypeModel();
        $Article = new ArticleModel();
        $Seo = new SeoModel();

        if(empty($cat) || empty($type)) _404();
        $categoryInfo = $ArticleCategory->One(array('url'=>$cat));
        $typeInfo = $ArticleType->One(array('pinyin'=>$type));
        if(empty($categoryInfo) || empty($typeInfo)) _404();
        $categoryInfo = $this->categorys[$categoryInfo['catid']];
        $url = '/'.$categoryInfo['url'].'/'.$typeInfo['pinyin'].'/index_[PAGE].html';
        $pagelist = $Article->getPageNews(array('catid'=>$categoryInfo['catid'], 'type'=>$typeInfo['id']),$url);
        $this->list = $pagelist['list'];
        $this->page = $pagelist['page'];
        $this->count = $pagelist['count'];
        $typeData = $ArticleType->getManyType(array('id'=>array('neq', $typeInfo['id'])));
        foreach($typeData as $key=>$value){
            $typeData[$key]['data'] = $Article->getManyNews(array('catid'=>$categoryInfo['catid'],'status'=>99,'type'=>$value['id']),9);
        }
        $this->assign('typeData', $typeData);
        $this->assign('categoryInfo',$categoryInfo);
        $this->assign('typeInfo',$typeInfo);
        $this->seoInfo = $Seo->createSeo(__FUNCTION__, array('typename'=>$typeInfo['title'], 'catname'=>$categoryInfo['catname']));
        $this->cacheTypes = $ArticleType->types();
        $this->types = $ArticleType->getManyType();
        $this->display();
    }

    public function detail(){
        $cat = I('get.catpinyin');
        $id = (int)I('get.id');
        $ArticleCategory = new ArticleCategoryModel();
        $ArticleType = new ArticleTypeModel();
        $Article = new ArticleModel();
        $Seo = new SeoModel();

        if(empty($cat) || empty($id)) _404();
        $categoryInfo = $ArticleCategory->One(array('url'=>$cat));
        if(empty($categoryInfo)) _404();
        $categoryInfo = $this->categorys[$categoryInfo['catid']];
        $detail = $Article->One(array('id'=>$id));
        if(empty($detail)) _404();
        $typeInfo = $ArticleType->One(array('id'=>$detail['type']));
        $dataInfo = $Article->getManyNews(array('catid'=>$categoryInfo['catid'],'status'=>99,'type'=>$typeInfo['id'],'id'=>array('neq', $detail['id'])),5);
        $typeData = $ArticleType->getManyType(array('id'=>array('neq', $detail['type'])));
        foreach($typeData as $key=>$value){
            $typeData[$key]['data'] = $Article->getManyNews(array('catid'=>$categoryInfo['catid'],'status'=>99,'type'=>$value['id']),9);
        }
        $this->assign('Detail', $detail);
        $this->assign('typeData', $typeData);
        $this->assign('categoryInfo', $categoryInfo);
        $this->assign('typeInfo',$typeInfo);
        $this->assign('dataInfo',$dataInfo);
        $seoInfo = $Seo->createSeo(__FUNCTION__, array('typename'=>$typeInfo['title'], 'catname'=>$categoryInfo['catname'], 'title'=>$detail['title']));
        $seoInfo['seo_description'] = _substr($detail['description'], 250, '...');
        $this->seoInfo = $seoInfo;
        $this->display();
    }
    public function hall(){
        $cat = I('get.catpinyin');
        $ArticleCategory = new ArticleCategoryModel();
        $ArticleType = new ArticleTypeModel();
        $Article = new ArticleModel();
        $Result = new ResultModel();
        $Seo = new SeoModel();
        if(empty($cat)) _404();
        $categoryInfo = $ArticleCategory->One(array('url'=>$cat));
        if(empty($categoryInfo)) _404();
        $categoryInfo = $this->categorys[$categoryInfo['catid']];
        $typeData = $ArticleType->getManyType();
        foreach($typeData as $key=>$value){
            $typeData[$key]['data'] = $Article->getManyNews(array('catid'=>$categoryInfo['catid'],'status'=>99,'type'=>$value['id']),9);
        }
        $resultList = $Result->getManyNews(array('type_id'=>$categoryInfo['catid']),50);
        $this->assign('typeData', $typeData);
        $this->assign('categoryInfo', $categoryInfo);
        $this->assign('resultInfo', $this->getResult($categoryInfo['catid']));
        $this->assign('resultList', $resultList);
        $this->types = $ArticleType->getManyType();
        $this->seoInfo = $Seo->createSeo(__FUNCTION__, array('catname'=>$categoryInfo['catname']));
        $this->display();
    }
    public function kjzb(){
        $cat = I('get.catpinyin');
        $ArticleCategory = new ArticleCategoryModel();
        $ArticleType = new ArticleTypeModel();
        $Article = new ArticleModel();
        $Result = new ResultModel();
        $Seo = new SeoModel();

        if(empty($cat)) _404();
        $categoryInfo = $ArticleCategory->One(array('url'=>$cat));
        if(empty($categoryInfo)) _404();
        $categoryInfo = $this->categorys[$categoryInfo['catid']];
        $typeData = $ArticleType->getManyType();
        foreach($typeData as $key=>$value){
            $typeData[$key]['data'] = $Article->getManyNews(array('catid'=>$categoryInfo['catid'],'status'=>99,'type'=>$value['id']),9);
        }
        $resultList = $Result->getManyNews(array('type_id'=>$categoryInfo['catid'],'riqi'=>date('Y-m-d')));
        $this->assign('typeData', $typeData);
        $this->assign('categoryInfo', $categoryInfo);
        $this->assign('resultInfo', $this->getResult($categoryInfo['catid']));
        $this->assign('resultList', $resultList);
        $this->seoInfo = $Seo->createSeo(__FUNCTION__, array('catname'=>$categoryInfo['catname']));
        $this->display();
    }
    private function getResult($catid){
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
            'remainTime'=>$timeInfo['kjtime']-$timeInfo['opentime']-2,
            'categoryInfo'=>$this->categorys[$catid],
            'other'=>array('resultCount'=>$resultCount,'timeCount'=>$timeCount,'remainTime'=>$remainTime, 'min'=>$min, 'sec'=>$sec),
        );
    }

}