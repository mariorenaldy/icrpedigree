<?php // ARTechnology
defined('BASEPATH') OR exit('No direct script access allowed');

class Births extends CI_Controller {
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
				$this->load->model(array('studModel', 'birthModel', 'memberModel', 'trahModel'));
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
					$births = $this->birthModel->search_by_member($_GET['q']);
					if ($births) {
						$data['births'] = $births;
					}else{
						$data['error'] = 'Maaf untuk data <b style="color:red">'.$_GET['q'].'</b> tidak ditemukan!!';
					}
					$this->twig->display('front/view_births', $data);
				}
				else{
					$data['births'] = $this->birthModel->get_births()->result();
					$this->twig->display('front/view_births', $data);
				}
		}

		public function data($id = null){
			if ($id != null) {
				$where['bir_id'] = $id;
				$births = $this->birthModel->get_non_approved_births($where)->row();
				echo json_encode($births);
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
				
				$cek = true;
				$piece = explode("-", $this->input->post('bir_date_of_birth'));
				$date = $piece[2]."-".$piece[1]."-".$piece[0];
		
				$ts = new DateTime($date);
				$ts_now = new DateTime();
				
				if ($ts > $ts_now)
					$cek = false;
				else{
					$diff = floor($ts->diff($ts_now)->days/7);
					if ($diff > 1)
						$cek = false;
				}

				if ($cek){
					$data = $this->input->post(null,false);

					$piece = explode("-", $this->input->post('bir_date_of_birth'));
					$date = $piece[2]."-".$piece[1]."-".$piece[0];
					$data['bir_date_of_birth'] = $date;

					$member = $this->session->userdata('member_data');
					$data['bir_member'] = $member['mem_id'];

					$births = $this->birthModel->add_births($data);

					echo json_encode(array('data' => '1'));
				}
				else
					echo json_encode(array('data' => 'Pelaporan lahir harus kurang dari 1 minggu'));
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

				$cek = true;
				$piece = explode("-", $this->input->post('bir_date_of_birth'));
				$date = $piece[2]."-".$piece[1]."-".$piece[0];
		
				$ts = new DateTime($date);
				$ts_now = new DateTime();
				
				if ($ts > $ts_now)
					$cek = false;
				else{
					$diff = floor($ts->diff($ts_now)->days/7);
					if ($diff > 1)
						$cek = false;
				}

				if ($cek){
					$data = $this->input->post(null,false);

					$piece = explode("-", $this->input->post('bir_date_of_birth'));
					$date = $piece[2]."-".$piece[1]."-".$piece[0];
					$data['bir_date_of_birth'] = $date;

					$member = $this->session->userdata('member_data');
					$data['bir_member'] = $member['mem_id'];
					
					$where['bir_id'] = $id;

					$this->birthModel->update_births($data, $where);

					echo json_encode(array('data' => '1'));
				}
				else
					echo json_encode(array('data' => 'Pelaporan lahir harus kurang dari 1 minggu'));
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
        $coordinator = $this->session->userdata('member_data');
        return isset($coordinator);
	}
	
	private function _clean_text($name = null){
		return str_replace(array(' ', '-'), '_', $name);
	}
}
