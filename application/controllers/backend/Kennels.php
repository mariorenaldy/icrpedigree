<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Kennels extends CI_Controller {
		public function __construct(){
			// Call the CI_Controller constructor
			parent::__construct();
			$this->load->model(array('memberModel', 'KenneltypeModel', 'KennelModel', 'notification_model', 'notificationtype_model'));
			$this->load->library('upload', $this->config->item('upload_kennel'));
			$this->load->library(array('session', 'form_validation'));
			$this->load->helper(array('form', 'url'));
			$this->load->database();
			date_default_timezone_set("Asia/Bangkok");
		}

		public function index(){
            $where['ken_stat != '] = 0;
			$data['kennel'] = $this->KennelModel->get_kennels($where)->result();
			$this->load->view('backend/view_kennels', $data);
        }

		public function search(){
			$like['mem_name'] = $this->input->post('keywords');
			$like['ken_name'] = $this->input->post('keywords');
            $where['ken_stat != '] = 0;
			$data['kennel'] = $this->KennelModel->search_kennels($like, $where)->result();
			$this->load->view('backend/view_kennels', $data);
        }

		public function view_approve(){
            $where['ken_stat'] = 0;
			$data['kennel'] = $this->KennelModel->get_kennels($where)->result();
			$this->load->view('backend/approve_kennels', $data);
        }

		public function search_approve(){
			$like['mem_name'] = $this->input->post('keywords');
			$like['ken_name'] = $this->input->post('keywords');
            $where['ken_stat'] = 0;
			$data['kennel'] = $this->KennelModel->search_kennels($like, $where)->result();
			$this->load->view('backend/approve_kennels', $data);
        }

		public function add(){
			$data['kennelType'] = $this->KenneltypeModel->get_kennel_types(null)->result();
			$data['member'] = [];
			$this->load->view("backend/add_kennel", $data);
		}

		public function search_member(){
			$data['kennelType'] = $this->KenneltypeModel->get_kennel_types(null)->result();
		
			$like['mem_name'] = $this->input->post('mem_name');
			$where['mem_stat'] =  1;
			$data['member'] = $this->memberModel->search_members($like, $where)->result();
			$this->load->view("backend/add_kennel", $data);
		}

		public function validate_add(){
			if ($this->session->userdata('username')){
				$this->form_validation->set_error_delimiters('<div>','</div>');
				$this->form_validation->set_message('required', '%s wajib diisi');
				$this->form_validation->set_message('is_unique', '%s tidak boleh sama');
				$this->form_validation->set_rules('ken_name', 'Nama', 'trim|required|is_unique[kennels.ken_name]');
				
				$data['kennelType'] = $this->KenneltypeModel->get_kennel_types(null)->result();

				$like['mem_name'] = $this->input->post('mem_name');
				$where['mem_stat'] =  1;
				$data['member'] = $this->memberModel->search_members($like, $where)->result();
				if ($this->form_validation->run() == FALSE){
					$this->load->view("backend/add_kennel", $data);
				}
				else{
					$err = 0;
					$logo = '-';
					if (isset($_FILES['attachment_logo']) && !empty($_FILES['attachment_logo']['tmp_name']) && is_uploaded_file($_FILES['attachment_logo']['tmp_name'])){
						if (is_uploaded_file($_FILES['attachment_logo']['tmp_name'])){
							$this->upload->initialize($this->config->item('upload_kennel'));
							if ($this->upload->do_upload('attachment_logo')){
								$uploadData = $this->upload->data();
								$logo = $uploadData['file_name'];
							}
							else{
								$err++;
								$this->session->set_flashdata('error_message', $this->upload->display_errors());
							}
						}
					}

					if (!$err && $logo == "-"){
						$err++;
						$this->session->set_flashdata('error_message', 'Foto kennel wajib diisi');
					}

					if (!$err){
						$ken_id = $this->KennelModel->record_count() + 1;
						$kennel_data = array(
							'ken_id' => $ken_id,
							'ken_name' => $this->input->post('ken_name'),
							'ken_type_id' => $this->input->post('ken_type_id'),
							'ken_photo' => $logo,
							'ken_member_id' => $this->input->post('can_member_id'),
							'ken_stat' => 1,
							'ken_app_user' => $this->session->userdata('use_id'),
							'ken_app_date' => date('Y-m-d H:i:s')
						);
						$res = $this->KennelModel->add_kennels($kennel_data);
						if ($res){
							$this->session->set_flashdata('add_success', TRUE);
							redirect("backend/Kennels");
						}
						else{
							$this->session->set_flashdata('error_message', 'Gagal menyimpan kennel');
							$this->load->view("backend/add_kennel", $data);
						}
					}
					else{
						$this->load->view("backend/add_kennel", $data);
					}
				}
			}
			else{
				redirect('backend/Users/login');
			}
		}

		public function approve(){
			if ($this->uri->segment(4)){
				if ($this->session->userdata('use_username')){
					$err = 0;
					$where['ken_id'] = $this->uri->segment(4);
					$ken = $this->KennelModel->get_kennels($where)->row();
					$this->db->trans_strict(FALSE);
					$this->db->trans_start();
					$data['ken_app_user'] = $this->session->userdata('use_id');
					$data['ken_app_date'] = date('Y-m-d H:i:s');
					$data['ken_stat'] = 1;
					$res = $this->KennelModel->update_kennels($data, $where);
					if ($res){
						$res3 = $this->notification_model->add(17, $this->uri->segment(4), $ken->ken_member_id);
						if ($res3){
							$this->db->trans_complete();
							$whe_ken['mem_id'] = $ken->ken_member_id;
							$member = $this->memberModel->get_members($whe_ken)->row();
							if ($member->mem_firebase_token){
								$notif = $this->notificationtype_model->get_by_id(17);
								$url = 'https://fcm.googleapis.com/fcm/send';
								$key = 'AAAALe2LeZU:APA91bEqr2n1PRxkOyOfx8IwYO1O_1gjprFkq1AITOGUu3GYp2ZBi-8-AvM4ADI3m94NEv4cq-uKcMBU3pJXBhO21CyuVgPNX2l7VYXj5IllxEr6sika8eaJp1IgXCHALA5_xYw92pXK';
				
								$fields = array (
								'to' => $member->mem_firebase_token,
								'notification' => array(
									"channelId" => "ICRPedigree",
									'title' => $notif[0]->title,
									'body' => $notif[0]->description
								)
								);
								$fields = json_encode ( $fields );
				
								$headers = array (
									'Authorization: key=' . $key,
									'Content-Type: application/json'
								);
				
								$ch = curl_init ();
								curl_setopt ( $ch, CURLOPT_URL, $url );
								curl_setopt ( $ch, CURLOPT_POST, true );
								curl_setopt ( $ch, CURLOPT_HTTPHEADER, $headers );
								curl_setopt ( $ch, CURLOPT_RETURNTRANSFER, true );
								curl_setopt ( $ch, CURLOPT_POSTFIELDS, $fields );
				
								$result = curl_exec ( $ch );
								// echo $result;
								curl_close ( $ch );
							}
							$this->session->set_flashdata('approve', TRUE);
							redirect('backend/Kennels/view_approve');
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
						$this->session->set_flashdata('error', 'Failed to approve kennel name = '.$ken->ken_name);
						redirect('backend/Kennels/view_approve');
					}
				}
				else{
					redirect("backend/Users/login");
				}
			}
			else{
			  	redirect("backend/Kennels/view_approve");
			}
		}

		public function reject(){
			if ($this->uri->segment(4)){
				if ($this->session->userdata('use_username')){
					$err = 0;
					$where['ken_id'] = $this->uri->segment(4);
					$ken = $this->KennelModel->get_kennels($where)->row();
					$this->db->trans_strict(FALSE);
					$this->db->trans_start();
					$data['ken_app_user'] = $this->session->userdata('use_id');
					$data['ken_app_date'] = date('Y-m-d H:i:s');
					$data['ken_stat'] = 2;
					$res = $this->KennelModel->update_kennels($data, $where);
					if ($res){
						$res3 = $this->notification_model->add(18, $this->uri->segment(4), $ken->ken_member_id);
						if ($res3){
							$this->db->trans_complete();
							$whe_ken['mem_id'] = $ken->ken_member_id;
							$member = $this->memberModel->get_members($whe_ken)->row();
							if ($member->mem_firebase_token){
								$notif = $this->notificationtype_model->get_by_id(18);
								$url = 'https://fcm.googleapis.com/fcm/send';
								$key = 'AAAALe2LeZU:APA91bEqr2n1PRxkOyOfx8IwYO1O_1gjprFkq1AITOGUu3GYp2ZBi-8-AvM4ADI3m94NEv4cq-uKcMBU3pJXBhO21CyuVgPNX2l7VYXj5IllxEr6sika8eaJp1IgXCHALA5_xYw92pXK';
				
								$fields = array (
								'to' => $member->mem_firebase_token,
								'notification' => array(
									"channelId" => "ICRPedigree",
									'title' => $notif[0]->title,
									'body' => $notif[0]->description
								)
								);
								$fields = json_encode ( $fields );
				
								$headers = array (
									'Authorization: key=' . $key,
									'Content-Type: application/json'
								);
				
								$ch = curl_init ();
								curl_setopt ( $ch, CURLOPT_URL, $url );
								curl_setopt ( $ch, CURLOPT_POST, true );
								curl_setopt ( $ch, CURLOPT_HTTPHEADER, $headers );
								curl_setopt ( $ch, CURLOPT_RETURNTRANSFER, true );
								curl_setopt ( $ch, CURLOPT_POSTFIELDS, $fields );
				
								$result = curl_exec ( $ch );
								// echo $result;
								curl_close ( $ch );
							}
							$this->session->set_flashdata('approve', TRUE);
							redirect('backend/Kennels/view_approve');
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
						$this->session->set_flashdata('error', 'Failed to reject kennel name = '.$ken->ken_name);
						redirect('backend/Kennels/view_approve');
					}
				}
				else{
					redirect("backend/Users/login");
				}
			}
			else{
			  	redirect("backend/Kennels/view_approve");
			}
		}
}
