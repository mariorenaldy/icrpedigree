<?php
class StudentModel extends CI_Model {
    public function __construct(){
        parent::__construct();
    }
    public function get_students($where = null){
        $this->db->select('*');
        if ($where != null) {
            $this->db->where($where);
        }
        $this->db->order_by('std_id', 'desc');
        return $this->db->get('silp_students');
    }

    public function get_student(){
        $this->db->select('*');
        $this->db->order_by('std_id', 'desc');
        return $this->db->get('silp_students');
    }

    public function add_student($data = null){
        $result = false;
        if ($data != null) {
            $this->db->insert('silp_students', $data);
            $result = $this->db->insert_id();
        }
        return $result;
    }

    public function update_student($data = null, $where = null){
        $result = false;
        if($data != null && $where != null){
            $this->db->set($data);
            $this->db->where($where);
            $this->db->update('silp_students');
        }
        return $result;
    }

    public function remove_student($where = null){
        if($where != null){
            return $this->db->delete('silp_students', $where);
        }
    }

}
