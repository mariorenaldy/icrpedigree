<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Setting extends CI_Controller {
		public function __construct(){
			// Call the CI_Controller constructor
			parent::__construct();
			$this->load->model('settingModel');
			$this->load->library(array('session', 'form_validation'));
			$this->load->helper(array('url'));
			$this->load->database();
		}
		
		public function index(){
			if ($this->session->userdata('use_username') && !$this->session->userdata('use_akses')) {
				$data['mode'] = 0;
				$data['setting'] = $this->settingModel->get_setting(null)->row();
				$this->load->view('backend/edit_setting', $data);
			}
			else {
				redirect('backend/Dashboard');
			}
		}

		public function validate(){
			if ($this->session->userdata('use_username') && !$this->session->userdata('use_akses')){
				$this->form_validation->set_rules('set_tc', 'Term & Condition ', 'trim|required');
				$this->form_validation->set_rules('set_rule', 'Rule ', 'trim|required');

				$data['mode'] = 1;
				$data['setting'] = $this->settingModel->get_setting(null)->row();
				if ($this->form_validation->run() == FALSE){
					$this->load->view("backend/edit_setting", $data);
				}
				else{
					$data = $data = array(
						'set_tc' => $this->input->post('set_tc'),
						'set_rule' => $this->input->post('set_rule'),
					);
					$res = $this->settingModel->update_setting($data);
					if ($res){
						$this->session->set_flashdata('edit_success', TRUE);
						redirect("backend/Setting");
					}
					else{
						$this->session->set_flashdata('error_message', 'Failed to save setting');
						$this->load->view("backend/edit_setting", $data);
					}
				}
			}
			else {
				redirect('backend/Dashboard');
			}
		}
}
