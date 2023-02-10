<?php

class News_model extends CI_Model{
	function __construct(){
		date_default_timezone_set("Asia/Bangkok");
	}
	
	function get_max_id(){
		$this->db->select_max('news_id', 'max');
		$query = $this->db->get('news');
        return $query->result()[0]->max;
	}

	function add($data){
		$id = $this->get_max_id() + 1;
		if ($id){
			$data['news_id'] = $id;
		}
		else
			$data['news_id'] = 1;
		$this->db->insert('news', $data);
		return $data['news_id'];
	}

	public function update($data, $where){
        $this->db->set($data);
        $this->db->where($where);
        return $this->db->update('news');
    }

	function get_news($where){
		$this->db->select('*, DATE_FORMAT(date, "%d-%m-%Y") AS date');
		if ($where != null) {
            $this->db->where($where);
        }
		$this->db->order_by('news.date', 'DESC');
		$this->db->limit($this->config->item('news_count'), 0);
		return $this->db->get('news'); 		
	}
}
