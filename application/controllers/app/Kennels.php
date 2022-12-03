<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Kennels extends CI_Controller {
		public function __construct(){
			// Call the CI_Controller constructor
			parent::__construct();
			$this->load->model(array('KennelModel', 'logkennelModel'));
			$this->load->library('upload', $this->config->item('upload_kennel'));
			$this->load->library(array('session', 'form_validation'));
			$this->load->helper(array('url'));
			$this->load->database();
		}
		
		public function get_kennel(){
			if ($this->uri->segment(4)){
				$where['ken_id'] = $this->uri->segment(4);
				$kennel = $this->KennelModel->get_kennels($where)->row();
				echo json_encode([
					'status' => true,
					'data' => $kennel
				]);
			}
			else
				echo json_encode([
					'status' => false,
					'message' => 'Id Kennel wajib diisi'
				]);
		}

		public function update(){
			$err = 0;
			if (empty($this->input->post('ken_id'))){
				$err++;
				echo json_encode([
					'status' => false,
					'message' => 'Id kennel wajib diisi'
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
				$kennel = $this->KennelModel->daftar_kennels($this->input->post('ken_name'))->result();
				if ($kennel) {
					$err++;
					echo json_encode([
						'status' => false,
						'message' => 'Nama kennel sudah ada'
					]);
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
				$log = $this->logkennelModel->get_log($this->input->post('ken_id'))->result();
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
					'log_kennel_id' => $this->input->post('ken_id'),
					'log_kennel_name' => $this->input->post('ken_name'),
					'log_kennel_type_id' => $this->input->post('ken_type_id'),
					'log_stat' => 0
				);

				if ($logo)
					$data['log_kennel_photo'] = $logo;

				$this->logkennelModel->add_log($data);
				
				echo json_encode([
					'status' => true
				]);
			}
		}

		public function add(){
			$err = 0;
			if (empty($this->input->post('ken_member_id'))){
				$err++;
				echo json_encode([
					'status' => false,
					'message' => 'Id member wajib diisi'
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
				$kennel = $this->KennelModel->daftar_kennels($this->input->post('ken_name'))->result();
				if ($kennel) {
					$err++;
					echo json_encode([
						'status' => false,
						'message' => 'Nama kennel sudah ada'
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
					'ken_photo' => $logo,
					'ken_member_id' => $this->input->post('ken_member_id')
				);

				$id = $this->KennelModel->add_kennels($kennel_data);
				if ($id){
					echo json_encode([
						'status' => true
					]);
				}
				else {
					echo json_encode([
						'status' => false,
						'message' => 'Failed to save kennel data'
					]);
				}
			}
		}

		public function logs(){
			if ($this->uri->segment(4)){
				$where['ken_id'] = $this->uri->segment(4);
				$kennel = $this->KennelModel->get_kennels($where)->row();
				$where_log['log_kennel_id'] = $this->uri->segment(4);
				$logs = $this->logkennelModel->get_logs($where_log)->result();
				echo json_encode([
					'status' => true,
					'data' => [
						'kennel' => $kennel,
						'logs' => $logs
					]
				]);
			}
			else
				echo json_encode([
					'status' => false,
					'message' => 'Id kennel wajib diisi'
				]);
		}
}
