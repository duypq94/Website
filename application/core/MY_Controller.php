<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class MY_Controller extends CI_Controller{

	public $authentication;
	public $language;
	public $redirect;
	public $system;
	public $useragent;
	public $current_semester;
	public $next_semester;
		
	function __construct(){
		parent::__construct();

		// Load thư viện cần thiết
		$this->load->library(array('form_validation', 'session', 'pagination', 'user_agent', 'cart'));
		$this->load->helper(array('url', 'mystring', 'mypagination', 'myuri'));
		// Redirect
		//model
		$redirect = $this->input->get('redirect');
		$this->redirect = !empty($redirect)?base64_decode($redirect):'';
		// Thông tin
		if(isset($_SESSION['authentication'])) $this->authentication = json_decode($_SESSION['authentication'],TRUE);
		$this->useragent = $this->agent->agent_string();
		$this->load->model('home/mhome');
		//lấy học kỳ
		$this->system['allsemeter'] = $this->mhome->all_semester();
		$day = date('Y-m-d');
		foreach ($this->system['allsemeter'] as $key => $value){
			if($value['start']<= $day && $value['end']>= $day){
				$this->current_semester = $value['name'];
				break;
			}
		}
		$this->next_semester = $this->system['allsemeter'][$key+1];
	}

}
