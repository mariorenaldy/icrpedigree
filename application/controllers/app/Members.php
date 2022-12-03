<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Members extends CI_Controller {
		public function __construct(){
			// Call the CI_Controller constructor
			parent::__construct();
			$this->load->model(array('memberModel', 'KenneltypeModel', 'KennelModel', 'logmemberModel'));
			$this->load->library('upload', $this->config->item('upload_member'));
			$this->load->library('email', $this->config->item('email'));
			$this->email->set_newline("\r\n");
			$this->load->library(array('session', 'form_validation'));
			$this->load->helper(array('url'));
			$this->load->database();
		}
		
		public function get_member(){
			if ($this->uri->segment(4)){
				$where['mem_id'] = $this->uri->segment(4);
				$member = $this->memberModel->get_members($where)->row();
				$whe['ken_member_id'] = $this->uri->segment(4);
				$kennel = $this->KennelModel->get_kennels($whe)->result();
				echo json_encode([
					'status' => true,
					'data' => [
						'member' => $member,
						'kennel' => $kennel
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

			$photo = '';
			if (!$err && isset($_FILES['attachment_member']) && !empty($_FILES['attachment_member']['tmp_name']) && is_uploaded_file($_FILES['attachment_member']['tmp_name'])){
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
			if (!$err && isset($_FILES['attachment_pp']) && !empty($_FILES['attachment_pp']['tmp_name']) && is_uploaded_file($_FILES['attachment_pp']['tmp_name'])){
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
			if (!$err && isset($_FILES['attachment_logo']) && !empty($_FILES['attachment_logo']['tmp_name']) && is_uploaded_file($_FILES['attachment_logo']['tmp_name'])){
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
				$log = $this->logmemberModel->get_log($this->input->post('mem_id'))->result();
				if ($log){
					$err++;
					echo json_encode([
						'status' => false,
						'message' => 'Data pengubahan sebelumnya belum diproses'
					]);
				}
			}

			if (!$err){
				$data = array(
					'log_member_id' => $this->input->post('mem_id'),
					'log_name' => $this->input->post('mem_name'),
					'log_address' => $this->input->post('mem_address'),
					'log_mail_address' => $this->input->post('mem_mail_address'),
					'log_hp' => $this->input->post('mem_hp'),
					'log_kota' => $this->input->post('mem_kota'),
					'log_kode_pos' => $this->input->post('mem_kode_pos'),
					'log_email' => $this->input->post('mem_email'),
					'log_stat' => 0
				);

				if ($photo)
					$data['log_photo'] = $photo;
				if ($pp)
					$data['log_pp'] = $pp;

				$this->logmemberModel->add_log($data);
				
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

			if (!$err && empty($obj['token'])){
				echo json_encode([
					'status' => false,
					'message' => 'Token wajib diisi'
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
						return false;
					}

					if (!$member['mem_app_user']){
						echo json_encode([
							'status' => false,
							'message' => 'Data member belum di-approve. Harap menghubungi customer service'
						]);
						return false;
					}

					if (sha1($obj['password']) != $member['mem_password']){
						echo json_encode([
							'status' => false,
							'message' => 'Password salah'
						]);
						return false;
					}

					$res = $this->memberModel->edit_token($member['mem_id'], $obj['token']);
					if ($res){
						echo json_encode([
							'status' => true,
							'data' => [ 
								'username' => $obj['username'],
								'userid' => $member['mem_id']
							]
						]);
						return true;
					}
					else{
						echo json_encode([
							'status' => false,
							'message' => 'Gagal login'
						]);
						return false;
					}
				}
				else{
					echo json_encode([
						'status' => false,
						'message' => 'Username tidak terdaftar'
					]);
					return false;
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
				$member = $this->memberModel->daftar_users($this->input->post('mem_username'))->result();
				if ($member) {
					$err++;
					echo json_encode([
						'status' => false,
						'message' => 'Username sudah ada'
					]);
				}
			}

			if (!$err){
				$member = $this->memberModel->get_ktp($this->input->post('mem_ktp'))->result();
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
				$mem_id = $this->memberModel->record_count() + 1;
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
				$id = $this->memberModel->add_members($data);
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

		public function test_input($data) {
			$data = trim($data);
			$data = stripslashes($data);
			$data = htmlspecialchars($data);
			return $data;
		}

		public function forgotpassword(){
			$json = file_get_contents('php://input');
			$obj = json_decode($json, true);
			
			$err = 0;
			if (empty($obj['email'])){
				$err++;
				echo json_encode([
					'status' => false,
					'message' => 'Email wajib diisi'
				]); 
			}
	
			$email = $this->test_input($obj['email']);
			if (!$err && !filter_var($email, FILTER_VALIDATE_EMAIL)) {
				$err++;
				echo json_encode([
					'status' => false,
					'message' => 'Format email tidak valid'
				]); 
			}
	
			if (!$err){
				$where['members.mem_email'] = $obj['email'];
				$res = $this->memberModel->get_members($where);
				if ($res){
					$this->email->set_mailtype('html');
					$this->email->from($this->config->item('email')['smtp_user'], 'ICR Pedigree Customer Service');
					$this->email->to($obj['email']);
					$this->email->subject('Ubah Password');

					$message = '<div>Kepada pengguna ICR Pedigree,</div>';
					$message .= '<div>Kami mendapat permintaan untuk mengubah password ICR Pedigree. Klik link di bawah untuk mengubah password:</div>';
					$message .= '<div><a href="' . base_url().$this->config->item('forgot_password').$res->row()->mem_id.'">Ubah Password</a></div>';
					$message .= '<div>Jika Anda tidak ingin mengubah password, abaikan email ini.</div>';
					$message .= '<div>Salam </div>';
					$message .= '<div>ICR Pedigree Customer Service</div>';
					$message .= '<div><br/><hr/></div>';

					$this->email->message($message);
					$res = $this->email->send();
					if ($res){
						echo json_encode([
							'status' => true
						]);
					} else {
						echo json_encode([
							'status' => false,
							'message' => 'Gagal mengirim email',
							'error' => $this->email->print_debugger()
						]); 
					}
				}
				else{
					echo json_encode([
						'status' => false,
						'message' => 'Email tidak valid'
					]);
				}
			} 			
		}

		public function logs(){
			if ($this->uri->segment(4)){
				$where['mem_id'] = $this->uri->segment(4);
				$member = $this->memberModel->get_members($where)->row();
				$where_log['log_member_id'] = $this->uri->segment(4);
				$logs = $this->logmemberModel->get_logs($where_log)->result();
				echo json_encode([
					'status' => true,
					'data' => [
						'member' => $member,
						'logs' => $logs
					]
				]);
			}
			else
				echo json_encode([
					'status' => false,
					'message' => 'Id Member wajib diisi'
				]);
		}

}
