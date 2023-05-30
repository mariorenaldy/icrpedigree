<?php

class RequestmemberModel extends CI_Model {
    public function __construct(){
        date_default_timezone_set("Asia/Bangkok");
    }

    public function get_requests($where){
        $this->db->select('*, DATE_FORMAT(req_date, "%d-%m-%Y") AS req_date');
        if ($where != null) {
            $this->db->where($where);
        }
        $this->db->join('members','members.mem_id = requests_member.req_member_id');
        $this->db->join('kennels','kennels.ken_id = requests_member.req_kennel_id AND kennels.ken_member_id = members.mem_id');
        $this->db->join('users','users.use_id = requests_member.req_app_user');
        $this->db->join('approval_status','approval_status.stat_id = requests_member.req_stat');
        $this->db->join('kennels_type','kennels.ken_type_id = kennels_type.ken_type_id');
        $this->db->order_by('requests_member.req_id desc');
        return $this->db->get('requests_member');
    }

    public function search_requests($like, $where, $offset = 0, $limit = 0){
        $this->db->select('*, DATE_FORMAT(req_date, "%d-%m-%Y") AS req_date');
        if ($where != null) {
            $this->db->where($where);
        }
        if ($like != null) {
            $this->db->group_start();
            $this->db->or_like($like);
            $this->db->group_end();
        }
        $this->db->join('members','members.mem_id = requests_member.req_member_id');
        $this->db->join('kennels','kennels.ken_id = requests_member.req_kennel_id AND kennels.ken_member_id = members.mem_id');
        $this->db->join('users','users.use_id = requests_member.req_app_user');
        $this->db->join('approval_status','approval_status.stat_id = requests_member.req_stat');
        $this->db->join('kennels_type','kennels.ken_type_id = kennels_type.ken_type_id');
        $this->db->order_by('requests_member.req_id desc');
        return $this->db->get('requests_member');
    }

    public function add_requests($data){
        return $this->db->insert('requests_member', $data);
    }

    public function update_requests($data, $where){
        $this->db->set($data);
        $this->db->where($where);
        return $this->db->update('requests_member');
    }
}
