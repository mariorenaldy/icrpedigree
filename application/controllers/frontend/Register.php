<?php

class Register extends CI_Controller {
    public function __construct()
    {
		parent::__construct();
		$this->load->model(array('MemberModel','KennelModel'));
		$this->load->library('upload', $this->config->item('upload_member'));
	}

	public function index()
	{
        $this->load->view("frontend/register");
	}

	public function signup(){
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
			$member = $this->MemberModel->daftar_users($this->input->post('mem_username'))->result();
			if ($member) {
				$err++;
				$this->session->set_flashdata('error_message', 'Username sudah ada');
			}
		}

		if (!$err){
			$member = $this->MemberModel->get_ktp($this->input->post('mem_ktp'))->result();
			if ($member) {
				$err++;
				$this->session->set_flashdata('error_message', 'No. KTP sudah ada');
			}
		}

		if (!$err){
			$kennel = $this->KennelModel->daftar_kennels($this->input->post('ken_name'))->result();
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

			$ken_id = $this->KennelModel->record_count() + 1;
			$kennel_data = array(
				'ken_id' => $ken_id,
				'ken_name' => $this->input->post('ken_name'),
				'ken_type_id' => $this->input->post('ken_type_id'),
				'ken_photo' => $logo,
				'ken_member_id' => $mem_id
			);

			$this->db->trans_strict(FALSE);
			$this->db->trans_start();
			$id = $this->MemberModel->add_members($data);
			if ($id){
				$res = $this->KennelModel->add_kennels($kennel_data);
				if ($res){
					$this->db->trans_complete();
					$this->session->set_flashdata('register', TRUE);
				}
				else{
					$this->db->trans_rollback();
					$this->session->set_flashdata('error_message', 'Failed to save account sign up data');
				}
			}
			else {
				$this->db->trans_rollback();
				$this->session->set_flashdata('error_message', 'Failed to save account sign up data');
			}
		}
	}
}