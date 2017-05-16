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
					<a class="upload-file load-view" href="javascript:;">
						<div class="file-name"><?=$v['doc_title']?></div>
						<div class="file-dir"><?=$v['doc_desc']?></div>
					</a>
					<div class="view-detail" user-url="<?=$v['user_url']?>" doc-url="<?=$v['doc_url']?>">
						
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
		var mine = $(this);
		if( mine.next('.view-detail').is(':hidden') ){
			var user_url = mine.next('.view-detail').attr('user-url');
			var doc_url  = mine.next('.view-detail').attr('doc-url');

			mine.next('.view-detail').show();

			mine.next('.view-detail').append('<p class="view-loading" style="text-align:center;">Loading...</p>');
			$.post('<?=base_url('doc/load')?>', {user_url: user_url, doc_url: doc_url}, function(data){
				data = $.parseJSON(data);
				mine.next('.view-detail').children().remove();
				var html = '<table width="100%">';
				var total = 0;
				for(var i=0;i<data.length;i++){
					total += data[i].size;
					html += '<tr>';
					html += 	'<td width="33%" style="border-top:1px solid #eee;padding:10px;">'+data[i].key+'</td>';
					html += 	'<td width="33%" style="border-top:1px solid #eee;padding:10px;">'+data[i].size+'</td>';
					html += 	'<td width="33%" style="border-top:1px solid #eee;padding:10px;">'+data[i].modify+'</td>';
					html += '</tr>';
				}
					html += '<tr>';
					html += 	'<td width="33%" style="border-top:1px solid #eee;padding:10px;">'+data.length+'</td>';
					html += 	'<td width="33%" style="border-top:1px solid #eee;padding:10px;">'+total+'</td>';
					html += 	'<td width="33%" style="border-top:1px solid #eee;padding:10px;"></td>';
					html += '</tr>';
				html += '</table>';
				mine.next('.view-detail').append(html);
			});
		}else{
			mine.next('.view-detail').children().remove();
			mine.next('.view-detail').hide();
		}
	});
</script>