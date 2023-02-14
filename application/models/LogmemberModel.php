<?php
class LogmemberModel extends CI_Model {
    public function __construct(){
        date_default_timezone_set("Asia/Bangkok");
    }

    public function get_logs($where){
        $this->db->select('*, DATE_FORMAT(logs_member.log_payment_date, "%d-%m-%Y") as log_payment_date, DATE_FORMAT(logs_member.log_date, "%d-%m-%Y") as log_date, DATE_FORMAT(logs_member.log_app_date, "%d-%m-%Y") as log_app_date, u1.use_name AS user, u2.use_name AS app_user');
        $this->db->from('logs_member');
        if ($where != null) {
            $this->db->where($where);
        }
        $this->db->join('members','members.mem_id = logs_member.log_member_id');
        $this->db->join('users u1','u1.use_id = logs_member.log_user');
        $this->db->join('users u2','u2.use_id = logs_member.log_app_user');
        $this->db->join('approval_status','approval_status.stat_id = logs_member.log_stat');
        $this->db->order_by('logs_member.log_date', 'desc');
        return $this->db->get();
    }

    public function add_log($data){
        return $this->db->insert('logs_member', $data);
    }

    // public function get_log($id){
    //     $this->db->select('*');
    //     $this->db->from('logs_kennel');
    //     $this->db->where('log_kennel_id', $id);
    //     $this->db->where('log_stat', 0);
    //     return $this->db->get();
    // }
}
