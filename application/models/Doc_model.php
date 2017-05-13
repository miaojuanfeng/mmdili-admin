<?php
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
class doc_model extends CI_Model{
    //put your code here
    
    function __construct()
    {
        parent::__construct();

        $this->load->database('default');
    }

    public function get_count(){
        $query = $this->db->query("SELECT COUNT(doc_id) as rows_total FROM m_doc WHERE doc_deleted = 0");
        return $query->row_array()['rows_total'];
    }
	
	public function get_list($limit, $offset){
    	$query = $this->db->query("SELECT doc_url, doc_title, doc_page_num FROM m_doc WHERE doc_deleted = 0 ORDER BY doc_id DESC LIMIT ".$limit." OFFSET ".$offset);
    	return $query->result_array();
    }

    public function get_detail($doc_id){
    	$sql = "SELECT 
            doc_id,
            doc_url, 
            doc_title, 
			substring(doc_content, 1, 250) as doc_desc,
            doc_cate_id,
            doc_user_id,
            doc_dl_forbidden 
            FROM m_doc 
            WHERE doc_deleted = 0 
            AND doc_id = ".$doc_id." LIMIT 1";
    	$query = $this->db->query($sql);
    	return $query->row_array();
    }
}