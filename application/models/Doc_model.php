<?php
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
//class doc_model extends CI_Model{
class doc_model{
    //put your code here
    
    function __construct()
    {
        //parent::__construct();

        //$this->load->database('default');
	$this->cii_db = new cii_database('localhost', 'root', '', 'mmdili');
    }

    public function get_count(){
        //$query = $this->db->query("SELECT COUNT(doc_id) as rows_total FROM m_doc WHERE doc_deleted = 0");
        //return $query->row_array()['rows_total'];
	$query = $this->cii_db->query("SELECT doc_id FROM m_doc WHERE doc_deleted = 0");
	return $query->num_rows();
    }
	
	public function get_list($limit, $offset){
    	$query = $this->cii_db->query("SELECT user_url, doc_id, doc_url, doc_title, substring(doc_content, 1, 250) as doc_desc, doc_page_num FROM m_doc LEFT JOIN m_user ON doc_user_id = user_id WHERE doc_deleted = 0 AND user_deleted = 0 ORDER BY doc_id DESC LIMIT ".$limit." OFFSET ".$offset);
    	return $query->result_array();
    }

    public function get_detail($doc_id){
    	$sql = "SELECT 
    		user_url,
    		doc_ext_name,
            doc_id,
            doc_url, 
            doc_title, 
			substring(doc_content, 1, 250) as doc_desc,
            doc_cate_id,
            doc_user_id,
            doc_dl_forbidden 
            FROM m_doc 
            LEFT JOIN m_user ON doc_user_id = user_id 
            LEFT JOIN m_doc_ext ON m_doc.doc_ext_id = m_doc_ext.doc_ext_id 
            WHERE doc_deleted = 0 
            AND doc_id = ".$doc_id." LIMIT 1";
    	$query = $this->cii_db->query($sql);
    	return $query->row_array();
    }

    public function update($doc_id, $doc_cate_id, $doc_user_id, $doc_dl_forbidden, $update_doc_content, $doc_content, $update_doc_html){
    	$sql = "UPDATE m_doc SET 
    		doc_cate_id = ".$doc_cate_id.",
    		doc_user_id = ".$doc_user_id.",";
    	if( $update_doc_content ){
    		$sql .= "doc_content = '".$this->db->escape_str($doc_content)."',";
    	}
	if( !empty($update_doc_html) ){
		$sql .= "doc_html_view = ".$update_doc_html.",";
	}	
    	$sql .=	"
            doc_dl_forbidden = ".$doc_dl_forbidden.",
    		doc_modify_date = ".time()."  
    		WHERE doc_id = ".$doc_id;
    	$this->cii_db->query($sql);
    	if( $this->cii_db->affected_rows() ){
    		return true;
    	}
    	return false;
    }
}