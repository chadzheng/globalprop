'use strict';

/**
 * @ngdoc overview
 * @name nodejsApp
 * @description
 * # nodejsApp
 *
 * Main module of the application.
 */
angular
  .module('nodejsApp', [
    'ngAnimate',
    'ngCookies',
    'ngResource',
    'ngRoute',
    'ngSanitize',
    'ngTouch',
    'ui.router',
	'rzModule',
  'ngTable',
  'ui.bootstrap',
  'ui.slider',
  'ngStorage',
  'ngMap'
  
  ])
  .config(function ($stateProvider, $urlRouterProvider,$locationProvider) {

    //$locationProvider.html5Mode(true);
    $urlRouterProvider.otherwise("/");
    $stateProvider
    .state('detail', {
      url: "/:id",
       templateUrl: 'views/property.detail.html'
        //controller: 'propertyDtlCtrl'
    })
   
  });
