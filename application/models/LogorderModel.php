<?php
class LogorderModel extends CI_Model {
    public function __construct(){
        date_default_timezone_set("Asia/Bangkok");
    }

    public function get_logs($where){
        $this->db->select('*');
        $this->db->from('logs_order');
        if ($where != null) {
            $this->db->where($where);
        }
        return $this->db->get();
    }

    public function add_log($data){
        $insert = $this->db->insert('logs_order', $data);
        return $insert;
    }

    public function update_log($data, $where){
        $this->db->set($data);
        $this->db->where($where);
        return $this->db->update('logs_order');
    }
}
