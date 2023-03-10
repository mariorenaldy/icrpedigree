<?php
class SettingModel extends CI_Model {
    public function get_setting($q){
        if ($q)
            $this->db->select($q);
        else
            $this->db->select('*');
        return $this->db->get('settings');
    }

    public function update_setting($data){
        $this->db->set($data);
        return $this->db->update('settings');
    }
}
