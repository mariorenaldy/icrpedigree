<?php

class Births extends CI_Controller {
    public function __construct()
    {
		parent::__construct();
		$this->load->model('BirthModel');
		$this->load->model('MemberModel');
	}

	public function index()
	{
		$q1['mem_username'] = $this->session->userdata('username');
		$memberid = $this->MemberModel->get_members($q1)->row()->mem_id;

		$q2['bir_member_id'] = $memberid;
		$data['births'] = $this->BirthModel->get_births($q2)->result();
        $this->load->view("frontend/view_births", $data);
	}
}