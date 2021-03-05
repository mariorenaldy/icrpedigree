<?php // ARTechnology
defined('BASEPATH') OR exit('No direct script access allowed');

class Canines extends CI_Controller {
		private $navigations;
		public function __construct(){
				// Call the CI_Controller constructor
				parent::__construct();
				$this->load->model(array('caninesModel', 'memberModel', 'requestModel'));
				$this->load->library('upload', $this->config->item('upload_canine'));
		}

		public function get_canine(){
			$canine = $this->caninesModel->search_by_member_app('', $this->uri->segment(4), 0);
			$count = $this->caninesModel->search_count_by_member_app('', $this->uri->segment(4));
			echo json_encode([
				'status' => true,
				'count' => $count[0]->count,
				'data' => $canine
			]);
		}

		public function search_canine(){
			$canine = $this->caninesModel->search_by_member_app($this->uri->segment(5), $this->uri->segment(4), $this->uri->segment(6));
			$count = $this->caninesModel->search_count_by_member_app($this->uri->segment(5), $this->uri->segment(4), $this->uri->segment(6));
			echo json_encode([
				'status' => true,
				'count' => $count[0]->count,
				'data' => $canine
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

			if (!$err){
				$photo = '-';
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

			$where['can_id'] = $this->input->post('can_id');
			$can = $this->caninesModel->get_can_pedigrees($where)->row();
			if (!$can){
				$err++;
				echo json_encode([
					'status' => false,
					'message' => 'Id canine tidak valid'
				]);
			}
			
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

		public function logs(){
			$where['req_can_id'] = $this->uri->segment(4);
			$req = $this->requestModel->get_requests($where)->result();
			echo json_encode([
				'status' => true,
				'data' => $req
			]);
		}
}
