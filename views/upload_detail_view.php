﻿<!DOCTYPE html>
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
			<form action="<?=cii_base_url('upload/exec_html')?>" method="post" class="list">
				<input type="hidden" name="file_index" value="<?=$file_index?>" />
				<div class="item upload">
					<div class="upload-detail-file ">
						<div class="file-name"><?=$file['file_name']?></div>
						<div class="file-dir"><?=$file['file_dir']?></div>
						<div class="info-item">
							<select name="doc_cate_id">
								<option value="1" selected="selected">地理</option>
								<option value="2">历史</option>
								<option value="3">政治</option>
								<option value="4">文综</option>
								<option value="5">语文</option>
								<option value="6">数学</option>
								<option value="7">外语</option>
								<option value="8">计算机</option>
								<option value="9">申论精品文章</option>
							</select>
						</div>
						<div class="info-item">
							<select name="doc_dl_forbidden">
								<option value="0" selected="selected">可以下载</option>
								<option value="1">禁止下载</option>
							</select>
						</div>
						<div class="info-item">
							<select name="doc_user_id">
								<option value="1">M.J.F</option>
								<option value="2" selected="selected">MCMM</option>
								<option value="3">学业の回忆</option>
								<option value="4">梁文凯</option>
								<option value="5">校园往事</option>
								<option value="6">陈济天</option>
							</select>
						</div>
						<div class="upload-detail-act">
							<button type="submit" class="exec">Exec</button>
						</div>
					</div>
				</div>
			</form>
		</div>
	</div>
</body>
</html>