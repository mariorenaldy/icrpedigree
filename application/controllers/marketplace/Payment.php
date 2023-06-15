<?php
defined('BASEPATH') OR exit('No direct script access allowed');

#[\AllowDynamicProperties]

class Payment extends CI_Controller {
    public function __construct(){
		parent::__construct();
		$this->load->model(array('OrderModel', 'ProductModel'));
		$this->load->library(array('session', 'form_validation'));
		$this->load->helper(array('url'));
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
	public function checkout(){
		$clientId = "BRN-0222-1677984841764";
		$requestId = $this->input->post('inv');
		$date = new DateTime("now", new DateTimeZone('UTC'));
		$requestDate = $date->format('Y-m-d\TH:i:s\Z');
		$targetPath = "/checkout/v1/payment";
		$secretKey = "SK-WjYbHmZGDEhveR9kBxCW";

		$amount = $this->input->post('amount');
		$inv = $requestId;

		// Data
		$order = array(
			"amount" => $amount,
			"invoice_number" => $inv,
			"callback_url" => "http://localhost/icrpedigree/marketplace/Orders/cek_status/".$requestId
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
				$response['inv'] = $inv;
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
	// function getRandomString($length = 8) {
	// 	$characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
	// 	$string = '';
	
	// 	for ($i = 0; $i < $length; $i++) {
	// 		$string .= $characters[mt_rand(0, strlen($characters) - 1)];
	// 	}
	
	// 	return $string;
	// }
	function generateInvoice($length = 8) {
		$characters = '0123456789';
		$string = '';
	
		for ($i = 0; $i < $length; $i++) {
			$string .= $characters[mt_rand(0, strlen($characters) - 1)];
		}
	
		$string = 'INV-'.$string;
		return $string;
	}
	function saveOrder(){
		$pro_id = $this->input->post('pro_id');
		$quantity = $this->input->post('quantity');
		$inv = $this->generateInvoice();
		$amount = $this->input->post('amount');

		$data = array(
			'ord_mem_id' => $this->session->userdata('mem_id'),
			'ord_pro_id' => $pro_id,
			'ord_invoice' => $inv,
			'ord_quantity' => $quantity,
			'ord_total_price' => $amount,
			'ord_created_at' => date('Y-m-d H:i:s'),
			'ord_pay_due_date' => date('Y-m-d H:i:s', strtotime('1 hour')),
			'ord_stat_id' => $this->config->item('order_not_paid')
		);

		$err = 0;

		//update product stock
		$whePro['pro_id'] = $pro_id;
		$stock = $this->ProductModel->get_stock($whePro);
		$dataPro = array(
			'pro_stock' => $stock-$quantity
		);

		$this->db->trans_strict(FALSE);
		$this->db->trans_start();
		$products = $this->ProductModel->update_products($dataPro, $whePro);
		if ($products) {
			$id = $this->OrderModel->add_orders($data);
			if ($id) {
				$this->db->trans_complete();
			} else {
				$err = 2;
			}
	
			if ($err) {
				$this->db->trans_rollback();
				echo 'failed';
			}
			else{
				echo $inv;
			}
		} else {
			$err = 1;
		}

		if ($err) {
			$this->db->trans_rollback();
			echo 'failed';
		}

	}
}