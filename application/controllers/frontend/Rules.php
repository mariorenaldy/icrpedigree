<?php

class Rules extends CI_Controller {
    public function __construct()
    {
		parent::__construct();
	}

	public function index()
	{
		$this->data['content'] = 'rules';
        $this->load->view("frontend/layout/page_layout", $this->data);
	}
}