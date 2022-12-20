<?php

class Studs extends CI_Controller {
    public function __construct()
    {
		parent::__construct();
		$this->load->model('StudModel');
		$this->load->model('MemberModel');
	}

	public function index()
	{
		$q1['mem_username'] = $this->session->userdata('username');
		$memberid = $this->MemberModel->get_members($q1)->row()->mem_id;

		$q2['stu_member_id'] = $memberid;
		$data['studs'] = $this->StudModel->get_studs($q2)->result();
        $this->load->view("frontend/view_studs", $data);
	}
}