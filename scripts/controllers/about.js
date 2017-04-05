'use strict';

/**
 * @ngdoc function
 * @name nodejsApp.controller:AboutCtrl
 * @description
 * # AboutCtrl
 * Controller of the nodejsApp
 */
angular.module('nodejsApp')
  .controller('AboutCtrl', function ($scope,$http,$routeParams) {

    $scope.awesomeThings = [ 
      {'name':'HTML5 Boilerplate','type':'ios'},
  		{'name':'AngularJS','type':'android'},
  		{'name':'test1','type':'win'}    
    ];


    $http.get('phones/phones.json').
    success(function(data,status,header,config){
    	$scope.awesomeThings=data;	
    	console.log(data);
    });
    
  });
