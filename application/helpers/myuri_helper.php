<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

if(!function_exists('rewrite_url')){
	function rewrite_url($param = NULL){
		if(!isset($param['module']) || empty($param['module'])) return 'Empty Module';
		$param['suffix'] = (!isset($param['suffix']))?URL_SUFFIX:$param['suffix'];
		if(isset($param['canonical']) && !empty($param['canonical'])) return base_url($param['canonical']).$param['suffix'];
		if(isset($param['id']) && !empty($param['id'])){
			$param['slug'] = (isset($param['slug']) && !empty($param['slug']))?$param['slug']:'biegr';
			switch($param['module']){
				case 'article_catalogue': return base_url('c'.$param['id'].'/'.$param['slug'].$param['suffix']);
				case 'article': return base_url('a'.$param['id'].'/'.$param['slug'].$param['suffix']);
				case 'product_catalogue': return base_url('product/c'.$param['id'].'/'.$param['slug'].$param['suffix']);
				case 'product': return base_url('product/a'.$param['id'].'/'.$param['slug'].$param['suffix']);
				case 'attribute': return base_url((isset($param['prefix'])?$param['prefix']:'attribute').'/a'.$param['id'].'/'.$param['slug'].$param['suffix']);
			}	
		}
		return NULL;
	}
}

if(!function_exists('removeutf8')){
	function removeutf8($value = NULL){
		$chars = array(
			'a'	=>	array('ấ','ầ','ẩ','ẫ','ậ','Ấ','Ầ','Ẩ','Ẫ','Ậ','ắ','ằ','ẳ','ẵ','ặ','Ắ','Ằ','Ẳ','Ẵ','Ặ','á','à','ả','ã','ạ','â','ă','Á','À','Ả','Ã','Ạ','Â','Ă'),
			'e' =>	array('ế','ề','ể','ễ','ệ','Ế','Ề','Ể','Ễ','Ệ','é','è','ẻ','ẽ','ẹ','ê','É','È','Ẻ','Ẽ','Ẹ','Ê'),
			'i'	=>	array('í','ì','ỉ','ĩ','ị','Í','Ì','Ỉ','Ĩ','Ị'),
			'o'	=>	array('ố','ồ','ổ','ỗ','ộ','Ố','Ồ','Ổ','Ô','Ộ','ớ','ờ','ở','ỡ','ợ','Ớ','Ờ','Ở','Ỡ','Ợ','ó','ò','ỏ','õ','ọ','ô','ơ','Ó','Ò','Ỏ','Õ','Ọ','Ô','Ơ'),
			'u'	=>	array('ứ','ừ','ử','ữ','ự','Ứ','Ừ','Ử','Ữ','Ự','ú','ù','ủ','ũ','ụ','ư','Ú','Ù','Ủ','Ũ','Ụ','Ư'),
			'y'	=>	array('ý','ỳ','ỷ','ỹ','ỵ','Ý','Ỳ','Ỷ','Ỹ','Ỵ'),
			'd'	=>	array('đ','Đ'),
		);
		foreach ($chars as $key => $arr)
			foreach ($arr as $val)
				$value = str_replace($val, $key, $value);
		return $value;
	}
}

if(!function_exists('slug')){
	function slug($value = NULL){	
		$value = removeutf8($value);
		$value = str_replace('-', ' ', trim($value));
		$value = preg_replace('/[^a-z0-9-]+/i', ' ', $value);
		$value = trim(preg_replace('/\s\s+/', ' ', $value));
		return strtolower(str_replace(' ', '-', trim($value)));
	}
}

if(!function_exists('fullurl')){
	function fullurl($base64 = FALSE){
		$currentURL = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] == 'on') ? 'https://' : 'http://';
		$currentURL .= $_SERVER['SERVER_NAME'];
		if($_SERVER['SERVER_PORT'] != '80' && $_SERVER['SERVER_PORT'] != '443'){
			$currentURL .= ':'.$_SERVER['SERVER_PORT'];
		}
		$currentURL .= $_SERVER['REQUEST_URI'];
		// $currentURL = $currentURL.((!empty($_SERVER['QUERY_STRING']))?('?'.$_SERVER['QUERY_STRING']):'');
		if($base64 == FALSE){
			return $currentURL;
		}
		else{
			return base64_encode($currentURL);
		}
	}
}