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
	public function products(){
        $this->load->view("frontend/products");
	}
	public function product_detail(){
        $this->load->view("frontend/product_detail");
	}
	public function services(){
        $this->load->view("frontend/services");
	}
	public function service_detail(){
        $this->load->view("frontend/service_detail");
	}
	public function payment(){
        $this->load->view("frontend/payment");
	}
	public function demo(){
        $this->load->view("frontend/demo");
	}
}