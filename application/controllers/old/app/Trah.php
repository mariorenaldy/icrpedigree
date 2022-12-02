<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Trah extends CI_Controller {
		public function __construct(){
				// Call the CI_Controller constructor
				parent::__construct();
				$this->load->model('trahModel');
		}

		public function get(){
				$trah = $this->trahModel->get_all_trah()->result();
				echo json_encode([
					'status' => true,
					'data' => $trah
				]);				
		}
}
