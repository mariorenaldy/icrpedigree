<?php
defined('BASEPATH') OR exit('No direct script access allowed');

#[\AllowDynamicProperties]

class Requestownershipcanine extends CI_Controller {
		public function __construct(){
			// Call the CI_Controller constructor
			parent::__construct();
			$this->load->model(array('requestownershipcanineModel', 'caninesModel', 'memberModel', 'kennelModel', 'notification_model', 'notificationtype_model'));
			$this->load->library(array('session', 'form_validation'));
			$this->load->helper(array('form', 'url'));
			$this->load->database();
			date_default_timezone_set("Asia/Bangkok");
		}

		public function test_input($data) {
			$data = trim($data);
			$data = stripslashes($data);
			$data = htmlspecialchars($data);
			return $data;
		}

		public function index(){
			if ($this->session->userdata('mem_id')){
				$where['req_old_member_id'] = $this->session->userdata('mem_id');
				$data['req'] = $this->requestownershipcanineModel->get_requests($where)->result();
				$this->load->view('frontend/view_request_ownership', $data);
			}
			else{
				redirect('frontend/Members');
			}
        }

		public function search(){
			if ($this->session->userdata('mem_id')){
				$like['can_a_s'] = $this->input->post('keywords');
				$where['req_old_member_id'] = $this->session->userdata('mem_id');
				$data['req'] = $this->requestownershipcanineModel->search_requests($like, $where)->result();
				$this->load->view('frontend/view_request_ownership', $data);
			}
			else{
				redirect('frontend/Members');
			}
        }

		public function add(){
			if ($this->uri->segment(4)){
				$wheCan['can_id'] = $this->uri->segment(4);
				$data['canine'] = $this->caninesModel->get_canines($wheCan)->row();
				$data['member'] = [];
				$data['kennel'] = [];
				$data['kennel_id'] = 0;
				$data['mode'] = 0;
				$this->load->view("frontend/add_request_ownership", $data);
			}
			else{
				redirect("frontend/canines");
			}
		}

		public function search_member(){
			if ($this->session->userdata('mem_id')) {
				$wheCan['can_id'] = $this->input->post('can_id');
				$data['canine'] = $this->caninesModel->get_canines($wheCan)->row();

				$like['mem_name'] = $this->input->post('mem_name');
				$like['ken_name'] = $this->input->post('mem_name');
				$where['mem_stat'] = $this->config->item('accepted');
				$where['ken_stat'] = $this->config->item('accepted');
				$data['member'] = $this->memberModel->search_members($like, $where)->result();
		
				if ($data['member']){
					$whe['ken_member_id'] =  $data['member'][0]->mem_id;
					$whe['ken_stat'] = $this->config->item('accepted');
					$data['kennel'] = $this->kennelModel->get_kennels($whe)->result();
					if ($data['kennel'])
						$data['kennel_id'] = $data['kennel'][0]->ken_id;
					else
						$data['kennel_id'] = 0;
				}
				else{
					$data['kennel'] = [];
					$data['kennel_id'] = 0;
				}
				$data['mode'] = 1;
				$this->load->view('frontend/add_request_ownership', $data);
			}
			else {
			  redirect("frontend/Members");
			}
		}

		public function search_kennel(){
			if ($this->session->userdata('mem_id')) {
				$wheCan['can_id'] = $this->input->post('can_id');
				$data['canine'] = $this->caninesModel->get_canines($wheCan)->row();

				$like['mem_name'] = $this->input->post('mem_name');
				$like['ken_name'] = $this->input->post('mem_name');
				$where['mem_stat'] = $this->config->item('accepted');
				$where['ken_stat'] = $this->config->item('accepted');
				$data['member'] = $this->memberModel->search_members($like, $where)->result();
		
				$whe['ken_member_id'] =  $this->input->post('can_member_id');
				$whe['ken_stat'] = $this->config->item('accepted');
				$data['kennel'] = $this->kennelModel->get_kennels($whe)->result();
				if ($data['kennel'])
					$data['kennel_id'] = $data['kennel'][0]->ken_id;
				else
					$data['kennel_id'] = 0;
				$data['mode'] = 1;
				$this->load->view('frontend/add_request_ownership', $data);
			}
			else {
			  redirect("frontend/Members");
			}
		}

		public function validate(){
			if ($this->session->userdata('mem_id')){
				$wheCan['can_id'] = $this->input->post('can_id');
				$data['canine'] = $this->caninesModel->get_canines($wheCan)->row();

				$like['mem_name'] = $this->input->post('mem_name');
				$like['ken_name'] = $this->input->post('mem_name');
				$where['mem_stat'] = $this->config->item('accepted');
				$where['ken_stat'] = $this->config->item('accepted');
				$data['member'] = $this->memberModel->search_members($like, $where)->result();

				$whe['ken_member_id'] =  $this->input->post('can_member_id');
				$whe['ken_stat'] = $this->config->item('accepted');
				$data['kennel'] = $this->kennelModel->get_kennels($whe)->result();
				if ($data['kennel'])
					$data['kennel_id'] = $data['kennel'][0]->ken_id;
				else
					$data['kennel_id'] = 0;
				$data['mode'] = 1;

				$wheReq['req_old_member_id'] = $this->session->userdata('mem_id');
				$wheReq['req_can_id'] = $this->input->post('can_id');
				$wheReq['req_stat'] = $this->config->item('saved');
				$request = $this->requestownershipcanineModel->get_requests($wheReq)->num_rows();
				if (!$request){
					$this->form_validation->set_error_delimiters('<div>','</div>');
					$this->form_validation->set_message('required', '%s wajib diisi');
					$this->form_validation->set_rules('can_id', 'Anjing id ', 'trim|required');
					if ($this->input->post('reg_member')){
						$this->form_validation->set_rules('can_member_id', 'Member id ', 'trim|required');
						$this->form_validation->set_rules('can_kennel_id', 'Kennel id ', 'trim|required');
					}
					else{
						$this->form_validation->set_rules('name', 'Member name ', 'trim|required');
						$this->form_validation->set_rules('hp', 'Phone number ', 'trim|required');
						$this->form_validation->set_rules('email', 'email ', 'trim|required');
					}
					
					if ($this->form_validation->run() == FALSE){
						$this->load->view("frontend/add_request_ownership", $data);
					}
					else{
						$err = 0;
						$this->db->trans_strict(FALSE);
						$this->db->trans_start();
						if ($this->input->post('reg_member')){
							$wheMember['mem_id'] = $this->input->post('can_member_id');
							$member = $this->memberModel->get_members($wheMember)->row();
						}
						else{
							$email = $this->test_input($this->input->post('email'));
							if (!$err && !filter_var($email, FILTER_VALIDATE_EMAIL)) {
								$err++;
								$this->session->set_flashdata('error_message', 'Invalid email format');
							}

							if (!$err && $this->memberModel->check_for_duplicate(0, 'mem_hp', $this->input->post('hp'))){
								$err++;
								$this->session->set_flashdata('error_message', 'Duplicate phone number');
							}

							if (!$err && $this->memberModel->check_for_duplicate(0, 'mem_email', $this->input->post('email'))){
								$err++;
								$this->session->set_flashdata('error_message', 'Duplicate email');
							}

							if (!$err){
								$mem_id = $this->memberModel->record_count() + 1;
								$member_data = array(
									'mem_id' => $mem_id,
									'mem_name' => strtoupper($this->input->post('name')),
									'mem_hp' => $this->input->post('hp'),
									'mem_email' => $this->input->post('email'),
									'mem_username' => $this->input->post('email'),
									'mem_password' => sha1($this->input->post('hp')),
									'mem_stat' => $this->config->item('accepted'),
									'mem_type' => $this->config->item('free_member'),
									'mem_user' => $this->session->userdata('use_id'),
									'mem_date' => date('Y-m-d H:i:s'),
								);
				
								$ken_id = $this->kennelModel->record_count() + 1;
								$kennel_data = array(
									'ken_id' => $ken_id,
									'ken_name' => '',
									'ken_type_id' => 0,
									'ken_photo' => '-',
									'ken_member_id' => $mem_id,
									'ken_stat' => $this->config->item('accepted'),
									'ken_user' => $this->session->userdata('use_id'),
									'ken_date' => date('Y-m-d H:i:s'),
								);
								
								$id = $this->memberModel->add_members($member_data);
								if ($id){
									$res = $this->kennelModel->add_kennels($kennel_data);
									if ($res){
									$result = $this->notification_model->add(17, $mem_id, $mem_id);
									if (!$result){
										$err = 'M1';
									}
									}
									else{
									$err = 'M2';
									}
								}
								else{
									$err = 'M3';
								}
							}
						}

						$stb = '-';
						$photo = '-';
						if (!$err){
							if (!isset($_POST['attachment_canine']) || empty($_POST['attachment_canine'])) {
								$err++;
								$this->session->set_flashdata('error_message', 'Foto anjing wajib diisi');
							}
							if (!isset($_POST['attachment_stb']) || empty($_POST['attachment_stb'])) {
								$err++;
								$this->session->set_flashdata('error_message', 'Foto stambum wajib diisi');
							}

							$uploadedStb = $_POST['attachment_stb'];
							$image_array_1 = explode(";", $uploadedStb);
							$image_array_2 = explode(",", $image_array_1[1]);
							$uploadedStb = base64_decode($image_array_2[1]);
		
							if ((strlen($uploadedStb) > $this->config->item('file_size'))) {
								$err++;
								$this->session->set_flashdata('error_message', 'Ukuran file stambum terlalu besar (> 1 MB).');
							}

							$uploadedCanine = $_POST['attachment_canine'];
							$image_array_1 = explode(";", $uploadedCanine);
							$image_array_2 = explode(",", $image_array_1[1]);
							$uploadedCanine = base64_decode($image_array_2[1]);
		
							if ((strlen($uploadedCanine) > $this->config->item('file_size'))) {
								$err++;
								$this->session->set_flashdata('error_message', 'Ukuran file anjing terlalu besar (> 1 MB).');
							}

							$stb_name = $this->config->item('path_ownership').$this->config->item('file_name_ownership');
							$canine_name = $this->config->item('path_canine').$this->config->item('file_name_canine');

							if (!is_dir($this->config->item('path_ownership')) or !is_writable($this->config->item('path_ownership'))) {
								$err++;
								$this->session->set_flashdata('error_message', 'Folder ownership tidak ditemukan atau tidak writeable.');
							} else if (!is_dir($this->config->item('path_canine')) or !is_writable($this->config->item('path_canine'))) {
								$err++;
								$this->session->set_flashdata('error_message', 'Folder canine tidak ditemukan atau tidak writeable.');
							} else {
								if (is_file($stb_name) and !is_writable($stb_name)) {
									$err++;
									$this->session->set_flashdata('error_message', 'File stambum sudah ada dan tidak writeable.');
								}
								if (is_file($canine_name) and !is_writable($canine_name)) {
									$err++;
									$this->session->set_flashdata('error_message', 'File anjing sudah ada dan tidak writeable.');
								}
							}

							if (!$err){
								file_put_contents($stb_name, $uploadedStb);
								$stb = str_replace($this->config->item('path_ownership'), '', $stb_name);

								file_put_contents($canine_name, $uploadedCanine);
								$photo = str_replace($this->config->item('path_canine'), '', $canine_name);
							}
						}

						if (!$err){
							$wheKennel['ken_member_id'] = $this->session->userdata('mem_id'); 
							$mem_kennel = $this->kennelModel->get_kennels($wheKennel)->row();
							$req_data = array(
								'req_can_id' => $this->input->post('can_id'),
								'req_old_member_id' => $this->session->userdata('mem_id'),
								'req_old_kennel_id' => $mem_kennel->ken_id,
								'req_stat' => $this->config->item('saved'),
								'req_date' => date('Y-m-d H:i:s'),
								'req_photo' => $photo,
								'req_stb_photo' => $stb,
							);
							if ($this->input->post('reg_member')){
								$req_data['req_member_id'] = $member->mem_id;
								$req_data['req_kennel_id'] = $member->ken_id;
							}
							else{
								$req_data['req_member_id'] = $mem_id;
								$req_data['req_kennel_id'] = $ken_id;
							}
								
							$res = $this->requestownershipcanineModel->add_requests($req_data);
							if ($res){
								$this->db->trans_complete();
								$this->session->set_flashdata('add_success', TRUE);
								redirect("frontend/Requestownershipcanine");
							}
							else{
								$this->db->trans_rollback();
								$this->session->set_flashdata('error_message', 'Gagal menyimpan laporan ubah pemilik.');
								$this->load->view("frontend/add_request_ownership", $data);
							}
						}
						else{
							$this->db->trans_rollback();
							$this->session->set_flashdata('error_message', 'Gagal menyimpan laporan ubah pemilik. Error code : '.$err);
							$this->load->view("frontend/add_request_ownership", $data);
						}
					}
				}
				else{
					$this->session->set_flashdata('error_message', 'Laporan ubah pemilik yang lama belum diproses. Harap menghubungi Admin.');
					$this->load->view("frontend/add_request_ownership", $data);
				}
			}
			else{
				redirect('frontend/Members');
			}
		}
}
