<?php
defined('BASEPATH') OR exit('No direct script access allowed');

#[\AllowDynamicProperties]

class Beranda extends CI_Controller {
    public function __construct(){
		parent::__construct();
		$this->load->library(array('session'));
        $this->load->helper(array('url', 'cookie'));
		
        if ($this->input->cookie('site_lang')) {
            $this->lang->load('home', $this->input->cookie('site_lang'));
        } else {
            set_cookie('site_lang', 'indonesia', '2147483647'); 
            $this->lang->load('home','indonesia');
        }
	}

	public function index(){
        $this->load->view("frontend/beranda");
	}
}