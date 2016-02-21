<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

if(!function_exists('navigation_menu')){
	function navigation_menu($keyword = 'top-menu', $param = NULL){
		$CI =& get_instance();
		$CI->load->model('backend_navigation/mfnavigation');
		$CI->load->model('backend_navigation/mmenu');
		$position = $CI->mfnavigation->get_position_bykeyword($keyword, FALSE);
		if(!isset($position) || is_array($position) == FALSE || count($position) == 0){
			return NULL;
		}
		if(isset($param['cache']) && $param['cache'] == TRUE && !empty($position['content'])){
			$content = json_decode($position['content'], TRUE);
			if(isset($param['json']) && $param['json'] == TRUE){
				return $content['json'];
			}
			else{
				return $content['string'];
			}
		}
		$menu = $CI->mfnavigation->show_menu_bypositionid($position['id'], FALSE);
		if(!isset($menu) || is_array($menu) == FALSE || count($menu) == 0){
			return NULL;
		}
		$str = '';
		$json = NULL;
		if(isset($menu) && is_array($menu) && count($menu)){
			foreach($menu as $key => $val){
				if(!empty($val['url'])){
					$str = $str.'<li class="l1"><a href="'.$val['url'].'" title="'.htmlspecialchars(strip_tags($val['title'])).'" class="l1">'.$val['title'].'</a></li>';	
					$json[$val['id']] = array('url' => $val['url'], 'title' => $val['title']);
				}
				else if(!empty($val['module']) && $val['moduleid'] > 0){
					if(!empty($val['module_item'])){
						$param['module_item'] = $val['module_item'];
						$temp = navigation_post($val['module'], $val['moduleid'], $param);
						$str = $str.$temp['string'];
						$json[$val['id']] = $temp['json'];
					}
					else{
						$temp = navigation_catalogue($val['module'], $val['moduleid'], $param);
						$str = $str.$temp['string'];
						$json[$val['id']] = $temp['json'];
					}
				}
				
			}
		}
		$str = (!empty($str)?'<ul class="ul l1 clearfix">'.$str.'</ul>':$str);
		return array(
			'string' => $str,
			'json' => $json
		);
	}
}

if(!function_exists('navigation_catalogue')){
	function navigation_catalogue($module = '', $moduleid = 0, $param = NULL){
		$CI =& get_instance();
		if(isset($param[$module]) && is_array($module) && count($module)){
			$menu = $param[$module];
		}
		else{
			$menu = $CI->mmenu->_getwhere(array(
				'select' => 'id, title, slug, lft, rgt, canonical, parentid, image',
				'table' => $module,
				'param_where' => array(
					'lang' => $CI->language
				),
				'list' => TRUE
			));
		}
		$str = '';
		$json = NULL;
		$keyCurrent = 0;
		if(isset($menu) && is_array($menu) && count($menu)){
			foreach($menu as $keyMain => $valMain){
				if($valMain['id'] == $moduleid){
					$keyCurrent = $valMain['id'];
					$href = rewrite_url(array('module' => $module, 'canonical' => $valMain['canonical'], 'slug' => $valMain['slug'], 'id' => $valMain['id']));
					$str = $str.'<li class="l1"><a href="'.$href.'" title="'.htmlspecialchars($valMain['title']).'" class="l1">'.htmlspecialchars($valMain['title']).'</a>';
					$json[$valMain['id']] = array('url' => $href, 'title' => $valMain['title'], 'image' => $valMain['image']);
					if($valMain['rgt'] - $valMain['lft'] > 1){
						$str = $str.'<ul class="l2 clearfix">';	
						foreach($menu as $keyItem => $valItem){
							if($valItem['parentid'] != $valMain['id']) continue;
							$href = rewrite_url(array('module' => $module, 'canonical' => $valItem['canonical'], 'slug' => $valItem['slug'], 'id' => $valItem['id']));
							$str = $str.'<li class="l2"><a href="'.$href.'" title="'.htmlspecialchars($valItem['title']).'" class="l2">'.htmlspecialchars($valItem['title']).'</a>';
							$json[$valMain['id']]['item'][$valItem['id']] = array('url' => $href, 'title' => $valItem['title'], 'image' => $valItem['image']);
							if($valItem['rgt'] - $valItem['lft'] > 1){
								$str = $str.'<ul class="l3 clearfix">';	
								foreach($menu as $keySubItem => $valSubItem){
									if($valSubItem['parentid'] != $valItem['id']) continue;
									$href = rewrite_url(array('module' => $module, 'canonical' => $valSubItem['canonical'], 'slug' => $valSubItem['slug'], 'id' => $valSubItem['id']));
									$str = $str.'<li class="l3"><a href="'.$href.'" title="'.htmlspecialchars($valSubItem['title']).'" class="l3">'.htmlspecialchars($valSubItem['title']).'</a>';
									$json[$valMain['id']]['item'][$valItem['id']]['subitem'][$valSubItem['id']] = array('url' => $href, 'title' => $valSubItem['title'], 'image' => $valSubItem['image']);
									$str = $str.'</li>';
								}
								$str = $str.'</ul>';	
							}
							$str = $str.'</li>';
						}
						$str = $str.'</ul>';	
					}
					$str = $str.'</li>';	
				}
			}
		}
		return array(
			'string' => $str,
			'json' => $json[$keyCurrent]
		);
	}
}

if(!function_exists('navigation_post')){
	function navigation_post($module = '', $moduleid = 0, $param = NULL){
		$CI =& get_instance();
		if(isset($param[$module]) && is_array($module) && count($module)){
			$menu = $param[$module];
		}
		else{
			$menu = $CI->mmenu->_getwhere(array(
				'select' => 'id, title, slug, lft, rgt, canonical, parentid',
				'table' => $module,
				'param_where' => array(
					'lang' => $CI->language
				),
				'list' => TRUE
			));
		}
		$str = '';
		$json = NULL;
		if(isset($menu) && is_array($menu) && count($menu)){
			foreach($menu as $keyMain => $valMain){
				if($valMain['id'] == $moduleid){
					$href = rewrite_url(array('module' => $module, 'canonical' => $valMain['canonical'], 'slug' => $valMain['slug'], 'id' => $valMain['id']));
					$str = $str.'<li class="l1"><a href="'.$href.'" title="'.htmlspecialchars($valMain['title']).'" class="l1">'.htmlspecialchars($valMain['title']).'</a>';
					$json = array('url' => $href, 'title' => $valMain['title']);
					$data['post'] = $CI->mmenu->_getwhere(array(
						'select' => 'id, title, slug, canonical',
						'table' => $param['module_item'],
						'param_where' => array(
							'catalogueid' => $moduleid,
							'lang' => $CI->language
						),
						'limit' => 5,
						'start' => 0,
						'orderby' => '`order` ASC, `id` DESC',
						'list' => TRUE
					));
					if(isset($data['post']) && is_array($data['post']) && count($data['post'])){
						$str = $str.'<ul class="l2 clearfix">';	
						foreach($data['post'] as $keyItem => $valItem){
							$href = rewrite_url(array('module' => $param['module_item'], 'canonical' => $valItem['canonical'], 'slug' => $valItem['slug'], 'id' => $valItem['id']));
							$str = $str.'<li class="l2"><a href="'.$href.'" title="'.htmlspecialchars($valItem['title']).'" class="l2">'.htmlspecialchars($valItem['title']).'</a>';
							$json['item'][$valItem['id']] = array('url' => $href, 'title' => $valItem['title']);
						}
						$str = $str.'</ul>';	
					}
					$str = $str.'</li>';	
				}
			}
		}
		return array(
			'string' => $str,
			'json' => $json
		);
	}
}
