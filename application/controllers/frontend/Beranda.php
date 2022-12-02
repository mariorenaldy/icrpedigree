<?php

class Beranda extends CI_Controller {
    public function __construct()
    {
		parent::__construct();
	}

	public function index()
	{
		$data['content'] = 'beranda';
		$this->load->view("frontend/layout/page_layout", $data);
	}
}