<?php

class Beranda extends CI_Controller {
    public function __construct()
    {
		parent::__construct();
	}

	public function index()
	{
		$this->data['content'] = 'beranda';
        $this->load->view("template/frontend", $this->data);
	}
}