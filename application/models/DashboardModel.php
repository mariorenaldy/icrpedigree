<?php
class DashboardModel extends CI_Model {
    public function __construct(){
        parent::__construct();
    }

    public function get_count_canine(){
        return $this->db->count_all_results('canines');
    }

    public function get_count_product(){
        return $this->db->count_all_results('products');
    }

    public function get_count_event(){
        return $this->db->count_all_results('events');
    }

    public function get_count_admin(){
      $this->db->select('use_id');
      $this->db->where('use_akses !=',3);
      // ARTechnology
      $this->db->where('use_id !=', 0);
      // ARTechnology
      return $this->db->get('users');
    }

    public function get_count_pegawai(){
        $this->db->select('use_id');
        $this->db->where('use_akses',3);
        return $this->db->get('users');
    }

    // ARTechnology
    public function get_count_member(){
        return $this->db->count_all_results('members');
    }

    public function get_count_stud(){
        return $this->db->count_all_results('studs');
    }

    public function get_count_birth(){
        return $this->db->count_all_results('births');
    }
    // ARTechnology



}
