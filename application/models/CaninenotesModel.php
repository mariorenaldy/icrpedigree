<?php
class CaninenotesModel extends CI_Model {
    public function get_note($where){
        $this->db->select('*, DATE_FORMAT(note_date, "%d-%m-%Y") as note_date');
        if ($where != null) {
            $this->db->where($where);
        }
        $this->db->join('users', 'canine_notes.note_user = users.use_id');
        // $this->db->order_by('note_id');
        $this->db->order_by('note_date');
        return $this->db->get('canine_notes');
    }

    public function add_note($data){
        $this->db->insert('canine_notes', $data);
        return $this->db->insert_id();
    }

    public function update_note($data, $where){
        $this->db->set($data);
        $this->db->where($where);
        return $this->db->update('canine_notes');
    }
}
