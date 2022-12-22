<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Births extends CI_Controller {
		private $navigations;
		public function __construct(){
				// Call the CI_Controller constructor
				parent::__construct();
				$this->load->library('upload', $this->config->item('upload_canine'));
				$this->load->model(array('birthModel', 'caninesModel', 'studModel', 'kennelModel'));
		}

		public function get(){
			if ($this->uri->segment(4)){
				if ($this->uri->segment(5)){
					$birth = $this->birthModel->search_by_member_app('', $this->uri->segment(4), $this->uri->segment(5));
					$count = $this->birthModel->search_count_by_member_app('', $this->uri->segment(4));
					echo json_encode([
						'status' => true,
						'count_data' => $count[0]->count,
						'count_birth' => $this->config->item('birth_count'),
						'data' => $birth
					]);
				}
				else{
					$birth = $this->birthModel->search_by_member_app('', $this->uri->segment(4), 0);
					$count = $this->birthModel->search_count_by_member_app('', $this->uri->segment(4));
					echo json_encode([
						'status' => true,
						'count_data' => $count[0]->count,
						'count_birth' => $this->config->item('birth_count'),
						'data' => $birth
					]);
				}
			}
			else
				echo json_encode([
					'status' => false,
					'message' => 'Id member wajib diisi'
				]);
		}

		public function search(){
			if ($this->uri->segment(4)){
				if ($this->uri->segment(5)){
					if ($this->uri->segment(6)){
						$birth = $this->birthModel->search_by_member_app($this->uri->segment(5), $this->uri->segment(4), $this->uri->segment(6));
						$count = $this->birthModel->search_count_by_member_app($this->uri->segment(5), $this->uri->segment(4));
						echo json_encode([
							'status' => true,
							'count_data' => $count[0]->count,
							'count_birth' => $this->config->item('birth_count'),
							'data' => $birth
						]);
					}
					else{
						$birth = $this->birthModel->search_by_member_app($this->uri->segment(5), $this->uri->segment(4), 0);
						$count = $this->birthModel->search_count_by_member_app($this->uri->segment(5), $this->uri->segment(4));
						echo json_encode([
							'status' => true,
							'count_data' => $count[0]->count,
							'count_birth' => $this->config->item('birth_count'),
							'data' => $birth
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
				$where['bir_id'] = $this->uri->segment(4);
				$birth = $this->birthModel->get_births($where)->row();
				echo json_encode([
					'status' => true,
					'data' => $birth
				]);
			}
			else
				echo json_encode([
					'status' => false,
					'message' => 'Id lahir wajib diisi'
				]);
		}
		
		public function add(){
			$err = 0;
			if (empty($this->input->post('bir_member_id'))){
				$err++;
				echo json_encode([
					'status' => false,
					'message' => 'Id member wajib diisi'
				]); 
			}

			if (!$err && empty($this->input->post('bir_stu_id'))){
				$err++;
				echo json_encode([
					'status' => false,
					'message' => 'Id pacak wajib diisi'
				]); 
			}

			if (!$err && $this->input->post('bir_male') == ''){
				$err++;
				echo json_encode([
					'status' => false,
					'message' => 'Jumlah jantan wajib diisi'
				]); 
			}

			if (!$err && $this->input->post('bir_female') == ''){
				$err++;
				echo json_encode([
					'status' => false,
					'message' => 'Jumlah betina wajib diisi'
				]); 
			}

			if (!$err && empty($this->input->post('bir_date_of_birth'))){
				$err++;
				echo json_encode([
					'status' => false,
					'message' => 'Tanggal lahir wajib diisi'
				]); 
			}

			if (!$err){
				$damPhoto = '-';
				if (isset($_FILES['attachment_dam']) && !empty($_FILES['attachment_dam']['tmp_name']) && is_uploaded_file($_FILES['attachment_dam']['tmp_name'])){
					$this->upload->initialize($this->config->item('upload_birth'));
					if ($this->upload->do_upload('attachment_dam')){
						$uploadData = $this->upload->data();
						$damPhoto = $uploadData['file_name'];
					}
					else{
						$err++;
						echo json_encode([
							'status' => false,
							'message' => $this->upload->display_errors()
						]);
					}
				}

				if (!$err && $damPhoto == "-"){
					$err++;
					echo json_encode([
						'status' => false,
						'message' => 'Foto dam wajib diisi'
					]); 
				}
					
				if (!$err){
					// syarat maksimal 75 hari dari lapor pacak
					$whereStud['stu_id'] = $this->input->post('bir_stu_id');
					$stud = $this->studModel->get_studs($whereStud)->row();
					if ($stud){
						$piece = explode("-", $this->input->post('bir_date_of_birth'));
						$date = $piece[2]."-".$piece[1]."-".$piece[0];
		
						$ts = new DateTime($date);
						$ts_stud = new DateTime($stud->stu_stud_date);
						if ($ts_stud > $ts){
							$err++;
							echo json_encode([
								'status' => false,
								'message' => 'Pelaporan lahir harus kurang dari '.$this->config->item('jarak_lapor_lahir').' hari dari waktu pacak'
							]); 
						}
						else{
							$diff = floor($ts->diff($ts_stud)->days/$this->config->item('jarak_lapor_lahir'));
							if ($diff > 1){
								$err++;
								echo json_encode([
									'status' => false,
									'message' => 'Pelaporan lahir harus kurang dari '.$this->config->item('jarak_lapor_lahir').' hari dari waktu pacak'
								]);
							}
						}
					}
					else{
						$err++;
						echo json_encode([
							'status' => false,
							'message' => 'Id pacak tidak valid'
						]); 
					}

					if (!$err){
						$data = array(
							'bir_stu_id' => $this->input->post('bir_stu_id'),
							'bir_member_id' => $this->input->post('bir_member_id'),
							'bir_dam_photo' => $damPhoto,
							'bir_male' => $this->input->post('bir_male'),
							'bir_female' => $this->input->post('bir_female'),
							'bir_date_of_birth' => $date,
						);
						$births = $this->birthModel->add_births($data);
						if ($births){
							echo json_encode([
								'status' => true
							]);
						}
						else{
							echo json_encode([
								'status' => false,
								'message' => 'Gagal menyimpan lahir'
							]);
						}
					}
				}
			}
		}

		public function update(){
			$err = 0;
			if (empty($this->input->post('bir_id'))){
				$err++;
				echo json_encode([
					'status' => false,
					'message' => 'Id lahir wajib diisi'
				]); 
			}

			if (!$err && empty($this->input->post('bir_a_s'))){
				$err++;
				echo json_encode([
					'status' => false,
					'message' => 'Nama canine wajib diisi'
				]); 
			}

			if (!$err && !$this->input->post('bir_date_of_birth')){
				$err++;
				echo json_encode([
					'status' => false,
					'message' => 'Tanggal lahir wajib diisi'
				]); 
			}

			if (!$err){
				$res = $this->caninesModel->check_can_a_s($this->input->post('bir_id'), $this->input->post('bir_a_s'));
				$photo = '';
				if (!$res){
					if (isset($_FILES['attachment_canine']) && !empty($_FILES['attachment_canine']['tmp_name']) && is_uploaded_file($_FILES['attachment_canine']['tmp_name'])){
						$this->upload->initialize($this->config->item('upload_canine'));
						if ($this->upload->do_upload('attachment_canine')){
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

					if (isset($_FILES['attachment_dam']) && !empty($_FILES['attachment_dam']['tmp_name']) && is_uploaded_file($_FILES['attachment_dam']['tmp_name'])){
						$this->upload->initialize($this->config->item('upload_birth'));
						if ($this->upload->do_upload('attachment_dam')){
							$uploadData = $this->upload->data();
							$damPhoto = $uploadData['file_name'];
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
					$where['bir_id'] = $this->input->post('bir_id');
					$birth = $this->birthModel->get_births($where);
					if (!$birth){
						$err++;
						echo json_encode([
							'status' => false,
							'message' => 'Id lahir tidak valid'
						]);
					}
				}

				if (!$err && $photo && $birth->result()[0]->bir_photo){
					$curr_image = $this->config->item('upload_path_canine').'/'.$birth->result()[0]->bir_photo;
					if (file_exists($curr_image)){
						unlink($curr_image);
					}
				}

				if (!$err && $damPhoto && $birth->result()[0]->bir_dam_photo){
					$curr_image = $this->config->item('upload_path_birth').'/'.$birth->result()[0]->bir_dam_photo;
					if (file_exists($curr_image)){
						unlink($curr_image);
					}
				}

				if (!$err){
					$data = array(
						'bir_a_s' => $this->input->post('bir_a_s'),
						'bir_breed' => $this->input->post('bir_breed'),
						'bir_gender' => $this->input->post('bir_gender'),
						'bir_color' => $this->input->post('bir_color'),
						'bir_date_of_birth' => $date
					);
					if ($photo)
						$data['bir_photo'] = $photo;
					if ($damPhoto)
						$data['bir_dam_photo'] = $damPhoto;
					$this->birthModel->update_births($data, $where);
					echo json_encode([
						'status' => true
					]);
				}
				else
					echo json_encode([
						'status' => false,
						'message' => 'Nama canine tidak boleh sama'
					]);
			}
		}
}
