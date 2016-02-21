<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class System extends MY_Controller{

	function __construct(){
		parent::__construct();
		$this->load->model('msystem');
		if(!isset($this->authentication)||!is_array($this->authentication)||!count($this->authentication)) redirect(site_url('admin/home/login'));
		if($this->authentication['user_group']!=3) show_404();
	}
	
	public function index(){
		$data['tabs'] = 'Danh sách kỳ học';
		$data['semester'] = $this->msystem->getall_semester();
		$data['title'] = 'Quản lý hệ thống';
		$data['template'] = 'system/index';
		$this->load->view('admin/layout/home', $data);
	}
	public function opcourse($id = NULL){
		$id = (int)$id;
		$data['semester'] = $this->msystem->semester_byid($id);
		if($this->input->post('submit')){
			$id = (int)$this->input->post('id');
			$temp['start'] = $this->input->post('start');
			$temp['end'] = $this->input->post('end');
			$timehp = json_encode($temp);
			$flag = $this->msystem->opcourse($id,$timehp);
			if($flag){
				message_flash('Mở đăng ký thành công');
				redirect(site_url('admin_system/system'));
			}
		}
		$data['tabs'] = 'Mở đăng ký học phần';
		$data['title'] = 'Mở đăng ký học phần';
		$data['template'] = 'admin_system/system/course';
		$this->load->view('admin/layout/home', $data);
	}
	public function opclass($id = NULL){
		$id = (int)$id;
		$data['semester'] = $this->msystem->semester_byid($id);
		if($this->input->post('submit')){
			$id = (int)$this->input->post('id');
			$temp['start'] = $this->input->post('start');
			$temp['end'] = $this->input->post('end');
			$timelh = json_encode($temp);
			$flag = $this->msystem->opclass($id,$timelh);
			if($flag){
				message_flash('Mở đăng ký thành công');
				redirect(site_url('admin_system/system'));
			}
		}
		$data['tabs'] = 'Mở đăng ký lớp';
		$data['title'] = 'Mở đăng ký lớp';
		$data['template'] = 'admin_system/system/lop';
		$this->load->view('admin/layout/home', $data);
	}
	
}
