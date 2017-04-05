'use strict';

/**
 * @ngdoc function
 * @name nodejsApp.controller:MainCtrl
 * @description
 * # Search
 * Controller of the nodejsApp
 */
angular.module('nodejsApp')
  .controller('paginationCtrl', function ($rootScope,$scope,district,searchParam,base,news,$modal,$filter,$location,$localStorage) {
    $scope.searchMainType=$scope.searchMainType||'prop';
    if ($scope.page){
        $scope.page=_.extend({
        current:3,
        size:5,
        perPage:5,
        tmpl:'views/template/paginationTmpl1.html'
        },$scope.page);

    }else {
        $scope.page={
            current:3,
            size:5,
            perPage:5,
            tmpl:'views/template/paginationTmpl1.html'
        };
    }
    
    
    $scope.pageChanged = function() {
        //$scope.page.total=100;1

            switch($scope.searchMainType){
                case 'prop':
                    searchParam.setPage($scope.searchMainType,$scope.page.current);
                    //$localStorage.search.page_position=$scope.page.current;
                    $location.search(searchParam.getPara('prop'));
                    $rootScope.$emit('searchPropStart');
                    
                break;
                case 'trans':
                    searchParam.setPage($scope.searchMainType,$scope.page.current);
                    
                    $location.search(searchParam.getPara('trans'));
                    $rootScope.$emit('searchTransStart');                    
                break;
                case 'news':

                    searchParam.setPage($scope.searchMainType,$scope.page.current);
                    
                    $rootScope.$emit('searchNewsStart');                    
                break;
            }
            


            
        };
//    $scope.district=district.get();
    
    
    
    $rootScope.$on('pageChange',function(EV,page){
        $scope.page.current=page.current;
        $scope.page.total=parseInt(page.total);
        
    });

    
  });
