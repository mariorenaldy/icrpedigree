<?php

class Notificationtype_model extends CI_Model{
	function edit($id, $title, $desc){
		$data = array(
			'title' => $title,
			'description' => $desc
		);
		$this->db->where('notificationtype_id', $id);
		$edit = $this->db->update('notificationtype', $data);
		return $edit;
	}

	function get_by_id($id){
		$sql = "SELECT nt.notificationtype_id AS notificationtypeid, nt.title, nt.description FROM notificationtype nt WHERE nt.notificationtype_id = ".$id;
		$query = $this->db->query($sql);
        return $query->result();  		
	}
}
