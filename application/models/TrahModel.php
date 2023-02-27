<?php
class TrahModel extends CI_Model {
  public function get_trah($where){
    $this->db->select('*');
    if ($where != null) {
      $this->db->where($where);
    }
    $this->db->order_by('tra_name');
    return $this->db->get('trah');
  }

  public function add_trah($data){
    $this->db->insert('trah', $data);
    return $this->db->insert_id();
  }

  public function update_trah($data, $where){
    $this->db->set($data);
    $this->db->where($where);
    return $this->db->update('trah');
  }
}
