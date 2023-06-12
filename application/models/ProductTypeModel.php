<?php
class ProductTypeModel extends CI_Model {
    public function record_count() {
        return $this->db->count_all("products_type");
    }

    public function get_type($where = null){
        $this->db->select('*');
        if ($where != null) {
            $this->db->where($where);
        }
        $this->db->order_by('pro_type_name');
        return $this->db->get('products_type');
    }

    public function add_type($data){
        return $this->db->insert('products_type', $data);
    }

    public function update_type($data, $where){
        $this->db->set($data);
        $this->db->where($where);
        return $this->db->update('products_type');
    }
}
