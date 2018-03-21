<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class States extends CI_Controller {
		
	function __construct(){
		parent::__construct();
		$this->load->database();
		$this->load->library('session');
		$this->load->library('app');
		$this->load->library('admin/admin_template');
		$this->load->library('admin/auth');
		$this->load->model('config_model');
		$this->load->model('state_model');
		$this->load->model('city_model');
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
        $config["total_rows"] = $this->state_model->count();
		
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
			);
		$states = $this->state_model->get_all($options);
		
		$this->app->set_cdata('states',$states);
		$this->app->set_cdata('states_count',$config["total_rows"]);
		$this->app->set_cdata('state_pagingation',$this->pagination->create_links());
		
		$this->admin_template->render('states_list');
	}
	
	public function edit(){
		$this->auth->check_login();
		
		if($id=$this->uri->segment(4,0)){
			
			if(isset($_POST['submit'])){
				$data['name']=$_POST['name'];
				$data['content']=$_POST['content'];
				$data['slug']=$_POST['slug'];
				
				if($this->state_model->update($id,$data)){
					$response = array(
						'type'=>'success',
						'message'=>'Success update'
					);
					$this->session->set_flashdata('message',$response);
					redirect(base_url('admin/states/edit/'.$id));
				}else{
					$response = array(
						'type'=>'alert',
						'message'=>'Failed update'
					);
					$this->session->set_flashdata('message',$response);
					redirect(base_url('admin/states/edit/'.$id));
				}
			}
			
			$this->_loadCKEditor();
			$state=$this->state_model->get($id);
			$this->app->set_cdata("state_data",$state);
			$this->admin_template->render('state_edit');
		}else{
			redirect(base_url('admin/states'));
		}
	}
	
	public function add(){
		$this->auth->check_login();
		
			if(isset($_POST['submit'])){
					
				if(!$this->state_model->is_exists($_POST['abbr'])){
					$data['name']=$_POST['name'];
					$data['abbr']=$_POST['abbr'];
					$data['content']=$_POST['content'];
					$data['slug']=$_POST['slug'];
					
					if($this->state_model->insert($data)){
						$response = array(
							'type'=>'success',
							'message'=>'Success adding state'
						);
						$this->session->set_flashdata('message',$response);
						redirect(base_url('admin/states/edit/'.$data['abbr']));
					}else{
						$response = array(
							'type'=>'alert',
							'message'=>'Failed adding state'
						);
						$this->session->set_flashdata('message',$response);
						redirect(base_url('admin/states/add/'));
					}
				}else{
					//abbr already exist..
					$response = array(
							'type'=>'alert',
							'message'=>'Failed adding state. '.$_POST['abbr'].' Already exists'
						);
					$this->session->set_flashdata('message',$response);
					redirect(base_url('admin/states/add/'));
				}

			}
			$this->_loadCKEditor();
			$this->admin_template->render('state_add');
		
	}
	
	public function trash(){
		if($id=$this->uri->segment(4,0)){
			if($this->state_model->is_exists($id)){
				if($this->state_model->trash($id)){
					$response = array(
						'type'=>'success',
						'message'=>'Success Deleting State'
					);
					$this->session->set_flashdata('message',$response);
					redirect(base_url('admin/states/'));
				}else{
					$response = array(
						'type'=>'alert',
						'message'=>'Failed delete'
					);
					$this->session->set_flashdata('message',$response);
					redirect(base_url('admin/states/'));
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
	
	public function truncate(){
		if($this->state_model->truncate()){
			$response = array(
				'type'=>'success',
				'message'=>'Success Deleting all records'
			);
			$this->session->set_flashdata('message',$response);
			redirect(base_url('admin/states/'));
		}else{
			
		}
	}
}