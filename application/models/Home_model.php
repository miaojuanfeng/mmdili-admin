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

    public function insert_doc($doc_url, $doc_title, $doc_width, $doc_height, $doc_page_num, $now){
		$this->db->query("INSERT INTO m_doc(
			doc_url,
			doc_title,
			doc_type,
			doc_width,
			doc_height,
			doc_page_num,
			doc_create_date,
			doc_modify_date
		) VALUES(
			".$doc_url.",
			'".$doc_title."',
			1,
			".$doc_width.",
			".$doc_height.",
			".$doc_page_num.",
			'".$now."',
			'".$now."'
		)");
		return true;
    }
}