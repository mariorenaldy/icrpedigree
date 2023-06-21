<?php
class logstambumModel extends CI_Model {
    public function __construct(){
        date_default_timezone_set("Asia/Bangkok");
    }

    public function get_logs($where){
        $this->db->select('*, DATE_FORMAT(logs_stambum.log_date, "%d-%m-%Y %H:%i:%s") as log_date');
        $this->db->from('logs_stambum');
        if ($where != null) {
            $this->db->where($where);
        }
        $this->db->join('members','members.mem_id = logs_stambum.log_member_id');
        $this->db->join('kennels','kennels.ken_id = logs_stambum.log_kennel_id', 'left');
        $this->db->join('users','users.use_id = logs_stambum.log_app_user');
        $this->db->join('approval_status','approval_status.stat_id = logs_stambum.log_stat');
        $this->db->order_by('logs_stambum.log_date', 'desc');
        return $this->db->get();
    }

    public function add_log($data){
        $insert = $this->db->insert('logs_stambum', $data);
        return $insert;
    }

    public function update_log($data, $where){
        $this->db->set($data);
        $this->db->where($where);
        return $this->db->update('logs_stambum');
    }
}
