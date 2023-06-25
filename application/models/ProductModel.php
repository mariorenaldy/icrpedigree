<?php
class ProductModel extends CI_Model {
    public function __construct(){
        parent::__construct();
    }

    public function record_count() {
      return $this->db->count_all("products");
    }

    public function accepted_count() {
        $ignoreStat = array($this->config->item('deleted'), $this->config->item('rejected'));
        $this->db->where_not_in('pro_stat', $ignoreStat);
        $this->db->from("products");
        return $this->db->count_all_results();
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

    public function get_stock($where = null){
        $this->db->select('pro_stock');
        if ($where != null) {
            $this->db->where($where);
        }
        return $this->db->get('products')->row()->pro_stock;
    }

    public function update_stock($where, $amount){
        $currStock = $this->get_stock($where);
        $newStock = $currStock + $amount;

        $data = array('pro_stock' => $newStock);
        $this->db->set($data);
        $this->db->where($where);
        return $this->db->update('products');
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

    public function search_products($like, $where, $offset = 0, $limit = 0){
        $this->db->select('*');
        if ($where != null) {
            $this->db->where($where);
        }
        if ($like != null) {
            $this->db->group_start();
            $this->db->or_like($like);
            $this->db->group_end();
        }
        $this->db->join('products_type', 'products.pro_type_id = products_type.pro_type_id', 'left');
        $this->db->order_by('pro_id', 'desc');
        if ($limit)
            $this->db->limit($limit, $offset);
        return $this->db->get('products');
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
