<?php
defined('BASEPATH') OR exit('No direct script access allowed');

#[\AllowDynamicProperties]

class Notification extends CI_Controller {
		public function __construct(){
			// Call the CI_Controller constructor
			parent::__construct();
			$this->load->model('notification_model');
			$this->load->library(array('session', 'pagination'));
			$this->load->helper(array('url', 'cookie'));
			$this->load->database();

			if ($this->input->cookie('site_lang')) {
				$this->lang->load('common', $this->input->cookie('site_lang'));
			} else {
				set_cookie('site_lang', 'indonesia', '2147483647'); 
				$this->lang->load('common','indonesia');
			}
		}

		public function index(){
			if ($this->session->userdata('mem_id')){
				$page = ($this->uri->segment(4)) ? ($this->uri->segment(4) - 1) : 0;
				$config['per_page'] = $this->config->item('notif_count');
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

				$config['base_url'] = base_url().'frontend/Notification/index';
				$config['total_rows'] = count($this->notification_model->get_by_mem_id($this->session->userdata('mem_id'), 0, 0));
				$this->pagination->initialize($config);

				$data['notif'] = $this->notification_model->get_by_mem_id($this->session->userdata('mem_id'), $page * $config['per_page'], 1);
				$this->load->view('frontend/notif', $data);
			}
			else
				redirect('frontend/Members');
		}
}
