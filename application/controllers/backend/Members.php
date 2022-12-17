<?php // ARTechnology
defined('BASEPATH') OR exit('No direct script access allowed');

class Members extends CI_Controller {
		public function __construct(){
			// Call the CI_Controller constructor
			parent::__construct();
			$this->load->model(array('memberModel', 'KennelModel', 'LogmemberModel', 'notification_model', 'notificationtype_model'));
			$this->load->library('upload', $this->config->item('upload_member'));
			$this->load->library(array('session', 'form_validation'));
			$this->load->library('email', $this->config->item('email'));
			$this->email->set_newline("\r\n");
			$this->load->helper(array('url'));
			$this->load->database();
			date_default_timezone_set("Asia/Bangkok");
		}

		public function index(){
			$user = $this->session->userdata('user_data');
			$data['users'] = $user;
			$data['navigations'] = $this->navigations;
			$data['kennels'] = $this->KennelModel->daftar_kennels();
			$this->twig->display('backend/members', $data);
		}

		public function view_approve(){
			$where['mem_app_user'] = 0;
			$where['mem_stat'] = $this->config->item('non_paid_member_status');
			$data['member'] = $this->memberModel->get_members($where)->result();
			$this->load->view('backend/approve_members', $data);
		}

		public function search_approve(){
			$like['mem_name'] = $this->input->post('keywords');
			$like['mem_address'] = $this->input->post('keywords');
			$like['mem_hp'] = $this->input->post('keywords');
			$where['mem_app_user'] = 0;
			$where['mem_stat'] = $this->config->item('non_paid_member_status');
			$data['member'] = $this->memberModel->search_members($like, $where)->result();
			$this->load->view('backend/approve_members', $data);
		}

		public function approve(){
			if ($this->uri->segment(4)){
				if ($this->session->userdata('use_username')){
					$where['mem_id'] = $this->uri->segment(4);
					$data['mem_app_user'] = $this->session->userdata('use_id');
					$data['mem_app_date'] = date('Y-m-d H:i:s');
					$res = $this->memberModel->update_members($data, $where);
					if ($res){
						$member = $this->memberModel->get_members($where)->row();
						$this->email->set_mailtype('html');
						$this->email->from($this->config->item('email')['smtp_user'], 'ICR Pedigree Customer Service');
						$this->email->to($member->email);
						$this->email->subject('Ubah Password');

						$message = '<div>Kepada pengguna ICR Pedigree,</div>';
						$message .= '<div>Admin sudah approve keanggotaan anda di ICR Pedigree. Silakan lakukan login untuk mengakses aplikasi ICR Pedigree.</div>';
						$message .= '<div>Salam </div>';
						$message .= '<div>ICR Pedigree Customer Service</div>';
						$message .= '<div><br/><hr/></div>';

						$this->email->message($message);
						$res = $this->email->send();

						$this->session->set_flashdata('approve', TRUE);
						redirect('backend/Members/view_approve');
					}
					else{
						$this->session->set_flashdata('error', 'Member dengan id = '.$this->uri->segment(4).' tidak dapat di-approve');
						redirect('backend/Members/view_approve');
					}
				}
				else{
					redirect('backend/Users/login');
				}
			}
			else{
				redirect('backend/Members/view_approve');
			}
		}

		public function reject(){
			if ($this->uri->segment(4)){
				if ($this->session->userdata('use_username')){
					$where['mem_id'] = $this->uri->segment(4);
					$data['mem_stat'] = $this->config->item('deactivated_member_status');
					$data['mem_app_user'] = $this->session->userdata('use_username');
					$data['mem_app_date'] = date('Y-m-d H:i:s');
					$res = $this->memberModel->update_members($data, $where);
					if ($res){
						$this->session->set_flashdata('reject', TRUE);
						redirect('backend/Members/view_approve');
					}
					else{
						$this->session->set_flashdata('error', 'Member dengan id = '.$this->uri->segment(4).' tidak dapat ditolak');
						redirect('backend/Members/view_approve');
					}
				}
				else{
					redirect('backend/Users/login');
				}
			}
			else{
				redirect('backend/Members/view_approve');
			}
		}

		public function add(){
			$title = self::_clean_text('member');
			$img = $this->input->post('srcDataCrop');
			$_POST['mem_photo'] = '-';
			if ($img) 
				$_POST['mem_photo'] = self::_upload_base64($img, $title);
			unset($_POST['srcDataCrop']);

			$titlePP = self::_clean_text('pp');
			$imgPP = $this->input->post('srcDataCropPP');
			$_POST['mem_pp'] = '-';
			if ($imgPP) 
				$_POST['mem_pp'] = self::_upload_base64($imgPP, $titlePP);
			unset($_POST['srcDataCropPP']);

			$data = $this->input->post(null, true);
			$username = $data['mem_username'];
			$user = self::_same_user($username);
			if ($user) {
				echo json_encode(array('data' => 'Username Sudah Ada!'));
				return false;
			}
			$member = $this->memberModel->get_ktp($this->input->post('mem_ktp'))->result();
			if (count($member) > 1){
				echo json_encode(array('data' => 'No. KTP sudah ada'));
				return false;
			}
			if ($data['password'] == $data['repass']) {
				$data['mem_password'] = sha1($data['password']);
				unset($data['password']);
				unset($data['repass']);
				$id = $this->memberModel->add_members($data);
				if (!$id) {
					echo json_encode(array('data' => 'Gagal Memproses Akun Anda, Coba Lagi.'));
					return false;
				}
				unset($data['mem_password']);
				echo json_encode(array('data' => '1'));

			} else {
				echo json_encode(array('data' => 'Konfirmasi kata sandi gagal.'));
			}
		}

		public function data($id = null){
				if ($id != null) {
						$where['mem_id'] = $id;
						$member = $this->memberModel->get_members($where)->row();
						echo json_encode($member);
				}else{
						$aColumns = array('mem_id', 'mem_name', 'mem_address', 'mem_mail_address', 'mem_hp', 'mem_photo', 'mem_created_at', 'mem_updated_at', 'mem_stat', 'mem_app_user', 'mem_app_date', 'use_username', 'ken_name', 'mem_ken_id', 'mem_email', 'mem_pp', 'mem_kota', 'mem_kode_pos', 'mem_ktp');
						$sTable = 'members';

						$iDisplayStart = $this->input->get_post('start', true);
						$iDisplayLength = $this->input->get_post('length', true);
						$sSearch = $this->input->post('search', true);
						$sEcho = $this->input->get_post('sEcho', true);
						$columns = $this->input->get_post('columns', true);
						$orders = $this->input->get_post('order', true);

						// Paging
						if(isset($iDisplayStart) && $iDisplayLength != '-1'){
								$this->db->limit($this->db->escape_str($iDisplayLength), $this->db->escape_str($iDisplayStart));
						}

						// Ordering
						if(isset($orders[0]['column'])){
								// for($i=0; $i<intval($columns); $i++){
										// $iSortCol = $this->input->get_post('iSortCol_'.$i, true);
										// $bSortable = $this->input->get_post('bSortable_'.intval($iSortCol), true);
										$bSortable = $columns[$orders[0]['column']]['orderable'];
										// $sSortDir = $this->input->get_post('sSortDir_'.$i, true);

										if($bSortable == 'true')
										{
												$this->db->order_by($columns[$orders[0]['column']]['data'], $orders[0]['dir']);
												// $this->db->order_by($aColumns[intval($this->db->escape_str($iSortCol))], $this->db->escape_str($sSortDir));
										}
								// }
						}

						/*
						 * Filtering
						 * NOTE this does not match the built-in DataTables filtering which does it
						 * word by word on any field. It's possible to do here, but concerned about efficiency
						 * on very large tables, and MySQL's regex functionality is very limited
						 */
						if(isset($sSearch['value']) && !empty($sSearch['value'])){
								for($i=0; $i<count($columns); $i++){
										// $bSearchable = $this->input->get_post('bSearchable_'.$i, true);
										$bSearchable = $columns[$i]['searchable'];

										// Individual column filtering
										if(isset($bSearchable) && $bSearchable == 'true')
										{
												for($j=0; $j<count($aColumns); $j++){
													$this->db->or_like($aColumns[$j], $this->db->escape_like_str($sSearch['value']));
												}
										}
								}
						}


						// Select Data
						$this->db->select('SQL_CALC_FOUND_ROWS '.str_replace(' , ', ' ', implode(', ', $aColumns)), false);
						$this->db->join('users','users.use_id = members.mem_app_user');
						$this->db->join('kennels','kennels.ken_id = members.mem_ken_id');
						$this->db->where('mem_id !=', 0);
						$this->db->order_by('mem_id', 'DESC');
						$rResult = $this->db->get($sTable);

						// Data set length after filtering
						$this->db->select('FOUND_ROWS() AS found_rows');
						$iFilteredTotal = $this->db->get()->row()->found_rows;

						// Total data set length
						$iTotal = $this->db->count_all($sTable);

						// Output
						$output = array(
								'sEcho' => intval($sEcho),
								'iTotalRecords' => $iTotal,
								'iTotalDisplayRecords' => $iFilteredTotal,
								'aaData' => array()
						);

						foreach($rResult->result_array() as $i => $aRow){
								$row = array();

								// foreach($aColumns as $col){
								// 		if($col == 'stock')
								//     $row[$col] = $aRow[$col];
								// }
								$output['aaData'][] = $aRow;
						}

						echo json_encode($output);
				}
		}

		public function update($id = null){
			$img = $this->input->post('srcDataCrop');
			if ($img){
				$title = self::_clean_text('member');
				$_POST['mem_photo'] = self::_upload_base64($img, $title, true, $id);
			}
			unset($_POST['srcDataCrop']);

			$imgPP = $this->input->post('srcDataCropPP');
			if ($imgPP){
				$titlePP = self::_clean_text('pp');
				$_POST['mem_pp'] = self::_upload_base64($imgPP, $titlePP, true, $id);
			}
			unset($_POST['srcDataCropPP']);

			$data = $this->input->post(null, true);
			$where['mem_id'] = $id;
			$user = $this->memberModel->get_members($where)->row_array();
			if ($user == null) {
				echo json_encode(array('data' => 'Data Tidak Ditemukan'));
				return false;
			}
			$whe['mem_id != '] = $id;
			$whe['mem_ktp'] = $this->input->post('mem_ktp');
			$member = $this->memberModel->get_members($whe)->result();
			if (count($member) > 1){
				echo json_encode(array('data' => 'No. KTP sudah ada'));
				return false;
			}
			if (isset($data['password']) && $data['password'] != ''){
				if ($data['newpass'] == $data['repass']){
					if (sha1($data['password']) == $user['mem_password']) {
						$data['mem_password'] = sha1($data['newpass']);
					}
					else {
						echo json_encode(array('data' => 'Password salah'));
						return false;
					}
				}
				else{
					echo json_encode(array('data' => 'Password baru harus sama dengan konfirmasi password'));
					return false;
				}
			}
			else{
				$data['mem_password'] = $user['mem_password'];
			}
			unset($data['password']);
			unset($data['newpass']);
			unset($data['repass']);
			$this->memberModel->update_members($data, $where);

			unset($data['mem_password']);
			echo json_encode(array('data' => '1'));
		}

		public function reset($id = null){
			$where['mem_id'] = $id;
			$user = $this->memberModel->get_members($where)->row_array();
			if ($user == null) {
				echo json_encode(array('data' => 'Data Tidak Ditemukan'));
				return false;
			}
			
			if ($this->input->post('newpass') == $this->input->post('repass')) {
				$data['mem_password'] = sha1($this->input->post('newpass'));
				$this->memberModel->update_members($data, $where);
				echo json_encode(array('data' => '1'));
				return true;
			} else {
				echo json_encode(array('data' => 'Password baru harus sama dengan konfirmasi password.'));
				return false;
			}
		}

		public function request(){
			$user = $this->session->userdata('user_data');
			$data['users'] = $user;
			$data['navigations'] = $this->navigations;
	  
			$this->twig->display('backend/requests_member', $data);
		}
	  
		public function request_data(){
			$aColumns = array('log_id', 'log_name', 'log_address', 'log_photo', 'log_kennel_photo', 'log_kennel_name', 'log_hp', 'log_email', 'log_kota', 'log_kode_pos', 'use_username', 'log_app_date', 'log_tanggal', 'stat_name', 'mem_photo', 'kennels.ken_photo', 'mem_name', 'mem_address', 'mem_kode_pos', 'mem_hp', 'mem_email', 'ken_name', 'mem_kota');
			$sTable = 'logs_member';
	  
			$iDisplayStart = $this->input->get_post('start', true);
			$iDisplayLength = $this->input->get_post('length', true);
			$sSearch = $this->input->post('search', true);
			$sEcho = $this->input->get_post('sEcho', true);
			$columns = $this->input->get_post('columns', true);
			$orders = $this->input->get_post('order', true);
	  
			// Paging
			if(isset($iDisplayStart) && $iDisplayLength != '-1'){
				$this->db->limit($this->db->escape_str($iDisplayLength), $this->db->escape_str($iDisplayStart));
			}
	  
			// Ordering
			if(isset($orders[0]['column'])){
				// for($i=0; $i<intval($columns); $i++){
					// $iSortCol = $this->input->get_post('iSortCol_'.$i, true);
					// $bSortable = $this->input->get_post('bSortable_'.intval($iSortCol), true);
					$bSortable = $columns[$orders[0]['column']]['orderable'];
					// $sSortDir = $this->input->get_post('sSortDir_'.$i, true);
	  
					if($bSortable == 'true')
					{
						$this->db->order_by($columns[$orders[0]['column']]['data'], $orders[0]['dir']);
						// $this->db->order_by($aColumns[intval($this->db->escape_str($iSortCol))], $this->db->escape_str($sSortDir));
					}
				// }
			}
	  
			/*
			  * Filtering
			  * NOTE this does not match the built-in DataTables filtering which does it
			  * word by word on any field. It's possible to do here, but concerned about efficiency
			  * on very large tables, and MySQL's regex functionality is very limited
			  */
			if(isset($sSearch['value']) && !empty($sSearch['value'])){
				// ARTechnology
				for($i=0; $i<count($columns); $i++){
				// ARTechnology
	  
					// $bSearchable = $this->input->get_post('bSearchable_'.$i, true);
					$bSearchable = $columns[$i]['searchable'];
	  
					// Individual column filtering
					if(isset($bSearchable) && $bSearchable == 'true')
					{
						for($j=0; $j<count($aColumns); $j++){
						  $this->db->or_like($aColumns[$j], $this->db->escape_like_str($sSearch['value']));
						}
					}
				}
			}
	  
			// Select Data
			$this->db->select('SQL_CALC_FOUND_ROWS '.str_replace(' , ', ' ', implode(', ', $aColumns)), false);
			$this->db->join('members','members.mem_id = logs_member.log_member_id');
			$this->db->join('kennels','kennels.ken_id = logs_member.log_kennel_id');
			$this->db->join('users','users.use_id = logs_member.log_app_user');
			$this->db->join('approval_status','approval_status.stat_id = logs_member.log_stat');
			$this->db->where('log_stat', 0);
			$this->db->order_by('log_tanggal', 'desc');
			$rResult = $this->db->get($sTable);
			
			// Data set length after filtering
			$this->db->select('FOUND_ROWS() AS found_rows');
			$iFilteredTotal = $this->db->get()->row()->found_rows;
	  
			// Total data set length
			$iTotal = $this->db->count_all($sTable);
	  
			// Output
			$output = array(
				'sEcho' => intval($sEcho),
				'iTotalRecords' => $iTotal,
				'iTotalDisplayRecords' => $iFilteredTotal,
				'aaData' => array()
			);
	  
			foreach($rResult->result_array() as $i => $aRow){
				$row = array();
	  
				// foreach($aColumns as $col){
				// 		if($col == 'stock')
				//     $row[$col] = $aRow[$col];
				// }
				$output['aaData'][] = $aRow;
			}
	  
			echo json_encode($output);
		}
	  
		public function approve_profile($id = null){
			if ($id){
				$whe['log_id'] = $id;
				$req = $this->LogmemberModel->get_logs($whe)->row();
		
				$where['mem_id'] = $req->log_member_id;
				$member = $this->memberModel->get_members($where)->row();
	  
				$whe_ken['ken_id'] = $req->log_kennel_id;
				$kennel = $this->KennelModel->get_kennels($whe_ken)->row();

				$data = array(
					'mem_name' => $req->log_name,
					'mem_address' => $req->log_address,
					'mem_mail_address' => $req->log_mail_address,
					'mem_hp' => $req->log_hp,
					'mem_kota' => $req->log_kota,
					'mem_kode_pos' => $req->log_kode_pos,
					'mem_email' => $req->log_email
				);

				$data_kennel = array(
					'ken_name' => $req->log_kennel_name,
					'ken_type_id' => $req->log_kennel_type_id
				);

				if ($req->log_photo != ''){
					$data['mem_photo'] = $req->log_photo;
					$curr_image = $this->path_upload.basename($member->mem_photo);
					if(file_exists($curr_image)){
					unlink($curr_image);
					}
				}

				if ($req->log_pp != ''){
					$data['mem_pp'] = $req->log_pp;
					$curr_image = $this->path_upload.basename($member->mem_pp);
					if(file_exists($curr_image)){
					unlink($curr_image);
					}
				}

				if ($req->log_kennel_photo != ''){
					$data_kennel['ken_photo'] = $req->log_kennel_photo;
					$curr_image = $this->path_upload.basename($kennel->ken_photo);
					if(file_exists($curr_image)){
					unlink($curr_image);
					}
				}
	  
				$this->db->trans_strict(FALSE);
				$this->db->trans_start();
				$this->memberModel->update_members($data, $where);
				$this->KennelModel->update_kennels($data_kennel, $whe_ken);
				$res2 = $this->LogmemberModel->update_status($id, 1);
				if ($res2){
					if ($member->mem_id){
					$res3 = $this->notification_model->add(9, $req->log_id, $member->mem_id);
	
					if ($member->mem_firebase_token){
						$notif = $this->notificationtype_model->get_by_id(9);
						$url = 'https://fcm.googleapis.com/fcm/send';
						$key = 'AAAALe2LeZU:APA91bEqr2n1PRxkOyOfx8IwYO1O_1gjprFkq1AITOGUu3GYp2ZBi-8-AvM4ADI3m94NEv4cq-uKcMBU3pJXBhO21CyuVgPNX2l7VYXj5IllxEr6sika8eaJp1IgXCHALA5_xYw92pXK';
			
						$fields = array (
						'to' => $member->mem_firebase_token,
						'notification' => array(
							"channelId" => "ICRPedigree",
							'title' => $notif[0]->title,
							'body' => $notif[0]->description
						)
						);
						$fields = json_encode ( $fields );
			
						$headers = array (
							'Authorization: key=' . $key,
							'Content-Type: application/json'
						);
			
						$ch = curl_init ();
						curl_setopt ( $ch, CURLOPT_URL, $url );
						curl_setopt ( $ch, CURLOPT_POST, true );
						curl_setopt ( $ch, CURLOPT_HTTPHEADER, $headers );
						curl_setopt ( $ch, CURLOPT_RETURNTRANSFER, true );
						curl_setopt ( $ch, CURLOPT_POSTFIELDS, $fields );
			
						$result = curl_exec ( $ch );
						// echo $result;
						curl_close ( $ch );
					}
					}
					$this->db->trans_complete();
					echo json_encode(array('data' => '1'));
				}
				else{
					$this->db->trans_rollback();
					echo json_encode(array('data' => 'Request dengan id = '.$id.' tidak dapat di-approve'));
				}
			}
		}
	  
		public function reject_profile($id = null){
			if ($id){
			  $this->db->trans_strict(FALSE);
			  $this->db->trans_start();
			  $res = $this->LogmemberModel->update_status($id, 2);
			  if ($res){
				$whe['log_id'] = $id;
				$req = $this->LogmemberModel->get_logs($whe)->row();
	  
				if ($req->log_member_id){
				  $result = $this->notification_model->add(10, $id, $req->log_member_id);
	  
				  $whe_can['mem_id'] = $req->log_member_id;
				  $member = $this->memberModel->get_members($whe_can)->row();
				  if ($member->mem_firebase_token){
					$notif = $this->notificationtype_model->get_by_id(10);
					$url = 'https://fcm.googleapis.com/fcm/send';
					$key = 'AAAALe2LeZU:APA91bEqr2n1PRxkOyOfx8IwYO1O_1gjprFkq1AITOGUu3GYp2ZBi-8-AvM4ADI3m94NEv4cq-uKcMBU3pJXBhO21CyuVgPNX2l7VYXj5IllxEr6sika8eaJp1IgXCHALA5_xYw92pXK';
		
					$fields = array (
					  'to' => $member->mem_firebase_token,
					  'notification' => array(
						"channelId" => "ICRPedigree",
						'title' => $notif[0]->title,
						'body' => $notif[0]->description
					  )
					);
					$fields = json_encode ( $fields );
		
					$headers = array (
						'Authorization: key=' . $key,
						'Content-Type: application/json'
					);
		
					$ch = curl_init ();
					curl_setopt ( $ch, CURLOPT_URL, $url );
					curl_setopt ( $ch, CURLOPT_POST, true );
					curl_setopt ( $ch, CURLOPT_HTTPHEADER, $headers );
					curl_setopt ( $ch, CURLOPT_RETURNTRANSFER, true );
					curl_setopt ( $ch, CURLOPT_POSTFIELDS, $fields );
		
					$result = curl_exec ( $ch );
					// echo $result;
					curl_close ( $ch );
				  }
				}
				$this->db->trans_complete();
				echo json_encode(array('data' => '1'));
			  }
			  else{
				$this->db->trans_rollback();
				echo json_encode(array('data' => 'Request dengan id = '.$id.' tidak dapat di-reject'));
			  }
			}
		}
	  
		public function logs_request(){
			$user = $this->session->userdata('user_data');
			$data['users'] = $user;
			$data['navigations'] = $this->navigations;
			
			$this->twig->display('backend/logsRequest_member', $data);
		}
	  
		public function data_logs_request(){
			$aColumns = array('log_id', 'log_name', 'log_address', 'log_photo', 'log_kennel_photo', 'log_kennel_name', 'log_hp', 'log_email', 'log_kota', 'log_kode_pos', 'use_username', 'log_app_date', 'log_tanggal', 'stat_name', 'mem_photo', 'kennels.ken_photo', 'mem_name', 'mem_address', 'mem_kode_pos', 'mem_hp', 'mem_email', 'ken_name', 'mem_kota');
			$sTable = 'logs_member';
	  
			$iDisplayStart = $this->input->get_post('start', true);
			$iDisplayLength = $this->input->get_post('length', true);
			$sSearch = $this->input->post('search', true);
			$sEcho = $this->input->get_post('sEcho', true);
			$columns = $this->input->get_post('columns', true);
			$orders = $this->input->get_post('order', true);
	  
			// Paging
			if(isset($iDisplayStart) && $iDisplayLength != '-1'){
				$this->db->limit($this->db->escape_str($iDisplayLength), $this->db->escape_str($iDisplayStart));
			}
	  
			// Ordering
			if(isset($orders[0]['column'])){
				// for($i=0; $i<intval($columns); $i++){
					// $iSortCol = $this->input->get_post('iSortCol_'.$i, true);
					// $bSortable = $this->input->get_post('bSortable_'.intval($iSortCol), true);
					$bSortable = $columns[$orders[0]['column']]['orderable'];
					// $sSortDir = $this->input->get_post('sSortDir_'.$i, true);
	  
					if($bSortable == 'true')
					{
						$this->db->order_by($columns[$orders[0]['column']]['data'], $orders[0]['dir']);
						// $this->db->order_by($aColumns[intval($this->db->escape_str($iSortCol))], $this->db->escape_str($sSortDir));
					}
				// }
			}
	  
			/*
			  * Filtering
			  * NOTE this does not match the built-in DataTables filtering which does it
			  * word by word on any field. It's possible to do here, but concerned about efficiency
			  * on very large tables, and MySQL's regex functionality is very limited
			  */
			if(isset($sSearch['value']) && !empty($sSearch['value'])){
				// ARTechnology
				for($i=0; $i<count($columns); $i++){
				// ARTechnology
	  
					// $bSearchable = $this->input->get_post('bSearchable_'.$i, true);
					$bSearchable = $columns[$i]['searchable'];
	  
					// Individual column filtering
					if(isset($bSearchable) && $bSearchable == 'true')
					{
						for($j=0; $j<count($aColumns); $j++){
						  $this->db->or_like($aColumns[$j], $this->db->escape_like_str($sSearch['value']));
						}
					}
				}
			}
	  
			// Select Data
			$this->db->select('SQL_CALC_FOUND_ROWS '.str_replace(' , ', ' ', implode(', ', $aColumns)), false);
			$this->db->join('members','members.mem_id = logs_member.log_member_id');
			$this->db->join('kennels','kennels.ken_id = logs_member.log_kennel_id');
			$this->db->join('users','users.use_id = logs_member.log_app_user');
			$this->db->join('approval_status','approval_status.stat_id = logs_member.log_stat');
			$this->db->where('log_stat <>', 0);
			$this->db->order_by('log_tanggal', 'desc');
			$rResult = $this->db->get($sTable);
			
			// Data set length after filtering
			$this->db->select('FOUND_ROWS() AS found_rows');
			$iFilteredTotal = $this->db->get()->row()->found_rows;
	  
			// Total data set length
			$iTotal = $this->db->count_all($sTable);
	  
			// Output
			$output = array(
				'sEcho' => intval($sEcho),
				'iTotalRecords' => $iTotal,
				'iTotalDisplayRecords' => $iFilteredTotal,
				'aaData' => array()
			);
	  
			foreach($rResult->result_array() as $i => $aRow){
				$row = array();
	  
				// foreach($aColumns as $col){
				// 		if($col == 'stock')
				//     $row[$col] = $aRow[$col];
				// }
				$output['aaData'][] = $aRow;
			}
	  
			echo json_encode($output);
		}

    //  PHP Helper

		private function _upload_base64($image = null, $name = null, $update = false, $id = null){
				$name_image = $name.'_'.time();
				$name_image = strtolower($name_image);
				$image = str_replace('data:image/png;base64,', '', $image);
				// $image = str_replace('data:image/png;base64,', '', $image);
				$image = str_replace(' ', '+', $image);
				$data = base64_decode($image);
				// $file = $this->path_upload.$name_image . '.jpg';
				$file = $this->path_upload.$name_image . '.png';
				$success = file_put_contents($file, $data);

				$url_image = $name_image.'.png';

				if ($update && $id != null){
					$where['mem_id'] = $id;
					$member = $this->memberModel->get_members($where)->row();
					if ($name == "member")
						$curr_image = $this->path_upload.basename($member->mem_photo);
					else
						$curr_image = $this->path_upload.basename($member->mem_pp);
					if (file_exists($curr_image)){
						unlink($curr_image);
					}
				}
				return $url_image;
		}

		private function _clean_text($name = null){
			return str_replace(array(' ', '-'), '_', $name);
		}

    public function gen_pass(){
      $rand = substr(uniqid('', true), -5);
      return $rand;
    }

    private function _is_logged_in(){
        $coordinator = $this->session->userdata('user_data');
        return isset($coordinator);
    }

	public function _same_user($username) {
		$user = $this->memberModel->daftar_users($username)->row_array();
		return isset($user);
	}
	
	public function activate(){
        $memberId = $this->input->post('memberId', true);
        $err = 0;
        foreach ($memberId as $id) {
            $res = $this->memberModel->set_active($id, 1);
            if (!$res){
              $err = $id;
              break;
            }
        }
        if (!$err){
          echo json_encode(array('data' => '1'));
        }
        else{
          echo json_encode(array('data' => 'Member dengan id = '.$err.' tidak dapat diaktivasi'));
        }
    }

    public function deactivate(){
      $memberId = $this->input->post('memberId', true);
      $err = 0;
      foreach ($memberId as $id) {
          $res = $this->memberModel->set_active($id, 0);
          if (!$res){
            $err = $id;
            break;
          }
      }
      if (!$err){
        echo json_encode(array('data' => '1'));
      }
      else{
        echo json_encode(array('data' => 'Member dengan id = '.$err.' tidak dapat dideaktivasi'));
      }
  	}
}
