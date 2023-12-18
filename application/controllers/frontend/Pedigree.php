<?php
defined('BASEPATH') OR exit('No direct script access allowed');

#[\AllowDynamicProperties]

class Pedigree extends CI_Controller {
    public function __construct(){
        // Call the CI_Controller constructor
        parent::__construct();
        $this->load->model(array('caninesModel'));
        $this->load->library(array('session', 'form_validation', 'pagination'));
        $this->load->helper(array('url', 'cookie'));
        $this->load->database();
        date_default_timezone_set("Asia/Bangkok");

		if ($this->input->cookie('site_lang')) {
            $this->lang->load('canine', $this->input->cookie('site_lang'));
            $this->lang->load('pedigree', $this->input->cookie('site_lang'));
        } else {
            set_cookie('site_lang', 'indonesia', '2147483647'); 
            $this->lang->load('canine','indonesia');
            $this->lang->load('pedigree','indonesia');
        }
    }

	public function index(){
		$data['canines'] = [];
        $data['keywords'] = '';
        $this->session->set_userdata('keywords', '');
		$this->load->view('frontend/pedigree', $data);
    }

    public function search(){
		if ($this->session->userdata('mem_id')){
            if ($this->input->post('keywords')){
				$this->session->set_userdata('keywords', $this->input->post('keywords'));
				$data['keywords'] = $this->input->post('keywords');
			}
			else{
				if ($this->uri->segment(4))
                    $data['keywords'] = $this->session->userdata('keywords');
                else{
                    $data['keywords'] = '';
                    $this->session->set_userdata('keywords', '');
                }
			}

            $page = ($this->uri->segment(4)) ? ($this->uri->segment(4) - 1) : 0;
			$config['per_page'] = $this->config->item('canine_count');
			$config['uri_segment'] = 4;
			$config['use_page_numbers'] = TRUE;

			//Encapsulate whole pagination 
			$config['full_tag_open'] = '<ul class="pagination justify-content-end">';
			$config['full_tag_close'] = '</ul>';

			//First link of pagination
			$config['first_link'] = 'Pertama / First';
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
			$config['last_link'] = 'Akhir / Last';
			$config['last_tag_open'] = '<li>';
			$config['last_tag_close'] = '</li>';

			//For CURRENT page on which you are
			$config['cur_tag_open'] = '<li class="active"><a class="page-link bg-dark text-warning border-light" href="#">';
			$config['cur_tag_close'] = '</a></li>';

			$config['attributes'] = array('class' => 'page-link bg-dark text-light');

			$like['can_a_s'] = $data['keywords'];
			$like['can_icr_number'] = $data['keywords'];
			$like['can_chip_number'] = $data['keywords'];
			$like['ken_name'] = $data['keywords'];
			$piece = explode("-", $data['keywords']);
			if (isset($piece[1]) && isset($piece[2])){
				$dob = $piece[2]."-".$piece[1]."-".$piece[0];
				$like['can_date_of_birth'] = $dob;
			}
			$where['can_member_id != '] = $this->config->item('no_member');
			$where['can_stat'] = $this->config->item('accepted');
			$where['can_rip'] = $this->config->item('canine_alive');
			$where['mem_stat'] = $this->config->item('accepted');
			$where['ken_stat'] = $this->config->item('accepted');
			$data['canines'] = $this->caninesModel->search_canines($like, $where, 'can_a_s', $page * $config['per_page'], $this->config->item('canine_count'))->result();

            $config['base_url'] = base_url().'/frontend/Pedigree/search';
			$config['total_rows'] = $this->caninesModel->search_canines($like, $where, 'can_a_s', $page * $config['per_page'], 0)->num_rows();
			$this->pagination->initialize($config);
			$this->load->view('frontend/pedigree', $data);
		}
		else{
			redirect('frontend/Members');
		}
    }

	public function view(){
		$data['canines'] = [];
        $data['keywords'] = '';
        $this->session->set_userdata('keywords', '');
		$this->load->view('frontend/search_canine', $data);
    }

    public function search_canine(){
		if ($this->input->post('keywords')){
            $this->session->set_userdata('keywords', $this->input->post('keywords'));
            $data['keywords'] = $this->input->post('keywords');
        }
        else{
            if ($this->uri->segment(4))
                $data['keywords'] = $this->session->userdata('keywords');
            else{
                $data['keywords'] = '';
                $this->session->set_userdata('keywords', '');
            }
        }

        $page = ($this->uri->segment(4)) ? ($this->uri->segment(4) - 1) : 0;
        $config['per_page'] = $this->config->item('canine_count');
        $config['uri_segment'] = 4;
        $config['use_page_numbers'] = TRUE;

        //Encapsulate whole pagination 
        $config['full_tag_open'] = '<ul class="pagination justify-content-end">';
        $config['full_tag_close'] = '</ul>';

        //First link of pagination
        $config['first_link'] = 'Pertama / First';
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
        $config['last_link'] = 'Akhir / Last';
        $config['last_tag_open'] = '<li>';
        $config['last_tag_close'] = '</li>';

        //For CURRENT page on which you are
        $config['cur_tag_open'] = '<li class="active"><a class="page-link bg-dark text-warning border-light" href="#">';
        $config['cur_tag_close'] = '</a></li>';

        $config['attributes'] = array('class' => 'page-link bg-dark text-light');

        $like['can_a_s'] = $data['keywords'];
        $like['can_icr_number'] = $data['keywords'];
        $like['can_chip_number'] = $data['keywords'];
        $like['ken_name'] = $data['keywords'];
        $piece = explode("-", $data['keywords']);
        if (isset($piece[1]) && isset($piece[2])){
            $dob = $piece[2]."-".$piece[1]."-".$piece[0];
            $like['can_date_of_birth'] = $dob;
        }
        $where['can_member_id != '] = $this->config->item('no_member');
        $where['can_stat'] = $this->config->item('accepted');
        $where['can_rip'] = $this->config->item('canine_alive');
        $where['mem_stat'] = $this->config->item('accepted');
        $where['ken_stat'] = $this->config->item('accepted');
        $data['canines'] = $this->caninesModel->search_canines($like, $where, 'can_a_s', $page * $config['per_page'], $this->config->item('canine_count'))->result();

        $config['base_url'] = base_url().'/frontend/Pedigree/search_canine';
        $config['total_rows'] = $this->caninesModel->search_canines($like, $where, 'can_a_s', $page * $config['per_page'], 0)->num_rows();
        $this->pagination->initialize($config);
		$this->load->view('frontend/search_canine', $data);
    }
}