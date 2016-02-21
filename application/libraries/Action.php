<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Action{

	private $CI;
	
	function __construct($params = NULL){
		$this->params = $params;
		$this->CI =& get_instance();
		$this->CI->load->model(array($this->params['model']));
	}

	public function _sort($param = NULL){
		$model = $this->params['model'];
		if($this->CI->input->post('sort')){
			$order = $this->CI->input->post('order');
			if(isset($order) && is_array($order) && count($order)){
				$data_order = NULL;
				foreach($order as $keyOrder => $valOrder){
					$data_order[] = array('id' => $keyOrder, 'order' => (int)$valOrder);
				}
				$flag = $this->CI->$model->_savebatch(array(
					'table' => $this->params['table'],
					'data' => $data_order,
					'field' => 'id'
				));
				if($flag > 0){
					if(isset($param['nestedset']) && $param['nestedset'] == TRUE){
						$this->CI->nestedset->get(array('orderby' => 'level ASC, order ASC, id ASC'));
						$this->CI->nestedset->recursive(0, $this->CI->nestedset->set());
						$this->CI->nestedset->action();
					}
					message_flash('Sắp xếp thành công');
				}
				else{
					message_flash('Dữ liệu không thay đổi', 'error');
				}
				redirect(!empty($this->CI->redirect)?$this->CI->redirect:$param['redirect']);
			}
		}
	}

	public function _delete($param = NULL){
		$model = $this->params['model'];
		if($this->CI->input->post('delete')){
			$check = $this->CI->input->post('check');
			if(isset($check) && is_array($check) && count($check)){
				$data_check = NULL;
				foreach($check as $keyCheck => $valCheck){
					$data_check[] = $keyCheck;
				}
				if(property_exists('RouterBie', 'delete')){
					$this->CI->routerbie->delete(array(
						'param_where' => array(
							'module' => $this->params['table']
						),
						'field_where_in' => 'moduleid',
						'param_where_in' => $data_check
					));
				}
				$flag = $this->CI->$model->_del(array(
					'table' => $this->params['table'],
					'field_where_in' => 'id',
					'param_where_in' => $data_check
				));	
				if($flag > 0){
					message_flash('Xóa lựa chọn thành công');
				}
				else{
					message_flash('Dữ liệu không thay đổi', 'error');
				}
				redirect(!empty($this->CI->redirect)?$this->CI->redirect:$param['redirect']);
			}
			message_flash('Bạn cần phải lựa chọn đối tượng để xóa', 'error');
			redirect(!empty($this->CI->redirect)?$this->CI->redirect:$param['redirect']);
		}
	}
}
