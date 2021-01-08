<?php
class SettingModel extends CI_Model {
    public function __construct(){
        parent::__construct();
    }

    public function get_settings($where = null){
        $this->db->select('*');
        if ($where != null) {
            $this->db->where($where);
        }
        $this->db->order_by('set_id', 'desc');
        return $this->db->get('settings');
    }

    public function get_setting(){
        $this->db->select('*');
        $this->db->order_by('set_id', 'desc');
        return $this->db->get('settings');
    }

    public function add_settings($data = null){
        $result = false;
        if ($data != null) {
            $this->db->insert('settings', $data);
            $result = $this->db->insert_id();
        }
        return $result;
    }

    public function update_settings($data = null, $where = null){
        $result = false;
        if($data != null && $where != null){
            $this->db->set($data);
            $this->db->where($where);
            $this->db->update('settings');
        }
        return $result;
    }

    public function remove_settings($where = null){
        if($where != null){
            return $this->db->delete('settings', $where);
        }
    }

}
