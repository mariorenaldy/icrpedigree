<?php
defined('BASEPATH') OR exit('No direct script access allowed');

#[\AllowDynamicProperties]

class Requestupdatecanine extends CI_Controller {
		public function __construct(){
			// Call the CI_Controller constructor
			parent::__construct();
			$this->load->model(array('requestupdatecanineModel', 'caninesModel', 'notification_model', 'notificationtype_model'));
			$this->load->library(array('session', 'form_validation', 'pagination'));
			$this->load->helper(array('form', 'url'));
			$this->load->database();
			date_default_timezone_set("Asia/Bangkok");

			if ($this->input->cookie('site_lang')) {
				$this->lang->load('common', $this->input->cookie('site_lang'));
				$this->lang->load('canine', $this->input->cookie('site_lang'));
			} else {
				set_cookie('site_lang', 'indonesia', '2147483647'); 
				$this->lang->load('common','indonesia');
				$this->lang->load('canine','indonesia');
			}
		}

		public function index(){
			if ($this->session->userdata('mem_id')){
                $page = ($this->uri->segment(4)) ? ($this->uri->segment(4) - 1) : 0;
                $config['per_page'] = $this->config->item('canine_count');
                $config['uri_segment'] = 4;
                $config['use_page_numbers'] = TRUE;

                //Encapsulate whole pagination 
                $config['full_tag_open'] = '<ul class="pagination justify-content-end">';
                $config['full_tag_close'] = '</ul>';

                //First link of pagination
                $config['first_link'] = 'Pertama';
                $config['first_tag_open'] = '<li>';
                $config['first_tag_close'] = '</li>';

                //Customizing the “Digit” Link
                $config['num_tag_open'] = '<li>';
                $config['num_tag_close'] = '</li>';

                //For PREVIOUS PAGE Setup
                $config['prev_link'] = '<';
                $config['prev_tag_open'] = '<li>';
                $config['prev_tag_close'] = '</li>';

                //For NEXT PAGE Setup
                $config['next_link'] = '>';
                $config['next_tag_open'] = '<li>';
                $config['next_tag_close'] = '</li>';

                //For LAST PAGE Setup
                $config['last_link'] = 'Akhir';
                $config['last_tag_open'] = '<li>';
                $config['last_tag_close'] = '</li>';

                //For CURRENT page on which you are
                $config['cur_tag_open'] = '<li class="active"><a class="page-link bg-dark text-warning border-light" href="#">';
                $config['cur_tag_close'] = '</a></li>';

                $config['attributes'] = array('class' => 'page-link bg-dark text-light');

				$where['req_member_id'] = $this->session->userdata('mem_id');
				$data['req'] = $this->requestupdatecanineModel->get_requests($where, $page * $config['per_page'], $this->config->item('canine_count'))->result();

                $config['base_url'] = base_url().'/frontend/RequestUpdatecanine/index';
                $config['total_rows'] = $this->requestupdatecanineModel->get_requests($where, $page * $config['per_page'], 0)->num_rows();
                $this->pagination->initialize($config);

                $data['keywords'] = '';
                $this->session->set_userdata('keywords', '');
				$this->load->view('frontend/view_request_update_canine', $data);
			}
			else{
				redirect('frontend/Members');
			}
        }

		public function search(){
			if ($this->session->userdata('mem_id')){
                if ($this->input->post('keywords')){
                    $this->session->set_userdata('keywords', $this->input->post('keywords'));
                    $data['keywords'] = $this->input->post('keywords');
                }
                else{
                    $data['keywords'] = $this->session->userdata('keywords');
                }

                $page = ($this->uri->segment(4)) ? ($this->uri->segment(4) - 1) : 0;
                $config['per_page'] = $this->config->item('canine_count');
                $config['uri_segment'] = 4;
                $config['use_page_numbers'] = TRUE;

                //Encapsulate whole pagination 
                $config['full_tag_open'] = '<ul class="pagination justify-content-end">';
                $config['full_tag_close'] = '</ul>';

                //First link of pagination
                $config['first_link'] = 'Pertama';
                $config['first_tag_open'] = '<li>';
                $config['first_tag_close'] = '</li>';

                //Customizing the “Digit” Link
                $config['num_tag_open'] = '<li>';
                $config['num_tag_close'] = '</li>';

                //For PREVIOUS PAGE Setup
                $config['prev_link'] = '<';
                $config['prev_tag_open'] = '<li>';
                $config['prev_tag_close'] = '</li>';

                //For NEXT PAGE Setup
                $config['next_link'] = '>';
                $config['next_tag_open'] = '<li>';
                $config['next_tag_close'] = '</li>';

                //For LAST PAGE Setup
                $config['last_link'] = 'Akhir';
                $config['last_tag_open'] = '<li>';
                $config['last_tag_close'] = '</li>';

                //For CURRENT page on which you are
                $config['cur_tag_open'] = '<li class="active"><a class="page-link bg-dark text-warning border-light" href="#">';
                $config['cur_tag_close'] = '</a></li>';

                $config['attributes'] = array('class' => 'page-link bg-dark text-light');

				$like['can_a_s'] = $this->input->post('keywords');
				$where['req_member_id'] = $this->session->userdata('mem_id');
				$data['req'] = $this->requestupdatecanineModel->search_requests($like, $where, $page * $config['per_page'], $this->config->item('canine_count'))->result();

                $config['base_url'] = base_url().'/frontend/RequestUpdatecanine/search';
                $config['total_rows'] = $this->requestupdatecanineModel->search_requests($like, $where, $page * $config['per_page'], 0)->num_rows();
                $this->pagination->initialize($config);
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
				$site_lang = $this->input->cookie('site_lang');
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
								$image_name = $this->config->item('path_canine').$this->config->item('file_name_canine');
								if (!is_dir($this->config->item('path_canine')) or !is_writable($this->config->item('path_canine'))) {
									$err++;
									if ($site_lang == 'indonesia') {
										$this->session->set_flashdata('error_message', 'Folder canine tidak ditemukan atau tidak writable.');
									}
									else{
										$this->session->set_flashdata('error_message', 'Canine folder is not found or is not writable.');
									}
								} else{
									if (is_file($image_name) and !is_writable($image_name)) {
										$err++;
										if ($site_lang == 'indonesia') {
											$this->session->set_flashdata('error_message', 'File sudah ada dan tidak writable.');
										}
										else{
											$this->session->set_flashdata('error_message', 'The file is already exists and is not writable.');
										}
									}
								}

								if (!$err){
									file_put_contents($image_name, $uploadedImg);
									$photo = str_replace($this->config->item('path_canine'), '', $image_name);
								}
							}
						}

						if (!$err){
							$rip = 0;
							if ($this->input->post('can_rip'))
								$rip = 1;
							$req_data = array(
								'req_can_id' => $this->input->post('can_id'),
								'req_member_id' => $this->session->userdata('mem_id'),
								'req_stat' => $this->config->item('saved'),
								'req_date' => date('Y-m-d H:i:s'),
								'req_photo' => $photo,
								'req_old_photo' => $data['canine']->can_photo,
								'req_rip' => $rip,
							);	
							$res = $this->requestupdatecanineModel->add_requests($req_data);
							if ($res){
								$this->session->set_flashdata('add_success', TRUE);
								redirect("frontend/Requestupdatecanine");
							}
							else{
								if ($site_lang == 'indonesia') {
									$this->session->set_flashdata('error_message', 'Gagal menyimpan laporan ubah foto & RIP.');
								}
								else{
									$this->session->set_flashdata('error_message', 'Failed to save photo & RIP change report.');
								}
								$this->load->view("frontend/add_request_update_canine", $data);
							}
						}
						else{
							if ($site_lang == 'indonesia') {
								$this->session->set_flashdata('error_message', 'Gagal menyimpan laporan ubah foto & RIP. Error code : '.$err);
							}
							else{
								$this->session->set_flashdata('error_message', 'Failed to save photo & RIP change report. Error code : '.$err);
							}
							$this->load->view("frontend/add_request_update_canine", $data);
						}
					}
				}
				else{
					if ($site_lang == 'indonesia') {
						$this->session->set_flashdata('error_message', 'Laporan ubah foto & RIP yang lama belum diproses. Harap menghubungi Admin.');
					}
					else{
						$this->session->set_flashdata('error_message', 'The previous photo & RIP change report has not been processed. Please contact Admin.');
					}
					$this->load->view("frontend/add_request_update_canine", $data);
				}
			}
			else{
				redirect('frontend/Members');
			}
		}
}
