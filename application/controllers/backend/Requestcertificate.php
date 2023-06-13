<?php
defined('BASEPATH') OR exit('No direct script access allowed');

#[\AllowDynamicProperties]

class Requestcertificate extends CI_Controller {
	public function __construct(){
		// Call the CI_Controller constructor
		parent::__construct();
		$this->load->model(array('requestcertificateModel', 'caninesModel', 'memberModel', 'logrequestCertificateModel', 'RejectReasonsModel', 'notification_model', 'CertificateStatusModel'));
		$this->load->library(array('session', 'form_validation'));
		$this->load->helper(array('form', 'url'));
		$this->load->database();
		date_default_timezone_set("Asia/Bangkok");
	}

	public function index(){
		$data['req'] = $this->requestcertificateModel->get_requests()->result();
		$this->load->view('backend/view_request_certificate', $data);
	}

	public function deliver()
	{
		if ($this->uri->segment(4)){
			$req_id = $this->uri->segment(4);
			$dataReq = array(
				'req_updated_at' => date('Y-m-d H:i:s'),
				'req_updated_by' => $this->session->userdata('use_id'),
				'req_stat_id' => $this->config->item('cert_delivered')
			);

			$whereReq['req_id'] = $req_id;
			$request = $this->requestcertificateModel->get_requests($whereReq)->row();
			$dataLog = array(
				'log_req_id' => $req_id,
				'log_mem_id' => $request->req_mem_id,
				'log_can_id' => $request->req_can_id,
				'log_stat_id' => $this->config->item('cert_delivered'),
				'log_created_at' => date('Y-m-d H:i:s', strtotime($request->req_created_at)),
				'log_updated_at' => date('Y-m-d H:i:s'),
				'log_updated_by' => $this->session->userdata('use_id'),
				'log_arrived_date' => date('Y-m-d H:i:s', strtotime($request->req_arrived_date)),
				'log_reject_note' => $request->req_reject_note,
				'log_desc' => $request->req_desc
			);
	
			$err = 0;
			$this->db->trans_strict(FALSE);
			$this->db->trans_start();
			$whereReq['req_id'] = $req_id;
			$requests = $this->requestcertificateModel->update_requests($dataReq, $whereReq);
			if ($requests) {
				$log = $this->logrequestCertificateModel->add_log($dataLog);
				if($log){
					$result = $this->notification_model->add(34, $req_id, $request->req_mem_id, "Sertifikat untuk anjing / Certificate for dog: ".$request->can_a_s);
					if ($result){
						$this->db->trans_complete();
						$this->session->set_flashdata('deliver_success', true);
						redirect("backend/Requestcertificate");
					}
					else{
						$err = 3;
					}
				}
				else{
					$err = 1;
				}
			} else {
				$err = 2;
			}

			if ($err) {
				$this->db->trans_rollback();
				$this->session->set_flashdata('error_message', 'Failed to deliver certificate. Error code: '.$err);
				redirect('backend/Requestcertificate');
			}
		}
		else{
			redirect('backend/Requestcertificate');
		}
	}
	public function arrive()
	{
		if ($this->uri->segment(4)){
			$req_id = $this->uri->segment(4);
			$dataReq = array(
				'req_updated_at' => date('Y-m-d H:i:s'),
				'req_updated_by' => $this->session->userdata('use_id'),
				'req_arrived_date' => date('Y-m-d H:i:s'),
				'req_stat_id' => $this->config->item('cert_arrived')
			);

			$whereReq['req_id'] = $req_id;
			$request = $this->requestcertificateModel->get_requests($whereReq)->row();
			$dataLog = array(
				'log_req_id' => $req_id,
				'log_mem_id' => $request->req_mem_id,
				'log_can_id' => $request->req_can_id,
				'log_stat_id' => $this->config->item('cert_arrived'),
				'log_created_at' => date('Y-m-d H:i:s', strtotime($request->req_created_at)),
				'log_updated_at' => date('Y-m-d H:i:s'),
				'log_updated_by' => $this->session->userdata('use_id'),
				'log_arrived_date' => date('Y-m-d H:i:s'),
				'log_reject_note' => $request->req_reject_note,
				'log_desc' => $request->req_desc
			);
	
			$err = 0;
			$this->db->trans_strict(FALSE);
			$this->db->trans_start();
			$whereReq['req_id'] = $req_id;
			$requests = $this->requestcertificateModel->update_requests($dataReq, $whereReq);
			if ($requests) {
				$log = $this->logrequestCertificateModel->add_log($dataLog);
				if($log){
					$result = $this->notification_model->add(35, $req_id, $request->req_mem_id, "Sertifikat untuk anjing / Certificate for dog: ".$request->can_a_s);
					if ($result){
						$this->db->trans_complete();
						$this->session->set_flashdata('arrive_success', true);
						redirect("backend/Requestcertificate");
					}
					else{
						$err = 3;
					}
				}
				else{
					$err = 1;
				}
			} else {
				$err = 2;
			}

			if ($err) {
				$this->db->trans_rollback();
				$this->session->set_flashdata('error_message', 'Failed to set request as arrived. Error code: '.$err);
				redirect('backend/Requestcertificate');
			}
		}
		else{
			redirect('backend/Requestcertificate');
		}
	}
	public function reject()
	{
		if ($this->uri->segment(4)){
			$req_id = $this->uri->segment(4);
			$whereReq['req_id'] = $req_id;
			$data['req'] = $this->requestcertificateModel->get_requests($whereReq)->row();
			$data['reasons'] = $this->RejectReasonsModel->get_certificate_reasons()->result();
			$data['mode'] = 0;
			if ($data['req']) {
				$this->load->view("backend/reject_certificate", $data);
			} else {
				redirect('backend/Requestcertificate');
			}
		}
		else{
			redirect('backend/Requestcertificate');
		}
	}
	public function validate_reject(){ 
        if ($this->session->userdata('use_id')) {

			$valid = false;
            if (!$this->input->post('dropdown_reason')){
				$this->form_validation->set_error_delimiters('<div>', '</div>');
                $this->form_validation->set_rules('req_reject_note', 'Other Reason required', 'trim|required');
				if($this->form_validation->run() == TRUE){
					$valid = true;
				}
            }
			else{
				$valid = true;
			}

			$req_id = $this->input->post('req_id');
			$whereReq['req_id'] = $req_id;
			$data['req'] = $this->requestcertificateModel->get_requests($whereReq)->row();
			$data['reasons'] = $this->RejectReasonsModel->get_certificate_reasons()->result();
            $data['mode'] = 1;
            
			if($data['req']){
				if(!$valid){
					$this->load->view('backend/reject_certificate', $data);
				} else {
					$err = 0;

					$request = $data['req'];
					$dataReq = array(
						'req_updated_at' => date('Y-m-d H:i:s'),
						'req_updated_by' => $this->session->userdata('use_id'),
						'req_stat_id' => $this->config->item('cert_rejected')
					);

					$dataLog = array(
						'log_req_id' => $req_id,
						'log_mem_id' => $request->req_mem_id,
						'log_can_id' => $request->req_can_id,
						'log_stat_id' => $this->config->item('cert_rejected'),
						'log_created_at' => date('Y-m-d H:i:s', strtotime($request->req_created_at)),
						'log_updated_at' => date('Y-m-d H:i:s'),
						'log_updated_by' => $this->session->userdata('use_id'),
						'log_arrived_date' => date('Y-m-d H:i:s', strtotime($request->req_arrived_date)),
						'log_reject_note' => $request->req_reject_note,
						'log_desc' => $request->req_desc
					);

					if($this->input->post('dropdown_reason')){
						$dataReq['req_reject_note'] = $this->input->post('req_reject');
						$dataLog['log_reject_note'] = $this->input->post('req_reject');
					}
					else{
						$dataReq['req_reject_note'] = $this->input->post('req_reject_note');
						$dataLog['log_reject_note'] = $this->input->post('req_reject_note');
					}
			
					$this->db->trans_strict(FALSE);
					$this->db->trans_start();
					$rejected = $this->requestcertificateModel->update_requests($dataReq, $whereReq);
					if ($rejected) {
						$log = $this->logrequestCertificateModel->add_log($dataLog);
						if ($log){
							$result = $this->notification_model->add(36, $req_id, $request->req_mem_id, "Sertifikat untuk anjing / Certificate for dog: ".$request->can_a_s);
							if ($result){
								$this->db->trans_complete();
								$this->session->set_flashdata('reject_success', true);
								redirect("backend/Requestcertificate");
							}
							else{
								$err = 3;
							}
						}
						else{
							$err = 2;
						}
					} else {
						$err = 1;
					}
	
					if ($err) {
						$this->db->trans_rollback();
						$this->session->set_flashdata('error_message', 'Failed to reject request. Error code: '.$err);
						redirect('backend/Requestcertificate');
					}
				}
			}
			else{
				$this->session->set_flashdata('error_message', 'Failed to get request data.');
				redirect('backend/Requestcertificate');
			}
        } 
        else {
            redirect("backend/Requestcertificate");
        }
    }
	public function log(){
        if ($this->uri->segment(4)){
            $where['log_req_id'] = $this->uri->segment(4);
            $data['request'] = $this->logrequestCertificateModel->get_logs($where)->result();
            $this->load->view('backend/log_request_certificate', $data);
        }
        else{
            redirect('backend/Requestcertificate');
        }
    }
	public function edit()
	{
		if ($this->uri->segment(4)){
			$req_id = $this->uri->segment(4);
			$whereReq['req_id'] = $req_id;
			$data['request'] = $this->requestcertificateModel->get_requests($whereReq)->row();
            $data['status'] = $this->CertificateStatusModel->get_status()->result();

			$data['mode'] = 0;
			if ($data['request']) {
				$this->load->view("backend/edit_request_certificate", $data);
			} else {
				redirect('backend/Requestcertificate');
			}
		}
		else{
			redirect('backend/Requestcertificate');
		}
	}
	public function validate_edit(){ 
        if ($this->session->userdata('use_username')) {
			$req_id = $this->input->post('req_id');
			$whereReq['req_id'] = $req_id;
			$data['request'] = $this->requestcertificateModel->get_requests($whereReq)->row();

            $data['status'] = $this->CertificateStatusModel->get_status()->result();
			$data['mode'] = 1;

			$arrivedDate = null;
			if($this->input->post('req_arrived_date') != null){
				$arrivedDate = date('Y-m-d H:i:s', strtotime($this->input->post('req_arrived_date')));
			}
			
			$requestReason = $this->input->post('req_desc');
			$rejectNote = $this->input->post('req_reject_note');

			$dataReq = array(
				'req_stat_id' => $this->input->post('req_stat_id'),
				'req_updated_at' => date('Y-m-d H:i:s'),
				'req_updated_by' => $this->session->userdata('use_id'),
				'req_arrived_date' => $arrivedDate,
				'req_reject_note' => $rejectNote,
				'req_desc' => $requestReason,
			);

			$dataLog = array(
				'log_req_id' => $data['request']->req_id,
				'log_mem_id' => $data['request']->req_mem_id,
				'log_can_id' => $data['request']->req_can_id,
				'log_stat_id' => $this->input->post('req_stat_id'),
				'log_created_at' => $data['request']->req_created_at,
				'log_updated_at' => date('Y-m-d H:i:s'),
				'log_updated_by' => $this->session->userdata('use_id'),
				'log_arrived_date' => $arrivedDate,
				'log_reject_note' => $rejectNote,
				'log_desc' => $requestReason,
			);

			$this->db->trans_strict(FALSE);
			$this->db->trans_start();
			$request = $this->requestcertificateModel->update_requests($dataReq, $whereReq);
			if ($request) {
				$log = $this->logrequestCertificateModel->add_log($dataLog);
				if ($log){
					$this->db->trans_complete();
					$this->session->set_flashdata('edit_success', true);
					redirect("backend/Requestcertificate");
				}
				else{
					$err = 2;
				}
			} else {
				$err = 3;
			}

			if ($err) {
				$this->db->trans_rollback();
				$this->session->set_flashdata('error_message', 'Failed to edit request with id = '.$this->input->post('req_id').'. Error code: '.$err);
				$this->load->view('backend/edit_request_certificate', $data);
			}
        }
        else{
            redirect('backend/Users/login');
        }
    }
	public function add()
	{
		$data['member'] = [];
		$data['canine'] = [];
		$data['status'] = $this->CertificateStatusModel->get_status()->result();
		$this->load->view("backend/add_request_certificate", $data);
	}
	public function search_member(){
		$like['mem_name'] = $this->input->post('mem_name');
		$where['mem_stat'] = $this->config->item('accepted');
		$where['mem_id !='] = $this->config->item('no_member');
		$member = $this->memberModel->search_members($like, $where)->result();
		$json = json_encode($member);
		echo $json;
    }

	public function search_dog(){
		$where['can_member_id'] = $this->input->post('mem_id');
		$where['can_stat'] = $this->config->item('accepted');
		$canine = $this->caninesModel->search_canines(null, $where)->result();
		$jsonCan = json_encode($canine);
		echo $jsonCan;
    }
	public function validate_add(){ 
        if ($this->session->userdata('use_username')) {
            $this->form_validation->set_error_delimiters('<div>', '</div>');
            $this->form_validation->set_rules('req_mem_id', 'Member ', 'trim|required');
            $this->form_validation->set_rules('req_can_id', 'Dog ', 'trim|required');

			$data['status'] = $this->CertificateStatusModel->get_status()->result();

            $like['mem_name'] = $this->input->post('mem_name');
            $where['mem_stat'] = $this->config->item('accepted');
			$where['mem_id !='] = $this->config->item('no_member');
            $data['member'] = $this->memberModel->search_members($like, $where)->result();

			$wheCan['can_member_id'] = $this->input->post('mem_id');
			$wheCan['can_stat'] = $this->config->item('accepted');
			$canine = $this->caninesModel->search_canines(null, $wheCan)->result();

			$whereCan['can_id'] = $this->input->post('req_can_id');
			$dogData = $this->caninesModel->get_canines($whereCan)->row();

            if ($this->form_validation->run() == FALSE) {
                $this->load->view('backend/add_request_certificate', $data);
            } else {
				$arrivedDate = null;
				if($this->input->post('req_arrived_date')){
					$arrivedDate = date('Y-m-d H:i:s', strtotime($this->input->post('req_arrived_date')));
				}

				$dataReq = array(
					'req_mem_id' => $this->input->post('req_mem_id'),
					'req_can_id' => $this->input->post('req_can_id'),
					'req_stat_id' => $this->input->post('req_stat_id'),
					'req_created_at' => date('Y-m-d H:i:s'),
					'req_updated_at' => date('Y-m-d H:i:s'),
					'req_updated_by' => $this->session->userdata('use_id'),
					'req_arrived_date' => $arrivedDate,
					'req_reject_note' => $this->input->post('req_reject_note'),
					'req_desc' => $this->input->post('req_desc'),
				);

				$dataLog = array(
					'log_mem_id' => $this->input->post('req_mem_id'),
					'log_can_id' => $this->input->post('req_can_id'),
					'log_stat_id' => $this->input->post('req_stat_id'),
					'log_created_at' => date('Y-m-d H:i:s'),
					'log_updated_at' => date('Y-m-d H:i:s'),
					'log_updated_by' => $this->session->userdata('use_id'),
					'log_arrived_date' => $arrivedDate,
					'log_reject_note' => $this->input->post('req_reject_note'),
					'log_desc' => $this->input->post('req_desc'),
				);

				$this->db->trans_strict(FALSE);
				$this->db->trans_start();
				$requests = $this->requestcertificateModel->add_requests($dataReq);
				if ($requests) {
					$insertedID = $this->db->insert_id();
					$dataLog['log_req_id'] = $insertedID;

					$log = $this->logrequestCertificateModel->add_log($dataLog);
					if ($log){
						if($this->input->post('req_stat_id') == 2){
							$result = $this->notification_model->add(34, $insertedID, $this->input->post('req_mem_id'), "Sertifikat untuk anjing / Certificate for dog: ".$dogData->can_a_s);
							if ($result){
								$this->db->trans_complete();
								$this->session->set_flashdata('add_success', true);
								redirect("backend/Requestcertificate");
							}
							else{
								$err = 1;
							}
						}
						else if($this->input->post('ord_stat_id') == 3){
							$result = $this->notification_model->add(35, $insertedID, $this->input->post('req_mem_id'), "Sertifikat untuk anjing / Certificate for dog: ".$dogData->can_a_s);
							if ($result){
								$this->db->trans_complete();
								$this->session->set_flashdata('add_success', true);
								redirect("backend/Requestcertificate");
							}
							else{
								$err = 1;
							}
						}
						else if($this->input->post('ord_stat_id') == 5){
							$result = $this->notification_model->add(36, $insertedID, $this->input->post('req_mem_id'), "Sertifikat untuk anjing / Certificate for dog: ".$dogData->can_a_s);
							if ($result){
								$this->db->trans_complete();
								$this->session->set_flashdata('add_success', true);
								redirect("backend/Requestcertificate");
							}
							else{
								$err = 1;
							}
						}
						else{
							$this->db->trans_complete();
							$this->session->set_flashdata('add_success', true);
							redirect("backend/Requestcertificate");
						}
					}
					else{
						$err = 3;
					}
				} else {
					$err = 5;
				}
				if ($err) {
					$this->db->trans_rollback();
					$this->session->set_flashdata('error_message', 'Failed to save certificate request. Error code: '.$err);
					$this->load->view('backend/add_request_certificate', $data);
				}
            }
        } 
        else {
            redirect("backend/Users/login");
        }
    }
}
