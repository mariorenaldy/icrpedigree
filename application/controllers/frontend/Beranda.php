<?php
defined('BASEPATH') OR exit('No direct script access allowed');

#[\AllowDynamicProperties]

class Beranda extends CI_Controller {
    public function __construct(){
		parent::__construct();
        $this->load->model(array('caninesModel', 'MemberModel'));
		$this->load->library(array('session'));
        $this->load->helper(array('url', 'cookie'));
        $this->load->database();
		
        if ($this->input->cookie('site_lang')) {
            $this->lang->load('common', $this->input->cookie('site_lang'));
            $this->lang->load('home', $this->input->cookie('site_lang'));
        } else {
            set_cookie('site_lang', 'indonesia', '2147483647'); 
            $this->lang->load('common','indonesia');
            $this->lang->load('home','indonesia');
        }
	}

	public function index(){
        $this->updateToFree();
        $this->load->view("frontend/beranda");
	}

    function updateToFree(){
        $this->db->trans_strict(FALSE);
        $this->db->trans_start();

        //update all expired member type to free
        $members = $this->MemberModel->update_expired_members();
        if ($members) {
            $this->db->trans_complete();
            return true;
        } else {
            $this->db->trans_rollback();
            return false;
        }
    }
}