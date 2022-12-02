<?php

class Register extends CI_Controller {
    public function __construct()
    {
		parent::__construct();
	}

	public function index()
	{
		$this->data['content'] = 'register';
        $this->load->view("frontend/layout/page_layout", $this->data);
	}
}