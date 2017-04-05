'use strict';


angular.module('nodejsApp')
	.constant('api', {
		lang:'c'
		//port: '8080',
		//base: 'data'
		// fullUrl: this.url+':'+this.port+'/'+this.data+'/'
	})
	.factory('searchParams',function(){
		return {
            type:1,
            district:'',
            street:'',
            building:'',
            price1:0,
            price2:0,
            area1:0,
            area2:0,
            usage:'',
            page_position:1

        }
	})
