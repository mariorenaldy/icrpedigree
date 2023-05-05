<?php
defined('BASEPATH') OR exit('No direct script access allowed');

#[\AllowDynamicProperties]

class Caninenote extends CI_Controller{
	public function __construct(){
		parent::__construct();
		$this->load->model(array('CaninenotesModel', 'CaninesModel', 'LogcaninenoteModel'));
		$this->load->library(array('session', 'form_validation'));
        $this->load->helper(array('url'));
        $this->load->database();
	}

	public function index(){
        if ($this->uri->segment(4)){
            $where['can_id'] = $this->uri->segment(4);
            $data['canine'] = $this->CaninesModel->get_canines($where)->row();
            $where['note_stat'] = $this->config->item('accepted');
            $data['note'] = $this->CaninenotesModel->get_note($where)->result();
            $this->load->view('backend/view_canine_notes.php', $data);
        }
        else
            redirect("backend/Canines");
	}

    public function add(){
        if ($this->uri->segment(4)){
            $where['can_id'] = $this->uri->segment(4);
            $data['canine'] = $this->CaninesModel->get_canines($where)->row();
            $data['can_id'] = $this->uri->segment(4);
            $this->load->view('backend/add_canine_notes.php', $data);
        }
        else
            redirect("backend/Canines");
    }

    public function validate_add(){
        $this->form_validation->set_error_delimiters('<div>','</div>');
        $this->form_validation->set_rules('date', 'Date ', 'trim|required');
        $this->form_validation->set_rules('desc', 'Note ', 'trim|required');

        $where['can_id'] = $this->input->post('can_id');
        $data['canine'] = $this->CaninesModel->get_canines($where)->row();
        $data['can_id'] = $this->input->post('can_id');
        if ($this->form_validation->run() == FALSE){
            $this->load->view('backend/add_canine_notes', $data);
        }
        else{
            $piece = explode("-", $this->input->post('date'));
            $date = $piece[2]."-".$piece[1]."-".$piece[0];
            $dataNote = array(
                'can_id' => $this->input->post('can_id'),
                'note_date' => $date,
                'note_desc' => $this->input->post('desc'),
                'note_user' => $this->session->userdata('use_id'),
                'note_stat' => $this->config->item('accepted'),
            );

            $this->db->trans_strict(FALSE);
            $this->db->trans_start();
            $id = $this->CaninenotesModel->add_note($dataNote);
            if ($id){
                $dataLog = array(
                    'note_id' => $id,
                    'can_id' => $this->input->post('can_id'),
                    'log_date' => $date,
                    'log_user' => $this->session->userdata('use_id'),
                    'log_desc' => $this->input->post('desc'),
                    'log_stat' => $this->config->item('accepted'),
                    'date' => date('Y-m-d H:i:s'),
                );
                $log = $this->LogcaninenoteModel->add_log($dataLog);
                if ($log){
                    $this->db->trans_complete();
                    $this->session->set_flashdata('add_success', TRUE);
                    redirect('backend/Caninenote/index/'.$this->input->post('can_id'));
                }
                else{
                    $this->db->trans_rollback();
                    $this->session->set_flashdata('error_message', 'Failed to add canine note');
                    $this->load->view('backend/add_canine_notes', $data);
                }
            }
            else{
                $this->session->set_flashdata('error_message', 'Failed to add canine note');
                $this->load->view('backend/add_canine_notes', $data);
            }
        }
    }

	public function edit(){
        if ($this->uri->segment(4)){
            $where['note_id'] = $this->uri->segment(4);
            $data['note'] = $this->CaninenotesModel->get_note($where)->row();
            $data['mode'] = 0;
            $this->load->view('backend/edit_canine_notes.php', $data);
        }
        else {
            redirect('backend/Canines');
        }
    }

    public function validate_edit(){
        $this->form_validation->set_error_delimiters('<div>','</div>');
        $this->form_validation->set_rules('date', 'Date ', 'trim|required');
        $this->form_validation->set_rules('desc', 'Note ', 'trim|required');

        $where['note_id'] = $this->input->post('note_id');
        $data['note'] = $this->CaninenotesModel->get_note($where)->row();
        $data['mode'] = 1;
        if ($this->form_validation->run() == FALSE){
            $this->load->view('backend/edit_canine_notes', $data);
        }
        else{
            $piece = explode("-", $this->input->post('date'));
            $date = $piece[2]."-".$piece[1]."-".$piece[0];
            $dataNote = array(
                'note_date' => $date,
                'note_desc' => $this->input->post('desc'),
                'note_user' => $this->session->userdata('use_id'),
            );

            $this->db->trans_strict(FALSE);
            $this->db->trans_start();
            $note = $this->CaninenotesModel->update_note($dataNote, $where);
            if ($note){
                $dataLog = array(
                    'note_id' => $this->input->post('note_id'),
                    'can_id' => $data['note']->can_id,
                    'log_date' => $date,
                    'log_user' => $this->session->userdata('use_id'),
                    'log_desc' => $this->input->post('desc'),
                    'log_stat' => $this->config->item('accepted'),
                    'date' => date('Y-m-d H:i:s'),
                );
                $log = $this->LogcaninenoteModel->add_log($dataLog);
                if ($log){
                    $this->db->trans_complete();
                    $this->session->set_flashdata('edit_success', TRUE);
                    redirect('backend/Caninenote/index/'.$data['note']->can_id);
                }
                else{
                    $this->db->trans_rollback();
                    $this->session->set_flashdata('error_message', 'Failed to edit canine note');
                    $this->load->view('backend/edit_canine_notes', $data);
                }
            }
            else{
                $this->session->set_flashdata('error_message', 'Failed to edit canine note');
                $this->load->view('backend/edit_canine_notes', $data);
            }
        }
    }

    public function delete(){
        if ($this->uri->segment(4)){
            if ($this->uri->segment(5)){
                $where['note_id'] = $this->uri->segment(5);
                $data['note_stat'] = $this->config->item('rejected');
                $note = $this->CaninenotesModel->update_note($data, $where);
                if ($note){
                    $this->session->set_flashdata('delete_success', TRUE);
                    redirect('backend/Caninenote/index/'.$this->uri->segment(4));
                }
                else{
                    $this->session->set_flashdata('error_message', 'Failed to delete canine note');
                    redirect('backend/Caninenote/index/'.$this->uri->segment(4));
                }
            }
            else{
                $this->session->set_flashdata('error_message', 'Invalid canine note id');
                redirect('backend/Caninenote/index/'.$this->uri->segment(4));
            }
        }
        else {
            redirect('backend/Canines');
        }
    }

    public function log(){
        if ($this->uri->segment(4)){
            $whereCan['can_id'] = $this->uri->segment(4);
            $data['canine'] = $this->CaninesModel->get_canines($whereCan)->row();
            if ($this->uri->segment(5)){
                $where['note_id'] = $this->uri->segment(5);
                $data['note'] = $this->LogcaninenoteModel->get_logs($where)->result();
                $this->load->view('backend/log_canine_notes', $data);
            }
            else{
                $this->session->set_flashdata('error_message', 'No logs');
                redirect('backend/Caninenote/index/'.$this->uri->segment(4));
            }
        }
        else{
            redirect('backend/Canines');
        }
    }
}
