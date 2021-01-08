<?php
class TrahModel extends CI_Model {
  public function __construct(){
    parent::__construct();
  }

  public function record_count() {
    return $this->db->count_all("trah");
  }

  public function fetch_data($num, $offset) {
    $this->db->order_by('id', 'desc');
    $data = $this->db->get('trah', $num, $offset);
    return $data;
  }


public function get_trah($where = null){
  $this->db->select('*');
  if ($where != null) {
    $this->db->where($where);
  }
  $this->db->order_by('id', 'desc');
  return $this->db->get('trah',6);
}

public function get_event(){
  $this->db->select('*');
  $this->db->order_by('id', 'desc');
  return $this->db->get('trah',3);
}

public function add_trah($data = null){
  $result = false;
  if ($data != null) {
    $this->db->insert('trah', $data);
    $result = $this->db->insert_id();
  }
  return $result;
}

public function update_trah($data = null, $where = null){
  $result = false;
  if($data != null && $where != null){
    $this->db->set($data);
    $this->db->where($where);
    $this->db->update('trah');
  }
  return $result;
}

public function remove_trah($where = null){
  if($where != null){
    return $this->db->delete('trah', $where);
  }
}

}
