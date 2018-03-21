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

		

		$this->app->set_cdata('isLocationCovered',FALSE);

	}

	

	public function index(){



		$this->load->model('state_model');

		$this->load->model('city_model');

		$this->load->model('page_model');

		$this->load->model('post_model');

		$this->load->model('article_model');


		if($seg_one=$this->uri->segment(1,0)){

			if(is_numeric($seg_one) && strlen($seg_one)==5){

				$this->_load_city_zip();

			}
			if(($seg_one)=='tag'){

				//if($seg_two=$this->uri->segment(2,0)){
					//if ($this->article_model->is_exists($seg_two,'permalink')){
						$this->_load_tags();
					//}
				//}
				
				
			}elseif(($seg_one)=='category'){

				//if($seg_two=$this->uri->segment(2,0)){
					//if ($this->article_model->is_exists($seg_two,'permalink')){
						$this->_load_categories();
					//}
				//}
				
				
			}elseif(($seg_one)=='author'){

				//if($seg_two=$this->uri->segment(2,0)){
					//if ($this->article_model->is_exists($seg_two,'permalink')){
						$this->_load_author();
					//}
				//}
				
				
			}elseif ($this->article_model->is_exists($seg_one,'permalink')){
				$this->_load_permalink();
			}elseif($seg_one=='search'){

				$this->_load_search();

			}elseif($seg_one=='blog'){
				$this->_load_articles();

			}elseif($this->page_model->is_exists($seg_one,'slug')){
				$this->_load_page();

			}elseif($this->city_model->is_exists($seg_one,'slug')){

				

				$this->_load_city();

				/*

				 * if($seg_two=$this->uri->segment(2,0)){

					$this->_load_city();

				}else{

				   	$this->_load_state();

				}

				 */

			}elseif($this->post_model->is_exists($seg_one,'slug')){

				$this->_load_post();

			}else{

				$this->_load_page_not_found();

			}

		}else{

			$this->_load_frontpage();

		}

	}

	

	public function _serviceLocationCoverage(){

		

		

		



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

		

		

		//if(isset($location['region_code']) ){

		//	if(state_cities(strtolower($location['region_code']))){

				$this->app->set_cdata('isLocationCovered',TRUE);

		//	}

		//}

		

		

		$this->app->set_cdata('raw',$page);

		$this->app->set_cdata('content',$page->content);

		$this->app->set_cdata('header',$page->title);

		$this->app->set_cdata('title',$this->config_model->get('site_title'));

		$this->template->render($this->config_model->get('default_frontpage_layout'));

	}

	public function _load_articles(){
/*
		$this->load->model('post_model');

		$page_title = "Articles | ".$this->config_model->get('site_title');

		$this->app->set_cdata('title',$page_title);

		$this->template->render($this->config_model->get('blog_list_page'));*/
		$this->load->model('article_model');


		$articles = $this->article_model->get_all(array('status'=>'publish'));
		

		$permalink = $this->uri->segment(1);
		//$article = $this->article_model->get($permalink,array('key_by'=>'permalink'));
		$this->app->set_cdata('raw','');
		$this->app->set_cdata('articles',$articles);
		/*$this->app->set_cdata('page',$article);
		$this->app->set_cdata('content',$article->content);
		$this->app->set_cdata('header',$article->title);
		*/
		$this->app->set_cdata('title','Blogs | '.$this->config_model->get('site_title'));
		
		$this->template->render('blog');

	}
		public function _load_permalink() {

		$this->load->model('article_model');
		$permalink = $this->uri->segment(1);
		$article = $this->article_model->get($permalink,array('key_by'=>'permalink'));
		$this->app->set_cdata('raw',$article);
		$this->app->set_cdata('page',$article);
		$this->app->set_cdata('content',$article->content);
		$this->app->set_cdata('header',$article->title);

		$format = $this->config_model->get('page_title_format');
		$page_title = str_ireplace('%site_title%',$this->config_model->get('site_title'),$format);
		$page_title = str_ireplace('%page_title%',$article->title,$page_title);
		$this->app->set_cdata('title',$page_title);
/*
		$layout = !empty($page->layout)?$page->layout:$this->config_model->get('default_page_layout');*/
		$this->template->render('innerblog');
		}

/*
	public function _load_article(){
		
		$this->load->library('googlemaps');
		$this->googlemaps->initialize();
		$config['center'] = 'Porac, Pampanga';
		$config['zoom'] = 15;
		$this->googlemaps->initialize($config);
		$this->app->set_cdata('map', $this->googlemaps->create_map());
		

		$this->load->model('article_model');
		$permalink = $this->uri->segment(2);
		$article = $this->article_model->get($permalink,array('key_by'=>'permalink'));
		$this->app->set_cdata('raw',$article);
		$this->app->set_cdata('page',$article);
		$this->app->set_cdata('content',$article->content);
		$this->app->set_cdata('header',$article->title);
		
		$format = $this->config_model->get('page_title_format');
		$page_title = str_ireplace('%site_title%',$this->config_model->get('site_title'),$format);
		$page_title = str_ireplace('%page_title%',$article->title,$page_title);
		$this->app->set_cdata('title',$page_title);
		
		$layout = !empty($page->layout)?$page->layout:$this->config_model->get('default_page_layout');
		$this->template->render($layout);
	}*/

	public function _load_page(){

		$data['page'] = base_url('contact-us');

		$data['recaptcha_html'] = $this->recaptcha->recaptcha_get_html();

		$this->load->model('page_model');

		$this->app->set_cdata('isLocationCovered',TRUE);

		$pages = $this->page_model->get_all();

		

		$slug = $this->uri->segment(1);
		$data['page_type'] = $slug;

		$page = $this->page_model->get($slug,array('key_by'=>'slug'));

		$this->app->set_cdata('raw',$page);

		$this->app->set_cdata('page',$page);

		$this->app->set_cdata('content',$page->content);

		$this->app->set_cdata('header',$page->title);

		

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

	public function _load_tags(){
		$tag_name = $this->uri->segment(2);
		$articles = get_all_articles_with_tags($tag_name);
		

		//$this->db->select('*'); // Select field
		//$this->db->from('articles'); // from Table1
		
	
		//$this->db->join('categories','articles.id = categories.category','INNER'); // Join table1 with table2 based on the foreign key  cast(substring(t1.NAME, 3, 3) as int)
		/*$this->db->where('table1.col1',2);*/ // Set Filter
		//$result = $this->db->get();
		

		$this->app->set_cdata('articles',$articles);
		$this->app->set_cdata('raw','');
		$this->app->set_cdata('title', $tag_name.' | Tags');
		$this->template->render('tags');

	}
	public function _load_categories(){

		$this->load->model('category_model');

		$category = $this->uri->segment(2);

		$cat_id = $this->category_model->get_id_using_permalink($category);

		$articles = get_all_articles_with_categories($cat_id);
		$this->app->set_cdata('articles',$articles);
		$this->app->set_cdata('raw','');
		$this->app->set_cdata('title', $category.' | category');
		$this->template->render('tags');

	}
	public function _load_author(){
		$tag_name = $this->uri->segment(2);
		$articles = get_all_articles_with_author($tag_name);
		$this->app->set_cdata('articles',$articles);
		$this->app->set_cdata('raw','');
		$this->app->set_cdata('title', $tag_name.' | author');
		$this->template->render('tags');

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



	public function _load_city(){

 		$this->load->model('city_model');

	   //state_abbr = 'va';//$this->uri->segment(1);

		$slug = $this->uri->segment(1);

		$city = $this->city_model->get($slug,array('key_by'=>'slug'));



		$this->app->set_cdata('city',$city);

	   //state_name = 'va';//$this->state_model->get_value($city->state,'name');

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



	public function _load_city_xx(){//use this city pages for hierarchy url domain.com/state/city

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

	

	public function _load_city_zip(){

		$zip_code = $this->uri->segment(1,0);

		$cities = $this->city_model->get_by_zip_code($zip_code);

		

		if($cities){

			foreach($cities as $city){

				$state_name = $this->state_model->get_value($city->state,'name');

				$city->description = str_ireplace('[areacode]', $city->area_code, $city->description);

				$city->description = str_ireplace('[phone]', $city->phone, $city->description);

				$city->description = str_ireplace('[city]', $city->name, $city->description);

				$city->description = str_ireplace('[term]', strtoupper($city->state), $city->description);

				$city->description = str_ireplace('[state]', $state_name, $city->description);

			}

		}

		

		$this->app->set_cdata('raw',$cities);

		$this->template->render('template-zip-code-city');

	}

	

public function _load_search(){

		$this->load->library('search');
		$query = isset($_GET['q'])?$_GET['q']:"";
		$results = $this->page_model->search($query);

		if($results){
			$this->app->set_cdata('search_result',$results);
			$this->app->set_cdata('title'," Search Result For: $query");
		}else{

			$this->app->set_cdata('search_result',"");
			$this->app->set_cdata('title'," Search Result For: ");
		}	
/*
		

		

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
*/
		$this->app->set_cdata('raw','');

		$this->template->render('search');

	}
	

	public function _load_page_not_found(){

		$this->app->set_cdata('raw','');
		$this->app->set_cdata('title','');
		$this->template->render($this->config_model->get('page_not_found'));

	}

}