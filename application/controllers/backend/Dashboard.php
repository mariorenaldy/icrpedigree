<?php
defined('BASEPATH') or exit('No direct script access allowed');

#[\AllowDynamicProperties]

class Dashboard extends CI_Controller
{
	public function __construct()
	{
		// Call the CI_Controller constructor
		parent::__construct();
		$this->load->model(array('caninesModel', 'memberModel', 'studModel', 'birthModel', 'stambumModel', 'trahModel', 'userModel', 'productModel', 'orderModel'));
		$this->load->library(array('session'));
		$this->load->helper(array('url'));
	}

	public function index()
	{
		if ($this->session->userdata('use_username')) {
			$data['canCount'] = $this->caninesModel->record_count();
			$data['memCount'] = $this->memberModel->record_count();
			$data['studCount'] = $this->studModel->record_count();
			$data['birthCount'] = $this->birthModel->record_count();
			$data['stbCount'] = $this->stambumModel->record_count();
			$data['trahCount'] = $this->trahModel->record_count();
			$data['userCount'] = $this->userModel->record_count();
			$data['proCount'] = $this->productModel->record_count();
			$data['orderCount'] = $this->orderModel->record_count();
			$data['income'] = $this->orderModel->get_income()->income;

			$data['monthly_income'] = $this->orderModel->getMonthlyIncome();
			$data['memberData'] = $this->memberModel->getMonthlyData();
			$data['canineData'] = $this->caninesModel->getMonthlyData();
			$data['studData'] = $this->studModel->getMonthlyData();
			$data['birthData'] = $this->birthModel->getMonthlyData();
			$data['year'] = date("Y");

			$this->load->view('backend/dashboard', $data);
		} else {
			redirect('backend/Users/login');
		}
	}
	public function getIncomeData(){
		$year = $this->input->post('yearValue');
		$income = $this->orderModel->getMonthlyIncome($year);
		$jsonIncome = json_encode($income);
		echo $jsonIncome;
    }
	public function getReportData(){
		$year = $this->input->post('yearValue');
		$data['member'] = $this->memberModel->getMonthlyData($year);
		$data['canine'] = $this->caninesModel->getMonthlyData($year);
		$data['stud'] = $this->studModel->getMonthlyData($year);
		$data['birth'] = $this->birthModel->getMonthlyData($year);
		$jsonIncome = json_encode($data);
		echo $jsonIncome;
    }
}
