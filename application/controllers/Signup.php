<?php // ARTechnology
defined('BASEPATH') OR exit('No direct script access allowed');

class Signup extends CI_Controller {
		private $navigations;
		public function __construct(){
			// Call the CI_Controller constructor
			parent::__construct();
			$this->load->library('bcrypt');
			$this->load->model(array('contactModel', 'caninesModel', 'pedigreesModel', 'profileModel', 'sponsorModel', 'productModel', 'navigation', 'memberModel', 'KenneltypeModel', 'KennelModel'));
			$this->navigations = $this->navigation->get_navigation();
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
			$data['ken_types'] = $this->KenneltypeModel->get_kennel_types()->result();
			$this->twig->display('front/add_member', $data);
		}

		public function add(){
			$user = $this->memberModel->daftar_users($this->input->post('mem_username'))->result();
			if ($user) {
				echo json_encode(array('data' => 'Username Sudah Ada!'));
				return false;
			}

			if ($this->input->post('password') == $this->input->post('repass')) {
				$data = array(
					'mem_name' => $this->input->post('mem_name'),
					'mem_address' => $this->input->post('mem_address'),
					'mem_mail_address' => $this->input->post('mem_mail_address'),
					'mem_hp' => $this->input->post('mem_hp')
				);
	
				$data['mem_photo'] = '-';
				$img = $this->input->post('srcDataCrop');
				if ($img){
					$title = self::_clean_text('member');
					$this->path_upload = 'uploads/members/';
					$data['mem_photo'] = self::_upload_base64($img, $title);
				}
	
				$kennel = array(
					'ken_name' => $this->input->post('ken_name'),
					'ken_type_id' => $this->input->post('ken_type_id')
				);
	
				$kennel['ken_photo'] = '-';
				$ken_img = $this->input->post('ken_srcDataCrop');
				if ($ken_img) {
					$ken_title = self::_clean_text('kennel');
					$this->path_upload = 'uploads/kennels/';
					$kennel['ken_photo'] = self::_upload_base64($ken_img, $ken_title);
				}	
	
				$kennel['ken_id'] = $this->KennelModel->record_count() + 1;
				$data['mem_ken_id'] = $kennel['ken_id'];

				$this->db->trans_strict(FALSE);
				$this->db->trans_start();
				$this->KennelModel->add_kennels($kennel);

				$data['mem_username'] = $this->input->post('mem_username');
				$data['mem_password'] = $this->bcrypt->hash_password($this->input->post('password'));
				$id = $this->memberModel->add_members($data);
				if (!$id) {
					$this->db->trans_rollback();
					echo json_encode(array('data' => 'Gagal Memproses Akun Anda, Coba Lagi.'));
					return false;
				}
				else{
					$this->db->trans_complete();
					echo json_encode(array('data' => '1'));
				}
			} else 
				echo json_encode(array('data' => 'Konfirmasi kata sandi gagal.'));
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

				if ($update && $id != null){
						$where['mem_id'] = $id;
						$member = $this->memberModel->get_members($where)->row();
						$curr_image = $this->path_upload.basename($member->mem_photo);
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
}
