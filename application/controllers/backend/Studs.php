<?php // ARTechnology
defined('BASEPATH') OR exit('No direct script access allowed');

class Studs extends CI_Controller {
		public function __construct(){
			// Call the CI_Controller constructor
			parent::__construct();
			$this->load->model(array('studModel', 'caninesModel', 'trahModel', 'notification_model', 'notificationtype_model', 'memberModel', 'birthModel'));
			$this->load->library('upload', $this->config->item('upload_stud'));
			$this->load->library(array('session', 'form_validation'));
			$this->load->helper(array('url'));
			$this->load->database();
			date_default_timezone_set("Asia/Bangkok");
		}

		public function index(){
			$where['stu_stat'] = $this->config->item('accepted');
			$data['stud'] = $this->studModel->get_studs($where)->result();

			$birth = array();
			$sire = array();
			$dam = array();
			foreach ($data['stud'] as $s){
				$whereBirth = [];
				$whereBirth['bir_stu_id'] = $s->stu_id;
				$birth[] = $this->birthModel->get_births($whereBirth)->num_rows();
				$sire[] = $this->caninesModel->get_canines_gender($s->stu_sire_id)->row()->can_gender;
				$dam[] = $this->caninesModel->get_canines_gender($s->stu_dam_id)->row()->can_gender;
			}
			$data['birth'] = $birth;
			$data['sire'] = $sire;
			$data['dam'] = $dam;
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

			$birth = array();
			$sire = array();
			$dam = array();
			foreach ($data['stud'] as $s){
				$whereBirth = [];
				$whereBirth['bir_stu_id'] = $s->stu_id;
				$birth[] = $this->birthModel->get_births($whereBirth)->num_rows();
				$sire[] = $this->caninesModel->get_canines_gender($s->stu_sire_id)->row()->can_gender;
				$dam[] = $this->caninesModel->get_canines_gender($s->stu_dam_id)->row()->can_gender;
			}
			$data['birth'] = $birth;
			$data['sire'] = $sire;
			$data['dam'] = $dam;
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
				$whereMember['mem_stat'] = $this->config->item('accepted');
				$data['member'] = $this->memberModel->search_members($likeMember, $whereMember)->result();

				$whereSire['can_member_id'] = $data['member'][0]->mem_id;
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
			else {
				redirect("backend/Users/login");
			}
		}

		public function search_sire(){
			if ($this->session->userdata('use_username')){
				$likeMember['mem_name'] = $this->input->post('mem_name');
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
	
				if ($this->form_validation->run() == FALSE){
					$this->load->view('backend/add_stud', $data);
				}
				else{
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
							'stu_stat' => $this->config->item('saved'),
						);
						$stud = $this->studModel->add_studs($data);
						if ($stud){
							$this->session->set_flashdata('add_success', true);
							redirect("backend/Studs");
						}
						else{
							$this->session->set_flashdata('error_message', 'Failed to save stud');
							$this->load->view('backend/add_stud', $data);
						}
					}
					else{
						$this->load->view('backend/add_stud', $data);
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
					$data['stu_stat'] = $this->config->item('accepted');
					$res = $this->studModel->update_studs($data, $where);
					if ($res){
						$err = 0;
						$result = $this->notification_model->add(1, $this->uri->segment(4), $stud->stu_member_id);
						if ($result){
							$this->db->trans_complete();
							$whe['mem_id'] = $stud->stu_member;
							$member = $this->memberModel->get_members($whe)->row();
							if ($member->mem_firebase_token){
								$notif = $this->notificationtype_model->get_by_id(1);
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
							redirect('backend/Studs/view_approve');
						}
						else{
							$err = 1;
						}
					}
					else{
						$err = 1;
					}
					if ($err){
						$this->db->trans_rollback();
						$this->session->set_flashdata('error', 'Failed to approve stud id = '.$this->uri->segment(4));
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
					$data['stu_app_user'] = $this->session->userdata('use_id');
					$data['stu_app_date'] = date('Y-m-d H:i:s');
					$data['stu_stat'] = $this->config->item('rejected');
					$res = $this->studModel->update_studs($data, $where);
					if ($res){
						$err = 0;
						$result = $this->notification_model->add(6, $this->uri->segment(4), $stud->stu_member_id);
						if ($result){
							$this->db->trans_complete();
							$whe['mem_id'] = $stud->stu_member;
							$member = $this->memberModel->get_members($whe)->row();
							if ($member->mem_firebase_token){
								$notif = $this->notificationtype_model->get_by_id(6);
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
							$this->session->set_flashdata('reject', TRUE);
							redirect('backend/Studs/view_approve');
						}
						else{
							$err = 1;
						}
					}
					else{
						$err = 1;
					}
					if ($err){
						$this->db->trans_rollback();
						$this->session->set_flashdata('error', 'Failed to reject stud id = '.$this->uri->segment(4));
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

		public function view(){
			$user = $this->session->userdata('user_data');
			$data['users'] = $user;
			$data['navigations'] = $this->navigations;
			$data['trahs'] = $this->trahModel->get_trah()->result();
			$this->twig->display('backend/logsStud', $data);
		}

		public function logs($id = null){
			if ($id != null) {
				$where['stu_id'] = $id;
				$stud = $this->studModel->get_studs($where)->row();
				echo json_encode($stud);
			}else{
				$aColumns = array('stu_id', 'stu_photo', 'stu_sire_photo', 'stu_mom_photo', 'stu_stud_date', 'use_username', 'stu_app_date', 'stu_sire_id', 'stu_mom_id', 'mem_name', 'stu_note', 'stat_name', 'stu_stat');
				$sTable = 'studs';

				$iDisplayStart = $this->input->get_post('start', true);
				$iDisplayLength = $this->input->get_post('length', true);
				$sSearch = $this->input->post('search', true);
				$sEcho = $this->input->get_post('sEcho', true);
				$columns = $this->input->get_post('columns', true);
				$orders = $this->input->get_post('order', true);

				// Paging
				if(isset($iDisplayStart) && $iDisplayLength != '-1'){
						$this->db->limit($this->db->escape_str($iDisplayLength), $this->db->escape_str($iDisplayStart));
				}

				// Ordering
				if(isset($orders[0]['column'])){
						// for($i=0; $i<intval($columns); $i++){
								// $iSortCol = $this->input->get_post('iSortCol_'.$i, true);
								// $bSortable = $this->input->get_post('bSortable_'.intval($iSortCol), true);
								$bSortable = $columns[$orders[0]['column']]['orderable'];
								// $sSortDir = $this->input->get_post('sSortDir_'.$i, true);

								if($bSortable == 'true')
								{
										$this->db->order_by($columns[$orders[0]['column']]['data'], $orders[0]['dir']);
										// $this->db->order_by($aColumns[intval($this->db->escape_str($iSortCol))], $this->db->escape_str($sSortDir));
								}
						// }
				}

				/*
					* Filtering
					* NOTE this does not match the built-in DataTables filtering which does it
					* word by word on any field. It's possible to do here, but concerned about efficiency
					* on very large tables, and MySQL's regex functionality is very limited
					*/
				if(isset($sSearch['value']) && !empty($sSearch['value'])){
						for($i=0; $i<count($columns); $i++){
								// $bSearchable = $this->input->get_post('bSearchable_'.$i, true);
								$bSearchable = $columns[$i]['searchable'];

								// Individual column filtering
								if(isset($bSearchable) && $bSearchable == 'true')
								{
										for($j=0; $j<count($aColumns); $j++){
											$this->db->or_like($aColumns[$j], $this->db->escape_like_str($sSearch['value']));
										}
								}
						}
				}


				// Select Data
				$this->db->select('SQL_CALC_FOUND_ROWS '.str_replace(' , ', ' ', implode(', ', $aColumns)), false);
				$this->db->join('members','members.mem_id = studs.stu_member');
				$this->db->join('users','users.use_id = studs.stu_app_user');
				$this->db->join('approval_status','approval_status.stat_id = studs.stu_stat');
				$this->db->order_by('stu_date', 'DESC');
				$rResult = $this->db->get($sTable);

				// Data set length after filtering
				$this->db->select('FOUND_ROWS() AS found_rows');
				$iFilteredTotal = $this->db->get()->row()->found_rows;

				// Total data set length
				$iTotal = $this->db->count_all($sTable);

				// Output
				$output = array(
						'sEcho' => intval($sEcho),
						'iTotalRecords' => $iTotal,
						'iTotalDisplayRecords' => $iFilteredTotal,
						'aaData' => array()
				);

				foreach($rResult->result_array() as $i => $aRow){
						$row = array();

						// foreach($aColumns as $col){
						// 		if($col == 'stock')
						//     $row[$col] = $aRow[$col];
						// }
						$output['aaData'][] = $aRow;
				}

				echo json_encode($output);
			}
	}

	// public function update($id = null){
	// 	$img = $this->input->post('srcDataCrop');
	// 	if($img){
	// 		$title = self::_clean_text('stud');
	// 		$_POST['stu_photo'] = self::_upload_base64($img, $title, true, $id);
	// 	}
		
	// 	$img = $this->input->post('srcDataCropSire');
	// 	if($img){
	// 		$title = self::_clean_text('sire');
	// 		$_POST['stu_sire_photo'] = self::_upload_base64($img, $title, true, $id);
	// 	}

	// 	$img = $this->input->post('srcDataCropDam');
	// 	if($img){
	// 		$title = self::_clean_text('dam');
	// 		$_POST['stu_mom_photo'] = self::_upload_base64($img, $title, true, $id);
	// 	}

	// 	unset($_POST['srcDataCrop']);
	// 	unset($_POST['srcDataCropSire']);
	// 	unset($_POST['srcDataCropDam']);

	// 	$cek = true;
	// 	$piece = explode("-", $this->input->post('stu_stud_date'));
	// 	$date = $piece[2]."-".$piece[1]."-".$piece[0];

	// 	$ts = new DateTime($date);
	// 	$ts_now = new DateTime();
		
	// 	if ($ts > $ts_now)
	// 		$cek = false;
	// 	else{
	// 		$diff = floor($ts->diff($ts_now)->days/7);
	// 		if ($diff > 2)
	// 			$cek = false;
	// 	}

	// 	if ($cek){
	// 		$data = $this->input->post(null,false);
	// 		$data['stu_stud_date'] = $date;
			
	// 		$where['stu_id'] = $id;

	// 		$this->studModel->update_studs($data, $where);

	// 		echo json_encode(array('data' => '1'));
	// 	}
	// 	else{
	// 		echo json_encode(array('data' => 'Pelaporan pacak harus kurang dari 2 minggu'));
	// 	}
	// }
}
