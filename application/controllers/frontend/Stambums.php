<?php
defined('BASEPATH') OR exit('No direct script access allowed');

#[\AllowDynamicProperties]

class Stambums extends CI_Controller {
    public function __construct(){
        // Call the CI_Controller constructor
        parent::__construct();
        $this->load->model(array('stambumModel', 'caninesModel', 'memberModel', 'pedigreesModel', 'kennelModel', 'birthModel', 'studModel', 'logcanineModel', 'logpedigreeModel', 'logstambumModel'));
        $this->load->library(array('session', 'form_validation', 'pagination'));
        $this->load->helper(array('url', 'cookie'));
        $this->load->database();
        date_default_timezone_set("Asia/Bangkok");

		if ($this->input->cookie('site_lang')) {
            $this->lang->load('common', $this->input->cookie('site_lang'));
            $this->lang->load('canine', $this->input->cookie('site_lang'));
        } else {
            set_cookie('site_lang', 'indonesia', '2147483647'); 
            $this->lang->load('common','indonesia');
            $this->lang->load('canine','indonesia');
        }
    }

	public function index(){
		$this->updateExpired();
		if ($this->session->userdata('mem_id')){
            $page = ($this->uri->segment(4)) ? ($this->uri->segment(4) - 1) : 0;
			$config['per_page'] = $this->config->item('stb_count');
			$config['uri_segment'] = 4;
			$config['use_page_numbers'] = TRUE;

			//Encapsulate whole pagination 
			$config['full_tag_open'] = '<ul class="pagination justify-content-end">';
			$config['full_tag_close'] = '</ul>';

			//First link of pagination
			$config['first_link'] = 'Pertama / First';
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
			$config['last_link'] = 'Akhir / Last';
			$config['last_tag_open'] = '<li>';
			$config['last_tag_close'] = '</li>';

			//For CURRENT page on which you are
			$config['cur_tag_open'] = '<li class="active"><a class="page-link bg-dark text-warning border-light" href="#">';
			$config['cur_tag_close'] = '</a></li>';

			$config['attributes'] = array('class' => 'page-link bg-dark text-light');

			$where['stb_member_id'] = $this->session->userdata('mem_id');
			$where_not_in = array($this->config->item('cancelled'), $this->config->item('delete_stat'));
			$data['stambum'] = $this->stambumModel->get_stambum($where, 'stb_reg_date desc', $page * $config['per_page'], $this->config->item('stb_count'), $where_not_in)->result();
			
            $config['base_url'] = base_url().'/frontend/Stambums/index';
			$config['total_rows'] = $this->stambumModel->get_stambum($where, 'stb_reg_date desc', $page * $config['per_page'], 0, $where_not_in)->num_rows();
			$this->pagination->initialize($config);

			$data['keywords'] = '';
            $this->session->set_userdata('keywords', '');
            $this->load->view('frontend/view_stambums', $data);
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
				if ($this->uri->segment(4))
                    $data['keywords'] = $this->session->userdata('keywords');
                else{
                    $data['keywords'] = '';
                    $this->session->set_userdata('keywords', '');
                }
			}

            $page = ($this->uri->segment(4)) ? ($this->uri->segment(4) - 1) : 0;
			$config['per_page'] = $this->config->item('stb_count');
			$config['uri_segment'] = 4;
			$config['use_page_numbers'] = TRUE;

			//Encapsulate whole pagination 
			$config['full_tag_open'] = '<ul class="pagination justify-content-end">';
			$config['full_tag_close'] = '</ul>';

			//First link of pagination
			$config['first_link'] = 'Pertama / First';
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
			$config['last_link'] = 'Akhir / Last';
			$config['last_tag_open'] = '<li>';
			$config['last_tag_close'] = '</li>';

			//For CURRENT page on which you are
			$config['cur_tag_open'] = '<li class="active"><a class="page-link bg-dark text-warning border-light" href="#">';
			$config['cur_tag_close'] = '</a></li>';

			$config['attributes'] = array('class' => 'page-link bg-dark text-light');

			$like['stb_a_s'] = $data['keywords'];
			$where['stb_member_id'] = $this->session->userdata('mem_id');
			$where_not_in = array($this->config->item('cancelled'), $this->config->item('delete_stat'));
			$data['stambum'] = $this->stambumModel->search_stambum($like, $where, 'stb_a_s', $page * $config['per_page'], $this->config->item('stb_count'), $where_not_in)->result();

            $config['base_url'] = base_url().'/frontend/Stambums/search';
			$config['total_rows'] = $this->stambumModel->search_stambum($like, $where, 'stb_a_s', $page * $config['per_page'], 0, $where_not_in)->num_rows();
			$this->pagination->initialize($config);
			$this->load->view('frontend/view_stambums', $data);
		}
		else{
			redirect('frontend/Members');
		}
    }

	public function add(){
        if ($this->uri->segment(4)){  
			if ($this->session->userdata('mem_id')){
				$site_lang = $this->input->cookie('site_lang');
				$wheBirth['bir_id'] = $this->uri->segment(4);
				$data['birth'] = $this->birthModel->get_births($wheBirth)->row();

				if ($data['birth']->bir_stat == $this->config->item('accepted')){ // harus kurang dari 100 hari
					$whereStb['stb_bir_id'] = $this->uri->segment(4);
					$whereStb['stb_stat = '] = $this->config->item('accepted');
					$stb = $this->stambumModel->get_stambum($whereStb)->num_rows();
					if (!$stb){
						$err = 0;
						$piece = explode("-", $data['birth']->bir_date_of_birth);
						$dob = $piece[2]."-".$piece[1]."-".$piece[0];

						$ts = new DateTime();
						$ts_birth = new DateTime($dob);
						if ($ts_birth > $ts){
							$err++;
							if ($site_lang == 'indonesia') {
								$this->session->set_flashdata('error_message', 'Pelaporan anak harus kurang dari '.$this->config->item('jarak_lapor_anak').' hari dari waktu lahir'); 
							}
							else{
								$this->session->set_flashdata('error_message', 'Puppy report must be less than '.$this->config->item('jarak_lapor_anak').' days after birth date'); 
							}
						}
						else{
							$diff = $ts->diff($ts_birth)->days/$this->config->item('min_jarak_lapor_anak');
							if ($diff < 1){
								$err++;
								if ($site_lang == 'indonesia') {
									$this->session->set_flashdata('error_message', 'Pelaporan anak harus lebih dari '.$this->config->item('min_jarak_lapor_anak').' hari dari waktu lahir');
								}
								else{
									$this->session->set_flashdata('error_message', 'Puppy report must be more than '.$this->config->item('min_jarak_lapor_anak').' days after birth date');
								}
							}

							$diff = $ts->diff($ts_birth)->days/$this->config->item('jarak_lapor_anak');
							if ($diff > 1){
								$err++;
								if ($site_lang == 'indonesia') {
									$this->session->set_flashdata('error_message', 'Pelaporan anak harus kurang dari '.$this->config->item('jarak_lapor_anak').' hari dari waktu lahir');
								}
								else{
									$this->session->set_flashdata('error_message', 'Puppy report must be less than '.$this->config->item('jarak_lapor_anak').' days after birth date');
								}
							}
						}

						if (!$err){
							$data['mode'] = 0;
							$this->load->view('frontend/add_stambum', $data);
						}
						else{
							redirect("frontend/Births/view_approved");
						}
					}
					else{
						if ($stb->stb_stat == $this->config->item('saved')){
							if ($site_lang == 'indonesia') {
								$this->session->set_flashdata('error_message', 'Lapor anak sudah terdaftar dan belum diproses. Harap tunggu persetujuan');
							}
							else{
								$this->session->set_flashdata('error_message', 'The puppy report is already registered and has not been processed. Please wait for approval');
							}
						}
						else{
							if ($site_lang == 'indonesia') {
								$this->session->set_flashdata('error_message', 'Lapor anak sudah terdaftar');
							}
							else{
								$this->session->set_flashdata('error_message', 'The puppy report is already registered');
							}
						}
						redirect('frontend/Births/view_approved');
					}
				}
				else {
					if ($site_lang == 'indonesia') {
						$this->session->set_flashdata('error_message', 'Lapor anak tidak valid');
					}
					else{
						$this->session->set_flashdata('error_message', 'Invalid puppy report');
					}
					redirect("frontend/Births/view_approved");
				}
			}
			else{
				redirect("frontend/Members");
			}
        }
        else{
			redirect("frontend/Births/view_approved");
        }
    }

	public function validate_add(){ 
		if ($this->session->userdata('mem_id')){
			$site_lang = $this->input->cookie('site_lang');
			$count = $this->input->post('count');
			$countNum = (int)$count;
			$this->form_validation->set_error_delimiters('<div>','</div>');
			if($count == '0'){
				if ($site_lang == 'indonesia') {
					$this->form_validation->set_message('required', '%s wajib diisi');
					$this->form_validation->set_rules('stb_bir_id', 'Id Birth ', 'trim|required');
				}
				else{
					$this->form_validation->set_message('required', '%s required');
					$this->form_validation->set_rules('stb_bir_id', 'Birth id ', 'trim|required');
				}
			}
			else if($count != 'NaN' && $count != ''){
				if ($site_lang == 'indonesia') {
					$this->form_validation->set_message('required', '%s wajib diisi');
					$this->form_validation->set_rules('stb_bir_id', 'Id Birth ', 'trim|required');
					for ($i = 1; $i <= $countNum; $i++) {
						$this->form_validation->set_rules('stb_a_s'.$i, 'Nama anjing #'.$i.' ', 'trim|required');
					}
					$this->form_validation->set_rules('count', 'Jumlah anjing ', 'trim|required');
					$this->form_validation->set_rules('payment_method', 'Metode Pembayaran ', 'trim|required');
				}
				else{
					$this->form_validation->set_message('required', '%s required');
					$this->form_validation->set_rules('stb_bir_id', 'Birth id ', 'trim|required');
					for ($i = 1; $i <= $countNum; $i++) {
						$this->form_validation->set_rules('stb_a_s'.$i, 'Name of dog #'.$i.' ', 'trim|required');
					}
					$this->form_validation->set_rules('count', 'Number of dogs ', 'trim|required');
					$this->form_validation->set_rules('payment_method', 'Payment Method ', 'trim|required');
				}
			}
			$wheBirth['bir_id'] = $this->input->post('stb_bir_id');
			$data['birth'] = $this->birthModel->get_births($wheBirth)->row();
			$data['mode'] = 1;
			if($count == 'NaN' || $count == ''){
				if ($site_lang == 'indonesia') {
					$this->session->set_flashdata('error_message', 'Jumlah anjing wajib diisi');
				}
				else{
					$this->session->set_flashdata('error_message', 'Number of dogs required');
				}
				$this->load->view('frontend/add_stambum', $data);
			}
			else if ($this->form_validation->run() == FALSE){
				$this->load->view('frontend/add_stambum', $data);
			}
			else{
				if($count != '0'){
					$err = 0;
					$maleNum = 0;
					$femaleNum = 0;
					for ($i = 1; $i <= $countNum; $i++) {
						if($this->input->post('stb_gender'.$i) == 'MALE'){
							$maleNum++;
						}
						else{
							$femaleNum++;
						}
					}
	
					if($maleNum > $data['birth']->bir_male){
						if ($site_lang == 'indonesia') {
							$this->session->set_flashdata('error_message', 'Jumlah jantan yang didaftarkan melebihi batas');
						}
						else{
							$this->session->set_flashdata('error_message', 'The number of registered males exceeds the limit');
						}
						$err = 1;
					}
					if($femaleNum > $data['birth']->bir_female){
						if ($site_lang == 'indonesia') {
							$this->session->set_flashdata('error_message', 'Jumlah betina yang didaftarkan melebihi batas');
						}
						else{
							$this->session->set_flashdata('error_message', 'The number of registered females exceeds the limit');
						}
						$err = 2;
					}
	
					if(!$err){
						for ($i = 1; $i <= $countNum; $i++) {
							if (!isset($_POST['attachment'.$i]) || empty($_POST['attachment'.$i])){
								$err = 3;
								if ($site_lang == 'indonesia') {
									$this->session->set_flashdata('error_message', 'Foto anjing #'.$i.' wajib diisi');
								}
								else{
									$this->session->set_flashdata('error_message', 'Dog #'.$i.' photo is required');
								}
							}
						}
		
						if($this->input->post('payment_method') == 'upload-proof'){
							if (!isset($_POST['attachment_proof']) || empty($_POST['attachment_proof'])){
								$err = 4;
								if ($site_lang == 'indonesia') {
									$this->session->set_flashdata('error_message', 'Foto Bukti Pembayaran wajib diisi');
								}
								else{
									$this->session->set_flashdata('error_message', 'Photo Proof of Payment is required');
								}
							}
						}
		
						$photo = '-';
						$photoProof = '-';
						$photo = [];
						if (!$err){
							for ($i = 1; $i <= $countNum; $i++) {
								$uploadedImg = $_POST['attachment'.$i];
								$image_array_1 = explode(";", $uploadedImg);
								$image_array_2 = explode(",", $image_array_1[1]);
								$uploadedImg = base64_decode($image_array_2[1]);
			
								if ((strlen($uploadedImg) > $this->config->item('file_size'))) {
									$err = 5;
									if ($site_lang == 'indonesia') {
										$this->session->set_flashdata('error_message', 'Ukuran file foto anjing #'.$i.' terlalu besar (> 1 MB).');
									}
									else{
										$this->session->set_flashdata('error_message', 'The file size of dog #'.$i.' photo is too big (> 1 MB).');
									}
								}
			
								$img_name = $this->config->item('path_canine').$this->config->item('file_name_canine');
								$img_name = substr_replace($img_name, $i, 32, 0);
								if (!is_dir($this->config->item('path_canine')) or !is_writable($this->config->item('path_canine'))) {
									$err = 6;
									if ($site_lang == 'indonesia') {
										$this->session->set_flashdata('error_message', 'Folder canine tidak ditemukan atau tidak writable.');
									}
									else{
										$this->session->set_flashdata('error_message', 'Canine folder is not found or is not writable.');
									}
								} else{
									if (is_file($img_name) and !is_writable($img_name)) {
										$err = 7;
										if ($site_lang == 'indonesia') {
											$this->session->set_flashdata('error_message', 'File sudah ada dan tidak writable.');
										}
										else{
											$this->session->set_flashdata('error_message', 'The file is already exists and is not writable.');
										}
									}
								}
			
								if (!$err){
									file_put_contents($img_name, $uploadedImg);
									$photo[$i] = str_replace($this->config->item('path_canine'), '', $img_name);
								}
							}
						}
		
						if (!$err && $this->input->post('payment_method') == 'upload-proof'){
							$uploadedImg = $_POST['attachment_proof'];
							$image_array_1 = explode(";", $uploadedImg);
							$image_array_2 = explode(",", $image_array_1[1]);
							$uploadedImg = base64_decode($image_array_2[1]);
		
							if ((strlen($uploadedImg) > $this->config->item('file_size'))) {
								$err = 8;
								if ($site_lang == 'indonesia') {
									$this->session->set_flashdata('error_message', 'Ukuran file terlalu besar (> 1 MB).');
								}
								else{
									$this->session->set_flashdata('error_message', 'The file size is too big (> 1 MB).');
								}
							}
		
							$img_name = $this->config->item('path_payment').$this->config->item('file_name_payment');
							if (!is_dir($this->config->item('path_payment')) or !is_writable($this->config->item('path_payment'))) {
								$err = 9;
								if ($site_lang == 'indonesia') {
									$this->session->set_flashdata('error_message', 'Folder payment tidak ditemukan atau tidak writable.');
								}
								else{
									$this->session->set_flashdata('error_message', 'Payment folder is not found or is not writable.');
								}
							} else{
								if (is_file($img_name) and !is_writable($img_name)) {
									$err = 10;
									if ($site_lang == 'indonesia') {
										$this->session->set_flashdata('error_message', 'File sudah ada dan tidak writable.');
									}
									else{
										$this->session->set_flashdata('error_message', 'The file is already exists and is not writable.');
									}
								}
							}
		
							if (!$err){
								file_put_contents($img_name, $uploadedImg);
								$photoProof = str_replace($this->config->item('path_payment'), '', $img_name);
							}
						}
		
						if (!$err){
							$piece = explode("-", $data['birth']->bir_date_of_birth);
							$dob = $piece[2]."-".$piece[1]."-".$piece[0];
		
							$ts = new DateTime();
							$ts_birth = new DateTime($dob);
							if ($ts_birth > $ts){
								$err = 11;
								if ($site_lang == 'indonesia') {
									$this->session->set_flashdata('error_message', 'Pelaporan anak harus kurang dari '.$this->config->item('jarak_lapor_anak').' hari dari waktu lahir'); 
								}
								else{
									$this->session->set_flashdata('error_message', 'The puppy report must be less than '.$this->config->item('jarak_lapor_anak').' days after birth date'); 
								}
							}
							else{
								$diff = $ts->diff($ts_birth)->days/$this->config->item('min_jarak_lapor_anak');
								if ($diff < 1){
									$err = 12;
									if ($site_lang == 'indonesia') {
										$this->session->set_flashdata('error_message', 'Pelaporan anak harus lebih dari '.$this->config->item('min_jarak_lapor_anak').' hari dari waktu lahir');
									}
									else{
										$this->session->set_flashdata('error_message', 'The puppy report must be more than '.$this->config->item('min_jarak_lapor_anak').' days after birth date');
									}
								}
		
								$diff = $ts->diff($ts_birth)->days/$this->config->item('jarak_lapor_anak');
								if ($diff > 1){
									$err = 13;
									if ($site_lang == 'indonesia') {
										$this->session->set_flashdata('error_message', 'Pelaporan anak harus kurang dari '.$this->config->item('jarak_lapor_anak').' hari dari waktu lahir');
									}
									else{
										$this->session->set_flashdata('error_message', 'The puppy report must be less than '.$this->config->item('jarak_lapor_anak').' days after birth date');
									}
								}
							}
						}
		
						$wheStud['stu_id'] = $data['birth']->bir_stu_id;
						$stud = $this->studModel->get_studs($wheStud)->row();
						$wheDam['can_id'] = $stud->stu_dam_id;
						$dam = $this->caninesModel->get_canines($wheDam)->row();
						$wheKennel['mem_id'] = $stud->stu_partner_id;
						$kennel = $this->memberModel->get_members($wheKennel)->row();
		
						if (!$err){
							$can_a_s = [];
							for ($i = 1; $i <= $countNum; $i++) {
								// nama diubah berdasarkan kennel
								if ($kennel->ken_type_id == 1)
									$can_a_s[$i] = strtoupper($this->input->post('stb_a_s'.$i))." VON ".$kennel->ken_name;
								else if ($kennel->ken_type_id == 2)
									$can_a_s[$i] = $kennel->ken_name."` ".strtoupper($this->input->post('stb_a_s'.$i));
								else 
									$can_a_s[$i] = strtoupper($this->input->post('stb_a_s'.$i));
			
								if (!$err && $this->caninesModel->check_for_duplicate(0, 'can_a_s', $can_a_s[$i])){
									$err = 14;
									if ($site_lang == 'indonesia') {
										$this->session->set_flashdata('error_message', 'Nama anjing #'.$i.' sudah terdaftar');
									}
									else{
										$this->session->set_flashdata('error_message', 'The dog #'.$i.' name has already been registered');
									}
								}
							}
				
							if (!$err){
								$piece = explode("-", $data['birth']->bir_date_of_birth);
								$dob = $piece[2]."-".$piece[1]."-".$piece[0];
		
								$this->db->trans_strict(FALSE);
								$this->db->trans_start();

								$inv = $this->generateInvoice();
	
								for ($i = 1; $i <= $countNum; $i++) {
									$dataStb = array(
										'stb_bir_id' => $this->input->post('stb_bir_id'),
										'stb_a_s' => $can_a_s[$i],
										'stb_breed' => $dam->can_breed,
										'stb_gender' => $this->input->post('stb_gender'.$i),
										'stb_date_of_birth' => $dob,
										'stb_reg_date' => date('Y-m-d H:i:s'),
										'stb_photo' => $photo[$i],
										'stb_pay_photo' => $photoProof,
										'stb_pay_invoice' => '-',
										'stb_count' => $countNum,
										'stb_stat' => $this->config->item('saved'),
										'stb_user' => $this->config->item('system'),
										'stb_date' => date('Y-m-d H:i:s'),
										'stb_member_id' => $kennel->mem_id,
										'stb_kennel_id' => $kennel->ken_id,
									);

									if($this->input->post('payment_method') == 'upload-proof'){
										$dataStb['stb_pay_id'] = $this->config->item('upload_proof');
									}
									else{
										$dataStb['stb_pay_id'] = $this->config->item('doku');
										$dataStb['stb_pay_invoice'] = $inv;
										$dataStb['stb_stat'] = $this->config->item('not_paid');
										$dataStb['stb_pay_due_date'] = date('Y-m-d H:i:s', strtotime('1 hour'));
									}

									$result = $this->stambumModel->add_stambum($dataStb);
									if (!$result){
										$err = 15;
									}
								}
								if(!$err){
									$dataBirth['bir_stat'] = $this->config->item('completed');
									$bir = $this->birthModel->update_births($dataBirth, $wheBirth);
									if ($bir){
										if($this->input->post('payment_method') == 'upload-proof'){
											$this->db->trans_complete();
											$this->session->set_flashdata('add_success', true);
											redirect("frontend/Stambums");
										}
										else{
											$this->db->trans_complete();
											$price = $countNum*150000;
											redirect("frontend/Payment/checkout/Stambums/".$price."/".$inv);
										}
									}
									else{
										$err = 16;
									}
								}
								if ($err){
									$this->db->trans_rollback();
									if ($site_lang == 'indonesia') {
										$this->session->set_flashdata('error_message', 'Gagal menyimpan data anak anjing. Error code: '.$err);
									}
									else{
										$this->session->set_flashdata('error_message', 'Failed to save puppy data. Error code: '.$err);
									}
									$this->load->view('frontend/add_stambum', $data);
								}
							}
							else{
								$this->load->view('frontend/add_stambum', $data);
							}
						}
						else{
							$this->load->view('frontend/add_stambum', $data);
						}
					}
					else{
						$this->load->view('frontend/add_stambum', $data);
					}
				}
				else{
					$this->db->trans_strict(FALSE);
					$this->db->trans_start();
					
					$dataBirth['bir_stat'] = $this->config->item('completed');
					$bir = $this->birthModel->update_births($dataBirth, $wheBirth);
					if ($bir){
						$this->db->trans_complete();
						$this->session->set_flashdata('add_success', true);
						redirect("frontend/Stambums");
					}
					else{
						$err = 17;
					}
					if ($err){
						$this->db->trans_rollback();
						if ($site_lang == 'indonesia') {
							$this->session->set_flashdata('error_message', 'Gagal menyimpan data anak anjing. Error code: '.$err);
						}
						else{
							$this->session->set_flashdata('error_message', 'Failed to save puppy data. Error code: '.$err);
						}
						$this->load->view('frontend/add_stambum', $data);
					}
				}
			}
		}
		else{
			redirect("frontend/Members");
		}
	}
	public function cek_status($invoice){
		if ($this->uri->segment(4)){
			$site_lang = $this->input->cookie('site_lang');

			$where['stb_pay_invoice'] = $invoice;
			$stambums = $this->stambumModel->get_stambum($where)->result();
	
			$clientId = "BRN-0222-1677984841764";
			$requestId = $invoice;
			$date = new DateTime("now", new DateTimeZone('UTC'));
			$requestDate = $date->format('Y-m-d\TH:i:s\Z');
	
			$targetPath = "/orders/v1/status/".$requestId;
			$secretKey = "SK-WjYbHmZGDEhveR9kBxCW";
			
			// Prepare Signature Component
			$componentSignature = "Client-Id:" . $clientId . "\n" . 
								  "Request-Id:" . $requestId . "\n" .
								  "Request-Timestamp:" . $requestDate . "\n" . 
								  "Request-Target:" . $targetPath;
	
			// Calculate HMAC-SHA256 base64 from all the components above
			// $signature = base64_encode(hash_hmac('sha256', $componentSignature, $secretKey, true));
			$signature = $this->generate_signature($componentSignature, $secretKey);
	
			// Initiate cURL
			$ch = curl_init();
	
			curl_setopt_array($ch, array(
				CURLOPT_URL => 'https://api-sandbox.doku.com/orders/v1/status/'.$requestId,
				CURLOPT_SSL_VERIFYHOST => 0,
				CURLOPT_SSL_VERIFYPEER => 0,
				CURLOPT_RETURNTRANSFER => true,
				CURLOPT_FAILONERROR => true,
				CURLOPT_ENCODING => '',
				CURLOPT_MAXREDIRS => 10,
				CURLOPT_TIMEOUT => 0,
				CURLOPT_FOLLOWLOCATION => true,
				CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
				CURLOPT_CUSTOMREQUEST => 'GET',
				CURLOPT_HTTPHEADER => array(
					'Content-Type: application/json',
					'Client-Id: '.$clientId,
					'Request-Id: '.$requestId,
					'Request-Timestamp: '.$requestDate,
					'Signature: HMACSHA256='.$signature,
				),
			));
	
			// Execute the request
			$result = curl_exec($ch);
	
			if (!curl_errno($ch)) {
				switch ($http_code = curl_getinfo($ch, CURLINFO_HTTP_CODE)) {
					case 200:  # OK
						$statRes = json_decode($result)->transaction->status;
						if($statRes == 'FAILED'){
							$res = $this->failStambum($stambums);
							if($res){
								if ($site_lang == 'indonesia') {
									$this->session->set_flashdata('error_message', 'Pembayaran gagal');
								}
								else{
									$this->session->set_flashdata('error_message', 'Payment failed');
								}
							}
							else{
								if ($site_lang == 'indonesia') {
									$this->session->set_flashdata('error_message', 'Gagal mengubah status pendaftaran anak anjing');
								}
								else{
									$this->session->set_flashdata('error_message', 'Failed to change puppy registration status');
								}
							}
							redirect("frontend/Stambums");
						}
						else if($statRes == 'SUCCESS'){
							$res = $this->payStambum($stambums);
							if($res){
								$this->session->set_flashdata('add_success', true);
								redirect("frontend/Stambums");
							}
							else{
								if ($site_lang == 'indonesia') {
									$this->session->set_flashdata('error_message', 'Gagal membayar pendaftaran anak anjing');
								}
								else{
									$this->session->set_flashdata('error_message', 'Failed to pay puppy registration');
								}
								redirect("frontend/Stambums");
							}
						}
						else if($statRes == 'EXPIRED'){
							if ($site_lang == 'indonesia') {
								$this->session->set_flashdata('error_message', 'Batas pembayaran sudah lewat');
							}
							else{
								$this->session->set_flashdata('error_message', 'The payment due date has passed');
							}
							redirect("frontend/Stambums");
						}
						else if($statRes == 'PENDING'){
							if ($site_lang == 'indonesia') {
								$this->session->set_flashdata('error_message', 'Pembayaran belum diselesaikan');
							}
							else{
								$this->session->set_flashdata('error_message', 'Payment has not been completed');
							}
							redirect('frontend/Stambums');
						}
						else{
							if ($site_lang == 'indonesia') {
								$this->session->set_flashdata('error_message', 'Pembayaran gagal');
							}
							else{
								$this->session->set_flashdata('error_message', 'Payment failed');
							}
							redirect('frontend/Stambums');
						}
						break;
					default:
						redirect('frontend/Stambums');
				}
			}
			else{
				if ($site_lang == 'indonesia') {
					$this->session->set_flashdata('error_message', 'Pembayaran gagal');
				}
				else{
					$this->session->set_flashdata('error_message', 'Payment failed');
				}
				// $this->session->set_flashdata('error_message', 'Curl error: '.curl_error($ch));
				redirect('frontend/Stambums');
			}
	
			// Close cURL
			curl_close($ch);
		}
		else{
			redirect("frontend/Members");
		}
	}
	function generateInvoice($length = 8) {
		$characters = '0123456789';
		$string = '';
	
		for ($i = 0; $i < $length; $i++) {
			$string .= $characters[mt_rand(0, strlen($characters) - 1)];
		}
	
		$string = 'INVS-'.$string;
		return $string;
	}
	function generate_signature($componentSignature, $secretKey){
		$signature = base64_encode(hash_hmac('sha256', $componentSignature, $secretKey, true));
		return $signature;
	}
	public function payStambum($stambums){
		$data = array(
			'stb_stat' => $this->config->item('processed')
		);

		$this->db->trans_strict(FALSE);
		$this->db->trans_start();

		$err = 0;
		foreach($stambums as $stambum){
			$where['stb_id'] = $stambum->stb_id;
			$result = $this->stambumModel->update_stambum($data, $where);
			if (!$result) {
				$err++;
				break;
			}
		}
		if ($err) {
			$this->db->trans_rollback();
			return false;
		}
		else{
			$dataBirth['bir_stat'] = $this->config->item('completed');
			$wheBirth['bir_id'] = $stambums[0]->stb_bir_id;
			$bir = $this->birthModel->update_births($dataBirth, $wheBirth);
			if ($bir){
				$this->db->trans_complete();
				return true;
			}
			else{
				$this->db->trans_rollback();
				return false;
			}
		}
	}
	public function failStambum($stambums){
		$data = array(
			'stb_stat' => $this->config->item('payment_failed')
		);

		$this->db->trans_strict(FALSE);
		$this->db->trans_start();
		$err = 0;
		foreach($stambums as $stambum){
			$where['stb_id'] = $stambum->stb_id;
			$result = $this->stambumModel->update_stambum($data, $where);
			if (!$result) {
				$err++;
				break;
			}
		}
		if ($err) {
			$this->db->trans_rollback();
			return false;
		}
		else{
			$this->db->trans_complete();
			return true;
		}
	}
	public function cancel(){
		if ($this->uri->segment(4)){
			$site_lang = $this->input->cookie('site_lang');
			$stb_id = $this->uri->segment(4);
			$dataStb = array(
				'stb_stat' => $this->config->item('cancelled')
			);

			$err = 0;
			$whereStb['stb_id'] = $stb_id;
			$stb = $this->stambumModel->get_stambum($whereStb)->row();
			$whereStbs['stb_bir_id'] = $stb->stb_bir_id;
			$stambums = $this->stambumModel->get_stambum($whereStbs)->result();
			$this->db->trans_strict(FALSE);
			$this->db->trans_start();
			foreach($stambums as $stambum){
				$where['stb_id'] = $stambum->stb_id;
				$result = $this->stambumModel->update_stambum($dataStb, $where);
				if (!$result) {
					$err++;
					break;
				}
			}
			if (!$err) {
				$dataBirth['bir_stat'] = $this->config->item('accepted');
				$wheBirth['bir_id'] = $stambums[0]->stb_bir_id;
				$bir = $this->birthModel->update_births($dataBirth, $wheBirth);
				if (!$bir){
					$err = 101;
				}
			}

			if ($err) {
				$this->db->trans_rollback();
				if ($site_lang == 'indonesia') {
					$this->session->set_flashdata('error_message', 'Gagal membatalkan pendaftaran. Error code: '.$err);
				}
				else{
					$this->session->set_flashdata('error_message', 'Failed to cancel registration. Error code: '.$err);
				}
				redirect('frontend/Stambums');
			}
			else{
				$this->db->trans_complete();
				$this->session->set_flashdata('cancel_success', TRUE);
				redirect('frontend/Stambums');
			}
		}
		else{
			redirect('frontend/Stambums');
		}
	}
	function updateExpired(){
        $this->db->trans_strict(FALSE);
        $this->db->trans_start();

        //update all expired payment stambum status
        $stambums = $this->stambumModel->update_expired_stambum();
        
        if ($stambums) {
            $this->db->trans_complete();
            return true;
        } else {
            $this->db->trans_rollback();
            return false;
        }
	}
}