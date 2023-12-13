<?php
defined('BASEPATH') OR exit('No direct script access allowed');

#[\AllowDynamicProperties]

class Payment extends CI_Controller {
    public function __construct(){
		parent::__construct();
		$this->load->model(array('caninesModel'));
		$this->load->library(array('session', 'form_validation'));
		$this->load->helper(array('url', 'cookie'));
		$this->load->database();
		date_default_timezone_set("Asia/Bangkok");

		if ($this->input->cookie('site_lang')) {
            $this->lang->load('common', $this->input->cookie('site_lang'));
        } else {
            set_cookie('site_lang', 'indonesia', '2147483647'); 
            $this->lang->load('common','indonesia');
        }
	}
	function generate_signature($componentSignature, $secretKey){
		$signature = base64_encode(hash_hmac('sha256', $componentSignature, $secretKey, true));
		return $signature;
	}
	public function checkout($controllers, $amount, $inv){
		$clientId = "BRN-0222-1677984841764";
		$requestId = $inv;
		$date = new DateTime("now", new DateTimeZone('UTC'));
		$requestDate = $date->format('Y-m-d\TH:i:s\Z');
		$targetPath = "/checkout/v1/payment";
		$secretKey = "SK-WjYbHmZGDEhveR9kBxCW";

		// Data
		$order = array(
			"amount" => $amount,
			"invoice_number" => $inv,
			"callback_url" => base_url()."frontend/".$controllers."/cek_status/".$requestId
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
			CURLOPT_FAILONERROR => true,
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
				header( "Location: $url" );
				break;
			  default:
				$response['status'] = 'error';
				$response['code'] = $http_code;
				$response['message'] = json_decode($result)->message[0];
				$this->session->set_flashdata('error_message', $response['status'].' '.$response['code'].': '.$response['message']);
				redirect("frontend/Canines");
			}
		}
		else{
			// echo 'Curl error: ' . curl_error($ch);
			$this->session->set_flashdata('error_message', 'Curl error: '.curl_error($ch));
			redirect('frontend/Canines');
		}

		// Close cURL
		curl_close($ch);
	}
}