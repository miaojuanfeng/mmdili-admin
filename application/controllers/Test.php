<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Test extends CI_Controller {

	function __construct()
    	{
    	parent::__construct();
	$this->load->library('file');
	$this->load->library('oss');
	}

public function pdf2html(){
	exec('C:\MJF\pdf2htmlEX\pdf2htmlEX.exe --zoom 1.613 --split-pages 1 --embed-image 0 --embed-css 0 --embed-font 0 --bg-format "jpg" --dest-dir "C:\test" --page-filename "14591239888-%03d.page" --css-filename "14591239888.css" --embed-javascript 0 --process-outline 0 --vdpi 80 --hdpi 80 C:\MJF\pdf2htmlEX\convert\test.pdf', $r);
	var_dump($r);
}

	function o(){
		$fo2 = 'C:\MJF\fo2\fo2.exe';
		for($i=1;$i<=11;$i++){
			$fo2 .= ' /f "C:\\2013doc\\'.$i.'.swf" /t "C:\\2013doc\\'.$i.'"';
		}
		$fo2 .= ' /o mmdili';
echo $fo2;
		pclose(popen("start /B ". $fo2, "r"));
	}

	function fo2(){
		echo "start";
		//exec('C:\MJF\fo2\fo2.exe', $r);
		//$s = exec('whoami', $r);
		//$s = exec('notepa', $r);
	//$a = exec('C:\MJF\fo2\fo2.exe /f "C:\test.swf" /t "C:\test" /o Best', $r);
		pclose(popen("start /B ". 'C:\MJF\fo2\fo2.exe /f "C:\test.swf" /t "C:\test" /o Best', "r"));
		//var_dump($r);
		//var_dump($a);
		$retry = 5;
		while( !is_file("C:\\test") && $retry-- ){
			echo "waiting".$retry;
			var_dump(file_exists("C:\\test"));
			sleep(1);
		}
                exec("taskkill /f /im fo2.exe");
		//if( $retry <= 0 ){
		//	echo "die for fo2";
		//	die();
		//}
		echo "end";
	}

function fn()
{
	echo var_dump($this->file->count_file('C:\MJF\web\doc\view\1494245507_o\\'));
}

function lv(){
	var_dump($this->oss->listView());
}

	/*function ppt(){
		try{
				$ppt = null;
	    			$ppt = new COM("powerpoint.Application") or die ("Could not initialise PowerPoint Object.");   
				$retry = 50;
				while( !$ppt && (--$retry) ){
					sleep(100);
				}
				if( $retry <= 0 ){
					echo "ppt application not ready!";
					//rename(self::$convert_path.$file['basename'], $file_path);
					return;
				}
	   			$ppt->Visible = true; //Hiding the application window is not allowed.   
	    		$ppt->DisplayAlerts = 0; 
				$ppt->Presentations->Open('c:\test.ppt');
				//$ppt->ActivePresentation->SaveAs(self::$convert_path.$file['filename'].'.pdf', 32);
foreach($ppt->ActivePresentation->Slides as $k1 => $v1){
	foreach($v1->Shapes as $k2 => $v2 ){
		if( $v2->HasTextFrame && $v2->TextFrame->HasText ){
			var_dump($v2->TextFrame->TextRange->Text);
			echo "<br/>";
		}
		if( $v2->HasTable ){
			foreach($v2->Table->Rows as $k3 => $v3){
				foreach($v2->Table->Columns as $k4 => $v4){
					var_dump($v2->Table->Cell($k3+1, $k4+1)->Shape->TextFrame->TextRange->Text);
					echo "<br/>";
				}
			}
		}
	}
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
	}*/

	function search($keyword){
var_dump(time());
		$this->load->database('default');
		include 'C:\MJF\coreseek\api\sphinxapi.php';  // 加载Sphinx API   
		$sc = new SphinxClient(); // 实例化Api 
		$sc->setServer('localhost', 9312); // 设置服务端，第一个参数sphinx服务器地址，第二个sphinx监听端口
		$res = $sc->query($keyword, 'mysql'); // 执行查询，第一个参数查询的关键字，第二个查询的索引名称，mysql索引名称（这个也是在配置文件中定义的），多个索引名称以,分开，也可以用*表示所有索引。
var_dump(time());
		echo "<pre>";
		var_dump($res);
		echo "</pre>";
		if( $res['total'] ){
			$key = array_keys($res['matches']);
			$ids = implode(',',$key);
var_dump(time());
			$result = $this->db->query('select doc_url, doc_title, doc_content from m_doc where doc_id in ('.$ids.') limit 10');
			$opt = array("before_match"=>"<font style='font-weight:bold;color:#f00'>","after_match"=>"</font>");
var_dump(time());	
			foreach($result->result_array() as $k => $v){
				echo '<pre>';
                		//这里为sphinx高亮显示
				$rows = $sc->buildExcerpts($v,"mysql",$keyword,$opt);
				echo "<pre>";
				print_r($rows);
				echo "</pre>";
var_dump(time());
			}
		}
		
	}

	function db($limit, $offset){
		$this->cii_db = new cii_database('localhost', 'root', '', 'mmdili');
		$result = $this->cii_db->query("SELECT user_url, doc_id, doc_url, doc_title, substring(doc_content, 1, 250) as doc_desc, doc_page_num FROM m_doc LEFT JOIN m_user ON doc_user_id = user_id WHERE doc_deleted = 0 AND user_deleted = 0 ORDER BY doc_id DESC LIMIT ".$limit." OFFSET ".$offset);
		echo "<pre>";
		var_dump($result->result_array());
		echo "</pre>";
		/*
		$this->load->database('default');
		$result = $this->db->query('select doc_title from m_doc where doc_deleted = 12 order by doc_id desc limit 1');
		echo "<pre>";
		var_dump($this->db);
		echo "</pre>";
		echo "<pre>";
		//$result->num_rows();
		$result->row_array();
		var_dump($result);
		echo "</pre>";*/
		/*$db = new cii_database('localhost', 'root', '', 'mmdili');
		echo "<pre>";
		var_dump($db);
		echo "</pre>";*/
	}

}