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
        $this->load->helper(array('url'));
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
        $page = ($this->uri->segment(4)) ? ($this->uri->segment(4) - 1) : 0;
        $config['per_page'] = $this->config->item('backend_stb_count');
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
        $config['cur_tag_open'] = '<li class="active"><a class="page-link bg-primary text-light border-primary" href="#">';
        $config['cur_tag_close'] = '</a></li>';

        $config['attributes'] = array('class' => 'page-link bg-light text-primary');

        $where['stb_stat'] = $this->config->item('accepted');
        $where['kennels.ken_stat'] = $this->config->item('accepted');
        $data['stambum'] = $this->stambumModel->get_stambum($where, 'stb_id desc', $page * $config['per_page'], $this->config->item('backend_stb_count'))->result();

        $config['base_url'] = base_url().'/backend/Stambums/index';
        $config['total_rows'] = $this->stambumModel->get_stambum($where, 'stb_id desc', $page * $config['per_page'], 0)->num_rows();
        $this->pagination->initialize($config);

        $data['keywords'] = '';
        $data['sort_by'] = 'stb_id';
        $data['sort_type'] = 'desc';
        $this->session->set_userdata('keywords', '');
        $this->session->set_userdata('keywords', 'stb_id');
        $this->session->set_userdata('keywords', 'desc');
        $this->load->view('backend/view_stambums', $data);
    }

    public function search(){
        if ($this->input->post('keywords')){
            $this->session->set_userdata('keywords', $this->input->post('keywords'));
            $data['keywords'] = $this->input->post('keywords');
        }
        else{
            if ($this->uri->segment(4)){
                $data['keywords'] = $this->session->userdata('keywords');
            }
            else{
                $this->session->set_userdata('keywords', '');
                $data['keywords'] = '';
            }
        }

        if ($this->input->post('sort_by')){
            $this->session->set_userdata('sort_by', $this->input->post('sort_by'));
            $this->session->set_userdata('sort_type', $this->input->post('sort_type'));
            $data['sort_by'] = $this->input->post('sort_by');
            $data['sort_type'] = $this->input->post('sort_type');
        }
        else{
            $data['sort_by'] = $this->session->userdata('sort_by');
            $data['sort_type'] = $this->session->userdata('sort_type');
        }

        $page = ($this->uri->segment(4)) ? ($this->uri->segment(4) - 1) : 0;
        $config['per_page'] = $this->config->item('backend_stb_count');
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
        $config['cur_tag_open'] = '<li class="active"><a class="page-link bg-primary text-light border-primary" href="#">';
        $config['cur_tag_close'] = '</a></li>';

        $config['attributes'] = array('class' => 'page-link bg-light text-primary');

        if ($data['keywords']){
            $like['stb_a_s'] = $data['keywords'];
            $like['ken_name'] = $data['keywords'];
        }
        else  
            $like = null;
        $where['stb_stat'] = $this->config->item('accepted');
        $where['kennels.ken_stat'] = $this->config->item('accepted');
        $data['stambum'] = $this->stambumModel->search_stambum($like, $where, 'stb_a_s', $page * $config['per_page'], $this->config->item('backend_stb_count'))->result();

        $config['base_url'] = base_url().'/backend/Stambums/search';
        $config['total_rows'] = $this->stambumModel->search_stambum($like, $where, $page * $config['per_page'], 0)->num_rows();
        $this->pagination->initialize($config);
        $this->load->view('backend/view_stambums', $data);
    }

    public function view_approve(){
        $where['stb_stat'] = $this->config->item('saved');
        $where['kennels.ken_stat'] = $this->config->item('accepted');
        $data['stambum'] = $this->stambumModel->get_stambum($where, 'stb_id desc')->result();
        $this->load->view('backend/approve_stambums', $data);
    }
    
    public function search_approve(){
        $like['stb_a_s'] = $this->input->post('keywords');
        $like['ken_name'] = $this->input->post('keywords');
        $where['stb_stat'] = $this->config->item('saved');
        $where['kennels.ken_stat'] = $this->config->item('accepted');
        $data['stambum'] = $this->stambumModel->search_stambum($like, $where, 'stb_id desc')->result();
        $this->load->view('backend/approve_stambums', $data);
		}

    public function add(){
        if ($this->uri->segment(4)){  
            if ($this->session->userdata('use_id')){
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
							$this->session->set_flashdata('error_message', 'Puppy must be reported before '.$this->config->item('jarak_lapor_anak').' days from birth'); 
						}
						else{
							$diff = floor($ts->diff($ts_birth)->days/$this->config->item('min_jarak_lapor_anak'));
							if ($diff < 1){
								$err++;
								$this->session->set_flashdata('error_message', 'Puppy must be reported after '.$this->config->item('min_jarak_lapor_anak').' days from birth');
							}

							$diff = floor($ts->diff($ts_birth)->days/$this->config->item('jarak_lapor_anak'));
							if ($diff > 1){
								$err++;
								$this->session->set_flashdata('error_message', 'Puppy must be reported before '.$this->config->item('jarak_lapor_anak').' days from birth');
							}
						}

						if (!$err){
							$wheStud['stu_id'] = $data['birth']->bir_stu_id;
                            $data['stud'] = $this->studModel->get_studs($wheStud)->row();
                            $wheMember['mem_id IN ('.$data['stud']->stu_member_id.', '.$data['stud']->stu_partner_id.')'] = null;
                            $data['member'] = $this->memberModel->get_members($wheMember)->result();
                            $whe['ken_member_id'] =  $data['member'][0]->mem_id;
                            $whe['ken_stat'] = $this->config->item('accepted');
                            $data['kennel'] = $this->kennelModel->get_kennels($whe)->result();
                            $data['kennel_id'] = $data['kennel'][0]->ken_id;
                            $data['mode'] = 0;
                            $this->load->view('backend/add_stambum', $data);
						}
						else{
							redirect("backend/Births");
						}
					}
					else{
						if ($stb->stb_stat == $this->config->item('saved')){
							$this->session->set_flashdata('error_message', 'The puppy report is already registered and has not been processed');
						}
						else{
							$this->session->set_flashdata('error_message', 'The puppy report is already registered');
						}
						redirect('backend/Births');
					}
				}
				else {
					$this->session->set_flashdata('error_message', 'Invalid birth');
					redirect("backend/Births");
				}
            }
            else{
                redirect("backend/Users/login");
            }
        }
        else{
            redirect("backend/Births");
        }
    }

    public function add_more(){
        if ($this->uri->segment(4)){  
			if ($this->session->userdata('use_id')){
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
				$this->load->view('backend/add_stambum', $data);
			}
			else{
				redirect("backend/Users/login");
			}
        }
        else{
			redirect("backend/Births");
        }
    }

    public function search_member(){
        if ($this->session->userdata('use_id')) {
            $like['mem_name'] = $this->input->post('mem_name');
            $like['ken_name'] = $this->input->post('mem_name');
            $where['mem_stat'] = $this->config->item('accepted');
            $where['ken_stat'] = $this->config->item('accepted');
            $data['member'] = $this->memberModel->search_members($like, $where)->result();

            if ($data['member']){
                $whe['ken_member_id'] = $data['member'][0]->mem_id;
                $whe['ken_stat'] = $this->config->item('accepted');
                $data['kennel'] = $this->kennelModel->get_kennels($whe)->result();
                if ($data['kennel'])
                    $data['kennel_id'] = $data['kennel'][0]->ken_id;
                else
                    $data['kennel_id'] = 0;
            }
            else{
                $data['kennel'] = [];
                $data['kennel_id'] = 0;
            }
            $data['mode'] = 1;
            $this->load->view('backend/add_stambum', $data);
      }
      else {
        redirect("backend/Users/login");
      }
    }

    public function search_kennel(){
        if ($this->session->userdata('use_id')) {
            $like['mem_name'] = $this->input->post('mem_name');
            $like['ken_name'] = $this->input->post('mem_name');
            $where['mem_stat'] = $this->config->item('accepted');
            $where['ken_stat'] = $this->config->item('accepted');
            $data['member'] = $this->memberModel->search_members($like, $where)->result();

            $whe['ken_member_id'] =  $this->input->post('stb_member_id');
            $whe['ken_stat'] = $this->config->item('accepted');
            $data['kennel'] = $this->kennelModel->get_kennels($whe)->result();
            if ($data['kennel'])
                $data['kennel_id'] = $data['kennel'][0]->ken_id;
            else
                $data['kennel_id'] = 0;
            $data['mode'] = 1;
            $this->load->view('backend/add_stambum', $data);
        }
        else {
            redirect("backend/Users/login");
        }
    }
  
    public function validate_add(){ 
        if ($this->session->userdata('use_id')) {
            $this->form_validation->set_error_delimiters('<div>', '</div>');
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
            
            $like['mem_name'] = $this->input->post('mem_name');
            $like['ken_name'] = $this->input->post('mem_name');
            $where['mem_stat'] = $this->config->item('accepted');
            $where['ken_stat'] = $this->config->item('accepted');
            $data['member'] = $this->memberModel->search_members($like, $where)->result();

            $whe['ken_member_id'] =  $this->input->post('stb_member_id');
            $whe['ken_stat'] = $this->config->item('accepted');
            $data['kennel'] = $this->kennelModel->get_kennels($whe)->result();
            if ($data['kennel'])
                $data['kennel_id'] = $data['kennel'][0]->ken_id;
            else
                $data['kennel_id'] = 0;
            $data['mode'] = 1;
                
            if ($this->form_validation->run() == FALSE) {
                $this->load->view('backend/add_stambum', $data);
            } else {
                $err = 0;
                if (!isset($_POST['attachment']) || empty($_POST['attachment'])){
                    $err++;
                    $this->session->set_flashdata('error_message', 'Photo is required');
                }
        
                $photo = '-';
                if (!$err){
                    $uploadedImg = $_POST['attachment'];
                    $image_array_1 = explode(";", $uploadedImg);
                    $image_array_2 = explode(",", $image_array_1[1]);
                    $uploadedImg = base64_decode($image_array_2[1]);
            
                    if ((strlen($uploadedImg) > $this->config->item('file_size'))) {
                        $err++;
                        $this->session->set_flashdata('error_message', 'The file size is too big (> 1 MB).');
                    }
            
                    $img_name = $this->config->item('path_canine').$this->config->item('file_name_canine');
                    if (!is_dir($this->config->item('path_canine')) or !is_writable($this->config->item('path_canine'))) {
                        $err++;
                        $this->session->set_flashdata('error_message', 'canine folder not found or not writable.');
                    } else{
                        if (is_file($img_name) and !is_writable($img_name)) {
                        $err++;
                        $this->session->set_flashdata('error_message', 'File already exists and not writable.');
                        }
                    }
                }

                // cek jumlah male & female
                $wheBirth['bir_id'] = $this->input->post('stb_bir_id');
                $birth = $this->birthModel->get_births($wheBirth)->row();

                $wheStbMale['stb_bir_id'] = $this->input->post('stb_bir_id');
                $wheStbMale['stb_gender'] = 'MALE';
                $wheStbMale['stb_stat'] = $this->config->item('accepted');
                $male = $this->stambumModel->get_count($wheStbMale);

                $wheStbFemale['stb_bir_id'] = $this->input->post('stb_bir_id');
                $wheStbFemale['stb_gender'] = 'FEMALE';
                $wheStbFemale['stb_stat'] = $this->config->item('accepted');
                $female = $this->stambumModel->get_count($wheStbFemale);

                $maleFull = 0; 
                $femaleFull = 0;
                if ($this->input->post('stb_gender') == 'MALE'){
                    if ($male >= $birth->bir_male){
                        $err++;
                        $this->session->set_flashdata('error_message', 'Male puppy is full');
                    }
                    if ($male+1 == $birth->bir_male){
                        $maleFull = 1;
                    }
                    if ($female == $birth->bir_female){
                        $femaleFull = 1;
                    }
                }
                else{
                    if ($female >= $birth->bir_female){
                        $err++;
                        $this->session->set_flashdata('error_message', 'Female puppy is full');
                    }
                    if ($male == $birth->bir_male){
                        $maleFull = 1;
                    }
                    if ($female+1 == $birth->bir_female){
                        $femaleFull = 1;
                    }
                }

                if (!$err && !$this->input->post('mode')){
                    $data['warning'] = Array();
					$piece = explode("-", $birth->bir_date_of_birth);
					$dob = $piece[2]."-".$piece[1]."-".$piece[0];

					$ts = new DateTime();
					$ts_birth = new DateTime($dob);
					if ($ts_birth > $ts){
						$err++;
						$data['warning'][] = 'The puppy report must be less than '.$this->config->item('jarak_lapor_anak').' days after birth date'; 
					}
					else{
						$diff = floor($ts->diff($ts_birth)->days/$this->config->item('min_jarak_lapor_anak'));
						if ($diff < 1){
							$err++;
							$data['warning'][] = 'The puppy report must be more than '.$this->config->item('min_jarak_lapor_anak').' days after birth date';
						}

						$diff = floor($ts->diff($ts_birth)->days/$this->config->item('jarak_lapor_anak'));
						if ($diff > 1){
							$err++;
							$data['warning'][] = 'The puppy report must be less than '.$this->config->item('jarak_lapor_anak').' days after birth date';
						}
					}
				}

                if (!$err) {
                    $wheStud['stu_id'] = $birth->bir_stu_id;
                    $stud = $this->studModel->get_studs($wheStud)->row();
                    $wheDam['can_id'] = $stud->stu_dam_id;
                    $dam = $this->caninesModel->get_canines($wheDam)->row();
                    $wheKennel['mem_id'] = $stud->stu_partner_id;
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
                        file_put_contents($img_name, $uploadedImg);
                        $photo = str_replace($this->config->item('path_canine'), '', $img_name);
                        
                        $piece = explode("-", $birth->bir_date_of_birth);
                        $dob = $piece[2] . "-" . $piece[1] . "-" . $piece[0];

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
                            'can_stat' => $this->config->item('accepted'),
                            'can_app_user' => $this->session->userdata('use_id'),
                            'can_app_date' => date('Y-m-d H:i:s'),
                            'can_chip_number' => '-',
                            'can_icr_number' => '-',
                            'can_note' => '',
                            'can_user' => $this->session->userdata('use_id'),
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

                        if (!$err) {
                            $dataLog = array(
                                'log_canine_id' => $id,
                                'log_reg_number' => '-',
                                'log_a_s' => $dataCan['can_a_s'],
                                'log_breed' => $dam->can_breed,
                                'log_gender' => $this->input->post('stb_gender'),
                                'log_date_of_birth' => $dob,
                                'log_color' => '-',
                                'log_photo' => $photo,
                                'log_stat' => $this->config->item('accepted'),
                                'log_app_user' => $this->session->userdata('use_id'),
                                'log_app_date' => date('Y-m-d H:i:s'),
                                'log_chip_number' => '-',
                                'log_icr_number' => '-',
                                'log_note' => '',
                                'log_user' => $this->session->userdata('use_id'),
                                'log_date' => date('Y-m-d H:i:s'),
                            );
        
                            $dataStb = array(
                                'stb_bir_id' => $this->input->post('stb_bir_id'),
                                'stb_a_s' => $dataCan['can_a_s'],
                                'stb_breed' => $dam->can_breed,
                                'stb_gender' => $this->input->post('stb_gender'),
                                'stb_date_of_birth' => $dob,
                                'stb_reg_date' => date("Y/m/d"),
                                'stb_photo' => $photo,
                                'stb_stat' => $this->config->item('accepted'),
                                'stb_app_user' => $this->session->userdata('use_id'),
                                'stb_app_date' => date('Y-m-d H:i:s'),
                                'stb_user' => $this->session->userdata('use_id'),
                                'stb_date' => date('Y-m-d H:i:s'),
                                'stb_can_id' => $id,
                            );
        
                            $dataLogStb = array(
                                'log_bir_id' => $this->input->post('stb_bir_id'),
                                'log_a_s' => $dataCan['can_a_s'],
                                'log_breed' => $dam->can_breed,
                                'log_gender' => $this->input->post('stb_gender'),
                                'log_date_of_birth' => $dob,
                                'log_photo' => $photo,
                                'log_stat' => $this->config->item('accepted'),
                                'log_app_user' => $this->session->userdata('use_id'),
                                'log_app_date' => date('Y-m-d H:i:s'),
                                'log_user' => $this->session->userdata('use_id'),
                                'log_date' => date('Y-m-d H:i:s'),
                                'log_can_id' => $id,
                            );

                            if ($this->input->post('reg_member')){
                                $dataCan['can_member_id'] = $this->input->post('stb_member_id');
                                $dataCan['can_kennel_id'] = $this->input->post('stb_kennel_id');
                                $dataLog['log_member_id'] = $this->input->post('stb_member_id');
                                $dataLog['log_kennel_id'] = $this->input->post('stb_kennel_id');
                                $dataStb['stb_member_id'] = $this->input->post('stb_member_id');
                                $dataStb['stb_kennel_id'] = $this->input->post('stb_kennel_id');
                                $dataLogStb['log_member_id'] = $this->input->post('stb_member_id');
                                $dataLogStb['log_kennel_id'] = $this->input->post('stb_kennel_id');
                            }
                            else{
                                $dataCan['can_member_id'] = $mem_id;
                                $dataCan['can_kennel_id'] = $ken_id;
                                $dataLog['log_member_id'] = $mem_id;
                                $dataLog['log_kennel_id'] = $ken_id;
                                $dataStb['stb_member_id'] = $mem_id;
                                $dataStb['stb_kennel_id'] = $ken_id;
                                $dataLogStb['log_member_id'] = $mem_id;
                                $dataLogStb['log_kennel_id'] = $ken_id;
                            }

                            $dataPed = array(
                                'ped_sire_id' => $stud->stu_sire_id,
                                'ped_dam_id' => $stud->stu_dam_id,
                                'ped_canine_id' => $id,
                            );
            
                            $dataLogPed = array(
                                'log_sire_id' => $stud->stu_sire_id,
                                'log_dam_id' => $stud->stu_dam_id,
                                'log_canine_id' => $id,
                                'log_user' => $this->session->userdata('use_id'),
                                'log_date' => date('Y-m-d H:i:s'),
                            );

                            $canines = $this->caninesModel->add_canines($dataCan);
                            if ($canines) {
                                $pedigree = $this->pedigreesModel->add_pedigrees($dataPed);
                                if ($pedigree) {
                                    $log = $this->logcanineModel->add_log($dataLog);
                                    if ($log){
                                        $res = $this->logpedigreeModel->add_log($dataLogPed);
                                        if ($res){
                                            $result = $this->stambumModel->add_stambum($dataStb);
                                            if ($result){
                                                $dataLogStb['log_stb_id'] = $result;
                                                $log = $this->logstambumModel->add_log($dataLogStb);
                                                if ($log){
                                                    if ($maleFull && $femaleFull){
                                                        $dataBirth['bir_stat'] = $this->config->item('completed');
                                                        $bir = $this->birthModel->update_births($dataBirth, $wheBirth);
                                                        if (!$bir){
                                                            $err = 1;
                                                        } 
                                                    }

                                                    if (!$err){
                                                        if ($this->input->post('reg_member')){
                                                            $result = $this->notification_model->add(18, $result, $this->input->post('stb_member_id'), "Nama anjing / Canine name: ".$dataCan['can_a_s']."<br>Nama jantan / Sire name: ".$stud->sire_a_s.'<br>Nama betina / Dam name: '.$stud->dam_a_s);
                                                            if ($result){
                                                                $this->db->trans_complete();
                                                                $this->session->set_flashdata('add_success', true);
                                                                if ($maleFull && $femaleFull)
                                                                    redirect("backend/Stambums");
                                                                else // tambah anak lg
                                                                    redirect("backend/Stambums/add_more/".$this->input->post('stb_bir_id'));
                                                            }
                                                            else{
                                                                $err = 2;
                                                            }
                                                        }
                                                        else{
                                                            $result = $this->notification_model->add(18, $result, $mem_id, "Nama anjing / Canine name: ".$dataCan['can_a_s']."<br>Nama jantan / sire name: ".$stud->sire_a_s.'<br>Nama betina / Dam name: '.$stud->dam_a_s);
                                                            if ($result){
                                                                $this->db->trans_complete();
                                                                $this->session->set_flashdata('add_success', true);
                                                                if ($maleFull && $femaleFull)
                                                                    redirect("backend/Stambums");
                                                                else // tambah anak lg
                                                                    redirect("backend/Stambums/add_more/".$this->input->post('stb_bir_id'));
                                                            }
                                                            else{
                                                                $err = 2;
                                                            }
                                                        }
                                                    }
                                                }
                                                else{
                                                    $err = 3;
                                                }
                                            }
                                            else{
                                                $err = 4;
                                            }
                                        }
                                        else{
                                            $err = 5;
                                        }
                                    }
                                    else{
                                        $err = 6;
                                    }
                                } else {
                                    $err = 7;
                                }
                            } else {
                                $err = 8;
                            }
                            if ($err) {
                                $this->db->trans_rollback();
                                $this->session->set_flashdata('error_message', 'Failed to save puppy. Error code: '.$err);
                                $this->load->view('backend/add_stambum', $data);
                            }
                        } else {
                            $this->load->view('backend/add_stambum', $data);
                        }
                    }
                    else{
                        $this->load->view('backend/add_stambum', $data);
                    }
                } else {
                    $this->load->view('backend/add_stambum', $data);
                }
            }
        } 
        else {
            redirect("backend/Users/login");
        }
    }

    public function cancel_all(){
        if ($this->uri->segment(4)){  
			if ($this->session->userdata('use_id')){
				$wheBirth['bir_id'] = $this->uri->segment(4);
				$data['birth'] = $this->birthModel->get_births($wheBirth)->row();

				if ($data['birth']->bir_stat == $this->config->item('accepted')){ 
					$whereStb['stb_bir_id'] = $this->uri->segment(4);
					$dataStb = array(
						'stb_stat' => $this->config->item('rejected'),
						'stb_user' => 0,
						'stb_date' => date('Y-m-d H:i:s'),
					);

                    $this->db->trans_strict(FALSE);
					$this->db->trans_start();
                    $err = 0;
					$res = $this->stambumModel->update_stambum($dataStb, $whereStb);
					if ($res){
                        $where['log_stb_id'] = $this->uri->segment(4);
                        $data = array(
                            'log_stat' => $this->config->item('rejected'),
                            'log_user' => 0,
                            'log_date' => date('Y-m-d H:i:s'),
                        );
                        $log = $this->logstambumModel->update_log($data, $where);
                        if ($log){
                            $stbs = $this->stambumModel->get_stambum($whereStb)->result();
                            foreach ($stbs AS $stb){
                                $whe = Array();
                                $whe['can_id'] = $stb->stb_can_id;
                                $dataCan = array(
                                    'can_stat' => $this->config->item('rejected'),
                                    'can_user' => 0,
                                    'can_date' => date('Y-m-d H:i:s'),
                                );
                                $res = $this->caninesModel->update_canines($dataCan, $whe);
                                if ($res){
                                    $dataLog = array(
                                        'log_canine_id' => $stb->stb_can_id,
                                        'log_stat' => $this->config->item('rejected'),
                                        'log_user' => 0,
                                        'log_date' => date('Y-m-d H:i:s'),
                                    );
                                    $log = $this->logcanineModel->add_log($dataLog);
                                    if (!$log){
                                        $err = 1;
                                    }
                                }
                                else{
                                    $err = 2;
                                }
                            }
                        }
                        else{
                            $err = 3;
                        }
                    }
                    else{
                        $err = 4;
                    }
                    if (!$err)
                        $this->db->trans_complete();
                    else{
                        $this->db->trans_rollback();
						$this->session->set_flashdata('error_message', 'Failed to save puppy report. Err code: '.$err);
					}
                    redirect("backend/Stambums");
				}
			}
			else{
				redirect("backend/Users/login");
			}
        }
        else{
			redirect("backend/Stambums");
        }
    }

    public function force_complete(){
        if ($this->uri->segment(4)){  
			if ($this->session->userdata('use_id')){
				$wheBirth['bir_id'] = $this->uri->segment(4);
				$data['birth'] = $this->birthModel->get_births($wheBirth)->row();

				if ($data['birth']->bir_stat == $this->config->item('accepted')){ 
					$dataBirth = array(
						'bir_stat' => $this->config->item('completed'),
						'bir_user' => $this->config->item('system'),
						'bir_date' => date('Y-m-d H:i:s'),
					);
					$res = $this->birthModel->update_births($dataBirth, $wheBirth);
					if (!$res){
                        $this->session->set_flashdata('error_message', 'Failed to save puppy report.');
					}
                    redirect("backend/Stambums");
				}
			}
			else{
				redirect("backend/Users/login");
			}
        }
        else{
			redirect("backend/Stambums");
        }
    }

    public function approve(){
        if ($this->uri->segment(4)){
            if ($this->session->userdata('use_id')){
                $err = 0;
                $whereStb['stb_id'] = $this->uri->segment(4);
                $stb = $this->stambumModel->get_stambum($whereStb)->row();
                
                $piece = explode("-", $stb->stb_date_of_birth);
                $dob = $piece[2] . "-" . $piece[1] . "-" . $piece[0];

                $this->db->trans_strict(FALSE);
                $this->db->trans_start();
                $id = $this->caninesModel->record_count() + 895; // gara2 data canine dihapus
                $dataCan = array(
                    'can_id' => $id,
                    'can_a_s' => $stb->stb_a_s,
                    'can_reg_number' => '-', 
                    'can_breed' => $stb->stb_breed,
                    'can_gender' => $stb->stb_gender,
                    'can_date_of_birth' => $dob,
                    'can_color' => '-', 
                    'can_reg_date' => date("Y/m/d"),
                    'can_photo' => $stb->stb_photo,
                    'can_chip_number' => '-', 
                    'can_icr_number' => '-', 
                    'can_stat' => $this->config->item('accepted'),
                    'can_note' => '',
                    'can_user' => $this->session->userdata('use_id'),
                    'can_date' => date('Y-m-d H:i:s'),
                    'can_app_user' => $this->session->userdata('use_id'),
                    'can_app_date' => date('Y-m-d H:i:s'),
                    'can_member_id' => $stb->stb_member_id,
                    'can_kennel_id' => $stb->stb_kennel_id,
                );
                $canines = $this->caninesModel->add_canines($dataCan);
                if ($canines){
                    $dataStb = array(
                        'stb_can_id' => $id,
                        'stb_stat' => $this->config->item('accepted'),
                        'stb_app_user' => $this->session->userdata('use_id'),
                        'stb_app_date' => date('Y-m-d H:i:s'),
                        'stb_user' => $this->session->userdata('use_id'),
                        'stb_date' => date('Y-m-d H:i:s'),
                    );
                    $res = $this->stambumModel->update_stambum($dataStb, $whereStb);
                    if ($res){
                        $dataLogStb = array(
                            'log_stb_id' => $stb->stb_id,
                            'log_bir_id' => $stb->stb_bir_id,
                            'log_a_s' => $stb->stb_a_s,
                            'log_breed' => $stb->stb_breed,
                            'log_gender' => $stb->stb_gender,
                            'log_date_of_birth' => $dob,
                            'log_photo' => $stb->stb_photo,
                            'log_stat' => $this->config->item('accepted'),
                            'log_app_user' => $this->session->userdata('use_id'),
                            'log_app_date' => date('Y-m-d H:i:s'),
                            'log_user' => $this->session->userdata('use_id'),
                            'log_date' => date('Y-m-d H:i:s'),
                            'log_can_id' => $id,
                            'log_member_id' => $stb->stb_member_id,
                            'log_kennel_id' => $stb->stb_kennel_id,
                        );
                        $log = $this->logstambumModel->add_log($dataLogStb);
                        if ($log){
                            $dataLog = array(
                                'log_canine_id' => $id,
                                'log_reg_number' => '-',
                                'log_a_s' => $stb->stb_a_s,
                                'log_breed' => $stb->stb_breed,
                                'log_gender' => $stb->stb_gender,
                                'log_date_of_birth' => $dob,
                                'log_color' => '-',
                                'log_kennel_id' => $stb->stb_kennel_id,
                                'log_photo' => $stb->stb_photo,
                                'log_stat' => $this->config->item('accepted'),
                                'log_app_user' => $this->session->userdata('use_id'),
                                'log_app_date' => date('Y-m-d H:i:s'),
                                'log_chip_number' => '-',
                                'log_icr_number' => '-',
                                'log_member_id' => $stb->stb_member_id,
                                'log_note' => '-',
                                'log_user' => $this->session->userdata('use_id'),
                                'log_date' => date('Y-m-d H:i:s'),
                            );
                            $res = $this->logcanineModel->add_log($dataLog);
                            if ($res){
                                $wheBirth['bir_id'] = $stb->stb_bir_id;
                                $birth = $this->birthModel->get_births($wheBirth)->row();

                                $wheStud['stu_id'] = $birth->bir_stu_id;
                                $stud = $this->studModel->get_studs($wheStud)->row();
                                
                                $dataPed = array(
                                    'ped_sire_id' => $stud->stu_sire_id,
                                    'ped_dam_id' => $stud->stu_dam_id,
                                    'ped_canine_id' => $id,
                                );
                                $pedigree = $this->pedigreesModel->add_pedigrees($dataPed);
                                if ($pedigree){
                                    $dataLogPed = array(
                                        'log_sire_id' => $stud->stu_sire_id,
                                        'log_dam_id' => $stud->stu_dam_id,
                                        'log_canine_id' => $id,
                                        'log_user' => $this->session->userdata('use_id'),
                                        'log_date' => date('Y-m-d H:i:s'),
                                    );
                                    $log = $this->logpedigreeModel->add_log($dataLogPed);
                                    if ($log){
                                        $res = $this->notification_model->add(4, $this->uri->segment(4), $stb->stb_member_id, "Nama anjing / Canine name: ".$stb->stb_a_s."<br>Nama jantan / Sire name: ".$birth->sire.'<br>Nama betina / Dam name: '.$birth->dam);
                                        if ($res){
                                            $this->db->trans_complete();
                                            $this->session->set_flashdata('approve', TRUE);
                                            redirect('backend/Stambums/view_approve');
                                        }
                                        else{
                                            $err = 1;
                                        }
                                    }
                                    else{
                                        $err = 2;
                                    }
                                }
                                else{
                                    $serr = 3;
                                }
                            }
                            else{
                                $err = 4;
                            }
                        }
                        else{
                            $err = 5;
                        }
                    }
                    else{
                        $err = 6;
                    }
                }
                else{
                    $err = 7;
                }
                if ($err){
                    $this->db->trans_rollback();
                    $this->session->set_flashdata('error_message', 'Failed to approve puppy id = '.$this->uri->segment(4).'. Err code: '.$err);
                    redirect('backend/Stambums/view_approve');
                }
            }
            else{
                redirect("backend/Users/login");
            }
        }
        else{
        redirect("backend/Stambums/view_approve");
        }
    }

    public function reject(){
        if ($this->uri->segment(4)){
            if ($this->session->userdata('use_id')){
                $whereStb['stb_id'] = $this->uri->segment(4);
                $stb = $this->stambumModel->get_stambum($whereStb)->row();
                
                $piece = explode("-", $stb->stb_date_of_birth);
                $dob = $piece[2] . "-" . $piece[1] . "-" . $piece[0];

                $this->db->trans_strict(FALSE);
                $this->db->trans_start();
                $dataStb = array(
                    'stb_stat' => $this->config->item('rejected'),
                    'stb_user' => $this->session->userdata('use_id'),
                    'stb_date' => date('Y-m-d H:i:s'),
                );
                if ($this->uri->segment(5)){
                    $dataStb['stb_app_note'] = urldecode($this->uri->segment(5));
                }
                $res = $this->stambumModel->update_stambum($dataStb, $whereStb);
                if ($res){
                    $dataLogStb = array(
                        'log_stb_id' => $stb->stb_id,
                        'log_bir_id' => $stb->stb_bir_id,
                        'log_a_s' => $stb->stb_a_s,
                        'log_breed' => $stb->stb_breed,
                        'log_gender' => $stb->stb_gender,
                        'log_date_of_birth' => $dob,
                        'log_photo' => $stb->stb_photo,
                        'log_stat' => $this->config->item('rejected'),
                        'log_user' => $this->session->userdata('use_id'),
                        'log_date' => date('Y-m-d H:i:s'),
                        'log_can_id' => 0,
                    );
                    $log = $this->logstambumModel->add_log($dataLogStb);
                    if ($log){
                        $wheBirth['bir_id'] = $stb->stb_bir_id;
                        $birth = $this->birthModel->get_births($wheBirth)->row();
                        $res = $this->notification_model->add(5, $this->uri->segment(4), $stb->stb_member_id, "Nama anjing / Canine name: ".$stb->stb_a_s."<br>Nama jantan / Sire name: ".$birth->sire.'<br>Nama betina / Dam name: '.$birth->dam);
                        if ($res){
                            $this->db->trans_complete();
                            $this->session->set_flashdata('reject', TRUE);
                            redirect('backend/Stambums/view_approve');
                        }
                        else{
                            $err = 1;
                        }
                    }
                    else{
                        $err = 2;
                    }
                }
                else{
                    $err = 3;
                }
                if ($err){
                    $this->db->trans_rollback();
                    $this->session->set_flashdata('error_message', 'Failed to reject puppy id = '.$this->uri->segment(4));
                    redirect('backend/Stambums/view_approve');
                }
            }
            else{
                redirect("backend/Users/login");
            }
        }
        else{
            redirect("backend/Stambums/view_approve");
        }
    }

public function delete(){
    if ($this->uri->segment(4)){
        if ($this->session->userdata('use_id')){
            $err = 0;
            $where['stb_id'] = $this->uri->segment(4);
            $stb = $this->stambumModel->get_stambum($where)->row();
            $dataStb = array(
                'stb_stat' => $this->config->item('rejected'),
                'stb_user' => $this->session->userdata('use_id'),
                'stb_date' => date('Y-m-d H:i:s'),
            );
            if ($this->uri->segment(5)){
                $dataStb['stb_app_note'] = urldecode($this->uri->segment(5));
            }

            $data = array(
                'log_stb_id' => $this->uri->segment(4),
                'log_stat' => $this->config->item('rejected'),
                'log_user' => $this->session->userdata('use_id'),
                'log_date' => date('Y-m-d H:i:s'),
            );

            $whe['can_id'] = $stb->stb_can_id;
            $dataCan = array(
                'can_stat' => $this->config->item('rejected'),
                'can_user' => $this->session->userdata('use_id'),
                'can_date' => date('Y-m-d H:i:s'),
            );

            $dataLog = array(
                'log_canine_id' => $stb->stb_can_id,
                'log_stat' => $this->config->item('rejected'),
                'log_user' => $this->session->userdata('use_id'),
                'log_date' => date('Y-m-d H:i:s'),
            );

            $this->db->trans_strict(FALSE);
            $this->db->trans_start();
            $res = $this->stambumModel->update_stambum($dataStb, $where);
            if ($res){
                $log = $this->logstambumModel->add_log($data);
                if ($log){
                    $res = $this->caninesModel->update_canines($dataCan, $whe);
                    if ($res){
                        $log = $this->logcanineModel->add_log($dataLog);
                        if ($log){
                            $this->db->trans_complete();
                            $this->session->set_flashdata('delete_success', TRUE);
                            redirect("backend/Stambums");
                        }
                        else{
                            $err = 1;
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
                $this->session->set_flashdata('error_message', 'Failed to delete puppy id = '.$this->uri->segment(4).'. Error code: '.$err);
                redirect('backend/Stambums');
            }
        }
        else{
            redirect("backend/Users/login");
        }
    }
    else{
        redirect("backend/Stambums");
    }
}

    public function log(){
        if ($this->uri->segment(4)){
            $where['log_stb_id'] = $this->uri->segment(4);
            $data['stambum'] = $this->logstambumModel->get_logs($where)->result();
            $whePed['log_canine_id'] = $this->uri->segment(4);
            $data['ped'] = $this->logpedigreeModel->get_logs($whePed)->result();
            $data['sire'] = Array();
            $data['dam'] = Array();
            foreach($data['ped'] AS $r){
                $wheSire = [];
                $wheSire['can_id'] = $r->log_sire_id;
                $data['sire'][] = $this->caninesModel->get_canines($wheSire)->row();

                $wheDam = [];
                $wheDam['can_id'] = $r->log_dam_id;
                $data['dam'][] = $this->caninesModel->get_canines($wheDam)->row();
            }
            $this->load->view('backend/log_stambum', $data);
        }
        else{
            redirect('backend/Canines');
        }
    }
}
