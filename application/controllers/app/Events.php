<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Events extends CI_Controller {
  public function __construct(){
    // Call the CI_Controller constructor
    parent::__construct();
    $this->load->model(array('eventModel', 'eventGaleryModel'));
  }

  public function get_events(){
    echo json_encode([
      'status' => true,
      'data' => $this->eventModel->fetch_data($this->config->item('event_count'), 0)->result()
    ]);
  }

  public function get_gallery(){
    if ($this->uri->segment(4)){
      $where['gal_event_id'] = $this->uri->segment(4);
      echo json_encode([
        'status' => true,
        'data' => $this->eventGaleryModel->get_event_galleries($where)->result()
      ]);
    }
    else
      echo json_encode([
        'status' => false,
        'message' => 'Id event wajib diisi'
      ]);
  }
}
