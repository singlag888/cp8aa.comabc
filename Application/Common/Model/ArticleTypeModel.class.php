<?php
// 配置类型模型
namespace Common\Model;
use Think\Model;
class ArticleTypeModel extends Model {

    /*
     * 获取最新资讯
     * @param where array|varchar
     * @param limit int
     * @field varchar
     * @return array
     * 2015年3月19日15:59:46
     * create by zslin
     * */
    public function One($where='',$field=array()){
        $m = l_create_name($this->getModelName(), __FUNCTION__, array($where, $field));
        $res = S($m);
        if(empty($res)){
            $res = $this->field($field)->where($where)->find();
            S($m, $res, 60*30);
        }
        return $res;
    }
    public function getManyType($where='',$limit=100,$field='id,title,pinyin',$order='id DESC'){
        //if(empty($where)) return false;
        $m = l_create_name($this->getModelName(), __FUNCTION__, array($where, $limit, $field,$order));
        $res = S($m);
        if(empty($res)){
            $res = $this->field($field)->where($where)->order($order)->limit($limit)->select();
            S($m, $res, 60*30);
        }
        return $res;
    }
    public function types(){
        $m = l_create_name($this->getModelName(), __FUNCTION__);
        $array = S($m);
        if(empty($array)){
            $res = $this->field('id,title,pinyin')->order(array('id DESC'))->limit(100)->select();
            $array = array();
            foreach($res as $value){
                $array[$value['id']] = $value;
            }
            S($m, $array, 60*30);
        }
        return $array;
    }
}
?>