'use strict';

/**
 * @ngdoc function
 * @name nodejsApp.controller:ContactCtrl
 * @description
 * # ContactCtrl
 * Controller of the nodejsApp
 */
angular.module('nodejsApp')
  .controller('ContactCtrl', function ($scope) {
    $scope.awesomeThings = [
      'HTML5 Boilerplate',
      'AngularJS',
      'Karma'
    ];
  });
