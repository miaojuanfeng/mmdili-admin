<!DOCTYPE html>
<html>
<head>
	<title>mmTeacher</title>
	<link rel="stylesheet" type="text/css" href="assets/css/style.min.css">

	<script src="assets/lib/js/angular.min.js"></script>
	<script src="assets/lib/js/angular-ui-router.min.js"></script>
	<script src="assets/js/app.js"></script>
	<script src="assets/js/headerCtrl.js"></script>
	<script src="assets/js/contentCtrl.js"></script>
</head>
<body ng-app="mmAdmin">
	<div ui-view="sidebar"></div>
	<div class="main-container">
		<div ui-view="header"></div>
		<div ui-view="content"></div>
	</div>
</body>
</html>