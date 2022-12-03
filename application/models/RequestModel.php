<?php
// ARTechnology

class RequestModel extends CI_Model {
    public function __construct(){
        date_default_timezone_set("Asia/Bangkok");
    }

    // public function record_count() {
    //     return $this->db->count_all("requests");
    // }

    // public function fetch_data($num, $offset) {
    //     $this->db->order_by('req_id', 'desc');
    //     $data = $this->db->get('requests', $num, $offset);
    //     return $data;
    // }

    public function get_requests($where = null){
        $this->db->select('*');
        $this->db->from('requests');
        if ($where != null) {
            $this->db->where($where);
        }
        $this->db->join('canines','canines.can_id = requests.req_can_id');
        $this->db->join('users','users.use_id = requests.req_app_user');
        $this->db->join('approval_status','approval_status.stat_id = requests.req_stat');
        $this->db->order_by('requests.req_date', 'desc');
        $this->db->order_by('canines.can_id', 'desc');
        return $this->db->get();
    }

    public function add_requests($data = null){
        $result = false;
        if ($data != null) {
            $this->db->insert('requests', $data);
            $result = $this->db->insert_id();
        }
        return $result;
    }

    public function update_status($id, $stat){
        $user = $this->session->userdata('user_data');
        $data = array(
            'req_app_user' => $user['use_id'],
            'req_app_date' => date('Y-m-d H:i:s'),
            'req_stat' => $stat
        );
        $this->db->where('req_id', $id);

        $edit = $this->db->update('requests', $data);

		return $edit; 
    }
}
