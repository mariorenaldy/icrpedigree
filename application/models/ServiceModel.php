<?php
class ServiceModel extends CI_Model {
    public function __construct(){
        parent::__construct();
    }

    public function get_services($where = null){
        $this->db->select('*');
        if ($where != null) {
            $this->db->where($where);
        }
        $this->db->order_by('ser_id', 'desc');
        return $this->db->get('services');
    }

    public function get_service(){
        $this->db->select('*');
        $this->db->order_by('ser_id', 'desc');
        return $this->db->get('services');
    }

    public function add_services($data = null){
        $result = false;
        if ($data != null) {
            $this->db->insert('service', $data);
            $result = $this->db->insert_id();
        }
        return $result;
    }

    public function update_services($data = null, $where = null){
        $result = false;
        if($data != null && $where != null){
            $this->db->set($data);
            $this->db->where($where);
            $this->db->update('services');
        }
        return $result;
    }

    public function remove_services($where = null){
        if($where != null){
            return $this->db->delete('services', $where);
        }
    }

}
