<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Rules extends CI_Controller {
		public function __construct(){
			// Call the CI_Controller constructor
			parent::__construct();
			$this->load->model('rulesModel');
			$this->load->library(array('session', 'form_validation'));
			$this->load->helper(array('url'));
			$this->load->database();
		}

		public function index(){
			$where['ru_stat'] = 1;
			$data['rules'] = $this->rulesModel->get_rules($where)->result();
			$this->load->view('backend/view_rules', $data);
		}

		public function add(){
			$this->load->view('backend/add_rule');
		}

		public function validate_add(){
			$this->form_validation->set_error_delimiters('<div>','</div>');
			$this->form_validation->set_message('required', '%s wajib diisi');
			$this->form_validation->set_rules('rule', 'Rule ', 'trim|required');

			if ($this->form_validation->run() == FALSE){
				$this->load->view('backend/add_rule');
			}
			else{
				$data = array(
					'ru_desc' => $this->input->post('rule'),
				);
				$rule = $this->rulesModel->add($data);
				if ($rule){
					$this->session->set_flashdata('add_success', TRUE);
					redirect('backend/Rules');
				}
				else{
					$this->session->set_flashdata('add_error', 'Rule gagal disimpan');
					$this->load->view('backend/add_rule');
				}
			}
		}

		function edit(){
			if ($this->uri->segment(4)){
				$where['ru_rule_id'] = $this->uri->segment(4);
				$data['rule'] = $this->rulesModel->get_rules($where)->row();
				$data['mode'] = 0;
				$this->load->view('backend/edit_rule.php', $data);
			}
			else {
				redirect('backend/Rules');
			}
		}

		public function validate_edit(){
			$this->form_validation->set_error_delimiters('<div>','</div>');
			$this->form_validation->set_message('required', '%s wajib diisi');
			$this->form_validation->set_rules('rule', 'Rule ', 'trim|required');

			$where['ru_rule_id'] = $this->input->post('rule_id');
			$data['rule'] = $this->rulesModel->get_rules($where)->row();

			if ($this->form_validation->run() == FALSE){
				$this->load->view('backend/edit_rule', $data);
			}
			else{
				$data = array(
					'ru_desc' => $this->input->post('rule'),
				);
				$rule = $this->rulesModel->update($data, $where);
				if ($rule){
					$this->session->set_flashdata('edit_success', TRUE);
					redirect('backend/Rules');
				}
				else{
					$this->session->set_flashdata('edit_error', 'Rule gagal disimpan');
					$this->load->view('backend/edit_rule', $data);
				}
			}
		}

		function delete(){
			if ($this->uri->segment(4)){
				$where['ru_rule_id'] = $this->uri->segment(4);
				$data['ru_stat'] = 0;
				$rule = $this->rulesModel->update($data, $where);
				if ($rule){
					$this->session->set_flashdata('delete_success', TRUE);
					redirect('backend/Rules');
				}
				else{
					$this->session->set_flashdata('delete_error', 'Rule gagal dihapus');
					redirect('backend/Rules');
				}
			}
			else {
				redirect('backend/Rules');
			}
		}
}
