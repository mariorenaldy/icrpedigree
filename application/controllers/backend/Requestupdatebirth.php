<?php
defined('BASEPATH') OR exit('No direct script access allowed');

#[\AllowDynamicProperties]

class Requestupdatebirth extends CI_Controller {
		public function __construct(){
			// Call the CI_Controller constructor
			parent::__construct();
			$this->load->model(array('requestupdatebirthModel', 'birthModel', 'logbirthModel', 'memberModel', 'notification_model', 'notificationtype_model'));
			$this->load->library(array('session', 'form_validation'));
			$this->load->helper(array('form', 'url'));
			$this->load->database();
			date_default_timezone_set("Asia/Bangkok");
		}

		public function index(){
			$where['req_stat'] = $this->config->item('saved');
			$where['kennels.ken_stat'] = $this->config->item('accepted');
			$data['req'] = $this->requestupdatebirthModel->get_requests($where)->result();
			$this->load->view('backend/view_request_update_birth', $data);
        }

		public function search(){
			$date = '';
			$piece = explode("-", $this->input->post('date'));
			if (count($piece) == 3){
				$date = $piece[2]."-".$piece[1]."-".$piece[0];
			}
			if ($date){
				$like['req_date_of_birth'] = $date;
				$like['req_old_date_of_birth'] = $date;
			}
            $where['req_stat'] = $this->config->item('saved');
			$where['kennels.ken_stat'] = $this->config->item('accepted');
			$like['can_sire.can_a_s'] = $this->input->post('keywords');
			$like['can_dam.can_a_s'] = $this->input->post('keywords');
			$data['req'] = $this->requestupdatebirthModel->search_requests($like, $where)->result();
			$this->load->view('backend/view_request_update_birth', $data);
        }

		public function approve(){
			if ($this->uri->segment(4)){
				if ($this->session->userdata('use_username')){
					$err = 0;
					$wheReq['req_id'] = $this->uri->segment(4);
					$req = $this->requestupdatebirthModel->get_requests($wheReq)->row();

					$dataReq['req_app_user'] = $this->session->userdata('use_id');
					$dataReq['req_app_date'] = date('Y-m-d H:i:s');
					$dataReq['req_stat'] = $this->config->item('accepted');
					
					$this->db->trans_strict(FALSE);
					$this->db->trans_start();
					$result = $this->requestupdatebirthModel->update_requests($dataReq, $wheReq);
					if ($result){
						$dataBirth['bir_user'] = $this->session->userdata('use_id');
						$dataBirth['bir_date'] = date('Y-m-d H:i:s');
						if ($req->req_dam_photo != '-')
							$dataBirth['bir_dam_photo'] = $req->req_dam_photo;
						$piece = explode("-", $req->req_date_of_birth);
						$date = $piece[2]."-".$piece[1]."-".$piece[0]; 
						$dataBirth['bir_date_of_birth'] = $date;
						$dataBirth['bir_male'] = $req->req_male;
						$dataBirth['bir_female'] = $req->req_female;
						$wheBirth['bir_id'] = $req->req_bir_id;
						$res = $this->birthModel->update_births($dataBirth, $wheBirth);
						if ($res){
							$dataLog = array(
								'log_bir_id' => $req->req_bir_id,
								'log_dam_photo' => $req->req_dam_photo,
								'log_date_of_birth' => $date,
								'log_male' => $req->req_male,
								'log_female' => $req->req_female,
								'log_user' => $this->session->userdata('use_id'),
								'log_date' => date('Y-m-d H:i:s'),
							);
							$log = $this->logbirthModel->add_log($dataLog);
							if ($log){
								$wheBirth['bir_id'] = $req->req_bir_id;
								$birth = $this->birthModel->get_births($wheBirth)->row();
								$result = $this->notification_model->add(15, $this->uri->segment(4), $req->req_member_id, "Nama jantan / Sire name: ".$birth->sire.'<br>Nama betina / Dam name: '.$birth->dam);
								if ($result){
									$this->db->trans_complete();
									$this->session->set_flashdata('approve', TRUE);
									redirect('backend/Requestupdatebirth');
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
						$this->session->set_flashdata('error_message', 'Failed to approve update birth id = '.$this->uri->segment(4).'. Err code: '.$err);
						redirect('backend/Requestupdatebirth');
					}
				}
				else{
					redirect("backend/Users/login");
				}
			}
			else{
				redirect("backend/Requestupdatebirth");
			}
		}

		public function reject(){
			if ($this->uri->segment(4)){
				if ($this->session->userdata('use_username')){
					$err = 0;
					$wheReq['req_id'] = $this->uri->segment(4);
					$req = $this->requestupdatebirthModel->get_requests($wheReq)->row();

					$dataReq['req_app_user'] = $this->session->userdata('use_id');
					$dataReq['req_app_date'] = date('Y-m-d H:i:s');
					$dataReq['req_stat'] = $this->config->item('rejected');
					if ($this->uri->segment(5)){
						$dataReq['req_app_note'] = urldecode($this->uri->segment(5));
					}

					$this->db->trans_strict(FALSE);
					$this->db->trans_start();
					$update = $this->requestupdatebirthModel->update_requests($dataReq, $wheReq);
					if ($update){
						$wheBirth['bir_id'] = $req->req_bir_id;
						$birth = $this->birthModel->get_births($wheBirth)->row();
						$result = $this->notification_model->add(16, $this->uri->segment(4), $req->req_member_id, "Nama jantan / Sire name: ".$birth->sire.'<br>Nama betina / Dam name: '.$birth->dam);
						if ($result){
							$this->db->trans_complete();
							$this->session->set_flashdata('reject', TRUE);
							redirect('backend/Requestupdatebirth');
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
						$this->session->set_flashdata('error_message', 'Failed to reject update birth id = '.$this->uri->segment(4).'. Err code: '.$err);
						redirect('backend/Requestupdatebirth');
					}
				}
				else{
					redirect("backend/Users/login");
				}
			}
			else{
				redirect("backend/Requestupdatebirth");
			}
		}
}
