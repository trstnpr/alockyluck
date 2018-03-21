<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');



class Page extends CI_Controller {

		

	function __construct(){

		parent::__construct();

		$this->load->database();

		$this->load->library('session');

		$this->load->library('app');

		$this->load->library('admin/admin_template');

		$this->load->library('admin/auth');

		$this->load->model('config_model');

		$this->load->model('page_model');

		$this->load->model('article_model');

		$this->load->helper('ckeditor');

		

		

		

	}

	

	public function index(){

		$this->auth->check_login();

		$this->admin_template->render('page_list');

	}

	

	public function edit(){

		$this->auth->check_login();

		

		if($id=$this->uri->segment(4,0)){

			

			if(isset($_POST['submit'])){

				$data['title']=$_POST['title'];

				$data['slug']=$_POST['slug'];

				$data['layout']=$_POST['layout'];

				$data['content']=$_POST['content'];

				$data['meta_title']=$_POST['meta_title'];

				$data['meta_key']=$_POST['meta_keywords'];

				$data['meta_description']=$_POST['meta_description'];

				if($this->page_model->update($id,$data)){

					$response = array(

						'type'=>'success',

						'message'=>'Success update'

					);

					$this->session->set_flashdata('message',$response);

					redirect(base_url('admin/page/edit/'.$id));

				}else{

					$response = array(

						'type'=>'alert',

						'message'=>'Failed update'

					);

					$this->session->set_flashdata('message',$response);

					redirect(base_url('admin/page/edit/'.$id));

				}

			}

			

			$this->_loadCKEditor();

			$page=$this->page_model->get($id);

			$this->app->set_cdata("page_data",$page);

			$this->admin_template->render('page_edit');

		}else{

			redirect(base_url('admin/page'));

		}

	}

	

	public function add(){

		$this->auth->check_login();

		

			if(isset($_POST['submit'])){

			$data['title']=$_POST['title'];

			$data['slug']=$_POST['slug'];

			$data['layout']=$_POST['layout'];

			$data['content']=$_POST['content'];

			$data['meta_title']=$_POST['meta_title'];
			
			$data['meta_key']=$_POST['meta_keywords'];

			$data['meta_description']=$_POST['meta_description'];

				if($id=$this->page_model->insert($data)){

					$response = array(

						'type'=>'success',

						'message'=>'Success adding page'

					);

					$this->session->set_flashdata('message',$response);

					redirect(base_url('admin/page/edit/'.$id));

				}else{

					$response = array(

						'type'=>'alert',

						'message'=>'Failed adding page'

					);

					$this->session->set_flashdata('message',$response);

					redirect(base_url('admin/page/add/'));

				}

			}

			$this->_loadCKEditor();

			$this->admin_template->render('page_add');

		

	}

	

	public function trash(){

		if($id=$this->uri->segment(4,0)){

			if($this->page_model->is_exists($id)){

				if($this->page_model->trash($id)){

					$response = array(

						'type'=>'success',

						'message'=>'Success delete'

					);

					$this->session->set_flashdata('message',$response);

					redirect(base_url('admin/page/'));

				}else{

					$response = array(

						'type'=>'alert',

						'message'=>'Failed delete'

					);

					$this->session->set_flashdata('message',$response);

					redirect(base_url('admin/page/'));

				}

			}else{

				show_error('Record not exits',500);

			}

		}else{

			show_error('Url error.',404);

		}

	}

	

	function _loadCKEditor(){

		$this->load->library('CKEditor');

		$ckeditorpath = base_url().'assets/admin/plugins/ckeditor/';

		$this->ckeditor->basePath = $ckeditorpath;

		$this->ckeditor->config['width'] = '100%';

		$this->ckeditor->config['height'] = '300px';

	}

}