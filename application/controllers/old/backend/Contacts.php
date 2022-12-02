<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Contacts extends CI_Controller {
		private $navigations;
		public function __construct(){
				// Call the CI_Controller constructor
				parent::__construct();

				$this->load->model('contactModel');
				$this->load->model('navigation');
				$this->navigations = $this->navigation->get_navigation();
				$session = self::_is_logged_in();
        if(!$session) redirect('backend');
		}
		public function index(){
				// $session = self::_is_logged_in();
				//
				$data['navigations'] = $this->navigations;
				$user = $this->session->userdata('user_data');
				$data['users'] = $user;
				if ($user['use_akses'] != 3) {
					$whereCont['con_id'] = 1;
				 	$contact = $this->contactModel->get_contacts($whereCont)->row_array();
					$data['contact'] = $contact;
					$this->twig->display('backend/contacts', $data);
        }else {
          redirect('backend/dashboard');
        }
		}

		public function update($id = null){
				// $data = $this->input->post(null, true);
				$data = array( $_POST['name'] => $_POST['value'] );
				$where['con_id'] = $id;
				$this->contactModel->update_contact($data, $where);
				// $data['notice_id'] = $id;
				// self::_is_write_log('update', $data, 'aris');
				echo json_encode(array('data' => '1'));
		}



    //  PHP Helper
        public function gen_pass(){
          $rand = substr(uniqid('', true), -5);
          return $rand;
        }

        private function _is_logged_in(){
            $coordinator = $this->session->userdata('user_data');
            return isset($coordinator);
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
