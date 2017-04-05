'use strict';


angular.module('nodejsApp')
	.constant('base', {
		url: 'http://192.168.0.13/smartprop',
		thumbImage:'http://192.168.0.13/smartprop/thumbImage.php?id='
		//port: '8080',
		//base: 'data'
		// fullUrl: this.url+':'+this.port+'/'+this.data+'/'
	});
