<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Notification extends CI_Controller {
		public function __construct(){
			// Call the CI_Controller constructor
			parent::__construct();
			$this->load->model('notification_model');
			$this->load->library(array('session'));
			$this->load->helper(array('url'));
			$this->load->database();
		}

		public function index(){
			$data['notif'] = $this->notification_model->get_by_mem_id($this->session->userdata('mem_id'));
			$this->load->view('frontend/notif', $data);
		}
}