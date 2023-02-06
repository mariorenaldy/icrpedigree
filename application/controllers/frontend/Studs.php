<?php

class Studs extends CI_Controller {
    public function __construct(){
		parent::__construct();
		$this->load->model(array('studModel', 'caninesModel', 'memberModel', 'birthModel'));
		$this->load->library('upload', $this->config->item('upload_stud'));
		$this->load->library(array('session', 'form_validation'));
		$this->load->helper(array('url'));
		$this->load->database();
		date_default_timezone_set("Asia/Bangkok");
	}

	public function index(){
		if ($this->session->userdata('mem_id')){
			$where['stu_member_id'] = $this->session->userdata('mem_id');
			$data['stud'] = $this->studModel->get_studs($where)->result();

			$data['birth'] = array();
			foreach ($data['stud'] as $s){
				$whereBirth = [];
				$whereBirth['bir_stu_id'] = $s->stu_id;
				$data['birth'][] = $this->birthModel->get_births($whereBirth)->num_rows();
			}
			$this->load->view('frontend/view_studs', $data);
		}
		else{
			redirect('frontend/Members');
		}
	}

	public function search(){
		if ($this->session->userdata('mem_id')){
			$date = '';
			$piece = explode("-", $this->input->post('keywords'));
			if (count($piece) == 3){
				$date = $piece[2]."-".$piece[1]."-".$piece[0];
			}
			if ($date){
				$where['stu_stud_date'] = $date;
			}
			$where['stu_member_id'] = $this->session->userdata('mem_id');
			$data['stud'] = $this->studModel->get_studs($where)->result();

			$data['birth'] = array();
			foreach ($data['stud'] as $s){
				$whereBirth = [];
				$whereBirth['bir_stu_id'] = $s->stu_id;
				$data['birth'][] = $this->birthModel->get_births($whereBirth)->num_rows();
			}
			$this->load->view('frontend/view_studs', $data);
		}
		else{
			redirect('frontend/Members');
		}
	}

	public function view(){
		if ($this->session->userdata('mem_id')){
			$where['stu_partner_id'] = $this->session->userdata('mem_id');
			$where['stu_stat'] = $this->config->item('accepted');
			$data['stud'] = $this->studModel->get_studs($where)->result();

			$data['birth'] = array();
			foreach ($data['stud'] as $s){
				$whereBirth = [];
				$whereBirth['bir_stu_id'] = $s->stu_id;
				$data['birth'][] = $this->birthModel->get_births($whereBirth)->num_rows();
			}
			$this->load->view('frontend/view_approved_studs', $data);
		}
		else{
			redirect('frontend/Members');
		}
	}

	public function add(){
		if ($this->session->userdata('username')){
			$whereSire['can_member_id'] = $this->session->userdata('mem_id');
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
			$this->load->view('frontend/add_stud', $data);
		}
		else{
			redirect("frontend/Members");
		}
	}

	public function search_dam(){
		if ($this->session->userdata('username')){
			$whereSire['can_member_id'] = $this->session->userdata('mem_id');
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
			$this->load->view('frontend/add_stud', $data);
		}
		else{
			redirect("frontend/Members");
		}
	}

	public function validate_add(){
		if ($this->session->userdata('username')){
			$this->form_validation->set_error_delimiters('<div>','</div>');
			$this->form_validation->set_message('required', '%s wajib diisi');
			$this->form_validation->set_rules('stu_sire_id', 'Sire id ', 'trim|required');
			$this->form_validation->set_rules('stu_dam_id', 'Id dam ', 'trim|required');
			$this->form_validation->set_rules('stu_stud_date', 'Tanggal pacak ', 'trim|required');
			
			$whereSire['can_member_id'] = $this->session->userdata('mem_id');
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
				$this->load->view('frontend/add_stud', $data);
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
								$this->session->set_flashdata('error_message', 'Foto Pacak Error: '.$this->upload->display_errors());
							}
						}
					}

					if (!$err && $photo == "-"){
						$err++;
						$this->session->set_flashdata('error_message', 'Foto pacak wajib diisi');
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
								$this->session->set_flashdata('error_message', 'Foto Sire Error: '.$this->upload->display_errors());
							}
						}
					}

					if (!$err && $sire == "-"){
						$err++;
						$this->session->set_flashdata('error_message', 'Foto sire wajib diisi');
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
								$this->session->set_flashdata('error_message', 'Foto Dam Error: '.$this->upload->display_errors());
							}
						}
					}

					if (!$err && $dam == "-"){
						$err++;
						$this->session->set_flashdata('error_message', 'Foto dam wajib diisi');
					}

					// Lapor pacak harus kurang dari 7 hari
					if (!$err){
						$cek = true;
						$piece = explode("-", $this->input->post('stu_stud_date'));
						$date = $piece[2]."-".$piece[1]."-".$piece[0];
				
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
						if ($year != "2023")
							$cek = false;

						if ($cek){
							// jarak pacak utk dam yg sama adalah 120 hari
							$res = $this->studModel->check_date($this->input->post('stu_dam_id'), $date);
							if (!$res){
								$data = array(
									'stu_photo' => $photo,
									'stu_sire_id' => $this->input->post('stu_sire_id'),
									'stu_dam_id' => $this->input->post('stu_dam_id'),
									'stu_sire_photo' => $sire,
									'stu_dam_photo' => $dam,
									'stu_stud_date' => $date,
									'stu_member_id' => $this->session->userdata('mem_id'),
									'stu_partner_id' => $can->can_member_id,
								);
								$stud = $this->studModel->add_studs($data);
								if ($stud){
									// $this->session->set_flashdata('add_success', true);
									// redirect("frontend/Studs");
									$this->session->set_flashdata('add_stud_success', true);
									redirect("frontend/Beranda");
								}
								else{
									$this->session->set_flashdata('error_message', 'Gagal menyimpan data pacak. Err code: 1');
									$this->load->view('frontend/add_stud', $data);
								}
							}
							else{
								$this->session->set_flashdata('error_message', 'Pacak interval harus lebih dari '.$this->config->item('jarak_pacak').' hari');
								$this->load->view('frontend/add_stud', $data);
							}
						}
						else{
							$this->session->set_flashdata('error_message', 'Pelaporan pacak harus kurang dari '.$this->config->item('jarak_lapor_pacak').' hari');
							$this->load->view('frontend/add_stud', $data);
						}
					}
					else{
						$this->load->view('frontend/add_stud', $data);
					}
				}
				else{
					$this->session->set_flashdata('error_message', 'Gagal menyimpan data pacak. Err code: 3');
					$this->load->view('frontend/add_stud', $data);
				}
			}
		}
		else{
			redirect("frontend/Members");
		}
	}
}