<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); 

class admin_template {
	protected $data;
	protected $cdata;
	protected $ci;
	
    function __construct()
    {
        $this->ci =& get_instance();
		$data['layout']='index';
		$data['phtml']='index';
		$data['block']='index';
		$this->data = array_to_object($data);
    }
	
	function layout($file,$data=null){
		$this->load->view($file,$data);
	}
	
	function block($file=null,$data=null){
		$view = 'admin/block/';
		$view .= isset($file)?$file:$this->data->block;
		$this->ci->load->view($view,$data);
	}
	
	function render($layout=null,$data=null){
		$view = 'admin/';
		$view .= isset($layout)?$layout:$this->data->layout;
		$this->ci->load->view($view,$data);
	}
	
	function phtml($file=null,$data=null){
		$view = 'admin/phtml/';
		$view .= isset($file)?$file:$this->data->phtml;
		$this->ci->load->view($view,$data);
	}
	
	function admin_theme_uri($pathFile){
		return base_url("assets/admin/".$pathFile);
	}
}