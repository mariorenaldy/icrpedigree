<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Events extends CI_Controller {
  private $navigations;
  private $path_upload;
  public function __construct(){
    // Call the CI_Controller constructor
    parent::__construct();
    $this->load->library('bcrypt');
    $this->load->model('eventModel');
    $this->load->model('contactModel');
    $this->load->model('eventGaleryModel');
    $this->load->model('productModel');
    $this->load->model('sponsorModel');

    $this->load->model('profileModel');
    // $this->load->model('employeeCredentialModel');
    $this->load->model('navigation');

    $this->navigations = $this->navigation->get_navigation();
    $this->path_upload = 'uploads/coordinators/';

    $this->load->library('pagination');

    // $session = self::_is_logged_in();
    // if(!$session) redirect('mrbn-admin');
  }

  public function index($id=NULL){

    $config = array();
    $config["base_url"] = base_url() . "events/page/";
    $total_row = $this->eventModel->record_count();
    $config["total_rows"] = $total_row;
    $config["per_page"] = 3;
    $config['use_page_numbers'] = TRUE;
    $config['num_links'] = $total_row;
    // $config['cur_tag_open'] = '&nbsp;<a class="current">';
    // $config['cur_tag_close'] = '</a>';
    // $config['next_link'] = 'Next';
    // $config['prev_link'] = 'Previous';

    $config['full_tag_open'] = '<ul class="pagination pagination-sm">';
    $config['full_tag_close'] = '</ul><!--pagination-->';
    $config['first_link'] = '&laquo; First';
    $config['first_tag_open'] = '<li class="prev page">';
    $config['first_tag_close'] = '</li>';
    $config['last_link'] = 'Last &raquo;';
    $config['last_tag_open'] = '<li class="next page">';
    $config['last_tag_close'] = '</li>';
    $config['next_link'] = '>';
    $config['next_tag_open'] = '<li class="next page">';
    $config['next_tag_close'] = '</li>';
    $config['prev_link'] = '<';
    $config['prev_tag_open'] = '<li class="prev page">';
    $config['prev_tag_close'] = '</li>';
    $config['cur_tag_open'] = '<li class="active"><a href="">';
    $config['cur_tag_close'] = '</a></li>';
    $config['num_tag_open'] = '<li class="page">';
    $config['num_tag_close'] = '</li>';

    $this->pagination->initialize($config);

    $data["events"] = $this->eventModel->fetch_data($config["per_page"], $id*2)->result();

    $data["links"] = $this->pagination->create_links();

    // print_r($data['links']);
    $where['prof_id'] = 1;
    $profile = $this->profileModel->get_profiles($where)->row();
    $data['profile'] = $profile;
    // $event = $this->eventModel->get_events()->result();
    // $data['events'] = $event;

    $whereCont['con_id'] = 1;
    $contact = $this->contactModel->get_contacts($whereCont)->row_array();
    $data['contact'] = $contact;

    $sponsor = $this->sponsorModel->get_sponsors()->result();
    $data['sponsors'] = $sponsor;
    $product = $this->productModel->get_products()->result();
    $data['products'] = $product;
    // $data['pagination'] = $this->pagination->create_links();

    // ARTechnology
    $user = $this->session->userdata('member_data');
		$data['users'] = $user;
    // ARTechnology

    // print_r($data);
    $this->twig->display('front/events', $data);

  }

  public function page($id=NULL){

    $config = array();
    $config["base_url"] = base_url() . "events/page/";
    $total_row = $this->eventModel->record_count();
    $config["total_rows"] = $total_row;
    $config["per_page"] = 3;
    $config['use_page_numbers'] = TRUE;
    $config['num_links'] = $total_row;
    $config['full_tag_open'] = '<ul class="pagination pagination-sm">';
    $config['full_tag_close'] = '</ul><!--pagination-->';
    $config['first_link'] = '&laquo; First';
    $config['first_tag_open'] = '<li class="prev page">';
    $config['first_tag_close'] = '</li>';
    $config['last_link'] = 'Last &raquo;';
    $config['last_tag_open'] = '<li class="next page">';
    $config['last_tag_close'] = '</li>';
    $config['next_link'] = '>';
    $config['next_tag_open'] = '<li class="next page">';
    $config['next_tag_close'] = '</li>';
    $config['prev_link'] = '<';
    $config['prev_tag_open'] = '<li class="prev page">';
    $config['prev_tag_close'] = '</li>';
    $config['cur_tag_open'] = '<li class="active"><a href="">';
    $config['cur_tag_close'] = '</a></li>';
    $config['num_tag_open'] = '<li class="page">';
    $config['num_tag_close'] = '</li>';

    $this->pagination->initialize($config);

    $data["events"] = $this->eventModel->fetch_data($config["per_page"], $id)->result();
    $data["links"] = $this->pagination->create_links();


    $where['prof_id'] = 1;
    $profile = $this->profileModel->get_profiles($where)->row();
    $data['profile'] = $profile;
    // $event = $this->eventModel->get_events()->result();
    // $data['events'] = $event;

    $whereCont['con_id'] = 1;
    $contact = $this->contactModel->get_contacts($whereCont)->row_array();
    $data['contact'] = $contact;

    $sponsor = $this->sponsorModel->get_sponsors()->result();
    $data['sponsors'] = $sponsor;
    $product = $this->productModel->get_products()->result();
    $data['products'] = $product;
    // $data['pagination'] = $this->pagination->create_links();

    // ARTechnology
    $user = $this->session->userdata('member_data');
		$data['users'] = $user;
    // ARTechnology

    // print_r($data);
    $this->twig->display('front/events', $data);

  }

  public function albums($id = null){
    $where['prof_id'] = 1;
    $profile = $this->profileModel->get_profiles($where)->row();
    $data['profile'] = $profile;
    $user = $this->session->userdata('user_data');
    $data['users'] = $user;
    $data['navigations'] = $this->navigations;
    $whereGal['gal_event_id'] = $id;
    $galery = $this->eventGaleryModel->get_event_galleries($whereGal)->result();
    $data['galeries'] = $galery;
    $data['id']=$id;
    $product = $this->productModel->get_products()->result();
    $data['products'] = $product;
    $sponsor = $this->sponsorModel->get_sponsors()->result();
    $data['sponsors'] = $sponsor;
    // print_r($data);

    // ARTechnology
    $user = $this->session->userdata('member_data');
		$data['users'] = $user;
    // ARTechnology

    $this->twig->display('front/event_galery', $data);
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
