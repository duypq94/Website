<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Msystem extends My_Model{
	private $table;
	private $semester;
	function __construct(){
		parent::__construct();
		$this->table = 'semester';
		$this->semester = 'semester';
	}

	public function getall_semester(){
		return $this->_general(array(
			'select' => '*',
			'table' => $this->table,
			'list' => TRUE
		));
	}
	public function semester_byid($id = NULL){
		return $this->_getwhere(array(
			'select' => '*',
			'table' => $this->table,
			'list' => FALSE,
			'param_where' => array(
				'id' => $id,
			)
		));
	}
	public function opcourse($id=NULL,$timehp=NULL){
		$data['timehp'] = $timehp;
		return $this->_save(array(
			'table' => $this->table,
			'data' => $data,
			'param_where' => array(
				'id' => $id
			)
		));
	}
	public function opclass($id=NULL,$timelh=NULL){
		$id = (int)$id;
		$data['timelh'] = $timelh;
		return $this->_save(array(
			'table' => $this->table,
			'data' => $data,
			'param_where' => array(
				'id' => $id
			)
		));
	}
	
}
