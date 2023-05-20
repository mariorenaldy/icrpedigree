<?php
class LogpetModel extends CI_Model {
    public function __construct(){
        date_default_timezone_set("Asia/Bangkok");
    }

    public function get_logs($where){
        $this->db->select('*');
        $this->db->from('logs_pet');
        if ($where != null) {
            $this->db->where($where);
        }
        $this->db->order_by('log_id', 'desc');
        return $this->db->get();
    }

    public function add_log($data){
        $insert = $this->db->insert('logs_pet', $data);
        return $insert;
    }
}
