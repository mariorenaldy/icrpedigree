<?php
class QuoteModel extends CI_Model {
    public function __construct(){
        parent::__construct();
    }

    public function get_quotes($where = null){
        $this->db->select('*');
        if ($where != null) {
            $this->db->where($where);
        }
        $this->db->order_by('quo_id', 'desc');
        return $this->db->get('quotes');
    }

    public function get_qoute(){
        $this->db->select('*');
        $this->db->order_by('quo_id', 'desc');
        return $this->db->get('quotes');
    }

    public function add_quotes($data = null){
        $result = false;
        if ($data != null) {
            $this->db->insert('quotes', $data);
            $result = $this->db->insert_id();
        }
        return $result;
    }

    public function update_quotes($data = null, $where = null){
        $result = false;
        if($data != null && $where != null){
            $this->db->set($data);
            $this->db->where($where);
            $this->db->update('quotes');
        }
        return $result;
    }

    public function remove_quotes($where = null){
        if($where != null){
            return $this->db->delete('quotes', $where);
        }
    }

}
