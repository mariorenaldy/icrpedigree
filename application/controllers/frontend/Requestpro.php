<?php
defined('BASEPATH') OR exit('No direct script access allowed');

#[\AllowDynamicProperties]

class Requestpro extends CI_Controller {
	public function __construct(){
		// Call the CI_Controller constructor
		parent::__construct();
		$this->load->model(array('MemberModel', 'KennelModel', 'KenneltypeModel', 'notification_model', 'RequestproModel'));
		$this->load->library('upload', $this->config->item('upload_member'));
		$this->load->library(array('session', 'form_validation'));
		$this->load->helper(array('form', 'url', 'cookie'));
		$this->load->database();

		if ($this->input->cookie('site_lang')) {
			$this->lang->load('common', $this->input->cookie('site_lang'));
			$this->lang->load('member', $this->input->cookie('site_lang'));
		} else {
			set_cookie('site_lang', 'indonesia', '2147483647'); 
			$this->lang->load('common','indonesia');
			$this->lang->load('member','indonesia');
		}
	}

	public function test_input($data) {
		$data = trim($data);
		$data = stripslashes($data);
		$data = htmlspecialchars($data);
		return $data;
	}

	public function index(){
		$this->updateExpired();
		if ($this->session->userdata('mem_id')){
			$where['req_member_id'] = $this->session->userdata('mem_id');
			$data['request'] = $this->RequestproModel->get_requests($where)->result();
			$this->load->view('frontend/view_request_pro', $data);
		}
		else{
			redirect('frontend/Members');
		}
	}

	public function become_pro(){
		if ($this->session->userdata('mem_id')){
			$cities = $this->MemberModel->get_cities()->result();
			$data['cityOptions'] = "<option value=''>City/Regency</option>";
			foreach($cities as $key => $city){
				$data['cityOptions'] = $data['cityOptions']."<option value='".$city->city_name."'>";
				$data['cityOptions'] = $data['cityOptions'].$city->city_name;
				$data['cityOptions'] = $data['cityOptions']."</option>";
			}

			$data['kennelType'] = $this->KenneltypeModel->get_kennel_types('')->result();
			$where['mem_id'] = $this->session->userdata('mem_id');
			$data['member'] = $this->MemberModel->get_members($where)->row();
			$data['mode'] = 0;
			$this->load->view("frontend/become_pro", $data);
		}
		else{
			redirect("frontend/Members");
		}
	}

	public function validate(){
		if ($this->session->userdata('mem_id')){
			$site_lang = $this->input->cookie('site_lang');
			$cities = $this->MemberModel->get_cities()->result();
			$data['cityOptions'] = "<option value=''>City/Regency</option>";
			foreach($cities as $key => $city){
				$data['cityOptions'] = $data['cityOptions']."<option value='".$city->city_name."'>";
				$data['cityOptions'] = $data['cityOptions'].$city->city_name;
				$data['cityOptions'] = $data['cityOptions']."</option>";
			}
			
			$data['kennelType'] = $this->KenneltypeModel->get_kennel_types('')->result();
			$where['mem_id'] = $this->session->userdata('mem_id');
			$data['member'] = $this->MemberModel->get_members($where)->row();
			$data['mode'] = 1;

			$where['req_member_id'] = $this->session->userdata('mem_id');
			$where_in = array($this->config->item('saved'),$this->config->item('not_paid'));
			$res = $this->RequestproModel->get_requests($where, $where_in)->num_rows();
			if ($res){
				if ($site_lang == 'indonesia') {
					$this->session->set_flashdata('error_message', 'Laporan menjadi pro yang lama belum diproses. Harap tunggu persetujuan.');
				}
				else{
					$this->session->set_flashdata('error_message', 'The previous become pro report has not been processed. Please wait for approval');
				}
				$this->load->view("frontend/become_pro", $data);
			}
			else{
				$this->form_validation->set_error_delimiters('<div>','</div>');
				if ($site_lang == 'indonesia') {
					$this->form_validation->set_message('required', '%s wajib diisi');
					$this->form_validation->set_rules('mem_name', 'Nama sesuai KTP ', 'trim|required');
					$this->form_validation->set_rules('mem_mail_address', 'Alamat surat menyurat ', 'trim|required');
					$this->form_validation->set_rules('mem_address', 'Alamat ', 'trim|required');
					$this->form_validation->set_rules('mem_hp', 'No. HP Aktif WA ', 'trim|required');
					$this->form_validation->set_rules('mem_kota', 'Kota ', 'trim|required');
					$this->form_validation->set_rules('mem_kode_pos', 'Kode pos ', 'trim|required');
					$this->form_validation->set_rules('mem_email', 'email ', 'trim|required');
					$this->form_validation->set_rules('mem_ktp', 'No. KTP ', 'trim|required');
					$this->form_validation->set_rules('ken_name', 'Nama kennel ', 'trim|required');
					$this->form_validation->set_rules('payment_method', 'Metode Pembayaran ', 'trim|required');
				}
				else{
					$this->form_validation->set_message('required', '%s is required');
					$this->form_validation->set_rules('mem_name', 'ID Card Name ', 'trim|required');
					$this->form_validation->set_rules('mem_mail_address', 'Mail Address ', 'trim|required');
					$this->form_validation->set_rules('mem_address', 'Address ', 'trim|required');
					$this->form_validation->set_rules('mem_hp', 'Active WhatsApp Number ', 'trim|required');
					$this->form_validation->set_rules('mem_kota', 'City/Regency ', 'trim|required');
					$this->form_validation->set_rules('mem_kode_pos', 'Postal Code ', 'trim|required');
					$this->form_validation->set_rules('mem_email', 'email ', 'trim|required');
					$this->form_validation->set_rules('mem_ktp', 'ID Card Number ', 'trim|required');
					$this->form_validation->set_rules('ken_name', 'Kennel Name ', 'trim|required');
					$this->form_validation->set_rules('payment_method', 'Payment Method ', 'trim|required');
				}

				if ($this->form_validation->run() == FALSE){
					$this->load->view("frontend/become_pro", $data);
				}
				else{
					$err = 0;
					$logo = '-';
					if (isset($_POST['attachment_logo']) && !empty($_POST['attachment_logo'])){
						$uploadedLogo = $_POST['attachment_logo'];
						$image_array_1 = explode(";", $uploadedLogo);
						$image_array_2 = explode(",", $image_array_1[1]);
						$uploadedLogo = base64_decode($image_array_2[1]);
	
						if ((strlen($uploadedLogo) > $this->config->item('file_size'))){
							$err++;
							if ($site_lang == 'indonesia') {
								$this->session->set_flashdata('error_message', "Ukuran file kennel terlalu besar (> 1 MB).");
							}
							else{
								$this->session->set_flashdata('error_message', "The kennel file size is too big (> 1 MB).");
							}
						}

						$logo_name = $this->config->item('path_kennel').$this->config->item('file_name_kennel');
						if (!is_dir($this->config->item('path_kennel')) or !is_writable($this->config->item('path_kennel'))){
							$err++;
							if ($site_lang == 'indonesia') {
								$this->session->set_flashdata('error_message', 'Folder kennel tidak ditemukan atau tidak writable.');
							}
							else{
								$this->session->set_flashdata('error_message', 'Kennel folder is not found or is not writable.');
							}
						} else {
							if (is_file($logo_name) and !is_writable($logo_name)){
								$err++;
								if ($site_lang == 'indonesia') {
									$this->session->set_flashdata('error_message', 'File kennel sudah ada dan tidak writable.');
								}
								else{
									$this->session->set_flashdata('error_message', 'The kennel file is already exists and is not writable.');
								}
							}
						}
					}
					else{
						if($data['member']->ken_photo == '-' ||  $data['member']->ken_photo == null){
							$err++;
							if ($site_lang == 'indonesia') {
								$this->session->set_flashdata('error_message', 'Foto Kennel wajib diisi');
							}
							else{
								$this->session->set_flashdata('error_message', 'Kennel Photo is required');
							}
							redirect("frontend/Requestpro/become_pro");
						}
					}

					$proof = '-';
					if($this->input->post('payment_method') == 'upload-proof'){
						if (isset($_POST['attachment_proof']) && !empty($_POST['attachment_proof'])){
							$uploadedProof = $_POST['attachment_proof'];
							$image_array_1 = explode(";", $uploadedProof);
							$image_array_2 = explode(",", $image_array_1[1]);
							$uploadedProof = base64_decode($image_array_2[1]);
		
							if ((strlen($uploadedProof) > $this->config->item('file_size'))){
								$err++;
								if ($site_lang == 'indonesia') {
									$this->session->set_flashdata('error_message', "Ukuran file foto bukti pembayaran terlalu besar (> 1 MB).");
								}
								else{
									$this->session->set_flashdata('error_message', "The photo proof of payment file size is too big (> 1 MB).");
								}
							}

							$proof_name = $this->config->item('path_payment').$this->config->item('file_name_payment');
							if (!is_dir($this->config->item('path_payment')) or !is_writable($this->config->item('path_payment'))){
								$err++;
								if ($site_lang == 'indonesia') {
									$this->session->set_flashdata('error_message', 'Folder payment tidak ditemukan atau tidak writable.');
								}
								else{
									$this->session->set_flashdata('error_message', 'Payment folder is not found or is not writable.');
								}
							} else {
								if (is_file($proof_name) and !is_writable($proof_name)){
									$err++;
									if ($site_lang == 'indonesia') {
										$this->session->set_flashdata('error_message', 'File foto bukti pembayaran sudah ada dan tidak writable.');
									}
									else{
										$this->session->set_flashdata('error_message', 'The photo proof of payment file is already exists and is not writable.');
									}
								}
							}
						}
						else{
							$err++;
							if ($site_lang == 'indonesia') {
								$this->session->set_flashdata('error_message', 'Foto Bukti Pembayaran wajib diisi');
							}
							else{
								$this->session->set_flashdata('error_message', 'Photo Proof of Payment is required');
							}
							redirect("frontend/Requestpro/become_pro");
						}
					}

					$email = $this->test_input($this->input->post('mem_email'));
					if (!$err && !filter_var($email, FILTER_VALIDATE_EMAIL)) {
						$err++;
						if ($site_lang == 'indonesia') {
							$this->session->set_flashdata('error_message', 'Format email tidak valid');
						}
						else{
							$this->session->set_flashdata('error_message', 'Invalid email format');
						}
					}

					if (!$err && $this->MemberModel->check_for_duplicate($this->session->userdata('mem_id'), 'mem_ktp', $this->input->post('mem_ktp'))){
						$err++;
						if ($site_lang == 'indonesia') {
							$this->session->set_flashdata('error_message', 'No. KTP sudah terdaftar');
						}
						else{
							$this->session->set_flashdata('error_message', 'ID Card Number is already registered');
						}
					}

					if (!$err && $this->MemberModel->check_for_duplicate($this->session->userdata('mem_id'), 'mem_hp', $this->input->post('mem_hp'))){
						$err++;
						if ($site_lang == 'indonesia') {
							$this->session->set_flashdata('error_message', 'No. HP sudah terdaftar');
						}
						else{
							$this->session->set_flashdata('error_message', 'Phone number is already registered');
						}
					}
	
					if (!$err && $this->MemberModel->check_for_duplicate($this->session->userdata('mem_id'), 'mem_email', $this->input->post('mem_email'))){
						$err++;
						if ($site_lang == 'indonesia') {
							$this->session->set_flashdata('error_message', 'email sudah terdaftar');
						}
						else{
							$this->session->set_flashdata('error_message', 'email is already registered');
						}
					}

					if (!$err && $this->KennelModel->check_for_duplicate($this->session->userdata('mem_id'), 'ken_name', $this->input->post('ken_name'))){
						$err++;
						if ($site_lang == 'indonesia') {
							$this->session->set_flashdata('error_message', 'Nama kennel sudah terdaftar');
						}
						else{
							$this->session->set_flashdata('error_message', 'Kennel name is already registered');
						}
					}

					if (!$err) {
						if (isset($uploadedLogo)){
							file_put_contents($logo_name, $uploadedLogo);
							$logo = str_replace($this->config->item('path_kennel'), '', $logo_name);
						}
						if($this->input->post('payment_method') == 'upload-proof'){
							if (isset($uploadedProof)){
								file_put_contents($proof_name, $uploadedProof);
								$proof = str_replace($this->config->item('path_payment'), '', $proof_name);
							}
						}

						$dataMember = array(
							'req_member_id' => $this->session->userdata('mem_id'),
							'req_name' => strtoupper($this->input->post('mem_name')),
							'req_address' => $this->input->post('mem_address'),
							'req_mail_address' => $this->input->post('mem_mail_address'),
							'req_hp' => $this->input->post('mem_hp'),
							'req_kota' => $this->input->post('mem_kota'),
							'req_kode_pos' => $this->input->post('mem_kode_pos'),
							'req_email' => $this->input->post('mem_email'),
							'req_ktp' => $this->input->post('mem_ktp'),
							'req_stat' => $this->config->item('saved'),
							'req_date' => date('Y-m-d H:i:s'),
							'req_kennel_id' => $data['member']->ken_id,
							'req_kennel_name' => $this->input->post('ken_name'),
							'req_kennel_type_id' => $this->input->post('ken_type_id'),
							'req_kennel_photo' => $logo,
							'req_pay_photo' => $proof,
							'req_old_name' => $data['member']->mem_name,
							'req_old_address' => $data['member']->mem_address,
							'req_old_mail_address' => $data['member']->mem_mail_address,
							'req_old_hp' => $data['member']->mem_hp,
							'req_old_kota' => $data['member']->mem_kota,
							'req_old_kode_pos' => $data['member']->mem_kode_pos,
							'req_old_email' => $data['member']->mem_email,
							'req_old_ktp' => $data['member']->mem_ktp,
							'req_old_kennel_name' => $data['member']->ken_name,
							'req_old_kennel_type_id' => $data['member']->ken_type_id,
							'req_old_kennel_photo' => $data['member']->ken_photo,
						);

						if($this->input->post('payment_method') == 'upload-proof'){
							$dataMember['req_pay_id'] = $this->config->item('upload_proof');
						}
						else{
							$dataMember['req_stat'] = $this->config->item('not_paid');
							$dataMember['req_pay_id'] = $this->config->item('doku');
							$inv = $this->generateInvoice();
							$dataMember['req_pay_invoice'] = $inv;
							$dataMember['req_pay_due_date'] = date('Y-m-d H:i:s', strtotime('1 hour'));
						}

						$insert = $this->RequestproModel->add_requests($dataMember);
						if ($insert) {
							if($this->input->post('payment_method') == 'upload-proof'){
								$this->session->set_flashdata('become_pro', TRUE);
								redirect("frontend/Requestpro");
							}
							else{
								redirect("frontend/Payment/checkout/Requestpro/200000/".$inv);
							}
						} else {
							if ($site_lang == 'indonesia') {
								$this->session->set_flashdata('error_message', 'Gagal menyimpan laporan menjadi pro');
							}
							else{
								$this->session->set_flashdata('error_message', 'Failed to save become pro report');
							}
							$this->load->view("frontend/become_pro", $data);
						}
					} 
					else {
						$this->load->view("frontend/become_pro", $data);
					}
				}
			}
		}
		else{
			redirect("frontend/Members");
		}
	}
	public function cek_status($invoice){
		if ($this->uri->segment(4)){
			$site_lang = $this->input->cookie('site_lang');

			$where['req_pay_invoice'] = $invoice;
			$requests = $this->RequestproModel->get_requests($where)->row();
	
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
							$res = $this->failPro($requests->req_id);
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
									$this->session->set_flashdata('error_message', 'Gagal mengubah status pengajuan dengan id = '.$requests->req_id);
								}
								else{
									$this->session->set_flashdata('error_message', 'Failed to change submission status with id = '.$requests->req_id);
								}
							}
							redirect("frontend/Requestpro");
						}
						else if($statRes == 'SUCCESS'){
							$res = $this->payPro($requests->req_id);
							if($res){
								$this->session->set_flashdata('become_pro', TRUE);
								redirect("frontend/Requestpro");
							}
							else{
								if ($site_lang == 'indonesia') {
									$this->session->set_flashdata('error_message', 'Gagal membayar pengajuan dengan id = '.$requests->req_id);
								}
								else{
									$this->session->set_flashdata('error_message', 'Failed to pay submission with id = '.$requests->req_id);
								}
								redirect("frontend/Requestpro");
							}
						}
						else if($statRes == 'EXPIRED'){
							if ($site_lang == 'indonesia') {
								$this->session->set_flashdata('error_message', 'Batas pembayaran sudah lewat');
							}
							else{
								$this->session->set_flashdata('error_message', 'The payment due date has passed');
							}
							redirect("frontend/Requestpro");
						}
						else if($statRes == 'PENDING'){
							if ($site_lang == 'indonesia') {
								$this->session->set_flashdata('error_message', 'Pembayaran belum diselesaikan');
							}
							else{
								$this->session->set_flashdata('error_message', 'Payment has not been completed');
							}
							redirect('frontend/Requestpro');
						}
						else{
							if ($site_lang == 'indonesia') {
								$this->session->set_flashdata('error_message', 'Pembayaran gagal');
							}
							else{
								$this->session->set_flashdata('error_message', 'Payment failed');
							}
							redirect('frontend/Requestpro');
						}
						break;
					default:
						redirect('frontend/Requestpro');
				}
			}
			else{
				if ($site_lang == 'indonesia') {
					$this->session->set_flashdata('error_message', 'Pembayaran gagal');
				}
				else{
					$this->session->set_flashdata('error_message', 'Payment failed');
				}
				// $this->session->set_flashdata('error_message', 'Curl error: '.curl_error($ch));
				redirect('frontend/Requestpro');
			}
	
			// Close cURL
			curl_close($ch);
		}
		else{
			redirect("frontend/Requestpro");
		}
	}
	function generateInvoice($length = 8) {
		$characters = '0123456789';
		$string = '';
	
		for ($i = 0; $i < $length; $i++) {
			$string .= $characters[mt_rand(0, strlen($characters) - 1)];
		}
	
		$string = 'INVP-'.$string;
		return $string;
	}
	function generate_signature($componentSignature, $secretKey){
		$signature = base64_encode(hash_hmac('sha256', $componentSignature, $secretKey, true));
		return $signature;
	}
	public function payPro($req_id){
		$data = array(
			'req_stat' => $this->config->item('processed')
		);

		$this->db->trans_strict(FALSE);
		$this->db->trans_start();
		$where['req_id'] = $req_id;
		$requests = $this->RequestproModel->update_requests($data, $where);
		if ($requests) {
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
	public function failPro($req_id){
		$data = array(
			'req_stat' => $this->config->item('payment_failed')
		);

		$this->db->trans_strict(FALSE);
		$this->db->trans_start();
		$where['req_id'] = $req_id;
		$requests = $this->RequestproModel->update_requests($data, $where);
		if ($requests) {
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
	public function cancel(){
		if ($this->uri->segment(4)){
			$site_lang = $this->input->cookie('site_lang');
			$req_id = $this->uri->segment(4);
			$dataReq = array(
				'req_stat' => $this->config->item('cancelled')
			);
	
			$this->db->trans_strict(FALSE);
			$this->db->trans_start();
			$whereReq['req_id'] = $req_id;
			$requests = $this->RequestproModel->update_requests($dataReq, $whereReq);
			if ($requests) {
				$this->db->trans_complete();
				$this->session->set_flashdata('cancel_success', TRUE);
				redirect('frontend/Requestpro');
			} else {
				$this->db->trans_rollback();
				if ($site_lang == 'indonesia') {
					$this->session->set_flashdata('error_message', 'Gagal membatalkan pengajuan. Error code: '.$err);
				}
				else{
					$this->session->set_flashdata('error_message', 'Failed to cancel submission. Error code: '.$err);
				}
				redirect('frontend/Requestpro');
			}
		}
		else{
			redirect('frontend/Requestpro');
		}
	}
	function updateExpired(){
        $this->db->trans_strict(FALSE);
        $this->db->trans_start();

        //update all expired payment canine status
        $requests = $this->RequestproModel->update_expired_requests();
        
        if ($requests) {
            $this->db->trans_complete();
            return true;
        } else {
            $this->db->trans_rollback();
            return false;
        }
	}
}
