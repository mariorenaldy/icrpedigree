<?php // ARTechnology
defined('BASEPATH') OR exit('No direct script access allowed');

class Canines extends CI_Controller {
		private $navigations;
		public function __construct(){
				// Call the CI_Controller constructor
				parent::__construct();
				$this->load->model(array('caninesModel', 'memberModel', 'requestModel', 'pedigreesModel'));
				$this->load->library('upload', $this->config->item('upload_canine'));
		}

		public function get_canine(){
			if ($this->uri->segment(4)){
				if ($this->uri->segment(5)){
					$canine = $this->caninesModel->search_by_member_app('', $this->uri->segment(4), $this->uri->segment(5));
					$count = $this->caninesModel->search_count_by_member_app('', $this->uri->segment(4));
					echo json_encode([
						'status' => true,
						'count_data' => $count[0]->count,
						'count_canine' => $this->config->item('canine_count'),
						'data' => $canine
					]);
				}
				else{
					$canine = $this->caninesModel->search_by_member_app('', $this->uri->segment(4), 0);
					$count = $this->caninesModel->search_count_by_member_app('', $this->uri->segment(4));
					echo json_encode([
						'status' => true,
						'count_data' => $count[0]->count,
						'count_canine' => $this->config->item('canine_count'),
						'data' => $canine
					]);
				}
			}
			else
				echo json_encode([
					'status' => false,
					'message' => 'Id Member wajib diisi'
				]);
		}

		public function search_canine(){
			if ($this->uri->segment(4)){
				if ($this->uri->segment(5)){
					if ($this->uri->segment(6)){
						$canine = $this->caninesModel->search_by_member_app($this->uri->segment(5), $this->uri->segment(4), $this->uri->segment(6));
						$count = $this->caninesModel->search_count_by_member_app($this->uri->segment(5), $this->uri->segment(4));
						echo json_encode([
							'status' => true,
							'count_data' => $count[0]->count,
							'count_canine' => $this->config->item('canine_count'),
							'data' => $canine
						]);
					}
					else{
						$canine = $this->caninesModel->search_by_member_app($this->uri->segment(5), $this->uri->segment(4), 0);
						$count = $this->caninesModel->search_count_by_member_app($this->uri->segment(5), $this->uri->segment(4));
						echo json_encode([
							'status' => true,
							'count_data' => $count[0]->count,
							'count_canine' => $this->config->item('canine_count'),
							'data' => $canine
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
					'message' => 'Id Member wajib diisi'
				]);
		}

		public function get_by_id(){
			if ($this->uri->segment(4)){
				$canine = $this->caninesModel->get_by_id_app($this->uri->segment(4));
				if ($canine){
					echo json_encode([
						'status' => true,
						'data' => $canine[0]
					]);
				}
				else
					echo json_encode([
						'status' => false,
						'message' => 'Canine tidak ditemukan'
					]);
			}
			else
				echo json_encode([
					'status' => false,
					'message' => 'Id canine wajib diisi'
				]);
		}

		public function get_sire(){
			if ($this->uri->segment(4)){
				$where['can_member'] = $this->uri->segment(4);
				$where['can_gender'] = 'Male';
				$canine = $this->caninesModel->get_canines_simple($where);
				if ($canine){
					echo json_encode([
						'status' => true,
						'data' => $canine->result()
					]);
				}
				else
					echo json_encode([
						'status' => false,
						'message' => 'Canine tidak ditemukan'
					]);
			}
			else
				echo json_encode([
					'status' => false,
					'message' => 'Id member wajib diisi'
				]);
		}

		public function get_dam(){
			$where['can_gender'] = 'Female';
			$canine = $this->caninesModel->get_canines_simple($where);
			if ($canine){
				echo json_encode([
					'status' => true,
					'data' => $canine->result()
				]);
			}
			else
				echo json_encode([
					'status' => false,
					'message' => 'Canine tidak ditemukan'
				]);
		}

		public function update(){
			$err = 0;
			if (empty($this->input->post('can_id'))){
				$err++;
				echo json_encode([
					'status' => false,
					'message' => 'Id canine wajib diisi'
				]); 
			}

			if (!$err && empty($this->input->post('can_cage'))){
				$err++;
				echo json_encode([
					'status' => false,
					'message' => 'Kennel wajib diisi'
				]); 
			}

			if (!$err && empty($this->input->post('can_address'))){
				$err++;
				echo json_encode([
					'status' => false,
					'message' => 'Alamat wajib diisi'
				]); 
			}

			if (!$err && empty($this->input->post('can_owner'))){
				$err++;
				echo json_encode([
					'status' => false,
					'message' => 'Pemilik wajib diisi'
				]); 
			}

			$photo = '-';
			if (!$err && isset($_FILES['attachment_canine']) && !empty($_FILES['attachment_canine']['tmp_name'])){
				if (is_uploaded_file($_FILES['attachment_canine']['tmp_name'])){
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
			}

			if (!$err){
				$where['can_id'] = $this->input->post('can_id');
				$can = $this->caninesModel->get_can_pedigrees($where)->row();
				if (!$can){
					$err++;
					echo json_encode([
						'status' => false,
						'message' => 'Id canine tidak valid'
					]);
				}
			}
			
			if (!$err){
				$data['req_can_id'] = $this->input->post('can_id');
				if ($this->input->post('can_cage') && $this->input->post('can_cage') != $can->can_cage)
					$data['req_can_cage'] = $this->input->post('can_cage');
				else
					$data['req_can_cage'] = '';
				if ($this->input->post('can_address') && $this->input->post('can_address') != $can->can_address)
					$data['req_can_address'] = $this->input->post('can_address');
				else
					$data['req_can_address'] = '';
				if ($this->input->post('can_owner') && $this->input->post('can_owner') != $can->can_owner)
					$data['req_can_owner'] = $this->input->post('can_owner');
				else
					$data['req_can_owner'] = '';
				$data['req_can_photo'] = $photo;
				$data['req_app_user'] = 0;

				$this->requestModel->add_requests($data);
				echo json_encode([
					'status' => true
				]);
			}
		}

		public function logs(){
			$where['req_can_id'] = $this->uri->segment(4);
			$req = $this->requestModel->get_requests($where)->result();
			echo json_encode([
				'status' => true,
				'data' => $req
			]);
		}

		public function add(){
			$err = 0;
			if (empty($this->input->post('can_member'))){
				$err++;
				echo json_encode([
					'status' => false,
					'message' => 'Id member wajib diisi'
				]); 
			}

			if (!$err && empty($this->input->post('can_a_s'))){
				$err++;
				echo json_encode([
					'status' => false,
					'message' => 'Nama canine wajib diisi'
				]); 
			}

			if (!$err && empty($this->input->post('can_date_of_birth'))){
				$err++;
				echo json_encode([
					'status' => false,
					'message' => 'Tanggal lahir wajib diisi'
				]); 
			}

			if (!$err && empty($this->input->post('can_color'))){
				$err++;
				echo json_encode([
					'status' => false,
					'message' => 'Warna wajib diisi'
				]); 
			}

			if (!$err && empty($this->input->post('can_current_reg_number'))){
				$err++;
				echo json_encode([
					'status' => false,
					'message' => 'No. registrasi wajib diisi'
				]); 
			}

			if (!$err && empty($this->input->post('can_owner_name'))){
				$err++;
				echo json_encode([
					'status' => false,
					'message' => 'Breeder wajib diisi'
				]); 
			}

			if (!$err && empty($this->input->post('can_cage'))){
				$err++;
				echo json_encode([
					'status' => false,
					'message' => 'Kennel wajib diisi'
				]); 
			}

			if (!$err && empty($this->input->post('can_owner'))){
				$err++;
				echo json_encode([
					'status' => false,
					'message' => 'Pemilik wajib diisi'
				]); 
			}

			if (!$err && empty($this->input->post('can_address'))){
				$err++;
				echo json_encode([
					'status' => false,
					'message' => 'Alamat wajib diisi'
				]); 
			}

			$photo = '-';
			if (!$err && isset($_FILES['attachment_canine']) && !empty($_FILES['attachment_canine']['tmp_name'])){
				if (is_uploaded_file($_FILES['attachment_canine']['tmp_name'])){
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
			}
			
			if (!$err){
				$piece = explode("-", $this->input->post('can_date_of_birth'));
				$date = $piece[2]."-".$piece[1]."-".$piece[0];

				$data = array(
					'can_member' => $this->input->post('can_member'),
					'can_a_s' => $this->input->post('can_a_s'),
					'can_current_reg_number' => $this->input->post('can_current_reg_number'),
					'can_breed' => $this->input->post('can_breed'),
					'can_gender' => $this->input->post('can_gender'),
					'can_date_of_birth' => $date,
					'can_color' => $this->input->post('can_color'),
					'can_owner_name' => $this->input->post('can_owner_name'),
					'can_cage' => $this->input->post('can_cage'),
					'can_owner' => $this->input->post('can_owner'),
					'can_address' => $this->input->post('can_address'),
					'can_reg_date' => date("Y/m/d"),
					'can_photo' => $photo,
				);

				$cek = true;
                $res = $this->caninesModel->check_can_a_s('', $data['can_a_s']);
                if ($res){
                  $cek = false;
                }

				if ($cek){
					$this->db->trans_strict(FALSE);
					$this->db->trans_start();
					$canines = $this->caninesModel->add_canines($data);
					$pedigree = array('ped_canine_id' => $canines,
                                      'ped_sire_id' => 86,
                                      'ped_mom_id' => 87 );
					$pedigree = $this->pedigreesModel->add_pedigrees($pedigree);
					$this->db->trans_complete();
					echo json_encode([
						'status' => true
					]);
				}
				else{
					echo json_encode([
						'status' => false,
						'message' => 'Nama canine tidak boleh sama'
					]); 
				}
			}
		}
}