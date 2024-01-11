<?php
defined('BASEPATH') OR exit('No direct script access allowed');

#[\AllowDynamicProperties]

class Payment extends CI_Controller {
    public function __construct(){
		parent::__construct();
		$this->load->model(array('OrderModel', 'ProductModel'));
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
			"callback_url" => base_url()."marketplace/Orders/cek_status/".$requestId
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
		else{
			echo 'Curl error: ' . curl_error($ch);
		}

		// Close cURL
		curl_close($ch);
	}
	function generateInvoice($length = 8) {
		$characters = '0123456789';
		$string = '';
	
		for ($i = 0; $i < $length; $i++) {
			$string .= $characters[mt_rand(0, strlen($characters) - 1)];
		}
	
		$string = 'INVB-'.$string;
		return $string;
	}
	function saveOrder(){
		$inv = $this->generateInvoice();
		$amount = $this->input->post('amount');
		$data = array(
			'ord_mem_id' => $this->session->userdata('mem_id'),
			'ord_invoice' => $inv,
			'ord_city_id' => $this->input->post('city'),
			'ord_address' => $this->input->post('address'),
			'ord_shipping_id' => $this->input->post('shipping'),
			'ord_shipping_type' => $this->input->post('shippingType'),
			'ord_shipping_cost' => $this->input->post('shippingCost'),
			'ord_date' => date('Y-m-d H:i:s'),
			'ord_pay_due_date' => date('Y-m-d H:i:s', strtotime('1 hour')),
			'ord_total_price' => $amount,
			'ord_stat_id' => $this->config->item('order_not_paid')
		);

		$err = 0;

		$this->db->trans_strict(FALSE);
		$this->db->trans_start();

		$this->OrderModel->add_orders($data);
		$idOrder = $this->db->insert_id();

		foreach($this->cart->contents() as $item){
			$data = array(
				'itm_ord_id' => $idOrder,
				'itm_pro_id' => $item['id'],
				'itm_quantity' => $item['qty'],
				'itm_subtotal' => $item['subtotal']
			);

			//update product stock
			$whePro['pro_id'] = $item['id'];
			$stock = $this->ProductModel->get_stock($whePro);
			$stockAfter = $stock-$item['qty'];
			if($stockAfter < 0){
				$err = 4;
				break;
			}
			$dataPro = array(
				'pro_stock' => $stockAfter
			);

			$products = $this->ProductModel->update_products($dataPro, $whePro);
			if ($products) {
				$idItem = $this->OrderModel->add_order_items($data);
				if (!$idItem) {
					$err = 2;
					break;
				}
			} else {
				$err = 1;
				break;
			}
		}

		$this->db->trans_complete();

		$this->cart->destroy();

		if ($err) {
			echo 'failed';
		}
		else{
			echo $inv;
		}
	}
}