<?php

class MemberModel extends CI_Model {
    public function __construct(){
        date_default_timezone_set("Asia/Bangkok");
    }

    public function record_count() {
        return $this->db->count_all("members");
    }

    // public function fetch_data($num, $offset) {
    //     $this->db->order_by('mem_id', 'desc');
    //     $data = $this->db->get('members', $num, $offset);
    //     return $data;
    // }

    public function get_members($where){
        $this->db->select('*');
        if ($where != null) {
            $this->db->where($where);
        }
        $this->db->from('members');
        $this->db->join('users','users.use_id = members.mem_app_user');
        $this->db->order_by('mem_id', 'desc');
        $this->db->limit($this->config->item('backend_member_count'), 0);
        return $this->db->get();
    }

    public function search_members($like, $where){
        $this->db->select('*');
        $this->db->from('members');
        if ($where != null) {
            $this->db->where($where);
        }
        $this->db->group_start();
        if ($like != null) {
            $this->db->or_like($like);
        }
        $this->db->group_end();
        $this->db->join('users','users.use_id = members.mem_app_user');
        $this->db->order_by('mem_id', 'desc');
        return $this->db->get();
    }

    // public function daftar_users($username){
    //     $this->db->select('*');
    //     if ($username != null) {
    //         $this->db->where('mem_username', $username);
    //     }
    //     $this->db->from('members');
    //     return $this->db->get();
    // }

    // public function get_ktp($ktp){
    //     $this->db->select('*');
    //     if ($ktp != null ) {
    //         $this->db->where('mem_ktp', $ktp);
    //     }
    //     $this->db->from('members');
    //     return $this->db->get();
    // }

    // public function get_ktp_update($ktp, $id){
    //     $this->db->select('*');
    //     if ($ktp != null && $id != null) {
    //         $this->db->where('mem_ktp', $ktp);
    //         $this->db->where('mem_id <> ', $id);
    //     }
    //     $this->db->from('members');
    //     return $this->db->get();
    // }

    public function add_members($data){
        $this->db->insert('members', $data);
        return $this->db->affected_rows();
    }

    public function update_members($data, $where){
        $this->db->set($data);
        $this->db->where($where);
        $this->db->update('members');
        return $this->db->affected_rows();
    }

    // public function set_active($id, $status){
    //     $data = array(
    //         'mem_stat' => $status
    //     );
    //     $this->db->where('mem_id', $id);

    //     $edit = $this->db->update('members', $data);

	// 	return $edit; 
    // }

    // public function approve($id){
    //     $data = array(
    //         'mem_app_user' => $this->session->userdata('use_username'),
    //         'mem_app_date' => date('Y-m-d H:i:s')
    //     );
    //     $this->db->where('mem_id', $id);

    //     $edit = $this->db->update('members', $data);

	// 	return $edit; 
    // }

    // public function member_search($q = null){
    //     $this->db->select('mem_id as id, mem_name as text');
    //     if (isset($q)) {
    //         $this->db->like('mem_name', $q);
    //     }
    //     $this->db->from('members');
    //     $this->db->order_by('mem_id');
    //     return $this->db->get();
    // }

    // function edit_password($id, $pass){
	// 	$data = array(
	// 		'mem_password' => $pass
	// 	);
	// 	$this->db->where('mem_id', $id);
	// 	$edit = $this->db->update('members', $data);
	// 	return $edit; 
	// }

    // public function edit_token($id, $token){
    //     $data = array(
    //         'mem_firebase_token' => $token
    //     );
    //     $this->db->where('mem_id', $id);
    //     $edit = $this->db->update('members', $data);
	// 	return $edit; 
    // }
}
