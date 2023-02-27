<?php
defined('BASEPATH') OR exit('No direct script access allowed');

#[\AllowDynamicProperties]

class Requestownershipcanine extends CI_Controller {
		public function __construct(){
			// Call the CI_Controller constructor
			parent::__construct();
			$this->load->model(array('requestownershipcanineModel', 'caninesModel', 'memberModel', 'logcanineModel', 'notification_model', 'notificationtype_model'));
			$this->load->library(array('session', 'form_validation'));
			$this->load->helper(array('form', 'url'));
			$this->load->database();
			date_default_timezone_set("Asia/Bangkok");
		}

		public function index(){
			$where['req_stat'] = $this->config->item('saved');
			$data['req'] = $this->requestownershipcanineModel->get_requests($where)->result();
			$this->load->view('backend/view_request_ownership', $data);
        }

		public function search(){
			$like['can_a_s'] = $this->input->post('keywords');
            $where['req_stat'] = $this->config->item('saved');
			$data['req'] = $this->requestownershipcanineModel->search_requests($like, $where)->result();
			$this->load->view('backend/view_request_ownership', $data);
        }

		public function approve(){
			if ($this->uri->segment(4)){
				if ($this->session->userdata('use_username')){
					$err = 0;
					$wheReq['req_id'] = $this->uri->segment(4);
					$req = $this->requestownershipcanineModel->get_requests($wheReq)->row();

					$dataReq['req_app_user'] = $this->session->userdata('use_id');
					$dataReq['req_app_date'] = date('Y-m-d H:i:s');
					$dataReq['req_stat'] = $this->config->item('accepted');
					
					$this->db->trans_strict(FALSE);
					$this->db->trans_start();
					$result = $this->requestownershipcanineModel->update_requests($dataReq, $wheReq);
					if ($result){
						$dataCan['can_user'] = $this->session->userdata('use_id');
						$dataCan['can_date'] = date('Y-m-d H:i:s');
						$dataCan['can_member_id'] = $req->req_member_id;
						$dataCan['can_kennel_id'] = $req->req_kennel_id;
						$wheCan['can_id'] = $req->req_can_id;
						$res = $this->caninesModel->update_canines($dataCan, $wheCan);
						if ($res){
							$dataLog = array(
								'log_canine_id' => $req->req_can_id,
								'log_member_id' => $req->req_member_id,
								'log_kennel_id' => $req->req_kennel_id,
								'log_user' => $this->session->userdata('use_id'),
								'log_date' => date('Y-m-d H:i:s'),
							);
							$log = $this->logcanineModel->add_log($dataLog);
							if ($log){
								$result = $this->notification_model->add(3, $this->uri->segment(4), $req->req_old_member_id);
								if ($result){
									$res = $this->notification_model->add(3, $this->uri->segment(4), $req->req_member_id);
									if ($res){
										$this->db->trans_complete();
										$notif = $this->notificationtype_model->get_by_id(3);
										$whe_old['mem_id'] = $req->req_old_member_id;
										$member_old = $this->memberModel->get_members($whe_old)->row();
										if ($member_old->mem_firebase_token){
											firebase_notif($member_old->mem_firebase_token, $notif[0]->title, $notif[0]->description);
										}
										$whe_new['mem_id'] = $req->req_member_id;
										$member_new = $this->memberModel->get_members($whe_new)->row();
										if ($member_new->mem_firebase_token){
											firebase_notif($member_new->mem_firebase_token, $notif[0]->title, $notif[0]->description);
										}
										$this->session->set_flashdata('approve', TRUE);
										redirect('backend/Requestownershipcanine');
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
					if ($err){
						$this->db->trans_rollback();
						$this->session->set_flashdata('error_message', 'Failed to approve change canine ownership id = '.$this->uri->segment(4).'. Err code: '.$err);
						redirect('backend/Requestownershipcanine');
					}
				}
				else{
					redirect("backend/Users/login");
				}
			}
			else{
				redirect("backend/Requestownershipcanine");
			}
		}

		public function reject(){
			if ($this->uri->segment(4)){
				if ($this->session->userdata('use_username')){
					$err = 0;
					$wheReq['req_id'] = $this->uri->segment(4);
					$req = $this->requestownershipcanineModel->get_requests($wheReq)->row();

					$dataReq['req_app_user'] = $this->session->userdata('use_id');
					$dataReq['req_app_date'] = date('Y-m-d H:i:s');
					$dataReq['req_stat'] = $this->config->item('rejected');
					
					$this->db->trans_strict(FALSE);
					$this->db->trans_start();
					$update = $this->requestownershipcanineModel->update_requests($dataReq, $wheReq);
					if ($update){
						$result = $this->notification_model->add(8, $this->uri->segment(4), $req->req_old_member_id);
						if ($result){
							$res = $this->notification_model->add(8, $this->uri->segment(4), $req->req_member_id);
							if ($res){
								$this->db->trans_complete();
								$notif = $this->notificationtype_model->get_by_id(3);
								$whe_old['mem_id'] = $req->req_old_member_id;
								$member_old = $this->memberModel->get_members($whe_old)->row();
								if ($member_old->mem_firebase_token){
									firebase_notif($member_old->mem_firebase_token, $notif[0]->title, $notif[0]->description);
								}
								$whe_new['mem_id'] = $req->req_member_id;
								$member_new = $this->memberModel->get_members($whe_new)->row();
								if ($member_new->mem_firebase_token){
									firebase_notif($member_new->mem_firebase_token, $notif[0]->title, $notif[0]->description);
								}
								$this->session->set_flashdata('reject', TRUE);
								redirect('backend/Requestownershipcanine');
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
						$this->session->set_flashdata('error_message', 'Failed to reject change canine ownership id = '.$this->uri->segment(4).'. Err code: '.$err);
						redirect('backend/Requestownershipcanine');
					}
				}
				else{
					redirect("backend/Users/login");
				}
			}
			else{
				redirect("backend/Requestownershipcanine");
			}
		}
}
