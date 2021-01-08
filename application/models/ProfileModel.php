<?php
class ProfileModel extends CI_Model {
    public function __construct(){
        parent::__construct();
    }

    public function get_profiles($where = null){
        $this->db->select('*');
        if ($where != null) {
            $this->db->where($where);
        }
        $this->db->order_by('prof_id', 'desc');
        return $this->db->get('profile');
    }

    public function get_profile(){
        $this->db->select('*');
        $this->db->order_by('prof_id', 'desc');
        return $this->db->get('profile');
    }

    public function add_profiles($data = null){
        $result = false;
        if ($data != null) {
            $this->db->insert('profile', $data);
            $result = $this->db->insert_id();
        }
        return $result;
    }

    public function update_profiles($data = null, $where = null){
        $result = false;
        if($data != null && $where != null){
            $this->db->set($data);
            $this->db->where($where);
            $this->db->update('profile');
        }
        return $result;
    }

    public function remove_profiles($where = null){
        if($where != null){
            return $this->db->delete('profile', $where);
        }
    }

}
