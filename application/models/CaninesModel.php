<?php
class CaninesModel extends CI_Model {
    public function __construct(){
        date_default_timezone_set("Asia/Bangkok");
    }

    public function record_count() {
        return $this->db->count_all("canines");
    }

    public function accepted_count() {
        $ignore = array($this->config->item('dam_id'), $this->config->item('sire_id'));
        $ignoreStat = array($this->config->item('deleted'), $this->config->item('rejected'));
        $this->db->where_not_in('can_id', $ignore);
        $this->db->where_not_in('can_stat', $ignoreStat);
        $this->db->from("canines");
        return $this->db->count_all_results();
    }

    public function get_canines($where, $sort = 'can_id desc', $offset = 0, $limit = 0, $where_not_in = null){
        $this->db->select('*, DATE_FORMAT(canines.can_date_of_birth, "%d-%m-%Y") as can_date_of_birth, DATE_FORMAT(canines.can_reg_date, "%d-%m-%Y") as can_reg_date, DATE_FORMAT(canines.can_app_date, "%d-%m-%Y") as can_app_date, DATE_FORMAT(canines.can_app_date, "%Y-%m-%d %H:%i:%s") as can_app_date2, , DATE_FORMAT(canines.can_reg_date, "%Y-%m-%d %H:%i:%s") as can_reg_date2, DATE_FORMAT(canines.can_date_of_birth, "%Y-%m-%d") as can_date_of_birth2, DATE_FORMAT(canines.can_last_print, "%d-%m-%Y") as can_last_print, DATE_FORMAT(canines.can_date, "%d-%m-%Y") as can_date');
        if ($where != null) {
            $this->db->where($where);
        }
        if ($where_not_in != null) {
            $this->db->where_not_in('can_stat', $where_not_in);
        }
        $this->db->join('members','members.mem_id = canines.can_member_id');
        $this->db->join('kennels','kennels.ken_id = canines.can_kennel_id AND kennels.ken_member_id = members.mem_id', 'left');
        $this->db->join('payment_method','payment_method.pay_id = canines.can_pay_id' , 'left');
        $this->db->join('approval_status','approval_status.stat_id = canines.can_stat');
        $this->db->join('users', 'canines.can_app_user = users.use_id', 'left');
        $this->db->order_by($sort);
        if ($limit)
            $this->db->limit($limit, $offset);
        return $this->db->get('canines');
    }

    public function search_canines($like, $where, $sort = 'can_id desc', $offset = 0, $limit = 0, $where_not_in = null){
        $this->db->select('*, DATE_FORMAT(canines.can_date_of_birth, "%d-%m-%Y") as can_date_of_birth, DATE_FORMAT(canines.can_reg_date, "%d-%m-%Y") as can_reg_date, DATE_FORMAT(canines.can_app_date, "%d-%m-%Y") as can_app_date, DATE_FORMAT(canines.can_app_date, "%Y-%m-%d %H:%i:%s") as can_app_date2, DATE_FORMAT(canines.can_reg_date, "%Y-%m-%d %H:%i:%s") as can_reg_date2, DATE_FORMAT(canines.can_date_of_birth, "%Y-%m-%d") as can_date_of_birth2, DATE_FORMAT(canines.can_date, "%d-%m-%Y") as can_date');
        if ($where != null) {
            $this->db->where($where);
        }
        if ($where_not_in != null) {
            $this->db->where_not_in('can_stat', $where_not_in);
        }
        if ($like != null) {
            $this->db->group_start();
            $this->db->or_like($like);
            $this->db->group_end();
        }
        $this->db->join('members','members.mem_id = canines.can_member_id');
        $this->db->join('kennels','kennels.ken_id = canines.can_kennel_id AND kennels.ken_member_id = members.mem_id', 'left');
        $this->db->join('payment_method','payment_method.pay_id = canines.can_pay_id' , 'left');
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
        $this->db->select('*, DATE_FORMAT(canines.can_date_of_birth, "%d-%m-%Y") as can_date_of_birth, DATE_FORMAT(canines.can_reg_date, "%d-%m-%Y") as can_reg_date, DATE_FORMAT(canines.can_app_date, "%d-%m-%Y") as can_app_date, DATE_FORMAT(canines.can_last_print, "%d-%m-%Y") as can_last_print');
        if ($where != null) {
            $this->db->where($where);
        }
        $this->db->from('canines');
        $this->db->join('pedigrees','pedigrees.ped_canine_id = canines.can_id');
        $this->db->join('members','members.mem_id = canines.can_member_id');
        $this->db->join('kennels','kennels.ken_id = canines.can_kennel_id AND kennels.ken_member_id = members.mem_id', 'left');
        $this->db->order_by('can_id', 'desc');
        return $this->db->get();
    }

    public function get_exist_pedigrees($where){
        $this->db->select('can_id, can_a_s, can_photo, can_gender, ped_sire_id, ped_dam_id');
        if ($where != null) {
            $this->db->where($where);
        }
        $this->db->from('canines');
        $this->db->join('pedigrees','pedigrees.ped_canine_id = canines.can_id');
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
        $sql = "SELECT can_id from canines where ".$field." = '".$val."' AND can_stat IN (".$this->config->item('saved').", ".$this->config->item('accepted').", ".$this->config->item('not_paid').")";
        if ($id){
            $sql .= ' AND can_id <> '.$id;
        }
        $query = $this->db->query($sql);
        return count($query->result());
    }

    public function get_siblings($canineId, $sireId, $damId, $gender, $dob = null){
        $this->db->select('can_a_s');
        $this->db->from('pedigrees');
        $this->db->join('canines','pedigrees.ped_canine_id = canines.can_id');
        $this->db->where('ped_sire_id', $sireId);
        $this->db->where('ped_dam_id', $damId);
        $this->db->where('ped_canine_id != ', $canineId);
        $this->db->where('can_gender', $gender);
        if ($dob)
            $this->db->where('can_date_of_birth', $dob);
        $this->db->order_by('can_id');
        return $this->db->get();
    }

    public function get_random_canines($limit = 15){
        $this->db->order_by('id', 'RANDOM');
        $this->db->where('can_photo != ', '-');
        $this->db->where('can_member_id != ', $this->config->item('no_member'));
        $this->db->where('can_stat', $this->config->item('accepted'));
        $this->db->where('can_rip', $this->config->item('canine_alive'));
        $this->db->limit($limit);
        $query = $this->db->get('canines');
        return $query->result_array();
    }

    public function getMonthlyData($year = null){
        $this->db->select("DATE_FORMAT(can_reg_date, '%b %Y') as month, COUNT(can_id) as total_canine");
        $this->db->from('canines');
        if($year == null){
            $this->db->where('YEAR(can_reg_date) = YEAR(CURDATE())');
        }
        else{
            $this->db->where('YEAR(can_reg_date) = '.$year);
        }
        $this->db->group_by("DATE_FORMAT(can_reg_date, '%b %Y')");
        $this->db->order_by("can_reg_date", 'ASC');
        $ignore = array($this->config->item('deleted'), $this->config->item('rejected'));
        $this->db->where_not_in('can_stat', $ignore);
        $ignoreID = array($this->config->item('dam_id'), $this->config->item('sire_id'));
        $this->db->where_not_in('can_id', $ignoreID);

        $query = $this->db->get();
        
        return $query->result();
    }

    public function update_expired_canines(){
        $this->db->set('can_stat', $this->config->item('payment_failed'));
        $this->db->where('can_pay_due_date <= NOW()');
        $this->db->where('can_stat', $this->config->item('not_paid'));
        return $this->db->update('canines');
    }
}
