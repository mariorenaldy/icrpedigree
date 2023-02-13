<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Studs extends CI_Controller {
		public function __construct(){
			// Call the CI_Controller constructor
			parent::__construct();
			$this->load->model(array('studModel', 'caninesModel', 'notification_model', 'notificationtype_model', 'memberModel', 'birthModel', 'logstudModel', 'news_model'));
			$this->load->library('upload', $this->config->item('upload_stud'));
			$this->load->library(array('session', 'form_validation'));
			$this->load->helper(array('url', 'notif'));
			$this->load->database();
			date_default_timezone_set("Asia/Bangkok");
		}

		public function index(){
			$where['stu_stat'] = $this->config->item('accepted');
			$data['stud'] = $this->studModel->get_studs($where)->result();

			$data['birth'] = array();
			foreach ($data['stud'] as $s){
				$whereBirth = [];
				$whereBirth['bir_stu_id'] = $s->stu_id;
				$data['birth'][] = $this->birthModel->get_births($whereBirth)->num_rows();
			}
			$this->load->view('backend/view_studs', $data);
		}

		public function search(){
			$date = '';
			$piece = explode("-", $this->input->post('keywords'));
            if (count($piece) == 3){
                $date = $piece[2]."-".$piece[1]."-".$piece[0];
            }
			if ($date){
				$where['stu_stud_date'] = $date;
			}
			$where['stu_stat'] = $this->config->item('accepted');
			$data['stud'] = $this->studModel->get_studs($where)->result();

			$data['birth'] = array();
			foreach ($data['stud'] as $s){
				$whereBirth = [];
				$whereBirth['bir_stu_id'] = $s->stu_id;
				$data['birth'][] = $this->birthModel->get_births($whereBirth)->num_rows();
			}
			$this->load->view('backend/view_studs', $data);
		}

		public function view_approve(){
			$where['stu_stat'] = $this->config->item('saved');
			$data['stud'] = $this->studModel->get_studs($where)->result();
			$this->load->view('backend/approve_studs', $data);
		}

		public function search_approve(){
			$date = '';
			$piece = explode("-", $this->input->post('keywords'));
            if (count($piece) == 3){
                $date = $piece[2]."-".$piece[1]."-".$piece[0];
            }
			if ($date){
				$where['stu_stud_date'] = $date;
			}
			$where['stu_stat'] = $this->config->item('saved');
			$data['stud'] = $this->studModel->get_studs($where)->result();
			$this->load->view('backend/approve_studs', $data);
		}

		public function add(){
			$data['member'] = [];
			$data['sire'] = [];
			$data['sireStat'] = [];
			$data['dam'] = [];
			$data['damStat'] = [];
			$this->load->view('backend/add_stud', $data);
		}

		public function search_member(){
			if ($this->session->userdata('use_username')){
				$likeMember['mem_name'] = $this->input->post('mem_name');
				$likeMember['ken_name'] = $this->input->post('mem_name');
				$whereMember['mem_stat'] = $this->config->item('accepted');
				$data['member'] = $this->memberModel->search_members($likeMember, $whereMember)->result();

				if ($data['member']){
					$whereSire['can_member_id'] = $data['member'][0]->mem_id;
					$whereSire['can_gender'] = 'MALE';
					$whereSire['can_stat'] = $this->config->item('accepted');
					$data['sire'] = $this->caninesModel->get_canines_simple($whereSire)->result();
				}
				else{
					$data['sire'] = [];
				}
				
				// Sire harus 12 bulan
				$stat = Array();
				foreach ($data['sire'] as $c){
					$can = $this->caninesModel->get_dob_by_id($c->id);
					$sire_dob = $can->can_date_of_birth;
					
					$ts_now = date('Y-m-d');
					$ts = strtotime($ts_now);
					$tssire = strtotime($sire_dob);
					
					$year = date('Y', $ts);
					$yearsire = date('Y', $tssire);
	
					$month = date('m', $ts);
					$monthsire = date('m', $tssire);
	
					$diffsire = (($year - $yearsire) * 12) + ($month - $monthsire);
					if (abs($diffsire) < $this->config->item('umur_canine')) {
						$stat[] = 0;
					}
					else{
						$stat[] = 1;
					}
				}
				$data['sireStat'] = $stat;

				$data['dam'] = [];
				$data['damStat'] = [];
				$this->load->view('backend/add_stud', $data);
			}
			else {
				redirect("backend/Users/login");
			}
		}

		public function search_sire(){
			if ($this->session->userdata('use_username')){
				$likeMember['mem_name'] = $this->input->post('mem_name');
				$likeMember['ken_name'] = $this->input->post('mem_name');
				$whereMember['mem_stat'] = $this->config->item('accepted');
				$data['member'] = $this->memberModel->search_members($likeMember, $whereMember)->result();
				
				$whereSire['can_member_id'] = $this->input->post('can_member_id');
				$whereSire['can_gender'] = 'MALE';
				$whereSire['can_stat'] = $this->config->item('accepted');
				$data['sire'] = $this->caninesModel->get_canines_simple($whereSire)->result();
	
				// Sire harus 12 bulan
				$stat = Array();
				foreach ($data['sire'] as $c){
					$can = $this->caninesModel->get_dob_by_id($c->id);
					$sire_dob = $can->can_date_of_birth;
					
					$ts_now = date('Y-m-d');
					$ts = strtotime($ts_now);
					$tssire = strtotime($sire_dob);
					
					$year = date('Y', $ts);
					$yearsire = date('Y', $tssire);
	
					$month = date('m', $ts);
					$monthsire = date('m', $tssire);
	
					$diffsire = (($year - $yearsire) * 12) + ($month - $monthsire);
					if (abs($diffsire) < $this->config->item('umur_canine')) {
						$stat[] = 0;
					}
					else{
						$stat[] = 1;
					}
				}
				$data['sireStat'] = $stat;

				$data['dam'] = [];
				$data['damStat'] = [];
				$this->load->view('backend/add_stud', $data);
			}
			else{
				redirect("backend/Users/login");
			}
		}

		public function search_dam(){
			if ($this->session->userdata('use_username')){
				$likeMember['mem_name'] = $this->input->post('mem_name');
				$likeMember['ken_name'] = $this->input->post('mem_name');
				$whereMember['mem_stat'] = $this->config->item('accepted');
				$data['member'] = $this->memberModel->search_members($likeMember, $whereMember)->result();
				
				$whereSire['can_member_id'] = $this->input->post('can_member_id');
				$whereSire['can_gender'] = 'MALE';
				$whereSire['can_stat'] = $this->config->item('accepted');
				$data['sire'] = $this->caninesModel->get_canines_simple($whereSire)->result();
	
				// Sire harus 12 bulan
				$stat = Array();
				foreach ($data['sire'] as $c){
					$can = $this->caninesModel->get_dob_by_id($c->id);
					$sire_dob = $can->can_date_of_birth;
					
					$ts_now = date('Y-m-d');
					$ts = strtotime($ts_now);
					$tssire = strtotime($sire_dob);
					
					$year = date('Y', $ts);
					$yearsire = date('Y', $tssire);
	
					$month = date('m', $ts);
					$monthsire = date('m', $tssire);
	
					$diffsire = (($year - $yearsire) * 12) + ($month - $monthsire);
					if (abs($diffsire) < $this->config->item('umur_canine')) {
						$stat[] = 0;
					}
					else{
						$stat[] = 1;
					}
				}
				$data['sireStat'] = $stat;
	
				$like['can_a_s'] = $this->input->post('can_a_s');
				$whereDam['can_gender'] = 'FEMALE';
				$whereDam['can_stat'] = $this->config->item('accepted');
				$whereDam['can_id !='] = $this->config->item('dam_id');
				$data['dam'] = $this->caninesModel->search_canines_simple($like, $whereDam)->result();
	
				// Dam harus 12 bulan
				$stat = Array();
				foreach ($data['dam'] as $c){
					$can = $this->caninesModel->get_dob_by_id($c->id);
					$dam_dob = $can->can_date_of_birth;
					
					$ts_now = date('Y-m-d');
					$ts = strtotime($ts_now);
					$tsdam = strtotime($dam_dob);
					
					$year = date('Y', $ts);
					$yeardam = date('Y', $tsdam);
	
					$month = date('m', $ts);
					$monthdam = date('m', $tsdam);
	
					$diffdam = (($year - $yeardam) * 12) + ($month - $monthdam);
					if (abs($diffdam) < $this->config->item('umur_canine')) {
						$stat[] = 0;
					}
					else{
						$stat[] = 1;
					}
				}
				$data['damStat'] = $stat;
				$this->load->view('backend/add_stud', $data);
			}
			else{
				redirect("backend/Users/login");
			}
		}

		public function validate_add(){
			if ($this->session->userdata('use_username')){
				$this->form_validation->set_error_delimiters('<div>','</div>');
				$this->form_validation->set_rules('can_member_id', 'Member id ', 'trim|required');
				$this->form_validation->set_rules('stu_sire_id', 'Sire id ', 'trim|required');
				$this->form_validation->set_rules('stu_dam_id', 'Dam id ', 'trim|required');
				$this->form_validation->set_rules('stu_stud_date', 'Stud date ', 'trim|required');
				
				$likeMember['mem_name'] = $this->input->post('mem_name');
				$likeMember['ken_name'] = $this->input->post('mem_name');
				$whereMember['mem_stat'] = $this->config->item('accepted');
				$data['member'] = $this->memberModel->search_members($likeMember, $whereMember)->result();

				$whereSire['can_member_id'] = $this->input->post('can_member_id');
				$whereSire['can_gender'] = 'MALE';
				$whereSire['can_stat'] = $this->config->item('accepted');
				$data['sire'] = $this->caninesModel->get_canines_simple($whereSire)->result();
	
				// Sire harus 12 bulan
				$data['sireStat'] = Array();
				foreach ($data['sire'] as $c){
					$can = $this->caninesModel->get_dob_by_id($c->id);
					$sire_dob = $can->can_date_of_birth;
					
					$ts_now = date('Y-m-d');
					$ts = strtotime($ts_now);
					$tssire = strtotime($sire_dob);
					
					$year = date('Y', $ts);
					$yearsire = date('Y', $tssire);
	
					$month = date('m', $ts);
					$monthsire = date('m', $tssire);
	
					$diffsire = (($year - $yearsire) * 12) + ($month - $monthsire);
					if (abs($diffsire) < $this->config->item('umur_canine')) {
						$data['sireStat'][] = 0;
					}
					else{
						$data['sireStat'][] = 1;
					}
				}
	
				$like['can_a_s'] = $this->input->post('can_a_s');
				$whereDam['can_gender'] = 'FEMALE';
				$whereDam['can_stat'] = $this->config->item('accepted');
				$whereDam['can_id !='] = $this->config->item('dam_id');
				$data['dam'] = $this->caninesModel->search_canines_simple($like, $whereDam)->result();
	
				// Dam harus 12 bulan
				$data['damStat'] = Array();
				foreach ($data['dam'] as $c){
					$can = $this->caninesModel->get_dob_by_id($c->id);
					$dam_dob = $can->can_date_of_birth;
					
					$ts_now = date('Y-m-d');
					$ts = strtotime($ts_now);
					$tsdam = strtotime($dam_dob);
					
					$year = date('Y', $ts);
					$yeardam = date('Y', $tsdam);
	
					$month = date('m', $ts);
					$monthdam = date('m', $tsdam);
	
					$diffdam = (($year - $yeardam) * 12) + ($month - $monthdam);
					if (abs($diffdam) < $this->config->item('umur_canine')) {
						$data['damStat'][] = 0;
					}
					else{
						$data['damStat'][] = 1;
					}
				}
	
				if ($this->form_validation->run() == FALSE){
					$this->load->view('backend/add_stud', $data);
				}
				else{
					$wheDam['can_id'] = $this->input->post('stu_dam_id');
					$can = $this->caninesModel->get_canines($wheDam)->row();
					if ($can){
						$err = 0;
						$photo = '-';
						if (!$err && isset($_FILES['attachment_stud']) && !empty($_FILES['attachment_stud']['tmp_name']) && is_uploaded_file($_FILES['attachment_stud']['tmp_name'])){
							if (is_uploaded_file($_FILES['attachment_stud']['tmp_name'])){
								$this->upload->initialize($this->config->item('upload_stud'));
								if ($this->upload->do_upload('attachment_stud')){
									$uploadData = $this->upload->data();
									$photo = $uploadData['file_name'];
								}
								else{
									$err++;
									$this->session->set_flashdata('error_message', 'Stud Photo Error: '.$this->upload->display_errors());
								}
							}
						}
		
						if (!$err && $photo == "-"){
							$err++;
							$this->session->set_flashdata('error_message', 'Stud Photo is required');
						}
	
						if (!$err){
							$sire = '-';
							if (isset($_FILES['attachment_sire']) && !empty($_FILES['attachment_sire']['tmp_name']) && is_uploaded_file($_FILES['attachment_sire']['tmp_name'])){
								$this->upload->initialize($this->config->item('upload_stud_sire'));
								if ($this->upload->do_upload('attachment_sire')){
									$uploadData = $this->upload->data();
									$sire = $uploadData['file_name'];
								}
								else{
									$err++;
									$this->session->set_flashdata('error_message', 'Sire Photo Error: '.$this->upload->display_errors());
								}
							}
						}
		
						if (!$err && $sire == "-"){
							$err++;
							$this->session->set_flashdata('error_message', 'Sire photo is required');
						}
		
						if (!$err){
							$dam = '-';
							if (isset($_FILES['attachment_dam']) && !empty($_FILES['attachment_dam']['tmp_name']) && is_uploaded_file($_FILES['attachment_dam']['tmp_name'])){
								$this->upload->initialize($this->config->item('upload_stud_dam'));
								if ($this->upload->do_upload('attachment_dam')){
									$uploadData = $this->upload->data();
									$dam = $uploadData['file_name'];
								}
								else{
									$err++;
									$this->session->set_flashdata('error_message', 'Dam Photo Error: '.$this->upload->display_errors());
								}
							}
						}
		
						if (!$err && $dam == "-"){
							$err++;
							$this->session->set_flashdata('error_message', 'Dam photo is required');
						}
		
						if (!$err){
							$piece = explode("-", $this->input->post('stu_stud_date'));
							$date = $piece[2]."-".$piece[1]."-".$piece[0];

							$data = array(
								'stu_photo' => $photo,
								'stu_sire_id' => $this->input->post('stu_sire_id'),
								'stu_dam_id' => $this->input->post('stu_dam_id'),
								'stu_sire_photo' => $sire,
								'stu_dam_photo' => $dam,
								'stu_stud_date' => $date,
								'stu_member_id' => $this->input->post('can_member_id'),
								'stu_app_user' => $this->session->userdata('use_id'),
								'stu_app_date' => date('Y-m-d H:i:s'),
								'stu_stat' => $this->config->item('accepted'),
								'stu_partner_id' => $can->can_member_id,
								'stu_user' => $this->session->userdata('use_id'),
								'stu_date' => date('Y-m-d H:i:s'),
								'stu_reg_date' => date('Y-m-d H:i:s'),
							);

							$this->db->trans_strict(FALSE);
							$this->db->trans_start();
							$stud = $this->studModel->add_studs($data);
							if ($stud){
								$dataLog = array(
									'log_stu_id' => $stud,
									'log_photo' => $photo,
									'log_sire_id' => $this->input->post('stu_sire_id'),
									'log_dam_id' => $this->input->post('stu_dam_id'),
									'log_sire_photo' => $sire,
									'log_dam_photo' => $dam,
									'log_stud_date' => $date,
									'log_member_id' => $this->input->post('can_member_id'),
									'log_app_user' => $this->session->userdata('use_id'),
									'log_app_date' => date('Y-m-d H:i:s'),
									'log_stat' => $this->config->item('accepted'),
									'log_partner_id' => $can->can_member_id,
									'log_user' => $this->session->userdata('use_id'),
									'log_date' => date('Y-m-d H:i:s'),
								);
								$log = $this->logstudModel->add_log($dataLog);
								if ($log){
									$result = $this->notification_model->add(1, $stud, $this->input->post('can_member_id'));
									if ($result){
										$res = $this->notification_model->add(1, $stud, $can->can_member_id);
										if ($res){
											$whe['mem_id'] = $this->input->post('can_member_id');
											$member = $this->memberModel->get_members($whe)->row();

											$whePartner['mem_id'] = $can->can_member_id;
											$partner = $this->memberModel->get_members($whePartner)->row();

											$wheSire['can_id'] = $this->input->post('stu_sire_id');
											$c = $this->caninesModel->get_canines($wheSire)->row();

											$desc = 'Telah dilakukan pacak oleh '.$member->mem_name.' ('.$member->ken_name.')';
											$desc .= ' pada tanggal '.$this->input->post('stu_stud_date');
											$desc .= ' antara '.$c->can_a_s;
											$desc .= ' dan '.$can->can_a_s;

											$dataNews = array(
												'title' => 'Pacak '.$can->can_breed,
												'description' => $desc
											); 
											$news = $this->news_model->add($dataNews);
											if ($news){
												$this->db->trans_complete();
												if ($member->mem_firebase_token){
													$notif = $this->notificationtype_model->get_by_id(1);
													firebase_notif($member->mem_firebase_token, $notif[0]->title, $notif[0]->description);
												}
												if ($partner->mem_firebase_token){
													$notif = $this->notificationtype_model->get_by_id(1);
													firebase_notif($partner->mem_firebase_token, $notif[0]->title, $notif[0]->description);
												}
												$this->session->set_flashdata('mesg', base_url().'frontend/Births/add/'.$stud);
												$this->session->set_flashdata('telp', $partner->mem_hp);
												$this->session->set_flashdata('add_success', TRUE);
												redirect('backend/Studs');
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
						if ($err){
							$this->db->trans_rollback();
							$this->session->set_flashdata('error_message', 'Failed to save stud. Err code: '+$err);
							$this->load->view('backend/add_stud', $data);
						}
					}
					else{
						$this->session->set_flashdata('error_message', 'Failed to save stud. Err code: 6');
						$this->load->view('backend/add_stud', $data);
					}
				}
			}
			else{
				redirect("backend/Users/login");
			}
		}

		public function edit(){
			if ($this->uri->segment(4)){
				$where['stu_id'] = $this->uri->segment(4);
				$data['stud'] = $this->studModel->get_studs($where)->row();
				
				$whereMember['mem_id'] = $data['stud']->stu_member_id;
				$data['member'] = $this->memberModel->get_members($whereMember)->row();
				
				$whereSire['can_id'] = $data['stud']->stu_sire_id;
				$data['sire'] = $this->caninesModel->get_canines_simple($whereSire)->result();
	
				// Sire harus 12 bulan
				$data['sireStat'] = Array();
				foreach ($data['sire'] as $c){
					$can = $this->caninesModel->get_dob_by_id($c->id);
					$sire_dob = $can->can_date_of_birth;
					
					$ts_now = date('Y-m-d');
					$ts = strtotime($ts_now);
					$tssire = strtotime($sire_dob);
					
					$year = date('Y', $ts);
					$yearsire = date('Y', $tssire);
	
					$month = date('m', $ts);
					$monthsire = date('m', $tssire);
	
					$diffsire = (($year - $yearsire) * 12) + ($month - $monthsire);
					if (abs($diffsire) < $this->config->item('umur_canine')) {
						$data['sireStat'][] = 0;
					}
					else{
						$data['sireStat'][] = 1;
					}
				}

				$whereDam['can_id'] = $data['stud']->stu_dam_id;
				$data['dam'] = $this->caninesModel->get_canines_simple($whereDam)->result();
	
				// Dam harus 12 bulan
				$data['damStat'] = Array();
				foreach ($data['dam'] as $c){
					$can = $this->caninesModel->get_dob_by_id($c->id);
					$dam_dob = $can->can_date_of_birth;
					
					$ts_now = date('Y-m-d');
					$ts = strtotime($ts_now);
					$tsdam = strtotime($dam_dob);
					
					$year = date('Y', $ts);
					$yeardam = date('Y', $tsdam);
	
					$month = date('m', $ts);
					$monthdam = date('m', $tsdam);
	
					$diffdam = (($year - $yeardam) * 12) + ($month - $monthdam);
					if (abs($diffdam) < $this->config->item('umur_canine')) {
						$data['damStat'][] = 0;
					}
					else{
						$data['damStat'][] = 1;
					}
				}
				$data['mode'] = 0;
				$this->load->view('backend/edit_stud', $data);
			}
			else{
				redirect("backend/Studs");
			}
		}

		public function search_sire_update(){
			if ($this->session->userdata('use_username')){
				$where['stu_id'] = $this->input->post('stu_id');
				$data['stud'] = $this->studModel->get_studs($where)->row();
				$whereMember['mem_id'] = $data['stud']->stu_member_id;
				$data['member'] = $this->memberModel->get_members($whereMember)->row();
				
				$whereSire['can_member_id'] = $this->input->post('can_member_id');
				$whereSire['can_gender'] = 'MALE';
				$whereSire['can_stat'] = $this->config->item('accepted');
				$data['sire'] = $this->caninesModel->get_canines_simple($whereSire)->result();
	
				// Sire harus 12 bulan
				$stat = Array();
				foreach ($data['sire'] as $c){
					$can = $this->caninesModel->get_dob_by_id($c->id);
					$sire_dob = $can->can_date_of_birth;
					
					$ts_now = date('Y-m-d');
					$ts = strtotime($ts_now);
					$tssire = strtotime($sire_dob);
					
					$year = date('Y', $ts);
					$yearsire = date('Y', $tssire);
	
					$month = date('m', $ts);
					$monthsire = date('m', $tssire);
	
					$diffsire = (($year - $yearsire) * 12) + ($month - $monthsire);
					if (abs($diffsire) < $this->config->item('umur_canine')) {
						$stat[] = 0;
					}
					else{
						$stat[] = 1;
					}
				}
				$data['sireStat'] = $stat;

				$whereDam['can_id'] = $this->input->post('stu_dam_id');
				$data['dam'] = $this->caninesModel->get_canines_simple($whereDam)->result();
	
				// Dam harus 12 bulan
				$data['damStat'] = Array();
				foreach ($data['dam'] as $c){
					$can = $this->caninesModel->get_dob_by_id($c->id);
					$dam_dob = $can->can_date_of_birth;
					
					$ts_now = date('Y-m-d');
					$ts = strtotime($ts_now);
					$tsdam = strtotime($dam_dob);
					
					$year = date('Y', $ts);
					$yeardam = date('Y', $tsdam);
	
					$month = date('m', $ts);
					$monthdam = date('m', $tsdam);
	
					$diffdam = (($year - $yeardam) * 12) + ($month - $monthdam);
					if (abs($diffdam) < $this->config->item('umur_canine')) {
						$data['damStat'][] = 0;
					}
					else{
						$data['damStat'][] = 1;
					}
				}
				$data['mode'] = 1;
				$this->load->view('backend/edit_stud', $data);
			}
			else{
				redirect("backend/Users/login");
			}
		}

		public function search_dam_update(){
			if ($this->session->userdata('use_username')){
				$where['stu_id'] = $this->input->post('stu_id');
				$data['stud'] = $this->studModel->get_studs($where)->row();
				$whereMember['mem_id'] = $data['stud']->stu_member_id;
				$data['member'] = $this->memberModel->get_members($whereMember)->row();
				
				$whereSire['can_member_id'] = $this->input->post('can_member_id');
				$whereSire['can_gender'] = 'MALE';
				$whereSire['can_stat'] = $this->config->item('accepted');
				$data['sire'] = $this->caninesModel->get_canines_simple($whereSire)->result();
	
				// Sire harus 12 bulan
				$stat = Array();
				foreach ($data['sire'] as $c){
					$can = $this->caninesModel->get_dob_by_id($c->id);
					$sire_dob = $can->can_date_of_birth;
					
					$ts_now = date('Y-m-d');
					$ts = strtotime($ts_now);
					$tssire = strtotime($sire_dob);
					
					$year = date('Y', $ts);
					$yearsire = date('Y', $tssire);
	
					$month = date('m', $ts);
					$monthsire = date('m', $tssire);
	
					$diffsire = (($year - $yearsire) * 12) + ($month - $monthsire);
					if (abs($diffsire) < $this->config->item('umur_canine')) {
						$stat[] = 0;
					}
					else{
						$stat[] = 1;
					}
				}
				$data['sireStat'] = $stat;
	
				$like['can_a_s'] = $this->input->post('can_a_s');
				$whereDam['can_gender'] = 'FEMALE';
				$whereDam['can_stat'] = $this->config->item('accepted');
				$whereDam['can_id !='] = $this->config->item('dam_id');
				$data['dam'] = $this->caninesModel->search_canines_simple($like, $whereDam)->result();
	
				// Dam harus 12 bulan
				$stat = Array();
				foreach ($data['dam'] as $c){
					$can = $this->caninesModel->get_dob_by_id($c->id);
					$dam_dob = $can->can_date_of_birth;
					
					$ts_now = date('Y-m-d');
					$ts = strtotime($ts_now);
					$tsdam = strtotime($dam_dob);
					
					$year = date('Y', $ts);
					$yeardam = date('Y', $tsdam);
	
					$month = date('m', $ts);
					$monthdam = date('m', $tsdam);
	
					$diffdam = (($year - $yeardam) * 12) + ($month - $monthdam);
					if (abs($diffdam) < $this->config->item('umur_canine')) {
						$stat[] = 0;
					}
					else{
						$stat[] = 1;
					}
				}
				$data['damStat'] = $stat;
				$data['mode'] = 1;
				$this->load->view('backend/edit_stud', $data);
			}
			else{
				redirect("backend/Users/login");
			}
		}

		public function validate_edit(){
			if ($this->session->userdata('use_username')){
				$this->form_validation->set_error_delimiters('<div>','</div>');
				$this->form_validation->set_rules('stu_id', 'Stud id ', 'trim|required');
				$this->form_validation->set_rules('can_member_id', 'Member id ', 'trim|required');
				$this->form_validation->set_rules('stu_sire_id', 'Sire id ', 'trim|required');
				$this->form_validation->set_rules('stu_dam_id', 'Dam id ', 'trim|required');
				$this->form_validation->set_rules('stu_stud_date', 'Stud date ', 'trim|required');
				
				$where['stu_id'] = $this->input->post('stu_id');
				$data['stud'] = $this->studModel->get_studs($where)->row();
				$whereMember['mem_id'] = $data['stud']->stu_member_id;
				$data['member'] = $this->memberModel->get_members($whereMember)->row();

				$whereSire['can_member_id'] = $this->input->post('can_member_id');
				$whereSire['can_gender'] = 'MALE';
				$whereSire['can_stat'] = $this->config->item('accepted');
				$data['sire'] = $this->caninesModel->get_canines_simple($whereSire)->result();
	
				// Sire harus 12 bulan
				$data['sireStat'] = Array();
				foreach ($data['sire'] as $c){
					$can = $this->caninesModel->get_dob_by_id($c->id);
					$sire_dob = $can->can_date_of_birth;
					
					$ts_now = date('Y-m-d');
					$ts = strtotime($ts_now);
					$tssire = strtotime($sire_dob);
					
					$year = date('Y', $ts);
					$yearsire = date('Y', $tssire);
	
					$month = date('m', $ts);
					$monthsire = date('m', $tssire);
	
					$diffsire = (($year - $yearsire) * 12) + ($month - $monthsire);
					if (abs($diffsire) < $this->config->item('umur_canine')) {
						$data['sireStat'][] = 0;
					}
					else{
						$data['sireStat'][] = 1;
					}
				}
	
				$like['can_a_s'] = $this->input->post('can_a_s');
				$whereDam['can_gender'] = 'FEMALE';
				$whereDam['can_stat'] = $this->config->item('accepted');
				$whereDam['can_id !='] = $this->config->item('dam_id');
				$data['dam'] = $this->caninesModel->search_canines_simple($like, $whereDam)->result();
	
				// Dam harus 12 bulan
				$data['damStat'] = Array();
				foreach ($data['dam'] as $c){
					$can = $this->caninesModel->get_dob_by_id($c->id);
					$dam_dob = $can->can_date_of_birth;
					
					$ts_now = date('Y-m-d');
					$ts = strtotime($ts_now);
					$tsdam = strtotime($dam_dob);
					
					$year = date('Y', $ts);
					$yeardam = date('Y', $tsdam);
	
					$month = date('m', $ts);
					$monthdam = date('m', $tsdam);
	
					$diffdam = (($year - $yeardam) * 12) + ($month - $monthdam);
					if (abs($diffdam) < $this->config->item('umur_canine')) {
						$data['damStat'][] = 0;
					}
					else{
						$data['damStat'][] = 1;
					}
				}
				$data['mode'] = 1;
	
				if ($this->form_validation->run() == FALSE){
					$this->load->view('backend/edit_stud', $data);
				}
				else{
					$wheDam['can_id'] = $this->input->post('stu_dam_id');
					$can = $this->caninesModel->get_canines($wheDam)->row();
					if ($can){
						$err = 0;
						$photo = '-';
						if (!$err && isset($_FILES['attachment_stud']) && !empty($_FILES['attachment_stud']['tmp_name']) && is_uploaded_file($_FILES['attachment_stud']['tmp_name'])){
							if (is_uploaded_file($_FILES['attachment_stud']['tmp_name'])){
								$this->upload->initialize($this->config->item('upload_stud'));
								if ($this->upload->do_upload('attachment_stud')){
									$uploadData = $this->upload->data();
									$photo = $uploadData['file_name'];
								}
								else{
									$err++;
									$this->session->set_flashdata('error_message', 'Stud Photo Error: '.$this->upload->display_errors());
								}
							}
						}
		
						if (!$err){
							$sire = '-';
							if (isset($_FILES['attachment_sire']) && !empty($_FILES['attachment_sire']['tmp_name']) && is_uploaded_file($_FILES['attachment_sire']['tmp_name'])){
								$this->upload->initialize($this->config->item('upload_stud_sire'));
								if ($this->upload->do_upload('attachment_sire')){
									$uploadData = $this->upload->data();
									$sire = $uploadData['file_name'];
								}
								else{
									$err++;
									$this->session->set_flashdata('error_message', 'Sire Photo Error: '.$this->upload->display_errors());
								}
							}
						}
		
						if (!$err){
							$dam = '-';
							if (isset($_FILES['attachment_dam']) && !empty($_FILES['attachment_dam']['tmp_name']) && is_uploaded_file($_FILES['attachment_dam']['tmp_name'])){
								$this->upload->initialize($this->config->item('upload_stud_dam'));
								if ($this->upload->do_upload('attachment_dam')){
									$uploadData = $this->upload->data();
									$dam = $uploadData['file_name'];
								}
								else{
									$err++;
									$this->session->set_flashdata('error_message', 'Dam Photo Error: '.$this->upload->display_errors());
								}
							}
						}				
		
						if (!$err){
							$piece = explode("-", $this->input->post('stu_stud_date'));
							$date = $piece[2]."-".$piece[1]."-".$piece[0];

							$data = array(
								'stu_sire_id' => $this->input->post('stu_sire_id'),
								'stu_dam_id' => $this->input->post('stu_dam_id'),
								'stu_stud_date' => $date,
								'stu_user' => $this->session->userdata('use_id'),
								'stu_date' => date('Y-m-d H:i:s'),
								'stu_partner_id' => $can->can_member_id,
							);
							if ($photo)
								$data['stu_photo'] = $photo;
							if ($sire)
								$data['stu_sire_photo'] = $sire;
							if ($dam)
								$data['stu_dam_photo'] = $dam;

							$this->db->trans_strict(FALSE);
							$this->db->trans_start();
							$stud = $this->studModel->update_studs($data, $where);
							if ($stud){
								$dataLog = array(
									'log_stu_id' => $stud,
									'log_photo' => $photo,
									'log_sire_id' => $this->input->post('stu_sire_id'),
									'log_dam_id' => $this->input->post('stu_dam_id'),
									'log_sire_photo' => $sire,
									'log_dam_photo' => $dam,
									'log_stud_date' => $date,
									'log_user' => $this->session->userdata('use_id'),
									'log_date' => date('Y-m-d H:i:s'),
									'log_partner_id' => $can->can_member_id,
								);
								$log = $this->logstudModel->add_log($dataLog);
								if ($log){
									$result = $this->notification_model->add(18, $this->input->post('stu_id'), $can->can_member_id);
									if ($result){
										$this->db->trans_complete();
										$whePartner['mem_id'] = $can->can_member_id;
										$partner = $this->memberModel->get_members($whePartner)->row();
										if ($partner->mem_firebase_token){
											$notif = $this->notificationtype_model->get_by_id(18);
											firebase_notif($partner->mem_firebase_token, $notif[0]->title, $notif[0]->description);
										}
										$this->session->set_flashdata('mesg', base_url().'frontend/Births/add/'.$stud);
										$this->session->set_flashdata('telp', $partner->mem_hp);
										$this->session->set_flashdata('edit_success', TRUE);
										redirect('backend/Studs');
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
						if ($err){
							$this->db->trans_rollback();
							$this->session->set_flashdata('error_message', 'Failed to edit stud. Err code: '+$err);
							$this->load->view('backend/edit_stud', $data);
						}
					}
					else{
						$this->session->set_flashdata('error_message', 'Failed to edit stud. Err code: 4');
						$this->load->view('backend/edit_stud', $data);
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
					$where['stu_id'] = $this->uri->segment(4);
					$stud = $this->studModel->get_studs($where)->row();
					$this->db->trans_strict(FALSE);
					$this->db->trans_start();
					$data['stu_app_user'] = $this->session->userdata('use_id');
					$data['stu_app_date'] = date('Y-m-d H:i:s');
					$data['stu_user'] = $this->session->userdata('use_id');
					$data['stu_date'] = date('Y-m-d H:i:s');
					$data['stu_stat'] = $this->config->item('accepted');
					$res = $this->studModel->update_studs($data, $where);
					if ($res){
						$err = 0;
						$piece = explode("-", $stud->stu_stud_date);
						$date = $piece[2]."-".$piece[1]."-".$piece[0];

						$dataLog = array(
							'log_stu_id' => $this->uri->segment(4),
							'log_photo' => $stud->stu_photo,
							'log_sire_id' => $stud->stu_sire_id,
							'log_dam_id' => $stud->stu_dam_id,
							'log_sire_photo' => $stud->stu_sire_photo,
							'log_dam_photo' => $stud->stu_dam_photo,
							'log_stud_date' => $date,
							'log_member_id' => $stud->stu_member_id,
							'log_app_user' => $this->session->userdata('use_id'),
							'log_app_date' => date('Y-m-d H:i:s'),
							'log_stat' => $this->config->item('accepted'),
							'log_partner_id' => $stud->stu_partner_id,
							'log_user' => $this->session->userdata('use_id'),
							'log_date' => date('Y-m-d H:i:s'),
						);
						$log = $this->logstudModel->add_log($dataLog);
						if ($log){
							$result = $this->notification_model->add(14, $this->uri->segment(4), $stud->stu_member_id);
							if ($result){
								$res = $this->notification_model->add(14, $this->uri->segment(4), $stud->stu_partner_id);
								if ($res){
									$whe['mem_id'] = $stud->stu_member_id;
									$member = $this->memberModel->get_members($whe)->row();

									$whePartner['mem_id'] = $stud->stu_partner_id;
									$partner = $this->memberModel->get_members($whePartner)->row();

									$wheDam['can_id'] = $stud->stu_dam_id;
									$can = $this->caninesModel->get_canines($wheDam)->row();

									$wheSire['can_id'] = $stud->stu_sire_id;
									$c = $this->caninesModel->get_canines($wheSire)->row();

									$desc = 'Telah dilakukan pacak oleh '.$member->mem_name.' ('.$member->ken_name.')';
									$desc .= ' pada tanggal '.$stud->stu_stud_date;
									$desc .= ' antara '.$c->can_a_s;
									$desc .= ' dan '.$can->can_a_s;

									$dataNews = array(
										'title' => 'Pacak '.$can->can_breed,
										'description' => $desc
									); 
									$news = $this->news_model->add($dataNews);
									if ($news){
										$this->db->trans_complete();
										if ($member->mem_firebase_token){
											$notif = $this->notificationtype_model->get_by_id(14);
											firebase_notif($member->mem_firebase_token, $notif[0]->title, $notif[0]->description);
										}
										if ($partner->mem_firebase_token){
											$notif = $this->notificationtype_model->get_by_id(14);
											firebase_notif($partner->mem_firebase_token, $notif[0]->title, $notif[0]->description);
										}
										$this->session->set_flashdata('mesg', base_url().'frontend/Births/add/'.$this->uri->segment(4));
										$this->session->set_flashdata('telp', $partner->mem_hp);
										$this->session->set_flashdata('approve', TRUE);
										redirect('backend/Studs/view_approve');
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
						$this->session->set_flashdata('error_message', 'Failed to approve stud id = '.$this->uri->segment(4)).'. Err code: '.$err;
						redirect('backend/Studs/view_approve');
					}
				}
				else {
					redirect("backend/Users/login");
				}
			}
			else{
				redirect('backend/Studs/view_approve');
			}
		}

		public function reject(){
			if ($this->uri->segment(4)){
				if ($this->session->userdata('use_username')){
					$where['stu_id'] = $this->uri->segment(4);
					$stud = $this->studModel->get_studs($where)->row();
					$this->db->trans_strict(FALSE);
					$this->db->trans_start();
					$data['stu_user'] = $this->session->userdata('use_id');
					$data['stu_date'] = date('Y-m-d H:i:s');
					$data['stu_stat'] = $this->config->item('rejected');
					$res = $this->studModel->update_studs($data, $where);
					if ($res){
						$err = 0;
						$dataLog = array(
							'log_stu_id' => $this->uri->segment(4),
							'log_photo' => $stud->stu_photo,
							'log_sire_id' => $stud->stu_sire_id,
							'log_dam_id' => $stud->stu_dam_id,
							'log_sire_photo' => $stud->stu_sire_photo,
							'log_dam_photo' => $stud->stu_dam_photo,
							'log_stud_date' => $stud->stu_date,
							'log_member_id' => $stud->stu_member_id,
							'log_user' => $this->session->userdata('use_id'),
							'log_date' => date('Y-m-d H:i:s'),
							'log_stat' => $this->config->item('rejected'),
							'log_partner_id' => $stud->stu_partner_id,
						);
						$log = $this->logstudModel->add_log($dataLog);
						if ($log){
							$result = $this->notification_model->add(6, $this->uri->segment(4), $stud->stu_member_id);
							if ($result){
								$this->db->trans_complete();
								$whe['mem_id'] = $stud->stu_member;
								$member = $this->memberModel->get_members($whe)->row();
								if ($member->mem_firebase_token){
									$notif = $this->notificationtype_model->get_by_id(6);
									firebase_notif($member->mem_firebase_token, $notif[0]->title, $notif[0]->description);
								}
								$this->session->set_flashdata('reject', TRUE);
								redirect('backend/Studs/view_approve');
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
						$this->session->set_flashdata('error_message', 'Failed to reject stud id = '.$this->uri->segment(4).'. Err code: '.$err);
						redirect('backend/Studs/view_approve');
					}
				}
				else {
					redirect("backend/Users/login");
				}
			}
			else{
				redirect('backend/Studs/view_approve');
			}
		}

		public function delete(){
			if ($this->uri->segment(4)){
				if ($this->session->userdata('use_username')) {
					$where['stu_id'] = $this->uri->segment(4);
					$data['stu_user'] = $this->session->userdata('use_id');
					$data['stu_date'] = date('Y-m-d H:i:s');
					$data['stu_stat'] = $this->config->item('rejected');
					$this->db->trans_strict(FALSE);
					$this->db->trans_start();
					$res = $this->studModel->update_studs($data, $where);
					if ($res){
						$err = 0;
						$dataLog = array(
							'log_stu_id' => $this->uri->segment(4),
							'log_user' => $this->session->userdata('use_id'),
							'log_date' => date('Y-m-d H:i:s'),
							'log_stat' => $this->config->item('rejected'),
						);
						$log = $this->logstudModel->add_log($dataLog);
						if ($log){
							$this->db->trans_complete();
							$this->session->set_flashdata('delete', TRUE);
							redirect('backend/Studs');
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
						$this->session->set_flashdata('error_message', 'Failed to delete stud id = '.$this->uri->segment(4)).'. Err code: '.$err;
						redirect('backend/Studs/view_approve');
					}
				}
				else {
					redirect("backend/Users/login");
				}
			}
			else{
				redirect('backend/Studs/view_approve');
			}
		}
}
