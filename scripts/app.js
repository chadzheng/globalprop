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
  'ngMap',
  'ngFileUpload',
  'ngProgress'
  
  ])
  .config(function ($stateProvider, $urlRouterProvider,$locationProvider) {

    //$locationProvider.html5Mode(true);
    $urlRouterProvider.otherwise("/");
    var setPara={
      setPropParam:function($q,searchParam,$location){
          searchParam.reset('prop');
          
          var set= $q.defer();
          try{
              
              searchParam.setParam('prop',$location.search());
          }
          catch(e){
            set.reject();
          }
          set.resolve();
          return set.promise;
      },
      setTransParam:function($q,searchParam,$location){
        searchParam.reset('trans');
          var set= $q.defer();
          try{
            
              searchParam.setParam('trans',$location.search());
          }
          catch(e){
            set.reject();
          }
          set.resolve();
          return set.promise;
      }
    };
    $stateProvider
    .state('index', {
      url: "/",
       templateUrl: 'views/main.html',
        controller: 'IndexCtrl'
    })
    .state('property', {
      url: "/property",
       templateUrl: 'views/property.html',
        controller: 'propertyCtrl',
        reloadOnSearch:false,
        resolve:{
          search:setPara.setPropParam
        }
    })
	.state('recruit', {
      url: "/recruit",
       templateUrl: 'views/recruit.html'
        //controller: 'propertyCtrl'
    })
	.state('aboutUs', {
      url: "/aboutUs",
       templateUrl: 'views/aboutUs.html',
        controller: function($scope){
          $scope.emailParams={};
          $scope.emailParams.mail_type='';
          $scope.emailParams.pageTitle='聯絡我們';
        }
    })
	.state('postProp', {
      url: "/postProp",
       templateUrl: 'views/postProp.html',
        controller: function($scope){
          $scope.emailParams={};
          $scope.emailParams.file=[];
          $scope.emailParams.mail_type='postweb';
          $scope.emailParams.pageTitle='網上放盤';
        }
    })
	.state('mortgage', {
      url: "/mortgage",
       templateUrl: 'views/mortgage.html',
      controller: 'morCtrl'
    })
  .state('transaction', {
      url: "/transaction",
       templateUrl: 'views/transaction.html',
      controller: 'transCtrl',
      resolve:{
        setTrans:setPara.setTransParam
      }
    })
	.state('bankval', {
      url: "/bankval",
       templateUrl: 'views/bankval.html',
      controller: function($scope){
          $scope.emailParams={};
          $scope.emailParams.file=[];
          $scope.emailParams.mail_type='bankval';
          $scope.emailParams.pageTitle='代客估價';
      }
    })
	.state('link', {
      url: "/link",
       templateUrl: 'views/link.html',
      controller: function($scope){
          $scope.emailParams={};
          $scope.emailParams.file=[];
          $scope.emailParams.mail_type='link';
          $scope.emailParams.pageTitle='常用工具';
      }
    })
	.state('propNews', {
      url: "/propNews",
       templateUrl: 'views/propNews.html',
      controller: function($scope){
          $scope.emailParams={};
          $scope.emailParams.file=[];
          $scope.emailParams.mail_type='propNews';
          $scope.emailParams.pageTitle='市場消息';
      }
    })
    .state('property.detail', {
      url: "/:id",
      reloadOnSearch:false,
       onEnter: ['$stateParams', '$state', '$modal', '$resource', function($stateParams, $state, $modal, $resource,$scope,$location) {
        
        $modal.open({
            size:'lg',
            templateUrl: 'views/property.detail.html',
            
            controller: function($scope,$stateParams){
                $scope.emailParams={};
                $scope.emailParams.file=[];
                $scope.emailParams.prop_id =$stateParams.id;
                $scope.emailParams.mail_type='propertyDetail';
                $scope.emailParams.pageTitle='樓盤資料';
            }
          }).result.finally(function() {
            $state.go('^');
        });
     }]
     
       
        
    })
    .state('about', {
      url: "/about",
      templateUrl: 'views/about.html',
        controller: 'AboutCtrl'
    })
    .state('contact', {
      url: "/contact",
       templateUrl: 'views/contact.html',
        controller: 'ContactCtrl'
    })
     
  })
  .run(function($rootScope,ngProgressFactory){
     $rootScope.progressbar=ngProgressFactory.createInstance();
     $rootScope.progressbar.setHeight('2px');

    $rootScope
        .$on('$stateChangeStart', 
            function(event, toState, toParams, fromState, fromParams){ 
                $rootScope.progressbar.start();
        });

    $rootScope
        .$on('$stateChangeSuccess',
            function(event, toState, toParams, fromState, fromParams){ 
                $rootScope.progressbar.complete();
        });

  });

