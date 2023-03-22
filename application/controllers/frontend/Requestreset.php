<?php
defined('BASEPATH') OR exit('No direct script access allowed');

#[\AllowDynamicProperties]

class Requestreset extends CI_Controller {
		public function __construct(){
			// Call the CI_Controller constructor
			parent::__construct();
			$this->load->model(array('MemberModel', 'requestresetModel'));
			$this->load->library('upload', $this->config->item('upload_member'));
			$this->load->library(array('session', 'form_validation'));
			$this->load->helper(array('form', 'url'));
			$this->load->database();
		}

		public function reset_password(){
			$this->load->view("frontend/reset_password");
		}

		public function validate_reset(){
			$this->form_validation->set_rules('mem_hp', 'No. hp', 'trim');
			$this->form_validation->set_rules('mem_email', 'email', 'trim');
			
			if (!$this->input->post('mem_hp') && !$this->input->post('mem_email')){
				$this->session->set_flashdata('error_message', 'No. HP atau email harus diisi');
				$this->load->view("frontend/reset_password");
			}
			else{
				$mem_id = 0;
				if ($this->input->post('mem_hp')){
					$where['mem_hp'] = $this->input->post('mem_hp');
					$where['mem_stat'] = $this->config->item('accepted');
					$where['ken_stat'] = $this->config->item('accepted');
					$member = $this->MemberModel->get_members($where)->row();
					if ($member){
						$mem_id = $member->mem_id;
					}
				}
				
				if (!$mem_id && $this->input->post('mem_email')){
					$whereMember['mem_email'] = $this->input->post('mem_email');
					$whereMember['mem_stat'] = $this->config->item('accepted');
					$whereMember['ken_stat'] = $this->config->item('accepted');
					$member = $this->MemberModel->get_members($whereMember)->row();
					if ($member){
						$mem_id = $member->mem_id;
					}
				}

				if (!$mem_id){
					$this->session->set_flashdata('error_message', 'No. HP atau email tidak terdaftar');
					$this->load->view("frontend/reset_password");
				}
				else{
					$data['req_member_id'] = $mem_id;
					$data['req_stat'] = $this->config->item('saved');
					$res = $this->requestresetModel->get_requests($data)->num_rows();
					if ($res){
						$this->session->set_flashdata('error_message', 'Laporan reset password yang lama belum diproses. Harap menghubungi Admin.');
						$this->load->view("frontend/reset_password", $data);
					}
					else{
						$res = $this->requestresetModel->add_requests($data);
						if ($res){
							$this->session->set_flashdata('reset', TRUE);
							redirect("frontend/Members/reset_password");
						}
						else{
							$this->session->set_flashdata('error_message', 'Gagal menyimpan laporan reset password');
							$this->load->view("frontend/reset_password");
						}
					}
				}
			}
		}
}
