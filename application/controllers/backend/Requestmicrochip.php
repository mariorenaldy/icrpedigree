<?php
defined('BASEPATH') OR exit('No direct script access allowed');

#[\AllowDynamicProperties]

class Requestmicrochip extends CI_Controller {
	public function __construct(){
		// Call the CI_Controller constructor
		parent::__construct();
		$this->load->model(array('requestmicrochipModel', 'caninesModel', 'memberModel', 'logrequestMicrochipModel', 'RejectReasonsModel', 'notification_model', 'MicrochipStatusModel'));
		$this->load->library(array('session', 'form_validation'));
		$this->load->helper(array('form', 'url'));
		$this->load->database();
		date_default_timezone_set("Asia/Bangkok");
	}

	public function index(){
		$this->updateExpired();
		$where_not_in = array($this->config->item('micro_not_paid'),$this->config->item('micro_cancelled'),$this->config->item('micro_payment_failed'));
		$data['req'] = $this->requestmicrochipModel->get_requests(null, null, 0, 0, $where_not_in)->result();
		$this->load->view('backend/view_request_microchip', $data);
	}

	public function approve()
	{
		if ($this->uri->segment(4)){
			$req_id = $this->uri->segment(4);
			$dataReq = array(
				'req_updated_at' => date('Y-m-d H:i:s'),
				'req_updated_by' => $this->session->userdata('use_id'),
				'req_stat_id' => $this->config->item('accepted')
			);

			$whereReq['req_id'] = $req_id;
			$request = $this->requestmicrochipModel->get_requests($whereReq)->row();
			$dataLog = array(
				'log_req_id' => $req_id,
				'log_mem_id' => $request->req_mem_id,
				'log_can_id' => $request->req_can_id,
				'log_stat_id' => $this->config->item('accepted'),
				'log_created_at' => date('Y-m-d H:i:s', strtotime($request->req_created_at)),
				'log_updated_at' => date('Y-m-d H:i:s'),
				'log_updated_by' => $this->session->userdata('use_id'),
				'log_datetime' => date('Y-m-d H:i:s', strtotime($request->req_datetime)),
				'log_reject_note' => $request->req_reject_note,
				'log_pay_photo' => $request->req_pay_photo,
				'log_pay_id' => $request->req_pay_id,
				'log_pay_invoice' => $request->req_pay_invoice,
				'log_pay_due_date' => $request->req_pay_due_date
			);
	
			$err = 0;
			$this->db->trans_strict(FALSE);
			$this->db->trans_start();
			$whereReq['req_id'] = $req_id;
			$requests = $this->requestmicrochipModel->update_requests($dataReq, $whereReq);
			if ($requests) {
				$log = $this->logrequestMicrochipModel->add_log($dataLog);
				if($log){
					$result = $this->notification_model->add(37, $req_id, $request->req_mem_id, "Microchip untuk anjing / Microchip for dog: ".$request->can_a_s);
					if ($result){
						$this->db->trans_complete();
						$this->session->set_flashdata('approve_success', true);
						redirect("backend/Requestmicrochip");
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
				$this->session->set_flashdata('error_message', 'Failed to approve request. Error code: '.$err);
				redirect('backend/Requestmicrochip');
			}
		}
		else{
			redirect('backend/Requestmicrochip');
		}
	}
	public function complete()
	{
		if ($this->uri->segment(4)){
			$req_id = $this->uri->segment(4);
			$dataReq = array(
				'req_updated_at' => date('Y-m-d H:i:s'),
				'req_updated_by' => $this->session->userdata('use_id'),
				'req_stat_id' => $this->config->item('micro_implanted')
			);

			$whereReq['req_id'] = $req_id;
			$request = $this->requestmicrochipModel->get_requests($whereReq)->row();
			$dataLog = array(
				'log_req_id' => $req_id,
				'log_mem_id' => $request->req_mem_id,
				'log_can_id' => $request->req_can_id,
				'log_stat_id' => $this->config->item('micro_implanted'),
				'log_created_at' => date('Y-m-d H:i:s', strtotime($request->req_created_at)),
				'log_updated_at' => date('Y-m-d H:i:s'),
				'log_updated_by' => $this->session->userdata('use_id'),
				'log_datetime' => date('Y-m-d H:i:s', strtotime($request->req_datetime)),
				'log_reject_note' => $request->req_reject_note,
				'log_pay_photo' => $request->req_pay_photo,
				'log_pay_id' => $request->req_pay_id,
				'log_pay_invoice' => $request->req_pay_invoice,
				'log_pay_due_date' => $request->req_pay_due_date
			);
	
			$err = 0;
			$this->db->trans_strict(FALSE);
			$this->db->trans_start();
			$whereReq['req_id'] = $req_id;
			$requests = $this->requestmicrochipModel->update_requests($dataReq, $whereReq);
			if ($requests) {
				$log = $this->logrequestMicrochipModel->add_log($dataLog);
				if($log){
					$result = $this->notification_model->add(39, $req_id, $request->req_mem_id, "Microchip untuk anjing / Microchip for dog: ".$request->can_a_s);
					if ($result){
						$this->db->trans_complete();
						$this->session->set_flashdata('complete_success', true);
						redirect("backend/Requestmicrochip");
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
				$this->session->set_flashdata('error_message', 'Failed to complete request. Error code: '.$err);
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
						'log_pay_photo' => $request->req_pay_photo,
						'log_pay_id' => $request->req_pay_id,
						'log_pay_invoice' => $request->req_pay_invoice,
						'log_pay_due_date' => $request->req_pay_due_date
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
							$result = $this->notification_model->add(38, $req_id, $request->req_mem_id, "Microchip untuk anjing / Microchip for dog: ".$request->can_a_s);
							if ($result){
								$this->db->trans_complete();
								$this->session->set_flashdata('reject_success', true);
								redirect("backend/Requestmicrochip");
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
	public function log(){
        if ($this->uri->segment(4)){
            $where['log_req_id'] = $this->uri->segment(4);
            $data['request'] = $this->logrequestMicrochipModel->get_logs($where)->result();
            $this->load->view('backend/log_request_microchip', $data);
        }
        else{
            redirect('backend/Requestmicrochip');
        }
    }
	public function edit()
	{
		if ($this->uri->segment(4)){
			$req_id = $this->uri->segment(4);
			$whereReq['req_id'] = $req_id;
			$data['request'] = $this->requestmicrochipModel->get_requests($whereReq)->row();
            $data['status'] = $this->MicrochipStatusModel->get_status()->result();

			$data['mode'] = 0;
			if ($data['request']) {
				$this->load->view("backend/edit_request_microchip", $data);
			} else {
				redirect('backend/Requestmicrochip');
			}
		}
		else{
			redirect('backend/Requestmicrochip');
		}
	}
	public function validate_edit(){ 
        if ($this->session->userdata('use_username')) {
            $this->form_validation->set_error_delimiters('<div>', '</div>');
            $this->form_validation->set_rules('req_datetime', 'Appointment Date ', 'trim|required');

			$req_id = $this->input->post('req_id');
			$whereReq['req_id'] = $req_id;
			$data['request'] = $this->requestmicrochipModel->get_requests($whereReq)->row();

            $data['status'] = $this->MicrochipStatusModel->get_status()->result();
			$data['mode'] = 1;

            if ($this->form_validation->run() == FALSE) {
                $this->load->view('backend/edit_request_microchip', $data);
            } else {
				$err = 0;

				$appointmentDate = date('Y-m-d H:i:s', strtotime($this->input->post('req_datetime')));
				$rejectNote = $this->input->post('req_reject_note');

				$dataReq = array(
					'req_stat_id' => $this->input->post('req_stat_id'),
					'req_updated_at' => date('Y-m-d H:i:s'),
					'req_updated_by' => $this->session->userdata('use_id'),
					'req_datetime' => $appointmentDate,
					'req_reject_note' => $rejectNote
				);

				$dataLog = array(
					'log_req_id' => $data['request']->req_id,
					'log_mem_id' => $data['request']->req_mem_id,
					'log_can_id' => $data['request']->req_can_id,
					'log_stat_id' => $this->input->post('req_stat_id'),
					'log_created_at' => $data['request']->req_created_at,
					'log_updated_at' => date('Y-m-d H:i:s'),
					'log_updated_by' => $this->session->userdata('use_id'),
					'log_datetime' => $appointmentDate,
					'log_reject_note' => $rejectNote,
					'log_pay_photo' => $data['request']->req_pay_photo,
					'log_pay_id' => $data['request']->req_pay_id,
					'log_pay_invoice' => $data['request']->req_pay_invoice,
					'log_pay_due_date' => $data['request']->req_pay_due_date
				);

				if (!$err) {
					$this->db->trans_strict(FALSE);
					$this->db->trans_start();
					$request = $this->requestmicrochipModel->update_requests($dataReq, $whereReq);
					if ($request) {
						$log = $this->logrequestMicrochipModel->add_log($dataLog);
						if ($log){
							$this->db->trans_complete();
							$this->session->set_flashdata('edit_success', true);
							redirect("backend/Requestmicrochip");
						}
						else{
							$err = 2;
						}
					} else {
						$err = 3;
					}
				}

				if ($err) {
					$this->db->trans_rollback();
					$this->session->set_flashdata('error_message', 'Failed to edit request with id = '.$this->input->post('req_id').'. Error code: '.$err);
					$this->load->view('backend/edit_request_microchip', $data);
				}
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
		$data['status'] = $this->MicrochipStatusModel->get_status()->result();
		$this->load->view("backend/add_request_microchip", $data);
	}
	public function search_member(){
		$like['mem_name'] = $this->input->post('mem_name');
		$where['mem_stat'] = $this->config->item('accepted');
		$where['mem_id !='] = $this->config->item('no_member');
		$member = $this->memberModel->search_members($like, $where, 'mem_id desc')->result();
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
			$data['member'] = [];
			$data['canine'] = [];

            $this->form_validation->set_error_delimiters('<div>', '</div>');
            $this->form_validation->set_rules('req_mem_id', 'Member ', 'trim|required');
            $this->form_validation->set_rules('req_can_id', 'Dog ', 'trim|required');
            $this->form_validation->set_rules('req_datetime', 'Appointment Date ', 'trim|required');

			$data['status'] = $this->MicrochipStatusModel->get_status()->result();

			if($this->input->post('req_mem_id')){
				$like['mem_name'] = $this->input->post('mem_name');
				$where['mem_stat'] = $this->config->item('accepted');
				$where['mem_id !='] = $this->config->item('no_member');
				$data['member'] = $this->memberModel->search_members($like, $where, 'mem_id asc')->result();
			}

			$wheCan['can_member_id'] = $this->input->post('mem_id');
			$wheCan['can_stat'] = $this->config->item('accepted');
			$canine = $this->caninesModel->search_canines(null, $wheCan)->result();

			$whereCan['can_id'] = $this->input->post('req_can_id');
			$dogData = $this->caninesModel->get_canines($whereCan)->row();

            if ($this->form_validation->run() == FALSE) {
                $this->load->view('backend/add_request_microchip', $data);
            } else {
				$appointmentDate = date('Y-m-d H:i:s', strtotime($this->input->post('req_datetime')));

				$proof = '-';
				if (isset($_POST['attachment_proof']) && !empty($_POST['attachment_proof'])){
					$uploadedImg = $_POST['attachment_proof'];
					$image_array_1 = explode(";", $uploadedImg);
					$image_array_2 = explode(",", $image_array_1[1]);
					$uploadedImg = base64_decode($image_array_2[1]);
		
					if ((strlen($uploadedImg) > $this->config->item('file_size'))) {
						$err = 1;
						$this->session->set_flashdata('error_message', 'The file size is too big (> 1 MB).');
					}
		
					$img_name = $this->config->item('path_payment').$this->config->item('file_name_payment');
					if (!is_dir($this->config->item('path_payment')) or !is_writable($this->config->item('path_payment'))) {
						$err++;
						$this->session->set_flashdata('error_message', 'Payment folder not found or not writable.');
					} else{
						if (is_file($img_name) and !is_writable($img_name)) {
							$err++;
							$this->session->set_flashdata('error_message', 'File already exists and not writable.');
						}
					}
				}

				if (isset($uploadedImg)){
					file_put_contents($img_name, $uploadedImg);
					$proof = str_replace($this->config->item('path_payment'), '', $img_name);
				}

				$dataReq = array(
					'req_mem_id' => $this->input->post('req_mem_id'),
					'req_can_id' => $this->input->post('req_can_id'),
					'req_stat_id' => $this->input->post('req_stat_id'),
					'req_created_at' => date('Y-m-d H:i:s'),
					'req_updated_at' => date('Y-m-d H:i:s'),
					'req_updated_by' => $this->session->userdata('use_id'),
					'req_datetime' => $appointmentDate,
					'req_reject_note' => $this->input->post('req_reject_note'),
					'req_pay_photo' => $proof
				);

				$dataLog = array(
					'log_mem_id' => $this->input->post('req_mem_id'),
					'log_can_id' => $this->input->post('req_can_id'),
					'log_stat_id' => $this->input->post('req_stat_id'),
					'log_created_at' => date('Y-m-d H:i:s'),
					'log_updated_at' => date('Y-m-d H:i:s'),
					'log_updated_by' => $this->session->userdata('use_id'),
					'log_datetime' => $appointmentDate,
					'log_reject_note' => $this->input->post('req_reject_note'),
					'log_pay_photo' => $proof
				);

				$this->db->trans_strict(FALSE);
				$this->db->trans_start();
				$requests = $this->requestmicrochipModel->add_requests($dataReq);
				if ($requests) {
					$insertedID = $this->db->insert_id();
					$dataLog['log_req_id'] = $insertedID;

					$log = $this->logrequestMicrochipModel->add_log($dataLog);
					if ($log){
						if($this->input->post('req_stat_id') == 1){
							$result = $this->notification_model->add(37, $insertedID, $this->input->post('req_mem_id'), "Microchip untuk anjing / Microchip for dog: ".$dogData->can_a_s);
							if ($result){
								$this->db->trans_complete();
								$this->session->set_flashdata('add_success', true);
								redirect("backend/Requestmicrochip");
							}
							else{
								$err = 1;
							}
						}
						else if($this->input->post('ord_stat_id') == 2){
							$result = $this->notification_model->add(38, $insertedID, $this->input->post('req_mem_id'), "Microchip untuk anjing / Microchip for dog: ".$dogData->can_a_s);
							if ($result){
								$this->db->trans_complete();
								$this->session->set_flashdata('add_success', true);
								redirect("backend/Requestmicrochip");
							}
							else{
								$err = 1;
							}
						}
						else if($this->input->post('ord_stat_id') == 3){
							$result = $this->notification_model->add(39, $insertedID, $this->input->post('req_mem_id'), "Microchip untuk anjing / Microchip for dog: ".$dogData->can_a_s);
							if ($result){
								$this->db->trans_complete();
								$this->session->set_flashdata('add_success', true);
								redirect("backend/Requestmicrochip");
							}
							else{
								$err = 1;
							}
						}
						else{
							$this->db->trans_complete();
							$this->session->set_flashdata('add_success', true);
							redirect("backend/Requestmicrochip");
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
					$this->session->set_flashdata('error_message', 'Failed to save microchip request. Error code: '.$err);
					$this->load->view('backend/add_request_microchip', $data);
				}
            }
        } 
        else {
            redirect("backend/Users/login");
        }
    }
	function updateExpired(){
        $this->db->trans_strict(FALSE);
        $this->db->trans_start();

        //update all expired payment canine status
        $requests = $this->requestmicrochipModel->update_expired_requests();
        
        if ($requests) {
            $this->db->trans_complete();
            return true;
        } else {
            $this->db->trans_rollback();
            return false;
        }
	}
}
