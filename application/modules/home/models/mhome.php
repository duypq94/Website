<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class MHome extends My_Model{

	private $student = 'student';
	private $hocphan = 'course';
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


	public function getStudent($param = NULL){
		$student = $this->_getwhere(array(
			'select' => (isset($param['select'])?$param['select']:'SID, FirstName, LastName'),
			'table' => $this->student,
			'param_where' => $param['param_where']
		));
		if(isset($param['validation']) && $param['validation'] == TRUE){
			if(!isset($student) || is_array($student) == FALSE || count($student) == 0){
				message_flash('Người dùng không tồn tại', 'error');
				redirect(site_url());
			}
		}
		return $student;
	}

	public function getStudent_byID($SID = '', $select = 'SID, FirstName, LastName', $validation = FALSE){
		return $this->getStudent(array(
			'select' => $select,
			'validation' => $validation,
			'param_where' => array('SID' => $SID)
		));
	}	
	public function getSubject($param = NULL){
		$subject = $this -> _getwhere(array(
             'select' => (isset($param['select'])?$param['select']:'CourseID, Name, Unit, SoTiet'),
             'table'  => $this->hocphan,
             'param_where' => $param['param_where']
			));
	}
    function search($keyword)
    {
        $this->db->like('CourseID',$keyword);
        $query = $this->db->get('course');
        return $query->result_array();
    }
    function check_open()
    {
       //

    }
    public function all_semester(){
		return $this->_general(array(
			'table' => 'semester',
			'select' => 'name,start,end,timehp,timelh',
			'list' => TRUE,
			'order by' => 'name desc'
			));
	}
     
}