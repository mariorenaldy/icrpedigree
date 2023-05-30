<?php

class RequestexportModel extends CI_Model {
    public function __construct(){
        date_default_timezone_set("Asia/Bangkok");
    }

    public function get_requests($where, $offset = 0, $limit = 0){
        $this->db->select('*, DATE_FORMAT(req_date, "%d-%m-%Y") AS req_date');
        if ($where != null) {
            $this->db->where($where);
        }
        $this->db->join('members','members.mem_id = requests_export.req_member_id');
        $this->db->join('kennels','kennels.ken_member_id = members.mem_id');
        $this->db->join('users','users.use_id = requests_export.req_app_user');
        $this->db->join('approval_status','approval_status.stat_id = requests_export.req_stat');
        $this->db->order_by('requests_export.req_id desc');
        if ($limit)
            $this->db->limit($limit, $offset);
        return $this->db->get('requests_export');
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
        $this->db->join('members','members.mem_id = requests_export.req_member_id');
        $this->db->join('kennels','kennels.ken_member_id = members.mem_id');
        $this->db->join('users','users.use_id = requests_export.req_app_user');
        $this->db->join('approval_status','approval_status.stat_id = requests_export.req_stat');
        $this->db->order_by('requests_export.req_id desc');
        if ($limit)
            $this->db->limit($limit, $offset);
        return $this->db->get('requests_export');
    }

    public function add_requests($data){
        return $this->db->insert('requests_export', $data);
    }

    public function update_requests($data, $where){
        $this->db->set($data);
        $this->db->where($where);
        return $this->db->update('requests_export');
    }
}
