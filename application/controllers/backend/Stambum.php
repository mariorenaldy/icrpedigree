<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Stambum extends CI_Controller {
    public function __construct(){
        // Call the CI_Controller constructor
        parent::__construct();
        $this->load->model(array('memberModel', 'trahModel', 'kennelModel', 'stambumModel', 'birthModel', 'studModel', 'caninesModel', 'logstambumModel'));
        $this->load->library('upload', $this->config->item('upload_canine'));
        $this->load->library(array('session', 'form_validation'));
        $this->load->helper(array('url'));
        $this->load->database();
        date_default_timezone_set("Asia/Bangkok");
    }

    public function add(){
        $data['trah'] = $this->trahModel->get_trah(null)->result();

        $whereBir['bir_id'] = $this->uri->segment(4);
        $data['birth'] = $this->birthModel->get_births($whereBir)->result()[0];

        $whereStu['stu_id'] =  $data['birth']->bir_stu_id;
        $stud = $this->studModel->get_studs($whereStu)->result()[0];

        $whereSire['can_id'] = $stud->stu_sire_id;
        $sire = $this->caninesModel->get_canines($whereSire)->result()[0];

        $whereDam['can_id'] = $stud->stu_dam_id;
        $dam = $this->caninesModel->get_canines($whereDam)->result()[0];

        $data['kennel'][$sire->ken_id] = $sire->ken_name;
        $data['kennel'][$dam->ken_id] = $dam->ken_name;

        $this->load->view('backend/add_stambum', $data);
    }

    public function validate_add(){
        if ($this->session->userdata('use_username')) {
            $this->form_validation->set_error_delimiters('<div>', '</div>');
            $this->form_validation->set_rules('stb_kennel_id', 'Kennel id ', 'trim|required');
            $this->form_validation->set_rules('stb_a_s', 'Name ', 'trim|required');
            $this->form_validation->set_rules('stb_color', 'Color ', 'trim|required');
            $this->form_validation->set_rules('stb_date_of_birth', 'Date of Birth ', 'trim|required');

            $data['trah'] = $this->trahModel->get_trah(null)->result();

            $whereBir['bir_id'] = $this->input->post('bir_id');
            $data['birth'] = $this->birthModel->get_births($whereBir)->result()[0];
    
            $whereStu['stu_id'] =  $data['birth']->bir_stu_id;
            $stud = $this->studModel->get_studs($whereStu)->result()[0];
    
            $whereSire['can_id'] = $stud->stu_sire_id;
            $sire = $this->caninesModel->get_canines($whereSire)->result()[0];
    
            $whereDam['can_id'] = $stud->stu_dam_id;
            $dam = $this->caninesModel->get_canines($whereDam)->result()[0];
    
            $data['kennel'][$sire->ken_id] = $sire->ken_name;
            $data['kennel'][$dam->ken_id] = $dam->ken_name;

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

                if (!$err) {
                    $piece = explode("-", $this->input->post('stb_date_of_birth'));
                    $dob = $piece[2] . "-" . $piece[1] . "-" . $piece[0];

                    $id = $this->stambumModel->record_count() + 1;
                    $dataRecord = array(
                        'stb_id' => $id,
                        'stb_bir_id' => $this->input->post('bir_id'),
                        'stb_breed' => $this->input->post('stb_breed'),
                        'stb_gender' => $this->input->post('stb_gender'),
                        'stb_date_of_birth' => $dob,
                        'stb_color' => $this->input->post('stb_color'),
                        'stb_kennel_id' => $this->input->post('stb_kennel_id'),
                        'stb_photo' => $photo,
                        'stb_stat' => $this->config->item('accepted'),
                        'stb_app_user' => $this->session->userdata('use_id'),
                        'stb_app_date' => date('Y-m-d H:i:s'),
                        'stb_note' => $this->input->post('stb_note'),
                    );

                    // nama diubah berdasarkan kennel
                    $whereKennel['ken_id'] = $this->input->post('stb_kennel_id');
                    $kennel = $this->kennelModel->get_kennels($whereKennel)->result();
                    if ($kennel) {
                        $dataRecord['stb_member_id'] = $kennel[0]->ken_member_id;
                        if ($kennel[0]->ken_type_id == 1)
                            $dataRecord['stb_a_s'] = strtoupper($this->input->post('stb_a_s')) . " VON " . $kennel[0]->ken_name;
                        else if ($kennel[0]->ken_type_id == 2)
                            $dataRecord['stb_a_s'] = $kennel[0]->ken_name . "` " . strtoupper($this->input->post('stb_a_s'));
                        else
                            $dataRecord['stb_a_s'] = strtoupper($this->input->post('stb_a_s'));
                    }

                    if (!$err && $this->stambumModel->check_for_duplicate(0, 'stb_a_s', $this->input->post('stb_a_s'))) {
                        $err++;
                        $this->session->set_flashdata('error_message', 'Duplicate stambum name');
                    }

                    $dataLog = array(
                        'log_stambum_id' => $id,
                        'log_bir_id' => $this->input->post('bir_id'),
                        'log_a_s' => $dataRecord['stb_a_s'],
                        'log_breed' => $this->input->post('stb_breed'),
                        'log_gender' => $this->input->post('stb_gender'),
                        'log_date_of_birth' => $dob,
                        'log_color' => $this->input->post('stb_color'),
                        'log_kennel_id' => $this->input->post('stb_kennel_id'),
                        'log_photo' => $photo,
                        'log_stat' => $this->config->item('accepted'),
                        'log_app_user' => $this->session->userdata('use_id'),
                        'log_app_date' => date('Y-m-d H:i:s'),
                        'log_member_id' => $dataRecord['stb_member_id'],
                        'log_note' => $this->input->post('stb_note'),
                    );

                    if (!$err) {
                        $this->db->trans_strict(FALSE);
                        $this->db->trans_start();
                        $stambum = $this->stambumModel->add_stambum($dataRecord);
                        if ($stambum) {
                            $log = $this->logstambumModel->add_log($dataLog);
                            if ($log) {
                                $this->db->trans_complete();
                                $this->session->set_flashdata('add_success', true);
                                redirect("backend/Births");
                            } else {
                                $err = 2;
                            }
                        } else {
                            $err = 3;
                        }
                        if ($err) {
                            $this->db->trans_rollback();
                            $this->session->set_flashdata('error_message', 'Failed to save stambum. Error code: ' . $err);
                            $this->load->view('backend/add_stambum', $data);
                        }
                    } else {
                        $this->load->view('backend/add_stambum', $data);
                    }
                } else {
                    $this->load->view('backend/add_stambum', $data);
                }
            }
        } else {
            redirect("backend/Users/login");
        }
    }
}
