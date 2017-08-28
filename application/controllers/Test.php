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
		include 'C:\MJF\coreseek\api\sphinxapi.php';  // ¼ÓÔØSphinx API   
		$sc = new SphinxClient(); // ÊµÀý»¯Api 
		$sc->setServer('localhost', 9312); // ÉèÖÃ·þÎñ¶Ë£¬µÚÒ»¸ö²ÎÊýsphinx·þÎñÆ÷µØÖ·£¬µÚ¶þ¸ösphinx¼àÌý¶Ë¿Ú
		$res = $sc->query($keyword, 'mysql'); // Ö´ÐÐ²éÑ¯£¬µÚÒ»¸ö²ÎÊý²éÑ¯µÄ¹Ø¼ü×Ö£¬µÚ¶þ¸ö²éÑ¯µÄË÷ÒýÃû³Æ£¬mysqlË÷ÒýÃû³Æ£¨Õâ¸öÒ²ÊÇÔÚÅäÖÃÎÄ¼þÖÐ¶¨ÒåµÄ£©£¬¶à¸öË÷ÒýÃû³ÆÒÔ,·Ö¿ª£¬Ò²¿ÉÒÔÓÃ*±íÊ¾ËùÓÐË÷Òý¡£
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
                		//ÕâÀïÎªsphinx¸ßÁÁÏÔÊ¾
				$rows = $sc->buildExcerpts($v,"mysql",$keyword,$opt);
				echo "<pre>";
				print_r($rows);
				echo "</pre>";
var_dump(time());
			}
		}
		
	}

	function input(){
		echo "<pre>";
		var_dump($this->input->get('sa'));
		echo "</pre>";
		
	}

	function uri(){
		$uri = new cii_uri();
		var_dump($uri);
	}
	function str(){
		$db = new cii_database('localhost', 'root', '', 'mmdili');
		var_dump($db->escape_str("select * from mmdili where a = 'asd'"));
	}
	function font(){
		exec('font-spider C:\MJF\web\doc\view\1500619408\index.html', $log, $status);
		var_dump($log);
		var_dump($status);
	}
        function phpinfo(){
		phpinfo();
	}
	function simhash($id1 = 0, $id2 = 0){
		require 'application/libraries/pscws4/pscws4.class.php';

		$pscws = new PSCWS4('utf8');
		$pscws->set_dict('application/libraries/pscws4/etc/dict.utf8.xdb');
		$pscws->set_rule('application/libraries/pscws4/etc/rules.utf8.ini');

		$s = new simhash();

		$data['text1'] = array();
		$data['text1']['content'] = '';
		$data['text1']['kw'] = '';
		$data['text1']['sign'] = '';
		$data['text2'] = array();
		$data['text2']['content'] = '';
		$data['text2']['kw'] = '';
		$data['text2']['sign'] = '';
		$data['compare'] = '';
		$data['hamming'] = '';

		$text1 = $this->input->post('text1');
		$text2 = $this->input->post('text2');

		if( $id1 && $id2 ){
			$this->load->model('test_model');
			$doc1 = $this->test_model->get_detail($id1);
			$doc2 = $this->test_model->get_detail($id2);

			$text1 = strip_tags($doc1['doc_content']);
			$text2 = strip_tags($doc2['doc_content']);
		}

		if( $text1 ){
			$pscws->send_text($text1);
			$kw1 = array();
			foreach ($pscws->get_tops(100) as $key => $value) {
				if( !is_numeric($value['word']) ){
					$kw1[$value['word']] = $value['weight'];
				}
			}
			$sign1 = $s->sign($kw1);
			$data['text1']['content'] = $text1;
			$data['text1']['kw'] = $kw1;
			$data['text1']['sign'] = $sign1;
		}

		if( $text2 ){
			$pscws->send_text($text2);
			$kw2 = array();
			foreach ($pscws->get_tops(100) as $key => $value) {
				if( !is_numeric($value['word']) ){
					$kw2[$value['word']] = $value['weight'];
				}
			}
			$sign2 = $s->sign($kw2);
			$data['text2']['content'] = $text2;
			$data['text2']['kw'] = $kw2;
			$data['text2']['sign'] = $sign2;
		}

		if( !empty($sign1) && !empty($sign2) ){
			$data['compare'] = $s->compare($sign1, $sign2);
			$data['hamming'] = $s->hamming($data['compare']);
		}
		
		$this->load->view('test/simhash_view', $data);
	}

	public function dohash(){
		$this->load->database('default');

		require 'application/libraries/pscws4/pscws4.class.php';

		$pscws = new PSCWS4('utf8');
		$pscws->set_dict('application/libraries/pscws4/etc/dict.utf8.xdb');
		$pscws->set_rule('application/libraries/pscws4/etc/rules.utf8.ini');

		$simhash = new simhash();

		$doc = $this->db->query("SELECT doc_id, doc_content FROM m_doc ORDER BY doc_id ASC LIMIT 1")->result_array();
		foreach ($doc as $key => $value) {
			$doc_id = $value["doc_id"];
			$doc_content = strip_tags($value["doc_content"]);
			$pscws->send_text($doc_content);
			$kw = array();
			foreach ($pscws->get_tops(100) as $key => $value) {
				if( !is_numeric($value['word']) ){
					$kw[$value['word']] = $value['weight'];
				}
			}
			echo "<pre>";
			var_dump($kw);
			$doc_simhash = $simhash->sign($kw);
			var_dump($doc_simhash);
			$this->db->query("UPDATE m_doc set doc_simhash = '".$doc_simhash."' WHERE doc_id = ".$doc_id);
		}
	}

}