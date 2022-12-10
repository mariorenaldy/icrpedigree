<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Canines extends CI_Controller {
    public function __construct(){
        // Call the CI_Controller constructor
        parent::__construct();
        $this->load->model(array('caninesModel','memberModel', 'logcanineModel', 'requestModel', 'notification_model', 'notificationtype_model'));
        $this->load->library('upload', $this->config->item('upload_canine'));
    }

    public function index(){

    }

    public function view_approve(){
        $data['canine'] = $this->requestModel->get_requests()->result();
        $this->load->view('backend/approve_canines', $data);
    } 

    public function search(){
			$q = $_GET['q'];
			$canines = $this->caninesModel->get_search($q)->result();
			echo json_encode($canines);
		}

    public function sire(){
        if (isset($_GET['q'])) {
          $q = $_GET['q'];
          $canines = $this->caninesModel->sire_search($q)->result();
        }else {
          $canines = $this->caninesModel->sire_search()->result();
        }
        echo json_encode($canines);
		}

    public function dam(){
        if (isset($_GET['q'])) {
          $q = $_GET['q'];
          $canines = $this->caninesModel->dam_search($q)->result();
        }else {
          $canines = $this->caninesModel->dam_search()->result();
        }
        echo json_encode($canines);
		}

    public function breeder(){
					$q = $_GET['q'];
					$canines = $this->caninesModel->breeder_search($q)->result();
					echo json_encode($canines);
		}

    public function kennel(){
					$q = $_GET['q'];
					$canines = $this->caninesModel->kennel_search($q)->result();
					echo json_encode($canines);
		}

    public function address(){
          $q = $_GET['q'];
          $canines = $this->caninesModel->address_search($q)->result();
          echo json_encode($canines);
    }

    public function owner(){
          $q = $_GET['q'];
          $canines = $this->caninesModel->owner_search($q)->result();
          echo json_encode($canines);
    }

    // ARTechnology
    public function member(){
      if (isset($_GET['q'])) {
        $q = $_GET['q'];
        $member = $this->memberModel->member_search($q)->result();
      }else {
        $member = $this->memberModel->member_search()->result();
      }
      echo json_encode($member);
    }

    public function owner_name(){
      if (isset($_GET['q'])) {
        $q = $_GET['q'];
        $canines = $this->caninesModel->owner_name_search($q)->result();
      } else{
        $canines = $this->caninesModel->owner_name_search()->result();
      }
      echo json_encode($canines);
    }
    // ARTechnology

    public function add(){
        $sire = $this->input->post('can_sire');
        $dam = $this->input->post('can_dam');

        // $where['can_id'] = $id;
        // $canines = $this->caninesModel->get_parent($where)->row();

        $img = $this->input->post('srcDataCrop');
        $title = self::_clean_text('canines');

        $_POST['can_photo'] = '';
        if($img){
          $_POST['can_photo'] = self::_upload_base64($img, $title);
        } else{
          $_POST['can_photo'] = '-';
        }
        unset($_POST['srcDataCrop']);
        unset($_POST['can_sire']);
        unset($_POST['can_dam']);
        unset($_POST['sire']);
        unset($_POST['dam']);

        // $_POST['can_owner'] = $_POST['can_owner_name'];
        $_POST['can_reg_date'] = date("Y/m/d");
        // $_POST['can_icr_number'] = '-';

        // ARTechnology
        $cek = true;
        $piece = explode("-", $this->input->post('can_date_of_birth'));
        $dob = $piece[2]."-".$piece[1]."-".$piece[0];

        if ($sire != null && $dam !=null && $sire != 86 && $dam != 87) {
          $sire_dob = $this->caninesModel->get_dob_by_id($sire)[0]->can_date_of_birth;
          $dam_dob = $this->caninesModel->get_dob_by_id($dam)[0]->can_date_of_birth;

          $tssire = strtotime($sire_dob);
          $tsdam = strtotime($dam_dob);
          $ts = strtotime($dob);

          $yearsire = date('Y', $tssire);
          $yeardam = date('Y', $tsdam);
          $year = date('Y', $ts);

          $monthsire = date('m', $tssire);
          $monthdam = date('m', $tsdam);
          $month = date('m', $ts);

          $diffsire = (($year - $yearsire) * 12) + ($month - $monthsire);
          $diffdam = (($year - $yeardam) * 12) + ($month - $monthdam);

          if (abs($diffsire) < 14 || abs($diffdam) < 14){
            $cek = false;
          }
        }
      
        if ($cek){
          $cek2 = true;
          if ($sire != null && $dam !=null && $sire != 86 && $dam != 87){
            $res = $this->caninesModel->get_date_compare_sibling($dam, $dob);
            if ($res){
              foreach($res as $row){
                if ($row->diff != 0 && abs($row->diff) < 100){
                  $cek2 = false;
                }
              }
            }
          }

          if ($cek2){
        // ARTechnology

            $data = $this->input->post(null,false);

            // ARTechnology
            $data['can_date_of_birth'] = $dob;

            $cek3 = true;
            if ($this->input->post('can_icr_number') != '-'){
              $res = $this->caninesModel->check_icr_number('', $this->input->post('can_icr_number'));
              if ($res){
                $cek3 = false;
              }
            }

            if ($cek3){
              $cek4 = true;
              if ($this->input->post('can_icr_moc_number') != '-'){
                $res = $this->caninesModel->check_microchip_number('', $this->input->post('can_icr_moc_number'));
                if ($res){
                  $cek4 = false;
                }
              }

              if ($cek4){
                if (!empty($this->input->post('can_member'))){
                  $whereMember['mem_id'] = $this->input->post('can_member');
                  $member = $this->memberModel->get_members($whereMember)->result();
                  if ($member){
                    if ($member[0]->ken_type_id == 1)
                      $data['can_a_s'] = $this->input->post('can_a_s')." VON ".$member[0]->ken_name;
                    else if ($member[0]->ken_type_id == 2)
                      $data['can_a_s'] = $member[0]->ken_name."` ".$this->input->post('can_a_s');
                  }
                }

                $cek5 = true;
                $res = $this->caninesModel->check_can_a_s('', $data['can_a_s']);
                if ($res){
                  $cek5 = false;
                }

                if ($cek5){
                  $user = $this->session->userdata('user_data');
                  $data['can_app_stat'] = 1;
                  $data['can_app_user'] = $user['use_id'];
                  $data['can_app_date'] = date("Y/m/d");
                  $this->db->trans_strict(FALSE);
                  $this->db->trans_start();
                  // ARTechnology
                  $canines = $this->caninesModel->add_canines($data);
                  // ARTechnology

                  if ($sire != null && $dam != null) {
                    $pedigree = array('ped_canine_id' => $canines,
                                      'ped_sire_id' => $sire,
                                      'ped_mom_id' => $dam );  
                  }
                  else if ($sire != null){
                    $pedigree = array('ped_canine_id' => $canines,
                                      'ped_sire_id' => $sire,
                                      'ped_mom_id' => 87 );
                  }
                  else if ($dam != null){
                    $pedigree = array('ped_canine_id' => $canines,
                                      'ped_sire_id' => 86,
                                      'ped_mom_id' => $dam );
                  }
                  else {
                    $pedigree = array('ped_canine_id' => $canines,
                                      'ped_sire_id' => 86,
                                      'ped_mom_id' => 87 );
                  }

                  $pedigree = $this->pedigreesModel->add_pedigrees($pedigree);
                  // ARTechnology

                  $this->db->trans_complete();
                  echo json_encode(array('data' => '1'));
                }
                else
                  echo json_encode(array('data' => 'Nama canine tidak boleh sama'));
              }
              else{
                echo json_encode(array('data' => 'No. microchip tidak boleh sama'));
              }
            }
            else{
              echo json_encode(array('data' => 'No. ICR tidak boleh sama'));
            }
          // ARTechnology
          }
          else{
            echo json_encode(array('data' => 'Dam belum 100 hari'));
          }
        }
        else{
          echo json_encode(array('data' => 'Sire & Dam harus 14 bulan'));
        }
        // ARTechnology
    }

    public function update($id = null){
        // $data = $this->input->post(null, false);
        $sire = $this->input->post('can_sire');
        $dam = $this->input->post('can_dam');

				$img = $this->input->post('srcDataCrop');
        // print_r($data);
				if($img){
						$title = self::_clean_text('canine');
						$_POST['can_photo'] = self::_upload_base64($img, $title, true, $id);
				}

        unset($_POST['can_sire']);
        unset($_POST['can_dam']);
        unset($_POST['sire']);
        unset($_POST['dam']);
				unset($_POST['srcDataCrop']);
				$data = $this->input->post(null, false);
				$where['can_id'] = $id;

        // ARTechnology
        $cek = true;
        $piece = explode("-", $this->input->post('can_date_of_birth'));
        $dob = $piece[2]."-".$piece[1]."-".$piece[0];
        if ($sire != null && $dam !=null && $sire != 86 && $dam != 87) {
          $sire_dob = $this->caninesModel->get_dob_by_id($sire)[0]->can_date_of_birth;
          $dam_dob = $this->caninesModel->get_dob_by_id($dam)[0]->can_date_of_birth;

          $tssire = strtotime($sire_dob);
          $tsdam = strtotime($dam_dob);
          $ts = strtotime($dob);

          $yearsire = date('Y', $tssire);
          $yeardam = date('Y', $tsdam);
          $year = date('Y', $ts);

          $monthsire = date('m', $tssire);
          $monthdam = date('m', $tsdam);
          $month = date('m', $ts);

          $diffsire = (($year - $yearsire) * 12) + ($month - $monthsire);
          $diffdam = (($year - $yeardam) * 12) + ($month - $monthdam);

          if (abs($diffsire) < 14 || abs($diffdam) < 14){
            $cek = false;
          }
        }
      
        if ($cek){
          $cek2 = true;
          if ($sire != null && $dam !=null && $sire != 86 && $dam != 87) {
            $res = $this->caninesModel->get_date_compare_sibling_by_id($dam, $dob, $id);
            if ($res){
              foreach($res as $row){
                if ($row->diff != 0 && abs($row->diff) < 100){
                  $cek2 = false;
                }
              }
            }
          }

          if ($cek2){
            $data['can_date_of_birth'] = $dob;

            $cek3 = true;
            if ($this->input->post('can_icr_number') != '-'){
              $res = $this->caninesModel->check_icr_number($id, $this->input->post('can_icr_number'));
              if ($res){
                $cek3 = false;
              }
            }

            if ($cek3){
              $cek4 = true;
              if ($this->input->post('can_icr_moc_number') != '-'){
                $res = $this->caninesModel->check_microchip_number($id, $this->input->post('can_icr_moc_number'));
                if ($res){
                  $cek4 = false;
                }
              }

              if ($cek4){
                $canine = $this->caninesModel->get_canines($where)->row();
                
                $cek5 = true;
                $res = $this->caninesModel->check_can_a_s($id, $this->input->post('can_a_s'));
                if ($res){
                  $cek5 = false;
                }

                if ($cek5){
                  $owner = ''; 
                  if ($canine->can_owner != $this->input->post('can_owner')){
                    $owner = $canine->can_owner." => ".$this->input->post('can_owner');
                  }

                  $address = '';
                  if ($canine->can_address != $this->input->post('can_address')){
                    $address = $canine->can_address." => ".$this->input->post('can_address');
                  }

                  $cage = '';
                  if ($canine->can_cage != $this->input->post('can_cage')){
                    $cage = $canine->can_cage." => ".$this->input->post('can_cage');
                  }

                  $member = '';
                  if ($canine->can_member != $this->input->post('can_member')){
                    $where_log['mem_id'] = $canine->can_member;
                    $old_mem = $this->memberModel->get_members($where_log)->row();
              
                    $where_log['mem_id'] = $this->input->post('can_member');
                    $new_mem = $this->memberModel->get_members($where_log)->row(); 

                    $member = $old_mem->mem_name." => ".$new_mem->mem_name;
                  }

                  // write log 
                  $this->db->trans_strict(FALSE);
                  $this->db->trans_start();
                  if ($owner != '' || $address != '' || $cage != '' || $member != ''){
                    $log = array(
                      'log_id' => $id,
                      'log_owner' => $owner,
                      'log_address' => $address,
                      'log_cage' => $cage,
                      'log_member' => $member,
                      'log_old_photo' => '-',
                      'log_photo' => '-',
                      'log_stat' => 0,
                      'log_req' => 0
                    );
                    $res = $this->logcanineModel->add_log($log);

                    /*
                    if ($sire != null && $dam !=null) {
                      $wherePed['ped_canine_id'] = $id;
                      $pedigree = array('ped_sire_id' => $sire,
                                        'ped_mom_id' => $dam );

                      $pedigree = $this->pedigreesModel->update_pedigrees($pedigree, $wherePed);
                    }else if ($sire != null ) {
                      $wherePed['ped_canine_id'] = $id;
                      $pedigree = array('ped_sire_id' => $sire );

                      $pedigree = $this->pedigreesModel->update_pedigrees($pedigree, $wherePed);
                    }else if ($dam !=null) {
                      $wherePed['ped_canine_id'] = $id;
                      $pedigree = array('ped_mom_id' => $dam );
                      $pedigree = $this->pedigreesModel->update_pedigrees($pedigree, $wherePed);
                    }
                    */
                    // $data['pro_id'] = $id;
                    // self::_is_write_log('update', $data, 'aris');

                    if ($res){
                      $this->caninesModel->update_canines($data, $where);
                      $this->db->trans_complete();
                      echo json_encode(array('data' => '1'));
                    }
                    else{
                      $this->db->trans_rollback();
                      echo json_encode(array('data' => 'Gagal menulis ke log'));
                    }
                  }
                  else{ 
                      $this->caninesModel->update_canines($data, $where);
                      $this->db->trans_complete();
                      echo json_encode(array('data' => '1'));
                  }
                }
                else
                  echo json_encode(array('data' => 'Nama canine tidak boleh sama'));
              }
              else{
                echo json_encode(array('data' => 'No. microchip tidak boleh sama'));
              }
            }
            else{
              echo json_encode(array('data' => 'No. ICR tidak boleh sama'));
            }
        }
        else{
          echo json_encode(array('data' => 'Dam belum 100 hari'));
        }
      }
      else{
        echo json_encode(array('data' => 'Sire & Dam harus 14 bulan'));
      }
      // ARTechnology
		}

    public function update2($id = null){
        // $data = $this->input->post(null, false);
        $sire = $this->input->post('can_sire');
        $dam = $this->input->post('can_dam');
        unset($_POST['can_sire']);
        unset($_POST['can_dam']);
        unset($_POST['sire']);
        unset($_POST['dam']);
        //
				// $data = $this->input->post(null, false);
				// $where['can_id'] = $id;
				// $this->caninesModel->update_canines($data, $where);

        // ARTechnology
        $where['can_id'] = $id;
        $canine = $this->caninesModel->get_canines($where)->row();
        $dob = $canine->can_date_of_birth;
        
        $cek = true;
        if ($sire != null && $dam !=null && $sire != 86 && $dam != 87) {
          $sire_dob = $this->caninesModel->get_dob_by_id($sire)[0]->can_date_of_birth;
          $dam_dob = $this->caninesModel->get_dob_by_id($dam)[0]->can_date_of_birth;

          $tssire = strtotime($sire_dob);
          $tsdam = strtotime($dam_dob);
          $ts = strtotime($dob);

          $yearsire = date('Y', $tssire);
          $yeardam = date('Y', $tsdam);
          $year = date('Y', $ts);

          $monthsire = date('m', $tssire);
          $monthdam = date('m', $tsdam);
          $month = date('m', $ts);

          $diffsire = (($year - $yearsire) * 12) + ($month - $monthsire);
          $diffdam = (($year - $yeardam) * 12) + ($month - $monthdam);

          if (abs($diffsire) < 14 || abs($diffdam) < 14){
            $cek = false;
          }
        }
      
        if ($cek){
          $cek2 = true;
          if ($sire != null && $dam !=null && $sire != 86 && $dam != 87) {
            $res = $this->caninesModel->get_date_compare_sibling_by_id($dam, $dob, $id);
            if ($res){
              foreach($res as $row){
                if ($row->diff != 0 && abs($row->diff) < 100){
                  $cek2 = false;
                }
              }
            }
          }

          if ($cek2){
        // ARTechnology

            if ($sire != null && $dam != null) {
              $wherePed['ped_canine_id'] = $id;
              $pedigree = array('ped_sire_id' => $sire,
                                'ped_mom_id' => $dam );

              $pedigree = $this->pedigreesModel->update_pedigrees($pedigree, $wherePed);
            }
            // ARTechnology
            else if ($sire != null) {
              $wherePed['ped_canine_id'] = $id;
              $pedigree = array('ped_sire_id' => $sire );

              $pedigree = $this->pedigreesModel->update_pedigrees($pedigree, $wherePed);
            }
            else if ($dam != null) {
              $wherePed['ped_canine_id'] = $id;
              $pedigree = array('ped_mom_id' => $dam );

              $pedigree = $this->pedigreesModel->update_pedigrees($pedigree, $wherePed);
            }
            // ARTechnology 

            // $data['pro_id'] = $id;
            // self::_is_write_log('update', $data, 'aris');
            echo json_encode(array('data' => '1'));
      // ARTechnology
        }
        else{
          echo json_encode(array('data' => 'Dam belum 100 hari'));
        }
      }
      else{
        echo json_encode(array('data' => 'Sire & Dam harus 14 bulan'));
      }
      // ARTechnology
    }
    
    // ARTechnology
    public function payment($id = null){
      $data = $this->input->post(null, false);
      $where['can_id'] = $id;
      $this->caninesModel->update_canines($data, $where);
      echo json_encode(array('data' => '1'));
    }

    public function memberId($id = null)
    {
      $where['mem_id'] = $id;
      $member = $this->memberModel->get_members($where)->row();
      echo json_encode($member);
    }
    // ARTechnology

    public function parentId($id = null)
    {
      $where['can_id'] = $id;
      $canines = $this->caninesModel->get_parent($where)->row();
      echo json_encode($canines);
    }
    public function data($id = null){
        if ($id != null) {
            $where['can_id'] = $id;
            $canines = $this->caninesModel->get_can_pedigrees($where)->row();
            // $canines = $this->caninesModel->get_canines($where)->row();
            echo json_encode($canines);
        }else{
            // ARTechnology
            $aColumns = array('can_id', 'can_current_reg_number', 'can_icr_moc_number', 'can_icr_number','can_a_s', 'can_owner','can_gender', 'can_score' , 'can_photo', 'can_remaining_payment', 'can_created_at', 'can_updated_at', 'can_stat', 'can_note', 'can_address', 'can_member', 'mem_name', 'can_print', 'ken_type_id', 'ken_name', 'can_app_stat', 'use_username', 'can_app_date');
            // ARTechnology
            $sTable = 'canines';

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
                // ARTechnology
                for($i=0; $i<count($columns); $i++){
                // ARTechnology

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
            $this->db->join('members','members.mem_id = canines.can_member');
            $this->db->join('kennels','kennels.ken_id = members.mem_ken_id');
            $this->db->join('users','users.use_id = canines.can_app_user');
            $this->db->where('can_app_stat', 1);
            $this->db->order_by('can_id', 'desc');
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
        $canine_id = $this->input->post('canineId', true);
        $err = 0;
  			foreach ($canine_id as $id) {
            $where['can_id'] = $id;
            $canine = $this->caninesModel->get_canines($where)->row();
  					$curr_image = $this->path_upload.basename($canine->can_photo);
  					if(file_exists($curr_image)){
  							unlink($curr_image);
  					}
            // $where['can_id'] = $id;
            
            // ARTechnology
            if ($canine->can_gender == "Male"){
              $res = $this->pedigreesModel->unlink_parent($id, 86);
            }
            else{
              $res = $this->pedigreesModel->unlink_parent($id, 87);
            }

            if ($res){
            // ARTechnology
              $this->caninesModel->remove_canines($where);
            // ARTechnology
            }
            else{
              $err = $id;
              break;
            }
            // ARTechnology
        }
        // ARTechnology
        if (!$err){
        // ARTechnology
          echo json_encode(array('data' => '1'));
        // ARTechnology
        }
        else{
          echo json_encode(array('data' => 'Canine dengan id = '.$err.' tidak dapat dihapus'));
        }
        // ARTechnology
  	}


//  PHP Helper
    private function _upload_base64($image = null, $name = null, $update = false, $id = null){
        $name_image = $name.'_'.time();
        $name_image = strtolower($name_image);
        $image = str_replace('data:image/png;base64,', '', $image);
        // $image = str_replace('data:image/png;base64,', '', $image);
        $image = str_replace(' ', '+', $image);
        $data = base64_decode($image);
        // $file = $this->path_upload.$name_image . '.jpg';
        $file = $this->path_upload.$name_image . '.png';
        $success = file_put_contents($file, $data);

        $url_image = $name_image.'.png';

        if($update && $id != null){
            $where['can_id'] = $id;
            $canines = $this->caninesModel->get_canines($where)->row();
            $curr_image = $this->path_upload.basename($canines->can_photo);
            if(file_exists($curr_image)){
                unlink($curr_image);
            }
        }
        return $url_image;
    }

    private function _clean_text($name = null){
      return str_replace(array(' ', '-'), '_', $name);
    }

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

    // ARTechnology
    public function getFamily($id = null){
      $user = $this->session->userdata('user_data');
			$data['users'] = $user;
      $data['navigations'] = $this->navigations;
      
      if ($this->caninesModel->is_sire($id)){ 
        $data['canines'] = $this->caninesModel->get_dam_sibling($id); 
      }
      else{
        $data['canines'] = $this->caninesModel->get_sire_sibling($id); 
      }
      $this->twig->display('backend/family', $data);
    }

    public function activate(){
        $canine_id = $this->input->post('canineId', true);
        $err = 0;
        foreach ($canine_id as $id) {
            $res = $this->caninesModel->set_active($id, 1);
            if (!$res){
              $err = $id;
              break;
            }
        }
        if (!$err){
          echo json_encode(array('data' => '1'));
        }
        else{
          echo json_encode(array('data' => 'Canine dengan id = '.$err.' tidak dapat diaktivasi'));
        }
    }

    public function deactivate(){
      $canine_id = $this->input->post('canineId', true);
      $err = 0;
      foreach ($canine_id as $id) {
          $res = $this->caninesModel->set_active($id, 0);
          if (!$res){
            $err = $id;
            break;
          }
      }
      if (!$err){
        echo json_encode(array('data' => '1'));
      }
      else{
        echo json_encode(array('data' => 'Canine dengan id = '.$err.' tidak dapat dideaktivasi'));
      }
    }

    public function logs($id = null){
      $user = $this->session->userdata('user_data');
			$data['users'] = $user;
      $data['navigations'] = $this->navigations;
      
      $where['can_id'] = $id;
      $data['canines'] = $this->caninesModel->get_canines($where)->row();
      unset($where);
      
      $where['log_id'] = $id;
      $data['logs'] = $this->logcanineModel->get_logs($where)->result(); 
      $this->twig->display('backend/logsCanines', $data);
    }

    public function request(){
      $user = $this->session->userdata('user_data');
			$data['users'] = $user;
      $data['navigations'] = $this->navigations;

      $this->twig->display('backend/requests', $data);
    }

    public function request_data(){
      $aColumns = array('req_id', 'can_id', 'req_can_id', 'can_a_s', 'req_can_photo', 'can_cage', 'req_can_cage', 'can_address', 'req_can_address', 'can_owner', 'req_can_owner', 'use_username', 'req_app_date', 'req_date', 'stat_name', 'kennels.ken_name', 'kennels.ken_type_id');
      $sTable = 'requests';

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
          // ARTechnology
          for($i=0; $i<count($columns); $i++){
          // ARTechnology

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
      $this->db->join('canines','canines.can_id = requests.req_can_id');
      $this->db->join('users','users.use_id = requests.req_app_user');
      $this->db->join('approval_status','approval_status.stat_id = requests.req_stat');
      $this->db->join('members','members.mem_id = canines.can_member');
      $this->db->join('kennels','kennels.ken_id = members.mem_ken_id');
      $this->db->where('req_stat', 0);
      $this->db->order_by('req_date', 'desc');
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

    public function approve($id){
        if ($id){
            $whe['req_id'] = $id;
            $req = $this->requestModel->get_requests($whe)->row();

            $where['can_id'] = $req->req_can_id;
            $can = $this->caninesModel->get_can_pedigrees($where)->row();

            $old = '-';
            $photo = '-';
            if ($req->req_can_photo != '-'){
                $photo = $req->req_can_photo;
                $data['can_photo'] = $req->req_can_photo;
                $curr_image = $this->path_upload.basename($can->can_photo);
                if (file_exists($curr_image)){
                    $old = $can->can_photo;
                    unlink($curr_image);
                }
            }

          $cage = '';
          if ($req->req_can_cage){
            $data['can_cage'] = $req->req_can_cage;
            $cage = $can->can_owner." => ".$req->req_can_cage;
          }

          $address = '';
          if ($req->req_can_address){
            $data['can_address'] = $req->req_can_address;
            $address = $can->can_address." => ".$req->req_can_address;
          }

          $owner = '';
          if ($req->req_can_owner){
            $data['can_owner'] = $req->req_can_owner;
            $owner = $can->can_owner." => ".$req->req_can_owner;
          }

          $this->db->trans_strict(FALSE);
          $this->db->trans_start();
          // write log 
          if ($photo != '-' || $owner != '' || $address != '' || $cage != ''){
            $log = array(
              'log_id' => $req->req_can_id,
              'log_owner' => $owner,
              'log_address' => $address,
              'log_cage' => $cage,
              'log_member' => '',
              'log_old_photo' => $old,
              'log_photo' => $photo,
              'log_stat' => 1,
              'log_req' => $req->req_id
            );
            $res = $this->logcanineModel->add_log($log);
            if ($res){
              $this->caninesModel->update_canines($data, $where);
              $res2 = $this->requestModel->update_status($id, 1);
              if ($res2){
                if ($can->mem_id){
                  $res3 = $this->notification_model->add(3, $req->req_can_id, $can->mem_id);

                  $whe_can['mem_id'] = $can->mem_id;
                  $member = $this->memberModel->get_members($whe_can)->row();
                  if ($member->mem_firebase_token){
                    $notif = $this->notificationtype_model->get_by_id(3);
                    $url = 'https://fcm.googleapis.com/fcm/send';
                    $key = 'AAAALe2LeZU:APA91bEqr2n1PRxkOyOfx8IwYO1O_1gjprFkq1AITOGUu3GYp2ZBi-8-AvM4ADI3m94NEv4cq-uKcMBU3pJXBhO21CyuVgPNX2l7VYXj5IllxEr6sika8eaJp1IgXCHALA5_xYw92pXK';
        
                    $fields = array (
                      'to' => $member->mem_firebase_token,
                      'notification' => array(
                        "channelId" => "ICRPedigree",
                        'title' => $notif[0]->title,
                        'body' => $notif[0]->description
                      )
                    );
                    $fields = json_encode ( $fields );
        
                    $headers = array (
                        'Authorization: key=' . $key,
                        'Content-Type: application/json'
                    );
        
                    $ch = curl_init ();
                    curl_setopt ( $ch, CURLOPT_URL, $url );
                    curl_setopt ( $ch, CURLOPT_POST, true );
                    curl_setopt ( $ch, CURLOPT_HTTPHEADER, $headers );
                    curl_setopt ( $ch, CURLOPT_RETURNTRANSFER, true );
                    curl_setopt ( $ch, CURLOPT_POSTFIELDS, $fields );
        
                    $result = curl_exec ( $ch );
                    // echo $result;
                    curl_close ( $ch );
                  }
                }
                $this->db->trans_complete();
                echo json_encode(array('data' => '1'));
              }
              else{
                $this->db->trans_rollback();
                echo json_encode(array('data' => 'Request dengan id = '.$id.' tidak dapat di-approve'));
              }
            }
            else{
              $this->db->trans_rollback();
              echo json_encode(array('data' => 'Gagal menulis ke log'));
            }
          }
          else{
            $this->caninesModel->update_canines($data, $where);

            $res2 = $this->requestModel->update_status($id, 1);
            if ($res2){
              $this->db->trans_complete();
              echo json_encode(array('data' => '1'));
            }
            else{
              $this->db->trans_rollback();
              echo json_encode(array('data' => 'Request dengan id = '.$id.' tidak dapat di-approve'));
            }
          }
        }
    }

    public function reject($id = null){
      if ($id){
        $this->db->trans_strict(FALSE);
        $this->db->trans_start();
        $res = $this->requestModel->update_status($id, 2);
        if ($res){
          $whe['req_id'] = $id;
          $req = $this->requestModel->get_requests($whe)->row();

          $where['can_id'] = $req->req_can_id;
          $can = $this->caninesModel->get_can_pedigrees($where)->row();
          
          if ($can->mem_id){
            $result = $this->notification_model->add(8, $id, $can->mem_id);

            $whe_can['mem_id'] = $can->mem_id;
            $member = $this->memberModel->get_members($whe_can)->row();
            if ($member->mem_firebase_token){
              $notif = $this->notificationtype_model->get_by_id(8);
              $url = 'https://fcm.googleapis.com/fcm/send';
              $key = 'AAAALe2LeZU:APA91bEqr2n1PRxkOyOfx8IwYO1O_1gjprFkq1AITOGUu3GYp2ZBi-8-AvM4ADI3m94NEv4cq-uKcMBU3pJXBhO21CyuVgPNX2l7VYXj5IllxEr6sika8eaJp1IgXCHALA5_xYw92pXK';
  
              $fields = array (
                'to' => $member->mem_firebase_token,
                'notification' => array(
                  "channelId" => "ICRPedigree",
                  'title' => $notif[0]->title,
                  'body' => $notif[0]->description
                )
              );
              $fields = json_encode ( $fields );
  
              $headers = array (
                  'Authorization: key=' . $key,
                  'Content-Type: application/json'
              );
  
              $ch = curl_init ();
              curl_setopt ( $ch, CURLOPT_URL, $url );
              curl_setopt ( $ch, CURLOPT_POST, true );
              curl_setopt ( $ch, CURLOPT_HTTPHEADER, $headers );
              curl_setopt ( $ch, CURLOPT_RETURNTRANSFER, true );
              curl_setopt ( $ch, CURLOPT_POSTFIELDS, $fields );
  
              $result = curl_exec ( $ch );
              // echo $result;
              curl_close ( $ch );
            }
          }
          $this->db->trans_complete();
          echo json_encode(array('data' => '1'));
        }
        else{
          $this->db->trans_rollback();
          echo json_encode(array('data' => 'Request dengan id = '.$id.' tidak dapat di-reject'));
        }
      }
    }

    public function logs_request(){
      $user = $this->session->userdata('user_data');
			$data['users'] = $user;
      $data['navigations'] = $this->navigations;
      
      $this->twig->display('backend/logsRequest', $data);
    }

    public function data_logs_request(){
      $aColumns = array('log_owner', 'log_address', 'log_cage', 'log_tanggal', 'log_old_photo', 'log_photo', 'req_app_date', 'can_a_s', 'stat_name', 'use_username', 'kennels.ken_name', 'kennels.ken_type_id');
      $sTable = 'logs_canine';

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
          // ARTechnology
          for($i=0; $i<count($columns); $i++){
          // ARTechnology

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
      $this->db->join('canines','canines.can_id = logs_canine.log_id');
      $this->db->join('requests','requests.req_id = logs_canine.log_req');
      $this->db->join('users','users.use_id = requests.req_app_user');
      $this->db->join('approval_status','approval_status.stat_id = requests.req_stat');
      $this->db->join('members','members.mem_id = canines.can_member');
      $this->db->join('kennels','kennels.ken_id = members.mem_ken_id');
      $this->db->where('log_stat', 1);
      $this->db->where('req_stat <> ', 0);
      $this->db->order_by('log_tanggal', 'desc');
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

    public function approve_index(){
      $session = self::_is_logged_in();
      if(!$session) {
      		redirect('backend');
      }else {
        $where['set_id'] = 1;
        $setting = $this->settingModel->get_settings($where)->row();
        $data['setting'] = $setting;
        $data['trahs'] = $this->trahModel->get_trah()->result();

        // print_r($data['trahs']);
        $user = $this->session->userdata('user_data');
        $data['users'] = $user;
        if ($user['use_akses'] != 3) {
          $data['navigations'] = $this->navigations;
          $this->twig->display('backend/approve_canine', $data);
        }else {
          redirect('backend/dashboard');
        }

      }
    }

    public function approve_data($id = null){
      if ($id != null) {
          $where['can_id'] = $id;
          $canines = $this->caninesModel->get_can_pedigrees($where)->row();
          // $canines = $this->caninesModel->get_canines($where)->row();
          echo json_encode($canines);
      }else{
          // ARTechnology
          $aColumns = array('can_id', 'can_current_reg_number', 'can_icr_moc_number', 'can_icr_number','can_a_s', 'can_owner','can_gender', 'can_score' , 'can_photo', 'can_remaining_payment', 'can_created_at', 'can_updated_at', 'can_stat', 'can_note', 'can_address', 'can_member', 'mem_name', 'can_print', 'ken_type_id', 'ken_name', 'can_app_stat', 'can_color', 'can_date_of_birth', 'can_owner_name', 'can_cage', 'can_breed');
          // ARTechnology
          $sTable = 'canines';

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
              // ARTechnology
              for($i=0; $i<count($columns); $i++){
              // ARTechnology

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
          $this->db->join('members','members.mem_id = canines.can_member');
          $this->db->join('kennels','kennels.ken_id = members.mem_ken_id');
          $this->db->where('can_app_stat', 0);
          $this->db->order_by('can_id', 'desc');
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

  public function approve_canine($id = null){
    if ($id){
      $where['can_id'] = $id;
      $can = $this->caninesModel->get_can_pedigrees($where)->row();

      $res = $this->caninesModel->update_status($id, 1);
      if ($res){
        if ($can->mem_id){
          $res3 = $this->notification_model->add(11, $id, $can->mem_id);

          $whe_can['mem_id'] = $can->mem_id;
          $member = $this->memberModel->get_members($whe_can)->row();
          if ($member->mem_firebase_token){
            $notif = $this->notificationtype_model->get_by_id(11);
            $url = 'https://fcm.googleapis.com/fcm/send';
            $key = 'AAAALe2LeZU:APA91bEqr2n1PRxkOyOfx8IwYO1O_1gjprFkq1AITOGUu3GYp2ZBi-8-AvM4ADI3m94NEv4cq-uKcMBU3pJXBhO21CyuVgPNX2l7VYXj5IllxEr6sika8eaJp1IgXCHALA5_xYw92pXK';

            $fields = array (
              'to' => $member->mem_firebase_token,
              'notification' => array(
                "channelId" => "ICRPedigree",
                'title' => $notif[0]->title,
                'body' => $notif[0]->description
              )
            );
            $fields = json_encode ( $fields );

            $headers = array (
                'Authorization: key=' . $key,
                'Content-Type: application/json'
            );

            $ch = curl_init ();
            curl_setopt ( $ch, CURLOPT_URL, $url );
            curl_setopt ( $ch, CURLOPT_POST, true );
            curl_setopt ( $ch, CURLOPT_HTTPHEADER, $headers );
            curl_setopt ( $ch, CURLOPT_RETURNTRANSFER, true );
            curl_setopt ( $ch, CURLOPT_POSTFIELDS, $fields );

            $result = curl_exec ( $ch );
            // echo $result;
            curl_close ( $ch );
          }
        }
        echo json_encode(array('data' => '1'));
      }
      else{
        echo json_encode(array('data' => 'Canine dengan id = '.$id.' tidak dapat di-approve'));
      }
    }
  }

  public function reject_canine($id = null){
    if ($id){
      $where['can_id'] = $id;
      $can = $this->caninesModel->get_can_pedigrees($where)->row();

      $res = $this->caninesModel->update_status($id, 2);
      if ($res){
        if ($can->mem_id){
          $res3 = $this->notification_model->add(12, $id, $can->mem_id);

          $whe_can['mem_id'] = $can->mem_id;
          $member = $this->memberModel->get_members($whe_can)->row();
          if ($member->mem_firebase_token){
            $notif = $this->notificationtype_model->get_by_id(12);
            $url = 'https://fcm.googleapis.com/fcm/send';
            $key = 'AAAALe2LeZU:APA91bEqr2n1PRxkOyOfx8IwYO1O_1gjprFkq1AITOGUu3GYp2ZBi-8-AvM4ADI3m94NEv4cq-uKcMBU3pJXBhO21CyuVgPNX2l7VYXj5IllxEr6sika8eaJp1IgXCHALA5_xYw92pXK';

            $fields = array (
              'to' => $member->mem_firebase_token,
              'notification' => array(
                "channelId" => "ICRPedigree",
                'title' => $notif[0]->title,
                'body' => $notif[0]->description
              )
            );
            $fields = json_encode ( $fields );

            $headers = array (
                'Authorization: key=' . $key,
                'Content-Type: application/json'
            );

            $ch = curl_init ();
            curl_setopt ( $ch, CURLOPT_URL, $url );
            curl_setopt ( $ch, CURLOPT_POST, true );
            curl_setopt ( $ch, CURLOPT_HTTPHEADER, $headers );
            curl_setopt ( $ch, CURLOPT_RETURNTRANSFER, true );
            curl_setopt ( $ch, CURLOPT_POSTFIELDS, $fields );

            $result = curl_exec ( $ch );
            // echo $result;
            curl_close ( $ch );
          }
        }
        echo json_encode(array('data' => '1'));
      }
      else{
        echo json_encode(array('data' => 'Canine dengan id = '.$id.' tidak dapat di-reject'));
      }
    }
  }
    // ARTechnology
}
