<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Iplocator{
	var $keys = array(
		'country_name',
		'country_code',
		'region',
		'city',
		'latitude',
		'longitude'
	);
	var $license_key = '';
	var $ip;
	var $ci;
	
	function __construct(){
        $this->ci =& get_instance();
		$this->license_key = get_option('iplocator_key');
		
		if(isset($_GET['ip'])){
			$this->ip = $_GET['ip'];
		}else{
			$this->ip = $this->ci->input->ip_address();
		}
		
    }
	
	function getInfo(){
			$resource_url = "http://api.ip2location.com/?ip={$this->ip}&key={$this->license_key}&package=WS5";
			$data_info = explode(";",file_get_contents($resource_url));
			
			if(count($data_info) == count($this->keys)){
				$info = array_combine($this->keys,$data_info);
				$info['region_code']= stateToAbbr($info['region']);
				return $info;
			}else{
				return '';
			}
			
			
	}
	
	
}
	