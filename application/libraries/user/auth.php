<?php 

	defined('BASEPATH') OR exit('No direct script access allowed');

	class auth {

		protected $app;

	    public function __construct() {
	        $this->app =& get_instance();
			$this->app->load->library('session');
			$this->app->load->model('user_model');
			$this->app->load->model('role_model');
	    }
		
		public function login_user($email, $pass) {
			$password = md5($pass);
			if($this->app->user_model->resolve_user_login($email, $password)) {
				$user_id = $this->app->user_model->get_user_id_from_email($email);
	            $user = $this->app->user_model->get_user($user_id);
	            $user_data = array(
	            	'id' => $user->id,
	            	'email' => $user->email,
	            	'phone' => $user->phone,
	            	'password' => $user->password,
	            );
	            $session = array(
	            	'role' => $user->role,
	            	'logged_in' => true,
	            	'user_data' => $user_data
	            );
	            $this->app->session->set_userdata($session);
	            return TRUE;
			} else {
				return FALSE;
			}
		}
		
		public function check_user() {
			$sess_role = $this->app->session->userdata('role');
			$sess_status = $this->app->session->userdata('logged_in');
			if($this->app->role_model->get_user_from_role($sess_role) and $sess_status) {
				return TRUE;
			} else {
				redirect(base_url('user/signin'));
			}
		}

		public function check_user_offsess() {
			if(!$this->app->session->userdata('logged_in')) {
				return TRUE;
			} else {
				redirect('user/overview');
			}
		}

		public function session() {
			return $this->app->session->all_userdata();
		}

		public function session_data() {
			return $this->app->session->userdata('user_data');
		}

		public function session_user_id() {
			return $this->app->session->userdata('user_data')['id'];
		}
	}