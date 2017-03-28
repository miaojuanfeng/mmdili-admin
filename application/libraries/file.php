<?php
class File{
	private $except_dir = array('.', '..', 'system', 'desktop', 'data', 'recycle', 'temp', 'session');
	private $require_ext = array('doc', 'docx', 'pdf', 'ppt', 'pptx');

	public function file_list($path)
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
					if( in_array($file, $this->except_dir) ) continue 1;
					$real_path = str_replace(DIRECTORY_SEPARATOR.DIRECTORY_SEPARATOR, DIRECTORY_SEPARATOR, $path.DIRECTORY_SEPARATOR.$file);
					if( is_file($real_path) && in_array(pathinfo($file, PATHINFO_EXTENSION), $this->require_ext) ){
						$result[] = array(
							'file_name' => iconv('GB2312', 'UTF-8', $file),
							'file_dir' => iconv('GB2312', 'UTF-8', $real_path)
						);
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

	/**
 * 删除目录及目录下所有文件
 * @param str $path   待删除目录路径
 */
 public function del_dir_file($path) {
    $op = dir($path);
    while(false != ($item = $op->read())) {
        if($item == '.' || $item == '..') {
            continue;
        }
        if(is_dir($op->path.'/'.$item)) {
            $this->del_dir_file($op->path.'/'.$item);
            rmdir($op->path.'/'.$item);
        } else {
            unlink($op->path.'/'.$item);
        }
    
    } 
 }
}