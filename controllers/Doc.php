﻿<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Doc{

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
	$this->load->model('doc_model');
	$this->load->internal('input');
	$this->load->library('oss');
    	$this->load->library('file');
	$this->load->internal('pagination');
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
		
		$str = preg_replace('/\?+/', ' ', $str);
		$str = preg_replace('/\？+/', ' ', $str);
		$str = preg_replace('/・+/', '', $str);

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
			redirect(cii_base_url('doc'));
		}
		// 计算偏移量
		$offset = ($pn - 1) * $limit;
		//
		$data['doc']['doc'] = $this->doc_model->get_list($limit, $offset);
		foreach($data['doc']['doc'] as $key => $value){
			$data['doc']['doc'][$key]['doc_desc'] = mb_substr(strip_tags($value['doc_desc']), 0, 250);
		}

		$cii_pagination['base_url'] = cii_base_url('doc/index/');
		$cii_pagination['per_page'] = $limit;
		$cii_pagination['total_rows'] = $total;
		$cii_pagination['first_link'] = '首页';
		$cii_pagination['prev_link'] = '上一页';
		$cii_pagination['next_link'] = '下一页';
		$cii_pagination['last_link'] = '尾页';
		$this->pagination->initialize($cii_pagination);
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

		$this->load->view('doc_detail_view.php', $data);
	}

	private function clearn_file($path, $file_type){
	    //判断要清除的文件类型是否合格
	    if(!preg_match('/^[a-zA-Z]{2,}$/',$file_type)){
	        return false;
	    }
	    //当前路径是否为文件夹或可读的文件
	    if(!is_dir($path)||!is_readable($path)){
	        return false;
	    }
	    //遍历当前目录下所有文件
	    $all_files=scandir($path);
	    foreach($all_files as $filename){
	        //跳过当前目录和上一级目录
	        if(in_array($filename,array(".", ".."))){
	            continue;
	        }
	        //进入到$filename文件夹下
	        $full_name=$path.'/'.$filename;
	        //判断当前路径是否是一个文件夹，是则递归调用函数
	        //否则判断文件类型，匹配则删除
	        if(is_dir($full_name)){
	            clearn_file($full_name,$file_type);
	        }else{
	            preg_match("/(.*)\.$file_type/",$filename,$match);
	            if(!empty($match[0][0]) || !empty($match[0])){
	                //echo $full_name;
	                //echo '<br>';
	                unlink($full_name);
	            }
	        }
	    }
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
						$retry = 60;
						while( !$word && (--$retry) ){
							sleep(1);
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
						if( $update_doc_view || $update_doc_html ){
							$word->ActiveDocument->ExportAsFixedFormat(self::$convert_path.$doc_url.'.pdf', 17, false, 0, 0, 0, 0, 7, true, true, 2, true, true, false);
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
						$retry = 60;
						while( !$ppt && (--$retry) ){
							sleep(1);
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
						if( $update_doc_view || $update_doc_html ){
							$ppt->ActivePresentation->SaveAs(self::$convert_path.$doc_url.'.pdf', 32);
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
					$pdf_info = array();
					$exec = "C:\MJF\SWFTools\pdf2swf.exe \"".self::$convert_path.$doc_url.".pdf\" -I";
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
					$exec = "C:\MJF\SWFTools\pdf2swf.exe \"".self::$convert_path.$doc_url.".pdf\" -o ".$view_path."%.swf -T 9 -j 20 -s disablelinks".$poly2bitmap;
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
					$view_path = self::$view_path.$doc_url;

					$page_num = 0;
					$page_width = 0;
					$page_height = 0;
					$pdf_info = array();
					$exec = "C:\MJF\SWFTools\pdf2swf.exe \"".self::$convert_path.$doc_url.".pdf\" -I";
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

					$cmd  = 'C:\MJF\pdf2htmlEX\pdf2htmlEX.exe';
					//$cmd .= ' --zoom 1.613';
					$cmd .= ' --fit-width 960';
					$cmd .= ' --space-as-offset 1';
					$cmd .= ' --split-pages 1';
					$cmd .= ' --embed-image 0';
					$cmd .= ' --embed-css 0';
					$cmd .= ' --embed-font 0';
					$cmd .= ' --bg-format "jpg"';
					$cmd .= ' --dest-dir "'.$view_path.'"';
					// $cmd .= ' --page-filename "'.$doc_url.'-%03d.page"';
					$cmd .= ' --page-filename "%03d.html"';
					// $cmd .= ' --css-filename "'.$doc_url.'.css"';
					$cmd .= ' --css-filename "page.min.css"';
					$cmd .= ' --font-format "ttf"';
					$cmd .= ' --embed-javascript 0';
					$cmd .= ' --process-outline 0';
					$cmd .= ' --vdpi 80';
					$cmd .= ' --hdpi 80';
					$cmd .= ' "'.self::$convert_path.$doc_url.'.pdf"';
					exec($cmd, $r);
					if( $file['extension'] != 'pdf' ){
						unlink(self::$convert_path.$doc_url.".pdf");
					}
					// $this->clearn_file($view_path, 'woff');
					// $file_content = file_get_contents($view_path.'\page.min.css');
					// preg_match_all('/@font-face{font-family:(.*?)}/i', $file_content, $imgArr);
					// foreach ($imgArr[0] as $key => $value) {
					// 	$file_content = str_replace($value, '', $file_content);
					// }
					// preg_match_all('/.ff[0-9]*{(.*?)}/i', $file_content, $imgArr);
					// foreach ($imgArr[1] as $key => $value) {
					// 	$file_content = str_replace($value, '', $file_content);
					// }
					// file_put_contents($view_path.'\page.min.css', $file_content);
					if($update_doc_content){
						$doc_content = "";
					}
					for($i=1;$i<=$page_num;$i++){
						$file_content = file_get_contents($view_path.'\\'.sprintf("%03d.html", $i));
						//
						// preg_match_all('/<img.+src=\"?(.+\.(jpg|gif|bmp|bnp|png))\"?.+>/i', $file_content, $imgArr);
						// $file_content = str_replace($imgArr[1][0], 'http://view.mmdili.com/'.$user_url.'/'.$doc_url.'/'.$imgArr[1][0], $file_content);
						//
						// preg_match_all('/<\s*img\s+[^>]*?src\s*=\s*(\'|\")(.*?)\\1[^>]*?\/?\s*>/i', $file_content, $imgArr); 
 						preg_match_all('/<\s*img\s+[^>]*?class\s*=\s*(\'|\")(.*?)\\1+[^>]*?src\s*=\s*(\'|\")(.*?)\\1[^>]*?\/?\s*>/i', $file_content, $imgArr); 
 						if( isset($imgArr[2][0]) && isset($imgArr[4][0]) ){
	 						$div = '<div class="'.$imgArr[2][0].'" style="background-image:url('.'http://view.mmdili.com/'.$user_url.'/'.$doc_url.'/'.$imgArr[4][0].')"></div>';
	 						$file_content = str_replace($imgArr[0][0], $div, $file_content);
	 					}
						//
						preg_match_all('/<a .*?href="(.*?)".*?>/is', $file_content, $imgArr);
						foreach($imgArr[1] as $key => $value){
							$file_content = str_replace($value, 'javascript:;', $file_content);
						}
						file_put_contents($view_path.'\\'.sprintf("%03d.html", $i), $file_content);
						if($update_doc_content){
							if($doc_content == ""){
								$doc_content = $file_content;
							}else{
								$doc_content .= '#[page]#'.$file_content;
							}
							
						}
					}
					$html = '<html><head><link rel="stylesheet" href="page.min.css"></head><body>'.$doc_content.'</body></html>';
					file_put_contents($view_path.'\\'.'index.html', $html);
					$cmd = 'font-spider --no-backup '.$view_path.'\\'.'index.html';
					exec($cmd, $r);
					$this->clearn_file($view_path, 'html');
					$views = $this->oss->listView($user_url, $doc_url);
					$objects = array();
					foreach ($views as $key => $value) {
						$objects[] = $value->getKey();
					}
					if( count($objects) && !$this->oss->deleteObjects($objects)){
						echo "delete html from OSS failed.";
						return;
					}
					if( !$this->oss->uploadDir($user_url.'/'.$doc_url, $view_path)){
						echo "upload html to OSS failed.";
						return;
					}
					$this->file->del_dir_file(self::$view_path);
				}
				if( $update_doc_content ){
					//$doc_content = iconv('GB2312', 'UTF-8//IGNORE', $doc_content);
					$doc_content = $this->trim_whitespace($doc_content);
				}
				if( !$this->oss->uploadFile(iconv('GB2312', 'UTF-8', $user_url.'/'.strtotime(date('Y', $doc_url).'-01-01 00:00:00').'/'.$file['basename']), iconv('GB2312', 'UTF-8', $file_path)) ){					
			echo "upload doc to OSS failed.";
			return;
		}
			}

			if( $this->doc_model->update($doc_id, $doc_cate_id, $doc_user_id, $doc_dl_forbidden, $update_doc_content, $doc_content, $update_doc_html) ){
				cii_redirect(cii_base_url('doc/detail/'.$doc_id));
			}
		}
		cii_redirect(cii_base_url('doc'));
	}

	public function batch($start, $end){
		ob_end_clean();
 		ob_implicit_flush(1);
		for($batch_id=$start;$batch_id<=$end;$batch_id++){
			$detail = $this->doc_model->get_detail($batch_id);

			if( $detail ){
				echo "#".$batch_id." - ".$detail['doc_title']."(".$detail['doc_url'].")<br/>";
				//ob_flush();
     			flush();

				$doc_id = $detail['doc_id'];
				$doc_url = $detail['doc_url'];
				$user_url = $detail['user_url'];
				$doc_cate_id = $detail['doc_cate_id'];
				$doc_user_id = $detail['doc_user_id'];
				$doc_dl_forbidden = $detail['doc_dl_forbidden'];
				$update_doc_content = 1;
				$update_doc_view = 0;
				$update_doc_html = 1;
				$doc_content = "";
				$file_path = self::$online_path.$detail['user_url'].'\\'.strtotime(date('Y', $detail['doc_url']).'-01-01 00:00:00').'\\'.$detail['doc_title'].'.'.$detail['doc_ext_name'];

				if( $doc_id ){
					if( $update_doc_content || $update_doc_view || $update_doc_html ){
						$file_path = iconv('UTF-8', 'GB2312', $file_path);
						$file = $this->mb_pathinfo($file_path);
						if( $file['extension'] == 'doc' || $file['extension'] == 'docx' || $file['extension'] == 'txt' ){
							try{
								$word = null;
					    		$word = new COM("Word.Application") or die ("Could not initialise Word Object.");   
								$retry = 60;
								while( !$word && (--$retry) ){
									sleep(1);
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
								if( $update_doc_view || $update_doc_html ){
									$word->ActiveDocument->ExportAsFixedFormat(self::$convert_path.$doc_url.'.pdf', 17, false, 0, 0, 0, 0, 7, true, true, 2, true, true, false);
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
								$retry = 60;
								while( !$ppt && (--$retry) ){
									sleep(1);
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
								if( $update_doc_view || $update_doc_html ){
									$ppt->ActivePresentation->SaveAs(self::$convert_path.$doc_url.'.pdf', 32);
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
							$pdf_info = array();
							$exec = "C:\MJF\SWFTools\pdf2swf.exe \"".self::$convert_path.$doc_url.".pdf\" -I";
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
							$exec = "C:\MJF\SWFTools\pdf2swf.exe \"".self::$convert_path.$doc_url.".pdf\" -o ".$view_path."%.swf -T 9 -j 20 -s disablelinks".$poly2bitmap;
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
							$view_path = self::$view_path.$doc_url;

							$page_num = 0;
							$page_width = 0;
							$page_height = 0;
							$pdf_info = array();
							$exec = "C:\MJF\SWFTools\pdf2swf.exe \"".self::$convert_path.$doc_url.".pdf\" -I";
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

							$cmd  = 'C:\MJF\pdf2htmlEX\pdf2htmlEX.exe';
							// $cmd .= ' --zoom 1.613';
							$cmd .= ' --fit-width 960';
							$cmd .= ' --space-as-offset 1';
							$cmd .= ' --split-pages 1';
							$cmd .= ' --embed-image 0';
							$cmd .= ' --embed-css 0';
							$cmd .= ' --embed-font 0';
							$cmd .= ' --bg-format "jpg"';
							$cmd .= ' --dest-dir "'.$view_path.'"';
							// $cmd .= ' --page-filename "'.$doc_url.'-%03d.page"';
							// $cmd .= ' --page-filename "%03d"';
							$cmd .= ' --page-filename "%03d.html"';
							// $cmd .= ' --css-filename "'.$doc_url.'.css"';
							$cmd .= ' --css-filename "page.min.css"';
							$cmd .= ' --font-format "ttf"';
							$cmd .= ' --embed-javascript 0';
							$cmd .= ' --process-outline 0';
							$cmd .= ' --vdpi 80';
							$cmd .= ' --hdpi 80';
							// $cmd .= ' --embed-external-font 0';
							$cmd .= ' "'.self::$convert_path.$doc_url.'.pdf"';
							exec($cmd, $r);
							if( $file['extension'] != 'pdf' ){
								unlink(self::$convert_path.$doc_url.".pdf");
							}
							// $this->clearn_file($view_path, 'woff');
							// $file_content = file_get_contents($view_path.'\page.min.css');
							// preg_match_all('/@font-face{font-family:(.*?)}/i', $file_content, $imgArr);
							// foreach ($imgArr[0] as $key => $value) {
							// 	$file_content = str_replace($value, '', $file_content);
							// }
							// preg_match_all('/.ff[0-9]*{(.*?)}/i', $file_content, $imgArr);
							// foreach ($imgArr[1] as $key => $value) {
							// 	$file_content = str_replace($value, '', $file_content);
							// }
							// file_put_contents($view_path.'\page.min.css', $file_content);
							if($update_doc_content){
								$doc_content = "";
							}
							for($i=1;$i<=$page_num;$i++){
								$file_content = file_get_contents($view_path.'\\'.sprintf("%03d.html", $i));
								//
								// preg_match_all('/<img.+src=\"?(.+\.(jpg|gif|bmp|bnp|png))\"?.+>/i', $file_content, $imgArr);
								// $file_content = str_replace($imgArr[1][0], 'http://view.mmdili.com/'.$user_url.'/'.$doc_url.'/'.$imgArr[1][0], $file_content);
								//
								// preg_match_all('/<\s*img\s+[^>]*?src\s*=\s*(\'|\")(.*?)\\1[^>]*?\/?\s*>/i', $file_content, $imgArr); 
		 						preg_match_all('/<\s*img\s+[^>]*?class\s*=\s*(\'|\")(.*?)\\1+[^>]*?src\s*=\s*(\'|\")(.*?)\\1[^>]*?\/?\s*>/i', $file_content, $imgArr); 
		 						if( isset($imgArr[2][0]) && isset($imgArr[4][0]) ){
			 						$div = '<div class="'.$imgArr[2][0].'" style="background-image:url('.'http://view.mmdili.com/'.$user_url.'/'.$doc_url.'/'.$imgArr[4][0].')"></div>';
			 						$file_content = str_replace($imgArr[0][0], $div, $file_content);
			 					}
								//
								preg_match_all('/<a .*?href="(.*?)".*?>/is', $file_content, $imgArr);
								foreach($imgArr[1] as $key => $value){
									$file_content = str_replace($value, 'javascript:;', $file_content);
								}
								file_put_contents($view_path.'\\'.sprintf("%03d.html", $i), $file_content);
								if($update_doc_content){
									if($doc_content == ""){
										$doc_content = $file_content;
									}else{
										$doc_content .= '#[page]#'.$file_content;
									}
							
								}
							}
							$html = '<html><head><link rel="stylesheet" href="page.min.css"></head><body>'.$doc_content.'</body></html>';
							file_put_contents($view_path.'\\'.'index.html', $html);
							$cmd = 'font-spider --no-backup '.$view_path.'\\'.'index.html';
							exec($cmd, $r);
							$this->clearn_file($view_path, 'html');
							$views = $this->oss->listView($user_url, $doc_url);
							$objects = array();
							foreach ($views as $key => $value) {
								$objects[] = $value->getKey();
							}
							if( count($objects) && !$this->oss->deleteObjects($objects)){
								echo "delete html from OSS failed.";
								return;
							}
							if( !$this->oss->uploadDir($user_url.'/'.$doc_url, $view_path)){
								echo "upload html to OSS failed.";
								return;
							}
							$this->file->del_dir_file(self::$view_path);
						}
						if( $update_doc_content ){
							//$doc_content = iconv('GB2312', 'UTF-8//IGNORE', $doc_content);
							$doc_content = $this->trim_whitespace($doc_content);
						}
					}

					if( $this->doc_model->update($doc_id, $doc_cate_id, $doc_user_id, $doc_dl_forbidden, $update_doc_content, $doc_content, $update_doc_html) ){
						// redirect(cii_base_url('doc/detail/'.$doc_id));
					}
				}
			}
		}
		echo "Task Success.";
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