<?php
class NdiskModel extends Model{
	protected $_validate = array(
			array('title','require','网盘标题不能为空',1),
			array('keyword','require','关键字不能为空',1),
			array('info','require','网盘详细内容必须填写',1),			 
			array('picurl','require','网盘封面图片必须填写',1),
			array('id','checkid','非法操作',2,'callback',2),

	 );
	protected $_auto = array (		
		array('token','getToken',Model:: MODEL_BOTH,'callback'),
		array('create_time','time',1,'function'), // 对create_time字段在更新的时候写入当前时间戳);
	);
	function checkid(){
		$dataid=$this->field('id')->where(array('id'=>$_POST['id'],'token'=>session('token')))->find();
		if($dataid==false){
			return false;
		}else{
			return true;
		}
	}
	function getToken(){	
		return $_SESSION['token'];
	}
}

?>
