<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Mclass extends My_Model{

	public $table = 'table';
	public $dkhp = 'course_register';
	public $validation_login;
	public $validation_change_password;
	function __construct(){
		parent::__construct();
		$this->table = 'class_course';
		$this->validation_login = array(
			array('field' => 'id', 'label' => 'Tài khoản', 'rules' => 'trim|required'),
			array('field' => 'password', 'label' => 'Mật khẩu', 'rules' => 'trim|required|callback__authentication'),
		);
		$this->validation_login_capchar = array(
			array('field' => 'id', 'label' => 'Tài khoản', 'rules' => 'trim|required'),
			array('field' => 'password', 'label' => 'Mật khẩu', 'rules' => 'trim|required|callback__authentication'),
			array('field' => 'capchar', 'label' => 'Capchar', 'rules' => 'trim|required|callback__captcha'),
		);
	}
    
	public function getSemester(){		
        $query = $this->db->get('semester');        
        $semesters = $query->result_array();
        $result = array();
        foreach ($semesters as $semester) {
        	$result[] = $semester["name"];
        }
        $result = array_reverse($result);
        return $result;
	}
	public function search($sid, $semester, $keyword)
    {
    	$this->db->select('*');
    	$this->db->from('class_course');
    	$this->db->join('course','course.CourseID = class_course.courseid');
    	$this->db->where('class_course.semester', $semester); 
        $this->db->like('class_course.courseid',$keyword);        	       
        $result = $this->db->get()->result_array();    
        foreach ($result as $key => $value) {
            	$result[$key]['status'] = $this->check_register($sid,$result[$key]['classid'],$semester);
            }    
        return $result;
    }
    public function get_registered_class($sid, $semester){		
		$this->db->select('class_register.ID as id, course.Name as Name, class_course.classid as classid, class_course.courseid as courseid, course.Unit as Unit,stage,timetable');
		// $this->db->select('*');
    	$this->db->from('class_register');
    	$this->db->join('class_course','class_course.classid = class_register.classid');
    	$this->db->join('course','course.CourseID = class_course.courseid');    	
    	$this->db->where('class_register.semester', $semester);         
        $this->db->where('class_register.sid', $sid);
        $result = $this->db->get()->result_array(); 
        foreach ($result as $key => $value) {
            $result[$key]['timetable'] = timetable($value['timetable'],1);
            $result[$key]['stage'] = week($value['stage']);
        }
        return $result;
	}
	public function check_register($sid, $classid, $semester)
	{   
        $lop = $this->getclassbyid($classid);
        $all = $this->get_registered_class($sid,$semester);

        foreach ($all as $key => $value) {
            if($lop['courseid']==$value['courseid']) return  2;
        }
         $query = $this->db->get_where('class_register',array(
            'classid' => $classid,
            'semester' => $semester,
            'sid' => $sid
            ));
        $count = $query->num_rows();
        if ($count === 0) {
            return 0;
        } else return 1;
		
	}
	public function check_course_register($sid, $classid, $semester)
	{
        // $sid = $this->authentication['SID'];
        // $sid = "20121908";
        $this->db->select('*');
    	$this->db->from('course_register');
    	$this->db->join('class_course','class_course.courseid = course_register.cid');    	  
    	$this->db->where('course_register.semester', $semester); 
    	$this->db->where('course_register.sid', $sid);
        $this->db->where('class_course.classid',$classid);        
        $count = $this->db->get()->num_rows();
        if ($count === 0) {
        	return 0;
        } else return 1;
	}
    public function insert_data($sid, $classid, $semester)
	{
        $data['sid'] = $sid;
        $data['classid'] = $classid;
        $data['semester'] = $semester;         
        $data['created'] = date("Y-m-d");
        $this->db->insert('class_register', $data);  

        $this->db->select('class_register.id as id, course.Name as Name, class_course.classid as classid, class_course.courseid as courseid, course.Unit as Unit,timetable,stage');
    	$this->db->from('class_register');
    	$this->db->join('class_course','class_course.classid = class_register.classid');
    	$this->db->join('course','course.CourseID = class_course.courseid');    	
    	$this->db->where('class_register.semester', $semester); 
        $this->db->where('class_register.classid',$classid);
        $this->db->where('class_register.sid', $sid);
        $result = $this->db->get()->result_array();
        foreach ($result as $key => $value) {
            $result[$key]['timetable'] = timetable($value['timetable'],1);
            $result[$key]['stage'] = week($value['stage']);
        }
        return $result;
	}

	public function delete_data($id){
		$flag = $this->_del(array(
            'table' => 'class_register',
            'param_where' => array(
                'ID'=> $id
            )
        ));
	}

    public function check_time($semester = 0){
        $today = gmdate('Y-m-d', time() + 7*3600);
        $temp = $this->_getwhere(array(
        'select' => '*',
        'table' => 'semester',
        'lis' => FALSE,
        'param_where' => array(
        'name' => $semester,
        )
        ));
        $timehp = json_decode($temp['timelh'],TRUE);
        $check = new DateTime($today);
        $start = new DateTime($timehp['start']);
        $end = new DateTime($timehp['end']);
        if($check >= $start&&$check<=$end) return 1;
        return 0;
    }
    public function getclassbyid($classid){
        return $this->_getwhere(array(
            'select' => '*',
            'table' => 'class_course',
            'list' => false,
            'param_where' => array(
                'classid'=> $classid
            )
         ));
    }
    public function getcoursebyID($courseid = NULL){
        return $this->_getwhere(array(
            'select' => '*',
            'table' => 'course',
            'list' => false,
            'param_where' => array(
                'CourseID'=> $courseid
            )
         ));
    }
    public function getLecture($id = NULL){
        return $this->_getwhere(array(
            'select' => 'firstname,lastname,email',
            'table' => 'lecturer',
            'list' => false,
            'param_where' => array(
                'id'=> $id
            )
         ));
    }
    public function check_timetable($sid=NULL,$semester = NULL,$classid = NULL){
        $lop = $this->getclassbyid($classid);
        $lop['timetable']= json_decode($lop['timetable'],TRUE); 

        $all = $this->get_registered_class($sid,$semester);
        $temp = NULL;$k = 0;
        $check = NULL;
        //loc cac lop trung giai doan
        foreach ($all as $key => $value) {
            $temp = json_decode($value['timetable'],TRUE);
            $all[$key]['timetable'] = $temp;
            if(($value['stage']==3||$value['stage']==$lop['stage'])) {//check giai doan
                $check[$k++] = $all[$key];          
            }
        }
        //print_r($check);
        foreach ($check as $key => $value) {
            if (check_exist_day($lop['timetable'],$value['timetable'])==1)
                return $value['classid'];
        }
        return 0;
    }

	
}
