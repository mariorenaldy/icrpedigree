<?php
defined('BASEPATH') OR exit('No direct script access allowed');

#[\AllowDynamicProperties]

class Users extends CI_Controller {
		public function __construct(){
			// Call the CI_Controller constructor
			parent::__construct();
			$this->load->model(array('userModel', 'usertypeModel'));
			$this->load->library(array('session', 'form_validation'));
			$this->load->helper(array('form', 'url'));
			$this->load->database();
		}

		public function index(){
			$where['use_stat'] = $this->config->item('accepted'); 
			$data['users'] = $this->userModel->get_users($where)->result();
			$this->load->view('backend/view_users', $data);
		}

		public function add(){
			$data['type'] = $this->usertypeModel->get_user_type()->result();
			$this->load->view("backend/add_user", $data);
		}

		public function validate_add(){
			if ($this->session->userdata('use_username')){
				$this->form_validation->set_rules('username', 'Username ', 'trim|required|is_unique[users.use_username]');
				$this->form_validation->set_rules('password', 'Password ', 'trim|required');
				$this->form_validation->set_rules('repass', 'Confirmation Password ', 'trim|matches[password]');

				$data['type'] = $this->usertypeModel->get_user_type()->result();
				if ($this->form_validation->run() == FALSE){
					$this->load->view("backend/add_user", $data);
				}
				else{
					$id = $this->userModel->get_max_id() + 1;
					$user = array(
						'use_id' => $id,
						'use_username' => $this->input->post('username'),
						'use_password' => sha1($this->input->post('password')),
						'use_type_id' => $this->input->post('use_type_id'),
						'use_photo' => '-',
						'use_stat' => $this->config->item('accepted'),
					);
					$res = $this->userModel->add_users($user);
					if ($res){
						$this->session->set_flashdata('add_success', TRUE);
						redirect("backend/Users");
					}
					else{
						$this->session->set_flashdata('error_message', 'Failed to save user');
						$this->load->view("backend/add_user", $data);
					}
				}
			}
            else{
				redirect("backend/Users/login");
			}
		}

		public function edit_password(){
			$this->load->view("backend/edit_password");
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
							redirect("backend/Dashboard");
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
				$this->form_validation->set_rules('use_id', 'User id ', 'trim|required');
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
                if ($this->session->userdata('use_username')){
                    $where['use_id'] = $this->uri->segment(4);
                    $user = $this->userModel->get_users($where)->row();
                    if ($user){
                        $data['use_stat'] = $this->config->item('deleted');
                        $res = $this->userModel->update_users($data, $where);
                        if ($res){
                            $this->session->set_flashdata('delete_success', TRUE);
                        }
                        else{
                            $this->session->set_flashdata('delete_message', 'Failed to delete user');
                        }
                        redirect("backend/Users");
                    }
                    else{
                        $this->session->set_flashdata('delete_message', 'Failed to delete user');
                        redirect("backend/Users");
                    }
                }
                else{
                    redirect("backend/Users/login");
                }
			}
			else{
                redirect("backend/Users");
            }
		}

		public function login(){
			$this->load->view('backend/login_form');
		}

		public function validate_login(){
			$where['use_username'] = $this->input->post('username');
			$where['use_stat !='] = $this->config->item('deleted');
			$user = $this->userModel->get_users($where)->row();
	
			$err = 0;
			if (!$user){
				$err++;
				$this->session->set_flashdata('error_message', 'Username is not registered');
			}
	
			if (!$err && sha1($this->input->post('password')) != $user->use_password){
				$err++;
				$this->session->set_flashdata('error_message', 'Wrong password');
			}
	
			if (!$err){
				$this->session->set_userdata('use_username', $this->input->post('username'));
				$this->session->set_userdata('use_id', $user->use_id);
				$this->session->set_userdata('use_type_id', $user->use_type_id);
				if ($user->use_photo && $user->use_photo != '-')
					$this->session->set_userdata('use_pp', base_url().'uploads/users/'.$user->use_photo);
				else
					$this->session->set_userdata('use_pp', base_url().'assets/img/'.$this->config->item('default_img'));
				redirect("backend/Dashboard");
			}
			else{
				$this->load->view("backend/login_form");
			}
		}

		public function logout(){
			$this->session->unset_userdata('use_username');
			$this->session->unset_userdata('use_id');
			$this->session->unset_userdata('use_type_id');
			redirect('backend/Users/login');
		}

		public function update_type(){
			if ($this->uri->segment(4)){
				$where['use_id'] = $this->uri->segment(4);
				$data['user'] = $this->userModel->get_users($where)->row();
				$data['type'] = $this->usertypeModel->get_user_type()->result();
				$data['mode'] = 0;
				if ($data['user']){
					$this->load->view("backend/edit_user_type", $data);
				}
				else{
					redirect("backend/Users");
				}
			}
			else{
				redirect("backend/Users");
			}
		}

		public function validate_edit_user_type(){
			if ($this->session->userdata('use_username')){
				$this->form_validation->set_error_delimiters('<div>','</div>');
				$this->form_validation->set_rules('use_id', 'User id ', 'trim|required');

				$where['use_id'] = $this->input->post('use_id');
				$data['user'] = $this->userModel->get_users($where)->row();
				$data['type'] = $this->usertypeModel->get_user_type()->result();
				$data['mode'] = 1;
				if ($this->form_validation->run() == FALSE){
					$this->load->view("backend/edit_user_type", $data);
				}
				else{
					$dataUser['use_type_id'] = $this->input->post('use_type_id');
					$res = $this->userModel->update_users($dataUser, $where);
					if ($res){
						$this->session->set_flashdata('edit_type', TRUE);
						redirect("backend/Users");
					}
					else{
						$err = 1;
						$this->session->set_flashdata('delete_message', 'Failed to edit user type');
						redirect("backend/Users");
					}
				}
			}
			else{
				redirect("backend/Users/login");
			}
		}

		public function update_pp(){
			if ($this->uri->segment(4)){
				$where['use_id'] = $this->uri->segment(4);
				$data['user'] = $this->userModel->get_users($where)->row();
				$data['mode'] = 0;
				if ($data['user']){
					$this->load->view("backend/update_pp", $data);
				}
				else{
					redirect("backend/Users");
				}
			}
			else{
				redirect("backend/Users");
			}
		}

		public function validate_update_pp(){
			if ($this->session->userdata('use_username')){
				$this->form_validation->set_error_delimiters('<div>','</div>');
				$this->form_validation->set_rules('use_id', 'User id ', 'trim|required');

				$where['use_id'] = $this->input->post('use_id');
				$data['user'] = $this->userModel->get_users($where)->row();
				$data['type'] = $this->usertypeModel->get_user_type()->result();
				$data['mode'] = 1;
				if ($this->form_validation->run() == FALSE){
					$this->load->view("backend/update_pp", $data);
				}
				else{
					$err = 0;
					if (!isset($_POST['attachment']) || empty($_POST['attachment'])){
						$err++;
						$this->session->set_flashdata('error_message', 'Photo is required');
					}

					if (!$err){
						$photo = '-';
						$uploadedImg = $_POST['attachment'];
						$image_array_1 = explode(";", $uploadedImg);
						$image_array_2 = explode(",", $image_array_1[1]);
						$uploadedImg = base64_decode($image_array_2[1]);
				
						if ((strlen($uploadedImg) > $this->config->item('file_size'))) {
							$err++;
							$this->session->set_flashdata('error_message', 'The file size is too big (> 1 MB).');
						}
				
						$img_name = $this->config->item('path_user').$this->config->item('file_name_user');
						if (!is_dir($this->config->item('path_user')) or !is_writable($this->config->item('path_user'))) {
							$err++;
							$this->session->set_flashdata('error_message', 'User folder not found or not writable.');
						} else{
							if (is_file($img_name) and !is_writable($img_name)) {
								$err++;
								$this->session->set_flashdata('error_message', 'File already exists and not writable.');
							}
						}
					}

					if (!$err){
						file_put_contents($img_name, $uploadedImg);
						$dataUser['use_photo'] = str_replace($this->config->item('path_user'), '', $img_name);
						$res = $this->userModel->update_users($dataUser, $where);
						if ($res){
							$this->session->set_flashdata('edit_pp', TRUE);
							redirect("backend/Users");
						}
						else{
							$err = 1;
							$this->session->set_flashdata('error_message', 'Failed to edit pp');
						}
					}
					else{
						$this->load->view("backend/update_pp", $data);
					}
				}
			}
			else{
				redirect("backend/Users/login");
			}
		}

		public function edit_pp(){
			if ($this->session->userdata('use_id')){
				$where['use_id'] = $this->session->userdata('use_id');
				$data['user'] = $this->userModel->get_users($where)->row();
				$data['mode'] = 0;
				if ($data['user']){
					$this->load->view("backend/edit_pp", $data);
				}
				else{
					redirect("backend/Users");
				}
			}
			else{
				redirect("backend/Users/login");
			}
		}

		public function validate_edit_pp(){
			if ($this->session->userdata('use_username')){
				$where['use_id'] = $this->session->userdata('use_id');
				$data['user'] = $this->userModel->get_users($where)->row();
				$data['mode'] = 1;
				
				$err = 0;
				if (!isset($_POST['attachment']) || empty($_POST['attachment'])){
					$err++;
					$this->session->set_flashdata('error_message', 'Photo is required');
				}

				if (!$err){
					$photo = '-';
					$uploadedImg = $_POST['attachment'];
					$image_array_1 = explode(";", $uploadedImg);
					$image_array_2 = explode(",", $image_array_1[1]);
					$uploadedImg = base64_decode($image_array_2[1]);
			
					if ((strlen($uploadedImg) > $this->config->item('file_size'))) {
						$err++;
						$this->session->set_flashdata('error_message', 'The file size is too big (> 1 MB).');
					}
			
					$img_name = $this->config->item('path_user').$this->config->item('file_name_user');
					if (!is_dir($this->config->item('path_user')) or !is_writable($this->config->item('path_user'))) {
						$err++;
						$this->session->set_flashdata('error_message', 'User folder not found or not writable.');
					} else{
						if (is_file($img_name) and !is_writable($img_name)) {
							$err++;
							$this->session->set_flashdata('error_message', 'File already exists and not writable.');
						}
					}
				}

				if (!$err){
					file_put_contents($img_name, $uploadedImg);
					$dataUser['use_photo'] = str_replace($this->config->item('path_user'), '', $img_name);
					$res = $this->userModel->update_users($dataUser, $where);
					if ($res){
						$this->session->set_userdata('use_pp', base_url().'uploads/users/'.$dataUser['use_photo']);
						$this->session->set_flashdata('edit_pp', TRUE);
						redirect("backend/Dashboard");
					}
					else{
						$err = 1;
						$this->session->set_flashdata('error_message', 'Failed to edit pp');
					}
				}
				else{
					$this->load->view("backend/edit_pp", $data);
				}
			}
			else{
				redirect("backend/Users/login");
			}
		}
}
