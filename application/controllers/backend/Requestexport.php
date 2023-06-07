<?php
defined('BASEPATH') OR exit('No direct script access allowed');

#[\AllowDynamicProperties]

class Requestexport extends CI_Controller {
		public function __construct(){
			// Call the CI_Controller constructor
			parent::__construct();
			$this->load->model(array('requestexportModel', 'memberModel', 'trahModel', 'caninesModel', 'pedigreesModel', 'logcanineModel', 'logpedigreeModel', 'kennelModel', 'notification_model', 'notificationtype_model'));
			$this->load->library(array('session', 'form_validation'));
			$this->load->helper(array('form', 'url'));
			$this->load->database();
			date_default_timezone_set("Asia/Bangkok");
		}

		public function index(){
			$where['req_stat'] = $this->config->item('saved');
			$data['req'] = $this->requestexportModel->get_requests($where)->result();
			$this->load->view('backend/view_request_export', $data);
        }

		public function search(){
            if ($this->input->post('keywords')){
                $like['mem_name'] = $this->input->post('keywords');
                $like['ken_name'] = $this->input->post('keywords');
            }
            else
                $like = null;
            $where['req_stat'] = $this->config->item('saved');
			$data['req'] = $this->requestexportModel->search_requests($like, $where)->result();
			$this->load->view('backend/view_request_export', $data);
        }

		public function approve(){
			if ($this->uri->segment(4)){
				if ($this->session->userdata('use_username')){
					$err = 0;
					$wheReq['req_id'] = $this->uri->segment(4);
					$req = $this->requestexportModel->get_requests($wheReq)->row();

					$dataReq['req_app_user'] = $this->session->userdata('use_id');
					$dataReq['req_app_date'] = date('Y-m-d H:i:s');
					$dataReq['req_stat'] = $this->config->item('accepted');
					
					$this->db->trans_strict(FALSE);
					$this->db->trans_start();
					$result = $this->requestexportModel->update_requests($dataReq, $wheReq);
					if ($result){
                        $res = $this->notification_model->add(30, $this->uri->segment(4), $req->req_member_id);
                        if ($res){
                            $this->db->trans_complete();
                            $this->session->set_flashdata('approve', TRUE);
                            redirect('backend/Requestexport');
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
						$this->session->set_flashdata('error_message', 'Failed to approve export id = '.$this->uri->segment(4).'. Err code: '.$err);
						redirect('backend/Requestexport');
					}
				}
				else{
					redirect("backend/Users/login");
				}
			}
			else{
				redirect("backend/Requestexport");
			}
		}

		public function reject(){
			if ($this->uri->segment(4)){
				if ($this->session->userdata('use_username')){
					$err = 0;
					$wheReq['req_id'] = $this->uri->segment(4);
					$req = $this->requestexportModel->get_requests($wheReq)->row();

					$dataReq['req_app_user'] = $this->session->userdata('use_id');
					$dataReq['req_app_date'] = date('Y-m-d H:i:s');
					$dataReq['req_stat'] = $this->config->item('rejected');
					if ($this->uri->segment(5)){
						$dataReq['req_app_note'] = urldecode($this->uri->segment(5));
					}
					
					$this->db->trans_strict(FALSE);
					$this->db->trans_start();
					$update = $this->requestexportModel->update_requests($dataReq, $wheReq);
					if ($update){
						$result = $this->notification_model->add(31, $this->uri->segment(4), $req->req_member_id);
						if ($result){
							$this->db->trans_complete();
							$this->session->set_flashdata('reject', TRUE);
							redirect('backend/Requestexport');
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
						$this->session->set_flashdata('error_message', 'Failed to reject export id = '.$this->uri->segment(4).'. Err code: '.$err);
						redirect('backend/Requestexport');
					}
				}
				else{
					redirect("backend/Users/login");
				}
			}
			else{
				redirect("backend/Requestexport");
			}
		}

        public function manage(){
			$where['req_stat'] = $this->config->item('accepted');
			$data['req'] = $this->requestexportModel->get_requests($where)->result();
			$this->load->view('backend/view_approved_request_export', $data);
        }

		public function search_manage(){
			if ($this->input->post('keywords')){
                $like['mem_name'] = $this->input->post('keywords');
                $like['ken_name'] = $this->input->post('keywords');
            }
            else
                $like = null;
            $where['req_stat'] = $this->config->item('accepted');
			$data['req'] = $this->requestexportModel->search_requests($like, $where)->result();
			$this->load->view('backend/view_approved_request_export', $data);
        }

        public function add_canine(){
            if ($this->uri->segment(4)){
                $wheTrah['tra_stat != '] = $this->config->item('deleted');
                $data['trah'] = $this->trahModel->get_trah($wheTrah)->result();
                $where['req_id'] = $this->uri->segment(4);
                $data['req'] = $this->requestexportModel->get_requests($where)->row();
                $this->load->view('backend/add_canine_stb', $data);
            }
            else
                redirect("Requestexport/manage");
        }

        public function validate_add(){ 
            if ($this->session->userdata('use_username')) {
                $this->form_validation->set_error_delimiters('<div>', '</div>');
                $this->form_validation->set_rules('can_a_s', 'Name ', 'trim|required');
                $this->form_validation->set_rules('can_reg_number', 'Current registration number', 'trim|required');
                $this->form_validation->set_rules('can_icr_number', 'ICR number ', 'trim|required');
                $this->form_validation->set_rules('can_chip_number', 'Microchip number ', 'trim');
                $this->form_validation->set_rules('can_color', 'Color ', 'trim|required');
                $this->form_validation->set_rules('can_date_of_birth', 'Date of Birth ', 'trim|required');
            
                $wheTrah['tra_stat != '] = $this->config->item('deleted');
                $data['trah'] = $this->trahModel->get_trah($wheTrah)->result();
                $where['req_id'] = $this->input->post('req_id');
                $data['req'] = $this->requestexportModel->get_requests($where)->row();
    
                if ($this->form_validation->run() == FALSE) {
                    $this->load->view('backend/add_canine_stb', $data);
                } else {
                    $err = 0;
                    if ($this->input->post('can_icr_number') != "-" && $this->caninesModel->check_for_duplicate(0, 'can_icr_number', $this->input->post('can_icr_number'))){
                        $err++;
                        $this->session->set_flashdata('error_message', 'Duplicate ICR number');
                    }
            
                    if (!$err && $this->input->post('can_chip_number') != "-" && $this->caninesModel->check_for_duplicate(0, 'can_chip_number', $this->input->post('can_chip_number'))){
                        $err++;
                        $this->session->set_flashdata('error_message', 'Duplicate microchip number');
                    }
    
                    $piece = explode("-", $this->input->post('can_date_of_birth'));
                    $dob = $piece[2] . "-" . $piece[1] . "-" . $piece[0];
                    if (!$err){
                        $ts = new DateTime();
                        $ts_dob = new DateTime($dob);
                        if ($ts_dob > $ts){
                            $err++;
                            $this->session->set_flashdata('error_message', 'Tanggal lahir anjing harus lebih dari '.$this->config->item('min_jarak_lapor_anak').' hari');
                        }
                        else{ // min 45 hari
                            $diff = $ts->diff($ts_dob)->days/$this->config->item('min_jarak_lapor_anak');
                            if ($diff < 1){
                                $err++;
                                $this->session->set_flashdata('error_message', 'Tanggal lahir anjing harus lebih dari '.$this->config->item('min_jarak_lapor_anak').' hari');
                            }
                        }
                    }
    
                    if (!$err){
                        $id = $this->caninesModel->record_count() + 895; // gara2 data canine dihapus
                        $dataCan = array(
                            'can_id' => $id,
                            'can_member_id' => $data['req']->req_member_id,
                            'can_reg_number' => strtoupper($this->input->post('can_reg_number')),
                            'can_breed' => $this->input->post('can_breed'),
                            'can_gender' => $this->input->post('can_gender'),
                            'can_date_of_birth' => $dob,
                            'can_color' => $this->input->post('can_color'),
                            'can_kennel_id' => $data['req']->ken_id,
                            'can_reg_date' => date("Y/m/d"),
                            'can_photo' => $data['req']->req_can_photo,
                            'can_stat' => $this->config->item('accepted'),
                            'can_app_user' => $this->session->userdata('use_id'),
                            'can_app_date' => date('Y-m-d H:i:s'),
                            'can_chip_number' => $this->input->post('can_chip_number'),
                            'can_icr_number' => $this->input->post('can_icr_number'),
                            'can_note' => $this->input->post('can_note'),
                            'can_user' => $this->session->userdata('use_id'),
                            'can_date' => date('Y-m-d H:i:s'),
                        );
    
                        // nama diubah berdasarkan kennel
                        if (!$this->input->post('remove')){
                            if ($data['req']->ken_type_id == 1)
                                $dataCan['can_a_s'] = strtoupper($this->input->post('can_a_s'))." VON ".$data['req']->ken_name;
                            else if ($data['req']->ken_type_id == 2)
                                $dataCan['can_a_s'] = $data['req']->ken_name."` ".strtoupper($this->input->post('can_a_s'));
                            else 
                                $dataCan['can_a_s'] = strtoupper($this->input->post('can_a_s'));
                        }
                        else
                            $dataCan['can_a_s'] = strtoupper($this->input->post('can_a_s'));
    
                        if (!$err && $this->caninesModel->check_for_duplicate(0, 'can_a_s', $dataCan['can_a_s'])){
                            $err++;
                            $this->session->set_flashdata('error_message', 'Duplicate canine name');
                        }
    
                        if (strlen($dataCan['can_a_s']) >= $this->config->item('can_a_s_length')){
                            $err++;
                            $this->session->set_flashdata('error_message', 'Nama anjing terlalu panjang. Ditambah dengan nama kennel, harus di bawah '.$this->config->item('can_a_s_length').' karakter');
                        }
    
                        $dataLog = array(
                            'log_canine_id' => $id,
                            'log_reg_number' => strtoupper($this->input->post('can_reg_number')),
                            'log_a_s' => $dataCan['can_a_s'],
                            'log_breed' => $this->input->post('can_breed'),
                            'log_gender' => $this->input->post('can_gender'),
                            'log_date_of_birth' => $dob,
                            'log_color' => $this->input->post('can_color'),
                            'log_kennel_id' => $data['req']->ken_id,
                            'log_photo' => $data['req']->req_can_photo,
                            'log_stat' => $this->config->item('accepted'),
                            'log_app_user' => $this->session->userdata('use_id'),
                            'log_app_date' => date('Y-m-d H:i:s'),
                            'log_chip_number' => $this->input->post('can_chip_number'),
                            'log_icr_number' => $this->input->post('can_icr_number'),
                            'log_member_id' => $data['req']->req_member_id,
                            'log_note' => $this->input->post('can_note'),
                            'log_user' => $this->session->userdata('use_id'),
                            'log_date' => date('Y-m-d H:i:s'),
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
                            'log_user' => $this->session->userdata('use_id'),
                            'log_date' => date('Y-m-d H:i:s'),
                        );
    
                        if (!$err) {
                            $this->db->trans_strict(FALSE);
                            $this->db->trans_start();
                            $canines = $this->caninesModel->add_canines($dataCan);
                            if ($canines) {
                                $pedigree = $this->pedigreesModel->add_pedigrees($dataPed);
                                if ($pedigree) {
                                    $log = $this->logcanineModel->add_log($dataLog);
                                    if ($log){
                                        $res = $this->logpedigreeModel->add_log($dataLogPed);
                                        if ($res){
                                            $dataReq['req_stat'] = $this->config->item('completed');
                                            $result = $this->requestexportModel->update_requests($dataReq, $where);
                                            if ($result){
                                                $this->db->trans_complete();
                                                $this->session->set_flashdata('add_success', true);
                                                redirect("backend/Requestexport/manage");
                                            }
                                            else
                                                $err = 1;
                                        }
                                        else{
                                            $err = 2;
                                        }
                                    }
                                    else{
                                        $err = 3;
                                    }
                                } else {
                                    $err = 4;
                                }
                            } else {
                                $err = 5;
                            }
                            if ($err) {
                                $this->db->trans_rollback();
                                $this->session->set_flashdata('error_message', 'Failed to save canine. Error code: '.$err);
                                $this->load->view('backend/add_canine_stb', $data);
                            }
                        } else {
                            $this->load->view('backend/add_canine_stb', $data);
                        }
                    } else {
                        $this->load->view('backend/add_canine_stb', $data);
                    }
                }
            } 
            else {
                redirect("backend/Users/login");
            }
        }
}
