<?php
class LogkennelModel extends CI_Model {
    public function __construct(){
        date_default_timezone_set("Asia/Bangkok");
    }

    public function get_logs($where){
        $this->db->select('*, DATE_FORMAT(logs_kennel.log_date, "%d-%m-%Y %H:%i:%s") as log_date');
        $this->db->from('logs_kennel');
        if ($where != null) {
            $this->db->where($where);
        }
        $this->db->join('kennels','kennels.ken_id = logs_kennel.log_kennel_id');
        $this->db->join('kennels_type','kennels_type.ken_type_id = logs_kennel.log_kennel_type_id');
        $this->db->order_by('logs_kennel.log_date', 'desc');
        return $this->db->get();
    }

    public function add_log($data){
        return $this->db->insert('logs_kennel', $data);
    }
}
