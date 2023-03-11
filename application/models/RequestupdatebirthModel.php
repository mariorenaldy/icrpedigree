<?php

class RequestupdatebirthModel extends CI_Model {
    public function __construct(){
        date_default_timezone_set("Asia/Bangkok");
    }

    public function get_requests($where){
        $this->db->select('*, DATE_FORMAT(req_date, "%d-%m-%Y") AS req_date');
        if ($where != null) {
            $this->db->where($where);
        }
        $this->db->join('studs','studs.stu_id = requests_update_birth.bir_stu_id');
        $this->db->join('members','members.mem_id = requests_update_birth.bir_member_id AND members.mem_id = studs.stu_partner_id');
        $this->db->join('kennels','kennels.ken_member_id = members.mem_id');
        $this->db->join('canines c1','c1.can_id = studs.stu_sire_id');
        $this->db->join('canines c2','c2.can_id = studs.stu_dam_id');
        $this->db->join('users','users.use_id = requests_update_birth.bir_app_user');
        $this->db->join('approval_status','approval_status.stat_id = requests_update_birth.bir_stat');
        $this->db->order_by('requests_update_birth.req_id desc');
        return $this->db->get('requests_update_birth');
    }

    public function add_requests($data){
        return $this->db->insert('requests_update_birth', $data);
    }

    public function update_requests($data, $where){
        $this->db->set($data);
        $this->db->where($where);
        return $this->db->update('requests_update_birth');
    }
}
