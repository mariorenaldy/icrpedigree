<?php

class Stambums extends CI_Controller {
    public function __construct(){
        // Call the CI_Controller constructor
        parent::__construct();
        $this->load->model(array('stambumModel', 'caninesModel','memberModel', 'notification_model', 'notificationtype_model', 'pedigreesModel', 'kennelModel', 'birthModel', 'studModel', 'logcanineModel', 'logpedigreeModel', 'logstambumModel'));
        $this->load->library('upload', $this->config->item('upload_canine'));
        $this->load->library(array('session', 'form_validation'));
        $this->load->helper(array('url', 'mail', 'notif'));
        $this->load->database();
        date_default_timezone_set("Asia/Bangkok");
    }

	public function test_input($data) {
		$data = trim($data);
		$data = stripslashes($data);
		$data = htmlspecialchars($data);
		return $data;
	}

	public function index(){
		if ($this->session->userdata('mem_id')){
			$where['stb_member_id'] = $this->session->userdata('mem_id');
			$data['stambum'] = $this->stambumModel->get_stambum($where, 'stb_a_s')->result();
			$this->load->view('frontend/view_stambums', $data);
		}
		else{
			redirect('frontend/Members');
		}
    }

    public function search(){
		if ($this->session->userdata('mem_id')){
			$like['stb_a_s'] = $this->input->post('keywords');
			$where['stb_member_id'] = $this->session->userdata('mem_id');
			$data['stambum'] = $this->stambumModel->get_stambum($where, 'stb_a_s')->result();
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
				$wheStud['stu_id'] = $data['birth']->bir_stu_id;
				$data['stud'] = $this->studModel->get_studs($wheStud)->row();
				$wheMember['mem_id IN ('.$data['stud']->stu_member_id.', '.$data['stud']->stu_partner_id.')'] = null;
				$data['member'] = $this->memberModel->get_members($wheMember)->result();
				$whe['ken_member_id'] =  $data['member'][0]->mem_id;
				$whe['ken_stat'] = $this->config->item('accepted');
				$data['kennel'] = $this->kennelModel->get_kennels($whe)->result();
				$data['kennel_id'] = $data['kennel'][0]->ken_id;
				$data['mode'] = 0;
				$this->load->view('frontend/add_stambum', $data);
			}
			else{
				redirect("frontend/Members");
			}
        }
        else{
          redirect("frontend/Stambums");
        }
    }

	public function validate_add(){ // butuh cek nama canine, no microchip, no icr
		if ($this->session->userdata('mem_id')){
			$this->form_validation->set_error_delimiters('<div>','</div>');
			$this->form_validation->set_message('required', '%s wajib diisi');
			$this->form_validation->set_rules('can_kennel_id', 'Kennel id ', 'trim|required');
			$this->form_validation->set_rules('can_a_s', 'Nama ', 'trim|required');
			// $this->form_validation->set_rules('can_reg_number', 'No. Registration ', 'trim|required');
			// $this->form_validation->set_rules('can_icr_number', 'ICR number ', 'trim|required');
			// $this->form_validation->set_rules('can_chip_number', 'No. Microchip ', 'trim');
			// $this->form_validation->set_rules('can_color', 'Warna ', 'trim|required');
			$this->form_validation->set_rules('can_date_of_birth', 'Tanggal Lahir ', 'trim|required');
			
			$data['trah'] = $this->trahModel->get_trah(null)->result();
			$whe['ken_member_id'] = $this->session->userdata('mem_id');
			$whe['ken_stat'] = $this->config->item('accepted');
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

				// if (!$err && $this->input->post('can_icr_number') != "-" && $this->caninesModel->check_for_duplicate(0, 'can_icr_number', $this->input->post('can_icr_number'))){
				// 	$err++;
				// 	$this->session->set_flashdata('error_message', 'No. ICR tidak boleh sama');
				// }

				// if (!$err && $this->input->post('can_chip_number') != "-" && $this->caninesModel->check_for_duplicate(0, 'can_chip_number', $this->input->post('can_chip_number'))){
				// 	$err++;
				// 	$this->session->set_flashdata('error_message', 'No. Microchip tidak boleh sama');
				// }

				if (!$err){
					$piece = explode("-", $this->input->post('can_date_of_birth'));
					$dob = $piece[2]."-".$piece[1]."-".$piece[0];
					
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
						$this->session->set_flashdata('error_message', 'Nama canine tidak boleh sama');
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
								// $this->session->set_flashdata('add_success', true);
								// redirect("frontend/Canines");
								$this->session->set_flashdata('add_canine_success', true);
								redirect("frontend/Beranda");
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
							$this->session->set_flashdata('error_message', 'Gagal menyimpan data canine');
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

	public function search_canine(){
		$data['canines'] = [];
		$data['kennel'] = [];
		$this->load->view('frontend/search_canine', $data);
    }

    public function validate_canine(){
		if ($this->session->userdata('mem_id')){
			$like['can_a_s'] = $this->input->post('can_a_s');
			$where['can_member_id'] = 0;
			$data['canines'] = $this->caninesModel->search_canines($like, $where)->result();

			$wheKennel['ken_member_id'] = $this->session->userdata('mem_id');
			$data['kennel'] = $this->KennelModel->get_kennels($wheKennel)->result();
			$this->load->view('frontend/search_canine', $data);
		}
		else{
			redirect("frontend/Members");
		}
    }

	public function validate_claim_canine(){
		if ($this->session->userdata('mem_id')){
			$like['can_a_s'] = $this->input->post('can_a_s');
			$where['can_member_id'] = 0;
			$data['canines'] = $this->caninesModel->search_canines($like, $where)->result();

			$wheKennel['ken_member_id'] = $this->session->userdata('mem_id');
			$data['kennel'] = $this->KennelModel->get_kennels($wheKennel)->result();

			$dataCanine = array(
				'can_stat' => $this->config->item('saved'),
				'can_app_user' => 0,
				'can_member_id' => $this->session->userdata('mem_id'),
				'can_kennel_id' => $this->input->post('ken_id'),
			);
			$wheCanine['can_id'] = $this->input->post('can_id');
			$res = $this->caninesModel->update_canines($dataCanine, $wheCanine);
			if ($res){
				$this->session->set_flashdata('claim_success', TRUE);
				redirect("frontend/Canines/search_canine");
			}
			else{
				$this->session->set_flashdata('error_message', 'Gagal menyimpan klaim canine');
				$this->load->view('frontend/search_canine', $data);
			}
		}
		else{
			redirect("frontend/Members");
		}
    }
}