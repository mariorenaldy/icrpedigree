<?php
class ProductModel extends CI_Model {
    public function __construct(){
        parent::__construct();
    }

    public function record_count() {
      return $this->db->count_all("products");
    }

    public function fetch_data($num, $offset) {
      $this->db->order_by('pro_id', 'desc');
      $data = $this->db->get('products', $num, $offset);
      return $data;
    }

    public function get_products($where = null){
        $this->db->select('*');
        if ($where != null) {
            $this->db->where($where);
        }
        $this->db->order_by('pro_id', 'desc');
        return $this->db->get('products');
    }

    public function get_product(){
        $this->db->select('*');
        $this->db->order_by('pro_id', 'desc');
        return $this->db->get('products');
    }

    public function add_products($data = null){
        $result = false;
        if ($data != null) {
            $this->db->insert('products', $data);
            $result = $this->db->insert_id();
        }
        return $result;
    }

    public function update_products($data = null, $where = null){
        $result = false;
        if ($data != null && $where != null){
            $this->db->set($data);
            $this->db->where($where);
            $this->db->update('products');
        }
        return $result;
    }

    public function remove_products($where = null){
        if($where != null){
            return $this->db->delete('products', $where);
        }
    }

    public function search_products($num, $offset, $like){
        $this->db->select('*');
        if ($like != null) {
            $this->db->like($like);
        }
        $this->db->order_by('pro_id', 'desc');
        return $this->db->get('products', $num, $offset);
    }
}
