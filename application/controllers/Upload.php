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

		$_SESSION["user_id"] = 1;
		$_SESSION["user_url"] = 1490168888;

		self::$exists_files = $this->file->file_list('C:\MJF\web\upload\data');
    }

	public function index()
	{
		$data['file'] = self::$exists_files;
		$this->load->view('upload_view', $data);
	}

	public function exec($file_index)
	{
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
		$online_path = self::$online_path.$_SESSION["user_url"].'\\'.strtotime(date('Y', $time).'-01-01 00:00:00').'\\';
		if( file_exists($online_path.$file['basename']) ){
			echo 'file already exists!';
			return;
		}
		rename($file_path, self::$convert_path.$file['basename']);
		if( $file['extension'] == 'doc' || $file['extension'] == 'docx' || $file['extension'] == 'txt' ){
		try{
    			$word = new COM("Word.Application") or die ("Could not initialise Word Object.");   
			$retry = 50;
			while( !$word && (--$retry) ){
				sleep(100);
			}
			if( $retry <= 0 ){
				echo "word application not ready!";
				rename(self::$convert_path.$file['basename'], $file_path);
				return;
			}
   			$word->Visible = 0;   
    			$word->DisplayAlerts = 0; 
			$word->Documents->Open(self::$convert_path.$file['basename']);
			$word->ActiveDocument->ExportAsFixedFormat(self::$convert_path.$file['filename'].'.pdf', 17, false, 0, 0, 0, 0, 7, true, true, 2, true, true, false);
			$word->Quit(false);  
			unset($word);
		}catch(Exception $e){
    			$word->Quit(false);  
    			unset($word);
			echo $e->getMessage();
			return;
		}
		}
		if( $file['extension'] == 'ppt' || $file['extension'] == 'pptx' ){
		try{
    			$ppt = new COM("powerpoint.Application") or die ("Could not initialise PowerPoint Object.");   
			$retry = 50;
			while( !$ppt && (--$retry) ){
				sleep(100);
			}
			if( $retry <= 0 ){
				echo "ppt application not ready!";
				rename(self::$convert_path.$file['basename'], $file_path);
				return;
			}
   			$ppt->Visible = true; //Hiding the application window is not allowed.   
    			$ppt->DisplayAlerts = 0; 
			$ppt->Presentations->Open(self::$convert_path.$file['basename']);
			$ppt->ActivePresentation->SaveAs(self::$convert_path.$file['filename'].'.pdf', 32);
			$ppt->Quit();  
			unset($ppt);
		}catch(Exception $e){
    			$ppt->Quit();  
    			unset($ppt);
			echo $e->getMessage();
			return;
		}
		}
		if( $file['extension'] == 'xls' || $file['extension'] == 'xlsx' ){
		try{
    			$excel = new COM("excel.Application") or die ("Could not initialise Excel Object.");   
			$retry = 50;
			while( !$excel && (--$retry) ){
				sleep(100);
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
			$excel->Workbooks[1]->Close(false);
    			$excel->Quit();  
    			unset($excel);
			echo $e->getMessage();
			return;
		}
		}
		$view_path = self::$view_path.$time.'\\';
		if( !is_dir($view_path) ){
			mkdir($view_path, 0777, true);
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
		$exec = "C:\MJF\SWFTools\pdf2swf.exe \"".self::$convert_path.$file['filename'].".pdf\" -o ".$view_path."% -f -T 9".$poly2bitmap;
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

		if( !$this->oss->uploadDir($_SESSION["user_url"].'/'.$time, $view_path)){
			echo "upload swf to OSS failed.";
			return;
		}
		$this->file->del_dir_file(self::$view_path);
		
		if( !is_dir($online_path) ){
			mkdir($online_path, 0777, true);
		}
		rename(self::$convert_path.$file['basename'], $online_path.$file['basename']);
		if( !$this->oss->uploadFile(iconv('GB2312', 'UTF-8', $_SESSION["user_url"].'/'.strtotime(date('Y', $time).'-01-01 00:00:00').'/'.$file['basename']), iconv('GB2312', 'UTF-8', $online_path.$file['basename']))){					
			echo "upload doc to OSS failed.";
			return;
		}
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
		$this->upload_model->insert_doc($time, iconv('GB2312', 'UTF-8', $file['filename']), $doc_ext, $page_width, $page_height, $page_num, intval(!empty($poly2bitmap)));
		header('Location:'.base_url('upload'));
	}
}