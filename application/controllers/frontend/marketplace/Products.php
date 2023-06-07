<?php
defined('BASEPATH') or exit('No direct script access allowed');

#[\AllowDynamicProperties]

class Products extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model(array('productModel', 'productTypeModel', 'logproductModel'));
		$this->load->library(array('session', 'form_validation', 'pagination'));
		$this->load->helper(array('url'));
		$this->load->database();
	}
	public function index()
	{
		//pagination
		$config['base_url'] = base_url() . 'marketplace/Products/index';
		$config['total_rows'] = $this->productModel->record_count();
		$config['per_page'] = 9;
		$config['attributes'] = array('class' => 'page-link');

		//initialize pagination
		$this->pagination->initialize($config);

		$data['start'] = $this->uri->segment(4);
		$where['pro_stat'] = $this->config->item('accepted');
		$data['products'] = $this->productModel->fetch_data($where, $config['per_page'], $data['start'])->result();

		$this->load->view("marketplace/view_products_frontend", $data);
	}
	public function search()
	{
		$keyword = '';
		if ($this->input->get('keyword')) {
			$keyword = $this->input->get('keyword');
		} else {
			redirect('marketplace/Products');
		}

		//pagination
		$this->db->like('pro_name', $keyword);
		$this->db->from('products');
		$config['base_url'] = base_url() . 'marketplace/Products/search';
		$config['total_rows'] = $this->db->count_all_results();
		$config['per_page'] = 9;
		$config['attributes'] = array('class' => 'page-link');

		//initialize pagination
		$this->pagination->initialize($config);

		$data['start'] = $this->uri->segment(4);

		$like['pro_name'] = $keyword;
		$where['pro_stat'] = $this->config->item('accepted');
		$data['products'] = $this->productModel->search_products($where, $config['per_page'], $data['start'], $like)->result();

		$this->load->view("marketplace/products", $data);
	}
	public function product_detail()
	{
		if ($this->uri->segment(4)) {
			$where['pro_id'] = $this->uri->segment(4);
			$where['pro_stat'] = $this->config->item('accepted');
			$data['products'] = $this->productModel->get_products($where)->row();
			if($data['products']){
				$this->load->view("marketplace/product_detail", $data);
			}
			else{
				redirect('marketplace/products');
			}
		} else {
			redirect('marketplace/products');
		}
	}
	public function product_payment()
	{
		if ($this->uri->segment(4)) {
			$where['pro_id'] = $this->uri->segment(4);
			$where['pro_stat'] = $this->config->item('accepted');
			$data['products'] = $this->productModel->get_products($where)->row();
			if($data['products']){
				$this->load->view("marketplace/product_payment", $data);
			}
			else{
				redirect('marketplace/products');
			}
		} else {
			redirect('marketplace/product_detail');
		}
	}
}