<?php
defined('BASEPATH') OR exit('No direct script access allowed');

#[\AllowDynamicProperties]

class Requestupdatecanine extends CI_Controller {
		public function __construct(){
			// Call the CI_Controller constructor
			parent::__construct();
			$this->load->model(array('requestupdatecanineModel', 'caninesModel', 'notification_model', 'notificationtype_model'));
			$this->load->library(array('session', 'form_validation'));
			$this->load->helper(array('form', 'url'));
			$this->load->database();
			date_default_timezone_set("Asia/Bangkok");
		}

		public function index(){
			if ($this->session->userdata('mem_id')){
				$where['req_member_id'] = $this->session->userdata('mem_id');
				$data['req'] = $this->requestupdatecanineModel->get_requests($where)->result();
				$this->load->view('frontend/view_request_update_canine', $data);
			}
			else{
				redirect('frontend/Members');
			}
        }

		public function search(){
			if ($this->session->userdata('mem_id')){
				$like['can_a_s'] = $this->input->post('keywords');
				$where['req_member_id'] = $this->session->userdata('mem_id');
				$data['req'] = $this->requestupdatecanineModel->search_requests($like, $where)->result();
				$this->load->view('frontend/view_request_update_canine', $data);
			}
			else{
				redirect('frontend/Members');
			}
        }

		public function add(){
			if ($this->uri->segment(4)){
				$wheCan['can_id'] = $this->uri->segment(4);
				$data['canine'] = $this->caninesModel->get_canines($wheCan)->row();
				$data['mode'] = 0;
				$this->load->view("frontend/add_request_update_canine", $data);
			}
			else{
				redirect("frontend/Canines");
			}
		}

		public function validate(){
			if ($this->session->userdata('mem_id')){
				$wheCan['can_id'] = $this->input->post('can_id');
				$data['canine'] = $this->caninesModel->get_canines($wheCan)->row();
				$data['mode'] = 1;

				$wheReq['req_member_id'] = $this->session->userdata('mem_id');
				$wheReq['req_can_id'] = $this->input->post('can_id');
				$wheReq['req_stat'] = $this->config->item('saved');
				$request = $this->requestupdatecanineModel->get_requests($wheReq)->result();
				if (!$request){
					$this->form_validation->set_error_delimiters('<div>','</div>');
					$this->form_validation->set_message('required', '%s wajib diisi');
					$this->form_validation->set_error_delimiters('<div>', '</div>');
					$this->form_validation->set_rules('can_id', 'Canine id ', 'trim|required');
				
					if ($this->form_validation->run() == FALSE){
						$this->load->view("frontend/add_request_update_canine", $data);
					}
					else{
						$err = 0;
						$photo = '-';
						if ($this->input->post('attachment')) {
							$uploadedImg = $this->input->post('attachment');
							$image_array_1 = explode(";", $uploadedImg);
							$image_array_2 = explode(",", $image_array_1[1]);
							$uploadedImg = base64_decode($image_array_2[1]);

							if ((strlen($uploadedImg) > $this->config->item('file_size'))) {
								$err++;
								$data['error_message'] = 'Ukuran file terlalu besar (> 1 MB).<br/>';
							}
							else{
								$image_name = $this->config->item('path_canine').'canines_'.time().'.png';
								if (!is_dir($this->config->item('path_canine')) or !is_writable($this->config->item('path_canine'))) {
									$err++;
									$this->session->set_flashdata('error_message', 'Folder canine tidak ditemukan atau tidak writeable.');
								} else{
									if (is_file($image_name) and !is_writable($image_name)) {
										$err++;
										$this->session->set_flashdata('error_message', 'File sudah ada dan tidak writeable.');
									}
								}

								if (!$err){
									file_put_contents($image_name, $uploadedImg);
									$photo = str_replace($this->config->item('path_canine'), '', $image_name);
								}
							}
						}

						if (!$err){
							$req_data = array(
								'req_can_id' => $this->input->post('can_id'),
								'req_member_id' => $this->session->userdata('mem_id'),
								'req_stat' => $this->config->item('saved'),
								'req_date' => date('Y-m-d H:i:s'),
								'req_photo' => $photo,
								'req_old_photo' => $data['canine']->can_photo,
								'req_rip' => $this->input->post('can_rip')
							);	
							// if ($photo != '-'){
							// 	$req_data['req_photo'] = $photo;
							// 	$req_data['req_old_photo'] = $data['canine']->can_photo;
							// }
							$res = $this->requestupdatecanineModel->add_requests($req_data);
							if ($res){
								$this->session->set_flashdata('add_success', TRUE);
								redirect("frontend/Requestupdatecanine");
							}
							else{
								$this->session->set_flashdata('error_message', 'Gagal menyimpan laporan ubah data.');
								$this->load->view("frontend/add_request_update_canine", $data);
							}
						}
						else{
							$this->session->set_flashdata('error_message', 'Gagal menyimpan laporan ubah data. Error code : '.$err);
							$this->load->view("frontend/add_request_update_canine", $data);
						}
					}
				}
				else{
					$this->session->set_flashdata('error_message', 'Laporan ubah foto yang lama belum diproses. Harap menghubungi Admin.');
					$this->load->view("frontend/add_request_update_canine", $data);
				}
			}
			else{
				redirect('frontend/Members');
			}
		}
}
