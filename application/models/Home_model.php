<?php
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
class home_model extends CI_Model{
    //put your code here
    
    function __construct()
    {
        parent::__construct();

        $this->load->database('default');
    }
	
	public function check_doc_exists($file_name){
		$query = $this->db->query("SELECT doc_url FROM m_doc WHERE doc_deleted = 0 AND doc_title = '".$file_name."' LIMIT 1");
		if( $query->num_rows() ){
			return false;
		}
		return true;
	}

    public function insert_doc($doc_url, $doc_title, $doc_width, $doc_height, $doc_page_num, $doc_poly2bitmap){
		$this->db->query("INSERT INTO m_doc(
			doc_url,
			doc_title,
			doc_user_id,
			doc_ext_id,
			doc_width,
			doc_height,
			doc_page_num,
			doc_poly2bitmap,
			doc_modify_date
		) VALUES(
			".$doc_url.",
			'".$doc_title."',
			'".$_SESSION["user_id"]."',
			1,
			".$doc_width.",
			".$doc_height.",
			".$doc_page_num.",
			".$doc_poly2bitmap.",
			'".$doc_url."'
		)");
		return true;
    }
}