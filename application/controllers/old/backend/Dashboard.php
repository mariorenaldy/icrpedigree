<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {
		private $navigations;
		public function __construct(){
				// Call the CI_Controller constructor
				parent::__construct();
				$this->load->model('navigation');
				$this->load->model('dashboardModel');
				$this->navigations = $this->navigation->get_navigation();
				//
				// $session = self::_is_logged_in();
				// if(!$session) redirect('');
		}

		public function index(){
				// print_r($this->session->all_userdata());
				$session = self::_is_logged_in();
				//
				$data['navigations'] = $this->navigations;
				// $data['tes'] = 'Hello';
				// print_r($session);

				if($session) {
					$user = $this->session->userdata('user_data');
					$data['users'] = $user;
					// ARTechnology
					// $data['admin'] =  $this->dashboardModel->get_count_admin()->result();
					// $data['pegawai'] =$this->dashboardModel->get_count_pegawai()->result();
					$data['member'] =$this->dashboardModel->get_count_member();
					$data['stud'] =$this->dashboardModel->get_count_stud();
					$data['birth'] =$this->dashboardModel->get_count_birth();
					// ARTechnology
					$data['product'] =$this->dashboardModel->get_count_product();
					$data['event'] =$this->dashboardModel->get_count_event();
					$data['canine'] =$this->dashboardModel->get_count_canine();
					// print_r($data);
					$this->twig->display('backend/dashboard', $data);
				}else {
					$this->twig->display('login');

				}
		}


		private function _is_logged_in(){
		$coordinator = $this->session->userdata('user_data');
		return isset($coordinator);
    }
}
