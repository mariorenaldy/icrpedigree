<?php // ARTechnology
defined('BASEPATH') OR exit('No direct script access allowed');

class Studs extends CI_Controller {
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
				$this->load->model(array('studModel', 'trahModel'));
				$this->load->model('navigation');
				
				$this->navigations = $this->navigation->get_navigation();
				$this->path_upload = 'uploads/stud/';
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
					$studs = $this->studModel->search_by_member($_GET['q']);
					if ($studs) {
						$data['studs'] = $studs;
					}else{
						$data['error'] = 'Maaf untuk data <b style="color:red">'.$_GET['q'].'</b> tidak ditemukan!!';
					}
					$this->twig->display('front/view_studs', $data);
				}
				else{
					$data['studs'] = $this->studModel->get_member_studs()->result();
					$this->twig->display('front/view_studs', $data);
				}
		}

		public function data($id = null){
			if ($id != null) {
				$where['stu_id'] = $id;
				$studs = $this->studModel->get_non_approved_studs($where)->row();
				echo json_encode($studs);
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
				$data['stu_stud_date'] = $date;
				$member = $this->session->userdata('member_data');
				$data['stu_member'] = $member['mem_id'];
	
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
				$member = $this->session->userdata('member_data');
				$data['stu_member'] = $member['mem_id'];
				
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
        $coordinator = $this->session->userdata('member_data');
        return isset($coordinator);
	}
	
	private function _clean_text($name = null){
		return str_replace(array(' ', '-'), '_', $name);
	}
}
