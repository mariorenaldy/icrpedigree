<?php
defined('BASEPATH') OR exit('No direct script access allowed');

#[\AllowDynamicProperties]

class Canines extends CI_Controller {
    public function __construct(){
        // Call the CI_Controller constructor
        parent::__construct();
        $this->load->model(array('caninesModel','memberModel', 'pedigreesModel', 'trahModel', 'KennelModel'));
        $this->load->library(array('session', 'form_validation', 'pagination'));
        $this->load->helper(array('url'));
        $this->load->database();
        date_default_timezone_set("Asia/Bangkok");

		if ($this->input->cookie('site_lang')) {
            $this->lang->load('common', $this->input->cookie('site_lang'));
            $this->lang->load('canine', $this->input->cookie('site_lang'));
			$this->lang->load('ownership', $this->input->cookie('site_lang'));
        } else {
            set_cookie('site_lang', 'indonesia', '2147483647'); 
            $this->lang->load('common','indonesia');
            $this->lang->load('canine','indonesia');
			$this->lang->load('ownership', 'indonesia');
        }
    }

	public function index(){
		if ($this->session->userdata('mem_id')){
			$page = ($this->uri->segment(4)) ? ($this->uri->segment(4) - 1) : 0;
			$config['per_page'] = $this->config->item('canine_count');
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

			$where['can_member_id'] = $this->session->userdata('mem_id');
			$data['canines'] = $this->caninesModel->get_canines($where, 'can_id desc', $page * $config['per_page'], $this->config->item('canine_count'))->result();

			$config['base_url'] = base_url().'/frontend/Canines/index';
			$config['total_rows'] = $this->caninesModel->get_canines($where, 'can_id desc', $page * $config['per_page'], 0)->num_rows();
			$this->pagination->initialize($config);

			$data['keywords'] = '';
            $this->session->set_userdata('keywords', '');
			$this->load->view('frontend/view_canines', $data);
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
			$config['per_page'] = $this->config->item('canine_count');
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

			$like['can_a_s'] = $data['keywords'];
			$like['can_icr_number'] = $data['keywords'];
			$where['can_member_id'] = $this->session->userdata('mem_id');
			$data['canines'] = $this->caninesModel->search_canines($like, $where, 'can_id desc', $page * $config['per_page'], $this->config->item('canine_count'))->result();

			$config['base_url'] = base_url().'/frontend/Canines/search';
			$config['total_rows'] = $this->caninesModel->search_canines($like, $where, 'can_id desc', $page * $config['per_page'], 0)->num_rows();
			$this->pagination->initialize($config);
			$this->load->view('frontend/view_canines', $data);
		}
		else{
			redirect('frontend/Members');
		}
    }

	public function view_detail(){
        if ($this->uri->segment(4)){
			$where['can_id'] = $this->uri->segment(4);
			$data['canine'] = $this->caninesModel->get_canines($where)->row();
			$whePed['ped_canine_id'] = $this->uri->segment(4);
			$ped = $this->pedigreesModel->get_pedigrees($whePed)->row();
			$sire['can_id'] = $ped->ped_sire_id;
			$data['sire'] = $this->caninesModel->get_canines($sire)->row();
			$dam['can_id'] = $ped->ped_dam_id;
			$data['dam'] = $this->caninesModel->get_canines($dam)->row();
			
			if ($ped->ped_sire_id != $this->config->item('sire_id') && $ped->ped_dam_id != $this->config->item('dam_id')){
				$data['male_siblings'] = $this->caninesModel->get_siblings($this->uri->segment(4), $ped->ped_sire_id, $ped->ped_dam_id, 'MALE', $data['canine']->can_date_of_birth2)->result();
				$data['female_siblings'] = $this->caninesModel->get_siblings($this->uri->segment(4), $ped->ped_sire_id, $ped->ped_dam_id, 'FEMALE', $data['canine']->can_date_of_birth2)->result();
			}
			else{
				$data['male_siblings'] = [];
				$data['female_siblings'] = [];
			}
			$this->load->view("frontend/view_canine_detail", $data);
        }
        else{
          	redirect('frontend/Canines');
        }
    }

	public function add(){
		if ($this->session->userdata('mem_id')){
            $wheTrah['tra_stat'] = $this->config->item('frontend_breed');
			$data['trah'] = $this->trahModel->get_trah($wheTrah)->result();
			$whe['ken_member_id'] = $this->session->userdata('mem_id');
			$whe['ken_stat'] = $this->config->item('accepted');
			$data['kennel'] = $this->KennelModel->get_kennels($whe)->result();
			$this->load->view('frontend/add_canine', $data);
		}
		else{
			redirect("frontend/Members");
		}
	}

	public function validate_add(){ 
		if ($this->session->userdata('mem_id')){
			$site_lang = $this->input->cookie('site_lang');
			$this->form_validation->set_error_delimiters('<div>','</div>');
			if ($site_lang == 'indonesia') {
				$this->form_validation->set_message('required', '%s wajib diisi');
				$this->form_validation->set_rules('can_kennel_id', 'Kennel id ', 'trim|required');
				$this->form_validation->set_rules('can_a_s', 'Nama ', 'trim|required');
				// $this->form_validation->set_rules('can_reg_number', 'No. Registration ', 'trim|required');
				// $this->form_validation->set_rules('can_icr_number', 'ICR number ', 'trim|required');
				// $this->form_validation->set_rules('can_chip_number', 'No. Microchip ', 'trim');
				// $this->form_validation->set_rules('can_color', 'Warna ', 'trim|required');
				$this->form_validation->set_rules('can_date_of_birth', 'Tanggal Lahir ', 'trim|required');
			}
			else{
				$this->form_validation->set_rules('can_kennel_id', 'Kennel id ', 'trim|required');
				$this->form_validation->set_rules('can_a_s', 'Name ', 'trim|required');
				// $this->form_validation->set_rules('can_reg_number', 'No. Registration ', 'trim|required');
				// $this->form_validation->set_rules('can_icr_number', 'ICR number ', 'trim|required');
				// $this->form_validation->set_rules('can_chip_number', 'No. Microchip ', 'trim');
				// $this->form_validation->set_rules('can_color', 'Warna ', 'trim|required');
				$this->form_validation->set_rules('can_date_of_birth', 'Date of Birth ', 'trim|required');
			}

            $wheTrah['tra_stat'] = $this->config->item('frontend_breed');
			$data['trah'] = $this->trahModel->get_trah($wheTrah)->result();
			$whe['ken_member_id'] = $this->session->userdata('mem_id');
			$whe['ken_stat'] = $this->config->item('accepted');
			$data['kennel'] = $this->KennelModel->get_kennels($whe)->result();
			if ($this->form_validation->run() == FALSE){
				$this->load->view('frontend/add_canine', $data);
			}
			else{
				$err = 0;
				$photo = '-';
				if ($this->input->post('attachment')) {
					$uploadedImg = $this->input->post('attachment');
					$image_array_1 = explode(";", $uploadedImg);
					$image_array_2 = explode(",", $image_array_1[1]);
					$uploadedImg = base64_decode($image_array_2[1]);

					if ((strlen($uploadedImg) > $this->config->item('file_size'))) {
						$err++;
                        if ($site_lang == 'indonesia') {
                            $data['error_message'] = 'Ukuran file terlalu besar (> 1 MB).<br/>';
                        }
                        else{
                            $data['error_message'] = 'File size is too big (> 1 MB).<br/>';
                        }
					}
					else{
						$image_name = $this->config->item('path_canine').$this->config->item('file_name_canine');
						if (!is_dir($this->config->item('path_canine')) or !is_writable($this->config->item('path_canine'))) {
							$err++;
							if ($site_lang == 'indonesia') {
								$this->session->set_flashdata('error_message', 'Folder anjing tidak ditemukan atau tidak writable.');
							}
							else{
								$this->session->set_flashdata('error_message', 'Dog folder is not found or is not writable.');
							}
						} else{
							if (is_file($image_name) and !is_writable($image_name)) {
								$err++;
								if ($site_lang == 'indonesia') {
									$this->session->set_flashdata('error_message', 'File sudah ada dan tidak writable.');
								}
								else{
									$this->session->set_flashdata('error_message', 'File is already exists and is not writable.');
								}
							}
						}

						if (!$err){
							file_put_contents($image_name, $uploadedImg);
							$photo = str_replace($this->config->item('path_canine'), '', $image_name);
						}
					}
				}

				if (!$err && $photo == "-"){
					$err++;
					if ($site_lang == 'indonesia') {
						$this->session->set_flashdata('error_message', 'Foto wajib diisi');
					}
					else{
						$this->session->set_flashdata('error_message', 'Photo is required');
					}
				}

				// if (!$err && $this->input->post('can_icr_number') != "-" && $this->caninesModel->check_for_duplicate(0, 'can_icr_number', $this->input->post('can_icr_number'))){
				// 	$err++;
				// 	$this->session->set_flashdata('error_message', 'No. ICR tidak boleh sama');
				// }

				// if (!$err && $this->input->post('can_chip_number') != "-" && $this->caninesModel->check_for_duplicate(0, 'can_chip_number', $this->input->post('can_chip_number'))){
				// 	$err++;
				// 	$this->session->set_flashdata('error_message', 'No. Microchip tidak boleh sama');
				// }

                $piece = explode("-", $this->input->post('can_date_of_birth'));
                $dob = $piece[2]."-".$piece[1]."-".$piece[0];
				if (!$err){
					$ts = new DateTime();
					$ts_dob = new DateTime($dob);
                    if ($ts_dob > $ts){
                        $err++;
						if ($site_lang == 'indonesia') {
							$this->session->set_flashdata('error_message', 'Tanggal lahir anjing harus sebelum tanggal hari ini');
						}
						else{
							$this->session->set_flashdata('error_message', "The dog's date of birth must be before today's date");
						}
                    }
                    else{ // min 45 hari
                        $diff = $ts->diff($ts_dob)->days/$this->config->item('min_jarak_lapor_anak');
                        if ($diff < 1){
                            $err++;
							if ($site_lang == 'indonesia') {
								$this->session->set_flashdata('error_message', 'Tanggal lahir anjing harus lebih dari '.$this->config->item('min_jarak_lapor_anak').' hari sebelum hari ini');
							}
							else{
								$this->session->set_flashdata('error_message', "The dog's date of birth must be more than ".$this->config->item('min_jarak_lapor_anak').' days before today');
							}
                        }
                    }
                }

                if (!$err){
                    $id = $this->caninesModel->record_count() + 895; // gara2 data canine dihapus
                    $data = array(
                        'can_id' => $id,
                        'can_member_id' => $this->session->userdata('mem_id'),
                        'can_reg_number' => '-', // strtoupper($this->input->post('can_reg_number')),
                        'can_breed' => $this->input->post('can_breed'),
                        'can_gender' => $this->input->post('can_gender'),
                        'can_date_of_birth' => $dob,
                        'can_color' => '-', // $this->input->post('can_color'),
                        'can_kennel_id' => $this->input->post('can_kennel_id'),
                        'can_reg_date' => date("Y/m/d"),
                        'can_photo' => $photo,
                        'can_chip_number' => '-', // $this->input->post('can_chip_number'),
                        'can_icr_number' => '-', // $this->input->post('can_icr_number'),
                    );
    
                    // nama diubah berdasarkan kennel
                    $whereKennel['ken_id'] = $this->input->post('can_kennel_id');
                    $kennel = $this->KennelModel->get_kennels($whereKennel)->result();
                    if ($kennel){
                        if ($kennel[0]->ken_type_id == 1)
                            $data['can_a_s'] = strtoupper($this->input->post('can_a_s'))." VON ".$kennel[0]->ken_name;
                        else if ($kennel[0]->ken_type_id == 2)
                            $data['can_a_s'] = $kennel[0]->ken_name."` ".strtoupper($this->input->post('can_a_s'));
                        else 
                            $data['can_a_s'] = strtoupper($this->input->post('can_a_s'));
                    }
        
                    if (!$err && $this->caninesModel->check_for_duplicate(0, 'can_a_s', $data['can_a_s'])){
                        $err++;
						if ($site_lang == 'indonesia') {
							$this->session->set_flashdata('error_message', 'Nama anjing tidak boleh sama');
						}
						else{
							$this->session->set_flashdata('error_message', 'Duplicate dog name');
						}
                    }

                    if (strlen($data['can_a_s']) >= $this->config->item('can_a_s_length')){
                        $err++;
						if ($site_lang == 'indonesia') {
							$this->session->set_flashdata('error_message', 'Nama anjing terlalu panjang. Ditambah dengan nama kennel, harus di bawah '.$this->config->item('can_a_s_length').' karakter');
						}
						else{
							$this->session->set_flashdata('error_message', "The dog's name is too long. Added with the kennel name, it must be under ".$this->config->item('can_a_s_length').' characters');
						}
                    }

                    if (!$err){
                        $dataPed = array(
                            'ped_sire_id' => $this->config->item('sire_id'),
                            'ped_dam_id' => $this->config->item('dam_id'),
                            'ped_canine_id' => $id,
                        );

                        $this->db->trans_strict(FALSE);
                        $this->db->trans_start();
                        $canines = $this->caninesModel->add_canines($data);
                        if ($canines){
                            $pedigree = $this->pedigreesModel->add_pedigrees($dataPed);
                            if ($pedigree){
                                $this->db->trans_complete();
                                $this->session->set_flashdata('add_success', true);
                                redirect("frontend/Canines");
                            }
                            else{
                                $err++;
                            }
                        }
                        else{
                            $err++;
                        }
                        if ($err){
                            $this->db->trans_rollback();
							if ($site_lang == 'indonesia') {
								$this->session->set_flashdata('error_message', 'Gagal menyimpan data anjing');
							}
							else{
								$this->session->set_flashdata('error_message', 'Failed to save dog');
							}
                            $this->load->view('frontend/add_canine', $data);
                        }
                    }
                    else{
                        $this->load->view('frontend/add_canine', $data);
                    }
                }
                else{
                    $this->load->view('frontend/add_canine', $data);
                }
			}
		}
		else{
			redirect("frontend/Members");
		}
	}

	// public function search_canine(){
	// 	$data['canines'] = [];
	// 	$data['kennel'] = [];
	// 	$this->load->view('frontend/search_canine', $data);
    // }

    // public function validate_canine(){
	// 	if ($this->session->userdata('mem_id')){
	// 		$like['can_a_s'] = $this->input->post('can_a_s');
	// 		$where['can_member_id'] = 0;
	// 		$data['canines'] = $this->caninesModel->search_canines($like, $where)->result();

	// 		$wheKennel['ken_member_id'] = $this->session->userdata('mem_id');
	// 		$data['kennel'] = $this->KennelModel->get_kennels($wheKennel)->result();
	// 		$this->load->view('frontend/search_canine', $data);
	// 	}
	// 	else{
	// 		redirect("frontend/Members");
	// 	}
    // }

	// public function validate_claim_canine(){
	// 	if ($this->session->userdata('mem_id')){
	// 		$like['can_a_s'] = $this->input->post('can_a_s');
	// 		$where['can_member_id'] = 0;
	// 		$data['canines'] = $this->caninesModel->search_canines($like, $where)->result();

	// 		$wheKennel['ken_member_id'] = $this->session->userdata('mem_id');
	// 		$data['kennel'] = $this->KennelModel->get_kennels($wheKennel)->result();

	// 		$dataCanine = array(
	// 			'can_stat' => $this->config->item('saved'),
	// 			'can_app_user' => 0,
	// 			'can_member_id' => $this->session->userdata('mem_id'),
	// 			'can_kennel_id' => $this->input->post('ken_id'),
	// 		);
	// 		$wheCanine['can_id'] = $this->input->post('can_id');
	// 		$res = $this->caninesModel->update_canines($dataCanine, $wheCanine);
	// 		if ($res){
	// 			$this->session->set_flashdata('claim_success', TRUE);
	// 			redirect("frontend/Canines/search_canine");
	// 		}
	// 		else{
	// 			$this->session->set_flashdata('error_message', 'Gagal menyimpan klaim canine');
	// 			$this->load->view('frontend/search_canine', $data);
	// 		}
	// 	}
	// 	else{
	// 		redirect("frontend/Members");
	// 	}
    // }
}