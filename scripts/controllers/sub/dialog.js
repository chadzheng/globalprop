'use strict';

/**
 * @ngdoc function
 * @name nodejsApp.controller:MainCtrl
 * @description
 * # MainCtrl
 * Controller of the nodejsApp
 */
angular.module('nodejsApp')
  .controller('newsDialogCtrl', function ($rootScope,$modalInstance,$scope,news) {

  	$scope.news=news;
     $scope.ok = function () {
    $modalInstance.close($scope.selected.item);
  };

  $scope.cancel = function () {
    $modalInstance.dismiss('cancel');
  };
      
  })
  .controller('distDiaCtrl', function ($rootScope,$modalInstance,$scope,district,$filter) {
  	$scope.districts=district;
  	
     $scope.ok = function () {
     	//console.log($filter('filter')($scope.districts, {selected:true}));
    	$modalInstance.close($filter('filter')($scope.districts, {selected:true}));
	  };

	  $scope.cancel = function () {
	    $modalInstance.dismiss('cancel');
	  };
	      
  })
  .controller('usageDiaCtrl', function ($rootScope,$modalInstance,$scope,usage,$filter) {
  	$scope.usages=usage;
  	
     $scope.ok = function () {
     	//console.log($filter('filter')($scope.districts, {selected:true}));
    	$modalInstance.close($filter('filter')($scope.usages, {selected:true}));
	  };

	  $scope.cancel = function () {
	    $modalInstance.dismiss('cancel');
	  };
	      
  })
