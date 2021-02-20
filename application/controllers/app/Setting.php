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

	// public function index(){
	// 	$data['setting'] = $this->setting_model->get_all();
	// 	$this->load->view('edit_setting.php', $data);
	// }

	// public function validates(){
	//    	$this->form_validation->set_error_delimiters('<div>','</div>');
	// 	$this->form_validation->set_message('required', '%s wajib diisi');
	// 	$this->form_validation->set_rules('tc', 'Term & Condition', 'trim|required');
		
	// 	if ($this->form_validation->run() == FALSE){
	// 	   	$this->load->view('edit_setting.php');
	// 	}
	// 	else{
	// 		$result = $this->setting_model->edit(); 
	// 		if (!$result){
	// 			$this->session->set_flashdata('edit_error', TRUE);
	// 			$this->load->view('edit_setting.php');
	// 		}
	// 		else{
	// 			$this->session->set_flashdata('edit_success', TRUE);
	// 			redirect('Setting');
	// 		}
	//     }
	// }

	// public function get_tc(){
	// 	$data['setting'] = $this->setting_model->get_all();
	// 	$this->load->view('term_condition.php', $data);
	// }
}
