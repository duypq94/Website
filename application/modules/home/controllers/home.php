<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Home extends MY_Controller{

	function __construct(){
		parent::__construct();
		$this->load->model('mhome');
	}
	
	public function index(){
		if($this->input->post('submit'))
		{
			$this->form_validation->set_rules($this->mhome->validation_login);
			if ($this->form_validation->run()){
				$id = $this->input->post('id'); 
				$user = $this->mhome->getStudent_byID($id, 'SID, PIN, FirstName, LastName,user_group');
				$_SESSION['authentication'] = json_encode($user);
				redirect(site_url());
			}else
				redirect(site_url('home_login/login'));
			
		}
		$data['title'] = 'Trang chủ SIS';
		$data['template']= 'home/home/index';
		$this->load->view('layout/home', $data);
	}
	public function logout(){
		if(isset($_SESSION['authentication'])){
			unset($_SESSION['authentication']);
		}
		$this->session->unset_userdata('authentication');
		redirect(site_url());
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

	// Captcha
	public function captcha(){
		/**
		* PHP GD
		* create a simple image with GD library
		* 
		*/
		//setting the image header in order to proper display the image
		header("Content-Type: image/png");
		//try to create an image
		$image = @imagecreate(68, 25) or die("Cannot Initialize new GD image stream");
		//set the background color of the image
		$background_color = imagecolorallocate($image, 0xFF, 0xFF, 0xFF);

		// line_color
		$line_color = imagecolorallocate($image, 0,0,255); 
		for($i=0; $i < 3; $i++) {
			imageline($image,0,rand()%50, 68,rand()%50,$line_color);
		}

		// pixel_color
		$pixel_color = imagecolorallocate($image, 0,0,255);
		for($i=0; $i < 1000; $i++) {
			imagesetpixel($image,rand()%200,rand()%50, $pixel_color);
		}
		//set the color for the text
		$text_color = imagecolorallocate($image, 133, 14, 91);
		// random
		$random = strtoupper(rand(10000, 99999));
		$this->session->set_userdata('captcha', $random);
		//adf the string to the image
		imagestring($image, 5, 12, 4,  $random, $text_color);
		//outputs the image as png
		imagepng($image);
		//frees any memory associated with the image 
		imagedestroy($image);
	}
}
