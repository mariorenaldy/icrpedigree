<?php

class RequestcertificateModel extends CI_Model {
    public function __construct(){
        date_default_timezone_set("Asia/Bangkok");
    }

    public function get_requests($where = null, $sort = 'req_id desc', $offset = 0, $limit = 0){
        $this->db->select('*, DATE_FORMAT(com_created_at, "%d-%m-%Y %H:%i:%s") AS com_created_at, DATE_FORMAT(req_created_at, "%d-%m-%Y %H:%i:%s") AS req_created_at, DATE_FORMAT(req_updated_at, "%d-%m-%Y %H:%i:%s") AS req_updated_at, DATE_FORMAT(req_arrived_date, "%d-%m-%Y %H:%i:%s") AS req_arrived_date');
        if ($where != null) {
            $this->db->where($where);
        }
        $this->db->join('canines','canines.can_id = requests_certificate.req_can_id');
        $this->db->join('members','members.mem_id = requests_certificate.req_mem_id');
        $this->db->join('city','requests_certificate.req_city_id = city.city_id');
        $this->db->join('users','users.use_id = requests_certificate.req_updated_by', 'left');
        $this->db->join('certificate_status','certificate_status.cert_stat_id = requests_certificate.req_stat_id');
        $this->db->join('certificate_complain','requests_certificate.req_id = certificate_complain.com_req_id', 'left');
        $this->db->order_by($sort);
        if ($limit)
            $this->db->limit($limit, $offset);
        return $this->db->get('requests_certificate');
    }

    public function get_processed_requests($where = null, $where_in = null, $sort = 'req_id desc', $offset = 0, $limit = 0){
        $this->db->select('*, DATE_FORMAT(com_created_at, "%d-%m-%Y %H:%i:%s") AS com_created_at, DATE_FORMAT(req_created_at, "%d-%m-%Y %H:%i:%s") AS req_created_at, DATE_FORMAT(req_updated_at, "%d-%m-%Y %H:%i:%s") AS req_updated_at, DATE_FORMAT(req_arrived_date, "%d-%m-%Y %H:%i:%s") AS req_arrived_date');
        if ($where != null) {
            $this->db->where($where);
        }
        if ($where_in != null) {
            $this->db->where_in('req_stat_id', $where_in);
        }
        else{
            $this->db->where('req_stat_id != '.$this->config->item('cert_cancelled'));
        }
        $this->db->join('canines','canines.can_id = requests_certificate.req_can_id');
        $this->db->join('members','members.mem_id = requests_certificate.req_mem_id');
        $this->db->join('city','requests_certificate.req_city_id = city.city_id');
        $this->db->join('users','users.use_id = requests_certificate.req_updated_by', 'left');
        $this->db->join('certificate_status','certificate_status.cert_stat_id = requests_certificate.req_stat_id');
        $this->db->join('certificate_complain','requests_certificate.req_id = certificate_complain.com_req_id', 'left');
        $this->db->order_by($sort);
        if ($limit)
            $this->db->limit($limit, $offset);
        return $this->db->get('requests_certificate');
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
        $this->db->join('canines','canines.can_id = requests_certificate.req_can_id');
        $this->db->join('members AS m1','m1.mem_id = requests_certificate.req_member_id');
        $this->db->join('kennels AS k1','k1.ken_id = requests_certificate.req_kennel_id AND k1.ken_member_id = m1.mem_id', 'left');
        $this->db->join('members AS m2','m2.mem_id = requests_certificate.req_old_member_id');
        $this->db->join('kennels AS k2','k2.ken_id = requests_certificate.req_old_kennel_id AND k2.ken_member_id = m2.mem_id', 'left');
        $this->db->join('city','requests_certificate.req_city_id = city.city_id');
        $this->db->join('users','users.use_id = requests_certificate.req_app_user');
        $this->db->join('approval_status','approval_status.stat_id = requests_certificate.req_stat');
        $this->db->order_by('requests_certificate.req_id DESC');
        if ($limit)
            $this->db->limit($limit, $offset);
        return $this->db->get('requests_certificate');
    }

    public function add_requests($data){
        return $this->db->insert('requests_certificate', $data);
    }

    public function update_requests($data, $where){
        $this->db->set($data);
        $this->db->where($where);
        return $this->db->update('requests_certificate');
    }
}
