<?php
class Task{
	private static $except_dir = array('.', '..', 'system', 'desktop', 'data', 'recycle', 'temp', 'session');

	public static function file_list($path)
	{
		$result = array();
		$queue = array($path);
		while($data = each($queue))
		{
			$path = $data['value'];
			$handle = null;
			if (is_dir($path) && $handle = opendir($path)) 
			{
				while (FALSE !== ($file = readdir($handle))) 
				{
					if( in_array($file, self::$except_dir) ) continue 1;
					$real_path = str_replace(DIRECTORY_SEPARATOR.DIRECTORY_SEPARATOR, DIRECTORY_SEPARATOR, $path.DIRECTORY_SEPARATOR.$file);
					if(is_file($real_path)){
						$result[] = $real_path;
					}
					if (is_dir($real_path)){
						$queue[] = $real_path;
					}
				}
			}
			if($handle){
				closedir($handle);
			}
		}
		return $result;
	}
}

echo json_encode(Task::file_list('C:\MJF\web\upload\data'));