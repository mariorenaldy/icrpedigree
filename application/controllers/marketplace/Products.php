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
		$this->load->helper(array('url', 'cookie'));
		$this->load->database();
		date_default_timezone_set("Asia/Bangkok");

		if ($this->input->cookie('site_lang')) {
            $this->lang->load('common', $this->input->cookie('site_lang'));
            $this->lang->load('order', $this->input->cookie('site_lang'));
            $this->lang->load('product', $this->input->cookie('site_lang'));
        } else {
            set_cookie('site_lang', 'indonesia', '2147483647'); 
            $this->lang->load('common','indonesia');
            $this->lang->load('order','indonesia');
            $this->lang->load('product','indonesia');
        }
	}
	public function index(){
        $page = ($this->uri->segment(4)) ? ($this->uri->segment(4) - 1) : 0;
        $config['per_page'] = 9;
        $config['uri_segment'] = 4;
        $config['use_page_numbers'] = TRUE;

        //Encapsulate whole pagination 
        $config['full_tag_open'] = '<ul class="pagination justify-content-end">';
        $config['full_tag_close'] = '</ul>';

        //First link of pagination
        $config['first_link'] = 'First';
        $config['first_tag_open'] = '<li>';
        $config['first_tag_close'] = '</li>';

        //Customizing the Digit Link
        $config['num_tag_open'] = '<li>';
        $config['num_tag_close'] = '</li>';

        //For PREVIOUS PAGE Setup
        $config['prev_link'] = '<';
        $config['prev_tag_open'] = '<li>';
        $config['prev_tag_close'] = '</li>';

        //For NEXT PAGE Setup
        $config['next_link'] = '>';
        $config['next_tag_open'] = '<li>';
        $config['next_tag_close'] = '</li>';

        //For LAST PAGE Setup
        $config['last_link'] = 'Last';
        $config['last_tag_open'] = '<li>';
        $config['last_tag_close'] = '</li>';

        //For CURRENT page on which you are
        $config['cur_tag_open'] = '<li class="active"><a class="page-link bg-primary text-light border-primary" href="#">';
        $config['cur_tag_close'] = '</a></li>';

        $config['attributes'] = array('class' => 'page-link bg-light text-primary');

		$where['pro_stat'] = $this->config->item('accepted');
		$where['pro_stock !='] = 0;
		$data['products'] = $this->productModel->search_products(null, $where, $page * $config['per_page'], 9)->result();
		$data['pro_types'] = $this->productTypeModel->get_type()->result();
		$data['types'] = 0;
        
		$config['base_url'] = base_url() . 'marketplace/Products/index';
        $config['total_rows'] = $this->productModel->search_products(null, $where, $page * $config['per_page'], 0)->num_rows();
		$this->pagination->initialize($config);

        $data['keyword'] = '';
        $this->session->set_userdata('keyword', '');
        $this->load->view("marketplace/products_frontend", $data);
    }
	public function add_to_cart()
	{
		if ($this->uri->segment(4)) {
			$quantity = 1;
			if ($this->uri->segment(5)) {
				$quantity = $this->uri->segment(5);
			}
			$where['pro_id'] = $this->uri->segment(4);
			$where['pro_stat'] = $this->config->item('accepted');
			$where['pro_stock !='] = 0;
			$data['products'] = $this->productModel->get_products($where)->row();
			$err = 0;
			if($data['products']){
				//check stock
				$stock = $data['products']->pro_stock;

				if (count($this->cart->contents())>0){
					foreach ($this->cart->contents() as $cartItem){       
						if($cartItem['id'] == $data['products']->pro_id){
							if($cartItem['qty']+$quantity>$stock){
								$err = 1;
								break;
							}
						}
					}
				}

				$site_lang = $this->input->cookie('site_lang');
				if($err){
					if ($site_lang == 'indonesia') {
						$this->session->set_flashdata('error_message', 'Gagal menambahkan produk ke keranjang. Pastikan jumlah item yang ditambahkan tidak melebihi jumlah stok');
					}
					else{
						$this->session->set_flashdata('error_message', 'Failed to add product to shopping cart. Make sure the number of items being added will not exceed the number of stock');
					}
				}
				else{
					$dataCart = array(
						'id'      => $data['products']->pro_id,
						'qty'     => $quantity,
						'price'   => $data['products']->pro_price,
						'name'    => $data['products']->pro_name,
					);
	
					$this->cart->insert($dataCart);
					$this->session->set_flashdata('add_success', true);
				}
				redirect('marketplace/products');
			}
			else{
				redirect('marketplace/products');
			}
		} else {
			redirect('marketplace/products');
		}
	}
	public function cart_detail()
	{
		$this->load->view("marketplace/cart_detail");
	}
	public function clear_cart()
	{
		$this->cart->destroy();
		redirect('marketplace/products/cart_detail');
	}
	public function checkout()
	{
		$this->load->view("marketplace/checkout");
	}
	public function product_detail()
	{
		if ($this->uri->segment(4)) {
			$where['pro_id'] = $this->uri->segment(4);
			$where['pro_stat'] = $this->config->item('accepted');
			$where['pro_stock !='] = 0;
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

	//backend
	public function listProducts()
	{
		$where['pro_stat'] = $this->config->item('accepted');
		$data['products'] = $this->productModel->get_products($where)->result();
		$this->load->view("marketplace/products_backend", $data);
	}
	public function add()
	{
		$data['products_type'] = $this->productTypeModel->get_type()->result();
		$this->load->view('marketplace/add_product', $data);
	}
	public function validate_add()
	{
		if ($this->session->userdata('use_username')) {
			$this->form_validation->set_error_delimiters('<div>', '</div>');
			$this->form_validation->set_rules('pro_name', 'Name ', 'trim|required');
			$this->form_validation->set_rules('pro_price', 'Price ', 'trim|required');
			$this->form_validation->set_rules('pro_stock', 'Stock ', 'trim|required');

			$data['products_type'] = $this->productTypeModel->get_type()->result();

			if ($this->form_validation->run() == FALSE) {
				$this->load->view('marketplace/add_product', $data);
			} else {
				$err = 0;
				if (!isset($_POST['attachment']) || empty($_POST['attachment'])) {
					$err++;
					$this->session->set_flashdata('error_message', 'Photo is required');
				}

				$photo = '-';
				if (!$err) {
					$uploadedImg = $_POST['attachment'];
					$image_array_1 = explode(";", $uploadedImg);
					$image_array_2 = explode(",", $image_array_1[1]);
					$uploadedImg = base64_decode($image_array_2[1]);

					if ((strlen($uploadedImg) > $this->config->item('file_size'))) {
						$err++;
						$this->session->set_flashdata('error_message', 'The file size is too big (> 1 MB).');
					}

					$img_name = $this->config->item('path_product') . 'product_' . time() . '.png';
					if (!is_dir($this->config->item('path_product')) or !is_writable($this->config->item('path_product'))) {
						$err++;
						$this->session->set_flashdata('error_message', 'Products folder not found or not writable.');
					} else {
						if (is_file($img_name) and !is_writable($img_name)) {
							$err++;
							$this->session->set_flashdata('error_message', 'File already exists and not writable.');
						}
					}
				}

				if (!$err && $this->productModel->check_for_duplicate($this->input->post('pro_id'), 'pro_name', $this->input->post('pro_name'))){
                    $err++;
                    $this->session->set_flashdata('error_message', 'Product name cannot be the same');
                }

				if (!$err) {
					file_put_contents($img_name, $uploadedImg);
					$photo = str_replace($this->config->item('path_product'), '', $img_name);

					$dataPro = array(
						'pro_type_id' => $this->input->post('pro_type_id'),
						'pro_name' => $this->input->post('pro_name'),
						'pro_price' => $this->input->post('pro_price'),
						'pro_stock' => $this->input->post('pro_stock'),
						'pro_desc' => $this->input->post('pro_desc'),
						'pro_photo' => $photo,
						'pro_created_user' => $this->session->userdata('use_id'),
						'pro_created_at' => date('Y-m-d H:i:s'),
						'pro_updated_user' => $this->session->userdata('use_id'),
						'pro_updated_at' => date('Y-m-d H:i:s'),
						'pro_stat' => $this->config->item('accepted')
					);

					$dataLog = array(
						'log_product_type_id' => $this->input->post('pro_type_id'),
						'log_product_name' => $this->input->post('pro_name'),
						'log_product_price' => $this->input->post('pro_price'),
						'log_product_stock' => $this->input->post('pro_stock'),
						'log_product_desc' => $this->input->post('pro_desc'),
						'log_product_photo' => $photo,
						'log_product_created_user' => $this->session->userdata('use_id'),
						'log_product_created_at' => date('Y-m-d H:i:s'),
						'log_product_updated_user' => $this->session->userdata('use_id'),
						'log_product_updated_at' => date('Y-m-d H:i:s'),
						'log_stat' => $this->config->item('accepted')
					);

					if (!$err) {
						$this->db->trans_strict(FALSE);
						$this->db->trans_start();
						$products = $this->productModel->add_products($dataPro);
						if ($products) {
							$id = $this->db->insert_id();
							$dataLog['log_product_id'] = $id;
							$log = $this->logproductModel->add_log($dataLog);
							if ($log) {
								$this->db->trans_complete();
								$this->session->set_flashdata('add_success', true);
								redirect("marketplace/Products/listProducts");
							} else {
								$err = 1;
							}
						} else {
							$err = 2;
						}
						if ($err) {
							$this->db->trans_rollback();
							$this->session->set_flashdata('error_message', 'Failed to save product. Error code: ' . $err);
							$this->load->view('marketplace/add_product', $data);
						}
					} else {
						$this->load->view('marketplace/add_product', $data);
					}
				} else {
					$this->load->view('marketplace/add_product', $data);
				}
			}
		} else {
			redirect("backend/Users/login");
		}
	}
	public function delete(){
        if ($this->uri->segment(4)){
            if ($this->session->userdata('use_username')){
                $err = 0;
                $where['pro_id'] = $this->uri->segment(4);
                $data['pro_stat'] = $this->config->item('deleted');
                $data['pro_updated_user'] = $this->session->userdata('use_id');
                $data['pro_updated_at'] = date('Y-m-d H:i:s');

                $dataLog = array(
                    'log_product_id' => $this->uri->segment(4),
                    'log_stat' => $this->config->item('deleted'),
                    'log_product_updated_user' => $this->session->userdata('use_id'),
                    'log_product_updated_at' => date('Y-m-d H:i:s'),
                );

                $this->db->trans_strict(FALSE);
                $this->db->trans_start();
                $res = $this->productModel->update_products($data, $where);
                if ($res){
                    $log = $this->logproductModel->add_log($dataLog);
                    if ($log){
                        $this->db->trans_complete();
                        $this->session->set_flashdata('delete_success', TRUE);
                        redirect("marketplace/Products/listProducts");
                    }
                    else{
                        $err = 1;
                    }
                }
                else{
                    $err = 2;
                }
                if ($err){
                    $this->db->trans_rollback();
                    $this->session->set_flashdata('delete_message', 'Failed to delete product id = '.$this->uri->segment(4).'. Error code: '.$err);
                    redirect('marketplace/Products/listProducts');
                }
            }
            else{
                redirect("backend/Users/login");
            }
        }
        else{
        	redirect("marketplace/Products/listProducts");
        }
    }
	public function edit(){
        if ($this->uri->segment(4)){
            $where['pro_id'] = $this->uri->segment(4);
			$data['products_type'] = $this->productTypeModel->get_type()->result();
            $data['product'] = $this->productModel->get_products($where)->row();
			$data['mode'] = 0;
            $this->load->view("marketplace/edit_product", $data);
        }
        else{
            redirect('marketplace/Products/listProducts');
        }
    }
	public function validate_edit(){ 
        if ($this->session->userdata('use_username')) {
            $this->form_validation->set_error_delimiters('<div>', '</div>');
            $this->form_validation->set_rules('pro_name', 'Name ', 'trim|required');
            $this->form_validation->set_rules('pro_type_id', 'Type id ', 'trim|required');
            $this->form_validation->set_rules('pro_price', 'Price ', 'trim|required');
            $this->form_validation->set_rules('pro_stock', 'Stock ', 'trim|required');

            $where['pro_id'] = $this->input->post('pro_id');
			$data['products_type'] = $this->productTypeModel->get_type()->result();
            $data['product'] = $this->productModel->get_products($where)->row();
            $data['mode'] = 1;

            if ($this->form_validation->run() == FALSE) {
                $this->load->view('marketplace/edit_product', $data);
            } else {
                $err = 0;
                $photo = '-';
                if (!$err){
                    if (isset($_POST['attachment']) && !empty($_POST['attachment'])){
                        $uploadedImg = $_POST['attachment'];
                        $image_array_1 = explode(";", $uploadedImg);
                        $image_array_2 = explode(",", $image_array_1[1]);
                        $uploadedImg = base64_decode($image_array_2[1]);
            
                        if ((strlen($uploadedImg) > $this->config->item('file_size'))) {
                            $err++;
                            $this->session->set_flashdata('error_message', 'The file size is too big (> 1 MB).');
                        }
            
                        $img_name = $this->config->item('path_product').$this->config->item('file_name_product');
                        if (!is_dir($this->config->item('path_product')) or !is_writable($this->config->item('path_product'))) {
                            $err++;
                            $this->session->set_flashdata('error_message', 'Product folder not found or not writable.');
                        } else{
                            if (is_file($img_name) and !is_writable($img_name)) {
                                $err++;
                                $this->session->set_flashdata('error_message', 'File already exists and not writable.');
                            }
                        }
                    }
				}

                if (!$err && $this->productModel->check_for_duplicate($this->input->post('pro_id'), 'pro_name', $this->input->post('pro_name'))){
                    $err++;
                    $this->session->set_flashdata('error_message', 'Product name cannot be the same');
                }

                if (!$err) {
                    if (isset($uploadedImg)){
                        file_put_contents($img_name, $uploadedImg);
                        $photo = str_replace($this->config->item('path_product'), '', $img_name);
                    }

					$dataPro = array(
						'pro_type_id' => $this->input->post('pro_type_id'),
						'pro_name' => $this->input->post('pro_name'),
						'pro_price' => $this->input->post('pro_price'),
						'pro_stock' => $this->input->post('pro_stock'),
						'pro_desc' => $this->input->post('pro_desc'),
						'pro_updated_user' => $this->session->userdata('use_id'),
						'pro_updated_at' => date('Y-m-d H:i:s')
					);

					$dataLog = array(
						'log_product_id' => $this->input->post('pro_id'),
						'log_product_type_id' => $this->input->post('pro_type_id'),
						'log_product_name' => $this->input->post('pro_name'),
						'log_product_price' => $this->input->post('pro_price'),
						'log_product_stock' => $this->input->post('pro_stock'),
						'log_product_desc' => $this->input->post('pro_desc'),
						'log_product_photo' => $photo,
						'log_product_updated_user' => $this->session->userdata('use_id'),
						'log_product_updated_at' => date('Y-m-d H:i:s'),
						'log_stat' => $this->config->item('accepted')
					);

					if ($photo != '-'){
						$dataPro['pro_photo'] = $photo;
						$dataLog['log_product_photo'] = $photo;
					}
					else{
						$dataLog['log_product_photo'] = $data['product']->pro_photo;
					}

                    if (!$err) {
                        $this->db->trans_strict(FALSE);
                        $this->db->trans_start();
                        $products = $this->productModel->update_products($dataPro, $where);
                        if ($products) {
                            $log = $this->logproductModel->add_log($dataLog);
                            if ($log){
                                $this->db->trans_complete();
                                $this->session->set_flashdata('edit_success', true);
                                redirect("marketplace/Products/listProducts");
                            }
                            else{
                                $err = 1;
                            }
                        } else {
                            $err = 2;
                        }
                        if ($err) {
                            $this->db->trans_rollback();
                            $this->session->set_flashdata('error_message', 'Failed to edit product id = '.$this->input->post('pro_id').'. Error code: '.$err);
                            $this->load->view('marketplace/edit_product', $data);
                        }
                    } else {
                        $this->load->view('marketplace/edit_product', $data);
                    }
                } else {
                    $this->load->view('marketplace/edit_product', $data);
                }
            }
        }
        else{
            redirect('backend/Users/login');
        }
	}
	public function log(){
        if ($this->uri->segment(4)){
            $where['log_product_id'] = $this->uri->segment(4);
            $data['product'] = $this->logproductModel->get_logs($where)->result();
            $this->load->view('marketplace/log_product', $data);
        }
        else{
            redirect('marketplace/Products/listProducts');
        }
    }
	public function search_list(){
        if ($this->input->post('keywords')){
            $this->session->set_userdata('keywords', $this->input->post('keywords'));
            $data['keywords'] = $this->input->post('keywords');
        }
        else{
            if ($this->uri->segment(4)){
                $data['keywords'] = $this->session->userdata('keywords');
            }
            else{
                $this->session->set_userdata('keywords', '');
                $data['keywords'] = '';
            }
        }

        if ($data['keywords']){
            $like['pro_name'] = $data['keywords'];
        }
        else
            $like = null;
        $where['pro_stat'] = $this->config->item('accepted');
        $data['products'] = $this->productModel->search_products($where, 0, 0, $like)->result();
        $this->load->view("marketplace/view_products", $data);
    }

	public function search_all(){
		$data['types'] = 0;
		if ($this->input->post('types')){
			$this->session->set_userdata('types', $this->input->post('types'));
			$data['types'] = $this->input->post('types');
		}
		else{
			if ($this->uri->segment(4)){
				$data['types'] = $this->session->userdata('types');
			}
		}
		if ($this->input->post('keyword')){
			$this->session->set_userdata('keyword', $this->input->post('keyword'));
			$data['keyword'] = $this->input->post('keyword');
		}
		else{
			if ($this->uri->segment(4)){
				$data['keyword'] = $this->session->userdata('keyword');
			}
			else{
				$this->session->set_userdata('keyword', '');
				$data['keyword'] = '';
			}
		}

		$page = ($this->uri->segment(4)) ? ($this->uri->segment(4) - 1) : 0;
		$config['per_page'] = 9;
		$config['uri_segment'] = 4;
		$config['use_page_numbers'] = TRUE;

		//Encapsulate whole pagination 
		$config['full_tag_open'] = '<ul class="pagination justify-content-end">';
		$config['full_tag_close'] = '</ul>';

		//First link of pagination
		$config['first_link'] = 'First';
		$config['first_tag_open'] = '<li>';
		$config['first_tag_close'] = '</li>';

		//Customizing the Digit Link
		$config['num_tag_open'] = '<li>';
		$config['num_tag_close'] = '</li>';

		//For PREVIOUS PAGE Setup
		$config['prev_link'] = '<';
		$config['prev_tag_open'] = '<li>';
		$config['prev_tag_close'] = '</li>';

		//For NEXT PAGE Setup
		$config['next_link'] = '>';
		$config['next_tag_open'] = '<li>';
		$config['next_tag_close'] = '</li>';

		//For LAST PAGE Setup
		$config['last_link'] = 'Last';
		$config['last_tag_open'] = '<li>';
		$config['last_tag_close'] = '</li>';

		//For CURRENT page on which you are
		$config['cur_tag_open'] = '<li class="active"><a class="page-link bg-primary text-light border-primary" href="#">';
		$config['cur_tag_close'] = '</a></li>';

		$config['attributes'] = array('class' => 'page-link bg-light text-primary');

		if ($data['types'] == 0)
			$where = '';
		else
			$where['products.pro_type_id'] = $data['types'];

		$where['pro_stat'] = $this->config->item('accepted');
		$where['pro_stock !='] = 0;

		if ($data['keyword']){
			$like['pro_name'] = $this->input->post('keyword');
		}
		else
			$like = null;
			
		$data['products'] = $this->productModel->search_products($like, $where, $page * $config['per_page'], 9)->result();
		$data['pro_types'] = $this->productTypeModel->get_type()->result();

		$config['base_url'] = base_url() . 'marketplace/Products/index';
		$config['total_rows'] = $this->productModel->search_products($like, $where, $page * $config['per_page'], 0)->num_rows();
		$this->pagination->initialize($config);
		$this->load->view("marketplace/products_frontend", $data);
	}
}