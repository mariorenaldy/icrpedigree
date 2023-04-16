<?php
defined('BASEPATH') OR exit('No direct script access allowed');

#[\AllowDynamicProperties]

class Births extends CI_Controller {
		public function __construct(){
			// Call the CI_Controller constructor
			parent::__construct();
			$this->load->model(array('studModel', 'birthModel', 'caninesModel', 'memberModel', 'logbirthModel', 'pedigreesModel', 'notification_model', 'notificationtype_model', 'news_model', 'stambumModel', 'logstudModel'));
			$this->load->library('upload', $this->config->item('upload_birth'));
			$this->load->library(array('session', 'form_validation'));
			$this->load->helper(array('url', 'notif', 'mail'));
			$this->load->database();
			date_default_timezone_set("Asia/Bangkok");
		}

		public function index(){
			$where['bir_stat'] = $this->config->item('accepted');
			$where['kennels.ken_stat'] = $this->config->item('accepted');
			$data['birth'] = $this->birthModel->get_births($where, 0, $this->config->item('backend_birth_count'))->result();

			$data['stambum'] = array();
			$data['stat'] = array();
			foreach ($data['birth'] as $r){
				$whereStambum = [];
				$whereStambum['stb_bir_id'] = $r->bir_id;
				$whereStambum['stb_stat != '] = $this->config->item('rejected');
                $stb = $this->stambumModel->get_stambum($whereStambum)->num_rows();
				$data['stambum'][] = $stb;

                if ($stb < ($r->bir_male + $r->bir_female)){
                    $piece = explode("-", $r->bir_date_of_birth);
                    $dob = $piece[2]."-".$piece[1]."-".$piece[0];

                    $ts = new DateTime();
                    $ts_birth = new DateTime($dob);
                    if ($ts_birth > $ts){
                        $data['stat'][] = false;
                    }
                    else{ // min 45 hari; max 100 hari
                        $err = 0;
                        $diff = floor($ts->diff($ts_birth)->days/$this->config->item('min_jarak_lapor_anak'));
                        if ($diff < 1){
                            $err++;
                        }

                        if (!$err){
                            $diff = floor($ts->diff($ts_birth)->days/$this->config->item('jarak_lapor_anak'));
                            if ($diff > 1){
                                $err++;
                            }
                        }

                        if (!$err){

                        }

                        if (!$err)
                            $data['stat'][] = true;
                        else
                            $data['stat'][] = false;
                    }
                }
                else{
                    $data['stat'][] = false;
                }
			}
			$this->load->view('backend/view_births', $data);
		}

		public function search(){
			$date = '';
			$piece = explode("-", $this->input->post('date'));
			if (count($piece) == 3){
				$date = $piece[2]."-".$piece[1]."-".$piece[0];
			}
			if ($date){
				$where['bir_date_of_birth'] = $date;
			}
			$where['bir_stat'] = $this->config->item('accepted');
			$where['kennels.ken_stat'] = $this->config->item('accepted');
			$like['can_sire.can_a_s'] = $this->input->post('keywords');
			$like['can_dam.can_a_s'] = $this->input->post('keywords');
			$data['birth'] = $this->birthModel->search_births($like, $where, 0, $this->config->item('backend_birth_count'))->result();

			$data['stambum'] = array();
			$data['stat'] = array();
			foreach ($data['birth'] as $r){
				$whereStambum = [];
				$whereStambum['stb_bir_id'] = $r->bir_id;
				$whereStambum['stb_stat != '] = $this->config->item('rejected');
				$stb = $this->stambumModel->get_stambum($whereStambum)->num_rows();
				$data['stambum'][] = $stb;

                if ($stb < ($r->bir_male + $r->bir_female)){
                    $piece = explode("-", $r->bir_date_of_birth);
                    $dob = $piece[2]."-".$piece[1]."-".$piece[0];

                    $ts = new DateTime();
                    $ts_birth = new DateTime($dob);
                    if ($ts_birth > $ts){
                        $data['stat'][] = false;
                    }
                    else{ // min 45 hari; max 100 hari
                        $err = 0;
                        $diff = floor($ts->diff($ts_birth)->days/$this->config->item('min_jarak_lapor_anak'));
                        if ($diff < 1){
                            $err++;
                        }

                        if (!$err){
                            $diff = floor($ts->diff($ts_birth)->days/$this->config->item('jarak_lapor_anak'));
                            if ($diff > 1){
                                $err++;
                            }
                        }

                        if (!$err)
                            $data['stat'][] = true;
                        else
                            $data['stat'][] = false;
                    }
                }
                else{
                    $data['stat'][] = false;
                }
			}
			$this->load->view('backend/view_births', $data);
		}

		public function view_approve(){
			$where['bir_stat'] = $this->config->item('saved');
			$where['kennels.ken_stat'] = $this->config->item('accepted');
			$data['birth'] = $this->birthModel->get_births($where)->result();
			$this->load->view('backend/approve_births', $data);
		}

		public function search_approve(){
			$date = '';
			$piece = explode("-", $this->input->post('date'));
            if (count($piece) == 3){
                $date = $piece[2]."-".$piece[1]."-".$piece[0];
            }
			if ($date){
				$where['bir_date_of_birth'] = $date;
			}
			$where['bir_stat'] = $this->config->item('saved');
			$where['kennels.ken_stat'] = $this->config->item('accepted');
			$like['can_sire.can_a_s'] = $this->input->post('keywords');
			$like['can_dam.can_a_s'] = $this->input->post('keywords');
			$data['birth'] = $this->birthModel->search_births($like, $where)->result();
			$this->load->view('backend/approve_births', $data);
		}

		public function add(){ 
			if ($this->uri->segment(4)){
                // // min 58 hari; max 75 hari
                $whereStud['stu_id'] = $this->uri->segment(4);
                $stud = $this->studModel->get_studs($whereStud)->row();
                if ($stud->stu_stat == $this->config->item('accepted')){
                    $whereBirth['bir_stu_id'] = $this->uri->segment(4);
                    $whereBirth['bir_stat != '] = $this->config->item('rejected');
                    $birth = $this->birthModel->get_births($whereBirth)->num_rows();
                    if (!$birth){
                        $err = 0;
                        $piece = explode("-", $stud->stu_stud_date);
                        $studDate = $piece[2]."-".$piece[1]."-".$piece[0];
    
                        $ts = new DateTime();
                        $ts_stud = new DateTime($studDate);
                        if ($ts_stud > $ts){
                            $err++;
                            $this->session->set_flashdata('error_message', 'Birth must be reported before '.$this->config->item('jarak_lapor_lahir').' days from stud'); 
                        }
                        else{
                            $diff = floor($ts->diff($ts_stud)->days/$this->config->item('min_jarak_lapor_lahir'));
                            if ($diff < 1){
                                $err++;
                                $this->session->set_flashdata('error_message', 'Birth must be reported after '.$this->config->item('min_jarak_lapor_lahir').' days from stud');
                            }
    
                            if (!$err){
                                $diff = floor($ts->diff($ts_stud)->days/$this->config->item('jarak_lapor_lahir'));
                                if ($diff > 1){
                                    $err++;
                                    $this->session->set_flashdata('error_message', 'Birth must be reported before '.$this->config->item('jarak_lapor_lahir').' days from stud');
                                }
                            }
    
                            if (!$err){
                                $data['bir_stu_id'] = $this->uri->segment(4);
                                $data['mode'] = 0;
                                $this->load->view('backend/add_birth', $data);
                            }
                            else{
                                redirect('backend/Studs');
                            }
                        }
                    }
                    else{
                        if ($birth->bir_stat == $this->config->item('saved')){
                            $this->session->set_flashdata('error_message', 'Birth has been saved.');
                        }
                        else{
                            $this->session->set_flashdata('error_message', 'Birth has been approved.');
                        }
                        redirect('backend/Studs');
                    }
                }
                else{
                    $this->session->set_flashdata('error_message', 'Lapor lahir tidak valid');
                    redirect('backend/Studs');
                }
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
				$data['mode'] = $this->input->post('mode');
				if ($this->form_validation->run() == FALSE){
					$this->load->view('backend/add_birth', $data);
				}
				else{
					$err = 0;
					if (!isset($_POST['attachment_dam']) || empty($_POST['attachment_dam'])){
						$err++;
						$this->session->set_flashdata('error_message', 'Dam photo is required');
					}
			
					$damPhoto = '-';
					if (!$err){
						$uploadedImg = $_POST['attachment_dam'];
						$image_array_1 = explode(";", $uploadedImg);
						$image_array_2 = explode(",", $image_array_1[1]);
						$uploadedImg = base64_decode($image_array_2[1]);
				
						if ((strlen($uploadedImg) > $this->config->item('file_size'))) {
							$err++;
							$this->session->set_flashdata('error_message', 'The file size is too big (> 1 MB).');
						}
				
						$img_name = $this->config->item('path_birth').$this->config->item('file_name_birth');
						if (!is_dir($this->config->item('path_birth')) or !is_writable($this->config->item('path_birth'))) {
							$err++;
							$this->session->set_flashdata('error_message', 'births folder not found or not writable.');
						} else{
							if (is_file($img_name) and !is_writable($img_name)) {
							$err++;
							$this->session->set_flashdata('error_message', 'File already exists and not writeable.');
							}
						}
					}

                    if (!$err && !$this->input->post('mode')){
						// syarat maksimal 75 hari dari lapor pacak
                        $data['warning'] = Array();
						$whereStud['stu_id'] = $this->input->post('bir_stu_id');
						$stud = $this->studModel->get_studs($whereStud)->row();
						if ($stud){
							$piece = explode("-", $this->input->post('bir_date_of_birth'));
							$date = $piece[2]."-".$piece[1]."-".$piece[0];

							$piece = explode("-", $stud->stu_stud_date);
							$studDate = $piece[2]."-".$piece[1]."-".$piece[0];

							$ts = new DateTime($date);
							$ts_stud = new DateTime($studDate);
							if ($ts_stud > $ts){
								$err++;
								$this->session->set_flashdata('error_message', 'Birth must be reported before '.$this->config->item('jarak_lapor_lahir').' days from stud'); 
							}
							else{
								$diff = floor($ts->diff($ts_stud)->days/$this->config->item('min_jarak_lapor_lahir'));
								if ($diff < 1){
									$err++;
									$this->session->set_flashdata('error_message', 'Birth must be reported after '.$this->config->item('min_jarak_lapor_lahir').' days from stud');
								}

								if (!$err){
									$diff = floor($ts->diff($ts_stud)->days/$this->config->item('jarak_lapor_lahir'));
									if ($diff > 1){
										$err++;
										$this->session->set_flashdata('error_message', 'Birth must be reported before '.$this->config->item('jarak_lapor_lahir').' days from stud');
									}
								}
							}
						}
						else{
							$err++;
							$this->session->set_flashdata('error_message', 'Invalid stud id'); 
						}
                    }
						
					if (!$err){
						file_put_contents($img_name, $uploadedImg);
              			$damPhoto = str_replace($this->config->item('path_birth'), '', $img_name);

						$whereStud['stu_id'] = $this->input->post('bir_stu_id');
						$stud = $this->studModel->get_studs($whereStud)->row();
						if ($stud){
							$piece = explode("-", $this->input->post('bir_date_of_birth'));
							$date = $piece[2]."-".$piece[1]."-".$piece[0];
			
							$dataBirth = array(
								'bir_stu_id' => $this->input->post('bir_stu_id'),
								'bir_member_id' => $stud->stu_partner_id,
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
							$dataStud['stu_stat'] = $this->config->item('completed');
							$whereStud['stu_id'] = $this->input->post('bir_stu_id');
							$res = $this->studModel->update_studs($dataStud, $whereStud);
							if ($res){
								$birth = $this->birthModel->add_births($dataBirth);
								if ($birth){
									$dataLog = array(
										'log_bir_id' => $birth,
										'log_stu_id' => $this->input->post('bir_stu_id'),
										'log_member_id' => $stud->stu_partner_id,
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
										$result = $this->notification_model->add(21, $birth, $stud->stu_member_id, "Nama Sire: ".$stud->sire_a_s.'<br>Nama Dam: '.$stud->dam_a_s);
										if ($result){
											$res = $this->notification_model->add(21, $birth, $stud->stu_partner_id, "Nama Sire: ".$stud->sire_a_s.'<br>Nama Dam: '.$stud->dam_a_s.'<br><a class="text-reset link-warning" href="'.base_url().'frontend/Stambums/add/'.$birth.'">Lapor Anak</a>');
											if ($res){
												$dataOldNews['stat'] = $this->config->item('rejected');
												$whereOldNews['trans_id'] = $stud->stu_id;
												$whereOldNews['type'] = $this->config->item('stud');
												$oldNews = $this->news_model->update($dataOldNews, $whereOldNews);
												if ($oldNews){
													$whe['mem_id'] = $stud->stu_member_id;
													$member = $this->memberModel->get_members($whe)->row();

													$whePartner['mem_id'] = $stud->stu_partner_id;
													$partner = $this->memberModel->get_members($whePartner)->row();

													$wheDam['can_id'] = $stud->stu_dam_id;
													$can = $this->caninesModel->get_canines($wheDam)->row();
				
													$wheSire['can_id'] = $stud->stu_sire_id;
													$c = $this->caninesModel->get_canines($wheSire)->row();

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
														'description' => $desc,
														'date' => $date,
														'type' => $this->config->item('birth'),
														'photo' => $damPhoto,
														'trans_id' => $birth,
													); 
													$news = $this->news_model->add($dataNews);
													if ($news){
														$this->db->trans_complete();
														$notif = $this->notificationtype_model->get_by_id(21);
														if ($member->mem_firebase_token)
															firebase_notif($member->mem_firebase_token, $notif[0]->title, $notif[0]->description);
														if ($partner->mem_firebase_token)
															firebase_notif($partner->mem_firebase_token, $notif[0]->title, $notif[0]->description);

														$mail = send_stambum_link($partner->mem_email, $partner->mem_username, $c->can_a_s, $can->can_a_s, $birth);
														if (!$mail){
															$this->session->set_flashdata('error_message', show_error($this->email->print_debugger()));
														}
														else{
															$this->session->set_flashdata('mesg', 'Lapor Anak:\n'.base_url().'frontend/Stambums/add/'.$birth);
															$this->session->set_flashdata('telp', $partner->mem_hp);
															$this->session->set_flashdata('add_success', true);
														}
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
								}
								else{
									$err = 6;
								}
							}
							else{
								$err = 7;
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
				$data['mode'] = $this->input->post('mode');
				if ($this->form_validation->run() == FALSE){
					$this->load->view('backend/edit_birth', $data);
				}
				else{
					$err = 0;
					$damPhoto = '-';
					if (isset($_POST['attachment_dam']) && !empty($_POST['attachment_dam'])){
						$uploadedImg = $_POST['attachment_dam'];
						$image_array_1 = explode(";", $uploadedImg);
						$image_array_2 = explode(",", $image_array_1[1]);
						$uploadedImg = base64_decode($image_array_2[1]);
			
						if ((strlen($uploadedImg) > $this->config->item('file_size'))) {
							$err++;
							$this->session->set_flashdata('error_message', 'The file size is too big (> 1 MB).');
						}
			
						$img_name = $this->config->item('path_birth').$this->config->item('file_name_birth');
						if (!is_dir($this->config->item('path_birth')) or !is_writable($this->config->item('path_birth'))) {
							$err++;
							$this->session->set_flashdata('error_message', 'births folder not found or not writable.');
						} else{
							if (is_file($img_name) and !is_writable($img_name)) {
								$err++;
								$this->session->set_flashdata('error_message', 'File already exists and not writeable.');
							}
						}
					}

                    if (!$err && !$this->input->post('mode')){
						// syarat maksimal 75 hari dari lapor pacak
                        $data['warning'] = Array();
						$whereStud['stu_id'] = $data['birth']->bir_stu_id;
						$stud = $this->studModel->get_studs($whereStud)->row();
						if ($stud){
							$piece = explode("-", $this->input->post('bir_date_of_birth'));
							$date = $piece[2]."-".$piece[1]."-".$piece[0];

							$piece = explode("-", $stud->stu_stud_date);
							$studDate = $piece[2]."-".$piece[1]."-".$piece[0];

							$ts = new DateTime($date);
							$ts_stud = new DateTime($studDate);
							if ($ts_stud > $ts){
								$err++;
								$this->session->set_flashdata('error_message', 'Birth must be reported before '.$this->config->item('jarak_lapor_lahir').' days from stud'); 
							}
							else{
								$diff = floor($ts->diff($ts_stud)->days/$this->config->item('min_jarak_lapor_lahir'));
								if ($diff < 1){
									$err++;
									$this->session->set_flashdata('error_message', 'Birth must be reported after '.$this->config->item('min_jarak_lapor_lahir').' days from stud');
								}

								if (!$err){
									$diff = floor($ts->diff($ts_stud)->days/$this->config->item('jarak_lapor_lahir'));
									if ($diff > 1){
										$err++;
										$this->session->set_flashdata('error_message', 'Birth must be reported before '.$this->config->item('jarak_lapor_lahir').' days from stud');
									}
								}
							}
						}
						else{
							$err++;
							$this->session->set_flashdata('error_message', 'Invalid stud id'); 
						}
                    }
	
					if (!$err){
						if (isset($uploadedImg)){
							file_put_contents($img_name, $uploadedImg);
							$damPhoto = str_replace($this->config->item('path_birth'), '', $img_name);
						}

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
							'log_bir_id' => $this->input->post('bir_id'),
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
					$dataStud['stu_stat'] = $this->config->item('completed');
					$whereStud['stu_id'] = $birth->bir_stu_id;
					$result = $this->studModel->update_studs($dataStud, $whereStud);
					if ($result){
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
								'log_stu_id' => $birth->bir_stu_id,
								'log_member_id' => $birth->bir_member_id,
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
								$result = $this->notification_model->add(2, $this->uri->segment(4), $stud->stu_member_id, "Nama Sire: ".$stud->sire_a_s.'<br>Nama Dam: '.$stud->dam_a_s);
								if ($result){
									$res = $this->notification_model->add(2, $this->uri->segment(4), $stud->stu_partner_id, "Nama Sire: ".$stud->sire_a_s.'<br>Nama Dam: '.$stud->dam_a_s.'<br><a class="text-reset link-warning" href="'.base_url().'frontend/Stambums/add/'.$this->uri->segment(4).'">Lapor Anak</a>');
									if ($res){
										$dataOldNews['stat'] = $this->config->item('rejected');
										$whereOldNews['trans_id'] = $stud->stu_id;
										$whereOldNews['type'] = $this->config->item('stud');
										$oldNews = $this->news_model->update($dataOldNews, $whereOldNews);
										if ($oldNews){
											$whe['mem_id'] = $stud->stu_member_id;
											$member = $this->memberModel->get_members($whe)->row();

											$whePartner['mem_id'] = $stud->stu_partner_id;
											$partner = $this->memberModel->get_members($whePartner)->row();

											$wheDam['can_id'] = $stud->stu_dam_id;
											$can = $this->caninesModel->get_canines($wheDam)->row();
		
											$wheSire['can_id'] = $stud->stu_sire_id;
											$c = $this->caninesModel->get_canines($wheSire)->row();

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
											
											$piece = explode("-", $birth->bir_date_of_birth);
											$date = $piece[2]."-".$piece[1]."-".$piece[0];

											$dataNews = array(
												'title' => 'Lahir '.$can->can_breed,
												'description' => $desc,
												'date' => $date,
												'type' => $this->config->item('birth'),
												'photo' => $birth->bir_dam_photo,
												'trans_id' => $this->uri->segment(4),
											); 
											$news = $this->news_model->add($dataNews);
											if ($news){
												$this->db->trans_complete();
												$notif = $this->notificationtype_model->get_by_id(2);
												if ($member->mem_firebase_token)
													firebase_notif($member->mem_firebase_token, $notif[0]->title, $notif[0]->description);
												if ($partner->mem_firebase_token)
													firebase_notif($partner->mem_firebase_token, $notif[0]->title, $notif[0]->description);
												$mail = send_stambum_link($partner->mem_email, $partner->mem_username, $c->can_a_s, $can->can_a_s, $this->uri->segment(4));
												if (!$mail){
													$this->session->set_flashdata('error_message', show_error($this->email->print_debugger()));
												}
												else{
													$this->session->set_flashdata('mesg', 'Lapor Anak:\n'.base_url().'frontend/Stambums/add/'.$this->uri->segment(4));
													$this->session->set_flashdata('telp', $partner->mem_hp);
													$this->session->set_flashdata('approve', TRUE);
												}
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
						}
						else{
							$err = 6;
						}
					}
					else{
						$err = 7;
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
					if ($this->uri->segment(5)){
						$data['bir_app_note'] = urldecode($this->uri->segment(5));
					}
					$res = $this->birthModel->update_births($data, $where);
					if ($res){
						$err = 0;
						$piece = explode("-", $birth->bir_date_of_birth);
						$date = $piece[2]."-".$piece[1]."-".$piece[0];
						$dataLog = array(
							'log_bir_id' => $this->uri->segment(4),
							'log_stu_id' => $birth->bir_stu_id,
							'log_member_id' => $birth->bir_member_id,
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
							$result = $this->notification_model->add(7, $this->uri->segment(4), $stud->stu_member_id, "Nama Sire: ".$stud->sire_a_s.'<br>Nama Dam: '.$stud->dam_a_s);
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
                    $err = 0;
					$where['bir_id'] = $this->uri->segment(4);
					$data['bir_user'] = $this->session->userdata('use_id');
					$data['bir_date'] = date('Y-m-d H:i:s');
					$data['bir_stat'] = $this->config->item('rejected');
					$this->db->trans_strict(FALSE);
					$this->db->trans_start();
					$res = $this->birthModel->update_births($data, $where);
					if ($res){
						$dataLog = array(
							'log_bir_id' => $this->uri->segment(4),
							'log_user' => $this->session->userdata('use_id'),
							'log_date' => date('Y-m-d H:i:s'),
							'log_stat' => $this->config->item('rejected'),
						);
						$log = $this->logbirthModel->add_log($dataLog);
						if ($log){
                            $birth = $this->birthModel->get_births($where)->row();
                            $whereStud['stu_id'] = $birth->bir_stu_id;
                            $dataStud['stu_user'] = $this->session->userdata('use_id');
                            $dataStud['stu_date'] = date('Y-m-d H:i:s');
                            $dataStud['stu_stat'] = $this->config->item('accepted');
                            $res = $this->studModel->update_studs($dataStud, $whereStud);
                            if ($res){
                                $dataLogStud = array(
                                    'log_stu_id' => $birth->bir_stu_id,
                                    'log_user' => $this->session->userdata('use_id'),
                                    'log_date' => date('Y-m-d H:i:s'),
                                    'log_stat' => $this->config->item('accepted'),
                                );
                                $log = $this->logstudModel->add_log($dataLogStud);
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
						}
						else{
							$err = 3;
						}
					}
					else{
						$err = 4;
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

		public function log(){
			if ($this->uri->segment(4)){
				$where['log_bir_id'] = $this->uri->segment(4);
				$data['birth'] = $this->logbirthModel->get_logs($where)->result();
				$this->load->view('backend/log_birth', $data);
			}
			else{
				redirect('backend/Births');
			}
		}

		public function send_stambum_link(){
			if ($this->uri->segment(4)){
				$where['bir_id'] = $this->uri->segment(4);
				$birth = $this->birthModel->get_births($where)->row();

				$wheStud['stu_id'] = $birth->bir_stu_id;
				$stud = $this->studModel->get_studs($wheStud)->row();
							
				$whe['mem_id'] = $stud->stu_member_id;
				$member = $this->memberModel->get_members($whe)->row();

				$whePartner['mem_id'] = $stud->stu_partner_id;
				$partner = $this->memberModel->get_members($whePartner)->row();

				$wheDam['can_id'] = $stud->stu_dam_id;
				$can = $this->caninesModel->get_canines($wheDam)->row();

				$wheSire['can_id'] = $stud->stu_sire_id;
				$c = $this->caninesModel->get_canines($wheSire)->row();

				$mail = send_stambum_link($partner->mem_email, $partner->mem_username, $c->can_a_s, $can->can_a_s, $this->uri->segment(4));
				if ($mail){
					echo 'success';
				}
				else{
					echo show_error($this->email->print_debugger());
				}
			}
			else{
				redirect('backend/Births');
			}
		}
}
