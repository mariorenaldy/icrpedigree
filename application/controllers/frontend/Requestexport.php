<?php
defined('BASEPATH') OR exit('No direct script access allowed');

#[\AllowDynamicProperties]

class Requestexport extends CI_Controller {
    public function __construct(){
        // Call the CI_Controller constructor
        parent::__construct();
        $this->load->model(array('requestexportModel','memberModel', 'KennelModel'));
        $this->load->library('upload', $this->config->item('upload_canine'));
        $this->load->library(array('session', 'form_validation', 'pagination'));
        $this->load->helper(array('url'));
        $this->load->database();
        date_default_timezone_set("Asia/Bangkok");
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
			$data['req'] = $this->requestexportModel->get_requests($where, $page * $config['per_page'], $this->config->item('canine_count'))->result();

			$config['base_url'] = base_url().'/frontend/Requestexport/index';
			$config['total_rows'] = $this->requestexportModel->get_requests($where, $page * $config['per_page'], 0)->num_rows();
			$this->pagination->initialize($config);

			$data['keywords'] = '';
            $this->session->set_userdata('keywords', '');
			$this->load->view('frontend/view_request_export', $data);
		}
		else{
			redirect('frontend/Members');
		}
    }

	public function add(){
        if ($this->session->userdata('mem_id')){
            $whe['ken_member_id'] = $this->session->userdata('mem_id');
			$whe['ken_stat'] = $this->config->item('accepted');
			$data['kennel'] = $this->KennelModel->get_kennels($whe)->result();
			$this->load->view('frontend/add_request_export', $data);
		}
		else{
			redirect("frontend/Members");
		}
    }

    public function validate_add(){ 
		if ($this->session->userdata('mem_id')){
			$whe['ken_member_id'] = $this->session->userdata('mem_id');
			$whe['ken_stat'] = $this->config->item('accepted');
			$data['kennel'] = $this->KennelModel->get_kennels($whe)->result();
			
            $err = 0;
            $photo = '-';
            $photo_stb = '-';
            if ($this->input->post('attachment')) {
                $uploadedImg = $this->input->post('attachment');
                $image_array_1 = explode(";", $uploadedImg);
                $image_array_2 = explode(",", $image_array_1[1]);
                $uploadedImg = base64_decode($image_array_2[1]);

                if ((strlen($uploadedImg) > $this->config->item('file_size'))) {
                    $err++;
                    $data['error_message'] = 'Ukuran file anjing terlalu besar (> 1 MB).<br/>';
                }
                else{
                    $image_name = $this->config->item('path_canine').$this->config->item('file_name_canine');
                    if (!is_dir($this->config->item('path_canine')) or !is_writable($this->config->item('path_canine'))) {
                        $err++;
                        $this->session->set_flashdata('error_message', 'Folder anjing tidak ditemukan atau tidak writeable.');
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

            if ($this->input->post('attachment_stb')) {
                $uploadedImgStb = $this->input->post('attachment_stb');
                $image_array_1 = explode(";", $uploadedImgStb);
                $image_array_2 = explode(",", $image_array_1[1]);
                $uploadedImgStb = base64_decode($image_array_2[1]);

                if ((strlen($uploadedImgStb) > $this->config->item('file_size'))) {
                    $err++;
                    $data['error_message'] = 'Ukuran file stambum terlalu besar (> 1 MB).<br/>';
                }
                else{
                    $image_name_stb = $this->config->item('path_export').$this->config->item('file_name_export');
                    if (!is_dir($this->config->item('path_export')) or !is_writable($this->config->item('path_export'))) {
                        $err++;
                        $this->session->set_flashdata('error_message', 'Folder export tidak ditemukan atau tidak writeable.');
                    } else{
                        if (is_file($image_name_stb) and !is_writable($image_name_stb)) {
                            $err++;
                            $this->session->set_flashdata('error_message', 'File sudah ada dan tidak writeable.');
                        }
                    }

                    if (!$err){
                        file_put_contents($image_name_stb, $uploadedImgStb);
                        $photo_stb = str_replace($this->config->item('path_export'), '', $image_name_stb);
                    }
                }
            }

            if (!$err && $photo == "-"){
                $err++;
                $this->session->set_flashdata('error_message', 'Foto anjing wajib diisi');
            }

            if (!$err && $photo_stb == "-"){
                $err++;
                $this->session->set_flashdata('error_message', 'Foto stambum wajib diisi');
            }

            if (!$err){
                $data = array(
                    'req_member_id' => $this->session->userdata('mem_id'),
                    'req_can_photo' => $photo,
                    'req_stb_photo' => $photo_stb,
                    'req_stat' => $this->config->item('saved'),
                    'req_date' => date('Y-m-d H:i:s'),
                );

                $req = $this->requestexportModel->add_requests($data);
                if ($req){
                    $this->session->set_flashdata('add_success', true);
                    redirect("frontend/Requestexport");
                }
                else{
                    $this->session->set_flashdata('error_message', 'Gagal menyimpan eksport stambum');
                    $this->load->view('frontend/add_request_export', $data);
                }
            }
            else{
                $this->load->view('frontend/add_request_export', $data);
            }
		}
		else{
			redirect("frontend/Members");
		}
	}
}