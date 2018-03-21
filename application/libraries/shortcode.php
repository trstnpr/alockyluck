<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); 

class Shortcode {
	protected $ci;
	protected $short_names;
	
	
    function __construct(){
        $this->ci =& get_instance();
    }
	
	function get_all(){
		return $this->short_names;
	}
	
	function add($name, $function, $attrib=null){
		$is_exist = false;
		if($name!='' && $function!=''){
			for($x=0; $x < count($this->short_names[$name]); $x++){
				if($name == $this->short_names[$name]){
					$is_exist = true;
				}
			}
			if($is_exist == false){
				$this->short_names[$name]['name'] = $name; 
				$this->short_names[$name]['content'] = $function; 
			}			
		}
	}
}
