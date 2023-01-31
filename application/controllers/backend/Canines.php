<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Canines extends CI_Controller {
    public function __construct(){
        // Call the CI_Controller constructor
        parent::__construct();
        $this->load->model(array('caninesModel','memberModel', 'logcanineModel', 'logpedigreeModel', 'requestModel', 'notification_model', 'notificationtype_model', 'pedigreesModel', 'trahModel', 'kennelModel'));
        $this->load->library('upload', $this->config->item('upload_canine'));
        $this->load->library(array('session', 'form_validation'));
        $this->load->helper(array('url'));
        $this->load->database();
        date_default_timezone_set("Asia/Bangkok");
    }

    public function index(){
        $where['can_stat'] = $this->config->item('accepted');
        $data['canine'] = $this->caninesModel->get_canines($where, 'can_a_s', 'asc')->result();
        $this->load->view('backend/view_canines', $data);
    }

    public function search(){
        $like['can_a_s'] = $this->input->post('keywords');
        $like['can_icr_number'] = $this->input->post('keywords');
        $like['can_chip_number'] = $this->input->post('keywords');
        $where['can_stat'] = $this->config->item('accepted');
        $data['canine'] = $this->caninesModel->search_canines($like, $where, 'can_a_s', 'asc')->result();
        $this->load->view('backend/view_canines', $data);
    }

    public function view_approve(){
        $where['can_stat'] = $this->config->item('saved');
        $data['canine'] = $this->caninesModel->get_canines($where)->result();
        $this->load->view('backend/approve_canines', $data);
    }
    
    public function search_approve(){
        $like['can_a_s'] = $this->input->post('keywords');
        $like['can_reg_number'] = $this->input->post('keywords');
        $like['can_chip_number'] = $this->input->post('keywords');
        $where['can_stat'] = $this->config->item('saved');
        $data['canine'] = $this->caninesModel->search_canines($like, $where)->result();
        $this->load->view('backend/approve_canines', $data);
		}

    public function view_detail(){
        if ($this->uri->segment(4)){
          $where['can_id'] = $this->uri->segment(4);
          $data['canine'] = $this->caninesModel->get_canines($where)->row();
          $whePed['ped_canine_id'] = $this->uri->segment(4);
          $ped = $this->pedigreesModel->get_pedigrees($whePed)->row();
          $sire['can_id'] = $ped->ped_sire_id;
          $data['sire'] = $this->caninesModel->get_canines($sire)->row();
          $dam['can_id'] = $ped->ped_dam_id;
          $data['dam'] = $this->caninesModel->get_canines($dam)->row();
          
          if ($ped->ped_sire_id != $this->config->item('sire_id') && $ped->ped_dam_id != $this->config->item('dam_id')){
            $data['male_siblings'] = $this->caninesModel->get_siblings($this->uri->segment(4), $ped->ped_sire_id, $ped->ped_dam_id, 'MALE')->result();
            $data['female_siblings'] = $this->caninesModel->get_siblings($this->uri->segment(4), $ped->ped_sire_id, $ped->ped_dam_id, 'FEMALE')->result();
          }
          else{
            $data['male_siblings'] = [];
            $data['female_siblings'] = [];
          }
          $this->load->view("backend/view_canine_detail", $data);
        }
        else{
          redirect('backend/Canines');
        }
    }

    public function add(){
        $data['trah'] = $this->trahModel->get_trah(null)->result();
        $data['member'] = [];
        $data['kennel'] = [];
        $this->load->view('backend/add_canine', $data);
    }
  
    public function search_member(){
        if ($this->session->userdata('use_username')) {
          $data['trah'] = $this->trahModel->get_trah(null)->result();

          $like['mem_name'] = $this->input->post('mem_name');
          $where['mem_stat'] = $this->config->item('accepted');
          $data['member'] = $this->memberModel->search_members($like, $where)->result();

          if ($data['member']){
            $whe['ken_member_id'] =  $data['member'][0]->mem_id;
            $whe['ken_stat'] = $this->config->item('accepted');
            $data['kennel'] = $this->kennelModel->get_kennels($whe)->result();
          }
          else{
            $data['kennel'] = [];
          }
          $this->load->view('backend/add_canine', $data);
        }
        else {
          redirect("backend/Users/login");
        }
    }

    public function search_kennel(){
        if ($this->session->userdata('use_username')) {
          $data['trah'] = $this->trahModel->get_trah(null)->result();

          $like['mem_name'] = $this->input->post('mem_name');
          $where['mem_stat'] = $this->config->item('accepted');
          $data['member'] = $this->memberModel->search_members($like, $where)->result();

          $whe['ken_member_id'] =  $this->input->post('can_member_id');
          $data['kennel'] = $this->kennelModel->get_kennels($whe)->result();
          $this->load->view('backend/add_canine', $data);
        }
        else {
          redirect("backend/Users/login");
        }
    }
  
    public function validate_add(){ 
        if ($this->session->userdata('use_username')) {
          $this->form_validation->set_error_delimiters('<div>', '</div>');
          $this->form_validation->set_rules('can_member_id', 'Member id ', 'trim|required');
          $this->form_validation->set_rules('can_kennel_id', 'Kennel id ', 'trim|required');
          $this->form_validation->set_rules('can_a_s', 'Name ', 'trim|required');
          $this->form_validation->set_rules('can_reg_number', 'Current registration number', 'trim|required');
          $this->form_validation->set_rules('can_icr_number', 'ICR number ', 'trim|required');
          $this->form_validation->set_rules('can_chip_number', 'Microchip number ', 'trim');
          $this->form_validation->set_rules('can_color', 'Color ', 'trim|required');
          $this->form_validation->set_rules('can_date_of_birth', 'Date of Birth ', 'trim|required');
    
          $data['trah'] = $this->trahModel->get_trah(null)->result();

          $like['mem_name'] = $this->input->post('mem_name');
          $where['mem_stat'] = $this->config->item('accepted');
          $data['member'] = $this->memberModel->search_members($like, $where)->result();

          $whe['ken_member_id'] =  $this->input->post('can_member_id');
          $whe['ken_stat'] = $this->config->item('accepted');
          $data['kennel'] = $this->kennelModel->get_kennels($whe)->result();

          if ($this->form_validation->run() == FALSE) {
            $this->load->view('backend/add_canine', $data);
          } else {
            $err = 0;
            $photo = '-';
            if (!$err && isset($_FILES['attachment']) && !empty($_FILES['attachment']['tmp_name']) && is_uploaded_file($_FILES['attachment']['tmp_name'])) {
              if (is_uploaded_file($_FILES['attachment']['tmp_name'])) {
                $this->upload->initialize($this->config->item('upload_canine'));
                if ($this->upload->do_upload('attachment')) {
                  $uploadData = $this->upload->data();
                  $photo = $uploadData['file_name'];
                } else {
                  $err++;
                  $this->session->set_flashdata('error_message', $this->upload->display_errors());
                }
              }
            }

            if (!$err && $photo == "-") {
              $err++;
              $this->session->set_flashdata('error_message', 'Photo is required');
            }

            if (!$err && $this->input->post('can_icr_number') != "-" && $this->caninesModel->check_for_duplicate(0, 'can_icr_number', $this->input->post('can_icr_number'))){
              $err++;
              $this->session->set_flashdata('error_message', 'Duplicate ICR number');
            }
    
            if (!$err && $this->input->post('can_chip_number') != "-" && $this->caninesModel->check_for_duplicate(0, 'can_chip_number', $this->input->post('can_chip_number'))){
              $err++;
              $this->session->set_flashdata('error_message', 'Duplicate microchip number');
            }

            if (!$err) {
              $piece = explode("-", $this->input->post('can_date_of_birth'));
              $dob = $piece[2] . "-" . $piece[1] . "-" . $piece[0];
    
              $id = $this->caninesModel->record_count() + 895; // gara2 data canine dihapus
              $data = array(
                'can_id' => $id,
                'can_member_id' => $this->input->post('can_member_id'),
                'can_reg_number' => strtoupper($this->input->post('can_reg_number')),
                'can_breed' => $this->input->post('can_breed'),
                'can_gender' => $this->input->post('can_gender'),
                'can_date_of_birth' => $dob,
                'can_color' => $this->input->post('can_color'),
                'can_kennel_id' => $this->input->post('can_kennel_id'),
                'can_reg_date' => date("Y/m/d"),
                'can_photo' => $photo,
                'can_stat' => $this->config->item('accepted'),
                'can_app_user' => $this->session->userdata('use_id'),
                'can_app_date' => date('Y-m-d H:i:s'),
                'can_chip_number' => $this->input->post('can_chip_number'),
                'can_icr_number' => $this->input->post('can_icr_number'),
                'can_note' => $this->input->post('can_note'),
              );

              // nama diubah berdasarkan kennel
              $whereKennel['ken_id'] = $this->input->post('can_kennel_id');
              $kennel = $this->kennelModel->get_kennels($whereKennel)->result();
              if ($kennel) {
                if ($kennel[0]->ken_type_id == 1)
                  $data['can_a_s'] = strtoupper($this->input->post('can_a_s'))." VON ".$kennel[0]->ken_name;
                else if ($kennel[0]->ken_type_id == 2)
                  $data['can_a_s'] = $kennel[0]->ken_name."` ".strtoupper($this->input->post('can_a_s'));
                else 
                  $data['can_a_s'] = strtoupper($this->input->post('can_a_s'));
              }

              if (!$err && $this->caninesModel->check_for_duplicate(0, 'can_a_s', $this->input->post('can_a_s'))){
                $err++;
                $this->session->set_flashdata('error_message', 'Duplicate canine name');
              }

              $dataLog = array(
                'log_canine_id' => $id,
                'log_reg_number' => strtoupper($this->input->post('can_reg_number')),
                'log_a_s' => $data['can_a_s'],
                'log_breed' => $this->input->post('can_breed'),
                'log_gender' => $this->input->post('can_gender'),
                'log_date_of_birth' => $dob,
                'log_color' => $this->input->post('can_color'),
                'log_kennel_id' => $this->input->post('can_kennel_id'),
                'log_photo' => $photo,
                'log_stat' => $this->config->item('accepted'),
                'log_app_user' => $this->session->userdata('use_id'),
                'log_app_date' => date('Y-m-d H:i:s'),
                'log_chip_number' => $this->input->post('can_chip_number'),
                'log_icr_number' => $this->input->post('can_icr_number'),
                'log_member_id' => $this->input->post('can_member_id'),
                'log_note' => $this->input->post('can_note'),
              );

              $dataPed = array(
                'ped_sire_id' => $this->config->item('sire_id'),
                'ped_dam_id' => $this->config->item('dam_id'),
                'ped_canine_id' => $id,
              );

              $dataLogPed = array(
                'log_sire_id' => $this->config->item('sire_id'),
                'log_dam_id' => $this->config->item('dam_id'),
                'log_canine_id' => $id,
                'log_stat' => $this->config->item('accepted'),
                'log_app_user' => $this->session->userdata('use_id'),
                'log_app_date' => date('Y-m-d H:i:s'),
              );

              if (!$err) {
                $this->db->trans_strict(FALSE);
                $this->db->trans_start();
                $canines = $this->caninesModel->add_canines($data);
                if ($canines) {
                  $pedigree = $this->pedigreesModel->add_pedigrees($dataPed);
                  if ($pedigree) {
                    $log = $this->logcanineModel->add_log($dataLog);
                    if ($log){
                      $res = $this->logpedigreeModel->add_log($dataLogPed);
                      if ($res){
                        $this->db->trans_complete();
                        $this->session->set_flashdata('add_success', true);
                        redirect("backend/Canines");
                      }
                      else{
                        $err = 1;
                      }
                    }
                    else{
                      $err = 2;
                    }
                  } else {
                    $err = 3;
                  }
                } else {
                  $err = 4;
                }
                if ($err) {
                  $this->db->trans_rollback();
                  $this->session->set_flashdata('error_message', 'Failed to save canine. Error code: '.$err);
                  $this->load->view('backend/add_canine', $data);
                }
              } else {
                $this->load->view('backend/add_canine', $data);
              }
            } else {
              $this->load->view('backend/add_canine', $data);
            }
          }
        } 
        else {
          redirect("backend/Users/login");
        }
  }

  public function edit_canine(){
    if ($this->uri->segment(4)){
      $data['trah'] = $this->trahModel->get_trah(null)->result();
      $where['can_id'] = $this->uri->segment(4);
      $data['canine'] = $this->caninesModel->get_canines($where)->row();
      $wheMember['mem_id'] = $data['canine']->can_member_id;
      $data['member'] = $this->memberModel->get_members($wheMember)->result();
      $wheKennel['ken_member_id'] = $data['canine']->can_member_id;
      $data['kennel'] = $this->kennelModel->get_kennels($wheKennel)->result();
      $data['mode'] = 0;
      $this->load->view("backend/edit_canine", $data);
    }
    else{
      redirect('backend/Canines');
    }
  }

  public function search_member_update(){
    if ($this->session->userdata('use_username')) {
      $data['trah'] = $this->trahModel->get_trah(null)->result();
      $where['can_id'] = $this->input->post('can_id');
      $data['canine'] = $this->caninesModel->get_canines($where)->row();

      $like['mem_name'] = $this->input->post('mem_name');
      $wheMember['mem_stat'] = $this->config->item('accepted');
      $data['member'] = $this->memberModel->search_members($like, $wheMember)->result();

      if ($data['member']){
        $wheKennel['ken_member_id'] =  $data['member'][0]->mem_id;
        $wheKennel['ken_stat'] = $this->config->item('accepted');
        $data['kennel'] = $this->kennelModel->get_kennels($wheKennel)->result();
      }
      else{
        $wheMember['mem_id'] = $data['canine']->can_member_id;
        $data['member'] = $this->memberModel->get_members($wheMember)->result();
        $wheKennel['ken_member_id'] = $data['canine']->can_member_id;
        $data['kennel'] = $this->kennelModel->get_kennels($wheKennel)->result();
      }
      $data['mode'] = 1;
      $this->load->view('backend/edit_canine', $data);
    }
    else {
      redirect("backend/Users/login");
    }
  }

  public function search_kennel_update(){
    if ($this->session->userdata('use_username')) {
      $data['trah'] = $this->trahModel->get_trah(null)->result();
      $where['can_id'] = $this->input->post('can_id');
      $data['canine'] = $this->caninesModel->get_canines($where)->row();

      $like['mem_name'] = $this->input->post('mem_name');
      $wheMember['mem_stat'] = $this->config->item('accepted');
      $data['member'] = $this->memberModel->search_members($like, $wheMember)->result();

      if ($data['member']){
        $wheKennel['ken_member_id'] =  $this->input->post('can_member_id');
        $data['kennel'] = $this->kennelModel->get_kennels($wheKennel)->result();
      }
      else{
        $wheMember['mem_id'] = $data['canine']->can_member_id;
        $data['member'] = $this->memberModel->get_members($wheMember)->result();
        $wheKennel['ken_member_id'] = $data['canine']->can_member_id;
        $data['kennel'] = $this->kennelModel->get_kennels($wheKennel)->result();
      }
      $data['mode'] = 1;
      $this->load->view('backend/edit_canine', $data);
    }
    else {
      redirect("backend/Users/login");
    }
  }

  public function validate_edit_canine(){ 
    if ($this->session->userdata('use_username')) {
      $this->form_validation->set_error_delimiters('<div>', '</div>');
      $this->form_validation->set_rules('can_member_id', 'Member id ', 'trim|required');
      $this->form_validation->set_rules('can_kennel_id', 'Kennel id ', 'trim|required');
      $this->form_validation->set_rules('can_a_s', 'Name ', 'trim|required');
      $this->form_validation->set_rules('can_reg_number', 'Current registration number', 'trim|required');
      $this->form_validation->set_rules('can_icr_number', 'ICR number ', 'trim|required');
      $this->form_validation->set_rules('can_chip_number', 'Microchip number ', 'trim');
      $this->form_validation->set_rules('can_color', 'Color ', 'trim|required');
      $this->form_validation->set_rules('can_date_of_birth', 'Date of Birth ', 'trim|required');

      $data['trah'] = $this->trahModel->get_trah(null)->result();
      $where['can_id'] = $this->input->post('can_id');
      $data['canine'] = $this->caninesModel->get_canines($where)->row();
      
      $like['mem_name'] = $this->input->post('mem_name');
      $wheMember['mem_stat'] = $this->config->item('accepted');
      $data['member'] = $this->memberModel->search_members($like, $wheMember)->result();

      if ($data['member']){
        $wheKennel['ken_member_id'] =  $this->input->post('can_member_id');
        $data['kennel'] = $this->kennelModel->get_kennels($wheKennel)->result();
      }
      else{
        $wheMember['mem_id'] = $data['canine']->can_member_id;
        $data['member'] = $this->memberModel->get_members($wheMember)->result();
        $wheKennel['ken_member_id'] = $data['canine']->can_member_id;
        $data['kennel'] = $this->kennelModel->get_kennels($wheKennel)->result();
      }
      $data['mode'] = 1;

      if ($this->form_validation->run() == FALSE) {
        $this->load->view('backend/edit_canine', $data);
      } else {
        $err = 0;
        $photo = '-';
        if (!$err && isset($_FILES['attachment']) && !empty($_FILES['attachment']['tmp_name']) && is_uploaded_file($_FILES['attachment']['tmp_name'])) {
          if (is_uploaded_file($_FILES['attachment']['tmp_name'])) {
            $this->upload->initialize($this->config->item('upload_canine'));
            if ($this->upload->do_upload('attachment')) {
              $uploadData = $this->upload->data();
              $photo = $uploadData['file_name'];
            } else {
              $err++;
              $this->session->set_flashdata('error_message', $this->upload->display_errors());
            }
          }
        }

        if (!$err && $this->input->post('can_icr_number') != "-" && $this->caninesModel->check_for_duplicate($this->input->post('can_id'), 'can_icr_number', $this->input->post('can_icr_number'))){
          $err++;
          $this->session->set_flashdata('error_message', 'No. ICR tidak boleh sama');
        }

        if (!$err && $this->input->post('can_chip_number') != "-" && $this->caninesModel->check_for_duplicate($this->input->post('can_id'), 'can_chip_number', $this->input->post('can_chip_number'))){
          $err++;
          $this->session->set_flashdata('error_message', 'No. Microchip tidak boleh sama');
        }

        if (!$err && $this->caninesModel->check_for_duplicate($this->input->post('can_id'), 'can_a_s', $this->input->post('can_a_s'))){
          $err++;
          $this->session->set_flashdata('error_message', 'Nama canine tidak boleh sama');
        }

        if (!$err) {
          $piece = explode("-", $this->input->post('can_date_of_birth'));
          $dob = $piece[2] . "-" . $piece[1] . "-" . $piece[0];

          $dataCan = array(
            'can_member_id' => $this->input->post('can_member_id'),
            'can_reg_number' => strtoupper($this->input->post('can_reg_number')),
            'can_breed' => $this->input->post('can_breed'),
            'can_gender' => $this->input->post('can_gender'),
            'can_date_of_birth' => $dob,
            'can_color' => $this->input->post('can_color'),
            'can_kennel_id' => $this->input->post('can_kennel_id'),
            'can_stat' => $this->config->item('accepted'),
            'can_app_user' => $this->session->userdata('use_id'),
            'can_app_date' => date('Y-m-d H:i:s'),
            'can_chip_number' => $this->input->post('can_chip_number'),
            'can_icr_number' => $this->input->post('can_icr_number'),
            'can_a_s' => strtoupper($this->input->post('can_a_s')),
            'can_note' => $this->input->post('can_note'),
          );

          if ($photo != '-')
            $dataCan['can_photo'] = $photo;
          
          $dataLog = array(
            'log_canine_id' => $this->input->post('can_id'),
            'log_reg_number' => strtoupper($this->input->post('can_reg_number')),
            'log_a_s' => $dataCan['can_a_s'],
            'log_breed' => $this->input->post('can_breed'),
            'log_gender' => $this->input->post('can_gender'),
            'log_date_of_birth' => $dob,
            'log_color' => $this->input->post('can_color'),
            'log_kennel_id' => $this->input->post('can_kennel_id'),
            'log_photo' => $photo,
            'log_stat' => $this->config->item('accepted'),
            'log_app_user' => $this->session->userdata('use_id'),
            'log_app_date' => date('Y-m-d H:i:s'),
            'log_chip_number' => $this->input->post('can_chip_number'),
            'log_icr_number' => $this->input->post('can_icr_number'),
            'log_member_id' => $this->input->post('can_member_id'),
            'log_note' => $this->input->post('can_note'),
          );

          if (!$err) {
            $this->db->trans_strict(FALSE);
            $this->db->trans_start();
            $canines = $this->caninesModel->update_canines($dataCan, $where);
            if ($canines) {
              $log = $this->logcanineModel->add_log($dataLog);
              if ($log){
                $this->db->trans_complete();
                $this->session->set_flashdata('edit_success', true);
                redirect("backend/Canines");
              }
              else{
                $err = 1;
              }
            } else {
              $err = 2;
            }
            if ($err) {
              $this->db->trans_rollback();
              $this->session->set_flashdata('error_message', 'Failed to edit canine id = '.$this->input->post('can_id').'. Error code: '.$err);
              $this->load->view('backend/edit_canine', $data);
            }
          } else {
            $this->load->view('backend/edit_canine', $data);
          }
        } else {
          $this->load->view('backend/edit_canine', $data);
        }
      }
    }
    else{
      redirect('backend/Users/login');
    }
  }

  public function edit_pedigree(){
    if ($this->uri->segment(4)){
      $where['can_id'] = $this->uri->segment(4);
      $data['canine'] = $this->caninesModel->get_canines($where)->row();
      $whePed['ped_canine_id'] = $data['canine']->can_id;
      $data['ped'] = $this->pedigreesModel->get_pedigrees($whePed)->row();
      $wheSire['can_id'] = $data['ped']->ped_sire_id;
      $data['sire'] = $this->caninesModel->get_canines($wheSire)->result();
      $wheDam['can_id'] = $data['ped']->ped_dam_id;
      $data['dam'] = $this->caninesModel->get_canines($wheDam)->result();
      $data['mode'] = 0;
      $this->load->view("backend/edit_pedigree", $data);
    }
    else{
      redirect('backend/Canines');
    }
  }

  public function search_pedigree(){
    if ($this->session->userdata('use_username')) {
      $where['can_id'] = $this->input->post('ped_canine_id');
      $data['canine'] = $this->caninesModel->get_canines($where)->row();
      $whePed['ped_canine_id'] = $data['canine']->can_id;
      $data['ped'] = $this->pedigreesModel->get_pedigrees($whePed)->row();
      if ($this->input->post('sire_a_s')){
        $likeSire['can_a_s'] = $this->input->post('sire_a_s');
        $wheSire['can_stat'] = $this->config->item('accepted');
        $wheSire['can_gender'] = 'MALE';
        $data['sire'] = $this->caninesModel->search_canines($likeSire, $wheSire)->result();
      }
      else{
        $wheSire['can_id'] = $data['ped']->ped_sire_id;
        $data['sire'] = $this->caninesModel->get_canines($wheSire)->result();
      }
      if ($this->input->post('dam_a_s')){
        $likeDam['can_a_s'] = $this->input->post('dam_a_s');
        $wheDam['can_stat'] = $this->config->item('accepted');
        $wheDam['can_gender'] = 'FEMALE';
        $data['dam'] = $this->caninesModel->search_canines($likeDam, $wheDam)->result();
      }
      else{
        $wheDam['can_id'] = $data['ped']->ped_dam_id;
        $data['dam'] = $this->caninesModel->get_canines($wheDam)->result();
      }
      $data['mode'] = 1;
      $this->load->view("backend/edit_pedigree", $data);
    }
    else {
      redirect("backend/Users/login");
    }
  }

  public function validate_edit_pedigree(){
    if ($this->session->userdata('use_username')) {
      $where['can_id'] = $this->input->post('ped_canine_id');
      $data['canine'] = $this->caninesModel->get_canines($where)->row();
      $whePed['ped_canine_id'] = $data['canine']->can_id;
      $data['ped'] = $this->pedigreesModel->get_pedigrees($whePed)->row();
      if ($this->input->post('sire_a_s')){
        $likeSire['can_a_s'] = $this->input->post('sire_a_s');
        $wheSire['can_stat'] = $this->config->item('accepted');
        $wheSire['can_gender'] = 'MALE';
        $data['sire'] = $this->caninesModel->search_canines($likeSire, $wheSire)->result();
      }
      else{
        $wheSire['can_id'] = $data['ped']->ped_sire_id;
        $data['sire'] = $this->caninesModel->get_canines($wheSire)->result();
      }
      if ($this->input->post('dam_a_s')){
        $likeDam['can_a_s'] = $this->input->post('dam_a_s');
        $wheDam['can_stat'] = $this->config->item('accepted');
        $wheDam['can_gender'] = 'FEMALE';
        $data['dam'] = $this->caninesModel->search_canines($likeDam, $wheDam)->result();
      }
      else{
        $wheDam['can_id'] = $data['ped']->ped_dam_id;
        $data['dam'] = $this->caninesModel->get_canines($wheDam)->result();
      }
      $data['mode'] = 1;

      $this->form_validation->set_error_delimiters('<div>', '</div>');
      $this->form_validation->set_rules('ped_canine_id', 'Canine id ', 'trim|required');
      $this->form_validation->set_rules('ped_sire_id', 'Sire id ', 'trim|required');
      $this->form_validation->set_rules('ped_dam_id', 'Dam id ', 'trim|required');

      if ($this->form_validation->run() == FALSE) {
        $this->load->view('backend/edit_pedigree', $data);
      } else {
        $dataPed = array(
          'ped_sire_id' => $this->input->post('ped_sire_id'),
          'ped_dam_id' => $this->input->post('ped_dam_id'),
        );

        $dataLogPed = array(
          'log_sire_id' => $this->input->post('ped_sire_id'),
          'log_dam_id' => $this->input->post('ped_dam_id'),
          'log_canine_id' => $this->input->post('ped_canine_id'),
          'log_stat' => $this->config->item('accepted'),
          'log_app_user' => $this->session->userdata('use_id'),
          'log_app_date' => date('Y-m-d H:i:s'),
        );

        $this->db->trans_strict(FALSE);
        $this->db->trans_start();
        $whePed['ped_canine_id'] = $this->input->post('ped_canine_id');
        $pedigree = $this->pedigreesModel->update_pedigrees($dataPed, $whePed);
        if ($pedigree) {
          $res = $this->logpedigreeModel->add_log($dataLogPed);
          if ($res){
            $this->db->trans_complete();
            $this->session->set_flashdata('edit_pedigree_success', true);
            redirect("backend/Canines");
          }
          else{
            $err = 1;
          }
        }
        else{
          $err = 2;
        }
        if ($err) {
          $this->db->trans_rollback();
          $this->session->set_flashdata('error_message', 'Failed to edit pedigree. Error code: '.$err);
          $this->load->view("backend/edit_pedigree", $data);
        }
      }
    }
    else {
      redirect("backend/Users/login");
    }
  }

    public function update($id = null){
        // $data = $this->input->post(null, false);
        $sire = $this->input->post('can_sire');
        $dam = $this->input->post('can_dam');

				$img = $this->input->post('srcDataCrop');
        // print_r($data);
				if($img){
						$title = self::_clean_text('canine');
						$_POST['can_photo'] = self::_upload_base64($img, $title, true, $id);
				}

        unset($_POST['can_sire']);
        unset($_POST['can_dam']);
        unset($_POST['sire']);
        unset($_POST['dam']);
				unset($_POST['srcDataCrop']);
				$data = $this->input->post(null, false);
				$where['can_id'] = $id;

        $cek = true;
        $piece = explode("-", $this->input->post('can_date_of_birth'));
        $dob = $piece[2]."-".$piece[1]."-".$piece[0];
        if ($sire != null && $dam !=null && $sire != 86 && $dam != 87) {
          $sire_dob = $this->caninesModel->get_dob_by_id($sire)[0]->can_date_of_birth;
          $dam_dob = $this->caninesModel->get_dob_by_id($dam)[0]->can_date_of_birth;

          $tssire = strtotime($sire_dob);
          $tsdam = strtotime($dam_dob);
          $ts = strtotime($dob);

          $yearsire = date('Y', $tssire);
          $yeardam = date('Y', $tsdam);
          $year = date('Y', $ts);

          $monthsire = date('m', $tssire);
          $monthdam = date('m', $tsdam);
          $month = date('m', $ts);

          $diffsire = (($year - $yearsire) * 12) + ($month - $monthsire);
          $diffdam = (($year - $yeardam) * 12) + ($month - $monthdam);

          if (abs($diffsire) < 14 || abs($diffdam) < 14){
            $cek = false;
          }
        }
      
        if ($cek){
          $cek2 = true;
          if ($sire != null && $dam !=null && $sire != 86 && $dam != 87) {
            $res = $this->caninesModel->get_date_compare_sibling_by_id($dam, $dob, $id);
            if ($res){
              foreach($res as $row){
                if ($row->diff != 0 && abs($row->diff) < 100){
                  $cek2 = false;
                }
              }
            }
          }

          if ($cek2){
            $data['can_date_of_birth'] = $dob;

            $cek3 = true;
            if ($this->input->post('can_icr_number') != '-'){
              $res = $this->caninesModel->check_icr_number($id, $this->input->post('can_icr_number'));
              if ($res){
                $cek3 = false;
              }
            }

            if ($cek3){
              $cek4 = true;
              if ($this->input->post('can_icr_moc_number') != '-'){
                $res = $this->caninesModel->check_microchip_number($id, $this->input->post('can_icr_moc_number'));
                if ($res){
                  $cek4 = false;
                }
              }

              if ($cek4){
                $canine = $this->caninesModel->get_canines($where)->row();
                
                $cek5 = true;
                $res = $this->caninesModel->check_can_a_s($id, $this->input->post('can_a_s'));
                if ($res){
                  $cek5 = false;
                }

                if ($cek5){
                  $owner = ''; 
                  if ($canine->can_owner != $this->input->post('can_owner')){
                    $owner = $canine->can_owner." => ".$this->input->post('can_owner');
                  }

                  $address = '';
                  if ($canine->can_address != $this->input->post('can_address')){
                    $address = $canine->can_address." => ".$this->input->post('can_address');
                  }

                  $cage = '';
                  if ($canine->can_cage != $this->input->post('can_cage')){
                    $cage = $canine->can_cage." => ".$this->input->post('can_cage');
                  }

                  $member = '';
                  if ($canine->can_member != $this->input->post('can_member')){
                    $where_log['mem_id'] = $canine->can_member;
                    $old_mem = $this->memberModel->get_members($where_log)->row();
              
                    $where_log['mem_id'] = $this->input->post('can_member');
                    $new_mem = $this->memberModel->get_members($where_log)->row(); 

                    $member = $old_mem->mem_name." => ".$new_mem->mem_name;
                  }

                  // write log 
                  $this->db->trans_strict(FALSE);
                  $this->db->trans_start();
                  if ($owner != '' || $address != '' || $cage != '' || $member != ''){
                    $log = array(
                      'log_id' => $id,
                      'log_owner' => $owner,
                      'log_address' => $address,
                      'log_cage' => $cage,
                      'log_member' => $member,
                      'log_old_photo' => '-',
                      'log_photo' => '-',
                      'log_stat' => 0,
                      'log_req' => 0
                    );
                    $res = $this->logcanineModel->add_log($log);

                    if ($res){
                      $this->caninesModel->update_canines($data, $where);
                      $this->db->trans_complete();
                      echo json_encode(array('data' => '1'));
                    }
                    else{
                      $this->db->trans_rollback();
                      echo json_encode(array('data' => 'Gagal menulis ke log'));
                    }
                  }
                  else{ 
                      $this->caninesModel->update_canines($data, $where);
                      $this->db->trans_complete();
                      echo json_encode(array('data' => '1'));
                  }
                }
                else
                  echo json_encode(array('data' => 'Nama canine tidak boleh sama'));
              }
              else{
                echo json_encode(array('data' => 'No. microchip tidak boleh sama'));
              }
            }
            else{
              echo json_encode(array('data' => 'No. ICR tidak boleh sama'));
            }
        }
        else{
          echo json_encode(array('data' => 'Dam belum 100 hari'));
        }
      }
      else{
        echo json_encode(array('data' => 'Sire & Dam harus 14 bulan'));
      }
		}

    public function update2($id = null){
        // $data = $this->input->post(null, false);
        $sire = $this->input->post('can_sire');
        $dam = $this->input->post('can_dam');
        unset($_POST['can_sire']);
        unset($_POST['can_dam']);
        unset($_POST['sire']);
        unset($_POST['dam']);
        //
				// $data = $this->input->post(null, false);
				// $where['can_id'] = $id;
				// $this->caninesModel->update_canines($data, $where);

        $where['can_id'] = $id;
        $canine = $this->caninesModel->get_canines($where)->row();
        $dob = $canine->can_date_of_birth;
        
        $cek = true;
        if ($sire != null && $dam !=null && $sire != 86 && $dam != 87) {
          $sire_dob = $this->caninesModel->get_dob_by_id($sire)[0]->can_date_of_birth;
          $dam_dob = $this->caninesModel->get_dob_by_id($dam)[0]->can_date_of_birth;

          $tssire = strtotime($sire_dob);
          $tsdam = strtotime($dam_dob);
          $ts = strtotime($dob);

          $yearsire = date('Y', $tssire);
          $yeardam = date('Y', $tsdam);
          $year = date('Y', $ts);

          $monthsire = date('m', $tssire);
          $monthdam = date('m', $tsdam);
          $month = date('m', $ts);

          $diffsire = (($year - $yearsire) * 12) + ($month - $monthsire);
          $diffdam = (($year - $yeardam) * 12) + ($month - $monthdam);

          if (abs($diffsire) < 14 || abs($diffdam) < 14){
            $cek = false;
          }
        }
      
        if ($cek){
          $cek2 = true;
          if ($sire != null && $dam !=null && $sire != 86 && $dam != 87) {
            $res = $this->caninesModel->get_date_compare_sibling_by_id($dam, $dob, $id);
            if ($res){
              foreach($res as $row){
                if ($row->diff != 0 && abs($row->diff) < 100){
                  $cek2 = false;
                }
              }
            }
          }

          if ($cek2){
            if ($sire != null && $dam != null) {
              $wherePed['ped_canine_id'] = $id;
              $pedigree = array('ped_sire_id' => $sire,
                                'ped_mom_id' => $dam );

              $pedigree = $this->pedigreesModel->update_pedigrees($pedigree, $wherePed);
            }
            else if ($sire != null) {
              $wherePed['ped_canine_id'] = $id;
              $pedigree = array('ped_sire_id' => $sire );

              $pedigree = $this->pedigreesModel->update_pedigrees($pedigree, $wherePed);
            }
            else if ($dam != null) {
              $wherePed['ped_canine_id'] = $id;
              $pedigree = array('ped_mom_id' => $dam );

              $pedigree = $this->pedigreesModel->update_pedigrees($pedigree, $wherePed);
            }
            echo json_encode(array('data' => '1'));
        }
        else{
          echo json_encode(array('data' => 'Dam belum 100 hari'));
        }
      }
      else{
        echo json_encode(array('data' => 'Sire & Dam harus 14 bulan'));
      }
    }

    // public function getFamily($id = null){
    //   $user = $this->session->userdata('user_data');
		// 	$data['users'] = $user;
    //   $data['navigations'] = $this->navigations;
      
    //   if ($this->caninesModel->is_sire($id)){ 
    //     $data['canines'] = $this->caninesModel->get_dam_sibling($id); 
    //   }
    //   else{
    //     $data['canines'] = $this->caninesModel->get_sire_sibling($id); 
    //   }
    //   $this->twig->display('backend/family', $data);
    // }

    public function delete(){
      if ($this->uri->segment(4)){
        if ($this->session->userdata('use_username')){
          $err = 0;
          $where['can_id'] = $this->uri->segment(4);
          $canine = $this->caninesModel->get_canines($where)->row();

          $piece = explode("-", $canine->can_date_of_birth);
          $dob = $piece[2] . "-" . $piece[1] . "-" . $piece[0];

          $data['can_stat'] = $this->config->item('rejected');
          $data['can_app_user'] = $this->session->userdata('use_id');
          $data['can_app_date'] = date('Y-m-d H:i:s');

          $dataLog = array(
            'log_canine_id' => $canine->can_id,
            'log_reg_number' => $canine->can_reg_number,
            'log_a_s' => $canine->can_a_s,
            'log_breed' => $canine->can_breed,
            'log_gender' => $canine->can_gender,
            'log_date_of_birth' => $dob,
            'log_color' => $canine->can_color,
            'log_kennel_id' => $canine->can_kennel_id,
            'log_photo' => $canine->can_photo,
            'log_stat' => $this->config->item('rejected'),
            'log_app_user' => $this->session->userdata('use_id'),
            'log_app_date' => date('Y-m-d H:i:s'),
            'log_chip_number' => $canine->can_chip_number,
            'log_icr_number' => $canine->can_icr_number,
            'log_member_id' => $canine->can_member_id,
            'log_note' => $canine->can_note,
          );

          $this->db->trans_strict(FALSE);
          $this->db->trans_start();
          $res = $this->caninesModel->update_canines($data, $where);
          if ($res){
            $log = $this->logcanineModel->add_log($dataLog);
            if ($log){
              $this->db->trans_complete();
              $this->session->set_flashdata('delete_success', TRUE);
              redirect("backend/Canines");
            }
            else{
              $err = 1;
            }
          }
          else{
            $err = 2;
          }
          if ($err){
            $this->db->trans_rollback();
            $this->session->set_flashdata('error_message', 'Failed to delete canine id = '.$this->uri->segment(4).'. Error code: '.$err);
            redirect('backend/Canines');
          }
        }
        else{
          redirect("backend/Users/login");
        }
      }
      else{
        redirect("backend/Canines");
      }
    }

    public function logs($id = null){
      $user = $this->session->userdata('user_data');
			$data['users'] = $user;
      $data['navigations'] = $this->navigations;
      
      $where['can_id'] = $id;
      $data['canines'] = $this->caninesModel->get_canines($where)->row();
      unset($where);
      
      $where['log_id'] = $id;
      $data['logs'] = $this->logcanineModel->get_logs($where)->result(); 
      $this->twig->display('backend/logsCanines', $data);
    }

    public function request(){
      $user = $this->session->userdata('user_data');
			$data['users'] = $user;
      $data['navigations'] = $this->navigations;

      $this->twig->display('backend/requests', $data);
    }

    public function request_data(){
      $aColumns = array('req_id', 'can_id', 'req_can_id', 'can_a_s', 'req_can_photo', 'can_cage', 'req_can_cage', 'can_address', 'req_can_address', 'can_owner', 'req_can_owner', 'use_username', 'req_app_date', 'req_date', 'stat_name', 'kennels.ken_name', 'kennels.ken_type_id');
      $sTable = 'requests';

      $iDisplayStart = $this->input->get_post('start', true);
      $iDisplayLength = $this->input->get_post('length', true);
      $sSearch = $this->input->post('search', true);
      $sEcho = $this->input->get_post('sEcho', true);
      $columns = $this->input->get_post('columns', true);
      $orders = $this->input->get_post('order', true);

      // Paging
      if(isset($iDisplayStart) && $iDisplayLength != '-1'){
          $this->db->limit($this->db->escape_str($iDisplayLength), $this->db->escape_str($iDisplayStart));
      }

      // Ordering
      if(isset($orders[0]['column'])){
          // for($i=0; $i<intval($columns); $i++){
              // $iSortCol = $this->input->get_post('iSortCol_'.$i, true);
              // $bSortable = $this->input->get_post('bSortable_'.intval($iSortCol), true);
              $bSortable = $columns[$orders[0]['column']]['orderable'];
              // $sSortDir = $this->input->get_post('sSortDir_'.$i, true);

              if($bSortable == 'true')
              {
                  $this->db->order_by($columns[$orders[0]['column']]['data'], $orders[0]['dir']);
                  // $this->db->order_by($aColumns[intval($this->db->escape_str($iSortCol))], $this->db->escape_str($sSortDir));
              }
          // }
      }

      /*
        * Filtering
        * NOTE this does not match the built-in DataTables filtering which does it
        * word by word on any field. It's possible to do here, but concerned about efficiency
        * on very large tables, and MySQL's regex functionality is very limited
        */
      if(isset($sSearch['value']) && !empty($sSearch['value'])){
          for($i=0; $i<count($columns); $i++){
          
              // $bSearchable = $this->input->get_post('bSearchable_'.$i, true);
              $bSearchable = $columns[$i]['searchable'];

              // Individual column filtering
              if(isset($bSearchable) && $bSearchable == 'true')
              {
                  for($j=0; $j<count($aColumns); $j++){
                    $this->db->or_like($aColumns[$j], $this->db->escape_like_str($sSearch['value']));
                  }
              }
          }
      }

      // Select Data
      $this->db->select('SQL_CALC_FOUND_ROWS '.str_replace(' , ', ' ', implode(', ', $aColumns)), false);
      $this->db->join('canines','canines.can_id = requests.req_can_id');
      $this->db->join('users','users.use_id = requests.req_app_user');
      $this->db->join('approval_status','approval_status.stat_id = requests.req_stat');
      $this->db->join('members','members.mem_id = canines.can_member');
      $this->db->join('kennels','kennels.ken_id = members.mem_ken_id');
      $this->db->where('req_stat', 0);
      $this->db->order_by('req_date', 'desc');
      $rResult = $this->db->get($sTable);
      
      // Data set length after filtering
      $this->db->select('FOUND_ROWS() AS found_rows');
      $iFilteredTotal = $this->db->get()->row()->found_rows;

      // Total data set length
      $iTotal = $this->db->count_all($sTable);

      // Output
      $output = array(
          'sEcho' => intval($sEcho),
          'iTotalRecords' => $iTotal,
          'iTotalDisplayRecords' => $iFilteredTotal,
          'aaData' => array()
      );

      foreach($rResult->result_array() as $i => $aRow){
          $row = array();

          // foreach($aColumns as $col){
          // 		if($col == 'stock')
          //     $row[$col] = $aRow[$col];
          // }
          $output['aaData'][] = $aRow;
      }

      echo json_encode($output);
    }

    public function approve_update($id){
        if ($id){
            $whe['req_id'] = $id;
            $req = $this->requestModel->get_requests($whe)->row();

            $where['can_id'] = $req->req_can_id;
            $can = $this->caninesModel->get_can_pedigrees($where)->row();

            $old = '-';
            $photo = '-';
            if ($req->req_can_photo != '-'){
                $photo = $req->req_can_photo;
                $data['can_photo'] = $req->req_can_photo;
                $curr_image = $this->path_upload.basename($can->can_photo);
                if (file_exists($curr_image)){
                    $old = $can->can_photo;
                    unlink($curr_image);
                }
            }

          $cage = '';
          if ($req->req_can_cage){
            $data['can_cage'] = $req->req_can_cage;
            $cage = $can->can_owner." => ".$req->req_can_cage;
          }

          $address = '';
          if ($req->req_can_address){
            $data['can_address'] = $req->req_can_address;
            $address = $can->can_address." => ".$req->req_can_address;
          }

          $owner = '';
          if ($req->req_can_owner){
            $data['can_owner'] = $req->req_can_owner;
            $owner = $can->can_owner." => ".$req->req_can_owner;
          }

          $this->db->trans_strict(FALSE);
          $this->db->trans_start();
          // write log 
          if ($photo != '-' || $owner != '' || $address != '' || $cage != ''){
            $log = array(
              'log_id' => $req->req_can_id,
              'log_owner' => $owner,
              'log_address' => $address,
              'log_cage' => $cage,
              'log_member' => '',
              'log_old_photo' => $old,
              'log_photo' => $photo,
              'log_stat' => 1,
              'log_req' => $req->req_id
            );
            $res = $this->logcanineModel->add_log($log);
            if ($res){
              $this->caninesModel->update_canines($data, $where);
              $res2 = $this->requestModel->update_status($id, 1);
              if ($res2){
                if ($can->mem_id){
                  $res3 = $this->notification_model->add(3, $req->req_can_id, $can->mem_id);

                  $whe_can['mem_id'] = $can->mem_id;
                  $member = $this->memberModel->get_members($whe_can)->row();
                  if ($member->mem_firebase_token){
                    $notif = $this->notificationtype_model->get_by_id(3);
                    $url = 'https://fcm.googleapis.com/fcm/send';
                    $key = 'AAAALe2LeZU:APA91bEqr2n1PRxkOyOfx8IwYO1O_1gjprFkq1AITOGUu3GYp2ZBi-8-AvM4ADI3m94NEv4cq-uKcMBU3pJXBhO21CyuVgPNX2l7VYXj5IllxEr6sika8eaJp1IgXCHALA5_xYw92pXK';
        
                    $fields = array (
                      'to' => $member->mem_firebase_token,
                      'notification' => array(
                        "channelId" => "ICRPedigree",
                        'title' => $notif[0]->title,
                        'body' => $notif[0]->description
                      )
                    );
                    $fields = json_encode ( $fields );
        
                    $headers = array (
                        'Authorization: key=' . $key,
                        'Content-Type: application/json'
                    );
        
                    $ch = curl_init ();
                    curl_setopt ( $ch, CURLOPT_URL, $url );
                    curl_setopt ( $ch, CURLOPT_POST, true );
                    curl_setopt ( $ch, CURLOPT_HTTPHEADER, $headers );
                    curl_setopt ( $ch, CURLOPT_RETURNTRANSFER, true );
                    curl_setopt ( $ch, CURLOPT_POSTFIELDS, $fields );
        
                    $result = curl_exec ( $ch );
                    // echo $result;
                    curl_close ( $ch );
                  }
                }
                $this->db->trans_complete();
                echo json_encode(array('data' => '1'));
              }
              else{
                $this->db->trans_rollback();
                echo json_encode(array('data' => 'Request dengan id = '.$id.' tidak dapat di-approve'));
              }
            }
            else{
              $this->db->trans_rollback();
              echo json_encode(array('data' => 'Gagal menulis ke log'));
            }
          }
          else{
            $this->caninesModel->update_canines($data, $where);

            $res2 = $this->requestModel->update_status($id, 1);
            if ($res2){
              $this->db->trans_complete();
              echo json_encode(array('data' => '1'));
            }
            else{
              $this->db->trans_rollback();
              echo json_encode(array('data' => 'Request dengan id = '.$id.' tidak dapat di-approve'));
            }
          }
        }
    }

    public function reject_update($id = null){
      if ($id){
        $this->db->trans_strict(FALSE);
        $this->db->trans_start();
        $res = $this->requestModel->update_status($id, 2);
        if ($res){
          $whe['req_id'] = $id;
          $req = $this->requestModel->get_requests($whe)->row();

          $where['can_id'] = $req->req_can_id;
          $can = $this->caninesModel->get_can_pedigrees($where)->row();
          
          if ($can->mem_id){
            $result = $this->notification_model->add(8, $id, $can->mem_id);

            $whe_can['mem_id'] = $can->mem_id;
            $member = $this->memberModel->get_members($whe_can)->row();
            if ($member->mem_firebase_token){
              $notif = $this->notificationtype_model->get_by_id(8);
              $url = 'https://fcm.googleapis.com/fcm/send';
              $key = 'AAAALe2LeZU:APA91bEqr2n1PRxkOyOfx8IwYO1O_1gjprFkq1AITOGUu3GYp2ZBi-8-AvM4ADI3m94NEv4cq-uKcMBU3pJXBhO21CyuVgPNX2l7VYXj5IllxEr6sika8eaJp1IgXCHALA5_xYw92pXK';
  
              $fields = array (
                'to' => $member->mem_firebase_token,
                'notification' => array(
                  "channelId" => "ICRPedigree",
                  'title' => $notif[0]->title,
                  'body' => $notif[0]->description
                )
              );
              $fields = json_encode ( $fields );
  
              $headers = array (
                  'Authorization: key=' . $key,
                  'Content-Type: application/json'
              );
  
              $ch = curl_init ();
              curl_setopt ( $ch, CURLOPT_URL, $url );
              curl_setopt ( $ch, CURLOPT_POST, true );
              curl_setopt ( $ch, CURLOPT_HTTPHEADER, $headers );
              curl_setopt ( $ch, CURLOPT_RETURNTRANSFER, true );
              curl_setopt ( $ch, CURLOPT_POSTFIELDS, $fields );
  
              $result = curl_exec ( $ch );
              // echo $result;
              curl_close ( $ch );
            }
          }
          $this->db->trans_complete();
          echo json_encode(array('data' => '1'));
        }
        else{
          $this->db->trans_rollback();
          echo json_encode(array('data' => 'Request dengan id = '.$id.' tidak dapat di-reject'));
        }
      }
    }

    public function logs_request(){
      $user = $this->session->userdata('user_data');
			$data['users'] = $user;
      $data['navigations'] = $this->navigations;
      
      $this->twig->display('backend/logsRequest', $data);
    }

    public function data_logs_request(){
      $aColumns = array('log_owner', 'log_address', 'log_cage', 'log_tanggal', 'log_old_photo', 'log_photo', 'req_app_date', 'can_a_s', 'stat_name', 'use_username', 'kennels.ken_name', 'kennels.ken_type_id');
      $sTable = 'logs_canine';

      $iDisplayStart = $this->input->get_post('start', true);
      $iDisplayLength = $this->input->get_post('length', true);
      $sSearch = $this->input->post('search', true);
      $sEcho = $this->input->get_post('sEcho', true);
      $columns = $this->input->get_post('columns', true);
      $orders = $this->input->get_post('order', true);

      // Paging
      if(isset($iDisplayStart) && $iDisplayLength != '-1'){
          $this->db->limit($this->db->escape_str($iDisplayLength), $this->db->escape_str($iDisplayStart));
      }

      // Ordering
      if(isset($orders[0]['column'])){
          // for($i=0; $i<intval($columns); $i++){
              // $iSortCol = $this->input->get_post('iSortCol_'.$i, true);
              // $bSortable = $this->input->get_post('bSortable_'.intval($iSortCol), true);
              $bSortable = $columns[$orders[0]['column']]['orderable'];
              // $sSortDir = $this->input->get_post('sSortDir_'.$i, true);

              if($bSortable == 'true')
              {
                  $this->db->order_by($columns[$orders[0]['column']]['data'], $orders[0]['dir']);
                  // $this->db->order_by($aColumns[intval($this->db->escape_str($iSortCol))], $this->db->escape_str($sSortDir));
              }
          // }
      }

      /*
        * Filtering
        * NOTE this does not match the built-in DataTables filtering which does it
        * word by word on any field. It's possible to do here, but concerned about efficiency
        * on very large tables, and MySQL's regex functionality is very limited
        */
      if(isset($sSearch['value']) && !empty($sSearch['value'])){
          for($i=0; $i<count($columns); $i++){
          
              // $bSearchable = $this->input->get_post('bSearchable_'.$i, true);
              $bSearchable = $columns[$i]['searchable'];

              // Individual column filtering
              if(isset($bSearchable) && $bSearchable == 'true')
              {
                  for($j=0; $j<count($aColumns); $j++){
                    $this->db->or_like($aColumns[$j], $this->db->escape_like_str($sSearch['value']));
                  }
              }
          }
      }

      // Select Data
      $this->db->select('SQL_CALC_FOUND_ROWS '.str_replace(' , ', ' ', implode(', ', $aColumns)), false);
      $this->db->join('canines','canines.can_id = logs_canine.log_id');
      $this->db->join('requests','requests.req_id = logs_canine.log_req');
      $this->db->join('users','users.use_id = requests.req_app_user');
      $this->db->join('approval_status','approval_status.stat_id = requests.req_stat');
      $this->db->join('members','members.mem_id = canines.can_member');
      $this->db->join('kennels','kennels.ken_id = members.mem_ken_id');
      $this->db->where('log_stat', 1);
      $this->db->where('req_stat <> ', 0);
      $this->db->order_by('log_tanggal', 'desc');
      $rResult = $this->db->get($sTable);
      
      // Data set length after filtering
      $this->db->select('FOUND_ROWS() AS found_rows');
      $iFilteredTotal = $this->db->get()->row()->found_rows;

      // Total data set length
      $iTotal = $this->db->count_all($sTable);

      // Output
      $output = array(
          'sEcho' => intval($sEcho),
          'iTotalRecords' => $iTotal,
          'iTotalDisplayRecords' => $iFilteredTotal,
          'aaData' => array()
      );

      foreach($rResult->result_array() as $i => $aRow){
          $row = array();

          // foreach($aColumns as $col){
          // 		if($col == 'stock')
          //     $row[$col] = $aRow[$col];
          // }
          $output['aaData'][] = $aRow;
      }

      echo json_encode($output);
    }

  public function approve_canine(){
    if ($this->uri->segment(4)){
      if ($this->session->userdata('use_username')){
        $err = 0;
        $where['can_id'] = $this->uri->segment(4);
        $can = $this->caninesModel->get_canines($where)->row();
        $this->db->trans_strict(FALSE);
        $this->db->trans_start();
        $data['can_app_user'] = $this->session->userdata('use_id');
        $data['can_app_date'] = date('Y-m-d H:i:s');
        $data['can_stat'] = $this->config->item('accepted');
        $res = $this->caninesModel->update_canines($data, $where);
        if ($res){
          $piece = explode("-", $can->can_date_of_birth);
          $dob = $piece[2] . "-" . $piece[1] . "-" . $piece[0];

          $dataLog = array(
            'log_canine_id' => $this->uri->segment(4),
            'log_reg_number' => $can->can_reg_number,
            'log_a_s' => $can->can_a_s,
            'log_breed' => $can->can_breed,
            'log_gender' => $can->can_gender,
            'log_date_of_birth' => $dob,
            'log_color' => $can->can_color,
            'log_kennel_id' => $can->can_kennel_id,
            'log_photo' => $can->can_photo,
            'log_stat' => $this->config->item('accepted'),
            'log_app_user' => $this->session->userdata('use_id'),
            'log_app_date' => date('Y-m-d H:i:s'),
            'log_chip_number' => $can->can_chip_number,
            'log_icr_number' => $can->can_icr_number,
            'log_member_id' => $can->can_member_id,
            'log_note' => $can->can_note,
          );
          $log = $this->logcanineModel->add_log($dataLog);
          if ($log){
            $dataLogPed = array(
              'log_sire_id' => $this->config->item('sire_id'),
              'log_dam_id' => $this->config->item('dam_id'),
              'log_canine_id' => $this->uri->segment(4),
              'log_stat' => $this->config->item('accepted'),
              'log_app_user' => $this->session->userdata('use_id'),
              'log_app_date' => date('Y-m-d H:i:s'),
            );
            $res = $this->logpedigreeModel->add_log($dataLogPed);
            if ($res){
              $res3 = $this->notification_model->add(11, $this->uri->segment(4), $can->can_member_id);
              if ($res3){
                $this->db->trans_complete();
                $whe_can['mem_id'] = $can->can_member_id;
                $member = $this->memberModel->get_members($whe_can)->row();
                if ($member->mem_firebase_token){
                  $notif = $this->notificationtype_model->get_by_id(11);
                  $url = 'https://fcm.googleapis.com/fcm/send';
                  $key = 'AAAALe2LeZU:APA91bEqr2n1PRxkOyOfx8IwYO1O_1gjprFkq1AITOGUu3GYp2ZBi-8-AvM4ADI3m94NEv4cq-uKcMBU3pJXBhO21CyuVgPNX2l7VYXj5IllxEr6sika8eaJp1IgXCHALA5_xYw92pXK';

                  $fields = array (
                    'to' => $member->mem_firebase_token,
                    'notification' => array(
                      "channelId" => "ICRPedigree",
                      'title' => $notif[0]->title,
                      'body' => $notif[0]->description
                    )
                  );
                  $fields = json_encode ( $fields );

                  $headers = array (
                      'Authorization: key=' . $key,
                      'Content-Type: application/json'
                  );

                  $ch = curl_init ();
                  curl_setopt ( $ch, CURLOPT_URL, $url );
                  curl_setopt ( $ch, CURLOPT_POST, true );
                  curl_setopt ( $ch, CURLOPT_HTTPHEADER, $headers );
                  curl_setopt ( $ch, CURLOPT_RETURNTRANSFER, true );
                  curl_setopt ( $ch, CURLOPT_POSTFIELDS, $fields );

                  $result = curl_exec ( $ch );
                  // echo $result;
                  curl_close ( $ch );
                }
                $this->session->set_flashdata('approve', TRUE);
                redirect('backend/Canines/view_approve');
              }
              else{
                $err = 1;
              }
            }
            else{
              $err = 2;
            }
          }
          else{
            $serr = 3;
          }
        }
        else{
          $err = 4;
        }
        if ($err){
          $this->db->trans_rollback();
          $this->session->set_flashdata('error_message', 'Failed to approve canine id = '.$this->uri->segment(4).'. Err code: '.$err);
          redirect('backend/Canines/view_approve');
        }
      }
      else{
        redirect("backend/Users/login");
      }
    }
    else{
      redirect("backend/Canines/view_approve");
    }
  }

  public function reject_canine(){
    if ($this->uri->segment(4)){
      if ($this->session->userdata('use_username')){
        $where['can_id'] = $this->uri->segment(4);
        $can = $this->caninesModel->get_canines($where)->row();
        $this->db->trans_strict(FALSE);
        $this->db->trans_start();
        $data['can_app_user'] = $this->session->userdata('use_id');
        $data['can_app_date'] = date('Y-m-d H:i:s');
        $data['can_stat'] = $this->config->item('rejected');
        $res = $this->caninesModel->update_canines($data, $where);
        if ($res){
          $err = 0;
          $res2 = $this->notification_model->add(12, $this->uri->segment(4), $can->can_member_id);
          if ($res2){
            $piece = explode("-", $can->can_date_of_birth);
            $dob = $piece[2] . "-" . $piece[1] . "-" . $piece[0];
            $dataLog = array(
              'log_canine_id' => $can->can_id,
              'log_reg_number' => $can->can_reg_number,
              'log_a_s' => $can->can_a_s,
              'log_breed' => $can->can_breed,
              'log_gender' => $can->can_gender,
              'log_date_of_birth' => $dob,
              'log_color' => $can->can_color,
              'log_kennel_id' => $can->can_kennel_id,
              'log_photo' => $can->can_photo,
              'log_stat' => $this->config->item('rejected'),
              'log_app_user' => $this->session->userdata('use_id'),
              'log_app_date' => date('Y-m-d H:i:s'),
              'log_chip_number' => $can->can_chip_number,
              'log_icr_number' => $can->can_icr_number,
              'log_member_id' => $can->can_member_id,
              'log_note' => $can->can_note,
            );
            $log = $this->logcanineModel->add_log($dataLog);
            if ($log){
              $this->db->trans_complete();
              $whe_can['mem_id'] = $can->can_member_id;
              $member = $this->memberModel->get_members($whe_can)->row();
              if ($member->mem_firebase_token){
                $notif = $this->notificationtype_model->get_by_id(12);
                $url = 'https://fcm.googleapis.com/fcm/send';
                $key = 'AAAALe2LeZU:APA91bEqr2n1PRxkOyOfx8IwYO1O_1gjprFkq1AITOGUu3GYp2ZBi-8-AvM4ADI3m94NEv4cq-uKcMBU3pJXBhO21CyuVgPNX2l7VYXj5IllxEr6sika8eaJp1IgXCHALA5_xYw92pXK';

                $fields = array (
                  'to' => $member->mem_firebase_token,
                  'notification' => array(
                    "channelId" => "ICRPedigree",
                    'title' => $notif[0]->title,
                    'body' => $notif[0]->description
                  )
                );
                $fields = json_encode ( $fields );

                $headers = array (
                    'Authorization: key=' . $key,
                    'Content-Type: application/json'
                );

                $ch = curl_init ();
                curl_setopt ( $ch, CURLOPT_URL, $url );
                curl_setopt ( $ch, CURLOPT_POST, true );
                curl_setopt ( $ch, CURLOPT_HTTPHEADER, $headers );
                curl_setopt ( $ch, CURLOPT_RETURNTRANSFER, true );
                curl_setopt ( $ch, CURLOPT_POSTFIELDS, $fields );

                $result = curl_exec ( $ch );
                // echo $result;
                curl_close ( $ch );
              }
              $this->session->set_flashdata('reject', TRUE);
              redirect('backend/Canines/view_approve');
            }
            else{
              $err = 1;
            }
          }
          else{
            $err = 2;
          }
        }
        else{
          $err = 3;
        }
        if ($err){
          $this->db->trans_rollback();
          $this->session->set_flashdata('error_message', 'Failed to reject canine id = '.$this->uri->segment(4));
          redirect('backend/Canines/view_approve');
        }
      }
      else{
        redirect("backend/Users/login");
      }
    }
    else{
      redirect("backend/Canines/view_approve");
    }
  }
}
