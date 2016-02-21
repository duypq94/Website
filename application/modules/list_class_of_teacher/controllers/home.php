<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Home extends MY_Controller{

	public $d;
	function __construct(){
		parent::__construct();
		$this->load->model('list_class_of_teacher/mteacher');
		
	}
	
	public function index(){
	if(!isset($this->authentication)||!is_array($this->authentication)||!count($this->authentication)) redirect(site_url('list_class_of_teacher/home/login'));
		if($this->authentication['user_group']!=2) show_404();
		$data['title'] = 'Trang chủ SIS';
		$data['template']= 'list_class_of_teacher/home/index';

		$semester = $this->input->get('semester');
		$id = $this->authentication['id'];
		$semester = $this->input->get('semester');

		$area = 1;
        $data['id'] = $id;
        $data['semester'] = $semester; 
		$data['name'] = $this->mteacher->getname($id);
		if($semester){
		 $data['class'] = $this->mteacher->getclass_teacher($id,$semester);
	}
		 for($i=0;$i<count($data['class']);$i++){ 
		 $data['course'][$i] = $this->mteacher->getcourse_byID($data['class'][$i]['courseid']);
	
		 $data['class'][$i]['timetable']=$this->mteacher->timetable_new($data['class'][$i]['timetable'],$i);

		 
		}
		$h= 0;

		for($i=0;$i<count($data['class']);$i++){
			for($j=0;$j<count($data['class'][$i]);$j++){
				if($data['timetable'][$h]=$data['class'][$i]['timetable'][$j]
					){
					
					$h = $h +1;
				}
			}				
		}
		
		
		for($i=0;$i<(count($data['timetable'])-2);$i++){
		
			for($j=$i;$j<(count($data['timetable'])-2);$j++){

			if($data['timetable'][$i]['day']>$data['timetable'][$j+1]['day']){
				 $this->mteacher->doi($data['timetable'][$i],$data['timetable'][$j+1]);

			}
			if($data['timetable'][$i]['day']==$data['timetable'][$j+1]['day']){
				if($data['timetable'][$i]['start']>$data['timetable'][$j+1]['start']){
					$this->mteacher->doi($data['timetable'][$i],$data['timetable'][$j+1]);
				}

				if($data['timetable'][$i]['session']>$data['timetable'][$j+1]['session']){
					$this->mteacher->doi($data['timetable'][$i],$data['timetable'][$j+1]);
				}

				if($data['timetable'][$i]['session']==$data['timetable'][$j+1]['session']){
				if($data['timetable'][$i]['start']>$data['timetable'][$j+1]['start']){
					$this->mteacher->doi($data['timetable'][$i],$data['timetable'][$j+1]);
				}

				}
			}
		}
	}
	
		$this->load->view('layout/home', $data);
	}
	
//////////////////////////////////////////////////////////////////////////////////////////////////////////
public function login(){
		if(isset($this->authentication)&&is_array($this->authentication)&&count($this->authentication)) redirect(site_url('list_class_of_teacher/home/index'));
		if($this->input->post('submit')){


			$this->form_validation->set_rules($this->mteacher->validation_login);
			if ($this->form_validation->run()){
			$email = trim($this->input->post('email'));
			$user = $this->mteacher->getuser_byemail($email, 'id, email, password, salt,user_group');
			$remember = 1;
			$remember = (int)$this->input->post('remember');
			if($remember >= 1){
				$this->session->set_userdata('authentication', json_encode($user));
			}
			else if($remember == 0){
				$_SESSION['authentication'] = json_encode($user);
			}
			message_flash('Bạn đã đăng nhập thành công');
			
			redirect(site_url('list_class_of_teacher/home/'));

			
			}
		}
		$data['title'] = 'Đăng nhập hệ thống';
		$data['template'] = 'list_class_of_teacher/login/login';
		$this->load->view('list_class_of_teacher/layout/authentication', $data);
	}

	public function _authentication($password = ''){
		$email = $this->input->post('email');
		$user = $this->mteacher->getuser_byemail($email, 'email, password, salt');
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

	// callback email
	public function _email($password = ''){
		$email = $this->input->post('email');
		$user = $this->mteacher->getuser_byemail($email, 'email, password, salt');
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
//////////////////////////////////////////////////////////////////////////////////////////////////////
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
