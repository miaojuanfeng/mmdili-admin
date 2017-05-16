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
				<div class="item upload" <?=base_url('doc/detail/'.$v['doc_id'])?>>
					<a class="upload-file load-view" href="javascript:;">
						<div class="file-name"><?=$v['doc_title']?></div>
						<div class="file-dir"><?=$v['doc_desc']?></div>
					</a>
					<div class="view-detail">
						<p class="view-loading" style="text-align:center;display:none;">Loading...</p>
					</div>
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
<script type="text/javascript">
	$('.load-view').click(function(){
		if( $(this).next('.view-detail').is(":visible") ){
			$(this).next('.view-detail').hide();
		}else{
			$(this).next('.view-detail').show();

			$.post('<?=base_url('doc/load')?>', {user_url: '1490168888', date_url: '1491409463'}, function(data){
				console.log(data);
			});
		}
	});
</script>