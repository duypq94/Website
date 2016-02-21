<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Depart{

	private $CI;
	public $depart = "";
	public $lop = "";

	function __construct($params=NULL){
		$this->CI =& get_instance();
		$this->depart = "departments";
		$this->CI->load->model('home/mhome');
	}
	public function getDepart($params = NULL){
		$temp = $this->CI->mhome->_getwhere(array(
			'table' => $this->depart,
			'select' => "ID,Name",
			'list' => TRUE
			));
		if(isset($params)) $result[0]=$params;
		foreach ($temp as $key => $value) {
			$result[$value['ID']] = $value['Name']; 
		}
		return $result;
	}
	public function getroom($params = NULL){
		$temp = $this->CI->mhome->_getwhere(array(
			'table' => 'classroom',
			'select' => 'ID,Name',
			'list' => TRUE
		));
		if(isset($params)) $result[0]= $params;
		foreach ($temp as $key => $value) {
			$result[$value['Name']] = $value['Name'];
		}
		return $result;
	}
}
