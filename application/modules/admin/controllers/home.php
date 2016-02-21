<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Home extends MY_Controller{

	function __construct(){
		parent::__construct();
		$this->load->model('madmin');
	}
	
	public function index(){
		if(!isset($this->authentication)||!is_array($this->authentication)||!count($this->authentication)) redirect(site_url('admin/home/login'));
		if($this->authentication['user_group']!=3) show_404();
		$data['title'] = 'Trang quản trị';
		$this->load->view('layout/home', $data);
	}
	public function login(){
		if(isset($this->authentication)&&is_array($this->authentication)&&count($this->authentication)) redirect(site_url('admin/home/index'));
		if($this->input->post('submit')){
			$this->form_validation->set_rules($this->madmin->validation_login);
			if ($this->form_validation->run()){
			$email = trim($this->input->post('email'));
			$user = $this->madmin->getuser_byemail($email, 'email, password, salt,user_group,fullname');
			$remember = 1;
			$remember = (int)$this->input->post('remember');
			if($remember >= 1){
				$this->session->set_userdata('authentication', json_encode($user));
			}
			else if($remember == 0){
				$_SESSION['authentication'] = json_encode($user);
			}
			message_flash('Bạn đã đăng nhập thành công');
			redirect(site_url('admin/home/'));
			}
		}
		$data['title'] = 'Đăng nhập hệ thống';
		$data['template'] = 'admin/login/login';
		$this->load->view('admin/layout/authentication', $data);
	}
	public function info(){
		$data['title'] = 'Trang quản trị';
		$this->load->view('layout/home', $data);
	}
	public function _authentication($password = ''){
		$email = $this->input->post('email');
		$user = $this->madmin->getuser_byemail($email, 'email, password, salt');
		if(!isset($user) || is_array($user) == FALSE || count($user) == 0){
			$this->form_validation->set_message('_authentication', 'Tài khoản không tồn tại');
			return FALSE;
		}
		$password_encode = encryption($password, $user['salt']);
		if($user['password'] != $password_encode){
			$this->form_validation->set_message('_authentication', 'Mật khẩu không đúng');
			return FALSE;
		}
		return TRUE;
	}

	// callback captcha
	public function _captcha($captcha = ''){
		if(strtoupper($captcha) != $this->session->userdata('captcha')){
			$this->form_validation->set_message('_captcha', 'Captcha không đúng');
			return FALSE;
		}
		return TRUE;
	}

	// callback email
	public function _email($password = ''){
		$email = $this->input->post('email');
		$user = $this->madmin->getuser_byemail($email, 'email, password, salt');
		if(!isset($user) || is_array($user) == FALSE || count($user) == 0){
			$this->form_validation->set_message('_email', 'Tài khoản không tồn tại');
			return FALSE;
		}
		return TRUE;
	}
	public function logout(){
		// if(!isset($this->authentication) || is_array($this->authentication) == FALSE || count($this->authentication) == 0) redirect('backend_user/authentication/login');
		if(isset($_SESSION['authentication'])){
			unset($_SESSION['authentication']);
		}
		if(isset($_SESSION['user_folder'])){
			unset($_SESSION['user_folder']);
		}
		$this->session->unset_userdata('authentication');
		if(isset($_SESSION) && count($_SESSION)){
			foreach($_SESSION as $key => $val){
				if(in_array(substr($key, 0, 3), array('fb_'))){
					$_SESSION[$key] = '';
					unset($_SESSION[$key]);
				}
			}
		}
		if(isset($_SESSION['access_token'])){
			$_SESSION['access_token'] = '';
			unset($_SESSION['access_token']);
		}
		redirect(site_url());
	} 
}
