<?php
class PedigreesModel extends CI_Model {
    public function get_pedigrees($where){
        $this->db->select('*');
        if ($where != null) {
            $this->db->where($where);
        }
        $this->db->order_by('ped_id', 'desc');
        return $this->db->get('pedigrees');
    }

    public function add_pedigrees($data){
        $this->db->insert('pedigrees', $data);
        return $this->db->insert_id();
    }

    public function update_pedigrees($data, $where){
        $this->db->set($data);
        $this->db->where($where);
        return $this->db->update('pedigrees');
    }
}
