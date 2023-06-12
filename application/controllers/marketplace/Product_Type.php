<?php
defined('BASEPATH') OR exit('No direct script access allowed');

#[\AllowDynamicProperties]

class Product_Type extends CI_Controller {
		public function __construct(){
			// Call the CI_Controller constructor
			parent::__construct();
			$this->load->model(array('productTypeModel'));
			$this->load->library(array('session', 'form_validation'));
			$this->load->helper(array('form', 'url'));
			$this->load->database();
		}

		public function index(){
			$data['product_types'] = $this->productTypeModel->get_type(null)->result();
			$this->load->view('marketplace/product_type', $data);
		}

		public function add(){
			$this->load->view("marketplace/add_product_type");
		}

		public function validate_add(){
			if ($this->session->userdata('use_username')){
				$this->form_validation->set_rules('pro_type_name', 'Product Type ', 'trim|required|is_unique[products_type.pro_type_name]');
				
				if ($this->form_validation->run() == FALSE){
					$this->load->view("marketplace/add_product_type");
				}
				else{
					$pro_type = array(
						'pro_type_name' => $this->input->post('pro_type_name'),
						'pro_type_stat' => $this->config->item('accepted'),
					);
					$res = $this->productTypeModel->add_type($pro_type);
					if ($res){
						$this->session->set_flashdata('add_success', TRUE);
						redirect("marketplace/product_type");
					}
					else{
						$this->session->set_flashdata('error_message', 'Failed to save product type');
						$this->load->view("marketplace/add_product_type");
					}
				}
			}
            else{
                redirect("marketplace/Users/login");
            }
		}

		public function edit(){
            if ($this->uri->segment(4)){
				$where['pro_type_id'] = $this->uri->segment(4);
				$data['pro_type'] = $this->productTypeModel->get_type($where)->row();
				$data['mode'] = 0;
				if ($data['pro_type']){
					$this->load->view("marketplace/edit_product_type", $data);
				}
				else{
					redirect("marketplace/Product_Type");
				}
			}
			else{
				redirect("marketplace/Product_Type");
			}
		}

		public function validate_edit(){
            $data['mode'] = 1;
			if ($this->session->userdata('use_username')){
				$this->form_validation->set_error_delimiters('<div>','</div>');
				$this->form_validation->set_rules('pro_type_name', 'Product Type ', 'trim|required|is_unique[products_type.pro_type_name]');

				if ($this->form_validation->run() == FALSE){
					$this->load->view("marketplace/edit_product_type", $data);
				}
				else{
					$where['pro_type_id'] = $this->input->post('pro_type_id');
					$dataType['pro_type_name'] = $this->input->post('pro_type_name');
                    $res = $this->productTypeModel->update_type($dataType, $where);
                    if ($res){
                        $this->session->set_flashdata('edit_success', TRUE);
                        redirect("marketplace/Product_Type");
                    }
                    else{
                        $this->session->set_flashdata('error_message', 'Failed to edit product type');
						$this->load->view('marketplace/edit_product_type', $data);
					}
				}
			}
			else{
				redirect("marketplace/Users/login");
			}
		}

		public function delete(){
			if ($this->uri->segment(4)){
                if ($this->session->userdata('use_username')){
                    $where['pro_type_id'] = $this->uri->segment(4);
                    $data['pro_type_stat'] = $this->config->item('deleted');
                    $res = $this->productTypeModel->update_type($data, $where);
                    if ($res){
                        $this->session->set_flashdata('delete_success', TRUE);
                    }
                    else{
                        $this->session->set_flashdata('delete_message', 'Failed to delete product type');
                    }
                    redirect("marketplace/Product_Type");
                }
                else{
                    redirect("marketplace/Users/login");
                }
			}
            else{
                redirect("marketplace/Product_Type");
            }
		}

        public function activate(){
			if ($this->uri->segment(4)){
                if ($this->session->userdata('use_username')){
                    $where['pro_type_id'] = $this->uri->segment(4);
                    $data['pro_type_stat'] = $this->config->item('accepted');
                    $res = $this->productTypeModel->update_type($data, $where);
                    if ($res){
                        $this->session->set_flashdata('activate_success', TRUE);
                    }
                    else{
                        $this->session->set_flashdata('delete_message', 'Failed to activate product type');
                    }
                    redirect("marketplace/Product_Type");
                }
                else{
                    redirect("marketplace/Users/login");
                }
			}
            else{
                redirect("marketplace/Product_Type");
            }
		}
}
