<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Certificate extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model(array('caninesModel'));
        $this->load->model(array('caninesModel', 'memberModel', 'pedigreesModel'));
    }

    public function print($id)
    {
        $where1['can_id'] = $id;
        $data['canine'] = $this->caninesModel->get_canines($where1)->result();
        $where2['mem_id'] = $data['canine'][0]->can_member_id;
        $data['member'] = $this->memberModel->get_members($where2)->result();
        $this->load->view('backend/certificatePreview', $data);
    }

    // public function view_back()
    // {
    //     $this->load->view('backend/certificatePreviewBack');
    // }

    public function view_back($id)
    {
        $where['can_id'] = $id;
        $data['canine'] = $this->caninesModel->get_can_pedigrees($where)->result_array();
        if (!empty($data['canine'])) {
            $sire['can_id'] = $data['canine'][0]['ped_sire_id'];
            $dam['can_id'] = $data['canine'][0]['ped_dam_id'];
            // sire & dam level 1
            $data['canine'][0]['sire'] = $this->caninesModel->get_can_pedigrees($sire)->result_array();
            $data['canine'][0]['dam'] = $this->caninesModel->get_can_pedigrees($dam)->result_array();

            if ($data['canine'][0]['sire']) {
                $data['canine'][0]['sire'][0]['sire_as_count'] = strlen($data['canine'][0]['sire'][0]['can_a_s']);
            }

            if ($data['canine'][0]['dam']) {
                $data['canine'][0]['dam'][0]['dam_as_count'] = strlen($data['canine'][0]['dam'][0]['can_a_s']);
            }

            // sire & dam level 2
            if ($data['canine'][0]['sire']) {
                $sire1['can_id'] = $data['canine'][0]['sire'][0]['ped_sire_id'];
                $dam1['can_id'] = $data['canine'][0]['sire'][0]['ped_dam_id'];
                $data['canine'][0]['sire'][0]['sire'] = $this->caninesModel->get_can_pedigrees($sire1)->result_array();
                $data['canine'][0]['sire'][0]['dam'] = $this->caninesModel->get_can_pedigrees($dam1)->result_array();

                $sire2['can_id'] = $data['canine'][0]['dam'][0]['ped_sire_id'];
                $dam2['can_id'] = $data['canine'][0]['dam'][0]['ped_dam_id'];
                $data['canine'][0]['dam'][0]['sire'] = $this->caninesModel->get_can_pedigrees($sire2)->result_array();
                $data['canine'][0]['dam'][0]['dam'] = $this->caninesModel->get_can_pedigrees($dam2)->result_array();

                // sire level 3
                if ($data['canine'][0]['sire'][0]['sire']) {
                    $sire12['can_id'] = $data['canine'][0]['sire'][0]['sire'][0]['ped_sire_id'];
                    $dam12['can_id'] = $data['canine'][0]['sire'][0]['sire'][0]['ped_dam_id'];
                    $data['canine'][0]['sire'][0]['sire'][0]['sire'] = $this->caninesModel->get_can_pedigrees($sire12)->result_array();
                    $data['canine'][0]['sire'][0]['sire'][0]['dam'] = $this->caninesModel->get_can_pedigrees($dam12)->result_array();
                }

                if ($data['canine'][0]['sire'][0]['dam']) {
                    $sire22['can_id'] = $data['canine'][0]['sire'][0]['dam'][0]['ped_sire_id'];
                    $dam22['can_id'] = $data['canine'][0]['sire'][0]['dam'][0]['ped_dam_id'];
                    $data['canine'][0]['sire'][0]['dam'][0]['sire'] = $this->caninesModel->get_can_pedigrees($sire22)->result_array();
                    $data['canine'][0]['sire'][0]['dam'][0]['dam'] = $this->caninesModel->get_can_pedigrees($dam22)->result_array();
                }

                if ($data['canine'][0]['dam'][0]['sire']) {
                    $sire12['can_id'] = $data['canine'][0]['dam'][0]['sire'][0]['ped_sire_id'];
                    $dam12['can_id'] = $data['canine'][0]['dam'][0]['sire'][0]['ped_dam_id'];
                    $data['canine'][0]['dam'][0]['sire'][0]['sire'] = $this->caninesModel->get_can_pedigrees($sire12)->result_array();
                    $data['canine'][0]['dam'][0]['sire'][0]['dam'] = $this->caninesModel->get_can_pedigrees($dam12)->result_array();
                }

                if ($data['canine'][0]['dam'][0]['dam']) {
                    $sire22['can_id'] = $data['canine'][0]['dam'][0]['dam'][0]['ped_sire_id'];
                    $dam22['can_id'] = $data['canine'][0]['dam'][0]['dam'][0]['ped_dam_id'];
                    $data['canine'][0]['dam'][0]['dam'][0]['sire'] = $this->caninesModel->get_can_pedigrees($sire22)->result_array();
                    $data['canine'][0]['dam'][0]['dam'][0]['dam'] = $this->caninesModel->get_can_pedigrees($dam22)->result_array();
                }
            }

            if ($data['canine'][0]['ped_sire_id'] != '86' && $data['canine'][0]['ped_dam_id'] != '87') {
                // sibling male
                $whereMale['can_gender'] = 'Male';
                $whereMale['DATE_FORMAT(can_date_of_birth, "%d-%m-%Y") = '] = $data['canine'][0]['can_date_of_birth'];
                $whereMale['ped_canine_id !='] = $data['canine'][0]['can_id'];
                $whereMale['ped_sire_id'] = $data['canine'][0]['ped_sire_id'];
                $whereMale['ped_dam_id'] = $data['canine'][0]['ped_dam_id'];
                $data['sibling_male'] = $this->pedigreesModel->get_sibling($whereMale)->result();

                // sibling Female
                $whereFamale['can_gender'] = 'Female';
                $whereFamale['DATE_FORMAT(can_date_of_birth, "%d-%m-%Y") = '] = $data['canine'][0]['can_date_of_birth'];
                $whereFamale['ped_canine_id !='] = $data['canine'][0]['can_id'];
                $whereFamale['ped_sire_id'] = $data['canine'][0]['ped_sire_id'];
                $whereFamale['ped_dam_id'] = $data['canine'][0]['ped_dam_id'];
                $data['sibling_female'] = $this->pedigreesModel->get_sibling($whereFamale)->result();
            }
        }

        $this->load->view('backend/certificatePreviewBack', $data);
    }
}
