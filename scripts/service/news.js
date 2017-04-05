angular.module('nodejsApp')
	.service('news', function property($resource,base) {
		return $resource(base.url+'/ajax/getNews.php',{}, {
			getNewsList: {
				method: "GET",
				params:{
					type:'indexNews'
				},
                isArray:true
			}

		});
	});