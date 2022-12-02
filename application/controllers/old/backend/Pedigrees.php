<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pedigrees extends CI_Controller {
		private $navigations;
		public function __construct(){
				// Call the CI_Controller constructor
				parent::__construct();
				$this->load->model('caninesModel');
        $this->load->model('pedigreesModel');
				$this->load->model('navigation');
				$this->canines = array();
				$this->navigations = $this->navigation->get_navigation();
				$session = self::_is_logged_in();
        if(!$session) redirect('backend');
		}

		// public function id($id){
		// 		// $session = self::_is_logged_in();
		// 		//
		// 		$data['navigations'] = $this->navigations;
		// 		$user = $this->session->userdata('user_data');
		// 		$data['users'] = $user;
		//
		// 		$canine['can_id'] = $id;
		// 		$data['canines'] = $canine;
		//
		// 		// print_r($data);
		// 		$this->twig->display('backend/pedigrees', $data);
		//
		// }

		public function cid($id){
				$canine = $this->canine($id);
				$data['canines'] = json_encode($this->canines);
				print_r($data['canines']);
		}

		public function id($id = null){

				$user = $this->session->userdata('user_data');
				$data['users'] = $user;
				//
				$data['navigations'] = $this->navigations;
				$where['can_id'] = $id;

				// ARTechnology
				// $res = $this->caninesModel->get_canines($where)->result_array();
				// $data['canine'][0]['note'] = $res[0]->can_note;
				// ARTechnology

				$data['canine'] = $this->caninesModel->get_can_pedigrees($where)->result_array();
				$sire['can_id'] = $data['canine'][0]['ped_sire_id'];
				$dam['can_id'] = $data['canine'][0]['ped_mom_id'];
				// sire & mom level 1
				$data['canine'][0]['sire'] = $this->caninesModel->get_can_pedigrees($sire)->result_array();
				$data['canine'][0]['mom'] = $this->caninesModel->get_can_pedigrees($dam)->result_array();

				// sire & mom level 2
				if ($data['canine'][0]['sire']) {
					$sire1['can_id'] = $data['canine'][0]['sire'][0]['ped_sire_id'];
					$dam1['can_id'] = $data['canine'][0]['sire'][0]['ped_mom_id'];
					$data['canine'][0]['sire'][0]['sire'] = $this->caninesModel->get_can_pedigrees($sire1)->result_array();
					$data['canine'][0]['sire'][0]['mom'] = $this->caninesModel->get_can_pedigrees($dam1)->result_array();

					$sire2['can_id'] = $data['canine'][0]['mom'][0]['ped_sire_id'];
					$dam2['can_id'] = $data['canine'][0]['mom'][0]['ped_mom_id'];
					$data['canine'][0]['mom'][0]['sire'] = $this->caninesModel->get_can_pedigrees($sire2)->result_array();
					$data['canine'][0]['mom'][0]['mom'] = $this->caninesModel->get_can_pedigrees($dam2)->result_array();

					// sire level 3
					if ($data['canine'][0]['sire'][0]['sire']) {
							$sire12['can_id'] = $data['canine'][0]['sire'][0]['sire'][0]['ped_sire_id'];
							$dam12['can_id'] = $data['canine'][0]['sire'][0]['sire'][0]['ped_mom_id'];
							$data['canine'][0]['sire'][0]['sire'][0]['sire'] = $this->caninesModel->get_can_pedigrees($sire12)->result_array();
							$data['canine'][0]['sire'][0]['sire'][0]['mom'] = $this->caninesModel->get_can_pedigrees($dam12)->result_array();
					}

					if ($data['canine'][0]['sire'][0]['mom']) {
							$sire22['can_id'] = $data['canine'][0]['sire'][0]['mom'][0]['ped_sire_id'];
							$dam22['can_id'] = $data['canine'][0]['sire'][0]['mom'][0]['ped_mom_id'];
							$data['canine'][0]['sire'][0]['mom'][0]['sire'] = $this->caninesModel->get_can_pedigrees($sire22)->result_array();
							$data['canine'][0]['sire'][0]['mom'][0]['mom'] = $this->caninesModel->get_can_pedigrees($dam22)->result_array();
					}

					if ($data['canine'][0]['mom'][0]['sire']) {
							$sire12['can_id'] = $data['canine'][0]['mom'][0]['sire'][0]['ped_sire_id'];
							$dam12['can_id'] = $data['canine'][0]['mom'][0]['sire'][0]['ped_mom_id'];
							$data['canine'][0]['mom'][0]['sire'][0]['sire'] = $this->caninesModel->get_can_pedigrees($sire12)->result_array();
							$data['canine'][0]['mom'][0]['sire'][0]['mom'] = $this->caninesModel->get_can_pedigrees($dam12)->result_array();
					}

					if ($data['canine'][0]['mom'][0]['mom']) {
							$sire22['can_id'] = $data['canine'][0]['mom'][0]['mom'][0]['ped_sire_id'];
							$dam22['can_id'] = $data['canine'][0]['mom'][0]['mom'][0]['ped_mom_id'];
							$data['canine'][0]['mom'][0]['mom'][0]['sire'] = $this->caninesModel->get_can_pedigrees($sire22)->result_array();
							$data['canine'][0]['mom'][0]['mom'][0]['mom'] = $this->caninesModel->get_can_pedigrees($dam22)->result_array();
					}
				}


				// sibling male
				if ($data['canine'][0]['ped_sire_id'] != '86' && $data['canine'][0]['ped_mom_id'] != '87') {
					$whereMale['ped_sire_id'] = $data['canine'][0]['ped_sire_id'];
					$whereMale['ped_mom_id'] = $data['canine'][0]['ped_mom_id'];
					$whereMale['can_gender'] = 'Male';
					$whereMale['ped_canine_id !='] = $data['canine'][0]['can_id'];
					$data['sibling_male'] = $this->pedigreesModel->get_sibling($whereMale)->result();

					// sibling Female
					$whereFamale['ped_sire_id'] = $data['canine'][0]['ped_sire_id'];
					$whereFamale['ped_mom_id'] = $data['canine'][0]['ped_mom_id'];
					$whereFamale['can_gender'] = 'Female';
					$whereFamale['ped_canine_id !='] = $data['canine'][0]['can_id'];
					$data['sibling_female'] = $this->pedigreesModel->get_sibling($whereFamale)->result();
				}


				// print_r($data);
				$this->twig->display('backend/pedigrees', $data);

		}


		// Pedigrees algoritm

		public function canine($id){
			$where['can_id'] = $id;
			$canines = $this->caninesModel->get_can_pedigrees($where)->row();
			$canines->{'id'} =  $id;
			$canines->{'parent'} = null;
			array_push($this->canines, $canines);
			$this->pedigree($id);
		}

		public function pedigree($id){
			$where['ped_canine_id'] = $id;
			$query = $this->pedigreesModel->get_pedigrees($where)->row();

			if ($query != null) {
						$sire = $query->{'ped_sire_id'};
						$mom = $query->{'ped_mom_id'};
						$this->caninePedigree($sire, $id);
						$this->caninePedigree($mom, $id);
			}

		}

		public function caninePedigree($id, $parent){
			$where['can_id'] = $id;
			$canine = $this->caninesModel->get_can_pedigrees($where)->row();
			if ($canine != null) {
					$canine->{'id'} =  $id;
					$canine->{'parent'} =  $parent;
					array_push($this->canines, $canine);
					$this->pedigree($id);
			}
		}

		// end pedigree

		public function update($id = null){
				// $data = $this->input->post(null, true);
				$data = array( $_POST['name'] => $_POST['value'] );
				$where['con_id'] = $id;
				$this->contactModel->update_contact($data, $where);
				// $data['notice_id'] = $id;
				// self::_is_write_log('update', $data, 'aris');
				echo json_encode(array('data' => '1'));
		}



    //  PHP Helper
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
	
	// ARTechnology
	public function auto_correct(){
		$res = $this->caninesModel->get_all_with_no_pedigrees();
		if ($res){
			$err = 0;
			foreach ($res as $r){
				$ins = $this->pedigreesModel->insert_pedigree($r->can_id);
				if (!$ins){
					$err = $r->can_id;
					break;
				}
			}
			if (!$err){
				echo 'Success';
			}
			else{
				echo 'Fail to insert pedigree with id = '.$err;
			}
		}
		else{
			echo 'Fail to get canine data';
		}
	}
	// ARTechnology
}
