<?php
class ServiceModel extends CI_Model {
    public function __construct(){
        parent::__construct();
    }

    public function record_count() {
        return $this->db->count_all("services");
    }

    public function fetch_data($where = null, $num, $offset) {
        $this->db->order_by('ser_id', 'desc');
        if ($where != null) {
            $this->db->where($where);
        }
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
            $this->db->insert('services', $data);
            $result = $this->db->insert_id();
        }
        return $result;
    }

    public function update_services($data, $where){
        $this->db->set($data);
        $this->db->where($where);
        return $this->db->update('services');
    }

    public function search_services($where, $num = 0, $offset = 0, $like){
        $this->db->select('*');
        if ($where != null) {
            $this->db->where($where);
        }
        if ($like != null) {
            $this->db->like($like);
        }
        $this->db->order_by('ser_id', 'desc');
        return $this->db->get('services', $num, $offset);
    }

    public function check_for_duplicate($id, $field, $val){
        $sql = "SELECT ser_id from services where ".$field." = '".$val."' AND ser_stat IN (".$this->config->item('saved').", ".$this->config->item('accepted').")";
        if ($id){
            $sql .= ' AND ser_id <> '.$id;
        }
        $query = $this->db->query($sql);
        return count($query->result());
    }
}
