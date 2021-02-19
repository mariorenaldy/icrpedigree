<?php // ARTechnology
defined('BASEPATH') OR exit('No direct script access allowed');

class Members extends CI_Controller {
		public function __construct(){
			// Call the CI_Controller constructor
			parent::__construct();
			$this->load->library('bcrypt');
			$this->load->library('upload', $this->config->item('upload_member'));
			$this->load->model(array('memberModel', 'KenneltypeModel', 'KennelModel'));
		}
		
		public function get_member(){
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
					'message' => 'Nama member wajib diisi'
				]); 
			}

			if (!$err && empty($this->input->post('mem_address'))){
				$err++;
				echo json_encode([
					'status' => false,
					'message' => 'Alamat member wajib diisi'
				]); 
			}

			if (!$err && empty($this->input->post('mem_mail_address'))){
				$err++;
				echo json_encode([
					'status' => false,
					'message' => 'Alamat surat member wajib diisi'
				]); 
			}

			if (!$err && empty($this->input->post('mem_hp'))){
				$err++;
				echo json_encode([
					'status' => false,
					'message' => 'No. telp member wajib diisi'
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
				$photo = '-';
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

			if (!$err){
				$logo = '-';
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

			$where['mem_id'] = $this->input->post('mem_id');
			$member = $this->memberModel->get_members($where);
			if (!$member){
				$err++;
				echo json_encode([
					'status' => false,
					'message' => 'Id member tidak valid'
				]);
			}

			if (!$err && $photo && $member->result()[0]->mem_photo){
				$curr_image = $this->config->item('upload_path_member').'/'.$member->result()[0]->mem_photo;
				if (file_exists($curr_image)){
					unlink($curr_image);
				}
			}

			$where2['ken_id'] = $member->result()[0]->mem_ken_id;
			$kennel = $this->KennelModel->get_kennels($where2);
			if (!$err && $logo && $kennel && $kennel->result()[0]->ken_id && $kennel->result()[0]->ken_photo){
				$curr_image = $this->config->item('upload_path_kennel').'/'.$kennel->result()[0]->ken_photo;
				if (file_exists($curr_image)){
					unlink($curr_image);
				}
			}

			$data = array(
				'mem_name' => $this->input->post('mem_name'),
				'mem_address' => $this->input->post('mem_address'),
				'mem_mail_address' => $this->input->post('mem_mail_address'),
				'mem_hp' => $this->input->post('mem_hp'),
				'mem_photo' => $photo
			);
			
			$kennel_data = array(
				'ken_name' => $this->input->post('ken_name'),
				'ken_type_id' => $this->input->post('ken_type_id'),
				'ken_photo' => $logo
			);

			$this->db->trans_strict(FALSE);
			$this->db->trans_start();
			if ($kennel && $kennel->result()[0]->ken_id)
				$this->KennelModel->edit_kennels($kennel_data, $kennel->result()[0]->ken_id);
			else{
				$kennel_data['ken_id'] = $this->KennelModel->record_count() + 1;
				$data['mem_ken_id'] = $kennel_data['ken_id'];
				$this->KennelModel->add_kennels($kennel_data);
			}

			$this->memberModel->update_members($data, $where);
			$this->db->trans_complete();
			echo json_encode([
				'status' => true
			]);
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

			if (!$err && $obj['newpass'] == $obj['password']) {
				$err++;
				echo json_encode([
					'status' => false,
					'message' => 'Password lama tidak boleh sama dengan password baru'
				]);
			}
	
			$where['mem_id'] = $obj['mem_id'];
			$member = $this->memberModel->get_members($where);
			if (!$err){
				if ($this->bcrypt->check_password($obj['password'], $member->result()[0]->mem_password) == false){
					$err++;
					echo json_encode([
						'status' => false,
						'message' => 'Password tidak benar'
					]);
				}
				
				if (!$err) {
					$res = $this->memberModel->edit_password($obj['mem_id'], $this->bcrypt->hash_password($obj['newpass']));
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

					if (!$this->bcrypt->check_password($obj['password'], $member['mem_password'])){
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
					'message' => 'Nama member wajib diisi'
				]); 
			}

			if (!$err && empty($this->input->post('mem_address'))){
				$err++;
				echo json_encode([
					'status' => false,
					'message' => 'Alamat member wajib diisi'
				]); 
			}

			if (!$err && empty($this->input->post('mem_mail_address'))){
				$err++;
				echo json_encode([
					'status' => false,
					'message' => 'Alamat surat member wajib diisi'
				]); 
			}

			if (!$err && empty($this->input->post('mem_hp'))){
				$err++;
				echo json_encode([
					'status' => false,
					'message' => 'No. telp member wajib diisi'
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

			$member = $this->memberModel->daftar_users($this->input->post('mem_username'))->result();
			if (!$err && $member) {
				$err++;
				echo json_encode([
					'status' => false,
					'message' => 'Username sudah ada'
				]);
			}

			if (!$err){
				$photo = '-';
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

			if (!$err){
				$logo = '-';
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
					'mem_username' => $this->input->post('mem_username'),
					'mem_password' => $this->bcrypt->hash_password($this->input->post('password')),
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
}
