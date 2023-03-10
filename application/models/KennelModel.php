<?php

class KennelModel extends CI_Model {
    public function record_count() {
        return $this->db->count_all("kennels");
    }

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

    public function check_for_duplicate($id, $field, $val){
        $sql = "select ken_id from kennels where ".$field." = '".$val."' AND ken_stat = ".$this->config->item('accepted');
        if ($id){
            $sql .= ' AND ken_member_id <> '.$id;
        }
        $query = $this->db->query($sql);
        return count($query->result());
    }
}
