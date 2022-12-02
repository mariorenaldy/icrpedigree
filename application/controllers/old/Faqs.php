<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Faqs extends CI_Controller {
		private $navigations;
		public function __construct(){
				// Call the CI_Controller constructor
				parent::__construct();
      	$this->load->model('testimonialModel');
				$this->load->model('navigation');
				$this->navigations = $this->navigation->get_navigation();

		}
		public function index(){
				$user = $this->session->userdata('user_data');
				$data['users'] = $user;
				$data['navigations'] = $this->navigations;
				$this->twig->display('backend/faqs', $data);
		}

    public function add(){

          $data = $this->input->post(null, true);
          $this->testimonialModel->add_testimonials($data);

          // self::_is_write_log('add', $data, 'aris');
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
