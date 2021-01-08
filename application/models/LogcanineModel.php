<?php
class LogcanineModel extends CI_Model {
    public function __construct(){
        parent::__construct();
    }

    public function get_logs($where = null){
        $this->db->select('*, DATE_FORMAT(logs_canine.log_tanggal, "%d-%m-%Y") as log_tanggal');
        $this->db->from('logs_canine');
        if ($where != null) {
            $this->db->where($where);
        }
        $this->db->order_by('log_tanggal', 'desc');
        return $this->db->get();
    }

    public function add_log($data){
        $insert = $this->db->insert('logs_canine', $data);
        return $insert;
    }
}
