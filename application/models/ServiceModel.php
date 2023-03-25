<?php
class ServiceModel extends CI_Model {
    public function __construct(){
        parent::__construct();
    }

    public function record_count() {
        return $this->db->count_all("services");
    }

    public function fetch_data($num, $offset) {
        $this->db->order_by('ser_id', 'desc');
        $data = $this->db->get('services', $num, $offset);
        return $data;
    }

    public function get_services($where = null){
        $this->db->select('*');
        if ($where != null) {
            $this->db->where($where);
        }
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

    public function search_services($num, $offset, $like){
        $this->db->select('*');
        if ($like != null) {
            $this->db->like($like);
        }
        $this->db->order_by('ser_id', 'desc');
        return $this->db->get('services', $num, $offset);
    }
}
