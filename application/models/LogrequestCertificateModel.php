<?php
class LogrequestCertificateModel extends CI_Model {
    public function __construct(){
        date_default_timezone_set("Asia/Bangkok");
    }

    public function get_logs($where){
        $this->db->select('*');
        $this->db->from('logs_req_certificate');
        if ($where != null) {
            $this->db->where($where);
        }
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
