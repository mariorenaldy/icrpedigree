<?php
defined('BASEPATH') OR exit('No direct script access allowed');

#[\AllowDynamicProperties]

class Notificationtype extends CI_Controller{
	public function __construct(){
		parent::__construct();
		$this->load->model(array('notificationtype_model'));
		$this->load->library(array('session', 'form_validation'));
        $this->load->helper(array('url'));
        $this->load->database();
	}

	public function index(){
		$data['notif'] = $this->notificationtype_model->get_notificationtype()->result();
        $this->load->view('backend/view_notificationtypes', $data);
	}

	public function edit(){
        if ($this->uri->segment(4)){
            $data['notif'] = $this->notificationtype_model->get_by_id($this->uri->segment(4))[0];
            $data['mode'] = 0;
            $this->load->view('backend/edit_notificationtype.php', $data);
        }
        else {
            redirect('backend/Notificationtype');
        }
    }

    public function validate_edit(){
        $this->form_validation->set_error_delimiters('<div>','</div>');
        $this->form_validation->set_rules('title', 'Title ', 'trim|required');
        $this->form_validation->set_rules('description', 'Description ', 'trim|required');

        $where['notificationtype_id'] = $this->input->post('notificationtype_id');
        $data['notif'] = $this->notificationtype_model->get_by_id($this->input->post('notificationtype_id'))[0];
        $data['mode'] = 1;
        if ($this->form_validation->run() == FALSE){
            $this->load->view('backend/edit_notificationtype', $data);
        }
        else{
            $dataNotif = array(
                'title' => $this->input->post('title'),
                'description' => $this->input->post('description'),
            );
            $notif = $this->notificationtype_model->update($dataNotif, $where);
            if ($notif){
                $this->session->set_flashdata('edit_success', TRUE);
                redirect('backend/Notificationtype');
            }
            else{
                $this->session->set_flashdata('edit_error', 'Failed to edit notification type');
                $this->load->view('backend/edit_notificationtype', $data);
            }
        }
    }
}
