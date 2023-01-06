<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Users extends CI_Controller {
		public function __construct(){
			// Call the CI_Controller constructor
			parent::__construct();
			$this->load->model('userModel');
			$this->load->library(array('session', 'form_validation'));
			$this->load->helper(array('form', 'url'));
			$this->load->database();
		}

		public function index(){
			$where['use_stat'] = 1; 
			$data['users'] = $this->userModel->get_users($where)->result();
			$this->load->view('backend/view_users', $data);
		}

		public function add(){
			$this->load->view("backend/add_user");
		}

		public function validate_add(){
			if ($this->session->userdata('use_username')){
				$this->form_validation->set_rules('username', 'Username ', 'trim|required|is_unique[users.use_username]');
				$this->form_validation->set_rules('password', 'Password ', 'trim|required');
				$this->form_validation->set_rules('repass', 'Confirmation Password ', 'trim|matches[password]');

				if ($this->form_validation->run() == FALSE){
					$this->load->view("backend/add_user", $data);
				}
				else{
					$data = array(
						'use_username' => $this->input->post('username'),
						'use_password' => sha1($this->input->post('password')),
						'use_akses' => 1,
					);
					$res = $this->userModel->add_users($data);
					if ($res){
						$this->session->set_flashdata('add_success', TRUE);
						redirect("backend/Users");
					}
					else{
						$this->session->set_flashdata('error_message', 'Failed to save user');
						$this->load->view('backend/reset_password');
					}
				}
			}
		}

		public function edit_password(){
			if ($this->session->userdata('use_username')){
				$this->load->view("backend/edit_password");
			}
			else{
				redirect("backend/Users/login");
			}
		}

		public function validate_edit(){
			if ($this->session->userdata('use_username')){
				$this->form_validation->set_error_delimiters('<div>','</div>');
				$this->form_validation->set_rules('password', 'Password ', 'trim|required');
				$this->form_validation->set_rules('newpass', 'New Password ', 'trim|required');
				$this->form_validation->set_rules('repass', 'Confirmation password ', 'trim|matches[newpass]');

				if ($this->form_validation->run() == FALSE){
					$this->load->view("backend/edit_password");
				}
				else{
					$where['use_id'] = $this->session->userdata('use_id');
					$user = $this->userModel->get_users($where)->row();
					$err = 0;
					if (sha1($this->input->post('password')) == $user->use_password){
						$dataUser['use_password'] = sha1($this->input->post('newpass'));
						$res = $this->userModel->update_users($dataUser, $where);
						if ($res){
							$this->session->set_flashdata('edit_password', TRUE);
							redirect("backend/Users/edit_password");
						}
						else{
							$err = 1;
							$this->session->set_flashdata('error_message', 'Failed to reset password');
						}
					}
					else{
						$err = 2;
						$this->session->set_flashdata('error_message', 'Password is invalid');
					}
					if ($err){
						$this->load->view('backend/edit_password');
					}
				}
			}
			else{
				redirect("backend/Users/login");
			}
		}

		public function update_password(){
			if ($this->uri->segment(4)){
				$where['use_id'] = $this->uri->segment(4);
				$data['user'] = $this->userModel->get_users($where)->row();
				if ($data['user']){
					$this->load->view("backend/update_password", $data);
				}
				else{
					redirect("backend/Users");
				}
			}
			else{
				redirect("backend/Users");
			}
		}

		public function validate_update(){
			if ($this->session->userdata('use_username')){
				$this->form_validation->set_error_delimiters('<div>','</div>');
				$this->form_validation->set_rules('password', 'Password ', 'trim|required');
				$this->form_validation->set_rules('newpass', 'New Password ', 'trim|required');
				$this->form_validation->set_rules('repass', 'Confirmation password ', 'trim|matches[newpass]');

				$where['use_id'] = $this->input->post('use_id');
				$data['user'] = $this->userModel->get_users($where)->row();
				if ($this->form_validation->run() == FALSE){
					$this->load->view("backend/update_password", $data);
				}
				else{
					$err = 0;
					if (sha1($this->input->post('password')) == $data['user']->use_password){
						$dataUser['use_password'] = sha1($this->input->post('newpass'));
						$res = $this->userModel->update_users($dataUser, $where);
						if ($res){
							$this->session->set_flashdata('edit_password', TRUE);
							redirect("backend/Users");
						}
						else{
							$err = 1;
							$this->session->set_flashdata('error_message', 'Failed to reset password');
						}
					}
					else{
						$err = 2;
						$this->session->set_flashdata('error_message', 'Password is invalid');
					}
					if ($err){
						$this->load->view('backend/update_password', $data);
					}
				}
			}
			else{
				redirect("backend/Users/login");
			}
		}

		public function delete(){
			if ($this->uri->segment(4)){
				$where['use_id'] = $this->uri->segment(4);
				$user = $this->userModel->get_users($where)->row();
				if ($user){
					$data['use_stat'] = 0;
					$res = $this->userModel->update_users($data, $where);
					if ($res){
						$this->session->set_flashdata('delete', TRUE);
					}
					else{
						$this->session->set_flashdata('error_message', 'Failed to delete user');
					}
				}
			}
			redirect("backend/Users");
		}

		public function login(){
			$this->load->view('backend/login_form');
		}

		public function validate_login(){
			$where['users.use_username'] = $this->input->post('username');
			$user = $this->userModel->get_users($where)->row();
	
			$err = 0;
			if (!$user){
				$err++;
				$this->session->set_flashdata('login_error', 'Maaf nama pengguna tidak terdaftar');
			}
	
			if (!$err && sha1($this->input->post('password')) != $user->use_password){
				$err++;
				$this->session->set_flashdata('login_error', 'Maaf kata sandi anda salah');
			}
	
			if (!$err){
				$this->session->set_userdata('use_username', $this->input->post('username'));
				$this->session->set_userdata('use_id', $user->use_id);
				// $this->session->set_userdata('use_akses', $user->use_akses);
				redirect("backend/Dashboard");
			}
			else{
				$this->load->view("backend/login_form");
			}
		}

		public function logout(){
			// $this->session->sess_destroy();
			$this->session->unset_userdata('use_username');
			$this->session->unset_userdata('use_akses');
			redirect('backend/Users/login');
		}
}
