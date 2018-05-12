<?php
// 配置类型模型
namespace Common\Model;
use Think\Model;
class BasicModel extends Model {

    public function One($where='',$field=null){
        if(empty($where)) return false;
        $m = l_create_name($this->getModelName(), __FUNCTION__, array($where, $field));
        $res = S($m);
        if(empty($res)){
            $res = $this->field($field)->where($where)->find();
            S($m, $res, 60*30);
        }
        return $res;
    }


}
?>