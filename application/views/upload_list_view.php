<!DOCTYPE html>
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" /> 
	<title>文件夹</title>
	<?php require_once "meta_view.php" ?>
</head>
<body>
	<?php require_once "sidebar_view.php" ?>
	<div class="main-container">
		<?php require_once "header_view.php" ?>
		<div class="content">
			<div class="list">
				<input type="hidden" name="file" />
				<?php
				foreach($file as $k => $v){
				?>
				<div class="item upload">
					<a class="upload-file" href="<?=base_url('upload/detail/'.$k)?>">
						<div class="file-name"><?=$v['file_name']?></div>
						<div class="file-dir"><?=$v['file_dir']?></div>
					</a>
				</div>
				<?php
				}
				?>
			</div>
		</div>
	</div>
</body>
</html>