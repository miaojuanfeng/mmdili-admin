<!DOCTYPE html>
<html>
<head>
	<title>mmTeacher</title>
	<?php require_once "meta_view.php" ?>
</head>
<body>
	<?php require_once "sidebar_view.php" ?>
	<div class="main-container">
		<?php require_once "header_view.php" ?>
		<div class="content">
			<div class="list">
				<div class="item task">
					<div class="task-file">
						<div class="file-name" ng-bind="fileName"></div>
						<div class="file-dir" ng-bind="fileDir"></div>
					</div>
					<div class="task-act">
						<a href="javascript:;" ng-click="exec(fileDir)">Exec</a>
					</div>
					<div class="clearfix"></div>
				</div>
			</div>
		</div>
	</div>
</body>
</html>