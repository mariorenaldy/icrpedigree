<?php
defined('BASEPATH') OR exit('No direct script access allowed');

#[\AllowDynamicProperties]

class Pedigree extends CI_Controller {
    public function __construct(){
        // Call the CI_Controller constructor
        parent::__construct();
        $this->load->model(array('caninesModel'));
        $this->load->library('upload', $this->config->item('upload_canine'));
        $this->load->library(array('session', 'form_validation'));
        $this->load->helper(array('url'));
        $this->load->database();
        date_default_timezone_set("Asia/Bangkok");

		if ($this->input->cookie('site_lang')) {
            $this->lang->load('canine', $this->input->cookie('site_lang'));
            $this->lang->load('pedigree', $this->input->cookie('site_lang'));
        } else {
            set_cookie('site_lang', 'indonesia', '2147483647'); 
            $this->lang->load('canine','indonesia');
            $this->lang->load('pedigree','indonesia');
        }
    }

	public function index(){
		$data['canines'] = [];
		$this->load->view('frontend/pedigree', $data);
    }

    public function search(){
		if ($this->session->userdata('mem_id')){
			$like['can_a_s'] = $this->input->post('keywords');
			$like['can_icr_number'] = $this->input->post('keywords');
			$like['can_chip_number'] = $this->input->post('keywords');
			$like['ken_name'] = $this->input->post('keywords');
			$piece = explode("-", $this->input->post('keywords'));
			if (isset($piece[1]) && isset($piece[2])){
				$dob = $piece[2]."-".$piece[1]."-".$piece[0];
				$like['can_date_of_birth'] = $dob;
			}
			$where['can_member_id != '] = $this->config->item('no_member');
			$where['can_stat'] = $this->config->item('accepted');
			$where['can_rip'] = $this->config->item('canine_alive');
			$where['mem_stat'] = $this->config->item('accepted');
			$where['ken_stat'] = $this->config->item('accepted');
			$data['canines'] = $this->caninesModel->search_canines($like, $where)->result();
			$this->load->view('frontend/pedigree', $data);
		}
		else{
			redirect('frontend/Members');
		}
    }

	public function view(){
		$data['canines'] = [];
		$this->load->view('frontend/search_canine', $data);
    }

    public function search_canine(){
		$like['can_a_s'] = $this->input->post('keywords');
		$like['can_icr_number'] = $this->input->post('keywords');
		$like['can_chip_number'] = $this->input->post('keywords');
		$where['can_member_id != '] = $this->config->item('no_member');
		$where['can_stat'] = $this->config->item('accepted');
		$where['can_rip'] = $this->config->item('canine_alive');
		$where['mem_stat'] = $this->config->item('accepted');
		$where['ken_stat'] = $this->config->item('accepted');
		$data['canines'] = $this->caninesModel->search_canines($like, $where)->result();
		$this->load->view('frontend/search_canine', $data);
    }
}