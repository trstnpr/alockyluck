<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Maintenance extends CI_Controller {
		
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
		
		$this->admin_template->render('maintenance');
	}
	
	public function php_info(){
		$this->auth->check_login();
		
		$this->admin_template->render('phpinfo');
	}
	
	public function fix_city_url(){
		$this->auth->check_login();
		if(!isset($_POST['submit'])){show_error('ERROR: You dont have permission to view this page',500);}
		$this->load->model('city_model');
		$dup_ids=array();
		$response="";
		if($cities = $this->city_model->get_duplicated_slug()){
			foreach($cities as $city){
				if($dup_cities = $this->city_model->get_all(array('field_key'=>'slug','field_value'=>$city->slug,'fields'=>'name,id,slug,state'))){
					foreach($dup_cities as $dup_city){
						if($this->city_model->update($dup_city->id,array('slug'=>$dup_city->slug."-".$dup_city->state))){
							$response .= "<span style='color: green'>Success updating slug of {$dup_city->name} to {$dup_city->slug}-{$dup_city->state}</span></br>";
						}else{
							$response .= "<span style='color: red'>Failed updating slug of {$dup_city->name} to {$dup_city->slug}-{$dup_city->state}</span></br>";
						}
						
					}	
				}
			}
			
		}else{
			$response = "<h5>Nothing to fix</h5>";
		}
		$this->app->set_cdata('raw',$response);
		$this->admin_template->render('maintenance-fix-city-url');
	}
}