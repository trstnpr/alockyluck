<?php

function getPageShortContent($value,$numWords=null){
	if(is_numeric($value)){
		$options = array('fields'=>'id,content,slug,title');
	}else{
		$options = array('fields'=>'id,content,slug,title','key_by'=>'slug');
	}
	$x = get_option('num_page_short_content');
	if(!isset($numWords)){ $numWords = empty($x)?20:$x;}
	$that =& get_instance();
	$that->load->model('page_model');
	$page = $that->page_model->get($value,$options);
	return word_limiter($page->content , $numWords);
}