<?php
defined('BASEPATH') OR exit('No direct script access allowed');

#[\AllowDynamicProperties]

class Services extends CI_Controller {
    public function __construct(){
		parent::__construct();
		$this->load->model(array('serviceModel', 'logserviceModel'));
		$this->load->library(array('session', 'form_validation', 'pagination'));
		$this->load->helper(array('url'));
		$this->load->database();
	}
	public function index(){
		//pagination
		$config['base_url'] = base_url() . 'marketplace/Services/index';
		$config['total_rows'] = $this->serviceModel->record_count();
		$config['per_page'] = 9;
		$config['attributes'] = array('class' => 'page-link');

		//initialize pagination
		$this->pagination->initialize($config);

		$data['start'] = $this->uri->segment(4);
		$data['services'] = $this->serviceModel->fetch_data($config['per_page'], $data['start'])->result();

        $this->load->view("marketplace/services", $data);
	}
	public function search(){
		$keyword = '';
		if($this->input->get('keyword')){
			$keyword = $this->input->get('keyword');
		}
		else{
			redirect('marketplace/Services');
		}

		//pagination
		$this->db->like('ser_name', $keyword);
		$this->db->from('services');
		$config['base_url'] = base_url() . 'marketplace/Services/search';
		$config['total_rows'] = $this->db->count_all_results();
		$config['per_page'] = 9;
		$config['attributes'] = array('class' => 'page-link');

		//initialize pagination
		$this->pagination->initialize($config);

		$data['start'] = $this->uri->segment(4);

		$like['ser_name'] = $keyword;
		$data['services'] = $this->serviceModel->search_services($config['per_page'], $data['start'], $like)->result();

		$this->load->view("marketplace/services", $data);
    }
	public function service_detail(){
		if ($this->uri->segment(4)){
			$where['ser_id'] = $this->uri->segment(4);
			$data['services'] = $this->serviceModel->get_services($where)->row();
			$this->load->view("marketplace/service_detail", $data);
        }
        else{
          	redirect('Marketplace/services');
        }
	}
	public function service_payment(){
		if ($this->uri->segment(4)){
			$where['ser_id'] = $this->uri->segment(4);
			$data['services'] = $this->serviceModel->get_services($where)->row();
			$this->load->view("marketplace/service_payment", $data);
        }
        else{
          	redirect('Marketplace/service_detail');
        }
	}

	//backend
	public function listServices()
	{
		$data['services'] = $this->serviceModel->get_services()->result();
		$this->load->view("marketplace/view_services", $data);
	}
	public function add()
	{
		$this->load->view('marketplace/add_service');
	}
	public function validate_add()
	{
		if ($this->session->userdata('use_username')) {
			$this->form_validation->set_error_delimiters('<div>', '</div>');
			$this->form_validation->set_rules('ser_name', 'Name ', 'trim|required');
			$this->form_validation->set_rules('ser_price', 'Price ', 'trim|required');

			if ($this->form_validation->run() == FALSE) {
				$this->load->view('marketplace/add_service');
			} else {
				$err = 0;
				if (!isset($_POST['attachment']) || empty($_POST['attachment'])) {
					$err++;
					$this->session->set_flashdata('error_message', 'Photo is required');
				}

				$photo = '-';
				if (!$err) {
					$uploadedImg = $_POST['attachment'];
					$image_array_1 = explode(";", $uploadedImg);
					$image_array_2 = explode(",", $image_array_1[1]);
					$uploadedImg = base64_decode($image_array_2[1]);

					if ((strlen($uploadedImg) > $this->config->item('file_size'))) {
						$err++;
						$this->session->set_flashdata('error_message', 'The file size is too big (> 1 MB).');
					}

					$img_name = $this->config->item('path_service') . 'service_' . time() . '.png';
					if (!is_dir($this->config->item('path_service')) or !is_writable($this->config->item('path_service'))) {
						$err++;
						$this->session->set_flashdata('error_message', 'Services folder not found or not writable.');
					} else {
						if (is_file($img_name) and !is_writable($img_name)) {
							$err++;
							$this->session->set_flashdata('error_message', 'File already exists and not writable.');
						}
					}
				}

				if (!$err) {
					file_put_contents($img_name, $uploadedImg);
					$photo = str_replace($this->config->item('path_service'), '', $img_name);

					$id = $this->serviceModel->record_count() + 1;
					$dataSer = array(
						'ser_id' => $id,
						'ser_name' => $this->input->post('ser_name'),
						'ser_price' => $this->input->post('ser_price'),
						'ser_desc' => $this->input->post('ser_desc'),
						'ser_photo' => $photo,
						'ser_created_user' => $this->session->userdata('use_id'),
						'ser_created_at' => date('Y-m-d H:i:s')
					);

					$dataLog = array(
						'log_service_id' => $id,
						'log_service_name' => $this->input->post('ser_name'),
						'log_service_price' => $this->input->post('ser_price'),
						'log_service_desc' => $this->input->post('ser_desc'),
						'log_service_photo' => $photo,
						'log_service_created_user' => $this->session->userdata('use_id'),
						'log_service_created_at' => date('Y-m-d H:i:s')
					);

					if (!$err) {
						$this->db->trans_strict(FALSE);
						$this->db->trans_start();
						$services = $this->serviceModel->add_services($dataSer);
						if ($services) {
							$log = $this->logserviceModel->add_log($dataLog);
							if ($log) {
								$this->db->trans_complete();
								$this->session->set_flashdata('add_success', true);
								redirect("marketplace/Services/listServices");
							} else {
								$err = 1;
							}
						} else {
							$err = 2;
						}
						if ($err) {
							$this->db->trans_rollback();
							$this->session->set_flashdata('error_message', 'Failed to save service. Error code: ' . $err);
							$this->load->view('marketplace/add_service');
						}
					} else {
						$this->load->view('marketplace/add_service');
					}
				} else {
					$this->load->view('marketplace/add_service');
				}
			}
		} else {
			redirect("backend/Users/login");
		}
	}
}