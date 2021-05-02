<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pedigrees extends CI_Controller {
    public function __construct(){
        // Call the CI_Controller constructor
        parent::__construct();
        $this->load->model(array('caninesModel', 'pedigreesModel'));
    }

    public function search(){
        if ($this->uri->segment(4)){
            if ($this->uri->segment(5)){
                $canine = $this->caninesModel->search_by_member_app($this->uri->segment(4), 0, $this->uri->segment(5));
                $count = $this->caninesModel->search_count_by_member_app($this->uri->segment(4), 0, $this->uri->segment(5));
                echo json_encode([
                  'status' => true,
                  'count_data' => $count[0]->count,
                  'count_pedigree' => $this->config->item('pedigree_count'),
                  'data' => $canine
                ]);
            }
            else{
                $canine = $this->caninesModel->search_by_member_app($this->uri->segment(4), 0, 0);
                $count = $this->caninesModel->search_count_by_member_app($this->uri->segment(4), 0, 0);
                echo json_encode([
                  'status' => true,
                  'count_data' => $count[0]->count,
                  'count_pedigree' => $this->config->item('pedigree_count'),
                  'data' => $canine
                ]);
            }
        }
        else
            echo json_encode([
              'status' => false,
              'message' => 'Kata kunci wajib diisi'
            ]);
    }

    public function id(){
        if ($this->uri->segment(4)){
            $where['can_id'] = $this->uri->segment(4);
            $data['canine'] = $this->caninesModel->get_can_pedigrees($where)->result_array();
            $sire['can_id'] = $data['canine'][0]['ped_sire_id'];
            $dam['can_id'] = $data['canine'][0]['ped_mom_id'];
            
            // sire & mom level 1
            $data['canine'][0]['sire'] = $this->caninesModel->get_can_pedigrees($sire)->result_array();
            $data['canine'][0]['mom'] = $this->caninesModel->get_can_pedigrees($dam)->result_array();

            // sire & mom level 2
            if ($data['canine'][0]['sire']) {
              $sire1['can_id'] = $data['canine'][0]['sire'][0]['ped_sire_id'];
              $dam1['can_id'] = $data['canine'][0]['sire'][0]['ped_mom_id'];
              $data['canine'][0]['sire'][0]['sire'] = $this->caninesModel->get_can_pedigrees($sire1)->result_array();
              $data['canine'][0]['sire'][0]['mom'] = $this->caninesModel->get_can_pedigrees($dam1)->result_array();

              $sire2['can_id'] = $data['canine'][0]['mom'][0]['ped_sire_id'];
              $dam2['can_id'] = $data['canine'][0]['mom'][0]['ped_mom_id'];
              $data['canine'][0]['mom'][0]['sire'] = $this->caninesModel->get_can_pedigrees($sire2)->result_array();
              $data['canine'][0]['mom'][0]['mom'] = $this->caninesModel->get_can_pedigrees($dam2)->result_array();

              // sire level 3
              if ($data['canine'][0]['sire'][0]['sire']) {
                  $sire12['can_id'] = $data['canine'][0]['sire'][0]['sire'][0]['ped_sire_id'];
                  $dam12['can_id'] = $data['canine'][0]['sire'][0]['sire'][0]['ped_mom_id'];
                  $data['canine'][0]['sire'][0]['sire'][0]['sire'] = $this->caninesModel->get_can_pedigrees($sire12)->result_array();
                  $data['canine'][0]['sire'][0]['sire'][0]['mom'] = $this->caninesModel->get_can_pedigrees($dam12)->result_array();
              }

              if ($data['canine'][0]['sire'][0]['mom']) {
                  $sire22['can_id'] = $data['canine'][0]['sire'][0]['mom'][0]['ped_sire_id'];
                  $dam22['can_id'] = $data['canine'][0]['sire'][0]['mom'][0]['ped_mom_id'];
                  $data['canine'][0]['sire'][0]['mom'][0]['sire'] = $this->caninesModel->get_can_pedigrees($sire22)->result_array();
                  $data['canine'][0]['sire'][0]['mom'][0]['mom'] = $this->caninesModel->get_can_pedigrees($dam22)->result_array();
              }

              if ($data['canine'][0]['mom'][0]['sire']) {
                  $sire12['can_id'] = $data['canine'][0]['mom'][0]['sire'][0]['ped_sire_id'];
                  $dam12['can_id'] = $data['canine'][0]['mom'][0]['sire'][0]['ped_mom_id'];
                  $data['canine'][0]['mom'][0]['sire'][0]['sire'] = $this->caninesModel->get_can_pedigrees($sire12)->result_array();
                  $data['canine'][0]['mom'][0]['sire'][0]['mom'] = $this->caninesModel->get_can_pedigrees($dam12)->result_array();
              }

              if ($data['canine'][0]['mom'][0]['mom']) {
                  $sire22['can_id'] = $data['canine'][0]['mom'][0]['mom'][0]['ped_sire_id'];
                  $dam22['can_id'] = $data['canine'][0]['mom'][0]['mom'][0]['ped_mom_id'];
                  $data['canine'][0]['mom'][0]['mom'][0]['sire'] = $this->caninesModel->get_can_pedigrees($sire22)->result_array();
                  $data['canine'][0]['mom'][0]['mom'][0]['mom'] = $this->caninesModel->get_can_pedigrees($dam22)->result_array();
              }
            }

            if ($data['canine'][0]['ped_sire_id'] != '86' && $data['canine'][0]['ped_mom_id'] != '87') {
              // sibling male
              $whereMale['ped_sire_id'] = $data['canine'][0]['ped_sire_id'];
              $whereMale['ped_mom_id'] = $data['canine'][0]['ped_mom_id'];
              $whereMale['can_gender'] = 'Male';
              $whereMale['ped_canine_id !='] = $data['canine'][0]['can_id'];
              $data['sibling_male'] = $this->pedigreesModel->get_sibling($whereMale)->result();

              // sibling female
              $whereFamale['ped_sire_id'] = $data['canine'][0]['ped_sire_id'];
              $whereFamale['ped_mom_id'] = $data['canine'][0]['ped_mom_id'];
              $whereFamale['can_gender'] = 'Female';
              $whereFamale['ped_canine_id !='] = $data['canine'][0]['can_id'];
              $data['sibling_female'] = $this->pedigreesModel->get_sibling($whereFamale)->result();
            }

            $this->load->view('pedigree.php', $data);
        }
    }
}
