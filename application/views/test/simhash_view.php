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
label{
	font-size: 16px;
}
textarea{
	width: calc(100% - 22px);
	height: 300px;
	resize: none;
	border: 1px solid #eee;
	padding: 10px;
	box-shadow: 0 2px 15px 0px #ccc;
	border-radius: 5px;
	font-size: 13px;
}

</style>
<body>
	<div class="container">
		<div class="left">
			<div class="text1">
				<label>$text1 = '</label>
				<textarea>aasdasdas</textarea>
				<label>';</label>
			</div>
		</div>
		<div class="right">
			<div class="text2">
				<textarea>aasdasdas</textarea>
			</div>
		</div>
		<div class="clearfix"></div>
		<div class="result"></div>
	</div>
</body>
</html>