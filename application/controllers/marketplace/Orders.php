<?php
defined('BASEPATH') or exit('No direct script access allowed');

#[\AllowDynamicProperties]

class Orders extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model(array('OrderModel', 'ProductModel', 'logorderModel', 'RejectReasonsModel', 'OrderComplainModel', 'OrderStatusModel', 'memberModel', 'notification_model'));
		$this->load->library(array('session', 'form_validation', 'pagination'));
		$this->load->helper(array('url', 'cookie', 'mail'));
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
			$config['first_link'] = 'Pertama / First';
			$config['first_tag_open'] = '<li>';
			$config['first_tag_close'] = '</li>';

			//Customizing the Digit Link
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
			$config['last_link'] = 'Akhir / Last';
			$config['last_tag_open'] = '<li>';
			$config['last_tag_close'] = '</li>';

			//For CURRENT page on which you are
			$config['cur_tag_open'] = '<li class="active"><a class="page-link bg-dark text-warning border-light" href="#">';
			$config['cur_tag_close'] = '</a></li>';

			$config['attributes'] = array('class' => 'page-link bg-dark text-light');

			$where['ord_mem_id'] = $this->session->userdata('mem_id');
			$data['orders'] = $this->OrderModel->get_orders($where, 'sort_date desc', $page * $config['per_page'], $this->config->item('order_count'))->result();

			$config['base_url'] = base_url().'/marketplace/Orders/index';
			$config['total_rows'] = $this->OrderModel->get_orders($where, 'sort_date desc', $page * $config['per_page'], 0)->num_rows();
			$this->pagination->initialize($config);

			$data['keywords'] = '';
            $this->session->set_userdata('keywords', '');
			$this->load->view('marketplace/orders_frontend', $data);
		}
		else{
			redirect('frontend/Members');
		}
    }
	public function detail(){
		if ($this->uri->segment(4)){
			$ord_id = $this->uri->segment(4);
			$whereOrd['ord_id'] = $ord_id;
			$whereItm['itm_ord_id'] = $ord_id;
			$data['order'] = $this->OrderModel->get_orders($whereOrd)->row();
			$data['items'] = $this->OrderModel->get_order_items($whereItm)->result();
			if ($data['order']) {
				$this->load->view("marketplace/order_detail", $data);
			} else {
				redirect('marketplace/Orders/');
			}
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
			$config['first_link'] = 'Pertama / First';
			$config['first_tag_open'] = '<li>';
			$config['first_tag_close'] = '</li>';

			//Customizing the Digit Link
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
			$config['last_link'] = 'Akhir / Last';
			$config['last_tag_open'] = '<li>';
			$config['last_tag_close'] = '</li>';

			//For CURRENT page on which you are
			$config['cur_tag_open'] = '<li class="active"><a class="page-link bg-dark text-warning border-light" href="#">';
			$config['cur_tag_close'] = '</a></li>';

			$config['attributes'] = array('class' => 'page-link bg-dark text-light');

			$like['ord_invoice'] = $data['keywords'];
			$where['ord_mem_id'] = $this->session->userdata('mem_id');
			$data['orders'] = $this->OrderModel->search_orders($like, $where, 'ord_date desc', $page * $config['per_page'], $this->config->item('order_count'))->result();

			$config['base_url'] = base_url().'/marketplace/Orders/search';
			$config['total_rows'] = $this->OrderModel->search_orders($like, $where, 'ord_date desc', $page * $config['per_page'], 0)->num_rows();
			$this->pagination->initialize($config);
			$this->load->view('marketplace/orders_frontend', $data);
		}
		else{
			redirect('frontend/Members');
		}
    }
	public function cek_status($invoice){
		if ($this->uri->segment(4)){
			$site_lang = $this->input->cookie('site_lang');

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
				CURLOPT_SSL_VERIFYHOST => 0,
				CURLOPT_SSL_VERIFYPEER => 0,
				CURLOPT_RETURNTRANSFER => true,
				CURLOPT_FAILONERROR => true,
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
							$res = $this->failOrder($orders->ord_id);
							if($res){
								if ($site_lang == 'indonesia') {
									$this->session->set_flashdata('error_message', 'Pembayaran gagal');
								}
								else{
									$this->session->set_flashdata('error_message', 'Payment failed');
								}
							}
							else{
								if ($site_lang == 'indonesia') {
									$this->session->set_flashdata('error_message', 'Gagal mengubah status order dengan id = '.$orders->ord_id);
								}
								else{
									$this->session->set_flashdata('error_message', 'Failed to change order status with id = '.$orders->ord_id);
								}
							}
							redirect('marketplace/Orders');
						}
						else if($statRes == 'SUCCESS'){
							$res = $this->payOrder($orders->ord_id);
							if($res){
								$this->session->set_flashdata('add_success', true);
								redirect('marketplace/Orders');
							}
							else{
								if ($site_lang == 'indonesia') {
									$this->session->set_flashdata('error_message', 'Gagal membayar order dengan id = '.$orders->ord_id);
								}
								else{
									$this->session->set_flashdata('error_message', 'Failed to pay order with id = '.$orders->ord_id);
								}
								redirect('marketplace/Orders');
							}
						}
						else if($statRes == 'EXPIRED'){
							if ($site_lang == 'indonesia') {
								$this->session->set_flashdata('error_message', 'Batas pembayaran sudah lewat');
							}
							else{
								$this->session->set_flashdata('error_message', 'The payment due date has passed');
							}
							redirect('marketplace/Orders');
						}
						else if($statRes == 'PENDING'){
							if ($site_lang == 'indonesia') {
								$this->session->set_flashdata('error_message', 'Pembayaran belum diselesaikan');
							}
							else{
								$this->session->set_flashdata('error_message', 'Payment has not been completed');
							}
							redirect('marketplace/Orders');
						}
						else{
							if ($site_lang == 'indonesia') {
								$this->session->set_flashdata('error_message', 'Pembayaran gagal');
							}
							else{
								$this->session->set_flashdata('error_message', 'Payment failed');
							}
							redirect('marketplace/Orders');
						}
						break;
					default:
						redirect('marketplace/Orders');
				}
			}
			else{
				if ($site_lang == 'indonesia') {
					$this->session->set_flashdata('error_message', 'Pembayaran gagal');
				}
				else{
					$this->session->set_flashdata('error_message', 'Payment failed');
				}
				// echo 'Curl error: ' . curl_error($ch);
				redirect('marketplace/Orders');
			}
	
			// Close cURL
			curl_close($ch);
		}
		else{
			redirect('marketplace/Orders');
		}
	}
	function generate_signature($componentSignature, $secretKey){
		$signature = base64_encode(hash_hmac('sha256', $componentSignature, $secretKey, true));
		return $signature;
	}
	public function payOrder($ord_id){
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
	public function failOrder($ord_id){
		$data = array(
			'ord_id' => $ord_id,
			'ord_stat_id' => $this->config->item('order_failed')
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
				$whereItm['itm_ord_id'] = $order->ord_id;
				$order_items = $this->OrderModel->get_order_items($whereItm)->result();

				foreach ($order_items as $item) {
					$productId = $item->itm_pro_id;
					$quantity = $item->itm_quantity;
		
					$whePro['pro_id'] = $productId;
					$product = $this->ProductModel->update_stock($whePro, $quantity);
					if (!$product) {
						$err = 1;
					}
				}
			}

			if($err){
				$this->db->trans_complete();
				return false;
			}
			else{
				//update all order status to expired
				$orders = $this->OrderModel->update_expired_orders();
				$this->db->trans_complete();
				if ($orders) {
					return true;
				} else {
					return false;
				}
			}
	
		}
	}
	public function cancel(){
		if ($this->uri->segment(4)){
			$site_lang = $this->input->cookie('site_lang');
			$ord_id = $this->uri->segment(4);
			$dataOrd = array(
				'ord_stat_id' => $this->config->item('order_cancelled')
			);
	
			$err = 0;
			$this->db->trans_strict(FALSE);
			$this->db->trans_start();
			$whereOrd['ord_id'] = $ord_id;
			$orders = $this->OrderModel->update_orders($dataOrd, $whereOrd);
			if ($orders) {
				$order = $this->OrderModel->get_orders($whereOrd)->row();

				$whereItm['itm_ord_id'] = $ord_id;
				$order_items = $this->OrderModel->get_order_items($whereItm)->result();

				foreach ($order_items as $item) {
					$productId = $item->itm_pro_id;
					$quantity = $item->itm_quantity;
		
					$whePro['pro_id'] = $productId;
					$product = $this->ProductModel->update_stock($whePro, $quantity);
					if($product){
						$this->db->trans_complete();
						$this->session->set_flashdata('cancel_success', TRUE);
						redirect('marketplace/Orders');
					}
					else{
						$err = 2;
					}
				}
			} else {
				$err = 1;
			}

			if ($err) {
				$this->db->trans_rollback();
				if ($site_lang == 'indonesia') {
					$this->session->set_flashdata('error_message', 'Gagal membatalkan pesanan. Error code: '.$err);
				}
				else{
					$this->session->set_flashdata('error_message', 'Failed to cancel order. Error code: '.$err);
				}
				redirect('marketplace/Orders');
			}
		}
		else{
			redirect('marketplace/Orders');
		}
	}
	public function accept(){
		if ($this->uri->segment(4)){
			$site_lang = $this->input->cookie('site_lang');
			$ord_id = $this->uri->segment(4);
			$dataOrd = array(
				'ord_id' => $ord_id,
				'ord_completed_date' => date('Y-m-d H:i:s'),
				'ord_stat_id' => $this->config->item('order_completed')
			);
	
			$err = 0;
			$this->db->trans_strict(FALSE);
			$this->db->trans_start();
			$whereOrd['ord_id'] = $ord_id;
			$orders = $this->OrderModel->update_orders($dataOrd, $whereOrd);
			if ($orders) {
				$this->db->trans_complete();
				$this->session->set_flashdata('accept_success', TRUE);
				redirect('marketplace/Orders');
			} else {
				$err = 1;
			}

			if ($err) {
				$this->db->trans_rollback();
				if ($site_lang == 'indonesia') {
					$this->session->set_flashdata('error_message', 'Gagal menerima pesanan. Error code: '.$err);
				}
				else{
					$this->session->set_flashdata('error_message', 'Failed to accept order. Error code: '.$err);
				}
				redirect('marketplace/Orders');
			}
		}
		else{
			redirect('marketplace/Orders');
		}
	}
	public function complain(){
		if ($this->uri->segment(4)){
			$ord_id = $this->uri->segment(4);
			$whereOrd['ord_id'] = $ord_id;
			$data['order'] = $this->OrderModel->get_orders($whereOrd)->row();
			$data['mode'] = 0;
			$this->load->view('marketplace/order_complain', $data);
		}
		else{
			redirect('marketplace/Orders');
		}
	}
	public function validate_complain(){
		if ($this->session->userdata('mem_id')){
			$site_lang = $this->input->cookie('site_lang');
			$this->form_validation->set_error_delimiters('<div>','</div>');
			if ($site_lang == 'indonesia') {
				$this->form_validation->set_message('required', '%s wajib diisi');
				$this->form_validation->set_rules('com_desc', 'Deskripsi komplain ', 'trim|required');
			}
			else{
				$this->form_validation->set_message('required', '%s required');
				$this->form_validation->set_rules('com_desc', 'Complaint description ', 'trim|required');
			}

			$ord_id = $this->input->post('ord_id');
			$whereOrd['ord_id'] = $ord_id;
			$data['order'] = $this->OrderModel->get_orders($whereOrd)->row();
			$data['mode'] = 1;

			if ($this->form_validation->run() == FALSE){
				$this->load->view('marketplace/order_complain', $data);
			}
			else{
				$err = 0;
				$photo = '-';
				if ($this->input->post('attachment')) {
					$uploadedImg = $this->input->post('attachment');
					$image_array_1 = explode(";", $uploadedImg);
					$image_array_2 = explode(",", $image_array_1[1]);
					$uploadedImg = base64_decode($image_array_2[1]);

					if ((strlen($uploadedImg) > $this->config->item('file_size'))) {
						$err++;
                        if ($site_lang == 'indonesia') {
							$this->session->set_flashdata('error_message', 'Ukuran file terlalu besar (> 1 MB).');
                        }
                        else{
							$this->session->set_flashdata('error_message', 'File size is too big (> 1 MB).');
                        }
					}
					else{
						$image_name = $this->config->item('path_complain').$this->config->item('file_name_complain');
						if (!is_dir($this->config->item('path_complain')) or !is_writable($this->config->item('path_complain'))) {
							$err++;
							if ($site_lang == 'indonesia') {
								$this->session->set_flashdata('error_message', 'Folder complain tidak ditemukan atau tidak writable.');
							}
							else{
								$this->session->set_flashdata('error_message', 'Complain folder is not found or is not writable.');
							}
						} else{
							if (is_file($image_name) and !is_writable($image_name)) {
								$err++;
								if ($site_lang == 'indonesia') {
									$this->session->set_flashdata('error_message', 'File sudah ada dan tidak writable.');
								}
								else{
									$this->session->set_flashdata('error_message', 'File is already exists and is not writable.');
								}
							}
						}

						if (!$err){
							file_put_contents($image_name, $uploadedImg);
							$photo = str_replace($this->config->item('path_complain'), '', $image_name);
						}
					}
				}

                if (!$err){
                    $dataCom = array(
						'com_ord_id' => $ord_id,
                        'com_desc' => $this->input->post('com_desc'),
						'com_photo' => $photo
                    );

					$dataOrd = array(
						'ord_completed_date' => date('Y-m-d H:i:s'),
						'ord_stat_id' => $this->config->item('order_complained')
					);

					$this->db->trans_strict(FALSE);
					$this->db->trans_start();
					$complain = $this->OrderComplainModel->add_complains($dataCom);
					if ($complain){
						$whereOrd['ord_id'] = $ord_id;
						$orders = $this->OrderModel->update_orders($dataOrd, $whereOrd);
						if ($orders) {
							$this->db->trans_complete();
							$this->session->set_flashdata('complain_success', TRUE);
							redirect('marketplace/Orders');
						} else {
							$err = 1;
						}
					}
					else{
						$err = 2;
					}
                }

				if ($err){
					$this->db->trans_rollback();
					if ($site_lang == 'indonesia') {
						$this->session->set_flashdata('error_message', 'Gagal menyimpan data komplain');
					}
					else{
						$this->session->set_flashdata('error_message', 'Failed to save complaint file');
					}
					redirect('marketplace/Orders');
				}
			}
		}
		else{
			redirect("frontend/Members");
		}
	}

	//backend
	public function listOrders()
	{
		$this->updateExpired();
		$data['orders'] = $this->OrderModel->get_processed_orders()->result();
		$this->load->view("marketplace/orders_backend", $data);
	}
	public function order_detail()
	{
		if ($this->uri->segment(4)){
			$ord_id = $this->uri->segment(4);
			$whereOrd['ord_id'] = $ord_id;
			$whereItm['itm_ord_id'] = $ord_id;
			$data['order'] = $this->OrderModel->get_orders($whereOrd)->row();
			$data['items'] = $this->OrderModel->get_order_items($whereItm)->result();
			if ($data['order']) {
				$this->load->view("marketplace/order_detail_backend", $data);
			} else {
				redirect('marketplace/Orders/listOrders');
			}
		}
		else{
			redirect('marketplace/Orders/listOrders');
		}
	}
	public function deliver()
	{
		if ($this->uri->segment(4)){
			$ord_id = $this->uri->segment(4);
			$dataOrd = array(
				'ord_stat_id' => $this->config->item('order_delivered')
			);

			$whereOrd['ord_id'] = $ord_id;
			$order = $this->OrderModel->get_orders($whereOrd)->row();
			$dataLog = array(
				'log_ord_id' => $ord_id,
				'log_mem_id' => $order->ord_mem_id,
				'log_invoice' => $order->ord_invoice,
				'log_city_id' => $order->ord_city_id,
				'log_address' => $order->ord_address,
				'log_shipping_id' => $order->ord_shipping_id,
				'log_shipping_type' => $order->ord_shipping_type,
				'log_shipping_cost' => $order->ord_shipping_cost,
				'log_total_price' => $order->ord_total_price,
				'log_date' => date('Y-m-d H:i:s', strtotime($order->ord_date)),
				'log_updated_at' => date('Y-m-d H:i:s'),
				'log_updated_by' => $this->session->userdata('use_id'),
				'log_pay_date' => date('Y-m-d H:i:s', strtotime($order->ord_pay_date)),
				'log_pay_due_date' => date('Y-m-d H:i:s', strtotime($order->ord_pay_due_date)),
				'log_arrived_date' => date('Y-m-d H:i:s', strtotime($order->ord_arrived_date)),
				'log_completed_date' => date('Y-m-d H:i:s', strtotime($order->ord_completed_date)),
				'log_stat_id' => $this->config->item('order_delivered'),
				'log_reject_note' => $order->ord_reject_note,
			);
	
			$err = 0;
			$this->db->trans_strict(FALSE);
			$this->db->trans_start();
			$whereOrd['ord_id'] = $ord_id;
			$orders = $this->OrderModel->update_orders($dataOrd, $whereOrd);
			if ($orders) {
				$log = $this->logorderModel->add_log($dataLog);
				if($log){
					$result = $this->notification_model->add(30, $ord_id, $order->ord_mem_id, "Invoice Pesanan / Order: ".$order->ord_invoice);
					if ($result){
						$this->db->trans_complete();
						$this->send_deliver_order($order->mem_email, $order->mem_name, $order->ord_invoice);
						$this->session->set_flashdata('deliver_success', TRUE);
						redirect("marketplace/Orders/listOrders");
					}
					else{
						$err = 3;
					}
				}
				else{
					$err = 1;
				}
			} else {
				$err = 2;
			}

			if ($err) {
				$this->db->trans_rollback();
				$this->session->set_flashdata('error_message', 'Failed to deliver order. Error code: '.$err);
				redirect('marketplace/Orders/listOrders');
			}
		}
		else{
			redirect('marketplace/Orders/listOrders');
		}
	}
	public function arrive()
	{
		if ($this->uri->segment(4)){
			$ord_id = $this->uri->segment(4);
			$dataOrd = array(
				'ord_arrived_date' => date('Y-m-d H:i:s'),
				'ord_stat_id' => $this->config->item('order_arrived')
			);

			$whereOrd['ord_id'] = $ord_id;
			$order = $this->OrderModel->get_orders($whereOrd)->row();
			$dataLog = array(
				'log_ord_id' => $ord_id,
				'log_mem_id' => $order->ord_mem_id,
				'log_invoice' => $order->ord_invoice,
				'log_city_id' => $order->ord_city_id,
				'log_address' => $order->ord_address,
				'log_shipping_id' => $order->ord_shipping_id,
				'log_shipping_type' => $order->ord_shipping_type,
				'log_shipping_cost' => $order->ord_shipping_cost,
				'log_total_price' => $order->ord_total_price,
				'log_date' => date('Y-m-d H:i:s', strtotime($order->ord_date)),
				'log_updated_at' => date('Y-m-d H:i:s'),
				'log_updated_by' => $this->session->userdata('use_id'),
				'log_pay_date' => date('Y-m-d H:i:s', strtotime($order->ord_pay_date)),
				'log_pay_due_date' => date('Y-m-d H:i:s', strtotime($order->ord_pay_due_date)),
				'log_arrived_date' => date('Y-m-d H:i:s'),
				'log_completed_date' => date('Y-m-d H:i:s', strtotime($order->ord_completed_date)),
				'log_stat_id' => $this->config->item('order_arrived'),
				'log_reject_note' => $order->ord_reject_note,
			);
	
			$err = 0;
			$this->db->trans_strict(FALSE);
			$this->db->trans_start();
			$whereOrd['ord_id'] = $ord_id;
			$orders = $this->OrderModel->update_orders($dataOrd, $whereOrd);
			if ($orders) {
				$log = $this->logorderModel->add_log($dataLog);
				if($log){
					$result = $this->notification_model->add(31, $ord_id, $order->ord_mem_id, "Invoice Pesanan / Order: ".$order->ord_invoice);
					if ($result){
						$this->db->trans_complete();
						$this->send_arrived_order($order->mem_email, $order->mem_name, $order->ord_invoice, $order->ord_address);
						$this->session->set_flashdata('arrive_success', TRUE);
						redirect("marketplace/Orders/listOrders");
					}
					else{
						$err = 3;
					}
				}
				else{
					$err = 1;
				}
			} else {
				$err = 2;
			}

			if ($err) {
				$this->db->trans_rollback();
				$this->session->set_flashdata('error_message', 'Failed to set order as arrived. Error code: '.$err);
				redirect('marketplace/Orders/listOrders');
			}
		}
		else{
			redirect('marketplace/Orders/listOrders');
		}
	}
	public function reject()
	{
		if ($this->uri->segment(4)){
			$ord_id = $this->uri->segment(4);
			$whereOrd['ord_id'] = $ord_id;
			$data['order'] = $this->OrderModel->get_orders($whereOrd)->row();
			$data['reasons'] = $this->RejectReasonsModel->get_order_reasons()->result();
			$data['mode'] = 0;
			if ($data['order']) {
				$this->load->view("marketplace/reject_order", $data);
			} else {
				redirect('marketplace/Orders/listOrders');
			}
		}
		else{
			redirect('marketplace/Orders/listOrders');
		}
	}
	public function validate_reject(){ 
        if ($this->session->userdata('use_id')) {

			$valid = false;
            if (!$this->input->post('dropdown_reason')){
				$this->form_validation->set_error_delimiters('<div>', '</div>');
                $this->form_validation->set_rules('ord_reject_note', 'Other Reason required', 'trim|required');
				if($this->form_validation->run() == TRUE){
					$valid = true;
				}
            }
			else{
				$valid = true;
			}

			$ord_id = $this->input->post('ord_id');
			$whereOrd['ord_id'] = $ord_id;
			$data['order'] = $this->OrderModel->get_orders($whereOrd)->row();
			$data['reasons'] = $this->RejectReasonsModel->get_order_reasons()->result();
            $data['mode'] = 1;
            
			if($data['order']){
				if(!$valid){
					$this->load->view('marketplace/reject_order', $data);
				} else {
					$err = 0;

					$order = $data['order'];
					$dataOrd = array(
						'ord_stat_id' => $this->config->item('order_rejected')
					);

					$dataLog = array(
						'log_ord_id' => $ord_id,
						'log_mem_id' => $order->ord_mem_id,
						'log_invoice' => $order->ord_invoice,
						'log_city_id' => $order->ord_city_id,
						'log_address' => $order->ord_address,
						'log_shipping_id' => $order->ord_shipping_id,
						'log_shipping_type' => $order->ord_shipping_type,
						'log_shipping_cost' => $order->ord_shipping_cost,
						'log_total_price' => $order->ord_total_price,
						'log_date' => date('Y-m-d H:i:s', strtotime($order->ord_date)),
						'log_updated_at' => date('Y-m-d H:i:s'),
						'log_updated_by' => $this->session->userdata('use_id'),
						'log_pay_date' => date('Y-m-d H:i:s', strtotime($order->ord_pay_date)),
						'log_pay_due_date' => date('Y-m-d H:i:s', strtotime($order->ord_pay_due_date)),
						'log_arrived_date' => date('Y-m-d H:i:s', strtotime($order->ord_arrived_date)),
						'log_completed_date' => date('Y-m-d H:i:s', strtotime($order->ord_completed_date)),
						'log_stat_id' => $this->config->item('order_rejected')
					);

					if($this->input->post('dropdown_reason')){
						$dataOrd['ord_reject_note'] = $this->input->post('ord_reject');
						$dataLog['log_reject_note'] = $this->input->post('ord_reject');
					}
					else{
						$dataOrd['ord_reject_note'] = $this->input->post('ord_reject_note');
						$dataLog['log_reject_note'] = $this->input->post('ord_reject_note');
					}
			
					$this->db->trans_strict(FALSE);
					$this->db->trans_start();
					$rejected = $this->OrderModel->update_orders($dataOrd, $whereOrd);
					if ($rejected) {
						$log = $this->logorderModel->add_log($dataLog);
						if ($log){
							//update product stock
							$whereItm['itm_ord_id'] = $order->ord_id;
							$order_items = $this->OrderModel->get_order_items($whereItm)->result();
			
							foreach ($order_items as $item) {
								$productId = $item->itm_pro_id;
								$quantity = $item->itm_quantity;
					
								$whePro['pro_id'] = $productId;
								$product = $this->ProductModel->update_stock($whePro, $quantity);
								if (!$product) {
									$err = 1;
									break;
								}
							}

							if($err == 0){
								$result = $this->notification_model->add(32, $ord_id, $order->ord_mem_id, "Invoice Pesanan / Order: ".$order->ord_invoice);
								if ($result){
									$this->send_reject_order($order->mem_email, $order->mem_name, $order->ord_invoice, $dataOrd['ord_reject_note']);
									$this->session->set_flashdata('reject_success', TRUE);
								}
								else{
									$err = 2;
								}
							}
						}
						else{
							$err = 3;
						}
					} else {
						$err = 4;
					}

					$this->db->trans_complete();
	
					if ($err) {
						$this->session->set_flashdata('error_message', 'Failed to reject order. Error code: '.$err);
						redirect('marketplace/Orders/listOrders');
					}
				}
			}
			else{
				$this->session->set_flashdata('error_message', 'Failed to get order data.');
				redirect('marketplace/Orders/listOrders');
			}
			redirect("marketplace/Orders/listOrders");
        } 
        else {
            redirect("marketplace/Orders/listOrders");
        }
    }
	public function edit()
	{
		if ($this->uri->segment(4)){
			$ord_id = $this->uri->segment(4);
			$whereOrd['ord_id'] = $ord_id;
			$data['order'] = $this->OrderModel->get_orders($whereOrd)->row();
			$data['items'] = $this->OrderModel->get_order_items($whereOrd)->result();
            $data['status'] = $this->OrderStatusModel->get_status()->result();
			$data['province'] = $this->OrderModel->get_provinces()->result();
			$whereCity['city_province_id'] = $data['order']->prov_id;
			$data['city'] = $this->OrderModel->get_cities($whereCity)->result();

			$data['mode'] = 0;
			if ($data['order']) {
				$this->load->view("marketplace/edit_order", $data);
			} else {
				redirect('marketplace/Orders/listOrders');
			}
		}
		else{
			redirect('marketplace/Orders/listOrders');
		}
	}
	public function validate_edit(){ 
        if ($this->session->userdata('use_username')) {
            $this->form_validation->set_error_delimiters('<div>', '</div>');
            $this->form_validation->set_rules('ord_invoice', 'Invoice ', 'trim|required');
            $this->form_validation->set_rules('city_id', 'City/Regency ', 'trim|required');
            $this->form_validation->set_rules('ord_address', 'Full Address ', 'trim|required');
            $this->form_validation->set_rules('shipping', 'Shipping Service ', 'trim|required');
            $this->form_validation->set_rules('shipping_type', 'Shipping Type ', 'trim|required');
            $this->form_validation->set_rules('ord_shipping_cost', 'Shipping Cost ', 'trim|required');
            $this->form_validation->set_rules('ord_pay_date', 'Payment Date ', 'trim|required');
            $this->form_validation->set_rules('ord_pay_due_date', 'Payment Due Date ', 'trim|required');
            $this->form_validation->set_rules('ord_total_price', 'Grand Total ', 'trim|required');
            $this->form_validation->set_rules('ord_stat_id', 'Status ', 'trim|required');

			$ord_id = $this->input->post('ord_id');
			$whereOrd['ord_id'] = $ord_id;
			$data['order'] = $this->OrderModel->get_orders($whereOrd)->row();
			$data['items'] = $this->OrderModel->get_order_items($whereOrd)->result();
            $data['status'] = $this->OrderStatusModel->get_status()->result();
			$data['province'] = $this->OrderModel->get_provinces()->result();
			$whereCity['city_province_id'] = set_value('prov_id');
			$data['city'] = $this->OrderModel->get_cities($whereCity)->result();
			$data['mode'] = 1;

            if ($this->form_validation->run() == FALSE) {
                $this->load->view('marketplace/edit_order', $data);
            } else {
                $err = 0;
                
                if (!$err && $this->input->post('ord_invoice') != "-" && $this->OrderModel->check_for_duplicate($this->input->post('ord_id'), 'ord_invoice', $this->input->post('ord_invoice'))){
                    $err = 1;
                    $this->session->set_flashdata('error_message', 'Invoice number already exist');
                }

                if (!$err) {
					$payDate = date('Y-m-d H:i:s', strtotime($this->input->post('ord_pay_date')));
					$payDueDate = date('Y-m-d H:i:s', strtotime($this->input->post('ord_pay_due_date')));
					$arrivedDate = null;
					$completedDate = null;
					if($this->input->post('ord_arrived_date') != null){
						$arrivedDate = date('Y-m-d H:i:s', strtotime($this->input->post('ord_arrived_date')));
					}
					if($this->input->post('ord_completed_date') != null){
						$completedDate = date('Y-m-d H:i:s', strtotime($this->input->post('ord_completed_date')));
					}

					$dataOrd = array(
						'ord_invoice' => $this->input->post('ord_invoice'),
						'ord_city_id' => $this->input->post('city_id'),
						'ord_address' => $this->input->post('ord_address'),
						'ord_shipping_id' => $this->input->post('shipping'),
						'ord_shipping_type' => $this->input->post('shipping_type'),
						'ord_shipping_cost' => $this->input->post('ord_shipping_cost'),
						'ord_total_price' => $this->input->post('ord_total_price'),
						'ord_pay_date' => $payDate,
						'ord_pay_due_date' => $payDueDate,
						'ord_arrived_date' => $arrivedDate,
						'ord_completed_date' => $completedDate,
						'ord_stat_id' => $this->input->post('ord_stat_id'),
						'ord_reject_note' => $this->input->post('ord_reject_note')
					);

					$dataLog = array(
						'log_ord_id' => $ord_id,
						'log_mem_id' => $data['order']->ord_mem_id,
						'log_invoice' => $this->input->post('ord_invoice'),
						'log_city_id' => $this->input->post('city_id'),
						'log_address' => $this->input->post('ord_address'),
						'log_shipping_id' => $this->input->post('shipping'),
						'log_shipping_type' => $this->input->post('shipping_type'),
						'log_shipping_cost' => $this->input->post('ord_shipping_cost'),
						'log_total_price' => $this->input->post('ord_total_price'),
						'log_date' => $data['order']->ord_date,
						'log_updated_at' => date('Y-m-d H:i:s'),
						'log_updated_by' => $this->session->userdata('use_id'),
						'log_pay_date' => $payDate,
						'log_pay_due_date' => $payDueDate,
						'log_arrived_date' => $arrivedDate,
						'log_completed_date' => $completedDate,
						'log_stat_id' => $this->input->post('ord_stat_id'),
						'log_reject_note' => $this->input->post('ord_reject_note')
					);

                    if (!$err) {
                        $this->db->trans_strict(FALSE);
                        $this->db->trans_start();
                        $order = $this->OrderModel->update_orders($dataOrd, $whereOrd);
                        if ($order) {
                            $log = $this->logorderModel->add_log($dataLog);
                            if ($log){
                                $this->db->trans_complete();
                                $this->session->set_flashdata('edit_success', true);
                                redirect("marketplace/Orders/listOrders");
                            }
                            else{
                                $err = 2;
                            }
                        } else {
                            $err = 3;
                        }
                    }
				}

				if ($err) {
					$this->db->trans_rollback();
					$this->session->set_flashdata('error_message', 'Failed to edit order id = '.$this->input->post('ord_id').'. Error code: '.$err);
					$this->load->view('marketplace/edit_order', $data);
				}
            }
        }
        else{
            redirect('backend/Users/login');
        }
    }
	public function add()
	{
		$data['member'] = [];
		$data['product'] = [];
		$data['status'] = $this->OrderStatusModel->get_status()->result();
		$this->load->view("marketplace/add_order", $data);
	}
	public function search_member(){
		$like['mem_name'] = $this->input->post('mem_name');
		$where['mem_stat'] = $this->config->item('accepted');
		$where['mem_id !='] = $this->config->item('no_member');
		$member = $this->memberModel->search_members($like, $where)->result();
		$json = json_encode($member);
		echo $json;
    }

	public function search_product(){
		$like['pro_name'] = $this->input->post('pro_name');
		$where['pro_stat'] = $this->config->item('accepted');
		$product = $this->ProductModel->search_products($like, $where)->result();
		$jsonPro = json_encode($product);
		echo $jsonPro;
    }
	public function validate_add(){ 
        if ($this->session->userdata('use_username')) {
            $this->form_validation->set_error_delimiters('<div>', '</div>');
            $this->form_validation->set_rules('ord_mem_id', 'Member ', 'trim|required');
            $this->form_validation->set_rules('ord_invoice', 'Invoice ', 'trim|required');
            $this->form_validation->set_rules('ord_total_price', 'Total Price ', 'trim|required');
            $this->form_validation->set_rules('ord_pay_date', 'Payment Date ', 'trim|required');
            $this->form_validation->set_rules('ord_pay_due_date', 'Payment Due Date ', 'trim|required');

			$data['status'] = $this->OrderStatusModel->get_status()->result();

            $like['mem_name'] = $this->input->post('mem_name');
            $where['mem_stat'] = $this->config->item('accepted');
			$where['mem_id !='] = $this->config->item('no_member');
            $data['member'] = $this->memberModel->search_members($like, $where)->result();

            $likePro['pro_name'] = $this->input->post('pro_name');
            $wherePro['pro_stat'] = $this->config->item('accepted');
            $data['product'] = $this->ProductModel->search_products($likePro, $wherePro)->result();

            if ($this->form_validation->run() == FALSE) {
                $this->load->view('marketplace/add_order', $data);
            } else {
				$payDate = date('Y-m-d H:i:s', strtotime($this->input->post('ord_pay_date')));
				$payDueDate = date('Y-m-d H:i:s', strtotime($this->input->post('ord_pay_due_date')));
				$arrivedDate = null;
				$completedDate = null;
				if($this->input->post('ord_arrived_date') != null){
					$arrivedDate = date('Y-m-d H:i:s', strtotime($this->input->post('ord_arrived_date')));
				}
				if($this->input->post('ord_completed_date') != null){
					$completedDate = date('Y-m-d H:i:s', strtotime($this->input->post('ord_completed_date')));
				}
				
				$dataOrd = array(
					'ord_mem_id' => $this->input->post('ord_mem_id'),
					'ord_invoice' => $this->input->post('ord_invoice'),
					'ord_city_id' => $this->input->post('ord_city'),
					'ord_address' => $this->input->post('ord_address'),
					'ord_shipping_id' => $this->input->post('ord_shipping'),
					'ord_shipping_type' => $this->input->post('ord_shipping_type'),
					'ord_shipping_cost' => $this->input->post('ord_shipping_cost'),
					'ord_total_price' => $this->input->post('ord_total_price'),
					'ord_date' => date('Y-m-d H:i:s'),
					'ord_pay_date' => $payDate,
					'ord_pay_due_date' => $payDueDate,
					'ord_arrived_date' => $arrivedDate,
					'ord_completed_date' => $completedDate,
					'ord_updated_by' => $this->session->userdata('use_id'),
					'ord_stat_id' => $this->input->post('ord_stat_id'),
					'ord_reject_note' => $this->input->post('ord_reject_note')
				);

				$dataLog = array(
					'log_mem_id' => $this->input->post('ord_mem_id'),
					'log_invoice' => $this->input->post('ord_invoice'),
					'log_city_id' => $this->input->post('ord_city'),
					'log_address' => $this->input->post('ord_address'),
					'log_shipping_id' => $this->input->post('ord_shipping'),
					'log_shipping_type' => $this->input->post('ord_shipping_type'),
					'log_shipping_cost' => $this->input->post('ord_shipping_cost'),
					'log_total_price' => $this->input->post('ord_total_price'),
					'log_date' => date('Y-m-d H:i:s'),
					'log_updated_at' => date('Y-m-d H:i:s'),
					'log_updated_by' => $this->session->userdata('use_id'),
					'log_pay_date' => $payDate,
					'log_pay_due_date' => $payDueDate,
					'log_arrived_date' => $arrivedDate,
					'log_completed_date' => $completedDate,
					'log_stat_id' => $this->input->post('ord_stat_id'),
					'log_reject_note' => $this->input->post('ord_reject_note')
				);

				$this->db->trans_strict(FALSE);
				$this->db->trans_start();
				$orders = $this->OrderModel->add_orders($dataOrd);
				if ($orders) {
					$insertedID = $this->db->insert_id();
					$dataLog['log_ord_id'] = $insertedID;

					$log = $this->logorderModel->add_log($dataLog);
					if ($log){
						if($this->input->post('ord_stat_id') == 3){
							$result = $this->notification_model->add(30, $insertedID, $this->input->post('ord_mem_id'), "Invoice Pesanan / Order: ".$this->input->post('ord_invoice'));
							if ($result){
								$this->db->trans_complete();
								$this->session->set_flashdata('add_success', true);
								redirect("marketplace/Orders/listOrders");
							}
							else{
								$err = 1;
							}
						}
						else if($this->input->post('ord_stat_id') == 4){
							$result = $this->notification_model->add(31, $insertedID, $this->input->post('ord_mem_id'), "Invoice Pesanan / Order: ".$this->input->post('ord_invoice'));
							if ($result){
								$this->db->trans_complete();
								$this->session->set_flashdata('add_success', true);
								redirect("marketplace/Orders/listOrders");
							}
							else{
								$err = 1;
							}
						}
						else if($this->input->post('ord_stat_id') == 7){
							$result = $this->notification_model->add(32, $insertedID, $this->input->post('ord_mem_id'), "Invoice Pesanan / Order: ".$this->input->post('ord_invoice'));
							if ($result){
								$this->db->trans_complete();
								$this->session->set_flashdata('add_success', true);
								redirect("marketplace/Orders/listOrders");
							}
							else{
								$err = 1;
							}
						}
						else if($this->input->post('ord_stat_id') == 8){
							$result = $this->notification_model->add(33, $insertedID, $this->input->post('ord_mem_id'), "Invoice Pesanan / Order: ".$this->input->post('ord_invoice'));
							if ($result){
								$this->db->trans_complete();
								$this->session->set_flashdata('add_success', true);
								redirect("marketplace/Orders/listOrders");
							}
							else{
								$err = 1;
							}
						}
						else{
							$this->db->trans_complete();
							$this->session->set_flashdata('add_success', true);
							redirect("marketplace/Orders/listOrders");
						}
					}
					else{
						$err = 3;
					}
				} else {
					$err = 5;
				}
				if ($err) {
					$this->db->trans_rollback();
					$this->session->set_flashdata('error_message', 'Failed to save order. Error code: '.$err);
					$this->load->view('marketplace/add_order', $data);
				}
            }
        } 
        else {
            redirect("backend/Users/login");
        }
    }
	public function log(){
        if ($this->uri->segment(4)){
            $where['log_ord_id'] = $this->uri->segment(4);
            $data['order'] = $this->logorderModel->get_logs($where)->result();
            $this->load->view('marketplace/log_order', $data);
        }
        else{
            redirect('marketplace/Orders/listOrders');
        }
    }

	public function send_deliver_order($email, $member, $invoice){
		$mail = send_deliver_order($email, $member, $invoice);
		if (!$mail){
			$this->session->set_flashdata('error_message', show_error($this->email->print_debugger()));
		}
	}

	public function send_arrived_order($email, $member, $invoice, $address){
		$mail = send_arrived_order($email, $member, $invoice, $address);
		if (!$mail){
			$this->session->set_flashdata('error_message', show_error($this->email->print_debugger()));
		}
	}

	public function send_reject_order($email, $member, $invoice, $reason){
		$mail = send_reject_order($email, $member, $invoice, $reason);
		if (!$mail){
			$this->session->set_flashdata('error_message', show_error($this->email->print_debugger()));
		}
	}
}