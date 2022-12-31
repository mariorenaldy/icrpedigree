<?php

class Births extends CI_Controller {
    public function __construct(){
        // Call the CI_Controller constructor
        parent::__construct();
        $this->load->model(array('studModel', 'birthModel', 'caninesModel', 'memberModel', 'trahModel', 'pedigreesModel'));
		$this->load->library('upload', $this->config->item('upload_birth'));
        $this->load->library(array('session', 'form_validation'));
        $this->load->helper(array('url'));
        $this->load->database();
        date_default_timezone_set("Asia/Bangkok");
    }

	public function index(){
		if ($this->session->userdata('mem_id')){
			$where['bir_member_id'] = $this->session->userdata('mem_id');
			$data['births'] = $this->birthModel->get_births($where)->result();
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
			$where['bir_member_id'] = $this->session->userdata('mem_id');
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
				$damPhoto = '-';
				if (!$err){
					if (isset($_FILES['attachment_dam']) && !empty($_FILES['attachment_dam']['tmp_name']) && is_uploaded_file($_FILES['attachment_dam']['tmp_name'])){
						$this->upload->initialize($this->config->item('upload_birth'));
						if ($this->upload->do_upload('attachment_dam')){
							$uploadData = $this->upload->data();
							$damPhoto = $uploadData['file_name'];
						}
						else{
							$err++;
							$this->session->set_flashdata('error_message', $this->upload->display_errors());
						}
					}
				}

				if (!$err && $damPhoto == "-"){
					$err++;
					$this->session->set_flashdata('error_message', 'Foto dam wajib diisi'); 
				}
					
				if (!$err){
					// syarat maksimal 75 hari dari lapor pacak
					$whereStud['stu_id'] = $this->input->post('bir_stu_id');
					$stud = $this->studModel->get_studs($whereStud)->row();
					if ($stud){
						$piece = explode("-", $this->input->post('bir_date_of_birth'));
						$date = $piece[2]."-".$piece[1]."-".$piece[0];
		
						$ts = new DateTime($date);
						$ts_stud = new DateTime($stud->stu_stud_date);
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
							'bir_member_id' => $this->session->userdata('mem_id'),
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