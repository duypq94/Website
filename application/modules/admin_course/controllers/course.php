<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Course extends MY_Controller{

	private $navigation;
	function __construct(){
		parent::__construct();
		$this->load->library('depart');
		$this->load->model('mcourse');
		$this->navigation['post']['link'] = 'admin_course/course/index';
		$this->navigation['post']['title']='Danh sách môn học';
		$this->navigation['add']['link']='admin_course/course/add';
		$this->navigation['add']['title'] = 'Thêm mới môn học';
		if(!isset($this->authentication)||!is_array($this->authentication)||!count($this->authentication)) redirect(site_url('admin/home/login'));
		if($this->authentication['user_group']!=3) show_404();
	}
	
	public function index($page = 1){
		$data['keyword'] = $this->input->get('keyword');
		$data['departmentID'] = $this->input->get('departmentID');

		$config = backend_pagination();
		$config['base_url'] = base_url('admin_course/course/index');
		$config['total_rows'] = $this->mcourse->count();
		if($config['total_rows'] > 0){
			$config['param'] = URL_SUFFIX.'?keyword='.$this->input->get('keyword').'&departmentID='.$this->input->get('departmentID');
			$config['suffix'] = $config['param'];
			$config['first_url'] = $config['base_url'].$config['suffix'];
			$config['per_page'] = 3;
			$total_page = ceil($config['total_rows']/$config['per_page']);
			$config['cur_page'] = validate_pagination($page, $total_page);
			$this->pagination->initialize($config);
			$data['list_pagination'] = $this->pagination->create_links();
			$data['course'] = $this->mcourse->show($config['per_page'], ($config['cur_page'] - 1));
		}

		$data['title'] = 'Quảng lý môn học';
		$data['tabs'] = 'Danh sách môn học';
		$data['department'] = $this->depart->getDepart('- Chọn Khoa -');
		$data['navigation']=$this->navigation;
		$data['template'] = 'admin_course/course/index';

		$this->load->view('admin/layout/home', $data);
	}
	public function add(){
		$data['title'] = 'Quảng lý môn học';
		$data['tabs'] = 'Thêm môn học';
		$data['department'] = $this->depart->getDepart();
		$data['navigation']=$this->navigation;

		if($this->input->post('submit')){
			$this->form_validation->set_rules($this->mcourse->validation);
			if($this->input->post('requirement')!=NULL){
				$this->form_validation->set_rules('requirement[]', 'HP tiên quyết', 'trim|callback__requirement');
			}
			if ($this->form_validation->run()){
				$flag = $this->mcourse->insert();
				if($flag){
					message_flash('Thêm học phần '.$this->input->post('CID').' thành công');
					redirect(site_url('admin_course/course/index'));
				}
			}
		}
		$data['template'] = 'admin_course/course/add';
		$this->load->view('admin/layout/home', $data);
	}

	public function delete($id){
		$id = (int)$id;
		$course = $this->mcourse->get_byid($id);
		$this->mcourse->delete_byid($id);
		message_flash('Xóa Học phần '.$course['classid'].' thành công');
		redirect(site_url('admin_course/course/index'));
	}
	public function update($id = NULL){
		$courseid = (int)$id;
		$data['department'] = $this->depart->getDepart();
		$data['course'] = $this->mcourse->get_byid($courseid);

		if($this->input->post('submit')){
			$this->form_validation->set_rules($this->mcourse->validation_update);
			if($this->input->post('requirement')!=NULL){
				$this->form_validation->set_rules('requirement[]', 'HP tiên quyết', 'trim|callback__requirement');
			}
			if ($this->form_validation->run()){
				$flag = $this->mcourse->update_byid($id);
				if($flag){
					message_flash('Thay đổi học phần '.$data['course']['CourseID'].' thành công');
					redirect(site_url('admin_course/course/index'));
				}
			}
		}

		$data['template'] = 'admin_course/course/update';
		$this->load->view('admin/layout/home', $data);
	}
	

	public function _checkExist(){
		$CID = $this->input->post('CID');
		if($this->mcourse->checkExist($CID)){
			$this->form_validation->set_message('_checkExist', 'Mã học phần bị trùng');
			return FALSE;
		}
	}
	public function _requirement(){
		$requirement = $this->input->post('requirement');
		$temp=TRUE;
		$validation;
		foreach ($requirement as $key => $value) {
			if(!$this->mcourse->checkExist($value)){
				if($temp == TRUE){
					$validation = $value;
					$temp = FALSE;
					continue;
				}
				$temp = FALSE;
				$validation = $validation.' , '.$value;
			}
		}
		if($temp == FALSE) $this->form_validation->set_message('_requirement','Mã học phần '.$validation.' không tồn tại');
		return $temp;
	}
}
