<?php
class PedigreesModel extends CI_Model {
    // public function get_pedigrees($where = null){
    //     $this->db->select('*');
    //     if ($where != null) {
    //         $this->db->where($where);
    //     }
    //     $this->db->order_by('ped_id', 'desc');
    //     return $this->db->get('pedigrees');
    // }

    public function get_sibling($where = null){
        $this->db->select('ped_id, ped_canine_id, can_a_s');
        if ($where != null) {
            $this->db->where($where);
        }
        $this->db->join('canines','canines.can_id = pedigrees.ped_canine_id');
        $this->db->limit(10);
        $this->db->order_by('ped_id', 'desc');
        return $this->db->get('pedigrees');
    }
    
    public function add_pedigrees($data){
        $this->db->insert('pedigrees', $data);
        $result = $this->db->insert_id();
        return $result;
    }

    public function insert_pedigree($id){
        $data = array(
            'ped_sire_id' => $this->config->item('sire_id'),
            'ped_dam_id' => $this->config->item('dam_id'),
            'ped_canine_id' => $id
        );
        $insert = $this->db->insert('pedigrees', $data);
		return $insert;
    }

    public function update_pedigrees($data, $where){
        $this->db->set($data);
        $this->db->where($where);
        $this->db->update('pedigrees');
        return $this->db->affected_rows();
    }

    // public function remove_pedigrees($where = null){
    //     if($where != null){
    //         return $this->db->delete('pedigrees', $where);
    //     }
    // }

    // public function unlink_parent($id, $newId){
    //     if ($newId == $this->config->item('sire_id')){ // male
    //         $data = array(
    //             'ped_sire_id' => $newId
    //         );
    //         $this->db->where('ped_sire_id', $id);
    //     }
    //     else{
    //         $data = array(
    //             'ped_dam_id' => $newId
    //         );
    //         $this->db->where('ped_dam_id', $id);
    //     }

    //     $edit = $this->db->update('pedigrees', $data);
        
    //     $this->db->where('ped_canine_id', $id);
    //     $delete = $this->db->delete('pedigrees');

	// 	return $edit && $delete; 
    // }
}
