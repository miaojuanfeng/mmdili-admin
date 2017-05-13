<!DOCTYPE html>
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" /> 
	<title>馆藏库</title>
	<?php require_once "meta_view.php" ?>
</head>
<body>
	<?php require_once "sidebar_view.php" ?>
	<div class="main-container">
		<?php require_once "header_view.php" ?>
		<div class="content">
			<div class="list">
				<?php
				foreach($doc['doc'] as $k => $v){
				?>
				<div class="item upload">
					<a class="upload-file" href="<?=base_url('doc/detail/'.$v['doc_id'])?>">
						<div class="file-name"><?=$v['doc_title']?></div>
					</a>
				</div>
				<?php
				}
				?>
			</div>
			<?=$this->cii_pagination->create_links($this->uri->segment(3))?>
		</div>
	</div>
</body>
</html>
<style type="text/css">
	.pn .pn-container {
  float: right; }
  .pn .pn-container span {
    float: left;
    margin-left: 10px;
    font-size: 14px;
    line-height: 24px; }
    .pn .pn-container span a {
      display: block;
      padding: 2px 10px;
      color: #747474;
      background-color: #EDF2F8; }
      .pn .pn-container span a:hover {
        background-color: #a4bddb;
        color: #FFF; }
    .pn .pn-container span.current {
      padding: 2px 10px;
      background-color: #a4bddb;
      color: #FFF; }
</style>