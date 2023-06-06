<?php
defined('BASEPATH') OR exit('No direct script access allowed');

#[\AllowDynamicProperties]

class Requestreset extends CI_Controller {
		public function __construct(){
			// Call the CI_Controller constructor
			parent::__construct();
			$this->load->model(array('requestresetModel', 'memberModel'));
			$this->load->library(array('session', 'form_validation'));
			$this->load->helper(array('form', 'url'));
			$this->load->database();
			date_default_timezone_set("Asia/Bangkok");
		}

		public function index(){
			$where['req_stat'] = $this->config->item('saved');
			$where['kennels.ken_stat'] = $this->config->item('accepted');
			$data['request'] = $this->requestresetModel->get_requests($where)->result();
			$this->load->view('backend/view_request_reset', $data);
        }

		public function search(){
			$like['mem_name'] = $this->input->post('keywords');
			$like['ken_name'] = $this->input->post('keywords');
            $where['req_stat'] = $this->config->item('saved');
			$where['kennels.ken_stat'] = $this->config->item('accepted');
			$data['request'] = $this->requestresetModel->search_requests($like, $where)->result();
			$this->load->view('backend/view_request_reset', $data);
        }

		public function approve(){
			if ($this->uri->segment(4)){
				if ($this->session->userdata('use_username')){
					$err = 0;
					$wheReq['req_id'] = $this->uri->segment(4);
					$req = $this->requestresetModel->get_requests($wheReq)->row();

					$dataReq['req_app_user'] = $this->session->userdata('use_id');
					$dataReq['req_app_date'] = date('Y-m-d H:i:s');
					$dataReq['req_stat'] = $this->config->item('accepted');
					
					$this->db->trans_strict(FALSE);
					$this->db->trans_start();
					$result = $this->requestresetModel->update_requests($dataReq, $wheReq);
					if ($result){
						$wheMember['mem_id'] = $req->req_member_id;
						$member = $this->memberModel->get_members($wheMember)->row();
						$dataMember = array(
							'mem_password' => sha1($member->mem_hp),
							'mem_user' => $this->session->userdata('use_id'),
							'mem_date' => date('Y-m-d H:i:s'),
						);
						$res = $this->memberModel->update_members($dataMember, $wheMember);
						if ($res){
							$this->db->trans_complete();
							$this->session->set_flashdata('success', TRUE);
							redirect('backend/Requestreset');
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
						$this->session->set_flashdata('error_message', 'Failed to approve reset password id = '.$this->uri->segment(4).'. Err code: '.$err);
						redirect('backend/Requestreset');
					}
				}
				else{
					redirect("backend/Users/login");
				}
			}
			else{
				redirect("backend/Requestreset");
			}
		}

		public function reject(){
			if ($this->uri->segment(4)){
				if ($this->session->userdata('use_username')){
					$err = 0;
					$wheReq['req_id'] = $this->uri->segment(4);
					$req = $this->requestresetModel->get_requests($wheReq)->row();

					$dataReq['req_app_user'] = $this->session->userdata('use_id');
					$dataReq['req_app_date'] = date('Y-m-d H:i:s');
					$dataReq['req_stat'] = $this->config->item('rejected');
					if ($this->uri->segment(5)){
						$dataReq['req_app_note'] = urldecode($this->uri->segment(5));
					}
					
					$update = $this->requestresetModel->update_requests($dataReq, $wheReq);
					if ($update){
						$this->session->set_flashdata('reject', TRUE);
						redirect('backend/Requestreset');
					}
					else{
						$this->session->set_flashdata('error_message', 'Failed to reject reset password id = '.$this->uri->segment(4).'. Err code: '.$err);
						redirect('backend/Requestreset');
					}
				}
				else{
					redirect("backend/Users/login");
				}
			}
			else{
				redirect("backend/Requestreset");
			}
		}
}
