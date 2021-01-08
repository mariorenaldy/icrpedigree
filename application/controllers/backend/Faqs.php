<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Faqs extends CI_Controller {
		private $navigations;
		public function __construct(){
				// Call the CI_Controller constructor
				parent::__construct();
      	$this->load->model('testimonialModel');
				$this->load->model('navigation');
				$this->navigations = $this->navigation->get_navigation();
				$session = self::_is_logged_in();
        if(!$session) redirect('backend');
		}
		public function index(){
				$user = $this->session->userdata('user_data');
				$data['users'] = $user;
				if ($user['use_akses'] != 3) {
					$data['navigations'] = $this->navigations;
					$this->twig->display('backend/faqs', $data);
        }else {
          redirect('backend/dashboard');
        }

		}

    public function data($id = null){
        if ($id != null) {
            $where['tes_id'] = $id;
            $teste = $this->testeModel->get_testimonials($where)->row();
            echo json_encode($teste);
        }else{
            $aColumns = array('tes_id', 'tes_email', 'tes_content','tes_type', 'tes_created_at', 'tes_updated_at');
            $sTable = 'testimonials';

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
            $this->db->order_by('tes_id', 'DESC');
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

    public function remove(){
				$teste_id = $this->input->post('faqsId', true);
				foreach ($teste_id as $id) {
						$where['tes_id'] = $id;
						$this->testimonialModel->remove_testimonials($where);
				}
				echo json_encode(array('data' => '1'));
		}


    //  PHP Helper
        public function gen_pass(){
          $rand = substr(uniqid('', true), -5);
          return $rand;
        }

        private function _is_logged_in(){
            $coordinator = $this->session->userdata('user_data');
            return isset($coordinator);
        }

        private function _is_write_log($action, $description, $user){
            $data['log_action'] = $action;
            $data['log_description'] = json_encode($description);
            $data['log_user'] = $user;
            if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
                $ip = $_SERVER['HTTP_CLIENT_IP'];
            } elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
                $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
            } else {
                $ip = $_SERVER['REMOTE_ADDR'];
            }
            $data['log_ip'] = $ip;
            $data['log_browser'] = $_SERVER['HTTP_USER_AGENT'];

            $this->load->model('logModel');
            $this->logModel->add_log($data);
        }
}
