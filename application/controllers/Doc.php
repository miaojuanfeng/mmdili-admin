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

	private static $online_path = 'C:\MJF\web\doc\online\\';

	function __construct()
    {
    	parent::__construct();
    	$this->load->helper('url');
    	$this->load->model('doc_model');
    	$this->cii_pagination = new cii_pagination();
    }

    private function trim_whitespace($str)
    {
		// First remove the leading/trailing whitespace 
		//去掉开始和结束的空白 
		$str = trim($str); 

		$str = preg_replace('/　(?=　)/', ' ', $str);
		$str = preg_replace('/(?=)/', ' ', $str);
		$str = preg_replace('/(?=)/', ' ', $str);

		$str = preg_replace('/　/', ' ', $str);
		$str = preg_replace('//', ' ', $str);
		$str = preg_replace('//', ' ', $str);

		$str = preg_replace('/_(?=_)/', '', $str);
		$str = preg_replace('/…(?=…)/', '', $str);
		$str = preg_replace('/\?(?=\?)/', '', $str);
		$str = preg_replace('/\？ (?=\？ )/', '', $str);

		// Now remove any doubled-up whitespace 
		//去掉跟随别的挤在一块的空白
		$str = preg_replace('/\s(?=\s)/', '', $str);



		// Finally, replace any non-space whitespace, with a space 
		//最后，去掉非space 的空白，用一个空格代替 
		$str = preg_replace('/[\n\r\t]/', ' ', $str); 

		return $str;
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

    private function mb_pathinfo($filepath) {
	    preg_match('%^(.*?)[\\\\/]*(([^/\\\\]*?)(\.([^\.\\\\/]+?)|))[\\\\/\.]*$%im',$filepath,$m);
	    if($m[1]) $ret['dirname']=$m[1];
	    if($m[2]) $ret['basename']=$m[2];
	    if($m[5]) $ret['extension']=$m[5];
	    if($m[3]) $ret['filename']=$m[3];
	    return $ret;
	}

    public function detail($doc_id){
		
		$detail = $this->doc_model->get_detail($doc_id);

		$data['doc']['doc_id'] = $detail['doc_id'];
		$data['doc']['doc_url'] = $detail['doc_url'];
		$data['doc']['doc_title'] = $detail['doc_title'];
		$data['doc']['doc_desc'] = $detail['doc_desc'];
		$data['doc']['doc_cate_id'] = $detail['doc_cate_id'];
		$data['doc']['doc_user_id'] = $detail['doc_user_id'];
		$data['doc']['doc_dl_forbidden'] = $detail['doc_dl_forbidden'];
		$data['doc']['user_url'] = $detail['user_url'];
		$data['doc']['doc_ext_name'] = $detail['doc_ext_name'];

		$this->load->view('doc_detail_view', $data);
	}

	public function update(){
		$doc_id = $this->input->post('doc_id');
		$doc_cate_id = $this->input->post('doc_cate_id');
		$doc_user_id = $this->input->post('doc_user_id');
		$doc_dl_forbidden = $this->input->post('doc_dl_forbidden');
		$update_doc_content = $this->input->post('update_doc_content');
		$doc_content = "";
		$file_path = self::$online_path.$this->input->post('file_path');

		if( $doc_id ){
			if( $update_doc_content ){
				$file_path = iconv('UTF-8', 'GB2312', $file_path);
				$file = $this->mb_pathinfo($file_path);
				if( $file['extension'] == 'doc' || $file['extension'] == 'docx' || $file['extension'] == 'txt' ){
					try{
						$word = null;
			    		$word = new COM("Word.Application") or die ("Could not initialise Word Object.");   
						$retry = 50;
						while( !$word && (--$retry) ){
							sleep(100);
						}
						if( $retry <= 0 ){
							echo "word application not ready!";
							return;
						}
			   			$word->Visible = 0;   
			    		$word->DisplayAlerts = 0; 
						$word->Documents->Open($file_path);
						$doc_content = $word->ActiveDocument->content->Text;
						$word->Quit(false);  
						unset($word);
					}catch(Exception $e){
						if( $word ){
			    			$word->Quit(false);  
			    			unset($word);
						}
						echo $e->getMessage();
						return;
					}
				}
				$doc_content = iconv('GB2312', 'UTF-8//IGNORE', $doc_content);
				$doc_content = $this->trim_whitespace($doc_content);
			}

			if( $this->doc_model->update($doc_id, $doc_cate_id, $doc_user_id, $doc_dl_forbidden, $update_doc_content, $doc_content) ){
				redirect(base_url('doc/detail/'.$doc_id));
			}
		}
		redirect(base_url('doc'));
	}
}
?>