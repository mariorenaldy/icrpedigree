<?php
class UserModel extends CI_Model {
    public function record_count() {
        return $this->db->count_all("users");
    }

    public function accepted_count() {
        $ignoreStat = array($this->config->item('deleted'), $this->config->item('rejected'));
        $this->db->where_not_in('use_stat', $ignoreStat);
        $this->db->from("users");
        return $this->db->count_all_results();
    }

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
