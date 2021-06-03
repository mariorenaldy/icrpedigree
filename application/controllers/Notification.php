<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Notification extends CI_Controller{
	private $navigations;
	public function __construct(){
		parent::__construct();
		$this->load->model(array('notification_model', 'navigation', 'productModel', 'contactModel', 'caninesModel', 'pedigreesModel', 'profileModel', 'sponsorModel', 'productModel'));
		$this->load->library(array('session', 'form_validation'));
		$this->load->helper(array('url'));
		$this->load->database();
		$this->navigations = $this->navigation->get_navigation();
		$session = self::_is_logged_in();
		if (!$session) 
			redirect('signin');
	}

	public function index(){
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

		$user = $this->session->userdata('member_data');
		$data['users'] = $user;

		$data['navigations'] = $this->navigations;

		$data['notif'] = $this->notification_model->get_members_notif();
		$this->twig->display('front/view_notif', $data);
	}

	private function _is_logged_in(){
        $coordinator = $this->session->userdata('member_data');
        return isset($coordinator);
	}
}
