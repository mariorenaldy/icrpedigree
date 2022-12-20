<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Certificate extends CI_Controller {
    public function __construct(){
        parent::__construct();
        $this->load->model(array('caninesModel'));
    }

    public function index(){
        $data['trahs'] = $this->trahModel->get_trah()->result();
		
		$q1['mem_username'] = $this->session->userdata('username');
		$memberid = $this->MemberModel->get_members($q1)->row()->mem_id;

		$q2['can_member_id'] = $memberid;
		$data['canines'] = $this->CaninesModel->get_canines($q2)->result();
        $this->load->view("frontend/view_canines", $data);
        
        $this->load->view('backend/certificatePreview');
    }
}
