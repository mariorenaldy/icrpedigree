<?php
class StambumModel extends CI_Model {
    public function __construct(){
        date_default_timezone_set("Asia/Bangkok");
    }

    public function record_count() {
        return $this->db->count_all("stambums");
    }

    public function accepted_count() {
        $ignoreStat = array($this->config->item('deleted'), $this->config->item('rejected'));
        $this->db->where_not_in('stb_stat', $ignoreStat);
        $this->db->from("stambums");
        return $this->db->count_all_results();
    }

    public function get_stambum($where, $sort = 'stb_id desc', $offset = 0, $limit = 0, $where_not_in = null){
        $this->db->select('*, DATE_FORMAT(stambums.stb_date_of_birth, "%d-%m-%Y") as stb_date_of_birth, DATE_FORMAT(stambums.stb_app_date, "%d-%m-%Y") as stb_app_date, DATE_FORMAT(stambums.stb_date, "%d-%m-%Y") as stb_date, DATE_FORMAT(stambums.stb_date_of_birth, "%Y-%m-%d") as stb_date_of_birth2, DATE_FORMAT(stambums.stb_app_date, "%Y-%m-%d") as stb_app_date2');
        if ($where != null) {
            $this->db->where($where);
        }
        if ($where_not_in != null) {
            $this->db->where_not_in('stb_stat', $where_not_in);
        }
        $this->db->join('approval_status','approval_status.stat_id = stambums.stb_stat');
        $this->db->join('members','members.mem_id = stambums.stb_member_id');
        $this->db->join('kennels','kennels.ken_id = stambums.stb_kennel_id AND kennels.ken_member_id = members.mem_id', 'left');
        $this->db->join('births','stambums.stb_bir_id = births.bir_id');
        $this->db->join('payment_method','payment_method.pay_id = stambums.stb_pay_id' , 'left');
        $this->db->join('users', 'stambums.stb_app_user = users.use_id');
        $this->db->order_by($sort);
        if ($limit)
            $this->db->limit($limit, $offset);
        return $this->db->get('stambums');
    }

    public function search_stambum($like, $where, $sort = 'stb_id desc', $offset = 0, $limit = 0, $where_not_in = null){
        $this->db->select('*, DATE_FORMAT(stambums.stb_date_of_birth, "%d-%m-%Y") as stb_date_of_birth, DATE_FORMAT(stambums.stb_app_date, "%d-%m-%Y") as stb_app_date, DATE_FORMAT(stambums.stb_date, "%d-%m-%Y") as stb_date, DATE_FORMAT(stambums.stb_date_of_birth, "%Y-%m-%d") as stb_date_of_birth2, DATE_FORMAT(stambums.stb_app_date, "%Y-%m-%d") as stb_app_date2');
        if ($where != null) {
            $this->db->where($where);
        }
        if ($where_not_in != null) {
            $this->db->where_not_in('stb_stat', $where_not_in);
        }
        if ($like != null) {
            $this->db->group_start();
            $this->db->or_like($like);
            $this->db->group_end();
        }
        $this->db->join('approval_status','approval_status.stat_id = stambums.stb_stat');
        $this->db->join('members','members.mem_id = stambums.stb_member_id');
        $this->db->join('kennels','kennels.ken_id = stambums.stb_kennel_id AND kennels.ken_member_id = members.mem_id', 'left');
        $this->db->join('births','stambums.stb_bir_id = births.bir_id');
        $this->db->join('payment_method','payment_method.pay_id = stambums.stb_pay_id' , 'left');
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

    public function update_expired_stambum(){
        $this->db->set('stb_stat', $this->config->item('payment_failed'));
        $this->db->where('stb_pay_due_date <= NOW()');
        $this->db->where('stb_stat', $this->config->item('not_paid'));
        return $this->db->update('stambums');
    }
}
