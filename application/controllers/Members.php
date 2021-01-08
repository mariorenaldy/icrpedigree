<?php // ARTechnology
defined('BASEPATH') OR exit('No direct script access allowed');

class Members extends CI_Controller {
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
				$this->load->model('memberModel');
				$this->load->model('navigation');
				
				$this->navigations = $this->navigation->get_navigation();
				$this->path_upload = 'uploads/members/';

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

				$where['mem_id'] = $user['mem_id'];
				$member = $this->memberModel->get_members($where)->row();
				$data['members'] = $member;

				$data['navigations'] = $this->navigations;

				$this->twig->display('front/edit_member', $data);
		}

		public function update($id = null){
			$img = $this->input->post('srcDataCrop');
			if($img){
				$title = self::_clean_text('member');
				$_POST['mem_photo'] = self::_upload_base64($img, $title, true, $id);
			}
			unset($_POST['srcDataCrop']);
			$data = $this->input->post(null, true);
			$where['mem_id'] = $id;
			$user = $this->memberModel->get_members($where)->row_array();
			if ($user== null) {
				echo json_encode(array('data' => 'Data Tidak Ditemukan'));
				return false;
			}
			
			if (isset($data['password']) && $data['password'] != ''){
				if ($this->bcrypt->check_password($data['password'], $user['mem_password']) == true) {
					if ($data['newpass'] == $data['password']) {
						echo json_encode(array('data' => 'Password Yang Sama Tidak Dapat Digunakan Lagi!'));
						return false;
					}

					$data['mem_password'] = $this->bcrypt->hash_password($data['newpass']);
				}
				else {
					echo json_encode(array('data' => 'Password Awal Salah'));
					return false;
				}
			}
			else{
				$data['mem_password'] = $user['mem_password'];
			}
			unset($data['password']);
			unset($data['newpass']);
			$this->memberModel->update_members($data, $where);

			unset($data['mem_password']);
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
						$where['mem_id'] = $id;
						$member = $this->memberModel->get_members($where)->row();
						$curr_image = $this->path_upload.basename($member->mem_photo);
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
        $coordinator = $this->session->userdata('member_data');
        return isset($coordinator);
    }

	public function _same_user($username) {
		$user = $this->memberModel->daftar_users($username)->row_array();
		return isset($user);
	}
}
