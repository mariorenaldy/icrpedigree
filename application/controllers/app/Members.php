<?php // ARTechnology
defined('BASEPATH') OR exit('No direct script access allowed');

class Members extends CI_Controller {
		public function __construct(){
			// Call the CI_Controller constructor
			parent::__construct();
			$this->load->library('upload', $this->config->item('upload_member'));
			$this->load->model(array('memberModel', 'KenneltypeModel', 'KennelModel'));
		}
		
		public function get_member(){
			if ($this->uri->segment(4)){
				$where['mem_id'] = $this->uri->segment(4);
				$member = $this->memberModel->get_members($where)->row();
				$ken_types = $this->KenneltypeModel->get_kennel_types()->result();
				echo json_encode([
					'status' => true,
					'data' => [
						'member' => $member,
						'ken_types' => $ken_types
					]
				]);
			}
			else
				echo json_encode([
					'status' => false,
					'message' => 'Id Member wajib diisi'
				]);
		}

		public function update_profile(){
			$err = 0;
			if (empty($this->input->post('mem_id'))){
				$err++;
				echo json_encode([
					'status' => false,
					'message' => 'Id member wajib diisi'
				]); 
			}

			if (!$err && empty($this->input->post('mem_name'))){
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

			if (!$err && empty($this->input->post('ken_name'))){
				$err++;
				echo json_encode([
					'status' => false,
					'message' => 'Nama kennel wajib diisi'
				]); 
			}

			$photo = '';
			if (!$err && $this->input->post('attachment_member') && !$_FILES['attachment_member']['error']){
				if (is_uploaded_file($_FILES['attachment_member']['tmp_name'])){
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
			}

			$pp = '';
			if (!$err && $this->input->post('attachment_pp') && !$_FILES['attachment_pp']['error']){
				if (is_uploaded_file($_FILES['attachment_pp']['tmp_name'])){
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
			}

			$logo = '';
			if (!$err && $this->input->post('attachment_logo') && !$_FILES['attachment_logo']['error']){
				if (is_uploaded_file($_FILES['attachment_logo']['tmp_name'])){
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
			}

			if (!$err){
				$where['mem_id'] = $this->input->post('mem_id');
				$member = $this->memberModel->get_members($where);
				if (!$member){
					$err++;
					echo json_encode([
						'status' => false,
						'message' => 'Id member tidak valid'
					]);
				}
			}

			if (!$err && $photo && $member->result()[0]->mem_photo){
				$curr_image = $this->config->item('upload_path_member').'/'.$member->result()[0]->mem_photo;
				if (file_exists($curr_image)){
					unlink($curr_image);
				}
			}

			if (!$err && $pp && $member->result()[0]->mem_pp){
				$curr_image = $this->config->item('upload_path_member').'/'.$member->result()[0]->mem_pp;
				if (file_exists($curr_image)){
					unlink($curr_image);
				}
			}

			if (!$err){
				$where2['ken_id'] = $member->result()[0]->mem_ken_id;
				$kennel = $this->KennelModel->get_kennels($where2);
				if ($logo && $kennel && $kennel->result()[0]->ken_id && $kennel->result()[0]->ken_photo){
					$curr_image = $this->config->item('upload_path_kennel').'/'.$kennel->result()[0]->ken_photo;
					if (file_exists($curr_image)){
						unlink($curr_image);
					}
				}
			}

			if (!$err){
				$data = array(
					'mem_name' => $this->input->post('mem_name'),
					'mem_address' => $this->input->post('mem_address'),
					'mem_mail_address' => $this->input->post('mem_mail_address'),
					'mem_hp' => $this->input->post('mem_hp'),
					'mem_kota' => $this->input->post('mem_kota'),
					'mem_kode_pos' => $this->input->post('mem_kode_pos'),
					'mem_email' => $this->input->post('mem_email')
				);
				if ($photo)
					$data['mem_photo'] = $photo;
				if ($pp)
					$data['mem_pp'] = $pp;
				
				$kennel_data = array(
					'ken_name' => $this->input->post('ken_name'),
					'ken_type_id' => $this->input->post('ken_type_id')
				);
				if ($logo)
					$kennel_data['ken_photo'] = $logo;

				$this->db->trans_strict(FALSE);
				$this->db->trans_start();
				if ($kennel && $kennel->result()[0]->ken_id)
					$this->KennelModel->edit_kennels($kennel_data, $kennel->result()[0]->ken_id);
				else{
					$kennel_data['ken_id'] = $this->KennelModel->record_count() + 1;
					$data['mem_ken_id'] = $kennel_data['ken_id'];
					if (!$logo)
						$kennel_data['ken_photo'] = '-';
					$this->KennelModel->add_kennels($kennel_data);
				}

				$this->memberModel->update_members($data, $where);
				$this->db->trans_complete();
				echo json_encode([
					'status' => true
				]);
			}
		}

		public function change_password(){
			$json = file_get_contents('php://input');
			$obj = json_decode($json, true);
	
			$err = 0;
			if (empty($obj['mem_id'])){
				$err++;
				echo json_encode([
					'status' => false,
					'message' => 'Member id wajib diisi'
				]); 
			}
			
			if (!$err && empty($obj['password'])){
				$err++;
				echo json_encode([
					'status' => false,
					'message' => 'Password wajib diisi'
				]); 
			}
	
			if (!$err && empty($obj['newpass'])){
				$err++;
				echo json_encode([
					'status' => false,
					'message' => 'Password wajib diisi'
				]); 
			}
	
			if (!$err){
				$where['mem_id'] = $obj['mem_id'];
				$member = $this->memberModel->get_members($where);
				if (sha1($obj['password']) != $member->result()[0]->mem_password){
					$err++;
					echo json_encode([
						'status' => false,
						'message' => 'Password tidak benar'
					]);
				}
				
				if (!$err) {
					$res = $this->memberModel->edit_password($obj['mem_id'], sha1($obj['newpass']));
					if ($res){
						echo json_encode([
							'status' => true
						]);
					}
					else{
						echo json_encode([
							'status' => false,
							'message' => 'Gagal menyimpan password'
						]); 
					}
				}
				else{
					echo json_encode([
						'status' => false,
						'message' => 'Member id tidak benar'
					]);
				} 
			} 
		}

		public function signin(){
			$json = file_get_contents('php://input');
			$obj = json_decode($json, true);
			
			$err = 0;
			if (empty($obj['username'])){
				$err++;
				echo json_encode([
					'status' => false,
					'message' => 'Username wajib diisi'
				]); 
			}
	
			if (!$err && empty($obj['password'])){
				echo json_encode([
					'status' => false,
					'message' => 'Password wajib diisi'
				]); 
			}
			
			if (!$err){
				$where['members.mem_username'] = $obj['username'];
				$member = $this->memberModel->get_members($where)->row_array();
				if ($member) {
					if (!$member['mem_stat']){
						echo json_encode([
							'status' => false,
							'message' => 'Masa berlaku member telah habis. Harap melakukan pembayaran'
						]);
					}

					if (!$member['mem_app_user']){
						echo json_encode([
							'status' => false,
							'message' => 'Data member belum di-approve. Harap menghubungi customer service'
						]);
					}

					if (sha1($obj['password']) != $member['mem_password']){
						echo json_encode([
							'status' => false,
							'message' => 'Password salah'
						]);
					}

					echo json_encode([
						'status' => true,
						'data' => [ 
							'username' => $obj['username'],
							'userid' => $member['mem_id']
						]
					]);
				}
				else{
					echo json_encode([
						'status' => false,
						'message' => 'Username tidak terdaftar'
					]);
				}
			} 
		}
	
		public function signout(){
			$json = file_get_contents('php://input');
			$obj = json_decode($json, true);
	
			$err = 0;
			if (empty($obj['username'])){
				$err++;
				echo json_encode([
					'status' => false,
					'message' => 'Username wajib diisi'
				]); 
			}
	
			if (!$err){
				$where['members.mem_username'] = $obj['username'];
				$member = $this->memberModel->get_members($where)->row_array();
				if ($member){
					echo json_encode([
						'status' => true
					]);
				}
				else
					echo json_encode([
						'status' => false,
						'message' => 'Username tidak terdaftar'
					]);
			}
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
				$member = $this->memberModel->daftar_users($this->input->post('mem_username'))->result();
				if ($member) {
					$err++;
					echo json_encode([
						'status' => false,
						'message' => 'Username sudah ada'
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
					'message' => 'Foto logo wajib diisi'
				]);
			}

			if (!$err){
				$ken_id = $this->KennelModel->record_count() + 1;
				$kennel_data = array(
					'ken_id' => $ken_id,
					'ken_name' => $this->input->post('ken_name'),
					'ken_type_id' => $this->input->post('ken_type_id'),
					'ken_photo' => $logo
				);

				$data = array(
					'mem_name' => $this->input->post('mem_name'),
					'mem_address' => $this->input->post('mem_address'),
					'mem_mail_address' => $this->input->post('mem_mail_address'),
					'mem_hp' => $this->input->post('mem_hp'),
					'mem_photo' => $photo,
					'mem_kota' => $this->input->post('mem_kota'),
					'mem_kode_pos' => $this->input->post('mem_kode_pos'),
					'mem_email' => $this->input->post('mem_email'),
					'mem_pp' => $pp,
					'mem_username' => $this->input->post('mem_username'),
					'mem_password' => sha1($this->input->post('password')),
					'mem_ken_id' => $ken_id
				);
				
				$this->db->trans_strict(FALSE);
				$this->db->trans_start();
				$this->KennelModel->add_kennels($kennel_data);

				$id = $this->memberModel->add_members($data);
				if ($id){
					$this->db->trans_complete();
					echo json_encode([
						'status' => true
					]);
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

		public function reset_password(){
			$json = file_get_contents('php://input');
			$obj = json_decode($json, true);
	
			$err = 0;
			if (empty($obj['mem_id'])){
				$err++;
				echo json_encode([
					'status' => false,
					'message' => 'Member id wajib diisi'
				]); 
			}
			
			if (!$err && empty($obj['newpass'])){
				$err++;
				echo json_encode([
					'status' => false,
					'message' => 'Password baru wajib diisi'
				]); 
			}

			if (!$err){
				$where['mem_id'] = $obj['mem_id'];
				$user = $this->memberModel->get_members($where)->row_array();
				if ($user == null) {
					$err++;
					echo json_encode([
						'status' => false,
						'message' => 'Data tidak ditemukan'
					]);
				}
			}
			
			if (!$err){
				$data['mem_password'] = sha1($obj['newpass']);
				$this->memberModel->update_members($data, $where);
				echo json_encode([
					'status' => true
				]);
			}
		}
}
