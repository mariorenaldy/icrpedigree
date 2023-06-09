<?php
defined('BASEPATH') or exit('No direct script access allowed');

#[\AllowDynamicProperties]

class Orders extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model(array('OrderModel', 'ProductModel'));
		$this->load->library(array('session', 'form_validation', 'pagination'));
		$this->load->helper(array('url'));
		$this->load->database();
		date_default_timezone_set("Asia/Bangkok");

		if ($this->input->cookie('site_lang')) {
            $this->lang->load('common', $this->input->cookie('site_lang'));
            $this->lang->load('product', $this->input->cookie('site_lang'));
            $this->lang->load('order', $this->input->cookie('site_lang'));
        } else {
            set_cookie('site_lang', 'indonesia', '2147483647'); 
            $this->lang->load('common','indonesia');
            $this->lang->load('product','indonesia');
            $this->lang->load('order','indonesia');
        }
	}
	public function index(){
		if ($this->session->userdata('mem_id')){
			$this->updateExpired();
			$page = ($this->uri->segment(4)) ? ($this->uri->segment(4) - 1) : 0;
			$config['per_page'] = $this->config->item('order_count');
			$config['uri_segment'] = 4;
			$config['use_page_numbers'] = TRUE;

			//Encapsulate whole pagination 
			$config['full_tag_open'] = '<ul class="pagination justify-content-end">';
			$config['full_tag_close'] = '</ul>';

			//First link of pagination
			$config['first_link'] = 'Pertama';
			$config['first_tag_open'] = '<li>';
			$config['first_tag_close'] = '</li>';

			//Customizing the “Digit” Link
			$config['num_tag_open'] = '<li>';
			$config['num_tag_close'] = '</li>';

			//For PREVIOUS PAGE Setup
			$config['prev_link'] = '<';
			$config['prev_tag_open'] = '<li>';
			$config['prev_tag_close'] = '</li>';

			//For NEXT PAGE Setup
			$config['next_link'] = '>';
			$config['next_tag_open'] = '<li>';
			$config['next_tag_close'] = '</li>';

			//For LAST PAGE Setup
			$config['last_link'] = 'Akhir';
			$config['last_tag_open'] = '<li>';
			$config['last_tag_close'] = '</li>';

			//For CURRENT page on which you are
			$config['cur_tag_open'] = '<li class="active"><a class="page-link bg-dark text-warning border-light" href="#">';
			$config['cur_tag_close'] = '</a></li>';

			$config['attributes'] = array('class' => 'page-link bg-dark text-light');

			$where['ord_mem_id'] = $this->session->userdata('mem_id');
			$data['orders'] = $this->OrderModel->get_orders($where, 'ord_created_at desc', $page * $config['per_page'], $this->config->item('order_count'))->result();

			$config['base_url'] = base_url().'/marketplace/Orders/index';
			$config['total_rows'] = $this->OrderModel->get_orders($where, 'ord_created_at desc', $page * $config['per_page'], 0)->num_rows();
			$this->pagination->initialize($config);

			$data['keywords'] = '';
            $this->session->set_userdata('keywords', '');
			$this->load->view('marketplace/orders_frontend', $data);
		}
		else{
			redirect('frontend/Members');
		}
    }

	public function search(){
		if ($this->session->userdata('mem_id')){
			if ($this->input->post('keywords')){
				$this->session->set_userdata('keywords', $this->input->post('keywords'));
				$data['keywords'] = $this->input->post('keywords');
			}
			else{
                if ($this->uri->segment(4))
                    $data['keywords'] = $this->session->userdata('keywords');
                else{
                    $data['keywords'] = '';
                    $this->session->set_userdata('keywords', '');
                }
			}
			
			$page = ($this->uri->segment(4)) ? ($this->uri->segment(4) - 1) : 0;
			$config['per_page'] = $this->config->item('order_count');
			$config['uri_segment'] = 4;
			$config['use_page_numbers'] = TRUE;

			//Encapsulate whole pagination 
			$config['full_tag_open'] = '<ul class="pagination justify-content-end">';
			$config['full_tag_close'] = '</ul>';

			//First link of pagination
			$config['first_link'] = 'Pertama';
			$config['first_tag_open'] = '<li>';
			$config['first_tag_close'] = '</li>';

			//Customizing the “Digit” Link
			$config['num_tag_open'] = '<li>';
			$config['num_tag_close'] = '</li>';

			//For PREVIOUS PAGE Setup
			$config['prev_link'] = '<';
			$config['prev_tag_open'] = '<li>';
			$config['prev_tag_close'] = '</li>';

			//For NEXT PAGE Setup
			$config['next_link'] = '>';
			$config['next_tag_open'] = '<li>';
			$config['next_tag_close'] = '</li>';

			//For LAST PAGE Setup
			$config['last_link'] = 'Akhir';
			$config['last_tag_open'] = '<li>';
			$config['last_tag_close'] = '</li>';

			//For CURRENT page on which you are
			$config['cur_tag_open'] = '<li class="active"><a class="page-link bg-dark text-warning border-light" href="#">';
			$config['cur_tag_close'] = '</a></li>';

			$config['attributes'] = array('class' => 'page-link bg-dark text-light');

			$like['pro_name'] = $data['keywords'];
			$like['ord_invoice'] = $data['keywords'];
			$where['ord_mem_id'] = $this->session->userdata('mem_id');
			$data['orders'] = $this->OrderModel->search_orders($like, $where, 'ord_updated_at desc', $page * $config['per_page'], $this->config->item('order_count'))->result();

			$config['base_url'] = base_url().'/marketplace/Orders/search';
			$config['total_rows'] = $this->OrderModel->search_orders($like, $where, 'ord_updated_at desc', $page * $config['per_page'], 0)->num_rows();
			$this->pagination->initialize($config);
			$this->load->view('marketplace/orders_frontend', $data);
		}
		else{
			redirect('frontend/Members');
		}
    }
	public function cek_status($invoice){
		if ($this->uri->segment(4)){
			$where['ord_invoice'] = $invoice;
			$orders = $this->OrderModel->get_orders($where)->row();
	
			$clientId = "BRN-0222-1677984841764";
			$requestId = $invoice;
			$date = new DateTime("now", new DateTimeZone('UTC'));
			$requestDate = $date->format('Y-m-d\TH:i:s\Z');
	
			$targetPath = "/orders/v1/status/".$requestId;
			$secretKey = "SK-WjYbHmZGDEhveR9kBxCW";
			
			// Prepare Signature Component
			$componentSignature = "Client-Id:" . $clientId . "\n" . 
								  "Request-Id:" . $requestId . "\n" .
								  "Request-Timestamp:" . $requestDate . "\n" . 
								  "Request-Target:" . $targetPath;
	
			// Calculate HMAC-SHA256 base64 from all the components above
			// $signature = base64_encode(hash_hmac('sha256', $componentSignature, $secretKey, true));
			$signature = $this->generate_signature($componentSignature, $secretKey);
	
			// Initiate cURL
			$ch = curl_init();
	
			curl_setopt_array($ch, array(
				CURLOPT_URL => 'https://api-sandbox.doku.com/orders/v1/status/'.$requestId,
				CURLOPT_RETURNTRANSFER => true,
				CURLOPT_ENCODING => '',
				CURLOPT_MAXREDIRS => 10,
				CURLOPT_TIMEOUT => 0,
				CURLOPT_FOLLOWLOCATION => true,
				CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
				CURLOPT_CUSTOMREQUEST => 'GET',
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
						$statRes = json_decode($result)->transaction->status;
						if($statRes == 'FAILED'){
							var_dump('gagal status');
							die;
						}
						if($statRes == 'SUCCESS'){
							var_dump('berhasil');
							$res = $this->payOrder($orders->ord_id);
							if($res){
								var_dump('berhasil bayar data');
								die;
								$this->session->set_flashdata('add_success', true);
								redirect('marketplace/Orders');
							}
							else{
								var_dump('gagal bayar data');
								die;
								$this->session->set_flashdata('error_message', 'Failed to pay order with id = ');
								redirect('marketplace/Orders');
							}
						}
						if($statRes == 'EXPIRED'){
							var_dump('expired status');
							die;
						}
						break;
					default:
						var_dump('gagal');
						var_dump($result);die;
						$this->session->set_flashdata('error_message', 'Failed to check status for order id = '.$orders->ord_id.'. Error code: '.$http_code.' '.json_decode($result)->message[0]);
						redirect('marketplace/Orders');
				}
			}
			else{
				var_dump('aneh');
			}
	
			// Close cURL
			curl_close($ch);
		}
		else{
			redirect('frontend/Beranda');
		}
	}
	function generate_signature($componentSignature, $secretKey){
		$signature = base64_encode(hash_hmac('sha256', $componentSignature, $secretKey, true));
		return $signature;
	}
	function payOrder($ord_id){
		$data = array(
			'ord_id' => $ord_id,
			'ord_pay_date' => date('Y-m-d H:i:s'),
			'ord_stat_id' => $this->config->item('order_paid')
		);

		$this->db->trans_strict(FALSE);
		$this->db->trans_start();
		$where['ord_id'] = $ord_id;
		$orders = $this->OrderModel->update_orders($data, $where);
		if ($orders) {
			$this->db->trans_complete();
			return true;
		} else {
			$err = 1;
		}
		if ($err) {
			$this->db->trans_rollback();
			return false;
		}
	}
	function updateExpired(){
		$err = 0;
		$orders = $this->OrderModel->get_expired_orders()->result();
		if($orders){
			$this->db->trans_strict(FALSE);
			$this->db->trans_start();

			//update product stock
			foreach ($orders as $order) {
				$productId = $order->ord_pro_id;
				$quantity = $order->ord_quantity;
	
				$whePro['pro_id'] = $productId;
				$product = $this->ProductModel->update_stock($whePro, $quantity);
				if (!$product) {
					$err = 1;
				}
			}

			if($err){
				$this->db->trans_rollback();
			}
			else{
				//update all order status to expired
				$orders = $this->OrderModel->update_expired_orders();
				if ($orders) {
					$this->db->trans_complete();
					return true;
				} else {
					$this->db->trans_rollback();
					return false;
				}
			}
	
		}
	}
	function cancel(){
		if ($this->uri->segment(4)){
			$ord_id = $this->uri->segment(4);
			$dataOrd = array(
				'ord_id' => $ord_id,
				'ord_stat_id' => $this->config->item('order_cancelled')
			);
	
			$err = 0;
			$this->db->trans_strict(FALSE);
			$this->db->trans_start();
			$whereOrd['ord_id'] = $ord_id;
			$orders = $this->OrderModel->update_orders($dataOrd, $whereOrd);
			if ($orders) {
				$order = $this->OrderModel->get_orders($whereOrd)->row();
				$whePro['pro_id'] = $order->ord_pro_id;
				$product = $this->ProductModel->update_stock($whePro, $order->ord_quantity);
				if($product){
					$this->db->trans_complete();
					$this->session->set_flashdata('cancel_success', TRUE);
					redirect('marketplace/Orders');
				}
				else{
					$err = 2;
				}
			} else {
				$err = 1;
			}

			if ($err) {
				$this->db->trans_rollback();
				$this->session->set_flashdata('error_message', 'Failed to cancel order. Error code: '.$err);
				redirect('marketplace/Orders');
			}
		}
		else{
			redirect('marketplace/Orders');
		}
	}
}