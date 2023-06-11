<?php
defined('BASEPATH') OR exit('No direct script access allowed');

#[\AllowDynamicProperties]

class Requestmicrochip extends CI_Controller {
	public function __construct(){
		// Call the CI_Controller constructor
		parent::__construct();
		$this->load->model(array('requestmicrochipModel', 'caninesModel', 'memberModel', 'logrequestMicrochipModel', 'RejectReasonsModel'));
		$this->load->library(array('session', 'form_validation'));
		$this->load->helper(array('form', 'url'));
		$this->load->database();
		date_default_timezone_set("Asia/Bangkok");
	}

	public function index(){
		$data['req'] = $this->requestmicrochipModel->get_requests()->result();
		$this->load->view('backend/view_request_microchip', $data);
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
			$request = $this->requestmicrochipModel->get_requests($whereReq)->row();
			$dataLog = array(
				'log_req_id' => $req_id,
				'log_mem_id' => $request->req_mem_id,
				'log_can_id' => $request->req_can_id,
				'log_stat_id' => $this->config->item('cert_delivered'),
				'log_created_at' => date('Y-m-d H:i:s', strtotime($request->req_created_at)),
				'log_updated_at' => date('Y-m-d H:i:s'),
				'log_updated_by' => $this->session->userdata('use_id'),
				'log_datetime' => date('Y-m-d H:i:s', strtotime($request->req_datetime)),
				'log_reject_note' => $request->req_reject_note,
				'log_pay_photo' => $request->req_pay_photo
			);
	
			$err = 0;
			$this->db->trans_strict(FALSE);
			$this->db->trans_start();
			$whereReq['req_id'] = $req_id;
			$requests = $this->requestmicrochipModel->update_requests($dataReq, $whereReq);
			if ($requests) {
				$log = $this->logrequestMicrochipModel->add_log($dataLog);
				if($log){
					$this->db->trans_complete();
					$this->session->set_flashdata('deliver_success', TRUE);
					redirect('backend/Requestmicrochip');
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
				redirect('backend/Requestmicrochip');
			}
		}
		else{
			redirect('backend/Requestmicrochip');
		}
	}
	public function reject()
	{
		if ($this->uri->segment(4)){
			$req_id = $this->uri->segment(4);
			$whereReq['req_id'] = $req_id;
			$data['req'] = $this->requestmicrochipModel->get_requests($whereReq)->row();
			$data['reasons'] = $this->RejectReasonsModel->get_microchip_reasons()->result();
			$data['mode'] = 0;
			if ($data['req']) {
				$this->load->view("backend/reject_microchip", $data);
			} else {
				redirect('backend/Requestmicrochip');
			}
		}
		else{
			redirect('backend/Requestmicrochip');
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
			$data['req'] = $this->requestmicrochipModel->get_requests($whereReq)->row();
			$data['reasons'] = $this->RejectReasonsModel->get_microchip_reasons()->result();
            $data['mode'] = 1;
            
			if($data['req']){
				if(!$valid){
					$this->load->view('backend/reject_microchip', $data);
				} else {
					$err = 0;

					$request = $data['req'];
					$dataReq = array(
						'req_updated_at' => date('Y-m-d H:i:s'),
						'req_updated_by' => $this->session->userdata('use_id'),
						'req_stat_id' => $this->config->item('rejected')
					);

					$dataLog = array(
						'log_req_id' => $req_id,
						'log_mem_id' => $request->req_mem_id,
						'log_can_id' => $request->req_can_id,
						'log_stat_id' => $this->config->item('rejected'),
						'log_created_at' => date('Y-m-d H:i:s', strtotime($request->req_created_at)),
						'log_updated_at' => date('Y-m-d H:i:s'),
						'log_updated_by' => $this->session->userdata('use_id'),
						'log_datetime' => date('Y-m-d H:i:s', strtotime($request->req_datetime)),
						'log_reject_note' => $request->req_reject_note,
						'log_pay_photo' => $request->req_pay_photo
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
					$rejected = $this->requestmicrochipModel->update_requests($dataReq, $whereReq);
					if ($rejected) {
						$log = $this->logrequestMicrochipModel->add_log($dataLog);
						if ($log){
							$this->db->trans_complete();
							$this->session->set_flashdata('reject_success', TRUE);
							redirect("backend/Requestmicrochip");
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
						redirect('backend/Requestmicrochip');
					}
				}
			}
			else{
				$this->session->set_flashdata('error_message', 'Failed to get request data.');
				redirect('backend/Requestmicrochip');
			}
        } 
        else {
            redirect("backend/Requestmicrochip");
        }
    }
}
