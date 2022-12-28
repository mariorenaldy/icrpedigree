<?php

class Canines extends CI_Controller {
    public function __construct(){
        // Call the CI_Controller constructor
        parent::__construct();
        $this->load->model(array('caninesModel','memberModel', 'logcanineModel', 'requestModel', 'notification_model', 'notificationtype_model', 'pedigreesModel', 'trahModel', 'KennelModel'));
        $this->load->library('upload', $this->config->item('upload_canine'));
        $this->load->library(array('session', 'form_validation'));
        $this->load->helper(array('url'));
        $this->load->database();
        date_default_timezone_set("Asia/Bangkok");
    }

	public function index(){
		if ($this->session->userdata('mem_id')){
			$where['can_member_id'] = $this->session->userdata('mem_id');
			$data['canines'] = $this->caninesModel->get_canines($where)->result();
			$this->load->view('frontend/view_canines', $data);
		}
		else{
			redirect('frontend/Members');
		}
    }

    public function search(){
		if ($this->session->userdata('mem_id')){
			$like['can_a_s'] = $this->input->post('keywords');
			$like['can_icr_number'] = $this->input->post('keywords');
			$where['can_member_id'] = $this->session->userdata('mem_id');
			$data['canines'] = $this->caninesModel->search_canines($like, $where)->result();
			$this->load->view('frontend/view_canines', $data);
		}
		else{
			redirect('frontend/Members');
		}
    }

	public function add(){
		if ($this->session->userdata('username')){
			$data['trah'] = $this->trahModel->get_trah(null)->result();
			$whe['ken_member_id'] = $this->session->userdata('mem_id');
			$data['kennel'] = $this->KennelModel->get_kennels($whe)->result();
			$this->load->view('frontend/add_canine', $data);
		}
		else{
			redirect("frontend/Members");
		}
	}

	public function validate_add(){
		if ($this->session->userdata('username')){
			$this->form_validation->set_error_delimiters('<div>','</div>');
			$this->form_validation->set_message('required', '%s wajib diisi');
			$this->form_validation->set_rules('can_a_s', 'Nama ', 'trim|required');
			$this->form_validation->set_rules('can_reg_number', 'No. Registrasi ', 'trim|required');
			$this->form_validation->set_rules('can_color', 'Warna ', 'trim|required');
			$this->form_validation->set_rules('can_date_of_birth', 'Tanggal Lahir ', 'trim|required');
			
			$data['trah'] = $this->trahModel->get_all_trah()->result();
			$whe['ken_member_id'] = $this->session->userdata('mem_id');
			$data['kennel'] = $this->KennelModel->get_kennels($whe)->result();
			if ($this->form_validation->run() == FALSE){
				$this->load->view('frontend/add_canine', $data);
			}
			else{
				$err = 0;
				$photo = '-';
				if (!$err && isset($_FILES['attachment']) && !empty($_FILES['attachment']['tmp_name']) && is_uploaded_file($_FILES['attachment']['tmp_name'])){
					if (is_uploaded_file($_FILES['attachment']['tmp_name'])){
						$this->upload->initialize($this->config->item('upload_canine'));
						if ($this->upload->do_upload('attachment')){
							$uploadData = $this->upload->data();
							$photo = $uploadData['file_name'];
						}
						else{
							$err++;
							$this->session->set_flashdata('error_message', $this->upload->display_errors());
						}
					}
				}

				if (!$err && $photo == "-"){
					$err++;
					$this->session->set_flashdata('error_message', 'Foto wajib diisi');
				}
			
				if (!$err){
					$piece = explode("-", $this->input->post('can_date_of_birth'));
					$dob = $piece[2]."-".$piece[1]."-".$piece[0];
					
					$data = array(
						'can_member_id' => $this->session->userdata('mem_id'),
						'can_reg_number' => $this->input->post('can_reg_number'),
						'can_breed' => $this->input->post('can_breed'),
						'can_gender' => $this->input->post('can_gender'),
						'can_date_of_birth' => $dob,
						'can_color' => $this->input->post('can_color'),
						'can_kennel_id' => $this->input->post('can_kennel_id'),
						'can_reg_date' => date("Y/m/d"),
						'can_photo' => $photo
					);
		
					// nama diubah berdasarkan kennel
					$whereKennel['mem_id'] = $this->session->userdata('mem_id');
					$kennel = $this->KennelModel->get_kennels($whereKennel)->result();
					if ($kennel){
						if ($kennel[0]->ken_type_id == 1)
							$data['can_a_s'] = $this->input->post('can_a_s')." VON ".$kennel[0]->ken_name;
						else if ($kennel[0]->ken_type_id == 2)
							$data['can_a_s'] = $kennel[0]->ken_name."` ".$this->input->post('can_a_s');
					}
		
					if (!$err){
						$res = $this->caninesModel->check_can_a_s('', $data['can_a_s']);
						if ($res){
							$err++;
							$this->session->set_flashdata('error_message', 'Nama tidak boleh sama');
						}
					}
					
					if (!$err){
						$this->db->trans_strict(FALSE);
						$this->db->trans_start();
						$canines = $this->caninesModel->add_canines($data);
						if ($canines){
							$pedigree = $this->pedigreesModel->insert_pedigree($canines);
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
							$this->session->set_flashdata('error_message', 'Gagal menyimpan data anjing');
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
}