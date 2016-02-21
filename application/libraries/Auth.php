<?php if(!defined('BASEPATH')) exit('No direct script access allowed'); 

class Auth{

	private $CI;

    public function __construct(){
		$this->CI =& get_instance();
    }
	
	// Kiểm tra thông tin đăng nhập
	public function check(){
		$remember = 0;
		if(isset($_SESSION['authentication']) && !empty($_SESSION['authentication'])){
			$authentication = $_SESSION['authentication'];
		}
		else{
			$remember = 1;
			$authentication = $this->CI->session->userdata('authentication');
		}

		if(!isset($authentication) || empty($authentication)) return NULL;
		$authentication = json_decode($authentication, TRUE);
		$user = $this->CI->mauth->getuser(array(
			'select' => 'id, email, fullname, groupid',
			'param_where' => array(
				'email' => $authentication['email'],
				'password' => $authentication['password'],
				'salt' => $authentication['salt'],
				// 'http_user_agent' => $authentication['http_user_agent']
			),
		));
		if(!isset($user) || count($user) == 0){
			if($remember == 0){
				unset($_SESSION['authentication']);
			}
			else{
				$this->CI->session->unset_userdata('authentication');
			}
			return NULL;
		}
		$user['permissions'] = $this->CI->mauth->permissions(array('param_where' => array('id' => $user['groupid'])));
		unset($user['groupid']);
		$_SESSION['user_folder'] = ($user['id'] * 168) * 168 + 168;
		return $user;
	}

	// Kiểm tra cho phép truy cập hàm chức năng
	public function permissions($param = NULL){
		if(!isset($param['redirect']) || empty($param['redirect'])){
			$param['redirect'] = site_url('admin');
		}
		if(is_array($param) && count($param)){
			$user = $this->CI->authentication;
			if(in_array($param['uri'], $user['permissions']) == FALSE){
				message_flash('Bạn không có quyền vào khu vực này!', 'error');
				redirect($param['redirect']);
				print_r($user);
			}
		}
		else{
			message_flash('Bạn không có quyền vào khu vực này!', 'error');
			redirect($param['redirect']);
		}
	}

}
