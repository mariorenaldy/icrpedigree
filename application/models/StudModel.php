<?php

class StudModel extends CI_Model {
    public function __construct(){
        date_default_timezone_set("Asia/Bangkok");
    }

    // public function record_count() {
    //   return $this->db->count_all("studs");
    // }

    // public function fetch_data($num, $offset) {
    //   $this->db->order_by('stu_id', 'desc');
    //   $data = $this->db->get('studs', $num, $offset);
    //   return $data;
    // }

    public function get_studs($where){
        $this->db->select('*, can_sire.can_photo AS sire_photo, can_dam.can_photo AS dam_photo, can_sire.can_a_s AS sire_a_s, can_dam.can_a_s AS dam_a_s, DATE_FORMAT(stu_stud_date, "%d-%m-%Y") as stu_stud_date');
        $this->db->from('studs');
        if ($where != null)
            $this->db->where($where);
        $this->db->join('users','users.use_id = studs.stu_app_user');
        $this->db->join('approval_status','approval_status.stat_id = studs.stu_stat');
        $this->db->join('canines AS can_sire','can_sire.can_id = studs.stu_sire_id');
        $this->db->join('canines AS can_dam','can_dam.can_id = studs.stu_dam_id');
        $this->db->order_by('studs.stu_date', 'desc');
        $this->db->limit($this->config->item('backend_stud_count'), 0);
        return $this->db->get();
    }

    // public function get_member_studs($where = null){
    //     $user = $this->session->userdata('member_data');
    //     $this->db->select('*');
    //     $this->db->from('studs');
    //     if ($where != null) {
    //         $this->db->where($where);
    //     }
    //     $this->db->join('users','users.use_id = studs.stu_app_user');
    //     $this->db->join('approval_status','approval_status.stat_id = studs.stu_stat');
    //     $this->db->join('members','members.mem_id = studs.stu_member');
    //     $this->db->where('mem_id', $user['mem_id']);
    //     $this->db->order_by('studs.stu_date', 'desc');
    //     return $this->db->get();
    // }

    // public function get_non_approved_studs($where = null){ 
    //     $this->db->select('*, DATE_FORMAT(stu_stud_date, "%d-%m-%Y") as stu_stud_date');
    //     $this->db->from('studs');
    //     if ($where != null)
    //         $this->db->where($where);
    //     $this->db->join('users','users.use_id = studs.stu_app_user');
    //     $this->db->join('approval_status','approval_status.stat_id = studs.stu_stat');
    //     return $this->db->get();
    // }

    // public function search_by_member($q){
    //     $user = $this->session->userdata('member_data');
        
    //     $date = '';
    //     $piece = explode("-", $q);
    //     if (count($piece) == 3){
    //         $date = $piece[2]."-".$piece[1]."-".$piece[0];
    //     }

    //     $sql = "select * from studs s, users u, members m, approval_status a where u.use_id = s.stu_app_user AND a.stat_id = s.stu_stat AND m.mem_id = s.stu_member AND m.mem_id = ".$user['mem_id'];
    //     if ($date)
    //         $sql .= " AND s.stu_date LIKE '%".$date."%'";
    //     $sql .= " ORDER BY s.stu_date DESC";
    //     $query = $this->db->query($sql);
        
    //     return $query->result();
    // }

    public function search_by_member_app($q, $stu_member, $offset){
        $date = '';
        if ($q){
            $piece = explode("-", $q);
            if (count($piece) == 3){
                $date = $piece[2]."-".$piece[1]."-".$piece[0];
            }
        }

        $sql = "SELECT * FROM studs s, users u, members m, approval_status a WHERE u.use_id = s.stu_app_user AND a.stat_id = s.stu_stat AND m.mem_id = s.stu_member_id AND m.mem_id = ".$stu_member;
        if ($date)
            $sql .= " AND s.stu_date LIKE '%".$date."%'";
        $sql .= " ORDER BY s.stu_date DESC LIMIT ".$offset.", ".$this->config->item('stud_count');
        $query = $this->db->query($sql);
        return $query->result();
    }

    public function search_count_by_member_app($q, $stu_member){
        $date = '';
        if ($q){
            $piece = explode("-", $q);
            if (count($piece) == 3){
                $date = $piece[2]."-".$piece[1]."-".$piece[0];
            }
        }

        $sql = "SELECT COUNT(*) AS count FROM studs s, users u, members m, approval_status a WHERE u.use_id = s.stu_app_user AND a.stat_id = s.stu_stat AND m.mem_id = s.stu_member_id AND m.mem_id = ".$stu_member;
        if ($date)
            $sql .= " AND s.stu_date LIKE '%".$date."%'";
        $query = $this->db->query($sql);
        return $query->result();
    }

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
        $sql = "SELECT stu_stud_date FROM studs s where s.stu_dam_id = ".$stu_dam_id." AND ABS(DATEDIFF(s.stu_stud_date, '".$date."')) <= ".$this->config->item('jarak_pacak');
        $query = $this->db->query($sql);
        return $query->result();
    }
}
