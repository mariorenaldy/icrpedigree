<?php // ARTechnology
defined('BASEPATH') OR exit('No direct script access allowed');

class Canines extends CI_Controller {
		private $navigations;
		public function __construct(){
				// Call the CI_Controller constructor
				parent::__construct();
				$this->load->library('bcrypt');
				$this->load->model('contactModel');
				$this->load->model('caninesModel');
				$this->load->model('pedigreesModel');
				$this->load->model('profileModel');
				$this->load->model('sponsorModel');
				$this->canines = array();
				$this->load->model('productModel');
				// $this->load->model('employeeCredentialModel');
				$this->load->model(array('memberModel', 'requestModel', 'trahModel'));
				$this->load->model('navigation');
				
				$this->navigations = $this->navigation->get_navigation();
				$this->path_upload = 'uploads/canine/';
				$this->name = "photo_";
				
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

				$user = $this->session->userdata('member_data');
				$data['users'] = $user;

				$data['navigations'] = $this->navigations;

				$data['trahs'] = $this->trahModel->get_trah()->result();

				if (isset($_GET['q']) && $_GET['q'] != '+') {
					$canines = $this->caninesModel->search_by_member($_GET['q']);
					if ($canines) {
						$data['canines'] = $canines;
					}else{
						$data['error'] = 'Maaf untuk data <b style="color:red">'.$_GET['q'].'</b> tidak ditemukan!!';
					}
					$this->twig->display('front/view_canines', $data);
				}
				else{
					$data['canines'] = $this->caninesModel->get_members_canines()->result();
					$this->twig->display('front/view_canines', $data);
				}
		}

		public function sire(){
			$member = $this->session->userdata('member_data');
			if (isset($_GET['q'])) {
			  $q = $_GET['q'];
			  $canines = $this->caninesModel->sire_search_by_id($q, $member['mem_id'])->result();
			} else {
			  $canines = $this->caninesModel->sire_search_by_id(null, $member['mem_id'])->result();
			}
			echo json_encode($canines);
			}
	
		public function dam(){
			if (isset($_GET['q'])) {
			  $q = $_GET['q'];
			  $canines = $this->caninesModel->dam_search($q)->result();
			} else {
			  $canines = $this->caninesModel->dam_search()->result();
			}
			echo json_encode($canines);
		}

		public function breeder(){
			$q = $_GET['q'];
			$canines = $this->caninesModel->breeder_search($q)->result();
			echo json_encode($canines);
		}

		public function kennel(){
			$q = $_GET['q'];
			$canines = $this->caninesModel->kennel_search($q)->result();
			echo json_encode($canines);
		}

		public function owner(){
			$q = $_GET['q'];
			$canines = $this->caninesModel->owner_search($q)->result();
			echo json_encode($canines);
		}

		public function address(){
			$q = $_GET['q'];
			$canines = $this->caninesModel->address_search($q)->result();
			echo json_encode($canines);
		}

		public function parentId($id = null){
			$where['can_id'] = $id;
			$canines = $this->caninesModel->get_parent($where)->row();
			echo json_encode($canines);
		}

		public function search(){
			$canines = $this->caninesModel->search_by_member($_GET['q']);
			echo json_encode($canines);
		}

		public function data($id = null){
			if ($id != null) {
				$canines = $this->caninesModel->get_members_canine($id)->row();
				echo json_encode($canines);
			}
		}
		
		public function update($id = null){
			$img = $this->input->post('srcDataCrop');
			if ($img){
				$title = self::_clean_text('canine');
				$data['req_can_photo'] = self::_upload_base64($img, $title);
			}
			unset($_POST['srcDataCrop']);

			$where['can_id'] = $id;
			$can = $this->caninesModel->get_can_pedigrees($where)->row();

			$data['req_can_id'] = $id;
			if ($this->input->post('can_cage') && $this->input->post('can_cage') != $can->can_cage)
				$data['req_can_cage'] = $this->input->post('can_cage');
			else
				$data['req_can_cage'] = '';
			if ($this->input->post('can_address') && $this->input->post('can_address') != $can->can_address)
				$data['req_can_address'] = $this->input->post('can_address');
			else
				$data['req_can_address'] = '';
			if ($this->input->post('can_owner') && $this->input->post('can_owner') != $can->can_owner)
				$data['req_can_owner'] = $this->input->post('can_owner');
			else
				$data['req_can_owner'] = '';
			$data['req_app_user'] = 0;

			$this->requestModel->add_requests($data);
            echo json_encode(array('data' => '1'));
		}

		public function logs($id = null){
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

			$user = $this->session->userdata('member_data');
			$data['users'] = $user;

			$data['navigations'] = $this->navigations;

			$where['req_can_id'] = $id;
			$data['reqs'] = $this->requestModel->get_requests($where)->result();
			$this->twig->display('front/requests', $data);
		}

		public function add(){
			$res = $this->caninesModel->check_can_a_s('', $this->input->post('can_a_s'));
			if (!$res){
				$img = $this->input->post('srcDataCrop');
				$title = self::_clean_text('canine');
				if ($img)
					$_POST['can_photo'] = self::_upload_base64($img, $title);
				else
					$_POST['can_photo'] = '-';

				unset($_POST['srcDataCrop']);
				
				$data = $this->input->post(null,false);

				$piece = explode("-", $this->input->post('can_date_of_birth'));
				$date = $piece[2]."-".$piece[1]."-".$piece[0];
				$data['can_date_of_birth'] = $date;

				$member = $this->session->userdata('member_data');
				$data['can_member'] = $member['mem_id'];

				$this->db->trans_strict(FALSE);
				$this->db->trans_start();
				$canine = $this->caninesModel->add_canines($data);
				$pedigree = array('ped_canine_id' => $canines,
								  'ped_sire_id' => 86,
								  'ped_mom_id' => 87 );
				$pedigree = $this->pedigreesModel->add_pedigrees($pedigree);
				$this->db->trans_complete();
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
			$where['can_id'] = $id;
			$canines = $this->caninesModel->get_canines($where)->row();
			$curr_image = $this->path_upload.basename($canines->can_photo);
			if(file_exists($curr_image)){
				unlink($curr_image);
			}
		}
		return $url_image;
	}

    private function _is_logged_in(){
        $coordinator = $this->session->userdata('member_data');
        return isset($coordinator);
	}
	
	private function _clean_text($name = null){
		return str_replace(array(' ', '-'), '_', $name);
	}
}
