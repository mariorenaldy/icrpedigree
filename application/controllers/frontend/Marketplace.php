<?php
defined('BASEPATH') OR exit('No direct script access allowed');

#[\AllowDynamicProperties]

class Marketplace extends CI_Controller {
    public function __construct(){
		parent::__construct();
		$this->load->library(array('session'));
		$this->load->helper(array('url'));
		$this->load->database();
	}

	public function index(){
        $this->load->view("frontend/marketplace");
	}
}