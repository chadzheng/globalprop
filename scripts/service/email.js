angular.module('nodejsApp')
	.service('email', function property($resource,base) {
		return $resource(base.url+'/ajax/getSendEmail2.php',{}, {
			sendEmail: {
				method: "POST",
				
			}

		});
	});