<?php
class EventModel extends CI_Model {
  public function __construct(){
    parent::__construct();
  }

  public function record_count() {
    return $this->db->count_all("events");
  }

  public function fetch_data($num, $offset) {
    $this->db->order_by('evn_id', 'desc');
    $data = $this->db->get('events', $num, $offset);
    return $data;
  }


public function get_events($where = null){
  $this->db->select('*');
  if ($where != null) {
    $this->db->where($where);
  }
  $this->db->order_by('evn_id', 'desc');
  return $this->db->get('events',6);
}

public function get_event(){
  $this->db->select('*');
  $this->db->order_by('evn_id', 'desc');
  return $this->db->get('events',3);
}

public function add_events($data = null){
  $result = false;
  if ($data != null) {
    $this->db->insert('events', $data);
    $result = $this->db->insert_id();
  }
  return $result;
}

public function update_events($data = null, $where = null){
  $result = false;
  if($data != null && $where != null){
    $this->db->set($data);
    $this->db->where($where);
    $this->db->update('events');
  }
  return $result;
}

public function remove_events($where = null){
  if($where != null){
    return $this->db->delete('events', $where);
  }
}

}
