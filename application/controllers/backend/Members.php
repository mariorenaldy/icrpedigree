<?php // ARTechnology
defined('BASEPATH') OR exit('No direct script access allowed');

class Members extends CI_Controller {
		private $navigations;
		public function __construct(){
			// Call the CI_Controller constructor
			parent::__construct();
			$this->load->library('bcrypt');
			$this->load->model(array('memberModel', 'KennelModel'));
			$this->load->model('navigation');
			$this->navigations = $this->navigation->get_navigation();
			$this->path_upload = 'uploads/members/';

			$session = self::_is_logged_in();
        	if(!$session) redirect('backend');
		}
		public function index(){
			$user = $this->session->userdata('user_data');
			$data['users'] = $user;
			$data['navigations'] = $this->navigations;
			$data['kennels'] = $this->KennelModel->daftar_kennels();
			$this->twig->display('backend/members', $data);
		}

		public function add(){

			$img = $this->input->post('srcDataCrop');
			$title = self::_clean_text('member');

			$_POST['mem_photo'] = '-';
			if($img) $_POST['mem_photo'] = self::_upload_base64($img, $title);
			unset($_POST['srcDataCrop']);

			$data = $this->input->post(null, true);
			$username = $data['mem_username'];
			$user = self::_same_user($username);

			if ($user) {
				echo json_encode(array('data' => 'Username Sudah Ada!'));
				return false;
			}
			if ($data['password'] == $data['repass']) {

				$data['mem_password'] = $this->bcrypt->hash_password($data['password']);
				unset($data['password']);
				unset($data['repass']);

				$id = $this->memberModel->add_members($data);
				if (!$id) {
					echo json_encode(array('data' => 'Gagal Memproses Akun Anda, Coba Lagi.'));
					return false;
				}

				unset($data['mem_password']);

				echo json_encode(array('data' => '1'));

			}else{
				echo json_encode(array('data' => 'Konfirmasi kata sandi gagal.'));
			}
		}

		public function data($id = null){
				if ($id != null) {
						$where['mem_id'] = $id;
						$member = $this->memberModel->get_members($where)->row();
						echo json_encode($member);
				}else{
						$aColumns = array('mem_id', 'mem_name', 'mem_address', 'mem_mail_address', 'mem_hp', 'mem_photo', 'mem_created_at', 'mem_updated_at', 'mem_stat', 'mem_app_user', 'mem_app_date', 'use_username', 'ken_name', 'mem_ken_id');
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
			$data = $this->input->post(null, true);
			$where['mem_id'] = $id;
			$user = $this->memberModel->get_members($where)->row_array();
			if ($user== null) {
				echo json_encode(array('data' => 'Data Tidak Ditemukan'));
				return false;
			}
			
			if (isset($data['password']) && $data['password'] != ''){
				if ($data['newpass'] == $data['repass']){
					if ($data['newpass'] == $data['password']) {
						echo json_encode(array('data' => 'Password lama tidak boleh sama dengan password baru'));
						return false;
					}
					else{
						if ($this->bcrypt->check_password($data['password'], $user['mem_password']) == true) {
							$data['mem_password'] = $this->bcrypt->hash_password($data['newpass']);
						}
						else {
							echo json_encode(array('data' => 'Password tidak benar'));
							return false;
						}
					}
				}
				else{
					echo json_encode(array('data' => 'Password baru tidak sama dengan konfirmasi password'));
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
				if ($this->bcrypt->check_password($this->input->post('password'), $user['mem_password']) == true) {
					$data['mem_password'] = $this->bcrypt->hash_password($this->input->post('newpass'));
					$this->memberModel->update_members($data, $where);
					echo json_encode(array('data' => '1'));
				}
				else{
					echo json_encode(array('data' => 'Password Awal Salah'));
					return false;
				}
			} else {
				echo json_encode(array('data' => 'Konfirmasi kata sandi gagal.'));
				return false;
			}
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

				if($update && $id != null){
						$where['mem_id'] = $id;
						$member = $this->memberModel->get_members($where)->row();
						$curr_image = $this->path_upload.basename($member->mem_photo);
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

  	public function approve($id = null){
		if ($id){
			$res = $this->memberModel->approve($id);
			if ($res){
				echo json_encode(array('data' => '1'));
			}
			else{
				echo json_encode(array('data' => 'Member dengan id = '.$id.' tidak dapat di-approve'));
			}
		}
	}
}
