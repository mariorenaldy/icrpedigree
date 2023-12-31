<?php
defined('BASEPATH') OR exit('No direct script access allowed');

#[\AllowDynamicProperties]

class Births extends CI_Controller {
		public function __construct(){
			// Call the CI_Controller constructor
			parent::__construct();
			$this->load->model(array('studModel', 'birthModel', 'caninesModel', 'memberModel', 'logbirthModel', 'pedigreesModel', 'notification_model', 'notificationtype_model', 'news_model', 'stambumModel', 'logstudModel', 'approvalStatusModel'));
			$this->load->library('upload', $this->config->item('upload_birth'));
			$this->load->library(array('session', 'form_validation', 'pagination'));
			$this->load->helper(array('url', 'mail'));
			$this->load->database();
			date_default_timezone_set("Asia/Bangkok");
		}

		public function index(){
            $page = ($this->uri->segment(4)) ? ($this->uri->segment(4) - 1) : 0;
            $config['per_page'] = $this->config->item('backend_birth_count');
            $config['uri_segment'] = 4;
            $config['use_page_numbers'] = TRUE;

            //Encapsulate whole pagination 
            $config['full_tag_open'] = '<ul class="pagination justify-content-end">';
            $config['full_tag_close'] = '</ul>';

            //First link of pagination
            $config['first_link'] = 'First';
            $config['first_tag_open'] = '<li>';
            $config['first_tag_close'] = '</li>';

            //Customizing the Digit Link
            $config['num_tag_open'] = '<li>';
            $config['num_tag_close'] = '</li>';

            //For PREVIOUS PAGE Setup
            $config['prev_link'] = '<';
            $config['prev_tag_open'] = '<li>';
            $config['prev_tag_close'] = '</li>';

            //For NEXT PAGE Setup
            $config['next_link'] = '>';
            $config['next_tag_open'] = '<li>';
            $config['next_tag_close'] = '</li>';

            //For LAST PAGE Setup
            $config['last_link'] = 'Last';
            $config['last_tag_open'] = '<li>';
            $config['last_tag_close'] = '</li>';

            //For CURRENT page on which you are
            $config['cur_tag_open'] = '<li class="active"><a class="page-link bg-primary text-light border-primary" href="#">';
            $config['cur_tag_close'] = '</a></li>';

            $config['attributes'] = array('class' => 'page-link bg-light text-primary');

			// $where['bir_stat'] = $this->config->item('accepted');
			// $where['bir_stat !='] = $this->config->item('processed');
			$where_not_in = array($this->config->item('delete_stat'),$this->config->item('processed'));
            $where['kennels.ken_stat'] = $this->config->item('accepted');
			$data['birth'] = $this->birthModel->get_births($where, $page * $config['per_page'], $this->config->item('backend_birth_count'), $where_not_in)->result();

			$data['stambum'] = array();
            $data['stb_date'] = array();
			$data['stat'] = array();
			$data['completed'] = array();
			

			foreach ($data['birth'] as $r){
				$whereStambum = [];
				$whereStambum['stb_bir_id'] = $r->bir_id;
				$whereStambum['stb_stat != '] = $this->config->item('rejected');
                $stb = $this->stambumModel->get_stambum($whereStambum);
				$data['stambum'][] = $stb->num_rows();
                if ($stb->num_rows())
                    $data['stb_date'][] = $stb->row()->stb_date;
                else
                    $data['stb_date'][] = '';

				if($r->bir_stat == $this->config->item('completed') || $r->bir_stat == $this->config->item('rejected')){
					$data['completed'][] = true;
				}
				else{
					$data['completed'][] = false;
				}

                if ($stb->num_rows() < ($r->bir_male + $r->bir_female)){
                    $piece = explode("-", $r->bir_date_of_birth);
                    $dob = $piece[2]."-".$piece[1]."-".$piece[0];

                    $ts = new DateTime();
                    $ts_birth = new DateTime($dob);
                    if ($ts_birth > $ts){
                        $data['stat'][] = false;
                    }
                    else{ // min 45 hari; max 100 hari
                        $err = 0;
                        $diff = $ts->diff($ts_birth)->days/$this->config->item('min_jarak_lapor_anak');
                        if ($diff < 1){
                            $err++;
                        }

                        if (!$err){
                            $diff = $ts->diff($ts_birth)->days/$this->config->item('jarak_lapor_anak');
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

            $config['base_url'] = base_url().'/backend/Births/index';
            $config['total_rows'] = $this->birthModel->get_births($where, $page * $config['per_page'], 0, $where_not_in)->num_rows();
            $this->pagination->initialize($config);

            $data['keywords'] = '';
            $data['date'] = '';
            $this->session->set_userdata('keywords', '');
            $this->session->set_userdata('date', '');
			$this->load->view('backend/view_births', $data);
		}

		public function search(){
            if ($this->input->post('keywords') || $this->input->post('date')){
                $this->session->set_userdata('keywords', $this->input->post('keywords'));
                $this->session->set_userdata('date', $this->input->post('date'));
                $data['keywords'] = $this->input->post('keywords');
                $data['date'] = $this->input->post('date');
            }
            else{
                if ($this->uri->segment(4)){
                    $data['keywords'] = $this->session->userdata('keywords');
                    $data['date'] = $this->session->userdata('date');
                }
                else{
                    $this->session->set_userdata('keywords', '');
                    $this->session->set_userdata('date', '');
                    $data['keywords'] = '';
                    $data['date'] = '';
                }
            }

            $page = ($this->uri->segment(4)) ? ($this->uri->segment(4) - 1) : 0;
            $config['per_page'] = $this->config->item('backend_birth_count');
            $config['uri_segment'] = 4;
            $config['use_page_numbers'] = TRUE;

            //Encapsulate whole pagination 
            $config['full_tag_open'] = '<ul class="pagination justify-content-end">';
            $config['full_tag_close'] = '</ul>';

            //First link of pagination
            $config['first_link'] = 'First';
            $config['first_tag_open'] = '<li>';
            $config['first_tag_close'] = '</li>';

            //Customizing the Digit Link
            $config['num_tag_open'] = '<li>';
            $config['num_tag_close'] = '</li>';

            //For PREVIOUS PAGE Setup
            $config['prev_link'] = '<';
            $config['prev_tag_open'] = '<li>';
            $config['prev_tag_close'] = '</li>';

            //For NEXT PAGE Setup
            $config['next_link'] = '>';
            $config['next_tag_open'] = '<li>';
            $config['next_tag_close'] = '</li>';

            //For LAST PAGE Setup
            $config['last_link'] = 'Last';
            $config['last_tag_open'] = '<li>';
            $config['last_tag_close'] = '</li>';

            //For CURRENT page on which you are
            $config['cur_tag_open'] = '<li class="active"><a class="page-link bg-primary text-light border-primary" href="#">';
            $config['cur_tag_close'] = '</a></li>';

            $config['attributes'] = array('class' => 'page-link bg-light text-primary');

			$date = '';
			$piece = explode("-", $data['date']);
			if (count($piece) == 3){
				$date = $piece[2]."-".$piece[1]."-".$piece[0];
			}
			if ($date){
				$where['bir_date_of_birth'] = $date;
			}
			// $where['bir_stat'] = $this->config->item('accepted');
			// $where['bir_stat !='] = $this->config->item('processed');
			$where_not_in = array($this->config->item('delete_stat'),$this->config->item('processed'));
            $where['kennels.ken_stat'] = $this->config->item('accepted');
            if ($data['keywords']){
                $like['can_sire.can_a_s'] = $this->input->post('keywords');
                $like['can_dam.can_a_s'] = $this->input->post('keywords');
            }
            else
                $like = null;
			$data['birth'] = $this->birthModel->search_births($like, $where, $page * $config['per_page'], $this->config->item('backend_birth_count'), $where_not_in)->result();

			$data['stambum'] = array();
            $data['stb_date'] = array();
			$data['stat'] = array();
			$data['completed'] = array();
			foreach ($data['birth'] as $r){
				$whereStambum = [];
				$whereStambum['stb_bir_id'] = $r->bir_id;
				$whereStambum['stb_stat != '] = $this->config->item('rejected');
				$stb = $this->stambumModel->get_stambum($whereStambum);
				$data['stambum'][] = $stb->num_rows();
                if ($stb->num_rows())
                    $data['stb_date'][] = $stb->row()->stb_date;
                else
                    $data['stb_date'][] = '';

				if($r->bir_stat == $this->config->item('completed') || $r->bir_stat == $this->config->item('rejected')){
					$data['completed'][] = true;
				}
				else{
					$data['completed'][] = false;
				}

                if ($stb->num_rows() < ($r->bir_male + $r->bir_female)){
                    $piece = explode("-", $r->bir_date_of_birth);
                    $dob = $piece[2]."-".$piece[1]."-".$piece[0];

                    $ts = new DateTime();
                    $ts_birth = new DateTime($dob);
                    if ($ts_birth > $ts){
                        $data['stat'][] = false;
                    }
                    else{ // min 45 hari; max 100 hari
                        $err = 0;
                        $diff = $ts->diff($ts_birth)->days/$this->config->item('min_jarak_lapor_anak');
                        if ($diff < 1){
                            $err++;
                        }

                        if (!$err){
                            $diff = $ts->diff($ts_birth)->days/$this->config->item('jarak_lapor_anak');
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

            $config['base_url'] = base_url().'/backend/Births/search';
            $config['total_rows'] = $this->birthModel->search_births($like, $where, $page * $config['per_page'], 0, $where_not_in)->num_rows();
            $this->pagination->initialize($config);
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
                // min 58 hari; max 75 hari
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
                            $this->session->set_flashdata('birth_message', 'Birth must be reported before '.$this->config->item('jarak_lapor_lahir').' days from stud'); 
                        }
                        else{
                            $diff = $ts->diff($ts_stud)->days/$this->config->item('min_jarak_lapor_lahir');
                            if ($diff < 1){
                                $err++;
                                $this->session->set_flashdata('birth_message', 'Birth must be reported after '.$this->config->item('min_jarak_lapor_lahir').' days from stud');
                            }
    
                            if (!$err){
                                $diff = $ts->diff($ts_stud)->days/$this->config->item('jarak_lapor_lahir');
                                if ($diff > 1){
                                    $err++;
                                    $this->session->set_flashdata('birth_message', 'Birth must be reported before '.$this->config->item('jarak_lapor_lahir').' days from stud');
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
                            $this->session->set_flashdata('birth_message', 'Birth has been saved.');
                        }
                        else{
                            $this->session->set_flashdata('birth_message', 'Birth has been approved.');
                        }
                        redirect('backend/Studs');
                    }
                }
                else{
                    $this->session->set_flashdata('birth_message', 'Lapor lahir tidak valid');
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
							$this->session->set_flashdata('error_message', 'File already exists and not writable.');
							}
						}
					}

                    if (!$err && !$this->input->post('mode')){
						$whereStud['stu_id'] = $this->input->post('bir_stu_id');
						$stud = $this->studModel->get_studs($whereStud)->row();

						if (isset($stud)){
							$piece = explode("-", $this->input->post('bir_date_of_birth'));
							$date = $piece[2]."-".$piece[1]."-".$piece[0];

							$piece = explode("-", $stud->stu_stud_date);
							$studDate = $piece[2]."-".$piece[1]."-".$piece[0];

							$ts = new DateTime($date);
							$ts_stud = new DateTime($studDate);

							$ts_today = new DateTime();
							if ($ts > $ts_today){
								$err++;
								$this->session->set_flashdata('error_message', "The Date of Birth must be before today's date");
							}
							else{
								if ($ts_stud > $ts){
									$err++;
									$this->session->set_flashdata('error_message', 'The Date of Birth must be after the Stud Date');
								}
								else{
									$diff = $ts->diff($ts_stud)->days/$this->config->item('min_jarak_lapor_lahir');
									if ($diff < 1){
										$err++;
										$this->session->set_flashdata('error_message', 'Birth must be reported after '.$this->config->item('min_jarak_lapor_lahir').' days from stud');
									}
	
									if (!$err){
										$diff = $ts->diff($ts_stud)->days/$this->config->item('jarak_lapor_lahir');
										if ($diff > 1){
											$err++;
											$this->session->set_flashdata('error_message', 'Birth must be reported before '.$this->config->item('jarak_lapor_lahir').' days from stud');
										}
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
										$result = $this->notification_model->add(21, $birth, $stud->stu_member_id, "Nama Jantan / Sire Name: ".$stud->sire_a_s.'<br>Nama Betina / Dam Name: '.$stud->dam_a_s);
										if ($result){
											$res = $this->notification_model->add(21, $birth, $stud->stu_partner_id, "Nama Jantan / Sire Name: ".$stud->sire_a_s.'<br>Nama Betina / Dam Name: '.$stud->dam_a_s.'<br><a class="text-reset link-warning" href="'.base_url().'frontend/Stambums/add/'.$birth.'">Lapor Anak / Puppy Report</a>');
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
                                                    $desc .= ' untuk informasi lebih lanjut<br><hr>';
													if ($this->input->post('bir_male') && $this->input->post('bir_female')){
                                                        $desc .= $this->input->post('bir_male').' male(s) and ';
														$desc .= $this->input->post('bir_female').' female(s)';
													}
													else if ($this->input->post('bir_male'))
														$desc .= $this->input->post('bir_male').' male(s)';
													else if ($this->input->post('bir_female'))
														$desc .= $this->input->post('bir_female').' female(s)';
													$desc .= ' was/were born on '.$this->input->post('bir_date_of_birth').'.';
													$desc .= ' Contact '.$partner->mem_name.' ('.$partner->ken_name.') for more information';
													
													$dataNews = array(
														'title' => 'Lahir / Birth '.$can->can_breed,
														'description' => $desc,
														'date' => $date,
														'type' => $this->config->item('birth'),
														'photo' => $damPhoto,
														'trans_id' => $birth,
													); 
													$news = $this->news_model->add($dataNews);
													if ($news){
														$this->db->trans_complete();
														$this->send_stambum_link($partner->mem_email, $partner->mem_username, $c->can_a_s, $can->can_a_s);
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
				$data['status'] = $this->approvalStatusModel->get_status()->result();
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
								$this->session->set_flashdata('error_message', 'File already exists and not writable.');
							}
						}
					}

                    if (!$err && !$this->input->post('mode')){
						$whereStud['stu_id'] = $data['birth']->bir_stu_id;
						$stud = $this->studModel->get_studs($whereStud)->row();
						if (!isset($stud)){
							$err++;
							$this->session->set_flashdata('error_message', 'Invalid stud id'); 
						}
                    }

					if (!$err){
						$piece = explode("-", $this->input->post('bir_date_of_birth'));
						$date = $piece[2]."-".$piece[1]."-".$piece[0];
	
						$ts = new DateTime();
						$ts_birth = new DateTime($date);
						if ($ts_birth > $ts){
							$err++;
							$this->session->set_flashdata('error_message', "The Date of Birth must be before today's date");
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
							'bir_stat' => $this->input->post('bir_stat'),
							'bir_date_of_birth' => $date,
							'bir_user' => $this->session->userdata('use_id'),
							'bir_date' => date('Y-m-d H:i:s'),
						);

						$dataLog = array(
							'log_bir_id' => $this->input->post('bir_id'),
							'log_stu_id' => $data['birth']->bir_stu_id,
							'log_member_id' => $data['birth']->bir_member_id,
							'log_date' => date('Y-m-d H:i:s'),
							'log_male' => $this->input->post('bir_male'),
							'log_female' => $this->input->post('bir_female'),
							'log_dam_photo' => $damPhoto,
							'log_stat' => $this->input->post('bir_stat'),
							'log_date_of_birth' => $date,
							'log_user' => $this->session->userdata('use_id'),
							'log_app_user' => $data['birth']->bir_app_user,
							'log_app_date' => $data['birth']->bir_app_date,
							'log_date' => date('Y-m-d H:i:s'),
							'log_stat' => $data['birth']->bir_stat
						);

						if ($damPhoto != '-'){
							$dataBirth['bir_dam_photo'] = $damPhoto;
							$dataLog['log_dam_photo'] = $damPhoto;
						}
						else{
							$dataLog['log_dam_photo'] = $data['birth']->bir_dam_photo;
						}

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
								$result = $this->notification_model->add(2, $this->uri->segment(4), $stud->stu_member_id, "Nama Jantan / Sire Name: ".$stud->sire_a_s.'<br>Nama Betina / Dam Name: '.$stud->dam_a_s);
								if ($result){
									$res = $this->notification_model->add(2, $this->uri->segment(4), $stud->stu_partner_id, "Nama Jantan / Sire Name: ".$stud->sire_a_s.'<br>Nama Betina / Dam Name: '.$stud->dam_a_s.'<br><a class="text-reset link-warning" href="'.base_url().'frontend/Stambums/add/'.$this->uri->segment(4).'">Lapor Anak / Puppy Report</a>');
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
                                            $desc .= ' untuk informasi lebih lanjut<br><hr>';
                                            if ($birth->bir_male && $birth->bir_female){
                                                $desc .= $birth->bir_male.' male(s) and ';
                                                $desc .= $birth->bir_female.' female(s)';
                                            }
                                            else if ($birth->bir_male)
                                                $desc .= $birth->bir_male.' male(s)';
                                            else if ($birth->bir_female)
                                                $desc .= $birth->bir_female.' female(s)';
                                            $desc .= ' was/were born on '.$birth->bir_date_of_birth.'.';
                                            $desc .= ' Contact '.$partner->mem_name.' ('.$partner->ken_name.') for more information';

											$piece = explode("-", $birth->bir_date_of_birth);
											$date = $piece[2]."-".$piece[1]."-".$piece[0];

											$dataNews = array(
												'title' => 'Lahir / Birth '.$can->can_breed,
												'description' => $desc,
												'date' => $date,
												'type' => $this->config->item('birth'),
												'photo' => $birth->bir_dam_photo,
												'trans_id' => $this->uri->segment(4),
											); 
											$news = $this->news_model->add($dataNews);
											if ($news){
												$this->db->trans_complete();
												$this->send_stambum_link($partner->mem_email, $partner->mem_username, $c->can_a_s, $can->can_a_s);
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
					$data['bir_app_user'] = $this->session->userdata('use_id');
					$data['bir_date'] = date('Y-m-d H:i:s');
					$data['bir_app_date'] = date('Y-m-d H:i:s');
					$data['bir_stat'] = $this->config->item('rejected');
					if(isset($_GET['reason'])) {
						$data['bir_app_note'] = $_GET['reason'];
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
							'log_app_user' => $this->session->userdata('use_id'),
							'log_date' => date('Y-m-d H:i:s'),
							'log_app_date' => date('Y-m-d H:i:s'),
							'log_stat' => $this->config->item('rejected'),
						);
						$log = $this->logbirthModel->add_log($dataLog);
						if ($log){
							$wheStud['stu_id'] = $birth->bir_stu_id;
							$stud = $this->studModel->get_studs($wheStud)->row();
							$result = $this->notification_model->add(7, $this->uri->segment(4), $stud->stu_member_id, "Nama Jantan / Sire Name: ".$stud->sire_a_s.'<br>Nama Betina / Dam Name: '.$stud->dam_a_s);
							if ($result){
								$this->db->trans_complete();
								$this->send_reject_birth($birth->mem_email, $birth->mem_name, $stud->sire_a_s, $stud->dam_a_s, $data['bir_app_note']);
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
					$data['bir_app_user'] = $this->session->userdata('use_id');
					$data['bir_date'] = date('Y-m-d H:i:s');
					$data['bir_app_date'] = date('Y-m-d H:i:s');
					$data['bir_stat'] = $this->config->item('delete_stat');
                    if ($this->uri->segment(5)){
                        $data['bir_app_note'] = urldecode($this->uri->segment(5));
                    }
					$this->db->trans_strict(FALSE);
					$this->db->trans_start();
					$res = $this->birthModel->update_births($data, $where);
					$oldBirth = $this->birthModel->get_births($where)->row();
					if ($res){
						$dataLog = array(
							'log_bir_id' => $this->uri->segment(4),
							'log_stu_id' => $oldBirth->bir_stu_id,
							'log_member_id' => $oldBirth->bir_member_id,
							'log_user' => $this->session->userdata('use_id'),
							'log_app_user' => $this->session->userdata('use_id'),
							'log_date' => date('Y-m-d H:i:s'),
							'log_app_date' => date('Y-m-d H:i:s'),
							'log_dam_photo' => $oldBirth->bir_dam_photo,
							'log_male' => $oldBirth->bir_male,
							'log_female' => $oldBirth->bir_female,
							'log_date_of_birth' => date('Y-m-d', strtotime($oldBirth->bir_date_of_birth)),
							'log_stat' => $this->config->item('delete_stat'),
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
                                    $this->session->set_flashdata('delete_success', TRUE);
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
						$this->session->set_flashdata('delete_message', 'Failed to delete birth id = '.$this->uri->segment(4).'. Err code: '.$err);
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

        public function complete(){
			if ($this->uri->segment(4)){
                if ($this->session->userdata('use_id')){
                    $err = 0;
                    $where['bir_id'] = $this->uri->segment(4);
                    $data['bir_user'] = $this->session->userdata('use_id');
                    $data['bir_date'] = date('Y-m-d H:i:s');
                    $data['bir_stat'] = $this->config->item('completed');
                    $this->db->trans_strict(FALSE);
					$this->db->trans_start();
					$res = $this->birthModel->update_births($data, $where);
					if ($res){
						$dataLog = array(
							'log_bir_id' => $this->uri->segment(4),
							'log_user' => $this->session->userdata('use_id'),
							'log_date' => date('Y-m-d H:i:s'),
							'log_stat' => $this->config->item('completed'),
						);
						$log = $this->logbirthModel->add_log($dataLog);
						if ($log){
                            $this->db->trans_complete();
                            $this->session->set_flashdata('complete_success', TRUE);
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
						$this->session->set_flashdata('delete_message', 'Failed to complete birth id = '.$this->uri->segment(4).'. Err code: '.$err);
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
		public function send_stambum_link($email, $member, $sire, $dam){
			$mail = send_stambum_link($email, $member, $sire, $dam);
			if (!$mail){
				$this->session->set_flashdata('error_message', show_error($this->email->print_debugger()));
			}
		}

		public function send_reject_birth($email, $member, $sire, $dam, $reason){
			$mail = send_reject_birth($email, $member, $sire, $dam, $reason);
			if (!$mail){
				$this->session->set_flashdata('error_message', show_error($this->email->print_debugger()));
			}
		}
}
