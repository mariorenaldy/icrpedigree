<?php
class TestimonialModel extends CI_Model {
    public function __construct(){
        parent::__construct();
    }

    public function get_testimonials($where = null){
        $this->db->select('*');
        if ($where != null) {
            $this->db->where($where);
        }
        $this->db->order_by('tes_id', 'desc');
        return $this->db->get('testimonials');
    }

    public function get_testimonial(){
        $this->db->select('*');
        $this->db->order_by('tes_id', 'desc');
        return $this->db->get('testimonials');
    }

    public function add_testimonials($data = null){
        $result = false;
        if ($data != null) {
            $this->db->insert('testimonials', $data);
            $result = $this->db->insert_id();
        }
        return $result;
    }

    public function update_testimonials($data = null, $where = null){
        $result = false;
        if($data != null && $where != null){
            $this->db->set($data);
            $this->db->where($where);
            $this->db->update('testimonials');
        }
        return $result;
    }

    public function remove_testimonials($where = null){
        if($where != null){
            return $this->db->delete('testimonials', $where);
        }
    }

}
