<?php
// ARTechnology

class KennelModel extends CI_Model {
    public function __construct(){
        parent::__construct();
    }

    public function record_count() {
      return $this->db->count_all("kennels");
    }

    public function fetch_data($num, $offset) {
      $this->db->order_by('ken_id', 'desc');
      $data = $this->db->get('kennels', $num, $offset);
      return $data;
    }

    public function get_kennels($where = null){
        $this->db->select('kennels.ken_id, kennels.ken_photo, kennels.ken_name AS ken_name, kennels.ken_type_id, kennels_type.ken_name AS ken_type');
        if ($where != null) {
            $this->db->where($where);
        }
        $this->db->from('kennels');
        $this->db->join('kennels_type','kennels_type.ken_type_id = kennels.ken_type_id');
        $this->db->order_by('ken_id', 'desc');
        return $this->db->get();
    }

    public function daftar_kennels($name = null){
        if ($name)
            $this->db->where('ken_name', $name);
        $this->db->order_by('ken_id', 'desc');
        return $this->db->get('kennels');
      }

    public function add_kennels($data = null){
        $result = false;
        if ($data != null) {
            $result = $this->db->insert('kennels', $data);
        }
        return $result;
    }

    public function update_kennels($data = null, $where = null){
        $result = false;
        if ($data != null && $where != null){
            $this->db->set($data);
            $this->db->where($where);
            $this->db->update('kennels');
        }
        return $result;
    }

    public function kennel_search($q = null){
        $this->db->select('ken_id as id, ken_name as text');
        if (isset($q)) {
            $this->db->like('ken_name', $q);
        }
        $this->db->from('kennels');
        $this->db->order_by('ken_id');
        return $this->db->get();
    }

    public function set_active($id, $status){
        $data = array(
            'ken_stat' => $status
        );
        $this->db->where('ken_id', $id);

        $edit = $this->db->update('kennels', $data);

		return $edit; 
    }
}
