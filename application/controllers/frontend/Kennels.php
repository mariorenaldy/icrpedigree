<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Kennels extends CI_Controller {
		public function __construct(){
			// Call the CI_Controller constructor
			parent::__construct();
			$this->load->model(array('MemberModel', 'KenneltypeModel', 'KennelModel'));
			$this->load->library('upload', $this->config->item('upload_kennel'));
			$this->load->library(array('session', 'form_validation'));
			$this->load->helper(array('form', 'url'));
			$this->load->database();
		}

		public function index(){
            if ($this->session->userdata('mem_id')){
				$where['ken_member_id'] = $this->session->userdata('mem_id');
				$data['kennel'] = $this->KennelModel->get_kennels($where)->result();
				$this->load->view('frontend/view_kennels', $data);
			}
			else{
				redirect('frontend/Members');
			}
        }

		public function add(){
			$data['kennelType'] = $this->KenneltypeModel->get_kennel_types(null)->result();
			$this->load->view("frontend/add_kennel", $data);
		}

		public function validate_add(){
			if ($this->session->userdata('username')){
				$this->form_validation->set_error_delimiters('<div>','</div>');
				$this->form_validation->set_message('required', '%s wajib diisi');
				$this->form_validation->set_message('is_unique', '%s tidak boleh sama');
				$this->form_validation->set_rules('ken_name', 'Nama', 'trim|required|is_unique[kennels.ken_name]');
				
				$data['kennelType'] = $this->KenneltypeModel->get_kennel_types(null)->result();
				if ($this->form_validation->run() == FALSE){
					$this->load->view("frontend/add_kennel", $data);
				}
				else{
					$err = 0;
					$logo = '-';
					if (isset($_FILES['attachment_logo']) && !empty($_FILES['attachment_logo']['tmp_name']) && is_uploaded_file($_FILES['attachment_logo']['tmp_name'])){
						if (is_uploaded_file($_FILES['attachment_logo']['tmp_name'])){
							$this->upload->initialize($this->config->item('upload_kennel'));
							if ($this->upload->do_upload('attachment_logo')){
								$uploadData = $this->upload->data();
								$logo = $uploadData['file_name'];
							}
							else{
								$err++;
								$this->session->set_flashdata('error_message', $this->upload->display_errors());
							}
						}
					}

					if (!$err && $logo == "-"){
						$err++;
						$this->session->set_flashdata('error_message', 'Foto kennel wajib diisi');
					}

					if (!$err){
						$ken_id = $this->KennelModel->record_count() + 1;
						$kennel_data = array(
							'ken_id' => $ken_id,
							'ken_name' => $this->input->post('ken_name'),
							'ken_type_id' => $this->input->post('ken_type_id'),
							'ken_photo' => $logo,
							'ken_member_id' => $this->session->userdata('mem_id'),
						);
						$res = $this->KennelModel->add_kennels($kennel_data);
						if ($res){
							$this->session->set_flashdata('add_success', TRUE);
							redirect("frontend/Kennels");
						}
						else{
							$this->session->set_flashdata('error_message', 'Gagal menyimpan kennel');
							$this->load->view("frontend/add_kennel", $data);
						}
					}
					else{
						$this->load->view("frontend/add_kennel", $data);
					}
				}
			}
			else{
				redirect('frontend/Members');
			}
		}
}
