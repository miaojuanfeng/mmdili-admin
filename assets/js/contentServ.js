mmAdmin.factory('contentServ', function($q, $http){
	var self = this;
	self.httpUrl = 'http://47.92.3.88/admin/api/task.php';

	return {
		getTaskFile: function(){
			var deferred = $q.defer();
            $http.post(self.httpUrl, {function: 'file_list'})
            .success(function(data){
                deferred.resolve(data);
            })
            .error(function(reason) {
                deferred.reject(reason);
            })
            return deferred.promise;
		},
		execTask: function(file){
			var deferred = $q.defer();
            $http.post(self.httpUrl, {function: 'exec_task'})
            .success(function(data){
                deferred.resolve(data);
            })
            .error(function(reason) {
                deferred.reject(reason);
            })
            return deferred.promise;
		},
	}
});