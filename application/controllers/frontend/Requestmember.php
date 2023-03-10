<?php
defined('BASEPATH') OR exit('No direct script access allowed');

#[\AllowDynamicProperties]

class Requestmember extends CI_Controller {
		public function __construct(){
			// Call the CI_Controller constructor
			parent::__construct();
			$this->load->model(array('MemberModel', 'KennelModel', 'KenneltypeModel', 'notification_model', 'RequestmemberModel'));
			$this->load->library('upload', $this->config->item('upload_member'));
			$this->load->library(array('session', 'form_validation'));
			$this->load->helper(array('form', 'url'));
			$this->load->database();
		}

		public function test_input($data) {
			$data = trim($data);
			$data = stripslashes($data);
			$data = htmlspecialchars($data);
			return $data;
		}

		public function index(){
			if ($this->session->userdata('mem_id')){
				$where['req_member_id'] = $this->session->userdata('mem_id');
				$data['request'] = $this->RequestmemberModel->get_requests($where)->result();
				$this->load->view('frontend/view_request_member', $data);
			}
			else{
				redirect('frontend/Members');
			}
        }

		public function edit_profile(){
			if ($this->session->userdata('mem_id')){
				$data['kennelType'] = $this->KenneltypeModel->get_kennel_types('')->result();
				$where['mem_id'] = $this->session->userdata('mem_id');
				$data['member'] = $this->MemberModel->get_members($where)->row();
				$data['mode'] = 0;
				$this->load->view("frontend/edit_profile", $data);
			}
			else{
				redirect("frontend/Members");
			}
		}

		public function validate_edit(){
			if ($this->session->userdata('mem_id')){
				$data['kennelType'] = $this->KenneltypeModel->get_kennel_types('')->result();
				$where['mem_id'] = $this->session->userdata('mem_id');
				$data['member'] = $this->MemberModel->get_members($where)->row();
				$data['mode'] = 1;

				$where['req_member_id'] = $this->session->userdata('mem_id');
				$where['req_stat'] = $this->config->item('saved');
				$res = $this->RequestmemberModel->get_requests($where)->num_rows();
				if ($res){
					$this->session->set_flashdata('error_message', 'Laporan ubah kennel yang lama belum diproses. Harap menghubungi Admin.');
					$this->load->view("frontend/edit_profile", $data);
				}
				else{
					$this->form_validation->set_error_delimiters('<div>','</div>');
					$this->form_validation->set_message('required', '%s wajib diisi');
					$this->form_validation->set_rules('mem_name', 'Nama sesuai KTP ', 'trim|required');
					$this->form_validation->set_rules('mem_address', 'Alamat surat menyurat ', 'trim|required');
					$this->form_validation->set_rules('mem_mail_address', 'Alamat yang tertera di sertifikat ', 'trim|required');
					$this->form_validation->set_rules('mem_hp', 'No. HP Aktif WA ', 'trim|required');
					$this->form_validation->set_rules('mem_kota', 'Kota ', 'trim|required');
					$this->form_validation->set_rules('mem_kode_pos', 'Kode pos ', 'trim|required');
					$this->form_validation->set_rules('mem_email', 'email ', 'trim|required');
					$this->form_validation->set_rules('mem_ktp', 'No. KTP ', 'trim|required');
					$this->form_validation->set_rules('ken_name', 'Nama kennel ', 'trim|required');

					if ($this->form_validation->run() == FALSE){
						$this->load->view("frontend/edit_profile", $data);
					}
					else{
						$err = 0;
						$logo = '-';
						if (isset($_POST['attachment_logo']) && !empty($_POST['attachment_logo'])){
							$uploadedLogo = $_POST['attachment_logo'];
							$image_array_1 = explode(";", $uploadedLogo);
							$image_array_2 = explode(",", $image_array_1[1]);
							$uploadedLogo = base64_decode($image_array_2[1]);
		
							if ((strlen($uploadedLogo) > $this->config->item('file_size'))){
								$err++;
								$this->session->set_flashdata('error_message', "The Kennel Photo file size is too big (> 1 MB).");
							}

							$logo_name = $this->config->item('path_kennel').'kennel_'.time().'.png';
							if (!is_dir($this->config->item('path_kennel')) or !is_writable($this->config->item('path_kennel'))){
								$err++;
								$this->session->set_flashdata('error_message', 'kennels folder not found or not writable.');
							} else {
								if (is_file($logo_name) and !is_writable($logo_name)){
									$err++;
									$this->session->set_flashdata('error_message', 'Kennel Photo file already exists and not writeable.');
								}
							}
						}

						$email = $this->test_input($this->input->post('mem_email'));
						if (!$err && !filter_var($email, FILTER_VALIDATE_EMAIL)) {
							$err++;
							$this->session->set_flashdata('error_message', 'Invalid email format');
						}
	
						if (!$err && $this->MemberModel->check_for_duplicate($this->session->userdata('mem_id'), 'mem_ktp', $this->input->post('mem_ktp'))){
							$err++;
							$this->session->set_flashdata('error_message', 'Duplicate KTP number');
						}
	
						if (!$err && $this->MemberModel->check_for_duplicate($this->session->userdata('mem_id'), 'mem_hp', $this->input->post('mem_hp'))){
							$err++;
							$this->session->set_flashdata('error_message', 'Duplicate phone number');
						}
		
						if (!$err && $this->MemberModel->check_for_duplicate($this->session->userdata('mem_id'), 'mem_email', $this->input->post('mem_email'))){
							$err++;
							$this->session->set_flashdata('error_message', 'Duplicate email');
						}
	
						if (!$err && $this->KennelModel->check_for_duplicate($this->session->userdata('mem_id'), 'ken_name', $this->input->post('ken_name'))){
							$err++;
							$this->session->set_flashdata('error_message', 'Duplicate kennel name');
						}

						if (!$err) {
							if (isset($uploadedLogo)){
								file_put_contents($logo_name, $uploadedLogo);
								$logo = str_replace($this->config->item('path_kennel'), '', $logo_name);
							}

							$dataMember = array(
								'req_member_id' => $this->session->userdata('mem_id'),
								'req_name' => strtoupper($this->input->post('mem_name')),
								'req_address' => $this->input->post('mem_address'),
								'req_mail_address' => $this->input->post('mem_mail_address'),
								'req_hp' => $this->input->post('mem_hp'),
								'req_kota' => $this->input->post('mem_kota'),
								'req_kode_pos' => $this->input->post('mem_kode_pos'),
								'req_email' => $this->input->post('mem_email'),
								'req_ktp' => $this->input->post('mem_ktp'),
								'req_stat' => $this->config->item('saved'),
								'req_date' => date('Y-m-d H:i:s'),
								'req_kennel_id' => $data['member']->ken_id,
								'req_kennel_name' => $this->input->post('ken_name'),
								'req_kennel_type_id' => $this->input->post('ken_type_id'),
								'req_kennel_photo' => $logo,
								'req_old_name' => $data['member']->mem_name,
								'req_old_address' => $data['member']->mem_address,
								'req_old_mail_address' => $data['member']->mem_mail_address,
								'req_old_hp' => $data['member']->mem_hp,
								'req_old_kota' => $data['member']->mem_kota,
								'req_old_kode_pos' => $data['member']->mem_kode_pos,
								'req_old_email' => $data['member']->mem_email,
								'req_old_ktp' => $data['member']->mem_ktp,
								'req_old_kennel_name' => $data['member']->ken_name,
								'req_old_kennel_type_id' => $data['member']->ken_type_id,
								'req_old_kennel_photo' => $data['member']->ken_photo,
							);

							$insert = $this->RequestmemberModel->add_requests($dataMember);
							if ($insert) {
								$this->session->set_flashdata('edit_profile', TRUE);
								redirect("frontend/Requestmember");
							} else {
								$this->session->set_flashdata('error_message', 'Gagal menyimpan laporan ubah kennel');
								$this->load->view("frontend/edit_profile", $data);
							}
						} 
						else {
							$this->load->view("frontend/edit_profile", $data);
						}
					}
				}
			}
			else{
				redirect("frontend/Members");
			}
		}
}
