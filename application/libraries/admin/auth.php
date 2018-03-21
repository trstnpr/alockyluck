<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Auth{
	protected $ci;
	
    function __construct(){
        $this->ci =& get_instance();
		$this->ci->load->library('session');
		$this->ci->load->library('app');
    }
	
	function login($username, $password){
		$busername = $this->ci->config->item('backend_username');
		$bpass=$this->ci->config->item('backend_password');
		if($busername==$username && $bpass==$password){
			$this->ci->session->set_userdata('is_login',TRUE);
			return 1;
		}else{
			return 0;
		}
	}
	
	function check_login(){
		if($this->ci->session->userdata('is_login')){
			return 1;
		}else{
			redirect(base_url('admin/login'));
		}
	}
}