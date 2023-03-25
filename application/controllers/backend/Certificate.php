<?php
defined('BASEPATH') or exit('No direct script access allowed');

#[\AllowDynamicProperties]

class Certificate extends CI_Controller{
    public function __construct(){
        parent::__construct();
        $this->load->model(array('caninesModel', 'settingModel'));
        $this->load->library(array('session'));
        $this->load->helper(array('url'));
        $this->load->database();
    }

    public function front(){
        if ($this->uri->segment(4)){
            $where['can_id'] = $this->uri->segment(4);
            $data['canine'] = $this->caninesModel->get_canines($where)->row();
            $data['rules'] = $this->settingModel->get_setting('set_rule')->row();
            if ($data['canine']) {
                if ($this->uri->segment(5)){
                    $this->load->view('backend/certificateFront', $data);
                }
                else{
                    $this->load->view('backend/certificatePreview', $data);
                }
            } else {
                $this->session->set_flashdata('error', 'Invalid canine id');
                redirect('backend/Canines');
            }
        } else {
            redirect('backend/Canines');
        }
    }

    public function back(){
        if ($this->uri->segment(4)){
            $where['can_id'] = $this->uri->segment(4);
            $data['canine'] = $this->caninesModel->get_can_pedigrees($where)->row();
            if ($data['canine']){ //&& $data['canine']->ped_canine_id != $this->config->item('sire_id') &&
                // $data['canine']->ped_canine_id != $this->config->item('dam_id')) {
                // level 1
                $sire['can_id'] = $data['canine']->ped_sire_id;
                $data['sire'] = $this->caninesModel->get_can_pedigrees($sire)->row();
                $dam['can_id'] = $data['canine']->ped_dam_id;
                $data['dam'] = $this->caninesModel->get_can_pedigrees($dam)->row();

                // level 2
                if ($data['sire']){ //&& $data['sire']->ped_canine_id != $this->config->item('sire_id')){
                    $sire21['can_id'] = $data['sire']->ped_sire_id;
                    $data['sire21'] = $this->caninesModel->get_can_pedigrees($sire21)->row();
                    $dam21['can_id'] = $data['sire']->ped_dam_id;
                    $data['dam21'] = $this->caninesModel->get_can_pedigrees($dam21)->row();
                }
                else{
                    $data['sire21'] = [];
                    $data['dam21'] = [];
                }

                if ($data['dam']){ //&& $data['dam']->ped_canine_id != $this->config->item('dam_id')){
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
                if ($data['sire21']){ //&& $data['sire21']->ped_canine_id != $this->config->item('sire_id')){
                    $sire31['can_id'] = $data['sire21']->ped_sire_id;
                    $data['sire31'] = $this->caninesModel->get_can_pedigrees($sire31)->row();
                    $dam31['can_id'] = $data['sire21']->ped_dam_id;
                    $data['dam31'] = $this->caninesModel->get_can_pedigrees($dam31)->row();
                }
                else{
                    $data['sire31'] = [];
                    $data['dam31'] = [];
                }

                if ($data['dam21']){ //&& $data['dam21']->ped_canine_id != $this->config->item('dam_id')){
                    $sire32['can_id'] = $data['dam21']->ped_sire_id;
                    $data['sire32'] = $this->caninesModel->get_can_pedigrees($sire32)->row();
                    $dam32['can_id'] = $data['dam21']->ped_dam_id;
                    $data['dam32'] = $this->caninesModel->get_can_pedigrees($dam32)->row();
                }
                else{
                    $data['sire32'] = [];
                    $data['dam32'] = [];
                }

                if ($data['sire22']){ //&& $data['sire22']->ped_canine_id != $this->config->item('sire_id')){
                    $sire33['can_id'] = $data['sire22']->ped_sire_id;
                    $data['sire33'] = $this->caninesModel->get_can_pedigrees($sire33)->row();
                    $dam33['can_id'] = $data['sire22']->ped_dam_id;
                    $data['dam33'] = $this->caninesModel->get_can_pedigrees($dam33)->row();
                }
                else{
                    $data['sire33'] = [];
                    $data['dam33'] = [];
                }

                if ($data['dam22']){ //&& $data['dam22']->ped_canine_id != $this->config->item('dam_id')){
                    $sire34['can_id'] = $data['dam22']->ped_sire_id;
                    $data['sire34'] = $this->caninesModel->get_can_pedigrees($sire34)->row();
                    $dam34['can_id'] = $data['dam22']->ped_dam_id;
                    $data['dam34'] = $this->caninesModel->get_can_pedigrees($dam34)->row();
                }
                else{
                    $data['sire34'] = [];
                    $data['dam34'] = [];
                }

                if ($this->uri->segment(5)){
                    $dataPrint['can_print'] = $data['canine']->can_print + 1;
                    $res = $this->caninesModel->update_canines($dataPrint, $where);
                    if ($res){
                        $this->load->view('backend/certificateBack', $data);
                    }
                    else{
                        $this->session->set_flashdata('error', 'Gagal menyimpan data');
                        redirect('backend/Canines');
                    }
                }
                else{
                    $this->load->view('backend/certificatePreviewBack', $data);
                }
            }
            else{
                $this->session->set_flashdata('error', 'Invalid canine id');
                redirect('backend/Canines');
            }
        } else {
            redirect('backend/Canines');
        }
    }
}
