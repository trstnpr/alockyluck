<?php

//get all post..
function posts($filter=null){
	if(isset($filter))extract($filter);
	$filter = array(
		'limit'=>99999,
		'start'=>0,
		'order_by'=>'created DESC,id DESC',//add comma for multiple order by..
		'fields'=>'*',
		'status'=>'publish',
	);
	$that =& get_instance();
	$that->load->model('post_model');
	return $that->post_model->get_all($filter);
}


function get_post($key, $filter){
	if(isset($filter))extract($filter);
	$filter = array(
		'fields'=>'*',
		'primary_key'=>'id',
		'status'=>null
	);
	$that =& get_instance();
	$that->load->model('post_model');
	return $that->post_model->get($key,$filter);
}