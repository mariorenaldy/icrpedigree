<?php
defined('BASEPATH') OR exit('No direct script access allowed');

#[\AllowDynamicProperties]

class Beranda extends CI_Controller {
    public function __construct()
    {
		parent::__construct();
		$this->load->library(array('session'));
        $this->load->helper(array('url'));
		
		$site_lang = $this->session->userdata('site_lang');
        if ($site_lang) {
            $this->lang->load('home',$this->session->userdata('site_lang'));
        } else {
            $this->lang->load('home','indonesia');
        }
	}

	public function index()
	{
        $this->load->view("frontend/beranda");
	}
}