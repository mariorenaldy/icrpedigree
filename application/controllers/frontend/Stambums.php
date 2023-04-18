<?php
defined('BASEPATH') OR exit('No direct script access allowed');

#[\AllowDynamicProperties]

class Stambums extends CI_Controller {
    public function __construct(){
        // Call the CI_Controller constructor
        parent::__construct();
        $this->load->model(array('stambumModel', 'caninesModel','memberModel', 'notification_model', 'notificationtype_model', 'pedigreesModel', 'kennelModel', 'birthModel', 'studModel', 'logcanineModel', 'logpedigreeModel', 'logstambumModel'));
        $this->load->library('upload', $this->config->item('upload_canine'));
        $this->load->library(array('session', 'form_validation', 'pagination'));
        $this->load->helper(array('url', 'mail', 'notif'));
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

	public function test_input($data) {
		$data = trim($data);
		$data = stripslashes($data);
		$data = htmlspecialchars($data);
		return $data;
	}

	public function index(){
		if ($this->session->userdata('mem_id')){
            $page = ($this->uri->segment(4)) ? ($this->uri->segment(4) - 1) : 0;
			$config['per_page'] = $this->config->item('stb_count');
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

			$where['stb_member_id'] = $this->session->userdata('mem_id');
			$data['stambum'] = $this->stambumModel->get_stambum($where, 'stb_a_s', $page * $config['per_page'], $this->config->item('stb_count'))->result();
			
            $config['base_url'] = base_url().'/frontend/Stambums/index';
			$config['total_rows'] = $this->stambumModel->get_stambum($where, 'stb_a_s', $page * $config['per_page'], 0)->num_rows();
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
				$data['keywords'] = $this->session->userdata('keywords');
			}

            $page = ($this->uri->segment(4)) ? ($this->uri->segment(4) - 1) : 0;
			$config['per_page'] = $this->config->item('stb_count');
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

			$like['stb_a_s'] = $data['keywords'];
			$where['stb_member_id'] = $this->session->userdata('mem_id');
			$data['stambum'] = $this->stambumModel->search_stambum($like, $where, 'stb_a_s', $page * $config['per_page'], $this->config->item('stb_count'))->result();

            $config['base_url'] = base_url().'/frontend/Stambums/search';
			$config['total_rows'] = $this->stambumModel->search_stambum($like, $where, 'stb_a_s', $page * $config['per_page'], 0)->num_rows();
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
				$wheBirth['bir_id'] = $this->uri->segment(4);
				$data['birth'] = $this->birthModel->get_births($wheBirth)->row();

				if ($data['birth']->bir_stat == $this->config->item('accepted')){ // harus kurang dari 100 hari
					$whereStb['stb_bir_id'] = $this->uri->segment(4);
					$whereStb['stb_stat != '] = $this->config->item('rejected');
					$stb = $this->stambumModel->get_stambum($whereStb)->num_rows();
					if (!$stb){
						$err = 0;
						$piece = explode("-", $data['birth']->bir_date_of_birth);
						$dob = $piece[2]."-".$piece[1]."-".$piece[0];

						$ts = new DateTime();
						$ts_birth = new DateTime($dob);
						if ($ts_birth > $ts){
							$err++;
							$this->session->set_flashdata('error_message', 'Pelaporan anak harus kurang dari '.$this->config->item('jarak_lapor_anak').' hari dari waktu lahir'); 
						}
						else{
							$diff = floor($ts->diff($ts_birth)->days/$this->config->item('min_jarak_lapor_anak'));
							if ($diff < 1){
								$err++;
								$this->session->set_flashdata('error_message', 'Pelaporan anak harus lebih dari '.$this->config->item('min_jarak_lapor_anak').' hari dari waktu lahir');
							}

							$diff = floor($ts->diff($ts_birth)->days/$this->config->item('jarak_lapor_anak'));
							if ($diff > 1){
								$err++;
								$this->session->set_flashdata('error_message', 'Pelaporan anak harus kurang dari '.$this->config->item('jarak_lapor_anak').' hari dari waktu lahir');
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
							$this->session->set_flashdata('error_message', 'Lapor anak sudah terdaftar dan belum diproses. Harap menghubungi Admin');
						}
						else{
							$this->session->set_flashdata('error_message', 'Lapor anak sudah terdaftar');
						}
						redirect('frontend/Births/view_approved');
					}
				}
				else {
					$this->session->set_flashdata('error_message', 'Lapor anak tidak valid');
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

	public function add_more(){
        if ($this->uri->segment(4)){  
			if ($this->session->userdata('mem_id')){
				$wheBirth['bir_id'] = $this->uri->segment(4);
				$data['birth'] = $this->birthModel->get_births($wheBirth)->row();
				$data['mode'] = 0;
				$this->load->view('frontend/add_stambum', $data);
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
			$this->form_validation->set_error_delimiters('<div>','</div>');
			$this->form_validation->set_message('required', '%s wajib diisi');
			$this->form_validation->set_rules('stb_bir_id', 'Birth id ', 'trim|required');
			$this->form_validation->set_rules('stb_a_s', 'Canine name ', 'trim|required');
			
			$wheBirth['bir_id'] = $this->input->post('stb_bir_id');
			$data['birth'] = $this->birthModel->get_births($wheBirth)->row();
			$data['mode'] = 1;
			if ($this->form_validation->run() == FALSE){
				$this->load->view('frontend/add_stambum', $data);
			}
			else{
				$err = 0;
				if (!isset($_POST['attachment']) || empty($_POST['attachment'])){
					$err++;
					$this->session->set_flashdata('error_message', 'Foto wajib diisi');
				}

				$photo = '-';
				if (!$err){
					$uploadedImg = $_POST['attachment'];
					$image_array_1 = explode(";", $uploadedImg);
					$image_array_2 = explode(",", $image_array_1[1]);
					$uploadedImg = base64_decode($image_array_2[1]);

					if ((strlen($uploadedImg) > $this->config->item('file_size'))) {
						$err++;
						$this->session->set_flashdata('error_message', 'Ukuran file terlalu besar (> 1 MB).');
					}

					$img_name = $this->config->item('path_canine').$this->config->item('file_name_canine');
					if (!is_dir($this->config->item('path_canine')) or !is_writable($this->config->item('path_canine'))) {
						$err++;
						$this->session->set_flashdata('error_message', 'Folder canine tidak ditemukan atau tidak writeable.');
					} else{
						if (is_file($img_name) and !is_writable($img_name)) {
							$err++;
							$this->session->set_flashdata('error_message', 'File sudah ada dan tidak writeable.');
						}
					}

					if (!$err){
						file_put_contents($img_name, $uploadedImg);
						$photo = str_replace($this->config->item('path_canine'), '', $img_name);
					}
				}

				// cek jumlah male & female
				$maleFull = 0; 
				$femaleFull = 0;

				$wheStbMale['stb_bir_id'] = $this->input->post('stb_bir_id');
				$wheStbMale['stb_gender'] = 'MALE';
				$wheStbMale['stb_stat != '] = $this->config->item('rejected'); 
				$male = $this->stambumModel->get_count($wheStbMale);

				$wheStbFemale['stb_bir_id'] = $this->input->post('stb_bir_id');
				$wheStbFemale['stb_gender'] = 'FEMALE';
				$wheStbFemale['stb_stat != '] = $this->config->item('rejected');
				$female = $this->stambumModel->get_count($wheStbFemale);

				if ($this->input->post('stb_gender') == 'MALE'){
					if ($male >= $data['birth']->bir_male){
						$err++;
						$this->session->set_flashdata('error_message', 'Anak jantan sudah semua');
					}
					if ($male+1 == $data['birth']->bir_male){
						$maleFull = 1;
					}
					if ($female == $data['birth']->bir_female){
						$femaleFull = 1;
					}
				}
				else{
					if ($female >= $data['birth']->bir_female){
						$err++;
						$this->session->set_flashdata('error_message', 'Anak betina sudah semua');
					}
					if ($male == $data['birth']->bir_male){
						$maleFull = 1;
					}
					if ($female+1 == $data['birth']->bir_female){
						$femaleFull = 1;
					}
				}

				if (!$err){
					$piece = explode("-", $data['birth']->bir_date_of_birth);
					$dob = $piece[2]."-".$piece[1]."-".$piece[0];

					$ts = new DateTime();
					$ts_birth = new DateTime($dob);
					if ($ts_birth > $ts){
						$err++;
						$this->session->set_flashdata('error_message', 'Pelaporan anak harus kurang dari '.$this->config->item('jarak_lapor_anak').' hari dari waktu lahir'); 
					}
					else{
						$diff = floor($ts->diff($ts_birth)->days/$this->config->item('min_jarak_lapor_anak'));
						if ($diff < 1){
							$err++;
							$this->session->set_flashdata('error_message', 'Pelaporan anak harus lebih dari '.$this->config->item('min_jarak_lapor_anak').' hari dari waktu lahir');
						}

						$diff = floor($ts->diff($ts_birth)->days/$this->config->item('jarak_lapor_anak'));
						if ($diff > 1){
							$err++;
							$this->session->set_flashdata('error_message', 'Pelaporan anak harus kurang dari '.$this->config->item('jarak_lapor_anak').' hari dari waktu lahir');
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
					// nama diubah berdasarkan kennel
					if ($kennel->ken_type_id == 1)
						$can_a_s = strtoupper($this->input->post('stb_a_s'))." VON ".$kennel->ken_name;
					else if ($kennel->ken_type_id == 2)
						$can_a_s = $kennel->ken_name."` ".strtoupper($this->input->post('stb_a_s'));
					else 
						$can_a_s = strtoupper($this->input->post('stb_a_s'));

					if (!$err && $this->caninesModel->check_for_duplicate(0, 'can_a_s', $can_a_s)){
						$err++;
						$this->session->set_flashdata('error_message', 'Nama anjing tidak boleh sama');
					}
		
					if (!$err){
						$piece = explode("-", $data['birth']->bir_date_of_birth);
						$dob = $piece[2]."-".$piece[1]."-".$piece[0];

						$this->db->trans_strict(FALSE);
						$this->db->trans_start();
						$dataStb = array(
							'stb_bir_id' => $this->input->post('stb_bir_id'),
							'stb_a_s' => $can_a_s,
							'stb_breed' => $dam->can_breed,
							'stb_gender' => $this->input->post('stb_gender'),
							'stb_date_of_birth' => $dob,
							'stb_reg_date' => date("Y/m/d"),
							'stb_photo' => $photo,
							'stb_stat' => $this->config->item('saved'),
							'stb_user' => 0,
							'stb_date' => date('Y-m-d H:i:s'),
							'stb_member_id' => $kennel->mem_id,
							'stb_kennel_id' => $kennel->ken_id,
						);
						
						$result = $this->stambumModel->add_stambum($dataStb);
						if ($result){
							if ($maleFull && $femaleFull){ // anak lengkap
								$dataBirth['bir_stat'] = $this->config->item('completed');
								$bir = $this->birthModel->update_births($dataBirth, $wheBirth);
								if ($bir){
									$res = $this->notification_model->add(18, $result, $kennel->mem_id);
									if ($res){
										$this->db->trans_complete();
										if ($kennel->mem_firebase_token){
											$notif = $this->notificationtype_model->get_by_id(18);
											firebase_notif($kennel->mem_firebase_token, $notif[0]->title, $notif[0]->description);
										}
										$this->session->set_flashdata('add_success', true);
										redirect("frontend/Stambums");
									}
									else{
										$err = 1;
									} 
								}
								else{
									$err = 2;
								}
							}
							else{ // tambah anak lagi
								$this->db->trans_complete();
								$this->session->set_flashdata('add_success', true);
								redirect("frontend/Stambums/add_more/".$this->input->post('stb_bir_id'));
							}			
						}
						else{
							$err = 3;
						}
						if ($err){
							$this->db->trans_rollback();
							$this->session->set_flashdata('error_message', 'Gagal menyimpan data anak. Error code: '.$err);
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
		}
		else{
			redirect("frontend/Members");
		}
	}

	public function cancel_all(){
        if ($this->uri->segment(4)){  
			if ($this->session->userdata('mem_id')){
				$wheBirth['bir_id'] = $this->uri->segment(4);
				$data['birth'] = $this->birthModel->get_births($wheBirth)->row();

				if ($data['birth']->bir_stat == $this->config->item('accepted')){ 
					$whereStb['stb_bir_id'] = $this->uri->segment(4);
					$dataStb = array(
						'stb_stat' => $this->config->item('rejected'),
						'stb_user' => 0,
						'stb_date' => date('Y-m-d H:i:s'),
					);
					$res = $this->stambumModel->update_stambum($dataStb, $whereStb);
					if ($res){
						redirect("frontend/Stambums");
					}
					else{
						$this->session->set_flashdata('error_message', 'Lapor anak gagal disimpan.');
						redirect("frontend/Stambums");
					}
				}
			}
			else{
				redirect("frontend/Members");
			}
        }
        else{
			redirect("frontend/Stambums");
        }
    }

	public function force_complete(){
        if ($this->uri->segment(4)){  
			if ($this->session->userdata('mem_id')){
				$wheBirth['bir_id'] = $this->uri->segment(4);
				$data['birth'] = $this->birthModel->get_births($wheBirth)->row();

				if ($data['birth']->bir_stat == $this->config->item('accepted')){ 
					$dataBirth = array(
						'bir_stat' => $this->config->item('completed'),
						'bir_user' => $this->config->item('system'),
						'bir_date' => date('Y-m-d H:i:s'),
					);
					$res = $this->birthModel->update_births($dataBirth, $wheBirth);
					if ($res){
						redirect("frontend/Stambums");
					}
					else{
						$this->session->set_flashdata('error_message', 'Lapor anak gagal disimpan.');
						redirect("frontend/Stambums");
					}
				}
			}
			else{
				redirect("frontend/Members");
			}
        }
        else{
			redirect("frontend/Stambums");
        }
    }
}