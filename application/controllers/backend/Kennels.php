<?php // ARTechnology
defined('BASEPATH') OR exit('No direct script access allowed');

class Kennels extends CI_Controller {
		private $navigations;
		public function __construct(){
			// Call the CI_Controller constructor
			parent::__construct();
			$this->load->library('bcrypt');
			$this->load->model(array('KennelModel', 'KenneltypeModel'));
			$this->load->model('navigation');
			$this->navigations = $this->navigation->get_navigation();
			$this->path_upload = 'uploads/kennels/';
			
			$session = self::_is_logged_in();
        	if(!$session) redirect('backend');
		}

		public function index(){
			$user = $this->session->userdata('user_data');
			$data['users'] = $user;
			$data['navigations'] = $this->navigations;
			$data['ken_types'] = $this->KenneltypeModel->get_kennel_types()->result();
			$this->twig->display('backend/kennels', $data);
		}

		public function add(){
			$img = $this->input->post('srcDataCrop');
			$title = self::_clean_text('kennel');
			$_POST['ken_photo'] = '-';
			if ($img) 
				$_POST['ken_photo'] = self::_upload_base64($img, $title);
			unset($_POST['srcDataCrop']);
 
			$data = $this->input->post(null, true);
			$data['ken_id'] = $this->KennelModel->record_count() + 1;
			$id = $this->KennelModel->add_kennels($data);
			if (!$id) {
				echo json_encode(array('data' => 'Gagal Memproses Kennel Anda, Coba Lagi.'));
				return false;
			}
			echo json_encode(array('data' => '1'));
		}

		public function data($id = null){
			if ($id != null) {
					$where['ken_id'] = $id;
					$kennel = $this->KennelModel->get_kennels($where)->row();
					echo json_encode($kennel);
			} else {
					$aColumns = array('ken_id', 'ken_photo', 'ken_name', 'kennels.ken_type_id', 'ken_stat', 'ken_type_name');
					$sTable = 'kennels';

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
					if (isset($sSearch['value']) && !empty($sSearch['value'])){
						for($i=0; $i<count($columns); $i++){
							// $bSearchable = $this->input->get_post('bSearchable_'.$i, true);
							$bSearchable = $columns[$i]['searchable'];

							// Individual column filtering
							if (isset($bSearchable) && $bSearchable == 'true'){
								for ($j=0; $j<count($aColumns); $j++){
									$this->db->or_like($aColumns[$j], $this->db->escape_like_str($sSearch['value']));
								}
							}
						}
					}


					// Select Data
					$this->db->select('SQL_CALC_FOUND_ROWS '.str_replace(' , ', ' ', implode(', ', $aColumns)), false);
					$this->db->join('kennels_type', 'kennels_type.ken_type_id = kennels.ken_type_id');
					$this->db->where('ken_id !=', 0);
					$this->db->order_by('ken_id', 'DESC');
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
				$title = self::_clean_text('kennel');
				$_POST['ken_photo'] = self::_upload_base64($img, $title, true, $id);
			}
			unset($_POST['srcDataCrop']);

			$data = $this->input->post(null, true);
			$where['ken_id'] = $id;
			$kennel = $this->KennelModel->get_kennels($where)->row_array();
			if ($kennel == null) {
				echo json_encode(array('data' => 'Data Tidak Ditemukan'));
				return false;
			}
			$this->KennelModel->update_kennels($data, $where);
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

		$url_image = $name_image.'.png';

		if($update && $id != null){
				$where['ken_id'] = $id;
				$kennel = $this->KennelModel->get_kennels($where)->row();
				$curr_image = $this->path_upload.basename($kennel->ken_photo);
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

	public function activate(){
        $kennelId = $this->input->post('kennelId', true);
        $err = 0;
        foreach ($kennelId as $id) {
            $res = $this->KennelModel->set_active($id, 1);
            if (!$res){
              $err = $id;
              break;
            }
        }
        if (!$err){
			echo json_encode(array('data' => '1'));
        }
        else{
			echo json_encode(array('data' => 'Kennel dengan id = '.$err.' tidak dapat diaktivasi'));
        }
    }

    public function deactivate(){
		$kennelId = $this->input->post('kennelId', true);
		$err = 0;
		foreach ($kennelId as $id) {
			$res = $this->KennelModel->set_active($id, 0);
			if (!$res){
			$err = $id;
			break;
			}
		}
		if (!$err){
			echo json_encode(array('data' => '1'));
		}
		else{
			echo json_encode(array('data' => 'Kennel dengan id = '.$err.' tidak dapat dideaktivasi'));
		}
	}

	public function kennel(){
		if (isset($_GET['q'])) {
			$q = $_GET['q'];
			$kennel = $this->KennelModel->kennel_search($q)->result();
		} else {
			$kennel = $this->KennelModel->kennel_search()->result();
		}
		echo json_encode($kennel);
	}
}
