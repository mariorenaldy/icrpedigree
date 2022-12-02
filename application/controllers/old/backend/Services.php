<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Services extends CI_Controller {
		private $navigations;
		public function __construct(){
				// Call the CI_Controller constructor
				parent::__construct();
				$this->load->model('serviceModel');
				$this->load->model('navigation');
				$this->navigations = $this->navigation->get_navigation();

				$session = self::_is_logged_in();
        if(!$session) redirect('backend');
		}

		public function index(){

				$user = $this->session->userdata('user_data');
				$data['users'] = $user;
				if ($user['use_akses'] != 3) {
					$data['navigations'] = $this->navigations;
					$whereStd['ser_id'] = 1;
					$service = $this->serviceModel->get_services($whereStd)->row_array();
					$data['service'] = $service;

					$this->twig->display('backend/service', $data);
				}else {
					redirect('backend/dashboard');
				}


		}

		public function update($id = null){
				// $data = $this->input->post(null, true);
				$ser_decs = addslashes($this->input->post('ser_desc'));
				$ser_reg_rule_ind = addslashes($this->input->post('rule_ind'));
				$ser_reg_rule_eng = addslashes($this->input->post('rule_eng'));
				$data = array(
	  			'ser_id'=>$id,
	  			'ser_desc'  => $ser_decs,
					'ser_reg_rule_ind' => $ser_reg_rule_ind,
					'ser_reg_rule_eng' => $ser_reg_rule_eng
	  			);
				// $data = array( $_POST['name'] => $_POST['value'] );
				$where['ser_id'] = $id;
				$this->serviceModel->update_services($data, $where);
				// $data['notice_id'] = $id;
				// self::_is_write_log('update', $data, 'aris');

				echo "<script>alert('Perubahan berhasil disimpan!!')</script>";

				redirect('/backend/services', 'refresh');

				// echo json_encode(array('data' => '1'));
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
