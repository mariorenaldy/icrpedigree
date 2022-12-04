<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {
		private $navigations;
		public function __construct(){
				// Call the CI_Controller constructor
				parent::__construct();
        $this->load->model('contactModel');
				$this->load->model('caninesModel');
				$this->load->model('pedigreesModel');
				$this->load->model('profileModel');
				$this->load->model('sponsorModel');
				$this->canines = array();
				$this->load->model('productModel');
				// $this->load->model('employeeCredentialModel');
				$this->load->model('memberModel');
        $this->load->model('navigation');
        
				$this->navigations = $this->navigation->get_navigation();
		}

		public function index(){
      $session = self::_is_logged_in();
      if($session) {
        redirect('frontend/beranda');
      }else {
        $product = $this->productModel->get_products()->result();
        $data['products'] = $product;
        $sponsor = $this->sponsorModel->get_sponsors()->result();
        $data['sponsors'] = $sponsor;
        $whereCont['con_id'] = 1;
        $contact = $this->contactModel->get_contacts($whereCont)->row_array();
        $data['contact'] = $contact;
        $wherePro['prof_id'] = 1;
        $profile = $this->profileModel->get_profiles($wherePro)->row();
        $data['profile'] = $profile;

        $data['content'] = 'login';
        $this->load->view("frontend/layout/page_layout", $data);
      }
    }

    public function login(){
			$session = self::_is_logged_in();
			if ($session) {
				redirect('index');
			}else{
				$data = $this->input->post(null, true);
        $where['members.mem_username'] = $data['username'];
        $member = $this->memberModel->get_members($where)->row_array();

        if (!$member){
          echo json_encode(array('data' => 'Maaf nama pengguna tidak terdaftar.'));
          return false;
        }

        if (!$member['mem_stat']){
          echo json_encode(array('data' => 'Masa berlaku member telah habis. Harap melakukan pembayaran'));
          return false;
        }

        if (!$member['mem_app_user']){
          echo json_encode(array('data' => 'Data member belum di-approve. Harap menghubungi customer service'));
          return false;
        }

        if (sha1($data['password']) != $member['mem_password']){
          echo json_encode(array('data' => 'Maaf kata sandi anda salah.'));
          return false;
        }

        unset($member['mem_password']);
        $data['password'] = sha1($data['password']);
        $this->session->set_userdata('member_data', $member);

				echo json_encode(array('data' => '1'));
			}


    }

		//  PHP Helper

		public function _is_user($where) {
      $user = $this->memberModel->get_members($where)->row_array();
      return isset($user);
		}

		public function _same_user($username) {
      $user = $this->memberModel->daftar_users($username)->row_array();
      return isset($user);
		}

		public function logout(){
				$this->session->unset_userdata('member_data');
				redirect('frontend/login');
		}

    private function _is_logged_in(){
        $user = $this->session->userdata('member_data');
        return isset($user);
    }
}
