<?php

class UsertypeModel extends CI_Model {
  public function get_user_type(){
    $this->db->select('*');
    $this->db->order_by('user_type_id');
    return $this->db->get('user_type');
  }
}
