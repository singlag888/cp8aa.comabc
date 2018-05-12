<?php
namespace Mobile\Controller;
use Common\Model\ArticleModel;
use Think\Controller;
class ApiController extends Controller
{
	public function pdcArticle(){
		if(!IS_CLI) exit('fuck');
		$Pdc = D('Pdc');
		$Article = D('Article');

		$list = $Pdc->where(array('status'=>1,'times'=>array('lt',10)))->limit(1000)->select();
		$successIds = array();
		$FailIds = array();
		foreach($list as $key=>$value){
			$info = $Article->One(array('id'=>$value['aid']));
			$info['thumb'] = str_replace('/Uploads', "http://www.pdc.cm/Uploads", $info['thumb']);
			$info['content'] = str_replace('/Uploads', "http://www.pdc.cm/Uploads", $info['content']);
			$info['key'] = md5($info['title'].'hjdashdshjdsAHK');
			unset($info['id']);
			$url = trim($value['url'],'/');
			$result = $this->request_post($url.'/Home/Api/article/',$info);
			$result = json_decode($result, true);
			if(1 == $result['msgCode']){
				$successIds[] = $value['id'];
			}else{
				$FailIds[] = $value['id'];
			}
		}
		if($successIds){
			$Pdc->where(array('id'=>array('in',$successIds)))->save(array('status'=>99));
		}
		if($FailIds){
			$Pdc->where(array('id'=>array('in',$FailIds)))->setInc('times',1);
		}
	}

	public function pdcResult(){
		if(!IS_CLI) exit('fuck');
		$PdcResult = D('PdcResult');
		$CpResult = D('Result');

		$list = $PdcResult->where(array('status'=>1,'times'=>array('lt',10)))->limit(1000)->select();
		$successIds = array();
		$FailIds = array();
		foreach($list as $key=>$value){
			$info = $CpResult->where(array('id'=>$value['rid']))->find();
			unset($info['id']);
			$url = trim($value['url'],'/');
			$info['key'] = md5($info['expect'].'hjdashdshjdsAHK');
			$result = $this->request_post($url.'/Home/Api/result/',$info);
			$result = json_decode($result, true);
			if(1 == $result['msgCode']){
				$successIds[] = $value['id'];
			}else{
				$FailIds[] = $value['id'];
			}
		}
		if($successIds){
			$PdcResult->where(array('id'=>array('in',$successIds)))->save(array('status'=>99));
		}
		if($FailIds){
			$PdcResult->where(array('id'=>array('in',$FailIds)))->setInc('times',1);
		}
	}

	public function article(){
		if(IS_POST){
			$Article = new ArticleModel();
			$data = $_POST;
			if($data['key'] != md5($data['title'].'hjdashdshjdsAHK')){
				echo json_encode(array('msg'=>'Fuck You'));
				exit();
			}
			$content = ContentDownImg($data['content'],$data['title']);
			$data['content'] = $content['data'];
			if(empty($data['thumb']) && $content['imglist']){
				$data['thumb'] = img_thumb($content['imglist'][0]);
			}
			$info = $Article->where(array('title'=>$data['title']))->find();
			if($info){
				echo json_encode(array('msgCode'=>1));
				exit();
			}else{
				unset($data['key']);
				$id = $Article->add($data);
				if(empty($id)) exit('error');
				$datainfo['article_id'] = $id;
				$datainfo['content'] = $data['content'];
				$result = M('ArticleData')->add($datainfo);
				if($result){
					echo json_encode(array('msgCode'=>1));
					exit();
				}else{
					echo json_encode(array('msgCode'=>0));
					exit();
				}
			}
		}else{
			echo json_encode(array('msg'=> 'This is Test'));
			exit();
		}
	}
	public function result(){
		if(IS_POST){
			$CpResult = D('Result');
			$data = $_POST;
			if($data['key'] != md5($data['expect'].'hjdashdshjdsAHK')){
				echo json_encode(array('msg'=>'Fuck You'));
				exit();
			}

			$where = array('type_id'=>$data['type_id'],'expect'=>$data['expect']);
			$info = $CpResult->field(array('id','opencode'))->where($where)->find();
			if($info){
				echo json_encode(array('msgCode'=>1));
				exit();
			}else{
				unset($data['key']);
				$result = $CpResult->add($data);
				if($result){
					echo json_encode(array('msgCode'=>1));
					exit();
				}else{
					echo json_encode(array('msgCode'=>0));
					exit();
				}
			}
		}else{
			echo json_encode(array('msg'=> 'This is Test'));
			exit();
		}
	}



	public function index(){
		if(!IS_CLI) exit('Fuck You');
		$id = I('get.id');
		if(empty($id)) exit('Error');
		$CpResult = D('Result');
		$this->addTime($id);
		$list = array(
				'1'=>'http://ho.apiplus.net/newly.do?token=t877b1a3dde95a3fbk&code=ahk3&format=json',
				'2'=>'http://ho.apiplus.net/newly.do?token=t877b1a3dde95a3fbk&code=bjk3&format=json',
				'3'=>'http://ho.apiplus.net/newly.do?token=t877b1a3dde95a3fbk&code=jsk3&format=json',
				'4'=>'http://ho.apiplus.net/newly.do?token=t877b1a3dde95a3fbk&code=gdklsf&format=json',
				'5'=>'http://ho.apiplus.net/newly.do?token=t877b1a3dde95a3fbk&code=cqssc&format=json',
				'6'=>'http://ho.apiplus.net/newly.do?token=t877b1a3dde95a3fbk&code=bjpk10&format=json',
				'7'=>'http://ho.apiplus.net/newly.do?token=t877b1a3dde95a3fbk&code=er75ft&format=json',
				'8'=>'http://ho.apiplus.net/newly.do?token=t877b1a3dde95a3fbk&code=er75sc&format=json'
		);
		if(empty($list[$id])) exit('Error');
		$jsonStr = file_get_contents($list[$id]);;
		$array = json_decode($jsonStr, true);
		$data = $array['data'];
		if($data) {
			foreach($data as $k=>$v){
				$arr['riqi'] = substr($v['opentime'],0,10);
				$where = array('type_id'=>$id,'expect'=>$v['expect']);
				$resultInfo = $CpResult->field(array('id','opencode'))->where($where)->find();
				if(false == $resultInfo){
					$openCodeArray = explode(',', str_replace('+',',',$v['opencode']));
					$openCodeResult = array();
					foreach($openCodeArray as $openCodeValue){
						$openCodeResult[] = (int)$openCodeValue;
					}
					$openCodeString = implode(',',$openCodeResult);
					$addId = $CpResult->add(array(
							'type_id' => $id,
							'riqi' => $arr['riqi'],
							'expect' => $v['expect'],
							'opentimestamp' => $v['opentimestamp'],
							'opencode' => $openCodeString,
							'ctime' => time()
					));
					if($addId) {
						$PdcResult = M('PdcResult');
						$PdcWeb = M('PdcWeb');
						$list = $PdcWeb->where(array('status'=>99))->limit(1000)->select();
						$time = time();
						//循环删除文章
						$sql = "INSERT INTO `db_pdc_result`
                            (`rid`,`url`,`status`,`ctime`,`times`)
                        VALUES ";
						foreach($list as $value){
							$sql .= " ('{$addId}','{$value['url']}','1','{$time}','0'),";
						}
						$sql = trim($sql, ',').';';
						try{
							$PdcResult->query($sql);
						}catch (\Exception $e){}
						echo "\n".date('Y-m-d H:i').' type:'.$id.' expect:'.$v['expect'].' success';
					}
				}
			}
		}
		exit(' Done');
	}
	private function addTime($type){
		$db = D('Time');
		if(empty($type)) return false;
		$date = date('Y-m-d');
		$timeInfo = $db->where(array('type_id'=>$type, 'riqi'=>$date))->find();
		if($timeInfo) return false;
		$date = date('Y-m-d');
		switch($type){
			case '1':	//安徽快三
				$kjtime = strtotime($date.' 08:40');
				for($i=1;$i<=80;$i++){
					$data = array();
					$data['kjtime'] = $kjtime + 10*$i*60;
					$data['closetime'] = $data['kjtime']-10;
					$data['opentime'] = $data['kjtime'] - 10*60;
					$data['type_id'] = $type;
					$data['riqi'] = $date;
					$data['expect'] = date('Ymd').$this->repairNumber($i);;
					$db->add($data);
				}
				break;
			case '2':	//北京快三
				$yesterday = date('Y-m-d', strtotime($date)-3600*24);
				$lastResulet = D('Result')->field(array('id','expect','opentimestamp'))->where(array('type_id'=>$type,'riqi'=>$yesterday))->order(array('expect DESC'))->find();
				$lastQishu = $lastResulet['expect'];
				$kjtime = strtotime($date.' 09:00');
				for($i=1;$i<=89;$i++){
					$data = array();
					$data['kjtime'] = $kjtime + 10*$i*60;
					$data['closetime'] = $data['kjtime']-10;
					$data['opentime'] = $data['kjtime'] - 10*60;
					$data['type_id'] = $type;
					$data['riqi'] = $date;
					$data['expect'] = $lastQishu+$i;
					$db->add($data);
				}
				break;
			case '3':	//江苏快三
				$kjtime = strtotime($date.' 08:30');
				for($i=1;$i<=82;$i++){
					$data = array();
					$data['kjtime'] = $kjtime + 10*$i*60;
					$data['closetime'] = $data['kjtime']-10;
					$data['opentime'] = $data['kjtime'] - 10*60;
					$data['type_id'] = $type;
					$data['riqi'] = $date;
					$data['expect'] = date('Ymd').$this->repairNumber($i);;;
					$db->add($data);
				}
				break;
			case '4':
				$kjtime = strtotime($date.' 09:00');
				for($i=1;$i<=84;$i++){
					$data = array();
					$data['kjtime'] = $kjtime + 10*$i*60;
					$data['closetime'] = $data['kjtime']-60*2;
					$data['opentime'] = $data['kjtime'] - 10*60;
					$data['type_id'] = $type;
					$data['riqi'] = $date;
					$data['expect'] = str_replace('-', '', $data['riqi']).$this->repairNumber($i);
					$db->add($data);
				}
				break;
			case '5':;
				$kjtime = strtotime($date.' 00:01:00');
				$num = 0;
				for($i=1;$i<=23;$i++){
					$data = array();
					$data['kjtime'] = $kjtime + 5*$i*60;
					$data['closetime'] = $data['kjtime'] -10;
					$data['opentime'] = $data['kjtime'] - 5*60;
					$data['type_id'] = $type;
					$data['riqi'] = $date;
					$data['expect'] = str_replace('-', '', $data['riqi']).$this->repairNumber($num + $i);
					$db->add($data);
				}
				$kjtime = strtotime($date.' 09:51:00');
				for($i=1;$i<=73;$i++){
					$data = array();
					$data['kjtime'] = $kjtime + $i*10*60;
					$data['closetime'] = $data['kjtime']-10;
					$data['riqi'] = $date;
					$data['opentime'] = $data['kjtime'] - 10*60;
					$data['type_id'] = $type;
					$data['expect'] = str_replace('-', '', $data['riqi']).$this->repairNumber(23+$i);
					$db->add($data);
				}
				$kjtime = strtotime($date.' 22:01:00');
				for($i=1;$i<=24;$i++){
					$data = array();
					$data['kjtime'] = $kjtime + $i*5*60;
					$data['closetime'] = $data['kjtime']-10;
					$data['riqi'] = $date;
					$data['opentime'] = $data['kjtime'] - 5*60;
					$data['type_id'] = $type;
					$data['expect'] = str_replace('-', '', $data['riqi']).$this->repairNumber(96+$i);
					$db->add($data);
				}
			break;
			case '6':
				$yesterday = date('Y-m-d', strtotime($date)-3600*24);
				$lastResulet = D('Result')->field(array('id','expect','opentimestamp'))->where(array('type_id'=>$type,'riqi'=>$yesterday))->order(array('expect DESC'))->find();
				$lastQishu = $lastResulet['expect'];
				$kjtime = strtotime($date.' 09:02:30');
				for($i=1;$i<=179;$i++){
					$data = array();
					$data['kjtime'] = $kjtime + $i*5*60;
					$data['closetime'] = $data['kjtime']-60;
					$data['opentime'] = $data['kjtime'] - 5*60;
					$data['type_id'] = $type;
					$data['qishu'] = $lastQishu+$i;
					$data['riqi'] = $date;
					$data['expect'] = $data['qishu'];
					$db->add($data);
				}
				break;
			case '7':
				$kjtime = strtotime($date.' 07:29');
				for($i=1;$i<=985;$i++){
					$data = array();
					$data['kjtime'] = $kjtime + $i*75;
					$data['closetime'] = $data['kjtime']-10;
					$data['opentime'] = $data['kjtime'] - 75;
					$data['type_id'] = $type;
					$data['riqi'] = $date;
					$data['expect'] = str_replace('-', '', $data['riqi']).$this->repairNumber($i);
					$db->add($data);
				}
				break;
			case '8':
				$kjtime = strtotime($date.' 07:30');
				for($i=1;$i<=985;$i++){
					$data = array();
					$data['kjtime'] = $kjtime + $i*75;
					$data['closetime'] = $data['kjtime']-10;
					$data['opentime'] = $data['kjtime'] - 75;
					$data['type_id'] = $type;
					$data['riqi'] = $date;
					$data['expect'] = str_replace('-', '', $data['riqi']).$this->repairNumber($i);
					$db->add($data);
				}
				break;
			default:
				return 'Error';
				break;
		}
		if(5 == $type){

		}

	}

	public function history(){
		$id = I('get.id');
		if(empty($id)) exit('Error');
		$CpResult = D('Result');
		$date = date('Y-m-d', time()-24*60*60);
		//$this->addTime($id);
		$list = array(
				'1'=>'http://ho.apiplus.net/daily.do?token=t877b1a3dde95a3fbk&code=ahk3&format=json&date='.$date,
				'2'=>'http://ho.apiplus.net/daily.do?token=t877b1a3dde95a3fbk&code=bjk3&format=json&date='.$date,
				'3'=>'http://ho.apiplus.net/daily.do?token=t877b1a3dde95a3fbk&code=jsk3&format=json&date='.$date,
				'4'=>'http://ho.apiplus.net/daily.do?token=t877b1a3dde95a3fbk&code=gdklsf&format=json&date='.$date,
				'5'=>'http://ho.apiplus.net/daily.do?token=t877b1a3dde95a3fbk&code=cqssc&format=json&date='.$date,
				'6'=>'http://ho.apiplus.net/daily.do?token=t877b1a3dde95a3fbk&code=bjpk10&format=json&date='.$date,
				'7'=>'http://ho.apiplus.net/daily.do?token=t877b1a3dde95a3fbk&code=er75ft&format=json&date='.$date,
				'8'=>'http://ho.apiplus.net/daily.do?token=t877b1a3dde95a3fbk&code=er75sc&format=json&date='.$date
		);
		if(empty($list[$id])) exit('Error');
		$jsonStr = file_get_contents($list[$id]);;
		$array = json_decode($jsonStr, true);
		$data = $array['data'];
		if($data) {
			foreach($data as $k=>$v){
				$arr['riqi'] = substr($v['opentime'],0,10);
				$where = array('type_id'=>$id,'expect'=>$v['expect']);
				$resultInfo = $CpResult->field(array('id','opencode'))->where($where)->find();
				if(false == $resultInfo){
					$openCodeArray = explode(',', str_replace('+',',',$v['opencode']));
					$openCodeResult = array();
					foreach($openCodeArray as $openCodeValue){
						$openCodeResult[] = (int)$openCodeValue;
					}
					$openCodeString = implode(',',$openCodeResult);
					$addId = $CpResult->add(array(
							'type_id' => $id,
							'riqi' => $arr['riqi'],
							'expect' => $v['expect'],
							'opentimestamp' => $v['opentimestamp'],
							'opencode' => $openCodeString,
							'ctime' => time()
					));
					if($addId) {
						echo "\n".date('Y-m-d H:i').' type:'.$id.' expect:'.$v['expect'].' success';
					}
				}
			}
		}
		exit(' Done');
	}

	/*
     * 2017年1月10日17:04:00
     * 数字补全函数
     * */
	private function repairNumber($number,$length=3){
		if(false==is_numeric($number) || empty($length)) return false;
		$number = (int)$number;
		$len = strlen($number);
		if($len<$length) return str_pad($number,$length,'0',STR_PAD_LEFT);
		return $number;
	}
	/*
     * 模拟post进行url请求
     * @param string $url
     * @param string $param
     */
	private function request_post($url = '', $param = '') {
		if (empty($url) || empty($param)) {
			return false;
		}
		$postUrl = $url;
		$curlPost = $param;
		$ch = curl_init();//初始化curl
		curl_setopt($ch, CURLOPT_URL,$postUrl);//抓取指定网页
		curl_setopt($ch, CURLOPT_HEADER, 0);//设置header
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);//要求结果为字符串且输出到屏幕上
		curl_setopt($ch, CURLOPT_POST, 1);//post提交方式
		curl_setopt($ch, CURLOPT_POSTFIELDS, $curlPost);
		$data = curl_exec($ch);//运行curl
		curl_close($ch);

		return $data;
	}

}