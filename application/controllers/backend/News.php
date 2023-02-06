<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class News extends CI_Controller{
	public function __construct(){
		parent::__construct();
		$this->load->model(array('news_model'));
		$this->load->library(array('session', 'form_validation'));
        $this->load->helper(array('url'));
        $this->load->database();
	}

	public function index(){
        $where['stat'] = $this->config->item('accepted');
		$data['news'] = $this->news_model->get_news($where)->result();
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
                $this->session->set_flashdata('edit_error', 'Failed to edit news');
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
                $this->session->set_flashdata('delete_error', 'Failed to delete news');
                redirect('backend/News');
            }
        }
        else {
            redirect('backend/News');
        }
    }
}
