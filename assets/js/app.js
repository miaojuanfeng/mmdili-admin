var mmAdmin = angular.module("mmAdmin", ['ui.router'])
.config(function ($httpProvider, $stateProvider, $urlRouterProvider){
	
	$stateProvider
	.state('home', {
		url: '/',
		views: {
            'header': {
                templateUrl: 'templates/header.html',
                controller: ''
            },
            'sidebar': {
                templateUrl: 'templates/sidebar.html',
                controller: ''
            },
            'content': {
                templateUrl: 'templates/content.html',
                controller: 'contentCtrl'
            }
        }
	})
	// .state('home.user', {
	// 	url: 'user',
	// 	views: {
 //            'content@': {
 //                templateUrl: 'user.html',
 //                controller: 'UserController'
 //            }
 //        }
	// })
	// .state('home.user_insert', {
	// 	url: 'user/insert',
	// 	views: {
 //            'content@': {
 //                templateUrl: 'user_insert.html',
 //                controller: 'UserInsertController'
 //            }
 //        }
	// })
	// .state('home.role', {
	// 	url: 'role',
	// 	views: {
 //            'content@': {
 //                templateUrl: 'role.html',
 //                controller: 'RoleController'
 //            }
 //        }
	// })
	// .state('home.role_insert', {
	// 	url: 'role/insert',
	// 	views: {
 //            'content@': {
 //                templateUrl: 'role_insert.html',
 //                controller: ''
 //            }
 //        }
	// })
	$urlRouterProvider.otherwise('/');
	
	var serialize = function(obj, prefix) {
		var str = [];
		for(var p in obj) {
			if (obj.hasOwnProperty(p)) {
				var k = prefix ? prefix + "[" + p + "]" : p, v = obj[p];
			  	str.push(typeof v == "object" ? serialize(v, k) : encodeURIComponent(k) + "=" + encodeURIComponent(v));
			}
		}
		return str.join("&");
	};
	$httpProvider.defaults.transformRequest = function(data){
	    if (data === undefined) {
	        return data;
	    }
	    return serialize(data);
	};
	$httpProvider.defaults.headers.post['Content-Type'] = 'application/x-www-form-urlencoded; charset=UTF-8';
})