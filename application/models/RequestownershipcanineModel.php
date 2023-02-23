<?php

class RequestownershipcanineModel extends CI_Model {
    public function __construct(){
        date_default_timezone_set("Asia/Bangkok");
    }

    public function get_requests($where){
        $this->db->select('*, m1.mem_name AS mem_name, k1.ken_name AS ken_name, m2.mem_name AS old_mem_name, k2.ken_name AS old_ken_name');
        if ($where != null) {
            $this->db->where($where);
        }
        $this->db->join('canines','canines.can_id = requests_ownership_canine.req_can_id');
        $this->db->join('members AS m1','m1.mem_id = requests_ownership_canine.req_member_id');
        $this->db->join('kennels AS k1','k1.ken_id = requests_ownership_canine.req_kennel_id AND k1.ken_member_id = m1.mem_id');
        $this->db->join('members AS m2','m2.mem_id = requests_ownership_canine.req_old_member_id');
        $this->db->join('kennels AS k2','k2.ken_id = requests_ownership_canine.req_old_kennel_id AND k2.ken_member_id = m2.mem_id');
        $this->db->join('users','users.use_id = requests_ownership_canine.req_app_user');
        $this->db->join('approval_status','approval_status.stat_id = requests_ownership_canine.req_stat');
        return $this->db->get('requests_ownership_canine');
    }

    public function search_requests($like, $where){
        $this->db->select('*, m1.mem_name AS mem_name, k1.ken_name AS ken_name, m2.mem_name AS old_mem_name, k2.ken_name AS old_ken_name');
        if ($where != null) {
            $this->db->where($where);
        }
        $this->db->group_start();
        if ($like != null) {
            $this->db->or_like($like);
        }
        $this->db->group_end();
        $this->db->join('canines','canines.can_id = requests_ownership_canine.req_can_id');
        $this->db->join('members AS m1','m1.mem_id = requests_ownership_canine.req_member_id');
        $this->db->join('kennels AS k1','k1.ken_id = requests_ownership_canine.req_kennel_id AND k1.ken_member_id = m1.mem_id');
        $this->db->join('members AS m2','m2.mem_id = requests_ownership_canine.req_old_member_id');
        $this->db->join('kennels AS k2','k2.ken_id = requests_ownership_canine.req_old_kennel_id AND k2.ken_member_id = m2.mem_id');
        $this->db->join('users','users.use_id = requests_ownership_canine.req_app_user');
        $this->db->join('approval_status','approval_status.stat_id = requests_ownership_canine.req_stat');
        $this->db->order_by('requests_ownership_canine.req_date', 'desc');
        $this->db->order_by('requests_ownership_canine.req_can_id', 'desc');
        return $this->db->get('requests_ownership_canine');
    }

    public function add_requests($data){
        return $this->db->insert('requests_ownership_canine', $data);
    }

    public function update_requests($data, $where){
        $this->db->set($data);
        $this->db->where($where);
        return $this->db->update('requests_ownership_canine');
    }
}
