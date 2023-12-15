<?php
class LogrequestCertificateModel extends CI_Model {
    public function __construct(){
        date_default_timezone_set("Asia/Bangkok");
    }

    public function get_logs($where){
        $this->db->select('*, DATE_FORMAT(logs_req_certificate.log_created_at, "%d-%m-%Y %H:%i:%s") as log_created_at, DATE_FORMAT(logs_req_certificate.log_updated_at, "%d-%m-%Y %H:%i:%s") as log_date, u1.use_username AS user, DATE_FORMAT(logs_req_certificate.log_arrived_date, "%d-%m-%Y %H:%i:%s") as log_arrived_date');
        $this->db->from('logs_req_certificate');
        if ($where != null) {
            $this->db->where($where);
        }
        $this->db->join('users u1','u1.use_id = logs_req_certificate.log_updated_by');
        $this->db->join('certificate_status','certificate_status.cert_stat_id = logs_req_certificate.log_stat_id');
        $this->db->join('city','logs_req_certificate.log_city_id = city.city_id');
        $this->db->join('members', 'logs_req_certificate.log_mem_id = members.mem_id');
        $this->db->join('canines', 'logs_req_certificate.log_can_id = canines.can_id');
        $this->db->order_by('logs_req_certificate.log_updated_at', 'desc');
        return $this->db->get();
    }

    public function add_log($data){
        $insert = $this->db->insert('logs_req_certificate', $data);
        return $insert;
    }

    public function update_log($data, $where){
        $this->db->set($data);
        $this->db->where($where);
        return $this->db->update('logs_req_certificate');
    }
}
