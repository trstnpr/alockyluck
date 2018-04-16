<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

	class User extends CI_Controller {

		public function __construct(){
			parent::__construct();
			$this->load->database();
			$this->load->library('session');
			$this->load->helper('user');

			$this->load->model('user_model');
			$this->load->library('upload');
			$this->load->library('email');
			$this->load->library('session');
			$this->load->model('role_model');
			$this->load->library('user/auth');
			$this->load->library('user_agent');
			$this->load->library('api/jao');
		}

		public function index() {
			if($segment = $this->uri->segment(2,0)) {
				if($segment == 'signup') {
					$this->_signup();
				} else if($segment == 'signin') {
					$this->_signin();
				} else if($segment == 'signout') {
					$this->_signout();
				} else if($segment == 'overview') {
					$this->_user_overview();
				} else if($segment == 'jao') {
					$this->_user_jao();
				} else if($segment == 'my-account') {
					$this->_user_my_account();
				} else if($segment == 'password-management') {
					$this->_user_password_management();
				} else if($segment == 'test') {
					$this->_user_tester();
				} else {
					show_404();
				}
			} else {
				redirect('user/signin');
			}
		}
		public function _signup($page = 'signup') {
			$this->auth->check_user_offsess();
			if($req = $this->input->post()) {
				if(!empty($_FILES['license'])) {
					$date = date('Y');
					$file_path = './uploads/user/'.$date.'/';
                    $licence_path = array();
			        $files = $_FILES;
			        $cpt = count($_FILES['license']['name']);
			        for ($i = 0; $i < $cpt; $i ++) {
			            $name = time().$files ['license'] ['name'] [$i];
			            $_FILES['license']['name'] = $name;
			            $_FILES['license']['type'] = $files['license']['type'][$i];
			            $_FILES['license']['tmp_name'] = $files['license']['tmp_name'][$i];
			            $_FILES['license']['error'] = $files['license']['error'][$i];
			            $_FILES['license']['size'] = $files['license']['size'][$i];
			            $this->upload->initialize(set_upload_options($file_path));
			            if(!($this->upload->do_upload('license')) OR $files['license']['error'][$i] != 0) {
			                print_r($this->upload->display_errors());
			            } else {
			                $licence_path[] = $file_path.$name;
			            }
			        }
			        $license = serialize($licence_path);
				} else {
					$license = NULL;
				}
				$req['documents'] = $license;
				$req['role'] = 2;
				// Set mailing
				$mail = array(
					'email' => $req['email'],
					'name' => $req['first_name'].' '.$req['last_name'],
					'subject' => 'Signup Request',
					'message' => 'This is the message'
				);

				if(!$this->user_model->email_check($req['email'])) {
					$reqAPI = signupAPI($req);
					if(isset($reqAPI) AND $reqAPI['status'] == 1) {
						if($this->user_model->add_user($req) AND appMailer($mail)) {
							$response = json_encode(array('result' => 'success', 'alert' => 'Done! Successfully signed up', 'message' => 'Thank you for signing up. We will review your informations and email you back asap.'));
						} else {
							$response = json_encode(array('result' => 'error', 'alert' => 'oops! Something went wrong', 'message' => 'Sorry we are unable to process you registration at the moment.'));
						}
					} else {
						$response = json_encode(array('result' => 'error', 'alert' => 'oops! Something went wrong', 'message' => $reqAPI['message']));
					}
				} else {
					$response = json_encode(array('result' => 'error', 'alert' => 'Wait! Email is unavailable', 'message' => 'Sorry, "'.$req['email'].'" is already in used.'));
				}
				echo $response;
			} else {
				// Meta
				$data['page'] = $page;
				$data['title'] = 'Sign Up';
				$data['meta_title'] = $data['title'];
				$data['meta_keywords'] = '';
				$data['meta_description'] = '';
				
				$this->load->view('user/templates/_header', $data);
				$this->load->view('user/'.$page, $data);
				$this->load->view('user/templates/_footer', $data);
			}
		}
		public function _signin($page = 'signin') {
			$this->auth->check_user_offsess();
			if($this->input->post()) {
				$this->_signin_process();
			} else {
				// Meta
				$data['page'] = $page;	
				$data['title'] = 'Sign In';
				$data['meta_title'] = $data['title'];
				$data['meta_keywords'] = '';
				$data['meta_description'] = '';

				$this->load->view('user/templates/_header', $data);
				$this->load->view('user/'.$page, $data);
				$this->load->view('user/templates/_footer', $data);
			}
		}
		public function _signin_process() {
			$request = $this->input->post();
            if($this->auth->login_user($request['email'], $request['password'])) {
                $response = json_encode(array('result' => 'success', 'redirect' => base_url('user/overview')));
            } else {
                $response = json_encode(array('result' => 'error', 'alert' => 'Oops! Something went wrong', 'message' => 'Invalid credentials'));
            }
            echo $response;
		}
		public function _signout() {
			$this->auth->check_user();
			$this->session->sess_destroy();
			redirect('user/signin');
		}
		public function _user_overview($page = 'overview') {
			$this->auth->check_user();
			// Meta
			$data['page'] = $page;	
			$data['title'] = 'Overview';
			$data['meta_title'] = $data['title'];
			$data['meta_keywords'] = '';
			$data['meta_description'] = '';

			$this->load->view('user/templates/_header_user', $data);
			$this->load->view('user/'.$page, $data);
			$this->load->view('user/templates/_footer_user', $data);
		}
		public function _user_jao() {
			$this->auth->check_user();
			if($segment = $this->uri->segment(3,0)) {
				if($segment == 'information') {
					$this->_user_jao_information();
				} else if($segment == 'trip-history') {
					$this->_user_jao_trip_history();
				} else if($segment == 'download') {
					$this->_user_jao_download();
				} else {
					show_404();
				}
			} else {
				show_404();
			}
		}
		public function _user_jao_information($page = 'jao-info') {
			$data['page'] = $page;	
			$data['title'] = 'JAO Information';
			$data['meta_title'] = $data['title'];
			$data['meta_keywords'] = '';
			$data['meta_description'] = '';
			$data['profile'] = profileAPI(get_user_info()->phone);

			$this->load->view('user/templates/_header_user', $data);
			$this->load->view('user/'.$page, $data);
			$this->load->view('user/templates/_footer_user', $data);
		}
		public function _user_jao_trip_history($page = 'jao-trip-history') {
			$data['page'] = $page;	
			$data['title'] = 'Trip History';
			$data['meta_title'] = $data['title'];
			$data['meta_keywords'] = '';
			$data['meta_description'] = '';
			$data['trips'] = tripsAPI(get_user_info()->phone);

			$this->load->view('user/templates/_header_user', $data);
			$this->load->view('user/'.$page, $data);
			$this->load->view('user/templates/_footer_user', $data);
		}
		public function _user_jao_download($page = 'jao-download') {
			redirect('https://play.google.com/store/apps/details?id=com.lookna.onmyway');
			// $data['page'] = $page;	
			// $data['title'] = 'Download JAO App!';
			// $data['meta_title'] = $data['title'];
			// $data['meta_keywords'] = '';
			// $data['meta_description'] = '';

			// $this->load->view('user/templates/_header_user', $data);
			// $this->load->view('user/'.$page, $data);
			// $this->load->view('user/templates/_footer_user', $data);
		}
		public function _user_my_account($page = 'my-account') {
			$this->auth->check_user();
			if($segment = $this->uri->segment(3,0)) {
				if($segment == 'edit') {
					$this->_user_my_account_edit();
				} else {
					show_404();
				}
			} else {
				// Meta
				$data['page'] = $page;	
				$data['title'] = 'My Account';
				$data['meta_title'] = $data['title'];
				$data['meta_keywords'] = '';
				$data['meta_description'] = '';

				$this->load->view('user/templates/_header_user', $data);
				$this->load->view('user/'.$page, $data);
				$this->load->view('user/templates/_footer_user', $data);
			}
		}
		public function _user_my_account_edit($page = 'edit-my-account') {
			if($req = $this->input->post()) {
				$sess_id = 5; // temporary
				if(!empty($_FILES['default_photo']['name'])) {
                    $date = date('Y');
                    $path = APPPATH.'../uploads/user/'.$date.'/';
                    if(!file_exists($path.$date)) {
                        mkdir($path.$date, 0777, true);
                    }
                    $config['upload_path'] = 'uploads/user/'.$date.'/';
                    $config['allowed_types'] = 'jpg|png';
                    $config['file_name'] = $_FILES['default_photo']['name'];
                    $this->load->library('upload',$config);
                    $this->upload->initialize($config);
                    if($this->upload->do_upload('default_photo')) {
                        $uploadData = $this->upload->data();
                        $default_photo = $uploadData['file_name'];
                        $photo_dir = $config['upload_path'].$default_photo;
                    } else {
                        $photo_dir = NULL;
                    }
                } else {
                    $photo_dir = NULL;
                }
                $req['default_photo'] = $photo_dir;

                if($this->user_model->update_user(get_user_info()->id, $req)) {
					$response = json_encode(array('result' => 'success', 'alert' => 'Done! Successfully updated', 'message' => 'Your information is updated.'));
				} else {
					$response = json_encode(array('result' => 'error', 'alert' => 'oops! Something went wrong', 'message' => 'Sorry we are unable to process your request at the moment.'));
				}
				echo $response;
			} else {
				// Meta
				$data['page'] = $page;	
				$data['title'] = 'Edit My Account';
				$data['meta_title'] = $data['title'];
				$data['meta_keywords'] = '';
				$data['meta_description'] = '';

				$this->load->view('user/templates/_header_user', $data);
				$this->load->view('user/'.$page, $data);
				$this->load->view('user/templates/_footer_user', $data);
			}
		}
		public function _user_password_management($page = 'password-management') {
			$this->auth->check_user();
			if($segment = $this->uri->segment(3,0)) {
				if($segment == 'change') {
					$this->_user_change_password();
				} else {
					show_404();
				}
			} else {
				// Meta
				$data['page'] = $page;	
				$data['title'] = 'Password Management';
				$data['meta_title'] = $data['title'];
				$data['meta_keywords'] = '';
				$data['meta_description'] = '';

				$this->load->view('user/templates/_header_user', $data);
				$this->load->view('user/'.$page, $data);
				$this->load->view('user/templates/_footer_user', $data);
			}
		}
		public function _user_change_password($page = 'change-password') {
			if($req = $this->input->post()) {
				if(md5($req['password']) == get_user_info()->password) {
					if($req['new_password'] == $req['confirm_password']) {
						$data['password'] = md5($req['new_password']);
						if($this->user_model->update_password(get_user_info()->id, $data)) {
							$response = json_encode(array('result' => 'success', 'alert' => 'Done! You will be signed out.', 'redirect' => base_url('user/signout')));
						} else {
							$response = json_encode(array('result' => 'error', 'alert' => 'Oops! Something went wrong', 'message' => 'Changing password is unavailable at the moment.'));
						}
					} else {
						$response = json_encode(array('result' => 'error', 'alert' => 'Oops! Something went wrong', 'message' => 'Password didn\'t match.'));
					}
				} else {
					$response = json_encode(array('result' => 'error', 'alert' => 'Oops! Something went wrong', 'message' => 'Incorrect password'));
				}
				echo $response;
			} else {
				// Meta
				$data['page'] = $page;	
				$data['title'] = 'Change Password';
				$data['meta_title'] = $data['title'];
				$data['meta_keywords'] = '';
				$data['meta_description'] = '';

				$this->load->view('user/templates/_header_user', $data);
				$this->load->view('user/'.$page, $data);
				$this->load->view('user/templates/_footer_user', $data);
			}
		}

		public function _user_tester() {
			if($segment = $this->uri->segment(3,0) and $segment == 'data') {
				$data = json_encode(array('users' => $this->user_model->get_users()));
				echo $data;
			} else {
				$this->load->view('user/test');
			}
		}
	}