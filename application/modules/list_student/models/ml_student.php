<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class ML_student extends My_Model{

	private $student = 'student';
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
		$this->course_register = 'course_register';
	}


	function getStudent_byID($id='',$semester=''){
		$this->db->like('cid',$id);
		$this->db->like('semester',$semester);
		$this->db->select('sid');
		$query = $this->db->get('course_register');
		return $query->result_array();
	}
	function getStudent($id=''){
		$st = $this->_getwhere(array(
			'select' =>'FirstName, LastName',
        	'table'  =>$this->student,
        
        	'param_where' =>array('SID' => $id )
			));
	return $st;
	}
}
