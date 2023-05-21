<?php
class PetModel extends CI_Model {
    public function __construct(){
        parent::__construct();
    }

    public function record_count() {
      return $this->db->count_all("pets");
    }

    public function fetch_data($where = null, $num, $offset) {
        $this->db->order_by('pet_id', 'desc');
        if ($where != null) {
            $this->db->where($where);
        }
        $data = $this->db->get('pets', $num, $offset);
        return $data;
    }

    public function get_pets($where = null){
        $this->db->select('*');
        if ($where != null) {
            $this->db->where($where);
        }
        $this->db->order_by('pet_id', 'desc');
        return $this->db->get('pets');
    }

    public function add_pets($data = null){
        $result = false;
        if ($data != null) {
            $this->db->insert('pets', $data);
            $result = $this->db->insert_id();
        }
        return $result;
    }

    public function update_pets($data, $where){
        $this->db->set($data);
        $this->db->where($where);
        return $this->db->update('pets');
    }

    public function search_pets($where, $num, $offset, $like){
        $this->db->select('*');
        if ($where != null) {
            $this->db->where($where);
        }
        if ($like != null) {
            $this->db->like($like);
        }
        $this->db->order_by('pet_id', 'desc');
        return $this->db->get('pets', $num, $offset);
    }

    public function check_for_duplicate($id, $field, $val){
        $sql = "SELECT pet_id from pets where ".$field." = '".$val."' AND pet_stat IN (".$this->config->item('saved').", ".$this->config->item('accepted').")";
        if ($id){
            $sql .= ' AND pet_id <> '.$id;
        }
        $query = $this->db->query($sql);
        return count($query->result());
    }
}
