<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Email extends CI_Controller{
	public function __construct(){
		parent::__construct();
		$this->load->model(array('MemberModel'));
		$this->load->library(array('session', 'form_validation'));
		$this->load->helper(array('url'));
		$this->load->database();
	}

	public function forgotpassword($id){
		$data['id'] = $id;
		$this->load->view('forgotpassword.php', $data);
	}

	public function changepassword(){
		$this->form_validation->set_error_delimiters('<div>','</div>');
		$this->form_validation->set_message('required', '%s wajib diisi');
		$this->form_validation->set_message('matches', 'Password wajib sama dengan confirm password');
		$this->form_validation->set_rules('password', 'Password ', 'trim|required');
		$this->form_validation->set_rules('confirm', 'Confirm password ', 'trim|matches[password]');
		
		$data['id'] = $this->input->post('id');
		if ($this->form_validation->run() == FALSE){
			$this->load->view('forgotpassword.php', $data);
		}
		else{
			$res = $this->MemberModel->edit_password($this->input->post('id'), SHA1($this->input->post('password')));
			if ($res){
				$data['status'] = 1;
			}
			else{
				$data['status'] = 0;
			}
			$this->load->view('passwordchanged.php', $data);
		}
	}
}
