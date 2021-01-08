<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pedigrees extends CI_Controller {
    private $navigations;
    private $path_upload;
    public function __construct(){
        // Call the CI_Controller constructor
        parent::__construct();
        $this->load->model('contactModel');
        $this->load->library('bcrypt');
				$this->load->model('caninesModel');
        $this->load->model('pedigreesModel');
        $this->load->model('profileModel');
        $this->load->model('sponsorModel');
      	$this->canines = array();
          $this->load->model('productModel');
        // $this->load->model('employeeCredentialModel');
        $this->load->model('navigation');

        $this->navigations = $this->navigation->get_navigation();
        $this->path_upload = 'uploads/coordinators/';
        
        $session = self::_is_logged_in();
        if(!$session) redirect('signin');
    }

    public function index(){
      $product = $this->productModel->get_products()->result();
      $data['products'] = $product;
      $sponsor = $this->sponsorModel->get_sponsors()->result();
      $data['sponsors'] = $sponsor;
      $whereCont['con_id'] = 1;
      $contact = $this->contactModel->get_contacts($whereCont)->row_array();
      $data['contact'] = $contact;
        $wherePro['prof_id'] = 1;
        $profile = $this->profileModel->get_profiles($wherePro)->row();
        $data['profile'] = $profile;

        // ARTechnology
        $user = $this->session->userdata('member_data');
		    $data['users'] = $user;
        // ARTechnology

        $this->twig->display('front/pedigrees',$data);

        if (isset($_GET['q']) && $_GET['q'] != '+') {
          // ARTechnology
        //   $q = $_GET['q'];
        //   $canines = $this->caninesModel->get_search($q)->result();
        //   $whereCan['can_icr_number'] = $canines[0]->can_icr_number;
        //   $canines = $this->caninesModel->get_canines($whereCan)->result();
          $canines = $this->caninesModel->search_by_icr_number($_GET['q']);
          // ARTechnology
          if ($canines) {
              $this->pedid($canines[0]->can_id);
              $this->twig->display('front/family_tree',$data);
          }else{
              // ARTechnology
              // $data['error'] = 'Maaf untuk data <b style="color:red">'.$id.'</b> tidak ditemukan!!';
              $data['error'] = 'Maaf untuk data <b style="color:red">'.$_GET['q'].'</b> tidak ditemukan!!';
              // ARTechnology
              $this->twig->display('front/pedigrees',$data);
          }
    }
  }

  public function pedid($id = null){

    $product = $this->productModel->get_products()->result();
    $data['products'] = $product;
    $sponsor = $this->sponsorModel->get_sponsors()->result();
    $data['sponsors'] = $sponsor;
    $whereCont['con_id'] = 1;
    $contact = $this->contactModel->get_contacts($whereCont)->row_array();
    $data['contact'] = $contact;
      $wherePro['prof_id'] = 1;
      $profile = $this->profileModel->get_profiles($wherePro)->row();
      $data['profile'] = $profile;
      
      $where['can_id'] = $id;
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

      // ARTechnology
      $user = $this->session->userdata('member_data');
      $data['users'] = $user;
      // ARTechnology
      
      // print_r($data);
      $this->twig->display('front/family_tree',$data);

  }


    public function search(){
      // ARTechnology
    //   $q = $_GET['q'];
    //   $canines = $this->caninesModel->get_search($q)->result();
      $canines = $this->caninesModel->search_by_icr_number($_GET['q']);
      // ARTechnology
      echo json_encode($canines);
    }

    public function id($id){
      if ($id == null) {
          redirect('/pedigrees');
      }
      $product = $this->productModel->get_products()->result();
      $data['products'] = $product;
      $sponsor = $this->sponsorModel->get_sponsors()->result();
      $data['sponsors'] = $sponsor;
      $whereCont['con_id'] = 1;
      $contact = $this->contactModel->get_contacts($whereCont)->row_array();
      $data['contact'] = $contact;
      $where['prof_id'] = 1;
      $profile = $this->profileModel->get_profiles($where)->row();
      $data['profile'] = $profile;

      if ($id) {
        $whereCan['can_id'] = $id;
        $canines = $this->caninesModel->get_canines($whereCan)->row();
        $data['canine'] = $canines;
        $this->pedid($id);
        // $this->twig->display('front/family_tree',$data);
      }else{
          if (isset($_GET['q'])) {
            $q = $_GET['q'];
            $canines = $this->caninesModel->get_search($q)->result();
            $whereCan['can_icr_number'] = $canines[0]->can_icr_number;
            $canines = $this->caninesModel->get_canines($whereCan)->row();
            if ($canines) {
                $this->pedid($canines[0]->can_id);
                // $data['canine'] = $canines;
                // $this->twig->display('front/family_tree',$data);
            }else{
              // echo "<script>
              //         alert('Data Tidak ada!!');
              //       </script>";

              // redirect(base_url().'pedigrees', 'refresh');

              print_r('untuk data '.$id.' yg anda cari tidak ditemukan!!');

              // $error = '<script>
              //         alert("Data Tidak ada!!");
              //         window.location.href="'.base_url().'pedigrees";
              //       </script>';
              //
              // echo $error ;
            }
          }
      }

    }

    public function cid($id){
				$canine = $this->canine($id);
				$data['canines'] = json_encode($this->canines);
				print_r($data['canines']);
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


//  PHP Helper
    public function gen_pass(){
      $rand = substr(uniqid('', true), -5);
      return $rand;
    }

    private function _is_logged_in(){
        $coordinator = $this->session->userdata('member_data');
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
