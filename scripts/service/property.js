angular.module('nodejsApp')
	.service('property', function property($resource,base) {
		return $resource(base.url+'/ajax/getProperty.php',{}, {
			getIndexProp: {
				method: "POST",
				params:{
					type:'indexProp'
				},
                isArray:true
			},
			getSearchProp: {
				method: "POST",
				params:{
					type:'propertyList'
				},
                
			},
			getPropertyDetail: {
				method: "POST",
				params:{
					type:'propertyDetail'
				},
                isArray:true
			},
			

		});
	});