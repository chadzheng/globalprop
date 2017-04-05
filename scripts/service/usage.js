angular.module('nodejsApp')
	.service('usage', function property($resource,base) {
		return $resource(base.url+'/ajax/getProperty.php?type=usagelist',{}, {
			get: {
				
				
                isArray:true
			}
		});
	});