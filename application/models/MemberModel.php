<?php
// ARTechnology

class MemberModel extends CI_Model {
    public function __construct(){
        date_default_timezone_set("Asia/Bangkok");
    }

    public function record_count() {
      return $this->db->count_all("members");
    }

    public function fetch_data($num, $offset) {
      $this->db->order_by('mem_id', 'desc');
      $data = $this->db->get('members', $num, $offset);
      return $data;
    }

    public function get_members($where = null){
        $this->db->select('*');
        if ($where != null) {
            $this->db->where($where);
        }
        $this->db->from('members');
        $this->db->join('users','users.use_id = members.mem_app_user');
        $this->db->join('kennels','kennels.ken_id = members.mem_ken_id');
        $this->db->order_by('mem_id', 'desc');
        return $this->db->get();
    }

    public function daftar_users($username = null){
        $this->db->select('*');
        if ($username != null ) {
            $this->db->where('mem_username', $username);
        }
        $this->db->from('members');
        return $this->db->get();
      }

    public function add_members($data = null){
        $result = false;
        if ($data != null) {
            $this->db->insert('members', $data);
            $result = $this->db->insert_id();
        }
        return $result;
    }

    public function update_members($data = null, $where = null){
        $result = false;
        if($data != null && $where != null){
            $this->db->set($data);
            $this->db->where($where);
            $this->db->update('members');
        }
        return $result;
    }

    public function set_active($id, $status){
        $data = array(
            'mem_stat' => $status
        );
        $this->db->where('mem_id', $id);

        $edit = $this->db->update('members', $data);

		return $edit; 
    }

    public function approve($id){
        $user = $this->session->userdata('user_data');
        $data = array(
            'mem_app_user' => $user['use_id'],
            'mem_app_date' => date('Y-m-d H:i:s')
        );
        $this->db->where('mem_id', $id);

        $edit = $this->db->update('members', $data);

		return $edit; 
    }

    public function member_search($q = null){
        $this->db->select('mem_id as id, mem_name as text');
        if (isset($q)) {
            $this->db->like('mem_name', $q);
        }
        $this->db->from('members');
        $this->db->order_by('mem_id');
        return $this->db->get();
    }

    function edit_password($id, $pass){
		$data = array(
			'mem_password' => $pass
		);
		$this->db->where('mem_id', $id);
		$edit = $this->db->update('members', $data);
		return $edit; 
	}
}
