<?php if(!defined('BASEPATH')) exit('No direct script access allowed'); 

class RouterBie{

	public $CI;

    public function __construct(){
		$this->CI =& get_instance();
		$this->CI->load->model('backend_router/mrouter');
    }
	
	// Validate
	public function validate($slug = ''){
		return $this->CI->mrouter->get_byslug($slug);
	}
	
	// Thêm router
	public function insert($param = NULL){
		if(!isset($param['slug']) || empty($param['slug']) || !isset($param['module']) || empty($param['module']) || !isset($param['moduleid']) || empty($param['moduleid'])) die('Chưa đủ thông tin Router!');
		return $this->CI->mrouter->insert(array(
			'slug' => $param['slug'],
			'crc32' => sprintf("%u", crc32($param['slug'])),
			'module' => $param['module'],
			'moduleid' => $param['moduleid']
		));
	}
	
	// Xóa router
	public function delete($param = NULL){
		if(isset($param['canonical']) && !empty($param['canonical'])){
			$this->CI->mrouter->delete_byslug($param['canonical']);
		}
		else if(isset($param['param_where']) && is_array($param['param_where']) && isset($param['field_where_in']) && (empty($param['field_where_in']) || !isset($param['param_where_in']) || is_array($param['param_where_in']) == FALSE)){
			$this->CI->mrouter->delete_bymod($param['param_where']);
		}
		else if(isset($param['param_where']) && is_array($param['param_where']) && isset($param['field_where_in']) && !empty($param['field_where_in']) && isset($param['param_where_in']) && is_array($param['param_where_in'])){
			$this->CI->mrouter->delete(array(
				'param_where' => $param['param_where'],
				'field_where_in' => $param['field_where_in'],
				'param_where_in' => $param['param_where_in']
			));	
		}
	}
	
	public function delete_bymod($param = NULL){
		$this->CI->mrouter->delete_bymod(array(
			'module' => $param['module'],
			'moduleid' => $param['moduleid']
		));
	}
	
	// Update router
	public function updated($param = NULL){
		if(empty($param['slug'])){
			$this->delete_bymod(array(
				'module' => $param['module'],
				'moduleid' => $param['moduleid']
			));
		}
		else if($param['slug'] != $param['old']){
			if(empty($param['old'])){
				$this->insert(array(
					'slug' => $param['slug'],
					'module' => $param['module'],
					'moduleid' => $param['moduleid']
				));
			}
			else{
				$this->CI->mrouter->update_byslug($param['old'], array(
					'slug' => $param['slug'],
				));
			}
		}
	}

}
