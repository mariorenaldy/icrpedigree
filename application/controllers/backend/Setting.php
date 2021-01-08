<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Setting extends CI_Controller {
		private $navigations;
		public function __construct(){
				// Call the CI_Controller constructor
				parent::__construct();
				$this->load->model('settingModel');
				$this->load->model('navigation');
				$this->navigations = $this->navigation->get_navigation();

				$session = self::_is_logged_in();
        if(!$session) redirect('backend');
		}
		public function index(){
				$data['navigations'] = $this->navigations;
				$user = $this->session->userdata('user_data');
				$data['users'] = $user;
				if ($user['use_akses'] != 3) {
					$where['set_id'] = 1;
					$setting = $this->settingModel->get_settings($where)->row_array();
					$data['setting'] = $setting;
					$this->twig->display('backend/setting', $data);
				}else {
					redirect('backend/dashboard');
				}


		}

		public function update($id = null){
				// $data = $this->input->post(null, true);
				$data = array( $_POST['name'] => $_POST['value'] );
				$where['set_id'] = $id;
				$this->settingModel->update_settings($data, $where);
				// $data['notice_id'] = $id;
				// self::_is_write_log('update', $data, 'aris');
				echo json_encode(array('data' => '1'));
		}

		private function _is_logged_in(){
        $coordinator = $this->session->userdata('user_data');
        return isset($coordinator);
    }
}
