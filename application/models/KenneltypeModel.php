<?php

class KenneltypeModel extends CI_Model{
	public function get_kennel_types($where){
        if ($where) {
            $this->db->where($where);
        }
        $this->db->where('ken_type_id > 0');
        $this->db->order_by('ken_type_name');
        return $this->db->get('kennels_type');
    }
}
