<?php
defined('BASEPATH') OR exit('No direct script access allowed');

#[\AllowDynamicProperties]

class Rules extends CI_Controller {
		public function __construct(){
			// Call the CI_Controller constructor
			parent::__construct();
			$this->load->library(array('session'));
			$this->load->helper(array('url', 'cookie'));
			$this->load->database();

			if ($this->input->cookie('site_lang')) {
				$this->lang->load('common', $this->input->cookie('site_lang'));
			} else {
				set_cookie('site_lang', 'indonesia', '2147483647'); 
				$this->lang->load('common','indonesia');
			}
		}

		public function index(){
			$site_lang = $this->input->cookie('site_lang');
			if ($site_lang == 'indonesia') {
				$this->load->view('frontend/rules');
			}
			else{
				$this->load->view('frontend/rules_eng');
			}
		}
}
