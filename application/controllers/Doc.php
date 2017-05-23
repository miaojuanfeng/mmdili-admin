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
	private static $convert_path = 'C:\MJF\web\doc\convert\\';
	private static $view_path = 'C:\MJF\web\doc\view\\';

	function __construct()
    {
    	parent::__construct();
    	$this->load->helper('url');
    	$this->load->model('doc_model');
    	$this->load->library('oss');
    	$this->load->library('file');
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
		$str = preg_replace('/\? (?=\? )/', '', $str);
		$str = preg_replace('/\？(?=\？)/', '', $str);
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
		$doc_url = $this->input->post('doc_url');
		$user_url = $this->input->post('user_url');
		$doc_cate_id = $this->input->post('doc_cate_id');
		$doc_user_id = $this->input->post('doc_user_id');
		$doc_dl_forbidden = $this->input->post('doc_dl_forbidden');
		$update_doc_content = $this->input->post('update_doc_content');
		$update_doc_view = $this->input->post('update_doc_view');
		$update_doc_html = $this->input->post('update_doc_html');
		$doc_content = "";
		$file_path = self::$online_path.$this->input->post('file_path');

		if( $doc_id ){
			if( $update_doc_content || $update_doc_view || $update_doc_html ){
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
						if( $update_doc_content ){
							$doc_content = $word->ActiveDocument->content->Text;
						}
						if( $update_doc_view ){
							$word->ActiveDocument->ExportAsFixedFormat(self::$convert_path.$file['filename'].'.pdf', 17, false, 0, 0, 0, 0, 7, true, true, 2, true, true, false);
						}
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
				if( $file['extension'] == 'ppt' || $file['extension'] == 'pptx' ){
					try{
						$ppt = null;
			    			$ppt = new COM("powerpoint.Application") or die ("Could not initialise PowerPoint Object.");   
						$retry = 50;
						while( !$ppt && (--$retry) ){
							sleep(100);
						}
						if( $retry <= 0 ){
							echo "ppt application not ready!";
							return;
						}
			   			$ppt->Visible = true; //Hiding the application window is not allowed.   
			    		$ppt->DisplayAlerts = 0; 
						$ppt->Presentations->Open($file_path);
						if( $update_doc_content ){
							foreach($ppt->ActivePresentation->Slides as $k1 => $v1){
								foreach($v1->Shapes as $k2 => $v2 ){
									if( $v2->HasTextFrame && $v2->TextFrame->HasText ){
										$doc_content .= $v2->TextFrame->TextRange->Text." ";
									}
									if( $v2->HasTable ){
										foreach($v2->Table->Rows as $k3 => $v3){
											foreach($v2->Table->Columns as $k4 => $v4){
												$doc_content .= $v2->Table->Cell($k3+1, $k4+1)->Shape->TextFrame->TextRange->Text." ";
											}
										}
									}
								}
							}
						}
						if( $update_doc_view ){
							$ppt->ActivePresentation->SaveAs(self::$convert_path.$file['filename'].'.pdf', 32);
						}
						$ppt->Quit();  
						unset($ppt);
					}catch(Exception $e){
						if( $ppt ){
			    			$ppt->Quit();  
			    			unset($ppt);
						}
						echo $e->getMessage();
						return;
					}
				}
				if( $update_doc_view ){
					$view_path = self::$view_path.$doc_url.'\\';
					$view_optimizer_path = self::$view_path.$doc_url.'_o'.'\\';
					if( !is_dir($view_path) ){
						mkdir($view_path, 0777, true);
					}
					if( !is_dir($view_optimizer_path) ){
						mkdir($view_optimizer_path, 0777, true);
					}

					$page_num = 0;
					$page_width = 0;
					$page_height = 0;
					$exec = "C:\MJF\SWFTools\pdf2swf.exe \"".self::$convert_path.$file['filename'].".pdf\" -I";
					exec($exec, $pdf_info);
					if( count($pdf_info) ){
						$page_num = count($pdf_info);
						$page_width_height_string = explode(' ', $pdf_info[0]);
						$page_width  = intval(explode('=', $page_width_height_string[1])[1]);
						$page_height = intval(explode('=', $page_width_height_string[2])[1]);
					}
					if( !$page_width || !$page_height || !$page_num ){
						echo "get pdf info failed.";
						return;
					}
					$poly2bitmap = '';
			pdf2swf_run:
					$exec = "C:\MJF\SWFTools\pdf2swf.exe \"".self::$convert_path.$file['filename'].".pdf\" -o ".$view_path."%.swf -T 9 -j 20 -s disablelinks".$poly2bitmap;
					exec($exec, $swf_info);
					foreach($swf_info as $k => $v){
						//log_message('error', $v);
						if( empty($poly2bitmap) && $v == 'ERROR   This file is too complex to render- SWF only supports 65536 shapes at once' ){
							$poly2bitmap = ' -s poly2bitmap';
							log_message('error', 'run -s poly2bitmap');
							goto pdf2swf_run;
						}
					}
					if( $file['extension'] != 'pdf' ){
						unlink(self::$convert_path.$file['filename'].".pdf");
					}
					
					$fo2 = 'C:\MJF\fo2\fo2.exe';
					for($i=1;$i<=$page_num;$i++){
						$fo2 .= ' /f "'.$view_path.$i.'.swf" /t "'.$view_optimizer_path.$i.'"';
					}
					$fo2 .= ' /o mmdili';
					pclose(popen("start /B ". $fo2, "r"));
					$retry = 60;
					while( $retry-- ){
						if( $this->file->count_file($view_optimizer_path) == $page_num ){
							break;
						}
						sleep(1);
					}
			                exec("taskkill /f /im fo2.exe");
					if( $retry <= 0 ){
						echo "fo2 make files failed";
						die();
					}

					if( !$this->oss->uploadDir($user_url.'/'.$doc_url, $view_optimizer_path)){
						echo "upload swf to OSS failed.";
						return;
					}
					$this->file->del_dir_file(self::$view_path);
				}else if( $update_doc_html ){
					$view_path = self::$view_path.$doc_url.'\\';
					
					$cmd  = 'C:\MJF\pdf2htmlEX\pdf2htmlEX.exe';
					$cmd .= ' --zoom 1.613';
					$cmd .= ' --split-pages 1';
					$cmd .= ' --embed-image 0';
					$cmd .= ' --embed-css 0';
					$cmd .= ' --embed-font 0';
					$cmd .= ' --bg-format "jpg"';
					$cmd .= ' --dest-dir "'.$view_path.'"';
					$cmd .= ' --page-filename "'.$doc_url.'-%03d.page"';
					$cmd .= ' --css-filename "'.$doc_url.'.css"';
					$cmd .= ' --embed-javascript 0';
					$cmd .= ' --process-outline 0';
					$cmd .= ' --vdpi 80';
					$cmd .= ' --hdpi 80';
					$cmd .= ' '.self::$convert_path.$file['filename'].'.pdf';
					exec($cmd, $r);
					if( $file['extension'] != 'pdf' ){
						unlink(self::$convert_path.$file['filename'].".pdf");
					}
				}
				if( $update_doc_content ){
					$doc_content = iconv('GB2312', 'UTF-8//IGNORE', $doc_content);
					$doc_content = $this->trim_whitespace($doc_content);
				}
			}

			if( $this->doc_model->update($doc_id, $doc_cate_id, $doc_user_id, $doc_dl_forbidden, $update_doc_content, $doc_content) ){
				redirect(base_url('doc/detail/'.$doc_id));
			}
		}
		redirect(base_url('doc'));
	}

	public function load(){
		$user_url = $this->input->post('user_url');
		$doc_url = $this->input->post('doc_url');

		if( $user_url && $doc_url ){
			$views = $this->oss->listView($user_url, $doc_url);
			$retval = array();
			foreach ($views as $key => $value) {
				$retval[$key]['key'] = $value->getKey();
				$retval[$key]['size'] = $value->getSize()/1024;
				$retval[$key]['modify'] = date('Y-m-d H:i:s', strtotime($value->getLastModified()));
			}
			echo json_encode($retval);
		}
	}
}
?>