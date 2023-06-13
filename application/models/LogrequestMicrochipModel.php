<?php
class LogrequestMicrochipModel extends CI_Model {
    public function __construct(){
        date_default_timezone_set("Asia/Bangkok");
    }

    public function get_logs($where){
        $this->db->select('*, DATE_FORMAT(logs_req_microchip.log_datetime, "%d-%m-%Y %H:%i:%s") as log_datetime, DATE_FORMAT(logs_req_microchip.log_created_at, "%d-%m-%Y %H:%i:%s") as log_created_at, DATE_FORMAT(logs_req_microchip.log_updated_at, "%d-%m-%Y %H:%i:%s") as log_date, u1.use_username AS user');
        $this->db->from('logs_req_microchip');
        if ($where != null) {
            $this->db->where($where);
        }
        $this->db->join('users u1','u1.use_id = logs_req_microchip.log_updated_by');
        $this->db->join('approval_status','approval_status.stat_id = logs_req_microchip.log_stat_id');
        $this->db->join('members', 'logs_req_microchip.log_mem_id = members.mem_id');
        $this->db->join('canines', 'logs_req_microchip.log_can_id = canines.can_id');
        $this->db->order_by('logs_req_microchip.log_updated_at', 'desc');
        return $this->db->get();
    }

    public function add_log($data){
        $insert = $this->db->insert('logs_req_microchip', $data);
        return $insert;
    }

    public function update_log($data, $where){
        $this->db->set($data);
        $this->db->where($where);
        return $this->db->update('logs_req_microchip');
    }
}
