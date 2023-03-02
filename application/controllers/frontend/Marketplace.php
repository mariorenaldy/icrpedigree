<?php
defined('BASEPATH') OR exit('No direct script access allowed');

#[\AllowDynamicProperties]

class Marketplace extends CI_Controller {
    public function __construct(){
		parent::__construct();
		$this->load->library(array('session', 'form_validation'));
		$this->load->helper(array('url'));
		$this->load->database();
	}

	public function index(){
        $this->load->view("frontend/marketplace");
	}
	public function product(){
        $this->load->view("frontend/product");
	}
}