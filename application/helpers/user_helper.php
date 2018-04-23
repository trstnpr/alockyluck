<?php
    function dump($data) {
        echo '<pre>';
        print_r($data);
        echo '</pre>';
    }
    function truncate($str, $width) {
        return strtok(wordwrap(strip_tags($str), $width, "...\n"), "\n");
    }
    function datetime_now() {
        return date('Y-m-d H:i:s');
    }
    function date_proper($data) {
        $date = date_create($data);
        return date_format($date, 'M d, Y');
    }
    function set_upload_options($file_path) {
        $config = array();
        $config ['upload_path'] = $file_path;
        $config ['allowed_types'] = 'jpg|png';
        return $config;
    }
    function appMailer($data) {
        $app =& get_instance();
        $app->load->library('email');

        /* Local Email Function -- Remove this when uploaded on live site */
        $config['protocol'] = 'smtp';
        $config['smtp_host'] = 'ssl://smtp.gmail.com';
        $config['smtp_port'] = '465';
        $config['smtp_user'] = 'webtestpurpose@gmail.com';
        $config['smtp_pass'] = 'lock001156058';
        /* Local Email Function -- Remove this when uploaded on live site */
        // $config['protocol'] = 'sendmail';
        $config['mailpath'] = '/usr/sbin/sendmail';
        $config['charset'] = 'iso-8859-1';
        $config['mailtype'] = 'html';
        $config['wordwrap'] = TRUE;
        $app->email->initialize($config);

        $app->email->set_newline("\r\n");
        $app->email->from('no-reply@aluckylock.com', 'Aluckylock');
        $app->email->to($data['email']);
        $app->email->subject($data['subject']);
        $app->email->message($data['message']);

        if($app->email->send()) {
            return TRUE;
        } else {
            return FALSE;
        }
    }
    function prev_page() {
        $app =& get_instance();
        $app->load->library('user_agent');
        if($app->agent->is_referral()) {
            return $app->agent->referrer();
        } else {
            return FALSE;
        }
    }
    function get_user_info() {
        $app =& get_instance();
        $app->load->library('user/auth');
        $app->load->model('user_model');
        $user_id = $app->auth->session_user_id();
        if($user_data = $app->user_model->get_user($user_id)) {
            return $user_data;
        } else {
            return FALSE;
        }
    }
    // Signup to api
    function signupAPI($data) {
        $app =& get_instance();
        $req = array(
            'first_name' => $data['first_name'],
            'last_name' => $data['last_name'],
            'email' => $data['email'],
            'phone' => $data['phone'],
            'password' => $data['password']
        );
        // $req = $data;
        try {
            $res = $app->jao->signupJAO($req);
            if(isset($res['status']) and $res['status'] == 200) {
                $result = $res['body'];
                if($result->status->status_code == 1) {
                    $response = array(
                        'status' => 1,
                        'message' => $result->message
                    );
                } else {
                    $response = array(
                        'status' => 0,
                        'message' => $result->message
                    );
                }
            } else {
                $response = array(
                    'status' => 0,
                    'message' => 'Sorry! We can\'t your application at the moment.'
                );
            }
        } catch(\Exception $e) {
            $response = array(
                'status' => 0,
                'message' => 'Sorry! We can\'t process your application at the moment.'
            );
        }
        return $response;
    }
    // Check jao download and signup
    function check_signinAPI($phone) {
        $app =& get_instance();
        try {
            $res = $app->jao->is_signedinJAO($phone);
            if(isset($res['status']) and $res['status'] == 200) {
                $result = $res['body'];
                if($result->status->status_code == 1) {
                    $response = array(
                        'status' => 1,
                        'message' => $result->message
                    );
                } else {
                    $response = array(
                        'status' => 0,
                        'message' => 'Please download and login to JAO'
                    );
                }
            } else {
                $response = array(
                    'status' => 0,
                    'message' => 'Service is not available at the moment.'
                );
            }
        } catch(\Exception $e) {
            $response = array(
                'status' => 0,
                'message' => 'Data are not available at the moment.'
            );
        }
        return $response;
    }
    // Get Trip History
    function tripsAPI($phone) {
        $app =& get_instance();
        try {
            $res = $app->jao->tripsJAO($phone);
            if(isset($res['status']) and $res['status'] == 200) {
                $result = $res['body'];
                if($result->status->status_code == 1) {
                    $response = array(
                        'status' => 1,
                        'message' => $result->message,
                        'data' => $result->data
                    );
                } else {
                    $response = array(
                        'status' => 0,
                        'message' => $result->message
                    );
                }
            } else {
                $response = array(
                    'status' => 0,
                    'message' => 'Data are not available at the moment.'
                );
            }
        } catch(\Exception $e) {
            $response = array(
                'status' => 0,
                'message' => 'Data are not available at the moment.'
            );
        }
        return $response;
    }

    // Get User JAO Profile Info
    function profileAPI($phone) {
        $app =& get_instance();
        try {
            $res = $app->jao->profileJAO($phone);
            if(isset($res['status']) and $res['status'] == 200) {
                $result = $res['body'];
                if($result->status->status_code == 1) {
                    $response = array(
                        'status' => 1,
                        'message' => $result->message,
                        'data' => $result->data
                    );
                } else {
                    $response = array(
                        'status' => 0,
                        'message' => $result->message
                    );
                }
            } else {
                $response = array(
                    'status' => 0,
                    'message' => 'Data are not available at the moment.'
                );
            }
        } catch(\Exception $e) {
            $response = array(
                'status' => 0,
                'message' => 'Data are not available at the moment.'
            );
        }
        return $response;
    }

    // Gravatar
    function get_gravatar( $email, $s = 500, $d = 'mm', $r = 'g', $img = false, $atts = array() ) {
        $url = 'https://www.gravatar.com/avatar/';
        $url .= md5( strtolower( trim( $email ) ) );
        $url .= "?s=$s&d=$d&r=$r";
        if ( $img ) {
            $url = '<img src="' . $url . '"';
            foreach ( $atts as $key => $val )
                $url .= ' ' . $key . '="' . $val . '"';
            $url .= ' />';
        }
        return $url;
    }
    // Gravatar

    function generate_password_token($data) {
        return md5($data.strtotime('now'));
    }

    function send_recovery($data) {

        $that =& get_instance();
        $that->load->library('email');

        /* Local Email Function -- Remove this when uploaded on live site */
        // $config['protocol'] = 'smtp';
        // $config['smtp_host'] = 'ssl://smtp.gmail.com';
        // $config['smtp_port'] = '465';
        // $config['smtp_user'] = 'webtestpurpose@gmail.com';
        // $config['smtp_pass'] = 'lock001156058';
        // $config['mailtype'] = 'html';
        // $config['charset'] = 'iso-8859-1';
        // $config['wordwrap'] = TRUE;
        // $config['newline'] = "\r\n";
        // $that->email->initialize($config);
        /* Local Email Function -- Remove this when uploaded on live site */

        $body = '
            <a href="'.base_url().'" target="_blank">
                <img src="'.theme_uri('images/logo-inner-scrolled.png').'" alt="12Local" title="12Local" width="30%" />
            </a>
            <br/>
            Hello User,
            <br/>
            <p>We are sorry to know that you are unable access you account.</p>
            <p>Therefore, we provide you this account recovery that you can <a href="'.$data['recovery'].'" target="_blank">click</a> to recover your account.</p>
            <br/>
            <p>Or you can copy the below address to your browser</p>
            <br/>
            <p>'.$data['recovery'].'</p>
            <br/>
            <br/>
            <p>Regards,</p>
            <p>12Local Team</p>
        ';

        $that->email->set_mailtype('html');
        $that->email->from('recovery@12local.com', '12Local Team');
        $that->email->to($data['email']);
        $that->email->subject('Password Recovery');
        $that->email->message($body);

        if($that->email->send()) {
            return TRUE;
        } else {
            return FALSE;
        }

    }