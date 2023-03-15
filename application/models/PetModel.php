<?php
class PetModel extends CI_Model {
    public function __construct(){
        parent::__construct();
    }

    public function record_count() {
      return $this->db->count_all("pets");
    }

    public function fetch_data($num, $offset) {
      $this->db->order_by('pet_id', 'desc');
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

    public function get_pet(){
        $this->db->select('*');
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

    public function update_pets($data = null, $where = null){
        $result = false;
        if ($data != null && $where != null){
            $this->db->set($data);
            $this->db->where($where);
            $this->db->update('pets');
        }
        return $result;
    }

    public function remove_pets($where = null){
        if($where != null){
            return $this->db->delete('pets', $where);
        }
    }

}
