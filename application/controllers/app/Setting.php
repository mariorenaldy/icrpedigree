<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Setting extends CI_Controller{
	public function __construct(){
		parent::__construct();
		$this->load->model(array('SettingModel'));
		$this->load->library(array('session', 'form_validation'));
		$this->load->helper(array('url'));
		$this->load->database();
	}

	public function getall(){
		$setting = $this->SettingModel->get_all();
		echo json_encode($setting); 
	}
}
