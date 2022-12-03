<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Notification extends CI_Controller{
	public function __construct(){
		parent::__construct();
		$this->load->model(array('notification_model'));
		$this->load->library(array('session', 'form_validation'));
		$this->load->helper(array('url'));
		$this->load->database();
	}

	public function get(){
		if ($this->uri->segment(4)){
			$offset = 0;
			if ($this->uri->segment(5))
				$offset = $this->uri->segment(5);

			$read = $this->notification_model->get_read($this->uri->segment(4));
			$count = $this->notification_model->get_count($this->uri->segment(4));
			$notification = $this->notification_model->get_by_mem_id($this->uri->segment(4), $offset);
			echo json_encode([
				'status' => true,
				'data' => $notification,
				'count_notif' => $this->config->item('notif_count'),
				'count_data' => $count[0]->count,
				'count_read' => $read[0]->count,
			]);
		}
		else{
			echo json_encode([
				'status' => false,
				'message' => 'User id wajib diisi'
			]);
		}
	}

	public function read(){
		$json = file_get_contents('php://input');
		$obj = json_decode($json, true);

		$err = 0;
		if (empty($obj['notification_id'])){
			$err++;
			echo json_encode([
				'status' => false,
				'message' => 'Notification id wajib diisi'
			]); 
		}

		if (!$err){
			$notification = $this->notification_model->update_status($obj['notification_id']);
			if ($notification){
				echo json_encode([
					'status' => true
				]);
			}
			else{
				echo json_encode([
					'status' => false,
					'message' => 'Gagal baca notif'
				]);
			}
		}
	}

	public function read_all(){
		$json = file_get_contents('php://input');
		$obj = json_decode($json, true);

		$err = 0;
		if (empty($obj['mem_id'])){
			$err++;
			echo json_encode([
				'status' => false,
				'message' => 'Member id wajib diisi'
			]); 
		}

		if (!$err){
			$notification = $this->notification_model->update_all_status($obj['mem_id']);
			if ($notification){
				echo json_encode([
					'status' => true
				]);
			}
			else{
				echo json_encode([
					'status' => false,
					'message' => 'Gagal baca semua notif'
				]);
			}
		}
	}
}
