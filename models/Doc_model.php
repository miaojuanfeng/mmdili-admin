<?php
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
class doc_model{
    //put your code here
    
    function __construct()
    {
        $this->load->database('default');
    }

    public function get_count(){
        //$query = $this->db->query("SELECT COUNT(doc_id) as rows_total FROM m_doc WHERE doc_deleted = 0");
        //return $query->row_array()['rows_total'];
    	$query = $this->db->query("SELECT doc_id FROM m_doc WHERE doc_deleted = 0");
    	return $query->num_rows();
    }
	
	public function get_list($limit, $offset){
    	$query = $this->db->query("SELECT user_url, doc_id, doc_url, doc_title, doc_content as doc_desc, doc_page_num FROM m_doc LEFT JOIN m_user ON doc_user_id = user_id WHERE doc_deleted = 0 AND user_deleted = 0 ORDER BY doc_id DESC LIMIT ".$limit." OFFSET ".$offset);
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
    	$query = $this->db->query($sql);
    	if($query->num_rows()){
        	return $query->row_array();
    	}else{
    		return null;
    	}
    }

    public function update($doc_id, $doc_cate_id, $doc_user_id, $doc_dl_forbidden, $update_doc_content, $doc_content, $update_doc_html){
    	$sql = "UPDATE m_doc SET 
    		doc_cate_id = ".$doc_cate_id.",
    		doc_user_id = ".$doc_user_id.",";
    	if( $update_doc_content ){
    		//$sql .= "doc_content = '".$this->db->escape_str($doc_content)."',";
		$sql .= "doc_content = '".mysqli_real_escape_string($this->db->conn_id, $doc_content)."',";
    	}
    	if( !empty($update_doc_html) ){
    		$sql .= "doc_html_view = ".$update_doc_html.",";
    	}	
    	$sql .=	"
            doc_dl_forbidden = ".$doc_dl_forbidden.",
    		doc_modify_date = ".time()."  
    		WHERE doc_id = ".$doc_id;
    	$this->db->query($sql);
    	if( $this->db->affected_rows() ){
    		return true;
    	}
    	return false;
    }
}