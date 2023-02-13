<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Births extends CI_Controller {
		public function __construct(){
			// Call the CI_Controller constructor
			parent::__construct();
			$this->load->model(array('studModel', 'birthModel', 'caninesModel', 'memberModel', 'logbirthModel', 'pedigreesModel', 'notification_model', 'notificationtype_model', 'news_model', 'stambumModel'));
			$this->load->library('upload', $this->config->item('upload_birth'));
			$this->load->library(array('session', 'form_validation'));
			$this->load->helper(array('url', 'notif'));
			$this->load->database();
			date_default_timezone_set("Asia/Bangkok");
		}

		public function index(){
			$where['bir_stat'] = $this->config->item('accepted');
			$data['birth'] = $this->birthModel->get_births($where)->result();

			$data['stambum'] = array();
			$data['stambum_stat'] = array();
			foreach ($data['birth'] as $r){
				$whereStambum = [];
				$whereStambum['stb_bir_id'] = $r->bir_id;
				$data['stambum'][] = $this->stambumModel->get_stambum($whereStambum)->num_rows();
				
				$wheStbMale = [];
				$wheStbMale['stb_bir_id'] = $r->bir_id;
				$wheStbMale['stb_gender'] = 'MALE';
				$wheStbMale['stb_stat'] = $this->config->item('accepted');
				$male = $this->stambumModel->get_count($wheStbMale);

				$wheStbFemale = [];
				$wheStbFemale['stb_bir_id'] = $r->bir_id;
				$wheStbFemale['stb_gender'] = 'FEMALE';
				$wheStbFemale['stb_stat'] = $this->config->item('accepted');
				$female = $this->stambumModel->get_count($wheStbFemale);

				if ($male == $r->bir_male && $female == $r->bir_female){
					$data['stambum_stat'][] = 0;
				}
				else{
					$data['stambum_stat'][] = 1;
				}
			}
			$this->load->view('backend/view_births', $data);
		}

		public function search(){
			$date = '';
			$piece = explode("-", $this->input->post('keywords'));
			if (count($piece) == 3){
				$date = $piece[2]."-".$piece[1]."-".$piece[0];
			}
			if ($date){
				$where['bir_date_of_birth'] = $date;
			}
			$where['bir_stat'] = $this->config->item('accepted');
			$data['birth'] = $this->birthModel->get_births($where)->result();

			$data['stambum'] = array();
			$data['stambum_stat'] = array();
			foreach ($data['birth'] as $r){
				$whereStambum = [];
				$whereStambum['stb_bir_id'] = $r->bir_id;
				$data['stambum'][] = $this->stambumModel->get_stambum($whereStambum)->num_rows();
				
				$wheStbMale = [];
				$wheStbMale['stb_bir_id'] = $r->bir_id;
				$wheStbMale['stb_gender'] = 'MALE';
				$wheStbMale['stb_stat'] = $this->config->item('accepted');
				$male = $this->stambumModel->get_count($wheStbMale);

				$wheStbFemale = [];
				$wheStbFemale['stb_bir_id'] = $r->bir_id;
				$wheStbFemale['stb_gender'] = 'FEMALE';
				$wheStbFemale['stb_stat'] = $this->config->item('accepted');
				$female = $this->stambumModel->get_count($wheStbFemale);

				if ($male == $r->bir_male && $female == $r->bir_female){
					$data['stambum_stat'][] = 0;
				}
				else{
					$data['stambum_stat'][] = 1;
				}
			}
			$this->load->view('backend/view_births', $data);
		}

		public function view_approve(){
			$where['bir_stat'] = $this->config->item('saved');
			$data['birth'] = $this->birthModel->get_births($where)->result();
			$this->load->view('backend/approve_births', $data);
		}

		public function search_approve(){
			$date = '';
			$piece = explode("-", $this->input->post('keywords'));
			if (count($piece) == 3){
				$date = $piece[2]."-".$piece[1]."-".$piece[0];
			}
			if ($date){
				$where['bir_date_of_birth'] = $date;
			}
			$where['bir_stat'] = $this->config->item('saved');
			$data['birth'] = $this->birthModel->get_births($where)->result();
			$this->load->view('backend/approve_births', $data);
		}

		public function add(){ 
			if ($this->uri->segment(4)){
				$data['bir_stu_id'] = $this->uri->segment(4);
				$data['mode'] = 0;
				$this->load->view('backend/add_birth', $data);
			}
			else{
				redirect('backend/Studs');
			}
		}

		public function validate_add(){
			if ($this->session->userdata('use_username')){
				$this->form_validation->set_error_delimiters('<div>','</div>');
				$this->form_validation->set_rules('bir_stu_id', 'Stud id ', 'trim|required');
				$this->form_validation->set_rules('bir_male', 'Male ', 'trim|required');
				$this->form_validation->set_rules('bir_female', 'Female ', 'trim|required');
				$this->form_validation->set_rules('bir_date_of_birth', 'Date of Birth ', 'trim|required');
	
				$data['bir_stu_id'] = $this->input->post('bir_stu_id');
				$data['mode'] = 1;
				if ($this->form_validation->run() == FALSE){
					$this->load->view('backend/add_birth', $data);
				}
				else{
					$err = 0;
					$damPhoto = '-';
					if (!$err){
						if (isset($_FILES['attachment_dam']) && !empty($_FILES['attachment_dam']['tmp_name']) && is_uploaded_file($_FILES['attachment_dam']['tmp_name'])){
							$this->upload->initialize($this->config->item('upload_birth'));
							if ($this->upload->do_upload('attachment_dam')){
								$uploadData = $this->upload->data();
								$damPhoto = $uploadData['file_name'];
							}
							else{
								$err++;
								$this->session->set_flashdata('error_message', $this->upload->display_errors());
							}
						}
					}
	
					if (!$err && $damPhoto == "-"){
						$err++;
						$this->session->set_flashdata('error_message', 'Dam photo is required'); 
					}
						
					if (!$err){
						$whereStud['stu_id'] = $this->input->post('bir_stu_id');
						$stud = $this->studModel->get_studs($whereStud)->row();
						if ($stud){
							$piece = explode("-", $this->input->post('bir_date_of_birth'));
							$date = $piece[2]."-".$piece[1]."-".$piece[0];
			
							$dataBirth = array(
								'bir_stu_id' => $this->input->post('bir_stu_id'),
								'bir_dam_photo' => $damPhoto,
								'bir_male' => $this->input->post('bir_male'),
								'bir_female' => $this->input->post('bir_female'),
								'bir_date_of_birth' => $date,
								'bir_app_user' => $this->session->userdata('use_id'),
								'bir_app_date' => date('Y-m-d H:i:s'),
								'bir_user' => $this->session->userdata('use_id'),
								'bir_date' => date('Y-m-d H:i:s'),
								'bir_stat' => $this->config->item('accepted'),
							);

							$this->db->trans_strict(FALSE);
							$this->db->trans_start();
							$birth = $this->birthModel->add_births($dataBirth);
							if ($birth){
								$dataLog = array(
									'log_bir_id' => $birth,
									'log_dam_photo' => $damPhoto,
									'log_male' => $this->input->post('bir_male'),
									'log_female' => $this->input->post('bir_female'),
									'log_date_of_birth' => $date,
									'log_app_user' => $this->session->userdata('use_id'),
									'log_app_date' => date('Y-m-d H:i:s'),
									'log_stat' => $this->config->item('accepted'),
									'log_user' => $this->session->userdata('use_id'),
									'log_date' => date('Y-m-d H:i:s'),
								);
								$log = $this->logbirthModel->add_log($dataLog);
								if ($log){
									$result = $this->notification_model->add(21, $birth, $stud->stu_member_id);
									if ($result){
										$res = $this->notification_model->add(21, $birth, $stud->stu_partner_id);
										if ($res){
											$whe['mem_id'] = $stud->stu_member_id;
											$member = $this->memberModel->get_members($whe)->row();

											$whePartner['mem_id'] = $stud->stu_partner_id;
											$partner = $this->memberModel->get_members($whePartner)->row();

											$wheSire['can_id'] = $stud->stu_sire_id;
											$can = $this->caninesModel->get_canines($wheSire)->row();

											$desc = 'Telah lahir ';
											if ($this->input->post('bir_male') && $this->input->post('bir_female')){
												$desc .= $this->input->post('bir_male').' jantan dan ';
												$desc .= $this->input->post('bir_female').' betina';
											}
											else if ($this->input->post('bir_male'))
												$desc .= $this->input->post('bir_male').' jantan';
											else if ($this->input->post('bir_female'))
												$desc .= $this->input->post('bir_female').' betina';
											$desc .= ' pada tanggal '.$this->input->post('bir_date_of_birth').'.';
											$desc .= ' Hubungi '.$partner->mem_name.' ('.$partner->ken_name.')';
											
											$dataNews = array(
												'title' => 'Lahir '.$can->can_breed,
												'description' => $desc
											); 
											$news = $this->news_model->add($dataNews);
											if ($news){
												$this->db->trans_complete();
												$notif = $this->notificationtype_model->get_by_id(21);
												if ($member->mem_firebase_token)
													firebase_notif($member->mem_firebase_token, $notif[0]->title, $notif[0]->description);
												if ($partner->mem_firebase_token)
													firebase_notif($partner->mem_firebase_token, $notif[0]->title, $notif[0]->description);
												$this->session->set_flashdata('add_success', true);
												redirect("backend/Births");
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
								}
								else{
									$err = 4;
								}
							}
							else{
								$err = 5;
							}
							if ($err){
								$this->session->set_flashdata('error_message', 'Failed to save birth. Err code: '.$err);
								$this->load->view('backend/add_birth', $data);
							}	
						}
						else{
							$this->session->set_flashdata('error_message', 'Stud id is invalid'); 
							$this->load->view('backend/add_birth', $data);
						}
					}
					if ($err){
						$this->load->view('backend/add_birth', $data);
					}
				}
			}
			else{
				redirect("backend/Users/login");
			}
		}

		public function edit(){ 
			if ($this->uri->segment(4)){
				$where['bir_id'] = $this->uri->segment(4);
				$data['birth'] = $this->birthModel->get_births($where)->row();
				$data['mode'] = 0;
				$this->load->view('backend/edit_birth', $data);
			}
			else{
				redirect('backend/Studs');
			}
		}

		public function validate_edit(){
			if ($this->session->userdata('use_username')){
				$this->form_validation->set_error_delimiters('<div>','</div>');
				$this->form_validation->set_rules('bir_id', 'Birth id ', 'trim|required');
				$this->form_validation->set_rules('bir_male', 'Male ', 'trim|required');
				$this->form_validation->set_rules('bir_female', 'Female ', 'trim|required');
				$this->form_validation->set_rules('bir_date_of_birth', 'Date of Birth ', 'trim|required');
	
				$where['bir_id'] = $this->input->post('bir_id');
				$data['birth'] = $this->birthModel->get_births($where)->row();
				$data['mode'] = 1;
				if ($this->form_validation->run() == FALSE){
					$this->load->view('backend/edit_birth', $data);
				}
				else{
					$err = 0;
					$damPhoto = '-';
					if (!$err){
						if (isset($_FILES['attachment_dam']) && !empty($_FILES['attachment_dam']['tmp_name']) && is_uploaded_file($_FILES['attachment_dam']['tmp_name'])){
							$this->upload->initialize($this->config->item('upload_birth'));
							if ($this->upload->do_upload('attachment_dam')){
								$uploadData = $this->upload->data();
								$damPhoto = $uploadData['file_name'];
							}
							else{
								$err++;
								$this->session->set_flashdata('error_message', $this->upload->display_errors());
							}
						}
					}
	
					if (!$err){
						$piece = explode("-", $this->input->post('bir_date_of_birth'));
						$date = $piece[2]."-".$piece[1]."-".$piece[0];
		
						$dataBirth = array(
							'bir_male' => $this->input->post('bir_male'),
							'bir_female' => $this->input->post('bir_female'),
							'bir_date_of_birth' => $date,
							'bir_user' => $this->session->userdata('use_id'),
							'bir_date' => date('Y-m-d H:i:s'),
						);
						
						if ($damPhoto != '-')
							$dataBirth['bir_dam_photo'] = $damPhoto;

						$dataLog = array(
							'log_male' => $this->input->post('bir_male'),
							'log_female' => $this->input->post('bir_female'),
							'log_dam_photo' => $damPhoto,
							'log_date_of_birth' => $date,
							'log_user' => $this->session->userdata('use_id'),
							'log_date' => date('Y-m-d H:i:s'),
						);

						$this->db->trans_strict(FALSE);
						$this->db->trans_start();
						$birth = $this->birthModel->update_births($dataBirth, $where);
						if ($birth){
							$log = $this->logbirthModel->add_log($dataLog);
							if ($log){	
								$this->db->trans_complete();
								$this->session->set_flashdata('edit_success', true);
								redirect("backend/Births");
							}
							else{
								$err = 1;
							}
						}
						else{
							$err = 2;
						}
						if ($err){
							$this->session->set_flashdata('error_message', 'Failed to save birth. Err code: '+$err);
							$this->load->view('backend/edit_birth', $data);
						}	
					}
					if ($err){
						$this->load->view('backend/edit_birth', $data);
					}
				}
			}
			else{
				redirect("backend/Users/login");
			}
		}

		public function approve(){
			if ($this->uri->segment(4)){
				if ($this->session->userdata('use_username')) {
					$where['bir_id'] = $this->uri->segment(4);
					$birth = $this->birthModel->get_births($where)->row();
					$this->db->trans_strict(FALSE);
					$this->db->trans_start();
					$data['bir_app_user'] = $this->session->userdata('use_id');
					$data['bir_app_date'] = date('Y-m-d H:i:s');
					$data['bir_user'] = $this->session->userdata('use_id');
					$data['bir_date'] = date('Y-m-d H:i:s');
					$data['bir_stat'] = $this->config->item('accepted');
					$res = $this->birthModel->update_births($data, $where);
					if ($res){
						$err = 0;
						$piece = explode("-", $birth->bir_date_of_birth);
						$date = $piece[2]."-".$piece[1]."-".$piece[0];
						$dataLog = array(
							'log_bir_id' => $this->uri->segment(4),
							'log_dam_photo' => $birth->bir_dam_photo,
							'log_male' => $birth->bir_male,
							'log_female' => $birth->bir_female,
							'log_date_of_birth' => $date,
							'log_app_user' => $this->session->userdata('use_id'),
							'log_app_date' => date('Y-m-d H:i:s'),
							'log_user' => $this->session->userdata('use_id'),
							'log_date' => date('Y-m-d H:i:s'),
							'log_stat' => $this->config->item('accepted'),
						);
						$log = $this->logbirthModel->add_log($dataLog);
						if ($log){
							$wheStud['stu_id'] = $birth->bir_stu_id;
							$stud = $this->studModel->get_studs($wheStud)->row();
							$result = $this->notification_model->add(2, $this->uri->segment(4), $stud->stu_member_id);
							if ($result){
								$res = $this->notification_model->add(2, $this->uri->segment(4), $stud->stu_partner_id);
								if ($res){
									$whe['mem_id'] = $stud->stu_member_id;
									$member = $this->memberModel->get_members($whe)->row();

									$whePartner['mem_id'] = $stud->stu_partner_id;
									$partner = $this->memberModel->get_members($whePartner)->row();

									$wheSire['can_id'] = $stud->stu_sire_id;
									$can = $this->caninesModel->get_canines($wheSire)->row();

									$desc = 'Telah lahir ';
									if ($birth->bir_male && $birth->bir_female){
										$desc .= $birth->bir_male.' jantan dan ';
										$desc .= $birth->bir_female.' betina';
									}
									else if ($birth->bir_male)
										$desc .= $birth->bir_male.' jantan';
									else if ($birth->bir_female)
										$desc .= $birth->bir_female.' betina';
									$desc .= ' pada tanggal '.$birth->bir_date_of_birth.'.';
									$desc .= ' Hubungi '.$partner->mem_name.' ('.$partner->ken_name.')';
									
									$dataNews = array(
										'title' => 'Lahir '.$can->can_breed,
										'description' => $desc
									); 
									$news = $this->news_model->add($dataNews);
									if ($news){
										$this->db->trans_complete();
										$notif = $this->notificationtype_model->get_by_id(2);
										if ($member->mem_firebase_token)
											firebase_notif($member->mem_firebase_token, $notif[0]->title, $notif[0]->description);
										if ($partner->mem_firebase_token)
											firebase_notif($partner->mem_firebase_token, $notif[0]->title, $notif[0]->description);
										$this->session->set_flashdata('approve', TRUE);
										redirect('backend/Births/view_approve');
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
						$this->session->set_flashdata('error_message', 'Failed to approve birth id = '.$this->uri->segment(4).'. Err code: '.$err);
						redirect('backend/Births/view_approve');
					}
				}
				else{
					redirect('backend/Users/login');
				}
			}
			else{
				redirect('backend/Births/view_approve');
			}
		}

		public function reject(){
			if ($this->uri->segment(4)){
				if ($this->session->userdata('use_username')) {
					$where['bir_id'] = $this->uri->segment(4);
					$birth = $this->birthModel->get_births($where)->row();
					$this->db->trans_strict(FALSE);
					$this->db->trans_start();
					$data['bir_user'] = $this->session->userdata('use_id');
					$data['bir_date'] = date('Y-m-d H:i:s');
					$data['bir_stat'] = $this->config->item('rejected');
					$res = $this->birthModel->update_births($data, $where);
					if ($res){
						$err = 0;
						$piece = explode("-", $birth->bir_date_of_birth);
						$date = $piece[2]."-".$piece[1]."-".$piece[0];
						$dataLog = array(
							'log_bir_id' => $this->uri->segment(4),
							'log_dam_photo' => $birth->bir_dam_photo,
							'log_male' => $birth->bir_male,
							'log_female' => $birth->bir_female,
							'log_date_of_birth' => $date,
							'log_user' => $this->session->userdata('use_id'),
							'log_date' => date('Y-m-d H:i:s'),
							'log_stat' => $this->config->item('rejected'),
						);
						$log = $this->logbirthModel->add_log($dataLog);
						if ($log){
							$wheStud['stu_id'] = $birth->bir_stu_id;
							$stud = $this->studModel->get_studs($wheStud)->row();
							$result = $this->notification_model->add(7, $this->uri->segment(4), $stud->stu_member_id);
							if ($result){
								$this->db->trans_complete();
								$wheBirth['mem_id'] = $birth->bir_member_id;
								$member = $this->memberModel->get_members($wheBirth)->row();
								if ($member->mem_firebase_token){
									$notif = $this->notificationtype_model->get_by_id(7);
									firebase_notif($member->mem_firebase_token, $notif[0]->title, $notif[0]->description);
								}
								$this->session->set_flashdata('reject', TRUE);
								redirect('backend/Births/view_approve');
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
						$this->session->set_flashdata('error_message', 'Failed to reject birth id = '.$this->uri->segment(4).'. Err code: '.$err);
						redirect('backend/Births/view_approve');
					}
				}
				else{
					redirect('backend/Users/login');
				}
			}
			else{
				redirect('backend/Births/view_approve');
			}
		}

		public function delete(){
			if ($this->uri->segment(4)){
				if ($this->session->userdata('use_username')) {
					$where['bir_id'] = $this->uri->segment(4);
					$data['bir_user'] = $this->session->userdata('use_id');
					$data['bir_date'] = date('Y-m-d H:i:s');
					$data['bir_stat'] = $this->config->item('rejected');
					$this->db->trans_strict(FALSE);
					$this->db->trans_start();
					$res = $this->birthModel->update_births($data, $where);
					if ($res){
						$err = 0;
						$dataLog = array(
							'log_bir_id' => $this->uri->segment(4),
							'log_user' => $this->session->userdata('use_id'),
							'log_date' => date('Y-m-d H:i:s'),
							'log_stat' => $this->config->item('rejected'),
						);
						$log = $this->logbirthModel->add_log($dataLog);
						if ($log){
							$this->db->trans_complete();
							$this->session->set_flashdata('delete', TRUE);
							redirect('backend/Births');
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
						$this->session->set_flashdata('error_message', 'Failed to delete birth id = '.$this->uri->segment(4).'. Err code: '.$err);
						redirect('backend/Births');
					}
				}
				else{
					redirect('backend/Users/login');
				}
			}
			else{
				redirect('backend/Births');
			}
		}
}
