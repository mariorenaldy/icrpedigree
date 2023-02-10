<?php

class BirthModel extends CI_Model {
    public function __construct(){
        date_default_timezone_set("Asia/Bangkok");
    }

    public function get_births($where){
        $this->db->select('*, DATE_FORMAT(bir_date_of_birth, "%d-%m-%Y") as bir_date_of_birth, DATE_FORMAT(bir_app_date, "%d-%m-%Y") as bir_app_date');
        $this->db->from('births');
        if ($where != null) {
            $this->db->where($where);
        }
        $this->db->join('studs','studs.stu_id = births.bir_stu_id');
        $this->db->join('members','members.mem_id = studs.stu_member_id');
        $this->db->join('kennels','kennels.ken_member_id = members.mem_id AND kennels.ken_member_id = studs.stu_member_id');
        $this->db->join('users','users.use_id = births.bir_app_user');
        $this->db->join('approval_status','approval_status.stat_id = births.bir_stat');
        $this->db->order_by('births.bir_date', 'desc');
        $this->db->limit($this->config->item('backend_birth_count'), 0);
        return $this->db->get();
    }

    // public function search_by_member_app($q, $bir_member, $offset){
    //     $date = '';
    //     if ($q){
    //         $piece = explode("-", $q);
    //         if (count($piece) == 3){
    //             $date = $piece[2]."-".$piece[1]."-".$piece[0];
    //         }
    //     }

    //     $sql = "SELECT * FROM births s, users u, members m, approval_status a WHERE u.use_id = s.bir_app_user AND a.stat_id = s.bir_stat AND m.mem_id = s.bir_member_id AND m.mem_id = ".$bir_member;
    //     if ($date)
    //         $sql .= " AND s.bir_date_of_birth LIKE '%".$date."%'";
    //     $sql .= " ORDER BY s.bir_date DESC LIMIT ".$offset.", ".$this->config->item('birth_count');
    //     $query = $this->db->query($sql);
    //     return $query->result();
    // }

    // public function search_count_by_member_app($q, $bir_member){
    //     $date = '';
    //     if ($q){
    //         $piece = explode("-", $q);
    //         if (count($piece) == 3){
    //             $date = $piece[2]."-".$piece[1]."-".$piece[0];
    //         }
    //     }

    //     $sql = "SELECT COUNT(*) AS count FROM births s, users u, members m, approval_status a WHERE u.use_id = s.bir_app_user AND a.stat_id = s.bir_stat AND m.mem_id = s.bir_member_id AND m.mem_id = ".$bir_member;
    //     if ($date)
    //         $sql .= " OR s.bir_date_of_birth LIKE '%".$date."%')";
    //     $query = $this->db->query($sql);
    //     return $query->result();
    // }

    public function add_births($data){
        $this->db->insert('births', $data);
        return $this->db->insert_id();
    }

    public function update_births($data, $where){
        $this->db->set($data);
        $this->db->where($where);
        return $this->db->update('births');
    }
}
