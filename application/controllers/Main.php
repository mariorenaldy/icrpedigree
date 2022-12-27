<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Main extends CI_Controller {
	public function __construct(){
		// Call the CI_Controller constructor
		parent::__construct();
		$this->load->helper(array('url'));
	}

	public function index() {
		redirect('frontend/Beranda');
	}
}
