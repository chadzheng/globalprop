'use strict';

/**
 * @ngdoc function
 * @name nodejsApp.controller:MainCtrl
 * @description
 * # Search
 * Controller of the nodejsApp
 */
angular.module('nodejsApp')
  .controller('transCtrl', function ($rootScope,$scope,$localStorage,district,base,news,$modal,$filter,$location,usage) {
   $scope.page={
        perPage:20
        
   }

    $scope.searchMainType='trans';
    
   //$localStorage.searchTrans=_.extend($rootScope._tempTransParams,$location.search());
   //$scope.params=_.extend($rootScope._tempTransParams,$location.search());
   
  })
  .controller('transResultCtrl', function ($rootScope,$scope,$localStorage,searchParam,trans,$modal,$filter,$location,usage) {
    
 /*$scope.$watch(function(){return angular.toJson($localStorage.searchTrans)},
                function(i,e){
                console.log('test');
                  searchTrans();
                });
 */
 $rootScope.$$listeners.searchTransStart=[];
  $rootScope.$on('searchTransStart',function(){
      searchTrans();
    })
   var searchTrans=function(){
        $scope.trans=[];
         trans.getSearchTrans(searchParam.getPara('trans'),function(data){
          
            $rootScope.$broadcast('pageChange',{
                total:data.TOTAL,
                current:data.PAGE_POSITION
            })
            $scope.trans= data.DAYBOOK_RESULT;

        });
    }
    searchTrans();
  })
