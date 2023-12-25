<?php
defined('BASEPATH') OR exit('No direct script access allowed');

#[\AllowDynamicProperties]

class Requestmember extends CI_Controller {
		public function __construct(){
			// Call the CI_Controller constructor
			parent::__construct();
			$this->load->model(array('MemberModel', 'KennelModel', 'KenneltypeModel', 'notification_model', 'RequestmemberModel'));
			$this->load->library(array('session', 'form_validation'));
			$this->load->helper(array('form', 'url', 'cookie'));
			$this->load->database();

			if ($this->input->cookie('site_lang')) {
				$this->lang->load('common', $this->input->cookie('site_lang'));
				$this->lang->load('member', $this->input->cookie('site_lang'));
			} else {
				set_cookie('site_lang', 'indonesia', '2147483647'); 
				$this->lang->load('common','indonesia');
				$this->lang->load('member','indonesia');
			}
		}

		public function test_input($data) {
			$data = trim($data);
			$data = stripslashes($data);
			$data = htmlspecialchars($data);
			return $data;
		}

		public function index(){
			if ($this->session->userdata('mem_id')){
				$where['req_member_id'] = $this->session->userdata('mem_id');
				$data['request'] = $this->RequestmemberModel->get_requests($where)->result();
				$this->load->view('frontend/view_request_member', $data);
			}
			else{
				redirect('frontend/Members');
			}
        }

		public function edit_profile(){
			if ($this->session->userdata('mem_id')){
				$cities = $this->MemberModel->get_cities()->result();
				$data['cityOptions'] = "<option value=''>City/Regency</option>";
				foreach($cities as $key => $city){
					$data['cityOptions'] = $data['cityOptions']."<option value='".$city->city_name."'>";
					$data['cityOptions'] = $data['cityOptions'].$city->city_name;
					$data['cityOptions'] = $data['cityOptions']."</option>";
				}

				$data['kennelType'] = $this->KenneltypeModel->get_kennel_types('')->result();
				$where['mem_id'] = $this->session->userdata('mem_id');
				$data['member'] = $this->MemberModel->get_members($where)->row();
				$data['mode'] = 0;
				$this->load->view("frontend/edit_profile", $data);
			}
			else{
				redirect("frontend/Members");
			}
		}

		public function validate_edit(){
			if ($this->session->userdata('mem_id')){
				$site_lang = $this->input->cookie('site_lang');
				$data['kennelType'] = $this->KenneltypeModel->get_kennel_types('')->result();
				$where['mem_id'] = $this->session->userdata('mem_id');
				$data['member'] = $this->MemberModel->get_members($where)->row();
				$data['mode'] = 1;

				$where['req_member_id'] = $this->session->userdata('mem_id');
				$where['req_stat'] = $this->config->item('saved');
				$res = $this->RequestmemberModel->get_requests($where)->num_rows();
				if ($res){
					if ($site_lang == 'indonesia') {
						$this->session->set_flashdata('error_message', 'Laporan ubah kennel yang lama belum diproses. Harap tunggu persetujuan.');
					}
					else{
						$this->session->set_flashdata('error_message', 'The previous kennel change report has not been processed. Please wait for approval.');
					}
					$this->load->view("frontend/edit_profile", $data);
				}
				else{
					$this->form_validation->set_error_delimiters('<div>','</div>');
					if ($site_lang == 'indonesia') {
						$this->form_validation->set_message('required', '%s wajib diisi');
						$this->form_validation->set_rules('mem_name', 'Nama sesuai KTP ', 'trim|required');
						$this->form_validation->set_rules('mem_mail_address', 'Alamat surat menyurat ', 'trim|required');
						$this->form_validation->set_rules('mem_address', 'Alamat ', 'trim|required');
						$this->form_validation->set_rules('mem_hp', 'No. HP Aktif WA ', 'trim|required');
						$this->form_validation->set_rules('mem_kota', 'Kota ', 'trim|required');
						$this->form_validation->set_rules('mem_kode_pos', 'Kode pos ', 'trim|required');
						$this->form_validation->set_rules('mem_email', 'email ', 'trim|required');
						$this->form_validation->set_rules('mem_ktp', 'No. KTP ', 'trim|required');
						$this->form_validation->set_rules('ken_name', 'Nama kennel ', 'trim|required');
					}
					else{
						$this->form_validation->set_rules('mem_name', 'ID Card Name ', 'trim|required');
						$this->form_validation->set_rules('mem_mail_address', 'Mail Address ', 'trim|required');
						$this->form_validation->set_rules('mem_address', 'Address ', 'trim|required');
						$this->form_validation->set_rules('mem_hp', 'Active WhatsApp Number ', 'trim|required');
						$this->form_validation->set_rules('mem_kota', 'City/Regency ', 'trim|required');
						$this->form_validation->set_rules('mem_kode_pos', 'Postal Code ', 'trim|required');
						$this->form_validation->set_rules('mem_email', 'email ', 'trim|required');
						$this->form_validation->set_rules('mem_ktp', 'ID Card Number ', 'trim|required');
						$this->form_validation->set_rules('ken_name', 'Kennel Name ', 'trim|required');
					}
					

					if ($this->form_validation->run() == FALSE){
						$this->load->view("frontend/edit_profile", $data);
					}
					else{
						$err = 0;
						$logo = '-';
						if (isset($_POST['attachment_logo']) && !empty($_POST['attachment_logo'])){
							$uploadedLogo = $_POST['attachment_logo'];
							$image_array_1 = explode(";", $uploadedLogo);
							$image_array_2 = explode(",", $image_array_1[1]);
							$uploadedLogo = base64_decode($image_array_2[1]);
		
							if ((strlen($uploadedLogo) > $this->config->item('file_size'))){
								$err++;
								if ($site_lang == 'indonesia') {
									$this->session->set_flashdata('error_message', "Ukuran file kennel terlalu besar (> 1 MB).");
								}
								else{
									$this->session->set_flashdata('error_message', "The kennel file size is too big (> 1 MB).");
								}
							}

							$logo_name = $this->config->item('path_kennel').$this->config->item('file_name_kennel');
							if (!is_dir($this->config->item('path_kennel')) or !is_writable($this->config->item('path_kennel'))){
								$err++;
								if ($site_lang == 'indonesia') {
									$this->session->set_flashdata('error_message', 'Folder kennel tidak ditemukan atau tidak writable.');
								}
								else{
									$this->session->set_flashdata('error_message', 'Kennel folder is not found or is not writable.');
								}
							} else {
								if (is_file($logo_name) and !is_writable($logo_name)){
									$err++;
									if ($site_lang == 'indonesia') {
										$this->session->set_flashdata('error_message', 'File kennel sudah ada dan tidak writable.');
									}
									else{
										$this->session->set_flashdata('error_message', 'The kennel file is already exists and is not writable.');
									}
								}
							}
						}

						$email = $this->test_input($this->input->post('mem_email'));
						if (!$err && !filter_var($email, FILTER_VALIDATE_EMAIL)) {
							$err++;
							if ($site_lang == 'indonesia') {
								$this->session->set_flashdata('error_message', 'Format email tidak valid');
							}
							else{
								$this->session->set_flashdata('error_message', 'Invalid email format');
							}
						}
	
						if (!$err && $this->MemberModel->check_for_duplicate($this->session->userdata('mem_id'), 'mem_ktp', $this->input->post('mem_ktp'))){
							$err++;
							if ($site_lang == 'indonesia') {
								$this->session->set_flashdata('error_message', 'No. KTP sudah terdaftar');
							}
							else{
								$this->session->set_flashdata('error_message', 'ID Card Number is already registered');
							}
						}
	
						if (!$err && $this->MemberModel->check_for_duplicate($this->session->userdata('mem_id'), 'mem_hp', $this->input->post('mem_hp'))){
							$err++;
							if ($site_lang == 'indonesia') {
								$this->session->set_flashdata('error_message', 'No. HP sudah terdaftar');
							}
							else{
								$this->session->set_flashdata('error_message', 'Phone number is already registered');
							}
						}
		
						if (!$err && $this->MemberModel->check_for_duplicate($this->session->userdata('mem_id'), 'mem_email', $this->input->post('mem_email'))){
							$err++;
							if ($site_lang == 'indonesia') {
								$this->session->set_flashdata('error_message', 'email sudah terdaftar');
							}
							else{
								$this->session->set_flashdata('error_message', 'email is already registered');
							}
						}
	
						if (!$err && $this->KennelModel->check_for_duplicate($this->session->userdata('mem_id'), 'ken_name', $this->input->post('ken_name'))){
							$err++;
							if ($site_lang == 'indonesia') {
								$this->session->set_flashdata('error_message', 'Nama kennel sudah terdaftar');
							}
							else{
								$this->session->set_flashdata('error_message', 'Kennel name is already registered');
							}
						}

						if (!$err) {
							if (isset($uploadedLogo)){
								file_put_contents($logo_name, $uploadedLogo);
								$logo = str_replace($this->config->item('path_kennel'), '', $logo_name);
							}

							$dataMember = array(
								'req_member_id' => $this->session->userdata('mem_id'),
								'req_name' => strtoupper($this->input->post('mem_name')),
								'req_address' => $this->input->post('mem_address'),
								'req_mail_address' => $this->input->post('mem_mail_address'),
								'req_hp' => $this->input->post('mem_hp'),
								'req_kota' => $this->input->post('mem_kota'),
								'req_kode_pos' => $this->input->post('mem_kode_pos'),
								'req_email' => $this->input->post('mem_email'),
								'req_ktp' => $this->input->post('mem_ktp'),
								'req_stat' => $this->config->item('saved'),
								'req_date' => date('Y-m-d H:i:s'),
								'req_kennel_id' => $data['member']->ken_id,
								'req_kennel_name' => $this->input->post('ken_name'),
								'req_kennel_type_id' => $this->input->post('ken_type_id'),
								'req_kennel_photo' => $logo,
								'req_old_name' => $data['member']->mem_name,
								'req_old_address' => $data['member']->mem_address,
								'req_old_mail_address' => $data['member']->mem_mail_address,
								'req_old_hp' => $data['member']->mem_hp,
								'req_old_kota' => $data['member']->mem_kota,
								'req_old_kode_pos' => $data['member']->mem_kode_pos,
								'req_old_email' => $data['member']->mem_email,
								'req_old_ktp' => $data['member']->mem_ktp,
								'req_old_kennel_name' => $data['member']->ken_name,
								'req_old_kennel_type_id' => $data['member']->ken_type_id,
								'req_old_kennel_photo' => $data['member']->ken_photo,
							);

							$insert = $this->RequestmemberModel->add_requests($dataMember);
							if ($insert) {
								$this->session->set_flashdata('edit_profile', TRUE);
								redirect("frontend/Requestmember");
							} else {
								if ($site_lang == 'indonesia') {
									$this->session->set_flashdata('error_message', 'Gagal menyimpan laporan ubah kennel');
								}
								else{
									$this->session->set_flashdata('error_message', 'Failed to save kennel update report');
								}
								$this->load->view("frontend/edit_profile", $data);
							}
						} 
						else {
							$this->load->view("frontend/edit_profile", $data);
						}
					}
				}
			}
			else{
				redirect("frontend/Members");
			}
		}
}
