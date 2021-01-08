<?php
class ChampionsModel extends CI_Model {
    public function __construct(){
        parent::__construct();
    }

    public function get_champions($where = null){
        $this->db->select('*');
        if ($where != null) {
            $this->db->where($where);
        }
        $this->db->order_by('ech_id', 'desc');
        return $this->db->get('event_champions');
    }

    public function add_champions($data = null){
        $result = false;
        if ($data != null) {
            $this->db->insert('event_champions', $data);
            $result = $this->db->insert_id();
        }
        return $result;
    }

    public function update_champions($data = null, $where = null){
        $result = false;
        if($data != null && $where != null){
            $this->db->set($data);
            $this->db->where($where);
            $this->db->update('event_champions');
        }
        return $result;
    }

    public function remove_champions($where = null){
        if($where != null){
            return $this->db->delete('event_champions', $where);
        }
    }

}
