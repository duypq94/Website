<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class register extends MY_Controller{
    public $my_course;
    public $sum_unit;
	function __construct(){
		parent::__construct();
        if(!isset($this->authentication) || is_array($this->authentication) == FALSE || count($this->authentication) == 0) redirect('home_login/login');
        if($this->authentication['user_group']!=1) die();
        
		$this->load->model('register_course/mcourse');
        $this->load->library('depart');
        $temp = $this->mcourse->get_register();
        $this->my_course = $temp['course'];
        $this->sum_unit = $temp['sum_unit'];
	}
	public function index(){
        if($this->input->post('submit'))
        {  //echo $this->mcourse->check_required();die();
            $semester = $this->input->post('semester');
            if (!$this->mcourse->check_time($semester)){
                $this->session->set_flashdata('msg','Đây không phải là thời điểm đăng kí học phần');
                redirect(site_url('register_course/register'));
            }else{
                $data['course'] = $this->mcourse->show(); 
            }
        }
        $data['department'] = $this->depart->getDepart();
		$data['template'] = 'register';
		$data['title'] = 'Register Course';
		$this->load->view('home/layout/home', $data);
	}
    public function delete_registercourse($ID = 0){
        $semester = $this->mcourse->get_semester($ID);
        if (!$this->mcourse->check_time($semester)) {
            $this->session->set_flashdata('msg','Đây không phải là thời điểm chỉnh sửa đăng kí');
        }
        elseif ($this->mcourse->check_delete($ID)){
            $this->mcourse->delete_registercourse($ID);
            $this->session->set_flashdata('msg2', 'Học phần đã được xóa');
            redirect(site_url('register_course/register'));
        }
        redirect(site_url('register_course/register'));

    }
    
    public function register_course($CID = 0){
        $course = $this->mcourse->getcourse_byID($CID);
        $SoTC = $course['0']['Unit'];

        if (($SoTC + $this->sum_unit) > 20) {
            $this->session->set_flashdata('msg','Bạn đã vượt qua giới hạn đăng kí');
        }elseif ($this->mcourse->check_required($CID) ===0) {
            $this->session->set_flashdata('msg','Bạn chưa đủ điều kiện tiên quyết');
        }
        else{  
            $this->mcourse->write_course($CID);  
        }
         
         redirect(site_url('register_course/register'));

    }      
}
