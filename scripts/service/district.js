angular.module('nodejsApp')
	.service('district', function property($resource,base) {
		return $resource(base.url+'/ajax/getProperty.php?type=distlist',{}, {
			get: {
				
				
                isArray:true
			}
		});
	});