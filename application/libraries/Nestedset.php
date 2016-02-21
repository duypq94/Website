<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Nestedset{

	private $CI;
	public $checked = NULL;
	public $params = NULL;
	public $data = NULL;
	public $count = 0;
	public $count_level = 0;
	public $lft = NULL;
	public $rgt = NULL;
	public $level = NULL;

	/* Cấu hình nestedset */
	function __construct($params = NULL){
		$this->CI =& get_instance();
		$this->params = $params;
		$this->CI->load->model(array($this->params['model']));
		$this->checked = NULL;
		$this->count = 0;
		$this->count_level = 0;
		$this->lft = NULL;
		$this->rgt = NULL;
		$this->level = NULL;
	}
	
	/* Lấy danh sách nestedset */
	public function get($param = NULL){
		$model = isset($this->params['model_name'])?$this->params['model_name']:$this->params['model'];
		$param['param_where']['lang'] = $this->CI->language;
		if(isset($param['param_where']) && is_array($param['param_where']) && count($param['param_where'])){
			$this->data = $this->CI->$model->_getwhere(array(	/* Lấy nestedset với điều kiện */
				'select' => 'id, title, parentid, lft, rgt, level, order',
				'table' => $this->params['table'],
				'list' => TRUE,
				'param_where' => $param['param_where'],
				'orderby' => isset($param['orderby'])?$param['orderby']:'lft ASC, order ASC'
			));	
		}
		else{
			$this->data = $this->CI->$model->_get(array(	/* Lấy toàn bộ nestedset */
				'select' => 'id, title, parentid, lft, rgt, level, order',
				'table' => $this->params['table'],
				'list' => TRUE,
				'orderby' => isset($param['orderby'])?$param['orderby']:'lft ASC, order ASC'
			));	
		}
	}

	/* Xử lý mảng nestedset  */
	public function set(){	
		if(isset($this->data) && is_array($this->data)){
			$arr = NULL;
			foreach($this->data as $key => $val){
				$arr[$val['id']][$val['parentid']] = 1;
				$arr[$val['parentid']][$val['id']] = 1;
			}
			return $arr;
		}
	}

	/* Tính lại level */
	public function recursive($start = 0, $arr = NULL){
		$this->lft[$start] = ++$this->count;
		$this->level[$start] = $this->count_level;
		if(isset($arr) && is_array($arr)){
			foreach($arr as $key => $val){
				if((isset($arr[$start][$key]) || isset($arr[$key][$start])) &&(!isset($this->checked[$key][$start]) && !isset($this->checked[$start][$key]))){
					$this->count_level++;
					$this->checked[$start][$key] = 1;
					$this->checked[$key][$start] = 1;
					$this->recursive($key, $arr);
					$this->count_level--;
				}
			}
		}
		$this->rgt[$start] = ++$this->count;
	}
	
	/* Cập nhật lft, rgt */
    function action(){
		if(isset($this->level) && is_array($this->level) && isset($this->lft) && is_array($this->lft) && isset($this->rgt) && is_array($this->rgt)){
			$data = NULL;
			foreach($this->level as $key => $val){
				$data[] = array(
					'id' => $key,
					'level' => $val,
					'lft' => $this->lft[$key],
					'rgt' => $this->rgt[$key],
				);
			}
			$model = isset($this->params['model_name'])?$this->params['model_name']:$this->params['model'];
			$this->CI->$model->_savebatch(array(
				'table' => $this->params['table'],
				'data' => $data,
				'field' => 'id'
			));
		}
    }
	
	/* Xuất dropdown */
	public function dropdown($param = NULL){
		$this->get($param);
		if(isset($this->data) && is_array($this->data)){
			$temp = NULL;
			$temp[0] = (isset($param['text']) && !empty($param['text']))?$param['text']:'[Root]';
			foreach($this->data as $key => $val){
				$temp[$val['id']] = str_repeat('|-----', (($val['level'] > 0)?($val['level'] - 1):0)).$val['title'];
			}
			return $temp;
		}
	}
	
	/*----------------------------
	 * Tính danh mục con 
	 * $param['andparent'] == TRUE Lấy cả cha
	 */
	public function children($param = NULL){
		$model = isset($this->params['model_name'])?$this->params['model_name']:$this->params['model'];
		$catalogues = NULL;
		$param['andparent'] = (isset($param['andparent']) && ($param['andparent'] == TRUE))?'=':'';
		if(isset($param['lft']) && isset($param['rgt'])){	/* Truyền vào có left và right */
			$catalogues['lft'] = $param['lft'];
			$catalogues['rgt'] = $param['rgt'];
		}
		else if(isset($param['id'])){	/* Tính left và right */
			$catalogues = $this->CI->$model->_getwhere(array(
				'select' => 'id, lft, rgt',
				'table' => $this->params['table'],
				'param_where' => array(
					'id' => $param['id'],
				)
			));
		}
		if($catalogues == NULL) return NULL; /* Không thấy con */
		if(isset($param['count']) && $param['count'] == TRUE){
			$children = $this->CI->$model->_getwhere(array(	/* Lấy danh sách con */
				'select' => 'id',
				'table' => $this->params['table'],
				'count' => TRUE,
				'param_where' => array(
					'lft >'.$param['andparent'].'' => $catalogues['lft'],
					'rgt <'.$param['andparent'].'' => $catalogues['rgt'],
				)
			));
			return $children;
		}
		else if(isset($param['list']) && $param['list'] == TRUE){
			return $this->CI->$model->_getwhere(array(
				'table' => $this->params['table'],
				'list' => TRUE,
				'param_where' => array(
					'lft >'.$param['andparent'].'' => $catalogues['lft'],
					'rgt <'.$param['andparent'].'' => $catalogues['rgt'],
				)
			));
		}
		else{
			$temp = NULL;
			$children = $this->CI->$model->_getwhere(array(
				'select' => 'id',
				'table' => $this->params['table'],
				'list' => TRUE,
				'param_where' => array(
					'lft >'.$param['andparent'].'' => $catalogues['lft'],
					'rgt <'.$param['andparent'].'' => $catalogues['rgt'],
				)
			));
			if(isset($children) && is_array($children) && count($children)){	/* Làm lại mảng đẩy ra */
				foreach($children as $key => $val){
					$temp[] = $val['id'];
				}
				return $temp;
			}
			return NULL;
		}		
		
	}
	
	/* Xuất breadcrumb */
	public function breadcrumb($param = NULL){
		$model = isset($this->params['model_name'])?$this->params['model_name']:$this->params['model'];
		$catalogues = NULL;
		if(isset($param['lft']) && isset($param['rgt'])){
			$catalogues['lft'] = $param['lft'];
			$catalogues['rgt'] = $param['rgt'];
		}
		else if(isset($param['id'])){
			$catalogues = $this->CI->$model->_getwhere(array(
				'select' => 'id, lft, rgt',
				'table' => $this->params['table'],
				'param_where' => array(
					'id' => $param['id'],
				)
			));
		}
		if($catalogues == NULL) return NULL;
		$temp = NULL;
		$breadcrumb = $this->CI->$model->_getwhere(array(
			'select' => 'id, title, slug, canonical',
			'table' => $this->params['table'],
			'list' => TRUE,
			'param_where' => array(
				'lft <=' => $catalogues['lft'],
				'rgt >=' => $catalogues['rgt'],
			),
			'orderby' => 'lft ASC'
		));
		if(isset($breadcrumb) && is_array($breadcrumb) && count($breadcrumb)){
			foreach($breadcrumb as $key => $val){
				$temp[] = $val;
			}
			return $temp;
		}
		return NULL;
	}

}
