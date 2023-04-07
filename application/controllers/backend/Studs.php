<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

#[\AllowDynamicProperties]

class Studs extends CI_Controller {
		public function __construct(){
			// Call the CI_Controller constructor
			parent::__construct();
			$this->load->model(array('studModel', 'caninesModel', 'notification_model', 'notificationtype_model', 'memberModel', 'birthModel', 'logstudModel', 'news_model', 'pedigreesModel'));
			$this->load->library('upload', $this->config->item('upload_stud'));
			$this->load->library(array('session', 'form_validation'));
			$this->load->helper(array('url', 'notif', 'mail'));
			$this->load->database();
			date_default_timezone_set("Asia/Bangkok");
		}

		public function index(){
			$where['stu_stat IN ('.$this->config->item('accepted').', '.$this->config->item('completed').')'] = null;
			$data['stud'] = $this->studModel->get_studs($where)->result();

			$data['birth'] = array();
			foreach ($data['stud'] as $s){
				$whereBirth = [];
				$whereBirth['bir_stu_id'] = $s->stu_id;
				$whereBirth['bir_stat IN ('.$this->config->item('accepted').', '.$this->config->item('completed').')'] = null;
				$data['birth'][] = $this->birthModel->get_births($whereBirth)->num_rows();
			}
			$this->load->view('backend/view_studs', $data);
		}

		public function search(){
			$date = '';
			$piece = explode("-", $this->input->post('date'));
            if (count($piece) == 3){
                $date = $piece[2]."-".$piece[1]."-".$piece[0];
            }
			if ($date){
				$where['stu_stud_date'] = $date;
			}
			$where['stu_stat IN ('.$this->config->item('accepted').', '.$this->config->item('completed').')'] = null;
			$like['can_sire.can_a_s'] = $this->input->post('keywords');
			$like['can_dam.can_a_s'] = $this->input->post('keywords');
			$data['stud'] = $this->studModel->search_studs($like, $where)->result();

			$data['birth'] = array();
			foreach ($data['stud'] as $s){
				$whereBirth = [];
				$whereBirth['bir_stu_id'] = $s->stu_id;
				$whereBirth['bir_stat IN ('.$this->config->item('accepted').', '.$this->config->item('completed').')'] = null;
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
			$piece = explode("-", $this->input->post('date'));
            if (count($piece) == 3){
                $date = $piece[2]."-".$piece[1]."-".$piece[0];
            }
			if ($date){
				$where['stu_stud_date'] = $date;
			}
			$where['stu_stat'] = $this->config->item('saved');
			$like['can_sire.can_a_s'] = $this->input->post('keywords');
			$like['can_dam.can_a_s'] = $this->input->post('keywords');
			$data['stud'] = $this->studModel->search_studs($like, $where)->result();
			$this->load->view('backend/approve_studs', $data);
		}

		public function add(){
			$data['member'] = [];
			$data['sire'] = [];
			$data['sireStat'] = [];
			$data['dam'] = [];
			$data['damStat'] = [];
			$data['mode'] = 0;
			$this->load->view('backend/add_stud', $data);
		}

		public function search_member(){
			if ($this->session->userdata('use_username')){
				$likeMember['mem_name'] = $this->input->post('mem_name');
				$likeMember['ken_name'] = $this->input->post('mem_name');
				$whereMember['mem_stat'] = $this->config->item('accepted');
				$whereMember['ken_stat'] = $this->config->item('accepted');
				$data['member'] = $this->memberModel->search_members($likeMember, $whereMember)->result();

				if ($data['member']){
					$whereSire['can_member_id'] = $data['member'][0]->mem_id;
					$whereSire['can_gender'] = 'MALE';
					$whereSire['can_stat'] = $this->config->item('accepted');
					$whereSire['can_rip '] = $this->config->item('canine_alive');
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
				$data['mode'] = 0;
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
				$whereMember['ken_stat'] = $this->config->item('accepted');
				$data['member'] = $this->memberModel->search_members($likeMember, $whereMember)->result();
				
				$whereSire['can_member_id'] = $this->input->post('can_member_id');
				$whereSire['can_gender'] = 'MALE';
				$whereSire['can_stat'] = $this->config->item('accepted');
				$whereSire['can_rip '] = $this->config->item('canine_alive');
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
				$data['mode'] = 0;
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
				$whereMember['ken_stat'] = $this->config->item('accepted');
				$data['member'] = $this->memberModel->search_members($likeMember, $whereMember)->result();
				
				$whereSire['can_member_id'] = $this->input->post('can_member_id');
				$whereSire['can_gender'] = 'MALE';
				$whereSire['can_stat'] = $this->config->item('accepted');
				$whereSire['can_rip '] = $this->config->item('canine_alive');
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
	
				$whereCan['can_id'] = $this->input->post('stu_sire_id');
				$can = $this->caninesModel->get_canines($whereCan)->row();
				$like['can_a_s'] = $this->input->post('can_a_s');
				$whereDam['can_gender'] = 'FEMALE';
				$whereDam['can_stat'] = $this->config->item('accepted');
				$whereDam['can_id !='] = $this->config->item('dam_id');
				$whereDam['can_member_id !='] = $this->config->item('no_member');
				$whereDam['can_breed'] = $can->can_breed;
				$whereDam['can_rip '] = $this->config->item('canine_alive');
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
				$data['mode'] = 0;
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
				$whereMember['ken_stat'] = $this->config->item('accepted');
				$data['member'] = $this->memberModel->search_members($likeMember, $whereMember)->result();

				$whereSire['can_member_id'] = $this->input->post('can_member_id');
				$whereSire['can_gender'] = 'MALE';
				$whereSire['can_stat'] = $this->config->item('accepted');
				$whereSire['can_rip '] = $this->config->item('canine_alive');
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
	
				$whereCan['can_id'] = $this->input->post('stu_sire_id');
				$can = $this->caninesModel->get_canines($whereCan)->row();
				$like['can_a_s'] = $this->input->post('can_a_s');
				$whereDam['can_gender'] = 'FEMALE';
				$whereDam['can_stat'] = $this->config->item('accepted');
				$whereDam['can_id !='] = $this->config->item('dam_id');
				$whereDam['can_member_id !='] = $this->config->item('no_member');
				$whereDam['can_breed'] = $can->can_breed;
				$whereDam['can_rip '] = $this->config->item('canine_alive');
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
				$data['mode'] = $this->input->post('mode');
	
				if ($this->form_validation->run() == FALSE){
					$this->load->view('backend/add_stud', $data);
				}
				else{
					$wheDam['can_id'] = $this->input->post('stu_dam_id');
					$can = $this->caninesModel->get_canines($wheDam)->row();
					if ($can){
						$err = 0;
						if (!isset($_POST['attachment_dam']) || empty($_POST['attachment_dam'])) {
							$err++;
							$this->session->set_flashdata('error_message', 'Dam photo is required');
						}
						if (!isset($_POST['attachment_sire']) || empty($_POST['attachment_sire'])) {
							$err++;
							$this->session->set_flashdata('error_message', 'Sire photo is required');
						}
						if (!isset($_POST['attachment_stud']) || empty($_POST['attachment_stud'])){
							$err++;
							$this->session->set_flashdata('error_message', 'Stud photo is required');
						}
	
						$photo = '-';
						$sire = '-';
						$dam = '-';
						if (!$err){
							$uploadedStud = $_POST['attachment_stud'];
							$image_array_1 = explode(";", $uploadedStud);
							$image_array_2 = explode(",", $image_array_1[1]);
							$uploadedStud = base64_decode($image_array_2[1]);
		
							if ((strlen($uploadedStud) > $this->config->item('file_size'))) {
								$err++;
								$this->session->set_flashdata('error_message', 'Stud file size is too big (> 1 MB).');
							}
	
							$uploadedSire = $_POST['attachment_sire'];
							$image_array_1 = explode(";", $uploadedSire);
							$image_array_2 = explode(",", $image_array_1[1]);
							$uploadedSire = base64_decode($image_array_2[1]);
		
							if ((strlen($uploadedSire) > $this->config->item('file_size'))) {
								$err++;
								$this->session->set_flashdata('error_message', 'Sire file size is too big (> 1 MB).');
							}
	
							$uploadedDam = $_POST['attachment_dam'];
							$image_array_1 = explode(";", $uploadedDam);
							$image_array_2 = explode(",", $image_array_1[1]);
							$uploadedDam = base64_decode($image_array_2[1]);
		
							if ((strlen($uploadedDam) > $this->config->item('file_size'))) {
								$err++;
								$this->session->set_flashdata('error_message', 'Dam file size is too big (> 1 MB).');
							}
	
							$stud_name = $this->config->item('path_stud').$this->config->item('file_name_stud');
							$sire_name = $this->config->item('path_stud').$this->config->item('file_name_sire');
							$dam_name = $this->config->item('path_stud').$this->config->item('file_name_dam');
	
							if (!is_dir($this->config->item('path_stud')) or !is_writable($this->config->item('path_stud'))) {
								$err++;
								$this->session->set_flashdata('error_message', 'stud folder not found or not writeable.');
							} else{
								if (is_file($stud_name) and !is_writable($stud_name)) {
									$err++;
									$this->session->set_flashdata('error_message', 'Stud file already exists and not writeable.');
								}
								if (is_file($sire_name) and !is_writable($sire_name)) {
									$err++;
									$this->session->set_flashdata('error_message', 'Sire file already exists and not writeable.');
								}
								if (is_file($dam_name) and !is_writable($dam_name)) {
									$err++;
									$this->session->set_flashdata('error_message', 'Dam file already exists and not writeable.');
								}
							}
	
							if (!$err){
								file_put_contents($stud_name, $uploadedStud);
								$photo = str_replace($this->config->item('path_stud'), '', $stud_name);
	
								file_put_contents($sire_name, $uploadedSire);
								$sire = str_replace($this->config->item('path_stud'), '', $sire_name);
	
								file_put_contents($dam_name, $uploadedDam);
								$dam = str_replace($this->config->item('path_stud'), '', $dam_name);
							}
						}
		
						$piece = explode("-", $this->input->post('stu_stud_date'));
						$date = $piece[2]."-".$piece[1]."-".$piece[0];
						if (!$err && !$this->input->post('mode')){
							// Lapor pacak harus kurang dari 7 hari
							$data['warning'] = Array();
							// $ts = new DateTime($date);
							// $ts_now = new DateTime();
							
							// if ($ts > $ts_now)
							// 	$cek = false;
							// else{
							// 	$diff = floor($ts->diff($ts_now)->days/$this->config->item('jarak_lapor_pacak'));
							// 	if ($diff > 2)
							// 		$cek = false;
							// }
							
							$year = $piece[2];
							$month = $piece[1];
							$day = $piece[0];
							if ($year != $this->config->item('tahun_lapor_pacak')){
								$err++;
								$data['warning'][] = 'Stud must be reported before '.$this->config->item('hari_lapor_pacak').' days';
							}
							else{
								if ($month == $this->config->item('bulan_lapor_pacak') && (int)$day < $this->config->item('tanggal_lapor_pacak')){
									$err++;
									$data['warning'][] = 'Stud must be reported before '.$this->config->item('hari_lapor_pacak').' days';
								}
							}

							// Jarak pacak utk dam yg sama adalah sbb:
							// Kurang dari 4 bulan dari pacak(tidak ada lahir) 
							// Kurang dari 3 bulan dari lahir(ada lahir)
							$wheBirth['studs.stu_dam_id'] = $this->input->post('stu_dam_id');
							$wheBirth['studs.stu_stat IN ('.$this->config->item('accepted').', '.$this->config->item('completed').')'] = null;
							$wheBirth['births.bir_stat IN ('.$this->config->item('accepted').', '.$this->config->item('completed').')'] = null;
							$birth = $this->birthModel->get_births($wheBirth)->row();
							if (!$birth){
								$res = $this->studModel->check_date($this->input->post('stu_dam_id'), $date);
								if ($res){
									$err++;
									$data['warning'][] = 'Stud interval must greater than '.$this->config->item('jarak_pacak').' days from stud date';
								}
							}
							else{
								$res = $this->birthModel->check_date($this->input->post('stu_dam_id'), $date);
								if ($res){
									$err++;
									$data['warning'][] = 'Stud interval must greater than '.$this->config->item('jarak_pacak_lahir').' days from birth date';
								}
							}
								
							// dam anak dari sire
							$wherePedSire['ped_sire_id'] = $this->input->post('stu_sire_id');
							$wherePedSire['ped_canine_id'] = $this->input->post('stu_dam_id');
							$pedSire = $this->pedigreesModel->get_pedigrees($wherePedSire)->row();
							if ($pedSire){
								$err++;
								$data['warning'][] = 'Dam is sire\'s child';
							}

							// sire anak dari dam
							$wherePedDam['ped_dam_id'] = $this->input->post('stu_dam_id');
							$wherePedDam['ped_canine_id'] = $this->input->post('stu_sire_id');
							$pedDam = $this->pedigreesModel->get_pedigrees($wherePedDam)->row();
							if ($pedDam){
								$err++;
								$data['warning'][] = 'Sire is dam\' child';
							}
									
							// sibling
							$wherePed['ped_canine_id'] = $this->input->post('stu_sire_id');
							$ped = $this->pedigreesModel->get_pedigrees($wherePed)->row();
							if ($ped->ped_sire_id != $this->config->item('sire_id') && $ped->ped_dam_id != $this->config->item('dam_id')){
								$sibling = $this->studModel->check_siblings($this->input->post('stu_sire_id'), $ped->ped_sire_id, $ped->ped_dam_id)->result();
								$cek = false;
								foreach ($sibling AS $r){
									if ($r->can_id == $this->input->post('stu_dam_id'))
										$cek = true;
								}
								if ($cek){
									$err++;
									$data['warning'][] = 'Sire and dam are sibling';
								}
							}
						}

						if (!$err){
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
									$wheSire['can_id'] = $this->input->post('stu_sire_id');
									$canSire = $this->caninesModel->get_canines($wheSire)->row();
									$result = $this->notification_model->add(14, $stud, $this->input->post('can_member_id'), 'Nama Sire: '.$canSire->can_a_s.'<br>Nama Dam: '.$can->can_a_s);
									if ($result){
										$res = $this->notification_model->add(14, $stud, $can->can_member_id, 'Nama Sire: '.$canSire->can_a_s.'<br>Nama Dam: '.$can->can_a_s.'<br><a class="text-reset link-warning" href="'.base_url().'frontend/Births/add/'.$stud.'">Lapor Lahir</a>');
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
												'description' => $desc,
												'date' => $date,
												'type' => $this->config->item('stud'),
												'photo' => $photo,
												'trans_id' => $stud,
											); 
											$news = $this->news_model->add($dataNews);
											if ($news){
												$this->db->trans_complete();
												$notif = $this->notificationtype_model->get_by_id(14);
												if ($member->mem_firebase_token){
													firebase_notif($member->mem_firebase_token, $notif[0]->title, $notif[0]->description);
												}
												if ($partner->mem_firebase_token){
													firebase_notif($partner->mem_firebase_token, $notif[0]->title, $notif[0]->description);
												}
												$mail = send_birth_link($partner->mem_email, $partner->mem_username, $c->can_a_s, $can->can_a_s, $stud);
												if (!$mail){
													$this->session->set_flashdata('error_message', show_error($this->email->print_debugger()));
												}
												else{
													$this->session->set_flashdata('mesg', 'Lapor Lahir:\n'.base_url().'frontend/Births/add/'.$stud);
													$this->session->set_flashdata('telp', $partner->mem_hp);
													$this->session->set_flashdata('add_success', TRUE);
												}
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
							if ($err){
								$this->db->trans_rollback();
								$this->session->set_flashdata('error_message', 'Failed to save stud. Err code: '.$err);
								$this->load->view('backend/edit_stud', $data);
							}
						}
						if ($err){
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
				$whereSire['can_rip '] = $this->config->item('canine_alive');
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
				$whereSire['can_rip '] = $this->config->item('canine_alive');
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
	
				$whereCan['can_id'] = $this->input->post('stu_sire_id');
				$can = $this->caninesModel->get_canines($whereCan)->row();
				$like['can_a_s'] = $this->input->post('can_a_s');
				$whereDam['can_gender'] = 'FEMALE';
				$whereDam['can_stat'] = $this->config->item('accepted');
				$whereDam['can_id !='] = $this->config->item('dam_id');
				$whereDam['can_member_id !='] = $this->config->item('no_member');
				$whereDam['can_breed'] = $can->can_breed;
				$whereDam['can_rip '] = $this->config->item('canine_alive');
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
				$whereSire['can_rip '] = $this->config->item('canine_alive');
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
	
				$whereCan['can_id'] = $this->input->post('stu_sire_id');
				$can = $this->caninesModel->get_canines($whereCan)->row();
				
				$like['can_a_s'] = $this->input->post('can_a_s');
				$whereDam['can_gender'] = 'FEMALE';
				$whereDam['can_stat'] = $this->config->item('accepted');
				$whereDam['can_id !='] = $this->config->item('dam_id');
				$whereDam['can_member_id !='] = $this->config->item('no_member');
				$whereDam['can_breed'] = $can->can_breed;
				$whereDam['can_rip '] = $this->config->item('canine_alive');
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
						$sire = '-';
						$dam = '-';
						if (isset($_POST['attachment_stud']) && !empty($_POST['attachment_stud'])){
							$uploadedStud = $_POST['attachment_stud'];
							$image_array_1 = explode(";", $uploadedStud);
							$image_array_2 = explode(",", $image_array_1[1]);
							$uploadedStud = base64_decode($image_array_2[1]);
		
							if ((strlen($uploadedStud) > $this->config->item('file_size'))) {
								$err++;
								$this->session->set_flashdata('error_message', 'Stud file size is too big (> 1 MB).');
							}

							$stud_name = $this->config->item('path_stud').$this->config->item('file_name_stud');
						}
						if (isset($_POST['attachment_sire']) && !empty($_POST['attachment_sire'])) {
							$uploadedSire = $_POST['attachment_sire'];
							$image_array_1 = explode(";", $uploadedSire);
							$image_array_2 = explode(",", $image_array_1[1]);
							$uploadedSire = base64_decode($image_array_2[1]);
		
							if ((strlen($uploadedSire) > $this->config->item('file_size'))) {
								$err++;
								$this->session->set_flashdata('error_message', 'Sire file size is too big (> 1 MB).');
							}

							$sire_name = $this->config->item('path_stud').$this->config->item('file_name_sire');
						}
						if (isset($_POST['attachment_dam']) && !empty($_POST['attachment_dam'])) {
							$uploadedDam = $_POST['attachment_dam'];
							$image_array_1 = explode(";", $uploadedDam);
							$image_array_2 = explode(",", $image_array_1[1]);
							$uploadedDam = base64_decode($image_array_2[1]);
		
							if ((strlen($uploadedDam) > $this->config->item('file_size'))) {
								$err++;
								$this->session->set_flashdata('error_message', 'Dam file size is too big (> 1 MB).');
							}

							$dam_name = $this->config->item('path_stud').$this->config->item('file_name_dam');
						}

						if (isset($uploadedStud) || isset($uploadedSire) || isset($uploadedDam)){
							if (!is_dir($this->config->item('path_stud')) or !is_writable($this->config->item('path_stud'))) {
								$err++;
								$this->session->set_flashdata('error_message', 'stud folder not found or not writeable.');
							} else{
								if (is_file($stud_name) and !is_writable($stud_name)) {
									$err++;
									$this->session->set_flashdata('error_message', 'Stud file already exists and not writeable.');
								}
								if (is_file($sire_name) and !is_writable($sire_name)) {
									$err++;
									$this->session->set_flashdata('error_message', 'Sire file already exists and not writeable.');
								}
								if (is_file($dam_name) and !is_writable($dam_name)) {
									$err++;
									$this->session->set_flashdata('error_message', 'Dam file already exists and not writeable.');
								}
							}
						}
		
						if (!$err){
							if (isset($uploadedStud)){
								file_put_contents($stud_name, $uploadedStud);
								$photo = str_replace($this->config->item('path_stud'), '', $stud_name);
							}
							if (isset($uploadedSire)){
								file_put_contents($sire_name, $uploadedSire);
								$sire = str_replace($this->config->item('path_stud'), '', $sire_name);
							}
							if (isset($uploadedDam)){
								file_put_contents($dam_name, $uploadedDam);
								$dam = str_replace($this->config->item('path_stud'), '', $dam_name);
							}

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
									'log_stu_id' => $this->input->post('stu_id'),
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
									$wheSire['can_id'] = $this->input->post('stu_sire_id');
									$canSire = $this->caninesModel->get_canines($wheSire)->row();
									$result = $this->notification_model->add(1, $this->input->post('stu_id'), $can->can_member_id, 'Nama Sire: '.$canSire->can_a_s.'<br>Nama Dam: '.$can->can_a_s.'<br><a class="text-reset link-warning" href="'.base_url().'frontend/Births/add/'.$this->input->post('stu_id').'">Lapor Lahir</a>');
									if ($result){
										$this->db->trans_complete();
										$whePartner['mem_id'] = $can->can_member_id;
										$partner = $this->memberModel->get_members($whePartner)->row();
										if ($partner->mem_firebase_token){
											$notif = $this->notificationtype_model->get_by_id(1);
											firebase_notif($partner->mem_firebase_token, $notif[0]->title, $notif[0]->description);
										}
										$mail = send_birth_link($partner->mem_email, $partner->mem_username, $canSire->can_a_s, $can->can_a_s, $this->input->post('stu_id'));
										if (!$mail){
											$this->session->set_flashdata('error_message', show_error($this->email->print_debugger()));
										}
										else{
											$this->session->set_flashdata('mesg', 'Lapor Lahir:\n'.base_url().'frontend/Births/add/'.$this->input->post('stu_id'));
											$this->session->set_flashdata('telp', $partner->mem_hp);
											$this->session->set_flashdata('edit_success', TRUE);
										}
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
							if ($err){
								$this->db->trans_rollback();
								$this->session->set_flashdata('error_message', 'Failed to edit stud. Err code: '.$err);
								$this->load->view('backend/edit_stud', $data);
							}
						}
						else{
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
							$result = $this->notification_model->add(1, $this->uri->segment(4), $stud->stu_member_id, "Nama Sire: ".$stud->sire_a_s.'<br>Nama Dam: '.$stud->dam_a_s);
							if ($result){
								$res = $this->notification_model->add(1, $this->uri->segment(4), $stud->stu_partner_id, "Nama Sire: ".$stud->sire_a_s.'<br>Nama Dam: '.$stud->dam_a_s.'<br><a class="text-reset link-warning" href="'.base_url().'frontend/Births/add/'.$this->uri->segment(4).'">Lapor Lahir</a>');
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

									$piece = explode("-", $stud->stu_stud_date);
									$date = $piece[2]."-".$piece[1]."-".$piece[0];

									$dataNews = array(
										'title' => 'Pacak '.$can->can_breed,
										'description' => $desc,
										'date' => $date,
										'type' => $this->config->item('stud'),
										'photo' => $stud->stu_photo,
										'trans_id' => $this->uri->segment(4),
									); 
									$news = $this->news_model->add($dataNews);
									if ($news){
										$this->db->trans_complete();
										$notif = $this->notificationtype_model->get_by_id(1);
										if ($member->mem_firebase_token){
											firebase_notif($member->mem_firebase_token, $notif[0]->title, $notif[0]->description);
										}
										if ($partner->mem_firebase_token){
											firebase_notif($partner->mem_firebase_token, $notif[0]->title, $notif[0]->description);
										}
										$mail = send_birth_link($partner->mem_email, $partner->mem_username, $c->can_a_s, $can->can_a_s, $this->uri->segment(4));
										if (!$mail){
											$this->session->set_flashdata('error_message', show_error($this->email->print_debugger()));
										}
										else{
											$this->session->set_flashdata('mesg', 'Lapor Lahir:\n'.base_url().'frontend/Births/add/'.$this->uri->segment(4));
											$this->session->set_flashdata('telp', $partner->mem_hp);
											$this->session->set_flashdata('approve', TRUE);
										}
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
					if ($this->uri->segment(5)){
						$data['stu_app_note'] = urldecode($this->uri->segment(5));
					}
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
							$result = $this->notification_model->add(6, $this->uri->segment(4), $stud->stu_member_id, "Nama Sire: ".$stud->sire_a_s.'<br>Nama Dam: '.$stud->dam_a_s);
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
						redirect('backend/Studs');
					}
				}
				else {
					redirect("backend/Users/login");
				}
			}
			else{
				redirect('backend/Studs');
			}
		}

		public function log(){
			if ($this->uri->segment(4)){
				$where['log_stu_id'] = $this->uri->segment(4);
				$data['stud'] = $this->logstudModel->get_logs($where)->result();
				$data['sire'] = Array();
				$data['dam'] = Array();
				foreach($data['stud'] AS $r){
					$wheSire = [];
					$wheSire['can_id'] = $r->log_sire_id;
					$data['sire'][] = $this->caninesModel->get_canines($wheSire)->row();
			
					$wheDam = [];
					$wheDam['can_id'] = $r->log_dam_id;
					$data['dam'][] = $this->caninesModel->get_canines($wheDam)->row();
				}
				$this->load->view('backend/log_stud', $data);
			}
			else{
				redirect('backend/Studs');
			}
		}

		public function send_birth_link(){
			if ($this->uri->segment(4)){
				$where['stu_id'] = $this->uri->segment(4);
				$stud = $this->studModel->get_studs($where)->row();

				$whePartner['mem_id'] = $stud->stu_partner_id;
				$partner = $this->memberModel->get_members($whePartner)->row();

				$wheDam['can_id'] = $stud->stu_dam_id;
				$can = $this->caninesModel->get_canines($wheDam)->row();

				$wheSire['can_id'] = $stud->stu_sire_id;
				$c = $this->caninesModel->get_canines($wheSire)->row();

				$mail = send_birth_link($partner->mem_email, $partner->mem_username, $c->can_a_s, $can->can_a_s, $this->uri->segment(4));
				if ($mail){
					echo 'success';
				}
				else{
					echo show_error($this->email->print_debugger());
				}
			}
			else{
				redirect('backend/Studs');
			}
		}
}
