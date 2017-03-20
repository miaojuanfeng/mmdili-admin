mmAdmin.controller('contentCtrl', function($scope, contentServ){
	$scope.taskList = [0,1,2,3,4,5];

	//$scope.$on("$ionicView.beforeEnter", function(){
		contentServ.getTaskFile().then(function(data){
			console.log(data);
		})
	//});

	$scope.exec = function(){
		alert('');
	}
});