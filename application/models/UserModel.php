<?php
class UserModel extends CI_Model {
    public function get_max_id(){
		$this->db->select_max('use_id', 'max');
		$query = $this->db->get('users');
        return ($query->result()[0]->max);
	}

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
        return $this->db->insert('users', $data);
    }

    public function update_users($data, $where){
        $this->db->set($data);
        $this->db->where($where);
        return $this->db->update('users');
    }
}
