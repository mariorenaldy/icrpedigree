<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Members extends CI_Controller {
		public function __construct(){
			// Call the CI_Controller constructor
			parent::__construct();
			$this->load->model(array('MemberModel', 'KenneltypeModel'));
			$this->load->library(array('session', 'form_validation'));
			$this->load->helper(array('form', 'url'));
			$this->load->database();
		}

		public function index(){
            if (!$this->session->userdata('username')){
                $data['content'] = 'login';
                $this->load->view("frontend/login_form", $data);
            }
            else{
                redirect("frontend/Beranda");
            }
        }

		public function validate_login(){
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
				redirect("frontend/Beranda");
			}
			else{
				$data['content'] = 'login';
				$this->load->view("frontend/login_form", $data);
			}
		}

		public function logout(){
			$this->session->unset_userdata('username');
			redirect('frontend/Members');
		}

		public function register(){
			$data['kennelType'] = $this->KenneltypeModel->get_kennel_types('')->result();
			$this->load->view("frontend/register", $data);
		}

		public function validate_register(){
			$data['kennelType'] = $this->KenneltypeModel->get_kennel_types('')->result();

			$err = 0;
			if (empty($this->input->post('mem_name'))){
				$err++;
				$this->session->set_flashdata('error_message', 'Nama sesuai KTP wajib diisi');
			}
	
			if (!$err && empty($this->input->post('mem_address'))){
				$err++;
				$this->session->set_flashdata('error_message', 'Alamat sesuai KTP wajib diisi');
			}
	
			if (!$err && empty($this->input->post('mem_mail_address'))){
				$err++;
				$this->session->set_flashdata('error_message', 'Alamat surat menyurat wajib diisi');
			}
	
			if (!$err && empty($this->input->post('mem_hp'))){
				$err++;
				$this->session->set_flashdata('error_message', 'No. telp member wajib diisi');
			}
	
			if (!$err && empty($this->input->post('mem_kota'))){
				$err++;
				$this->session->set_flashdata('error_message', 'Kota member wajib diisi');
			}
	
			if (!$err && empty($this->input->post('mem_kode_pos'))){
				$err++;
				$this->session->set_flashdata('error_message', 'Kode pos member wajib diisi');
			}
	
			if (!$err && empty($this->input->post('mem_email'))){
				$err++;
				$this->session->set_flashdata('error_message', 'Email member wajib diisi');
			}
	
			if (!$err && empty($this->input->post('mem_ktp'))){
				$err++;
				$this->session->set_flashdata('error_message', 'No. KTP member wajib diisi');
			}
	
			if (!$err && empty($this->input->post('mem_username'))){
				$err++;
				$this->session->set_flashdata('error_message', 'Username member wajib diisi');
			}
	
			if (!$err && empty($this->input->post('password'))){
				$err++;
				$this->session->set_flashdata('error_message', 'Password wajib diisi');
			}
	
			if (!$err && empty($this->input->post('ken_name'))){
				$err++;
				$this->session->set_flashdata('error_message', 'Nama kennel wajib diisi');
			}
	
			if (!$err){
				$where['mem_username'] = $this->input->post('mem_username');
				$member = $this->memberModel->get_members($where)->num_rows();
				if ($member) {
					$err++;
					$this->session->set_flashdata('error_message', 'Username sudah ada');
				}
			}
	
			if (!$err){
				$whe['mem_ktp'] = $this->input->post('mem_ktp');
				$member = $this->memberModel->get_members($whe)->num_rows();
				if ($member) {
					$err++;
					$this->session->set_flashdata('error_message', 'No. KTP sudah ada');
				}
			}
	
			if (!$err){
				$whereKennel['ken_name'] = $this->input->post('ken_name');
				$kennel = $this->KennelModel->get_kennels($whereKennel)->num_rows();
				if ($kennel) {
					$err++;
					$this->session->set_flashdata('error_message', 'Nama kennel sudah ada');
				}
			}			
	
			$photo = '-';
			if (!$err && isset($_FILES['attachment_member']) && !empty($_FILES['attachment_member']['tmp_name']) && is_uploaded_file($_FILES['attachment_member']['tmp_name'])){
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
	
			$pp = '-';
			if (!$err && isset($_FILES['attachment_pp']) && !empty($_FILES['attachment_pp']['tmp_name']) && is_uploaded_file($_FILES['attachment_pp']['tmp_name'])){
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
	
			$logo = '-';
			if (!$err && isset($_FILES['attachment_logo']) && !empty($_FILES['attachment_logo']['tmp_name']) && is_uploaded_file($_FILES['attachment_logo']['tmp_name'])){
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
	
				$kennel_data = array(
					'ken_name' => $this->input->post('ken_name'),
					'ken_type_id' => $this->input->post('ken_type_id'),
					'ken_photo' => $logo,
					'ken_member_id' => $mem_id
				);
	
				$err = 0;
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
					$this->session->set_flashdata('error_message', 'Failed to save account sign up data');
					$this->load->view("frontend/register", $data);
				}
			}
		}
}
