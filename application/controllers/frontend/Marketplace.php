<?php
defined('BASEPATH') OR exit('No direct script access allowed');

#[\AllowDynamicProperties]

class Marketplace extends CI_Controller {
    public function __construct(){
		parent::__construct();
		$this->load->model(array('productModel', 'serviceModel'));
		$this->load->library(array('session', 'form_validation', 'pagination'));
		$this->load->helper(array('url'));
		$this->load->database();
	}

	public function index(){
        $this->load->view("frontend/marketplace");
	}
	public function products(){
		//pagination
		$config['base_url'] = base_url() . '/frontend/Marketplace/products';
		$config['total_rows'] = $this->productModel->record_count();
		$config['per_page'] = 9;
		
		//styling pagination
		$config['full_tag_open'] = '<nav><ul class="pagination justify-content-end">';
		$config['full_tag_close'] = '</ul></nav>';
		
		$config['first_link'] = 'First';
		$config['first_tag_open'] = '<li class="page-item">';
		$config['first_tag_close'] = '</li>';
		
		$config['last_link'] = 'Last';
		$config['last_tag_open'] = '<li class="page-item">';
		$config['last_tag_close'] = '</li>';

		$config['next_tag_open'] = '<li class="page-item">';
		$config['next_tag_close'] = '</li>';

		$config['prev_tag_open'] = '<li class="page-item">';
		$config['prev_tag_close'] = '</li>';

		$config['cur_tag_open'] = '<li class="page-item active"><a class="page-link" href="#">';
		$config['cur_tag_close'] = '</a></li>';

		$config['num_tag_open'] = '<li class="page-item">';
		$config['num_tag_close'] = '</li>';

		$config['attributes'] = array('class' => 'page-link');

		//initialize pagination
		$this->pagination->initialize($config);

		$data['start'] = $this->uri->segment(4);
		$data['products'] = $this->productModel->fetch_data($config['per_page'], $data['start'])->result();

        $this->load->view("frontend/products", $data);
	}
	public function product_detail(){
        $this->load->view("frontend/product_detail");
	}
	public function services(){
		//pagination
		$config['base_url'] = base_url() . '/frontend/Marketplace/services';
		$config['total_rows'] = $this->serviceModel->record_count();
		$config['per_page'] = 9;
		
		//styling pagination
		$config['full_tag_open'] = '<nav><ul class="pagination justify-content-end">';
		$config['full_tag_close'] = '</ul></nav>';
		
		$config['first_link'] = 'First';
		$config['first_tag_open'] = '<li class="page-item">';
		$config['first_tag_close'] = '</li>';
		
		$config['last_link'] = 'Last';
		$config['last_tag_open'] = '<li class="page-item">';
		$config['last_tag_close'] = '</li>';

		$config['next_tag_open'] = '<li class="page-item">';
		$config['next_tag_close'] = '</li>';

		$config['prev_tag_open'] = '<li class="page-item">';
		$config['prev_tag_close'] = '</li>';

		$config['cur_tag_open'] = '<li class="page-item active"><a class="page-link" href="#">';
		$config['cur_tag_close'] = '</a></li>';

		$config['num_tag_open'] = '<li class="page-item">';
		$config['num_tag_close'] = '</li>';

		$config['attributes'] = array('class' => 'page-link');

		//initialize pagination
		$this->pagination->initialize($config);

		$data['start'] = $this->uri->segment(4);
		$data['services'] = $this->serviceModel->fetch_data($config['per_page'], $data['start'])->result();

        $this->load->view("frontend/services", $data);
	}
	public function service_detail(){
        $this->load->view("frontend/service_detail");
	}
	public function payment(){
        $this->load->view("frontend/payment");
	}
	function generate_signature($componentSignature, $secretKey){
		$signature = base64_encode(hash_hmac('sha256', $componentSignature, $secretKey, true));
		return $signature;
	}
	public function checkout(){
		date_default_timezone_set('UTC');

		$clientId = "BRN-0222-1677984841764";
		$requestId = $this->getRandomString();
		$requestDate = date('Y-m-d\TH:i:s\Z');
		$targetPath = "/checkout/v1/payment";
		$secretKey = "SK-WjYbHmZGDEhveR9kBxCW";

		$amount = $this->input->post('amount');
		$inv = $this->getRandomString();;

		// Data
		$order = array(
			"amount" => $amount,
			"invoice_number" => $inv
		);
		$payment = array(
			"payment_due_date" => 60
		);
		$data = array(
			"order" => $order,
			"payment" => $payment,
		);

		// Generate Digest
		$digestValue = base64_encode(hash('sha256', json_encode($data), true));
		
		// Prepare Signature Component
		$componentSignature = "Client-Id:" . $clientId . "\n" . 
							  "Request-Id:" . $requestId . "\n" .
							  "Request-Timestamp:" . $requestDate . "\n" . 
							  "Request-Target:" . $targetPath . "\n" .
							  "Digest:" . $digestValue;

		// Calculate HMAC-SHA256 base64 from all the components above
		// $signature = base64_encode(hash_hmac('sha256', $componentSignature, $secretKey, true));
		$signature = $this->generate_signature($componentSignature, $secretKey);

		// Initiate cURL
		$ch = curl_init();

		curl_setopt_array($ch, array(
			CURLOPT_URL => 'https://api-sandbox.doku.com/checkout/v1/payment',
			CURLOPT_RETURNTRANSFER => true,
			CURLOPT_ENCODING => '',
			CURLOPT_MAXREDIRS => 10,
			CURLOPT_TIMEOUT => 0,
			CURLOPT_FOLLOWLOCATION => true,
			CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
			CURLOPT_CUSTOMREQUEST => 'POST',
			CURLOPT_POSTFIELDS => json_encode($data),
			CURLOPT_HTTPHEADER => array(
				'Content-Type: application/json',
				'Client-Id: '.$clientId,
				'Request-Id: '.$requestId,
				'Request-Timestamp: '.$requestDate,
				'Signature: HMACSHA256='.$signature,
			),
		));

		// Execute the request
		$result = curl_exec($ch);

		if (!curl_errno($ch)) {
			switch ($http_code = curl_getinfo($ch, CURLINFO_HTTP_CODE)) {
			  case 200:  # OK
				$url = json_decode($result)->response->payment->url;
				$response['status'] = 'success';
				$response['url'] = $url;
				header('Content-type: application/json');
				echo json_encode($response);
				break;
			  default:
				$response['status'] = 'error';
				$response['code'] = $http_code;
				$response['message'] = json_decode($result)->message[0];
				header('Content-type: application/json');
				echo json_encode($response);
			}
		}

		// Close cURL
		curl_close($ch);
	}
	function getRandomString($length = 8) {
		$characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
		$string = '';
	
		for ($i = 0; $i < $length; $i++) {
			$string .= $characters[mt_rand(0, strlen($characters) - 1)];
		}
	
		return $string;
	}
}