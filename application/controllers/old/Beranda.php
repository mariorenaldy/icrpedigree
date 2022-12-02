<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Beranda extends CI_Controller {
    private $navigations;
    private $path_upload;
    public function __construct(){
        // Call the CI_Controller constructor
        parent::__construct();
        $this->load->library('bcrypt');
        $this->load->model('contactModel');
				$this->load->model('eventModel');
        $this->load->model('profileModel');
        $this->load->model('sponsorModel');
        $this->load->model('quoteModel');
        $this->load->model('productModel');
        $this->load->model('sponsorModel');
        $this->load->model('caninesModel');
        // $this->load->model('employeeCredentialModel');
        $this->load->model('navigation');

        $this->navigations = $this->navigation->get_navigation();

    }

    public function index(){
        $where['prof_id'] = 1;
        $profile = $this->profileModel->get_profiles($where)->row();
        $data['profile'] = $profile;

        $whereSpo['spo_type'] = 1;
        $sponsor = $this->sponsorModel->get_sponsors($whereSpo)->result();
        if ($sponsor) {
            $data['sponsorsPrimary'] = $sponsor;
        }


        $whereCont['con_id'] = 1;
        $contact = $this->contactModel->get_contacts($whereCont)->row_array();
        $data['contact'] = $contact;

        $event = $this->eventModel->get_event()->result();
        $data['event'] = $event;
        $data['winners'] = $this->caninesModel->get_champions()->result();
        $quote = $this->quoteModel->get_quotes()->result();
        $data['quote'] = $quote;
        $product = $this->productModel->get_products()->result();
        $data['products'] = $product;
        $sponsor = $this->sponsorModel->get_sponsors()->result();
        $data['sponsors'] = $sponsor;

        // ARTechnology
        $user = $this->session->userdata('member_data');
		$data['users'] = $user;
        // ARTechnology

        // print_r($data);
        $this->twig->display('front/beranda', $data);

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
