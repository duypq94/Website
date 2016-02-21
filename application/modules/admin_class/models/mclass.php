<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Mclass extends My_Model{

	private $table;
	private $timetable;
	private $course_register;
	private $course;
	public $validation;
	function __construct(){
		parent::__construct();
		$this->table = 'class_course';
		$this->course_register = 'course_register';
		$this->course = 'course';

		$this->validation = array(
			array('field' => 'courseid', 'label' => 'Mã học phần', 'rules' => 'trim|required|callback__checkExist'),
		);
	}
	public function save_timetable(){

	}
	public function insert($timetable=NULL){
		$data['courseid'] = $this->input->post('courseid');
		$data['semester'] = $this->input->post('semester');
		$data['stage'] = $this->input->post('stage');
		$data['max'] = $this->input->post('max');
		$data['comment'] = $this->input->post('comment');
		$data['timetable'] = $timetable;
		return $this->_save(array(
			'table' => $this->table,
			'data' => $data
		));
	}
	public function count(){
		$param_where = NULL;
		$keyword = $this->db->escape_like_str($this->input->get('keyword'));

		/*$departmentID = (int)$this->input->get('departmentID');
		if($departmentID > 0){
			$param_where['departmentID'] = $departmentID;
		}*/
		return $this->_general(array(
			'table' => $this->table,
			'param' => (!empty($keyword)?'(`courseid` LIKE \'%'.$keyword.'%\')':''),
			'param_where' => $param_where,
			'count' => TRUE,
		));
	}
	public function show($limit = 0,$start = 0){
		//$param_where['semester'] = $this->next_semester['name'];
		$param_where = NULL;
		$keyword = $this->db->escape_like_str($this->input->get('keyword'));

		return $this->_general(array(
			'select' => '*',
			'table' => $this->table,
			'limit' => $limit,
			'start' => ($start * $limit),
			'list' => TRUE,
			'param' => (!empty($keyword)?'(`courseID` LIKE \'%'.$keyword.'%\')':''),
			'param_where' => $param_where,
			'orderby' => 'id desc'
		));
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
			message_flash('Lớp không tồn tại', 'error');
			redirect(site_url('admin_class/lop/index'));
		}
		return $post;
	}
	public function delete_byid($id = 0){
		$lop = $this->get_byid($id);
		$flag = $this->_del(array(
			'table' => 'class_register',
			'param_where' => array(
				'classid'=> $lop['classid']
			)
		));
		return $this->_del(array(
			'table' =>  $this->table,
			'param_where' => array(
				'id' => $id
			)
		));
	}
	// lấy tên học phần và số sinh viên đăng ký
	public function get_register($limit=0,$start =0){
		try{
			$keyword = $this->db->escape_like_str($this->input->get('keyword'));
			$departmentID = (int)$this->input->get('departmentID');		
			$this->db->select('cid,name,COUNT(sid) as number,semester');
			$this->db->from($this->course_register);
			$this->db->join($this->course,'courseID = cid');
			if($departmentID > 0) $this->db->where('DepartmentID',$departmentID);
			$this->db->where('semester',$this->next_semester['name']);
			$this->db->like('cid',$keyword);

			$this->db->group_by('cid');
			if(isset($limit)&&$limit>0) $this->db->limit((int)$limit,(int)$start*$limit);
			$data = $this->db->get()->result_array();
			return $data;
		}catch(Exception $e){
			echo $e->getMessage();
		}
	}

	public function update_byid($id = 0,$timetable=NULL){
		$id = (int)$id;
		$data['courseid'] = $this->input->post('courseid');
		$data['semester'] = $this->input->post('semester');
		$data['stage'] = $this->input->post('stage');
		$data['max'] = $this->input->post('max');
		$data['comment'] = $this->input->post('comment');
		$data['timetable'] = $timetable;
		$data['lecturerid'] = $this->input->post('lecturerid');
		//print_r($data);
		return $this->_save(array(
			'table' => $this->table,
			'data' => $data,
			'param_where' => array(
				'id' => $id
			)
		));
	}
	public function getAlllecture(){
		$temp = $this->_general(array(
			'table' => 'lecturer',
			'select' => 'id,firstname,lastname',
			'list' => TRUE
		));
		$result = NULL;
		foreach ($temp as $key => $value) {
			$result[$value['id']] = $value['firstname'].' '.$value['lastname'];
		}
		return $result;
	}	
}
