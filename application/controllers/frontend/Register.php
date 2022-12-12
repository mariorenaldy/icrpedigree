<?php

class Register extends CI_Controller {
    public function __construct()
    {
		parent::__construct();
		$this->load->model(array('MemberModel','KennelModel'));
	}

	public function index()
	{
        $this->load->view("frontend/register");
	}

	public function signup(){
		$err = 0;
		if (empty($this->input->post('mem_name'))){
			$err++;
			echo json_encode([
				'status' => false,
				'message' => 'Nama sesuai KTP wajib diisi'
			]); 
		}

		if (!$err && empty($this->input->post('mem_address'))){
			$err++;
			echo json_encode([
				'status' => false,
				'message' => 'Alamat sesuai KTP wajib diisi'
			]); 
		}

		if (!$err && empty($this->input->post('mem_mail_address'))){
			$err++;
			echo json_encode([
				'status' => false,
				'message' => 'Alamat surat menyurat wajib diisi'
			]); 
		}

		if (!$err && empty($this->input->post('mem_hp'))){
			$err++;
			echo json_encode([
				'status' => false,
				'message' => 'No. telp member wajib diisi'
			]); 
		}

		if (!$err && empty($this->input->post('mem_kota'))){
			$err++;
			echo json_encode([
				'status' => false,
				'message' => 'Kota member wajib diisi'
			]); 
		}

		if (!$err && empty($this->input->post('mem_kode_pos'))){
			$err++;
			echo json_encode([
				'status' => false,
				'message' => 'Kode pos member wajib diisi'
			]); 
		}

		if (!$err && empty($this->input->post('mem_email'))){
			$err++;
			echo json_encode([
				'status' => false,
				'message' => 'Email member wajib diisi'
			]); 
		}

		if (!$err && empty($this->input->post('mem_ktp'))){
			$err++;
			echo json_encode([
				'status' => false,
				'message' => 'No. KTP member wajib diisi'
			]); 
		}

		if (!$err && empty($this->input->post('mem_username'))){
			$err++;
			echo json_encode([
				'status' => false,
				'message' => 'Username member wajib diisi'
			]); 
		}

		if (!$err && empty($this->input->post('password'))){
			$err++;
			echo json_encode([
				'status' => false,
				'message' => 'Password wajib diisi'
			]); 
		}

		if (!$err && empty($this->input->post('ken_name'))){
			$err++;
			echo json_encode([
				'status' => false,
				'message' => 'Nama kennel wajib diisi'
			]); 
		}

		if (!$err){
			$member = $this->MemberModel->daftar_users($this->input->post('mem_username'))->result();
			if ($member) {
				$err++;
				echo json_encode([
					'status' => false,
					'message' => 'Username sudah ada'
				]);
			}
		}

		if (!$err){
			$member = $this->MemberModel->get_ktp($this->input->post('mem_ktp'))->result();
			if ($member) {
				$err++;
				echo json_encode([
					'status' => false,
					'message' => 'No. KTP sudah ada'
				]);
			}
		}

		if (!$err){
			$kennel = $this->KennelModel->daftar_kennels($this->input->post('ken_name'))->result();
			if ($kennel) {
				$err++;
				echo json_encode([
					'status' => false,
					'message' => 'Nama kennel sudah ada'
				]);
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
				echo json_encode([
					'status' => false,
					'message' => $this->upload->display_errors()
				]);
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
				echo json_encode([
					'status' => false,
					'message' => $this->upload->display_errors()
				]);
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
				echo json_encode([
					'status' => false,
					'message' => $this->upload->display_errors()
				]);
			}
		}

		if (!$err && $photo == "-"){
			$err++;
			echo json_encode([
				'status' => false,
				'message' => 'Foto KTP wajib diisi'
			]);
		}

		if (!$err && $logo == "-"){
			$err++;
			echo json_encode([
				'status' => false,
				'message' => 'Foto kennel wajib diisi'
			]);
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
					echo json_encode([
						'status' => true
					]);
				}
				else{
					$this->db->trans_rollback();
					echo json_encode([
						'status' => false,
						'message' => 'Failed to save account sign up data'
					]);
				}
			}
			else {
				$this->db->trans_rollback();
				echo json_encode([
					'status' => false,
					'message' => 'Failed to save account sign up data'
				]);
			}
		}
	}
}