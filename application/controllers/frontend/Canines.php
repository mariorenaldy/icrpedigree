<?php

class Canines extends CI_Controller {
    public function __construct()
    {
		parent::__construct();
		$this->load->model('CaninesModel');
	}

	public function index()
	{
		$data['canines'] = $this->CaninesModel->get_canines()->result();
        $this->load->view("frontend/view_canines", $data);
	}
}