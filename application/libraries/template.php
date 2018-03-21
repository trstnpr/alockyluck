<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); 

class Template {
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
		$view = $this->ci->app->data('theme').'block/';
		$view .= isset($file)?$file:$this->data->block;
		$this->ci->load->view($view,$data);
	}
	
	function form($file=null,$data=null){
		$view = $this->ci->app->data('theme').'form/';
		$view .= isset($file)?$file:$this->data->block;
		$this->ci->load->view($view,$data);
	}
	
	function render($layout=null,$data=null){
		$view = $this->ci->app->data('theme');
		$view .= isset($layout)?$layout:$this->data->layout;
		$this->ci->load->view($view,$data);
	}
	
	function phtml($file=null,$data=null){
		$view = $this->ci->app->data('theme').'phtml/';
		$view .= isset($file)?$file:$this->data->phtml;
		$this->ci->load->view($view,$data);
	}
}