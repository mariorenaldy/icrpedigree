<?php

class Births extends CI_Controller {
    public function __construct(){
        // Call the CI_Controller constructor
        parent::__construct();
        $this->load->model(array('studModel', 'birthModel', 'caninesModel', 'memberModel', 'pedigreesModel', 'stambumModel'));
		$this->load->library('upload', $this->config->item('upload_birth'));
        $this->load->library(array('session', 'form_validation'));
        $this->load->helper(array('url'));
        $this->load->database();
        date_default_timezone_set("Asia/Bangkok");
    }

	public function index(){
		if ($this->session->userdata('mem_id')){
			$wheStud['stu_partner_id'] = $this->session->userdata('mem_id');
			$wheStud['stu_stat'] = $this->config->item('accepted');
			$stud = $this->studModel->get_studs($wheStud)->result();

			$data['births'] = Array();
			foreach ($stud AS $r){
				$wheBirth = [];
				$wheBirth['bir_stu_id'] = $r->stu_id;
				$data['births'][] = $this->birthModel->get_births($wheBirth)->row();
			}

			$data['stambum_stat'] = array();
			foreach ($data['births'] as $r){
				if ($r){
					$wheStbMale = [];
					$wheStbMale['stb_bir_id'] = $r->bir_id;
					$wheStbMale['stb_gender'] = 'MALE';
					$wheStbMale['stb_stat'] = $this->config->item('accepted');
					$male = $this->stambumModel->get_count($wheStbMale);

					$wheStbFemale = [];
					$wheStbFemale['stb_bir_id'] = $r->bir_id;
					$wheStbFemale['stb_gender'] = 'FEMALE';
					$wheStbFemale['stb_stat'] = $this->config->item('accepted');
					$female = $this->stambumModel->get_count($wheStbFemale);

					if ($male >= $r->bir_male || $female >= $r->bir_female){
						$data['stambum_stat'][] = 0;
					}
					else{
						$data['stambum_stat'][] = 1;
					}
				}
				else{
					$data['stambum_stat'][] = 0;
				}
			}
			$this->load->view('frontend/view_births', $data);
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
				$where['bir_date_of_birth'] = $date;
			}
			$where['stu_partner_id'] = $this->session->userdata('mem_id');
			$stud = $this->studModel->get_studs($wheStud)->result();

			$data['births'] = Array();
			foreach ($stud AS $r){
				$wheBirth = [];
				$wheBirth['bir_stu_id'] = $r->stu_id;
				$data['births'][] = $this->birthModel->get_births($wheBirth)->row();
			}

			$data['stambum_stat'] = array();
			foreach ($data['births'] as $r){
				if ($r){
					$wheStbMale = [];
					$wheStbMale['stb_bir_id'] = $r->bir_id;
					$wheStbMale['stb_gender'] = 'MALE';
					$wheStbMale['stb_stat'] = $this->config->item('accepted');
					$male = $this->stambumModel->get_count($wheStbMale);

					$wheStbFemale = [];
					$wheStbFemale['stb_bir_id'] = $r->bir_id;
					$wheStbFemale['stb_gender'] = 'FEMALE';
					$wheStbFemale['stb_stat'] = $this->config->item('accepted');
					$female = $this->stambumModel->get_count($wheStbFemale);

					if ($male >= $r->bir_male || $female >= $r->bir_female){
						$data['stambum_stat'][] = 0;
					}
					else{
						$data['stambum_stat'][] = 1;
					}
				}
				else{
					$data['stambum_stat'][] = 0;
				}
			}
			$this->load->view('frontend/view_births', $data);
		}
		else{
			redirect('frontend/Members');
		}
    }

	public function view_approved(){
		if ($this->session->userdata('mem_id')){
			$where['stu_partner_id'] = $this->session->userdata('mem_id');
			$where['stu_partner_id'] = $this->session->userdata('mem_id');
			$data['births'] = $this->birthModel->get_births($where)->result();
			$this->load->view('frontend/view_births', $data);
		}
		else{
			redirect('frontend/Members');
		}
    }

	public function add(){
		if ($this->uri->segment(4)){
			$data['bir_stu_id'] = $this->uri->segment(4);
			$data['mode'] = 0;
			$this->load->view('frontend/add_birth', $data);
		}
		else{
			redirect('frontend/Studs');
		}
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
				$err = 0;
				if (!isset($_POST['attachment_dam']) || empty($_POST['attachment_dam'])){
					$err++;
					$this->session->set_flashdata('error_message', 'Foto dam wajib diisi');
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
						$image_name = $this->config->item('path_birth').'birth_'.time().'.png';
						if (!is_dir($this->config->item('path_birth')) or !is_writable($this->config->item('path_birth'))) {
							$err++;
							$this->session->set_flashdata('error_message', 'Folder lahir tidak ditemukan atau tidak writeable.');
						} else{
							if (is_file($image_name) and !is_writable($image_name)) {
								$err++;
								$this->session->set_flashdata('error_message', 'File sudah ada dan tidak writeable.');
							}
						}

						if (!$err){
							file_put_contents($image_name, $uploadedImg);
							$damPhoto = str_replace($this->config->item('path_birth'), '', $image_name);
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
							$diff = floor($ts->diff($ts_stud)->days/$this->config->item('jarak_lapor_lahir'));
							if ($diff > 1){
								$err++;
								$this->session->set_flashdata('error_message', 'Pelaporan lahir harus kurang dari '.$this->config->item('jarak_lapor_lahir').' hari dari waktu pacak');
							}
						}
					}
					else{
						$err++;
						$this->session->set_flashdata('error_message', 'Id pacak tidak valid'); 
					}

					if (!$err){
						$data = array(
							'bir_stu_id' => $this->input->post('bir_stu_id'),
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
							$this->session->set_flashdata('error_message', 'Gagal menyimpan data lahir');
							$this->load->view('frontend/add_birth', $data);
						}
					}
					else{
						$this->load->view('frontend/add_birth', $data);
					}
				}
				else{
					$this->load->view('frontend/add_birth', $data);
				}
			}
		}
		else{
			redirect("frontend/Members");
		}
	}
}