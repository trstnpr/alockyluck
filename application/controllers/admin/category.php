<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Category extends CI_Controller {
		
	function __construct(){
		parent::__construct();
		$this->load->database();
		$this->load->library('session');
		$this->load->library('app');
		$this->load->library('admin/admin_template');
		$this->load->library('admin/auth');
		$this->load->helper('ckeditor');
		$this->load->model('config_model');
		$this->load->model('category_model');
		
		
		
		$this->app->set_cdata('sidebar-navigation','main-navigation');
		$this->app->set_cdata('main-navigation','main-navigation');
		$this->app->set_cdata('top-navigation','top-navigation');
	}
	
	public function index(){
		$this->auth->check_login();
		$this->load->library("pagination");
		/*
		 * Pagination
		 */
		$current_page = isset($_GET['per_page']) && $_GET['per_page']>0?$_GET['per_page']:1;
        $config["base_url"] = base_url(uri_string())."?";
        $config["total_rows"] = $this->category_model->count(array('status'=>'publish,draft'));
		
        $config["per_page"] = $this->config_model->get('record_per_page');
        $config['page_query_string'] = TRUE;
		$config['use_page_numbers'] = TRUE;
		$config['full_tag_open'] ="<ul class='pagination align-right'>";
		$config['full_tag_close'] = "<ul>";
		
		$config['num_tag_open'] = '<li>';
		$config['num_tag_close'] = '</li>';
		
		$config['first_link'] = 'First &laquo';
		$config['first_tag_open'] = '<li class="arrow">';
		$config['first_tag_close'] = '</li>';
		
		$config['last_link'] = 'Last &raquo;';
		$config['last_tag_open'] = '<li class="arrow">';
		$config['last_tag_close'] = '</li>';
		
		$config['next_link'] = 'Next &rsaquo;';
		$config['next_tag_open'] = '<li>';
		$config['next_tag_close'] = '</li>';
		
		$config['prev_link'] = 'Prev &lsaquo;';
		$config['prev_tag_open'] = '<li>';
		$config['prev_tag_close'] = '</li>';
		
		$config['cur_tag_open'] = '<li class="current" ><a>';
		$config['cur_tag_close'] = '</a></li>';
		
		
        $this->pagination->initialize($config);
		$start_record = ($current_page-1)*$config['per_page'];
		
		$options=array(
			'limit'=>$config["per_page"],
			'start'=>$start_record,
			'status'=>'publish,draft'
			);
			
		$pages = $this->category_model->get_all();
		
		$this->app->set_cdata('pages',$pages);
		$this->app->set_cdata('pages_count',$config["total_rows"]);
		$this->app->set_cdata('pages_pagingation',$this->pagination->create_links());
		
		
		$this->admin_template->render('category_list');
	}
	
	public function edit(){
		$this->auth->check_login();
		
		if($id=$this->uri->segment(4,0)){
			
			if(isset($_POST['submit'])){
				
				$data['label']=$_POST['label'];
				$data['permalink']=$_POST['permalink'];
				$data['description']=$_POST['content'];

				if($this->category_model->update($id,$data)){
					$response = array(
						'type'=>'success',
						'message'=>'Success update'
					);
					$this->session->set_flashdata('message',$response);
					redirect(base_url('admin/category/edit/'.$id));
				}else{
					$response = array(
						'type'=>'alert',
						'message'=>'Failed update'
					);
					$this->session->set_flashdata('message',$response);
					redirect(base_url('admin/category/edit/'.$id));
				}
			}
			
			$this->_loadCKEditor();
			$page=$this->category_model->get($id);
			$this->app->set_cdata("category_data",$page);
			$this->admin_template->render('category_edit');
		}else{
			redirect(base_url('admin/category'));
		}
	}
	
	public function add(){
		$this->auth->check_login();
			
			if(isset($_POST['submit'])){
			$data['label']=$_POST['label'];
			$data['permalink']=$_POST['permalink'];
			$data['description']=$_POST['content'];
			
			$permalink=$_POST['permalink'];
			if(isset($permalink) AND !empty($permalink)) {
				$data['permalink']=$permalink;
			} else {
				$data['permalink']=slugify($data['label']);
			}
			

				if($id=$this->category_model->insert($data)){
					$response = array(
						'type'=>'success',
						'message'=>'Success adding category'
					);
					$this->session->set_flashdata('message',$response);
					redirect(base_url('admin/category/edit/'.$id));

				}else{
					$response = array(
						'type'=>'alert',
						'message'=>'Failed adding category'
					);
					$this->session->set_flashdata('message',$response);
					redirect(base_url('admin/category/add/'));
				}
			}
			$this->_loadCKEditor();
			$this->admin_template->render('category_add');
		
	}
	
	public function trash(){
		if($id=$this->uri->segment(4,0)){
			if($this->category_model->is_exists($id)){
				if($this->category_model->delete($id)){
					$response = array(
						'type'=>'success',
						'message'=>'Success delete'
					);
					$this->session->set_flashdata('message',$response);
					redirect(base_url('admin/category/'));
				}else{
					$response = array(
						'type'=>'alert',
						'message'=>'Failed delete'
					);
					$this->session->set_flashdata('message',$response);
					redirect(base_url('admin/category/'));
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































