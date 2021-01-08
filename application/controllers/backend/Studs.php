<?php // ARTechnology
defined('BASEPATH') OR exit('No direct script access allowed');

class Studs extends CI_Controller {
		private $navigations;
		public function __construct(){
			// Call the CI_Controller constructor
			parent::__construct();
			$this->load->library('bcrypt');
			$this->load->model(array('studModel', 'trahModel'));
			$this->load->model('caninesModel');
			$this->load->model('navigation');
			$this->navigations = $this->navigation->get_navigation();
			$this->path_upload = 'uploads/stud/';

			$session = self::_is_logged_in();
        	if(!$session) redirect('backend');
		}

		public function index(){
				$user = $this->session->userdata('user_data');
				$data['users'] = $user;
				$data['navigations'] = $this->navigations;
				$this->twig->display('backend/studs', $data);
		}

		public function approve($id = null){
			$this->studModel->approve($id);
			echo json_encode(array('data' => '1'));
		}

		public function reject($id = null){
			$this->studModel->reject($id);
			echo json_encode(array('data' => '1'));
		}

		public function data($id = null){
				if ($id != null) {
						$where['stu_id'] = $id;
						$stud = $this->studModel->get_studs($where)->row();
						echo json_encode($stud);
				}else{
						$aColumns = array('stu_id', 'stu_photo', 'stu_sire_photo', 'stu_mom_photo', 'stu_stud_date', 'stu_stat', 'mem_name');
						$sTable = 'studs';

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
						$this->db->join('members','members.mem_id = studs.stu_member');
						$this->db->where('stu_stat', 0);
						$this->db->order_by('stu_date', 'DESC');
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

		public function view(){
			$user = $this->session->userdata('user_data');
			$data['users'] = $user;
			$data['navigations'] = $this->navigations;
			$data['trahs'] = $this->trahModel->get_trah()->result();
			$this->twig->display('backend/logsStud', $data);
		}

		public function logs($id = null){
			if ($id != null) {
				$where['stu_id'] = $id;
				$stud = $this->studModel->get_studs($where)->row();
				echo json_encode($stud);
			}else{
				$aColumns = array('stu_id', 'stu_photo', 'stu_sire_photo', 'stu_mom_photo', 'stu_stud_date', 'use_username', 'stu_app_date', 'stu_sire_id', 'stu_mom_id', 'mem_name', 'stu_note', 'stat_name', 'stu_stat');
				$sTable = 'studs';

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
				$this->db->join('members','members.mem_id = studs.stu_member');
				$this->db->join('users','users.use_id = studs.stu_app_user');
				$this->db->join('approval_status','approval_status.stat_id = studs.stu_stat');
				$this->db->order_by('stu_date', 'DESC');
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

	public function add(){
		$img = $this->input->post('srcDataCrop');
		$title = self::_clean_text('stud');
		$_POST['stu_photo'] = self::_upload_base64($img, $title);
		
		$img = $this->input->post('srcDataCropSire');
		$title = self::_clean_text('sire');
		$_POST['stu_sire_photo'] = self::_upload_base64($img, $title);

		$img = $this->input->post('srcDataCropDam');
		$title = self::_clean_text('dam');
		$_POST['stu_mom_photo'] = self::_upload_base64($img, $title);

		unset($_POST['srcDataCrop']);
		unset($_POST['srcDataCropSire']);
		unset($_POST['srcDataCropDam']);

		$cek = true;
		$piece = explode("-", $this->input->post('stu_stud_date'));
		$date = $piece[2]."-".$piece[1]."-".$piece[0];

		$ts = new DateTime($date);
		$ts_now = new DateTime();
		
		if ($ts > $ts_now)
			$cek = false;
		else{
			$diff = floor($ts->diff($ts_now)->days/7);
			if ($diff > 2)
				$cek = false;
		}

		if ($cek){
			$data = $this->input->post(null,false);
			$user = $this->session->userdata('user_data');
			$data['stu_stud_date'] = $date;
			$data['stu_app_user'] = $user['use_id'];
			$data['stu_app_date'] = date('Y-m-d H:i:s');
			$data['stu_stat'] = 1;

			$stud = $this->studModel->add_studs($data);

			echo json_encode(array('data' => '1'));
		}
		else{
			echo json_encode(array('data' => 'Pelaporan pacak harus kurang dari 2 minggu'));
		}
	}

	public function update($id = null){
		$img = $this->input->post('srcDataCrop');
		if($img){
			$title = self::_clean_text('stud');
			$_POST['stu_photo'] = self::_upload_base64($img, $title, true, $id);
		}
		
		$img = $this->input->post('srcDataCropSire');
		if($img){
			$title = self::_clean_text('sire');
			$_POST['stu_sire_photo'] = self::_upload_base64($img, $title, true, $id);
		}

		$img = $this->input->post('srcDataCropDam');
		if($img){
			$title = self::_clean_text('dam');
			$_POST['stu_mom_photo'] = self::_upload_base64($img, $title, true, $id);
		}

		unset($_POST['srcDataCrop']);
		unset($_POST['srcDataCropSire']);
		unset($_POST['srcDataCropDam']);

		$cek = true;
		$piece = explode("-", $this->input->post('stu_stud_date'));
		$date = $piece[2]."-".$piece[1]."-".$piece[0];

		$ts = new DateTime($date);
		$ts_now = new DateTime();
		
		if ($ts > $ts_now)
			$cek = false;
		else{
			$diff = floor($ts->diff($ts_now)->days/7);
			if ($diff > 2)
				$cek = false;
		}

		if ($cek){
			$data = $this->input->post(null,false);
			$data['stu_stud_date'] = $date;
			
			$where['stu_id'] = $id;

			$this->studModel->update_studs($data, $where);

			echo json_encode(array('data' => '1'));
		}
		else{
			echo json_encode(array('data' => 'Pelaporan pacak harus kurang dari 2 minggu'));
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
			$where['stu_id'] = $id;
			$studs = $this->studModel->get_studs($where)->row();
			$curr_image = $this->path_upload.basename($studs->stu_photo);
			if(file_exists($curr_image)){
				unlink($curr_image);
			}
			$curr_image = $this->path_upload.basename($studs->stu_sire_photo);
			if(file_exists($curr_image)){
				unlink($curr_image);
			}
			$curr_image = $this->path_upload.basename($studs->stu_mom_photo);
			if(file_exists($curr_image)){
				unlink($curr_image);
			}
		}
		return $url_image;
	}

    private function _is_logged_in(){
        $coordinator = $this->session->userdata('user_data');
        return isset($coordinator);
	}
	
	private function _clean_text($name = null){
		return str_replace(array(' ', '-'), '_', $name);
	}
}
