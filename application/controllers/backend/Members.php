<?php
defined('BASEPATH') OR exit('No direct script access allowed');

#[\AllowDynamicProperties]

class Members extends CI_Controller {
		public function __construct(){
			// Call the CI_Controller constructor
			parent::__construct();
			$this->load->model(array('MemberModel', 'KennelModel', 'LogmemberModel', 'LogkennelModel', 'notification_model', 'notificationtype_model', 'KenneltypeModel', 'CaninesModel'));
			$this->load->library(array('session', 'form_validation', 'pagination'));
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
			$this->updateToFree();
            $page = ($this->uri->segment(4)) ? ($this->uri->segment(4) - 1) : 0;
            $config['per_page'] = $this->config->item('backend_member_count');
            $config['uri_segment'] = 4;
            $config['use_page_numbers'] = TRUE;

            //Encapsulate whole pagination 
            $config['full_tag_open'] = '<ul class="pagination justify-content-end">';
            $config['full_tag_close'] = '</ul>';

            //First link of pagination
            $config['first_link'] = 'First';
            $config['first_tag_open'] = '<li>';
            $config['first_tag_close'] = '</li>';

            //Customizing the “Digit” Link
            $config['num_tag_open'] = '<li>';
            $config['num_tag_close'] = '</li>';

            //For PREVIOUS PAGE Setup
            $config['prev_link'] = '<';
            $config['prev_tag_open'] = '<li>';
            $config['prev_tag_close'] = '</li>';

            //For NEXT PAGE Setup
            $config['next_link'] = '>';
            $config['next_tag_open'] = '<li>';
            $config['next_tag_close'] = '</li>';

            //For LAST PAGE Setup
            $config['last_link'] = 'Last';
            $config['last_tag_open'] = '<li>';
            $config['last_tag_close'] = '</li>';

            //For CURRENT page on which you are
            $config['cur_tag_open'] = '<li class="active"><a class="page-link bg-primary text-light border-primary" href="#">';
            $config['cur_tag_close'] = '</a></li>';

            $config['attributes'] = array('class' => 'page-link bg-light text-primary');

			$where['mem_type'] = $this->config->item('pro_member');
			// $where['mem_stat'] = $this->config->item('accepted');
			$where['mem_stat !='] = $this->config->item('processed');
			$where['mem_id !='] = 0;
			// $where['ken_stat'] = $this->config->item('accepted');
			$where['ken_stat !='] = $this->config->item('processed');
			$data['member'] = $this->MemberModel->get_members($where, 'mem_app_date2 desc', $page * $config['per_page'], $this->config->item('backend_member_count'))->result();

            $config['base_url'] = base_url().'/backend/Members/index';
            $config['total_rows'] = $this->MemberModel->get_members($where, 'mem_app_date2 desc', $page * $config['per_page'], 0)->num_rows();
            $this->pagination->initialize($config);

            $data['keywords'] = '';
            $data['sort_by'] = 'mem_app_date2';
            $data['sort_type'] = 'desc';
            $data['mem_type'] = $this->config->item('pro_member');
            $this->session->set_userdata('keywords', '');
            $this->session->set_userdata('sort_by', 'mem_app_date2');
            $this->session->set_userdata('sort_type', 'desc');
			$this->load->view('backend/view_members', $data);
		}

		function updateToFree(){
			$this->db->trans_strict(FALSE);
			$this->db->trans_start();

			//update all expired member type to free
			$members = $this->MemberModel->update_expired_members();
			if ($members) {
				$this->db->trans_complete();
				return true;
			} else {
				$this->db->trans_rollback();
				return false;
			}
		}

		public function search(){
			$data['mem_type'] = $this->config->item('pro_member');
			if ($this->input->post('mem_type') != null){
				$this->session->set_userdata('mem_type', $this->input->post('mem_type'));
				$data['mem_type'] = $this->input->post('mem_type');
			}
			else{
				if ($this->uri->segment(4)){
					$data['mem_type'] = $this->session->userdata('mem_type');
				}
			}
            if ($this->input->post('keywords')){
                $this->session->set_userdata('keywords', $this->input->post('keywords'));
                $data['keywords'] = $this->input->post('keywords');
            }
            else{
                if ($this->uri->segment(4)){
                    $data['keywords'] = $this->session->userdata('keywords');
                }
                else{
                    $this->session->set_userdata('keywords', '');
                    $data['keywords'] = '';
                }
            }
    
            if ($this->input->post('sort_by')){
                $this->session->set_userdata('sort_by', $this->input->post('sort_by'));
                $this->session->set_userdata('sort_type', $this->input->post('sort_type'));
                $data['sort_by'] = $this->input->post('sort_by');
                $data['sort_type'] = $this->input->post('sort_type');
            }
            else{
                $data['sort_by'] = $this->session->userdata('sort_by');
                $data['sort_type'] = $this->session->userdata('sort_type');
            }

            $page = ($this->uri->segment(4)) ? ($this->uri->segment(4) - 1) : 0;
            $config['per_page'] = $this->config->item('backend_member_count');
            $config['uri_segment'] = 4;
            $config['use_page_numbers'] = TRUE;

            //Encapsulate whole pagination 
            $config['full_tag_open'] = '<ul class="pagination justify-content-end">';
            $config['full_tag_close'] = '</ul>';

            //First link of pagination
            $config['first_link'] = 'First';
            $config['first_tag_open'] = '<li>';
            $config['first_tag_close'] = '</li>';

            //Customizing the “Digit” Link
            $config['num_tag_open'] = '<li>';
            $config['num_tag_close'] = '</li>';

            //For PREVIOUS PAGE Setup
            $config['prev_link'] = '<';
            $config['prev_tag_open'] = '<li>';
            $config['prev_tag_close'] = '</li>';

            //For NEXT PAGE Setup
            $config['next_link'] = '>';
            $config['next_tag_open'] = '<li>';
            $config['next_tag_close'] = '</li>';

            //For LAST PAGE Setup
            $config['last_link'] = 'Last';
            $config['last_tag_open'] = '<li>';
            $config['last_tag_close'] = '</li>';

            //For CURRENT page on which you are
            $config['cur_tag_open'] = '<li class="active"><a class="page-link bg-primary text-light border-primary" href="#">';
            $config['cur_tag_close'] = '</a></li>';

            $config['attributes'] = array('class' => 'page-link bg-light text-primary');

            if ($data['keywords']){
                $like['mem_name'] = $data['keywords'];
                $like['mem_hp'] = $data['keywords'];
                $like['ken_name'] = $data['keywords'];
                $like['mem_ktp'] = $data['keywords'];
            }
            else
                $like = null;

			// $where['mem_stat'] = $this->config->item('accepted');
			$where['mem_stat !='] = $this->config->item('processed');
			// $where['ken_stat'] = $this->config->item('accepted');
			$where['ken_stat !='] = $this->config->item('processed');
			// if ($data['mem_type'] == $this->config->item('all_member'))
			// 	$where['mem_type IN ('.$this->config->item('pro_member').', '.$this->config->item('free_member').')'] = null;
			// else
			// 	$where['mem_type'] = $data['mem_type'];
			if ($data['mem_type'] != $this->config->item('all_member'))
				$where['mem_type'] = $data['mem_type'];
			$where['mem_id !='] = 0;
			$data['member'] = $this->MemberModel->search_members($like, $where, $data['sort_by'].' '.$data['sort_type'], $page * $config['per_page'], $this->config->item('backend_member_count'))->result();

			// var_dump($data['member']);
            $config['base_url'] = base_url().'/backend/Members/search';
            $config['total_rows'] = $this->MemberModel->search_members($like, $where, $data['sort_by'].' '.$data['sort_type'], $page * $config['per_page'], 0)->num_rows();
            $this->pagination->initialize($config);
			$this->load->view('backend/view_members', $data);
		}

		public function view_approve(){
			$where['mem_stat'] = $this->config->item('saved');
			// $where['ken_stat'] = $this->config->item('saved');
			$data['member'] = $this->MemberModel->get_members($where)->result();
			$this->load->view('backend/approve_members', $data);
		}

		public function search_approve(){
			$like['mem_name'] = $this->input->post('keywords');
			$like['mem_hp'] = $this->input->post('keywords');
			$like['ken_name'] = $this->input->post('keywords');
			$where['mem_stat'] = $this->config->item('saved');
			// $where['ken_stat'] = $this->config->item('saved');
			$data['member'] = $this->MemberModel->search_members($like, $where)->result();
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
					$this->form_validation->set_rules('mem_mail_address', 'Mail Address ', 'trim|required');
					if (!$this->input->post('same'))
						$this->form_validation->set_rules('mem_address', 'Address ', 'trim|required');
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
						if (!isset($_POST['attachment_logo']) || empty($_POST['attachment_logo'])) {
							$err++;
							$this->session->set_flashdata('error_message', 'Kennel Photo is required');
						}
		
						$pp = '-';
						$logo = '-';
						$proof = '-';
						if (!$err){
							if (isset($_POST['attachment_pp']) && !empty($_POST['attachment_pp'])){
								$uploadedPP = $_POST['attachment_pp'];
								$image_array_1 = explode(";", $uploadedPP);
								$image_array_2 = explode(",", $image_array_1[1]);
								$uploadedPP = base64_decode($image_array_2[1]);
			
								if ((strlen($uploadedPP) > $this->config->item('file_size'))){
									$err++;
									$this->session->set_flashdata('error_message', 'The PP file size is too big (> 1 MB).');
								}

								$pp_name = $this->config->item('path_member').$this->config->item('file_name_member');
								if (!is_dir($this->config->item('path_member')) or !is_writable($this->config->item('path_member'))){
									$err++;
									$this->session->set_flashdata('error_message', 'members folder not found or not writable.');
								} else {
									if (is_file($pp_name) and !is_writable($pp_name)){
										$err++;
										$this->session->set_flashdata('error_message', 'PP file already exists and not writable.');
									}
								}
							}
	
							$uploadedLogo = $_POST['attachment_logo'];
							$image_array_1 = explode(";", $uploadedLogo);
							$image_array_2 = explode(",", $image_array_1[1]);
							$uploadedLogo = base64_decode($image_array_2[1]);
		
							if ((strlen($uploadedLogo) > $this->config->item('file_size'))){
								$err++;
								$this->session->set_flashdata('error_message', "The Kennel Photo file size is too big (> 1 MB).");
							}
							
							$logo_name = $this->config->item('path_kennel').$this->config->item('file_name_kennel');
							if (!is_dir($this->config->item('path_kennel')) or !is_writable($this->config->item('path_kennel'))){
								$err++;
								$this->session->set_flashdata('error_message', 'kennels folder not found or not writable.');
							} else {
								if (is_file($logo_name) and !is_writable($logo_name)){
									$err++;
									$this->session->set_flashdata('error_message', 'Kennel Photo file already exists and not writable.');
								}
							}

							if (isset($_POST['attachment_proof']) && !empty($_POST['attachment_proof'])){
								$uploadedProof = $_POST['attachment_proof'];
								$image_array_1 = explode(";", $uploadedProof);
								$image_array_2 = explode(",", $image_array_1[1]);
								$uploadedProof = base64_decode($image_array_2[1]);
			
								if ((strlen($uploadedProof) > $this->config->item('file_size'))){
									$err++;
									$this->session->set_flashdata('error_message', 'The Payment Proof file size is too big (> 1 MB).');
								}

								$proof_name = $this->config->item('path_payment').$this->config->item('file_name_payment');
								if (!is_dir($this->config->item('path_payment')) or !is_writable($this->config->item('path_payment'))){
									$err++;
									$this->session->set_flashdata('error_message', 'payment folder not found or not writable.');
								} else {
									if (is_file($proof_name) and !is_writable($proof_name)){
										$err++;
										$this->session->set_flashdata('error_message', 'Payment Proof file already exists and not writable.');
									}
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

					if (!$err && $this->input->post('mem_type') == $this->config->item('pro_member') && $this->MemberModel->check_for_duplicate(0, 'mem_username', $this->input->post('mem_username'))){
						$err++;
						$this->session->set_flashdata('error_message', 'Username tidak boleh sama');
					}
	
					if (!$err && $this->input->post('mem_type') == $this->config->item('pro_member') && $this->KennelModel->check_for_duplicate(0, 'ken_name', $this->input->post('ken_name'))){
						$err++;
						$this->session->set_flashdata('error_message', 'Duplicate kennel name');
					}
	
					if (!$err){
						if (isset($uploadedPP)){
							file_put_contents($pp_name, $uploadedPP);
							$pp = str_replace($this->config->item('path_member'), '', $pp_name);
						}

						if (isset($uploadedProof)){
							file_put_contents($proof_name, $uploadedProof);
							$proof = str_replace($this->config->item('path_payment'), '', $proof_name);
						}
	
						file_put_contents($logo_name, $uploadedLogo);
						$logo = str_replace($this->config->item('path_kennel'), '', $logo_name);

						if ($this->input->post('mem_type')){
							$data = array(
								'mem_name' => strtoupper($this->input->post('mem_name')),
								'mem_mail_address' => $this->input->post('mem_mail_address'),
								'mem_hp' => $this->input->post('mem_hp'),
								'mem_kota' => $this->input->post('mem_kota'),
								'mem_kode_pos' => $this->input->post('mem_kode_pos'),
								'mem_email' => $this->input->post('mem_email'),
								'mem_ktp' => $this->input->post('mem_ktp'),
								'mem_pp' => $pp,
								'mem_pay_photo' => $proof,
								'mem_username' => $this->input->post('mem_username'),
								'mem_password' => sha1($this->input->post('password')),
								'mem_app_user' => $this->session->userdata('use_id'),
								'mem_app_date' => date('Y-m-d H:i:s'),
								'mem_stat' => $this->config->item('accepted'),
								'mem_type' => $this->config->item('pro_member'),
								'mem_user' => $this->session->userdata('use_id'),
								'mem_date' => date('Y-m-d H:i:s'),
							);
			
							$kennel_data = array(
								'ken_name' => strtoupper($this->input->post('ken_name')),
								'ken_type_id' => $this->input->post('ken_type_id'),
								'ken_photo' => $logo,
								'ken_stat' => $this->config->item('accepted'),
								'ken_app_user' => $this->session->userdata('use_id'),
								'ken_app_date' => date('Y-m-d H:i:s'),
								'ken_user' => $this->session->userdata('use_id'),
								'ken_date' => date('Y-m-d H:i:s'),
							);

							$dataLog = array(
								'log_name' => strtoupper($this->input->post('mem_name')),
								'log_mail_address' => $this->input->post('mem_mail_address'),
								'log_hp' => $this->input->post('mem_hp'),
								'log_kota' => $this->input->post('mem_kota'),
								'log_kode_pos' => $this->input->post('mem_kode_pos'),
								'log_email' => $this->input->post('mem_email'),
								'log_ktp' => $this->input->post('mem_ktp'),
								'log_app_user' => $this->session->userdata('use_id'),
								'log_app_date' => date('Y-m-d H:i:s'),
								'log_stat' => $this->config->item('accepted'),
								'log_mem_type' => $this->config->item('pro_member'),
								'log_user' => $this->session->userdata('use_id'),
								'log_date' => date('Y-m-d H:i:s'),
								'log_pay_photo' => $proof
							);

							$dataKennelLog = array(
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
								$data['mem_address'] = $this->input->post('mem_mail_address');
								$dataLog['log_address'] = $this->input->post('mem_mail_address');
							}
							else{
								$data['mem_address'] = $this->input->post('mem_address');
								$dataLog['log_address'] = $this->input->post('mem_address');
							}
						}
						else{
							$data = array(
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
	
							$kennel_data = array(
								'ken_name' => '',
								'ken_type_id' => 0,
								'ken_photo' => '-',
								'ken_stat' => $this->config->item('accepted'),
								'ken_user' => $this->session->userdata('use_id'),
								'ken_date' => date('Y-m-d H:i:s'),
							);
						}
		
						$this->db->trans_strict(FALSE);
						$this->db->trans_start();
						$id = $this->MemberModel->add_members($data);
						if ($id){
							$mem_id = $this->db->insert_id();
							$kennel_data['ken_member_id'] = $mem_id;
							$res = $this->KennelModel->add_kennels($kennel_data);
							if ($res){
								$ken_id = $this->db->insert_id();
								$result = $this->notification_model->add(17, $mem_id, $mem_id);
								if ($result){
									if ($this->input->post('mem_type')){
										$dataLog['log_member_id'] = $mem_id;
										$log = $this->LogmemberModel->add_log($dataLog);
										if ($log){
											$dataKennelLog['log_kennel_id'] = $ken_id;
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
					$this->form_validation->set_rules('mem_mail_address', 'Mail Address ', 'trim|required');
					$this->form_validation->set_rules('mem_address', 'Address ', 'trim|required');
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
						$logo = '-';
						$proof = '-';
						if (isset($_POST['attachment_pp']) && !empty($_POST['attachment_pp'])){
							$uploadedPP = $_POST['attachment_pp'];
							$image_array_1 = explode(";", $uploadedPP);
							$image_array_2 = explode(",", $image_array_1[1]);
							$uploadedPP = base64_decode($image_array_2[1]);
		
							if ((strlen($uploadedPP) > $this->config->item('file_size'))){
								$err++;
								$this->session->set_flashdata('error_message', 'The PP file size is too big (> 1 MB).');
							}

							$pp_name = $this->config->item('path_member').$this->config->item('file_name_member');
							if (!is_dir($this->config->item('path_member')) or !is_writable($this->config->item('path_member'))){
								$err++;
								$this->session->set_flashdata('error_message', 'members folder not found or not writable.');
							} else {
								if (is_file($pp_name) and !is_writable($pp_name)){
									$err++;
									$this->session->set_flashdata('error_message', 'PP file already exists and not writable.');
								}
							}
						}
						if (isset($_POST['attachment_logo']) && !empty($_POST['attachment_logo'])){
							$uploadedLogo = $_POST['attachment_logo'];
							$image_array_1 = explode(";", $uploadedLogo);
							$image_array_2 = explode(",", $image_array_1[1]);
							$uploadedLogo = base64_decode($image_array_2[1]);
		
							if ((strlen($uploadedLogo) > $this->config->item('file_size'))){
								$err++;
								$this->session->set_flashdata('error_message', "The Kennel Photo file size is too big (> 1 MB).");
							}

							$logo_name = $this->config->item('path_kennel').$this->config->item('file_name_kennel');
							if (!is_dir($this->config->item('path_kennel')) or !is_writable($this->config->item('path_kennel'))){
								$err++;
								$this->session->set_flashdata('error_message', 'kennels folder not found or not writable.');
							} else {
								if (is_file($logo_name) and !is_writable($logo_name)){
									$err++;
									$this->session->set_flashdata('error_message', 'Kennel Photo file already exists and not writable.');
								}
							}
						}

						if (isset($_POST['attachment_proof']) && !empty($_POST['attachment_proof'])){
							$uploadedProof = $_POST['attachment_proof'];
							$image_array_1 = explode(";", $uploadedProof);
							$image_array_2 = explode(",", $image_array_1[1]);
							$uploadedProof = base64_decode($image_array_2[1]);
		
							if ((strlen($uploadedProof) > $this->config->item('file_size'))){
								$err++;
								$this->session->set_flashdata('error_message', "The Payment Proof file size is too big (> 1 MB).");
							}

							$proof_name = $this->config->item('path_payment').$this->config->item('file_name_payment');
							if (!is_dir($this->config->item('path_payment')) or !is_writable($this->config->item('path_payment'))){
								$err++;
								$this->session->set_flashdata('error_message', 'payment folder not found or not writable.');
							} else {
								if (is_file($proof_name) and !is_writable($proof_name)){
									$err++;
									$this->session->set_flashdata('error_message', 'Payment Proof Photo file already exists and not writable.');
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
						if (isset($uploadedPP)){
							file_put_contents($pp_name, $uploadedPP);
							$pp = str_replace($this->config->item('path_member'), '', $pp_name);
						}
						if (isset($uploadedLogo)){
							file_put_contents($logo_name, $uploadedLogo);
							$logo = str_replace($this->config->item('path_kennel'), '', $logo_name);
						}
						if (isset($uploadedProof)){
							file_put_contents($proof_name, $uploadedProof);
							$proof = str_replace($this->config->item('path_payment'), '', $proof_name);
						}
						
						if ($this->input->post('mem_type')){
							$data = array(
								'mem_name' => strtoupper($this->input->post('mem_name')),
								'mem_address' => $this->input->post('mem_address'),
								'mem_mail_address' => $this->input->post('mem_mail_address'),
								'mem_address' => $this->input->post('mem_address'),
								'mem_hp' => $this->input->post('mem_hp'),
								'mem_kota' => $this->input->post('mem_kota'),
								'mem_kode_pos' => $this->input->post('mem_kode_pos'),
								'mem_email' => $this->input->post('mem_email'),
								'mem_ktp' => $this->input->post('mem_ktp'),
								'mem_type' => $this->input->post('mem_type'),
								'mem_user' => $this->session->userdata('use_id'),
								'mem_date' => date('Y-m-d H:i:s'),
							);
							if ($pp != '-')
								$data['mem_pp'] = $pp;
							if ($proof != '-')
								$data['mem_pay_photo'] = $proof;
							if (!$dataReg['member']->mem_user){
								$data['mem_payment_date'] = date('Y-m-d', strtotime('+1 year'));
								$data['mem_app_user'] = $this->session->userdata('use_id');
								$data['mem_app_date'] = date('Y-m-d H:i:s');
							}

							$kennel_data = array(
								'ken_name' => strtoupper($this->input->post('ken_name')),
								'ken_type_id' => $this->input->post('ken_type_id'),
								'ken_user' => $this->session->userdata('use_id'),
								'ken_date' => date('Y-m-d H:i:s'),
							);

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
								'log_user' => $this->session->userdata('use_id'),
								'log_date' => date('Y-m-d H:i:s'),
								'log_stat' => $this->config->item('accepted'),
								'log_mem_type' => $this->input->post('mem_type'),
								'log_pay_photo' => $proof
							);
							if (!$dataReg['member']->mem_user){
								$dataLog['log_payment_date'] = date('Y-m-d', strtotime('+1 year'));
								$dataLog['log_app_user'] = $this->session->userdata('use_id');
								$dataLog['log_app_date'] = date('Y-m-d H:i:s');
							}
	
							$dataKennelLog = array(
								'log_kennel_id' => $this->input->post('ken_id'),
								'log_kennel_name' => strtoupper($this->input->post('ken_name')),
								'log_kennel_type_id' => $this->input->post('ken_type_id'),
								'log_stat' => $this->config->item('accepted'),
								'log_user' => $this->session->userdata('use_id'),
								'log_date' => date('Y-m-d H:i:s')
							);

							if ($logo != '-'){
								$kennel_data['ken_photo'] = $logo;
								$dataKennelLog['log_kennel_photo'] = $logo;
							}
							else{
								$dataKennelLog['log_kennel_photo'] = $dataReg['member']->ken_photo;
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
								'mem_pay_photo' => null,
								'mem_payment_date' => null,
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
								'log_pay_photo' => $member->mem_pay_photo,
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
					$data['mem_app_user'] = $this->session->userdata('use_id');
					$data['mem_date'] = date('Y-m-d H:i:s');
					$data['mem_app_date'] = date('Y-m-d H:i:s');
					if ($this->uri->segment(5)){
						$data['mem_app_note'] = urldecode($this->uri->segment(5));
					}
					
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
								'log_pay_photo' => $member->mem_pay_photo,
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
                    if ($this->uri->segment(5)){
                        $data['mem_app_note'] = urldecode($this->uri->segment(5));
                    }
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
								'log_member_id' => $member->mem_id,
								'log_name' => $member->mem_name,
								'log_address' => $member->mem_address,
								'log_mail_address' => $member->mem_mail_address,
								'log_hp' => $member->mem_hp,
								'log_kota' => $member->mem_kota,
								'log_kode_pos' => $member->mem_kode_pos,
								'log_email' => $member->mem_email,
								'log_ktp' => $member->mem_ktp,
								'log_pay_photo' => $member->mem_pay_photo,
								'log_user' => $this->session->userdata('use_id'),
								'log_app_user' => $member->mem_app_user,
								'log_date' => date('Y-m-d H:i:s'),
								'log_app_date' => date('Y-m-d', strtotime($member->mem_app_date)),
								'log_stat' => $this->config->item('rejected'),
								'log_mem_type' => $this->config->item('pro_member'),
							);
							$log = $this->LogmemberModel->add_log($dataLog);
							if ($log){
								$dataKennelLog = array(
									'log_kennel_id' => $member->ken_id,
									'log_stat' => $this->config->item('rejected'),
									'log_user' => $this->session->userdata('use_id'),
									'log_date' => date('Y-m-d H:i:s')
								);
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
									$dataCan['can_member_id'] = $this->config->item('no_member');
									$dataCan['can_kennel_id'] = $this->config->item('no_member');
									$wheCan['can_member_id'] = $this->uri->segment(4);
									$can = $this->CaninesModel->update_canines($dataCan, $wheCan);
									if ($can){
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
					}
					else{
						$err = 5;
					}
					if ($err){ 
						$this->db->trans_rollback();
						$this->session->set_flashdata('delete_message', 'Failed to delete member id = '.$this->uri->segment(4).'. Error code: '.$err);
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
					$where['mem_id'] = $this->uri->segment(4);
					$member = $this->MemberModel->get_members($where)->row();
					$this->db->trans_strict(FALSE);
					$this->db->trans_start();
					if (!$member->mem_app_user){
						$data = array(
							'mem_name' => $member->mem_name,
							'mem_hp' => $member->mem_hp,
							'mem_email' => $member->mem_email,
						);
					}
					$data['mem_payment_date'] = date('Y-m-d', strtotime('+1 year'));
					$data['mem_type'] = $this->config->item('pro_member');
					$data['mem_app_user'] = $this->session->userdata('use_id');
					$data['mem_app_date'] = date('Y-m-d H:i:s');
					$data['mem_user'] = $this->session->userdata('use_id');
					$data['mem_date'] = date('Y-m-d H:i:s');
					$res = $this->MemberModel->update_members($data, $where);
					if ($res){
						$err = 0;
						$dataLog = array(
							'log_member_id' => $member->mem_id,
							'log_payment_date' => date('Y-m-d', strtotime('+1 year')),
							'log_name' => $member->mem_name,
							'log_address' => $member->mem_address,
							'log_mail_address' => $member->mem_mail_address,
							'log_hp' => $member->mem_hp,
							'log_kota' => $member->mem_kota,
							'log_kode_pos' => $member->mem_kode_pos,
							'log_email' => $member->mem_email,
							'log_ktp' => $member->mem_ktp,
							'log_pay_photo' => $member->mem_pay_photo,
							'log_user' => $this->session->userdata('use_id'),
							'log_date' => date('Y-m-d H:i:s'),
							'log_stat' => $this->config->item('accepted'),
							'log_mem_type' => $this->config->item('pro_member'),
						);
						if (!$member->mem_app_user){
							$dataLog['log_app_user'] = $this->session->userdata('use_id');
							$dataLog['log_app_date'] = date('Y-m-d H:i:s');
						}
						else{
							$dataLog['log_app_user'] = $member->mem_app_user;
							$dataLog['log_app_date'] = date('Y-m-d', strtotime($member->mem_app_date));
						}
						$log = $this->LogmemberModel->add_log($dataLog);
						if ($log){
							if (!$member->mem_app_user){
								$dataKennel = array(
									'ken_stat' => $this->config->item('accepted'),
									'ken_user' => $this->session->userdata('use_id'),
									'ken_date' => date('Y-m-d H:i:s'),
									'ken_app_user' => $this->session->userdata('use_id'),
									'ken_app_date' => date('Y-m-d H:i:s'),
								);
								$wheKennel['ken_member_id'] = $this->uri->segment(4);
								$res = $this->KennelModel->update_kennels($dataKennel, $wheKennel);
								if ($res){
									$dataKennelLog = array(
										'log_kennel_id' => $member->ken_id,
										'log_stat' => $this->config->item('accepted'),
										'log_user' => $this->session->userdata('use_id'),
										'log_date' => date('Y-m-d H:i:s'),
										'log_app_user' => $this->session->userdata('use_id'),
										'log_app_date' => date('Y-m-d H:i:s'),
									);
									$log = $this->LogkennelModel->add_log($dataKennelLog);
									if (!$log){
										$err = 4;
									}
								}
								else{
									$err = 5;
								}
							}
							if (!$err){
								$res = $this->notification_model->add(19, $this->uri->segment(4), $this->uri->segment(4));
								if ($res){
									$this->db->trans_complete();
									$this->session->set_flashdata('payment_success', TRUE);
									redirect('backend/Members');
								}
								else{
									$err = 1;
								}
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
						$this->db->trans_rollback();
						$this->session->set_flashdata('delete_message', 'Failed to set payment for member id = '.$this->uri->segment(4).'. Error code: '.$err);
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
					$this->session->set_flashdata('delete_message', 'Not found');
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
					$this->session->set_flashdata('delete_message', 'Not found');
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

		public function log(){
			if ($this->uri->segment(4)){
				$where['log_member_id'] = $this->uri->segment(4);
				$data['member'] = $this->LogmemberModel->get_logs($where)->result();
				$wheLog['log_kennel_id'] = $data['member'][0]->ken_id;
				$data['kennel'] = $this->LogkennelModel->get_logs($wheLog)->result();
				$this->load->view('backend/log_member', $data);
			}
			else{
				redirect('backend/Members');
			}
		}
}
