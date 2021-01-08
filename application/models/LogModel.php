<?php
class LogModel extends CI_Model {
    public function __construct(){
        parent::__construct();
    }
    public function get_logs($where = null){
        $this->db->select('log_id, log_code, log_name, log_description');
        if ($where != null) {
            $this->db->where($where);
        }
        $this->db->order_by('log_id', 'desc');
        return $this->db->get('silp_logs');
    }
    public function add_log($data = null){
        $result = false;
        if ($data != null) {
            $this->db->insert('silp_logs', $data);
            $result = $this->db->insert_id();
        }
        return $result;
    }

    public function update_log($data = null, $where = null){
        $result = false;
        if($data != null && $where != null){
            $this->db->set($data);
            $this->db->where($where);
            $this->db->update('silp_logs');
        }
        return $result;
    }

    public function remove_log($where = null){
        if($where != null){
            return $this->db->delete('silp_logs', $where);
        }
    }

}
