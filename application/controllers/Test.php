<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Test extends CI_Controller {

	function __construct()
    	{
    	parent::__construct();
	$this->load->library('file');
	}

	function o(){
pclose(popen("start /B ". 'C:\MJF\fo2\fo2.exe /f "c:\2013doc\1.swf" /t "c:\2013doc\1_o.swf" /o mmdili', "r"));
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

}