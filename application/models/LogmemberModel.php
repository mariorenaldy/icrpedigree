<?php
class LogmemberModel extends CI_Model {
    public function __construct(){
        parent::__construct();
    }

    public function record_count() {
    return $this->db->count_all("logs_member");
    }

    public function fetch_data($num, $offset) {
    $this->db->order_by('log_id', 'desc');
    $data = $this->db->get('logs_member', $num, $offset);
    return $data;
    }

    public function get_logs($where = null){
        $this->db->select('*');
        $this->db->from('logs_member');
        if ($where != null) {
            $this->db->where($where);
        }
        $this->db->join('members','members.mem_id = logs_member.log_member_id');
        $this->db->join('users','users.use_id = logs_member.log_app_user');
        $this->db->join('approval_status','approval_status.stat_id = logs_member.log_stat');
        $this->db->order_by('logs_member.log_tanggal', 'desc');
        $this->db->order_by('members.mem_id', 'desc');
        return $this->db->get();
    }

    public function add_log($data){
        $insert = $this->db->insert('logs_member', $data);
        return $insert;
    }

    public function update_status($id, $stat){
        $user = $this->session->userdata('user_data');
        $data = array(
            'log_app_user' => $user['use_id'],
            'log_app_date' => date('Y-m-d H:i:s'),
            'log_stat' => $stat
        );
        $this->db->where('log_id', $id);

        $edit = $this->db->update('logs_member', $data);

		return $edit; 
    }
}
