<!DOCTYPE html>
<html>
<head>
	<title>Simhash PHP Extension Demo</title>
</head>
<style>
.left{
	float: left;
	width: 50%;
}
.right{
	float: right;
	width: 50%;
}
.clearfix{
	float: none;
	clear: both;
}
.text1{
	margin:10px;
}
.text2{
	margin:10px;
}
.result{
	margin:10px;
}
.label{
	font-size: 16px;
	margin: 10px 0;
	font-weight: bold;
}
textarea, input, pre{
	width: calc(100% - 22px);
	height: 300px;
	resize: vertical;
	border: 1px solid #eee;
	padding: 10px;
	box-shadow: 0 2px 15px 0px #ccc;
	border-radius: 5px;
	font-size: 14px;
	outline: none;
}
.keyword{
	height: 150px;
	overflow: scroll;
}
input{
	height: auto;
}
.button{
	background: #337ab7;
	color: #fff;
	padding: 10px 40px;
	outline: none;
	border: none;
	text-align: center;
	font-size: 18px;
	margin: 20px 0;
	box-shadow: 0 2px 15px 0px #ccc;
	border-radius: 5px;
	width: 250px;
	cursor: pointer;
}
.button:hover{
	background: #337ce7;
}
h2, h4{
	text-align: center;
}
h2{
	margin-bottom: 5px;
}
h4{
	margin-top: 0px;
}
</style>
<body>
	<h2>Simhash PHP Extension Demo</h2>
	<h4>Compare the similarity between Texts.</h4>
	<div class="container">
		<form method="post" action="http://admin.mmdili.com/test/simhash">
		<div class="left">
			<div class="text1">
				<div>
					<div class="label">Text1</div>
					<textarea name="text1"><?=$text1['content']?></textarea>
				</div>
				<div>
					<div class="label">Keyword1</div>
					<pre class="keyword" readonly="true"><?=var_dump($text1['kw'])?></pre>
				</div>
				<div>
					<div class="label">Fingerprint1</div>
					<input readonly="true" value="<?=decbin($text1['sign'])?>">
				</div>
			</div>
		</div>
		<div class="right">
			<div class="text2">
				<div>
					<div class="label">Text2</div>
					<textarea name="text2"><?=$text2['content']?></textarea>
				</div>
				<div>
					<div class="label">Keyword2</div>
					<pre class="keyword" readonly="true"><?=var_dump($text2['kw'])?></pre>
				</div>
				<div>
					<div class="label">Fingerprint2</div>
					<input readonly="true" value="<?=decbin($text2['sign'])?>">
				</div>
			</div>
		</div>
		<div class="clearfix"></div>
		<div class="result">
			<div>
				<div class="label">Compare</div>
				<input readonly="true" value="<?=decbin($compare)?>">
			</div>
			<div>
				<div class="label">Hamming</div>
				<input readonly="true" value="<?=$hamming?>">
			</div>
			<div style="text-align:center;">
				<input class="button" type="submit" value="Submit"/>
			</div>
		</div>
		</form>
	</div>
	<a href="https://github.com/miaojuanfeng/SimhashPhpExtension"><img style="position: absolute; top: 0; right: 0; border: 0;" src="https://camo.githubusercontent.com/a6677b08c955af8400f44c6298f40e7d19cc5b2d/68747470733a2f2f73332e616d617a6f6e6177732e636f6d2f6769746875622f726962626f6e732f666f726b6d655f72696768745f677261795f3664366436642e706e67" alt="Fork me on GitHub" data-canonical-src="https://s3.amazonaws.com/github/ribbons/forkme_right_gray_6d6d6d.png"></a>
</body>
</html>