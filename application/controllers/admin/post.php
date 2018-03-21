<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Post extends CI_Controller {
		
	function __construct(){
		parent::__construct();
		$this->load->database();
		$this->load->library('session');
		
		if(!$this->db->table_exists('posts')){$this->_install_module();}
		
		$this->load->library('app');
		$this->load->library('admin/admin_template');
		$this->load->library('admin/auth');
		$this->load->model('config_model');
		$this->load->model('post_model');
		$this->load->helper('ckeditor');
		$this->load->library("pagination");
	}
	
	public function index(){
		$this->auth->check_login();
		
		/*
		 * Pagination
		 */
		$current_page = isset($_GET['per_page']) && $_GET['per_page']>0?$_GET['per_page']:1;
        $config["base_url"] = base_url(uri_string())."?";
        $config["total_rows"] = $this->post_model->count();
		
        $config["per_page"] = $this->config_model->get('record_per_page');
        $config['page_query_string'] = TRUE;
		$config['use_page_numbers'] = TRUE;
		$config['full_tag_open'] ="<ul class='pagination'>";
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
			'status'=>'publish,draft',
			'fields'=>'id, title, slug, created, category, status, updated'
			);
		$this->app->set_cdata('records_count',$config["total_rows"]);
		$this->app->set_cdata('records_pagingation',$this->pagination->create_links());
		
		$records = $this->post_model->get_all($options);
		$this->app->set_cdata("records",$records);
		$this->admin_template->render('post_list');
	}
	
	public function edit(){
		$this->auth->check_login();
		
		if($id=$this->uri->segment(4,0)){
			
			if(isset($_POST['submit'])){
				$data['status']=$_POST['status'];
				$data['title']=$_POST['title'];
				$data['slug']=$_POST['slug'];
				$data['layout']=$_POST['layout'];
				$data['content']=$_POST['content'];
				$data['meta_key']=$_POST['meta_keywords'];
				$data['meta_description']=$_POST['meta_description'];
				$data['meta_title']=$_POST['meta_title'];
				$data['updated']=date('Y-m-d H:i:s');
				$data['creator']=$_POST['creator'];
				$data['created']=$_POST['created_date']." ".$_POST['created_time'];
				
				if($this->post_model->update($id,$data)){
					$response = array(
						'type'=>'success',
						'message'=>'Success update'
					);
					$this->session->set_flashdata('message',$response);
					redirect(base_url('admin/post/edit/'.$id));
				}else{
					$response = array(
						'type'=>'alert',
						'message'=>'Failed update'
					);
					$this->session->set_flashdata('message',$response);
					redirect(base_url('admin/post/edit/'.$id));
				}
			}
			
			$this->_loadCKEditor();
			$record=$this->post_model->get($id);
			$this->app->set_cdata("record",$record);
			$this->admin_template->render('post_edit');
		}else{
			redirect(base_url('admin/post'));
		}
	}
	
	public function add(){
		$this->auth->check_login();
		
			if(isset($_POST['submit'])){
			$data['title']=$_POST['title'];
			$data['slug']=$_POST['slug'];
			$data['layout']=$_POST['layout'];
			$data['content']=$_POST['content'];
			$data['meta_key']=$_POST['meta_keywords'];
			$data['meta_description']=$_POST['meta_description'];
			$data['meta_title']=$_POST['meta_title'];
			$data['created']=date('Y-m-d H:i:s');
			$data['creator']=$_POST['creator'];
			
				if($id=$this->post_model->insert($data)){
					$response = array(
						'type'=>'success',
						'message'=>'Success adding post'
					);
					$this->session->set_flashdata('message',$response);
					redirect(base_url('admin/post/edit/'.$id));
				}else{
					$response = array(
						'type'=>'alert',
						'message'=>'Failed adding post'
					);
					$this->session->set_flashdata('message',$response);
					redirect(base_url('admin/post/add/'));
				}
			}
			
			$this->_loadCKEditor();
			$this->admin_template->render('post_add');
		
	}
	
	public function trash(){
		if($id=$this->uri->segment(4,0)){
			if($this->post_model->is_exists($id)){
				if($this->post_model->trash($id)){
					$response = array(
						'type'=>'success',
						'message'=>'Success delete'
					);
					$this->session->set_flashdata('message',$response);
					redirect(base_url('admin/post/'));
				}else{
					$response = array(
						'type'=>'alert',
						'message'=>'Failed delete'
					);
					$this->session->set_flashdata('message',$response);
					redirect(base_url('admin/post/'));
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
	
	public function _install_module(){
		$this->load->model('config_model');
		$config_item1 = "INSERT INTO `options`(`key`,`value`,`label`,`input_type`,`description`) VALUES ( 'default_post_layout','single-post','Default Post Layout','text',NULL);";
		$config_item2 = "INSERT INTO `options`(`key`,`value`,`label`,`input_type`,`description`) VALUES ( 'blog_list_page','blog-post','Blogs Pages','text',NULL);";
		$query = "CREATE TABLE `posts` (
			  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
			  `title` varchar(255) DEFAULT NULL,
			  `slug` varchar(255) DEFAULT NULL,
			  `content` text,
			  `layout` varchar(64) DEFAULT NULL,
			  `meta_key` varchar(255) DEFAULT NULL,
			  `meta_description` varchar(255) DEFAULT NULL,
			  `meta_title` varchar(255) DEFAULT NULL,
			  `created` datetime DEFAULT NULL,
			  `updated` datetime DEFAULT NULL,
			  `creator` int(10) unsigned NOT NULL DEFAULT '1' COMMENT 'user id',
			  `category` varchar(255) DEFAULT '0' COMMENT '0=general',
			  `status` tinyint(4) DEFAULT '1' COMMENT '1=publish, 2=draft, 3=trash',
			  `tags` text,
			  PRIMARY KEY (`id`)
			) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=latin1";
			
		if($this->db->query($query)){
			
			
			if(!$this->config_model->is_key_exists('default_post_layout')){
				$this->db->query($config_item1);
			}
			
			if(!$this->config_model->is_key_exists('blog_list_page')){
				$this->db->query($config_item2);
			}
			
			$response = array(
				'type'=>'success',
				'message'=>'Success installing Blog module.'
			);
			$this->session->set_flashdata('message',$response);
			redirect(base_url('admin/post'));
		}else{
			show_error('Some went wrong while installing Blog module. Please try again',500);
		}
	}
}