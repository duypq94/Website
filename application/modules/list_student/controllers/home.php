<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Home extends MY_Controller{

	function __construct(){
		parent::__construct();
		$this->load->model('ml_student');
	}
	
	public function index(){
		if(!isset($this->authentication)||!is_array($this->authentication)||!count($this->authentication)) redirect(site_url('list_class_of_teacher/home/login'));
		if($this->authentication['user_group']!=2) show_404();
		$data['title'] = 'Trang chủ SIS';
		$data['template']= 'list_student/home/index';

		$id = $this->input->get('cid');
		$semester = $this->input->get('semester');

		$gvid = $this->input->get('id');
		$data['semester']=$semester;
		$data['id']=$gvid;

		$data['stsid']= $this->ml_student->getStudent_byID( $id,$semester);
	

		for($i=0;$i<count($data['stsid']);$i++)
		{
			$data['student'][$i]= $this->ml_student->getStudent($data['stsid'][$i]['sid']);
			//print_r('</br>');
			//print_r($i);
			//print_r($data['student'][$i]);
		}
		
		//die();
		$this->load->view('layout/home', $data);
	}
	public function _authentication($password = ''){
		
		$id = $this->input->post('id');

		$user = $this->ml_student->getStudent_byID($id, 'MaSV, MatKhau, HoLot, Ten,salt');
		if(!isset($user) || is_array($user) == FALSE || count($user) == 0){
			$this->form_validation->set_message('_authentication', 'Tài khoản không tồn tại');
			return FALSE;
		}
		$password_encode = encryption($password, $user['salt']);
		if($user['MatKhau'] != $password_encode){
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
