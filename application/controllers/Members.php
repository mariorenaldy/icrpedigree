<?php // ARTechnology
defined('BASEPATH') OR exit('No direct script access allowed');

class Members extends CI_Controller {
		private $navigations;
		public function __construct(){
			// Call the CI_Controller constructor
			parent::__construct();
			$this->load->model(array('contactModel', 'caninesModel', 'pedigreesModel', 'profileModel', 'sponsorModel', 'productModel', 'navigation', 'memberModel', 'KenneltypeModel', 'KennelModel', 'logmemberModel'));
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
				'log_member_id' => $id,
				'log_name' => $this->input->post('mem_name'),
				'log_address' => $this->input->post('mem_address'),
				'log_mail_address' => $this->input->post('mem_mail_address'),
				'log_hp' => $this->input->post('mem_hp'),
				'log_kota' => $this->input->post('mem_kota'),
				'log_kode_pos' => $this->input->post('mem_kode_pos'),
				'log_email' => $this->input->post('mem_email'),
				'log_kennel_name' => $this->input->post('ken_name'),
				'log_kennel_type_id' => $this->input->post('ken_type_id'),
				'log_stat' => 0
			);

			$img = $this->input->post('srcDataCrop');
			if ($img){
				$title = self::_clean_text('member');
				$this->path_upload = 'uploads/members/';
				$data['log_photo'] = self::_upload_base64($img, $title, true, $id);
			}

			$imgPP = $this->input->post('srcDataCropPP');
			if ($imgPP){
				$titlePP = self::_clean_text('pp');
				$this->path_upload = 'uploads/members/';
				$data['log_pp'] = self::_upload_base64($imgPP, $titlePP, true, $id);
			}

			$ken_img = $this->input->post('ken_srcDataCrop');
			if ($ken_img) {
				$ken_title = self::_clean_text('kennel');
				$this->path_upload = 'uploads/kennels/';
				if ($this->input->post('mem_ken_id'))
					$kennel['log_kennel_photo'] = self::_upload_base64($ken_img, $ken_title, true, $this->input->post('mem_ken_id'));
				else
					$kennel['log_kennel_photo'] = self::_upload_base64($ken_img, $ken_title);
			}

			$where['mem_id'] = $id;
			$user = $this->memberModel->get_members($where)->row_array();
			if ($user == null) {
				echo json_encode(array('data' => 'Data Tidak Ditemukan'));
				return false;
			}
			
			$this->db->trans_strict(FALSE);
			$this->db->trans_start();
			if (!$this->input->post('mem_ken_id')){
				if (!$ken_img) 
					$kennel['ken_photo'] = '-';
				$kennel['ken_id'] = $this->KennelModel->record_count() + 1;
				$this->KennelModel->add_kennels($kennel);
				$data['log_kennel_id'] = $kennel['ken_id'];
			}
			else
				$data['log_kennel_id'] = $this->input->post('mem_ken_id');

			$this->logmemberModel->add_log($data);
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

				if ($update && $id != null){
					if ($name == "member" || $name == "pp"){
						$where['mem_id'] = $id;
						$member = $this->memberModel->get_members($where)->row();
						if ($name == "member")
							$curr_image = $this->path_upload.basename($member->mem_photo);
						else
							$curr_image = $this->path_upload.basename($member->mem_pp);
						if (file_exists($curr_image)){
							unlink($curr_image);
						}
					}
					else{
						$where['ken_id'] = $id;
						$kennel = $this->KennelModel->get_kennels($where)->row();
						if ($kennel){
							$curr_image = $this->path_upload.basename($kennel->ken_photo);
							if (file_exists($curr_image)){
								unlink($curr_image);
							}
						}
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
