<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

// Frontend
$route['default_controller'] = 'home/home/index/';
$route['404_override'] = '';


$route['admin'] = 'admin/home/index';
$route['teacher'] = 'list_class_of_teacher/home';
?>