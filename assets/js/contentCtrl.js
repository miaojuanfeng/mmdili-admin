mmAdmin.controller('contentCtrl', function($scope, contentServ){
	$scope.taskList = [];

	//$scope.$on("$ionicView.beforeEnter", function(){
		contentServ.getTaskFile().then(function(data){
			console.log(data);
			$scope.taskList = data;
		})
	//});

	$scope.exec = function(){
		alert('');
	}
});