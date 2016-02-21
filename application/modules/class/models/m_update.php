<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class M_update extends My_Model{

	private $student = 'student';
	public $validation_login;
	public $validation_change_password;
	private $course;
	private $class_course;
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
		$this->course = 'course';
		$this->class_course = 'class_course';
	}




	function getclass_D($id=''){
		$course = $this->_getwhere(array(
        'select' =>'Name',
        'table'  =>$this->course,
        
        'param_where' =>array('courseID' => $id )
			));
		return $course;
	}

	function getclass_ND($id='',$lid=''){
		$course = $this->_getwhere(array(
        'select' =>'content',
        'table'  =>$this->class_course,
        
        'param_where' =>array('courseID' => $id ,'classid' => $lid)
			));
		return $course;
	}

	function update_nd($id,$comment)
	{
		 $data = array('content'=>$comment);
		 $this->db->where('courseid', $id);
         $this->db->update('class_course', $data);
         
	}


	



}
