<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Members extends CI_Controller {
		public function __construct(){
			// Call the CI_Controller constructor
			parent::__construct();
			$this->load->model(array('MemberModel', 'KenneltypeModel', 'KennelModel'));
			$this->load->library('upload', $this->config->item('upload_member'));
			$this->load->library(array('session', 'form_validation'));
			$this->load->helper(array('form', 'url'));
			$this->load->database();
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
				$member = $this->MemberModel->get_members($where)->row();
				$err = 0;
				if (!$member){
					$err++;
					$this->session->set_flashdata('login_error', 'Maaf nama pengguna tidak terdaftar');
				}
				if (!$err && !$member->mem_stat){
					$err++;
					$this->session->set_flashdata('login_error', 'Masa berlaku member telah habis. Harap melakukan pembayaran');
				}
				if (!$err && !$member->mem_app_user){
					$err++;
					$this->session->set_flashdata('login_error', 'Data member belum di-approve. Harap menghubungi customer service');
				}
				if (!$err && sha1($this->input->post('password')) != $member->mem_password){
					$err++;
					$this->session->set_flashdata('login_error', 'Maaf kata sandi anda salah');
				}
				if (!$err){
					$this->session->set_userdata('username', $this->input->post('username'));
					$this->session->set_userdata('mem_id', $member->mem_id);
					$this->session->set_userdata('mem_stat', $member->mem_stat);
					redirect("frontend/Beranda");
				}
				else{
					$this->load->view("frontend/login_form");
				}
			}
		}

		public function logout(){
			$this->session->unset_userdata('username');
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
			$this->form_validation->set_message('is_unique', '%s tidak boleh sama');
			$this->form_validation->set_rules('mem_name', 'Nama sesuai KTP ', 'trim|required');
			$this->form_validation->set_rules('mem_address', 'Alamat sesuai KTP ', 'trim|required');
			$this->form_validation->set_rules('mem_mail_address', 'Alamat surat menyurat ', 'trim|required');
			$this->form_validation->set_rules('mem_hp', 'No. telp ', 'trim|required');
			$this->form_validation->set_rules('mem_kota', 'Kota ', 'trim|required');
			$this->form_validation->set_rules('mem_kode_pos', 'Kode pos ', 'trim|required');
			$this->form_validation->set_rules('mem_email', 'Email ', 'trim|required');
			$this->form_validation->set_rules('mem_ktp', 'No. KTP ', 'trim|required|is_unique[members.mem_ktp]');
			$this->form_validation->set_rules('mem_username', 'Username ', 'trim|required|is_unique[members.mem_username]');
			$this->form_validation->set_rules('password', 'Password ', 'trim|required');
			$this->form_validation->set_rules('repass', 'Konfirmasi password ', 'trim|matches[password]');
			$this->form_validation->set_rules('ken_name', 'Nama kennel ', 'trim|required|is_unique[kennels.ken_name]');

			$dataReg['kennelType'] = $this->KenneltypeModel->get_kennel_types('')->result();
			if ($this->form_validation->run() == FALSE){
				$this->load->view("frontend/register", $dataReg);
			}
			else{
				$err = 0;
				$photo = '-';
				if (isset($_FILES['attachment_member']) && !empty($_FILES['attachment_member']['tmp_name']) && is_uploaded_file($_FILES['attachment_member']['tmp_name'])){
					if (is_uploaded_file($_FILES['attachment_member']['tmp_name'])){
						$this->upload->initialize($this->config->item('upload_member'));
						if ($this->upload->do_upload('attachment_member')){
							$uploadData = $this->upload->data();
							$photo = $uploadData['file_name'];
						}
						else{
							$err++;
							$this->session->set_flashdata('error_message', $this->upload->display_errors());
						}
					}
				}
	
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
	
				if (!$err && $photo == "-"){
					$err++;
					$this->session->set_flashdata('error_message', 'Foto KTP wajib diisi');
				}
		
				if (!$err && $logo == "-"){
					$err++;
					$this->session->set_flashdata('error_message', 'Foto kennel wajib diisi');
				}
	
				if (!$err){
					$mem_id = $this->MemberModel->record_count() + 1;
					$data = array(
						'mem_id' => $mem_id,
						'mem_name' => $this->input->post('mem_name'),
						'mem_address' => $this->input->post('mem_address'),
						'mem_mail_address' => $this->input->post('mem_mail_address'),
						'mem_hp' => $this->input->post('mem_hp'),
						'mem_photo' => $photo,
						'mem_kota' => $this->input->post('mem_kota'),
						'mem_kode_pos' => $this->input->post('mem_kode_pos'),
						'mem_email' => $this->input->post('mem_email'),
						'mem_ktp' => $this->input->post('mem_ktp'),
						'mem_pp' => $pp,
						'mem_username' => $this->input->post('mem_username'),
						'mem_password' => sha1($this->input->post('password'))
					);
		
					$ken_id = $this->KennelModel->record_count() + 1;
					$kennel_data = array(
						'ken_id' => $ken_id,
						'ken_name' => $this->input->post('ken_name'),
						'ken_type_id' => $this->input->post('ken_type_id'),
						'ken_photo' => $logo,
						'ken_member_id' => $mem_id,
					);
		
					$this->db->trans_strict(FALSE);
					$this->db->trans_start();
					$id = $this->MemberModel->add_members($data);
					if ($id){
						$res = $this->KennelModel->add_kennels($kennel_data);
						if ($res){
							$this->db->trans_complete();
							$this->session->set_flashdata('register', TRUE);
							redirect("frontend/Members");
						}
						else{
							$err = 1;
						}
					}
					else {
						$err = 2;
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
			if ($this->session->userdata('username')){
				$where['mem_username'] = $this->session->userdata('username');
				$data['member'] = $this->MemberModel->get_members($where)->row();
				if (!$data['member']){
					redirect("frontend/Members");
				}
				else{
					if ($this->session->userdata('mem_stat') == '1'){
						$this->load->view("frontend/profile", $data);
						// $this->load->view("frontend/edit_profile", $data);
					}
					else{
						$this->load->view("frontend/profile", $data);
					}
				}
			}
			else{
				redirect("frontend/Members");
			}
		}
}
