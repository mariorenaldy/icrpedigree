<?php
defined('BASEPATH') OR exit('No direct script access allowed');

#[\AllowDynamicProperties]

class Requestexport extends CI_Controller {
		public function __construct(){
			// Call the CI_Controller constructor
			parent::__construct();
			$this->load->model(array('requestexportModel', 'memberModel', 'notification_model', 'notificationtype_model'));
			$this->load->library(array('session', 'form_validation'));
			$this->load->helper(array('form', 'url', 'notif'));
			$this->load->database();
			date_default_timezone_set("Asia/Bangkok");
		}

		public function index(){
			$where['req_stat'] = $this->config->item('saved');
			$data['req'] = $this->requestexportModel->get_requests($where)->result();
			$this->load->view('backend/view_request_export', $data);
        }

		public function search(){
			$like['mem_name'] = $this->input->post('keywords');
			$like['ken_name'] = $this->input->post('keywords');
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
                            $notif = $this->notificationtype_model->get_by_id(30);
                            $whe_member['mem_id'] = $req->req_member_id;
                            $member = $this->memberModel->get_members($whe_member)->row();
                            if ($member->mem_firebase_token){
                                firebase_notif($member->mem_firebase_token, $notif[0]->title, $notif[0]->description);
                            }
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
							$notif = $this->notificationtype_model->get_by_id(31);
							$whe_member['mem_id'] = $req->req_member_id;
							$member = $this->memberModel->get_members($whe_member)->row();
							if ($member->mem_firebase_token){
								firebase_notif($member->mem_firebase_token, $notif[0]->title, $notif[0]->description);
							}
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
}
