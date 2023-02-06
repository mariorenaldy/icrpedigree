<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Certificate extends CI_Controller{
    public function __construct(){
        parent::__construct();
        $this->load->model(array('caninesModel', 'settingModel'));
        $this->load->library(array('session'));
        $this->load->helper(array('url'));
        $this->load->database();
    }

    public function index(){
        if ($this->uri->segment(4)){
            $where['can_id'] = $this->uri->segment(4);
            $data['canine'] = $this->caninesModel->get_can_pedigrees($where)->row();
            if ($data['canine']){ 
                // level 1
                $sire['can_id'] = $data['canine']->ped_sire_id;
                $data['sire'] = $this->caninesModel->get_can_pedigrees($sire)->row();
                $dam['can_id'] = $data['canine']->ped_dam_id;
                $data['dam'] = $this->caninesModel->get_can_pedigrees($dam)->row();

                // level 2
                if ($data['sire']){ 
                    $sire21['can_id'] = $data['sire']->ped_sire_id;
                    $data['sire21'] = $this->caninesModel->get_can_pedigrees($sire21)->row();
                    $dam21['can_id'] = $data['sire']->ped_dam_id;
                    $data['dam21'] = $this->caninesModel->get_can_pedigrees($dam21)->row();
                }
                else{
                    $data['sire21'] = [];
                    $data['dam21'] = [];
                }

                if ($data['dam']){ 
                    $sire22['can_id'] = $data['dam']->ped_sire_id;
                    $data['sire22'] = $this->caninesModel->get_can_pedigrees($sire22)->row();
                    $dam22['can_id'] = $data['dam']->ped_dam_id;
                    $data['dam22'] = $this->caninesModel->get_can_pedigrees($dam22)->row();
                }
                else{
                    $data['sire22'] = [];
                    $data['dam22'] = [];
                }

                // level 3
                if ($data['sire21']){ 
                    $sire31['can_id'] = $data['sire21']->ped_sire_id;
                    $data['sire31'] = $this->caninesModel->get_can_pedigrees($sire31)->row();
                    $dam31['can_id'] = $data['sire21']->ped_dam_id;
                    $data['dam31'] = $this->caninesModel->get_can_pedigrees($dam31)->row();
                }
                else{
                    $data['sire31'] = [];
                    $data['dam31'] = [];
                }

                if ($data['dam21']){ 
                    $sire32['can_id'] = $data['dam21']->ped_sire_id;
                    $data['sire32'] = $this->caninesModel->get_can_pedigrees($sire32)->row();
                    $dam32['can_id'] = $data['dam21']->ped_dam_id;
                    $data['dam32'] = $this->caninesModel->get_can_pedigrees($dam32)->row();
                }
                else{
                    $data['sire32'] = [];
                    $data['dam32'] = [];
                }

                if ($data['sire22']){ 
                    $sire33['can_id'] = $data['sire22']->ped_sire_id;
                    $data['sire33'] = $this->caninesModel->get_can_pedigrees($sire33)->row();
                    $dam33['can_id'] = $data['sire22']->ped_dam_id;
                    $data['dam33'] = $this->caninesModel->get_can_pedigrees($dam33)->row();
                }
                else{
                    $data['sire33'] = [];
                    $data['dam33'] = [];
                }

                if ($data['dam22']){ 
                    $sire34['can_id'] = $data['dam22']->ped_sire_id;
                    $data['sire34'] = $this->caninesModel->get_can_pedigrees($sire34)->row();
                    $dam34['can_id'] = $data['dam22']->ped_dam_id;
                    $data['dam34'] = $this->caninesModel->get_can_pedigrees($dam34)->row();
                }
                else{
                    $data['sire34'] = [];
                    $data['dam34'] = [];
                }
                $this->load->view('frontend/certificateBack', $data);
            }
            else{
                $this->session->set_flashdata('error', 'Id canine tidak valid');
                redirect('frontend/Canines');
            }
        } else {
            redirect('frontend/Canines');
        }
    }
}
