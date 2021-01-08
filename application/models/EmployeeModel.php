<?php
class EmployeeModel extends CI_Model {
    public function __construct(){
        parent::__construct();
    }
    public function get_employees($where = null){
        $this->db->select('*');
        if ($where != null) {
            $this->db->where($where);
        }
        $this->db->order_by('emp_id', 'desc');
        return $this->db->get('silp_employees');
    }
    public function add_employee($data = null){
        $result = false;
        if ($data != null) {
            $this->db->insert('silp_employees', $data);
            $result = $this->db->insert_id();
        }
        return $result;
    }

    public function update_employee($data = null, $where = null){
        $result = false;
        if($data != null && $where != null){
            $this->db->set($data);
            $this->db->where($where);
            $this->db->update('silp_employees');
        }
        return $result;
    }

    public function remove_employee($where = null){
        if($where != null){
            return $this->db->delete('silp_employees', $where);
        }
    }

}
