<?php
defined('BASEPATH') OR exit('No direct script access allowed');

#[\AllowDynamicProperties]

class Requestupdatebirth extends CI_Controller {
		public function __construct(){
			// Call the CI_Controller constructor
			parent::__construct();
			$this->load->model(array('requestupdatebirthModel', 'birthModel', 'notification_model', 'notificationtype_model'));
			$this->load->library(array('session', 'form_validation', 'pagination'));
			$this->load->helper(array('form', 'url'));
			$this->load->database();
			date_default_timezone_set("Asia/Bangkok");

			if ($this->input->cookie('site_lang')) {
				$this->lang->load('common', $this->input->cookie('site_lang'));
				$this->lang->load('birth', $this->input->cookie('site_lang'));
			} else {
				set_cookie('site_lang', 'indonesia', '2147483647'); 
				$this->lang->load('common','indonesia');
				$this->lang->load('birth','indonesia');
			}
		}

		public function index(){
			if ($this->session->userdata('mem_id')){
                $page = ($this->uri->segment(4)) ? ($this->uri->segment(4) - 1) : 0;
                $config['per_page'] = $this->config->item('birth_count');
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
				$data['req'] = $this->requestupdatebirthModel->get_requests($where, $page * $config['per_page'], $this->config->item('birth_count'))->result();

                $config['base_url'] = base_url().'/frontend/Requestupdatebirth/index';
                $config['total_rows'] = $this->requestupdatebirthModel->get_requests($where, $page * $config['per_page'], 0)->num_rows();
                $this->pagination->initialize($config);

                $data['keywords'] = '';
                $data['date'] = '';
                $this->session->set_userdata('keywords', '');
                $this->session->set_userdata('date', '');
				$this->load->view('frontend/view_request_update_birth', $data);
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
    
                if ($this->input->post('date')){
                    $this->session->set_userdata('date', $this->input->post('date'));
                    $data['date'] = $this->input->post('date');
                }
                else{
                    $data['date'] = $this->session->userdata('date');
                }

                $page = ($this->uri->segment(4)) ? ($this->uri->segment(4) - 1) : 0;
                $config['per_page'] = $this->config->item('birth_count');
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

				$date = '';
				$piece = explode("-", $data['date']);
				if (count($piece) == 3){
					$date = $piece[2]."-".$piece[1]."-".$piece[0];
				}
				if ($date){
					$like['req_date_of_birth'] = $date;
					$like['req_old_date_of_birth'] = $date;
				}
				$where['req_member_id'] = $this->session->userdata('mem_id');
				$like['can_sire.can_a_s'] = $data['keywords'];
				$like['can_dam.can_a_s'] = $data['keywords'];
				$data['req'] = $this->requestupdatebirthModel->search_requests($like, $where, $page * $config['per_page'], $this->config->item('birth_count'))->result();

                $config['base_url'] = base_url().'/frontend/Requestupdatebirth/search';
                $config['total_rows'] = $this->requestupdatebirthModel->search_requests($like, $where, $page * $config['per_page'], 0)->num_rows();
                $this->pagination->initialize($config);
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
				
							$img_name = $this->config->item('path_birth').$this->config->item('file_name_birth');
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
								$this->session->set_flashdata('error_message', 'Gagal menyimpan laporan ubah lahir.');
								$this->load->view("frontend/add_request_update_birth", $data);
							}
						}
						else{
							$this->session->set_flashdata('error_message', 'Gagal menyimpan laporan ubah lahir. Error code : '.$err);
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
