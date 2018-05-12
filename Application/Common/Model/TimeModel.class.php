<?php
// 配置类型模型
namespace Common\Model;
use Think\Model;
class TimeModel extends Model {
	protected $connection = 'DB_PDC';
    public function One($where='',$field='expect,kjtime,opentime'){
        if(empty($where)) return false;
        return $this->field($field)->where($where)->find();
    }
}
?>