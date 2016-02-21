<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Lop extends MY_Controller{
	private $navigation;
	function __construct(){
		parent::__construct();
		$this->navigation['post']['link'] = 'admin_class/lop/index';
		$this->navigation['post']['title']='Danh sách lớp';
		$this->navigation['add']['link']='admin_class/lop/add';
		$this->navigation['add']['title'] = 'Thêm mới lớp';
		$this->load->model('mclass');
		$this->load->model('admin_course/mcourse');
		$this->load->library('depart');
		if(!isset($this->authentication)||!is_array($this->authentication)||!count($this->authentication)) redirect(site_url('admin/home/login'));
		if($this->authentication['user_group']!=3) show_404();
	}
	
	public function index($page = 1){
		$data['keyword'] = $this->input->get('keyword');
		$data['lecturer'] = $this->mclass->getAlllecture();
		$config = backend_pagination();
		$config['base_url'] = base_url('admin_class/lop/index');
		$config['total_rows'] = $this->mclass->count();
		if($config['total_rows'] > 0){
			$config['param'] = URL_SUFFIX.'?keyword='.$this->input->get('keyword');
			$config['suffix'] = $config['param'];
			$config['first_url'] = $config['base_url'].$config['suffix'];
			$config['per_page'] = 3;
			$total_page = ceil($config['total_rows']/$config['per_page']);
			$config['cur_page'] = validate_pagination($page, $total_page);
			$this->pagination->initialize($config);
			$data['list_pagination'] = $this->pagination->create_links();
			$data['cclass'] = $this->mclass->show($config['per_page'], ($config['cur_page'] - 1));
		}
		$data['title'] = 'Quảng lý lớp học';
		$data['tabs'] = 'Danh sách lớp';
		$data['navigation']=$this->navigation;
		$data['template'] = 'lop/index';
		$this->load->view('admin/layout/home', $data);
	}

	public function openclass($page = 1){
		$data['department'] = $this->depart->getDepart('- Chọn Khoa -');
		$data['departmentID'] = $this->input->get('departmentID');
		$data['keyword']= $this->input->get('keyword');
		$config = backend_pagination();
		$config['base_url'] = base_url('admin_class/lop/openclass');
		$config['total_rows'] = count($this->mclass->get_register());
		if($config['total_rows'] > 0){
			$config['param'] = URL_SUFFIX.'?keyword='.$this->input->get('keyword').'&departmentID='.$this->input->get('departmentID');
			$config['suffix'] = $config['param'];
			$config['first_url'] = $config['base_url'].$config['suffix'];
			$config['per_page'] = 3;
			$total_page = ceil($config['total_rows']/$config['per_page']);
			$config['cur_page'] = validate_pagination($page, $total_page);
			$this->pagination->initialize($config);
			$data['list_pagination'] = $this->pagination->create_links();

			$data['course'] = $this->mclass->get_register($config['per_page'],($config['cur_page'] - 1));
		}
		$data['title'] = 'Mở lớp';
		$data['tabs'] = 'Danh sách môn có học sinh đăng ký';
		$data['template'] = 'lop/openclass';
		$this->load->view('admin/layout/home', $data);

	}

	public function add($cid){
		$data['room'] = $this->depart->getroom();
		if($this->input->post('submit')){
			$this->form_validation->set_rules($this->mclass->validation);
			if($this->form_validation->run()){
			$data['courseid'] = $this->input->post('courseid');
			$data['semester'] = $this->input->post('semester');
			$data['stage'] = $this->input->post['stage'];
			$data['max'] = $this->input->post('max');
			//TKB
			$day = $this->input->post('day');
			$session = $this->input->post('session');
			$start = $this->input->post('start');
			$total = $this->input->post('total');
			$area = $this->input->post('area');
			$count=0;
			$timetable;
			foreach ($day as $key => $value){
				$timetable[$count]['day'] = $day[$key];
				$timetable[$count]['session'] = $session[$key];
				$timetable[$count]['start'] = $start[$key];
				$timetable[$count]['total'] = $total[$key];
				$timetable[$count]['area'] = $area[$key];
				$count++;
			}
			$timetable = json_encode($timetable);
			$flag = $this->mclass->insert($timetable);
			if($flag){
					message_flash('Thêm lớp thành công');
					redirect(site_url('admin_class/lop/index'));
			}
			}
		}
		if(isset($cid)){
			$data['courseid'] = $cid;
		}
		$data['title'] = 'Quảng lý lớp học';
		$data['tabs'] = 'Thêm lớp';
		$data['navigation']=$this->navigation;
		$data['template'] = 'lop/add';
		$data['semester'] = $this->next_semester['name'];
		
 		$this->load->view('admin/layout/home', $data);
	}
	public function delete($id){
		$id = (int)$id;
		$lop = $this->mclass->get_byid($id);
		$this->mclass->delete_byid($id);
		message_flash('Xóa lớp '.$lop['classid'].' thành công');
		redirect(site_url('admin_class/lop/index'));
	}
	public function update($id){
		$id = (int)$id;
		$lop = $this->mclass->get_byid($id);
		$data['room'] = $this->depart->getroom();
		$data['courseid'] = $lop['courseid'];
		$data['semester'] = $lop['semester'];
		$data['stage'] = $lop['stage'];
		$data['max'] = $lop['max'];
		$data['comment'] = $lop['comment'];
 		$data['timetable'] = json_decode($lop['timetable'],TRUE);
 		if($this->input->post('submit')){
 		$this->form_validation->set_rules($this->mclass->validation);
		if($this->form_validation->run()){
			$data['courseid'] = $this->input->post('courseid');
			$data['semester'] = $this->input->post('semester');
			$data['stage'] = $this->input->post('stage');
			$data['max'] = $this->input->post('max');
			//timetable
			$day = $this->input->post('day');
			$session = $this->input->post('session');
			$start = $this->input->post('start');
			$total = $this->input->post('total');
			$area = $this->input->post('area');
			$count=0;
			foreach ($day as $key => $value){
				$timetable[$count]['day'] = $day[$key];
				$timetable[$count]['session'] = $session[$key];
				$timetable[$count]['start'] = $start[$key];
				$timetable[$count]['total'] = $total[$key];
				$timetable[$count]['area'] = $area[$key];
				$count++;
			}
			$data['timetable'] = $timetable;
			$timetable = json_encode($timetable);
			$flag = $this->mclass->update_byid($id,$timetable);
			if($flag){
				message_flash('thay đổi '.$lop['classid'].' thành công');
				redirect(site_url('admin_class/lop/index'));
			}
		}
		}
		$data['lecturerid'] = $lop['lecturerid'];
		$data['lecturer'] = $this->mclass->getAlllecture();
		//print_r($lecturer); die();
		$data['title'] = 'Chỉnh sửa lớp';
		$data['tabs'] = 'Thêm lớp';
		$data['navigation']=$this->navigation;

		$data['template'] = 'lop/update';
		$this->load->view('admin/layout/home', $data);
	}
	public function _checkExist(){
		$CID = $this->input->post('courseid');
		if(!$this->mcourse->checkExist($CID)){
			$this->form_validation->set_message('_checkExist', 'Mã học phần không tồn tại');
			return FALSE;
		}
	}
}
