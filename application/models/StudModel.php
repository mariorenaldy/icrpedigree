<?php

class StudModel extends CI_Model {
    public function __construct(){
        date_default_timezone_set("Asia/Bangkok");
    }

    public function get_studs($where, $offset = 0, $limit = 0){
        $this->db->select('*, can_sire.can_photo AS sire_photo, can_dam.can_photo AS dam_photo, can_sire.can_a_s AS sire_a_s, can_dam.can_a_s AS dam_a_s, DATE_FORMAT(stu_stud_date, "%d-%m-%Y") as stu_stud_date, DATE_FORMAT(stu_app_date, "%d-%m-%Y") as stu_app_date');
        if ($where != null){
            $this->db->where($where);
        }
        $this->db->join('users','users.use_id = studs.stu_app_user');
        $this->db->join('approval_status','approval_status.stat_id = studs.stu_stat');
        $this->db->join('canines AS can_sire','can_sire.can_id = studs.stu_sire_id');
        $this->db->join('canines AS can_dam','can_dam.can_id = studs.stu_dam_id');
        $this->db->order_by('studs.stu_stud_date', 'desc');
        if ($limit)
            $this->db->limit($limit, $offset);
        return $this->db->get('studs');
    }

    public function search_studs($like, $where, $offset = 0, $limit = 0){
        $this->db->select('*, can_sire.can_photo AS sire_photo, can_dam.can_photo AS dam_photo, can_sire.can_a_s AS sire_a_s, can_dam.can_a_s AS dam_a_s, DATE_FORMAT(stu_stud_date, "%d-%m-%Y") as stu_stud_date, DATE_FORMAT(stu_app_date, "%d-%m-%Y") as stu_app_date');
        if ($where != null){
            $this->db->where($where);
        }
        if ($like != null) {
            $this->db->group_start();
            $this->db->or_like($like);
            $this->db->group_end();
        }
        $this->db->join('users','users.use_id = studs.stu_app_user');
        $this->db->join('approval_status','approval_status.stat_id = studs.stu_stat');
        $this->db->join('canines AS can_sire','can_sire.can_id = studs.stu_sire_id');
        $this->db->join('canines AS can_dam','can_dam.can_id = studs.stu_dam_id');
        $this->db->order_by('studs.stu_stud_date', 'desc');
        if ($limit)
            $this->db->limit($limit, $offset);
        return $this->db->get('studs');
    }

    // public function search_by_member_app($q, $stu_member, $offset){
    //     $date = '';
    //     if ($q){
    //         $piece = explode("-", $q);
    //         if (count($piece) == 3){
    //             $date = $piece[2]."-".$piece[1]."-".$piece[0];
    //         }
    //     }

    //     $sql = "SELECT * FROM studs s, users u, members m, approval_status a WHERE u.use_id = s.stu_app_user AND a.stat_id = s.stu_stat AND m.mem_id = s.stu_member_id AND m.mem_id = ".$stu_member;
    //     if ($date)
    //         $sql .= " AND s.stu_date LIKE '%".$date."%'";
    //     $sql .= " ORDER BY s.stu_date DESC LIMIT ".$offset.", ".$this->config->item('stud_count');
    //     $query = $this->db->query($sql);
    //     return $query->result();
    // }

    // public function search_count_by_member_app($q, $stu_member){
    //     $date = '';
    //     if ($q){
    //         $piece = explode("-", $q);
    //         if (count($piece) == 3){
    //             $date = $piece[2]."-".$piece[1]."-".$piece[0];
    //         }
    //     }

    //     $sql = "SELECT COUNT(*) AS count FROM studs s, users u, members m, approval_status a WHERE u.use_id = s.stu_app_user AND a.stat_id = s.stu_stat AND m.mem_id = s.stu_member_id AND m.mem_id = ".$stu_member;
    //     if ($date)
    //         $sql .= " AND s.stu_date LIKE '%".$date."%'";
    //     $query = $this->db->query($sql);
    //     return $query->result();
    // }

    public function add_studs($data){
        $this->db->insert('studs', $data);
        return $this->db->insert_id();
    }

    public function update_studs($data, $where){
        $this->db->set($data);
        $this->db->where($where);
        return $this->db->update('studs');
    }

    public function check_date($stu_dam_id, $date){
        $sql = "SELECT stu_stud_date FROM studs s where s.stu_dam_id = ".$stu_dam_id." AND ABS(DATEDIFF(s.stu_stud_date, '".$date."')) <= ".$this->config->item('jarak_pacak')." AND s.stu_stat IN (".$this->config->item('accepted').', '.$this->config->item('completed').')';
        $query = $this->db->query($sql);
        return $query->result();
    }

    public function check_siblings($canineId, $sireId, $damId, $dob = null){
        $this->db->select('can_id');
        $this->db->from('pedigrees');
        $this->db->join('canines','pedigrees.ped_canine_id = canines.can_id');
        $this->db->where('ped_sire_id', $sireId);
        $this->db->where('ped_dam_id', $damId);
        $this->db->where('ped_canine_id != ', $canineId);
        if ($dob)
            $this->db->where('can_date_of_birth', $dob);
        $this->db->order_by('can_id');
        return $this->db->get();
    }
}
