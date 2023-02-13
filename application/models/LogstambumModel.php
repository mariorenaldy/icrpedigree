<?php
class logstambumModel extends CI_Model {
    public function __construct(){
        date_default_timezone_set("Asia/Bangkok");
    }

    public function get_logs($where){
        $this->db->select('*, DATE_FORMAT(logs_stambum.log_date, "%d-%m-%Y") as log_date');
        $this->db->from('logs_birth');
        if ($where != null) {
            $this->db->where($where);
        }
        $this->db->join('births','births.bir_id = logs_stambum.log_bir_id');
        $this->db->join('studs','studs.stu_id = births.bir_stu_id');
        $this->db->join('members','members.mem_id = studs.stu_member_id');
        $this->db->join('kennels','kennels.ken_member_id = members.mem_id AND kennels.ken_member_id = studs.stu_member_id');
        $this->db->join('users','users.use_id = logs_birth.log_app_user');
        $this->db->join('approval_status','approval_status.stat_id = logs_birth.log_stat');
        $this->db->order_by('logs_stambum.log_date', 'desc');
        return $this->db->get();
    }

    public function add_log($data){
        $insert = $this->db->insert('logs_stambum', $data);
        return $insert;
    }
}
