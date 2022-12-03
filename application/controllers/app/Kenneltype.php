<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Kenneltype extends CI_Controller {
		public function __construct(){
			// Call the CI_Controller constructor
			parent::__construct();
			$this->load->model('KenneltypeModel');
		}

		public function get_all(){
			$res = $this->KenneltypeModel->get_kennel_types()->result();
			echo json_encode([
				'status' => true,
				'data' => $res
			]);
		}
}
