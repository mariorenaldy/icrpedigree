<?php

class Canines extends CI_Controller {
    public function __construct(){
        // Call the CI_Controller constructor
        parent::__construct();
        $this->load->model(array('caninesModel','memberModel', 'logcanineModel', 'requestModel', 'notification_model', 'notificationtype_model', 'pedigreesModel'));
        $this->load->library('upload', $this->config->item('upload_canine'));
        $this->load->library(array('session', 'form_validation'));
        $this->load->helper(array('url'));
        $this->load->database();
        date_default_timezone_set("Asia/Bangkok");
    }

	public function index(){
		if ($this->session->userdata('mem_id')){
			$where['can_app_user'] = 1;
			$where['can_member_id'] = $this->session->userdata('mem_id');
			$data['canines'] = $this->caninesModel->get_canines($where)->result();
			$this->load->view('frontend/view_canines', $data);
		}
		else{
			redirect('frontend/Members');
		}
    }

    public function search(){
		if ($this->session->userdata('mem_id')){
			$like['can_a_s'] = $this->input->post('keywords');
			$like['can_icr_number'] = $this->input->post('keywords');
			$where['can_app_user'] = 1;
			$where['can_member_id'] = $this->session->userdata('mem_id');
			$data['canines'] = $this->caninesModel->search_canines($like, $where)->result();
			$this->load->view('frontend/view_canines', $data);
		}
		else{
			redirect('frontend/Members');
		}
    }
}