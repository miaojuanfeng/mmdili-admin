<?php
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
//class doc_model extends CI_Model{
class test_model{
    //put your code here
    
    function __construct()
    {
        //parent::__construct();
	    $this->cii_db = new cii_database('localhost', 'root', '', 'mmdili');
    }

    public function get_detail($doc_id){
    	$sql = "SELECT 
    		user_url,
    		doc_ext_name,
            doc_id,
            doc_url, 
            doc_title, 
			doc_content,
            doc_cate_id,
            doc_user_id,
            doc_dl_forbidden 
            FROM m_doc 
            LEFT JOIN m_user ON doc_user_id = user_id 
            LEFT JOIN m_doc_ext ON m_doc.doc_ext_id = m_doc_ext.doc_ext_id 
            WHERE doc_deleted = 0 
            AND doc_id = ".$doc_id." LIMIT 1";
    	$query = $this->cii_db->query($sql);
    	if($query->num_rows()){
        	return $query->row_array();
    	}else{
    		return null;
    	}
    }
}