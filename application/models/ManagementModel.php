<?php
class ManagementModel extends CI_Model {
    public function __construct(){
        parent::__construct();
    }

    public function get_managements($where = null){
        $this->db->select('*');
        if ($where != null) {
            $this->db->where($where);
        }
        $this->db->order_by('man_id', 'desc');
        return $this->db->get('managements');
    }

    public function add_managements($data = null){
        $result = false;
        if ($data != null) {
            $this->db->insert('managements', $data);
            $result = $this->db->insert_id();
        }
        return $result;
    }

    public function update_managements($data = null, $where = null){
        $result = false;
        if($data != null && $where != null){
            $this->db->set($data);
            $this->db->where($where);
            $this->db->update('managements');
        }
        return $result;
    }

    public function remove_managements($where = null){
        if($where != null){
            return $this->db->delete('managements', $where);
        }
    }

}
