'use strict';

/**
 * @ngdoc function
 * @name nodejsApp.controller:MainCtrl
 * @description
 * # MainCtrl
 * Controller of the nodejsApp
 */
angular.module('nodejsApp')
  .controller('MainCtrl', function ($rootScope,$scope, $state,ngTableParams) {
  	
    $rootScope.$on('$viewContentLoading', 
		function(event, viewConfig){ 
		    
		});
		$scope.showPropDetail=function($id){

      window.open('./propDetail.html#/'+$id,'','scrollbars=1, resizable=1,width=1050,height=1000')
    }

  });
