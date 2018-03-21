<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Import extends CI_Controller {
		
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
		$this->admin_template->render('import');
	}
	
	public function states(){
		if(!isset($_POST['submit'])){
			//show_error('ERROR: You dont have permission to view this page',500);
			echo "Error..";
		}
		$this->admin_template->render('import_states');
	}
	
	public function cities(){
		$this->admin_template->render('import_cities');
	}
	public function phonenumbers(){
		if(!isset($_POST['submit'])){
			//show_error('ERROR: You dont have permission to view this page',500);
			echo "Error..";
		}
		$this->admin_template->render('import_phonenumber');
	}
}