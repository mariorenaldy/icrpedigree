<?php
defined('BASEPATH') OR exit('No direct script access allowed');

#[\AllowDynamicProperties]

class Beranda extends CI_Controller {
    public function __construct()
    {
		parent::__construct();
		$this->load->library(array('session'));
        $this->load->helper(array('url'));
	}

	public function index()
	{
        $this->load->view("frontend/beranda");
	}
}