<?php
/******************************
- Cấu trúc mặc định khởi tạo sẵn của Model
********************************/
class MY_Model extends CI_Model{

	function __construct(){
		parent::__construct();
	}

    /******************************
	Lấy dữ liệu theo tùy chọn
	- select: Những cột cần lấy ra
	- orderby: Dữ liệu được sắp xếp theo
	- table: Dữ liệu được lấy ra từ bảng
	- type: Kiểu dữ liệu trả về object hay array
	- limit: Vị trí dữ liệu lấy ra
	- list: Đưa ra nhiều dòng dữ liệu
	********************************/
	public function _general($param = NULL){
		if(isset($param['select']) && !empty($param['select'])){
			$this->db->select($param['select']);
		}
		if(isset($param['table']) && !empty($param['table'])){
			$this->db->from($param['table']);
		}
		if(isset($param['param']) && !empty($param['param'])){
			$this->db->where($param['param']);
		}
		if(isset($param['param_where']) && is_array($param['param_where'])){
			$this->db->where($param['param_where']);
		}
		if(isset($param['field_where_in']) && !empty($param['field_where_in']) && isset($param['param_where_in']) && is_array($param['param_where_in'])){
			$this->db->where_in($param['field_where_in'], $param['param_where_in']);
		}
		if(isset($param['orderby']) && !empty($param['orderby'])){
			$this->db->order_by($param['orderby']);
		}
		if(isset($param['limit']) && (int)$param['limit'] > 0){
			$this->db->limit((int)$param['limit'], (int)$param['start']);
		}
		if(isset($param['count']) && $param['count'] == TRUE){
			$data = $this->db->count_all_results();
			$this->db->flush_cache();
			return $data;
		}
		else{
			if(isset($param['list']) && $param['list'] == TRUE){
				if(isset($param['type']) && $param['type'] == 'object'){
					$data = $this->db->get()->result_object();
					$this->db->flush_cache();
					return $data;
				}
				$data = $this->db->get()->result_array();
				$this->db->flush_cache();
				return $data;
			}
			else{
				if(isset($param['type']) && $param['type'] == 'object'){
					$data = $this->db->get()->row_object();
					$this->db->flush_cache();
					return $data;
				}
				$data = $this->db->get()->row_array();
				$this->db->flush_cache();
				return $data;
			}
		}
	}
	
	/******************************
	Lấy dữ liệu đơn giản
	- select: Những cột cần lấy ra
	- orderby: Dữ liệu được sắp xếp theo
	- table: Dữ liệu được lấy ra từ bảng
	- limit: Vị trí dữ liệu lấy ra
	- type: Kiểu dữ liệu trả về object hay array
	- list: Đưa ra nhiều dòng dữ liệu
	********************************/
	public function _get($param = NULL){
		if(isset($param['select']) && !empty($param['select'])){
			$this->db->select($param['select']);
		}
		if(isset($param['table']) && !empty($param['table'])){
			$this->db->from($param['table']);
		}
		if(isset($param['limit']) && (int)$param['limit'] > 0){
			$this->db->limit((int)$param['limit'], (int)$param['start']);
		}
		if(isset($param['orderby']) && !empty($param['orderby'])){
			$this->db->order_by($param['orderby']);
		}
		if(isset($param['count']) && $param['count'] == TRUE){
			$data = $this->db->count_all_results();
			$this->db->flush_cache();
			return $data;
		}
		else{
			if(isset($param['list']) && $param['list'] == TRUE){
				if(isset($param['type']) && $param['type'] == 'object'){
					$data = $this->db->get()->result_object();
					$this->db->flush_cache();
					return $data;
				}
				$data = $this->db->get()->result_array();
				$this->db->flush_cache();
				return $data;
			}
			else{
				if(isset($param['type']) && $param['type'] == 'object'){
					$data = $this->db->get()->row_object();
					$this->db->flush_cache();
					return $data;
				}
				$data = $this->db->get()->row_array();
				$this->db->flush_cache();
				return $data;
			}
		}
	}
	
	/******************************
	Lấy dữ liệu đơn giản với điều kiện where
	- param_where:Mảng điều kiện
	********************************/
	public function _getwhere($param = NULL){
		if(isset($param['param_where']) && is_array($param['param_where'])){
			$this->db->where($param['param_where']);
		}
		return $this->_get($param);
	}

	/******************************
	Lấy dữ liệu đơn giản với điều kiện wherein
	- field_where_in:Trường dữ liệu
	- param_where_in: Tập hợp giá trị thỏa mãn
	********************************/
	public function _getwherein($param = NULL){
		if(isset($param['field_where_in']) && !empty($param['field_where_in']) && isset($param['param_where_in']) && is_array($param['param_where_in'])){
			$this->db->where_in($param['field_where_in'], $param['param_where_in']);
		}
		return $this->_get($param);
	}
	
	/******************************
	Lấy dữ liệu đơn giản với điều kiện like
	- type == 'array':/ WHERE title LIKE '%match%' AND page1 LIKE '%match%' AND page2 LIKE '%match%'
	********************************/
	public function _getlike($param = NULL, $type = 'single'){
		if($type == 'array'){
			if(isset($param['like']) && is_array($param['like'])){
				$this->db->like($param['param_like']);
			}
		}
		else if($type == 'single'){
			if(isset($param['like']) && is_array($param['like'])){
				foreach($param['like'] as $key => $val){
					$this->db->like($val[0], $val[1], isset($val[2])?$val[2]:'');
				}
			}
		}
		return $this->_get($param);
	}

	/******************************
	Hàm insert hoặc update
	********************************/
	public function _save($param = NULL){
		$flag = 0;
		$time = gmdate('Y-m-d H:i:s', time() + 7*3600);
		$data = $param['data'];
		if(isset($param['param']) && !empty($param['param'])){
			$this->db->where($param['param']);
			$flag = $flag = + 1;
		}
		if(isset($param['param_where']) && is_array($param['param_where'])){
			$this->db->where($param['param_where']);
			$flag = $flag = + 1;
		}
		if(isset($param['field_where_in']) && !empty($param['field_where_in']) && isset($param['param_where_in']) && is_array($param['param_where_in'])){
			$this->db->where_in($param['field_where_in'], $param['param_where_in']);
			$flag = $flag = + 1;
		}
		if($flag == 0){
			if(!isset($param['created']) || $param['created'] == TRUE){
				$data['created'] = $time;
			}
			$this->db->set($data);
			$this->db->insert($param['table']);
			// $this->db->insert($param['table'], $data);
			$insert_id = $this->db->insert_id();
			$this->db->flush_cache();
			return $insert_id;
		}
		else{
			if(!isset($param['updated'])){
				$data['updated'] = $time;
			}
			if(isset($param['updated']) && $param['updated'] == FALSE){
				unset($data['updated']);
			}
			$this->db->set($data);
			$this->db->update($param['table']);
			$affected_rows = $this->db->affected_rows();
			$this->db->flush_cache();
			return $affected_rows;
		}
	}

	/******************************
	Hàm update batch
	********************************/
	public function _savebatch($param = NULL){
		$data = $param['data'];
		if(isset($param['field']) && !empty($param['field'])){
			$this->db->update_batch($param['table'], $data, $param['field']); 	
		}
		else{
			$this->db->insert_batch($param['table'], $data); 
		}
		$affected_rows = $this->db->affected_rows();
		$this->db->flush_cache();
		return $affected_rows;
	}

	public function _del($param = NULL){
		$flag = 0;
		if(isset($param['param']) && !empty($param['param'])){
			$this->db->where($param['param']);
			$flag = $flag = + 1;
		}
		if(isset($param['param_where']) && is_array($param['param_where'])){
			$this->db->where($param['param_where']);
			$flag = $flag = + 1;
		}
		if(isset($param['field_where_in']) && !empty($param['field_where_in']) && isset($param['param_where_in']) && is_array($param['param_where_in'])){
			$this->db->where_in($param['field_where_in'], $param['param_where_in']);
			$flag = $flag = + 1;
		}
		if($flag > 0){
			$this->db->delete($param['table']);
			$affected_rows = $this->db->affected_rows();
			$this->db->flush_cache();
			return $affected_rows;
		}
		return 0;
	}

}
