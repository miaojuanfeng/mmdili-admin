<!DOCTYPE html>
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" /> 
	<title>mmTeacher</title>
	<?php require_once "meta_view.php" ?>
</head>
<body>
	<?php require_once "sidebar_view.php" ?>
	<div class="main-container">
		<?php require_once "header_view.php" ?>
		<div class="content">
			<div class="list">
				<?php
				foreach($file as $k => $v){
				?>
				<div class="item task">
					<div class="task-file">
						<div class="file-name"><?=$v?></div>
						<div class="file-dir"><?=$k?></div>
					</div>
					<div class="task-act">
						<a href="<?=base_url('home/exec/'.'{'.urlencode($k).'}')?>">Exec</a>
					</div>
					<div class="clearfix"></div>
				</div>
				<?php
				}
				?>
			</div>
		</div>
	</div>
</body>
</html>