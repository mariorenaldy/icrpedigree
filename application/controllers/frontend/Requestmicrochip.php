<?php
defined('BASEPATH') OR exit('No direct script access allowed');

#[\AllowDynamicProperties]

class Requestmicrochip extends CI_Controller {
    public function __construct(){
        // Call the CI_Controller constructor
        parent::__construct();
		$this->load->model(array('requestmicrochipModel', 'caninesModel', 'memberModel', 'logrequestMicrochipModel', 'RejectReasonsModel', 'MicrochipComplainModel'));
        $this->load->library(array('session', 'form_validation', 'pagination'));
        $this->load->helper(array('url', 'cookie'));
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
			$config['per_page'] = $this->config->item('request_count');
			$config['uri_segment'] = 4;
			$config['use_page_numbers'] = TRUE;

			//Encapsulate whole pagination 
			$config['full_tag_open'] = '<ul class="pagination justify-content-end">';
			$config['full_tag_close'] = '</ul>';

			//First link of pagination
			$config['first_link'] = 'Pertama';
			$config['first_tag_open'] = '<li>';
			$config['first_tag_close'] = '</li>';

			//Customizing the Digit Link
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
			$config['cur_tag_open'] = '<li class="active"><a class="page-link bg-dark text-warning brequest-light" href="#">';
			$config['cur_tag_close'] = '</a></li>';

			$config['attributes'] = array('class' => 'page-link bg-dark text-light');

			$where['req_mem_id'] = $this->session->userdata('mem_id');
			$data['requests'] = $this->requestmicrochipModel->get_requests($where, 'req_id desc', $page * $config['per_page'], $this->config->item('request_count'))->result();

			$config['base_url'] = base_url().'/frontend/Requestmicrochip/index';
			$config['total_rows'] = $this->requestmicrochipModel->get_requests($where, 'req_id desc', $page * $config['per_page'], 0)->num_rows();
			$this->pagination->initialize($config);

			$data['keywords'] = '';
            $this->session->set_userdata('keywords', '');
			$this->load->view('frontend/view_request_microchip', $data);
		}
		else{
			redirect('frontend/Members');
		}
    }

	public function add(){
		if ($this->uri->segment(4)){
			$where['can_id'] = $this->uri->segment(4);
			$data['canine'] = $this->caninesModel->get_canines($where)->row();
			$data['mode'] = 0;
			$this->load->view('frontend/add_request_microchip', $data);
        }
        else{
          	redirect('frontend/Canines');
        }
	}

	public function validate_add(){
		if ($this->session->userdata('mem_id')){
			$site_lang = $this->input->cookie('site_lang');
			$this->form_validation->set_error_delimiters('<div>','</div>');
			if ($site_lang == 'indonesia') {
				$this->form_validation->set_message('required', '%s wajib diisi');
				$this->form_validation->set_rules('req_datetime', 'Tanggal Pertemuan ', 'trim|required');
			}
			else{
				$this->form_validation->set_message('required', '%s required');
				$this->form_validation->set_rules('req_datetime', 'Appointment Date ', 'trim|required');
			}

			$can_id = $this->input->post('can_id');
			$whereCan['can_id'] = $can_id;
			$data['canine'] = $this->caninesModel->get_canines($whereCan)->row();
			$data['mode'] = 1;

			if ($this->form_validation->run() == FALSE){
				$this->load->view('frontend/add_request_microchip', $data);
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
                        if ($site_lang == 'indonesia') {
                            $data['error_message'] = 'Ukuran file terlalu besar (> 1 MB).<br/>';
                        }
                        else{
                            $data['error_message'] = 'File size is too big (> 1 MB).<br/>';
                        }
					}
					else{
						$image_name = $this->config->item('path_payment').$this->config->item('file_name_payment');
						if (!is_dir($this->config->item('path_payment')) or !is_writable($this->config->item('path_payment'))) {
							$err++;
							if ($site_lang == 'indonesia') {
								$this->session->set_flashdata('error_message', 'Folder payment tidak ditemukan atau tidak writable.');
							}
							else{
								$this->session->set_flashdata('error_message', 'Payment folder is not found or is not writable.');
							}
						} else{
							if (is_file($image_name) and !is_writable($image_name)) {
								$err++;
								if ($site_lang == 'indonesia') {
									$this->session->set_flashdata('error_message', 'File sudah ada dan tidak writable.');
								}
								else{
									$this->session->set_flashdata('error_message', 'File is already exists and is not writable.');
								}
							}
						}

						if (!$err){
							file_put_contents($image_name, $uploadedImg);
							$photo = str_replace($this->config->item('path_payment'), '', $image_name);
						}
					}
				}
				$req_datetime = date('Y-m-d H:i:s', strtotime($this->input->post('req_datetime')));

				if (!$err && $photo == "-"){
					$err++;
					if ($site_lang == 'indonesia') {
						$this->session->set_flashdata('error_message', 'Foto wajib diisi');
					}
					else{
						$this->session->set_flashdata('error_message', 'Photo is required');
					}
					$this->load->view('frontend/add_request_microchip', $data);
				}
				else{
					if (!$err){
						$dataReq = array(
							'req_mem_id' => $this->session->userdata('mem_id'),
							'req_can_id' => $can_id,
							'req_stat_id' => $this->config->item('micro_processed'),
							'req_created_at' => date('Y-m-d H:i:s'),
							'req_datetime' => $req_datetime,
							'req_pay_photo' => $photo
						);
	
						$this->db->trans_strict(FALSE);
						$this->db->trans_start();
						$request = $this->requestmicrochipModel->add_requests($dataReq);
						if ($request){
							$this->db->trans_complete();
							$this->session->set_flashdata('req_micro_success', TRUE);
							redirect('frontend/Canines');
						}
						else{
							$err = 1;
						}
					}
	
					if ($err){
						$this->db->trans_rollback();
						if ($site_lang == 'indonesia') {
							$this->session->set_flashdata('error_message', 'Gagal menyimpan pengajuan pemasangan microchip');
						}
						else{
							$this->session->set_flashdata('error_message', 'Failed to save microchip implant request');
						}
						$this->load->view('frontend/add_request_microchip', $data);
					}
				}

			}
		}
		else{
			redirect("frontend/Members");
		}
	}

	public function cancel(){
		if ($this->uri->segment(4)){
			$site_lang = $this->input->cookie('site_lang');
			$req_id = $this->uri->segment(4);
			$dataReq = array(
				'req_id' => $req_id,
				'req_stat_id' => $this->config->item('micro_cancelled')
			);
	
			$err = 0;
			$this->db->trans_strict(FALSE);
			$this->db->trans_start();
			$whereReq['req_id'] = $req_id;
			$requests = $this->requestmicrochipModel->update_requests($dataReq, $whereReq);
			if ($requests) {
				$request = $this->requestmicrochipModel->get_requests($whereReq)->row();
				$this->db->trans_complete();
				$this->session->set_flashdata('cancel_success', TRUE);
				redirect('frontend/Requestmicrochip');
			} else {
				$err = 1;
			}

			if ($err) {
				$this->db->trans_rollback();
				if ($site_lang == 'indonesia') {
					$this->session->set_flashdata('error_message', 'Gagal membatalkan pengajuan. Error code: '.$err);
				}
				else{
					$this->session->set_flashdata('error_message', 'Failed to cancel request. Error code: '.$err);
				}
				redirect('frontend/Requestmicrochip');
			}
		}
		else{
			redirect('frontend/Requestmicrochip');
		}
	}
	public function accept(){
		if ($this->uri->segment(4)){
			$site_lang = $this->input->cookie('site_lang');
			$req_id = $this->uri->segment(4);
			$dataReq = array(
				'req_id' => $req_id,
				'req_stat_id' => $this->config->item('micro_completed')
			);
	
			$err = 0;
			$this->db->trans_strict(FALSE);
			$this->db->trans_start();
			$whereReq['req_id'] = $req_id;
			$requests = $this->requestmicrochipModel->update_requests($dataReq, $whereReq);
			if ($requests) {
				$this->db->trans_complete();
				$this->session->set_flashdata('accept_success', TRUE);
				redirect('frontend/Requestmicrochip');
			} else {
				$err = 1;
			}

			if ($err) {
				$this->db->trans_rollback();
				if ($site_lang == 'indonesia') {
					$this->session->set_flashdata('error_message', 'Gagal menerima microchip. Error code: '.$err);
				}
				else{
					$this->session->set_flashdata('error_message', 'Failed to accept microchip. Error code: '.$err);
				}
				redirect('frontend/Requestmicrochip');
			}
		}
		else{
			redirect('frontend/Requestmicrochip');
		}
	}
	public function complain(){
		if ($this->uri->segment(4)){
			$req_id = $this->uri->segment(4);
			$whereReq['req_id'] = $req_id;
			$data['request'] = $this->requestmicrochipModel->get_requests($whereReq)->row();
			$data['mode'] = 0;
			$this->load->view('frontend/microchip_complain', $data);
		}
		else{
			redirect('frontend/Requestmicrochip');
		}
	}
	public function validate_complain(){
		if ($this->session->userdata('mem_id')){
			$site_lang = $this->input->cookie('site_lang');
			$this->form_validation->set_error_delimiters('<div>','</div>');
			if ($site_lang == 'indonesia') {
				$this->form_validation->set_message('required', '%s wajib diisi');
				$this->form_validation->set_rules('com_desc', 'Deskripsi komplain ', 'trim|required');
			}
			else{
				$this->form_validation->set_message('required', '%s required');
				$this->form_validation->set_rules('com_desc', 'Complaint description ', 'trim|required');
			}

			$req_id = $this->input->post('req_id');
			$whereReq['req_id'] = $req_id;
			$data['request'] = $this->requestmicrochipModel->get_requests($whereReq)->row();
			$data['mode'] = 1;

			if ($this->form_validation->run() == FALSE){
				$this->load->view('frontend/microchip_complain', $data);
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
                        if ($site_lang == 'indonesia') {
                            $data['error_message'] = 'Ukuran file terlalu besar (> 1 MB).<br/>';
                        }
                        else{
                            $data['error_message'] = 'File size is too big (> 1 MB).<br/>';
                        }
					}
					else{
						$image_name = $this->config->item('path_complain').$this->config->item('file_name_complain');
						if (!is_dir($this->config->item('path_complain')) or !is_writable($this->config->item('path_complain'))) {
							$err++;
							if ($site_lang == 'indonesia') {
								$this->session->set_flashdata('error_message', 'Folder complain tidak ditemukan atau tidak writable.');
							}
							else{
								$this->session->set_flashdata('error_message', 'Complain folder is not found or is not writable.');
							}
						} else{
							if (is_file($image_name) and !is_writable($image_name)) {
								$err++;
								if ($site_lang == 'indonesia') {
									$this->session->set_flashdata('error_message', 'File sudah ada dan tidak writable.');
								}
								else{
									$this->session->set_flashdata('error_message', 'File is already exists and is not writable.');
								}
							}
						}

						if (!$err){
							file_put_contents($image_name, $uploadedImg);
							$photo = str_replace($this->config->item('path_complain'), '', $image_name);
						}
					}
				}

                if (!$err){
                    $dataCom = array(
						'com_req_id' => $req_id,
                        'com_desc' => $this->input->post('com_desc'),
						'com_photo' => $photo
                    );

					$dataReq = array(
						'req_stat_id' => $this->config->item('micro_complained')
					);

					$this->db->trans_strict(FALSE);
					$this->db->trans_start();
					$complain = $this->MicrochipComplainModel->add_complains($dataCom);
					if ($complain){
						$whereReq['req_id'] = $req_id;
						$requests = $this->requestmicrochipModel->update_requests($dataReq, $whereReq);
						if ($requests) {
							$this->db->trans_complete();
							$this->session->set_flashdata('complain_success', TRUE);
							redirect('frontend/Requestmicrochip');
						} else {
							$err = 1;
						}
					}
					else{
						$err = 2;
					}
                }

				if ($err){
					$this->db->trans_rollback();
					if ($site_lang == 'indonesia') {
						$this->session->set_flashdata('error_message', 'Gagal menyimpan data komplain');
					}
					else{
						$this->session->set_flashdata('error_message', 'Failed to save complaint file');
					}
					$this->load->view('frontend/Requestmicrochip', $data);
				}
			}
		}
		else{
			redirect("frontend/Members");
		}
	}
}