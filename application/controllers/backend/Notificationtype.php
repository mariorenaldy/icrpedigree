<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Notificationtype extends CI_Controller{
	private $navigations;
	public function __construct(){
		parent::__construct();
		$this->load->model(array('notificationtype_model'));
		$this->load->model('navigation');
		$this->navigations = $this->navigation->get_navigation();
		$session = self::_is_logged_in();
        if (!$session) 
			redirect('backend');
	}

	public function index(){
		$user = $this->session->userdata('user_data');
		$data['users'] = $user;
		if ($user['use_akses'] != 3) {
			$data['navigations'] = $this->navigations;
			$this->twig->display('backend/notificationtype', $data);
		}
		else
			redirect('backend/dashboard');
	}

	public function data($id = null){
		if ($id != null) {
            $notif = $this->notificationtype_model->get_by_id($id)->row();
            echo json_encode($notif);
        }else{
            $aColumns = array('notificationtype_id', 'title', 'description');
            $sTable = 'notificationtype';

            $iDisplayStart = $this->input->get_post('start', true);
            $iDisplayLength = $this->input->get_post('length', true);
            $sSearch = $this->input->post('search', true);
            $sEcho = $this->input->get_post('sEcho', true);
            $columns = $this->input->get_post('columns', true);
            $orders = $this->input->get_post('order', true);

            // Paging
            if(isset($iDisplayStart) && $iDisplayLength != '-1'){
                $this->db->limit($this->db->escape_str($iDisplayLength), $this->db->escape_str($iDisplayStart));
            }

            // Ordering
            if(isset($orders[0]['column'])){
                // for($i=0; $i<intval($columns); $i++){
                    // $iSortCol = $this->input->get_post('iSortCol_'.$i, true);
                    // $bSortable = $this->input->get_post('bSortable_'.intval($iSortCol), true);
                    $bSortable = $columns[$orders[0]['column']]['orderable'];
                    // $sSortDir = $this->input->get_post('sSortDir_'.$i, true);

                    if($bSortable == 'true')
                    {
                        $this->db->order_by($columns[$orders[0]['column']]['data'], $orders[0]['dir']);
                        // $this->db->order_by($aColumns[intval($this->db->escape_str($iSortCol))], $this->db->escape_str($sSortDir));
                    }
                // }
            }

            /*
             * Filtering
             * NOTE this does not match the built-in DataTables filtering which does it
             * word by word on any field. It's possible to do here, but concerned about efficiency
             * on very large tables, and MySQL's regex functionality is very limited
             */
            if(isset($sSearch['value']) && !empty($sSearch['value'])){
                for($i=0; $i<count($columns); $i++){
                    // $bSearchable = $this->input->get_post('bSearchable_'.$i, true);
                    $bSearchable = $columns[$i]['searchable'];

                    // Individual column filtering
                    if(isset($bSearchable) && $bSearchable == 'true')
                    {
                        for($j=0; $j<count($aColumns); $j++){
                          $this->db->or_like($aColumns[$j], $this->db->escape_like_str($sSearch['value']));
                        }
                    }
                }
            }


            // Select Data
            $this->db->select('SQL_CALC_FOUND_ROWS '.str_replace(' , ', ' ', implode(', ', $aColumns)), false);
            $this->db->order_by('notificationtype_id', 'DESC');
            $rResult = $this->db->get($sTable);

            // Data set length after filtering
            $this->db->select('FOUND_ROWS() AS found_rows');
            $iFilteredTotal = $this->db->get()->row()->found_rows;

            // Total data set length
            $iTotal = $this->db->count_all($sTable);

            // Output
            $output = array(
                'sEcho' => intval($sEcho),
                'iTotalRecords' => $iTotal,
                'iTotalDisplayRecords' => $iFilteredTotal,
                'aaData' => array()
            );

            foreach($rResult->result_array() as $i => $aRow){
                $row = array();

                // foreach($aColumns as $col){
                // 		if($col == 'stock')
                //     $row[$col] = $aRow[$col];
                // }
                $output['aaData'][] = $aRow;
            }

            echo json_encode($output);
        }
	}

	public function update($id = null){
	   	$result = $this->notificationtype_model->edit($id, $this->input->post('title'), $this->input->post('description')); 
		if ($result)
			echo json_encode(array('data' => '1'));
		else
			echo json_encode(array('data' => 'Data notifikasi gagal disimpan'));
	}

	private function _is_logged_in(){
		$coordinator = $this->session->userdata('user_data');
		return isset($coordinator);
	}
}
