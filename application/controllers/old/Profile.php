<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Profile extends CI_Controller {
    private $navigations;
    private $path_upload;
    public function __construct(){
        // Call the CI_Controller constructor
        parent::__construct();
        $this->load->library('bcrypt');
        $this->load->model('profileModel');
        $this->load->model('contactModel');
        $this->load->model('managementModel');
        $this->load->model('navigation');
        $this->load->model('productModel');
        $this->load->model('sponsorModel');

        $this->navigations = $this->navigation->get_navigation();
        $this->path_upload = 'uploads/coordinators/';
        
        // $session = self::_is_logged_in();
        // if(!$session) redirect('mrbn-admin');
    }

    public function index(){
        $product = $this->productModel->get_products()->result();
        $data['products'] = $product;
        $where['prof_id'] = 1;
        $profile = $this->profileModel->get_profiles($where)->row();
        $data['profile'] = $profile;
        $whereCont['con_id'] = 1;
        $contact = $this->contactModel->get_contacts($whereCont)->row_array();
        $data['contact'] = $contact;
        $management = $this->managementModel->get_managements()->result();
        $data['managements'] = $management;
        $sponsor = $this->sponsorModel->get_sponsors()->result();
        $data['sponsors'] = $sponsor;

        // print_r($data);
        $this->twig->display('front/profile', $data);

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
