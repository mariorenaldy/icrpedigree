<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends CI_Controller {
		private $navigations;
		public function __construct(){
				// Call the CI_Controller constructor
				parent::__construct();
				$this->load->library('bcrypt');
				$this->load->model('userModel');
				$this->load->model('navigation');
				$this->navigations = $this->navigation->get_navigation();
		}

		public function index(){
			$session = self::_is_logged_in();
			if($session) {
					redirect('backend');
			}else{
				$data = $this->input->post(null, true);
        $where['users.use_username'] = $data['username'];
        $admin = $this->userModel->get_users($where)->row_array();

        if (!$admin){
          echo json_encode(array('data' => 'Maaf nama pengguna tidak terdaftar.'));
          return false;
        }

        if (!$this->bcrypt->check_password($data['password'], $admin['use_password'])){
          echo json_encode(array('data' => 'Maaf kata sandi anda salah.'));
          return false;
        }

        unset($admin['use_password']);
        $data['password'] = $this->bcrypt->hash_password($data['password']);
        $this->session->set_userdata('user_data', $admin);
        
        // self::_is_write_log('login', $data, $admin['emp_email']);

        $user = $this->session->userdata('user_data');

				// print_r($user);
        // $whereId['emp_id'] = $user['emp_id'];

        //echo json_encode(array('data' => $admin['use_username']));
      	echo json_encode(array('data' => '1'));
			}


    }

		//  PHP Helper

		public function _is_user($where) {
				$user = $this->userModel->get_users($where)->row_array();
				return isset($user);
		}

		public function _same_user($username) {
				$user = $this->userModel->daftar_users($username)->row_array();
				return isset($user);
		}

		public function logout(){
				// $this->session->sess_destroy();
				$this->session->unset_userdata('user_data');
				redirect('/backend');
		}

    private function _is_logged_in(){
        $user = $this->session->userdata('user_data');
        return isset($user);
    }

    private function _is_write_log($action, $description, $user){
        $data['log_action'] = $action;
        $data['log_description'] = json_encode($description);
        $data['log_user'] = $user;
        if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
            $ip = $_SERVER['HTTP_CLIENT_IP'];
        } elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
            $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
        } else {
            $ip = $_SERVER['REMOTE_ADDR'];
        }
        $data['log_ip'] = $ip;
        $data['log_browser'] = $_SERVER['HTTP_USER_AGENT'];

        $this->load->model('logModel');
        $this->logModel->add_log($data);
    }
}
