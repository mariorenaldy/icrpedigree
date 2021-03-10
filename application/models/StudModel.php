<?php
// ARTechnology

class StudModel extends CI_Model {
    public function __construct(){
        date_default_timezone_set("Asia/Bangkok");
    }

    public function record_count() {
      return $this->db->count_all("studs");
    }

    public function fetch_data($num, $offset) {
      $this->db->order_by('stu_id', 'desc');
      $data = $this->db->get('studs', $num, $offset);
      return $data;
    }

    public function get_studs($where = null){
        $this->db->select('*');
        $this->db->from('studs');
        if ($where != null) {
            $this->db->where($where);
        }
        $this->db->join('users','users.use_id = studs.stu_app_user');
        $this->db->join('approval_status','approval_status.stat_id = studs.stu_stat');
        $this->db->order_by('studs.stu_date', 'desc');
        return $this->db->get();
    }

    public function get_member_studs($where = null){
        $user = $this->session->userdata('member_data');
        $this->db->select('*');
        $this->db->from('studs');
        if ($where != null) {
            $this->db->where($where);
        }
        $this->db->join('users','users.use_id = studs.stu_app_user');
        $this->db->join('approval_status','approval_status.stat_id = studs.stu_stat');
        $this->db->join('members','members.mem_id = studs.stu_member');
        $this->db->where('mem_id', $user['mem_id']);
        $this->db->order_by('studs.stu_date', 'desc');
        return $this->db->get();
    }

    public function get_non_approved_studs($where = null){
        $this->db->select('*, DATE_FORMAT(stu_stud_date, "%d-%m-%Y") as stu_stud_date');
        $this->db->from('studs');
        if ($where != null) {
            $this->db->where($where);
        }
        return $this->db->get();
    }

    public function search_by_member($q){
        $user = $this->session->userdata('member_data');
        
        $date = '';
        $piece = explode("-", $q);
        if (count($piece) == 3){
            $date = $piece[2]."-".$piece[1]."-".$piece[0];
        }

        $sql = "select * from studs s, users u, members m, approval_status a where u.use_id = s.stu_app_user AND a.stat_id = s.stu_stat AND m.mem_id = s.stu_member AND m.mem_id = ".$user['mem_id'];
        if ($date)
            $sql .= " AND s.stu_date LIKE '%".$date."%'";
        else
            $sql .= " AND s.stu_date = '".$q."'";
        $sql .= " ORDER BY s.stu_date DESC";
        $query = $this->db->query($sql);
        
        return $query->result();
    }

    public function add_studs($data = null){
        $result = false;
        if ($data != null) {
            $this->db->insert('studs', $data);
            $result = $this->db->insert_id();
        }
        return $result;
    }

    public function update_studs($data = null, $where = null){
        $result = false;
        if($data != null && $where != null){
            $this->db->set($data);
            $this->db->where($where);
            $this->db->update('studs');
        }
        return $result;
    }

    public function approve($id){
        $user = $this->session->userdata('user_data');
        $data = array(
            'stu_sire_id' => $this->input->post('stu_sire_id'),
            'stu_mom_id' => $this->input->post('stu_mom_id'),
            'stu_note' => $this->input->post('stu_note'),
            'stu_app_user' => $user['use_id'],
            'stu_app_date' => date('Y-m-d H:i:s'),
            'stu_stat' => 1
        );
        $this->db->where('stu_id', $id);

        $edit = $this->db->update('studs', $data);

		return $edit; 
    }

    public function reject($id){
        $user = $this->session->userdata('user_data');
        $data = array(
            'stu_note' => $this->input->post('stu_note'),
            'stu_app_user' => $user['use_id'],
            'stu_app_date' => date('Y-m-d H:i:s'),
            'stu_stat' => 2
        );
        $this->db->where('stu_id', $id);

        $edit = $this->db->update('studs', $data);

		return $edit; 
    }

    public function check_date($id, $stu_mom_id, $date){
        $sql = "SELECT stu_stud_date FROM studs s where s.stu_id <> ".$id." AND s.stu_mom_id = ".$stu_mom_id." AND ABS(DATEDIFF(s.stu_stud_date, '".$date."')) <= 120";
        $query = $this->db->query($sql);
        return $query->result();
    }

    // public function update($id){
    //     $data = array(
    //         'stu_sire_id' => $this->input->post('stu_sire_id'),
    //         'stu_mom_id' => $this->input->post('stu_mom_id'),
    //         'stu_note' => $this->input->post('stu_note')
    //     );
    //     $this->db->where('stu_id', $id);

    //     $edit = $this->db->update('studs', $data);

	// 	return $edit; 
    // }
}
