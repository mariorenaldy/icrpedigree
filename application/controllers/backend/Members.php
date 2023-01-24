<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Members extends CI_Controller {
		public function __construct(){
			// Call the CI_Controller constructor
			parent::__construct();
			$this->load->model(array('MemberModel', 'KennelModel', 'LogmemberModel', 'LogkennelModel', 'notification_model', 'notificationtype_model', 'KenneltypeModel'));
			$this->load->library('upload', $this->config->item('upload_member'));
			$this->load->library(array('session', 'form_validation'));
			$this->load->library('email', $this->config->item('email'));
			$this->email->set_newline("\r\n");
			$this->load->helper(array('url'));
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
			$where['mem_stat'] = $this->config->item('accepted');
			$data['member'] = $this->MemberModel->get_members($where)->result();
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
			$where['mem_stat'] = $this->config->item('accepted');
			if ($this->input->post('mem_type') == $this->config->item('all_member'))
				$where['mem_type IN ('.$this->config->item('pro_member').', '.$this->config->item('free_member').')'] = null;
			else
				$where['mem_type'] = $this->input->post('mem_type');
			$data['member'] = $this->MemberModel->search_members($like, $where)->result();
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

		public function approve(){
			if ($this->uri->segment(4)){
				if ($this->session->userdata('use_username')){
					$err = 0;
					$this->db->trans_strict(FALSE);
					$this->db->trans_start();
					$where['mem_id'] = $this->uri->segment(4);
					$member = $this->MemberModel->get_members($where)->row();

					$data['mem_stat'] = $this->config->item('accepted');
					$data['mem_payment_date'] = date('Y-m-d', strtotime('+1 year'));
					$data['mem_app_user'] = $this->session->userdata('use_id');
					$data['mem_app_date'] = date('Y-m-d H:i:s');
					$res = $this->MemberModel->update_members($data, $where);
					if ($res){
						$kennel_data = array(
							'ken_stat' => $this->config->item('accepted'),
							'ken_app_user' => $this->session->userdata('use_id'),
							'ken_app_date' => date('Y-m-d H:i:s'),
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
									'log_app_date' => date('Y-m-d H:i:s')
								);
								$res = $this->LogkennelModel->add_log($dataKennelLog);
								if ($res){
									$this->db->trans_complete();
									
									$this->email->set_mailtype('html');
									$this->email->from($this->config->item('email')['smtp_user'], 'ICR Pedigree Customer Service');
									$this->email->to($member->email);
									$this->email->subject('Register Berhasil');

									$message = '<div>Kepada pengguna ICR Pedigree,</div>';
									$message .= '<div>Admin sudah approve keanggotaan anda di ICR Pedigree. Silakan lakukan login untuk mengakses aplikasi ICR Pedigree.</div>';
									$message .= '<div>Salam </div>';
									$message .= '<div>ICR Pedigree Customer Service</div>';
									$message .= '<div><br/><hr/></div>';

									$this->email->message($message);
									$res = $this->email->send();

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
					$data['mem_app_user'] = $this->session->userdata('use_id');
					$data['mem_app_date'] = date('Y-m-d H:i:s');
					$res = $this->MemberModel->update_members($data, $where);
					if ($res){
						$dataKennel['ken_stat'] = $this->config->item('rejected');
						$dataKennel['ken_app_user'] = $this->session->userdata('use_id');
						$dataKennel['ken_app_date'] = date('Y-m-d H:i:s');
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
								'log_app_user' => $this->session->userdata('use_id'),
								'log_app_date' => date('Y-m-d H:i:s'),
								'log_stat' => $this->config->item('rejected'),
							);
							$log = $this->LogmemberModel->add_log($dataLog);
							if ($log){
								$dataKennelLog = array(
									'log_kennel_id' => $member->ken_id,
									'log_kennel_name' => $member->ken_name,
									'log_kennel_type_id' => $member->ken_type_id,
									'log_kennel_photo' => $member->ken_photo,
									'log_stat' => $this->config->item('rejected'),
									'log_app_user' => $this->session->userdata('use_id'),
									'log_app_date' => date('Y-m-d H:i:s')
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

		public function payment(){
			if ($this->uri->segment(4)){
				if ($this->session->userdata('use_username')){
					$this->db->trans_strict(FALSE);
					$this->db->trans_start();
					$where['mem_id'] = $this->uri->segment(4);
					$data['mem_payment_date'] = date('Y-m-d', strtotime('+1 year'));
					$data['mem_stat'] = $this->config->item('pro_member');
					$res = $this->MemberModel->update_members($data, $where);
					if ($res){
						$err = 0;
						$res2 = $this->notification_model->add(19, $this->uri->segment(4), $this->uri->segment(4));
						if ($res2){
							$this->db->trans_complete();
							$member = $this->MemberModel->get_members($where)->row();
							if ($member->mem_firebase_token){
								$notif = $this->notificationtype_model->get_by_id(19);
								$url = 'https://fcm.googleapis.com/fcm/send';
								$key = 'AAAALe2LeZU:APA91bEqr2n1PRxkOyOfx8IwYO1O_1gjprFkq1AITOGUu3GYp2ZBi-8-AvM4ADI3m94NEv4cq-uKcMBU3pJXBhO21CyuVgPNX2l7VYXj5IllxEr6sika8eaJp1IgXCHALA5_xYw92pXK';

								$fields = array (
									'to' => $member->mem_firebase_token,
									'notification' => array(
									"channelId" => "ICRPedigree",
									'title' => $notif[0]->title,
									'body' => $notif[0]->description
									)
								);
								$fields = json_encode ( $fields );

								$headers = array (
									'Authorization: key=' . $key,
									'Content-Type: application/json'
								);

								$ch = curl_init ();
								curl_setopt ( $ch, CURLOPT_URL, $url );
								curl_setopt ( $ch, CURLOPT_POST, true );
								curl_setopt ( $ch, CURLOPT_HTTPHEADER, $headers );
								curl_setopt ( $ch, CURLOPT_RETURNTRANSFER, true );
								curl_setopt ( $ch, CURLOPT_POSTFIELDS, $fields );

								$result = curl_exec ( $ch );
								// echo $result;
								curl_close ( $ch );
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
	
					if (!$err && $this->input->post('mem_type') == $this->config->item('pro_member') && $this->KennelModel->check_for_duplicate(0, 'ken_name', $this->input->post('ken_name'))){
						$err++;
						$this->session->set_flashdata('error_message', 'Duplicate kennel name');
					}
	
					if (!$err){
						$mem_id = $this->MemberModel->record_count() + 1;
						if ($this->input->post('mem_type')){
							$data = array(
								'mem_id' => $mem_id,
								'mem_name' => $this->input->post('mem_name'),
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
								'ken_app_date' => date('Y-m-d H:i:s')
							);

							$dataLog = array(
								'log_member_id' => $mem_id,
								'log_name' => $this->input->post('mem_name'),
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
							);

							$dataKennelLog = array(
								'log_kennel_id' => $ken_id,
								'log_kennel_name' => strtoupper($this->input->post('ken_name')),
								'log_kennel_type_id' => $this->input->post('ken_type_id'),
								'log_kennel_photo' => $logo,
								'log_stat' => $this->config->item('accepted'),
								'log_app_user' => $this->session->userdata('use_id'),
								'log_app_date' => date('Y-m-d H:i:s')
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
								'mem_name' => $this->input->post('name'),
								'mem_hp' => $this->input->post('hp'),
								'mem_email' => $this->input->post('email'),
								'mem_username' => $this->input->post('email'),
								'mem_password' => sha1($this->input->post('hp')),
								'mem_stat' => $this->config->item('accepted'),
								'mem_type' => $this->config->item('free_member'),
							);
	
							$ken_id = $this->KennelModel->record_count() + 1;
							$kennel_data = array(
								'ken_id' => $ken_id,
								'ken_name' => '',
								'ken_type_id' => 0,
								'ken_photo' => '-',
								'ken_member_id' => $mem_id,
								'ken_stat' => $this->config->item('accepted'),
							);

							$dataLog = array(
								'log_member_id' => $mem_id,
								'log_name' => $this->input->post('name'),
								'log_hp' => $this->input->post('hp'),
								'log_email' => $this->input->post('email'),
								'log_pp' => '-',
								'log_app_user' => $this->session->userdata('use_id'),
								'log_app_date' => date('Y-m-d H:i:s'),
								'log_stat' => $this->config->item('accepted'),
							);

							$dataKennelLog = array(
								'log_kennel_id' => $ken_id,
								'log_kennel_type_id' => 0,
								'log_kennel_photo' => '-',
								'log_stat' => $this->config->item('accepted'),
								'log_app_user' => $this->session->userdata('use_id'),
								'log_app_date' => date('Y-m-d H:i:s')
							);
						}
		
						$this->db->trans_strict(FALSE);
						$this->db->trans_start();
						$id = $this->MemberModel->add_members($data);
						if ($id){
							$res = $this->KennelModel->add_kennels($kennel_data);
							if ($res){
								$log = $this->LogmemberModel->add_log($dataLog);
								if ($log){
									$res = $this->LogkennelModel->add_log($dataKennelLog);
									if ($res){
										$this->db->trans_complete();

										$this->email->set_mailtype('html');
										$this->email->from($this->config->item('email')['smtp_user'], 'ICR Pedigree Customer Service');
										$this->email->to($this->input->post('mem_email'));
										$this->email->subject('Register Berhasil');

										$message = '<div>Kepada pengguna ICR Pedigree,</div>';
										$message .= '<div>Admin sudah approve keanggotaan anda di ICR Pedigree. Silakan lakukan login untuk mengakses aplikasi ICR Pedigree.</div>';
										$message .= '<div>Salam </div>';
										$message .= '<div>ICR Pedigree Customer Service</div>';
										$message .= '<div><br/><hr/></div>';

										$this->email->message($message);
										$res = $this->email->send();

										$this->session->set_flashdata('add_success', TRUE);
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
								'mem_name' => $this->input->post('mem_name'),
								'mem_address' => $this->input->post('mem_address'),
								'mem_mail_address' => $this->input->post('mem_mail_address'),
								'mem_hp' => $this->input->post('mem_hp'),
								'mem_kota' => $this->input->post('mem_kota'),
								'mem_kode_pos' => $this->input->post('mem_kode_pos'),
								'mem_email' => $this->input->post('mem_email'),
								'mem_ktp' => $this->input->post('mem_ktp'),
							);
							if ($pp != '-')
								$data['mem_pp'] = $pp;

							$kennel_data = array(
								'ken_name' => strtoupper($this->input->post('ken_name')),
								'ken_type_id' => $this->input->post('ken_type_id'),
							);
							if ($logo != '-')
								$kennel_data['ken_photo'] = $logo;
							
							$dataLog = array(
								'log_member_id' => $this->input->post('mem_id'),
								'log_name' => $this->input->post('mem_name'),
								'log_address' => $this->input->post('mem_address'),
								'log_mail_address' => $this->input->post('mem_mail_address'),
								'log_hp' => $this->input->post('mem_hp'),
								'log_kota' => $this->input->post('mem_kota'),
								'log_kode_pos' => $this->input->post('mem_kode_pos'),
								'log_email' => $this->input->post('mem_email'),
								'log_ktp' => $this->input->post('mem_ktp'),
								'log_pp' => $pp,
								'log_app_user' => $this->session->userdata('use_id'),
								'log_app_date' => date('Y-m-d H:i:s'),
								'log_stat' => $this->config->item('accepted'),
							);
	
							$dataKennelLog = array(
								'log_kennel_id' => $this->input->post('ken_id'),
								'log_kennel_name' => strtoupper($this->input->post('ken_name')),
								'log_kennel_type_id' => $this->input->post('ken_type_id'),
								'log_kennel_photo' => $logo,
								'log_stat' => $this->config->item('accepted'),
								'log_app_user' => $this->session->userdata('use_id'),
								'log_app_date' => date('Y-m-d H:i:s')
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
								'mem_name' => $this->input->post('name'),
								'mem_hp' => $this->input->post('hp'),
								'mem_email' => $this->input->post('email'),
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

		public function delete(){
			if ($this->uri->segment(4)){
				if ($this->session->userdata('use_username')){
					$err = 0;
					$this->db->trans_strict(FALSE);
					$this->db->trans_start();
					$where['mem_id'] = $this->uri->segment(4);
					$member = $this->MemberModel->get_members($where)->row();

					$data = array(
						'mem_app_user' => $this->session->userdata('use_id'),
						'mem_app_date' => date('Y-m-d H:i:s'),
						'mem_stat' => $this->config->item('rejected'),
					);
					$res = $this->MemberModel->update_members($data, $where);
					if ($res){
						$dataKennel['ken_stat'] = $this->config->item('rejected');
						$dataKennel['ken_app_user'] = $this->session->userdata('use_id');
						$dataKennel['ken_app_date'] = date('Y-m-d H:i:s');
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
								'log_app_user' => $this->session->userdata('use_id'),
								'log_app_date' => date('Y-m-d H:i:s'),
								'log_stat' => $this->config->item('rejected'),
							);
							$log = $this->LogmemberModel->add_log($dataLog);
							if ($log){
								$dataKennelLog = array(
									'log_kennel_id' => $member->ken_id,
									'log_kennel_name' => $member->ken_name,
									'log_kennel_type_id' => $member->ken_type_id,
									'log_kennel_photo' => $member->ken_photo,
									'log_stat' => $this->config->item('rejected'),
									'log_app_user' => $this->session->userdata('use_id'),
									'log_app_date' => date('Y-m-d H:i:s')
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

		public function request(){
			$user = $this->session->userdata('user_data');
			$data['users'] = $user;
			$data['navigations'] = $this->navigations;
	  
			$this->twig->display('backend/requests_member', $data);
		}
	  
		public function request_data(){
			$aColumns = array('log_id', 'log_name', 'log_address', 'log_photo', 'log_kennel_photo', 'log_kennel_name', 'log_hp', 'log_email', 'log_kota', 'log_kode_pos', 'use_username', 'log_app_date', 'log_tanggal', 'stat_name', 'mem_photo', 'kennels.ken_photo', 'mem_name', 'mem_address', 'mem_kode_pos', 'mem_hp', 'mem_email', 'ken_name', 'mem_kota');
			$sTable = 'logs_member';
	  
			$iDisplayStart = $this->input->get_post('start', true);
			$iDisplayLength = $this->input->get_post('length', true);
			$sSearch = $this->input->post('search', true);
			$sEcho = $this->input->get_post('sEcho', true);
			$columns = $this->input->get_post('columns', true);
			$orders = $this->input->get_post('order', true);
	  
			// Paging
			if(isset($iDisplayStart) && $iDisplayLength != '-1'){
				$this->db->limit($this->db->escape_str($iDisplayLength), $this->db->escape_str($iDisplayStart));
			}
	  
			// Ordering
			if(isset($orders[0]['column'])){
				// for($i=0; $i<intval($columns); $i++){
					// $iSortCol = $this->input->get_post('iSortCol_'.$i, true);
					// $bSortable = $this->input->get_post('bSortable_'.intval($iSortCol), true);
					$bSortable = $columns[$orders[0]['column']]['orderable'];
					// $sSortDir = $this->input->get_post('sSortDir_'.$i, true);
	  
					if($bSortable == 'true')
					{
						$this->db->order_by($columns[$orders[0]['column']]['data'], $orders[0]['dir']);
						// $this->db->order_by($aColumns[intval($this->db->escape_str($iSortCol))], $this->db->escape_str($sSortDir));
					}
				// }
			}
	  
			/*
			  * Filtering
			  * NOTE this does not match the built-in DataTables filtering which does it
			  * word by word on any field. It's possible to do here, but concerned about efficiency
			  * on very large tables, and MySQL's regex functionality is very limited
			  */
			if(isset($sSearch['value']) && !empty($sSearch['value'])){
				// ARTechnology
				for($i=0; $i<count($columns); $i++){
				// ARTechnology
	  
					// $bSearchable = $this->input->get_post('bSearchable_'.$i, true);
					$bSearchable = $columns[$i]['searchable'];
	  
					// Individual column filtering
					if(isset($bSearchable) && $bSearchable == 'true')
					{
						for($j=0; $j<count($aColumns); $j++){
						  $this->db->or_like($aColumns[$j], $this->db->escape_like_str($sSearch['value']));
						}
					}
				}
			}
	  
			// Select Data
			$this->db->select('SQL_CALC_FOUND_ROWS '.str_replace(' , ', ' ', implode(', ', $aColumns)), false);
			$this->db->join('members','members.mem_id = logs_member.log_member_id');
			$this->db->join('kennels','kennels.ken_id = logs_member.log_kennel_id');
			$this->db->join('users','users.use_id = logs_member.log_app_user');
			$this->db->join('approval_status','approval_status.stat_id = logs_member.log_stat');
			$this->db->where('log_stat', 0);
			$this->db->order_by('log_tanggal', 'desc');
			$rResult = $this->db->get($sTable);
			
			// Data set length after filtering
			$this->db->select('FOUND_ROWS() AS found_rows');
			$iFilteredTotal = $this->db->get()->row()->found_rows;
	  
			// Total data set length
			$iTotal = $this->db->count_all($sTable);
	  
			// Output
			$output = array(
				'sEcho' => intval($sEcho),
				'iTotalRecords' => $iTotal,
				'iTotalDisplayRecords' => $iFilteredTotal,
				'aaData' => array()
			);
	  
			foreach($rResult->result_array() as $i => $aRow){
				$row = array();
	  
				// foreach($aColumns as $col){
				// 		if($col == 'stock')
				//     $row[$col] = $aRow[$col];
				// }
				$output['aaData'][] = $aRow;
			}
	  
			echo json_encode($output);
		}
	  
		public function approve_profile($id = null){
			if ($id){
				$whe['log_id'] = $id;
				$req = $this->LogmemberModel->get_logs($whe)->row();
		
				$where['mem_id'] = $req->log_member_id;
				$member = $this->MemberModel->get_members($where)->row();
	  
				$whe_ken['ken_id'] = $req->log_kennel_id;
				$kennel = $this->KennelModel->get_kennels($whe_ken)->row();

				$data = array(
					'mem_name' => $req->log_name,
					'mem_address' => $req->log_address,
					'mem_mail_address' => $req->log_mail_address,
					'mem_hp' => $req->log_hp,
					'mem_kota' => $req->log_kota,
					'mem_kode_pos' => $req->log_kode_pos,
					'mem_email' => $req->log_email
				);

				$data_kennel = array(
					'ken_name' => $req->log_kennel_name,
					'ken_type_id' => $req->log_kennel_type_id
				);

				if ($req->log_pp != ''){
					$data['mem_pp'] = $req->log_pp;
					$curr_image = $this->path_upload.basename($member->mem_pp);
					if(file_exists($curr_image)){
					unlink($curr_image);
					}
				}

				if ($req->log_kennel_photo != ''){
					$data_kennel['ken_photo'] = $req->log_kennel_photo;
					$curr_image = $this->path_upload.basename($kennel->ken_photo);
					if(file_exists($curr_image)){
					unlink($curr_image);
					}
				}
	  
				$this->db->trans_strict(FALSE);
				$this->db->trans_start();
				$this->MemberModel->update_members($data, $where);
				$this->KennelModel->update_kennels($data_kennel, $whe_ken);
				$res2 = $this->LogmemberModel->update_status($id, 1);
				if ($res2){
					if ($member->mem_id){
					$res3 = $this->notification_model->add(9, $req->log_id, $member->mem_id);
	
					if ($member->mem_firebase_token){
						$notif = $this->notificationtype_model->get_by_id(9);
						$url = 'https://fcm.googleapis.com/fcm/send';
						$key = 'AAAALe2LeZU:APA91bEqr2n1PRxkOyOfx8IwYO1O_1gjprFkq1AITOGUu3GYp2ZBi-8-AvM4ADI3m94NEv4cq-uKcMBU3pJXBhO21CyuVgPNX2l7VYXj5IllxEr6sika8eaJp1IgXCHALA5_xYw92pXK';
			
						$fields = array (
						'to' => $member->mem_firebase_token,
						'notification' => array(
							"channelId" => "ICRPedigree",
							'title' => $notif[0]->title,
							'body' => $notif[0]->description
						)
						);
						$fields = json_encode ( $fields );
			
						$headers = array (
							'Authorization: key=' . $key,
							'Content-Type: application/json'
						);
			
						$ch = curl_init ();
						curl_setopt ( $ch, CURLOPT_URL, $url );
						curl_setopt ( $ch, CURLOPT_POST, true );
						curl_setopt ( $ch, CURLOPT_HTTPHEADER, $headers );
						curl_setopt ( $ch, CURLOPT_RETURNTRANSFER, true );
						curl_setopt ( $ch, CURLOPT_POSTFIELDS, $fields );
			
						$result = curl_exec ( $ch );
						// echo $result;
						curl_close ( $ch );
					}
					}
					$this->db->trans_complete();
					echo json_encode(array('data' => '1'));
				}
				else{
					$this->db->trans_rollback();
					echo json_encode(array('data' => 'Request dengan id = '.$id.' tidak dapat di-approve'));
				}
			}
		}
	  
		public function reject_profile($id = null){
			if ($id){
			  $this->db->trans_strict(FALSE);
			  $this->db->trans_start();
			  $res = $this->LogmemberModel->update_status($id, 2);
			  if ($res){
				$whe['log_id'] = $id;
				$req = $this->LogmemberModel->get_logs($whe)->row();
	  
				if ($req->log_member_id){
				  $result = $this->notification_model->add(10, $id, $req->log_member_id);
	  
				  $whe_can['mem_id'] = $req->log_member_id;
				  $member = $this->MemberModel->get_members($whe_can)->row();
				  if ($member->mem_firebase_token){
					$notif = $this->notificationtype_model->get_by_id(10);
					$url = 'https://fcm.googleapis.com/fcm/send';
					$key = 'AAAALe2LeZU:APA91bEqr2n1PRxkOyOfx8IwYO1O_1gjprFkq1AITOGUu3GYp2ZBi-8-AvM4ADI3m94NEv4cq-uKcMBU3pJXBhO21CyuVgPNX2l7VYXj5IllxEr6sika8eaJp1IgXCHALA5_xYw92pXK';
		
					$fields = array (
					  'to' => $member->mem_firebase_token,
					  'notification' => array(
						"channelId" => "ICRPedigree",
						'title' => $notif[0]->title,
						'body' => $notif[0]->description
					  )
					);
					$fields = json_encode ( $fields );
		
					$headers = array (
						'Authorization: key=' . $key,
						'Content-Type: application/json'
					);
		
					$ch = curl_init ();
					curl_setopt ( $ch, CURLOPT_URL, $url );
					curl_setopt ( $ch, CURLOPT_POST, true );
					curl_setopt ( $ch, CURLOPT_HTTPHEADER, $headers );
					curl_setopt ( $ch, CURLOPT_RETURNTRANSFER, true );
					curl_setopt ( $ch, CURLOPT_POSTFIELDS, $fields );
		
					$result = curl_exec ( $ch );
					// echo $result;
					curl_close ( $ch );
				  }
				}
				$this->db->trans_complete();
				echo json_encode(array('data' => '1'));
			  }
			  else{
				$this->db->trans_rollback();
				echo json_encode(array('data' => 'Request dengan id = '.$id.' tidak dapat di-reject'));
			  }
			}
		}
	  
		public function logs_request(){
			$user = $this->session->userdata('user_data');
			$data['users'] = $user;
			$data['navigations'] = $this->navigations;
			
			$this->twig->display('backend/logsRequest_member', $data);
		}
	  
		public function data_logs_request(){
			$aColumns = array('log_id', 'log_name', 'log_address', 'log_photo', 'log_kennel_photo', 'log_kennel_name', 'log_hp', 'log_email', 'log_kota', 'log_kode_pos', 'use_username', 'log_app_date', 'log_tanggal', 'stat_name', 'mem_photo', 'kennels.ken_photo', 'mem_name', 'mem_address', 'mem_kode_pos', 'mem_hp', 'mem_email', 'ken_name', 'mem_kota');
			$sTable = 'logs_member';
	  
			$iDisplayStart = $this->input->get_post('start', true);
			$iDisplayLength = $this->input->get_post('length', true);
			$sSearch = $this->input->post('search', true);
			$sEcho = $this->input->get_post('sEcho', true);
			$columns = $this->input->get_post('columns', true);
			$orders = $this->input->get_post('order', true);
	  
			// Paging
			if(isset($iDisplayStart) && $iDisplayLength != '-1'){
				$this->db->limit($this->db->escape_str($iDisplayLength), $this->db->escape_str($iDisplayStart));
			}
	  
			// Ordering
			if(isset($orders[0]['column'])){
				// for($i=0; $i<intval($columns); $i++){
					// $iSortCol = $this->input->get_post('iSortCol_'.$i, true);
					// $bSortable = $this->input->get_post('bSortable_'.intval($iSortCol), true);
					$bSortable = $columns[$orders[0]['column']]['orderable'];
					// $sSortDir = $this->input->get_post('sSortDir_'.$i, true);
	  
					if($bSortable == 'true')
					{
						$this->db->order_by($columns[$orders[0]['column']]['data'], $orders[0]['dir']);
						// $this->db->order_by($aColumns[intval($this->db->escape_str($iSortCol))], $this->db->escape_str($sSortDir));
					}
				// }
			}
	  
			/*
			  * Filtering
			  * NOTE this does not match the built-in DataTables filtering which does it
			  * word by word on any field. It's possible to do here, but concerned about efficiency
			  * on very large tables, and MySQL's regex functionality is very limited
			  */
			if(isset($sSearch['value']) && !empty($sSearch['value'])){
				// ARTechnology
				for($i=0; $i<count($columns); $i++){
				// ARTechnology
	  
					// $bSearchable = $this->input->get_post('bSearchable_'.$i, true);
					$bSearchable = $columns[$i]['searchable'];
	  
					// Individual column filtering
					if(isset($bSearchable) && $bSearchable == 'true')
					{
						for($j=0; $j<count($aColumns); $j++){
						  $this->db->or_like($aColumns[$j], $this->db->escape_like_str($sSearch['value']));
						}
					}
				}
			}
	  
			// Select Data
			$this->db->select('SQL_CALC_FOUND_ROWS '.str_replace(' , ', ' ', implode(', ', $aColumns)), false);
			$this->db->join('members','members.mem_id = logs_member.log_member_id');
			$this->db->join('kennels','kennels.ken_id = logs_member.log_kennel_id');
			$this->db->join('users','users.use_id = logs_member.log_app_user');
			$this->db->join('approval_status','approval_status.stat_id = logs_member.log_stat');
			$this->db->where('log_stat <>', 0);
			$this->db->order_by('log_tanggal', 'desc');
			$rResult = $this->db->get($sTable);
			
			// Data set length after filtering
			$this->db->select('FOUND_ROWS() AS found_rows');
			$iFilteredTotal = $this->db->get()->row()->found_rows;
	  
			// Total data set length
			$iTotal = $this->db->count_all($sTable);
	  
			// Output
			$output = array(
				'sEcho' => intval($sEcho),
				'iTotalRecords' => $iTotal,
				'iTotalDisplayRecords' => $iFilteredTotal,
				'aaData' => array()
			);
	  
			foreach($rResult->result_array() as $i => $aRow){
				$row = array();
	  
				// foreach($aColumns as $col){
				// 		if($col == 'stock')
				//     $row[$col] = $aRow[$col];
				// }
				$output['aaData'][] = $aRow;
			}
	  
			echo json_encode($output);
		}
}
