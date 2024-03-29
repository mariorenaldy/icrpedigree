<?php
defined('BASEPATH') OR exit('No direct script access allowed');

#[\AllowDynamicProperties]

class Canines extends CI_Controller {
    public function __construct(){
        // Call the CI_Controller constructor
        parent::__construct();
        $this->load->model(array('caninesModel','memberModel', 'logcanineModel', 'logpedigreeModel', 'notification_model', 'notificationtype_model', 'pedigreesModel', 'trahModel', 'kennelModel'));
        $this->load->library(array('session', 'form_validation', 'pagination'));
        $this->load->helper(array('url', 'notif'));
        $this->load->database();
        date_default_timezone_set("Asia/Bangkok");
    }

    public function index(){
        $page = ($this->uri->segment(4)) ? ($this->uri->segment(4) - 1) : 0;
        $config['per_page'] = $this->config->item('backend_canine_count');
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

        $where['can_stat'] = $this->config->item('accepted');
        $where['kennels.ken_stat'] = $this->config->item('accepted');
        $data['canine'] = $this->caninesModel->get_canines($where, 'DATE_FORMAT(canines.can_app_date, "%Y-%m-%d %H:%i:%s") desc', $page * $config['per_page'], $this->config->item('backend_canine_count'))->result();
        
        $config['base_url'] = base_url().'/backend/Canines/index';
        $config['total_rows'] = $this->caninesModel->get_canines($where, 'DATE_FORMAT(canines.can_app_date, "%Y-%m-%d %H:%i:%s") desc', $page * $config['per_page'], 0)->num_rows();
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
            $like['can_a_s'] = $data['keywords'];
            $like['can_icr_number'] = $data['keywords'];
            $like['can_chip_number'] = $data['keywords'];
            $like['ken_name'] = $data['keywords'];
        }
        else
            $like = null;
        $where['can_stat'] = $this->config->item('accepted');
        $where['kennels.ken_stat'] = $this->config->item('accepted');
        $data['canine'] = $this->caninesModel->search_canines($like, $where, $data['sort_by'].' '.$data['sort_type'], $page * $config['per_page'], $this->config->item('backend_canine_count'))->result();

        $config['base_url'] = base_url().'/backend/Canines/search';
        $config['total_rows'] = $this->caninesModel->search_canines($like, $where, $data['sort_by'].' '.$data['sort_type'], $page * $config['per_page'], 0)->num_rows();
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

    public function list(){
        $page = ($this->uri->segment(4)) ? ($this->uri->segment(4) - 1) : 0;
        $config['per_page'] = $this->config->item('canine_list');
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

        $where['can_stat'] = $this->config->item('accepted');
        $where['can_rip'] = $this->config->item('canine_alive');
        $where['kennels.ken_stat'] = $this->config->item('accepted');
        $data['canine'] = $this->caninesModel->get_canines($where, 'DATE_FORMAT(canines.can_date, "%Y-%m-%d %H:%i:%s") desc', $page * $config['per_page'], $this->config->item('canine_list'))->result();
        
        $config['base_url'] = base_url().'/backend/Canines/list';
        $config['total_rows'] = $this->caninesModel->get_canines($where, 'DATE_FORMAT(canines.can_date, "%Y-%m-%d %H:%i:%s") desc', $page * $config['per_page'], 0)->num_rows();
        $this->pagination->initialize($config);

        $data['before'] = '';
        $data['after'] = '';
        $this->session->set_userdata('keywords', '');
        $this->load->view('backend/list_canines', $data);
    }

    public function search_list(){
        if ($this->input->post('before') && $this->input->post('after')){
            $this->session->set_userdata('before', $this->input->post('before'));
            $data['before'] = $this->input->post('before');
            $this->session->set_userdata('after', $this->input->post('after'));
            $data['after'] = $this->input->post('after');
        }
        else{
            if ($this->uri->segment(4)){
                $data['before'] = $this->session->userdata('before');
                $data['after'] = $this->session->userdata('after');
            }
            else{
                $this->session->set_userdata('before', '');
                $this->session->set_userdata('after', '');
                $data['before'] = '';
                $data['after'] = '';
            }
        }

        $page = ($this->uri->segment(4)) ? ($this->uri->segment(4) - 1) : 0;
        $config['per_page'] = $this->config->item('canine_list');
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

        if ($data['before'] && $data['after']){
            $piece = explode("-", $data['after']);
            $after = $piece[2]."-".$piece[1]."-".$piece[0];

            $piece = explode("-", $data['before']);
            $before = $piece[2]."-".$piece[1]."-".$piece[0];
            
            $where['can_date >= '] = $after;
            $where['can_date <= '] = $before;
        }
        $where['can_stat'] = $this->config->item('accepted');
        $where['can_rip'] = $this->config->item('canine_alive');
        $where['kennels.ken_stat'] = $this->config->item('accepted');
        $data['canine'] = $this->caninesModel->search_canines(null, $where, 'DATE_FORMAT(canines.can_date, "%Y-%m-%d %H:%i:%s") desc', $page * $config['per_page'], $this->config->item('canine_list'))->result();

        $config['base_url'] = base_url().'/backend/Canines/search_list';
        $config['total_rows'] = $this->caninesModel->search_canines(null, $where, 'DATE_FORMAT(canines.can_date, "%Y-%m-%d %H:%i:%s") desc', $page * $config['per_page'], 0)->num_rows();
        $this->pagination->initialize($config);
        $this->load->view('backend/list_canines', $data);
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

    public function search_kennel(){
        if ($this->session->userdata('use_username')) {
            $wheTrah['tra_stat != '] = $this->config->item('deleted');
            $data['trah'] = $this->trahModel->get_trah($wheTrah)->result();

            $like['mem_name'] = $this->input->post('mem_name');
            $like['ken_name'] = $this->input->post('mem_name');
            $where['mem_stat'] = $this->config->item('accepted');
            $where['ken_stat'] = $this->config->item('accepted');
            $data['member'] = $this->memberModel->search_members($like, $where)->result();

            $whe['ken_member_id'] =  $this->input->post('can_member_id');
            $whe['ken_stat'] = $this->config->item('accepted');
            $data['kennel'] = $this->kennelModel->get_kennels($whe)->result();
            $this->load->view('backend/add_canine', $data);
        }
        else {
          redirect("backend/Users/login");
        }
    }
  
    public function validate_add(){ 
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

            $like['mem_name'] = $this->input->post('mem_name');
            $like['ken_name'] = $this->input->post('mem_name');
            $where['mem_stat'] = $this->config->item('accepted');
            $where['ken_stat'] = $this->config->item('accepted');
            $data['member'] = $this->memberModel->search_members($like, $where)->result();

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
                    $this->session->set_flashdata('error_message', 'Duplicate ICR number');
                }
        
                if (!$err && $this->input->post('can_chip_number') != "-" && $this->caninesModel->check_for_duplicate(0, 'can_chip_number', $this->input->post('can_chip_number'))){
                    $err++;
                    $this->session->set_flashdata('error_message', 'Duplicate microchip number');
                }

                $piece = explode("-", $this->input->post('can_date_of_birth'));
                $dob = $piece[2] . "-" . $piece[1] . "-" . $piece[0];
                if (!$err){
                    $ts = new DateTime();
					$ts_dob = new DateTime($dob);
                    if ($ts_dob > $ts){
                        $err++;
                        $this->session->set_flashdata('error_message', 'Tanggal lahir anjing harus lebih dari '.$this->config->item('min_jarak_lapor_anak').' hari');
                    }
                    else{ // min 45 hari
                        $diff = floor($ts->diff($ts_dob)->days/$this->config->item('min_jarak_lapor_anak'));
                        if ($diff < 1){
                            $err++;
                            $this->session->set_flashdata('error_message', 'Tanggal lahir anjing harus lebih dari '.$this->config->item('min_jarak_lapor_anak').' hari');
                        }
                    }
                }

                if (!$err){
                    file_put_contents($img_name, $uploadedImg);
                    $photo = str_replace($this->config->item('path_canine'), '', $img_name);

                    $id = $this->caninesModel->record_count() + 895; // gara2 data canine dihapus
                    $dataCan = array(
                        'can_id' => $id,
                        'can_member_id' => $this->input->post('can_member_id'),
                        'can_reg_number' => strtoupper($this->input->post('can_reg_number')),
                        'can_breed' => $this->input->post('can_breed'),
                        'can_gender' => $this->input->post('can_gender'),
                        'can_date_of_birth' => $dob,
                        'can_color' => $this->input->post('can_color'),
                        'can_kennel_id' => $this->input->post('can_kennel_id'),
                        'can_reg_date' => date("Y/m/d"),
                        'can_photo' => $photo,
                        'can_stat' => $this->config->item('accepted'),
                        'can_app_user' => $this->session->userdata('use_id'),
                        'can_app_date' => date('Y-m-d H:i:s'),
                        'can_chip_number' => $this->input->post('can_chip_number'),
                        'can_icr_number' => $this->input->post('can_icr_number'),
                        'can_note' => $this->input->post('can_note'),
                        'can_user' => $this->session->userdata('use_id'),
                        'can_date' => date('Y-m-d H:i:s'),
                    );

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
                        $this->session->set_flashdata('error_message', 'Duplicate canine name');
                    }

                    if (strlen($dataCan['can_a_s']) >= $this->config->item('can_a_s_length')){
                        $err++;
                        $this->session->set_flashdata('error_message', 'Nama anjing terlalu panjang. Ditambah dengan nama kennel, harus di bawah '.$this->config->item('can_a_s_length').' karakter');
                    }

                    $dataLog = array(
                        'log_canine_id' => $id,
                        'log_reg_number' => strtoupper($this->input->post('can_reg_number')),
                        'log_a_s' => $dataCan['can_a_s'],
                        'log_breed' => $this->input->post('can_breed'),
                        'log_gender' => $this->input->post('can_gender'),
                        'log_date_of_birth' => $dob,
                        'log_color' => $this->input->post('can_color'),
                        'log_kennel_id' => $this->input->post('can_kennel_id'),
                        'log_photo' => $photo,
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
                        'ped_canine_id' => $id,
                    );

                    $dataLogPed = array(
                        'log_sire_id' => $this->config->item('sire_id'),
                        'log_dam_id' => $this->config->item('dam_id'),
                        'log_canine_id' => $id,
                        'log_user' => $this->session->userdata('use_id'),
                        'log_date' => date('Y-m-d H:i:s'),
                    );

                    if (!$err) {
                        $this->db->trans_strict(FALSE);
                        $this->db->trans_start();
                        $canines = $this->caninesModel->add_canines($dataCan);
                        if ($canines) {
                            $pedigree = $this->pedigreesModel->add_pedigrees($dataPed);
                            if ($pedigree) {
                                $log = $this->logcanineModel->add_log($dataLog);
                                if ($log){
                                    $res = $this->logpedigreeModel->add_log($dataLogPed);
                                    if ($res){
                                        $result = $this->notification_model->add(13, $id, $this->input->post('can_member_id'), "Nama anjing / Canine Name: ".$dataCan['can_a_s']);
                                        if ($result){
                                            $this->db->trans_complete();
                                            $whe['mem_id'] = $this->input->post('can_member_id');
                                            $member = $this->memberModel->get_members($whe)->row();
                                            if ($member->mem_firebase_token){
                                                $notif = $this->notificationtype_model->get_by_id(13);
                                                firebase_notif($member->mem_firebase_token, $notif[0]->title, $notif[0]->description);
                                            }
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

    public function search_kennel_update(){
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
            
            $like['mem_name'] = $this->input->post('mem_name');
            $like['ken_name'] = $this->input->post('mem_name');
            $wheMember['mem_stat'] = $this->config->item('accepted');
            $wheMember['ken_stat'] = $this->config->item('accepted');
            $data['member'] = $this->memberModel->search_members($like, $wheMember)->result();

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
                    $this->session->set_flashdata('error_message', 'No. ICR tidak boleh sama');
                }

                if (!$err && $this->input->post('can_chip_number') != "-" && $this->caninesModel->check_for_duplicate($this->input->post('can_id'), 'can_chip_number', $this->input->post('can_chip_number'))){
                    $err++;
                    $this->session->set_flashdata('error_message', 'No. Microchip tidak boleh sama');
                }

                if (!$err && $this->caninesModel->check_for_duplicate($this->input->post('can_id'), 'can_a_s', $this->input->post('can_a_s'))){
                    $err++;
                    $this->session->set_flashdata('error_message', 'Nama canine tidak boleh sama');
                }

                if (strlen($this->input->post('can_a_s')) >= $this->config->item('can_a_s_length')){
                    $err++;
                    $this->session->set_flashdata('error_message', 'Nama anjing terlalu panjang. Ditambah dengan nama kennel, harus di bawah '.$this->config->item('can_a_s_length').' karakter');
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

                    if ($photo != '-')
                        $dataCan['can_photo'] = $photo;
                    
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
                                $whe_can['mem_id'] = $can->can_member_id;
                                $member = $this->memberModel->get_members($whe_can)->row();
                                if ($member->mem_firebase_token){
                                    $notif = $this->notificationtype_model->get_by_id(11);
                                    firebase_notif($member->mem_firebase_token, $notif[0]->title, $notif[0]->description);
                                }
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
                            $whe_can['mem_id'] = $can->can_member_id;
                            $member = $this->memberModel->get_members($whe_can)->row();
                            if ($member->mem_firebase_token){
                                $notif = $this->notificationtype_model->get_by_id(12);
                                firebase_notif($member->mem_firebase_token, $notif[0]->title, $notif[0]->description);
                            }
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
                $data['can_stat'] = $this->config->item('rejected');
                $data['can_user'] = $this->session->userdata('use_id');
                $data['can_date'] = date('Y-m-d H:i:s');
                if ($this->uri->segment(5)){
                    $data['can_app_note'] = urldecode($this->uri->segment(5));
                }

                $dataLog = array(
                    'log_canine_id' => $this->uri->segment(4),
                    'log_stat' => $this->config->item('rejected'),
                    'log_user' => $this->session->userdata('use_id'),
                    'log_date' => date('Y-m-d H:i:s'),
                );

                $this->db->trans_strict(FALSE);
                $this->db->trans_start();
                $res = $this->caninesModel->update_canines($data, $where);
                if ($res){
                    $log = $this->logcanineModel->add_log($dataLog);
                    if ($log){
                        $this->db->trans_complete();
                        $this->session->set_flashdata('delete_success', TRUE);
                        redirect("backend/Canines");
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
                    $this->session->set_flashdata('error_message', 'Failed to delete canine id = '.$this->uri->segment(4).'. Error code: '.$err);
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

    public function to_csv(){
        $where['can_stat'] = $this->config->item('accepted');
        $where['kennels.ken_stat'] = $this->config->item('accepted');
        $canine = $this->caninesModel->get_canines($where, 'can_icr_number, can_chip_number', 0, 0)->result();

        $Arr = Array(); 
        $Arr[] = array('Current Reg. Number','ICR Number','Chip Number','Name','Breed','Gender','Color','Date of Birth','Kennel','Owner','Note','Reg. Date','Status');
        foreach ($canine as $row){
            $Arr[] = array($row->can_reg_number, $row->can_icr_number, $row->can_chip_number, $row->can_a_s, $row->can_breed, $row->can_gender, $row->can_color, $row->can_date_of_birth, $row->ken_name, $row->mem_name, $row->can_note, $row->can_reg_date, $row->stat_name.'( '.$row->use_username.' / '.$row->can_app_date.' )');
        }

        header("Content-type: application/csv");
        header('Content-Disposition: attachment; filename="canines_'.date('d-m-Y').'.csv"');
        header("Pragma: no-cache");
        header("Expires: 0");

        $handle = fopen('php://output', 'w');
        foreach ($Arr as $row) {
            fputcsv($handle, $row);
        }
        fclose($handle);
    }
}
