<?php
class TrahModel extends CI_Model {
    public function record_count() {
        return $this->db->count_all("trah");
    }

    public function accepted_count() {
        $ignoreStat = array($this->config->item('deleted'), $this->config->item('rejected'));
        $this->db->where_not_in('tra_stat', $ignoreStat);
        $this->db->from("trah");
        return $this->db->count_all_results();
    }

    public function get_trah($where){
        $this->db->select('*');
        if ($where != null) {
            $this->db->where($where);
        }
        $this->db->order_by('tra_name');
        return $this->db->get('trah');
    }

    public function add_trah($data){
        return $this->db->insert('trah', $data);
    }

    public function update_trah($data, $where){
        $this->db->set($data);
        $this->db->where($where);
        return $this->db->update('trah');
    }
}
