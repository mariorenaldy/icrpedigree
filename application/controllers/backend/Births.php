<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Births extends CI_Controller {
		public function __construct(){
			// Call the CI_Controller constructor
			parent::__construct();
			$this->load->model(array('studModel', 'birthModel', 'caninesModel', 'memberModel', 'trahModel', 'pedigreesModel', 'notification_model', 'notificationtype_model'));
			$this->load->library('upload', $this->config->item('upload_birth'));
			$this->load->library(array('session', 'form_validation'));
			$this->load->helper(array('url'));
			$this->load->database();
			date_default_timezone_set("Asia/Bangkok");
		}

		public function index(){
			$user = $this->session->userdata('user_data');
			$data['users'] = $user;
			$data['navigations'] = $this->navigations;
			$this->twig->display('backend/births', $data);
		}

		public function view_approve(){
			$where['bir_stat'] = 0;
			$data['birth'] = $this->birthModel->get_births($where)->result();
			$this->load->view('backend/approve_births', $data);
		}

		public function view_add(){
			$this->load->view('backend/add_birth');
		}

		public function search_approve(){
			$like['bir_a_s'] = $this->input->post('keywords');
			$where['bir_stat'] = 0;
			$data['birth'] = $this->birthModel->search_births($like, $where)->result();
			$this->load->view('backend/approve_births', $data);
		}

		public function approve(){
			if ($this->uri->segment(4)){
				$err = 0;
				$where['bir_id'] = $this->uri->segment(4);
				$birth = $this->birthModel->get_births($where)->row();
				$this->db->trans_strict(FALSE);
				$this->db->trans_start();
				$data['bir_app_user'] = $this->session->userdata('use_id');
				$data['bir_app_date'] = date('Y-m-d H:i:s');
				$data['bir_stat'] = 1;
				$res = $this->birthModel->update_births($data, $where);
				if ($res){
					$dataCanine = array(
						'can_member_id' => $birth->bir_member_id,
						'can_a_s' => $birth->bir_a_s,
						'can_breed' => $birth->bir_breed,
						'can_gender' => $birth->bir_gender,
						'can_date_of_birth' => $birth->bir_date_of_birth,
						'can_color' => $birth->bir_color,
						'can_kennel_id' => $birth->bir_kennel_id,
						'can_photo' => $birth->bir_photo
					);
					$canine = $this->caninesModel->add_canines($dataCanine);
					if ($canine){
						$whe['stu_id'] = $birth->bir_stu_id;
						$stud = $this->studModel->get_studs($whe)->row();
						if ($stud && $stud->stu_sire_id && $stud->stu_dam_id){
							$pedigree = array(
								'ped_canine_id' => $canine,
								'ped_sire_id' => $stud->stu_sire_id,
								'ped_dam_id' => $stud->stu_dam_id);
							$result = $this->pedigreesModel->add_pedigrees($pedigree);
							if ($result){
								$res = $this->notification_model->add(2, $this->uri->segment(4), $birth->bir_member_id);
								if ($res){
									$this->db->trans_complete();
									$wheBirth['mem_id'] = $birth->bir_member_id;
									$member = $this->memberModel->get_members($wheBirth)->row();
									if ($member->mem_firebase_token){
										$notif = $this->notificationtype_model->get_by_id(2);
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
									$this->session->set_flashdata('approve', TRUE);
									redirect('backend/Births/view_approve');
								}
								else{
									$err = 1;
								}
							}
							else{
								$err = 1;
							}	
						}
						else{
							$err = 1;
						}
					}
					else{
						$err = 1;
					}
				}
				else{
					$err = 1;
				}
				if ($err){
					$this->db->trans_rollback();
					$this->session->set_flashdata('error', 'Lahir dengan id = '.$this->uri->segment(4).' tidak dapat di-approve');
					redirect('backend/Births/view_approve');
				}
			}
			else{
				redirect('backend/Births/view_approve');
			}
		}

		public function reject(){
			if ($this->uri->segment(4)){
				$err = 0;
				$where['bir_id'] = $this->uri->segment(4);
				$birth = $this->birthModel->get_births($where)->row();
				$this->db->trans_strict(FALSE);
				$this->db->trans_start();
				$data['bir_app_user'] = $this->session->userdata('use_id');
				$data['bir_app_date'] = date('Y-m-d H:i:s');
				$data['bir_stat'] = 2;
				$res = $this->birthModel->update_births($data, $where);
				if ($res){
					$result = $this->notification_model->add(7, $this->uri->segment(4), $birth->bir_member_id);
					if ($result){
						$this->db->trans_complete();
						$wheBirth['mem_id'] = $birth->bir_member_id;
						$member = $this->memberModel->get_members($wheBirth)->row();
						if ($member->mem_firebase_token){
							$notif = $this->notificationtype_model->get_by_id(7);
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
						$this->session->set_flashdata('reject', TRUE);
						redirect('backend/Births/view_approve');
					}
					else{
						$err = 1;
					}
				}
				else{
					$err = 1;
				}
				if ($err){
					$this->db->trans_rollback();
					$this->session->set_flashdata('error', 'Lahir dengan id = '.$this->uri->segment(4).' tidak dapat ditolak');
					redirect('backend/Births/view_approve');
				}
			}
			else{
				redirect('backend/Births/view_approve');
			}
		}

		public function data($id = null){
				if ($id != null) {
						$where['bir_id'] = $id;
						$birth = $this->birthModel->get_births($where)->row();
						echo json_encode($birth);
				}else{
						$aColumns = array('bir_id', 'bir_stu_id', 'bir_photo', 'bir_a_s', 'bir_breed', 'bir_gender', 'bir_color', 'bir_date_of_birth', 'bir_cage', 'bir_owner_name', 'bir_stat', 'mem_name', 'kennels.ken_name', 'kennels.ken_type_id');
						$sTable = 'births';

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
						$this->db->join('members','members.mem_id = births.bir_member');
						$this->db->join('kennels','kennels.ken_id = members.mem_ken_id');
						$this->db->where('bir_stat', 0);
						$this->db->order_by('bir_date', 'DESC');
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
			$this->twig->display('backend/logsBirth', $data);
		}

		public function logs($id = null){
			if ($id != null) {
				$where['bir_id'] = $id;
				$birth = $this->birthModel->get_births($where)->row();
				echo json_encode($birth);
			}else{
				$aColumns = array('bir_id', 'bir_stu_id', 'bir_photo', 'bir_a_s', 'bir_breed', 'bir_gender', 'bir_color', 'bir_date_of_birth', 'bir_cage', 'bir_owner_name', 'bir_stat', 'mem_name', 'use_username', 'bir_app_date', 'bir_note', 'stat_name', 'bir_stat', 'bir_member', 'kennels.ken_name', 'kennels.ken_type_id');
				$sTable = 'births';

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
				$this->db->join('members','members.mem_id = births.bir_member');
				$this->db->join('users','users.use_id = births.bir_app_user');
				$this->db->join('approval_status','approval_status.stat_id = births.bir_stat');
				$this->db->join('kennels','kennels.ken_id = members.mem_ken_id');
				$this->db->order_by('bir_date', 'DESC');
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
		$res = $this->caninesModel->check_can_a_s('', $this->input->post('bir_a_s'));
		if (!$res){
			$img = $this->input->post('srcDataCrop');
			$title = self::_clean_text('canine');
			if ($img)
				$_POST['bir_photo'] = self::_upload_base64($img, $title);
			else
				$_POST['bir_photo'] = '-';

			unset($_POST['srcDataCrop']);
			
			$data = $this->input->post(null,false);

			$piece = explode("-", $this->input->post('bir_date_of_birth'));
			$date = $piece[2]."-".$piece[1]."-".$piece[0];
			$data['bir_date_of_birth'] = $date;

			$user = $this->session->userdata('user_data');
			$data['bir_app_user'] = $user['use_id'];

			$data['bir_app_date'] = date('Y-m-d H:i:s');
			$data['bir_stat'] = 1;

			$this->db->trans_strict(FALSE);
			$this->db->trans_start();
			// add birth data
			$births = $this->birthModel->add_births($data);
			if ($births){
				// add canine data
				$canine = $this->caninesModel->add_canine($data['bir_photo'], $data['bir_a_s'], $data['bir_breed'], $data['bir_gender'], $data['bir_color'], $data['bir_date_of_birth'], $data['bir_cage'], $data['bir_owner_name'], $data['bir_member']);
				
				// add pedigree data
				$where['stu_id'] = $data['bir_stu_id'];
				$stud = $this->studModel->get_studs($where)->row();
				
				$pedigree = array('ped_canine_id' => $canine,
								'ped_sire_id' => $stud->stu_sire_id,
								'ped_mom_id' => $stud->stu_mom_id );
				
				$res = $this->pedigreesModel->add_pedigrees($pedigree);

				$this->db->trans_complete();
				echo json_encode(array('data' => '1'));
			}
			else{
				$this->db->trans_rollback();
				echo json_encode(array('data' => 'Data lahir gagal disimpan'));
			}
		}
		else
			echo json_encode(array('data' => 'Nama canine tidak boleh sama'));
	}

	public function update($id = null){
		$res = $this->caninesModel->check_can_a_s($id, $this->input->post('bir_a_s'));
		if (!$res){
			$img = $this->input->post('srcDataCrop');
			if($img){
				$title = self::_clean_text('canine');
				$_POST['bir_photo'] = self::_upload_base64($img, $title, true, $id);
			}
				
			unset($_POST['srcDataCrop']);

			$data = $this->input->post(null,false);

			$piece = explode("-", $this->input->post('bir_date_of_birth'));
			$data['bir_date_of_birth'] = $piece[2]."-".$piece[1]."-".$piece[0];
			
			$where['bir_id'] = $id;

			$this->birthModel->update_births($data, $where);

			echo json_encode(array('data' => '1'));
		}
		else
			echo json_encode(array('data' => 'Nama canine tidak boleh sama'));
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
			$where['bir_id'] = $id;
			$births = $this->birthModel->get_births($where)->row();
			$curr_image = $this->path_upload.basename($births->bir_photo);
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
