<?php
class RulesModel extends CI_Model {
    public function get_rules($where){
        $this->db->select('*');
        if ($where != null) {
            $this->db->where($where);
        }
        $this->db->order_by('ru_rule_id', 'asc');
        return $this->db->get('rules');
    }

    public function add($data){
        $this->db->insert('rules', $data);
        return $this->db->insert_id();
    }

    public function update($data, $where){
        $this->db->set($data);
        $this->db->where($where);
        return $this->db->update('rules');
    }
}
