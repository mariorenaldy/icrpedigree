<?php
class StambumModel extends CI_Model {
    public function __construct(){
        date_default_timezone_set("Asia/Bangkok");
    }

    public function get_stambum($where, $sort = 'stb_id desc', $offset = 0, $limit = 0){
        $this->db->select('*, DATE_FORMAT(stambums.stb_date_of_birth, "%d-%m-%Y") as stb_date_of_birth, DATE_FORMAT(stambums.stb_app_date, "%d-%m-%Y") as stb_app_date');
        if ($where != null) {
            $this->db->where($where);
        }
        $this->db->join('approval_status','approval_status.stat_id = stambums.stb_stat');
        $this->db->join('members','members.mem_id = stambums.stb_member_id');
        $this->db->join('kennels','kennels.ken_id = stambums.stb_kennel_id AND kennels.ken_member_id = members.mem_id');
        $this->db->join('users', 'stambums.stb_app_user = users.use_id');
        $this->db->order_by($sort);
        if ($limit)
            $this->db->limit($limit, $offset);
        return $this->db->get('stambums');
    }

    public function search_stambum($like, $where, $sort = 'stb_id desc', $offset = 0, $limit = 0){
        $this->db->select('*, DATE_FORMAT(stambums.stb_date_of_birth, "%d-%m-%Y") as stb_date_of_birth, DATE_FORMAT(stambums.stb_app_date, "%d-%m-%Y") as stb_app_date');
        if ($where != null) {
            $this->db->where($where);
        }
        if ($like != null) {
            $this->db->group_start();
            $this->db->or_like($like);
            $this->db->group_end();
        }
        $this->db->join('approval_status','approval_status.stat_id = stambums.stb_stat');
        $this->db->join('members','members.mem_id = stambums.stb_member_id');
        $this->db->join('kennels','kennels.ken_id = stambums.stb_kennel_id AND kennels.ken_member_id = members.mem_id');
        $this->db->join('users', 'stambums.stb_app_user = users.use_id');
        $this->db->order_by($sort);
        if ($limit)
            $this->db->limit($limit, $offset);
        return $this->db->get('stambums');
    }

    public function get_count($where){
        $this->db->select('stb_id');
        if ($where != null) {
            $this->db->where($where);
        }
        return count($this->db->get('stambums')->result());
    }

    public function add_stambum($data){
        $this->db->insert('stambums', $data);
        return $this->db->insert_id();
    }

    public function update_stambum($data, $where){
        $this->db->set($data);
        $this->db->where($where);
        return $this->db->update('stambums');
    }

    // public function search_by_member_app($q, $can_member, $offset){ 
    //     $date = '';
    //     $sql = "SELECT * FROM stambum c, members m, kennels k, users u, approval_status a WHERE c.can_member_id = m.mem_id AND k.ken_member_id = m.mem_id AND k.ken_id = c.can_kennel_id AND c.can_stat = 1 AND u.use_id = c.can_app_user AND a.stat_id = c.can_app_stat";
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
	// 	$sql = "SELECT COUNT(*) AS count FROM stambum c, members m, kennels k, users u, approval_status a WHERE c.can_member_id = m.mem_id AND k.ken_member_id = m.mem_id AND k.ken_id = c.can_kennel_id AND c.can_stat = 1 AND u.use_id = c.can_app_user AND a.stat_id = c.can_app_stat";
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
