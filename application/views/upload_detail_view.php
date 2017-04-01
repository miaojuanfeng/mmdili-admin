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
			<form action="<?=base_url('upload/exec/'.$file_index)?>" method="post" class="list">
				<input type="hidden" name="file" />
				<?php
				var_dump($file);
				?>
				<div class="item upload">
					<div class="upload-detail-file ">
						<div class="file-name"><?=$file['file_name']?></div>
					</div>
					<div class="upload-detail-act">
						<button type="submit" class="">Exec</button>
					</div>
				</div>
			</form>
		</div>
	</div>
</body>
</html>