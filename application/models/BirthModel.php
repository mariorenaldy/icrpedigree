<?php

class BirthModel extends CI_Model {
    public function __construct(){
        date_default_timezone_set("Asia/Bangkok");
    }

    public function get_births($where, $offset = 0, $limit = 1){
        $this->db->select('*, DATE_FORMAT(bir_date_of_birth, "%d-%m-%Y") as bir_date_of_birth, DATE_FORMAT(bir_app_date, "%d-%m-%Y") as bir_app_date, c1.can_a_s AS sire, c2.can_a_s AS dam, DATE_FORMAT(stu_stud_date, "%d-%m-%Y") as stu_stud_date');
        $this->db->from('births');
        if ($where != null) {
            $this->db->where($where);
        }
        $this->db->join('studs','studs.stu_id = births.bir_stu_id');
        $this->db->join('members','members.mem_id = births.bir_member_id AND members.mem_id = studs.stu_partner_id');
        $this->db->join('kennels','kennels.ken_member_id = members.mem_id');
        $this->db->join('canines c1','c1.can_id = studs.stu_sire_id');
        $this->db->join('canines c2','c2.can_id = studs.stu_dam_id');
        $this->db->join('users','users.use_id = births.bir_app_user');
        $this->db->join('approval_status','approval_status.stat_id = births.bir_stat');
        $this->db->order_by('births.bir_date_of_birth', 'desc');
        if ($limit)
            $this->db->limit($this->config->item('backend_birth_count'), $offset);
        return $this->db->get();
    }

    public function add_births($data){
        $this->db->insert('births', $data);
        return $this->db->insert_id();
    }

    public function update_births($data, $where){
        $this->db->set($data);
        $this->db->where($where);
        return $this->db->update('births');
    }

    public function check_date($stu_dam_id, $date){
        $sql = "SELECT b.bir_date_of_birth FROM births b, studs s where b.bir_stu_id = s.stu_id AND s.stu_dam_id = ".$stu_dam_id." AND ABS(DATEDIFF(b.bir_date_of_birth, '".$date."')) <= ".$this->config->item('jarak_pacak_lahir')." AND s.stu_stat = ".$this->config->item('accepted')." AND b.bir_stat = ".$this->config->item('accepted');
        $query = $this->db->query($sql);
        return $query->result();
    }
}
