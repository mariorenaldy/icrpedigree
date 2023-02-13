<?php
class LogstudModel extends CI_Model {
    public function __construct(){
        date_default_timezone_set("Asia/Bangkok");
    }

    public function get_logs($where){
        $this->db->select('*, DATE_FORMAT(logs_stud.log_date, "%d-%m-%Y") as log_date');
        $this->db->from('logs_stud');
        if ($where != null) {
            $this->db->where($where);
        }
        $this->db->join('members AS m_sire','m_sire.mem_id = logs_stud.log_member_id');
        $this->db->join('kennels AS k_sire','k_sire.ken_member_id = m_sire.mem_id');
        $this->db->join('canines AS c_sire','c_sire.can_id = logs_stud.log_sire_id');
        $this->db->join('members AS m_dam','m_dam.mem_id = logs_stud.log_partner_id');
        $this->db->join('kennels AS k_dam','k_dam.ken_member_id = m_dam.mem_id');
        $this->db->join('canines AS c_dam','c_dam.can_id = logs_stud.log_dam_id');
        $this->db->join('users','users.use_id = logs_stud.log_app_user');
        $this->db->join('approval_status','approval_status.stat_id = logs_stud.log_stat');
        $this->db->order_by('logs_stud.log_date', 'desc');
        return $this->db->get();
    }

    public function add_log($data){
        $insert = $this->db->insert('logs_stud', $data);
        return $insert;
    }
}
