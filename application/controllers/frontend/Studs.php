<?php
defined('BASEPATH') OR exit('No direct script access allowed');

#[\AllowDynamicProperties]

class Studs extends CI_Controller {
    public function __construct(){
		parent::__construct();
		$this->load->model(array('studModel', 'caninesModel', 'memberModel', 'birthModel', 'pedigreesModel'));
		$this->load->library('upload', $this->config->item('upload_stud'));
		$this->load->library(array('session', 'form_validation', 'pagination'));
		$this->load->helper(array('url'));
		$this->load->database();
		date_default_timezone_set("Asia/Bangkok");

		if ($this->input->cookie('site_lang')) {
            $this->lang->load('common', $this->input->cookie('site_lang'));
            $this->lang->load('stud', $this->input->cookie('site_lang'));
        } else {
            set_cookie('site_lang', 'indonesia', '2147483647'); 
            $this->lang->load('common','indonesia');
            $this->lang->load('stud','indonesia');
        }
	}

	public function index(){
		if ($this->session->userdata('mem_id')){
            $page = ($this->uri->segment(4)) ? ($this->uri->segment(4) - 1) : 0;
			$config['per_page'] = $this->config->item('stud_count');
			$config['uri_segment'] = 4;
			$config['use_page_numbers'] = TRUE;

			//Encapsulate whole pagination 
			$config['full_tag_open'] = '<ul class="pagination justify-content-end">';
			$config['full_tag_close'] = '</ul>';

			//First link of pagination
			$config['first_link'] = 'Pertama';
			$config['first_tag_open'] = '<li>';
			$config['first_tag_close'] = '</li>';

			//Customizing the “Digit” Link
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
			$config['last_link'] = 'Akhir';
			$config['last_tag_open'] = '<li>';
			$config['last_tag_close'] = '</li>';

			//For CURRENT page on which you are
			$config['cur_tag_open'] = '<li class="active"><a class="page-link bg-dark text-warning border-light" href="#">';
			$config['cur_tag_close'] = '</a></li>';

			$config['attributes'] = array('class' => 'page-link bg-dark text-light');

			$where['stu_member_id'] = $this->session->userdata('mem_id');
			$data['stud'] = $this->studModel->get_studs($where, $page * $config['per_page'], $this->config->item('stud_count'))->result();

			$data['birth'] = array();
			foreach ($data['stud'] as $s){
				$whereBirth = [];
				$whereBirth['bir_stu_id'] = $s->stu_id;
				$data['birth'][] = $this->birthModel->get_births($whereBirth)->num_rows();
			}

            $config['base_url'] = base_url().'/frontend/Studs/index';
			$config['total_rows'] = $this->studModel->get_studs($where, $page * $config['per_page'], 0)->num_rows();
			$this->pagination->initialize($config);

			$data['keywords'] = '';
            $data['date'] = '';
            $this->session->set_userdata('keywords', '');
            $this->session->set_userdata('date', '');
			$this->load->view('frontend/view_studs', $data);
		}
		else{
			redirect('frontend/Members');
		}
	}

	public function search(){
		if ($this->session->userdata('mem_id')){
            if ($this->input->post('keywords')){
				$this->session->set_userdata('keywords', $this->input->post('keywords'));
                $data['keywords'] = $this->input->post('keywords');
			}
			else{
				$data['keywords'] = $this->session->userdata('keywords');
			}

            if ($this->input->post('date')){
				$this->session->set_userdata('date', $this->input->post('date'));
				$data['date'] = $this->input->post('date');
			}
			else{
				$data['date'] = $this->session->userdata('date');
			}

            $page = ($this->uri->segment(4)) ? ($this->uri->segment(4) - 1) : 0;
			$config['per_page'] = $this->config->item('stud_count');
			$config['uri_segment'] = 4;
			$config['use_page_numbers'] = TRUE;

			//Encapsulate whole pagination 
			$config['full_tag_open'] = '<ul class="pagination justify-content-end">';
			$config['full_tag_close'] = '</ul>';

			//First link of pagination
			$config['first_link'] = 'Pertama';
			$config['first_tag_open'] = '<li>';
			$config['first_tag_close'] = '</li>';

			//Customizing the “Digit” Link
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
			$config['last_link'] = 'Akhir';
			$config['last_tag_open'] = '<li>';
			$config['last_tag_close'] = '</li>';

			//For CURRENT page on which you are
			$config['cur_tag_open'] = '<li class="active"><a class="page-link bg-dark text-warning border-light" href="#">';
			$config['cur_tag_close'] = '</a></li>';

			$config['attributes'] = array('class' => 'page-link bg-dark text-light');
            
            $date = '';
			$piece = explode("-", $data['date']);
			if (count($piece) == 3){
				$date = $piece[2]."-".$piece[1]."-".$piece[0];
			}
			if ($date){
				$where['stu_stud_date'] = $date;
			}
			$where['stu_member_id'] = $this->session->userdata('mem_id');
			$like['can_sire.can_a_s'] = $data['keywords'];
			$like['can_dam.can_a_s'] = $data['keywords'];
			$data['stud'] = $this->studModel->search_studs($like, $where, $page * $config['per_page'], $this->config->item('stud_count'))->result();

			$data['birth'] = array();
			foreach ($data['stud'] as $s){
				$whereBirth = [];
				$whereBirth['bir_stu_id'] = $s->stu_id;
				$data['birth'][] = $this->birthModel->get_births($whereBirth)->num_rows();
			}

            $config['base_url'] = base_url().'/frontend/Studs/search';
			$config['total_rows'] = $this->studModel->search_studs($like, $where, $page * $config['per_page'], 0)->num_rows();
			$this->pagination->initialize($config);
			$this->load->view('frontend/view_studs', $data);
		}
		else{
			redirect('frontend/Members');
		}
	}

	public function view_approved(){
		if ($this->session->userdata('mem_id')){
			$where['stu_partner_id'] = $this->session->userdata('mem_id');
			$where['stu_stat'] = $this->config->item('accepted');
			$data['stud'] = $this->studModel->get_studs($where)->result();

			$data['birth'] = array();
			$data['stat'] = array();
			foreach ($data['stud'] as $s){
				$whereBirth = [];
				$whereBirth['bir_stu_id'] = $s->stu_id;
				$whereBirth['bir_stat != '] = $this->config->item('rejected');
				$data['birth'][] = $this->birthModel->get_births($whereBirth)->num_rows();

				$piece = explode("-", $s->stu_stud_date);
				$studDate = $piece[2]."-".$piece[1]."-".$piece[0];

				$ts = new DateTime();
				$ts_stud = new DateTime($studDate);
				if ($ts_stud > $ts){
					$data['stat'][] = false;
				}
				else{ // min 58 hari; max 75 hari
					$err = 0;
					$diff = floor($ts->diff($ts_stud)->days/$this->config->item('min_jarak_lapor_lahir'));
					if ($diff < 1){
						$err++;
					}

					if (!$err){
						$diff = floor($ts->diff($ts_stud)->days/$this->config->item('jarak_lapor_lahir'));
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
			$this->load->view('frontend/view_approved_studs', $data);
		}
		else{
			redirect('frontend/Members');
		}
	}

	public function add(){
		if ($this->session->userdata('mem_id')){
			$whereSire['can_member_id'] = $this->session->userdata('mem_id');
			$whereSire['can_gender'] = 'MALE';
			$whereSire['can_stat'] = $this->config->item('accepted');
			$whereSire['can_rip '] = $this->config->item('canine_alive');
			$data['sire'] = $this->caninesModel->get_canines_simple($whereSire)->result();

			// Sire harus 12 bulan
			$count = 0;
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
					$count++;
				}
			}
			$data['sireStat'] = $stat;
			$data['dam'] = [];
			$data['damStat'] = [];
			if ($count){
				$this->load->view('frontend/add_stud', $data);
			}
			else{
				$this->session->set_flashdata('error_message', 'Tidak ada anjing jantan min 12 bulan');
				redirect("frontend/Studs");
			}
		}
		else{
			redirect("frontend/Members");
		}
	}

	public function search_dam(){
		if ($this->session->userdata('mem_id')){
			$whereSire['can_member_id'] = $this->session->userdata('mem_id');
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
			$this->load->view('frontend/add_stud', $data);
		}
		else{
			redirect("frontend/Members");
		}
	}

	public function validate_add(){
		if ($this->session->userdata('mem_id')){
			$this->form_validation->set_error_delimiters('<div>','</div>');
			$this->form_validation->set_message('required', '%s wajib diisi');
			$this->form_validation->set_rules('stu_sire_id', 'Sire ', 'trim|required');
			$this->form_validation->set_rules('stu_dam_id', 'Dam ', 'trim|required');
			$this->form_validation->set_rules('stu_stud_date', 'Tanggal pacak ', 'trim|required');
			
			$whereSire['can_member_id'] = $this->session->userdata('mem_id');
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

			if ($this->form_validation->run() == FALSE){
				$this->load->view('frontend/add_stud', $data);
			}
			else{
				$piece = explode("-", $this->input->post('stu_stud_date'));
				$date = $piece[2]."-".$piece[1]."-".$piece[0];

				$wheStud['stu_sire_id'] = $this->input->post('stu_sire_id');
				$wheStud['stu_dam_id'] = $this->input->post('stu_dam_id');
				$wheStud['stu_stat != '] = $this->config->item('rejected');
				$wheStud['stu_stud_date'] = $date;
				$stud = $this->studModel->get_studs($wheStud)->row();
				if (!$stud){
					$wheDam['can_id'] = $this->input->post('stu_dam_id');
					$can = $this->caninesModel->get_canines($wheDam)->row();
					if ($can){
						$err = 0;
						if (!isset($_POST['attachment_dam']) || empty($_POST['attachment_dam'])) {
							$err++;
							$this->session->set_flashdata('error_message', 'Foto dam wajib diisi');
						}
						if (!isset($_POST['attachment_sire']) || empty($_POST['attachment_sire'])) {
							$err++;
							$this->session->set_flashdata('error_message', 'Foto sire wajib diisi');
						}
						if (!isset($_POST['attachment_stud']) || empty($_POST['attachment_stud'])){
							$err++;
							$this->session->set_flashdata('error_message', 'Foto pacak wajib diisi');
						}

						$photo = '-';
						$sire = '-';
						$dam = '-';
						if(!$err){
							$uploadedStud = $_POST['attachment_stud'];
							$image_array_1 = explode(";", $uploadedStud);
							$image_array_2 = explode(",", $image_array_1[1]);
							$uploadedStud = base64_decode($image_array_2[1]);
		
							if ((strlen($uploadedStud) > $this->config->item('file_size'))) {
								$err++;
								$this->session->set_flashdata('error_message', 'Ukuran file stud terlalu besar (> 1 MB).');
							}

							$uploadedSire = $_POST['attachment_sire'];
							$image_array_1 = explode(";", $uploadedSire);
							$image_array_2 = explode(",", $image_array_1[1]);
							$uploadedSire = base64_decode($image_array_2[1]);
		
							if ((strlen($uploadedSire) > $this->config->item('file_size'))) {
								$err++;
								$this->session->set_flashdata('error_message', 'Ukuran file sire terlalu besar (> 1 MB).');
							}

							$uploadedDam = $_POST['attachment_dam'];
							$image_array_1 = explode(";", $uploadedDam);
							$image_array_2 = explode(",", $image_array_1[1]);
							$uploadedDam = base64_decode($image_array_2[1]);
		
							if ((strlen($uploadedDam) > $this->config->item('file_size'))) {
								$err++;
								$this->session->set_flashdata('error_message', 'Ukuran file dam terlalu besar (> 1 MB).');
							}

							$stud_name = $this->config->item('path_stud').$this->config->item('file_name_stud');
							$sire_name = $this->config->item('path_stud').$this->config->item('file_name_sire');
							$dam_name = $this->config->item('path_stud').$this->config->item('file_name_dam');

							if (!is_dir($this->config->item('path_stud')) or !is_writable($this->config->item('path_stud'))) {
								$err++;
								$this->session->set_flashdata('error_message', 'Folder stud tidak ditemukan atau tidak writeable.');
							} else{
								if (is_file($stud_name) and !is_writable($stud_name)) {
									$err++;
									$this->session->set_flashdata('error_message', 'File stud sudah ada dan tidak writeable.');
								}
								if (is_file($sire_name) and !is_writable($sire_name)) {
									$err++;
									$this->session->set_flashdata('error_message', 'File sire sudah ada dan tidak writeable.');
								}
								if (is_file($dam_name) and !is_writable($dam_name)) {
									$err++;
									$this->session->set_flashdata('error_message', 'File dam sudah ada dan tidak writeable.');
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

						// Lapor pacak harus kurang dari 7 hari
						if (!$err){
							$cek = true;
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
							if ($year != $this->config->item('tahun_lapor_pacak'))
								$cek = false;
							else{
								if ($month == $this->config->item('bulan_lapor_pacak') && (int)$day < $this->config->item('tanggal_lapor_pacak'))
									$cek = false;
							}

							if ($cek){
								// Jarak pacak utk dam yg sama adalah sbb:
								// Kurang dari 4 bulan dari pacak(tidak ada lahir) 
								// Kurang dari 3 bulan dari lahir(ada lahir)
								$wheBirth['studs.stu_dam_id'] = $this->input->post('stu_dam_id');
								$wheBirth['studs.stu_stat IN ('.$this->config->item('accepted').', '.$this->config->item('completed').')'] = null;
								$wheBirth['births.bir_stat IN ('.$this->config->item('accepted').', '.$this->config->item('completed').')'] = null;
								$birth = $this->birthModel->get_births($wheBirth)->row();
								if (!$birth){
									$res = $this->studModel->check_date($this->input->post('stu_dam_id'), $date);
								}
								else{
									$res = $this->birthModel->check_date($this->input->post('stu_dam_id'), $date);
								}
								if (!$res){ 
									// dam anak dari sire
									$wherePedSire['ped_sire_id'] = $this->input->post('stu_sire_id');
									$wherePedSire['ped_canine_id'] = $this->input->post('stu_dam_id');
									$pedSire = $this->pedigreesModel->get_pedigrees($wherePedSire)->row();
									if ($pedSire){
										$err++;
										$this->session->set_flashdata('error_message', 'Dam tidak boleh anak dari sire');
									}

									if (!$err){
										// sire anak dari dam
										$wherePedDam['ped_dam_id'] = $this->input->post('stu_dam_id');
										$wherePedDam['ped_canine_id'] = $this->input->post('stu_sire_id');
										$pedDam = $this->pedigreesModel->get_pedigrees($wherePedDam)->row();
										if ($pedDam){
											$err++;
											$this->session->set_flashdata('error_message', 'Sire tidak boleh anak dari dam');
										}
									}

									if (!$err){ 
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
												$this->session->set_flashdata('error_message', 'Sire dan dam adalah sibling');
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
											'stu_member_id' => $this->session->userdata('mem_id'),
											'stu_partner_id' => $can->can_member_id,
										);
										$stud = $this->studModel->add_studs($data);
										if ($stud){
											$this->session->set_flashdata('add_success', true);
											redirect("frontend/Studs");
										}
										else{
											$this->session->set_flashdata('error_message', 'Gagal menyimpan data pacak. Err code: 1');
											$this->load->view('frontend/add_stud', $data);
										}
									}
									if ($err){
										$this->load->view('frontend/add_stud', $data);
									}
								}
								else{
									if (!$birth){
										$this->session->set_flashdata('error_message', 'Pacak interval harus lebih dari '.$this->config->item('jarak_pacak').' hari dari tanggal pacak');
										$this->load->view('frontend/add_stud', $data);
									}
									else{
										$this->session->set_flashdata('error_message', 'Pacak interval harus lebih dari '.$this->config->item('jarak_pacak_lahir').' hari dari tanggal lahir');
										$this->load->view('frontend/add_stud', $data);
									}
								}
							}
							else{
								$this->session->set_flashdata('error_message', 'Pelaporan pacak harus kurang dari '.$this->config->item('hari_lapor_pacak').' hari');
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
				else{
					if ($stud->stu_stat == $this->config->item('saved')){
						$this->session->set_flashdata('error_message', 'Lapor pacak sudah terdaftar dan belum diproses. Harap menghubungi Admin');
						$this->load->view('frontend/add_stud', $data);
					}
					else{
						$this->session->set_flashdata('error_message', 'Lapor pacak sudah terdaftar');
						$this->load->view('frontend/add_stud', $data);
					}
				}
			}
		}
		else{
			redirect("frontend/Members");
		}
	}
}