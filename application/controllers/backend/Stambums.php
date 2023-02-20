<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Stambums extends CI_Controller {
    public function __construct(){
        // Call the CI_Controller constructor
        parent::__construct();
        $this->load->model(array('stambumModel', 'caninesModel','memberModel', 'notification_model', 'notificationtype_model', 'pedigreesModel', 'kennelModel', 'birthModel', 'studModel', 'logcanineModel', 'logpedigreeModel', 'logstambumModel'));
        $this->load->library('upload', $this->config->item('upload_canine'));
        $this->load->library(array('session', 'form_validation'));
        $this->load->helper(array('url', 'mail', 'notif'));
        $this->load->database();
        date_default_timezone_set("Asia/Bangkok");
    }

    public function test_input($data) {
			$data = trim($data);
			$data = stripslashes($data);
			$data = htmlspecialchars($data);
			return $data;
		}

    public function index(){
        $where['stb_stat'] = $this->config->item('accepted');
        $data['stambum'] = $this->stambumModel->get_stambum($where, 'stb_a_s')->result();
        $this->load->view('backend/view_stambums', $data);
    }

    public function search(){
        $like['stb_a_s'] = $this->input->post('keywords');
        $like['ken_name'] = $this->input->post('keywords');
        $where['stb_stat'] = $this->config->item('accepted');
        $data['stambum'] = $this->stambumModel->search_stambum($like, $where, 'stb_a_s')->result();
        $this->load->view('backend/view_stambums', $data);
    }

    public function view_approve(){
        $where['stb_stat'] = $this->config->item('saved');
        $data['stambum'] = $this->stambumModel->get_stambum($where, 'stb_a_s')->result();
        $this->load->view('backend/approve_stambums', $data);
    }
    
    public function search_approve(){
        $like['stb_a_s'] = $this->input->post('keywords');
        $like['ken_name'] = $this->input->post('keywords');
        $where['stb_stat'] = $this->config->item('saved');
        $data['stambum'] = $this->stambumModel->search_stambum($like, $where, 'stb_a_s')->result();
        $this->load->view('backend/approve_stambums', $data);
		}

    public function add(){
        if ($this->uri->segment(4)){  
          if ($this->session->userdata('use_id')){
            $wheBirth['bir_id'] = $this->uri->segment(4);
            $data['birth'] = $this->birthModel->get_births($wheBirth)->row();
            $wheStud['stu_id'] = $data['birth']->bir_stu_id;
            $data['stud'] = $this->studModel->get_studs($wheStud)->row();
            $wheMember['mem_id IN ('.$data['stud']->stu_member_id.', '.$data['stud']->stu_partner_id.')'] = null;
            $data['member'] = $this->memberModel->get_members($wheMember)->result();
            $whe['ken_member_id'] =  $data['member'][0]->mem_id;
            $whe['ken_stat'] = $this->config->item('accepted');
            $data['kennel'] = $this->kennelModel->get_kennels($whe)->result();
            $data['kennel_id'] = $data['kennel'][0]->ken_id;
            $data['mode'] = 0;
            $this->load->view('backend/add_stambum', $data);
          }
          else{
            redirect("backend/Users/login");
          }
        }
        else{
          redirect("backend/Stambums");
        }
    }

    public function search_member(){
      if ($this->session->userdata('use_id')) {
        $like['mem_name'] = $this->input->post('mem_name');
        $like['ken_name'] = $this->input->post('mem_name');
        $where['mem_stat'] = $this->config->item('accepted');
        $data['member'] = $this->memberModel->search_members($like, $where)->result();

        if ($data['member']){
          $whe['ken_member_id'] =  $data['member'][0]->mem_id;
          $whe['ken_stat'] = $this->config->item('accepted');
          $data['kennel'] = $this->kennelModel->get_kennels($whe)->result();
          if ($data['kennel'])
            $data['kennel_id'] = $data['kennel'][0]->ken_id;
          else
            $data['kennel_id'] = 0;
        }
        else{
          $data['kennel'] = [];
          $data['kennel_id'] = 0;
        }
        $data['mode'] = 1;
        $this->load->view('backend/add_stambum', $data);
      }
      else {
        redirect("backend/Users/login");
      }
    }

    public function search_kennel(){
        if ($this->session->userdata('use_id')) {
          $like['mem_name'] = $this->input->post('mem_name');
          $like['ken_name'] = $this->input->post('mem_name');
          $where['mem_stat'] = $this->config->item('accepted');
          $data['member'] = $this->memberModel->search_members($like, $where)->result();

          $whe['ken_member_id'] =  $this->input->post('stb_member_id');
          $whe['ken_stat'] = $this->config->item('accepted');
          $data['kennel'] = $this->kennelModel->get_kennels($whe)->result();
          if ($data['kennel'])
            $data['kennel_id'] = $data['kennel'][0]->ken_id;
          else
            $data['kennel_id'] = 0;
          $data['mode'] = 1;
          $this->load->view('backend/add_stambum', $data);
        }
        else {
          redirect("backend/Users/login");
        }
    }
  
    public function validate_add(){ 
        if ($this->session->userdata('use_id')) {
          $this->form_validation->set_error_delimiters('<div>', '</div>');
          $this->form_validation->set_rules('stb_bir_id', 'Birth id ', 'trim|required');
          if ($this->input->post('reg_member')){
            $this->form_validation->set_rules('stb_member_id', 'Member id ', 'trim|required');
            $this->form_validation->set_rules('stb_kennel_id', 'Kennel id ', 'trim|required');
          }
          else{
            $this->form_validation->set_rules('name', 'Member name ', 'trim|required');
            $this->form_validation->set_rules('hp', 'Phone number ', 'trim|required');
            $this->form_validation->set_rules('email', 'email ', 'trim|required');
          }
          $this->form_validation->set_rules('stb_a_s', 'Canine name ', 'trim|required');
          
          $like['mem_name'] = $this->input->post('mem_name');
          $like['ken_name'] = $this->input->post('mem_name');
          $where['mem_stat'] = $this->config->item('accepted');
          $data['member'] = $this->memberModel->search_members($like, $where)->result();

          $whe['ken_member_id'] =  $this->input->post('stb_member_id');
          $whe['ken_stat'] = $this->config->item('accepted');
          $data['kennel'] = $this->kennelModel->get_kennels($whe)->result();
          if ($data['kennel'])
            $data['kennel_id'] = $data['kennel'][0]->ken_id;
          else
            $data['kennel_id'] = 0;
          $data['mode'] = 1;
            
          if ($this->form_validation->run() == FALSE) {
            $this->load->view('backend/add_stambum', $data);
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

            // cek jumlah male & female
            $wheBirth['bir_id'] = $this->input->post('stb_bir_id');
            $birth = $this->birthModel->get_births($wheBirth)->row();
            if ($this->input->post('stb_gender') == 'MALE'){
              $wheStbMale['stb_bir_id'] = $this->input->post('stb_bir_id');
              $wheStbMale['stb_gender'] = 'MALE';
              $wheStbMale['stb_stat'] = $this->config->item('accepted');
              $male = $this->stambumModel->get_count($wheStbMale);
              if ($male >= $birth->bir_male){
                $err++;
                $this->session->set_flashdata('error_message', 'Male puppy is full');
              }
            }
            else{
              $wheStbFemale['stb_bir_id'] = $this->input->post('stb_bir_id');
              $wheStbFemale['stb_gender'] = 'FEMALE';
              $wheStbFemale['stb_stat'] = $this->config->item('accepted');
              $female = $this->stambumModel->get_count($wheStbFemale);
              if ($female >= $birth->bir_female){
                $err++;
                $this->session->set_flashdata('error_message', 'Female puppy is full');
              }
            }

            if (!$err) {
              $wheStud['stu_id'] = $birth->bir_stu_id;
              $stud = $this->studModel->get_studs($wheStud)->row();
              $wheDam['can_id'] = $stud->stu_dam_id;
              $dam = $this->caninesModel->get_canines($wheDam)->row();
              $wheKennel['mem_id'] = $stud->stu_partner_id;
              $kennel = $this->memberModel->get_members($wheKennel)->row();

              $this->db->trans_strict(FALSE);
              $this->db->trans_start();
              if ($this->input->post('reg_member')){
                $wheMember['mem_id'] = $this->input->post('stb_member_id');
                $member = $this->memberModel->get_members($wheMember)->row();
              }
              else{
                $email = $this->test_input($this->input->post('email'));
                if (!$err && !filter_var($email, FILTER_VALIDATE_EMAIL)) {
                  $err++;
                  $this->session->set_flashdata('error_message', 'Invalid email format');
                }

                if (!$err && $this->memberModel->check_for_duplicate(0, 'mem_hp', $this->input->post('hp'))){
                  $err++;
                  $this->session->set_flashdata('error_message', 'Duplicate phone number');
                }

                if (!$err && $this->memberModel->check_for_duplicate(0, 'mem_email', $this->input->post('email'))){
                  $err++;
                  $this->session->set_flashdata('error_message', 'Duplicate email');
                }

                if (!$err){
                  $mem_id = $this->memberModel->record_count() + 1;
                  $member_data = array(
                    'mem_id' => $mem_id,
                    'mem_name' => strtoupper($this->input->post('name')),
                    'mem_hp' => $this->input->post('hp'),
                    'mem_email' => $this->input->post('email'),
                    'mem_username' => $this->input->post('email'),
                    'mem_password' => sha1($this->input->post('hp')),
                    'mem_stat' => $this->config->item('accepted'),
                    'mem_type' => $this->config->item('free_member'),
                    'mem_user' => $this->session->userdata('use_id'),
                    'mem_date' => date('Y-m-d H:i:s'),
                  );
      
                  $ken_id = $this->kennelModel->record_count() + 1;
                  $kennel_data = array(
                    'ken_id' => $ken_id,
                    'ken_name' => '',
                    'ken_type_id' => 0,
                    'ken_photo' => '-',
                    'ken_member_id' => $mem_id,
                    'ken_stat' => $this->config->item('accepted'),
                    'ken_user' => $this->session->userdata('use_id'),
                    'ken_date' => date('Y-m-d H:i:s'),
                  );
                    
                  $id = $this->memberModel->add_members($member_data);
                  if ($id){
                    $res = $this->kennelModel->add_kennels($kennel_data);
                    if ($res){
                      $result = $this->notification_model->add(17, $mem_id, $mem_id);
                      if (!$result){
                        $err = 'M1';
                      }
                    }
                    else{
                      $err = 'M2';
                    }
                  }
                  else{
                    $err = 'M3';
                  }
                }
              }
              
              if (!$err){
                $piece = explode("-", $birth->bir_date_of_birth);
                $dob = $piece[2] . "-" . $piece[1] . "-" . $piece[0];

                $id = $this->caninesModel->record_count() + 895; // gara2 data canine dihapus
                $dataCan = array(
                  'can_id' => $id,
                  'can_reg_number' => '-',
                  'can_breed' => $dam->can_breed,
                  'can_gender' => $this->input->post('stb_gender'),
                  'can_date_of_birth' => $dob,
                  'can_color' => '-',
                  'can_reg_date' => date("Y/m/d"),
                  'can_photo' => $photo,
                  'can_stat' => $this->config->item('accepted'),
                  'can_app_user' => $this->session->userdata('use_id'),
                  'can_app_date' => date('Y-m-d H:i:s'),
                  'can_chip_number' => '-',
                  'can_icr_number' => '-',
                  'can_note' => '',
                  'can_user' => $this->session->userdata('use_id'),
                  'can_date' => date('Y-m-d H:i:s'),
                );

                // nama diubah berdasarkan kennel
                if ($kennel->ken_type_id == 1)
                  $dataCan['can_a_s'] = strtoupper($this->input->post('stb_a_s'))." VON ".$kennel->ken_name;
                else if ($kennel->ken_type_id == 2)
                  $dataCan['can_a_s'] = $kennel->ken_name."` ".strtoupper($this->input->post('stb_a_s'));
                else 
                  $dataCan['can_a_s'] = strtoupper($this->input->post('stb_a_s'));

                if (!$err && $this->caninesModel->check_for_duplicate(0, 'can_a_s', $dataCan['can_a_s'])){
                  $err++;
                  $this->session->set_flashdata('error_message', 'Duplicate canine name');
                }

                if (!$err) {
                  $dataLog = array(
                    'log_canine_id' => $id,
                    'log_reg_number' => '-',
                    'log_a_s' => $dataCan['can_a_s'],
                    'log_breed' => $dam->can_breed,
                    'log_gender' => $this->input->post('stb_gender'),
                    'log_date_of_birth' => $dob,
                    'log_color' => '-',
                    'log_photo' => $photo,
                    'log_stat' => $this->config->item('accepted'),
                    'log_app_user' => $this->session->userdata('use_id'),
                    'log_app_date' => date('Y-m-d H:i:s'),
                    'log_chip_number' => '-',
                    'log_icr_number' => '-',
                    'log_note' => '',
                    'log_user' => $this->session->userdata('use_id'),
                    'log_date' => date('Y-m-d H:i:s'),
                  );
  
                  $dataStb = array(
                    'stb_bir_id' => $this->input->post('stb_bir_id'),
                    'stb_a_s' => $dataCan['can_a_s'],
                    'stb_breed' => $dam->can_breed,
                    'stb_gender' => $this->input->post('stb_gender'),
                    'stb_date_of_birth' => $dob,
                    'stb_reg_date' => date("Y/m/d"),
                    'stb_photo' => $photo,
                    'stb_stat' => $this->config->item('accepted'),
                    'stb_app_user' => $this->session->userdata('use_id'),
                    'stb_app_date' => date('Y-m-d H:i:s'),
                    'stb_user' => $this->session->userdata('use_id'),
                    'stb_date' => date('Y-m-d H:i:s'),
                    'stb_can_id' => $id,
                  );
  
                  $dataLogStb = array(
                    'log_bir_id' => $this->input->post('stb_bir_id'),
                    'log_a_s' => $dataCan['can_a_s'],
                    'log_breed' => $dam->can_breed,
                    'log_gender' => $this->input->post('stb_gender'),
                    'log_date_of_birth' => $dob,
                    'log_photo' => $photo,
                    'log_stat' => $this->config->item('accepted'),
                    'log_app_user' => $this->session->userdata('use_id'),
                    'log_app_date' => date('Y-m-d H:i:s'),
                    'log_user' => $this->session->userdata('use_id'),
                    'log_date' => date('Y-m-d H:i:s'),
                    'log_can_id' => $id,
                  );

                  if ($this->input->post('reg_member')){
                    $dataCan['can_member_id'] = $this->input->post('stb_member_id');
                    $dataCan['can_kennel_id'] = $this->input->post('stb_kennel_id');
                    $dataLog['log_member_id'] = $this->input->post('stb_member_id');
                    $dataLog['log_kennel_id'] = $this->input->post('stb_kennel_id');
                    $dataStb['stb_member_id'] = $this->input->post('stb_member_id');
                    $dataStb['stb_kennel_id'] = $this->input->post('stb_kennel_id');
                    $dataLogStb['log_member_id'] = $this->input->post('stb_member_id');
                    $dataLogStb['log_kennel_id'] = $this->input->post('stb_kennel_id');
                  }
                  else{
                    $dataCan['can_member_id'] = $mem_id;
                    $dataCan['can_kennel_id'] = $ken_id;
                    $dataLog['log_member_id'] = $mem_id;
                    $dataLog['log_kennel_id'] = $ken_id;
                    $dataStb['stb_member_id'] = $mem_id;
                    $dataStb['stb_kennel_id'] = $ken_id;
                    $dataLogStb['log_member_id'] = $mem_id;
                    $dataLogStb['log_kennel_id'] = $ken_id;
                  }

                  $dataPed = array(
                    'ped_sire_id' => $stud->stu_sire_id,
                    'ped_dam_id' => $stud->stu_dam_id,
                    'ped_canine_id' => $id,
                  );
  
                  $dataLogPed = array(
                    'log_sire_id' => $stud->stu_sire_id,
                    'log_dam_id' => $stud->stu_dam_id,
                    'log_canine_id' => $id,
                    'log_user' => $this->session->userdata('use_id'),
                    'log_date' => date('Y-m-d H:i:s'),
                  );

                  $canines = $this->caninesModel->add_canines($dataCan);
                  if ($canines) {
                    $pedigree = $this->pedigreesModel->add_pedigrees($dataPed);
                    if ($pedigree) {
                      $log = $this->logcanineModel->add_log($dataLog);
                      if ($log){
                        $res = $this->logpedigreeModel->add_log($dataLogPed);
                        if ($res){
                          $result = $this->stambumModel->add_stambum($dataStb);
                          if ($result){
                            $dataLogStb['log_stb_id'] = $result;
                            $log = $this->logstambumModel->add_log($dataLogStb);
                            if ($log){
                              if ($this->input->post('reg_member')){
                                $result = $this->notification_model->add(18, $result, $this->input->post('stb_member_id'));
                                if ($result){
                                  $this->db->trans_complete();
                                  if ($member->mem_firebase_token){
                                    $notif = $this->notificationtype_model->get_by_id(18);
                                    firebase_notif($member->mem_firebase_token, $notif[0]->title, $notif[0]->description);
                                  }
                                  $this->session->set_flashdata('add_success', true);
                                  redirect("backend/Stambums");
                                }
                                else{
                                  $err = 1;
                                }
                              }
                              else{
                                $result = $this->notification_model->add(18, $result, $mem_id);
                                if ($result){
                                  $this->db->trans_complete();
                                  $mail = send_greeting($this->input->post('email'));
                                  $this->session->set_flashdata('add_success', true);
                                  redirect("backend/Stambums");
                                }
                                else{
                                  $err = 1;
                                }
                              }
                            }
                            else{
                              $err = 2;
                            }
                          }
                          else{
                            $err = 3;
                          }
                        }
                        else{
                          $err = 4;
                        }
                      }
                      else{
                        $err = 5;
                      }
                    } else {
                      $err = 6;
                    }
                  } else {
                    $err = 7;
                  }
                  if ($err) {
                    $this->db->trans_rollback();
                    $this->session->set_flashdata('error_message', 'Failed to save puppy. Error code: '.$err);
                    $this->load->view('backend/add_stambum', $data);
                  }
                } else {
                  $this->load->view('backend/add_stambum', $data);
                }
              }
              else{
                $this->load->view('backend/add_stambum', $data);
              }
            } else {
              $this->load->view('backend/add_stambum', $data);
            }
          }
        } 
        else {
          redirect("backend/Users/login");
        }
  }

  public function approve(){
    if ($this->uri->segment(4)){
      if ($this->session->userdata('use_id')){
        $err = 0;
        $whereStb['stb_id'] = $this->uri->segment(4);
        $stb = $this->stambumModel->get_stambum($whereStb)->row();
        
        $piece = explode("-", $stb->stb_date_of_birth);
        $dob = $piece[2] . "-" . $piece[1] . "-" . $piece[0];

        $this->db->trans_strict(FALSE);
        $this->db->trans_start();
        $dataStb = array(
          'stb_stat' => $this->config->item('accepted'),
          'stb_app_user' => $this->session->userdata('use_id'),
          'stb_app_date' => date('Y-m-d H:i:s'),
          'stb_user' => $this->session->userdata('use_id'),
          'stb_date' => date('Y-m-d H:i:s'),
        );
        $res = $this->stambumModel->update_stambum($dataStb, $whereStb);
        if ($res){
          $dataLogStb = array(
            'log_stb_id' => $stb->stb_id,
            'log_bir_id' => $stb->stb_bir_id,
            'log_a_s' => $stb->stb_a_s,
            'log_breed' => $stb->stb_breed,
            'log_gender' => $stb->stb_gender,
            'log_date_of_birth' => $dob,
            'log_photo' => $stb->stb_photo,
            'log_stat' => $this->config->item('accepted'),
            'log_app_user' => $this->session->userdata('use_id'),
            'log_app_date' => date('Y-m-d H:i:s'),
            'log_user' => $this->session->userdata('use_id'),
            'log_date' => date('Y-m-d H:i:s'),
            'log_can_id' => $stb->stb_can_id,
          );
          $log = $this->logstambumModel->add_log($dataLogStb);
          if ($log){
            $whereCan['can_id'] = $stb->stb_can_id;
            $can = $this->caninesModel->get_canines($whereCan)->row();
            
            $dataCan['can_app_user'] = $this->session->userdata('use_id');
            $dataCan['can_app_date'] = date('Y-m-d H:i:s');
            $dataCan['can_user'] = $this->session->userdata('use_id');
            $dataCan['can_date'] = date('Y-m-d H:i:s');
            $dataCan['can_stat'] = $this->config->item('accepted');
            $res = $this->caninesModel->update_canines($dataCan, $whereCan);
            if ($res){
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
                'log_stat' => $this->config->item('accepted'),
                'log_app_user' => $this->session->userdata('use_id'),
                'log_app_date' => date('Y-m-d H:i:s'),
                'log_chip_number' => $can->can_chip_number,
                'log_icr_number' => $can->can_icr_number,
                'log_member_id' => $can->can_member_id,
                'log_note' => $can->can_note,
                'log_user' => $this->session->userdata('use_id'),
                'log_date' => date('Y-m-d H:i:s'),
              );
              $log = $this->logcanineModel->add_log($dataLog);
              if ($log){
                $whePed['ped_canine_id'] = $can->can_id;
                $ped = $this->pedigreesModel->get_pedigrees($whePed)->row();
                $dataLogPed = array(
                  'log_sire_id' => $ped->ped_sire_id,
                  'log_dam_id' => $ped->ped_dam_id,
                  'log_canine_id' => $can->can_id,
                  'log_user' => $this->session->userdata('use_id'),
                  'log_date' => date('Y-m-d H:i:s'),
                );
                $res = $this->logpedigreeModel->add_log($dataLogPed);
                if ($res){
                  $res = $this->notification_model->add(4, $this->uri->segment(4), $stb->stb_member_id);
                  if ($res){
                    $this->db->trans_complete();
                    $whereMember['mem_id'] = $stb->stb_member_id;
                    $member = $this->memberModel->get_members($whereMember)->row();
                    if ($member->mem_firebase_token){
                      $notif = $this->notificationtype_model->get_by_id(4);
                      firebase_notif($member->mem_firebase_token, $notif[0]->title, $notif[0]->description);
                    }
                    $this->session->set_flashdata('approve', TRUE);
                    redirect('backend/Stambums/view_approve');
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
          }
          else{
            $err = 5;
          }
        }
        else{
          $err = 6;
        }
        if ($err){
          $this->db->trans_rollback();
          $this->session->set_flashdata('error_message', 'Failed to approve puppy id = '.$this->uri->segment(4).'. Err code: '.$err);
          redirect('backend/Stambums/view_approve');
        }
      }
      else{
        redirect("backend/Users/login");
      }
    }
    else{
      redirect("backend/Stambums/view_approve");
    }
  }

  public function reject(){
    if ($this->uri->segment(4)){
      if ($this->session->userdata('use_id')){
        $whereStb['stb_id'] = $this->uri->segment(4);
        $stb = $this->stambumModel->get_stambum($whereStb)->row();
        
        $piece = explode("-", $stb->stb_date_of_birth);
        $dob = $piece[2] . "-" . $piece[1] . "-" . $piece[0];

        $this->db->trans_strict(FALSE);
        $this->db->trans_start();
        $dataStb = array(
          'stb_stat' => $this->config->item('rejected'),
          'stb_user' => $this->session->userdata('use_id'),
          'stb_date' => date('Y-m-d H:i:s'),
        );
        $res = $this->stambumModel->update_stambum($dataStb, $whereStb);
        if ($res){
          $dataLogStb = array(
            'log_stb_id' => $stb->stb_id,
            'log_bir_id' => $stb->stb_bir_id,
            'log_a_s' => $stb->stb_a_s,
            'log_breed' => $stb->stb_breed,
            'log_gender' => $stb->stb_gender,
            'log_date_of_birth' => $dob,
            'log_photo' => $stb->stb_photo,
            'log_stat' => $this->config->item('rejected'),
            'log_user' => $this->session->userdata('use_id'),
            'log_date' => date('Y-m-d H:i:s'),
            'log_can_id' => $stb->stb_can_id,
          );
          $log = $this->logstambumModel->add_log($dataLogStb);
          if ($log){
            $res = $this->notification_model->add(5, $this->uri->segment(4), $stb->stb_member_id);
            if ($res){
                $this->db->trans_complete();
                $wheMember['mem_id'] = $stb->stb_member_id;
                $member = $this->memberModel->get_members($wheMember)->row();
                if ($member->mem_firebase_token){
                  $notif = $this->notificationtype_model->get_by_id(5);
                  firebase_notif($member->mem_firebase_token, $notif[0]->title, $notif[0]->description);
                }
                $this->session->set_flashdata('reject', TRUE);
                redirect('backend/Stambums/view_approve');
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
          $this->session->set_flashdata('error_message', 'Failed to reject puppy id = '.$this->uri->segment(4));
          redirect('backend/Stambums/view_approve');
        }
      }
      else{
        redirect("backend/Users/login");
      }
    }
    else{
      redirect("backend/Stambums/view_approve");
    }
  }

  public function delete(){
    if ($this->uri->segment(4)){
      if ($this->session->userdata('use_id')){
        $err = 0;
        $where['stb_id'] = $this->uri->segment(4);
        $stb = $this->stambumModel->get_stambum($where)->row();
        $dataStb = array(
          'stb_stat' => $this->config->item('rejected'),
          'stb_user' => $this->session->userdata('use_id'),
          'stb_date' => date('Y-m-d H:i:s'),
        );

        $data = array(
          'log_stb_id' => $this->uri->segment(4),
          'log_stat' => $this->config->item('rejected'),
          'log_user' => $this->session->userdata('use_id'),
          'log_date' => date('Y-m-d H:i:s'),
        );

        $whe['can_id'] = $stb->stb_can_id;
        $dataCan = array(
          'can_stat' => $this->config->item('rejected'),
          'can_user' => $this->session->userdata('use_id'),
          'can_date' => date('Y-m-d H:i:s'),
        );

        $dataLog = array(
          'log_canine_id' => $stb->stb_can_id,
          'log_stat' => $this->config->item('rejected'),
          'log_user' => $this->session->userdata('use_id'),
          'log_date' => date('Y-m-d H:i:s'),
        );

        $this->db->trans_strict(FALSE);
        $this->db->trans_start();
        $res = $this->stambumModel->update_stambum($dataStb, $where);
        if ($res){
          $log = $this->logstambumModel->add_log($data);
          if ($log){
            $res = $this->caninesModel->update_canines($dataCan, $whe);
            if ($res){
              $log = $this->logcanineModel->add_log($dataLog);
              if ($log){
                $this->db->trans_complete();
                $this->session->set_flashdata('delete_success', TRUE);
                redirect("backend/Stambums");
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
        }
        else{
          $err = 4;
        }
        if ($err){
          $this->db->trans_rollback();
          $this->session->set_flashdata('error_message', 'Failed to delete puppy id = '.$this->uri->segment(4).'. Error code: '.$err);
          redirect('backend/Stambums');
        }
      }
      else{
        redirect("backend/Users/login");
      }
    }
    else{
      redirect("backend/Stambums");
    }
  }

  public function log(){
    if ($this->uri->segment(4)){
      $where['log_stb_id'] = $this->uri->segment(4);
      $data['stambum'] = $this->logstambumModel->get_logs($where)->result();
      $whePed['log_canine_id'] = $this->uri->segment(4);
      $data['ped'] = $this->logpedigreeModel->get_logs($whePed)->result();
      $data['sire'] = Array();
      $data['dam'] = Array();
      foreach($data['ped'] AS $r){
        $wheSire = [];
        $wheSire['can_id'] = $r->log_sire_id;
        $data['sire'][] = $this->caninesModel->get_canines($wheSire)->row();

        $wheDam = [];
        $wheDam['can_id'] = $r->log_dam_id;
        $data['dam'][] = $this->caninesModel->get_canines($wheDam)->row();
      }
      $this->load->view('backend/log_stambum', $data);
    }
    else{
      redirect('backend/Canines');
    }
  }
}
