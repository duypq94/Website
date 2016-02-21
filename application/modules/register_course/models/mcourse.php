<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Mcourse extends My_Model{

	public $table = 'table';
	public $dkhp = 'course_register';
  public $student = 'student';
	public $validation_login;
	public $validation_change_password;
	function __construct(){
		parent::__construct();
		$this->table = 'course';
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
    public  function getcourse_byID($id=0){
		$course = $this->_getwhere(array(
        'select' =>'CourseID,Name,Unit',
        'table'  =>$this->table,
        'limit'  => 1,
        'list' => true,
        'param_where' =>array('CourseID' => $id )
			));
		return $course;
	 }
	   public function show(){
    $keyword = $this->db->escape_like_str($this->input->post('keyword'));
    $course = $this->_general(array(
        'select' =>'*',
        'table'  =>$this->table,
        'list' => true,
        'param' => '(CourseID LIKE \'%'.$keyword.'%\')'
      ));
    return $course;
    }
    public function get_register($semester = 20152){
			$this->db->select('*');
      $this->db->from('course');
		  $this->db->join('course_register as DKHP','course.CourseID= DKHP.cid');	
      $this->db->where('sid',$this->authentication['SID']);
      $this->db->where('semester',$semester);
			$course = $this->db->get()->result_array();
			$sum_unit = 0;	
			foreach ($course as $key => $value) {
				$sum_unit = $value['Unit'] + $sum_unit;
			}
			$data['sum_unit'] = $sum_unit;
			$data['course'] = $course;
			return $data;
	   }
	  public  function check_register($check)
	 {
         
        $query = $this->db->get_where('course_register',array(
            'cid' => $check,
            'sid'=> $this->authentication['SID']
        	));
        $count = $query->num_rows();
        if ($count === 0) {
        	return 0;
        }else return 1;
	 }
	  public function check_delete($check)
	{
         
        $query = $this->db->get_where('course_register',array(
            'ID' => $check,
  //          'sid' => $this->authentication['SID']
                    	));

        $count = $query->num_rows();
        if ($count === 0) {
        	return 0;
        }else return 1;
		//
	}
	
   public function write_course($cid=NULL,$semester = 20152)
	{
         $data['SID'] = $this->authentication['SID'];
         $data['cid'] = $cid;
         $data['semester'] = $semester;
         if($this->check_register($data['cid']))
         {
             $this->session->set_flashdata('msg','Bạn đã đăng ký môn học này');

         }else
		        { 
             $this->session->set_flashdata('msg2','Bạn đã đăng ký thành công');
		        	$this->_save(array(
		            'table' => $this->dkhp,
		            'data'  => $data
		         	));
		    }
	}

	 public function delete_registercourse($ID=0)
	{
       return $this->_del(array(
          'table' => $this->dkhp,
          'param_where' =>array(
          'ID' => $ID)    
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
        $timehp = json_decode($temp['timehp'],TRUE);
        $check = new DateTime($today);
        $start = new DateTime($timehp['start']);
        $end = new DateTime($timehp['end']);
        if($check >= $start&&$check<=$end) return 1;
        return 0;
      }
  public function check_exist($CID)
    {   
        $required = $this->_getwhere(array(
        'select' =>'AcademyHistory',
        'table'  =>$this->student,
        'list' => FALSE,
        'param_where' =>array('SID' => $this->authentication['SID'] )
      ));
        $requiredcourse = json_decode($required['AcademyHistory']);
      
         
        foreach ($requiredcourse as $key => $value) {
            if ($value === $CID) {
              $temp = 1;
              break;
            }else $temp = 0;
        }
        return $temp;
    }
  public function get_semester($ID)
         {
           $course = $this->_getwhere(array(
          'select' =>'semester',
          'table'  =>$this->dkhp,
          'limit'  => 1,
          'list' => FALSE,
          'param_where' =>array(
            'ID' => $ID
            )
      ));
    return $course['semester'];

         }
  public function check_required($CID){
        $check = 1;
        $course = $this->_getwhere(array(
        'select' =>'Requirement',
        'table'  =>$this->table,
        'limit'  => 1,
        'list' => FALSE,
        'param_where' =>array('CourseID' => $CID)
      ));
        $requiredcourse = json_decode($course['Requirement']);
        foreach ($requiredcourse as $key => $value) {
            $check = $this->mcourse->check_exist($value)*$check;
            }  
         return $check;
      }  
 /*  public function check_exist($CID)
    {   
        $required = $this->_getwhere(array(
        'select' =>'AcademyHistory',
        'table'  =>$this->student,
        'list' => FALSE,
        'param_where' =>array('SID' => $this->authentication['SID'] )
      ));
        $requiredcourse = json_decode($required['AcademyHistory']);
      
         
      //  $prequiredcourse = $prequired['AcademyHistory'],true);
        foreach ($requiredcourse as $key => $value) {
            if ($value === $CID) {
              $temp = 1;
              break;
            }else $temp = 0;
        }
        return temp;
    } 
   public function check_exist($id)
    {   
   //      $id = 'IT1235';
        $CID = 'IT3244';
        $required = $this->_getwhere(array(
        'select' =>'Requirement',
        'table'  =>$this->table,
        'list' => FALSE,
        'param_where' =>array('CourseID' => $CID )
      ));
        $Studied = json_decode($required['Requirement']);
        foreach ($Studied as $key => $value) {
            if ($value === $id) {
              $temp = 1;
              break;
            }else $temp = 0;
        }
        return $temp;
    }
    */

}
