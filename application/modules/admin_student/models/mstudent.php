<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Mstudent extends My_Model{

	private $student = 'student';
	private $register = 'class_register';
	public $validation_login;
	public $validation_change_password;
	function __construct(){
		parent::__construct();
		$this->student = 'student';
		$this->validation_login = array(
			array('field' => 'id', 'label' => 'Tài khoản', 'rules' => 'trim|required'),
			array('field' => 'password', 'label' => 'Mật khẩu', 'rules' => 'trim|required|callback__authentication'),
		);
		$this->validation_login_capchar = array(
			array('field' => 'id', 'label' => 'Tài khoản', 'rules' => 'trim|required'),
			array('field' => 'password', 'label' => 'Mật khẩu', 'rules' => 'trim|required|callback__authentication'),
			array('field' => 'capchar', 'label' => 'Capchar', 'rules' => 'trim|required|callback__captcha'),
		);
	}


	public function getStudent($classid = 0){
		$this->db->select('student.SID as SID,FirstName,LastName,Addres,Birthday,student.ClassID as classid');
		$this->db->from($this->student);
		$this->db->join($this->register,'student.SID = class_register.sid');
		$this->db->where('class_register.classid',$classid);
		$data = $this->db->get()->result_array();
		return $data;
	}
	public function group_class(){
		$temp = $this->_general(array(
			'table' => 'class_group',
			'select' => '*',
			'list' => TRUE
		));
		$result = NULL;
		foreach ($temp as $key => $value) {
			$result[$value['ID']] = $value['Name'];
		}
		return $result;
	}	
}
