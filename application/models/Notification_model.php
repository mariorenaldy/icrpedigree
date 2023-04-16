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

	function add($type, $trans, $member, $note = ""){
		$id = $this->get_max_id() + 1;
		if ($id){
			$data = array(
				'notification_id' => $id,
				'notificationtype_id' => $type,
				'transaction_id' => $trans,
				'mem_id' => $member,
				'created_date' => date('Y-m-d H:i:s'),
				'note' => $note,
			);
			$insert = $this->db->insert('notification', $data);
			return $insert;
		}
		else
			return false;
	}

	function get_by_mem_id($member, $offset = 0, $limit = 1){
		$sql = "SELECT n.notification_id, n.transaction_id, DATE_FORMAT(n.created_date, '%d-%m-%Y') AS date, n.notificationtype_id, nt.title, nt.description, n.note FROM notification n, notificationtype nt WHERE n.notificationtype_id = nt.notificationtype_id AND n.mem_id = ".$member." ORDER BY n.created_date DESC";
		if ($limit) 
			$sql .= " LIMIT ".$offset.", ".$this->config->item('notif_count');
		$query = $this->db->query($sql);
        return $query->result();  		
	}

	function get_count($member){
		$sql = "SELECT COUNT(notification_id) AS count FROM notification WHERE mem_id = ".$member;
		$query = $this->db->query($sql);
        return $query->row();  
	}

    function delete($where){
        $this->db->where($where);
        return $this->db->delete('notification');
    }
}
