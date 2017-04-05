angular.module('nodejsApp')
	.service('captcha', function property($resource,base) {
		return $resource(base.url+'/ajax/checkSecure.php',{}, {
			get:{
				isArray:true
			}

		});
	});