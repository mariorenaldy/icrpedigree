<?php
class StambumModel extends CI_Model {
    public function __construct(){
        date_default_timezone_set("Asia/Bangkok");
    }

    public function get_stambum($where, $sort = 'stb_id desc', $offset = 0, $limit = 0){
        $this->db->select('*, DATE_FORMAT(stambums.stb_date_of_birth, "%d-%m-%Y") as stb_date_of_birth, DATE_FORMAT(stambums.stb_app_date, "%d-%m-%Y") as stb_app_date, DATE_FORMAT(stambums.stb_date, "%d-%m-%Y") as stb_date');
        if ($where != null) {
            $this->db->where($where);
        }
        $this->db->join('approval_status','approval_status.stat_id = stambums.stb_stat');
        $this->db->join('members','members.mem_id = stambums.stb_member_id');
        $this->db->join('kennels','kennels.ken_id = stambums.stb_kennel_id AND kennels.ken_member_id = members.mem_id');
        $this->db->join('births','stambums.stb_bir_id = births.bir_id');
        $this->db->join('users', 'stambums.stb_app_user = users.use_id');
        $this->db->order_by($sort);
        if ($limit)
            $this->db->limit($limit, $offset);
        return $this->db->get('stambums');
    }

    public function search_stambum($like, $where, $sort = 'stb_id desc', $offset = 0, $limit = 0){
        $this->db->select('*, DATE_FORMAT(stambums.stb_date_of_birth, "%d-%m-%Y") as stb_date_of_birth, DATE_FORMAT(stambums.stb_app_date, "%d-%m-%Y") as stb_app_date, DATE_FORMAT(stambums.stb_date, "%d-%m-%Y") as stb_date');
        if ($where != null) {
            $this->db->where($where);
        }
        if ($like != null) {
            $this->db->group_start();
            $this->db->or_like($like);
            $this->db->group_end();
        }
        $this->db->join('approval_status','approval_status.stat_id = stambums.stb_stat');
        $this->db->join('members','members.mem_id = stambums.stb_member_id');
        $this->db->join('kennels','kennels.ken_id = stambums.stb_kennel_id AND kennels.ken_member_id = members.mem_id');
        $this->db->join('births','stambums.stb_bir_id = births.bir_id');
        $this->db->join('users', 'stambums.stb_app_user = users.use_id');
        $this->db->order_by($sort);
        if ($limit)
            $this->db->limit($limit, $offset);
        return $this->db->get('stambums');
    }

    public function get_count($where){
        $this->db->select('stb_id');
        if ($where != null) {
            $this->db->where($where);
        }
        return count($this->db->get('stambums')->result());
    }

    public function add_stambum($data){
        $this->db->insert('stambums', $data);
        return $this->db->insert_id();
    }

    public function update_stambum($data, $where){
        $this->db->set($data);
        $this->db->where($where);
        return $this->db->update('stambums');
    }
}
