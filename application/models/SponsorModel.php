<?php
class SponsorModel extends CI_Model {
    public function __construct(){
        parent::__construct();
    }

    public function record_count() {
      $query = $this->db->where('spo_type', 2)->get('sponsors');
      return $query->num_rows();
    }

    public function fetch_data($num, $offset) {
      $this->db->order_by('spo_id', 'desc');
      $this->db->where('spo_type', 2);
      $data = $this->db->get('sponsors', $num, $offset);
      return $data;
    }

    public function get_sponsors($where = null){
        $this->db->select('*');
        if ($where != null) {
            $this->db->where($where);
        }
        $this->db->order_by('spo_id', 'desc');
        return $this->db->get('sponsors');
    }

    public function get_sponsor(){
        $this->db->select('*');
        $this->db->order_by('spo_id', 'desc');
        return $this->db->get('sponsors');
    }

    public function add_sponsors($data = null){
        $result = false;
        if ($data != null) {
            $this->db->insert('sponsors', $data);
            $result = $this->db->insert_id();
        }
        return $result;
    }

    public function update_sponsors($data = null, $where = null){
        $result = false;
        if($data != null && $where != null){
            $this->db->set($data);
            $this->db->where($where);
            $this->db->update('sponsors');
        }
        return $result;
    }

    public function remove_sponsors($where = null){
        if($where != null){
            return $this->db->delete('sponsors', $where);
        }
    }

}
