<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Admin extends CI_Controller {
		
	function __construct(){
		parent::__construct();
		$this->load->database();
		$this->load->library('session');
		$this->load->library('app');
		$this->load->library('admin/admin_template');
		$this->load->library('admin/auth');
	}
	
	public function index(){
		$this->auth->check_login();
		$this->admin_template->render('index');
	}
	
	public function login(){
		
		if(isset($_POST['submit'])){
			if($this->auth->login($_POST['username'],$_POST['password'])){
				redirect(base_url('admin'));
			}else{
				$this->session->set_flashdata('message','Login Failed');
				redirect(base_url('admin/login'));
			}
		}
		$this->admin_template->render('login');
	}
	
	public function logout(){
		$this->session->set_userdata('is_login',FALSE);
		$this->session->sess_destroy();
		redirect(base_url('admin/login'));
	}
}