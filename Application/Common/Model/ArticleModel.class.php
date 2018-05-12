<?php
// 配置类型模型
namespace Common\Model;
use Common\Extend\FormPage;
use Think\Model;
class ArticleModel extends Model {

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
        $where['status'] = 99;
        $m = l_create_name($this->getModelName(), __FUNCTION__, array($where, $field));
        $res = S($m);
        if(empty($res)){
            $res = $this->field($field)->where($where)->find();
            $content = D('ArticleData')->where(array('article_id'=>$res['id']))->find();
            $res['content'] = $content['content'];
            S($m, $res, 60*30);
        }
        return $res;
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
    public function getManyNews($where='',$limit=5,$field='id,title,inputtime,catid,type',$order='id DESC'){
        if(empty($where)) return false;
        $m = l_create_name($this->getModelName(), __FUNCTION__, array($where, $limit, $field,$order));
        $res = S($m);
        if(empty($res)){
            $res = $this->field($field)->where($where)->order($order)->limit($limit)->select();
            S($m, $res);
        }
        return $res;
    }
    /*
     * 获取新闻资讯分页
     * @param where array|varchar
     * @param url varchar url规则 必须是xxx-[PAGE](PAGE必须是大写)
     * @param pagenum int
     * @field varchar
     * @return list array 数据列表
     * @return page varchar 分页样式 调用格式必须是<div class="digg">{$page}</div> 样式存放在 layout.css样式表中
     * @return count int 总量
     * 2015年3月19日15:59:46
     * create by zslin
     * */
    public function getPageNews($where,$url='',$pagenum=15,$field='id,title,inputtime,thumb,description,type'){
        if(empty($where) || empty($url)) return false;
        $count      = $this->where($where)->count();
        $Page       = new FormPage($count,$pagenum);// 实例化分页类 传入总记录数和每页显示的记录数(25)
        $m = l_create_name($this->getModelName(),__FUNCTION__,array($where,$url,$pagenum,$field,$Page->firstRow));
        $res = S($m);
        if (empty($res)) {
            $res = $this->field($field)->where($where)->order('id DESC')->limit($Page->firstRow.','.$Page->listRows)->select();
            S($m,$res);
        }
        if($url) $Page->setConfig('link',$url);
        return array('list'=>$res,'page'=>$Page->show(),'count'=>$count);
    }

}
?>