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

		$this->load->view("marketplace/products_frontend", $data);
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

		$this->load->view("marketplace/products_frontend", $data);
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

					$id = $this->productModel->record_count() + 1;
					$dataPro = array(
						'pro_id' => $id,
						'pro_type_id' => $this->input->post('pro_type_id'),
						'pro_name' => $this->input->post('pro_name'),
						'pro_price' => $this->input->post('pro_price'),
						'pro_desc' => $this->input->post('pro_desc'),
						'pro_photo' => $photo,
						'pro_created_user' => $this->session->userdata('use_id'),
						'pro_created_at' => date('Y-m-d H:i:s'),
						'pro_updated_user' => $this->session->userdata('use_id'),
						'pro_updated_at' => date('Y-m-d H:i:s'),
						'pro_stat' => $this->config->item('accepted')
					);

					$dataLog = array(
						'log_product_id' => $id,
						'log_product_type_id' => $this->input->post('pro_type_id'),
						'log_product_name' => $this->input->post('pro_name'),
						'log_product_price' => $this->input->post('pro_price'),
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

                    if ($photo != '-')
                        $dataPro['pro_photo'] = $photo;

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
}