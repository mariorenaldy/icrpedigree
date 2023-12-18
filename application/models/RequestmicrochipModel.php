<?php

class RequestmicrochipModel extends CI_Model {
    public function __construct(){
        date_default_timezone_set("Asia/Bangkok");
    }

    public function get_requests($where = null, $sort = 'req_id desc', $offset = 0, $limit = 0, $where_not_in = null){
        $this->db->select('*, DATE_FORMAT(com_created_at, "%d-%m-%Y %H:%i:%s") AS com_created_at, DATE_FORMAT(req_created_at, "%d-%m-%Y %H:%i:%s") AS req_created_at, DATE_FORMAT(req_updated_at, "%d-%m-%Y %H:%i:%s") AS req_updated_at, DATE_FORMAT(req_datetime, "%d-%m-%Y %H:%i:%s") AS req_datetime');
        if ($where != null) {
            $this->db->where($where);
        }
        if ($where_not_in != null) {
            $this->db->where_not_in('req_stat_id', $where_not_in);
        }
        $this->db->join('canines','canines.can_id = requests_microchip.req_can_id');
        $this->db->join('members','members.mem_id = requests_microchip.req_mem_id');
        $this->db->join('users','users.use_id = requests_microchip.req_updated_by', 'left');
        $this->db->join('payment_method','payment_method.pay_id = requests_microchip.req_pay_id' , 'left');
        $this->db->join('microchip_status','microchip_status.micro_stat_id = requests_microchip.req_stat_id');
        $this->db->join('microchip_complain','requests_microchip.req_id = microchip_complain.com_req_id', 'left');
        $this->db->order_by($sort);
        if ($limit)
            $this->db->limit($limit, $offset);
        return $this->db->get('requests_microchip');
    }

    public function get_processed_requests($where = null){
        $this->db->select('*');
        if ($where != null) {
            $this->db->where($where);
        }
        $stats = array($this->config->item('micro_processed'), $this->config->item('micro_accepted'), $this->config->item('micro_not_paid'));
        $this->db->where_in('req_stat_id', $stats);
        return $this->db->get('requests_microchip');
    }

    public function search_requests($like, $where, $offset = 0, $limit = 0){
        $this->db->select('*, DATE_FORMAT(req_date, "%d-%m-%Y") AS req_date, m1.mem_name AS mem_name, k1.ken_name AS ken_name, m2.mem_name AS old_mem_name, k2.ken_name AS old_ken_name');
        if ($where != null) {
            $this->db->where($where);
        }
        if ($like != null) {
            $this->db->group_start();
            $this->db->or_like($like);
            $this->db->group_end();
        }
        $this->db->join('canines','canines.can_id = requests_microchip.req_can_id');
        $this->db->join('members AS m1','m1.mem_id = requests_microchip.req_member_id');
        $this->db->join('kennels AS k1','k1.ken_id = requests_microchip.req_kennel_id AND k1.ken_member_id = m1.mem_id', 'left');
        $this->db->join('members AS m2','m2.mem_id = requests_microchip.req_old_member_id');
        $this->db->join('kennels AS k2','k2.ken_id = requests_microchip.req_old_kennel_id AND k2.ken_member_id = m2.mem_id', 'left');
        $this->db->join('users','users.use_id = requests_microchip.req_app_user');
        $this->db->join('microchip_status','microchip_status.micro_stat_id = requests_microchip.req_stat_id');
        $this->db->order_by('requests_microchip.req_id DESC');
        if ($limit)
            $this->db->limit($limit, $offset);
        return $this->db->get('requests_microchip');
    }

    public function add_requests($data){
        return $this->db->insert('requests_microchip', $data);
    }

    public function update_requests($data, $where){
        $this->db->set($data);
        $this->db->where($where);
        return $this->db->update('requests_microchip');
    }

    public function update_expired_requests(){
        $this->db->set('req_stat_id', $this->config->item('micro_payment_failed'));
        $this->db->where('req_pay_due_date <= NOW()');
        $this->db->where('req_stat_id', $this->config->item('micro_not_paid'));
        return $this->db->update('requests_microchip');
    }
}
