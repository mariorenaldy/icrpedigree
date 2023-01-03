<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Users extends CI_Controller {
		public function __construct(){
			// Call the CI_Controller constructor
			parent::__construct();
			$this->load->model('userModel');
			$this->load->library(array('session', 'form_validation'));
			$this->load->helper(array('form', 'url'));
			$this->load->database();
		}

		public function index(){
			$data['user'] = $this->userModel->get_users()->result();
			$this->load->view('backend/view_users', $data);
		}

		public function login(){
			$this->load->view('backend/login_form');
		}

		public function validate_login(){
			$where['users.use_username'] = $this->input->post('username');
			$user = $this->userModel->get_users($where)->row();
	
			$err = 0;
			if (!$user){
				$err++;
				$this->session->set_flashdata('login_error', 'Maaf nama pengguna tidak terdaftar');
			}
	
			if (!$err && sha1($this->input->post('password')) != $user->use_password){
				$err++;
				$this->session->set_flashdata('login_error', 'Maaf kata sandi anda salah');
			}
	
			if (!$err){
				$this->session->set_userdata('use_username', $this->input->post('username'));
				$this->session->set_userdata('use_id', $user->use_id);
				// $this->session->set_userdata('use_akses', $user->use_akses);
				redirect("backend/Dashboard");
			}
			else{
				$this->load->view("backend/login_form");
			}
		}

		public function add() {

			$img = $this->input->post('srcDataCrop');
			$title = self::_clean_text('users');

			$_POST['use_photo'] = '';
			if($img) $_POST['use_photo'] = self::_upload_base64($img, $title);
			unset($_POST['srcDataCrop']);

      $data = $this->input->post(null, true);
      $username = $data['use_username'];
      $user = self::_same_user($username);

      if ($user) {
          echo json_encode(array('data' => 'Username Sudah Ada!'));
          return false;
      }
			if ($data['password'] == $data['repass']) {

					$data['use_password'] = $this->bcrypt->hash_password($data['password']);
					unset($data['password']);
					unset($data['repass']);

					$id = $this->userModel->add_users($data);
					if (!$id) {
							echo json_encode(array('data' => 'Gagal Memuseses Akun Anda, Coba Lagi.'));
							return false;
					}

					unset($data['use_password']);
	        echo json_encode(array('data' => '1'));

			}else{
					echo json_encode(array('data' => 'Konfirmasi kata sandi gagal.'));
			}
    }

		public function data($id = null){
				if ($id != null) {
						$where['use_id'] = $id;
						$user = $this->userModel->get_users($where)->row();
						echo json_encode($user);
				}else{
						$aColumns = array('use_id', 'use_name', 'use_akses', 'use_photo', 'use_created_at', 'use_updated_at');
						$sTable = 'users';

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
						// ARTechnology
						$this->db->where('use_id !=', 0);
						// ARTechnology
						$this->db->order_by('use_id', 'DESC');
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

		function update($id){
			// $users = $this->session->userdata('user_data');
			$img = $this->input->post('srcDataCrop');
			if($img){
					$title = self::_clean_text('users');
					$_POST['use_photo'] = self::_upload_base64($img, $title, true, $id);
			}
			unset($_POST['srcDataCrop']);

			$data = $this->input->post(null, true);
			// $where['username'] = $users['username'];
			$where['use_id'] = $id;
			$user = $this->userModel->get_users($where)->row_array();
			if ($user == null) {
				echo json_encode(array('data' => 'Data Tidak Ditemukan'));
				return false;
			}

			// ARTechnology
			if ($data['newpass'] == $data['repass']){
				if ($this->bcrypt->check_password($data['password'], $user['use_password']) == true) {
					if ($data['newpass'] == $data['password']) {
						echo json_encode(array('data' => 'Password lama tidak boleh sama dengan password baru'));
						return false;
					}

					$data['use_password'] = $this->bcrypt->hash_password($data['newpass']);
					unset($data['password']);
					unset($data['newpass']);
					unset($data['repass']);
					$this->userModel->update_users($data, $where);

					unset($data['use_password']);
					echo json_encode(array('data' => '1'));
				}
				else{
					echo json_encode(array('data' => 'Konfirmasi kata sandi gagal.'));
					return false;
				}
			} else {
				echo json_encode(array('data' => 'Password tidak benar'));
				return false;
			}
			// ARTechnology
		}



		public function remove(){
				$user_id = $this->input->post('userId', true);
				foreach ($user_id as $id) {
						$where['use_id'] = $id;
						$user = $this->userModel->get_users($where)->row();
						$curr_image = $this->path_upload.basename($user->use_photo);
						if(file_exists($curr_image)){
								unlink($curr_image);
						}
						$where['use_id'] = $id;
						$this->userModel->remove_users($where);
				}
				echo json_encode(array('data' => '1'));
		}

		public function logout(){
			// $this->session->sess_destroy();
			$this->session->unset_userdata('use_username');
			$this->session->unset_userdata('use_akses');
			redirect('/backend');
		}

		public function search(){
			$like['use_name'] = $this->input->post('keywords');
			$data['user'] = $this->userModel->search_users($like)->result();
			$this->load->view('backend/view_users', $data);
		}
}
