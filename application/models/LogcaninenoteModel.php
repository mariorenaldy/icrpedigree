<?php
class LogcaninenoteModel extends CI_Model {
    public function __construct(){
        date_default_timezone_set("Asia/Bangkok");
    }

    public function get_logs($where){
        $this->db->select('*, DATE_FORMAT(logs_canine_note.log_date, "%d-%m-%Y") as log_date, DATE_FORMAT(logs_canine_note.date, "%d-%m-%Y %H:%i:%s") as date');
        $this->db->from('logs_canine_note');
        if ($where != null) {
            $this->db->where($where);
        }
        $this->db->join('canines','canines.can_id = logs_canine_note.can_id');
        $this->db->join('users u','u.use_id = logs_canine_note.log_user');
        $this->db->join('approval_status','approval_status.stat_id = logs_canine_note.log_stat');
        $this->db->order_by('logs_canine_note.log_date', 'desc');
        return $this->db->get();
    }

    public function add_log($data){
        $insert = $this->db->insert('logs_canine_note', $data);
        return $insert;
    }
}
