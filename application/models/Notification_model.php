<?php

class Notification_model extends CI_Model{
	function __construct(){
		date_default_timezone_set("Asia/Bangkok");
	}

	function get_max_id(){
		$this->db->select_max('notification_id', 'max');
		$query = $this->db->get('notification');
        return $query->result()[0]->max;
	}

	function add($type, $trans, $member){
		$id = $this->get_max_id() + 1;
		if ($id){
			$data = array(
				'notification_id' => $id,
				'notificationtype_id' => $type,
				'transaction_id' => $trans,
				'mem_id' => $member,
				'is_read' => 0,
				'created_date' => date('Y-m-d H:i:s')
			);
			$insert = $this->db->insert('notification', $data);
			if ($insert)
				return $id;
			else
				return 0;
		}
		else
			return false;
	}

	function update_status($id){
		$data = array(
			'is_read' => 1
		);
		$this->db->where('notification_id', $id);
		$edit = $this->db->update('notification', $data);
		return $edit;
	}

	function update_all_status($member){
		$data = array(
			'is_read' => 1
		);
		$this->db->where('mem_id', $member);
		$edit = $this->db->update('notification', $data);
		return $edit;
	}

	function get_by_mem_id($member, $offset){
		$sql = "SELECT n.notification_id, n.transaction_id, DATE_FORMAT(n.created_date, '%d-%m-%Y') AS date, n.notificationtype_id, nt.title, nt.description, n.is_read FROM notification n, notificationtype nt WHERE n.notificationtype_id = nt.notificationtype_id AND n.mem_id = ".$member." ORDER BY n.created_date DESC LIMIT ".$offset.", ".$this->config->item('notif_count');
		$query = $this->db->query($sql);
        return $query->result();  		
	}

	function get_count($member){
		$sql = "SELECT COUNT(n.is_read) AS count FROM notification n WHERE n.mem_id = ".$member;
		$query = $this->db->query($sql);
        return $query->result();  
	}

	function get_read($member){
		$sql = "SELECT COUNT(n.is_read) AS count FROM notification n WHERE n.mem_id = ".$member." AND n.is_read = 0";
		$query = $this->db->query($sql);
        return $query->result();  
	}

	public function get_members_notif(){
        $member = $this->session->userdata('member_data');
        $sql = "SELECT n.notification_id, n.transaction_id, n.created_date, n.notificationtype_id, nt.title, nt.description, n.is_read FROM notification n, notificationtype nt WHERE n.notificationtype_id = nt.notificationtype_id AND n.mem_id = ".$member['mem_id']." ORDER BY n.created_date DESC";
		$query = $this->db->query($sql);
		return $query->result(); 
    }
}
