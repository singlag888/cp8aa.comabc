<?php 
/*
 * 文章分类模型
 */
namespace Common\Model;
use Think\Model;
class ArticleCategoryModel extends Model {
	public $categorys;
	public function file_cache(){
		$this->categorys = $this->limit(0,100)->order('listorder ASC')->select();
		foreach($this->categorys as $r) {
			unset($r['module']);
			$r['setting'] = unserialize($r['setting']);
			$categorys[$r['catid']] = $r;
		}
		F('category_content',$categorys);
		return true;
	}
	public function One($where='',$field='catid,catname,url,description'){
		$m = l_create_name($this->getModelName(), __FUNCTION__, array($where, $field));
		$res = S($m);
		if(empty($res)){
			$res = $this->field($field)->where($where)->find();
			S($m, $res, 60*30);
		}
		return $res;
	}
}
