<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Home extends MY_Controller{

	function __construct(){
		parent::__construct();
	}
	public function captcha(){
		/**
		* PHP GD
		* create a simple image with GD library
		* 
		*/
		//setting the image header in order to proper display the image
		header("Content-Type: image/png");
		//try to create an image
		$image = @imagecreate(68, 25) or die("Cannot Initialize new GD image stream");
		//set the background color of the image
		$background_color = imagecolorallocate($image, 0xFF, 0xFF, 0xFF);

		// line_color
		$line_color = imagecolorallocate($image, 0,0,255); 
		for($i=0; $i < 3; $i++) {
			imageline($image,0,rand()%50, 68,rand()%50,$line_color);
		}

		// pixel_color
		$pixel_color = imagecolorallocate($image, 0,0,255);
		for($i=0; $i < 1000; $i++) {
			imagesetpixel($image,rand()%200,rand()%50, $pixel_color);
		}
		//set the color for the text
		$text_color = imagecolorallocate($image, 133, 14, 91);
		// random
		$random = strtoupper(rand(10000, 99999));
		$this->session->set_userdata('captcha', $random);
		//adf the string to the image
		imagestring($image, 5, 12, 4,  $random, $text_color);
		//outputs the image as png
		imagepng($image);
		//frees any memory associated with the image 
		imagedestroy($image);
	}
	public function password(){
		print_r(encryption('123456', 'sfsdfsfdfvfdgdfg'));
	}
}
