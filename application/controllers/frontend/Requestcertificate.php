<?php
defined('BASEPATH') OR exit('No direct script access allowed');

#[\AllowDynamicProperties]

class Requestcertificate extends CI_Controller {
    public function __construct(){
        // Call the CI_Controller constructor
        parent::__construct();
		$this->load->model(array('requestcertificateModel', 'caninesModel', 'memberModel', 'logrequestCertificateModel', 'RejectReasonsModel', 'CertificateComplainModel'));
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
			$data['requests'] = $this->requestcertificateModel->get_requests($where, 'req_id desc', $page * $config['per_page'], $this->config->item('request_count'))->result();

			$config['base_url'] = base_url().'/frontend/Requestcertificate/index';
			$config['total_rows'] = $this->requestcertificateModel->get_requests($where, 'req_id desc', $page * $config['per_page'], 0)->num_rows();
			$this->pagination->initialize($config);

			$data['keywords'] = '';
            $this->session->set_userdata('keywords', '');
			$this->load->view('frontend/view_request_certificate', $data);
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
			$this->load->view('frontend/add_request_certificate', $data);
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
				$this->form_validation->set_rules('req_desc', 'Alasan pengajuan ', 'trim|required');
			}
			else{
				$this->form_validation->set_message('required', '%s required');
				$this->form_validation->set_rules('req_desc', 'Request reason ', 'trim|required');
			}

			$can_id = $this->input->post('can_id');
			$whereCan['can_id'] = $can_id;
			$data['canine'] = $this->caninesModel->get_canines($whereCan)->row();
			$data['mode'] = 1;

			if ($this->form_validation->run() == FALSE){
				$this->load->view('frontend/add_request_certificate', $data);
			}
			else{
				$err = 0;

                if (!$err){
                    $dataReq = array(
						'req_mem_id' => $this->session->userdata('mem_id'),
						'req_can_id' => $can_id,
						'req_stat_id' => $this->config->item('cert_processed'),
						'req_created_at' => date('Y-m-d H:i:s'),
                        'req_desc' => $this->input->post('req_desc')
                    );

					$this->db->trans_strict(FALSE);
					$this->db->trans_start();
					$request = $this->requestcertificateModel->add_requests($dataReq);
					if ($request){
						$this->db->trans_complete();
						$this->session->set_flashdata('req_cert_success', TRUE);
						redirect('frontend/Canines');
					}
					else{
						$err = 1;
					}
                }

				if ($err){
					$this->db->trans_rollback();
					if ($site_lang == 'indonesia') {
						$this->session->set_flashdata('error_message', 'Gagal menyimpan pengajuan cetak sertifikat');
					}
					else{
						$this->session->set_flashdata('error_message', 'Failed to save certificate request');
					}
					$this->load->view('frontend/add_request_certificate', $data);
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
				'req_stat_id' => $this->config->item('cert_cancelled')
			);
	
			$err = 0;
			$this->db->trans_strict(FALSE);
			$this->db->trans_start();
			$whereReq['req_id'] = $req_id;
			$requests = $this->requestcertificateModel->update_requests($dataReq, $whereReq);
			if ($requests) {
				$request = $this->requestcertificateModel->get_requests($whereReq)->row();
				$this->db->trans_complete();
				$this->session->set_flashdata('cancel_success', TRUE);
				redirect('frontend/Requestcertificate');
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
				redirect('frontend/Requestcertificate');
			}
		}
		else{
			redirect('frontend/Requestcertificate');
		}
	}
	public function accept(){
		if ($this->uri->segment(4)){
			$site_lang = $this->input->cookie('site_lang');
			$req_id = $this->uri->segment(4);
			$dataReq = array(
				'req_id' => $req_id,
				'req_stat_id' => $this->config->item('cert_completed')
			);
	
			$err = 0;
			$this->db->trans_strict(FALSE);
			$this->db->trans_start();
			$whereReq['req_id'] = $req_id;
			$requests = $this->requestcertificateModel->update_requests($dataReq, $whereReq);
			if ($requests) {
				$this->db->trans_complete();
				$this->session->set_flashdata('accept_success', TRUE);
				redirect('frontend/Requestcertificate');
			} else {
				$err = 1;
			}

			if ($err) {
				$this->db->trans_rollback();
				if ($site_lang == 'indonesia') {
					$this->session->set_flashdata('error_message', 'Gagal menerima sertifikat. Error code: '.$err);
				}
				else{
					$this->session->set_flashdata('error_message', 'Failed to accept certificate. Error code: '.$err);
				}
				redirect('frontend/Requestcertificate');
			}
		}
		else{
			redirect('frontend/Requestcertificate');
		}
	}
	public function complain(){
		if ($this->uri->segment(4)){
			$req_id = $this->uri->segment(4);
			$whereReq['req_id'] = $req_id;
			$data['request'] = $this->requestcertificateModel->get_requests($whereReq)->row();
			$data['mode'] = 0;
			$this->load->view('frontend/certificate_complain', $data);
		}
		else{
			redirect('frontend/Requestcertificate');
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
			$data['request'] = $this->requestcertificateModel->get_requests($whereReq)->row();
			$data['mode'] = 1;

			if ($this->form_validation->run() == FALSE){
				$this->load->view('frontend/certificate_complain', $data);
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
							$this->session->set_flashdata('error_message', 'Ukuran file terlalu besar (> 1 MB).');
                        }
                        else{
							$this->session->set_flashdata('error_message', 'File size is too big (> 1 MB).');
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
						'req_stat_id' => $this->config->item('cert_complained')
					);

					$this->db->trans_strict(FALSE);
					$this->db->trans_start();
					$complain = $this->CertificateComplainModel->add_complains($dataCom);
					if ($complain){
						$whereReq['req_id'] = $req_id;
						$requests = $this->requestcertificateModel->update_requests($dataReq, $whereReq);
						if ($requests) {
							$this->db->trans_complete();
							$this->session->set_flashdata('complain_success', TRUE);
							redirect('frontend/Requestcertificate');
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
					$this->load->view('frontend/Requestcertificate', $data);
				}
			}
		}
		else{
			redirect("frontend/Members");
		}
	}
}