<?php
class LogcanineModel extends CI_Model {
    public function __construct(){
        date_default_timezone_set("Asia/Bangkok");
    }

    public function get_logs($where){
        $this->db->select('*, DATE_FORMAT(logs_canine.log_date_of_birth, "%d-%m-%Y") as log_date_of_birth, DATE_FORMAT(logs_canine.log_date, "%d-%m-%Y %H:%i:%s") as log_date, DATE_FORMAT(logs_canine.log_app_date, "%d-%m-%Y") as log_app_date, u1.use_username AS user, u2.use_username AS app_user');
        $this->db->from('logs_canine');
        if ($where != null) {
            $this->db->where($where);
        }
        $this->db->join('members','members.mem_id = logs_canine.log_member_id');
        $this->db->join('kennels','kennels.ken_id = logs_canine.log_kennel_id');
        $this->db->join('users u1','u1.use_id = logs_canine.log_user');
        $this->db->join('users u2','u2.use_id = logs_canine.log_app_user');
        $this->db->join('approval_status','approval_status.stat_id = logs_canine.log_stat');
        $this->db->order_by('logs_canine.log_date', 'desc');
        return $this->db->get();
    }

    public function add_log($data){
        $insert = $this->db->insert('logs_canine', $data);
        return $insert;
    }

    public function update_log($data, $where){
        $this->db->set($data);
        $this->db->where($where);
        return $this->db->update('logs_canine');
    }
}
