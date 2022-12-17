<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Studs extends CI_Controller {
		public function __construct(){
			// Call the CI_Controller constructor
			parent::__construct();
			$this->load->library('upload', $this->config->item('upload_stud'));
			$this->load->model(array('caninesModel', 'studModel'));
		}

		// get by member id
		public function get(){
			if ($this->uri->segment(4)){
				if ($this->uri->segment(5)){
					$stud = $this->studModel->search_by_member_app('', $this->uri->segment(4), $this->uri->segment(5));
					$count = $this->studModel->search_count_by_member_app('', $this->uri->segment(4));
					$sire = array();
					$dam = array();
					foreach ($stud as $s){
						$sire[] = $this->caninesModel->get_canines_gender($s->stu_sire_id)->row()->can_gender;
						$dam[] = $this->caninesModel->get_canines_gender($s->stu_dam_id)->row()->can_gender;
					}
					echo json_encode([
						'status' => true,
						'count_data' => $count[0]->count,
						'count_stud' => $this->config->item('stud_count'),
						'data' => [
							'stud' => $stud,
							'sire' => $sire,
							'dam' => $dam
						]
					]);
				}
				else{
					$stud = $this->studModel->search_by_member_app('', $this->uri->segment(4), 0);
					$count = $this->studModel->search_count_by_member_app('', $this->uri->segment(4));
					$sire = array();
					$dam = array();
					foreach ($stud as $s){
						$sire[] = $this->caninesModel->get_canines_gender($s->stu_sire_id)->row()->can_gender;
						$dam[] = $this->caninesModel->get_canines_gender($s->stu_dam_id)->row()->can_gender;
					}
					echo json_encode([
						'status' => true,
						'count_data' => $count[0]->count,
						'count_stud' => $this->config->item('stud_count'),
						'data' => [
							'stud' => $stud,
							'sire' => $sire,
							'dam' => $dam
						]
					]);
				}
			}
			else
				echo json_encode([
					'status' => false,
					'message' => 'Id member wajib diisi'
				]);
		}

		// search by member id
		public function search(){
			if ($this->uri->segment(4)){
				if ($this->uri->segment(5)){
					if ($this->uri->segment(6)){
						$stud = $this->studModel->search_by_member_app($this->uri->segment(5), $this->uri->segment(4), $this->uri->segment(6));
						$count = $this->studModel->search_count_by_member_app($this->uri->segment(5), $this->uri->segment(4));
						$sire = array();
						$dam = array();
						foreach ($stud as $s){
							$sire[] = $this->caninesModel->get_canines_gender($s->stu_sire_id)->row()->can_gender;
							$dam[] = $this->caninesModel->get_canines_gender($s->stu_dam_id)->row()->can_gender;
						}
						echo json_encode([
							'status' => true,
							'count_data' => $count[0]->count,
							'count_stud' => $this->config->item('stud_count'),
							'data' => [
								'stud' => $stud,
								'sire' => $sire,
								'dam' => $dam
							]
						]);
					}
					else{
						$stud = $this->studModel->search_by_member_app($this->uri->segment(5), $this->uri->segment(4), 0);
						$count = $this->studModel->search_count_by_member_app($this->uri->segment(5), $this->uri->segment(4));
						$sire = array();
						$dam = array();
						foreach ($stud as $s){
							$sire[] = $this->caninesModel->get_canines_gender($s->stu_sire_id)->row()->can_gender;
							$dam[] = $this->caninesModel->get_canines_gender($s->stu_dam_id)->row()->can_gender;
						}
						echo json_encode([
							'status' => true,
							'count_data' => $count[0]->count,
							'count_stud' => $this->config->item('stud_count'),
							'data' => [
								'stud' => $stud,
								'sire' => $sire,
								'dam' => $dam,
							]
						]);
					}
				}
				else
					echo json_encode([
						'status' => false,
						'message' => 'Kata kunci wajib diisi'
					]);
			}
			else
				echo json_encode([
					'status' => false,
					'message' => 'Id member wajib diisi'
				]);
		}

		public function get_by_id(){
			if ($this->uri->segment(4)){
				$where['stu_id'] = $this->uri->segment(4);
				$stud = $this->studModel->get_studs($where)->row();
				
				$sireName = '';
				$sire = $this->caninesModel->get_by_id_app($stud->stu_sire_id);
				if ($sire)
					$sireName = $sire[0]->can_a_s;
				
				$damName = '';
				$dam = $this->caninesModel->get_by_id_app($stud->stu_dam_id);
				if ($dam)
					$damName = $dam[0]->can_a_s;

				echo json_encode([
					'status' => true,
					'data' => $stud,
					'sire' => $sireName,
					'dam' => $damName
				]);
			}
			else
				echo json_encode([
					'status' => false,
					'message' => 'Id pacak wajib diisi'
				]);
		}

		public function add(){
			$err = 0;
			if (empty($this->input->post('stu_member_id'))){
				$err++;
				echo json_encode([
					'status' => false,
					'message' => 'Id member wajib diisi'
				]); 
			}

			if (!$err && empty($this->input->post('stu_sire_id'))){
				$err++;
				echo json_encode([
					'status' => false,
					'message' => 'Id sire wajib diisi'
				]); 
			}

			if (!$err && empty($this->input->post('stu_dam_id'))){
				$err++;
				echo json_encode([
					'status' => false,
					'message' => 'Id dam wajib diisi'
				]); 
			}

			if (!$err && empty($this->input->post('stu_stud_date'))){
				$err++;
				echo json_encode([
					'status' => false,
					'message' => 'Tanggal pacak wajib diisi'
				]); 
			}

			if (!$err){
				$photo = '-';
				if (isset($_FILES['attachment_stud']) && !empty($_FILES['attachment_stud']['tmp_name']) && is_uploaded_file($_FILES['attachment_stud']['tmp_name'])){
					$this->upload->initialize($this->config->item('upload_stud'));
					if ($this->upload->do_upload('attachment_stud')){
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
				$sire = '-';
				if (isset($_FILES['attachment_sire']) && !empty($_FILES['attachment_sire']['tmp_name']) && is_uploaded_file($_FILES['attachment_sire']['tmp_name'])){
					$this->upload->initialize($this->config->item('upload_stud_sire'));
					if ($this->upload->do_upload('attachment_sire')){
						$uploadData = $this->upload->data();
						$sire = $uploadData['file_name'];
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
				$dam = '-';
				if (isset($_FILES['attachment_dam']) && !empty($_FILES['attachment_dam']['tmp_name']) && is_uploaded_file($_FILES['attachment_dam']['tmp_name'])){
					$this->upload->initialize($this->config->item('upload_stud_dam'));
					if ($this->upload->do_upload('attachment_dam')){
						$uploadData = $this->upload->data();
						$dam = $uploadData['file_name'];
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

			if (!$err && $photo == "-"){
				$err++;
				echo json_encode([
					'status' => false,
					'message' => 'Foto pacak wajib diisi'
				]); 
			}

			if (!$err && $sire == "-"){
				$err++;
				echo json_encode([
					'status' => false,
					'message' => 'Foto sire wajib diisi'
				]); 
			}

			if (!$err && $dam == "-"){
				$err++;
				echo json_encode([
					'status' => false,
					'message' => 'Foto dam wajib diisi'
				]); 
			}

			if (!$err){
				$cek = true;
				$piece = explode("-", $this->input->post('stu_stud_date'));
				$date = $piece[2]."-".$piece[1]."-".$piece[0];
		
				$ts = new DateTime($date);
				$ts_now = new DateTime();
				
				if ($ts > $ts_now)
					$cek = false;
				else{
					$diff = floor($ts->diff($ts_now)->days/7);
					if ($diff > 2)
						$cek = false;
				}

				if ($cek){
					$res = $this->studModel->check_date($this->input->post('stu_dam_id'), $date);
					if (!$res){
						$data = array(
							'stu_photo' => $photo,
							'stu_sire_id' => $this->input->post('stu_sire_id'),
							'stu_dam_id' => $this->input->post('stu_dam_id'),
							'stu_sire_photo' => $sire,
							'stu_dam_photo' => $dam,
							'stu_stud_date' => $date,
							'stu_member_id' => $this->input->post('stu_member_id')
						);
						$stud = $this->studModel->add_studs($data);
						echo json_encode([
							'status' => true
						]);
					}
					else{
						echo json_encode([
							'status' => false,
							'message' => 'Pacak interval harus lebih dari 120 hari'
						]);
					}
				}
				else{
					echo json_encode([
						'status' => false,
						'message' => 'Pelaporan pacak harus kurang dari 2 minggu'
					]);
				}
			}
		}

		public function update(){
			$err = 0;
			if (empty($this->input->post('stu_id'))){
				$err++;
				echo json_encode([
					'status' => false,
					'message' => 'Id pacak wajib diisi'
				]); 
			}

			if (!$err && empty($this->input->post('stu_sire_id'))){
				$err++;
				echo json_encode([
					'status' => false,
					'message' => 'Id sire wajib diisi'
				]); 
			}

			if (!$err && empty($this->input->post('stu_dam_id'))){
				$err++;
				echo json_encode([
					'status' => false,
					'message' => 'Id dam wajib diisi'
				]); 
			}

			if (!$err && empty($this->input->post('stu_stud_date'))){
				$err++;
				echo json_encode([
					'status' => false,
					'message' => 'Tanggal pacak wajib diisi'
				]); 
			}

			$photo = '';
			if (!$err && isset($_FILES['attachment_stud']) && !empty($_FILES['attachment_stud']['tmp_name']) && is_uploaded_file($_FILES['attachment_stud']['tmp_name'])){
				$this->upload->initialize($this->config->item('upload_stud'));
				if ($this->upload->do_upload('attachment_stud')){
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

			$sire = '';
			if (!$err && isset($_FILES['attachment_sire']) && !empty($_FILES['attachment_sire']['tmp_name']) && is_uploaded_file($_FILES['attachment_sire']['tmp_name'])){
				$this->upload->initialize($this->config->item('upload_stud_sire'));
				if ($this->upload->do_upload('attachment_sire')){
					$uploadData = $this->upload->data();
					$sire = $uploadData['file_name'];
				}
				else{
					$err++;
					echo json_encode([
						'status' => false,
						'message' => $this->upload->display_errors()
					]);
				}
			}

			$dam = '';
			if (!$err && isset($_FILES['attachment_dam']) && !empty($_FILES['attachment_dam']['tmp_name']) && is_uploaded_file($_FILES['attachment_dam']['tmp_name'])){
				$this->upload->initialize($this->config->item('upload_stud_dam'));
				if ($this->upload->do_upload('attachment_dam')){
					$uploadData = $this->upload->data();
					$dam = $uploadData['file_name'];
				}
				else{
					$err++;
					echo json_encode([
						'status' => false,
						'message' => $this->upload->display_errors()
					]);
				}
			}

			if (!$err){
				$where['stu_id'] = $this->input->post('stu_id');
				$stud = $this->studModel->get_studs($where);
				if (!$stud){
					$err++;
					echo json_encode([
						'status' => false,
						'message' => 'Id pacak tidak valid'
					]);
				}
			}

			if (!$err && $photo && $stud->result()[0]->stu_photo){
				$curr_image = $this->config->item('upload_path_stud').'/'.$stud->result()[0]->stu_photo;
				if (file_exists($curr_image)){
					unlink($curr_image);
				}
			}

			if (!$err && $sire && $stud->result()[0]->stu_sire_photo){
				$curr_image = $this->config->item('upload_path_stud').'/'.$stud->result()[0]->stu_sire_photo;
				if (file_exists($curr_image)){
					unlink($curr_image);
				}
			}

			if (!$err && $dam && $stud->result()[0]->stu_dam_photo){
				$curr_image = $this->config->item('upload_path_stud').'/'.$stud->result()[0]->stu_dam_photo;
				if (file_exists($curr_image)){
					unlink($curr_image);
				}
			}

			if (!$err){
				$cek = true;
				$piece = explode("-", $this->input->post('stu_stud_date'));
				$date = $piece[2]."-".$piece[1]."-".$piece[0];
		
				$ts = new DateTime($date);
				$ts_now = new DateTime();
				
				if ($ts > $ts_now)
					$cek = false;
				else{
					$diff = floor($ts->diff($ts_now)->days/7);
					if ($diff > 2)
						$cek = false;
				}

				if ($cek){
					$data['stu_stud_date'] = $date;
					if ($photo)
						$data['stu_photo'] = $photo;
					if ($sire)
						$data['stu_sire_photo'] = $sire;
					if ($dam)
						$data['stu_dam_photo'] = $dam;
					$data['stu_sire_id'] = $this->input->post('stu_sire_id');
					$data['stu_dam_id'] = $this->input->post('stu_dam_id');
					$res = $this->studModel->update_studs($data, $where);
					echo json_encode([
						'status' => true
					]);
				}
				else{
					echo json_encode([
						'status' => false,
						'message' => 'Pelaporan pacak harus kurang dari 2 minggu'
					]);
				}
			}
		}
}
