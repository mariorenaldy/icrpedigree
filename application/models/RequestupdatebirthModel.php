<?php

class RequestupdatebirthModel extends CI_Model {
    public function __construct(){
        date_default_timezone_set("Asia/Bangkok");
    }

    public function get_requests($where, $offset = 0, $limit = 0){
        $this->db->select('*, DATE_FORMAT(req_date_of_birth, "%d-%m-%Y") AS req_date_of_birth, DATE_FORMAT(req_old_date_of_birth, "%d-%m-%Y") AS req_old_date_of_birth');
        if ($where != null) {
            $this->db->where($where);
        }
        $this->db->join('births','births.bir_id = requests_update_birth.req_bir_id');
        $this->db->join('studs','studs.stu_id = births.bir_stu_id');
        $this->db->join('members','members.mem_id = requests_update_birth.req_member_id AND members.mem_id = studs.stu_partner_id');
        $this->db->join('kennels','kennels.ken_member_id = members.mem_id');
        $this->db->join('canines can_sire','can_sire.can_id = studs.stu_sire_id');
        $this->db->join('canines can_dam','can_dam.can_id = studs.stu_dam_id');
        $this->db->join('users','users.use_id = requests_update_birth.req_app_user');
        $this->db->join('approval_status','approval_status.stat_id = requests_update_birth.req_stat');
        $this->db->order_by('requests_update_birth.req_id desc');
        if ($limit)
            $this->db->limit($limit, $offset);
        return $this->db->get('requests_update_birth');
    }

    public function search_requests($like, $where, $offset = 0, $limit = 0){
        $this->db->select('*, DATE_FORMAT(req_date_of_birth, "%d-%m-%Y") AS req_date_of_birth, DATE_FORMAT(req_old_date_of_birth, "%d-%m-%Y") AS req_old_date_of_birth');
        if ($where != null) {
            $this->db->where($where);
        }
        $this->db->group_start();
        if ($like != null) {
            $this->db->or_like($like);
        }
        $this->db->group_end();
        $this->db->join('births','births.bir_id = requests_update_birth.req_bir_id');
        $this->db->join('studs','studs.stu_id = births.bir_stu_id');
        $this->db->join('members','members.mem_id = requests_update_birth.req_member_id AND members.mem_id = studs.stu_partner_id');
        $this->db->join('kennels','kennels.ken_member_id = members.mem_id');
        $this->db->join('canines can_sire','can_sire.can_id = studs.stu_sire_id');
        $this->db->join('canines can_dam','can_dam.can_id = studs.stu_dam_id');
        $this->db->join('users','users.use_id = requests_update_birth.req_app_user');
        $this->db->join('approval_status','approval_status.stat_id = requests_update_birth.req_stat');
        $this->db->order_by('requests_update_birth.req_id desc');
        if ($limit)
            $this->db->limit($limit, $offset);
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
