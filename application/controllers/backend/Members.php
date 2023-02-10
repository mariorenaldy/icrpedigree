<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Members extends CI_Controller {
		public function __construct(){
			// Call the CI_Controller constructor
			parent::__construct();
			$this->load->model(array('MemberModel', 'KennelModel', 'LogmemberModel', 'LogkennelModel', 'notification_model', 'notificationtype_model', 'KenneltypeModel'));
			$this->load->library('upload', $this->config->item('upload_member'));
			$this->load->library(array('session', 'form_validation'));
			$this->load->helper(array('url', 'mail', 'notif'));
			$this->load->database();
			date_default_timezone_set("Asia/Bangkok");
		}

		public function test_input($data) {
			$data = trim($data);
			$data = stripslashes($data);
			$data = htmlspecialchars($data);
			return $data;
		}

		public function index(){
			$where['mem_type'] = $this->config->item('pro_member');
			$where['mem_stat'] = $this->config->item('accepted');
			$data['member'] = $this->MemberModel->get_members($where, 'mem_app_date2')->result();
			$data['kennel'] = Array();
			foreach($data['member'] AS $m){
				$wheKennel = [];
				$wheKennel['ken_member_id'] = $m->mem_id;
				$wheKennel['ken_stat'] = $this->config->item('accepted'); 
				$data['kennel'][] = $this->KennelModel->get_kennels($wheKennel)->result();
			}
			$this->load->view('backend/view_members', $data);
		}

		public function search(){
			$like['mem_name'] = $this->input->post('keywords');
			$like['mem_address'] = $this->input->post('keywords');
			$like['mem_hp'] = $this->input->post('keywords');
			$like['ken_name'] = $this->input->post('keywords');
			$like['mem_ktp'] = $this->input->post('keywords');
			$where['mem_stat'] = $this->config->item('accepted');
			if ($this->input->post('mem_type') == $this->config->item('all_member'))
				$where['mem_type IN ('.$this->config->item('pro_member').', '.$this->config->item('free_member').')'] = null;
			else
				$where['mem_type'] = $this->input->post('mem_type');
			$data['member'] = $this->MemberModel->search_members($like, $where, 'mem_app_date2')->result();
			$data['kennel'] = Array();
			foreach($data['member'] AS $m){
				$wheKennel = [];
				$wheKennel['ken_member_id'] = $m->mem_id;
				$wheKennel['ken_stat'] = $this->config->item('accepted'); 
				$data['kennel'][] = $this->KennelModel->get_kennels($wheKennel)->result();
			}
			$this->load->view('backend/view_members', $data);
		}

		public function view_approve(){
			$where['mem_stat'] = $this->config->item('saved');
			$data['member'] = $this->MemberModel->get_members($where)->result();
			$data['kennel'] = Array();
			foreach($data['member'] AS $m){
				$wheKennel = [];
				$wheKennel['ken_member_id'] = $m->mem_id;
				$wheKennel['ken_stat'] = $this->config->item('saved'); 
				$data['kennel'][] = $this->KennelModel->get_kennels($wheKennel)->result();
			}
			$this->load->view('backend/approve_members', $data);
		}

		public function search_approve(){
			$like['mem_name'] = $this->input->post('keywords');
			$like['mem_address'] = $this->input->post('keywords');
			$like['mem_hp'] = $this->input->post('keywords');
			$like['ken_name'] = $this->input->post('keywords');
			$where['mem_stat'] = $this->config->item('saved');
			$data['member'] = $this->MemberModel->search_members($like, $where)->result();
			$data['kennel'] = Array();
			foreach($data['member'] AS $m){
				$wheKennel = [];
				$wheKennel['ken_member_id'] = $m->mem_id;
				$wheKennel['ken_stat'] = $this->config->item('saved'); 
				$data['kennel'][] = $this->KennelModel->get_kennels($wheKennel)->result();
			}
			$this->load->view('backend/approve_members', $data);
		}

		public function add(){
			$dataReg['kennelType'] = $this->KenneltypeModel->get_kennel_types(null)->result();
			$dataReg['mode'] = 0;
			$this->load->view("backend/add_member", $dataReg);
		}

		public function validate_add(){
			if ($this->session->userdata('use_username')){
				$this->form_validation->set_error_delimiters('<div>','</div>');
				if ($this->input->post('mem_type')){
					$this->form_validation->set_rules('mem_name', 'KTP Name ', 'trim|required');
					$this->form_validation->set_rules('mem_address', 'Mail Address ', 'trim|required');
					if (!$this->input->post('same'))
						$this->form_validation->set_rules('mem_mail_address', 'Certificate Address ', 'trim|required');
					$this->form_validation->set_rules('mem_hp', 'Phone Number ', 'trim|required');
					$this->form_validation->set_rules('mem_kota', 'City ', 'trim|required');
					$this->form_validation->set_rules('mem_kode_pos', 'Postal Code ', 'trim|required');
					$this->form_validation->set_rules('mem_email', 'email ', 'trim|required');
					$this->form_validation->set_rules('mem_ktp', 'KTP Number', 'trim|required'); 
					$this->form_validation->set_rules('mem_username', 'Username ', 'trim|required');
					$this->form_validation->set_rules('password', 'Password ', 'trim|required');
					$this->form_validation->set_rules('repass', 'Confirmation Password ', 'trim|matches[password]');
					$this->form_validation->set_rules('ken_name', 'Kennel Name', 'trim|required');
				}
				else{
					$this->form_validation->set_rules('name', 'KTP Name ', 'trim|required');
					$this->form_validation->set_rules('hp', 'Phone Number ', 'trim|required');
					$this->form_validation->set_rules('email', 'email ', 'trim|required');
				}

				$dataReg['kennelType'] = $this->KenneltypeModel->get_kennel_types(null)->result();
				$dataReg['mode'] = 1;
				if ($this->form_validation->run() == FALSE){
					$this->load->view("backend/add_member", $dataReg);
				}
				else{
					$err = 0;
					if ($this->input->post('mem_type')){
						$pp = '-';
						if (!$err && isset($_FILES['attachment_pp']) && !empty($_FILES['attachment_pp']['tmp_name']) && is_uploaded_file($_FILES['attachment_pp']['tmp_name'])){
							if (is_uploaded_file($_FILES['attachment_pp']['tmp_name'])){
								$this->upload->initialize($this->config->item('upload_member'));
								if ($this->upload->do_upload('attachment_pp')){
									$uploadData = $this->upload->data();
									$pp = $uploadData['file_name'];
								}
								else{
									$err++;
									$this->session->set_flashdata('error_message', $this->upload->display_errors());
								}
							}
						}
		
						$logo = '-';
						if (!$err && isset($_FILES['attachment_logo']) && !empty($_FILES['attachment_logo']['tmp_name']) && is_uploaded_file($_FILES['attachment_logo']['tmp_name'])){
							if (is_uploaded_file($_FILES['attachment_logo']['tmp_name'])){
								$this->upload->initialize($this->config->item('upload_kennel'));
								if ($this->upload->do_upload('attachment_logo')){
									$uploadData = $this->upload->data();
									$logo = $uploadData['file_name'];
								}
								else{
									$err++;
									$this->session->set_flashdata('error_message', $this->upload->display_errors());
								}
							}
						}
					}
	
					// if (!$err && $this->input->post('mem_type') && $logo == "-"){
					// 	$err++;
					// 	$this->session->set_flashdata('error_message', 'Foto kennel wajib diisi');
					// }
					
					if ($this->input->post('mem_type'))
						$email = $this->test_input($this->input->post('mem_email'));
					else
						$email = $this->test_input($this->input->post('email'));

					if (!$err && !filter_var($email, FILTER_VALIDATE_EMAIL)) {
						$err++;
						$this->session->set_flashdata('error_message', 'Invalid email format');
					}

					if (!$err && $this->input->post('mem_type') == $this->config->item('pro_member') && $this->MemberModel->check_for_duplicate(0, 'mem_ktp', $this->input->post('mem_ktp'))){
						$err++;
						$this->session->set_flashdata('error_message', 'Duplicate KTP number');
					}

					if (!$err && $this->MemberModel->check_for_duplicate(0, 'mem_hp', $this->input->post('mem_hp'))){
						$err++;
						$this->session->set_flashdata('error_message', 'Duplicate phone number');
					}
	
					if (!$err && $this->MemberModel->check_for_duplicate(0, 'mem_email', $this->input->post('mem_email'))){
						$err++;
						$this->session->set_flashdata('error_message', 'Duplicate email');
					}

					if (!$err && $this->MemberModel->check_for_duplicate(0, 'mem_username', $this->input->post('mem_username'))){
						$err++;
						$this->session->set_flashdata('error_message', 'Username tidak boleh sama');
					}
	
					if (!$err && $this->input->post('mem_type') == $this->config->item('pro_member') && $this->KennelModel->check_for_duplicate(0, 'ken_name', $this->input->post('ken_name'))){
						$err++;
						$this->session->set_flashdata('error_message', 'Duplicate kennel name');
					}
	
					if (!$err){
						$mem_id = $this->MemberModel->record_count() + 1;
						if ($this->input->post('mem_type')){
							$data = array(
								'mem_id' => $mem_id,
								'mem_name' => strtoupper($this->input->post('mem_name')),
								'mem_address' => $this->input->post('mem_address'),
								'mem_hp' => $this->input->post('mem_hp'),
								'mem_kota' => $this->input->post('mem_kota'),
								'mem_kode_pos' => $this->input->post('mem_kode_pos'),
								'mem_email' => $this->input->post('mem_email'),
								'mem_ktp' => $this->input->post('mem_ktp'),
								'mem_pp' => $pp,
								'mem_username' => $this->input->post('mem_username'),
								'mem_password' => sha1($this->input->post('password')),
								'mem_app_user' => $this->session->userdata('use_id'),
								'mem_app_date' => date('Y-m-d H:i:s'),
								'mem_stat' => $this->config->item('accepted'),
								'mem_type' => $this->config->item('pro_member'),
								'mem_user' => $this->session->userdata('use_id'),
								'mem_date' => date('Y-m-d H:i:s'),
							);
			
							$ken_id = $this->KennelModel->record_count() + 1;
							$kennel_data = array(
								'ken_id' => $ken_id,
								'ken_name' => strtoupper($this->input->post('ken_name')),
								'ken_type_id' => $this->input->post('ken_type_id'),
								'ken_photo' => $logo,
								'ken_member_id' => $mem_id,
								'ken_stat' => $this->config->item('accepted'),
								'ken_app_user' => $this->session->userdata('use_id'),
								'ken_app_date' => date('Y-m-d H:i:s'),
								'ken_user' => $this->session->userdata('use_id'),
								'ken_date' => date('Y-m-d H:i:s'),
							);

							$dataLog = array(
								'log_member_id' => $mem_id,
								'log_name' => strtoupper($this->input->post('mem_name')),
								'log_address' => $this->input->post('mem_address'),
								'log_hp' => $this->input->post('mem_hp'),
								'log_kota' => $this->input->post('mem_kota'),
								'log_kode_pos' => $this->input->post('mem_kode_pos'),
								'log_email' => $this->input->post('mem_email'),
								'log_ktp' => $this->input->post('mem_ktp'),
								'log_pp' => $pp,
								'log_app_user' => $this->session->userdata('use_id'),
								'log_app_date' => date('Y-m-d H:i:s'),
								'log_stat' => $this->config->item('accepted'),
								'log_mem_type' => $this->config->item('pro_member'),
								'log_user' => $this->session->userdata('use_id'),
								'log_date' => date('Y-m-d H:i:s'),
							);

							$dataKennelLog = array(
								'log_kennel_id' => $ken_id,
								'log_kennel_name' => strtoupper($this->input->post('ken_name')),
								'log_kennel_type_id' => $this->input->post('ken_type_id'),
								'log_kennel_photo' => $logo,
								'log_stat' => $this->config->item('accepted'),
								'log_app_user' => $this->session->userdata('use_id'),
								'log_app_date' => date('Y-m-d H:i:s'),
								'log_user' => $this->session->userdata('use_id'),
								'log_date' => date('Y-m-d H:i:s')
							);

							if ($this->input->post('same')){
								$data['mem_mail_address'] = $this->input->post('mem_address');
								$dataLog['log_mail_address'] = $this->input->post('mem_address');
							}
							else{
								$data['mem_mail_address'] = $this->input->post('mem_mail_address');
								$dataLog['log_mail_address'] = $this->input->post('mem_address');
							}
						}
						else{
							$data = array(
								'mem_id' => $mem_id,
								'mem_name' => strtoupper($this->input->post('name')),
								'mem_hp' => $this->input->post('hp'),
								'mem_email' => $this->input->post('email'),
								'mem_username' => $this->input->post('email'),
								'mem_password' => sha1($this->input->post('hp')),
								'mem_stat' => $this->config->item('accepted'),
								'mem_type' => $this->config->item('free_member'),
								'mem_user' => $this->session->userdata('use_id'),
								'mem_date' => date('Y-m-d H:i:s'),
							);
	
							$ken_id = $this->KennelModel->record_count() + 1;
							$kennel_data = array(
								'ken_id' => $ken_id,
								'ken_name' => '',
								'ken_type_id' => 0,
								'ken_photo' => '-',
								'ken_member_id' => $mem_id,
								'ken_stat' => $this->config->item('accepted'),
								'ken_user' => $this->session->userdata('use_id'),
								'ken_date' => date('Y-m-d H:i:s'),
							);
						}
		
						$this->db->trans_strict(FALSE);
						$this->db->trans_start();
						$id = $this->MemberModel->add_members($data);
						if ($id){
							$res = $this->KennelModel->add_kennels($kennel_data);
							if ($res){
								$result = $this->notification_model->add(17, $mem_id, $mem_id);
								if ($result){
									if ($this->input->post('mem_type')){
										$log = $this->LogmemberModel->add_log($dataLog);
										if ($log){
											$res = $this->LogkennelModel->add_log($dataKennelLog);
											if (!$res){
												$err = 1;
											}
										}
										else{
											$err = 2;
										}
									}	
									if (!$err){
										$this->db->trans_complete();
										$mail = send_greeting($this->input->post('mem_email'));
										$this->session->set_flashdata('add_success', TRUE);
										redirect("backend/Members");
									}
								}
								else{
									$err = 3;
								}
							}
							else{
								$err = 4;
							}
						}
						else {
							$err = 5;
						}
						if ($err){
							$this->db->trans_rollback();
							$this->session->set_flashdata('error_message', 'Failed to save member. Error code: '.$err);
							$this->load->view("backend/add_member", $dataReg);
						}
					}
					else{
						$this->load->view("backend/add_member", $dataReg);
					}
				}
			} 
			else{
				redirect('backend/Users/login');
			}
		}

		public function edit(){
			if ($this->uri->segment(4)){
				$dataReg['kennelType'] = $this->KenneltypeModel->get_kennel_types(null)->result();
				$where['mem_id'] = $this->uri->segment(4);
				$dataReg['member'] = $this->MemberModel->get_members($where)->row();
				$dataReg['mode'] = 0;
				$this->load->view("backend/edit_member", $dataReg);
			}
			else{
				redirect('backend/Members');
			}
		}

		public function validate_edit(){ 
			if ($this->session->userdata('use_username')){
				$this->form_validation->set_error_delimiters('<div>','</div>');
				if ($this->input->post('mem_type')){
					$this->form_validation->set_rules('mem_name', 'KTP Name ', 'trim|required');
					$this->form_validation->set_rules('mem_address', 'Mail Address ', 'trim|required');
					if (!$this->input->post('same'))
						$this->form_validation->set_rules('mem_mail_address', 'Certificate Address ', 'trim|required');
					$this->form_validation->set_rules('mem_hp', 'Phone Number ', 'trim|required');
					$this->form_validation->set_rules('mem_kota', 'City ', 'trim|required');
					$this->form_validation->set_rules('mem_kode_pos', 'Postal Code ', 'trim|required');
					$this->form_validation->set_rules('mem_email', 'Email ', 'trim|required');
					$this->form_validation->set_rules('mem_ktp', 'KTP Number', 'trim|required'); 
					$this->form_validation->set_rules('ken_name', 'Kennel Name', 'trim|required'); 
				}
				else{
					$this->form_validation->set_rules('name', 'Name ', 'trim|required');
					$this->form_validation->set_rules('hp', 'Phone Number ', 'trim|required');
					$this->form_validation->set_rules('email', 'email ', 'trim|required');
				}

				$dataReg['kennelType'] = $this->KenneltypeModel->get_kennel_types(null)->result();
				$where['mem_id'] = $this->input->post('mem_id');
				$dataReg['member'] = $this->MemberModel->get_members($where)->row();
				$dataReg['mode'] = 1;
				if ($this->form_validation->run() == FALSE){
					$this->load->view("backend/edit_member", $dataReg);
				}
				else{
					$err = 0;
					if ($this->input->post('mem_type')){
						$pp = '-';
						if (!$err && isset($_FILES['attachment_pp']) && !empty($_FILES['attachment_pp']['tmp_name']) && is_uploaded_file($_FILES['attachment_pp']['tmp_name'])){
							if (is_uploaded_file($_FILES['attachment_pp']['tmp_name'])){
								$this->upload->initialize($this->config->item('upload_member'));
								if ($this->upload->do_upload('attachment_pp')){
									$uploadData = $this->upload->data();
									$pp = $uploadData['file_name'];
								}
								else{
									$err++;
									$this->session->set_flashdata('error_message', $this->upload->display_errors());
								}
							}
						}
		
						$logo = '-';
						if (!$err && isset($_FILES['attachment_logo']) && !empty($_FILES['attachment_logo']['tmp_name']) && is_uploaded_file($_FILES['attachment_logo']['tmp_name'])){
							if (is_uploaded_file($_FILES['attachment_logo']['tmp_name'])){
								$this->upload->initialize($this->config->item('upload_kennel'));
								if ($this->upload->do_upload('attachment_logo')){
									$uploadData = $this->upload->data();
									$logo = $uploadData['file_name'];
								}
								else{
									$err++;
									$this->session->set_flashdata('error_message', $this->upload->display_errors());
								}
							}
						}
					}

					if ($this->input->post('mem_type'))
						$email = $this->test_input($this->input->post('mem_email'));
					else
						$email = $this->test_input($this->input->post('email'));

					if (!$err && !filter_var($email, FILTER_VALIDATE_EMAIL)) {
						$err++;
						$this->session->set_flashdata('error_message', 'Invalid email format');
					}

					if (!$err && $this->input->post('mem_type') == $this->config->item('pro_member') && $this->MemberModel->check_for_duplicate($this->input->post('mem_id'), 'mem_ktp', $this->input->post('mem_ktp'))){
						$err++;
						$this->session->set_flashdata('error_message', 'Duplicate KTP number');
					}

					if (!$err && $this->MemberModel->check_for_duplicate($this->input->post('mem_id'), 'mem_hp', $this->input->post('mem_hp'))){
						$err++;
						$this->session->set_flashdata('error_message', 'Duplicate phone number');
					}
	
					if (!$err && $this->MemberModel->check_for_duplicate($this->input->post('mem_id'), 'mem_email', $this->input->post('mem_email'))){
						$err++;
						$this->session->set_flashdata('error_message', 'Duplicate email');
					}
	
					if (!$err && $this->KennelModel->check_for_duplicate($this->input->post('mem_id'), 'ken_name', $this->input->post('ken_name'))){
						$err++;
						$this->session->set_flashdata('error_message', 'Duplicate kennel name');
					}

					if (!$err){
						if ($this->input->post('mem_type')){
							$data = array(
								'mem_name' => strtoupper($this->input->post('mem_name')),
								'mem_address' => $this->input->post('mem_address'),
								'mem_mail_address' => $this->input->post('mem_mail_address'),
								'mem_hp' => $this->input->post('mem_hp'),
								'mem_kota' => $this->input->post('mem_kota'),
								'mem_kode_pos' => $this->input->post('mem_kode_pos'),
								'mem_email' => $this->input->post('mem_email'),
								'mem_ktp' => $this->input->post('mem_ktp'),
								'mem_type' => $this->input->post('mem_type'),
								'mem_payment_date' => date('2023-1-1'),
								'mem_user' => $this->session->userdata('use_id'),
								'mem_date' => date('Y-m-d H:i:s'),
							);
							if ($pp != '-')
								$data['mem_pp'] = $pp;

							$kennel_data = array(
								'ken_name' => strtoupper($this->input->post('ken_name')),
								'ken_type_id' => $this->input->post('ken_type_id'),
								'ken_user' => $this->session->userdata('use_id'),
								'ken_date' => date('Y-m-d H:i:s'),
							);
							if ($logo != '-')
								$kennel_data['ken_photo'] = $logo;
							
							$dataLog = array(
								'log_member_id' => $this->input->post('mem_id'),
								'log_name' => strtoupper($this->input->post('mem_name')),
								'log_address' => $this->input->post('mem_address'),
								'log_mail_address' => $this->input->post('mem_mail_address'),
								'log_hp' => $this->input->post('mem_hp'),
								'log_kota' => $this->input->post('mem_kota'),
								'log_kode_pos' => $this->input->post('mem_kode_pos'),
								'log_email' => $this->input->post('mem_email'),
								'log_ktp' => $this->input->post('mem_ktp'),
								'log_pp' => $pp,
								'log_user' => $this->session->userdata('use_id'),
								'log_date' => date('Y-m-d H:i:s'),
								'log_stat' => $this->config->item('accepted'),
								'log_mem_type' => $this->input->post('mem_type'),
								'log_payment_date' => date('2023-1-1'),
							);
	
							$dataKennelLog = array(
								'log_kennel_id' => $this->input->post('ken_id'),
								'log_kennel_name' => strtoupper($this->input->post('ken_name')),
								'log_kennel_type_id' => $this->input->post('ken_type_id'),
								'log_kennel_photo' => $logo,
								'log_stat' => $this->config->item('accepted'),
								'log_user' => $this->session->userdata('use_id'),
								'log_date' => date('Y-m-d H:i:s')
							);

							if ($this->input->post('same')){
								$data['mem_mail_address'] = $this->input->post('mem_address');
								$dataLog['log_mail_address'] = $this->input->post('mem_address');
							}
							else{
								$data['mem_mail_address'] = $this->input->post('mem_mail_address');
								$dataLog['log_mail_address'] = $this->input->post('mem_address');
							}

							$this->db->trans_strict(FALSE);
							$this->db->trans_start();
							$mem = $this->MemberModel->update_members($data, $where);
							if ($mem){
								$wheKen['ken_id'] = $this->input->post('ken_id');
								$ken = $this->KennelModel->update_kennels($kennel_data, $wheKen);
								if ($ken){
									$log = $this->LogmemberModel->add_log($dataLog);
									if ($log){
										$res = $this->LogkennelModel->add_log($dataKennelLog);
										if ($res){
											$this->db->trans_complete();
											$this->session->set_flashdata('edit_success', TRUE);
											redirect("backend/Members");
										}
										else{
											$err = 1;
										}
									}
									else{
										$err = 2;
									}
								}
								else{
									$err = 3;
								}
							}
							else {
								$err = 4;
							}
							if ($err){
								$this->db->trans_rollback();
								$this->session->set_flashdata('error_message', 'Failed to edit member id = '.$this->input->post('mem_id').'. Error code: '.$err);
								$this->load->view("backend/edit_member", $dataReg);
							}
						}
						else{
							$data = array(
								'mem_name' => strtoupper($this->input->post('name')),
								'mem_hp' => $this->input->post('hp'),
								'mem_email' => $this->input->post('email'),
								'mem_type' => $this->input->post('mem_type'),
								'mem_user' => $this->session->userdata('use_id'),
								'mem_date' => date('Y-m-d H:i:s'),
							);
	
							$mem = $this->MemberModel->update_members($data, $where);
							if ($mem){
								$this->session->set_flashdata('edit_success', TRUE);
								redirect("backend/Members");
							}
							else{
								$this->session->set_flashdata('error_message', 'Failed to edit member id = '.$this->input->post('mem_id').'. Error code: '.$err);
								$this->load->view("backend/edit_member", $dataReg);
							}
						}
					}
					else{
						$this->load->view("backend/edit_member", $dataReg);
					}
				}
			}
			else{
				redirect('backend/Users/login');
			}
		}

		public function approve(){
			if ($this->uri->segment(4)){
				if ($this->session->userdata('use_username')){
					$err = 0;
					$this->db->trans_strict(FALSE);
					$this->db->trans_start();
					$where['mem_id'] = $this->uri->segment(4);
					$member = $this->MemberModel->get_members($where)->row();

					$data = array(
						'mem_stat' => $this->config->item('accepted'),
						'mem_payment_date' => date('Y-m-d', strtotime('+1 year')),
						'mem_app_user' => $this->session->userdata('use_id'),
						'mem_app_date' => date('Y-m-d H:i:s'),
						'mem_user' => $this->session->userdata('use_id'),
						'mem_date' => date('Y-m-d H:i:s'),
					);
					$res = $this->MemberModel->update_members($data, $where);
					if ($res){
						$kennel_data = array(
							'ken_stat' => $this->config->item('accepted'),
							'ken_app_user' => $this->session->userdata('use_id'),
							'ken_app_date' => date('Y-m-d H:i:s'),
							'ken_user' => $this->session->userdata('use_id'),
							'ken_date' => date('Y-m-d H:i:s'),
						);
						$where_kennel['ken_member_id'] = $this->uri->segment(4);
						$res2 = $this->KennelModel->update_kennels($kennel_data, $where_kennel);
						if ($res2){
							$dataLog = array(
								'log_member_id' => $member->mem_id,
								'log_name' => $member->mem_name,
								'log_address' => $member->mem_address,
								'log_mail_address' => $member->mem_mail_address,
								'log_hp' => $member->mem_hp,
								'log_kota' => $member->mem_kota,
								'log_kode_pos' => $member->mem_kode_pos,
								'log_email' => $member->mem_email,
								'log_ktp' => $member->mem_ktp,
								'log_pp' => $member->mem_pp,
								'log_app_user' => $this->session->userdata('use_id'),
								'log_app_date' => date('Y-m-d H:i:s'),
								'log_stat' => $this->config->item('accepted'),
								'log_mem_type' => $this->config->item('pro_member'),
								'log_payment_date' => date('Y-m-d', strtotime('+1 year')),
								'log_user' => $this->session->userdata('use_id'),
								'log_date' => date('Y-m-d H:i:s')
							);
							$log = $this->LogmemberModel->add_log($dataLog);
							if ($log){
								$dataKennelLog = array(
									'log_kennel_id' => $member->ken_id,
									'log_kennel_name' => $member->ken_name,
									'log_kennel_type_id' => $member->ken_type_id,
									'log_kennel_photo' => $member->ken_photo,
									'log_stat' => $this->config->item('accepted'),
									'log_app_user' => $this->session->userdata('use_id'),
									'log_app_date' => date('Y-m-d H:i:s'),
									'log_user' => $this->session->userdata('use_id'),
									'log_date' => date('Y-m-d H:i:s')
								);
								$res = $this->LogkennelModel->add_log($dataKennelLog);
								if ($res){
									$result = $this->notification_model->add(17, $member->mem_id, $member->mem_id);
									if ($result){
										$this->db->trans_complete();
										$mail = send_greeting($member->email);
										$this->session->set_flashdata('approve', TRUE);
										redirect('backend/Members/view_approve');
									}
									else{
										$err = 1;
									}
								}
								else{
									$err = 2;
								}
							}
							else{
								$err = 3;
							}
						}
						else{
							$err = 4;
						}
					}
					else{
						$err = 5;
					}
					if ($err){
						$this->db->trans_rollback();
						$this->session->set_flashdata('error_message', 'Failed to approve member id = '.$this->uri->segment(4).'. Error code: '.$err);
						redirect('backend/Members/view_approve');
					}
				}
				else{
					redirect('backend/Users/login');
				}
			}
			else{
				redirect('backend/Members/view_approve');
			}
		}

		public function reject(){
			if ($this->uri->segment(4)){
				if ($this->session->userdata('use_username')){
					$err = 0;
					$this->db->trans_strict(FALSE);
					$this->db->trans_start();
					$where['mem_id'] = $this->uri->segment(4);
					$member = $this->MemberModel->get_members($where)->row();
					
					$data['mem_stat'] = $this->config->item('rejected');
					$data['mem_user'] = $this->session->userdata('use_id');
					$data['mem_date'] = date('Y-m-d H:i:s');
					$res = $this->MemberModel->update_members($data, $where);
					if ($res){
						$dataKennel['ken_stat'] = $this->config->item('rejected');
						$dataKennel['ken_user'] = $this->session->userdata('use_id');
						$dataKennel['ken_date'] = date('Y-m-d H:i:s');
						$wheKennel['ken_member_id'] = $this->uri->segment(4);
						$res2 = $this->KennelModel->update_kennels($dataKennel, $wheKennel);
						if ($res2){
							$dataLog = array(
								'log_member_id' => $member->mem_id,
								'log_name' => $member->mem_name,
								'log_address' => $member->mem_address,
								'log_mail_address' => $member->mem_mail_address,
								'log_hp' => $member->mem_hp,
								'log_kota' => $member->mem_kota,
								'log_kode_pos' => $member->mem_kode_pos,
								'log_email' => $member->mem_email,
								'log_ktp' => $member->mem_ktp,
								'log_pp' => $member->mem_pp,
								'log_user' => $this->session->userdata('use_id'),
								'log_date' => date('Y-m-d H:i:s'),
								'log_stat' => $this->config->item('rejected'),
								'log_mem_type' => $this->config->item('pro_member'),
							);
							$log = $this->LogmemberModel->add_log($dataLog);
							if ($log){
								$dataKennelLog = array(
									'log_kennel_id' => $member->ken_id,
									'log_kennel_name' => $member->ken_name,
									'log_kennel_type_id' => $member->ken_type_id,
									'log_kennel_photo' => $member->ken_photo,
									'log_stat' => $this->config->item('rejected'),
									'log_user' => $this->session->userdata('use_id'),
									'log_date' => date('Y-m-d H:i:s')
								);
								$res = $this->LogkennelModel->add_log($dataKennelLog);
								if ($res){
									$this->db->trans_complete();
									$this->session->set_flashdata('reject', TRUE);
									redirect('backend/Members/view_approve');
								}
								else{
									$err = 1;
								}
							}
							else{
								$err = 2;
							}
						}
						else{
							$err = 3;
						}
					}
					else{
						$err = 4;
					}
					if ($err){
						$this->db->trans_rollback();
						$this->session->set_flashdata('error_message', 'Failed to reject member id = '.$this->uri->segment(4).'. Error code: '.$err);
						redirect('backend/Members/view_approve');
					}
				}
				else{
					redirect('backend/Users/login');
				}
			}
			else{
				redirect('backend/Members/view_approve');
			}
		}

		public function delete(){
			if ($this->uri->segment(4)){
				if ($this->session->userdata('use_username')){
					$err = 0;
					$where['mem_id'] = $this->uri->segment(4);
					$member = $this->MemberModel->get_members($where)->row();
					$data = array(
						'mem_user' => $this->session->userdata('use_id'),
						'mem_date' => date('Y-m-d H:i:s'),
						'mem_stat' => $this->config->item('rejected'),
					);
					$this->db->trans_strict(FALSE);
					$this->db->trans_start();
					$res = $this->MemberModel->update_members($data, $where);
					if ($res){
						$dataKennel['ken_stat'] = $this->config->item('rejected');
						$dataKennel['ken_user'] = $this->session->userdata('use_id');
						$dataKennel['ken_date'] = date('Y-m-d H:i:s');
						$wheKennel['ken_member_id'] = $this->uri->segment(4);
						$res2 = $this->KennelModel->update_kennels($dataKennel, $wheKennel);
						if ($res2){
							$dataLog = array(
								'log_member_id' => $this->uri->segment(4),
								'log_user' => $this->session->userdata('use_id'),
								'log_date' => date('Y-m-d H:i:s'),
								'log_stat' => $this->config->item('rejected'),
							);
							$log = $this->LogmemberModel->add_log($dataLog);
							if ($log){
								$dataKennelLog = array(
									'log_kennel_id' => $member->ken_id,
									'log_stat' => $this->config->item('rejected'),
									'log_user' => $this->session->userdata('use_id'),
									'log_date' => date('Y-m-d H:i:s')
								);
								$res = $this->LogkennelModel->add_log($dataKennelLog);
								if ($res){
									$this->db->trans_complete();
									$this->session->set_flashdata('delete_success', TRUE);
									redirect("backend/Members");
								}
								else{
									$err = 1;
								}
							}
							else{
								$err = 2;
							}
						}
						else{
							$err = 3;
						}
					}
					else{
						$err = 4;
					}
					if ($err){ 
						$this->db->trans_rollback();
						$this->session->set_flashdata('error_message', 'Failed to delete member id = '.$this->uri->segment(4).'. Error code: '.$err);
						redirect("backend/Members");
					}
				}
				else{
					redirect('backend/Users/login');
				}
			}
			else{
				redirect('backend/Members');
			}
		}

		public function payment(){
			if ($this->uri->segment(4)){
				if ($this->session->userdata('use_username')){
					$this->db->trans_strict(FALSE);
					$this->db->trans_start();
					$where['mem_id'] = $this->uri->segment(4);
					$data['mem_payment_date'] = date('Y-m-d', strtotime('+1 year'));
					$data['mem_type'] = $this->config->item('pro_member');
					$data['mem_user'] = $this->session->userdata('use_id');
					$data['mem_date'] = date('Y-m-d H:i:s');
					$res = $this->MemberModel->update_members($data, $where);
					if ($res){
						$err = 0;
						$dataLog = array(
							'log_member_id' => $this->uri->segment(4),
							'log_payment_date' => date('Y-m-d', strtotime('+1 year')),
							'log_user' => $this->session->userdata('use_id'),
							'log_date' => date('Y-m-d H:i:s'),
							'log_mem_type' => $this->config->item('pro_member'),
						);
						$log = $this->LogmemberModel->add_log($dataLog);
						if ($log){
							$res = $this->notification_model->add(19, $this->uri->segment(4), $this->uri->segment(4));
							if ($res){
								$this->db->trans_complete();
								$member = $this->MemberModel->get_members($where)->row();
								if ($member->mem_firebase_token){
									$notif = $this->notificationtype_model->get_by_id(19);
									firebase_notif($member->mem_firebase_token, $notif[0]->title, $notif[0]->description);
								}
								$this->session->set_flashdata('payment_success', TRUE);
								redirect('backend/Members');
							}
							else{
								$err = 1;
							}
						}
						else{
							$err = 2;
						}
					}
					else{
						$err = 3;
					}
					if ($err){
						$this->session->set_flashdata('error_message', 'Failed to set payment for member id = '.$this->uri->segment(4).'. Error code: '.$err);
						redirect('backend/Members');
					}
				}
				else{
					redirect('backend/Users/login');
				}
			}
			else{
				redirect('backend/Members');
			}
		}

		public function view_reset(){
			if ($this->uri->segment(4)){
				$where['mem_id'] = $this->uri->segment(4);
				$data['member'] = $this->MemberModel->get_members($where)->row();
				if (!$data['member']) {
					$this->session->set_flashdata('error_message', 'Not found');
					redirect("backend/Members");
				}
				else{
					$this->load->view("backend/reset_password", $data);
				}
			}
			else{
				redirect("backend/Members");
			}
		}

		public function reset(){
			if ($this->session->userdata('use_username')){
				$where['mem_id'] = $this->input->post('mem_id');
				$data['member'] = $this->MemberModel->get_members($where)->row();
				if (!$data['member']) {
					$err = 1;
					$this->session->set_flashdata('error_message', 'Not found');
					redirect("backend/Members");
				}
				else{
					$this->form_validation->set_error_delimiters('<div>','</div>');
					$this->form_validation->set_rules('newpass', 'New Password ', 'trim|required');
					$this->form_validation->set_rules('repass', 'Confirmation password ', 'trim|matches[newpass]');

					if ($this->form_validation->run() == FALSE){
						$this->load->view("backend/reset_password", $data);
					}
					else{
						$dataMember['mem_password'] = sha1($this->input->post('newpass'));
						$res = $this->MemberModel->update_members($dataMember, $where);
						if ($res){
							$this->session->set_flashdata('reset_password', TRUE);
							redirect("backend/Members");
						}
						else{
							$err = 2;
							$this->session->set_flashdata('error_message', 'Failed to reset password');
						}
						if ($err){
							$this->load->view('backend/reset_password', $data);
						}
					}
				}
			}
		}
}
