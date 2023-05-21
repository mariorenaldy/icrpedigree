<?php
defined('BASEPATH') OR exit('No direct script access allowed');

#[\AllowDynamicProperties]

class Pets extends CI_Controller {
    public function __construct(){
		parent::__construct();
		$this->load->model(array('petModel', 'logpetModel'));
		$this->load->library(array('session', 'form_validation', 'pagination'));
		$this->load->helper(array('url'));
		$this->load->database();
	}
	public function index(){
		//pagination
		$config['base_url'] = base_url() . 'marketplace/Pets/index';
		$config['total_rows'] = $this->petModel->record_count();
		$config['per_page'] = 9;
		$config['attributes'] = array('class' => 'page-link');

		//initialize pagination
		$this->pagination->initialize($config);

		$data['start'] = $this->uri->segment(4);
		$where['pet_stat'] = $this->config->item('accepted');
		$data['pets'] = $this->petModel->fetch_data($where, $config['per_page'], $data['start'])->result();

        $this->load->view("marketplace/pets", $data);
	}
	public function search(){
		$keyword = '';
		if($this->input->get('keyword')){
			$keyword = $this->input->get('keyword');
		}
		else{
			redirect('marketplace/Pets');
		}

		//pagination
		$this->db->like('pet_name', $keyword);
		$this->db->from('pets');
		$config['base_url'] = base_url() . 'marketplace/Pets/search';
		$config['total_rows'] = $this->db->count_all_results();
		$config['per_page'] = 9;
		$config['attributes'] = array('class' => 'page-link');

		//initialize pagination
		$this->pagination->initialize($config);

		$data['start'] = $this->uri->segment(4);

		$like['pet_name'] = $keyword;
		$where['pet_stat'] = $this->config->item('accepted');
		$data['pets'] = $this->petModel->search_pets($where, $config['per_page'], $data['start'], $like)->result();

		$this->load->view("marketplace/pets", $data);
    }
	public function pet_detail(){
		if ($this->uri->segment(4)){
			$where['pet_id'] = $this->uri->segment(4);
			$where['pet_stat'] = $this->config->item('accepted');
			$data['pets'] = $this->petModel->get_pets($where)->row();
			if($data['pets']){
				$this->load->view("marketplace/pet_detail", $data);
			}
			else{
				redirect('marketplace/pets');
			}
        }
        else{
          	redirect('marketplace/pets');
        }
	}
	public function pet_payment(){
		if ($this->uri->segment(4)){
			$where['pet_id'] = $this->uri->segment(4);
			$where['pet_stat'] = $this->config->item('accepted');
			$data['pets'] = $this->petModel->get_pets($where)->row();
			if($data['pets']){
				$this->load->view("marketplace/pet_payment", $data);
			}
			else{
				redirect('marketplace/pets');
			}
        }
        else{
          	redirect('marketplace/pet_detail');
        }
	}

	//backend
	public function listPets()
	{
		$where['pet_stat'] = $this->config->item('accepted');
		$data['pets'] = $this->petModel->get_pets($where)->result();
		$this->load->view("marketplace/view_pets", $data);
	}
	public function add()
	{
		$this->load->view('marketplace/add_pet');
	}
	public function validate_add()
	{
		if ($this->session->userdata('use_username')) {
			$this->form_validation->set_error_delimiters('<div>', '</div>');
			$this->form_validation->set_rules('pet_name', 'Name ', 'trim|required');
			$this->form_validation->set_rules('pet_price', 'Price ', 'trim|required');

			if ($this->form_validation->run() == FALSE) {
				$this->load->view('marketplace/add_pet');
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

					$img_name = $this->config->item('path_pet') . 'pet_' . time() . '.png';
					if (!is_dir($this->config->item('path_pet')) or !is_writable($this->config->item('path_pet'))) {
						$err++;
						$this->session->set_flashdata('error_message', 'Pets folder not found or not writable.');
					} else {
						if (is_file($img_name) and !is_writable($img_name)) {
							$err++;
							$this->session->set_flashdata('error_message', 'File already exists and not writable.');
						}
					}
				}

				if (!$err && $this->petModel->check_for_duplicate($this->input->post('pet_id'), 'pet_name', $this->input->post('pet_name'))){
                    $err++;
                    $this->session->set_flashdata('error_message', 'Pet name cannot be the same');
                }

				if (!$err) {
					file_put_contents($img_name, $uploadedImg);
					$photo = str_replace($this->config->item('path_pet'), '', $img_name);

					$id = $this->petModel->record_count() + 1;
					$dataPet = array(
						'pet_id' => $id,
						'pet_name' => $this->input->post('pet_name'),
						'pet_price' => $this->input->post('pet_price'),
						'pet_desc' => $this->input->post('pet_desc'),
						'pet_photo' => $photo,
						'pet_created_user' => $this->session->userdata('use_id'),
						'pet_created_at' => date('Y-m-d H:i:s'),
						'pet_stat' => $this->config->item('accepted')
					);

					$dataLog = array(
						'log_pet_id' => $id,
						'log_pet_name' => $this->input->post('pet_name'),
						'log_pet_price' => $this->input->post('pet_price'),
						'log_pet_desc' => $this->input->post('pet_desc'),
						'log_pet_photo' => $photo,
						'log_pet_created_user' => $this->session->userdata('use_id'),
						'log_pet_created_at' => date('Y-m-d H:i:s'),
						'log_stat' => $this->config->item('accepted')
					);

					if (!$err) {
						$this->db->trans_strict(FALSE);
						$this->db->trans_start();
						$pets = $this->petModel->add_pets($dataPet);
						if ($pets) {
							$log = $this->logpetModel->add_log($dataLog);
							if ($log) {
								$this->db->trans_complete();
								$this->session->set_flashdata('add_success', true);
								redirect("marketplace/Pets/listPets");
							} else {
								$err = 1;
							}
						} else {
							$err = 2;
						}
						if ($err) {
							$this->db->trans_rollback();
							$this->session->set_flashdata('error_message', 'Failed to save pet. Error code: ' . $err);
							$this->load->view('marketplace/add_pet');
						}
					} else {
						$this->load->view('marketplace/add_pet');
					}
				} else {
					$this->load->view('marketplace/add_pet');
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
                $where['pet_id'] = $this->uri->segment(4);
                $data['pet_stat'] = $this->config->item('deleted');
                $data['pet_updated_user'] = $this->session->userdata('use_id');
                $data['pet_updated_at'] = date('Y-m-d H:i:s');

                $dataLog = array(
                    'log_pet_id' => $this->uri->segment(4),
                    'log_stat' => $this->config->item('deleted'),
                    'log_pet_updated_user' => $this->session->userdata('use_id'),
                    'log_pet_updated_at' => date('Y-m-d H:i:s'),
                );

                $this->db->trans_strict(FALSE);
                $this->db->trans_start();
                $res = $this->petModel->update_pets($data, $where);
                if ($res){
                    $log = $this->logpetModel->add_log($dataLog);
                    if ($log){
                        $this->db->trans_complete();
                        $this->session->set_flashdata('delete_success', TRUE);
                        redirect("marketplace/Pets/listPets");
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
                    $this->session->set_flashdata('error_message', 'Failed to delete pet id = '.$this->uri->segment(4).'. Error code: '.$err);
                    redirect('marketplace/Pets/listPets');
                }
            }
            else{
                redirect("backend/Users/login");
            }
        }
        else{
        	redirect("marketplace/Pets/listPets");
        }
    }
	public function edit(){
        if ($this->uri->segment(4)){
            $where['pet_id'] = $this->uri->segment(4);
            $data['pet'] = $this->petModel->get_pets($where)->row();
			$data['mode'] = 0;
            $this->load->view("marketplace/edit_pet", $data);
        }
        else{
            redirect('marketplace/Pets/listPets');
        }
    }
	public function validate_edit(){ 
        if ($this->session->userdata('use_username')) {
            $this->form_validation->set_error_delimiters('<div>', '</div>');
            $this->form_validation->set_rules('pet_name', 'Name ', 'trim|required');
            $this->form_validation->set_rules('pet_price', 'Price ', 'trim|required');

            $where['pet_id'] = $this->input->post('pet_id');
            $data['pet'] = $this->petModel->get_pets($where)->row();
            $data['mode'] = 1;

            if ($this->form_validation->run() == FALSE) {
                $this->load->view('marketplace/edit_pet', $data);
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
            
                        $img_name = $this->config->item('path_pet').$this->config->item('file_name_pet');
                        if (!is_dir($this->config->item('path_pet')) or !is_writable($this->config->item('path_pet'))) {
                            $err++;
                            $this->session->set_flashdata('error_message', 'Pet folder not found or not writable.');
                        } else{
                            if (is_file($img_name) and !is_writable($img_name)) {
                                $err++;
                                $this->session->set_flashdata('error_message', 'File already exists and not writable.');
                            }
                        }
                    }
				}

                if (!$err && $this->petModel->check_for_duplicate($this->input->post('pet_id'), 'pet_name', $this->input->post('pet_name'))){
                    $err++;
                    $this->session->set_flashdata('error_message', 'Pet name cannot be the same');
                }

                if (!$err) {
                    if (isset($uploadedImg)){
                        file_put_contents($img_name, $uploadedImg);
                        $photo = str_replace($this->config->item('path_pet'), '', $img_name);
                    }

					$dataPet = array(
						'pet_name' => $this->input->post('pet_name'),
						'pet_price' => $this->input->post('pet_price'),
						'pet_desc' => $this->input->post('pet_desc'),
						'pet_updated_user' => $this->session->userdata('use_id'),
						'pet_updated_at' => date('Y-m-d H:i:s')
					);

                    if ($photo != '-')
                        $dataPet['pet_photo'] = $photo;

					$dataLog = array(
						'log_pet_id' => $this->input->post('pet_id'),
						'log_pet_name' => $this->input->post('pet_name'),
						'log_pet_price' => $this->input->post('pet_price'),
						'log_pet_desc' => $this->input->post('pet_desc'),
						'log_pet_photo' => $photo,
						'log_pet_updated_user' => $this->session->userdata('use_id'),
						'log_pet_updated_at' => date('Y-m-d H:i:s')
					);

                    if (!$err) {
                        $this->db->trans_strict(FALSE);
                        $this->db->trans_start();
                        $pets = $this->petModel->update_pets($dataPet, $where);
                        if ($pets) {
                            $log = $this->logpetModel->add_log($dataLog);
                            if ($log){
                                $this->db->trans_complete();
                                $this->session->set_flashdata('edit_success', true);
                                redirect("marketplace/Pets/listPets");
                            }
                            else{
                                $err = 1;
                            }
                        } else {
                            $err = 2;
                        }
                        if ($err) {
                            $this->db->trans_rollback();
                            $this->session->set_flashdata('error_message', 'Failed to edit pet id = '.$this->input->post('pet_id').'. Error code: '.$err);
                            $this->load->view('marketplace/edit_pet', $data);
                        }
                    } else {
                        $this->load->view('marketplace/edit_pet', $data);
                    }
                } else {
                    $this->load->view('marketplace/edit_pet', $data);
                }
            }
        }
        else{
            redirect('backend/Users/login');
        }
	}
}