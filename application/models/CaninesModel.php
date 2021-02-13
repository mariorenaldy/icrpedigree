<?php
class CaninesModel extends CI_Model {
    public function __construct(){
        parent::__construct();
    }

    // public function getCanines(){
    //   $query = $this->db->query("call getCanine()");
    //   return $query->result();
    // }

    public function get_search($q){

      $this->db->select('can_photo , can_id, can_a_s, can_icr_number, can_icr_moc_number ');
      $this->db->like('can_a_s', $q);
      $this->db->or_like('can_icr_number', $q);
      $this->db->or_like('can_icr_moc_number', $q);
      $this->db->order_by('can_id', 'desc');
      return $this->db->get('canines');
    }


    public function sire_search($q = null){

      $this->db->select('can_id as id, can_a_s as text');
      if (isset($q)) {
        $this->db->like('can_a_s', $q);
      }
      // $this->db->or_like('std_full_name', $q);
      $this->db->where('can_gender','Male');
      $this->db->order_by('can_id', 'desc');
      return $this->db->get('canines');

      // $query = $this->db->query('SELECT std_nrp , std_full_name, std_photo
      //                         FROM silp_students WHERE std_nrp like %'+$q+'%
      //                         OR std_full_name like %'+$q+'%');
      // return $query;
    }



    public function dam_search($q = null){

      $this->db->select('can_id as id, can_a_s as text');
      if (isset($q)) {
          $this->db->like('can_a_s', $q);
      }
      // $this->db->or_like('std_full_name', $q);
      $this->db->where('can_gender','Female');
      $this->db->order_by('can_id', 'desc');
      return $this->db->get('canines');
    }

    public function breeder_search($q){

      $this->db->select('can_owner_name');
      $this->db->like('can_owner_name', $q);
      $this->db->order_by('can_id', 'desc');
      return $this->db->get('canines');
    }

    public function kennel_search($q){

      $this->db->select('can_cage');
      $this->db->like('can_cage', $q);
      $this->db->order_by('can_id', 'desc');
      return $this->db->get('canines');
    }

    public function address_search($q){

      $this->db->select('can_address');
      $this->db->like('can_address', $q);
      $this->db->order_by('can_id', 'desc');
      return $this->db->get('canines');
    }

    public function owner_search($q){

      $this->db->select('can_owner');
      $this->db->like('can_owner', $q);
      $this->db->order_by('can_id', 'desc');
      return $this->db->get('canines');
    }

    public function owner_name_search($q){

        $this->db->select('can_owner_name');
        $this->db->like('can_owner_name', $q);
        $this->db->order_by('can_id', 'desc');
        return $this->db->get('canines');
      }

    // public function get_canines($where = null){
    //     $this->db->select('*');
    //     if ($where != null) {
    //         $this->db->where($where);
    //     }
    //     $this->db->order_by('can_id', 'desc');
    //     return $this->db->get('canines');
    // }

    public function get_canines($where = null){
        $this->db->select('*');
        if ($where != null) {
            $this->db->where($where);
        }
        $this->db->order_by('can_id', 'desc');
        return $this->db->get('canines');
    }

    public function get_parent($where = null){
        $this->db->select('can_a_s, can_id');
        if ($where != null) {
            $this->db->where($where);
        }
        $this->db->order_by('can_id', 'desc');
        return $this->db->get('canines');
    }

    public function get_champions(){
        $this->db->select('can_a_s, can_breed, 	can_photo, can_score');
        $this->db->from('canines');
        $this->db->limit(3);
        $this->db->order_by('can_score', 'desc');
        return $this->db->get();
    }

    public function get_can_pedigrees($where = null){
        // ARTechnology
        $this->db->select('*, DATE_FORMAT(canines.can_date_of_birth, "%d-%m-%Y") as can_date_of_birth');
        // $this->db->select('*');
        // ARTechnology
        if ($where != null) {
            $this->db->where($where);
        }
        $this->db->from('canines');
        $this->db->join('pedigrees','pedigrees.ped_canine_id = canines.can_id');
        $this->db->join('members','members.mem_id = canines.can_member');
        $this->db->join('kennels','kennels.ken_id = members.mem_ken_id');
        $this->db->order_by('can_id', 'desc');
        return $this->db->get();
    }

    public function add_canines($data = null){
        $result = false;
        if ($data != null) {
            $this->db->insert('canines', $data);
            $result = $this->db->insert_id();
        }
        return $result;
    }

    public function update_canines($data = null, $where = null){
        $result = false;
        if($data != null && $where != null){
            $this->db->set($data);
            $this->db->where($where);
            $this->db->update('canines');
        }
        return $result;
    }

    public function remove_canines($where = null){
        if($where != null){
            // ARTechnology
            return $this->db->delete('canines', $where);
            // $data = array(
            //     'can_stat' => 0
            // );

            // $this->db->where($where);
            // $edit = $this->db->update('canines', $data);

            // return $edit;
            // ARTechnology
        }
    }

    // ARTechnology
    public function get_dob_by_id($id){
        $sql = "SELECT DATE_FORMAT(can_date_of_birth, '%Y-%m-%d') as can_date_of_birth FROM canines WHERE can_id = ".$id;
        $query = $this->db->query($sql);
        
        return $query->result();
    } 

    public function get_date_compare_sibling($damId, $dob){
        $sql = "SELECT datediff(DATE_FORMAT(c.can_date_of_birth, '%Y-%m-%d'), '".$dob."') as diff FROM canines c, pedigrees p WHERE c.can_id = p.ped_canine_id AND p.ped_mom_id = ".$damId;
        $query = $this->db->query($sql);
        
        return $query->result();
    }

    public function get_date_compare_sibling_by_id($damId, $dob, $id){
        $sql = "SELECT datediff(DATE_FORMAT(c.can_date_of_birth, '%Y-%m-%d'), '".$dob."') as diff FROM canines c, pedigrees p WHERE c.can_id = p.ped_canine_id AND p.ped_mom_id = ".$damId." AND c.can_id <> ".$id;
        $query = $this->db->query($sql);
        
        return $query->result();
    }

    public function is_sire($id){
        $sql = "SELECT can_gender FROM canines WHERE can_id = ".$id;
        $query = $this->db->query($sql);
            
        return ($query->result()[0]->can_gender == 'Male');
    }

    public function get_dam_sibling($sireId){
        if ($sireId != 86){
            $sql = "SELECT (SELECT ca.can_a_s FROM canines ca WHERE ca.can_id = p.ped_mom_id) AS spouse, p.ped_mom_id AS spouseId, c.can_id AS siblingId, c.can_a_s AS sibling, DATE_FORMAT(c.can_date_of_birth, '%d-%m-%Y') AS dob FROM canines c, pedigrees p WHERE c.can_id = p.ped_canine_id AND p.ped_sire_id = ".$sireId." ORDER BY c.can_date_of_birth DESC, p.ped_mom_id";
            $query = $this->db->query($sql);
            
            return $query->result();
        }
        else{
            return null;
        }
    }

    public function get_sire_sibling($damId){
        if ($damId != 87){
            $sql = "SELECT (SELECT ca.can_a_s FROM canines ca WHERE ca.can_id = p.ped_sire_id) AS spouse, p.ped_sire_id AS spouseId, c.can_id AS siblingId, c.can_a_s AS sibling, DATE_FORMAT(c.can_date_of_birth, '%d-%m-%Y') AS dob FROM canines c, pedigrees p WHERE c.can_id = p.ped_canine_id AND  p.ped_mom_id = ".$damId." ORDER BY c.can_date_of_birth DESC, p.ped_sire_id";
            $query = $this->db->query($sql);
            
            return $query->result();
        }
        else{
            return null;
        }
    }

    public function get_all_with_no_pedigrees(){
        $sql = "select can_id from canines where can_id not in (select ped_canine_id from pedigrees)";
        $query = $this->db->query($sql);
        
        return $query->result();
    }

    public function set_active($id, $status){
        $data = array(
            'can_stat' => $status
        );
        $this->db->where('can_id', $id);

        $edit = $this->db->update('canines', $data);

		return $edit; 
    }

    public function search_by_icr_number($q){
        $date = '';
        $piece = explode("-", $q);
        if (count($piece) == 3){
            $date = $piece[2]."-".$piece[1]."-".$piece[0];
        }

        $sql = "select * from canines c, members m, kennels k where c.can_member = m.mem_id AND m.mem_ken_id = k.ken_id AND c.can_stat = 1 AND (c.can_icr_number LIKE '%".$q."%' OR c.can_icr_moc_number LIKE '%".$q."%' OR c.can_a_s LIKE '%".$q."%' OR c.can_cage LIKE '%".$q."%'";
        if ($date)
            $sql .= " OR c.can_date_of_birth LIKE '%".$date."%')";
        else
            $sql .= ")";
        $sql .= " ORDER BY c.can_icr_number";
        $query = $this->db->query($sql);
        
        return $query->result();
    }

    public function check_icr_number($id, $num){
        $sql = "select * from canines where can_icr_number = '".$num."'";
        if ($id){
            $sql .= ' AND can_id <> '.$id;
        }
        $query = $this->db->query($sql);
        
        return count($query->result());
    }

    public function check_microchip_number($id, $num){
        $sql = "select * from canines where can_icr_moc_number = '".$num."'";
        if ($id){
            $sql .= ' AND can_id <> '.$id;
        }
        $query = $this->db->query($sql);
        
        return count($query->result());
    }

    public function set_print($id, $count){
        $data = array(
            'can_print' => $count
        );
        $this->db->where('can_id', $id);

        $edit = $this->db->update('canines', $data);

		return $edit; 
    }

    public function get_members_canines(){
        $member = $this->session->userdata('member_data');

        $this->db->select('*');
        $this->db->from('canines');
        $this->db->join('members','members.mem_id = canines.can_member');
        $this->db->where('members.mem_id', $member['mem_id']);
        $this->db->where('canines.can_stat', 1);
        $this->db->order_by('can_id', 'desc');
        return $this->db->get();
    }

    public function get_members_canine($id){
        $member = $this->session->userdata('member_data');

        $this->db->select('*');
        $this->db->from('canines');
        $this->db->join('members','members.mem_id = canines.can_member');
        $this->db->where('members.mem_id', $member['mem_id']);
        $this->db->where('canines.can_stat', 1);
        $this->db->where('canines.can_id', $id);
        $this->db->order_by('can_id', 'desc');
        return $this->db->get();
    }

    public function search_by_member($q){
        $date = '';
        $piece = explode("-", $q);
        if (count($piece) == 3){
            $date = $piece[2]."-".$piece[1]."-".$piece[0];
        }

        $member = $this->session->userdata('member_data');

        $sql = "select * from canines c, members m, kennels k where m.mem_id = c.can_member AND m.mem_id = ".$member['mem_id']." AND m.mem_ken_id = k.ken_id AND c.can_stat = 1 AND (c.can_icr_number LIKE '%".$q."%' OR c.can_icr_moc_number LIKE '%".$q."%' OR c.can_a_s LIKE '%".$q."%' OR c.can_cage LIKE '%".$q."%'";
        if ($date)
            $sql .= " OR c.can_date_of_birth LIKE '%".$date."%')";
        else
            $sql .= ")";
        $sql .= " ORDER BY can_a_s";
        $query = $this->db->query($sql);
        
        return $query->result();
    }

    public function add_canine($bir_photo, $bir_a_s, $bir_breed, $bir_gender, $bir_color, $bir_date_of_birth, $bir_cage, $bir_owner_name, $bir_member){
        $data = array(
            'can_member' => $bir_member,
            'can_photo' => $bir_photo,
            'can_a_s' => $bir_a_s,
            'can_breed' => $bir_breed,
            'can_gender' => $bir_gender,
            'can_color' => $bir_color,
            'can_date_of_birth' => $bir_date_of_birth,
            'can_cage' => $bir_cage,
            'can_owner_name' => $bir_owner_name,
            'can_reg_date' => date('Y-m-d H:i:s'),
            'can_current_reg_number' => '-',
            'can_icr_number' => '-',
            'can_icr_moc_number' => '-',
            'can_address' => '-',
            'can_owner' => $bir_owner_name
        );

        $this->db->insert('canines', $data);
        $result = $this->db->insert_id();

		return $result; 
    }

    public function check_can_a_s($id, $name){
        $sql = "select * from canines where can_a_s = '".$name."'";
        if ($id){
            $sql .= ' AND can_id <> '.$id;
        }
        $query = $this->db->query($sql);
        
        return count($query->result());
    }
    // ARTechnology
}
