<?php

class MemberModel extends CI_Model {
    public function __construct(){
        date_default_timezone_set("Asia/Bangkok");
    }

    public function record_count() {
        return $this->db->count_all("members");
    }

    // public function get_all_members($where) {
    //     $this->db->select('*');
    //     if ($where != null) {
    //         $this->db->where($where);
    //     }
    //     $this->db->from('members');
    //     $this->db->order_by('mem_id', 'desc');
    //     return $this->db->get();
    // }

    public function get_members($where){
        $this->db->select('*, DATE_FORMAT(members.mem_created_at, "%d-%m-%Y") as mem_created_at, DATE_FORMAT(members.mem_app_date, "%d-%m-%Y") as mem_app_date');
        if ($where != null) {
            $this->db->where($where);
        }
        $this->db->from('members');
        $this->db->join('kennels','members.mem_id = kennels.ken_member_id');
        $this->db->join('users','members.mem_app_user = users.use_id');
        $this->db->order_by('mem_id', 'desc');
        $this->db->limit($this->config->item('backend_member_count'), 0);
        return $this->db->get();
    }

    public function search_members($like, $where){
        $this->db->select('*, DATE_FORMAT(members.mem_created_at, "%d-%m-%Y") as mem_created_at, DATE_FORMAT(members.mem_app_date, "%d-%m-%Y") as mem_app_date');
        $this->db->from('members');
        if ($where != null) {
            $this->db->where($where);
        }
        $this->db->group_start();
        if ($like != null) {
            $this->db->or_like($like);
        }
        $this->db->group_end();
        $this->db->join('kennels','members.mem_id = kennels.ken_member_id');
        $this->db->join('users','members.mem_app_user = users.use_id');
        $this->db->order_by('mem_id', 'desc');
        return $this->db->get();
    }

    // public function daftar_users($username){
    //     $this->db->select('*');
    //     if ($username != null) {
    //         $this->db->where('mem_username', $username);
    //     }
    //     $this->db->from('members');
    //     return $this->db->get();
    // }

    // public function get_ktp($ktp){
    //     $this->db->select('*');
    //     if ($ktp != null ) {
    //         $this->db->where('mem_ktp', $ktp);
    //     }
    //     $this->db->from('members');
    //     return $this->db->get();
    // }

    // public function get_ktp_update($ktp, $id){
    //     $this->db->select('*');
    //     if ($ktp != null && $id != null) {
    //         $this->db->where('mem_ktp', $ktp);
    //         $this->db->where('mem_id <> ', $id);
    //     }
    //     $this->db->from('members');
    //     return $this->db->get();
    // }

    public function add_members($data){
        return $this->db->insert('members', $data);
    }

    public function update_members($data, $where){
        $this->db->set($data);
        $this->db->where($where);
        return $this->db->update('members');
    }
}
