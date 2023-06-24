<?php
defined('BASEPATH') or exit('No direct script access allowed');

#[\AllowDynamicProperties]

class Certificate extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model(array('caninesModel'));
        $this->load->library(array('session', 'form_validation'));
        $this->load->helper(array('url', 'cookie'));
        $this->load->database();

        if ($this->input->cookie('site_lang')) {
            $this->lang->load('common', $this->input->cookie('site_lang'));
        } else {
            set_cookie('site_lang', 'indonesia', '2147483647');
            $this->lang->load('common', 'indonesia');
        }
    }

    public function index()
    {
        if ($this->uri->segment(4)) {
            $site_lang = $this->input->cookie('site_lang');
            $can_id = $this->uri->segment(4);
            $max_level = 1;
            if($this->input->post('level') != null){
                $max_level = $this->input->post('level');
            }
            $pedigree = $this->get_can_pedigree($can_id, 0, $max_level);
            
            if ($pedigree) {
                $data['array'] = $this->create_array($pedigree);
                $this->load->view('frontend/tree', $data);
            } else {
                if ($site_lang == 'indonesia') {
                    $this->session->set_flashdata('error', 'Silsilah anjing tidak ditemukan');
                } else {
                    $this->session->set_flashdata('error', "Dog's pedigree not found");
                }
                redirect('frontend/Canines');
            }
        } else {
            redirect('frontend/Canines');
        }
    }
    public function get_can_pedigree($can_id, $level = 0, $max_level = 3)
    {
        // ambil data anjing pada level saat ini
        $where['can_id'] = $can_id;
        $data['canine'] = $this->caninesModel->get_exist_pedigrees($where)->row();

        // jika data anjing adalah data dummy kosong (NO FEMALE atau NO MALE), return array kosong
        if($can_id == $this->config->item('dam_id') || $can_id == $this->config->item('sire_id')){
            return [];
        }

        // jika data anjing tidak ditemukan atau max level sudah tercapai, return array kosong
        if (!$data['canine'] || $level > $max_level) {
            return [];
        }

        // ambil data ayah anjing dengan memanggil fungsi ini secara rekursif
        $sire['can_id'] = $data['canine']->ped_sire_id;
        $data['sire'] = $this->get_can_pedigree($sire['can_id'], $level + 1, $max_level);

        // ambil data ibu anjing dengan memanggil fungsi ini secara rekursif
        $dam['can_id'] = $data['canine']->ped_dam_id;
        $data['dam'] = $this->get_can_pedigree($dam['can_id'], $level + 1, $max_level);

        // simpan data level saat ini
        $data['level'] = $level;

        // return data untuk level saat ini
        return $data;
    }
    function create_array($pedigree)
    {
        $stack = [];
        $arr = 'nodes: [';

        $data = $pedigree;
        $arr .= $this->printers($stack, $data);

        $arr .= ']';
        return $arr;
    }
    function printers($stack, $data)
    {
        if (empty($data)) {
            return '';
        }

        global $idx;
        $idx++;
        array_push($stack, $idx);
        end($stack);
        $pid = prev($stack);
        $status = 'Sire';
        if($data['canine']->can_gender == 'FEMALE'){
            $status = 'Dam';
        }

        $arr = '';
        if ($idx == 1) {
            $arr .= '{ id: 1, name: "' . $data['canine']->can_a_s . '", status: "' . '' .'", img: "' . base_url('uploads/canine/' . $data['canine']->can_photo) . '" },';
        } else if ($data['canine']->can_a_s != 'NO MALE' && $data['canine']->can_a_s != 'NO FEMALE'){
            $arr .= '{ id: ' . $idx . ', pid: ' . $pid . ', name: "' . $data['canine']->can_a_s . '", status: "' . $status . '", img: "' . base_url('uploads/canine/' . $data['canine']->can_photo) . '" },';
        }

        if (!empty($data['sire']) || !empty($data['dam'])) {

            if (!empty($data['sire'])) {
                $arr .= $this->printers($stack, $data['sire']);
            }

            if (!empty($data['dam'])) {
                $arr .= $this->printers($stack, $data['dam']);
            }
        }

        return $arr;
    }
}
