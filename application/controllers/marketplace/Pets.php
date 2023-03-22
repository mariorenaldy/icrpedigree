<?php
defined('BASEPATH') OR exit('No direct script access allowed');

#[\AllowDynamicProperties]

class Pets extends CI_Controller {
    public function __construct(){
		parent::__construct();
		$this->load->model(array('petModel'));
		$this->load->library(array('session', 'form_validation', 'pagination'));
		$this->load->helper(array('url'));
		$this->load->database();
	}
	public function index(){
		//pagination
		$config['base_url'] = base_url() . 'marketplace/Pets/index';
		$config['total_rows'] = $this->petModel->record_count();
		$config['per_page'] = 9;
		$config['attributes'] = array('class' => 'page-link');

		//initialize pagination
		$this->pagination->initialize($config);

		$data['start'] = $this->uri->segment(4);
		$data['pets'] = $this->petModel->fetch_data($config['per_page'], $data['start'])->result();

        $this->load->view("marketplace/pets", $data);
	}
	public function search(){
		$keyword = '';
		if($this->input->get('keyword')){
			$keyword = $this->input->get('keyword');
		}
		else{
			redirect('marketplace/Pets');
		}

		//pagination
		$this->db->like('pet_name', $keyword);
		$this->db->from('pets');
		$config['base_url'] = base_url() . 'marketplace/Pets/search';
		$config['total_rows'] = $this->db->count_all_results();
		$config['per_page'] = 9;
		$config['attributes'] = array('class' => 'page-link');

		//initialize pagination
		$this->pagination->initialize($config);

		$data['start'] = $this->uri->segment(4);

		$like['pet_name'] = $keyword;
		$data['pets'] = $this->petModel->search_pets($config['per_page'], $data['start'], $like)->result();

		$this->load->view("marketplace/pets", $data);
    }
	public function pet_detail(){
		if ($this->uri->segment(4)){
			$where['pet_id'] = $this->uri->segment(4);
			$data['pets'] = $this->petModel->get_pets($where)->row();
			$this->load->view("marketplace/pet_detail", $data);
        }
        else{
          	redirect('marketplace/pets');
        }
	}
	public function pet_payment(){
		if ($this->uri->segment(4)){
			$where['pet_id'] = $this->uri->segment(4);
			$data['pets'] = $this->petModel->get_pets($where)->row();
			$this->load->view("marketplace/pet_payment", $data);
        }
        else{
          	redirect('marketplace/pet_detail');
        }
	}
}