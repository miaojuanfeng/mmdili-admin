<?php
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
class upload_model extends CI_Model{
    //put your code here
    
    function __construct()
    {
        parent::__construct();

        $this->load->database('default');
    }
	
	public function get_list($limit, $offset){
    	$query = $this->db->query("SELECT doc_url, doc_title, doc_page_num FROM m_doc WHERE doc_deleted = 0 ORDER BY doc_id DESC LIMIT ".$limit." OFFSET ".$offset);
    	return $query->result_array();
    }
}