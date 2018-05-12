<?php
// 配置类型模型
namespace Common\Model;
use Common\Extend\FormPage;
use Think\Model;
class ResultModel extends Model {
	protected $connection = 'DB_PDC';
    public function One($where='',$field='expect,opencode,opentimestamp', $order='expect DESC'){
        if(empty($where)) return false;
        $m = l_create_name($this->getModelName(), __FUNCTION__, array($where, $field,$order));
        $res = S($m);
        if(empty($res)){
            $res = $this->field($field)->where($where)->order($order)->find();
            S($m, $res, 10);
        }
        return $res;
    }

    public function getPage($where,$url='',$pagenum=1000,$field='id,opencode,expect,opentimestamp'){
        if(empty($where) || empty($url)) return false;
        $count      = $this->where($where)->count();
        $Page       = new FormPage($count,$pagenum);// 实例化分页类 传入总记录数和每页显示的记录数(25)
        $m = l_create_name($this->getModelName(),__FUNCTION__,array($where,$url,$pagenum,$field,$Page->firstRow));
        $res = S($m);
        if (empty($res)) {
            $res = $this->field($field)->where($where)->order('expect DESC')->limit($Page->firstRow.','.$Page->listRows)->select();
            S($m,$res);
        }
        if($url) $Page->setConfig('link',$url);
        return array('list'=>$res,'page'=>$Page->show(),'count'=>$count);
    }

    /*
     * 获取最新资讯
     * @param where array|varchar
     * @param limit int
     * @field varchar
     * @return array
     * 2015年3月19日15:59:46
     * create by zslin
     * */
    public function getManyNews($where='',$limit=1000,$field='id,opencode,expect,opentimestamp,ctime',$order='expect DESC'){
        if(empty($where)) return false;
        $m = l_create_name($this->getModelName(), __FUNCTION__, array($where, $limit, $field,$order));
        $res = S($m);
        if(empty($res)){
            $res = $this->field($field)->where($where)->order($order)->limit($limit)->select();
            S($m, $res);
        }
        return $res;
    }

}
?>
