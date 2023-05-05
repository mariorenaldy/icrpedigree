<?php
defined('BASEPATH') OR exit('No direct script access allowed');

#[\AllowDynamicProperties]

class Requestupdatecanine extends CI_Controller {
		public function __construct(){
			// Call the CI_Controller constructor
			parent::__construct();
			$this->load->model(array('requestupdatecanineModel', 'caninesModel', 'memberModel', 'logcanineModel', 'notification_model', 'notificationtype_model'));
			$this->load->library(array('session', 'form_validation'));
			$this->load->helper(array('form', 'url', 'notif'));
			$this->load->database();
			date_default_timezone_set("Asia/Bangkok");
		}

		public function index(){
			$where['req_stat'] = $this->config->item('saved');
			$where['kennels.ken_stat'] = $this->config->item('accepted');
			$data['req'] = $this->requestupdatecanineModel->get_requests($where)->result();
			$this->load->view('backend/view_request_update_canine', $data);
        }

		public function search(){
			$like['can_a_s'] = $this->input->post('keywords');
            $where['req_stat'] = $this->config->item('saved');
			$where['kennels.ken_stat'] = $this->config->item('accepted');
			$data['req'] = $this->requestupdatecanineModel->search_requests($like, $where)->result();
			$this->load->view('backend/view_request_update_canine', $data);
        }

		public function approve(){
			if ($this->uri->segment(4)){
				if ($this->session->userdata('use_username')){
					$err = 0;
					$wheReq['req_id'] = $this->uri->segment(4);
					$req = $this->requestupdatecanineModel->get_requests($wheReq)->row();

					$dataReq['req_app_user'] = $this->session->userdata('use_id');
					$dataReq['req_app_date'] = date('Y-m-d H:i:s');
					$dataReq['req_stat'] = $this->config->item('accepted');
					
					$this->db->trans_strict(FALSE);
					$this->db->trans_start();
					$result = $this->requestupdatecanineModel->update_requests($dataReq, $wheReq);
					if ($result){
						$dataCan['can_user'] = $this->session->userdata('use_id');
						$dataCan['can_date'] = date('Y-m-d H:i:s');
						if ($req->req_photo != '-')
							$dataCan['can_photo'] = $req->req_photo;
						$dataCan['can_rip'] = $req->req_rip;
						$wheCan['can_id'] = $req->req_can_id;
						$res = $this->caninesModel->update_canines($dataCan, $wheCan);
						if ($res){
							$dataLog = array(
								'log_canine_id' => $req->req_can_id,
								'log_photo' => $req->req_photo,
								'log_user' => $this->session->userdata('use_id'),
								'log_date' => date('Y-m-d H:i:s'),
								'log_rip' => $req->req_rip,
							);
							$log = $this->logcanineModel->add_log($dataLog);
							if ($log){
								$wheCan['can_id'] = $req->req_can_id;
								$can = $this->caninesModel->get_canines($wheCan)->row();
								$result = $this->notification_model->add(22, $this->uri->segment(4), $req->req_member_id, 'Nama anjing / Canine name: '.$can->can_a_s);
								if ($result){
									$this->db->trans_complete();
									$notif = $this->notificationtype_model->get_by_id(22);
									$whe['mem_id'] = $req->req_member_id;
									$member = $this->memberModel->get_members($whe)->row();
									if ($member->mem_firebase_token){
										firebase_notif($member->mem_firebase_token, $notif[0]->title, $notif[0]->description);
									}
									$this->session->set_flashdata('approve', TRUE);
									redirect('backend/Requestupdatecanine');
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
						$this->session->set_flashdata('error_message', 'Failed to approve update photo & RIP id = '.$this->uri->segment(4).'. Err code: '.$err);
						redirect('backend/Requestupdatecanine');
					}
				}
				else{
					redirect("backend/Users/login");
				}
			}
			else{
				redirect("backend/Requestupdatecanine");
			}
		}

		public function reject(){
			if ($this->uri->segment(4)){
				if ($this->session->userdata('use_username')){
					$err = 0;
					$wheReq['req_id'] = $this->uri->segment(4);
					$req = $this->requestupdatecanineModel->get_requests($wheReq)->row();

					$dataReq['req_app_user'] = $this->session->userdata('use_id');
					$dataReq['req_app_date'] = date('Y-m-d H:i:s');
					$dataReq['req_stat'] = $this->config->item('rejected');
					if ($this->uri->segment(5)){
						$dataReq['req_app_note'] = urldecode($this->uri->segment(5));
					}
					
					$this->db->trans_strict(FALSE);
					$this->db->trans_start();
					$update = $this->requestupdatecanineModel->update_requests($dataReq, $wheReq);
					if ($update){
						$wheCan['can_id'] = $req->req_can_id;
						$can = $this->caninesModel->get_canines($wheCan)->row();
						$result = $this->notification_model->add(23, $this->uri->segment(4), $req->req_member_id, 'Nama anjing / Canine name: '.$can->can_a_s);
						if ($result){
							$this->db->trans_complete();
							$notif = $this->notificationtype_model->get_by_id(23);
							$whe['mem_id'] = $req->req_member_id;
							$member = $this->memberModel->get_members($whe)->row();
							if ($member->mem_firebase_token){
								firebase_notif($member->mem_firebase_token, $notif[0]->title, $notif[0]->description);
							}
							$this->session->set_flashdata('reject', TRUE);
							redirect('backend/Requestupdatecanine');
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
						$this->session->set_flashdata('error_message', 'Failed to reject update photo & RIP id = '.$this->uri->segment(4).'. Err code: '.$err);
						redirect('backend/Requestupdatecanine');
					}
				}
				else{
					redirect("backend/Users/login");
				}
			}
			else{
				redirect("backend/Requestupdatecanine");
			}
		}
}
