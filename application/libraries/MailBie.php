<?php if(!defined('BASEPATH')) exit('No direct script access allowed'); 

class MailBie{

	public $CI;

    public function __construct(){
		$this->CI =& get_instance();
    }
	
	public function sent($param = array()){
		$config = Array(
			'protocol' => $this->CI->system['email-protocol'],
			'smtp_host' => $this->CI->system['email-smtp-host'],
			'smtp_port' => $this->CI->system['email-smtp-port'],
			'smtp_user' => $param['from'],
			'smtp_pass' => $param['password'],
			'charset' => 'utf-8',
			'newline' => "\r\n",
			'mailtype' => 'html',
		);
		$this->CI->load->library('email', $config);
		$this->CI->email->set_newline("\r\n");
		$this->CI->email->from($param['from'], $param['name']);
		$this->CI->email->to($param['to']);
		$this->CI->email->cc($param['cc']);
		$this->CI->email->subject($param['subject']);
		$this->CI->email->message($param['message']);
		// $this->CI->email->send();
		if (!$this->CI->email->send()) show_error($this->CI->email->print_debugger());
		// else echo 'Your e-mail has been sent!';
	}
}
