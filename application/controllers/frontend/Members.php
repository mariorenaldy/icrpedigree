<?php
defined('BASEPATH') OR exit('No direct script access allowed');

#[\AllowDynamicProperties]

class Members extends CI_Controller {
		public function __construct(){
			// Call the CI_Controller constructor
			parent::__construct();
			$this->load->model(array('MemberModel', 'KennelModel', 'KenneltypeModel', 'notification_model'));
			$this->load->library('upload', $this->config->item('upload_member'));
			$this->load->library(array('session', 'form_validation'));
			$this->load->helper(array('form', 'url'));
			$this->load->database();
		}

		public function test_input($data) {
			$data = trim($data);
			$data = stripslashes($data);
			$data = htmlspecialchars($data);
			return $data;
		}

		public function index(){
            if (!$this->session->userdata('username')){
                $this->load->view("frontend/login_form");
            }
            else{
                redirect("frontend/Beranda");
            }
        }

		public function validate_login(){
			$this->form_validation->set_error_delimiters('<div>','</div>');
			$this->form_validation->set_message('required', '%s wajib diisi');
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
						$this->session->set_flashdata('login_error', 'Maaf nama pengguna/no hp tidak terdaftar');
					}
				}
				if (!$err && $member->mem_stat == $this->config->item('rejected')){
					$err++;
					$this->session->set_flashdata('login_error', 'Masa berlaku member telah habis. Harap melakukan pembayaran');
				}
				if (!$err && $member->mem_stat == $this->config->item('saved')){
					$err++;
					$this->session->set_flashdata('login_error', 'Data member belum di-approve. Harap menghubungi customer service');
				}
				if (!$err && sha1($this->input->post('password')) != $member->mem_password){
					$err++;
					$this->session->set_flashdata('login_error', 'Maaf kata sandi anda salah');
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
						$this->session->set_flashdata('login_error', 'Gagal login');
						$this->load->view("frontend/login_form");
					}
				}
				else{
					$this->load->view("frontend/login_form");
				}
			}
		}

		public function logout(){
			session_destroy();
			redirect('frontend/Members');
		}

		public function register(){
			$dataReg['kennelType'] = $this->KenneltypeModel->get_kennel_types('')->result();
			$this->load->view("frontend/register", $dataReg);
		}

		public function validate_register(){
			$this->form_validation->set_error_delimiters('<div>','</div>');
			$this->form_validation->set_message('required', '%s wajib diisi');
			$this->form_validation->set_message('matches', 'Password dan confirm password tidak sama');
			if ($this->input->post('mem_type')){
				$this->form_validation->set_rules('mem_name', 'Nama sesuai KTP ', 'trim|required');
				$this->form_validation->set_rules('mem_hp', 'No. HP Aktif WA ', 'trim|required');
				$this->form_validation->set_rules('mem_email', 'email ', 'trim|required');
				$this->form_validation->set_rules('mem_address', 'Alamat surat menyurat ', 'trim|required');
				if (!$this->input->post('same'))
					$this->form_validation->set_rules('mem_mail_address', 'Alamat yang tertera di sertifikat ', 'trim|required');
				$this->form_validation->set_rules('mem_kota', 'Kota ', 'trim|required');
				$this->form_validation->set_rules('mem_kode_pos', 'Kode pos ', 'trim|required');
				$this->form_validation->set_rules('mem_ktp', 'No. KTP ', 'trim|required');
				$this->form_validation->set_rules('mem_username', 'Username ', 'trim|required');
				$this->form_validation->set_rules('password', 'Password ', 'trim|required');
				$this->form_validation->set_rules('repass', 'Konfirmasi password ', 'trim|matches[password]');
				$this->form_validation->set_rules('ken_name', 'Nama kennel ', 'trim|required');
			}
			else{
				$this->form_validation->set_rules('name', 'Nama sesuai KTP ', 'trim|required');
				$this->form_validation->set_rules('hp', 'No. HP Aktif WA ', 'trim|required');
				$this->form_validation->set_rules('email', 'email ', 'trim|required');
			}

			$dataReg['kennelType'] = $this->KenneltypeModel->get_kennel_types('')->result();
			if ($this->form_validation->run() == FALSE){
				$this->load->view("frontend/register", $dataReg);
			}
			else{
				$err = 0;
				if ($this->input->post('mem_type')){
					if (!isset($_POST['attachment_logo']) || empty($_POST['attachment_logo'])) {
						$err++;
						$this->session->set_flashdata('error_message', 'Foto Kennel wajib diisi');
					}
	
					$pp = '-';
					$logo = '-';
					if (!$err){
						if (isset($_POST['attachment_pp']) && !empty($_POST['attachment_pp'])){
							$uploadedPP = $_POST['attachment_pp'];
							$image_array_1 = explode(";", $uploadedPP);
							$image_array_2 = explode(",", $image_array_1[1]);
							$uploadedPP = base64_decode($image_array_2[1]);
		
							if ((strlen($uploadedPP) > $this->config->item('file_size'))){
								$err++;
								$this->session->set_flashdata('error_message', 'Ukuran file PP terlalu besar (> 1 MB).<br/>');
							}

							$pp_name = $this->config->item('path_member').'member_'.time().'.png';
							if (!is_dir($this->config->item('path_member')) or !is_writable($this->config->item('path_member'))){
								$err++;
								$this->session->set_flashdata('error_message', 'Folder member tidak ditemukan atau tidak writeable.');
							} else {
								if (is_file($pp_name) and !is_writable($pp_name)){
									$err++;
									$this->session->set_flashdata('error_message', 'File PP sudah ada dan tidak writeable.');
								}
							}
						}

						$uploadedLogo = $_POST['attachment_logo'];
						$image_array_1 = explode(";", $uploadedLogo);
						$image_array_2 = explode(",", $image_array_1[1]);
						$uploadedLogo = base64_decode($image_array_2[1]);
	
						if ((strlen($uploadedLogo) > $this->config->item('file_size'))){
							$err++;
							$this->session->set_flashdata('error_message', "Ukuran file Foto Kennel terlalu besar (> 1 MB).<br/>");
						}
						
						$logo_name = $this->config->item('path_kennel').'kennel_'.time().'.png';
						if (!is_dir($this->config->item('path_kennel')) or !is_writable($this->config->item('path_kennel'))){
							$err++;
							$this->session->set_flashdata('error_message', 'Folder kennel tidak ditemukan atau tidak writeable.');
						} else {
							if (is_file($logo_name) and !is_writable($logo_name)){
								$err++;
								$this->session->set_flashdata('error_message', 'File Foto Kennel sudah ada dan tidak writeable.');
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
					$this->session->set_flashdata('error_message', 'Format email tidak valid');
				}

				if ($this->input->post('mem_type')){
					if (!$err && $this->MemberModel->check_for_duplicate(0, 'mem_name', $this->input->post('mem_name'))){
						$err++;
						$this->session->set_flashdata('error_message', 'Registrasi yang lama belum diproses. Harap menghubungi Admin');
					}

					if (!$err && $this->MemberModel->check_for_duplicate(0, 'mem_ktp', $this->input->post('mem_ktp'))){
						$err++;
						$this->session->set_flashdata('error_message', 'No. KTP tidak boleh sama');
					}

					if (!$err && $this->MemberModel->check_for_duplicate(0, 'mem_hp', $this->input->post('mem_hp'))){
						$err++;
						$this->session->set_flashdata('error_message', 'No. HP tidak boleh sama');
					}

					if (!$err && $this->MemberModel->check_for_duplicate(0, 'mem_email', $this->input->post('mem_email'))){
						$err++;
						$this->session->set_flashdata('error_message', 'email tidak boleh sama');
					}

					if (!$err && $this->MemberModel->check_for_duplicate(0, 'mem_username', $this->input->post('mem_email'))){
						$err++;
						$this->session->set_flashdata('error_message', 'email tidak boleh sama');
					}

					if (!$err && $this->KennelModel->check_for_duplicate(0, 'ken_name', $this->input->post('ken_name'))){
						$err++;
						$this->session->set_flashdata('error_message', 'Nama kennel tidak boleh sama');
					}
				} else {
					if (!$err && $this->MemberModel->check_for_duplicate(0, 'mem_name', $this->input->post('name'))){
						$err++;
						$this->session->set_flashdata('error_message', 'Registrasi yang lama belum diproses. Harap menghubungi Admin');
					}

					if (!$err && $this->MemberModel->check_for_duplicate(0, 'mem_hp', $this->input->post('hp'))){
						$err++;
						$this->session->set_flashdata('error_message', 'No. HP tidak boleh sama');
					}

					if (!$err && !$this->input->post('mem_type') && $this->MemberModel->check_for_duplicate(0, 'mem_email', $this->input->post('mem_email'))){
						$err++;
						$this->session->set_flashdata('error_message', 'email tidak boleh sama');
					}
				}
				
				if (!$err){
					if (isset($uploadedPP)){
						file_put_contents($pp_name, $uploadedPP);
						$pp = str_replace($this->config->item('path_member'), '', $pp_name);
					}

					file_put_contents($logo_name, $uploadedLogo);
					$logo = str_replace($this->config->item('path_kennel'), '', $logo_name);

					$mem_id = $this->MemberModel->record_count() + 1;
					if ($this->input->post('mem_type')){
						$dataMember = array(
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
							'mem_stat' => $this->config->item('saved'),
							'mem_type' => $this->config->item('pro_member'),
							'mem_user' => 0,
							'mem_date' => date('Y-m-d H:i:s'),
						);
						
						if ($this->input->post('same'))
							$dataMember['mem_mail_address'] = $this->input->post('mem_address');
						else
							$dataMember['mem_mail_address'] = $this->input->post('mem_mail_address');
						
						$ken_id = $this->KennelModel->record_count() + 1;
						$kennel_data = array(
							'ken_id' => $ken_id,
							'ken_name' => strtoupper($this->input->post('ken_name')),
							'ken_type_id' => $this->input->post('ken_type_id'),
							'ken_photo' => $logo,
							'ken_member_id' => $mem_id,
							'ken_stat' => $this->config->item('saved'),
							'ken_user' => 0,
							'ken_date' => date('Y-m-d H:i:s'),
						);
					}
					else{
						$dataMember = array(
							'mem_id' => $mem_id,
							'mem_name' => strtoupper($this->input->post('name')),
							'mem_hp' => $this->input->post('hp'),
							'mem_email' => $this->input->post('email'),
							'mem_username' => $this->input->post('email'),
							'mem_password' => sha1($this->input->post('hp')),
							'mem_stat' => $this->config->item('accepted'),
							'mem_type' => $this->config->item('free_member'),
							'mem_user' => 0,
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
							'ken_user' => 0,
							'ken_date' => date('Y-m-d H:i:s'),
						);
					}

					$this->db->trans_strict(FALSE);
					$this->db->trans_start();
					$id = $this->MemberModel->add_members($dataMember);
					if ($id){
						$res = $this->KennelModel->add_kennels($kennel_data);
						if ($res){
							$res = $this->notification_model->add(17, $mem_id, $mem_id);
							if ($res){
								$this->db->trans_complete();
								if ($this->input->post('mem_type'))
									$this->session->set_flashdata('pro', TRUE);
								else{
									$this->session->set_flashdata('free', TRUE);
									$this->session->set_flashdata('user', $this->input->post('email'));
								}
								redirect("frontend/Members");
							}
							else{
								$err = 1;
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
						$this->session->set_flashdata('error_message', 'Gagal menyimpan data member');
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
				$this->form_validation->set_error_delimiters('<div>','</div>');
				$this->form_validation->set_message('required', '%s wajib diisi');
				$this->form_validation->set_rules('password', 'Password', 'trim|required');
				$this->form_validation->set_rules('newpass', 'Password Baru', 'trim|required');
				$this->form_validation->set_rules('repass', 'Konfirmasi Password', 'trim|matches[newpass]');
			
				if ($this->form_validation->run() == FALSE){
					$this->load->view('frontend/edit_password');
				}
				else{
					$err = 0;
					$where['mem_id'] = $this->session->userdata('mem_id');
					$member = $this->MemberModel->get_members($where)->row_array();
					if (!$member) {
						$err = 1;
						$this->session->set_flashdata('error_message', 'Data Tidak Ditemukan');
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
								$this->session->set_flashdata('error_message', 'Gagal menyimpan password');
							}
						}
						else {
							$err = 3;
							$this->session->set_flashdata('error_message', 'Password salah');
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
			$err = 0;
			$where['mem_id'] = $this->session->userdata('mem_id');
			$data['member'] = $this->MemberModel->get_members($where)->row();
			if (!$data['member']) {
				$err++;
				$this->session->set_flashdata('error_message', 'Data Tidak Ditemukan');
			} else {
				$pp = '-';
				if (isset($_POST['attachment_pp']) && !empty($_POST['attachment_pp'])) {
					$uploadedImg = $_POST['attachment_pp'];
					$image_array_1 = explode(";", $uploadedImg);
					$image_array_2 = explode(",", $image_array_1[1]);
					$uploadedImg = base64_decode($image_array_2[1]);

					if ((strlen($uploadedImg) > $this->config->item('file_size'))) {
						$err++;
						$this->session->set_flashdata('error_message', 'Ukuran file terlalu besar (> 1 MB).');
					}
					else{
						$image_name = $this->config->item('path_member').'member_'.time().'.png';
						if (!is_dir($this->config->item('path_member')) or !is_writable($this->config->item('path_member'))) {
							$err++;
							$this->session->set_flashdata('error_message', 'Folder members tidak ditemukan atau tidak writeable.');
						} else{
							if (is_file($image_name) and !is_writable($image_name)) {
								$err++;
								$this->session->set_flashdata('error_message', 'File sudah ada dan tidak writeable.');
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
					$this->session->set_flashdata('error_message', 'PP wajib diisi');
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
						$this->session->set_flashdata('error_message', 'Gagal mengubah PP');
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
}
