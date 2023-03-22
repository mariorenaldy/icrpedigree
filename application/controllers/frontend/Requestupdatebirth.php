<?php
defined('BASEPATH') OR exit('No direct script access allowed');

#[\AllowDynamicProperties]

class Requestupdatebirth extends CI_Controller {
		public function __construct(){
			// Call the CI_Controller constructor
			parent::__construct();
			$this->load->model(array('requestupdatebirthModel', 'birthModel', 'notification_model', 'notificationtype_model'));
			$this->load->library(array('session', 'form_validation'));
			$this->load->helper(array('form', 'url'));
			$this->load->database();
			date_default_timezone_set("Asia/Bangkok");
		}

		public function index(){
			if ($this->session->userdata('mem_id')){
				$where['req_member_id'] = $this->session->userdata('mem_id');
				$data['req'] = $this->requestupdatebirthModel->get_requests($where)->result();
				$this->load->view('frontend/view_request_update_birth', $data);
			}
			else{
				redirect('frontend/Members');
			}
        }

		public function search(){
			if ($this->session->userdata('mem_id')){
				$date = '';
				$piece = explode("-", $this->input->post('keywords'));
				if (count($piece) == 3){
					$date = $piece[2]."-".$piece[1]."-".$piece[0];
				}
				if ($date){
					$wheBirth['req_date_of_birth'] = $date;
				}
				$where['req_member_id'] = $this->session->userdata('mem_id');
				$data['req'] = $this->requestupdatebirthModel->get_requests($where)->result();
				$this->load->view('frontend/view_request_update_birth', $data);
			}
			else{
				redirect('frontend/Members');
			}
        }

		public function add(){
			if ($this->uri->segment(4)){
				$wheBirth['bir_id'] = $this->uri->segment(4);
				$data['birth'] = $this->birthModel->get_births($wheBirth)->row();
				$data['mode'] = 0;
				$this->load->view("frontend/add_request_update_birth", $data);
			}
			else{
				redirect("frontend/Births");
			}
		}

		public function validate(){
			if ($this->session->userdata('mem_id')){
				$wheBirth['bir_id'] = $this->input->post('bir_id');
				$data['birth'] = $this->birthModel->get_births($wheBirth)->row();
				$data['mode'] = 1;

				$wheReq['req_member_id'] = $this->session->userdata('mem_id');
				$wheReq['req_bir_id'] = $this->input->post('bir_id');
				$wheReq['req_stat'] = $this->config->item('saved');
				$request = $this->requestupdatebirthModel->get_requests($wheReq)->result();
				if (!$request){
					$this->form_validation->set_error_delimiters('<div>','</div>');
					$this->form_validation->set_message('required', '%s wajib diisi');
					$this->form_validation->set_rules('bir_id', 'Birth id ', 'trim|required');
					if ($this->form_validation->run() == FALSE){
						$this->load->view("frontend/add_request_update_birth", $data);
					}
					else{
						$err = 0;
						$damPhoto = '-';
						if ($this->input->post('attachment_dam')) {
							$uploadedImg = $_POST['attachment_dam'];
							$image_array_1 = explode(";", $uploadedImg);
							$image_array_2 = explode(",", $image_array_1[1]);
							$uploadedImg = base64_decode($image_array_2[1]);
		
							if ((strlen($uploadedImg) > $this->config->item('file_size'))) {
								$err++;
								$this->session->set_flashdata('error_message', 'The file size is too big (> 1 MB).');
							}
				
							$img_name = $this->config->item('path_birth').'birth_'.time().'.png';
							if (!is_dir($this->config->item('path_birth')) or !is_writable($this->config->item('path_birth'))) {
								$err++;
								$this->session->set_flashdata('error_message', 'births folder not found or not writable.');
							} else{
								if (is_file($img_name) and !is_writable($img_name)) {
									$err++;
									$this->session->set_flashdata('error_message', 'File already exists and not writeable.');
								}
							}

							if (!$err){
								file_put_contents($img_name, $uploadedImg);
								$damPhoto = str_replace($this->config->item('path_birth'), '', $img_name);
							}
						}

						if (!$err){
							$piece = explode("-", $this->input->post('bir_date_of_birth'));
							$date = $piece[2]."-".$piece[1]."-".$piece[0];

							$piece = explode("-", $data['birth']->bir_date_of_birth);
							$birthDate = $piece[2]."-".$piece[1]."-".$piece[0];

							$req_data = array(
								'req_bir_id' => $this->input->post('bir_id'),
								'req_member_id' => $this->session->userdata('mem_id'),
								'req_stat' => $this->config->item('saved'),
								'req_date' => date('Y-m-d H:i:s'),
								'req_date_of_birth' => $date,
								'req_dam_photo' => $damPhoto,
								'req_male' => $this->input->post('bir_male'),
								'req_female' => $this->input->post('bir_female'),
								'req_old_date_of_birth' => $birthDate,
								'req_old_dam_photo' => $data['birth']->bir_dam_photo,
								'req_old_male' => $data['birth']->bir_male,
								'req_old_female' => $data['birth']->bir_female,
							);	
							$res = $this->requestupdatebirthModel->add_requests($req_data);
							if ($res){
								$this->session->set_flashdata('add_success', TRUE);
								redirect("frontend/Requestupdatebirth");
							}
							else{
								$this->session->set_flashdata('error_message', 'Gagal menyimpan laporan ubah data.');
								$this->load->view("frontend/add_request_update_birth", $data);
							}
						}
						else{
							$this->session->set_flashdata('error_message', 'Gagal menyimpan laporan ubah data. Error code : '.$err);
							$this->load->view("frontend/add_request_update_birth", $data);
						}
					}
				}
				else{
					$this->session->set_flashdata('error_message', 'Laporan ubah lahir yang lama belum diproses. Harap menghubungi Admin.');
					$this->load->view("frontend/add_request_update_birth", $data);
				}
			}
			else{
				redirect('frontend/Members');
			}
		}
}
