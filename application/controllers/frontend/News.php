<?php
defined('BASEPATH') OR exit('No direct script access allowed');

#[\AllowDynamicProperties]

class News extends CI_Controller {
		public function __construct(){
			// Call the CI_Controller constructor
			parent::__construct();
			$this->load->model('news_model');
			$this->load->library(array('session'));
			$this->load->helper(array('url'));
			$this->load->database();
		}

		public function index(){
			$where['stat'] = $this->config->item('accepted');
			$data['news'] = $this->news_model->get_news($where)->result();
			$this->load->view('frontend/news', $data);
		}
}
