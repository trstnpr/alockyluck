<?php 


function iplocatorGetCurrentCity(){
	$that=&get_instance();
	$defaultCity = get_option('');
	$that->load->library('app');
	$loc= $that->app->cdata('location');
	$state = isset($loc->region_code)?$loc->region_code:'';
	
	$cities = state_cities($state);
	
	if($cities){
		
	}else{
		
	}
	
}

function iplocatorGetCurrentState(){
}

function iplocatorGetCities(){
	$that=&get_instance();
	$defaultCity = get_option('');
	$that->load->library('app');
	$that->load->model('config_model');
	$loc= $that->app->cdata('location');
	$state = isset($loc->region_code)?$loc->region_code:'';
	
	$cities = state_cities($state);
	return $cities;
}

function iplocatorPhonenumber(){
	$that=&get_instance();
	$that->load->library('app');
	$that->load->model('config_model');
	$that->load->model('city_model');
	$phone = get_option('default_phone');
	
	$loc= $that->app->cdata('location');
	
	if($loc){
		if(strtolower(get_option('default_state_abbr')) == $loc->region_code){
			$that->db->select('*');
			$that->db->where('name',strtolower(ucwords($loc->city)));
			$that->db->where('state',strtolower($loc->region_code));
			$dataset = $that->db->get('cities');
			
			if( $data = $dataset->row() ){
				$phone = $data->phone;
			}else{
				$phone = get_option('default_phone');
			}
		}else{
			$phone = get_option('default_phone');
		}
	}
	
	return $phone;
}

function iplocatorGetSiteHeadline(){
	$that=&get_instance();
	$that->load->library('app');
	$that->load->model('config_model');
	$loc= $that->app->cdata('location');
	$state = isset($loc->region_code)?$loc->region_code:'';
	$return = '';
	
	$cities = state_cities($state);
	
	if($cities){
		$return = $that->config_model->get('headline');
		$return = str_replace("%default_city%",ucwords(strtolower($loc->city)), $return);
		$return = str_replace("%default_state_abbr%", strtoupper($loc->region_code), $return);
	}else{
		$return = get_option('headline');
	}
	
	return $return;
}
