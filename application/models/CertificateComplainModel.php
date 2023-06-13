<?php
class CertificateComplainModel extends CI_Model {
    public function __construct(){
        date_default_timezone_set("Asia/Bangkok");
    }

    public function get_complains($where){
        $this->db->select('*');
        if ($where != null) {
            $this->db->where($where);
        }
        return $this->db->get('certificate_complain');
    }

    public function add_complains($data){
        return $this->db->insert('certificate_complain', $data);
    }
}
