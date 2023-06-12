<?php

class Notificationtype_model extends CI_Model{
	function update($data, $where){
		$this->db->where($where);
		$edit = $this->db->update('notificationtype', $data);
		return $edit;
	}

	function get_by_id($id){
		$sql = "SELECT * FROM notificationtype WHERE notificationtype_id = ".$id;
		$query = $this->db->query($sql);
        return $query->result();  		
	}

	function get_notificationtype($where = null){
		$this->db->select('*');
		if ($where != null) {
            $this->db->where($where);
        }
        $this->db->order_by('notificationtype_id', 'asc');
        return $this->db->get('notificationtype');  		
	}
}
