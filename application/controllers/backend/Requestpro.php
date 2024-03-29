<?php
defined('BASEPATH') OR exit('No direct script access allowed');

#[\AllowDynamicProperties]

class Requestpro extends CI_Controller {
		public function __construct(){
			// Call the CI_Controller constructor
			parent::__construct();
			$this->load->model(array('requestproModel', 'memberModel', 'kennelModel', 'logmemberModel', 'logkennelModel', 'notification_model', 'notificationtype_model'));
			$this->load->library(array('session', 'form_validation'));
			$this->load->helper(array('form', 'url', 'notif'));
			$this->load->database();
			date_default_timezone_set("Asia/Bangkok");
		}

		public function index(){
			$where['req_stat'] = $this->config->item('saved');
			$where['kennels.ken_stat'] = $this->config->item('accepted');
			$data['request'] = $this->requestproModel->get_requests($where)->result();
			$this->load->view('backend/view_request_pro', $data);
        }

		public function search(){
			$like['mem_name'] = $this->input->post('keywords');
			$like['ken_name'] = $this->input->post('keywords');
            $where['req_stat'] = $this->config->item('saved');
			$where['kennels.ken_stat'] = $this->config->item('accepted');
			$data['request'] = $this->requestproModel->search_requests($like, $where)->result();
			$this->load->view('backend/view_request_pro', $data);
        }

		public function approve(){
			if ($this->uri->segment(4)){
				if ($this->session->userdata('use_username')){
					$err = 0;
					$wheReq['req_id'] = $this->uri->segment(4);
					$req = $this->requestproModel->get_requests($wheReq)->row();

					$dataReq['req_app_user'] = $this->session->userdata('use_id');
					$dataReq['req_app_date'] = date('Y-m-d H:i:s');
					$dataReq['req_stat'] = $this->config->item('accepted');
					
					$this->db->trans_strict(FALSE);
					$this->db->trans_start();
					$result = $this->requestproModel->update_requests($dataReq, $wheReq);
					if ($result){
						$dataMember = array(
							'mem_name' => $req->req_name,
							'mem_address' => $req->req_address,
							'mem_mail_address' => $req->req_mail_address,
							'mem_hp' => $req->req_hp,
							'mem_kota' => $req->req_kota,
							'mem_kode_pos' => $req->req_kode_pos,
							'mem_email' => $req->req_email,
							'mem_ktp' => $req->req_ktp,
							'mem_user' => $this->session->userdata('use_id'),
							'mem_date' => date('Y-m-d H:i:s'),
							'mem_app_user' => $this->session->userdata('use_id'),
							'mem_app_date' => date('Y-m-d H:i:s'),
							'mem_stat' => $this->config->item('accepted'),
							'mem_type' => $this->config->item('pro_member'),
						);
						$wheMember['mem_id'] = $req->req_member_id;
						$res = $this->memberModel->update_members($dataMember, $wheMember);
						if ($res){
							$dataKennel = array(
								'ken_name' => $req->req_kennel_name,
								'ken_type_id' => $req->req_kennel_type_id,
								'ken_user' => $this->session->userdata('use_id'),
								'ken_date' => date('Y-m-d H:i:s'),
								'ken_app_user' => $this->session->userdata('use_id'),
								'ken_app_date' => date('Y-m-d H:i:s'),
								'ken_stat' => $this->config->item('accepted'),
							);
							if ($req->req_kennel_photo != '-')
								$dataKennel['ken_photo'] = $req->req_kennel_photo;
							$wheKennel['ken_id'] = $req->req_kennel_id;
							$result = $this->kennelModel->update_kennels($dataKennel, $wheKennel);
							if ($result){
								$dataLog = array(
									'log_member_id' => $req->req_member_id,
									'log_name' => $req->req_name,
									'log_address' => $req->req_address,
									'log_mail_address' => $req->req_mail_address,
									'log_hp' => $req->req_hp,
									'log_kota' => $req->req_kota,
									'log_kode_pos' => $req->req_kode_pos,
									'log_email' => $req->req_email,
									'log_ktp' => $req->req_ktp,
									'log_user' => $this->session->userdata('use_id'),
									'log_date' => date('Y-m-d H:i:s'),
									'log_app_user' => $this->session->userdata('use_id'),
									'log_app_date' => date('Y-m-d H:i:s'),
									'log_stat' => $this->config->item('accepted'),
									'log_mem_type' => $this->config->item('pro_member'),
								);
								$log = $this->logmemberModel->add_log($dataLog);
								if ($log){
									$dataKennelLog = array(
										'log_kennel_id' => $req->req_kennel_id,
										'log_kennel_name' => $req->req_kennel_name,
										'log_kennel_type_id' => $req->req_kennel_type_id,
										'log_user' => $this->session->userdata('use_id'),
										'log_date' => date('Y-m-d H:i:s'),
										'log_app_user' => $this->session->userdata('use_id'),
										'log_app_date' => date('Y-m-d H:i:s'),
										'log_stat' => $this->config->item('accepted'),
									);
									if ($req->req_kennel_photo != '-')
										$dataKennelLog['log_kennel_photo'] = $req->req_kennel_photo;
									$result = $this->logkennelModel->add_log($dataKennelLog);
									if ($result){
										$res = $this->notification_model->add(26, $this->uri->segment(4), $req->req_member_id);
										if ($res){
											$this->db->trans_complete();
											$notif = $this->notificationtype_model->get_by_id(26);
											$whe_member['mem_id'] = $req->req_member_id;
											$member = $this->memberModel->get_members($whe_member)->row();
											if ($member->mem_firebase_token){
												firebase_notif($member->mem_firebase_token, $notif[0]->title, $notif[0]->description);
											}
											$this->session->set_flashdata('approve', TRUE);
											redirect('backend/Requestpro');
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
						$this->session->set_flashdata('error_message', 'Failed to approve kennel id = '.$this->uri->segment(4).'. Err code: '.$err);
						redirect('backend/Requestpro');
					}
				}
				else{
					redirect("backend/Users/login");
				}
			}
			else{
				redirect("backend/Requestpro");
			}
		}

		public function reject(){
			if ($this->uri->segment(4)){
				if ($this->session->userdata('use_username')){
					$err = 0;
					$wheReq['req_id'] = $this->uri->segment(4);
					$req = $this->requestproModel->get_requests($wheReq)->row();

					$dataReq['req_app_user'] = $this->session->userdata('use_id');
					$dataReq['req_app_date'] = date('Y-m-d H:i:s');
					$dataReq['req_stat'] = $this->config->item('rejected');
					if ($this->uri->segment(5)){
						$dataReq['req_app_note'] = urldecode($this->uri->segment(5));
					}
					
					$this->db->trans_strict(FALSE);
					$this->db->trans_start();
					$update = $this->requestproModel->update_requests($dataReq, $wheReq);
					if ($update){
						$result = $this->notification_model->add(27, $this->uri->segment(4), $req->req_member_id);
						if ($result){
							$this->db->trans_complete();
							$notif = $this->notificationtype_model->get_by_id(27);
							$whe_member['mem_id'] = $req->req_member_id;
							$member = $this->memberModel->get_members($whe_member)->row();
							if ($member->mem_firebase_token){
								firebase_notif($member->mem_firebase_token, $notif[0]->title, $notif[0]->description);
							}
							$this->session->set_flashdata('reject', TRUE);
							redirect('backend/Requestpro');
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
						$this->session->set_flashdata('error_message', 'Failed to reject kennel id = '.$this->uri->segment(4).'. Err code: '.$err);
						redirect('backend/Requestpro');
					}
				}
				else{
					redirect("backend/Users/login");
				}
			}
			else{
				redirect("backend/Requestpro");
			}
		}
}
