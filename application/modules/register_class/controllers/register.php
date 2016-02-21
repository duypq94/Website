<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Register extends MY_Controller{
    public $my_course;
    public $sum_unit;
    public $semester;
    private $sid;    
    function __construct()
    {
        parent::__construct();
        if(!isset($this->authentication) || is_array($this->authentication) == FALSE || count($this->authentication) == 0) redirect('home_login/login');
        if($this->authentication['user_group']!=1) die();
        $this->load->model('register_class/mclass');
        $this->semester = $this->next_semester['name'];
        $this->sid = $this->authentication['SID'] ;          
    }
    public function index($semester)
    {
        //print_r($this->system['allsemeter']);die();
        $allsemester = NULL;
        foreach ($this->system['allsemeter'] as $key => $value) {
            $allsemeter[$value['name']]=$value['name'];
        }
        $data['allsemeter'] = $allsemeter;        
        if($this->input->post('submit'))
        {

            $semester = $this->input->post('semester');
            if(!$this->mclass->check_time($semester)){
                $this->session->set_flashdata('msg','Đây không phải là thời điểm đăng kí lớp học');
                redirect(site_url('register_class/register/index/'.$semester));
            }
            $keyword   =  $this->input->post('keyword');
            $data['keyword'] = $keyword;
            $data['search_result']  = $this->mclass->search($this->sid, $semester, $keyword);            
        }        
        $data['navigation'] = 'home/layout/navigation';
        $data['registered_class'] = $this->mclass->get_registered_class($this->sid, $semester);        
        $data['template'] = 'register';
        $data['title'] = 'Register Course';
        $data['semester'] = $semester;
        $this->load->view('home/layout/home', $data);
    }

    public function register_class()
    {        
        if($this->input->post('class_id')){
            $semester = $this->input->post('semester_name');
            $classid = $this->input->post('class_id');
            $this->semester = $semester;
            $exited = $this->mclass->check_register($this->sid, $classid, $this->semester);
            if($exited==1){
                echo json_encode(array("result"=>"failed","data"=>"Bạn đã đăng ký lớp học này."));    
                die();
            } 
            if($exited==2){
                echo json_encode(array("result"=>"failed","data"=>"Học phần đã đăng ký lớp."));    
                die();
            } 
            if(!$this->mclass->check_course_register($this->sid, $classid, $this->semester)){
                echo json_encode(array("result"=>"failed","data"=>"Bạn chưa đăng ký học phần nên không thể đăng ký lớp học này."));    
                die();
            }
            $query = $this->db->query('select * from class_course where number < max and classid = '.$classid);
            $flag = $query->num_rows();

            if($flag > 0){ 
            $check_time = $this->mclass->check_timetable($this->sid,$this->semester,$classid);
            if($check_time==0){
                $this->db->query("update class_course SET number = number + 1 where number < max and classid = ".$classid);        
                $class_register = $this->mclass->insert_data($this->sid, $classid, $this->semester);
                echo json_encode(array("result"=>"successed", "data"=>$class_register));
                die();
            }else{
                echo json_encode(array("result"=>"failed","data"=>"Trùng thời khóa biểu với mã lớp ".$check_time));
                die(); 
            }   
            }else{
                echo json_encode(array("result"=>"failed","data"=>"Lớp học quá số lượng"));    
                die();
            }
        }        
    }

    public function delete_class()
    {        
        if($this->input->post('class_id')){
            $semester = $this->input->post('semester_name');
            $this->semester = $semester;
            $classid = $this->input->post('class_id');
            if(!$this->mclass->check_register($this->sid, $classid, $this->semester)){
                echo json_encode(array("result"=>"failed","data"=>"Bạn chưa đăng ký lớp học này."));    
                die();
            }
            if(!$this->mclass->check_time($this->semester)){
                echo json_encode(array("result"=>"failed","data"=>"Đây không phải thời điểm hủy đăng ký ."));    
                die();
            }
            $id = $this->input->post('id');  
            $this->mclass->delete_data($id);
            $flag = $this->db->query("update class_course SET number = number - 1 where number < max and classid = ".$classid);
            echo json_encode(array("result"=>"successed", "data"=>"null"));
            die();
        }        
    }
    public function test(){
        $result = $this->mclass->getclassbyid('860001');
        $result = $this->mclass->check_timetable($this->sid,$this->semester,'860004');
        print_r($result);die();
    }
    public function detail($classid = NULL){

        $data['navigation'] = 'home/layout/navigation';
        $data['template'] = 'detail';
        $data['title'] = 'Chi tiết khóa học';
        $data['lop'] = $this->mclass->getclassbyid($classid);
        $courseid = $data['lop']['courseid'];
        $lecturerid = $data['lop']['lecturerid'];
        $data['course'] = $this->mclass->getcoursebyID($courseid);
        if($lecturerid != NULL)
            $data['lecturer'] = $this->mclass->getLecture($lecturerid);
        $this->load->view('home/layout/home', $data);
    }
}