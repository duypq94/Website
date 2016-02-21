<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Mteacher extends My_Model{

	private $user = 'lecturer';
	private $user_group = 'user_group';

	private $student = 'student';
	public $validation_login;
	public $validation_change_password;
	private $course;
	private $class_course;
	function __construct(){
		parent::__construct();

		$this->validation_login_capchar = array(
			array('field' => 'email', 'label' => 'email', 'rules' => 'trim|required'),
			array('field' => 'password', 'label' => 'Mật khẩu', 'rules' => 'trim|required|callback__authentication'),

		);

		$this->validation_register = array(
			array('field' => 'email', 'label' => 'Tài khoản', 'rules' => 'trim|required|valid_email|callback__email'),
			array('field' => 'password', 'label' => 'Mật khẩu', 'rules' => 'trim|required|min_length[6]|max_length[255]'),
			array('field' => 'repassword', 'label' => 'Gõ lại mật khẩu', 'rules' => 'trim|required|min_length[6]|max_length[255]|matches[password]'),
			array('field' => 'fullname', 'label' => 'Tên đầy đủ', 'rules' => 'trim'),
		);
		$this->validation_login = array(
			array('field' => 'email', 'label' => 'Tài khoản', 'rules' => 'trim|required|valid_email'),
			array('field' => 'password', 'label' => 'Mật khẩu', 'rules' => 'trim|required|callback__authentication'),
			
		);
		$this->validation_recovery = array(
			array('field' => 'email', 'label' => 'Tài khoản', 'rules' => 'trim|required|valid_email|callback__email'),

		);
		
		$this->lecturer = 'lecturer';
		$this->student = 'student';
		$this->course = 'course';
		$this->class_course = 'class_course';
	}


	public function getStudent($param = NULL){
		$student = $this->_getwhere(array(
			'select' => (isset($param['select'])?$param['select']:'MaSV, HoLot, Ten'),
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

	public function getStudent_byID($MaSV = '', $select = 'MaSV, HoLot, Ten', $validation = FALSE){
		return $this->getStudent(array(
			'select' => $select,
			'validation' => $validation,
			'param_where' => array('MaSV' => $MaSV)
		));
	}
	

	function getclass_teacher($id=0,$semester=0){
		
		$this->db->like('lecturerid',$id);
		$this->db->like('semester',$semester);
		$this->db->select('classid');
		$this->db->select('courseid');
		$this->db->select('timetable');
		$query = $this->db->get('class_course');
		return $query->result_array();
	}
	

	function getcourse_byID($id=''){
		$course = $this->_getwhere(array(
        'select' =>'Name, Unit ',
        'table'  =>$this->course,
        
        'param_where' =>array('courseID' => $id )
			));
		return $course;
	}


	function getname($id=''){
		$course = $this->_getwhere(array(
        'select' =>'firstname, lastname ',
        'table'  =>$this->lecturer,
        
        'param_where' =>array('id' => $id )
			));
		return $course;
	}

	function timetable_new($text=NULL,$id=0){
		$tkb = NULL;
		$i =0;
		$text = json_decode($text,TRUE);
		foreach ($text as $key => $value) {/*
				$tkb = $tkb.'Thứ '.$value['day'].','.lesson_to_time($value['session'],$value['start'],$value['total']);
				if($area == 1) $tkb = $tkb.','.$value['area'];
				$tkb = $tkb.'<br>';*/
				//print_r($value);
				//print_r('<br>');
				//for($i=0;$i<count($value);$i++){


				$tkb[$i]['day']=(int)$value['day'];
				
				$tkb[$i]['start']=(int)$value['start'];
				$tkb[$i]['session']=(int)$value['session'];
				$tkb[$i]['time'] = lesson_to_time($value['session'],$value['start'],$value['total']);
				$tkb[$i]['area'] = $value['area'];
				$tkb[$i]['id'] = $id;
				$i = $i+1;
				
			//}
			}
		return $tkb;	
	}
function doi(&$id1,&$id2)
{
	$a = $id1;
	$id1 = $id2;
	$id2= $a;


}

function getclass_D($id=''){
		$course = $this->_getwhere(array(
        'select' =>'Description, Name',
        'table'  =>$this->course,
        
        'param_where' =>array('courseID' => $id )
			));
		return $course;
	}

	function getclass_ND($id=''){
		$course = $this->_getwhere(array(
        'select' =>'content',
        'table'  =>$this->class_course,
        
        'param_where' =>array('courseID' => $id )
			));
		return $course;
	}

	function update_nd($id,$comment)
	{
		 $data = array('content'=>$comment);
		 $this->db->where('courseid', $id);
         $this->db->update('class_course', $data);
         
	}
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

	// Thông tin của user
	public function getuser($param = NULL){
		$user = $this->_getwhere(array(
			'select' => (isset($param['select'])?$param['select']:'id, email, fullname'),
			'table' => $this->user,
			'param_where' => $param['param_where']
		));
		if(isset($param['validation']) && $param['validation'] == TRUE){
			if(!isset($user) || is_array($user) == FALSE || count($user) == 0){
				message_flash('Người dùng không tồn tại', 'error');
				redirect(site_url());
			}
		}
		return $user;
	}

	// Thông tin của group
	public function getgroup($param = NULL){
		$group = $this->_getwhere(array(
			'select' => (isset($param['select'])?$param['select']:'id, email, fullname'),
			'table' => $this->user_group,
			'param_where' => isset($param['param_where'])?$param['param_where']:NULL
		));
		if(isset($param['validation']) && $param['validation'] == TRUE){
			if(!isset($group) || is_array($group) == FALSE || count($group) == 0){
				message_flash('Nhóm quyền không tồn tại', 'error');
				redirect(site_url());
			}
		}
		return $group;
	}
	
	// Thông tin của user qua email
	public function getuser_byemail($email = '', $select = 'id, email, fullname', $validation = FALSE){
		return $this->getuser(array(
			'select' => $select,
			'validation' => $validation,
			'param_where' => array('email' => $email)
		));
	}
	
	// Thông tin của user qua id
	public function getuser_byid($id = 0, $select = 'id, email, fullname', $validation = FALSE){
		return $this->getuser(array(
			'select' => $select,
			'validation' => $validation,
			'param_where' => array('id' => $id)
		));
	}
	
	// Thông tin của user qua id
	public function getgroup_bydefault($default = 0, $select = 'id', $validation = FALSE){
		return $this->getgroup(array(
			'select' => $select,
			'validation' => $validation,
			'param_where' => array('default' => $default)
		));
	}
	
	// Thông tin của user qua verify
	public function getuser_byverify($verify = '', $validation = TRUE){
		$user = $this->getuser(array(
			'select' => 'id, email, verify, last_recovery',
			'param_where' => array('verify' => $verify)
		));
		if($validation == TRUE){
			if(!isset($user) || is_array($user) == FALSE || count($user) == 0){
				message_flash('Mã xác nhận không hợp lệ', 'error');
				redirect('backend_user/authentication/login');
			}
			if(time() - $user['last_recovery'] > 3600){
				message_flash('Mã xác nhận đã hết hạn sử dụng', 'error');
				redirect('backend_user/authentication/login');
			}
		}
		return $user;
	}
	

	// Cấp lại mật khẩu mới qua id
	public function recovery_byid($id = 0, $password = ''){
		$salt = random();
		return $this->_save(array(
			'table' => $this->user,
			'data' => array(
				'salt' => $salt,
				'password' => encryption($password, $salt),
			),
			'param_where' => array(
				'id' => $id
			)
		));
	}	
	
	// Cập nhật thông tin của user qua email
	public function updateuser_byemail($email = '', $data = NULL){
		return $this->_save(array(
			'table' => $this->user,
			'data' => $data,
			'param_where' => array('email' => $email)
		));	
	}

	// Cập nhật thông tin của user qua id
	public function updateuser_byid($id = '', $data = NULL){
		return $this->_save(array(
			'table' => $this->user,
			'data' => $data,
			'param_where' => array('id' => $id)
		));	
	}
	
	// Quyền của nhóm
    function permissions($param = NULL){
		$group = $this->getgroup(array(
			'select' => 'group',
			'table' => $this->user_group,
			'param_where' => $param['param_where'],
		));
		return (!isset($group['group']) || empty($group['group']))?NULL:json_decode($group['group'], TRUE);
		 
    }

	// Thêm thành viên mới
	public function insert(){
		$group = $this->getgroup_bydefault(1);
		$salt = random();
		return $this->_save(array(
			'table' => $this->user,
			'data' => array(
				'email' => $this->input->post('email'),
				'fullname' => $this->input->post('fullname'),
				'groupid' => $group['id'],
				'salt' => $salt,
				'password' => encryption($this->input->post('password'), $salt),
			)
		));
	}


}
