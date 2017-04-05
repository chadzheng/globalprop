angular.module('nodejsApp')
	.service('trans', function property($resource,base) {
		return $resource(base.url+'/ajax/getTransaction.php',{}, {
			
			getSearchTrans: {
				method: "POST",
				params:{
					type:'transList'
				}
                
			}
			,getUsage: {
				method: "POST",
				params:{
					type:'loadUsage'
				}
				,isArray:true
                
			}
			,getDist: {
				method: "POST",
				params:{
					type:'loadDist'
				}
                ,isArray:true
			}

		});
	});