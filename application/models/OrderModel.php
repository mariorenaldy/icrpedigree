<?php

class OrderModel extends CI_Model {
    public function __construct(){
        date_default_timezone_set("Asia/Bangkok");
    }

    public function record_count() {
        return $this->db->count_all("orders");
    }

    public function accepted_count() {
        $ignoreStat = array($this->config->item('order_not_paid'), $this->config->item('order_cancelled'), $this->config->item('order_rejected'), $this->config->item('order_failed'));
        $this->db->where_not_in('ord_stat_id', $ignoreStat);
        $this->db->from("orders");
        return $this->db->count_all_results();
    }
    public function get_orders($where = null, $sort = 'sort_date desc', $offset = 0, $limit = 0){
        $this->db->select('*, ord_date as sort_date, DATE_FORMAT(orders.ord_date, "%d %M %Y %H:%i:%s") as ord_date, DATE_FORMAT(orders.ord_pay_date, "%d %M %Y %H:%i:%s") as ord_pay_date, DATE_FORMAT(orders.ord_pay_due_date, "%d %M %Y %H:%i:%s") as ord_pay_due_date, DATE_FORMAT(orders.ord_arrived_date, "%d %M %Y %H:%i:%s") as ord_arrived_date, DATE_FORMAT(orders.ord_completed_date, "%d %M %Y %H:%i:%s") as ord_completed_date');
        if ($where != null) {
            $this->db->where($where);
        }
        $this->db->join('order_status','orders.ord_stat_id = order_status.ord_stat_id');
        $this->db->join('members','orders.ord_mem_id = members.mem_id');
        $this->db->join('order_complain','orders.ord_id = order_complain.com_ord_id', 'left');
        $this->db->order_by($sort);
        if ($limit)
            $this->db->limit($limit, $offset);
        return $this->db->get('orders');
    }

    public function get_order_items($where = null){
        $this->db->select('*');
        if ($where != null) {
            $this->db->where($where);
        }
        $this->db->join('orders','order_items.itm_ord_id = orders.ord_id');
        $this->db->join('products','order_items.itm_pro_id = products.pro_id');
        return $this->db->get('order_items');
    }

    public function get_processed_orders($sort = 'ord_date desc', $offset = 0, $limit = 0){
        $this->db->select('*, DATE_FORMAT(orders.ord_date, "%d %M %Y %H:%i:%s") as ord_created_at, DATE_FORMAT(orders.ord_pay_date, "%d %M %Y %H:%i:%s") as ord_pay_date, DATE_FORMAT(orders.ord_pay_due_date, "%d %M %Y %H:%i:%s") as ord_pay_due_date, DATE_FORMAT(orders.ord_arrived_date, "%d %M %Y %H:%i:%s") as ord_arrived_date, DATE_FORMAT(orders.ord_completed_date, "%d %M %Y %H:%i:%s") as ord_completed_date');
        $where = array($this->config->item('order_not_paid'), $this->config->item('order_cancelled'), $this->config->item('order_failed'));
        $this->db->where_not_in('orders.ord_stat_id', $where);
        $this->db->join('order_status','orders.ord_stat_id = order_status.ord_stat_id');
        $this->db->join('members','orders.ord_mem_id = members.mem_id');
        $this->db->join('order_complain','orders.ord_id = order_complain.com_ord_id', 'left');
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
        $this->db->order_by($sort);
        if ($limit)
            $this->db->limit($limit, $offset);
        return $this->db->get('orders');
    }

    public function add_orders($data){
        return $this->db->insert('orders', $data);
    }

    public function add_order_items($data){
        return $this->db->insert('order_items', $data);
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

    public function check_for_duplicate($id, $field, $val){
        $sql = "SELECT ord_id from orders where ".$field." = '".$val."'";
        if ($id){
            $sql .= ' AND ord_id <> '.$id;
        }
        $query = $this->db->query($sql);
        return count($query->result());
    }

    public function get_income() {
        $this->db->select('SUM(ord_total_price) as income');
        $ignore = array($this->config->item('order_not_paid'), $this->config->item('order_cancelled'), $this->config->item('order_rejected'), $this->config->item('order_failed'));
        $this->db->where_not_in('ord_stat_id', $ignore);
        return $this->db->get('orders')->row();
    }

    public function getMonthlyIncome($year = null){
        $this->db->select("DATE_FORMAT(ord_pay_date, '%b %Y') as month, SUM(ord_total_price) as total_income");
        $this->db->from('orders');
        if($year == null){
            $this->db->where('YEAR(ord_pay_date) = YEAR(CURDATE())');
        }
        else{
            $this->db->where('YEAR(ord_pay_date) = '.$year);
        }
        $this->db->group_by("DATE_FORMAT(ord_pay_date, '%b %Y')");
        $this->db->order_by("ord_pay_date", 'ASC');
        $ignore = array($this->config->item('order_not_paid'), $this->config->item('order_cancelled'), $this->config->item('order_rejected'), $this->config->item('order_failed'));
        $this->db->where_not_in('ord_stat_id', $ignore);

        $query = $this->db->get();
        
        return $query->result();
    }

}
