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
			<form action="<?=cii_base_url('doc/update')?>" method="post" class="list">
				<input type="hidden" name="doc_id" value="<?=$doc['doc_id']?>" />
				<input type="hidden" name="doc_url" value="<?=$doc['doc_url']?>" />
				<input type="hidden" name="user_url" value="<?=$doc['user_url']?>" />
				<input type="hidden" name="file_path" value="<?=$doc['user_url'].'\\'.strtotime(date('Y', $doc['doc_url']).'-01-01 00:00:00').'\\'.$doc['doc_title'].'.'.$doc['doc_ext_name']?>" />
				<div class="item upload">
					<div class="upload-detail-file ">
						<div class="file-name"><?=$doc['doc_title']?></div>
						<div class="file-dir"><?=$doc['doc_desc']?></div>
						<div class="info-item">
							<select name="doc_cate_id">
								<option value="1" <?php if($doc['doc_cate_id']==1) echo "selected='selected'"; ?>>地理</option>
								<option value="2" <?php if($doc['doc_cate_id']==2) echo "selected='selected'"; ?>>历史</option>
								<option value="3" <?php if($doc['doc_cate_id']==3) echo "selected='selected'"; ?>>政治</option>
								<option value="4" <?php if($doc['doc_cate_id']==4) echo "selected='selected'"; ?>>文综</option>
								<option value="5" <?php if($doc['doc_cate_id']==5) echo "selected='selected'"; ?>>语文</option>
								<option value="6" <?php if($doc['doc_cate_id']==6) echo "selected='selected'"; ?>>数学</option>
								<option value="7" <?php if($doc['doc_cate_id']==7) echo "selected='selected'"; ?>>外语</option>
								<option value="8" <?php if($doc['doc_cate_id']==8) echo "selected='selected'"; ?>>计算机</option>
								<option value="9" <?php if($doc['doc_cate_id']==9) echo "selected='selected'"; ?>>申论精品文章</option>
							</select>
						</div>
						<div class="info-item">
							<select name="doc_dl_forbidden">
								<option value="0" <?php if($doc['doc_dl_forbidden']==0) echo "selected='selected'"; ?>>可以下载</option>
								<option value="1" <?php if($doc['doc_dl_forbidden']==1) echo "selected='selected'"; ?>>禁止下载</option>
							</select>
						</div>
						<div class="info-item">
							<input type="hidden" name="doc_user_id" value="<?=$doc['doc_user_id']?>" />
							<select name="doc_user_id" disabled="disabled">
								<option value="1" <?php if($doc['doc_user_id']==1) echo "selected='selected'"; ?>>M.J.F</option>
								<option value="2" <?php if($doc['doc_user_id']==2) echo "selected='selected'"; ?>>MCMM</option>
								<option value="3" <?php if($doc['doc_user_id']==3) echo "selected='selected'"; ?>>学业の回忆</option>
								<option value="4" <?php if($doc['doc_user_id']==4) echo "selected='selected'"; ?>>梁文凯</option>
								<option value="5" <?php if($doc['doc_user_id']==5) echo "selected='selected'"; ?>>校园往事</option>
								<option value="6" <?php if($doc['doc_user_id']==6) echo "selected='selected'"; ?>>陈济天</option>
							</select>
						</div>
						<div class="info-item">
							<input type="checkbox" name="update_doc_content" value="1">更新文档内容
						</div>
						<div class="info-item">
							<input type="checkbox" name="update_doc_view" value="1">更新文档视图
						</div>
						<div class="info-item">
							<input type="checkbox" name="update_doc_html" value="1">更新文档Html
						</div>
						<div class="upload-detail-act">
							<button type="submit" class="exec">Update</button>
						</div>
					</div>
				</div>
			</form>
		</div>
	</div>
</body>
</html>