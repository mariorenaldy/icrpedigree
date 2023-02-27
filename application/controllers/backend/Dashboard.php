<?php
defined('BASEPATH') OR exit('No direct script access allowed');

#[\AllowDynamicProperties]

class Dashboard extends CI_Controller {
		public function __construct(){
			// Call the CI_Controller constructor
			parent::__construct();
			$this->load->library(array('session'));
			$this->load->helper(array('url'));
		}

		public function index(){
			if ($this->session->userdata('use_username')) {
				$this->load->view('backend/dashboard');
			}
			else {
				redirect('backend/Users/login');
			}
		}
}
