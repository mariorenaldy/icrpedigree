<?php
class LogbirthModel extends CI_Model {
    public function __construct(){
        date_default_timezone_set("Asia/Bangkok");
    }

    public function get_logs($where){
        $this->db->select('*, DATE_FORMAT(logs_birth.log_date_of_birth, "%d-%m-%Y") as log_date_of_birth, , DATE_FORMAT(logs_birth.log_date, "%d-%m-%Y") as log_date');
        $this->db->from('logs_birth');
        if ($where != null) {
            $this->db->where($where);
        }
        $this->db->join('studs','studs.stu_id = logs_birth.log_stu_id');
        $this->db->join('members','members.mem_id = studs.stu_partner_id AND members.mem_id = logs_birth.log_member_id');
        $this->db->join('kennels','kennels.ken_member_id = members.mem_id');
        $this->db->join('canines','canines.can_id = studs.stu_dam_id');
        $this->db->join('users u1','u1.use_id = logs_birth.log_user');
        $this->db->join('users u2','u2.use_id = logs_birth.log_app_user');
        $this->db->join('approval_status','approval_status.stat_id = logs_birth.log_stat');
        $this->db->order_by('logs_birth.log_date', 'desc');
        return $this->db->get();
    }

    public function add_log($data){
        $insert = $this->db->insert('logs_birth', $data);
        return $insert;
    }
}
