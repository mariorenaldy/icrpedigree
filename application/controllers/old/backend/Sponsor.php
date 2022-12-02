<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Sponsor extends CI_Controller {
		private $navigations;
		public function __construct(){
				// Call the CI_Controller constructor
				parent::__construct();
				$this->load->model('sponsorModel');
				$this->load->model('navigation');
				$this->navigations = $this->navigation->get_navigation();
				$this->path_upload = 'uploads/sponsor/';

				$session = self::_is_logged_in();
        if(!$session) redirect('backend');
		}
		public function index(){

				$data['navigations'] = $this->navigations;
				$user = $this->session->userdata('user_data');
				$data['users'] = $user;
				if ($user['use_akses'] != 3) {
					$this->twig->display('backend/sponsor', $data);
				}else {
					redirect('backend/dashboard');
				}


		}

		public function primary(){

				$data['navigations'] = $this->navigations;
				$user = $this->session->userdata('user_data');
				$data['users'] = $user;
				$this->twig->display('backend/sponsor_primary', $data);

		}

		public function add(){

					$img = $this->input->post('srcDataCrop');
					$title = self::_clean_text('sponsor');

					$_POST['spo_logo'] = '';
					if($img) $_POST['spo_logo'] = self::_upload_base64($img, $title);
					unset($_POST['srcDataCrop']);

					$_POST['spo_type'] = 2;
					$data = $this->input->post(null, true);
					$this->sponsorModel->add_sponsors($data);

					// self::_is_write_log('add', $data, 'aris');
					echo json_encode(array('data' => '1'));

		}

		public function addprimary(){

					$img = $this->input->post('srcDataCrop');
					$title = self::_clean_text('sponsor_primary');

					$_POST['spo_logo'] = '';
					if($img) $_POST['spo_logo'] = self::_upload_base64($img, $title);
					unset($_POST['srcDataCrop']);

					$_POST['spo_type'] = 1;
					$data = $this->input->post(null, true);
					$this->sponsorModel->add_sponsors($data);

					// self::_is_write_log('add', $data, 'aris');
					echo json_encode(array('data' => '1'));

		}

		public function data($id = null){
				if ($id != null) {
						$where['spo_id'] = $id;
						$sponsor = $this->sponsorModel->get_sponsors($where)->row();
						echo json_encode($sponsor);
				}else{
						$aColumns = array('spo_id', 'spo_name', 'spo_desc','spo_website', 'spo_logo', 'spo_created_at', 'spo_updated_at');
						$sTable = 'sponsors';

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
						$this->db->where('spo_type',2);
						$this->db->order_by('spo_id', 'DESC');
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

		public function data_primary($id = null){
				if ($id != null) {
						$where['spo_id'] = $id;
						$sponsor = $this->sponsorModel->get_sponsors($where)->row();
						echo json_encode($sponsor);
				}else{
						$aColumns = array('spo_id', 'spo_name', 'spo_desc','spo_website', 'spo_logo', 'spo_created_at', 'spo_updated_at');
						$sTable = 'sponsors';

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
						$this->db->where('spo_type',1);
						$this->db->order_by('spo_id', 'DESC');
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
				if($img){
						$title = self::_clean_text('sponsor');
						$_POST['spo_logo'] = self::_upload_base64($img, $title, true, $id);
				}
				unset($_POST['srcDataCrop']);
				$data = $this->input->post(null, true);
				$where['spo_id'] = $id;
				$this->sponsorModel->update_sponsors($data, $where);
				// $data['spo_id'] = $id;
				// self::_is_write_log('update', $data, 'aris');
				echo json_encode(array('data' => '1'));
		}

		public function remove(){
				$sponsor_id = $this->input->post('sponsorId', true);
				foreach ($sponsor_id as $id) {
						$where['spo_id'] = $id;
						$sponsor = $this->sponsorModel->get_sponsors($where)->row();
						$curr_image = $this->path_upload.basename($sponsor->spo_logo);
						if(file_exists($curr_image)){
								unlink($curr_image);
						}
						$where['spo_id'] = $id;
						$this->sponsorModel->remove_sponsors($where);
				}
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
						$where['spo_id'] = $id;
						$sponsor = $this->sponsorModel->get_sponsors($where)->row();
						$curr_image = $this->path_upload.basename($sponsor->spo_logo);
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
}
