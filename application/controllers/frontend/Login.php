<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {
		public function __construct(){
				// Call the CI_Controller constructor
				parent::__construct();
        $this->load->model(array('MemberModel'));
        $this->load->library(array('session', 'form_validation'));
        $this->load->helper(array('form', 'url'));
        $this->load->database();
		}

		public function index(){
        if (!$this->session->userdata('username')){
            $data['content'] = 'login';
            $this->load->view("frontend/login_form", $data);
        }
        else{
            // redirect("frontend/Dashboard");
            redirect("frontend/beranda");
        }
    }

    public function validate_login(){
        $where['members.mem_username'] = $this->input->post('username');
        $member = $this->MemberModel->get_members($where)->row();

        $err = 0;
        if (!$member){
            $err++;
            $this->session->set_flashdata('login_error', 'Maaf nama pengguna tidak terdaftar');
        }

        if (!$err && !$member->mem_stat){
            $err++;
            $this->session->set_flashdata('login_error', 'Masa berlaku member telah habis. Harap melakukan pembayaran');
        }

        if (!$err && !$member->mem_app_user){
            $err++;
            $this->session->set_flashdata('login_error', 'Data member belum di-approve. Harap menghubungi customer service');
        }

        if (!$err && sha1($this->input->post('password')) != $member->mem_password){
            $err++;
            $this->session->set_flashdata('login_error', 'Maaf kata sandi anda salah');
        }

        if (!$err){
            $this->session->set_userdata('username', $this->input->post('username'));
            // redirect("frontend/Dashboard");
            redirect("frontend/beranda");
        }
        else{
            $data['content'] = 'login';
            $this->load->view("frontend/login_form", $data);
        }
    }
}
