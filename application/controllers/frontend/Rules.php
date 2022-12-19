<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Rules extends CI_Controller {
		public function __construct(){
			// Call the CI_Controller constructor
			parent::__construct();
			$this->load->model('rulesModel');
			$this->load->library(array('session'));
			$this->load->helper(array('url'));
			$this->load->database();
		}

		public function index(){
			$where['ru_stat'] = 1;
			$data['rules'] = $this->rulesModel->get_rules($where)->result();
			$this->load->view('frontend/rules', $data);
		}
}
