<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Student extends MY_Controller{

	private $navigation;
	function __construct(){
		parent::__construct();
		$this->navigation['post']['link'] = 'admin_student/student/index';
		$this->navigation['post']['title']='Danh sách sinh viên';
		$this->navigation['add']['link']='admin_student/student/add';
		$this->navigation['add']['title'] = 'Thêm mới sinh viên';
		if(!isset($this->authentication)||!is_array($this->authentication)||!count($this->authentication)) redirect(site_url('admin/home/login'));
		if($this->authentication['user_group']!=3) show_404();
		$this->load->model('mstudent');
	}
	
	public function index($id=NULL){
		$data['title'] = 'Quảng lý sinh viên';
		$data['tabs'] = 'Danh sách sinh viên mã lớp '.$id;
		$data['lop'] = $this->mstudent->group_class();
		$data['student'] = $this->mstudent->getStudent($id);
		$data['template']= 'admin_student/student/index';
		$this->load->view('admin/layout/home', $data);
	}
}
