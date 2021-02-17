<?php
class UserModel extends CI_Model {
    public function __construct(){
        parent::__construct();
    }

    public function get_users($where = null){
        $this->db->select('*');
        if ($where != null) {
            $this->db->where($where);
        }
        $this->db->order_by('use_id', 'desc');
        return $this->db->get('users');
    }

    public function daftar_users($username = null){
      $this->db->select('*');
        if ($username != null ) {
            $user['use_username'] = $username;
            $this->db->where($user);
        }
        return $this->db->get('users');
    }

    public function add_users($data = null){
        $result = false;
        if ($data != null) {
            $this->db->insert('users', $data);
            $result = $this->db->insert_id();
        }
        return $result;
    }

    public function update_users($data = null, $where = null){
        $result = false;
        if($data != null && $where != null){
            $this->db->set($data);
            $this->db->where($where);
            $this->db->update('users');
        }
        return $result;
    }

    public function remove_users($where = null){
        if($where != null){
            return $this->db->delete('users', $where);
        }
    }
}
