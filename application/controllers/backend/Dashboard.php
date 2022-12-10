<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {
		private $navigations;
		public function __construct(){
			// Call the CI_Controller constructor
			parent::__construct();
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
