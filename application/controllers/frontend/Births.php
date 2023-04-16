<?php
defined('BASEPATH') OR exit('No direct script access allowed');

#[\AllowDynamicProperties]

class Births extends CI_Controller {
    public function __construct(){
        // Call the CI_Controller constructor
        parent::__construct();
        $this->load->model(array('studModel', 'birthModel', 'stambumModel'));
		$this->load->library('upload', $this->config->item('upload_birth'));
        $this->load->library(array('session', 'form_validation', 'pagination'));
        $this->load->helper(array('url'));
        $this->load->database();
        date_default_timezone_set("Asia/Bangkok");
    }

	public function index(){
		if ($this->session->userdata('mem_id')){
            $page = ($this->uri->segment(4)) ? ($this->uri->segment(4) - 1) : 0;
			$config['per_page'] = $this->config->item('birth_count');
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

			$wheBirth['bir_member_id'] = $this->session->userdata('mem_id');
			$data['births'] = $this->birthModel->get_births($wheBirth, $page * $config['per_page'], $this->config->item('birth_count'))->result();

            $config['base_url'] = base_url().'/frontend/Births/index';
			$config['total_rows'] = $this->birthModel->get_births($wheBirth, $page * $config['per_page'], 0)->num_rows();
			$this->pagination->initialize($config);

			$data['keywords'] = '';
            $data['date'] = '';
            $this->session->set_userdata('keywords', '');
            $this->session->set_userdata('date', '');
			$this->load->view('frontend/view_births', $data);
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
			$config['per_page'] = $this->config->item('birth_count');
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
				$wheBirth['bir_date_of_birth'] = $date;
			}
			$wheBirth['bir_member_id'] = $this->session->userdata('mem_id');
			$like['can_sire.can_a_s'] = $data['keywords'];
			$like['can_dam.can_a_s'] = $data['keywords'];
			$data['births'] = $this->birthModel->search_births($like, $wheBirth, $page * $config['per_page'], $this->config->item('birth_count'))->result();

            $config['base_url'] = base_url().'/frontend/Births/search';
			$config['total_rows'] = $this->birthModel->search_births($like, $wheBirth, $page * $config['per_page'], 0)->num_rows();
			$this->pagination->initialize($config);
			$this->load->view('frontend/view_births', $data);
		}
		else{
			redirect('frontend/Members');
		}
    }

	public function view_approved(){
		if ($this->session->userdata('mem_id')){
			$wheBirth['bir_member_id'] = $this->session->userdata('mem_id');
			$wheBirth['bir_stat'] = $this->config->item('accepted');
			$data['births'] = $this->birthModel->get_births($wheBirth)->result();

            $data['stb'] = Array();
            $data['stat'] = Array();
			foreach ($data['births'] as $r){
				$whereStb = [];
				$whereStb['stb_bir_id'] = $r->bir_id;
				$whereStb['stb_stat != '] = $this->config->item('rejected');
				$data['stb'][] = $this->stambumModel->get_stambum($whereStb)->num_rows();

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
			$this->load->view('frontend/view_approved_births', $data);
		}
		else{
			redirect('frontend/Members');
		}
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
						$this->session->set_flashdata('error_message', 'Pelaporan lahir harus kurang dari '.$this->config->item('jarak_lapor_lahir').' hari dari waktu pacak'); 
					}
					else{
						$diff = floor($ts->diff($ts_stud)->days/$this->config->item('min_jarak_lapor_lahir'));
						if ($diff < 1){
							$err++;
							$this->session->set_flashdata('error_message', 'Pelaporan lahir harus lebih dari '.$this->config->item('min_jarak_lapor_lahir').' hari dari waktu pacak');
						}

						if (!$err){
							$diff = floor($ts->diff($ts_stud)->days/$this->config->item('jarak_lapor_lahir'));
							if ($diff > 1){
								$err++;
								$this->session->set_flashdata('error_message', 'Pelaporan lahir harus kurang dari '.$this->config->item('jarak_lapor_lahir').' hari dari waktu pacak');
							}
						}

						if (!$err){
							$data['bir_stu_id'] = $this->uri->segment(4);
							$data['mode'] = 0;
							$this->load->view('frontend/add_birth', $data);
						}
						else{
							redirect('frontend/Studs/view_approved');
						}
					}
				}
				else{
					if ($birth->bir_stat == $this->config->item('saved')){
						$this->session->set_flashdata('error_message', 'Lapor lahir sudah terdaftar dan belum diproses. Harap menghubungi Admin');
					}
					else{
						$this->session->set_flashdata('error_message', 'Lapor lahir sudah terdaftar');
					}
					redirect('frontend/Studs/view_approved');
				}
			}
			else{
				$this->session->set_flashdata('error_message', 'Lapor lahir tidak valid');
				redirect('frontend/Studs/view_approved');
			}
		}
		else
			redirect('frontend/Studs/view_approved');
	}

	public function validate_add(){
		if ($this->session->userdata('username')){
			$this->form_validation->set_error_delimiters('<div>','</div>');
			$this->form_validation->set_message('required', '%s wajib diisi');
			$this->form_validation->set_rules('bir_stu_id', 'Id Pacak ', 'trim|required');
			$this->form_validation->set_rules('bir_male', 'Jumlah Jantan ', 'trim|required');
			$this->form_validation->set_rules('bir_female', 'Jumlah Betina ', 'trim|required');
			$this->form_validation->set_rules('bir_date_of_birth', 'Tanggal lahir ', 'trim|required');

			$data['mode'] = 1;
			if ($this->form_validation->run() == FALSE){
				$this->load->view('frontend/add_birth', $data);
			}
			else{
				$wheBirth['bir_stu_id'] = $this->input->post('bir_stu_id');
				$wheBirth['bir_stat != '] = $this->config->item('rejected');
				$birth = $this->birthModel->get_births($wheBirth)->row();
				if (!$birth){
					$err = 0;
					if (!isset($_POST['attachment_dam']) || empty($_POST['attachment_dam'])){
						$err++;
						$this->session->set_flashdata('error_message', 'Foto wajib diisi');
					}
			
					$damPhoto = '-';
					if (!$err){
						$uploadedImg = $_POST['attachment_dam'];
						$image_array_1 = explode(";", $uploadedImg);
						$image_array_2 = explode(",", $image_array_1[1]);
						$uploadedImg = base64_decode($image_array_2[1]);

						if ((strlen($uploadedImg) > $this->config->item('file_size'))) {
							$err++;
							$data['error_message'] = 'Ukuran file terlalu besar (> 1 MB).<br/>';
						}
						else{
							$image_name = $this->config->item('path_birth').$this->config->item('file_name_birth');
							if (!is_dir($this->config->item('path_birth')) or !is_writable($this->config->item('path_birth'))) {
								$err++;
								$this->session->set_flashdata('error_message', 'Folder lahir tidak ditemukan atau tidak writeable.');
							} else{
								if (is_file($image_name) and !is_writable($image_name)) {
									$err++;
									$this->session->set_flashdata('error_message', 'File sudah ada dan tidak writeable.');
								}
							}
						}
					}

					if (!$err){
						// syarat maksimal 75 hari dari lapor pacak
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
								$this->session->set_flashdata('error_message', 'Pelaporan lahir harus kurang dari '.$this->config->item('jarak_lapor_lahir').' hari dari waktu pacak'); 
							}
							else{
								$diff = floor($ts->diff($ts_stud)->days/$this->config->item('min_jarak_lapor_lahir'));
								if ($diff < 1){
									$err++;
									$this->session->set_flashdata('error_message', 'Pelaporan lahir harus lebih dari '.$this->config->item('min_jarak_lapor_lahir').' hari dari waktu pacak');
								}

								if (!$err){
									$diff = floor($ts->diff($ts_stud)->days/$this->config->item('jarak_lapor_lahir'));
									if ($diff > 1){
										$err++;
										$this->session->set_flashdata('error_message', 'Pelaporan lahir harus kurang dari '.$this->config->item('jarak_lapor_lahir').' hari dari waktu pacak');
									}
								}
							}
						}
						else{
							$err++;
							$this->session->set_flashdata('error_message', 'Id pacak tidak valid'); 
						}
                    }

                    if (!$err){
                        file_put_contents($image_name, $uploadedImg);
                        $damPhoto = str_replace($this->config->item('path_birth'), '', $image_name);

                        $data = array(
                            'bir_stu_id' => $this->input->post('bir_stu_id'),
                            'bir_member_id' => $stud->stu_partner_id,
                            'bir_dam_photo' => $damPhoto,
                            'bir_male' => $this->input->post('bir_male'),
                            'bir_female' => $this->input->post('bir_female'),
                            'bir_date_of_birth' => $date,
                        );
                        $births = $this->birthModel->add_births($data);
                        if ($births){
                            $this->session->set_flashdata('add_success', true);
                            redirect("frontend/Births");
                        }
                        else{
                            $this->session->set_flashdata('error_message', 'Gagal menyimpan lahir');
                            $this->load->view('frontend/add_birth', $data);
                        }
                    }
                    else{
                        $this->load->view('frontend/add_birth', $data);
                    }
				}
				else{
					if ($birth->bir_stat == $this->config->item('saved')){
						$this->session->set_flashdata('error_message', 'Lapor lahir sudah terdaftar dan belum diproses. Harap menghubungi Admin');
					}
					else{
						$this->session->set_flashdata('error_message', 'Lapor lahir sudah terdaftar');
					}
					$this->load->view('frontend/add_birth', $data);
				}
			}
		}
		else{
			redirect("frontend/Members");
		}
	}
}