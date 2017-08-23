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
textarea, input{
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
textarea.keyword{
	height: 100px;
}
input{
	height: auto;
}
button{
	background: blue;
	color: #fff;
	padding: 10px 20px;
}
</style>
<body>
	<div class="container">
		<div class="left">
			<div class="text1">
				<div>
					<div class="label">Text1</div>
					<textarea>aasdasdas</textarea>
				</div>
				<div>
					<div class="label">Keyword1</div>
					<textarea class="keyword" readonly="true">aasdasdas</textarea>
				</div>
				<div>
					<div class="label">Fingerprint1</div>
					<input readonly="true" value="asdas">
				</div>
			</div>
		</div>
		<div class="right">
			<div class="text2">
				<div>
					<div class="label">Text2</div>
					<textarea>aasdasdas</textarea>
				</div>
				<div>
					<div class="label">Keyword2</div>
					<textarea class="keyword" readonly="true">aasdasdas</textarea>
				</div>
				<div>
					<div class="label">Fingerprint2</div>
					<input readonly="true" value="asdas">
				</div>
			</div>
		</div>
		<div class="clearfix"></div>
		<div class="result">
			<div>
				<div class="label">Result</div>
				<input readonly="true" value="asdas">
			</div>
			<div>
				<div class="label">Hamming</div>
				<input readonly="true" value="asdas">
			</div>
			<div>
				<button value="Submit">
			</div>
		</div>
	</div>
</body>
</html>