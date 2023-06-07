<?php
defined('BASEPATH') OR exit('No direct script access allowed');

#[\AllowDynamicProperties]

class News extends CI_Controller{
	public function __construct(){
		parent::__construct();
		$this->load->model(array('news_model'));
		$this->load->library(array('session', 'form_validation', 'pagination'));
        $this->load->helper(array('url'));
        $this->load->database();
	}

	public function index(){
        $page = ($this->uri->segment(4)) ? ($this->uri->segment(4) - 1) : 0;
        $config['per_page'] = $this->config->item('backend_news_count');
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
        $config['cur_tag_open'] = '<li class="active"><a class="page-link bg-primary text-light border-primary" href="#">';
        $config['cur_tag_close'] = '</a></li>';

        $config['attributes'] = array('class' => 'page-link bg-light text-primary');

        $where['stat'] = $this->config->item('accepted');
		$data['news'] = $this->news_model->get_news($where, $page * $config['per_page'], $this->config->item('backend_news_count'))->result();

        $config['base_url'] = base_url().'/backend/News/index';
        $config['total_rows'] = $this->news_model->get_news($where, $page * $config['per_page'], 0)->num_rows();
        $this->pagination->initialize($config);
        $this->load->view('backend/view_news', $data);
	}

	public function edit(){
        if ($this->uri->segment(4)){
            $where['news_id'] = $this->uri->segment(4);
            $data['news'] = $this->news_model->get_news($where)->row();
            $data['mode'] = 0;
            $this->load->view('backend/edit_news.php', $data);
        }
        else {
            redirect('backend/News');
        }
    }

    public function validate_edit(){
        $this->form_validation->set_error_delimiters('<div>','</div>');
        $this->form_validation->set_rules('title', 'Title ', 'trim|required');
        $this->form_validation->set_rules('description', 'Description ', 'trim|required');

        $where['news_id'] = $this->input->post('news_id');
        $data['news'] = $this->news_model->get_news($where)->row();
        $data['mode'] = 1;
        if ($this->form_validation->run() == FALSE){
            $this->load->view('backend/edit_news', $data);
        }
        else{
            $dataNews = array(
                'title' => $this->input->post('title'),
                'description' => $this->input->post('description'),
            );
            $news = $this->news_model->update($dataNews, $where);
            if ($news){
                $this->session->set_flashdata('edit_success', TRUE);
                redirect('backend/News');
            }
            else{
                $this->session->set_flashdata('error_message', 'Failed to edit news');
                $this->load->view('backend/edit_news', $data);
            }
        }
    }

    public function delete(){
        if ($this->uri->segment(4)){
            $where['news_id'] = $this->uri->segment(4);
            $data['stat'] = $this->config->item('rejected');;
            $news = $this->news_model->update($data, $where);
            if ($news){
                $this->session->set_flashdata('delete_success', TRUE);
                redirect('backend/News');
            }
            else{
                $this->session->set_flashdata('delete_message', 'Failed to delete news');
                redirect('backend/News');
            }
        }
        else {
            redirect('backend/News');
        }
    }
}
