<?php

class BirthModel extends CI_Model {
    public function __construct(){
        date_default_timezone_set("Asia/Bangkok");
    }

    public function record_count() {
        return $this->db->count_all("births");
    }

    public function accepted_count() {
        $ignoreStat = array($this->config->item('deleted'), $this->config->item('rejected'));
        $this->db->where_not_in('bir_stat', $ignoreStat);
        $this->db->from("births");
        return $this->db->count_all_results();
    }

    public function get_births($where, $offset = 0, $limit = 0){
        $this->db->select('*, DATE_FORMAT(bir_date_of_birth, "%d-%m-%Y") as bir_date_of_birth, DATE_FORMAT(bir_app_date, "%d-%m-%Y") as bir_app_date, can_sire.can_a_s AS sire, can_sire.can_id AS sire_id, can_dam.can_a_s AS dam, can_dam.can_id AS dam_id, DATE_FORMAT(stu_stud_date, "%d-%m-%Y") as stu_stud_date');
        if ($where != null) {
            $this->db->where($where);
        }
        $this->db->join('studs','studs.stu_id = births.bir_stu_id');
        $this->db->join('members','members.mem_id = births.bir_member_id AND members.mem_id = studs.stu_partner_id');
        $this->db->join('kennels','kennels.ken_member_id = members.mem_id', 'left');
        $this->db->join('canines can_sire','can_sire.can_id = studs.stu_sire_id');
        $this->db->join('canines can_dam','can_dam.can_id = studs.stu_dam_id');
        $this->db->join('users','users.use_id = births.bir_app_user');
        $this->db->join('approval_status','approval_status.stat_id = births.bir_stat');
        $this->db->order_by('births.bir_date_of_birth', 'desc');
        if ($limit)
            $this->db->limit($limit, $offset);
        return $this->db->get('births');
    }

    public function search_births($like, $where, $offset = 0, $limit = 0){
        $this->db->select('*, DATE_FORMAT(bir_date_of_birth, "%d-%m-%Y") as bir_date_of_birth, DATE_FORMAT(bir_app_date, "%d-%m-%Y") as bir_app_date, can_sire.can_a_s AS sire, can_sire.can_id AS sire_id, can_dam.can_a_s AS dam, can_dam.can_id AS dam_id, DATE_FORMAT(stu_stud_date, "%d-%m-%Y") as stu_stud_date');
        if ($where != null) {
            $this->db->where($where);
        }
        if ($like != null) {
            $this->db->group_start();
            $this->db->or_like($like);
            $this->db->group_end();
        }
        $this->db->join('studs','studs.stu_id = births.bir_stu_id');
        $this->db->join('members','members.mem_id = births.bir_member_id AND members.mem_id = studs.stu_partner_id');
        $this->db->join('kennels','kennels.ken_member_id = members.mem_id', 'left');
        $this->db->join('canines can_sire','can_sire.can_id = studs.stu_sire_id');
        $this->db->join('canines can_dam','can_dam.can_id = studs.stu_dam_id');
        $this->db->join('users','users.use_id = births.bir_app_user');
        $this->db->join('approval_status','approval_status.stat_id = births.bir_stat');
        $this->db->order_by('births.bir_date_of_birth', 'desc');
        if ($limit)
            $this->db->limit($limit, $offset);
        return $this->db->get('births');
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
        $sql = "SELECT b.bir_date_of_birth FROM births b, studs s where b.bir_stu_id = s.stu_id AND s.stu_dam_id = ".$stu_dam_id." AND ABS(DATEDIFF(b.bir_date_of_birth, '".$date."')) <= ".$this->config->item('jarak_pacak_lahir')." AND s.stu_stat = ".$this->config->item('completed')." AND b.bir_stat = ".$this->config->item('accepted');
        $query = $this->db->query($sql);
        return $query->result();
    }

    public function getMonthlyData($year = null){
        $this->db->select("DATE_FORMAT(bir_reg_date, '%b %Y') as month, COUNT(bir_id) as total_birth");
        $this->db->from('births');
        if($year == null){
            $this->db->where('YEAR(bir_reg_date) = YEAR(CURDATE())');
        }
        else{
            $this->db->where('YEAR(bir_reg_date) = '.$year);
        }
        $this->db->group_by("DATE_FORMAT(bir_reg_date, '%b %Y')");
        $this->db->order_by("bir_reg_date", 'ASC');
        $ignore = array($this->config->item('deleted'), $this->config->item('rejected'));
        $this->db->where_not_in('bir_stat', $ignore);

        $query = $this->db->get();
        
        return $query->result();
    }
}
