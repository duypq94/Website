<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Login extends MY_Controller{

	function __construct(){
		parent::__construct();
		$this->load->model('home/mhome');
	}
	public function index(){
		if($this->input->post('submit'))
		{
			$this->form_validation->set_rules($this->mhome->validation_login_capchar);
			if ($this->form_validation->run()){
				$id = $this->input->post('id'); 
				$user = $this->mhome->getStudent_byID($id, 'SID, PIN, FirstName, LastName,user_group');
				$_SESSION['authentication'] = json_encode($user);
				redirect(site_url());
			}
			
		}
		$data['template'] = 'home_login/login';
		$data['navigation'] = 'home/layout/navigation';
		$data['title'] = 'Đăng nhập vào hệ thống';

		$this->load->view('home/layout/home', $data);

	}

	public function _captcha($captcha = ''){
		if(strtoupper($captcha) != $this->session->userdata('captcha')){
			$this->form_validation->set_message('_captcha', 'Captcha không đúng');
			return FALSE;
		}
		return TRUE;
	}
	
	public function _authentication($password = ''){
		
		$id = $this->input->post('id');

		$user = $this->mhome->getStudent_byID($id, 'SID, PIN, FirstName, LastName,salt');
		if(!isset($user) || is_array($user) == FALSE || count($user) == 0){
			$this->form_validation->set_message('_authentication', 'Tài khoản không tồn tại');
			return FALSE;
		}
		$password_encode = encryption($password, $user['salt']);
		if($user['PIN'] != $password_encode){
			$this->form_validation->set_message('_authentication', 'Mật khẩu không đúng');
			return FALSE;
		}
		return TRUE;
	}
}
