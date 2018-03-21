<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');



class Post extends CI_Controller {

		

	function __construct(){

		parent::__construct();

		$this->load->database();

		$this->load->library('session');

		$this->load->library('app');

		$this->load->model('config_model');

		$this->load->helper('frontend_helper');

		$this->load->helper('post_helper');

		$this->load->library('recaptcha');

		$this->load->model('state_model');

		$this->load->model('city_model');

		$this->load->model('page_model');

		$this->load->model('post_model');

		

		$this->app->set_cdata('isLocationCovered',FALSE);

	}

	

	public function index(){

		$this->load->model('state_model');
		$this->load->model('city_model');
		$this->load->model('testimonial_model');
		$this->load->model('page_model');
		$this->load->model('post_model');
      
		

		if($seg_one=$this->uri->segment(1,0)){


			if(is_numeric($seg_one) && strlen($seg_one)==5){

				$this->_load_city_zip();

			} elseif($seg_one=='zip-code'){
				$seg_two = $this->uri->segment(2,0);
				if($this->city_model->is_exists($seg_two,'slug')){
					$this->_load_city_zip();
				}elseif(empty($seg_two)){
						$this->_load_state();
				}else{
					$this->_load_page_not_found();
				}
			} elseif($seg_one=='search'){

				$this->_load_search();

			} elseif($this->page_model->is_exists($seg_one,'slug')){

				$this->_load_page();

			}elseif($seg_one=='blog'){

				$this->_load_articles();

			}elseif($this->state_model->is_exists($seg_one,'slug')){

				 if($seg_two=$this->uri->segment(2,0)){

					$this->_load_city();

				 }else{

				   	$this->_load_state();

				}

			}elseif($this->post_model->is_exists($seg_one,'slug')){

				$this->_load_post();

			}else{

				$this->_load_page_not_found();

			}

		}else{

			$this->_load_frontpage();

		}

	}

	public function _load_frontpage(){

		$this->load->model('page_model');

        //$this->load->library('iplocator',array('license_key'=>$this->config_model->get('iplocator_key')));

		//$location = $this->iplocator->getInfo();

        $location=array(

			'country_name' => '',

			'country_code' => '',

			'region' => get_option('default_state'),

			'city' => get_option('default_city'),

			'latitude' => '',

			'longitude' => '',

			'region_code' =>get_option('default_state_abbr')

		);

		$this->app->set_cdata('location',$location);

		$id = $this->config_model->get('frontpage_id');

		$page = $this->page_model->get($id);

		$this->app->set_cdata('raw',$page);

		$this->app->set_cdata('content',$page->content);

		$this->app->set_cdata('header',$page->title);

		$this->app->set_cdata('title',$this->config_model->get('site_title'));

		$this->app->set_cdata('isLocationCovered',TRUE);

		$this->template->render($this->config_model->get('default_frontpage_layout'));

	}

	public function _load_articles(){

		$this->load->model('post_model');

		$page_title = "Articles | ".$this->config_model->get('site_title');

		$this->app->set_cdata('title',$page_title);

		$this->template->render($this->config_model->get('blog_list_page'));

	}

	public function _load_page(){

		$data['page'] = base_url('contact-us');

		// $data['recaptcha_html'] = $this->recaptcha->recaptcha_get_html();
		$data['recaptcha_html'] = $this->input->post('g-recaptcha-response');

		$this->load->model('page_model');

		$pages = $this->page_model->get_all();

		

		$slug = $this->uri->segment(1);

		$data['page_type'] = $slug;

		$page = $this->page_model->get($slug,array('key_by'=>'slug'));

		$this->app->set_cdata('raw',$page);

		$this->app->set_cdata('page',$page);

		$this->app->set_cdata('content',$page->content);

		$this->app->set_cdata('header',$page->title);
		//$data['gr_data'] = gr_keys();
		
		$format = $this->config_model->get('page_title_format');

		$page_title = str_replace('%site_title%',$this->config_model->get('site_title'),$format);

		$page_title = str_replace('%page_title%',$page->title,$page_title);

		$this->app->set_cdata('title',$page_title);

		

		$layout = !empty($page->layout)?$page->layout:$this->config_model->get('default_page_layout');

		$this->template->render($layout, $data);

	}

	public function _load_post(){

		$this->load->model('post_model');

		$pages = $this->page_model->get_all();

		$slug = $this->uri->segment(1);

		$record = $this->post_model->get($slug,array('primary_key'=>'slug'));

		$this->app->set_cdata('raw',$record);

		$this->app->set_cdata('record',$record);

		$this->app->set_cdata('content',$record->content);

		$this->app->set_cdata('header',$record->title);

		

		$format = $this->config_model->get('page_title_format');

		$page_title = str_replace('%site_title%',$this->config_model->get('site_title'),$format);

		$page_title = str_replace('%page_title%',$record->title,$page_title);

		$this->app->set_cdata('title',$page_title);

		$layout = !empty($record->layout)?$record->layout:$this->config_model->get('default_post_layout');

		$this->template->render($layout);

	}

	public function _load_submit_form(){

		$data['page'] = base_url('submit-form');

		// $data['recaptcha_html'] = $this->recaptcha->recaptcha_get_html();
		//$data['recaptcha_html'] = $this->input->post('g-recaptcha-response');

		$this->load->model('page_model');

		$pages = $this->page_model->get_all();

		

		$slug = $this->uri->segment(1);

		$data['page_type'] = $slug;

		$page = $this->page_model->get($slug,array('key_by'=>'slug'));

		$this->app->set_cdata('raw',$page);

		$this->app->set_cdata('page',$page);

		$this->app->set_cdata('content',$page->content);

		$this->app->set_cdata('header',$page->title);
		//$data['gr_data'] = gr_keys();
		
		$format = $this->config_model->get('page_title_format');

		$page_title = str_replace('%site_title%',$this->config_model->get('site_title'),$format);

		$page_title = str_replace('%page_title%',$page->title,$page_title);

		$this->app->set_cdata('title',$page_title);

		

		$layout = !empty($page->layout)?$page->layout:$this->config_model->get('default_page_layout');

		$this->template->render($layout, $data);

	}

	public function _load_state(){

		$this->load->model('state_model');

		$slug = $this->uri->segment(1);

		$state = $this->state_model->get($slug,array('key_by'=>'slug','join_table'=>'cities'));

		$this->app->set_cdata('raw',$state);

		$this->app->set_cdata('state',$state);

		$this->app->set_cdata('content',$state->content);

		$this->app->set_cdata('header',$state->name);

		$format = $this->config_model->get('state_title_format');

		$title = str_replace('%site_title%',$this->config_model->get('site_title'),$format);

		$title = str_replace('%state_name%',$state->name,$title);

		$this->app->set_cdata('title',$title);

		$this->template->render($this->config_model->get('state_page_layout'));

	}

	public function _load_city_zip(){
		
		$zip_code = $this->uri->segment(2,0);
		$cities = $this->city_model->get_by_zip_code($zip_code);

		if($cities){
			foreach($cities as $city){
				$zipcode_description = $city->description;
				$zipcode = $city->zip_code;
				//$state_name = $this->state_model->get_value($city->state,'name');
				//$city->description = str_ireplace('[areacode]', $city->area_code, $city->description);
				//$city->description = str_ireplace('[phone]', $city->phone, $city->description);
				//$city->description = str_ireplace('[city]', $city->name, $city->description);
				//$city->description = str_ireplace('[term]', strtoupper($city->state), $city->description);
				//$city->description = str_ireplace('[state]', $state_name, $city->description);
			}
		}
		$default_city = ucwords(get_option('default_city'));
		$default_state_name = strtoupper(get_option('default_state_abbr'));
		$title = $zipcode.' | '.$default_city.' '.$default_state_name;
		$this->app->set_cdata('title',$title);
		$this->app->set_cdata('raw',$city);
		$this->template->render('zip-code');
	}



	public function _load_city(){

	    $state_abbr = $this->uri->segment(1);

		$slug = $this->uri->segment(2);

		$city = $this->city_model->get($slug,array('key_by'=>'slug','filter_by'=>"state=>$state_abbr"));


		$this->app->set_cdata('city',$city);

	    $state_name = $this->state_model->get_value($city->state,'name');


		$city->description = str_ireplace('[areacode]', $city->area_code, $city->description);

		$city->description = str_ireplace('[phone]', $city->phone, $city->description);

		$city->description = str_ireplace('[city]', $city->name, $city->description);

		$city->description = str_ireplace('[term]', strtoupper($city->state), $city->description);

		$city->description = str_ireplace('[state]', strtoupper($city->state), $city->description);

		$this->app->set_cdata('raw',$city);

		$this->app->set_cdata('content',$city->description);

		$this->app->set_cdata('header',$city->name);


		$format = $this->config_model->get('city_title_format');

		$title = str_replace('%site_title%',$this->config_model->get('site_title'),$format);

		$title = str_replace('%city_name%',$city->name,$title);

		$title = str_replace('%state_abbr%',strtoupper($city->state),$title);

		$this->app->set_cdata('title',$title);

		$this->template->render($this->config_model->get('city_page_layout'));

	}



	public function _load_city_xx(){ //use this city pages for hierarchy url domain.com/state/city

 		$this->load->model('city_model');

	    $state_abbr = $this->uri->segment(1);

		$slug = $this->uri->segment(2);

		$city = $this->city_model->get($slug,array('key_by'=>'slug'));



		$this->app->set_cdata('city',$city);

	   	$state_name = $this->state_model->get_value($city->state,'name');

		$this->app->set_cdata('isLocationCovered',TRUE);

		$city->description = str_ireplace('[areacode]', $city->area_code, $city->description);

		$city->description = str_ireplace('[phone]', $city->phone, $city->description);

		$city->description = str_ireplace('[city]', $city->name, $city->description);

		$city->description = str_ireplace('[term]', strtoupper($city->state), $city->description);

		$city->description = str_ireplace('[state]', strtoupper($city->state), $city->description);



		$this->app->set_cdata('raw',$city);

		$this->app->set_cdata('content',$city->description);

		$this->app->set_cdata('header',$city->name);



		$format = $this->config_model->get('city_title_format');

		$title = str_replace('%site_title%',$this->config_model->get('site_title'),$format);

		$title = str_replace('%city_name%',$city->name,$title);

		$title = str_replace('%state_abbr%',strtoupper($city->state),$title);

		$this->app->set_cdata('title',$title);

		$this->template->render($this->config_model->get('city_page_layout'));

	}

	public function _load_search(){

		$this->load->library('search');

		$query = isset($_GET['location'])?$_GET['location']:"";

		if($query){

			$res = $this->search->query($query);

			if($res){

				$this->load->model('state_model');

				foreach($res as $city){

					$state_name = $this->state_model->get_value($city->state,'name');

					$city->description = str_ireplace('[areacode]', $city->area_code, $city->description);

					$city->description = str_ireplace('[phone]', $city->phone, $city->description);

					$city->description = str_ireplace('[city]', $city->name, $city->description);

					$city->description = str_ireplace('[term]', strtoupper($city->state), $city->description);

					$city->description = str_ireplace('[state]', $state_name, $city->description);

				}

			}

			

			$this->app->set_cdata('search_result',$res);

			$this->app->set_cdata('title',"Search: $query");

		}else{

			$this->app->set_cdata('search_result',"");

			$this->app->set_cdata('title',"Search: ");

		}

		

		$this->template->render('search');

	}

	

	public function _load_page_not_found(){

		$this->app->set_cdata('raw','');
		$this->app->set_cdata('title','');
		$this->template->render($this->config_model->get('page_not_found'));

	}

	public function suggest() {

		$this->load->model('city_model');

		$city_data = $this->city_model->get_cities();
		
		$result = array();

		foreach($city_data as $city) {

			$result[] = $city->name.', '.strtoupper($city->state);

		}

		$json_data = json_encode($result);

		print_r($json_data);

		//$this->template->render('search');

	}


		// public function contactProcess() {

		// 	$mdata = $this->input->post();
		// 	//$gr_data = gr_keys();
		// 	$site_key = '6LeiYEwUAAAAAJBpnO6IlN3GC2Mvv9v2uVT_zeWh';
		// 	$secret_key = '6LeiYEwUAAAAAGHGhCUtZrR7SJ5f9u14AyOoL0xD';
		// 	$site_verify = 'https://www.google.com/recaptcha/api/siteverify?secret='.$secret_key.'&response='.$mdata['g-recaptcha-response'].'&remoteip='.$_SERVER['REMOTE_ADDR'];
		// 	$response = file_get_contents($site_verify);
		// 	$g_response = json_decode($response);

		// 	if($g_response->success == 1) {

		// 		//$emailConfig = mail_config();

		//         $from = array(
		//             'email' => $mdata['email'],
		//             'name' => strtoupper($mdata['name']).' - '.'TESTING ONLY'.' Contact Us'
		//         );
		       
		//         // $to = array($mdata['email']);
		//         $to = 'marketing@aluckylock.com';
		//         $subject = $mdata['subject'];
		//       	$message = $mdata['message'];
		//         $this->load->library('email');
		//         $this->email->set_newline("\r\n");
		//         $this->email->from($from['email'], $from['name']);
		//         $this->email->to($to);
		//         $this->email->subject($subject);
		//         $this->email->message($message);
		//         if (!$this->email->send()) {
		//             $response = json_encode(array('result' => 'error', 'message' => 'Oops! Please try again later.'));
		//         } else {
		//             $response = json_encode(array('result' => 'success', 'message' => 'Message successfully sent!'));
		//         }

		// 	} else {
		// 		$response = json_encode(array('result' => 'error', 'message' => 'Invalid Captcha!'));
		// 	}

	 //        echo $response;

		// }    


}