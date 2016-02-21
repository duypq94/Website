<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

if(!function_exists('backend_pagination')){
	function backend_pagination(){
		$config['full_tag_open'] = '<section class="pagination"><ul>';
		$config['full_tag_close'] = '</ul></section>';
		$config['first_link'] = '&laquo; First';
		$config['first_tag_open'] = '<li>';
		$config['first_tag_close'] = '</li>';
		$config['last_link'] = 'Last &raquo;';
		$config['last_tag_open'] = '<li>';
		$config['last_tag_close'] = '</li>';
		$config['next_link'] = 'Next &raquo;';
		$config['next_tag_open'] = '<li>';
		$config['next_tag_close'] = '</li>';
		$config['prev_link'] = '&laquo; Previous';
		$config['prev_tag_open'] = '<li>';
		$config['prev_tag_close'] = '</li>';
		$config['cur_tag_open'] = '<li class="active"><a>';
		$config['cur_tag_close'] = '</a></li>';
		$config['num_tag_open'] = '<li>';
		$config['num_links'] = 5;
		$config['use_page_numbers'] = TRUE;
		$config['per_page'] = 10;
		return $config;
	}
}

if(!function_exists('frontend_pagination')){
	function frontend_pagination(){
		$config['full_tag_open'] = '<section class="pagination clearfix"><ul class="clearfix">';
		$config['full_tag_close'] = '</ul></section><!-- .pagination -->';
		$config['first_link'] = '&laquo; First';
		$config['first_tag_open'] = '<li>';
		$config['first_tag_close'] = '</li>';
		$config['last_link'] = 'Last &raquo;';
		$config['last_tag_open'] = '<li>';
		$config['last_tag_close'] = '</li>';
		$config['next_link'] = 'Next &raquo;';
		$config['next_tag_open'] = '<li>';
		$config['next_tag_close'] = '</li>';
		$config['prev_link'] = '&laquo; Previous';
		$config['prev_tag_open'] = '<li>';
		$config['prev_tag_close'] = '</li>';
		$config['cur_tag_open'] = '<li class="active"><a>';
		$config['cur_tag_close'] = '</a></li>';
		$config['num_tag_open'] = '<li>';
		$config['num_links'] = 5;
		$config['use_page_numbers'] = TRUE;
		$config['per_page'] = 10;
		return $config;
	}
}

if(!function_exists('validate_pagination')){
	function validate_pagination($page = 0, $total_page = 0){
		$page = ($page > $total_page)?$total_page:$page;
		$page = ($page < 1)?1:$page;
		return $page;
	}
}

if(!function_exists('seo_pagination')){
	function seo_pagination($config = NULL){
		if($config['cur_page'] == 1){
			$data['canonical'] = $config['base_url'].URL_SUFFIX;
		}
		else if($config['cur_page'] > 1){
			$data['canonical'] = $config['base_url'].'/trang-'.$config['cur_page'].URL_SUFFIX;	
		}
		if(($config['cur_page']-1) >= 1){
			if(($config['cur_page']-1) == 1){
				$data['prev'] = $config['base_url'].URL_SUFFIX;		
			}
			else{
				$data['prev'] = $config['base_url'].'/trang-'.($config['cur_page']-1).URL_SUFFIX;		
			}
		}
		if(isset($config['total_page']) && ($config['cur_page']+1) <= $config['total_page']){
			$data['next'] = $config['base_url'].'/trang-'.($config['cur_page']+1).URL_SUFFIX;		
		}
		return $data;
	}
}