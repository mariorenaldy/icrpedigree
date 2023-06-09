<?php

class OrderModel extends CI_Model {
    public function __construct(){
        date_default_timezone_set("Asia/Bangkok");
    }

    public function record_count() {
        return $this->db->count_all("orders");
    }

    public function get_orders($where, $sort = 'ord_created_at desc', $offset = 0, $limit = 0){
        $this->db->select('*, DATE_FORMAT(orders.ord_created_at, "%d-%m-%Y %H:%i:%s") as ord_created_at');
        if ($where != null) {
            $this->db->where($where);
        }
        $this->db->join('order_status','orders.ord_stat_id = order_status.ord_stat_id');
        $this->db->join('products','orders.ord_pro_id = products.pro_id');
        $this->db->order_by($sort);
        if ($limit)
            $this->db->limit($limit, $offset);
        return $this->db->get('orders');
    }

    public function search_orders($like, $where, $sort = 'ord_created_at desc', $offset = 0, $limit = 0){
        $this->db->select('*');
        if ($where != null) {
            $this->db->where($where);
        }
        if ($like != null) {
            $this->db->group_start();
            $this->db->or_like($like);
            $this->db->group_end();
        }
        $this->db->join('order_status','orders.ord_stat_id = order_status.ord_stat_id');
        $this->db->join('products','orders.ord_pro_id = products.pro_id');
        $this->db->order_by($sort);
        if ($limit)
            $this->db->limit($limit, $offset);
        return $this->db->get('orders');
    }

    public function add_orders($data){
        return $this->db->insert('orders', $data);
    }

    public function update_orders($data, $where){
        $this->db->set($data);
        $this->db->where($where);
        return $this->db->update('orders');
    }

    public function update_expired_orders(){
        $this->db->set('ord_stat_id', $this->config->item('order_failed'));
        $this->db->where('ord_pay_due_date <= NOW()');
        $this->db->where('ord_stat_id', $this->config->item('order_not_paid'));
        return $this->db->update('orders');
    }

    public function get_expired_orders(){
        $this->db->select('*');
        $this->db->where('ord_pay_due_date <= NOW()');
        $this->db->where('ord_stat_id', $this->config->item('order_not_paid'));
        return $this->db->get('orders');
    }
}
