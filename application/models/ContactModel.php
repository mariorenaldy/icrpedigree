<?php
class ContactModel extends CI_Model {
    public function __construct(){
        parent::__construct();
    }
    public function get_contacts($where = null){
        $this->db->select('*');
        if ($where != null) {
            $this->db->where($where);
        }
        $this->db->order_by('con_id', 'desc');
        return $this->db->get('contacts');
    }
    public function add_contact($data = null){
        $result = false;
        if ($data != null) {
            $this->db->insert('contacts', $data);
            $result = $this->db->insert_id();
        }
        return $result;
    }

    public function update_contact($data = null, $where = null){
        $result = false;
        if($data != null && $where != null){
            $this->db->set($data);
            $this->db->where($where);
            $this->db->update('contacts');
        }
        return $result;
    }

    public function remove_contact($where = null){
        if($where != null){
            return $this->db->delete('contacts', $where);
        }
    }

}
