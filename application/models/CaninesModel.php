<?php
class CaninesModel extends CI_Model {
    public function __construct(){
        date_default_timezone_set("Asia/Bangkok");
    }

    public function record_count() {
        return $this->db->count_all("canines");
    }

    public function get_canines($where){
        $this->db->select('*, DATE_FORMAT(canines.can_date_of_birth, "%d-%m-%Y") as can_date_of_birth, DATE_FORMAT(canines.can_reg_date, "%d-%m-%Y") as can_reg_date, DATE_FORMAT(canines.can_app_date, "%d-%m-%Y") as can_app_date');
        if ($where != null) {
            $this->db->where($where);
        }
        $this->db->join('approval_status','approval_status.stat_id = canines.can_stat');
        $this->db->join('members','members.mem_id = canines.can_member_id');
        $this->db->join('kennels','kennels.ken_id = canines.can_kennel_id AND kennels.ken_member_id = members.mem_id');
        $this->db->join('users', 'canines.can_app_user = users.use_id');
        $this->db->order_by('can_id', 'desc');
        $this->db->limit($this->config->item('backend_canine_count'), 0);
        return $this->db->get('canines');
    }

    public function search_canines($like, $where){
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
        $this->db->order_by('can_id', 'desc');
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

    public function get_canines_gender($id){
        $this->db->select('can_gender');
        $this->db->where('can_id', $id);
        return $this->db->get('canines');
    }

    public function get_can_pedigrees($where){
        $this->db->select('*, DATE_FORMAT(canines.can_date_of_birth, "%d-%m-%Y") as can_date_of_birth, DATE_FORMAT(canines.can_reg_date, "%d-%m-%Y") as can_reg_date, DATE_FORMAT(canines.can_app_date, "%d-%m-%Y") as can_app_date');
        if ($where != null) {
            $this->db->where($where);
        }
        $this->db->where('can_id != ', $this->config->item('sire_id'));
        $this->db->where('can_id != ', $this->config->item('dam_id'));
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

    // public function is_sire($id){
    //     $sql = "SELECT can_gender FROM canines WHERE can_id = ".$id;
    //     $query = $this->db->query($sql);
            
    //     return ($query->result()[0]->can_gender == 'Male');
    // }

    // public function get_dam_sibling($sireId){
    //     if ($sireId != $this->config->item('sireId')){
    //         $sql = "SELECT (SELECT ca.can_a_s FROM canines ca WHERE ca.can_id = p.ped_dam_id) AS spouse, p.ped_dam_id AS spouseId, c.can_id AS siblingId, c.can_a_s AS sibling, DATE_FORMAT(c.can_date_of_birth, '%d-%m-%Y') AS dob FROM canines c, pedigrees p WHERE c.can_id = p.ped_canine_id AND p.ped_sire_id = ".$sireId." ORDER BY c.can_date_of_birth DESC, p.ped_dam_id";
    //         $query = $this->db->query($sql);
            
    //         return $query->result();
    //     }
    //     else{
    //         return null;
    //     }
    // }

    // public function get_sire_sibling($damId){
    //     if ($damId != $this->config->item('damId')){
    //         $sql = "SELECT (SELECT ca.can_a_s FROM canines ca WHERE ca.can_id = p.ped_sire_id) AS spouse, p.ped_sire_id AS spouseId, c.can_id AS siblingId, c.can_a_s AS sibling, DATE_FORMAT(c.can_date_of_birth, '%d-%m-%Y') AS dob FROM canines c, pedigrees p WHERE c.can_id = p.ped_canine_id AND  p.ped_dam_id = ".$damId." ORDER BY c.can_date_of_birth DESC, p.ped_sire_id";
    //         $query = $this->db->query($sql);
            
    //         return $query->result();
    //     }
    //     else{
    //         return null;
    //     }
    // }

    // public function get_all_with_no_pedigrees(){
    //     $sql = "select can_id from canines where can_id not in (select ped_canine_id from pedigrees)";
    //     $query = $this->db->query($sql);
        
    //     return $query->result();
    // }

    // public function search_by_icr_number($q){
    //     $date = '';
    //     $piece = explode("-", $q);
    //     if (count($piece) == 3){
    //         $date = $piece[2]."-".$piece[1]."-".$piece[0];
    //     }

    //     $sql = "select * from canines c, members m, kennels k where c.can_member_id = m.mem_id AND m.mem_ken_id = k.ken_id AND c.can_stat = 1 AND (c.can_icr_number LIKE '%".$q."%' OR c.can_chip_number LIKE '%".$q."%' OR c.can_a_s LIKE '%".$q."%' OR k.ken_name LIKE '%".$q."%'";
    //     if ($date)
    //         $sql .= " OR c.can_date_of_birth LIKE '%".$date."%')";
    //     else
    //         $sql .= ")";
    //     $sql .= " ORDER BY c.can_icr_number";
    //     $query = $this->db->query($sql);
        
    //     return $query->result();
    // }

    // public function check_icr_number($id, $num){
    //     $sql = "select * from canines where can_icr_number = '".$num."'";
    //     if ($id){
    //         $sql .= ' AND can_id <> '.$id;
    //     }
    //     $query = $this->db->query($sql);
        
    //     return count($query->result());
    // }

    // public function check_microchip_number($id, $num){
    //     $sql = "select * from canines where can_chip_number = '".$num."'";
    //     if ($id){
    //         $sql .= ' AND can_id <> '.$id;
    //     }
    //     $query = $this->db->query($sql);
        
    //     return count($query->result());
    // }

    // public function get_members_canines(){
    //     $member = $this->session->userdata('member_data');

    //     $this->db->select('*');
    //     $this->db->from('canines');
    //     $this->db->join('members','members.mem_id = canines.can_member_id');
    //     $this->db->join('users','users.use_id = canines.can_app_user');
    //     $this->db->join('approval_status','approval_status.stat_id = canines.can_app_stat');
    //     $this->db->where('members.mem_id', $member['mem_id']);
    //     $this->db->where('canines.can_stat', 1);
    //     $this->db->order_by('can_id', 'desc');
    //     return $this->db->get();
    // }

    // public function get_members_canine($id){
    //     $member = $this->session->userdata('member_data');

    //     $this->db->select('*');
    //     $this->db->from('canines');
    //     $this->db->join('members','members.mem_id = canines.can_member_id');
    //     $this->db->where('members.mem_id', $member['mem_id']);
    //     $this->db->where('canines.can_stat', 1);
    //     $this->db->where('canines.can_id', $id);
    //     $this->db->order_by('can_id', 'desc');
    //     return $this->db->get();
    // }

    // public function search_by_member($q){
    //     $date = '';
    //     $piece = explode("-", $q);
    //     if (count($piece) == 3){
    //         $date = $piece[2]."-".$piece[1]."-".$piece[0];
    //     }

    //     $member = $this->session->userdata('member_data');

    //     $sql = "select * from canines c, members m, kennels k where m.mem_id = c.can_member_id AND m.mem_id = ".$member['mem_id']." AND m.mem_ken_id = k.ken_id AND c.can_stat = 1 AND (c.can_icr_number LIKE '%".$q."%' OR c.can_chip_number LIKE '%".$q."%' OR c.can_a_s LIKE '%".$q."%' OR k.ken_name LIKE '%".$q."%'";
    //     if ($date)
    //         $sql .= " OR c.can_date_of_birth LIKE '%".$date."%')";
    //     else
    //         $sql .= ")";
    //     $sql .= " ORDER BY can_a_s";
    //     $query = $this->db->query($sql);
        
    //     return $query->result();
    // }

    public function check_can_a_s($id, $name){
        $sql = "select * from canines where can_a_s = '".$name."' AND can_app_stat = ".$this->config->item('accepted');
        if ($id){
            $sql .= ' AND can_id <> '.$id;
        }
        $query = $this->db->query($sql);
        return count($query->result());
    }

    public function search_by_member_app($q, $can_member, $offset){ 
        $date = '';
        $sql = "SELECT * FROM canines c, members m, kennels k, users u, approval_status a WHERE c.can_member_id = m.mem_id AND k.ken_member_id = m.mem_id AND k.ken_id = c.can_kennel_id AND c.can_stat = 1 AND u.use_id = c.can_app_user AND a.stat_id = c.can_app_stat";
        if ($can_member)
            $sql .= " AND m.mem_id = ".$can_member;
        if ($q){
            $sql .= " AND (c.can_icr_number LIKE '%".$q."%' OR c.can_chip_number LIKE '%".$q."%' OR c.can_a_s LIKE '%".$q."%' OR k.ken_name LIKE '%".$q."%'";
            $piece = explode("-", $q);
            if (count($piece) == 3)
                $date = $piece[2]."-".$piece[1]."-".$piece[0];
        }
        if ($date)
            $sql .= " OR c.can_date_of_birth LIKE '%".$date."%'";
        if ($q)
            $sql .= ")";
        $sql .= " ORDER BY can_a_s LIMIT ".$offset.", ".$this->config->item('canine_count');
        $query = $this->db->query($sql);
        return $query->result();
    }

    function search_count_by_member_app($q, $can_member){
        $date = '';
		$sql = "SELECT COUNT(*) AS count FROM canines c, members m, kennels k, users u, approval_status a WHERE c.can_member_id = m.mem_id AND k.ken_member_id = m.mem_id AND k.ken_id = c.can_kennel_id AND c.can_stat = 1 AND u.use_id = c.can_app_user AND a.stat_id = c.can_app_stat";
		if ($can_member)
            $sql .= " AND m.mem_id = ".$can_member;
        if ($q){
            $sql .= " AND (c.can_icr_number LIKE '%".$q."%' OR c.can_chip_number LIKE '%".$q."%' OR c.can_a_s LIKE '%".$q."%' OR k.ken_name LIKE '%".$q."%'";
            $piece = explode("-", $q);
            if (count($piece) == 3)
                $date = $piece[2]."-".$piece[1]."-".$piece[0];
        }
        if ($date)
            $sql .= " OR c.can_date_of_birth LIKE '%".$date."%'";
        if ($q)
            $sql .= ")";
        $query = $this->db->query($sql);
        return $query->result();  
	}

    public function get_siblings($canineId, $damId, $sireId){
        $this->db->select('can_a_s');
        $this->db->where('ped_sire_id != ', $this->config->item('sire_id'));
        $this->db->where('ped_dam_id != ', $this->config->item('dam_id'));
        $this->db->where('ped_sire_id = ', $sireId);
        $this->db->where('ped_dam_id = ', $damId);
        $this->db->where('ped_canine_id != ', $canineId);
        $this->db->from('pedigrees');
        $this->db->join('canines','canines.can_id = pedigrees.ped_canine_id');
        $this->db->order_by('can_id', 'desc');
        return $this->db->get();
    }
}
