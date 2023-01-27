<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Stambum extends CI_Controller {
    public function __construct(){
        // Call the CI_Controller constructor
        parent::__construct();
        $this->load->model(array('memberModel', 'trahModel', 'kennelModel', 'stambumModel'));
        $this->load->library('upload', $this->config->item('upload_canine'));
        $this->load->library(array('session', 'form_validation'));
        $this->load->helper(array('url'));
        $this->load->database();
        date_default_timezone_set("Asia/Bangkok");
    }

    public function add(){
        $this->load->view('backend/add_stambum');
    }

    public function validate_add(){
        if ($this->session->userdata('use_username')) {
            $this->form_validation->set_error_delimiters('<div>', '</div>');
            $this->form_validation->set_rules('stb_member_id', 'Member id ', 'trim|required');
            $this->form_validation->set_rules('stb_kennel_id', 'Kennel id ', 'trim|required');
            $this->form_validation->set_rules('stb_a_s', 'Name ', 'trim|required');
            $this->form_validation->set_rules('stb_color', 'Color ', 'trim|required');
            $this->form_validation->set_rules('stb_date_of_birth', 'Date of Birth ', 'trim|required');

            $data['trah'] = $this->trahModel->get_trah(null)->result();

            $like['mem_name'] = $this->input->post('mem_name');
            $where['mem_stat'] = $this->config->item('accepted');
            $data['member'] = $this->memberModel->search_members($like, $where)->result();

            $whe['ken_member_id'] =  $this->input->post('stb_member_id');
            $whe['ken_stat'] = $this->config->item('accepted');
            $data['kennel'] = $this->kennelModel->get_kennels($whe)->result();

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
                    $data = array(
                        'stb_id' => $id,
                        'stb_member_id' => $this->input->post('stb_member_id'),
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
                        if ($kennel[0]->ken_type_id == 1)
                            $data['stb_a_s'] = strtoupper($this->input->post('stb_a_s')) . " VON " . $kennel[0]->ken_name;
                        else if ($kennel[0]->ken_type_id == 2)
                            $data['stb_a_s'] = $kennel[0]->ken_name . "` " . strtoupper($this->input->post('stb_a_s'));
                        else
                            $data['stb_a_s'] = strtoupper($this->input->post('stb_a_s'));
                    }

                    if (!$err && $this->stambumModel->check_for_duplicate(0, 'stb_a_s', $this->input->post('stb_a_s'))) {
                        $err++;
                        $this->session->set_flashdata('error_message', 'Duplicate stambum name');
                    }

                    $dataLog = array(
                        'log_stambum_id' => $id,
                        'log_a_s' => $data['stb_a_s'],
                        'log_breed' => $this->input->post('stb_breed'),
                        'log_gender' => $this->input->post('stb_gender'),
                        'log_date_of_birth' => $dob,
                        'log_color' => $this->input->post('stb_color'),
                        'log_kennel_id' => $this->input->post('stb_kennel_id'),
                        'log_photo' => $photo,
                        'log_stat' => $this->config->item('accepted'),
                        'log_app_user' => $this->session->userdata('use_id'),
                        'log_app_date' => date('Y-m-d H:i:s'),
                        'log_member_id' => $this->input->post('stb_member_id'),
                        'log_note' => $this->input->post('stb_note'),
                    );

                    if (!$err) {
                        $this->db->trans_strict(FALSE);
                        $this->db->trans_start();
                        $stambum = $this->stambumModel->add_stambum($data);
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
