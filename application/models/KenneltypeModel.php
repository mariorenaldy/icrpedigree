<?php

class KenneltypeModel extends CI_Model{
	public function __construct(){
	}

	public function get_kennel_types($where = null){
        if ($where != null) {
            $this->db->where($where);
        }
        $this->db->where('ken_type_id > 0');
        $this->db->order_by('ken_type_name');
        return $this->db->get('kennels_type');
    }
}
