<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Doc extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */
	function __construct()
    {
    	parent::__construct();
    	$this->load->helper('url');
    	$this->load->model('doc_model');
    	$this->cii_pagination = new cii_pagination();
    }

    public function index($pn = 1){
    	// 每页显示数量
		$limit = 10;
		// 总记录数量
		$total = $this->doc_model->get_count();
		// 总页数
		$page = ceil($total/$limit);
		/*
		 * 容错处理
		 * 1.如果页数不是数字
		 * 2.如果页数不是整数
		 * 3.如果页数小于首页
		 * 4.如果页数大于尾页
		 * 转到404
		*/
		if( (!empty($pn) && !is_numeric($pn)) || ($pn > intval($pn)) || ($pn < 1) || ($page && $pn > $page) ){
			redirect(base_url('doc'));
		}
		// 计算偏移量
		$offset = ($pn - 1) * $limit;
		//
		$data['doc']['doc'] = $this->doc_model->get_list($limit, $offset);

		$cii_pagination['base_url'] = base_url('doc/index/');
		$cii_pagination['per_page'] = $limit;
		$cii_pagination['total_rows'] = $total;
		$this->cii_pagination->initialize($cii_pagination);
		//
		$this->load->view('doc_list_view', $data);
    }

    public function detail($doc_id){
		
		$detail = $this->doc_model->get_detail($doc_id);

		$data['doc']['doc_id'] = $detail['doc_id'];
		$data['doc']['doc_title'] = $detail['doc_title'];
		$data['doc']['doc_desc'] = $detail['doc_desc'];
		$data['doc']['doc_cate_id'] = $detail['doc_cate_id'];
		$data['doc']['doc_user_id'] = $detail['doc_user_id'];
		$data['doc']['doc_dl_forbidden'] = $detail['doc_dl_forbidden'];

		$this->load->view('doc_detail_view', $data);
	}
}
?>