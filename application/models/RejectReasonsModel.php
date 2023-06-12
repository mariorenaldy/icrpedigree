<?php
class RejectReasonsModel extends CI_Model {
    public function __construct(){
        date_default_timezone_set("Asia/Bangkok");
    }

    public function get_order_reasons(){
        $this->db->select('*');
        $this->db->from('reject_reasons');
        $this->db->where('rej_type', 'Order');
        return $this->db->get();
    }

    public function get_certificate_reasons(){
        $this->db->select('*');
        $this->db->from('reject_reasons');
        $this->db->where('rej_type', 'Certificate');
        return $this->db->get();
    }

    public function get_microchip_reasons(){
        $this->db->select('*');
        $this->db->from('reject_reasons');
        $this->db->where('rej_type', 'Microchip');
        return $this->db->get();
    }
}