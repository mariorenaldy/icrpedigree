<?php

class Marketplace extends CI_Controller {
    public function __construct()
    {
		parent::__construct();
	}

	public function index()
	{
        $this->load->view("frontend/marketplace");
	}
}