<?php
class ProductModel extends CI_Model {
    public function __construct(){
        parent::__construct();
    }

    public function record_count() {
      return $this->db->count_all("products");
    }

    public function fetch_data($where = null, $num, $offset) {
        $this->db->order_by('pro_id', 'desc');
        if ($where != null) {
            $this->db->where($where);
        }
        $data = $this->db->get('products', $num, $offset);
        return $data;
    }

    public function get_products($where = null){
        $this->db->select('*');
        if ($where != null) {
            $this->db->where($where);
        }
        $this->db->order_by('pro_id', 'desc');
        $this->db->join('products_type', 'products.pro_type_id = products_type.pro_type_id', 'left');
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

    public function update_products($data, $where){
        $this->db->set($data);
        $this->db->where($where);
        return $this->db->update('products');
    }

    public function search_products($where, $num, $offset, $like){
        $this->db->select('*');
        if ($where != null) {
            $this->db->where($where);
        }
        if ($like != null) {
            $this->db->like($like);
        }
        $this->db->order_by('pro_id', 'desc');
        $this->db->join('products_type', 'products.pro_type_id = products_type.pro_type_id', 'left');
        return $this->db->get('products', $num, $offset);
    }

    public function check_for_duplicate($id, $field, $val){
        $sql = "SELECT pro_id from products where ".$field." = '".$val."' AND pro_stat IN (".$this->config->item('saved').", ".$this->config->item('accepted').")";
        if ($id){
            $sql .= ' AND pro_id <> '.$id;
        }
        $query = $this->db->query($sql);
        return count($query->result());
    }
}
