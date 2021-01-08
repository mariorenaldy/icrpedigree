<?php
class RulesModel extends CI_Model {
    public function __construct(){
        parent::__construct();
    }

    public function get_service_details($where = null){
        $this->db->select('*');
        if ($where != null) {
            $this->db->where($where);
        }
        $this->db->order_by('sdet_id', 'desc');
        return $this->db->get('service_details');
    }

    public function get_service(){
        $this->db->select('*');
        $this->db->order_by('sdet_id', 'desc');
        return $this->db->get('service_details');
    }

    public function add_service_details($data = null){
        $result = false;
        if ($data != null) {
            $this->db->insert('service_details', $data);
            $result = $this->db->insert_id();
        }
        return $result;
    }

    public function update_service_details($data = null, $where = null){
        $result = false;
        if($data != null && $where != null){
            $this->db->set($data);
            $this->db->where($where);
            $this->db->update('service_details');
        }
        return $result;
    }

    public function remove_service_details($where = null){
        if($where != null){
            return $this->db->delete('service_details', $where);
        }
    }

}
