<?php
defined('BASEPATH') OR exit('No direct script access allowed');

#[\AllowDynamicProperties]

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

	public function search_kennel(){
        if ($this->session->userdata('mem_id')) {
			$wheBirth['bir_id'] = $this->input->post('stb_bir_id');
			$data['birth'] = $this->birthModel->get_births($wheBirth)->row();
			$wheStud['stu_id'] = $data['birth']->bir_stu_id;
			$data['stud'] = $this->studModel->get_studs($wheStud)->row();
			$wheMember['mem_id IN ('.$data['stud']->stu_member_id.', '.$data['stud']->stu_partner_id.')'] = null;
			$data['member'] = $this->memberModel->get_members($wheMember)->result();
			$whe['ken_member_id'] =  $this->input->post('stb_member_id');
			$whe['ken_stat'] = $this->config->item('accepted');
			$data['kennel'] = $this->kennelModel->get_kennels($whe)->result();
			$data['kennel_id'] = $data['kennel'][0]->ken_id;
			$data['mode'] = 1;
			$this->load->view('frontend/add_stambum', $data);
        }
        else {
          redirect("frontend/Members");
        }
    }

	public function validate_add(){ 
		if ($this->session->userdata('mem_id')){
			$this->form_validation->set_error_delimiters('<div>','</div>');
			$this->form_validation->set_message('required', '%s wajib diisi');
			$this->form_validation->set_rules('stb_bir_id', 'Birth id ', 'trim|required');
			if ($this->input->post('reg_member')){
				$this->form_validation->set_rules('stb_member_id', 'Member id ', 'trim|required');
				$this->form_validation->set_rules('stb_kennel_id', 'Kennel id ', 'trim|required');
			}
			else{
				$this->form_validation->set_rules('name', 'Member name ', 'trim|required');
				$this->form_validation->set_rules('hp', 'Phone number ', 'trim|required');
				$this->form_validation->set_rules('email', 'email ', 'trim|required');
			}
			$this->form_validation->set_rules('stb_a_s', 'Canine name ', 'trim|required');
			
			$wheBirth['bir_id'] = $this->input->post('stb_bir_id');
			$data['birth'] = $this->birthModel->get_births($wheBirth)->row();
			$wheStud['stu_id'] = $data['birth']->bir_stu_id;
			$data['stud'] = $this->studModel->get_studs($wheStud)->row();
			$wheMember['mem_id IN ('.$data['stud']->stu_member_id.', '.$data['stud']->stu_partner_id.')'] = null;
			$data['member'] = $this->memberModel->get_members($wheMember)->result();
			$whe['ken_member_id'] =  $this->input->post('stb_member_id');
			$whe['ken_stat'] = $this->config->item('accepted');
			$data['kennel'] = $this->kennelModel->get_kennels($whe)->result();
			$data['kennel_id'] = $data['kennel'][0]->ken_id;
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

					$img_name = $this->config->item('path_canine').'canine_'.time().'.png';
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
				if ($this->input->post('stb_gender') == 'MALE'){
					$wheStbMale['stb_bir_id'] = $this->input->post('stb_bir_id');
					$wheStbMale['stb_gender'] = 'MALE';
					$wheStbMale['stb_stat'] = $this->config->item('accepted');
					$male = $this->stambumModel->get_count($wheStbMale);
					if ($male >= $data['birth']->bir_male){
						$err++;
						$this->session->set_flashdata('error_message', 'Male canine children is full');
					}
				}
				else{
					$wheStbFemale['stb_bir_id'] = $this->input->post('stb_bir_id');
					$wheStbFemale['stb_gender'] = 'FEMALE';
					$wheStbFemale['stb_stat'] = $this->config->item('accepted');
					$female = $this->stambumModel->get_count($wheStbFemale);
					if ($female >= $data['birth']->bir_female){
						$err++;
						$this->session->set_flashdata('error_message', 'Female canine child is full');
					}
				}

				$piece = explode("-", $data['birth']->bir_date_of_birth);
				$dob = $piece[2]."-".$piece[1]."-".$piece[0];

				$ts = new DateTime();
				$ts_birth = new DateTime($dob);
				if ($ts_birth > $ts){
					$err++;
					$this->session->set_flashdata('error_message', 'Pelaporan anak harus kurang dari '.$this->config->item('jarak_lapor_stb').' hari dari waktu lahir'); 
				}
				else{
					$diff = floor($ts->diff($ts_birth)->days/$this->config->item('jarak_lapor_stb'));
					if ($diff > 1){
						$err++;
						$this->session->set_flashdata('error_message', 'Pelaporan anak harus kurang dari '.$this->config->item('jarak_lapor_stb').' hari dari waktu lahir');
					}
				}

				$wheDam['can_id'] = $data['stud']->stu_dam_id;
				$dam = $this->caninesModel->get_canines($wheDam)->row();
				$wheKennel['mem_id'] = $data['stud']->stu_partner_id;
				$kennel = $this->memberModel->get_members($wheKennel)->row();

				$this->db->trans_strict(FALSE);
				$this->db->trans_start();
				if ($this->input->post('reg_member')){
					$wheMember['mem_id'] = $this->input->post('stb_member_id');
					$member = $this->memberModel->get_members($wheMember)->row();
				}
				else{
					$email = $this->test_input($this->input->post('email'));
					if (!$err && !filter_var($email, FILTER_VALIDATE_EMAIL)) {
						$err++;
						$this->session->set_flashdata('error_message', 'Invalid email format');
					}

					if (!$err && $this->memberModel->check_for_duplicate(0, 'mem_hp', $this->input->post('hp'))){
						$err++;
						$this->session->set_flashdata('error_message', 'Duplicate phone number');
					}

					if (!$err && $this->memberModel->check_for_duplicate(0, 'mem_email', $this->input->post('email'))){
						$err++;
						$this->session->set_flashdata('error_message', 'Duplicate email');
					}

					if (!$err){
						$mem_id = $this->memberModel->record_count() + 1;
						$member_data = array(
							'mem_id' => $mem_id,
							'mem_name' => strtoupper($this->input->post('name')),
							'mem_hp' => $this->input->post('hp'),
							'mem_email' => $this->input->post('email'),
							'mem_username' => $this->input->post('email'),
							'mem_password' => sha1($this->input->post('hp')),
							'mem_stat' => $this->config->item('accepted'),
							'mem_type' => $this->config->item('free_member'),
							'mem_user' => $this->session->userdata('use_id'),
							'mem_date' => date('Y-m-d H:i:s'),
						);
		
						$ken_id = $this->kennelModel->record_count() + 1;
						$kennel_data = array(
							'ken_id' => $ken_id,
							'ken_name' => '',
							'ken_type_id' => 0,
							'ken_photo' => '-',
							'ken_member_id' => $mem_id,
							'ken_stat' => $this->config->item('accepted'),
							'ken_user' => $this->session->userdata('use_id'),
							'ken_date' => date('Y-m-d H:i:s'),
						);
							
						$id = $this->memberModel->add_members($member_data);
						if ($id){
							$res = $this->kennelModel->add_kennels($kennel_data);
							if ($res){
								$result = $this->notification_model->add(17, $mem_id, $mem_id);
								if (!$result){
									$err = 'M1';
								}
							}
							else{
								$err = 'M2';
							}
						}
						else{
							$err = 'M3';
						}
					}
				}

				if (!$err){
					$id = $this->caninesModel->record_count() + 895; // gara2 data canine dihapus
					$dataCan = array(
						'can_id' => $id,
						'can_reg_number' => '-', 
						'can_breed' => $dam->can_breed,
						'can_gender' => $this->input->post('stb_gender'),
						'can_date_of_birth' => $dob,
						'can_color' => '-', 
						'can_reg_date' => date("Y/m/d"),
						'can_photo' => $photo,
						'can_chip_number' => '-', 
						'can_icr_number' => '-', 
						'can_stat' => $this->config->item('rejected'),
						'can_note' => '',
						'can_user' => 0,
						'can_date' => date('Y-m-d H:i:s'),
					);
		
					// nama diubah berdasarkan kennel
					if ($kennel->ken_type_id == 1)
						$dataCan['can_a_s'] = strtoupper($this->input->post('stb_a_s'))." VON ".$kennel->ken_name;
					else if ($kennel->ken_type_id == 2)
						$dataCan['can_a_s'] = $kennel->ken_name."` ".strtoupper($this->input->post('stb_a_s'));
					else 
						$dataCan['can_a_s'] = strtoupper($this->input->post('stb_a_s'));

					if (!$err && $this->caninesModel->check_for_duplicate(0, 'can_a_s', $dataCan['can_a_s'])){
						$err++;
						$this->session->set_flashdata('error_message', 'Duplicate canine name');
					}
		
					if (!$err){
						$dataStb = array(
							'stb_bir_id' => $this->input->post('stb_bir_id'),
							'stb_a_s' => $dataCan['can_a_s'],
							'stb_breed' => $dam->can_breed,
							'stb_gender' => $this->input->post('stb_gender'),
							'stb_date_of_birth' => $dob,
							'stb_reg_date' => date("Y/m/d"),
							'stb_photo' => $photo,
							'stb_stat' => $this->config->item('saved'),
							'stb_user' => 0,
							'stb_date' => date('Y-m-d H:i:s'),
							'stb_can_id' => $id,
						);

						if ($this->input->post('reg_member')){
							$dataCan['can_member_id'] = $this->input->post('stb_member_id');
							$dataCan['can_kennel_id'] = $this->input->post('stb_kennel_id');
							$dataStb['stb_member_id'] = $this->input->post('stb_member_id');
							$dataStb['stb_kennel_id'] = $this->input->post('stb_kennel_id');
						}
						else{
							$dataCan['can_member_id'] = $mem_id;
							$dataCan['can_kennel_id'] = $ken_id;
							$dataStb['stb_member_id'] = $mem_id;
							$dataStb['stb_kennel_id'] = $ken_id;
						}

						$dataPed = array(
							'ped_sire_id' => $data['stud']->stu_sire_id,
							'ped_dam_id' => $data['stud']->stu_dam_id,
							'ped_canine_id' => $id,
						);

						$canines = $this->caninesModel->add_canines($dataCan);
						if ($canines){
							$pedigree = $this->pedigreesModel->add_pedigrees($dataPed);
							if ($pedigree){
								$result = $this->stambumModel->add_stambum($dataStb);
								if ($result){
									if ($this->input->post('reg_member')){
										$res = $this->notification_model->add(18, $result, $this->input->post('stb_member_id'));
										if ($res){
											$this->db->trans_complete();
											if ($member->mem_firebase_token){
												$notif = $this->notificationtype_model->get_by_id(18);
												firebase_notif($member->mem_firebase_token, $notif[0]->title, $notif[0]->description);
											}
											$this->session->set_flashdata('add_success', true);
											redirect("frontend/Stambums");
										}
										else{
											$err = 1;
										}
									}
									else{
										$res = $this->notification_model->add(18, $result, $mem_id);
										if ($res){
											$this->db->trans_complete();
											$mail = send_greeting($this->input->post('email'));
											$this->session->set_flashdata('add_success', true);
											redirect("frontend/Stambums");
										}
										else{
											$err = 1;
										}
									}
								}
								else{
									$err = 2;
								}
							}
							else{
								$err = 3;
							}
						}
						else{
							$err = 4;
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
}