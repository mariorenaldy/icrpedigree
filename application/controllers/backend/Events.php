<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Events extends CI_Controller {
		private $navigations;
		public function __construct(){
				// Call the CI_Controller constructor
				parent::__construct();
				$this->load->model(array('eventModel', 'notification_model', 'memberModel'));
				$this->load->model('championsModel');
				$this->load->model('settingModel');
				$this->load->model('caninesModel');
			  $this->load->model('eventGaleryModel');
				$this->load->model('navigation');
				$this->navigations = $this->navigation->get_navigation();
				$this->path_upload = 'uploads/events/';
				$session = self::_is_logged_in();
        if(!$session) redirect('backend');
		}
		public function index(){

				$user = $this->session->userdata('user_data');
				$data['users'] = $user;
				$data['navigations'] = $this->navigations;
				$this->twig->display('backend/event', $data);

		}

		public function albums($id){
				$user = $this->session->userdata('user_data');
				$data['users'] = $user;
				$data['navigations'] = $this->navigations;
				$whereGal['gal_event_id'] = $id;
				$galery = $this->eventGaleryModel->get_event_galleries($whereGal)->result();
				$data['galeries'] = $galery;
				$data['id']=$id;

				// print_r($data);
				$this->twig->display('backend/event_galery', $data);
		}

		public function champions($id){
				$user = $this->session->userdata('user_data');
				$data['users'] = $user;
				$data['navigations'] = $this->navigations;
				$whereChamp['ech_event_id'] = $id;
				$champions = $this->championsModel->get_champions($whereChamp)->row();
				$data['champions'] = $champions;
				$data['id']=$id;

				if ($champions != null) {
					$whereCan1['can_id'] = $champions->{'ech_champion_id_1'};
					$canines1 = $this->caninesModel->get_canines($whereCan1)->row();
					$data['canine1'] = $canines1;

					$whereCan2['can_id'] = $champions->{'ech_champion_id_2'};
					$canines2 = $this->caninesModel->get_canines($whereCan2)->row();
					$data['canine2'] = $canines2;

					$whereCan3['can_id'] = $champions->{'ech_champion_id_3'};
					$canines3 = $this->caninesModel->get_canines($whereCan3)->row();
					$data['canine3'] = $canines3;
				}

				// print_r($data);
				$this->twig->display('backend/event_champions', $data);
		}

		public function removeAlbums($id){
			$whereGal['gal_id'] = $id;
			$galery = $this->eventGaleryModel->remove_event_galleries($whereGal);
			echo json_encode(array('data' => '1'));

		}

		public function add(){
				$img = $this->input->post('srcDataCrop');
				$title = self::_clean_text('events');

				$_POST['evn_photo'] = '';
				if($img) $_POST['evn_photo'] = self::_upload_base64($img, $title);
				unset($_POST['srcDataCrop']);

				$data = $this->input->post(null, true);
				$this->db->trans_strict(FALSE);
				$this->db->trans_start();
				$res = $this->eventModel->add_events($data);
				if ($res){
					$member = $this->memberModel->daftar_users()->result();
					foreach ($member AS $row){
						$result = $this->notification_model->add(5, $res, $row->mem_id);
					}
					$this->db->trans_complete();
					echo json_encode(array('data' => '1'));
				}
				else{
					$this->db->trans_rollback();
					echo json_encode(array('data' => 'Data event gagal disimpan'));
				}

		}

		public function championsAdd($id = null){

					unset($_POST['champ1']);
					unset($_POST['champ2']);
					unset($_POST['champ3']);

					$_POST['ech_event_id'] = $id;
					$data = $this->input->post(null, true);
					$this->championsModel->add_champions($data);

					$whereSet['set_id'] = 1;
					$setting = $this->settingModel->get_settings($whereSet)->row();


					$whereCan1['can_id'] = $_POST['ech_champion_id_1'];
					$canines1 = $this->caninesModel->get_canines($whereCan1)->row();
					$can_score1 = $canines1->{'can_score'} + $setting->{'set_first_champion_score'};
					$dataCan1 = array('can_score' => $can_score1 );
					$this->caninesModel->update_canines($dataCan1, $whereCan1);

					$whereCan2['can_id'] = $_POST['ech_champion_id_2'];
					$canines2 = $this->caninesModel->get_canines($whereCan2)->row();
					$can_score2 = $canines2->{'can_score'} + $setting->{'set_second_champion_score'};
					$dataCan2 = array('can_score' => $can_score2, );
					$this->caninesModel->update_canines($dataCan2, $whereCan2);
					//

					$whereCan3['can_id'] = $_POST['ech_champion_id_3'];
					$canines3 = $this->caninesModel->get_canines($whereCan3)->row();
					$can_score3 = $canines3->{'can_score'} + $setting->{'set_third_champion_score'};
					$dataCan3 = array('can_score' => 	$can_score3, );
					$this->caninesModel->update_canines($dataCan3, $whereCan3);

					// self::_is_write_log('add', $data, 'aris');
					echo json_encode(array('data' => '1'));

		}

		public function albumsadd($id=null){

					$img = $this->input->post('srcDataCrop');
					$title = self::_clean_text('events_albums');

					$_POST['gal_photo'] = '';
					if($img) $_POST['gal_photo'] = self::_upload_base64($img, $title);
					unset($_POST['srcDataCrop']);

					$_POST['gal_event_id'] = $id;
					$data = $this->input->post(null, true);
					$this->eventGaleryModel->add_event_galleries($data);

					// self::_is_write_log('add', $data, 'aris');
					echo json_encode(array('data' => '1'));

		}

		public function albumsPhoto($id = null){
			$where['gal_id'] = $id;
			$galery = $this->eventGaleryModel->get_event_galleries($where)->row();
						echo json_encode($galery);
		}

		public function data($id = null){
				if ($id != null) {
						$where['evn_id'] = $id;
						$event = $this->eventModel->get_events($where)->row();
						echo json_encode($event);
				}else{
						$aColumns = array('evn_id', 'evn_title', 'evn_place', 'evn_date', 'evn_desc', 'evn_photo', 'evn_created_at', 'evn_updated_at');
						$sTable = 'events';

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
						$this->db->order_by('evn_id', 'DESC');
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
						$title = self::_clean_text('events');
						$_POST['evn_photo'] = self::_upload_base64($img, $title, true, $id);
				}
				unset($_POST['srcDataCrop']);
				$data = $this->input->post(null, true);
				$where['evn_id'] = $id;
				$this->eventModel->update_events($data, $where);
				// $data['evn_id'] = $id;
				// self::_is_write_log('update', $data, 'aris');
				echo json_encode(array('data' => '1'));
		}

		public function updateAlbums($id = null){
				$img = $this->input->post('srcDataCrop');
				if($img){
						$title = self::_clean_text('events_albums');
						$_POST['gal_photo'] = self::_upload_base64($img, $title, true, $id);
				}
				unset($_POST['srcDataCrop']);
				$data = $this->input->post(null, true);
				$where['gal_id'] = $id;
				$this->eventGaleryModel->update_event_galleries($data, $where);
				// $data['evn_id'] = $id;
				// self::_is_write_log('update', $data, 'aris');
				echo json_encode(array('data' => '1'));
		}

		public function remove(){
				$event_id = $this->input->post('eventId', true);
				foreach ($event_id as $id) {
						$where['evn_id'] = $id;
						$event = $this->eventModel->get_events($where)->row();
						$curr_image = $this->path_upload.basename($event->evn_photo);
						if(file_exists($curr_image)){
								unlink($curr_image);
						}
						$where['evn_id'] = $id;
						$this->eventModel->remove_events($where);
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
						$where['evn_id'] = $id;
						$event = $this->eventModel->get_events($where)->row();
						$curr_image = $this->path_upload.basename($event->evn_photo);
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
