<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends CI_Controller {
    private $navigations;
    private $path_upload;
    public function __construct(){
        // Call the CI_Controller constructor
        parent::__construct();
        $this->load->library('bcrypt');
				$this->load->model('employeeModel');
        $this->load->model('employeeCredentialModel');
        $this->load->model('navigation');

        $this->navigations = $this->navigation->get_navigation();
        $this->path_upload = 'uploads/coordinators/';
        //
        // $session = self::_is_logged_in();
        // if(!$session) redirect('mrbn-admin');
    }

    public function index(){

    }

    public function auth(){
        $data = $this->input->post(null, true);
        $where['silp_employees.emp_email'] = $data['email'];
        $admin = $this->employeeCredentialModel->get_credentials($where)->row_array();

        if (!$admin){
          echo json_encode(array('data' => 'Maaf email Anda tidak terdaftar.'));
          return false;
        }

        if (!$this->bcrypt->check_password($data['password'], $admin['crd_password'])){
          echo json_encode(array('data' => 'Maaf kata sandi anda salah.'));
          return false;
        }

        unset($admin['crd_password']);
        $data['password'] = $this->bcrypt->hash_password($data['password']);
        $this->session->set_userdata('user_data_administrasi', $admin);
        self::_is_write_log('login', $data, $admin['emp_email']);

        $user = $this->session->userdata('user_data_administrasi');
        // $whereId['emp_id'] = $user['emp_id'];

        $emp_nip = $user['emp_nip'];
        $emp_full_name = $user['emp_full_name'];
        $emp_nick_name = $user['emp_nick_name'];
        $emp_email = $user['emp_email'];

        if ($emp_nip != null && $emp_full_name != null && $emp_nick_name != null && $emp_email != null ) {
            echo json_encode(array('data' => '1'));
        }else{
            echo json_encode(array('data' => '2'));
        }


    }
		public function profile(){
				$session = self::_is_logged_in();
				if(!$session) redirect('');

				$data['navigations'] = $this->navigations;
				$session = $this->session->userdata('user_data_administrasi');
				$user = $this->session->userdata('user_data_administrasi');
        $data['sess'] = $this->session->userdata('user_data_administrasi');
				$whereId['emp_id'] = $user['emp_id'];

				$data['employee'] =  $this->employeeModel->get_employees($whereId)->row();
				// print_r($data);
				$this->twig->display('administration/profile', $data);
		}

		public function update_password(){
				$data = $this->input->post(null, true);
				$where['crd_email'] = $data['email'];
				$data_crd = $this->employeeCredentialModel->get_credentials($where)->row_array();

				if (!$this->bcrypt->check_password($data['old_password'], $data_crd['crd_password'])){
					echo json_encode(array('data' => 'The old password you entered is incorrect. Please enter again.'));
					return false;
				}

				$data_credential['crd_password'] = $this->bcrypt->hash_password($data['new_password']);
				$this->employeeCredentialModel->update_credential($data_credential, $where);
				$data_credential['crd_email'] = $data['email'];
				self::_is_write_log('update', $data_credential, 'aris');
				echo json_encode(array('data' => '1'));
		}

    public function logout(){
        // $this->session->sess_destroy();
        $this->session->unset_userdata('user_data_administrasi');
        redirect('');
    }

    public function gen_pass(){
      $rand = substr(uniqid('', true), -5);
      return $rand;
    }

    private function _is_logged_in(){
        $coordinator = $this->session->userdata('user_data_administrasi');
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
