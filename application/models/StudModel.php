<?php

class StudModel extends CI_Model {
    public function __construct(){
        date_default_timezone_set("Asia/Bangkok");
    }

    public function record_count() {
        return $this->db->count_all("studs");
    }

    public function accepted_count() {
        $ignoreStat = array($this->config->item('deleted'), $this->config->item('rejected'));
        $this->db->where_not_in('stu_stat', $ignoreStat);
        $this->db->from("studs");
        return $this->db->count_all_results();
    }

    public function get_studs($where, $offset = 0, $limit = 0, $where_not_in = null){
        $this->db->select('*, can_sire.can_photo AS sire_photo, can_dam.can_photo AS dam_photo, can_sire.can_a_s AS sire_a_s, can_dam.can_a_s AS dam_a_s, DATE_FORMAT(stu_stud_date, "%d-%m-%Y") as stu_stud_date, DATE_FORMAT(stu_app_date, "%d-%m-%Y") as stu_app_date');
        if ($where != null){
            $this->db->where($where);
        }
        if ($where_not_in != null) {
            $this->db->where_not_in('stu_stat', $where_not_in);
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

    public function search_studs($like, $where, $offset = 0, $limit = 0, $where_not_in = null){
        $this->db->select('*, can_sire.can_photo AS sire_photo, can_dam.can_photo AS dam_photo, can_sire.can_a_s AS sire_a_s, can_dam.can_a_s AS dam_a_s, DATE_FORMAT(stu_stud_date, "%d-%m-%Y") as stu_stud_date, DATE_FORMAT(stu_app_date, "%d-%m-%Y") as stu_app_date');
        if ($where != null){
            $this->db->where($where);
        }
        if ($where_not_in != null) {
            $this->db->where_not_in('stu_stat', $where_not_in);
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

    public function getMonthlyData($year = null){
        $this->db->select("DATE_FORMAT(stu_reg_date, '%b %Y') as month, COUNT(stu_id) as total_stud");
        $this->db->from('studs');
        if($year == null){
            $this->db->where('YEAR(stu_reg_date) = YEAR(CURDATE())');
        }
        else{
            $this->db->where('YEAR(stu_reg_date) = '.$year);
        }
        $this->db->group_by("DATE_FORMAT(stu_reg_date, '%b %Y')");
        $this->db->order_by("stu_reg_date", 'ASC');
        $ignore = array($this->config->item('deleted'), $this->config->item('rejected'));
        $this->db->where_not_in('stu_stat', $ignore);

        $query = $this->db->get();
        
        return $query->result();
    }
}
