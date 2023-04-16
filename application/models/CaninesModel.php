<?php
class CaninesModel extends CI_Model {
    public function __construct(){
        date_default_timezone_set("Asia/Bangkok");
    }

    public function record_count() {
        return $this->db->count_all("canines");
    }

    public function get_canines($where, $sort = 'can_id desc', $offset = 0, $limit = 0){
        $this->db->select('*, DATE_FORMAT(canines.can_date_of_birth, "%d-%m-%Y") as can_date_of_birth, DATE_FORMAT(canines.can_reg_date, "%d-%m-%Y") as can_reg_date, DATE_FORMAT(canines.can_app_date, "%d-%m-%Y") as can_app_date, DATE_FORMAT(canines.can_app_date, "%Y-%m-%d %H:%i:%s") as can_app_date2, , DATE_FORMAT(canines.can_reg_date, "%Y-%m-%d %H:%i:%s") as can_reg_date2, DATE_FORMAT(canines.can_date_of_birth, "%Y-%m-%d") as can_date_of_birth2');
        if ($where != null) {
            $this->db->where($where);
        }
        $this->db->join('members','members.mem_id = canines.can_member_id');
        $this->db->join('kennels','kennels.ken_id = canines.can_kennel_id AND kennels.ken_member_id = members.mem_id');
        $this->db->join('approval_status','approval_status.stat_id = canines.can_stat');
        $this->db->join('users', 'canines.can_app_user = users.use_id');
        $this->db->order_by($sort);
        if ($limit)
            $this->db->limit($limit, $offset);
        return $this->db->get('canines');
    }

    public function search_canines($like, $where, $sort = 'can_id desc', $offset = 0, $limit = 0){
        $this->db->select('*, DATE_FORMAT(canines.can_date_of_birth, "%d-%m-%Y") as can_date_of_birth, DATE_FORMAT(canines.can_reg_date, "%d-%m-%Y") as can_reg_date, DATE_FORMAT(canines.can_app_date, "%d-%m-%Y") as can_app_date');
        if ($where != null) {
            $this->db->where($where);
        }
        $this->db->group_start();
        if ($like != null) {
            $this->db->or_like($like);
        }
        $this->db->group_end();
        $this->db->join('members','members.mem_id = canines.can_member_id');
        $this->db->join('kennels','kennels.ken_id = canines.can_kennel_id AND kennels.ken_member_id = members.mem_id');
        $this->db->join('approval_status','approval_status.stat_id = canines.can_stat');
        $this->db->join('users', 'canines.can_app_user = users.use_id');
        $this->db->order_by($sort);
        if ($limit)
            $this->db->limit($limit, $offset);
        return $this->db->get('canines');
    }

    public function get_canines_simple($where){
        $this->db->select('can_a_s AS name, can_id AS id');
        if ($where != null) {
            $this->db->where($where);
        }
        $this->db->where('can_id != ', $this->config->item('sire_id'));
        $this->db->where('can_id != ', $this->config->item('dam_id'));
        $this->db->order_by('can_id', 'desc');
        return $this->db->get('canines');
    }

    public function search_canines_simple($like, $where){
        $this->db->select('can_a_s AS name, can_id AS id');
        if ($like != null) {
            $this->db->like($like);
        }
        if ($where != null) {
            $this->db->where($where);
        }
        $this->db->where('can_id != ', $this->config->item('sire_id'));
        $this->db->where('can_id != ', $this->config->item('dam_id'));
        $this->db->order_by('can_id', 'desc');
        return $this->db->get('canines');
    }

    public function get_can_pedigrees($where){
        $this->db->select('*, DATE_FORMAT(canines.can_date_of_birth, "%d-%m-%Y") as can_date_of_birth, DATE_FORMAT(canines.can_reg_date, "%d-%m-%Y") as can_reg_date, DATE_FORMAT(canines.can_app_date, "%d-%m-%Y") as can_app_date');
        if ($where != null) {
            $this->db->where($where);
        }
        $this->db->from('canines');
        $this->db->join('pedigrees','pedigrees.ped_canine_id = canines.can_id');
        $this->db->join('members','members.mem_id = canines.can_member_id');
        $this->db->join('kennels','kennels.ken_id = canines.can_kennel_id AND kennels.ken_member_id = members.mem_id');
        $this->db->order_by('can_id', 'desc');
        return $this->db->get();
    }

    public function add_canines($data){
        return $this->db->insert('canines', $data);
    }

    public function update_canines($data, $where){
        $this->db->set($data);
        $this->db->where($where);
        return $this->db->update('canines');
    }

    public function get_dob_by_id($id){
        $sql = "SELECT DATE_FORMAT(can_date_of_birth, '%Y-%m-%d') as can_date_of_birth FROM canines WHERE can_id = ".$id;
        $query = $this->db->query($sql);
        return $query->row();
    } 

    public function get_date_compare_sibling($damId, $dob){
        $sql = "SELECT datediff(DATE_FORMAT(c.can_date_of_birth, '%Y-%m-%d'), '".$dob."') as diff FROM canines c, pedigrees p WHERE c.can_id = p.ped_canine_id AND p.ped_dam_id = ".$damId;
        $query = $this->db->query($sql);
        return $query->result();
    }

    public function get_date_compare_sibling_by_id($damId, $dob, $id){
        $sql = "SELECT datediff(DATE_FORMAT(c.can_date_of_birth, '%Y-%m-%d'), '".$dob."') as diff FROM canines c, pedigrees p WHERE c.can_id = p.ped_canine_id AND p.ped_dam_id = ".$damId." AND c.can_id <> ".$id;
        $query = $this->db->query($sql);
        return $query->result();
    }

    public function check_for_duplicate($id, $field, $val){
        $sql = "SELECT can_id from canines where ".$field." = '".$val."' AND can_stat IN (".$this->config->item('saved').", ".$this->config->item('accepted').")";
        if ($id){
            $sql .= ' AND can_id <> '.$id;
        }
        $query = $this->db->query($sql);
        return count($query->result());
    }

    public function get_siblings($canineId, $sireId, $damId, $gender){
        $this->db->select('can_a_s');
        $this->db->from('pedigrees');
        $this->db->join('canines','pedigrees.ped_canine_id = canines.can_id');
        $this->db->where('ped_sire_id', $sireId);
        $this->db->where('ped_dam_id', $damId);
        $this->db->where('ped_canine_id != ', $canineId);
        $this->db->where('can_gender', $gender);
        $this->db->order_by('can_id');
        return $this->db->get();
    }

    // public function search_by_member_app($q, $can_member, $offset){ 
    //     $date = '';
    //     $sql = "SELECT * FROM canines c, members m, kennels k, users u, approval_status a WHERE c.can_member_id = m.mem_id AND k.ken_member_id = m.mem_id AND k.ken_id = c.can_kennel_id AND c.can_stat = 1 AND u.use_id = c.can_app_user AND a.stat_id = c.can_app_stat";
    //     if ($can_member)
    //         $sql .= " AND m.mem_id = ".$can_member;
    //     if ($q){
    //         $sql .= " AND (c.can_icr_number LIKE '%".$q."%' OR c.can_chip_number LIKE '%".$q."%' OR c.can_a_s LIKE '%".$q."%' OR k.ken_name LIKE '%".$q."%'";
    //         $piece = explode("-", $q);
    //         if (count($piece) == 3)
    //             $date = $piece[2]."-".$piece[1]."-".$piece[0];
    //     }
    //     if ($date)
    //         $sql .= " OR c.can_date_of_birth LIKE '%".$date."%'";
    //     if ($q)
    //         $sql .= ")";
    //     $sql .= " ORDER BY can_a_s LIMIT ".$offset.", ".$this->config->item('canine_count');
    //     $query = $this->db->query($sql);
    //     return $query->result();
    // }

    // function search_count_by_member_app($q, $can_member){
    //     $date = '';
	// 	$sql = "SELECT COUNT(*) AS count FROM canines c, members m, kennels k, users u, approval_status a WHERE c.can_member_id = m.mem_id AND k.ken_member_id = m.mem_id AND k.ken_id = c.can_kennel_id AND c.can_stat = 1 AND u.use_id = c.can_app_user AND a.stat_id = c.can_app_stat";
	// 	if ($can_member)
    //         $sql .= " AND m.mem_id = ".$can_member;
    //     if ($q){
    //         $sql .= " AND (c.can_icr_number LIKE '%".$q."%' OR c.can_chip_number LIKE '%".$q."%' OR c.can_a_s LIKE '%".$q."%' OR k.ken_name LIKE '%".$q."%'";
    //         $piece = explode("-", $q);
    //         if (count($piece) == 3)
    //             $date = $piece[2]."-".$piece[1]."-".$piece[0];
    //     }
    //     if ($date)
    //         $sql .= " OR c.can_date_of_birth LIKE '%".$date."%'";
    //     if ($q)
    //         $sql .= ")";
    //     $query = $this->db->query($sql);
    //     return $query->result();  
	// }
}
