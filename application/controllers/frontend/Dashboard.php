<?php

class Dashboard extends CI_Controller {
    public function __construct(){
		// Call the CI_Controller constructor
		parent::__construct();
        $this->load->library(array('session'));
        $this->load->helper(array('url'));
        $this->load->database();
	}

	public function index(){
        $this->load->view("frontend/dashboard");
	}
}