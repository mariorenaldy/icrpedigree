<?php
class LogkennelModel extends CI_Model {
    public function __construct(){
        date_default_timezone_set("Asia/Bangkok");
    }

    public function get_logs($where){
        $this->db->select('*');
        $this->db->from('logs_kennel');
        if ($where != null) {
            $this->db->where($where);
        }
        $this->db->join('kennels','kennels.ken_id = logs_kennel.log_kennel_id');
        $this->db->order_by('logs_kennel.log_tanggal', 'desc');
        return $this->db->get();
    }

    public function add_log($data){
        return $this->db->insert('logs_kennel', $data);
    }
}
