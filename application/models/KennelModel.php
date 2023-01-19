<?php

class KennelModel extends CI_Model {
    public function record_count() {
        return $this->db->count_all("kennels");
    }

    // public function fetch_data($num, $offset) {
    //     $this->db->order_by('ken_id', 'desc');
    //     $data = $this->db->get('kennels', $num, $offset);
    //     return $data;
    // }

    public function get_kennels($where){
        $this->db->select('kennels.ken_id, kennels.ken_photo, kennels.ken_name, kennels.ken_member_id, kennels.ken_type_id, kennels_type.ken_type_name, members.mem_id, members.mem_name, approval_status.stat_name');
        $this->db->where($where);
        $this->db->from('kennels');
        $this->db->join('kennels_type','kennels.ken_type_id = kennels_type.ken_type_id');
        $this->db->join('members','kennels.ken_member_id = members.mem_id');
        $this->db->join('approval_status','kennels.ken_stat = approval_status.stat_id');
        $this->db->order_by('ken_id', 'desc');
        return $this->db->get();
    }

    public function search_kennels($like, $where){
        $this->db->select('kennels.ken_id, kennels.ken_photo, kennels.ken_name, kennels.ken_member_id, kennels.ken_type_id, kennels_type.ken_type_name, members.mem_id, members.mem_name, approval_status.stat_name');
        $this->db->where($where);
        $this->db->group_start();
        if ($like != null) {
            $this->db->or_like($like);
        }
        $this->db->group_end();
        $this->db->from('kennels');
        $this->db->join('kennels_type','kennels_type.ken_type_id = kennels.ken_type_id');
        $this->db->join('members','members.mem_id = kennels.ken_member_id');
        $this->db->join('approval_status','approval_status.stat_id = kennels.ken_stat');
        $this->db->order_by('ken_id', 'desc');
        return $this->db->get();
    }

    public function get_kennels_simple($where = null){
        $this->db->select('ken_name AS name, ken_id AS id');
        if ($where != null) {
            $this->db->where($where);
        }
        $this->db->order_by('ken_id', 'desc');
        return $this->db->get('kennels');
    }

    public function get_stud_kennels($sireId, $damId){
        $this->db->distinct();
        $this->db->select('ken_name AS name, ken_id AS id');
        $this->db->where('ken_stat', 1);
        $this->db->group_start();
        $this->db->or_where('ken_member_id', $sireId);
        $this->db->or_where('ken_member_id', $damId);
        $this->db->group_end();
        $this->db->order_by('ken_id', 'desc');
        return $this->db->get('kennels');
    }

    public function add_kennels($data){
        return $this->db->insert('kennels', $data);
    }

    public function update_kennels($data, $where){
        $this->db->set($data);
        $this->db->where($where);
        return $this->db->update('kennels');
    }

    // public function edit_kennels($data, $id){
    //     $result = false;
    //     if ($data != null && $id != null){
    //         $this->db->where('ken_id', $id);
    //         $result = $this->db->update('kennels', $data);
    //     }
    //     return $result;
    // }

    // public function kennel_search($q = null){
    //     $this->db->select('ken_id as id, ken_name as text');
    //     if (isset($q)) {
    //         $this->db->like('ken_name', $q);
    //     }
    //     $this->db->from('kennels');
    //     $this->db->order_by('ken_id');
    //     return $this->db->get();
    // }

    // public function set_active($id, $status){
    //     $data = array(
    //         'ken_stat' => $status
    //     );
    //     $this->db->where('ken_id', $id);

    //     $edit = $this->db->update('kennels', $data);

	// 	return $edit; 
    // }
}
