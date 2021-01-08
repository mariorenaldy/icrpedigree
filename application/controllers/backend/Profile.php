<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Profile extends CI_Controller {
		private $navigations;
		public function __construct(){
				// Call the CI_Controller constructor
				parent::__construct();
				$this->load->model('profileModel');
				$this->load->model('navigation');
				$this->navigations = $this->navigation->get_navigation();

				$this->path_upload = 'uploads/profile/';

				$session = self::_is_logged_in();
        if(!$session) redirect('backend');
		}
		public function index(){

				$data['navigations'] = $this->navigations;
				$user = $this->session->userdata('user_data');
				$data['users'] = $user;
				if ($user['use_akses'] != 3) {
					$whereStd['prof_id'] = 1;
				 	$profile = $this->profileModel->get_profiles($whereStd)->row_array();
					$data['profile'] = $profile;
					$this->twig->display('backend/profile', $data);
				}else {
					redirect('backend/dashboard');
				}

				// }
		}

		public function update($id = null){
				// $data = $this->input->post(null, true);
				$data = array( $_POST['name'] => $_POST['value'] );
				$where['prof_id'] = $id;
				$this->profileModel->update_profiles($data, $where);
				// $data['notice_id'] = $id;
				// self::_is_write_log('update', $data, 'aris');
				echo json_encode(array('data' => '1'));
		}

		public function update_logo($id = null){
				$img = $this->input->post('srcDataCrop');
				if($img){
						$title = self::_clean_text('profile');
						$_POST['prof_logo'] = self::_upload_base64($img, $title, true, $id);
				}
				unset($_POST['srcDataCrop']);
				$data = $this->input->post(null, true);
				$where['prof_id'] = $id;
				$this->profileModel->update_profiles($data, $where);
				echo json_encode(array('data' => '1'));
		}

		public function update_background($id = null){
				$img = $this->input->post('srcDataCrop-bg');
				if($img){
						$title = self::_clean_text('background');
						$_POST['prof_background'] = self::_upload_bg_base64($img, $title, true, $id);
				}
				unset($_POST['srcDataCrop-bg']);
				$data = $this->input->post(null, true);
				$where['prof_id'] = $id;
				$this->profileModel->update_profiles($data, $where);
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

				$url_image = $file;

				// if($update && $id != null){
				// 		$where['prof_id'] = $id;
				// 		$profile = $this->profileModel->get_profiles($where)->row();
				// 		$curr_image = $this->path_upload.basename($profile->prof_logo);
				// 		if(file_exists($curr_image)){
				// 				unlink($curr_image);
				// 		}
				// }

				return $url_image;
		}

		private function _upload_bg_base64($image = null, $name = null, $update = false, $id = null){
				$name_image = $name.'_'.time();
				$name_image = strtolower($name_image);
				$image = str_replace('data:image/png;base64,', '', $image);
				// $image = str_replace('data:image/png;base64,', '', $image);
				$image = str_replace(' ', '+', $image);
				$data = base64_decode($image);
				// $file = $this->path_upload.$name_image . '.jpg';
				$file = $this->path_upload.$name_image . '.png';
				$success = file_put_contents($file, $data);

				$url_image = $file;

				if($update && $id != null){
						$where['prof_id'] = $id;
						$profile = $this->profileModel->get_profiles($where)->row();
						$curr_image = $this->path_upload.basename($profile->prof_background);
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
}
