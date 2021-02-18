<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Users extends CI_Controller {
		private $navigations;
		public function __construct(){
				// Call the CI_Controller constructor
				parent::__construct();
				$this->load->library('bcrypt');

				$this->load->model('userModel');
				$this->load->model('navigation');
				$this->navigations = $this->navigation->get_navigation();

				$this->path_upload = 'uploads/users/';

				$session = self::_is_logged_in();
        if(!$session) redirect('backend');
		}
		public function index(){
			// $session = self::_is_logged_in();
			// if(!$session) {
			// 		redirect('backend');
			// }else {
				$data['navigations'] = $this->navigations;
				$user = $this->session->userdata('user_data');
				$data['users'] = $user;
				if ($user['use_akses'] == 1) {
					$this->twig->display('backend/users', $data);
				}else{
					redirect('backend/dashboard');
				}

			// }
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

		public function auth(){
        $data = $this->input->post(null, true);
        $where['users.use_username'] = $data['username'];
        $admin = $this->userModel->get_users($where)->row_array();

        if (!$admin){
          echo json_encode(array('data' => 'Maaf nama pengguna tidak terdaftar.'));
          return false;
        }

        if (!$this->bcrypt->check_password($data['password'], $admin['use_password'])){
          echo json_encode(array('data' => 'Maaf kata sandi anda salah.'));
          return false;
        }

        unset($admin['use_password']);
        $data['password'] = $this->bcrypt->hash_password($data['password']);

        $this->session->set_userdata('user_data', $admin);
        // self::_is_write_log('login', $data, $admin['emp_email']);

        $user = $this->session->userdata('user_data');
        // $whereId['emp_id'] = $user['emp_id'];

      	echo json_encode(array('data' => '1'));

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

				$url_image = $file;

				if($update && $id != null){
						$where['use_id'] = $id;
						$user = $this->userModel->get_users($where)->row();
						$curr_image = $this->path_upload.basename($user->use_photo);
						if(file_exists($curr_image)){
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

		public function _is_user($where) {
				$user = $this->userModel->get_users($where)->row_array();
				return isset($user);
		}

		public function _same_user($username) {
				$user = $this->userModel->daftar_users($username)->row_array();
				return isset($user);
		}

		public function logout(){
				// $this->session->sess_destroy();
				$this->session->unset_userdata('user_data');
				redirect('/backend');
		}

    private function _is_logged_in(){
        $coordinator = $this->session->userdata('user_data');
        return isset($coordinator);
    }

    private function _is_write_log($action, $description, $user){
        $data['log_action'] = $action;
        $data['log_description'] = json_encode($description);
        $data['log_user'] = $user;
        if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
            $ip = $_SERVER['HTTP_CLIENT_IP'];
        } elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
            $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
        } else {
            $ip = $_SERVER['REMOTE_ADDR'];
        }
        $data['log_ip'] = $ip;
        $data['log_browser'] = $_SERVER['HTTP_USER_AGENT'];

        $this->load->model('logModel');
        $this->logModel->add_log($data);
    }
}
