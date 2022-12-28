<?php
class TrahModel extends CI_Model {
  // public function record_count() {
  //   return $this->db->count_all("trah");
  // }

  // public function fetch_data($num, $offset) {
  //   $this->db->order_by('id', 'desc');
  //   $data = $this->db->get('trah', $num, $offset);
  //   return $data;
  // }

  public function get_trah($where){
    $this->db->select('*');
    if ($where != null) {
      $this->db->where($where);
    }
    $this->db->order_by('tra_name');
    return $this->db->get('trah', $this->config->item('trah_count'));
  }

  // public function get_event(){
  //   $this->db->select('*');
  //   $this->db->order_by('id', 'desc');
  //   return $this->db->get('trah', 3);
  // }

  public function add_trah($data){
    $this->db->insert('trah', $data);
    return $this->db->insert_id();
  }

  public function update_trah($data, $where){
    $this->db->set($data);
    $this->db->where($where);
    $this->db->update('trah');
    return $this->db->affected_rows();
  }

  // public function get_all_trah(){
  //   $this->db->select('*');
  //   $this->db->from('trah');
  //   $this->db->order_by('tra_name', 'ASC');
  //   return $this->db->get();
  // }
}
