<?php
defined('BASEPATH') OR exit('No direct script access allowed');

#[\AllowDynamicProperties]

class Breeds extends CI_Controller {
		public function __construct(){
			// Call the CI_Controller constructor
			parent::__construct();
			$this->load->model(array('trahModel'));
			$this->load->library(array('session', 'form_validation'));
			$this->load->helper(array('form', 'url'));
			$this->load->database();
		}

		public function index(){
			$data['breeds'] = $this->trahModel->get_trah(null)->result();
			$this->load->view('backend/view_breeds', $data);
		}

		public function add(){
			$this->load->view("backend/add_breed");
		}

		public function validate_add(){
			if ($this->session->userdata('use_username')){
				$this->form_validation->set_rules('tra_name', 'Breed ', 'trim|required|is_unique[trah.tra_name]');
				
				if ($this->form_validation->run() == FALSE){
					$this->load->view("backend/add_breed");
				}
				else{
					$breed = array(
						'tra_name' => strtoupper($this->input->post('tra_name')),
						'tra_stat' => $this->config->item('backend_breed'),
					);
					$res = $this->trahModel->add_trah($breed);
					if ($res){
						$this->session->set_flashdata('add_success', TRUE);
						redirect("backend/Breeds");
					}
					else{
						$this->session->set_flashdata('error_message', 'Failed to save breed');
						$this->load->view("backend/add_breed");
					}
				}
			}
            else{
                redirect("backend/Users/login");
            }
		}

		public function edit(){
            if ($this->uri->segment(4)){
				$where['tra_id'] = $this->uri->segment(4);
				$data['breed'] = $this->trahModel->get_trah($where)->row();
				$data['mode'] = 0;
				if ($data['breed']){
					$this->load->view("backend/edit_breed", $data);
				}
				else{
					redirect("backend/Breeds");
				}
			}
			else{
				redirect("backend/Breeds");
			}
		}

		public function validate_edit(){
			if ($this->session->userdata('use_username')){
				$this->form_validation->set_error_delimiters('<div>','</div>');
				$this->form_validation->set_rules('tra_name', 'Breed ', 'trim|required|is_unique[Trah.tra_name]');

				if ($this->form_validation->run() == FALSE){
					$this->load->view("backend/edit_breed");
				}
				else{
					$where['tra_id'] = $this->input->post('tra_id');
					$data['tra_name'] = strtoupper($this->input->post('tra_name'));
                    $res = $this->trahModel->update_trah($data, $where);
                    if ($res){
                        $this->session->set_flashdata('edit_success', TRUE);
                        redirect("backend/Breeds");
                    }
                    else{
                        $this->session->set_flashdata('error_message', 'Failed to edit breed');
						$this->load->view('backend/edit_breed');
					}
				}
			}
			else{
				redirect("backend/Users/login");
			}
		}

		public function delete(){
			if ($this->uri->segment(4)){
                if ($this->session->userdata('use_username')){
                    $where['tra_id'] = $this->uri->segment(4);
                    $data['tra_stat'] = $this->config->item('deleted');
                    $res = $this->trahModel->update_trah($data, $where);
                    if ($res){
                        $this->session->set_flashdata('delete', TRUE);
                    }
                    else{
                        $this->session->set_flashdata('error_message', 'Failed to delete breed');
                    }
                    redirect("backend/Breeds");
                }
                else{
                    redirect("backend/Users/login");
                }
			}
            else{
                redirect("backend/Breeds");
            }
		}

        public function activate(){
			if ($this->uri->segment(4)){
                if ($this->session->userdata('use_username')){
                    $where['tra_id'] = $this->uri->segment(4);
                    $data['tra_stat'] = $this->config->item('backend_breed');
                    $res = $this->trahModel->update_trah($data, $where);
                    if ($res){
                        $this->session->set_flashdata('activate', TRUE);
                    }
                    else{
                        $this->session->set_flashdata('error_message', 'Failed to activate breed');
                    }
                    redirect("backend/Breeds");
                }
                else{
                    redirect("backend/Users/login");
                }
			}
            else{
                redirect("backend/Breeds");
            }
		}
}
