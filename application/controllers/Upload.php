<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Upload extends CI_Controller {

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
	private static $exists_files = array();
	private static $convert_path = 'C:\MJF\web\doc\convert\\';
	private static $view_path = 'C:\MJF\web\doc\view\\';
	private static $online_path = 'C:\MJF\web\doc\online\\';

	private function path_info($filepath){   
	    $path_parts = array();   
	    $path_parts ['dirname'] = rtrim(substr($filepath, 0, strrpos($filepath, '/')),"/")."/";   
	    $path_parts ['basename'] = ltrim(substr($filepath, strrpos($filepath, '/')),"/");   
	    $path_parts ['extension'] = substr(strrchr($filepath, '.'), 1);   
	    $path_parts ['filename'] = ltrim(substr($path_parts ['basename'], 0, strrpos($path_parts ['basename'], '.')),"/");   
	    return $path_parts;   
	}

	private function mb_pathinfo($filepath) {
	    preg_match('%^(.*?)[\\\\/]*(([^/\\\\]*?)(\.([^\.\\\\/]+?)|))[\\\\/\.]*$%im',$filepath,$m);
	    if($m[1]) $ret['dirname']=$m[1];
	    if($m[2]) $ret['basename']=$m[2];
	    if($m[5]) $ret['extension']=$m[5];
	    if($m[3]) $ret['filename']=$m[3];
	    return $ret;
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

	function __construct()
    {
    	parent::__construct();
    	$this->load->helper('url');
    	$this->load->model('upload_model');
    	$this->load->library('file');
		$this->load->library('oss');

		if( !is_dir(self::$convert_path) ){
			mkdir(self::$convert_path);
		}
		if( !is_dir(self::$view_path) ){
			mkdir(self::$view_path);
		}
		if( !is_dir(self::$online_path) ){
			mkdir(self::$online_path);
		}

		$this->user_url = array(1 => 1490176666, 2 => 1490168888);

		self::$exists_files = $this->file->file_list('C:\MJF\web\upload\data');
    }

	public function index()
	{
		$data['file'] = self::$exists_files;
		$this->load->view('upload_list_view', $data);
	}

	public function detail($file_index){
		if(!count(self::$exists_files) || !isset(self::$exists_files[$file_index])){
			echo 'index not exists!';
			return;
		}
		$data['file_index'] = $file_index;
		$data['file'] = self::$exists_files[$file_index];

		$this->load->view('upload_detail_view', $data);
	}

	public function exec()
	{
		$file_index       = $this->input->post('file_index');
		$doc_cate_id      = $this->input->post('doc_cate_id');
		$doc_dl_forbidden = $this->input->post('doc_dl_forbidden');
		$doc_user_id      = $this->input->post('doc_user_id');
		$doc_content      = "";
		if( ($file_index != 0 && empty($file_index)) || empty($doc_cate_id) ){
			echo 'paremeters wrong!';
			return;
		}
		if(!count(self::$exists_files) || !isset(self::$exists_files[$file_index])){
			echo 'index not exists!';
			return;
		}
		$file_path = iconv('UTF-8', 'GB2312', self::$exists_files[$file_index]['file_dir']);
		if( !file_exists($file_path) ){
			echo 'file not exists!';
			return;
		}
		$file = $this->mb_pathinfo($file_path);
		if( !$this->upload_model->check_doc_exists(iconv('GB2312', 'UTF-8', $file['filename'])) ){
			echo 'database record already exists!';
			return;
		}
		$time = time();
		$online_path = self::$online_path.$this->user_url[$doc_user_id].'\\'.strtotime(date('Y', $time).'-01-01 00:00:00').'\\';
		if( file_exists($online_path.$file['basename']) ){
			echo 'file already exists!';
			return;
		}
		rename($file_path, self::$convert_path.$file['basename']);
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
					rename(self::$convert_path.$file['basename'], $file_path);
					return;
				}
	   			$word->Visible = 0;   
	    		$word->DisplayAlerts = 0; 
				$word->Documents->Open(self::$convert_path.$file['basename']);
				$doc_content = $word->ActiveDocument->content->Text;
				$word->ActiveDocument->ExportAsFixedFormat(self::$convert_path.$file['filename'].'.pdf', 17, false, 0, 0, 0, 0, 7, true, true, 2, true, true, false);
				$word->Quit(false);  
				unset($word);
			}catch(Exception $e){
				if( $word ){
	    			$word->Quit(false);  
	    			unset($word);
				}
				rename(self::$convert_path.$file['basename'], $file_path);
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
					rename(self::$convert_path.$file['basename'], $file_path);
					return;
				}
	   			$ppt->Visible = true; //Hiding the application window is not allowed.   
	    		$ppt->DisplayAlerts = 0; 
				$ppt->Presentations->Open(self::$convert_path.$file['basename']);
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
				$ppt->ActivePresentation->SaveAs(self::$convert_path.$file['filename'].'.pdf', 32);
				$ppt->Quit();  
				unset($ppt);
			}catch(Exception $e){
				if( $ppt ){
	    			$ppt->Quit();  
	    			unset($ppt);
				}
				rename(self::$convert_path.$file['basename'], $file_path);
				echo $e->getMessage();
				return;
			}
		}
		if( $file['extension'] == 'xls' || $file['extension'] == 'xlsx' ){
			try{
				$excel = null;
	    			$excel = new COM("excel.Application") or die ("Could not initialise Excel Object.");   
				$retry = 60;
				while( !$excel && (--$retry) ){
					sleep(1);
				}
				if( $retry <= 0 ){
					echo "excel application not ready!";
					rename(self::$convert_path.$file['basename'], $file_path);
					return;
				}
	   			$excel->Visible = 1;   
	    		$excel->DisplayAlerts = 0; 
				$excel->Workbooks->Open(self::$convert_path.$file['basename']);
				$excel->Workbooks[1]->ExportAsFixedFormat(0, self::$convert_path.$file['filename'].'.pdf');
				$excel->Workbooks[1]->Close(false);
				$excel->Quit();  
				unset($excel);
			}catch(Exception $e){
				if( $excel ){
				$excel->Workbooks[1]->Close(false);
	    			$excel->Quit();  
	    			unset($excel);
				}
				rename(self::$convert_path.$file['basename'], $file_path);
				echo $e->getMessage();
				return;
			}
		}
		$view_path = self::$view_path.$time.'\\';
		$view_optimizer_path = self::$view_path.$time.'_o'.'\\';
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

		if( !$this->oss->uploadDir($this->user_url[$doc_user_id].'/'.$time, $view_optimizer_path)){
			echo "upload swf to OSS failed.";
			return;
		}
		$this->file->del_dir_file(self::$view_path);
		
		if( !is_dir($online_path) ){
			mkdir($online_path, 0777, true);
		}
		
		if( !$this->oss->uploadFile(iconv('GB2312', 'UTF-8', $this->user_url[$doc_user_id].'/'.strtotime(date('Y', $time).'-01-01 00:00:00').'/'.$file['basename']), iconv('GB2312', 'UTF-8', self::$convert_path.$file['basename'])) ){					
			echo "upload doc to OSS failed.";
			return;
		}
		rename(self::$convert_path.$file['basename'], $online_path.$file['basename']);

		$doc_content = iconv('GB2312', 'UTF-8//IGNORE', $doc_content);
		$doc_content = $this->trim_whitespace($doc_content);
		switch($file['extension']){
			case 'doc':
				$doc_ext = 1;
				break;
			case 'docx':
				$doc_ext = 2;
				break;
			case 'pdf':
				$doc_ext = 3;
				break;
			case 'ppt':
				$doc_ext = 4;
				break;
			case 'pptx':
				$doc_ext = 5;
				break;
			case 'txt':
				$doc_ext = 6;
				break;
			case 'xls':
				$doc_ext = 7;
				break;
			case 'xlsx':
				$doc_ext = 8;
				break;
			default:
				$doc_ext = 0;
				break;
		}
		$this->upload_model->insert_doc($time, iconv('GB2312', 'UTF-8', $file['filename']), $doc_content, $doc_user_id, $doc_ext, $doc_cate_id, $page_width, $page_height, $page_num, intval(!empty($poly2bitmap)), $doc_dl_forbidden);
		header('Location:'.base_url('upload'));
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

	public function exec_html()
	{
		$file_index       = $this->input->post('file_index');
		$doc_cate_id      = $this->input->post('doc_cate_id');
		$doc_dl_forbidden = $this->input->post('doc_dl_forbidden');
		$doc_user_id      = $this->input->post('doc_user_id');
		$doc_content      = "";
		if( ($file_index != 0 && empty($file_index)) || empty($doc_cate_id) ){
			echo 'paremeters wrong!';
			return;
		}
		if(!count(self::$exists_files) || !isset(self::$exists_files[$file_index])){
			echo 'index not exists!';
			return;
		}
		$file_path = iconv('UTF-8', 'GB2312', self::$exists_files[$file_index]['file_dir']);
		if( !file_exists($file_path) ){
			echo 'file not exists!';
			return;
		}
		$file = $this->mb_pathinfo($file_path);
		if( !$this->upload_model->check_doc_exists(iconv('GB2312', 'UTF-8', $file['filename'])) ){
			echo 'database record already exists!';
			return;
		}
		$time = time();
		$online_path = self::$online_path.$this->user_url[$doc_user_id].'\\'.strtotime(date('Y', $time).'-01-01 00:00:00').'\\';
		if( file_exists($online_path.$file['basename']) ){
			echo 'file already exists!';
			return;
		}
		rename($file_path, self::$convert_path.$file['basename']);
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
					rename(self::$convert_path.$file['basename'], $file_path);
					return;
				}
	   			$word->Visible = 0;   
	    		$word->DisplayAlerts = 0; 
				$word->Documents->Open(self::$convert_path.$file['basename']);
				$doc_content = $word->ActiveDocument->content->Text;
				$word->ActiveDocument->ExportAsFixedFormat(self::$convert_path.$file['filename'].'.pdf', 17, false, 0, 0, 0, 0, 7, true, true, 2, true, true, false);
				$word->Quit(false);  
				unset($word);
			}catch(Exception $e){
				if( $word ){
	    			$word->Quit(false);  
	    			unset($word);
				}
				rename(self::$convert_path.$file['basename'], $file_path);
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
					rename(self::$convert_path.$file['basename'], $file_path);
					return;
				}
	   			$ppt->Visible = true; //Hiding the application window is not allowed.   
	    		$ppt->DisplayAlerts = 0; 
				$ppt->Presentations->Open(self::$convert_path.$file['basename']);
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
				$ppt->ActivePresentation->SaveAs(self::$convert_path.$file['filename'].'.pdf', 32);
				$ppt->Quit();  
				unset($ppt);
			}catch(Exception $e){
				if( $ppt ){
	    			$ppt->Quit();  
	    			unset($ppt);
				}
				rename(self::$convert_path.$file['basename'], $file_path);
				echo $e->getMessage();
				return;
			}
		}
		if( $file['extension'] == 'xls' || $file['extension'] == 'xlsx' ){
			try{
				$excel = null;
	    			$excel = new COM("excel.Application") or die ("Could not initialise Excel Object.");   
				$retry = 60;
				while( !$excel && (--$retry) ){
					sleep(1);
				}
				if( $retry <= 0 ){
					echo "excel application not ready!";
					rename(self::$convert_path.$file['basename'], $file_path);
					return;
				}
	   			$excel->Visible = 1;   
	    		$excel->DisplayAlerts = 0; 
				$excel->Workbooks->Open(self::$convert_path.$file['basename']);
				$excel->Workbooks[1]->ExportAsFixedFormat(0, self::$convert_path.$file['filename'].'.pdf');
				$excel->Workbooks[1]->Close(false);
				$excel->Quit();  
				unset($excel);
			}catch(Exception $e){
				if( $excel ){
				$excel->Workbooks[1]->Close(false);
	    			$excel->Quit();  
	    			unset($excel);
				}
				rename(self::$convert_path.$file['basename'], $file_path);
				echo $e->getMessage();
				return;
			}
		}

		$view_path = self::$view_path.$time;

		$page_num = 0;
		$page_width = 0;
		$page_height = 0;
		$pdf_info = array();
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
		// $cmd .= ' --page-filename "'.$time.'-%03d.page"';
		// $cmd .= ' --page-filename "%03d"';
		$cmd .= ' --page-filename "%03d.html"';
		// $cmd .= ' --css-filename "'.$time.'.css"';
		$cmd .= ' --css-filename "page.min.css"';
		$cmd .= ' --embed-javascript 0';
		$cmd .= ' --process-outline 0';
		$cmd .= ' --vdpi 80';
		$cmd .= ' --hdpi 80';
		$cmd .= ' "'.self::$convert_path.$file['filename'].'.pdf"';
		exec($cmd, $r);
		if( $file['extension'] != 'pdf' ){
			unlink(self::$convert_path.$file['filename'].".pdf");
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
		$doc_content = "";
		for($i=1;$i<=$page_num;$i++){
			$file_content = file_get_contents($view_path.'\\'.sprintf("%03d.html", $i));
			//
			// preg_match_all('/<img.+src=\"?(.+\.(jpg|gif|bmp|bnp|png))\"?.+>/i', $file_content, $imgArr);
			// $file_content = str_replace($imgArr[1][0], 'http://view.mmdili.com/'.$this->user_url[$doc_user_id].'/'.$time.'/'.$imgArr[1][0], $file_content);
			//
			// preg_match_all('/<\s*img\s+[^>]*?src\s*=\s*(\'|\")(.*?)\\1[^>]*?\/?\s*>/i', $file_content, $imgArr); 
				preg_match_all('/<\s*img\s+[^>]*?class\s*=\s*(\'|\")(.*?)\\1+[^>]*?src\s*=\s*(\'|\")(.*?)\\1[^>]*?\/?\s*>/i', $file_content, $imgArr); 
				if( isset($imgArr[2][0]) && isset($imgArr[4][0]) ){
					$div = '<div class="'.$imgArr[2][0].'" style="background-image:url('.'http://view.mmdili.com/'.$this->user_url[$doc_user_id].'/'.$time.'/'.$imgArr[4][0].')"></div>';
					$file_content = str_replace($imgArr[0][0], $div, $file_content);
				}
			//
			preg_match_all('/<a .*?href="(.*?)".*?>/is', $file_content, $imgArr);
			foreach($imgArr[1] as $key => $value){
				$file_content = str_replace($value, 'javascript:;', $file_content);
			}
			file_put_contents($view_path.'\\'.sprintf("%03d.html", $i), $file_content);
			//
			if($doc_content == ""){
				$doc_content = $file_content;
			}else{
				$doc_content .= '#[page]#'.$file_content;
			}
		}
		$this->clearn_file($view_path, 'html');
		//$doc_content = iconv('GB2312', 'UTF-8//IGNORE', $doc_content);
		$doc_content = $this->trim_whitespace($doc_content);
		//
		if( !$this->oss->uploadDir($this->user_url[$doc_user_id].'/'.$time, $view_path)){
			echo "upload html to OSS failed.";
			return;
		}
		$this->file->del_dir_file(self::$view_path);
		
		if( !is_dir($online_path) ){
			mkdir($online_path, 0777, true);
		}
		
		if( !$this->oss->uploadFile(iconv('GB2312', 'UTF-8', $this->user_url[$doc_user_id].'/'.strtotime(date('Y', $time).'-01-01 00:00:00').'/'.$file['basename']), iconv('GB2312', 'UTF-8', self::$convert_path.$file['basename'])) ){					
			echo "upload doc to OSS failed.";
			return;
		}
		rename(self::$convert_path.$file['basename'], $online_path.$file['basename']);

		$doc_content = iconv('GB2312', 'UTF-8//IGNORE', $doc_content);
		$doc_content = $this->trim_whitespace($doc_content);
		switch($file['extension']){
			case 'doc':
				$doc_ext = 1;
				break;
			case 'docx':
				$doc_ext = 2;
				break;
			case 'pdf':
				$doc_ext = 3;
				break;
			case 'ppt':
				$doc_ext = 4;
				break;
			case 'pptx':
				$doc_ext = 5;
				break;
			case 'txt':
				$doc_ext = 6;
				break;
			case 'xls':
				$doc_ext = 7;
				break;
			case 'xlsx':
				$doc_ext = 8;
				break;
			default:
				$doc_ext = 0;
				break;
		}
		$this->upload_model->insert_doc($time, iconv('GB2312', 'UTF-8', $file['filename']), $doc_content, $doc_user_id, $doc_ext, $doc_cate_id, $page_width, $page_height, $page_num, intval(!empty($poly2bitmap)), $doc_dl_forbidden);
		header('Location:'.base_url('upload'));
	}
}
