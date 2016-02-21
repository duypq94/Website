<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Mcourse extends My_Model{

	public $validation;
	public $validation_update;
	private $table;
	function __construct(){
		parent::__construct();
		$this->table = 'course';
		$this->validation = array(
			array('field' => 'CID', 'label' => 'Mã học phần', 'rules' => 'trim|required|callback__checkExist'),
			array('field' => 'name', 'label' => 'Tên học phần', 'rules' => 'trim|required'),	
			array('field' => 'unit', 'label' => 'Số tín chỉ', 'rules' => 'trim|required'),
		);
		$this->validation_update = array(
			array('field' => 'CID', 'label' => 'Mã học phần', 'rules' => 'trim|required'),
			array('field' => 'name', 'label' => 'Tên học phần', 'rules' => 'trim|required'),	
			array('field' => 'unit', 'label' => 'Số tín chỉ', 'rules' => 'trim|required'),
		);
	}
	public function insert(){
		$data['CourseID'] = $this->input->post('CID');
		$data['Name'] = $this->input->post('name');
		$data['Unit'] = $this->input->post('unit');
		$data['DepartmentID'] = $this->input->post('departid');
		$requirement = $this->input->post('requirement');
		$data['Requirement'] = isset($requirement) ? json_encode($this->input->post('requirement')):NULL;
		$data['Description'] = $this->input->post('description');
		return $this->_save(array(
			'table' => $this->table,
			'data' => $data
		));
	}

	public function count(){
		$param_where = NULL;
		$keyword = $this->db->escape_like_str($this->input->get('keyword'));
		$departmentID = (int)$this->input->get('departmentID');
		if($departmentID > 0){
			$param_where['departmentID'] = $departmentID;
		}
		return $this->_general(array(
			'table' => $this->table,
			'param' => (!empty($keyword)?'(`CourseID` LIKE \'%'.$keyword.'%\')':''),
			'param_where' => $param_where,
			'count' => TRUE,
		));
	}

	public function show($limit = 0, $start = 0){
		$param_where = NULL;
		$keyword = $this->db->escape_like_str($this->input->get('keyword'));
		$departmentID = (int)$this->input->get('departmentID');
		if($departmentID > 0){
			$param_where['departmentID'] = $departmentID;
		}
		return $this->_general(array(
			'select' => '*',
			'table' => $this->table,
			'limit' => $limit,
			'start' => ($start * $limit),
			'list' => TRUE,
			'param' => (!empty($keyword)?'(`CourseID` LIKE \'%'.$keyword.'%\')':''),
			'param_where' => $param_where,
			'orderby' => 'ID desc'
		));
	}
	public function checkExist($CID = NULL)
	{
		if($CID!=NULL){
			$param_where['CourseID'] = $CID; 
			$temp = $this->_general(array(
			'select' => '*',
			'table' => $this->table,
			'count' =>TRUE,
			'param_where' => $param_where
		));
			if($temp!=0) return TRUE;
		}
	}
	public function get_byid($id = 0){
		$post = $this->_getwhere(array(
			'select' => '*',
			'table' => $this->table,
			'param_where' => array(
				'id' => $id,
			)
		));
		if(!isset($post) || is_array($post) == FALSE || count($post) == 0){
			message_flash('Môn học không tồn tại', 'error');
			redirect(site_url('admin_course/course/index'));
		}
		return $post;
	}
	public function delete_byid($id = 0){
		return $this->_del(array(
			'table' =>  $this->table,
			'param_where' => array(
				'id' => $id
			)
		));
	}
	public function update_byid($id = 0){
		$id = (int)$id;
		//$data['CourseID'] = $this->input->post('CID');
		$data['Name'] = $this->input->post('name');
		$data['Unit'] = $this->input->post('unit');
		$data['DepartmentID'] = $this->input->post('departid');
		$requirement = $this->input->post('requirement');
		$data['Requirement'] = isset($requirement) ? json_encode($this->input->post('requirement')):NULL;
		$data['Description'] = $this->input->post('description');

		return $this->_save(array(
			'table' => $this->table,
			'data' => $data,
			'param_where' => array(
				'id' => $id
			)
		));
	}
}
