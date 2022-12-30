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
			$where['bir_stat != '] = 0;
			$data['birth'] = $this->birthModel->get_births($where)->result();
			$this->load->view('backend/view_births', $data);
		}

		public function search(){
			$date = '';
			$piece = explode("-", $this->input->post('keywords'));
			if (count($piece) == 3){
				$date = $piece[2]."-".$piece[1]."-".$piece[0];
			}
			if ($date){
				$where['bir_date_of_birth'] = $date;
			}
			$where['bir_stat != '] = 0;
			$data['birth'] = $this->birthModel->get_births($where)->result();
			$this->load->view('backend/view_births', $data);
		}

		public function add(){
			if ($this->uri->segment(4)){
				$data['bir_stu_id'] = $this->uri->segment(4);
				$data['member'] = [];
				$data['mode'] = 0;
				$this->load->view('backend/add_birth', $data);
			}
			else{
				redirect('backend/Studs');
			}
		}

		public function search_member(){
			if ($this->session->userdata('use_username')){
				$data['bir_stu_id'] = $this->input->post('bir_stu_id');

				$like['mem_name'] = $this->input->post('mem_name');
				$where['mem_stat'] =  1;
				$data['member'] = $this->memberModel->search_members($like, $where)->result();

				$data['mode'] = 1;
				$this->load->view('backend/add_birth', $data);
			}
			else{
				redirect("backend/Users/login");
			}
		}

		public function validate_add(){
			if ($this->session->userdata('use_username')){
				$this->form_validation->set_error_delimiters('<div>','</div>');
				$this->form_validation->set_rules('bir_stu_id', 'Stud id ', 'trim|required');
				$this->form_validation->set_rules('can_member_id', 'Member id ', 'trim|required');
				$this->form_validation->set_rules('bir_male', 'Male ', 'trim|required');
				$this->form_validation->set_rules('bir_female', 'Female ', 'trim|required');
				$this->form_validation->set_rules('bir_date_of_birth', 'Date of Birth ', 'trim|required');
	
				$data['bir_stu_id'] = $this->input->post('bir_stu_id');

				$like['mem_name'] = $this->input->post('mem_name');
				$where['mem_stat'] =  1;
				$data['member'] = $this->memberModel->search_members($like, $where)->result();

				$data['mode'] = 1;
				if ($this->form_validation->run() == FALSE){
					$this->load->view('backend/add_birth', $data);
				}
				else{
					$err = 0;
					$damPhoto = '-';
					if (!$err){
						if (isset($_FILES['attachment_dam']) && !empty($_FILES['attachment_dam']['tmp_name']) && is_uploaded_file($_FILES['attachment_dam']['tmp_name'])){
							$this->upload->initialize($this->config->item('upload_birth'));
							if ($this->upload->do_upload('attachment_dam')){
								$uploadData = $this->upload->data();
								$damPhoto = $uploadData['file_name'];
							}
							else{
								$err++;
								$this->session->set_flashdata('error_message', $this->upload->display_errors());
							}
						}
					}
	
					if (!$err && $damPhoto == "-"){
						$err++;
						$this->session->set_flashdata('error_message', 'Dam photo is required'); 
					}
						
					if (!$err){
						// syarat maksimal 75 hari dari lapor pacak
						$whereStud['stu_id'] = $this->input->post('bir_stu_id');
						$stud = $this->studModel->get_studs($whereStud)->row();
						if ($stud){
							$piece = explode("-", $this->input->post('bir_date_of_birth'));
							$date = $piece[2]."-".$piece[1]."-".$piece[0];
			
							$data = array(
								'bir_stu_id' => $this->input->post('bir_stu_id'),
								'bir_member_id' => $this->input->post('can_member_id'),
								'bir_dam_photo' => $damPhoto,
								'bir_male' => $this->input->post('bir_male'),
								'bir_female' => $this->input->post('bir_female'),
								'bir_date_of_birth' => $date,
								'bir_app_user' => $this->session->userdata('use_id'),
								'bir_app_date' => date('Y-m-d H:i:s'),
								'bir_stat' => 1,
							);
							$births = $this->birthModel->add_births($data);
							if ($births){
								$this->session->set_flashdata('add_success', true);
								redirect("backend/Births");
							}
							else{
								$err++;
								$this->session->set_flashdata('error_message', 'Failed to save birth');
							}
						}
						else{
							$err++;
							$this->session->set_flashdata('error_message', 'Stud id is invalid'); 
						}
					}
					if ($err){
						$this->load->view('backend/add_birth', $data);
					}
				}
			}
			else{
				redirect("backend/Users/login");
			}
		}

		public function view_approve(){
			$where['bir_stat'] = 0;
			$data['birth'] = $this->birthModel->get_births($where)->result();
			$this->load->view('backend/approve_births', $data);
		}

		public function search_approve(){
			$date = '';
			$piece = explode("-", $this->input->post('keywords'));
			if (count($piece) == 3){
				$date = $piece[2]."-".$piece[1]."-".$piece[0];
			}
			if ($date){
				$where['bir_date_of_birth'] = $date;
			}
			$where['bir_stat'] = 0;
			$data['birth'] = $this->birthModel->get_births($where)->result();
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
					$this->session->set_flashdata('error', 'Failed to approve birth id = '.$this->uri->segment(4));
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
					$this->session->set_flashdata('error', 'Failed to reject birth id = '.$this->uri->segment(4));
					redirect('backend/Births/view_approve');
				}
			}
			else{
				redirect('backend/Births/view_approve');
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
