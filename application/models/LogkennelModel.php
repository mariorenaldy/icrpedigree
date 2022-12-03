<?php
class LogkennelModel extends CI_Model {
    public function __construct(){
        parent::__construct();
    }

    public function record_count() {
    return $this->db->count_all("logs_kennel");
    }

    public function fetch_data($num, $offset) {
    $this->db->order_by('log_id', 'desc');
    $data = $this->db->get('logs_kennel', $num, $offset);
    return $data;
    }

    public function get_logs($where = null){
        $this->db->select('*');
        $this->db->from('logs_kennel');
        if ($where != null) {
            $this->db->where($where);
        }
        $this->db->join('kennels','kennels.ken_id = logs_kennel.log_kennel_id');
        $this->db->join('users','users.use_id = logs_kennel.log_app_user');
        $this->db->join('approval_status','approval_status.stat_id = logs_kennel.log_stat');
        $this->db->order_by('logs_kennel.log_tanggal', 'desc');
        $this->db->order_by('kennels.ken_id', 'desc');
        return $this->db->get();
    }

    public function add_log($data){
        $insert = $this->db->insert('logs_kennel', $data);
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

        $edit = $this->db->update('logs_kennel', $data);

		return $edit; 
    }

    public function get_log($id){
        $this->db->select('*');
        $this->db->from('logs_kennel');
        $this->db->where('log_kennel_id', $id);
        $this->db->where('log_stat', 0);
        return $this->db->get();
    }
}
