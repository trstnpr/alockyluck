<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Config extends CI_Controller {
		
	function __construct(){
		parent::__construct();
		$this->load->database();
		$this->load->library('session');
		$this->load->library('app');
		$this->load->library('admin/admin_template');
		$this->load->library('admin/auth');
		$this->load->model('config_model');
	}
	
	public function index(){
		$this->auth->check_login();
		if(isset($_POST['submit'])){
			foreach($_POST['options'] as $key=>$option){
				$this->config_model->set_option($key,$option[0]);
			}
			$this->session->set_flashdata('message','Success updating configuration data');
			redirect($_POST['callback_url']);
		}
		
		
		
		
		$this->admin_template->render('configuration');
	}
}