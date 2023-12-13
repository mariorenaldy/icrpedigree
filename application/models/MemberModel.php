<?php

class MemberModel extends CI_Model {
    public function __construct(){
        date_default_timezone_set("Asia/Bangkok");
    }

    public function record_count() {
        return $this->db->count_all("members");
    }

    public function accepted_count() {
        $ignore = array($this->config->item('no_member'));
        $ignoreStat = array($this->config->item('deleted'), $this->config->item('rejected'));
        $this->db->where_not_in('mem_id', $ignore);
        $this->db->where_not_in('mem_stat', $ignoreStat);
        $this->db->from("members");
        return $this->db->count_all_results();
    }

    public function get_members($where, $sort = 'mem_id desc', $offset = 0, $limit = 0){
        $this->db->select('*, members.mem_created_at as created_date, DATE_FORMAT(members.mem_created_at, "%d-%m-%Y") as mem_created_at, DATE_FORMAT(members.mem_app_date, "%d-%m-%Y") as mem_app_date, DATE_FORMAT(members.mem_date, "%d-%m-%Y") as mem_date, DATE_FORMAT(members.mem_app_date, "%Y-%m-%d %H:%i:%s") AS mem_app_date2, DATE_FORMAT(members.last_login, "%d-%m-%Y") as last_login');
        if ($where != null) {
            $this->db->where($where);
        }
        $this->db->from('members');
        $this->db->join('kennels','kennels.ken_member_id = members.mem_id', 'left');
        $this->db->join('payment_method','payment_method.pay_id = members.mem_pay_id' , 'left');
        $this->db->join('approval_status','approval_status.stat_id = members.mem_stat');
        $this->db->join('users','users.use_id = members.mem_app_user');
        $this->db->order_by($sort);
        if ($limit)
            $this->db->limit($limit, $offset);
        return $this->db->get();
    }

    public function get_member_type($id){
        $this->db->select('mem_type');
        $this->db->where('mem_id', $id);
        $this->db->from('members');
        return $this->db->get();
    }

    public function update_expired_members(){
        $this->db->set('mem_type', $this->config->item('free_member'));
        $this->db->set('mem_payment_date', null);
        $this->db->set('mem_pay_photo', null);
        $this->db->where('mem_payment_date < NOW()');
        $this->db->where('mem_type', $this->config->item('pro_member'));
        return $this->db->update('members');
    }

    public function search_members($like, $where, $sort = 'mem_id desc', $offset = 0, $limit = 0){
        $this->db->select('*, members.mem_created_at as created_date, DATE_FORMAT(members.mem_created_at, "%d-%m-%Y") as mem_created_at, DATE_FORMAT(members.mem_app_date, "%d-%m-%Y") as mem_app_date, DATE_FORMAT(members.mem_date, "%d-%m-%Y") as mem_date, DATE_FORMAT(members.mem_app_date, "%Y-%m-%d %H:%i:%s") AS mem_app_date2, DATE_FORMAT(members.last_login, "%d-%m-%Y") as last_login');
        $this->db->from('members');
        if ($where != null) {
            $this->db->where($where);
        }
        if ($like != null) {
            $this->db->group_start();
            $this->db->or_like($like);
            $this->db->group_end();
        }
        $this->db->join('kennels','members.mem_id = kennels.ken_member_id', 'left');
        $this->db->join('payment_method','payment_method.pay_id = members.mem_pay_id' , 'left');
        $this->db->join('approval_status','approval_status.stat_id = members.mem_stat');
        $this->db->join('users','members.mem_app_user = users.use_id');
        $this->db->order_by($sort);
        if ($limit)
            $this->db->limit($limit, $offset);
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

    public function getMonthlyData($year = null){
        $this->db->select("DATE_FORMAT(mem_created_at, '%b %Y') as month, COUNT(mem_id) as total_member");
        $this->db->from('members');
        if($year == null){
            $this->db->where('YEAR(mem_created_at) = YEAR(CURDATE())');
        }
        else{
            $this->db->where('YEAR(mem_created_at) = '.$year);
        }
        $this->db->group_by("DATE_FORMAT(mem_created_at, '%b %Y')");
        $this->db->order_by("mem_created_at", 'ASC');
        $ignore = array($this->config->item('deleted'), $this->config->item('rejected'));
        $this->db->where_not_in('mem_stat', $ignore);
        $ignoreID = array($this->config->item('no_member'));
        $this->db->where_not_in('mem_id', $ignoreID);

        $query = $this->db->get();
        
        return $query->result();
    }

    public function get_cities(){
        $this->db->select('*');
        $this->db->from('city');
        return $this->db->get();
    }
}
