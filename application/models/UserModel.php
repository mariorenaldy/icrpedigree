<?php
class UserModel extends CI_Model {
    public function get_users($where){
        $this->db->select('*');
        if ($where) {
            $this->db->where($where);
        }
        $this->db->join('user_type', 'user_type.user_type_id = users.use_type_id');
        $this->db->order_by('use_id', 'desc');
        return $this->db->get('users');
    }

    public function add_users($data){
        $this->db->insert('users', $data);
        return $this->db->insert_id();
    }

    public function update_users($data, $where){
        $this->db->set($data);
        $this->db->where($where);
        $this->db->update('users');
        return $this->db->affected_rows();
    }
}
