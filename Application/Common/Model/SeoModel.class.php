<?php
// 配置类型模型
namespace Common\Model;
use Common\Extend\FormPage;
use Think\Model;
class SeoModel extends Model {

    /*
     * 获取最新资讯
     * @param where array|varchar
     * @param limit int
     * @field varchar
     * @return array
     * 2015年3月19日15:59:46
     * create by zslin
     * */
    public function One($where='',$field=null){
        if(empty($where)) return false;
        $m = l_create_name($this->getModelName(), __FUNCTION__, array($where, $field));
        $res = S($m);
        if(empty($res)){
            $res = $this->field($field)->where($where)->find();
            S($m, $res, 60);
        }
        return $res;
    }

    public function createSeo($func,$data = array()){
        if(empty($func)) return false;
        $detail = $this->One(array('func'=>$func), array('seo_title','seo_keywords', 'seo_description'));
        if(empty($data)) return $detail;
        foreach($data as $key=>$value){
            $detail['seo_title'] = str_replace($key,$value,$detail['seo_title']);
            $detail['seo_keywords'] = str_replace($key,$value,$detail['seo_keywords']);
            $detail['seo_description'] = str_replace($key,$value,$detail['seo_description']);
        }
        return $detail;
    }

}
?>