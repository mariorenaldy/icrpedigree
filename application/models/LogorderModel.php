<?php
class LogorderModel extends CI_Model {
    public function __construct(){
        date_default_timezone_set("Asia/Bangkok");
    }

    public function get_logs($where){
        $this->db->select('*, DATE_FORMAT(logs_order.log_updated_at, "%d %M %Y %H:%i:%s") as log_date, u1.use_username AS user, DATE_FORMAT(logs_order.log_pay_date, "%d %M %Y %H:%i:%s") as log_pay_date, DATE_FORMAT(logs_order.log_pay_due_date, "%d %M %Y %H:%i:%s") as log_pay_due_date, DATE_FORMAT(logs_order.log_arrived_date, "%d %M %Y %H:%i:%s") as log_arrived_date, DATE_FORMAT(logs_order.log_completed_date, "%d %M %Y %H:%i:%s") as log_completed_date');
        $this->db->from('logs_order');
        if ($where != null) {
            $this->db->where($where);
        }
        $this->db->join('users u1','u1.use_id = logs_order.log_updated_by');
        $this->db->join('order_status','order_status.ord_stat_id = logs_order.log_stat_id');
        $this->db->join('members', 'logs_order.log_mem_id = members.mem_id');
        $this->db->order_by('logs_order.log_updated_at', 'desc');
        return $this->db->get();
    }

    public function add_log($data){
        $insert = $this->db->insert('logs_order', $data);
        return $insert;
    }

    public function update_log($data, $where){
        $this->db->set($data);
        $this->db->where($where);
        return $this->db->update('logs_order');
    }
}
