<?php
defined('BASEPATH') OR exit('No direct script access allowed');

#[\AllowDynamicProperties]

class Canines extends CI_Controller {
    public function __construct(){
        // Call the CI_Controller constructor
        parent::__construct();
        $this->load->model(array('caninesModel','memberModel', 'pedigreesModel', 'trahModel', 'KennelModel', 'requestmicrochipModel'));
        $this->load->library(array('session', 'form_validation', 'pagination'));
        $this->load->helper(array('url', 'cookie'));
        $this->load->database();
        date_default_timezone_set("Asia/Bangkok");

		if ($this->input->cookie('site_lang')) {
            $this->lang->load('common', $this->input->cookie('site_lang'));
            $this->lang->load('canine', $this->input->cookie('site_lang'));
			$this->lang->load('ownership', $this->input->cookie('site_lang'));
        } else {
            set_cookie('site_lang', 'indonesia', '2147483647'); 
            $this->lang->load('common','indonesia');
            $this->lang->load('canine','indonesia');
			$this->lang->load('ownership', 'indonesia');
        }
    }

	public function index(){
		if ($this->session->userdata('mem_id')){
			$this->updateExpired();
			$this->updateExpiredMicrochip();
			$page = ($this->uri->segment(4)) ? ($this->uri->segment(4) - 1) : 0;
			$config['per_page'] = $this->config->item('canine_count');
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

			$where['can_member_id'] = $this->session->userdata('mem_id');
			// $where['can_stat !='] = $this->config->item('cancelled');
			$where_not_in = array($this->config->item('cancelled'), $this->config->item('delete_stat'));
			$data['canines'] = $this->caninesModel->get_canines($where, 'can_id desc', $page * $config['per_page'], $this->config->item('canine_count'), $where_not_in)->result();

			$config['base_url'] = base_url().'/frontend/Canines/index';
			$config['total_rows'] = $this->caninesModel->get_canines($where, 'can_id desc', $page * $config['per_page'], 0, $where_not_in)->num_rows();
			$this->pagination->initialize($config);

			$data['keywords'] = '';
            $this->session->set_userdata('keywords', '');
			$this->load->view('frontend/view_canines', $data);
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
			$config['per_page'] = $this->config->item('canine_count');
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

			$like['can_a_s'] = $data['keywords'];
			$like['can_icr_number'] = $data['keywords'];
			$where['can_member_id'] = $this->session->userdata('mem_id');
			// $where['can_stat !='] = $this->config->item('cancelled');
			$where_not_in = array($this->config->item('cancelled'), $this->config->item('delete_stat'));
			$data['canines'] = $this->caninesModel->search_canines($like, $where, 'can_id desc', $page * $config['per_page'], $this->config->item('canine_count'), $where_not_in)->result();

			$config['base_url'] = base_url().'/frontend/Canines/search';
			$config['total_rows'] = $this->caninesModel->search_canines($like, $where, 'can_id desc', $page * $config['per_page'], 0, $where_not_in)->num_rows();
			$this->pagination->initialize($config);
			$this->load->view('frontend/view_canines', $data);
		}
		else{
			redirect('frontend/Members');
		}
    }

	public function view_detail(){
        if ($this->uri->segment(4)){
			$where['can_id'] = $this->uri->segment(4);
			$data['canine'] = $this->caninesModel->get_canines($where)->row();
			$whePed['ped_canine_id'] = $this->uri->segment(4);
			$ped = $this->pedigreesModel->get_pedigrees($whePed)->row();
			$sire['can_id'] = $ped->ped_sire_id;
			$data['sire'] = $this->caninesModel->get_canines($sire)->row();
			$dam['can_id'] = $ped->ped_dam_id;
			$data['dam'] = $this->caninesModel->get_canines($dam)->row();
			
			if ($ped->ped_sire_id != $this->config->item('sire_id') && $ped->ped_dam_id != $this->config->item('dam_id')){
				$data['male_siblings'] = $this->caninesModel->get_siblings($this->uri->segment(4), $ped->ped_sire_id, $ped->ped_dam_id, 'MALE', $data['canine']->can_date_of_birth2)->result();
				$data['female_siblings'] = $this->caninesModel->get_siblings($this->uri->segment(4), $ped->ped_sire_id, $ped->ped_dam_id, 'FEMALE', $data['canine']->can_date_of_birth2)->result();
			}
			else{
				$data['male_siblings'] = [];
				$data['female_siblings'] = [];
			}
			$this->load->view("frontend/view_canine_detail", $data);
        }
        else{
          	redirect('frontend/Canines');
        }
    }

	public function add(){
		if ($this->session->userdata('mem_id')){
            $wheTrah['tra_stat'] = $this->config->item('frontend_breed');
			$data['trah'] = $this->trahModel->get_trah($wheTrah)->result();
			$whe['ken_member_id'] = $this->session->userdata('mem_id');
			$whe['ken_stat'] = $this->config->item('accepted');
			$data['kennel'] = $this->KennelModel->get_kennels($whe)->result();
			$this->load->view('frontend/add_canine', $data);
		}
		else{
			redirect("frontend/Members");
		}
	}

	public function validate_add(){ 
		if ($this->session->userdata('mem_id')){
			$site_lang = $this->input->cookie('site_lang');
			$this->form_validation->set_error_delimiters('<div>','</div>');
			if ($site_lang == 'indonesia') {
				$this->form_validation->set_message('required', '%s wajib diisi');
				$this->form_validation->set_rules('can_kennel_id', 'Kennel id ', 'trim|required');
				$this->form_validation->set_rules('can_a_s', 'Nama ', 'trim|required');
				$this->form_validation->set_rules('can_date_of_birth', 'Tanggal Lahir ', 'trim|required');
				$this->form_validation->set_rules('payment_method', 'Metode Pembayaran ', 'trim|required');
			}
			else{
				$this->form_validation->set_rules('can_kennel_id', 'Kennel id ', 'trim|required');
				$this->form_validation->set_rules('can_a_s', 'Name ', 'trim|required');
				$this->form_validation->set_rules('can_date_of_birth', 'Date of Birth ', 'trim|required');
				$this->form_validation->set_rules('payment_method', 'Payment Method ', 'trim|required');
			}

            $wheTrah['tra_stat'] = $this->config->item('frontend_breed');
			$data['trah'] = $this->trahModel->get_trah($wheTrah)->result();
			$whe['ken_member_id'] = $this->session->userdata('mem_id');
			$whe['ken_stat'] = $this->config->item('accepted');
			$data['kennel'] = $this->KennelModel->get_kennels($whe)->result();
			if ($this->form_validation->run() == FALSE){
				$this->load->view('frontend/add_canine', $data);
			}
			else{
				$err = 0;
				$photo = '-';
				$photoProof = '-';
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
						$image_name = $this->config->item('path_canine').$this->config->item('file_name_canine');
						if (!is_dir($this->config->item('path_canine')) or !is_writable($this->config->item('path_canine'))) {
							$err++;
							if ($site_lang == 'indonesia') {
								$this->session->set_flashdata('error_message', 'Folder anjing tidak ditemukan atau tidak writable.');
							}
							else{
								$this->session->set_flashdata('error_message', 'Dog folder is not found or is not writable.');
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
							$photo = str_replace($this->config->item('path_canine'), '', $image_name);
						}
					}
				}

				if($this->input->post('payment_method') == 'upload-proof'){
					if ($this->input->post('attachment_proof')) {
						$uploadedImg = $this->input->post('attachment_proof');
						$image_array_1 = explode(";", $uploadedImg);
						$image_array_2 = explode(",", $image_array_1[1]);
						$uploadedImg = base64_decode($image_array_2[1]);
	
						if ((strlen($uploadedImg) > $this->config->item('file_size'))) {
							$err++;
							if ($site_lang == 'indonesia') {
								$this->session->set_flashdata('error_message', 'Ukuran file bukti pembayaran terlalu besar (> 1 MB).');
							}
							else{
								$this->session->set_flashdata('error_message', 'Payment proof file size is too big (> 1 MB).');
							}
						}
						else{
							$image_name = $this->config->item('path_payment').$this->config->item('file_name_payment');
							if (!is_dir($this->config->item('path_payment')) or !is_writable($this->config->item('path_payment'))) {
								$err++;
								if ($site_lang == 'indonesia') {
									$this->session->set_flashdata('error_message', 'Folder payment tidak ditemukan atau tidak writable.');
								}
								else{
									$this->session->set_flashdata('error_message', 'Payment folder is not found or is not writable.');
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
								$photoProof = str_replace($this->config->item('path_payment'), '', $image_name);
							}
						}
					}
				}

				if (!$err && $photo == "-"){
					$err++;
					if ($site_lang == 'indonesia') {
						$this->session->set_flashdata('error_message', 'Foto anjing wajib diisi');
					}
					else{
						$this->session->set_flashdata('error_message', 'Dog photo is required');
					}
				}

				if($this->input->post('payment_method') == 'upload-proof'){
					if (!$err && $photoProof == "-"){
						$err++;
						if ($site_lang == 'indonesia') {
							$this->session->set_flashdata('error_message', 'Foto bukti pembayaran wajib diisi');
						}
						else{
							$this->session->set_flashdata('error_message', 'Photo proof of payment is required');
						}
					}
				}

                $piece = explode("-", $this->input->post('can_date_of_birth'));
                $dob = $piece[2]."-".$piece[1]."-".$piece[0];
				if (!$err){
					$ts = new DateTime();
					$ts_dob = new DateTime($dob);
                    if ($ts_dob > $ts){
                        $err++;
						if ($site_lang == 'indonesia') {
							$this->session->set_flashdata('error_message', 'Tanggal lahir anjing harus sebelum tanggal hari ini');
						}
						else{
							$this->session->set_flashdata('error_message', "The dog's date of birth must be before today's date");
						}
                    }
                    else{ // min 45 hari
                        $diff = $ts->diff($ts_dob)->days/$this->config->item('min_jarak_lapor_anak');
                        if ($diff < 1){
                            $err++;
							if ($site_lang == 'indonesia') {
								$this->session->set_flashdata('error_message', 'Tanggal lahir anjing harus lebih dari '.$this->config->item('min_jarak_lapor_anak').' hari sebelum hari ini');
							}
							else{
								$this->session->set_flashdata('error_message', "The dog's date of birth must be more than ".$this->config->item('min_jarak_lapor_anak').' days before today');
							}
                        }
                    }
                }

                if (!$err){
                    $dataCan = array(
                        'can_member_id' => $this->session->userdata('mem_id'),
                        'can_reg_number' => '-', // strtoupper($this->input->post('can_reg_number')),
                        'can_breed' => $this->input->post('can_breed'),
                        'can_gender' => $this->input->post('can_gender'),
                        'can_date_of_birth' => $dob,
                        'can_color' => '-', // $this->input->post('can_color'),
                        'can_kennel_id' => $this->input->post('can_kennel_id'),
                        'can_reg_date' => date("Y/m/d"),
                        'can_photo' => $photo,
                        'can_pay_photo' => $photoProof,
                        'can_pay_invoice' => '-',
                        'can_chip_number' => '-', // $this->input->post('can_chip_number'),
                        'can_icr_number' => '-', // $this->input->post('can_icr_number'),
                    );

					if($this->input->post('payment_method') == 'upload-proof'){
						$dataCan['can_pay_id'] = $this->config->item('upload_proof');
					}
					else{
						$dataCan['can_pay_id'] = $this->config->item('doku');
						$inv = $this->generateInvoice();
						$dataCan['can_pay_invoice'] = $inv;
						$dataCan['can_stat'] = $this->config->item('not_paid');
						$dataCan['can_pay_due_date'] = date('Y-m-d H:i:s', strtotime('1 hour'));
					}
    
                    // nama diubah berdasarkan kennel
                    $whereKennel['ken_id'] = $this->input->post('can_kennel_id');
                    $kennel = $this->KennelModel->get_kennels($whereKennel)->result();
                    if ($kennel){
                        if ($kennel[0]->ken_type_id == 1)
                            $dataCan['can_a_s'] = strtoupper($this->input->post('can_a_s'))." VON ".$kennel[0]->ken_name;
                        else if ($kennel[0]->ken_type_id == 2)
                            $dataCan['can_a_s'] = $kennel[0]->ken_name."` ".strtoupper($this->input->post('can_a_s'));
                        else 
                            $dataCan['can_a_s'] = strtoupper($this->input->post('can_a_s'));
                    }
        
                    if (!$err && $this->caninesModel->check_for_duplicate(0, 'can_a_s', $dataCan['can_a_s'])){
                        $err++;
						if ($site_lang == 'indonesia') {
							$this->session->set_flashdata('error_message', 'Nama anjing tidak boleh sama');
						}
						else{
							$this->session->set_flashdata('error_message', 'Duplicate dog name');
						}
                    }

                    if (strlen($dataCan['can_a_s']) >= $this->config->item('can_a_s_length')){
                        $err++;
						if ($site_lang == 'indonesia') {
							$this->session->set_flashdata('error_message', 'Nama anjing terlalu panjang. Ditambah dengan nama kennel, harus di bawah '.$this->config->item('can_a_s_length').' karakter');
						}
						else{
							$this->session->set_flashdata('error_message', "The dog's name is too long. Added with the kennel name, it must be under ".$this->config->item('can_a_s_length').' characters');
						}
                    }

                    if (!$err){
                        $dataPed = array(
                            'ped_sire_id' => $this->config->item('sire_id'),
                            'ped_dam_id' => $this->config->item('dam_id')
                        );

                        $this->db->trans_strict(FALSE);
                        $this->db->trans_start();
                        $canines = $this->caninesModel->add_canines($dataCan);
                        if ($canines){
							$insertedID = $this->db->insert_id();
							$dataPed['ped_canine_id'] = $insertedID;
                            $pedigree = $this->pedigreesModel->add_pedigrees($dataPed);
                            if ($pedigree){
                                $this->db->trans_complete();
								if($this->input->post('payment_method') == 'upload-proof'){
									$this->session->set_flashdata('add_success', true);
									redirect("frontend/Canines");
								}
								else{
									redirect("frontend/Payment/checkout/Canines/150000/".$inv);
								}
                            }
                            else{
                                $err++;
                            }
                        }
                        else{
                            $err++;
                        }
                        if ($err){
                            $this->db->trans_rollback();
							if ($site_lang == 'indonesia') {
								$this->session->set_flashdata('error_message', 'Gagal menyimpan data anjing');
							}
							else{
								$this->session->set_flashdata('error_message', 'Failed to save dog');
							}
                            $this->load->view('frontend/add_canine', $data);
                        }
                    }
                    else{
                        $this->load->view('frontend/add_canine', $data);
                    }
                }
                else{
                    $this->load->view('frontend/add_canine', $data);
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

			$where['can_pay_invoice'] = $invoice;
			$canines = $this->caninesModel->get_canines($where)->row();
	
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
							$res = $this->failCanine($canines->can_id);
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
									$this->session->set_flashdata('error_message', 'Gagal mengubah status pendaftaran anjing dengan id = '.$canines->can_id);
								}
								else{
									$this->session->set_flashdata('error_message', 'Failed to change dog registration status with id = '.$canines->can_id);
								}
							}
							redirect("frontend/Canines");
						}
						else if($statRes == 'SUCCESS'){
							$res = $this->payCanine($canines->can_id);
							if($res){
								$this->session->set_flashdata('add_success', true);
								redirect("frontend/Canines");
							}
							else{
								if ($site_lang == 'indonesia') {
									$this->session->set_flashdata('error_message', 'Gagal membayar pendaftaran anjing dengan id = '.$canines->can_id);
								}
								else{
									$this->session->set_flashdata('error_message', 'Failed to pay dog registration with id = '.$canines->can_id);
								}
								redirect("frontend/Canines");
							}
						}
						else if($statRes == 'EXPIRED'){
							if ($site_lang == 'indonesia') {
								$this->session->set_flashdata('error_message', 'Batas pembayaran sudah lewat');
							}
							else{
								$this->session->set_flashdata('error_message', 'The payment due date has passed');
							}
							redirect("frontend/Canines");
						}
						else if($statRes == 'PENDING'){
							if ($site_lang == 'indonesia') {
								$this->session->set_flashdata('error_message', 'Pembayaran belum diselesaikan');
							}
							else{
								$this->session->set_flashdata('error_message', 'Payment has not been completed');
							}
							redirect('frontend/Canines');
						}
						else{
							if ($site_lang == 'indonesia') {
								$this->session->set_flashdata('error_message', 'Pembayaran gagal');
							}
							else{
								$this->session->set_flashdata('error_message', 'Payment failed');
							}
							redirect('frontend/Canines');
						}
						break;
					default:
						redirect('frontend/Canines');
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
				redirect('frontend/Canines');
			}
	
			// Close cURL
			curl_close($ch);
		}
		else{
			redirect("frontend/Members");
		}
	}
	function generateInvoice($length = 8) {
		$characters = '0123456789';
		$string = '';
	
		for ($i = 0; $i < $length; $i++) {
			$string .= $characters[mt_rand(0, strlen($characters) - 1)];
		}
	
		$string = 'TESCAN-'.$string;
		return $string;
	}
	function generate_signature($componentSignature, $secretKey){
		$signature = base64_encode(hash_hmac('sha256', $componentSignature, $secretKey, true));
		return $signature;
	}
	public function payCanine($can_id){
		$data = array(
			'can_stat' => $this->config->item('processed')
		);

		$this->db->trans_strict(FALSE);
		$this->db->trans_start();
		$where['can_id'] = $can_id;
		$canines = $this->caninesModel->update_canines($data, $where);
		if ($canines) {
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
	public function failCanine($can_id){
		$data = array(
			'can_stat' => $this->config->item('payment_failed')
		);

		$this->db->trans_strict(FALSE);
		$this->db->trans_start();
		$where['can_id'] = $can_id;
		$canines = $this->caninesModel->update_canines($data, $where);
		if ($canines) {
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
			$can_id = $this->uri->segment(4);
			$dataCan = array(
				'can_stat' => $this->config->item('cancelled')
			);
	
			$this->db->trans_strict(FALSE);
			$this->db->trans_start();
			$whereCan['can_id'] = $can_id;
			$canines = $this->caninesModel->update_canines($dataCan, $whereCan);
			if ($canines) {
				$this->db->trans_complete();
				$this->session->set_flashdata('cancel_success', TRUE);
				redirect('frontend/Canines');
			} else {
				$this->db->trans_rollback();
				if ($site_lang == 'indonesia') {
					$this->session->set_flashdata('error_message', 'Gagal membatalkan pendaftaran. Error code: '.$err);
				}
				else{
					$this->session->set_flashdata('error_message', 'Failed to cancel registration. Error code: '.$err);
				}
				redirect('frontend/Canines');
			}
		}
		else{
			redirect('frontend/Canines');
		}
	}
	function updateExpired(){
        $this->db->trans_strict(FALSE);
        $this->db->trans_start();

        //update all expired payment canine status
        $canines = $this->caninesModel->update_expired_canines();
        
        if ($canines) {
            $this->db->trans_complete();
            return true;
        } else {
            $this->db->trans_rollback();
            return false;
        }
	}
	function updateExpiredMicrochip(){
        $this->db->trans_strict(FALSE);
        $this->db->trans_start();

        //update all expired payment canine status
        $requests = $this->requestmicrochipModel->update_expired_requests();
        
        if ($requests) {
            $this->db->trans_complete();
            return true;
        } else {
            $this->db->trans_rollback();
            return false;
        }
	}
}