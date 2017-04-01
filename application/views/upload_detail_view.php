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
				echo $file;
				?>
				<div class="item task">
					<div class="task-file">
						<div class="file-name"><?=$file?></div>
					</div>
					<div class="task-act">
						<button type="submit">Exec</button>
					</div>
				</div>
			</form>
		</div>
	</div>
</body>
</html>