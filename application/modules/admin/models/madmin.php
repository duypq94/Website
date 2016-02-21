<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Madmin extends My_Model{

	private $user = 'administrators';
	private $user_group = 'user_group';
	public $validation_login;
	public $validation_change_password;

	function __construct(){
		parent::__construct();
		$this->validation_register = array(
			array('field' => 'email', 'label' => 'Tài khoản', 'rules' => 'trim|required|valid_email|callback__email'),
			array('field' => 'password', 'label' => 'Mật khẩu', 'rules' => 'trim|required|min_length[6]|max_length[255]'),
			array('field' => 'repassword', 'label' => 'Gõ lại mật khẩu', 'rules' => 'trim|required|min_length[6]|max_length[255]|matches[password]'),
			array('field' => 'fullname', 'label' => 'Tên đầy đủ', 'rules' => 'trim'),
		);
		$this->validation_login = array(
			array('field' => 'email', 'label' => 'Tài khoản', 'rules' => 'trim|required|valid_email'),
			array('field' => 'password', 'label' => 'Mật khẩu', 'rules' => 'trim|required|callback__authentication'),
			array('field' => 'captcha', 'label' => 'Captcha', 'rules' => 'trim|required|callback__captcha'),
		);
		$this->validation_recovery = array(
			array('field' => 'email', 'label' => 'Tài khoản', 'rules' => 'trim|required|valid_email|callback__email'),
			array('field' => 'captcha', 'label' => 'Captcha', 'rules' => 'trim|required|callback__captcha'),
		);
		$this->validation_change_password = array(
			array('field' => 'oldpassword', 'label' => 'Mật khẩu cũ', 'rules' => 'trim|required|min_length[6]|max_length[255]|callback__password'),
			array('field' => 'newpassword', 'label' => 'Mật khẩu mới', 'rules' => 'trim|required|min_length[6]|max_length[255]'),
			array('field' => 'renewpassword', 'label' => 'Gõ lại mật khẩu mới', 'rules' => 'trim|required|min_length[6]|max_length[255]|matches[newpassword]'),
		);
	}

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
