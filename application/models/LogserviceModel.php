<?php
class LogserviceModel extends CI_Model {
    public function __construct(){
        date_default_timezone_set("Asia/Bangkok");
    }

    public function get_logs($where){
        $this->db->select('*, DATE_FORMAT(logs_service.log_service_updated_at, "%d-%m-%Y %H:%i:%s") as log_date, u1.use_username AS user');
        $this->db->from('logs_service');
        if ($where != null) {
            $this->db->where($where);
        }
        $this->db->join('users u1','u1.use_id = logs_service.log_service_updated_user');
        $this->db->join('approval_status','approval_status.stat_id = logs_service.log_stat');
        $this->db->order_by('logs_service.log_service_updated_at', 'desc');
        return $this->db->get();
    }

    public function add_log($data){
        $insert = $this->db->insert('logs_service', $data);
        return $insert;
    }
}
