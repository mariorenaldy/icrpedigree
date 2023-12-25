<?php
defined('BASEPATH') OR exit('No direct script access allowed');

#[\AllowDynamicProperties]

class Canines extends CI_Controller {
    public function __construct(){
        // Call the CI_Controller constructor
        parent::__construct();
        $this->load->model(array('caninesModel','memberModel', 'logcanineModel', 'logpedigreeModel', 'notification_model', 'notificationtype_model', 'pedigreesModel', 'trahModel', 'kennelModel', 'stambumModel', 'logstambumModel'));
        $this->load->library(array('session', 'form_validation', 'pagination'));
        $this->load->helper(array('url'));
        $this->load->database();
        date_default_timezone_set("Asia/Bangkok");
    }

    public function index(){
        $this->updateExpired();
        $page = ($this->uri->segment(4)) ? ($this->uri->segment(4) - 1) : 0;
        $config['per_page'] = $this->config->item('backend_canine_count');
        $config['uri_segment'] = 4;
        $config['use_page_numbers'] = TRUE;

        //Encapsulate whole pagination 
        $config['full_tag_open'] = '<ul class="pagination justify-content-end">';
        $config['full_tag_close'] = '</ul>';

        //First link of pagination
        $config['first_link'] = 'First';
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
        $config['last_link'] = 'Last';
        $config['last_tag_open'] = '<li>';
        $config['last_tag_close'] = '</li>';

        //For CURRENT page on which you are
        $config['cur_tag_open'] = '<li class="active"><a class="page-link bg-primary text-light border-primary" href="#">';
        $config['cur_tag_close'] = '</a></li>';

        $config['attributes'] = array('class' => 'page-link bg-light text-primary');

        // $where['can_stat'] = $this->config->item('accepted');
        // $where['can_stat !='] = $this->config->item('processed');
        $where_not_in = array($this->config->item('delete_stat'),$this->config->item('processed'),$this->config->item('not_paid'),$this->config->item('cancelled'),$this->config->item('payment_failed'));
        $where['kennels.ken_stat'] = $this->config->item('accepted');
        $data['canine'] = $this->caninesModel->get_canines($where, 'DATE_FORMAT(canines.can_app_date, "%Y-%m-%d %H:%i:%s") desc', $page * $config['per_page'], $this->config->item('backend_canine_count'), $where_not_in)->result();
        
        $config['base_url'] = base_url().'/backend/Canines/index';
        $config['total_rows'] = $this->caninesModel->get_canines($where, 'DATE_FORMAT(canines.can_app_date, "%Y-%m-%d %H:%i:%s") desc', $page * $config['per_page'], 0, $where_not_in)->num_rows();
        $this->pagination->initialize($config);

        $data['keywords'] = '';
        $data['sort_by'] = 'can_app_date2';
        $data['sort_type'] = 'desc';
        $this->session->set_userdata('keywords', '');
        $this->session->set_userdata('sort_by', 'can_app_date2');
        $this->session->set_userdata('sort_type', 'desc');
        $this->load->view('backend/view_canines', $data);
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
        $config['per_page'] = $this->config->item('backend_canine_count');
        $config['uri_segment'] = 4;
        $config['use_page_numbers'] = TRUE;

        //Encapsulate whole pagination 
        $config['full_tag_open'] = '<ul class="pagination justify-content-end">';
        $config['full_tag_close'] = '</ul>';

        //First link of pagination
        $config['first_link'] = 'First';
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
        $config['last_link'] = 'Last';
        $config['last_tag_open'] = '<li>';
        $config['last_tag_close'] = '</li>';

        //For CURRENT page on which you are
        $config['cur_tag_open'] = '<li class="active"><a class="page-link bg-primary text-light border-primary" href="#">';
        $config['cur_tag_close'] = '</a></li>';

        $config['attributes'] = array('class' => 'page-link bg-light text-primary');

        if ($data['keywords']){
            $like['can_a_s'] = $data['keywords'];
            $like['can_icr_number'] = $data['keywords'];
            $like['can_chip_number'] = $data['keywords'];
            $like['ken_name'] = $data['keywords'];
            $like['stat_name'] = $data['keywords'];
        }
        else
            $like = null;
        // $where['can_stat'] = $this->config->item('accepted');
        // $where['can_stat !='] = $this->config->item('processed');
        $where_not_in = array($this->config->item('delete_stat'),$this->config->item('processed'),$this->config->item('not_paid'),$this->config->item('cancelled'),$this->config->item('payment_failed'));
        $where['kennels.ken_stat'] = $this->config->item('accepted');
        $data['canine'] = $this->caninesModel->search_canines($like, $where, $data['sort_by'].' '.$data['sort_type'], $page * $config['per_page'], $this->config->item('backend_canine_count'), $where_not_in)->result();

        $config['base_url'] = base_url().'/backend/Canines/search';
        $config['total_rows'] = $this->caninesModel->search_canines($like, $where, $data['sort_by'].' '.$data['sort_type'], $page * $config['per_page'], 0, $where_not_in)->num_rows();
        $this->pagination->initialize($config);
        $this->load->view('backend/view_canines', $data);
    }

    public function view_approve(){
        $page = ($this->uri->segment(4)) ? ($this->uri->segment(4) - 1) : 0;
        $config['per_page'] = $this->config->item('backend_canine_count');
        $config['uri_segment'] = 4;
        $config['use_page_numbers'] = TRUE;

        //Encapsulate whole pagination 
        $config['full_tag_open'] = '<ul class="pagination justify-content-end">';
        $config['full_tag_close'] = '</ul>';

        //First link of pagination
        $config['first_link'] = 'First';
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
        $config['last_link'] = 'Last';
        $config['last_tag_open'] = '<li>';
        $config['last_tag_close'] = '</li>';

        //For CURRENT page on which you are
        $config['cur_tag_open'] = '<li class="active"><a class="page-link bg-primary text-light border-primary" href="#">';
        $config['cur_tag_close'] = '</a></li>';

        $config['attributes'] = array('class' => 'page-link bg-light text-primary');

        $where['can_stat'] = $this->config->item('saved');
        $where['kennels.ken_stat'] = $this->config->item('accepted');
        $data['canine'] = $this->caninesModel->get_canines($where, 'can_id desc', $page * $config['per_page'], $this->config->item('backend_canine_count'))->result();

        $config['base_url'] = base_url().'/backend/Canines/view_approve';
        $config['total_rows'] = $this->caninesModel->get_canines($where, 'can_id desc', $page * $config['per_page'], 0)->num_rows();
        $this->pagination->initialize($config);

        $data['keywords'] = '';
        $data['sort_by'] = 'can_date';
        $data['sort_type'] = 'desc';
        $this->session->set_userdata('keywords', '');
        $this->load->view('backend/approve_canines', $data);
    }
    
    public function search_approve(){
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
        $config['per_page'] = $this->config->item('backend_canine_count');
        $config['uri_segment'] = 4;
        $config['use_page_numbers'] = TRUE;

        //Encapsulate whole pagination 
        $config['full_tag_open'] = '<ul class="pagination justify-content-end">';
        $config['full_tag_close'] = '</ul>';

        //First link of pagination
        $config['first_link'] = 'First';
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
        $config['last_link'] = 'Last';
        $config['last_tag_open'] = '<li>';
        $config['last_tag_close'] = '</li>';

        //For CURRENT page on which you are
        $config['cur_tag_open'] = '<li class="active"><a class="page-link bg-primary text-light border-primary" href="#">';
        $config['cur_tag_close'] = '</a></li>';

        $config['attributes'] = array('class' => 'page-link bg-light text-primary');

        if ($data['keywords']){
            $like['can_a_s'] = $data['keywords'];
            $like['ken_name'] = $data['keywords'];
        }
        else
            $like = null;
        $where['can_stat'] = $this->config->item('saved');
        $where['kennels.ken_stat'] = $this->config->item('accepted');
        $data['canine'] = $this->caninesModel->search_canines($like, $where, $data['sort_by'].' '.$data['sort_type'], $page * $config['per_page'], $this->config->item('backend_canine_count'))->result();

        $config['base_url'] = base_url().'/backend/Canines/search_approve';
        $config['total_rows'] = $this->caninesModel->search_canines($like, $where, $data['sort_by'].' '.$data['sort_type'], $page * $config['per_page'], 0)->num_rows();
        $this->pagination->initialize($config);
        $this->load->view('backend/approve_canines', $data);
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
            $this->load->view("backend/view_canine_detail", $data);
        }
        else{
            redirect('backend/Canines');
        }
    }

    public function add(){
        $wheTrah['tra_stat != '] = $this->config->item('deleted');
        $data['trah'] = $this->trahModel->get_trah($wheTrah)->result();
        $data['member'] = [];
        $data['kennel'] = [];
        $this->load->view('backend/add_canine', $data);
    }
  
    public function search_member(){
        if ($this->session->userdata('use_username')) {
            $wheTrah['tra_stat != '] = $this->config->item('deleted');
            $data['trah'] = $this->trahModel->get_trah($wheTrah)->result();

            $like['mem_name'] = $this->input->post('mem_name');
            $like['ken_name'] = $this->input->post('mem_name');
            $where['mem_stat'] = $this->config->item('accepted');
            $where['ken_stat'] = $this->config->item('accepted');
            $data['member'] = $this->memberModel->search_members($like, $where)->result();

            if ($data['member']){
                $whe['ken_member_id'] =  $data['member'][0]->mem_id;
                $whe['ken_stat'] = $this->config->item('accepted');
                $data['kennel'] = $this->kennelModel->get_kennels($whe)->result();
            }
            else{
                $data['kennel'] = [];
            }
            $this->load->view('backend/add_canine', $data);
        }
        else {
            redirect("backend/Users/login");
        }
    }

    // public function search_kennel(){
    //     if ($this->session->userdata('use_username')) {
    //         $wheTrah['tra_stat != '] = $this->config->item('deleted');
    //         $data['trah'] = $this->trahModel->get_trah($wheTrah)->result();

    //         $like['mem_name'] = $this->input->post('mem_name');
    //         $like['ken_name'] = $this->input->post('mem_name');
    //         $where['mem_stat'] = $this->config->item('accepted');
    //         $where['ken_stat'] = $this->config->item('accepted');
    //         $data['member'] = $this->memberModel->search_members($like, $where)->result();

    //         $whe['ken_member_id'] =  $this->input->post('can_member_id');
    //         $whe['ken_stat'] = $this->config->item('accepted');
    //         $data['kennel'] = $this->kennelModel->get_kennels($whe)->result();
    //         $this->load->view('backend/add_canine', $data);
    //     }
    //     else {
    //       redirect("backend/Users/login");
    //     }
    // }

    public function search_kennel(){
        $whe['ken_member_id'] =  $this->input->post('can_member_id');
        $whe['ken_stat'] = $this->config->item('accepted');
        $kennel = $this->kennelModel->get_kennels($whe)->result();
		$json = json_encode($kennel);
		echo $json;
    }
  
    public function validate_add(){ 
        if ($this->session->userdata('use_username')) {
            $this->form_validation->set_error_delimiters('<div>', '</div>');
            $this->form_validation->set_rules('can_member_id', 'Member id ', 'trim|required');
            $this->form_validation->set_rules('can_kennel_id', 'Kennel id ', 'trim|required');
            $this->form_validation->set_rules('can_a_s', 'Name ', 'trim|required');
            $this->form_validation->set_rules('can_date_of_birth', 'Date of Birth ', 'trim|required');
        
            $wheTrah['tra_stat != '] = $this->config->item('deleted');
            $data['trah'] = $this->trahModel->get_trah($wheTrah)->result();

            $where['mem_id'] = $this->input->post('can_member_id');
            $data['member'] = $this->memberModel->get_members($where)->result();

            $whe['ken_member_id'] =  $this->input->post('can_member_id');
            $whe['ken_stat'] = $this->config->item('accepted');
            $data['kennel'] = $this->kennelModel->get_kennels($whe)->result();

            if ($this->form_validation->run() == FALSE) {
                $this->load->view('backend/add_canine', $data);
            } else {
                $err = 0;
                if (!isset($_POST['attachment']) || empty($_POST['attachment'])){
                    $err++;
                    $this->session->set_flashdata('error_message', 'Photo is required');
                }
        
                $photo = '-';
                $photoProof = '-';
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
                        $this->session->set_flashdata('error_message', 'Canine folder not found or not writable.');
                    } else{
                        if (is_file($img_name) and !is_writable($img_name)) {
                        $err++;
                        $this->session->set_flashdata('error_message', 'File already exists and not writable.');
                        }
                    }
                }

                if (!$err && $this->input->post('can_icr_number') != "-" && $this->caninesModel->check_for_duplicate(0, 'can_icr_number', $this->input->post('can_icr_number'))){
                    $err++;
                    $this->session->set_flashdata('error_message', 'ICR number is already registered');
                }
        
                if (!$err && $this->input->post('can_chip_number') != "-" && $this->caninesModel->check_for_duplicate(0, 'can_chip_number', $this->input->post('can_chip_number'))){
                    $err++;
                    $this->session->set_flashdata('error_message', 'Microchip number is already registered');
                }

                $piece = explode("-", $this->input->post('can_date_of_birth'));
                $dob = $piece[2] . "-" . $piece[1] . "-" . $piece[0];
                if (!$err){
                    $ts = new DateTime();
					$ts_dob = new DateTime($dob);
                    if ($ts_dob > $ts){
                        $err++;
                        $this->session->set_flashdata('error_message', "The Date of Birth must be before today's date");
                    }
                    else{ // min 45 hari
                        $diff = $ts->diff($ts_dob)->days/$this->config->item('min_jarak_lapor_anak');
                        if ($diff < 1){
                            $err++;
                            $this->session->set_flashdata('error_message', 'The Date of Birth must be more than '.$this->config->item('min_jarak_lapor_anak').' days before today');
                        }
                    }
                }

                if (!$err){
                    file_put_contents($img_name, $uploadedImg);
                    $photo = str_replace($this->config->item('path_canine'), '', $img_name);

                    $dataCan = array(
                        'can_member_id' => $this->input->post('can_member_id'),
                        'can_reg_number' => '-',
                        'can_breed' => $this->input->post('can_breed'),
                        'can_gender' => $this->input->post('can_gender'),
                        'can_date_of_birth' => $dob,
                        'can_color' => '-',
                        'can_kennel_id' => $this->input->post('can_kennel_id'),
                        'can_reg_date' => date("Y/m/d"),
                        'can_photo' => $photo,
                        'can_pay_photo' => $photoProof,
                        'can_stat' => $this->config->item('accepted'),
                        'can_app_user' => $this->session->userdata('use_id'),
                        'can_app_date' => date('Y-m-d H:i:s'),
                        'can_chip_number' => '-',
                        'can_icr_number' => '-',
                        'can_note' => $this->input->post('can_note'),
                        'can_user' => $this->session->userdata('use_id'),
                        'can_date' => date('Y-m-d H:i:s'),
                    );

                    if($this->input->post('can_color')){
                        $dataCan['can_color'] = $this->input->post('can_color');
                    }
                    if($this->input->post('can_chip_number')){
                        $dataCan['can_chip_number'] = $this->input->post('can_chip_number');
                    }
                    if($this->input->post('can_icr_number')){
                        $dataCan['can_icr_number'] = $this->input->post('can_icr_number');
                    }

                    // nama diubah berdasarkan kennel
                    if (!$this->input->post('remove')){
                        $whereKennel['ken_id'] = $this->input->post('can_kennel_id');
                        $kennel = $this->kennelModel->get_kennels($whereKennel)->result();
                        if ($kennel) {
                        if ($kennel[0]->ken_type_id == 1)
                            $dataCan['can_a_s'] = strtoupper($this->input->post('can_a_s'))." VON ".$kennel[0]->ken_name;
                        else if ($kennel[0]->ken_type_id == 2)
                            $dataCan['can_a_s'] = $kennel[0]->ken_name."` ".strtoupper($this->input->post('can_a_s'));
                        else 
                            $dataCan['can_a_s'] = strtoupper($this->input->post('can_a_s'));
                        }
                    }
                    else
                        $dataCan['can_a_s'] = strtoupper($this->input->post('can_a_s'));

                    if (!$err && $this->caninesModel->check_for_duplicate(0, 'can_a_s', $dataCan['can_a_s'])){
                        $err++;
                        $this->session->set_flashdata('error_message', 'Dog name is already registered');
                    }

                    if (strlen($dataCan['can_a_s']) >= $this->config->item('can_a_s_length')){
                        $err++;
                        $this->session->set_flashdata('error_message', 'Nama anjing terlalu panjang. Ditambah dengan nama kennel, harus di bawah '.$this->config->item('can_a_s_length').' karakter');
                    }

                    $dataLog = array(
                        'log_reg_number' => strtoupper($this->input->post('can_reg_number')),
                        'log_a_s' => $dataCan['can_a_s'],
                        'log_breed' => $this->input->post('can_breed'),
                        'log_gender' => $this->input->post('can_gender'),
                        'log_date_of_birth' => $dob,
                        'log_color' => $this->input->post('can_color'),
                        'log_kennel_id' => $this->input->post('can_kennel_id'),
                        'log_photo' => $photo,
                        'log_pay_photo' => $photoProof,
                        'log_stat' => $this->config->item('accepted'),
                        'log_app_user' => $this->session->userdata('use_id'),
                        'log_app_date' => date('Y-m-d H:i:s'),
                        'log_chip_number' => $this->input->post('can_chip_number'),
                        'log_icr_number' => $this->input->post('can_icr_number'),
                        'log_member_id' => $this->input->post('can_member_id'),
                        'log_note' => $this->input->post('can_note'),
                        'log_user' => $this->session->userdata('use_id'),
                        'log_date' => date('Y-m-d H:i:s'),
                    );

                    $dataPed = array(
                        'ped_sire_id' => $this->config->item('sire_id'),
                        'ped_dam_id' => $this->config->item('dam_id'),
                    );

                    $dataLogPed = array(
                        'log_sire_id' => $this->config->item('sire_id'),
                        'log_dam_id' => $this->config->item('dam_id'),
                        'log_user' => $this->session->userdata('use_id'),
                        'log_date' => date('Y-m-d H:i:s'),
                    );

                    if (!$err) {
                        $this->db->trans_strict(FALSE);
                        $this->db->trans_start();
                        $canines = $this->caninesModel->add_canines($dataCan);
                        if ($canines) {
                            $insertedID = $this->db->insert_id();
                            $dataLog['log_canine_id'] = $insertedID;
                            $dataPed['ped_canine_id'] = $insertedID;
                            $dataLogPed['log_canine_id'] = $insertedID;

                            $pedigree = $this->pedigreesModel->add_pedigrees($dataPed);
                            if ($pedigree) {
                                $log = $this->logcanineModel->add_log($dataLog);
                                if ($log){
                                    $res = $this->logpedigreeModel->add_log($dataLogPed);
                                    if ($res){
                                        $result = $this->notification_model->add(13, $insertedID, $this->input->post('can_member_id'), "Nama anjing / Canine Name: ".$dataCan['can_a_s']);
                                        if ($result){
                                            $this->db->trans_complete();
                                            $this->session->set_flashdata('add_success', true);
                                            redirect("backend/Canines");
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
                            } else {
                                $err = 4;
                            }
                        } else {
                            $err = 5;
                        }
                        if ($err) {
                            $this->db->trans_rollback();
                            $this->session->set_flashdata('error_message', 'Failed to save canine. Error code: '.$err);
                            $this->load->view('backend/add_canine', $data);
                        }
                    } else {
                        $this->load->view('backend/add_canine', $data);
                    }
                } else {
                    $this->load->view('backend/add_canine', $data);
                }
            }
        } 
        else {
            redirect("backend/Users/login");
        }
    }

    public function edit_canine(){
        if ($this->uri->segment(4)){
            $wheTrah['tra_stat != '] = $this->config->item('deleted');
            $data['trah'] = $this->trahModel->get_trah(null)->result();
            $where['can_id'] = $this->uri->segment(4);
            $data['canine'] = $this->caninesModel->get_canines($where)->row();
            $wheMember['mem_id'] = $data['canine']->can_member_id;
            $data['member'] = $this->memberModel->get_members($wheMember)->result();
            $wheKennel['ken_member_id'] = $data['canine']->can_member_id;
            $data['kennel'] = $this->kennelModel->get_kennels($wheKennel)->result();
            $data['mode'] = 0;
            $this->load->view("backend/edit_canine", $data);
        }
        else{
            redirect('backend/Canines');
        }
    }

    public function search_member_update(){
        if ($this->session->userdata('use_username')) {
            $wheTrah['tra_stat != '] = $this->config->item('deleted');
            $data['trah'] = $this->trahModel->get_trah($wheTrah)->result();
            $where['can_id'] = $this->input->post('can_id');
            $data['canine'] = $this->caninesModel->get_canines($where)->row();

            $like['mem_name'] = $this->input->post('mem_name');
            $like['ken_name'] = $this->input->post('mem_name');
            $wheMember['mem_stat'] = $this->config->item('accepted');
            $wheMember['ken_stat'] = $this->config->item('accepted');
            $data['member'] = $this->memberModel->search_members($like, $wheMember)->result();

            if ($data['member']){
                $wheKennel['ken_member_id'] =  $data['member'][0]->mem_id;
                $wheKennel['ken_stat'] = $this->config->item('accepted');
                $data['kennel'] = $this->kennelModel->get_kennels($wheKennel)->result();
            }
            else{
                $wheMember['mem_id'] = $data['canine']->can_member_id;
                $data['member'] = $this->memberModel->get_members($wheMember)->result();
                $wheKennel['ken_member_id'] = $data['canine']->can_member_id;
                $wheKennel['ken_stat'] = $this->config->item('accepted');
                $data['kennel'] = $this->kennelModel->get_kennels($wheKennel)->result();
            }
            $data['mode'] = 1;
            $this->load->view('backend/edit_canine', $data);
        }
        else {
            redirect("backend/Users/login");
        }
    }

    public function validate_edit_canine(){ 
        if ($this->session->userdata('use_username')) {
            $this->form_validation->set_error_delimiters('<div>', '</div>');
            $this->form_validation->set_rules('can_member_id', 'Member id ', 'trim|required');
            $this->form_validation->set_rules('can_kennel_id', 'Kennel id ', 'trim|required');
            $this->form_validation->set_rules('can_a_s', 'Name ', 'trim|required');
            $this->form_validation->set_rules('can_reg_number', 'Current registration number', 'trim|required');
            $this->form_validation->set_rules('can_icr_number', 'ICR number ', 'trim|required');
            $this->form_validation->set_rules('can_chip_number', 'Microchip number ', 'trim');
            $this->form_validation->set_rules('can_color', 'Color ', 'trim|required');
            $this->form_validation->set_rules('can_date_of_birth', 'Date of Birth ', 'trim|required');

            $wheTrah['tra_stat != '] = $this->config->item('deleted');
            $data['trah'] = $this->trahModel->get_trah($wheTrah)->result();
            $where['can_id'] = $this->input->post('can_id');
            $data['canine'] = $this->caninesModel->get_canines($where)->row();
            
            $whereMem['mem_id'] = $this->input->post('can_member_id');
            $data['member'] = $this->memberModel->get_members($whereMem)->result();

            if ($data['member']){
                $wheKennel['ken_member_id'] =  $this->input->post('can_member_id');
                $wheKennel['ken_stat'] = $this->config->item('accepted');
                $data['kennel'] = $this->kennelModel->get_kennels($wheKennel)->result();
            }
            else{
                $wheMember['mem_id'] = $data['canine']->can_member_id;
                $data['member'] = $this->memberModel->get_members($wheMember)->result();
                $wheKennel['ken_member_id'] = $data['canine']->can_member_id;
                $wheKennel['ken_stat'] = $this->config->item('accepted');
                $data['kennel'] = $this->kennelModel->get_kennels($wheKennel)->result();
            }
            $data['mode'] = 1;

            if ($this->form_validation->run() == FALSE) {
                $this->load->view('backend/edit_canine', $data);
            } else {
                $err = 0;
                $photo = '-';
                $photoProof = '-';
                if (!$err){
                    if (isset($_POST['attachment']) && !empty($_POST['attachment'])){
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
                            $this->session->set_flashdata('error_message', 'Canine folder not found or not writable.');
                        } else{
                            if (is_file($img_name) and !is_writable($img_name)) {
                                $err++;
                                $this->session->set_flashdata('error_message', 'File already exists and not writable.');
                            }
                        }
                    }
                }

                if (!$err && $this->input->post('can_icr_number') != "-" && $this->caninesModel->check_for_duplicate($this->input->post('can_id'), 'can_icr_number', $this->input->post('can_icr_number'))){
                    $err++;
                    $this->session->set_flashdata('error_message', 'ICR number already registered');
                }

                if (!$err && $this->input->post('can_chip_number') != "-" && $this->caninesModel->check_for_duplicate($this->input->post('can_id'), 'can_chip_number', $this->input->post('can_chip_number'))){
                    $err++;
                    $this->session->set_flashdata('error_message', 'Microchip number already registered');
                }

                if (!$err && $this->caninesModel->check_for_duplicate($this->input->post('can_id'), 'can_a_s', $this->input->post('can_a_s'))){
                    $err++;
                    $this->session->set_flashdata('error_message', 'Dog name already registered');
                }

                if (strlen($this->input->post('can_a_s')) >= $this->config->item('can_a_s_length')){
                    $err++;
                    $this->session->set_flashdata('error_message', 'The dog\'s name is too long. Plus the kennel name, must be under '.$this->config->item('can_a_s_length').' characters');
                }

                if (!$err){
                    $piece = explode("-", $this->input->post('can_date_of_birth'));
                    $dob = $piece[2] . "-" . $piece[1] . "-" . $piece[0];

                    $ts = new DateTime();
                    $ts_dob = new DateTime($dob);
                    if ($ts_dob > $ts){
                        $err++;
                        $this->session->set_flashdata('error_message', "The Date of Birth must be before today's date");
                    }
                }

                if (!$err) {
                    if (isset($uploadedImg)){
                        file_put_contents($img_name, $uploadedImg);
                        $photo = str_replace($this->config->item('path_canine'), '', $img_name);
                    }

                    $piece = explode("-", $this->input->post('can_date_of_birth'));
                    $dob = $piece[2] . "-" . $piece[1] . "-" . $piece[0];

                    $rip = 0;
                    if ($this->input->post('can_rip'))
                        $rip = 1;

                    $dataCan = array(
                        'can_member_id' => $this->input->post('can_member_id'),
                        'can_reg_number' => strtoupper($this->input->post('can_reg_number')),
                        'can_breed' => $this->input->post('can_breed'),
                        'can_gender' => $this->input->post('can_gender'),
                        'can_date_of_birth' => $dob,
                        'can_color' => $this->input->post('can_color'),
                        'can_kennel_id' => $this->input->post('can_kennel_id'),
                        'can_stat' => $this->config->item('accepted'),
                        'can_user' => $this->session->userdata('use_id'),
                        'can_date' => date('Y-m-d H:i:s'),
                        'can_chip_number' => $this->input->post('can_chip_number'),
                        'can_icr_number' => $this->input->post('can_icr_number'),
                        'can_a_s' => strtoupper($this->input->post('can_a_s')),
                        'can_rip' => $rip,
                        'can_note' => $this->input->post('can_note'),
                    );

                    if ($photo != '-'){
                        $dataCan['can_photo'] = $photo;
                    }
                    else{
                        if ($data['canine']->can_photo != '-'){
                            $photo = $data['canine']->can_photo;
                            $dataCan['can_photo'] = $data['canine']->can_photo;
                        }
                    }
                    
                    $dataLog = array(
                        'log_canine_id' => $this->input->post('can_id'),
                        'log_reg_number' => strtoupper($this->input->post('can_reg_number')),
                        'log_a_s' => $dataCan['can_a_s'],
                        'log_breed' => $this->input->post('can_breed'),
                        'log_gender' => $this->input->post('can_gender'),
                        'log_date_of_birth' => $dob,
                        'log_color' => $this->input->post('can_color'),
                        'log_kennel_id' => $this->input->post('can_kennel_id'),
                        'log_photo' => $photo,
                        'log_pay_photo' => $photoProof,
                        'log_stat' => $this->config->item('accepted'),
                        'log_user' => $this->session->userdata('use_id'),
                        'log_date' => date('Y-m-d H:i:s'),
                        'log_chip_number' => $this->input->post('can_chip_number'),
                        'log_icr_number' => $this->input->post('can_icr_number'),
                        'log_member_id' => $this->input->post('can_member_id'),
                        'log_rip' => $rip,
                        'log_note' => $this->input->post('can_note'),
                    );

                    if (!$err) {
                        $this->db->trans_strict(FALSE);
                        $this->db->trans_start();
                        $canines = $this->caninesModel->update_canines($dataCan, $where);
                        if ($canines) {
                            $log = $this->logcanineModel->add_log($dataLog);
                            if ($log){
                                $this->db->trans_complete();
                                $this->session->set_flashdata('edit_success', true);
                                redirect("backend/Canines");
                            }
                            else{
                                $err = 1;
                            }
                        } else {
                            $err = 2;
                        }
                        if ($err) {
                            $this->db->trans_rollback();
                            $this->session->set_flashdata('error_message', 'Failed to edit canine id = '.$this->input->post('can_id').'. Error code: '.$err);
                            $this->load->view('backend/edit_canine', $data);
                        }
                    } else {
                        $this->load->view('backend/edit_canine', $data);
                    }
                } else {
                    $this->load->view('backend/edit_canine', $data);
                }
            }
        }
        else{
            redirect('backend/Users/login');
        }
    }

    public function edit_pedigree(){
        if ($this->uri->segment(4)){
            $where['can_id'] = $this->uri->segment(4);
            $data['canine'] = $this->caninesModel->get_canines($where)->row();
            $whePed['ped_canine_id'] = $data['canine']->can_id;
            $data['ped'] = $this->pedigreesModel->get_pedigrees($whePed)->row();
            $wheSire['can_id'] = $data['ped']->ped_sire_id;
            $data['sire'] = $this->caninesModel->get_canines($wheSire)->result();
            $wheDam['can_id'] = $data['ped']->ped_dam_id;
            $data['dam'] = $this->caninesModel->get_canines($wheDam)->result();
            $data['mode'] = 0;
            $this->load->view("backend/edit_pedigree", $data);
        }
        else{
            redirect('backend/Canines');
        }
    }

    public function search_pedigree(){
        if ($this->session->userdata('use_username')) {
            $where['can_id'] = $this->input->post('ped_canine_id');
            $data['canine'] = $this->caninesModel->get_canines($where)->row();
            $whePed['ped_canine_id'] = $data['canine']->can_id;
            $data['ped'] = $this->pedigreesModel->get_pedigrees($whePed)->row();
            if ($this->input->post('sire_a_s')){
                $likeSire['can_a_s'] = $this->input->post('sire_a_s');
                $wheSire['can_stat'] = $this->config->item('accepted');
                $wheSire['can_gender'] = 'MALE';
                $data['sire'] = $this->caninesModel->search_canines($likeSire, $wheSire)->result();
            }
            else{
                $wheSire['can_id'] = $data['ped']->ped_sire_id;
                $data['sire'] = $this->caninesModel->get_canines($wheSire)->result();
            }
            if ($this->input->post('dam_a_s')){
                $likeDam['can_a_s'] = $this->input->post('dam_a_s');
                $wheDam['can_stat'] = $this->config->item('accepted');
                $wheDam['can_gender'] = 'FEMALE';
                $data['dam'] = $this->caninesModel->search_canines($likeDam, $wheDam)->result();
            }
            else{
                $wheDam['can_id'] = $data['ped']->ped_dam_id;
                $data['dam'] = $this->caninesModel->get_canines($wheDam)->result();
            }
            $data['mode'] = 1;
            $this->load->view("backend/edit_pedigree", $data);
        }
        else {
            redirect("backend/Users/login");
        }
    }

public function validate_edit_pedigree(){
    if ($this->session->userdata('use_username')) {
        $where['can_id'] = $this->input->post('ped_canine_id');
        $data['canine'] = $this->caninesModel->get_canines($where)->row();
        $whePed['ped_canine_id'] = $data['canine']->can_id;
        $data['ped'] = $this->pedigreesModel->get_pedigrees($whePed)->row();
        if ($this->input->post('sire_a_s')){
            $likeSire['can_a_s'] = $this->input->post('sire_a_s');
            $wheSire['can_stat'] = $this->config->item('accepted');
            $wheSire['can_gender'] = 'MALE';
            $data['sire'] = $this->caninesModel->search_canines($likeSire, $wheSire)->result();
        }
        else{
            $wheSire['can_id'] = $data['ped']->ped_sire_id;
            $data['sire'] = $this->caninesModel->get_canines($wheSire)->result();
        }
        if ($this->input->post('dam_a_s')){
            $likeDam['can_a_s'] = $this->input->post('dam_a_s');
            $wheDam['can_stat'] = $this->config->item('accepted');
            $wheDam['can_gender'] = 'FEMALE';
            $data['dam'] = $this->caninesModel->search_canines($likeDam, $wheDam)->result();
        }
        else{
            $wheDam['can_id'] = $data['ped']->ped_dam_id;
            $data['dam'] = $this->caninesModel->get_canines($wheDam)->result();
        }
        $data['mode'] = 1;

        $this->form_validation->set_error_delimiters('<div>', '</div>');
        $this->form_validation->set_rules('ped_canine_id', 'Canine id ', 'trim|required');
        $this->form_validation->set_rules('ped_sire_id', 'Sire id ', 'trim|required');
        $this->form_validation->set_rules('ped_dam_id', 'Dam id ', 'trim|required');

        if ($this->form_validation->run() == FALSE) {
            $this->load->view('backend/edit_pedigree', $data);
        } else {
            $dataPed = array(
                'ped_sire_id' => $this->input->post('ped_sire_id'),
                'ped_dam_id' => $this->input->post('ped_dam_id'),
            );

            $dataLogPed = array(
                'log_sire_id' => $this->input->post('ped_sire_id'),
                'log_dam_id' => $this->input->post('ped_dam_id'),
                'log_canine_id' => $this->input->post('ped_canine_id'),
                'log_user' => $this->session->userdata('use_id'),
                'log_date' => date('Y-m-d H:i:s'),
            );

            $this->db->trans_strict(FALSE);
            $this->db->trans_start();
            $whePed['ped_canine_id'] = $this->input->post('ped_canine_id');
            $pedigree = $this->pedigreesModel->update_pedigrees($dataPed, $whePed);
            if ($pedigree) {
                $res = $this->logpedigreeModel->add_log($dataLogPed);
                if ($res){
                    $this->db->trans_complete();
                    $this->session->set_flashdata('edit_pedigree_success', true);
                    redirect("backend/Canines");
                }
                else{
                    $err = 1;
                }
            }
            else{
                $err = 2;
            }
            if ($err) {
                $this->db->trans_rollback();
                $this->session->set_flashdata('error_message', 'Failed to edit pedigree. Error code: '.$err);
                $this->load->view("backend/edit_pedigree", $data);
            }
        }
    }
    else {
        redirect("backend/Users/login");
    }
}

    public function approve_canine(){
        if ($this->uri->segment(4)){
            if ($this->session->userdata('use_username')){
                $err = 0;
                $where['can_id'] = $this->uri->segment(4);
                $can = $this->caninesModel->get_canines($where)->row();
                $this->db->trans_strict(FALSE);
                $this->db->trans_start();
                $data['can_app_user'] = $this->session->userdata('use_id');
                $data['can_app_date'] = date('Y-m-d H:i:s');
                $data['can_user'] = $this->session->userdata('use_id');
                $data['can_date'] = date('Y-m-d H:i:s');
                $data['can_stat'] = $this->config->item('accepted');
                $res = $this->caninesModel->update_canines($data, $where);
                if ($res){
                    $piece = explode("-", $can->can_date_of_birth);
                    $dob = $piece[2] . "-" . $piece[1] . "-" . $piece[0];

                    $dataLog = array(
                        'log_canine_id' => $this->uri->segment(4),
                        'log_reg_number' => $can->can_reg_number,
                        'log_a_s' => $can->can_a_s,
                        'log_breed' => $can->can_breed,
                        'log_gender' => $can->can_gender,
                        'log_date_of_birth' => $dob,
                        'log_color' => $can->can_color,
                        'log_kennel_id' => $can->can_kennel_id,
                        'log_photo' => $can->can_photo,
                        'log_pay_photo' => $can->can_pay_photo,
                        'log_stat' => $this->config->item('accepted'),
                        'log_app_user' => $this->session->userdata('use_id'),
                        'log_app_date' => date('Y-m-d H:i:s'),
                        'log_chip_number' => $can->can_chip_number,
                        'log_icr_number' => $can->can_icr_number,
                        'log_member_id' => $can->can_member_id,
                        'log_note' => $can->can_note,
                        'log_user' => $this->session->userdata('use_id'),
                        'log_date' => date('Y-m-d H:i:s'),
                    );
                    $log = $this->logcanineModel->add_log($dataLog);
                    if ($log){
                        $dataLogPed = array(
                        'log_sire_id' => $this->config->item('sire_id'),
                        'log_dam_id' => $this->config->item('dam_id'),
                        'log_canine_id' => $this->uri->segment(4),
                        'log_user' => $this->session->userdata('use_id'),
                        'log_date' => date('Y-m-d H:i:s'),
                        );
                        $res = $this->logpedigreeModel->add_log($dataLogPed);
                        if ($res){
                            $res3 = $this->notification_model->add(11, $this->uri->segment(4), $can->can_member_id, "Nama anjing / Canine name: ".$can->can_a_s);
                            if ($res3){
                                $this->db->trans_complete();
                                $this->session->set_flashdata('approve', TRUE);
                                redirect('backend/Canines/view_approve');
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
                if ($err){
                    $this->db->trans_rollback();
                    $this->session->set_flashdata('error_message', 'Failed to approve canine id = '.$this->uri->segment(4).'. Err code: '.$err);
                    redirect('backend/Canines/view_approve');
                }
            }
            else{
                redirect("backend/Users/login");
            }
        }
        else{
            redirect("backend/Canines/view_approve");
        }
    }

    public function reject_canine(){
        if ($this->uri->segment(4)){
            if ($this->session->userdata('use_username')){
                $where['can_id'] = $this->uri->segment(4);
                $can = $this->caninesModel->get_canines($where)->row();
                $this->db->trans_strict(FALSE);
                $this->db->trans_start();
                $data['can_user'] = $this->session->userdata('use_id');
                $data['can_app_user'] = $this->session->userdata('use_id');
                $data['can_app_date'] = date('Y-m-d H:i:s');
                $data['can_date'] = date('Y-m-d H:i:s');
                $data['can_stat'] = $this->config->item('rejected');
                if ($this->uri->segment(5)){
                    $data['can_app_note'] = urldecode($this->uri->segment(5));
                }
                $res = $this->caninesModel->update_canines($data, $where);
                if ($res){
                    $err = 0;
                    $res2 = $this->notification_model->add(12, $this->uri->segment(4), $can->can_member_id, "Nama anjing / Canine name: ".$can->can_a_s);
                    if ($res2){
                        $piece = explode("-", $can->can_date_of_birth);
                        $dob = $piece[2] . "-" . $piece[1] . "-" . $piece[0];
                        $dataLog = array(
                            'log_canine_id' => $can->can_id,
                            'log_reg_number' => $can->can_reg_number,
                            'log_a_s' => $can->can_a_s,
                            'log_breed' => $can->can_breed,
                            'log_gender' => $can->can_gender,
                            'log_date_of_birth' => $dob,
                            'log_color' => $can->can_color,
                            'log_kennel_id' => $can->can_kennel_id,
                            'log_photo' => $can->can_photo,
                            'log_pay_photo' => $can->can_pay_photo,
                            'log_stat' => $this->config->item('rejected'),
                            'log_user' => $this->session->userdata('use_id'),
                            'log_date' => date('Y-m-d H:i:s'),
                            'log_chip_number' => $can->can_chip_number,
                            'log_icr_number' => $can->can_icr_number,
                            'log_member_id' => $can->can_member_id,
                            'log_note' => $can->can_note,
                        );
                        $log = $this->logcanineModel->add_log($dataLog);
                        if ($log){
                            $this->db->trans_complete();
                            $this->session->set_flashdata('reject', TRUE);
                            redirect('backend/Canines/view_approve');
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
                    $this->session->set_flashdata('error_message', 'Failed to reject canine id = '.$this->uri->segment(4));
                    redirect('backend/Canines/view_approve');
                }
            }
            else{
                redirect("backend/Users/login");
            }
        }
        else{
            redirect("backend/Canines/view_approve");
        }
    }

    public function delete(){
        if ($this->uri->segment(4)){
            if ($this->session->userdata('use_username')){
                $err = 0;
                $where['can_id'] = $this->uri->segment(4);
                $data['can_stat'] = $this->config->item('delete_stat');
                $data['can_user'] = $this->session->userdata('use_id');
                $data['can_app_user'] = $this->session->userdata('use_id');
                $data['can_date'] = date('Y-m-d H:i:s');
                $data['can_app_date'] = date('Y-m-d H:i:s');
                if ($this->uri->segment(5)){
                    $data['can_app_note'] = urldecode($this->uri->segment(5));
                }

                $oldCan = $this->caninesModel->get_canines($where)->row();
    
                $dataLog = array(
                    'log_canine_id' => $this->uri->segment(4),
                    'log_reg_number' => $oldCan->can_reg_number,
                    'log_a_s' => $oldCan->can_a_s,
                    'log_breed' => $oldCan->can_breed,
                    'log_gender' => $oldCan->can_gender,
                    'log_date_of_birth' => date('Y-m-d', strtotime($oldCan->can_date_of_birth)),
                    'log_color' => $oldCan->can_color,
                    'log_kennel_id' => $oldCan->can_kennel_id,
                    'log_photo' => $oldCan->can_photo,
                    'log_pay_photo' => $oldCan->can_pay_photo,
                    'log_stat' => $this->config->item('delete_stat'),
                    'log_user' => $this->session->userdata('use_id'),
                    'log_app_user' => $this->session->userdata('use_id'),
                    'log_date' => date('Y-m-d H:i:s'),
                    'log_app_date' => date('Y-m-d H:i:s'),
                    'log_chip_number' => $oldCan->can_chip_number,
                    'log_icr_number' => $oldCan->can_icr_number,
                    'log_member_id' => $oldCan->can_member_id,
                    'log_note' => $oldCan->can_note,
                );

                $whe['stb_can_id'] = $oldCan->can_id;
                $stb = $this->stambumModel->get_stambum($whe)->row();

                if($stb){
                    $dataStb = array(
                        'stb_stat' => $this->config->item('delete_stat'),
                        'stb_user' => $this->session->userdata('use_id'),
                        'stb_app_user' => $this->session->userdata('use_id'),
                        'stb_date' => date('Y-m-d H:i:s'),
                        'stb_app_date' => date('Y-m-d H:i:s'),
                    );
                    if ($this->uri->segment(5)){
                        $dataStb['stb_app_note'] = urldecode($this->uri->segment(5));
                    }
        
                    $logStb = array(
                        'log_stb_id' => $stb->stb_id,
                        'log_bir_id' => $stb->stb_bir_id,
                        'log_a_s' => $stb->stb_a_s,
                        'log_breed' => $stb->stb_breed,
                        'log_gender' => $stb->stb_gender,
                        'log_member_id' => $stb->stb_member_id,
                        'log_kennel_id' => $stb->ken_id,
                        'log_date_of_birth' => date('Y-m-d', strtotime($stb->stb_date_of_birth)),
                        'log_photo' => $stb->stb_photo,
                        'log_pay_photo' => $stb->stb_pay_photo,
                        'log_stat' => $this->config->item('delete_stat'),
                        'log_user' => $this->session->userdata('use_id'),
                        'log_app_user' => $this->session->userdata('use_id'),
                        'log_date' => date('Y-m-d H:i:s'),
                        'log_app_date' => date('Y-m-d H:i:s'),
                        'log_can_id' => $stb->stb_can_id,
                    );
                }

                $this->db->trans_strict(FALSE);
                $this->db->trans_start();
                $res = $this->caninesModel->update_canines($data, $where);
                if ($res){
                    $log = $this->logcanineModel->add_log($dataLog);
                    if ($log){
                        if($stb){
                            $stbRes = $this->stambumModel->update_stambum($dataStb, $whe);
                            if($stbRes){
                                $logStbRes = $this->logstambumModel->add_log($logStb);
                                if($logStbRes){
                                    $this->db->trans_complete();
                                    $this->session->set_flashdata('delete_success', TRUE);
                                    redirect("backend/Canines");
                                }
                                else{
                                    $err = 4;
                                }
                            }
                            else{
                                $err = 3;
                            }
                        }
                        else{
                            $this->db->trans_complete();
                            $this->session->set_flashdata('delete_success', TRUE);
                            redirect("backend/Canines");
                        }
                        
                    }
                    else{
                        $err = 1;
                    }
                }
                else{
                    $err = 2;
                }
                if ($err){
                    $this->db->trans_rollback();
                    $this->session->set_flashdata('delete_message', 'Failed to delete canine id = '.$this->uri->segment(4).'. Error code: '.$err);
                    redirect('backend/Canines');
                }
            }
            else{
                redirect("backend/Users/login");
            }
        }
        else{
        redirect("backend/Canines");
        }
    }

    public function log(){
        if ($this->uri->segment(4)){
            $where['log_canine_id'] = $this->uri->segment(4);
            $data['canine'] = $this->logcanineModel->get_logs($where)->result();
            $data['ped'] = $this->logpedigreeModel->get_logs($where)->result();
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
            $this->load->view('backend/log_canine', $data);
        }
        else{
            redirect('backend/Canines');
        }
    }

    public function tree(){
        if ($this->uri->segment(4)) {
            $can_id = $this->uri->segment(4);
            $max_level = 1;
            if($this->input->post('level') != null){
                $max_level = $this->input->post('level');
            }
            $pedigree = $this->get_can_pedigree($can_id, 0, $max_level);
            
            if ($pedigree) {
                $data['array'] = $this->create_array($pedigree);
                $this->load->view('backend/tree', $data);
            } else {
                $this->session->set_flashdata('error', "Dog's pedigree not found");
                redirect('backend/Canines');
            }
        } else {
            redirect('backend/Canines');
        }
    }
    public function get_can_pedigree($can_id, $level = 0, $max_level = 3)
    {
        // ambil data anjing pada level saat ini
        $where['can_id'] = $can_id;
        $data['canine'] = $this->caninesModel->get_exist_pedigrees($where)->row();

        // jika data anjing adalah data dummy kosong (NO FEMALE atau NO MALE), return array kosong
        if($can_id == $this->config->item('dam_id') || $can_id == $this->config->item('sire_id')){
            return [];
        }

        // jika data anjing tidak ditemukan atau max level sudah tercapai, return array kosong
        if (!$data['canine'] || $level > $max_level) {
            return [];
        }

        // ambil data ayah anjing dengan memanggil fungsi ini secara rekursif
        $sire['can_id'] = $data['canine']->ped_sire_id;
        $data['sire'] = $this->get_can_pedigree($sire['can_id'], $level + 1, $max_level);

        // ambil data ibu anjing dengan memanggil fungsi ini secara rekursif
        $dam['can_id'] = $data['canine']->ped_dam_id;
        $data['dam'] = $this->get_can_pedigree($dam['can_id'], $level + 1, $max_level);

        // simpan data level saat ini
        $data['level'] = $level;

        // return data untuk level saat ini
        return $data;
    }
    function create_array($pedigree)
    {
        $stack = [];
        $arr = 'nodes: [';

        $data = $pedigree;
        $arr .= $this->printers($stack, $data);

        $arr .= ']';
        return $arr;
    }
    function printers($stack, $data)
    {
        if (empty($data)) {
            return '';
        }

        global $idx;
        $idx++;
        array_push($stack, $idx);
        end($stack);
        $pid = prev($stack);
        $status = 'Sire';
        if($data['canine']->can_gender == 'FEMALE'){
            $status = 'Dam';
        }

        $arr = '';
        if ($idx == 1) {
            $arr .= '{ id: 1, name: "' . $data['canine']->can_a_s . '", status: "' . '' .'", img: "' . base_url('uploads/canine/' . $data['canine']->can_photo) . '" },';
        } else if ($data['canine']->can_a_s != 'NO MALE' && $data['canine']->can_a_s != 'NO FEMALE'){
            $arr .= '{ id: ' . $idx . ', pid: ' . $pid . ', name: "' . $data['canine']->can_a_s . '", status: "' . $status . '", img: "' . base_url('uploads/canine/' . $data['canine']->can_photo) . '" },';
        }

        if (!empty($data['sire']) || !empty($data['dam'])) {

            if (!empty($data['sire'])) {
                $arr .= $this->printers($stack, $data['sire']);
            }

            if (!empty($data['dam'])) {
                $arr .= $this->printers($stack, $data['dam']);
            }
        }

        return $arr;
    }
    function updateExpired(){
        $this->db->trans_strict(FALSE);
        $this->db->trans_start();

        //update all expired payment canine status
        $canines = $this->caninesModel->update_expired_canines();
        
        if ($canines) {
            $this->db->trans_complete();
            return true;
        } else {
            $this->db->trans_rollback();
            return false;
        }
	}
}
