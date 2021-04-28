<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Product extends CI_Controller {
    public function __construct(){
        // Call the CI_Controller constructor
        parent::__construct();
        $this->load->model('productModel');
    }

    public function get_products(){
        $offset = 0;
        if ($this->uri->segment(4))
          $offset = $this->uri->segment(4);
        echo json_encode([
          'status' => true,
          'data' => $this->productModel->fetch_data($this->config->item('product_count'), $offset)->result()
        ]);
    }

    public function get_detail(){
        if ($this->uri->segment(4)){
          $where['pro_id'] = $this->uri->segment(4);
          echo json_encode([
            'status' => true,
            'data' => $this->productModel->get_products($where)->result()
          ]);
        }
        else
          echo json_encode([
            'status' => false,
            'message' => 'Id product wajib diisi'
          ]);
    }
}
