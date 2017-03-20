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
				<input type="hidden" name="file" />
				<?php
				foreach($file as $k => $v){
				?>
				<div class="item task">
					<div class="task-file">
						<div class="file-name"><?=$v?></div>
						<div class="file-dir"><?=$k?></div>
					</div>
					<div class="task-act">
						<a class="exec" href="javascript:;" file-dir="<?=$k?>">Exec</a>
					</div>
					<div class="clearfix"></div>
				</div>
				<?php
				}
				?>
			</div>
			<script type="text/javascript">
			$('.exec').click(function(){
				var file = $(this).attr('file-dir');
				$.post("<?=base_url('home/exec')?>", {file: file}, function(data){
					alert(data);
				});
			});
			</script>
		</div>
	</div>
</body>
</html>