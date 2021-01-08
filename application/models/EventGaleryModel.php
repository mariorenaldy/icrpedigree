<?php
class EventGaleryModel extends CI_Model {
    public function __construct(){
        parent::__construct();
    }

    public function get_event_galleries($where = null){
        $this->db->select('*');
        if ($where != null) {
            $this->db->where($where);
        }
        $this->db->order_by('gal_id', 'desc');
        return $this->db->get('event_galleries');
    }

    public function add_event_galleries($data = null){
        $result = false;
        if ($data != null) {
            $this->db->insert('event_galleries', $data);
            $result = $this->db->insert_id();
        }
        return $result;
    }

    public function update_event_galleries($data = null, $where = null){
        $result = false;
        if($data != null && $where != null){
            $this->db->set($data);
            $this->db->where($where);
            $this->db->update('event_galleries');
        }
        return $result;
    }

    public function remove_event_galleries($where = null){
        if($where != null){
            return $this->db->delete('event_galleries', $where);
        }
    }

}
