<?php
class MicrochipStatusModel extends CI_Model {
    public function __construct(){
        date_default_timezone_set("Asia/Bangkok");
    }

    public function get_status($where = null){
        $this->db->select('*');
        if ($where != null) {
            $this->db->where($where);
        }
        return $this->db->get('microchip_status');
    }

    public function add_status($data){
        return $this->db->insert('microchip_status', $data);
    }
}
