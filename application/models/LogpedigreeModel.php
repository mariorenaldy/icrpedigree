<?php
class LogpedigreeModel extends CI_Model {
    public function __construct(){
        date_default_timezone_set("Asia/Bangkok");
    }

    public function get_logs($where){
        $this->db->select('*, DATE_FORMAT(logs_pedigree.log_date, "%d-%m-%Y %H:%i:%s") as log_date');
        $this->db->from('logs_pedigree');
        if ($where != null) {
            $this->db->where($where);
        }
        $this->db->join('users','users.use_id = logs_pedigree.log_user');
        $this->db->order_by('logs_pedigree.log_date', 'desc');
        return $this->db->get();
    }

    public function add_log($data){
        $insert = $this->db->insert('logs_pedigree', $data);
        return $insert;
    }
}
