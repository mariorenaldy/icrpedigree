<?php // ARTechnology
defined('BASEPATH') OR exit('No direct script access allowed');

class Members extends CI_Controller {
		private $navigations;
		public function __construct(){
			// Call the CI_Controller constructor
			parent::__construct();
			$this->load->library('bcrypt');
			$this->load->model(array('contactModel', 'caninesModel', 'pedigreesModel', 'profileModel', 'sponsorModel', 'productModel', 'navigation', 'memberModel', 'KenneltypeModel', 'KennelModel'));
			$this->navigations = $this->navigation->get_navigation();
			
			$session = self::_is_logged_in();
			if (!$session) 
				redirect('signin');
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
			$data['members'] = $this->memberModel->get_members($where)->row();
			$data['ken_types'] = $this->KenneltypeModel->get_kennel_types()->result();
			$data['navigations'] = $this->navigations;

			$this->twig->display('front/edit_member', $data);
		}

		public function update($id = null){
			$data = array(
				'mem_name' => $this->input->post('mem_name'),
				'mem_address' => $this->input->post('mem_address'),
				'mem_mail_address' => $this->input->post('mem_mail_address'),
				'mem_hp' => $this->input->post('mem_hp')
			);

			$img = $this->input->post('srcDataCrop');
			if ($img){
				$title = self::_clean_text('member');
				$this->path_upload = 'uploads/members/';
				$data['mem_photo'] = self::_upload_base64($img, $title, true, $id);
			}

			$where['mem_id'] = $id;
			$user = $this->memberModel->get_members($where)->row_array();
			if ($user == null) {
				echo json_encode(array('data' => 'Data Tidak Ditemukan'));
				return false;
			}
			
			if ($this->input->post('password') && $this->input->post('password') != ''){
				if ($this->input->post('newpass') == $this->input->post('repass')) {
					if ($this->bcrypt->check_password($this->input->post('password'), $user['mem_password']) == true) {
						if ($this->input->post('newpass') == $this->input->post('password')) {
							echo json_encode(array('data' => 'Password Yang Sama Tidak Dapat Digunakan Lagi!'));
							return false;
						}
						$data['mem_password'] = $this->bcrypt->hash_password($this->input->post('newpass'));
					}
					else {
						echo json_encode(array('data' => 'Password Awal Salah'));
						return false;
					}
				} else {
					echo json_encode(array('data' => 'Konfirmasi kata sandi gagal.'));
					return false;
				}
			}
			
			$kennel = array(
				'ken_name' => $this->input->post('ken_name'),
				'ken_type_id' => $this->input->post('ken_type_id')
			);

			$ken_img = $this->input->post('ken_srcDataCrop');
			if ($ken_img) {
				$ken_title = self::_clean_text('kennel');
				$this->path_upload = 'uploads/kennels/';
				$kennel['ken_photo'] = self::_upload_base64($ken_img, $ken_title);
			}

			$this->db->trans_strict(FALSE);
			$this->db->trans_start();
			if ($this->input->post('mem_ken_id'))
				$this->KennelModel->edit_kennels($kennel, $this->input->post('mem_ken_id'));
			else{
				if (!$ken_img) 
					$kennel['ken_photo'] = '-';
				$kennel['ken_id'] = $this->KennelModel->record_count() + 1;
				$data['mem_ken_id'] = $kennel['ken_id'];
				$this->KennelModel->add_kennels($kennel);
			}

			$this->memberModel->update_members($data, $where);
			$this->db->trans_complete();
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
