<?php
defined('BASEPATH') OR exit('No direct script access allowed');

#[\AllowDynamicProperties]

class Services extends CI_Controller {
    public function __construct(){
		parent::__construct();
		$this->load->model(array('serviceModel'));
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
}