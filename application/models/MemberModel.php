<?php

class MemberModel extends CI_Model {
    public function __construct(){
        date_default_timezone_set("Asia/Bangkok");
    }

    public function record_count() {
        return $this->db->count_all("members");
    }

    public function get_members($where, $sort = 'mem_id'){
        $this->db->select('*, DATE_FORMAT(members.mem_created_at, "%d-%m-%Y") as mem_created_at, DATE_FORMAT(members.mem_app_date, "%d-%m-%Y") as mem_app_date, members.mem_app_date AS mem_app_date2');
        if ($where != null) {
            $this->db->where($where);
        }
        $this->db->where('kennels.ken_stat', $this->config->item('accepted'));
        $this->db->from('members');
        $this->db->join('kennels','kennels.ken_member_id = members.mem_id');
        $this->db->join('users','users.use_id = members.mem_app_user');
        $this->db->order_by($sort, 'desc');
        $this->db->limit($this->config->item('backend_member_count'), 0);
        return $this->db->get();
    }

    public function search_members($like, $where, $sort = 'mem_id'){
        $this->db->select('*, DATE_FORMAT(members.mem_created_at, "%d-%m-%Y") as mem_created_at, DATE_FORMAT(members.mem_app_date, "%d-%m-%Y") as mem_app_date, members.mem_app_date AS mem_app_date2');
        $this->db->from('members');
        if ($where != null) {
            $this->db->where($where);
        }
        $this->db->where('kennels.ken_stat', $this->config->item('accepted'));
        $this->db->group_start();
        if ($like != null) {
            $this->db->or_like($like);
        }
        $this->db->group_end();
        $this->db->join('kennels','members.mem_id = kennels.ken_member_id');
        $this->db->join('users','members.mem_app_user = users.use_id');
        $this->db->order_by($sort, 'desc');
        return $this->db->get();
    }

    public function add_members($data){
        return $this->db->insert('members', $data);
    }

    public function update_members($data, $where){
        $this->db->set($data);
        $this->db->where($where);
        return $this->db->update('members');
    }

    public function check_for_duplicate($id, $field, $val){
        $sql = "select mem_id from members where ".$field." = '".$val."' AND mem_stat IN (".$this->config->item('saved').", ".$this->config->item('accepted').")";
        if ($id){
            $sql .= ' AND mem_id <> '.$id;
        }
        $query = $this->db->query($sql);
        return count($query->result());
    }
}
