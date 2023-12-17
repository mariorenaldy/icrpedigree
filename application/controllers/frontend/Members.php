<?php
defined('BASEPATH') OR exit('No direct script access allowed');

#[\AllowDynamicProperties]

class Members extends CI_Controller {
		public function __construct(){
			// Call the CI_Controller constructor
			parent::__construct();
			$this->load->model(array('MemberModel', 'KennelModel', 'KenneltypeModel', 'notification_model'));
			$this->load->library(array('session', 'form_validation'));
			$this->load->helper(array('form', 'url', 'cookie'));
			$this->load->database();

			if ($this->input->cookie('site_lang')) {
                $this->lang->load('common', $this->input->cookie('site_lang'));
                $this->lang->load('register', $this->input->cookie('site_lang'));
                $this->lang->load('login', $this->input->cookie('site_lang'));
                $this->lang->load('profile', $this->input->cookie('site_lang'));
                $this->lang->load('member', $this->input->cookie('site_lang'));
            } else {
                set_cookie('site_lang', 'indonesia', '2147483647'); 
                $this->lang->load('common', 'indonesia');
                $this->lang->load('register', 'indonesia');
                $this->lang->load('login', 'indonesia');
                $this->lang->load('profile', 'indonesia');
                $this->lang->load('member', 'indonesia');
            }
		}

		public function test_input($data) {
			$data = trim($data);
			$data = stripslashes($data);
			$data = htmlspecialchars($data);
			return $data;
		}

		public function index(){
			$this->updateToFree();
            if (!$this->session->userdata('username')){
                $this->load->view("frontend/login_form");
            }
            else{
                redirect("frontend/Beranda");
            }
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

		public function validate_login(){
			$this->form_validation->set_error_delimiters('<div>','</div>');

            $site_lang = $this->input->cookie('site_lang');
			if ($site_lang == 'indonesia') {
				$this->form_validation->set_message('required', '%s wajib diisi');
			}

			$this->form_validation->set_rules('username', 'Username', 'trim|required');
			$this->form_validation->set_rules('password', 'Password', 'trim|required');
		
			if ($this->form_validation->run() == FALSE){
				$this->load->view('frontend/login_form');
			}
			else{
				$where['mem_username'] = $this->input->post('username');
				$where['mem_stat'] = $this->config->item('accepted');
				$where['ken_stat'] = $this->config->item('accepted');
				$member = $this->MemberModel->get_members($where)->row(); // username
				$err = 0;
				if (!$member){
					$whereMem['mem_hp'] = $this->input->post('username');
					$whereMem['mem_stat'] = $this->config->item('accepted');
					$whereMem['ken_stat'] = $this->config->item('accepted'); 
					$member = $this->MemberModel->get_members($whereMem)->row(); // no hp
					if (!$member){
						$err++;
                        if ($site_lang == 'indonesia') {
							$this->session->set_flashdata('login_error', 'Nama pengguna/no hp tidak terdaftar');
						}
						else{
							$this->session->set_flashdata('login_error', 'Username/phone number is not registered');
						}
					}
				}
				if (!$err && $member->mem_stat == $this->config->item('rejected')){
					$err++;
                    if ($site_lang == 'indonesia') {
						$this->session->set_flashdata('login_error', 'Masa berlaku member telah habis. Harap melakukan pembayaran');
					}
					else{
						$this->session->set_flashdata('login_error', 'Your membership has been expired. Please pay the annual fee to continue using the service');
					}
				}
				if (!$err && $member->mem_stat == $this->config->item('saved')){
					$err++;
                    if ($site_lang == 'indonesia') {
						$this->session->set_flashdata('login_error', 'Data member belum di-approve. Harap tunggu persetujuan');
					}
					else{
						$this->session->set_flashdata('login_error', 'Your membership has not been approved. Please wait for approval');
					}
				}
				if (!$err && sha1($this->input->post('password')) != $member->mem_password){
					$err++;
                    if ($site_lang == 'indonesia') {
						$this->session->set_flashdata('login_error', 'Password salah');
					}
					else{
						$this->session->set_flashdata('login_error', 'Invalid password');
					}
				}
				if (!$err){
					$data['last_login'] = date('Y-m-d H:i:s');
					$whe['mem_id'] = $member->mem_id;
					$mem = $this->MemberModel->update_members($data, $whe);
					if ($mem){
						$this->session->set_userdata('username', $this->input->post('username'));
						$this->session->set_userdata('mem_id', $member->mem_id);
						$this->session->set_userdata('mem_name', $member->mem_name);
						$this->session->set_userdata('mem_type', $member->mem_type);
						if ($member->mem_pp && $member->mem_pp != '-')
							$this->session->set_userdata('mem_pp', base_url().'uploads/members/'.$member->mem_pp);
						else
							$this->session->set_userdata('mem_pp', base_url().'assets/img/'.$this->config->item('default_img'));
						$notif = $this->notification_model->get_count($member->mem_id);
						$this->session->set_userdata('notif_count', $notif->count);
						redirect("frontend/Beranda");
					}
					else{
                        if ($site_lang == 'indonesia') {
							$this->session->set_flashdata('login_error', 'Gagal login');
						}
						else{
							$this->session->set_flashdata('login_error', 'Login failed');
						}
						$this->load->view("frontend/login_form");
					}
				}
				else{
					$this->load->view("frontend/login_form");
				}
			}
		}

		public function logout(){
			$this->session->unset_userdata('username');
			$this->session->unset_userdata('mem_id');
			$this->session->unset_userdata('mem_name');
			$this->session->unset_userdata('mem_type');
			$this->session->unset_userdata('mem_pp');
			$this->session->unset_userdata('notif_count');
			$this->cart->destroy();
			redirect('frontend/Members');
		}

		public function register(){
			$dataReg['kennelType'] = $this->KenneltypeModel->get_kennel_types('')->result();
			$cities = $this->MemberModel->get_cities()->result();
			$dataReg['cityOptions'] = "<option value=''>City/Regency</option>";
			foreach($cities as $key => $city){
				$dataReg['cityOptions'] = $dataReg['cityOptions']."<option value='".$city->city_name."'>";
				$dataReg['cityOptions'] = $dataReg['cityOptions'].$city->city_name;
				$dataReg['cityOptions'] = $dataReg['cityOptions']."</option>";
			}

			$this->load->view("frontend/register", $dataReg);
		}

		public function validate_register(){
			$this->form_validation->set_error_delimiters('<div>','</div>');
			$site_lang = $this->input->cookie('site_lang');
			if ($site_lang == 'indonesia') {
				$this->form_validation->set_message('required', '%s wajib diisi');
				$this->form_validation->set_message('matches', 'Password dan confirm password tidak sama');
				if ($this->input->post('mem_type')){
					$this->form_validation->set_rules('mem_name', 'Nama sesuai KTP ', 'trim|required');
					$this->form_validation->set_rules('mem_hp', 'No. HP Aktif WA ', 'trim|required');
					$this->form_validation->set_rules('mem_email', 'email ', 'trim|required');
					$this->form_validation->set_rules('mem_mail_address', 'Alamat surat menyurat ', 'trim|required');
					if (!$this->input->post('same'))
						$this->form_validation->set_rules('mem_address', 'Alamat ', 'trim|required');
					$this->form_validation->set_rules('mem_kota', 'Kota ', 'trim|required');
					$this->form_validation->set_rules('mem_kode_pos', 'Kode pos ', 'trim|required');
					$this->form_validation->set_rules('mem_ktp', 'No. KTP ', 'trim|required');
					$this->form_validation->set_rules('mem_username', 'Username ', 'trim|required');
					$this->form_validation->set_rules('password', 'Password ', 'trim|required');
					$this->form_validation->set_rules('repass', 'Konfirmasi password ', 'trim|matches[password]');
					$this->form_validation->set_rules('ken_name', 'Nama kennel ', 'trim|required');
					$this->form_validation->set_rules('payment_method', 'Metode Pembayaran ', 'trim|required');
				}
				else{
					$this->form_validation->set_rules('name', 'Nama sesuai KTP ', 'trim|required');
					$this->form_validation->set_rules('hp', 'No. HP Aktif WA ', 'trim|required');
					$this->form_validation->set_rules('email', 'email ', 'trim|required');
				}
			}
			else{
				if ($this->input->post('mem_type')){
					$this->form_validation->set_rules('mem_name', 'ID Card Name ', 'trim|required');
					$this->form_validation->set_rules('mem_hp', 'Active WhatsApp Number ', 'trim|required');
					$this->form_validation->set_rules('mem_email', 'email ', 'trim|required');
					$this->form_validation->set_rules('mem_mail_address', 'Mail Address ', 'trim|required');
					if (!$this->input->post('same'))
						$this->form_validation->set_rules('mem_address', 'Address ', 'trim|required');
					$this->form_validation->set_rules('mem_kota', 'City/Regency ', 'trim|required');
					$this->form_validation->set_rules('mem_kode_pos', 'Postal Code ', 'trim|required');
					$this->form_validation->set_rules('mem_ktp', 'ID Card Number ', 'trim|required');
					$this->form_validation->set_rules('mem_username', 'Username ', 'trim|required');
					$this->form_validation->set_rules('password', 'Password ', 'trim|required');
					$this->form_validation->set_rules('repass', 'Confirm Password ', 'trim|matches[password]');
					$this->form_validation->set_rules('ken_name', 'Kennel Name ', 'trim|required');
					$this->form_validation->set_rules('payment_method', 'Payment Method ', 'trim|required');
				}
				else{
					$this->form_validation->set_rules('name', 'ID Card Name ', 'trim|required');
					$this->form_validation->set_rules('hp', 'Active WhatsApp Number ', 'trim|required');
					$this->form_validation->set_rules('email', 'email ', 'trim|required');
				}
			}

			$dataReg['kennelType'] = $this->KenneltypeModel->get_kennel_types('')->result();
			$cities = $this->MemberModel->get_cities()->result();
			$dataReg['cityOptions'] = "<option value=''>City/Regency</option>";
			foreach($cities as $key => $city){
				$dataReg['cityOptions'] = $dataReg['cityOptions']."<option value='".$city->city_name."'>";
				$dataReg['cityOptions'] = $dataReg['cityOptions'].$city->city_name;
				$dataReg['cityOptions'] = $dataReg['cityOptions']."</option>";
			}

			if ($this->form_validation->run() == FALSE){
				$this->load->view("frontend/register", $dataReg);
			}
			else{
				$err = 0;
				if ($this->input->post('mem_type')){
					if (!isset($_POST['attachment_logo']) || empty($_POST['attachment_logo'])) {
						$err++;
						if ($site_lang == 'indonesia') {
							$this->session->set_flashdata('error_message', 'Foto Kennel wajib diisi');
						}
						else{
							$this->session->set_flashdata('error_message', 'Kennel Photo is required');
						}
					}

					if($this->input->post('payment_method') == 'upload-proof'){
						if (!isset($_POST['attachment_proof']) || empty($_POST['attachment_proof'])) {
							$err++;
							if ($site_lang == 'indonesia') {
								$this->session->set_flashdata('error_message', 'Foto Bukti Pembayaran wajib diisi');
							}
							else{
								$this->session->set_flashdata('error_message', 'Photo Proof of Payment is required');
							}
						}
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
								if ($site_lang == 'indonesia') {
									$this->session->set_flashdata('error_message', 'Ukuran file PP terlalu besar (> 1 MB).<br/>');
								}
								else{
									$this->session->set_flashdata('error_message', 'PP file size is too big (> 1 MB).<br/>');
								}
							}

							$pp_name = $this->config->item('path_member').$this->config->item('file_name_member');
							if (!is_dir($this->config->item('path_member')) or !is_writable($this->config->item('path_member'))){
								$err++;
								if ($site_lang == 'indonesia') {
									$this->session->set_flashdata('error_message', 'Folder member tidak ditemukan atau tidak writable.');
								}
								else{
									$this->session->set_flashdata('error_message', 'member folder is not found or is not writable.');
								}
							} else {
								if (is_file($pp_name) and !is_writable($pp_name)){
									$err++;
									if ($site_lang == 'indonesia') {
										$this->session->set_flashdata('error_message', 'File PP sudah ada dan tidak writable.');
									}
									else{
										$this->session->set_flashdata('error_message', 'PP file is already exist and is not writable.');
									}
								}
							}
						}

						$uploadedLogo = $_POST['attachment_logo'];
						$image_array_1 = explode(";", $uploadedLogo);
						$image_array_2 = explode(",", $image_array_1[1]);
						$uploadedLogo = base64_decode($image_array_2[1]);
	
						if ((strlen($uploadedLogo) > $this->config->item('file_size'))){
							$err++;
							if ($site_lang == 'indonesia') {
								$this->session->set_flashdata('error_message', "Ukuran file Foto Kennel terlalu besar (> 1 MB).<br/>");
							}
							else{
								$this->session->set_flashdata('error_message', "Kennel Photo file size is too big (> 1 MB).<br/>");
							}
						}

						if($this->input->post('payment_method') == 'upload-proof'){
							$uploadedProof = $_POST['attachment_proof'];
							$image_array_1 = explode(";", $uploadedProof);
							$image_array_2 = explode(",", $image_array_1[1]);
							$uploadedProof = base64_decode($image_array_2[1]);
		
							if ((strlen($uploadedProof) > $this->config->item('file_size'))){
								$err++;
								if ($site_lang == 'indonesia') {
									$this->session->set_flashdata('error_message', "Ukuran file Foto Bukti Pembayaran terlalu besar (> 1 MB).<br/>");
								}
								else{
									$this->session->set_flashdata('error_message', "Photo Proof of Payment file size is too big (> 1 MB).<br/>");
								}
							}
						}
						
						$logo_name = $this->config->item('path_kennel').$this->config->item('file_name_kennel');
						if (!is_dir($this->config->item('path_kennel')) or !is_writable($this->config->item('path_kennel'))){
							$err++;
							if ($site_lang == 'indonesia') {
								$this->session->set_flashdata('error_message', 'Folder kennel tidak ditemukan atau tidak writable.');
							}
							else{
								$this->session->set_flashdata('error_message', 'kennel folder is not found or is not writable.');
							}
						} else {
							if (is_file($logo_name) and !is_writable($logo_name)){
								$err++;
								if ($site_lang == 'indonesia') {
									$this->session->set_flashdata('error_message', 'File Foto Kennel sudah ada dan tidak writable.');
								}
								else{
									$this->session->set_flashdata('error_message', 'Kennel Photo file is already exist and is not writable.');
								}
							}
						}

						if($this->input->post('payment_method') == 'upload-proof'){
							$proof_name = $this->config->item('path_payment').$this->config->item('file_name_payment');
							if (!is_dir($this->config->item('path_payment')) or !is_writable($this->config->item('path_payment'))){
								$err++;
								if ($site_lang == 'indonesia') {
									$this->session->set_flashdata('error_message', 'Folder payment tidak ditemukan atau tidak writable.');
								}
								else{
									$this->session->set_flashdata('error_message', 'payment folder is not found or is not writable.');
								}
							} else {
								if (is_file($proof_name) and !is_writable($proof_name)){
									$err++;
									if ($site_lang == 'indonesia') {
										$this->session->set_flashdata('error_message', 'File Foto Bukti Pembayaran sudah ada dan tidak writable.');
									}
									else{
										$this->session->set_flashdata('error_message', 'Photo Proof of Payment file is already exist and is not writable.');
									}
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
					if ($site_lang == 'indonesia') {
						$this->session->set_flashdata('error_message', 'Format email tidak valid');
					}
					else{
						$this->session->set_flashdata('error_message', 'Email format is not valid');
					}
				}

				if ($this->input->post('mem_type')){
					$whereMem['mem_name'] = $this->input->post('mem_name');
					$mem = $this->MemberModel->get_members($whereMem)->row();
					if (!$err && $mem && $mem->mem_stat == $this->config->item('saved')){
						$err++;
						if ($site_lang == 'indonesia') {
							$this->session->set_flashdata('error_message', 'Nama sudah terdaftar dan belum diproses. Harap tunggu persetujuan');
						}
						else{
							$this->session->set_flashdata('error_message', 'Name is already registered and has not been processed. Please wait for approval');
						}
					}

					if (!$err && $mem && $mem->mem_stat == $this->config->item('accepted')){
						$err++;
						if ($site_lang == 'indonesia') {
							$this->session->set_flashdata('error_message', 'Nama sudah terdaftar');
						}
						else{
							$this->session->set_flashdata('error_message', 'Name is already registered');
						}
					}

					if (!$err && $this->MemberModel->check_for_duplicate(0, 'mem_ktp', $this->input->post('mem_ktp'))){
						$err++;
						if ($site_lang == 'indonesia') {
							$this->session->set_flashdata('error_message', 'No. KTP tidak boleh sama');
						}
						else{
							$this->session->set_flashdata('error_message', 'Duplicate ID Card Number');
						}
					}

					if (!$err && $this->MemberModel->check_for_duplicate(0, 'mem_hp', $this->input->post('mem_hp'))){
						$err++;
						if ($site_lang == 'indonesia') {
							$this->session->set_flashdata('error_message', 'No. HP tidak boleh sama');
						}
						else{
							$this->session->set_flashdata('error_message', 'Duplicate Phone number');
						}
					}

					if (!$err && $this->MemberModel->check_for_duplicate(0, 'mem_email', $this->input->post('mem_email'))){
						$err++;
						if ($site_lang == 'indonesia') {
							$this->session->set_flashdata('error_message', 'email tidak boleh sama');
						}
						else{
							$this->session->set_flashdata('error_message', 'Duplicate email');
						}
					}

					if (!$err && $this->MemberModel->check_for_duplicate(0, 'mem_username', $this->input->post('mem_username'))){
						$err++;
						if ($site_lang == 'indonesia') {
							$this->session->set_flashdata('error_message', 'Username tidak boleh sama');
						}
						else{
							$this->session->set_flashdata('error_message', 'Duplicate username');
						}
					}

					if (!$err && $this->KennelModel->check_for_duplicate(0, 'ken_name', $this->input->post('ken_name'))){
						$err++;
						if ($site_lang == 'indonesia') {
							$this->session->set_flashdata('error_message', 'Nama kennel tidak boleh sama');
						}
						else{
							$this->session->set_flashdata('error_message', 'Duplicate kennel name');
						}
					}
				} else {
					$whereMem['mem_name'] = $this->input->post('name');
					$mem = $this->MemberModel->get_members($whereMem)->row();
					if (!$err && $mem && $mem->mem_stat == $this->config->item('saved')){
						$err++;
						$this->session->set_flashdata('error_message', 'Nama anda sudah terdaftar dan belum diproses. Harap tunggu persetujuan');
					}

					if (!$err && $mem && $mem->mem_stat == $this->config->item('accepted')){
						$err++;
						$this->session->set_flashdata('error_message', 'Nama anda sudah terdaftar');
					}

					if (!$err && $this->MemberModel->check_for_duplicate(0, 'mem_hp', $this->input->post('hp'))){
						$err++;
						$this->session->set_flashdata('error_message', 'No. HP tidak boleh sama');
					}

					if (!$err && !$this->input->post('mem_type') && $this->MemberModel->check_for_duplicate(0, 'mem_email', $this->input->post('email'))){
						$err++;
						$this->session->set_flashdata('error_message', 'email tidak boleh sama');
					}
				}
				
				if (!$err){
					if ($this->input->post('mem_type')){
						if (isset($uploadedPP)){
							file_put_contents($pp_name, $uploadedPP);
							$pp = str_replace($this->config->item('path_member'), '', $pp_name);
						}
	
						file_put_contents($logo_name, $uploadedLogo);
						$logo = str_replace($this->config->item('path_kennel'), '', $logo_name);
	
						if($this->input->post('payment_method') == 'upload-proof'){
							file_put_contents($proof_name, $uploadedProof);
							$proof = str_replace($this->config->item('path_payment'), '', $proof_name);
						}
						
						$dataMember = array(
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
							'mem_stat' => $this->config->item('saved'),
							'mem_type' => $this->config->item('pro_member'),
							'mem_user' => $this->config->item('system'),
							'mem_date' => date('Y-m-d H:i:s'),
						);
						
						if ($this->input->post('same'))
							$dataMember['mem_address'] = $this->input->post('mem_mail_address');
						else
							$dataMember['mem_address'] = $this->input->post('mem_address');

						if($this->input->post('payment_method') == 'upload-proof'){
							$dataMember['mem_pay_id'] = $this->config->item('upload_proof');
						}
						else{
							$dataMember['mem_stat'] = $this->config->item('not_paid');
							$dataMember['mem_pay_id'] = $this->config->item('doku');
							$inv = $this->generateInvoice();
							$dataMember['mem_pay_invoice'] = $inv;
							$dataMember['mem_pay_due_date'] = date('Y-m-d H:i:s', strtotime('1 hour'));
						}
						
						$kennel_data = array(
							'ken_name' => strtoupper($this->input->post('ken_name')),
							'ken_type_id' => $this->input->post('ken_type_id'),
							'ken_photo' => $logo,
							'ken_stat' => $this->config->item('saved'),
							'ken_user' => $this->config->item('system'),
							'ken_date' => date('Y-m-d H:i:s'),
						);
					}
					else{
						$dataMember = array(
							'mem_name' => strtoupper($this->input->post('name')),
							'mem_hp' => $this->input->post('hp'),
							'mem_email' => $this->input->post('email'),
							'mem_username' => $this->input->post('email'),
							'mem_password' => sha1($this->input->post('hp')),
							'mem_stat' => $this->config->item('accepted'),
							'mem_type' => $this->config->item('free_member'),
							'mem_user' => $this->config->item('system'),
							'mem_date' => date('Y-m-d H:i:s'),
						);

						$kennel_data = array(
							'ken_id' => $ken_id,
							'ken_name' => '',
							'ken_type_id' => 0,
							'ken_photo' => '-',
							'ken_stat' => $this->config->item('accepted'),
							'ken_user' => $this->config->item('system'),
							'ken_date' => date('Y-m-d H:i:s'),
						);
					}

					$this->db->trans_strict(FALSE);
					$this->db->trans_start();
					$id = $this->MemberModel->add_members($dataMember);
					if ($id){
						$mem_id = $this->db->insert_id();
						$kennel_data['ken_member_id'] = $mem_id;
						$res = $this->KennelModel->add_kennels($kennel_data);
						if ($res){
							$this->db->trans_complete();
							if ($this->input->post('mem_type')){
								if($this->input->post('payment_method') == 'upload-proof'){
									$this->session->set_flashdata('pro', TRUE);
									redirect("frontend/Members");
								}
								else{
									redirect("frontend/Payment/checkout/Members/200000/".$inv);
								}
							}
							else{
								$this->session->set_flashdata('free', TRUE);
								$this->session->set_flashdata('user', $this->input->post('email'));
								redirect("frontend/Members");
							}
						}
						else{
							$err = 2;
						}
					}
					else {
						$err = 3;
					}
					if ($err){
						$this->db->trans_rollback();
						if ($site_lang == 'indonesia') {
							$this->session->set_flashdata('error_message', 'Gagal menyimpan data member');
						}
						else{
							$this->session->set_flashdata('error_message', 'Failed to save member');
						}
						$this->load->view("frontend/register", $dataReg);
					}
				}
				else{
					$this->load->view("frontend/register", $dataReg);
				}
			}
		}

		public function profile(){
			if ($this->session->userdata('mem_id')){
				$where['mem_id'] = $this->session->userdata('mem_id');
				$data['member'] = $this->MemberModel->get_members($where)->row();
				$whe['ken_id'] = $data['member']->ken_id;
				$data['kennel'] = $this->KennelModel->get_kennels($whe)->row();
				$this->load->view("frontend/profile", $data);
			}
			else{
				redirect("frontend/Members");
			}
		}

		public function view_edit_password(){
			if ($this->session->userdata('username')){
				$where['mem_username'] = $this->session->userdata('username');
				$data['member'] = $this->MemberModel->get_members($where)->row();
				if (!$data['member']){
					redirect("frontend/Members");
				}
				else{
					$this->load->view("frontend/edit_password");
				}
			}
			else{
				redirect("frontend/Members");
			}
		}
	
		public function validate_edit_password(){
			if ($this->session->userdata('username')){
				$site_lang = $this->input->cookie('site_lang');
				$this->form_validation->set_error_delimiters('<div>','</div>');
				if ($site_lang == 'indonesia') {
					$this->form_validation->set_message('required', '%s wajib diisi');
					$this->form_validation->set_rules('password', 'Password', 'trim|required');
					$this->form_validation->set_rules('newpass', 'Password Baru', 'trim|required');
					$this->form_validation->set_rules('repass', 'Konfirmasi Password', 'trim|matches[newpass]');
				}
				else{
					$this->form_validation->set_rules('password', 'Password', 'trim|required');
					$this->form_validation->set_rules('newpass', 'New Password', 'trim|required');
					$this->form_validation->set_rules('repass', 'Confirm Password', 'trim|matches[newpass]');
				}
			
				if ($this->form_validation->run() == FALSE){
					$this->load->view('frontend/edit_password');
				}
				else{
					$err = 0;
					$where['mem_id'] = $this->session->userdata('mem_id');
					$member = $this->MemberModel->get_members($where)->row_array();
					if (!$member) {
						$err = 1;
						if ($site_lang == 'indonesia') {
							$this->session->set_flashdata('error_message', 'Data Tidak Ditemukan');
						}
						else{
							$this->session->set_flashdata('error_message', 'Not Found');
						}
					}
					else{
						if (sha1($this->input->post('password')) == $member['mem_password']) {
							$data['mem_password'] = sha1($this->input->post('newpass'));
							$res = $this->MemberModel->update_members($data, $where);
							if ($res){
								$this->session->set_flashdata('edit_password', TRUE);
								redirect("frontend/Members/view_edit_password");
							}
							else{
								$err = 2;
								if ($site_lang == 'indonesia') {
									$this->session->set_flashdata('error_message', 'Gagal menyimpan password');
								}
								else{
									$this->session->set_flashdata('error_message', 'Failed to save password');
								}
							}
						}
						else {
							$err = 3;
							if ($site_lang == 'indonesia') {
								$this->session->set_flashdata('error_message', 'Password salah');
							}
							else{
								$this->session->set_flashdata('error_message', 'Invalid password');
							}
						}
					}
					if ($err){
						$this->load->view('frontend/edit_password');
					}
				}
			}
			else{
				redirect("frontend/Members");
			}
		}


	public function change_pp(){
		if ($this->session->userdata('mem_id')){
			$site_lang = $this->input->cookie('site_lang');
			$err = 0;
			$where['mem_id'] = $this->session->userdata('mem_id');
			$data['member'] = $this->MemberModel->get_members($where)->row();
			if (!$data['member']) {
				$err++;
				if ($site_lang == 'indonesia') {
					$this->session->set_flashdata('error_message', 'Data Tidak Ditemukan');
				}
				else{
					$this->session->set_flashdata('error_message', 'Not Found');
				}
			} else {
				$pp = '-';
				if (isset($_POST['attachment_pp']) && !empty($_POST['attachment_pp'])) {
					$uploadedImg = $_POST['attachment_pp'];
					$image_array_1 = explode(";", $uploadedImg);
					$image_array_2 = explode(",", $image_array_1[1]);
					$uploadedImg = base64_decode($image_array_2[1]);

					if ((strlen($uploadedImg) > $this->config->item('file_size'))) {
						$err++;
						if ($site_lang == 'indonesia') {
							$this->session->set_flashdata('error_message', 'Ukuran file terlalu besar (> 1 MB).');
						}
						else{
							$this->session->set_flashdata('error_message', 'File size is too big (> 1 MB).');
						}
					}
					else{
						$image_name = $this->config->item('path_member').$this->config->item('file_name_member');
						if (!is_dir($this->config->item('path_member')) or !is_writable($this->config->item('path_member'))) {
							$err++;
							if ($site_lang == 'indonesia') {
								$this->session->set_flashdata('error_message', 'Folder members tidak ditemukan atau tidak writable.');
							}
							else{
								$this->session->set_flashdata('error_message', 'Member folder not found or not writable.');
							}
						} else{
							if (is_file($image_name) and !is_writable($image_name)) {
								$err++;
								if ($site_lang == 'indonesia') {
									$this->session->set_flashdata('error_message', 'File sudah ada dan tidak writable.');
								}
								else{
									$this->session->set_flashdata('error_message', 'File already exists and is not writable.');
								}
							}
						}

						if (!$err){
							file_put_contents($image_name, $uploadedImg);
							$pp = str_replace($this->config->item('path_member'), '', $image_name);
						}
					}
				}	

				if (!$err && $pp == "-") {
					$err++;
					if ($site_lang == 'indonesia') {
						$this->session->set_flashdata('error_message', 'PP wajib diisi');
					}
					else{
						$this->session->set_flashdata('error_message', 'PP required');
					}
				}

				if (!$err){
					$record['mem_pp'] = $pp;
					$res = $this->MemberModel->update_members($record, $where);
					if ($res) {
						$this->session->set_userdata('mem_pp', base_url().'uploads/members/'.$pp);
						$this->session->set_flashdata('change_pp', TRUE);
						redirect("frontend/Members/profile", $data);
					} else {
						$err++;
						if ($site_lang == 'indonesia') {
							$this->session->set_flashdata('error_message', 'Gagal mengubah PP');
						}
						else{
							$this->session->set_flashdata('error_message', 'Failed to change PP');
						}
					}
				}
				else {
					$this->load->view("frontend/profile", $data);
				}
			}
		}
		else{
			redirect("frontend/Members");
		}
	}
	public function cek_status($invoice){
		if ($this->uri->segment(4)){
			$site_lang = $this->input->cookie('site_lang');

			$where['mem_pay_invoice'] = $invoice;
			$members = $this->MemberModel->get_members($where)->row();
	
			$clientId = "BRN-0222-1677984841764";
			$requestId = $invoice;
			$date = new DateTime("now", new DateTimeZone('UTC'));
			$requestDate = $date->format('Y-m-d\TH:i:s\Z');
	
			$targetPath = "/orders/v1/status/".$requestId;
			$secretKey = "SK-WjYbHmZGDEhveR9kBxCW";
			
			// Prepare Signature Component
			$componentSignature = "Client-Id:" . $clientId . "\n" . 
								  "Request-Id:" . $requestId . "\n" .
								  "Request-Timestamp:" . $requestDate . "\n" . 
								  "Request-Target:" . $targetPath;
	
			// Calculate HMAC-SHA256 base64 from all the components above
			// $signature = base64_encode(hash_hmac('sha256', $componentSignature, $secretKey, true));
			$signature = $this->generate_signature($componentSignature, $secretKey);
	
			// Initiate cURL
			$ch = curl_init();
	
			curl_setopt_array($ch, array(
				CURLOPT_URL => 'https://api-sandbox.doku.com/orders/v1/status/'.$requestId,
				CURLOPT_RETURNTRANSFER => true,
				CURLOPT_FAILONERROR => true,
				CURLOPT_ENCODING => '',
				CURLOPT_MAXREDIRS => 10,
				CURLOPT_TIMEOUT => 0,
				CURLOPT_FOLLOWLOCATION => true,
				CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
				CURLOPT_CUSTOMREQUEST => 'GET',
				CURLOPT_HTTPHEADER => array(
					'Content-Type: application/json',
					'Client-Id: '.$clientId,
					'Request-Id: '.$requestId,
					'Request-Timestamp: '.$requestDate,
					'Signature: HMACSHA256='.$signature,
				),
			));
	
			// Execute the request
			$result = curl_exec($ch);
	
			if (!curl_errno($ch)) {
				switch ($http_code = curl_getinfo($ch, CURLINFO_HTTP_CODE)) {
					case 200:  # OK
						$statRes = json_decode($result)->transaction->status;
						if($statRes == 'FAILED'){
							$res = $this->failMember($members->mem_id);
							if($res){
								if ($site_lang == 'indonesia') {
									$this->session->set_flashdata('error_message', 'Pembayaran gagal');
								}
								else{
									$this->session->set_flashdata('error_message', 'Payment failed');
								}
							}
							else{
								if ($site_lang == 'indonesia') {
									$this->session->set_flashdata('error_message', 'Gagal mengubah status pendaftaran dengan id = '.$members->mem_id);
								}
								else{
									$this->session->set_flashdata('error_message', 'Failed to change registration status with id = '.$members->mem_id);
								}
							}
							redirect("frontend/Members/register");
						}
						if($statRes == 'SUCCESS'){
							$res = $this->payMember($members->mem_id);
							if($res){
								$this->session->set_flashdata('pro', TRUE);
								redirect("frontend/Members");
							}
							else{
								if ($site_lang == 'indonesia') {
									$this->session->set_flashdata('error_message', 'Gagal membayar pendaftaran dengan id = '.$members->mem_id);
								}
								else{
									$this->session->set_flashdata('error_message', 'Failed to pay registration with id = '.$members->mem_id);
								}
								redirect("frontend/Members/register");
							}
						}
						if($statRes == 'EXPIRED'){
							if ($site_lang == 'indonesia') {
								$this->session->set_flashdata('error_message', 'Batas pembayaran sudah lewat');
							}
							else{
								$this->session->set_flashdata('error_message', 'The payment due date has passed');
							}
						}
						if($statRes == 'PENDING'){
							redirect('frontend/Members/register');
						}
						else{
							if ($site_lang == 'indonesia') {
								$this->session->set_flashdata('error_message', 'Pembayaran gagal');
							}
							else{
								$this->session->set_flashdata('error_message', 'Payment failed');
							}
							redirect('frontend/Members/register');
						}
						break;
					default:
						redirect('frontend/Members/register');
				}
			}
			else{
				$this->session->set_flashdata('error_message', 'Curl error: '.curl_error($ch));
				redirect('frontend/Members/register');
			}
	
			// Close cURL
			curl_close($ch);
		}
		else{
			redirect("frontend/Members");
		}
	}
	function generateInvoice($length = 8) {
		$characters = '0123456789';
		$string = '';
	
		for ($i = 0; $i < $length; $i++) {
			$string .= $characters[mt_rand(0, strlen($characters) - 1)];
		}
	
		$string = 'TESMB-'.$string;
		return $string;
	}
	function generate_signature($componentSignature, $secretKey){
		$signature = base64_encode(hash_hmac('sha256', $componentSignature, $secretKey, true));
		return $signature;
	}
	public function payMember($mem_id){
		$data = array(
			'mem_stat' => $this->config->item('processed')
		);

		$this->db->trans_strict(FALSE);
		$this->db->trans_start();
		$where['mem_id'] = $mem_id;
		$members = $this->MemberModel->update_members($data, $where);
		if ($members) {
			$this->db->trans_complete();
			return true;
		} else {
			$err = 1;
		}
		if ($err) {
			$this->db->trans_rollback();
			return false;
		}
	}
	public function failMember($can_id){
		$data = array(
			'mem_stat' => $this->config->item('payment_failed')
		);

		$this->db->trans_strict(FALSE);
		$this->db->trans_start();
		$where['mem_id'] = $mem_id;
		$members = $this->MemberModel->update_members($data, $where);
		if ($members) {
			$this->db->trans_complete();
			return true;
		} else {
			$err = 1;
		}
		if ($err) {
			$this->db->trans_rollback();
			return false;
		}
	}
}
