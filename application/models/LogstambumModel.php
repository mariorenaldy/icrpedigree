<?php
class LogstambumModel extends CI_Model {
    public function __construct(){
        date_default_timezone_set("Asia/Bangkok");
    }

    public function get_logs($where){
        $this->db->select('*, DATE_FORMAT(logs_stambum.log_tanggal, "%d-%m-%Y") as log_tanggal');
        $this->db->from('logs_stambum');
        if ($where != null) {
            $this->db->where($where);
        }
        $this->db->join('members','members.mem_id = logs_stambum.log_member_id');
        $this->db->join('kennels','kennels.ken_id = logs_stambum.log_kennel_id');
        $this->db->join('users','users.use_id = logs_stambum.log_app_user');
        $this->db->join('approval_status','approval_status.stat_id = logs_stambum.log_stat');
        $this->db->order_by('log_tanggal', 'desc');
        return $this->db->get();
    }

    public function add_log($data){
        $insert = $this->db->insert('logs_stambum', $data);
        return $insert;
    }
}
