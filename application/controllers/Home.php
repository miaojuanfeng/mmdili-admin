<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {

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
	private static $view_path = 'C:\MJF\web\doc\convert\\';
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

	public function __construct()
    {
    	parent::__construct();
    	$this->load->helper('url');
    	// $this->load->model('home_model');
    	$this->load->library('file');

	self::$exists_files = $this->file->file_list('C:\MJF\web\upload\data');
    }

	public function index()
	{
		$data['file'] = self::$exists_files;
		$this->load->view('home_view', $data);
	}

	public function exec($file_index)
	{
		if(!count(self::$exists_files) || !isset(self::$exists_files[$file_index])){
			echo 'index not exists!';
			return;
		}
		$file_path = iconv('UTF-8','GB2312',self::$exists_files[$file_index]['file_dir']);
		if( !file_exists($file_path) ){
			echo 'file not exists!';
			return;
		}
		$file = $this->mb_pathinfo($file_path);
		rename($file_path, self::$convert_path.$file['basename']);
		try{
    			$word = new COM("Word.Application") or die ("Could not initialise Object.");   
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
		$exec = ".\C:\MJF\SWFTools\pdf2swf.exe ".self::$convert_path.$file['filename'].".pdf -o ".self::$view_path."%.swf -f -T 9";
		exec($exec, $pdf_info);
		var_dump($pdf_info);
		//rename(self::$convert_path.$file['basename'], self::$online_path.$file['basename']);
	}
}
