'use strict';

/**
 * @ngdoc function
 * @name nodejsApp.controller:MainCtrl
 * @description
 * # MainCtrl
 * Controller of the nodejsApp
 */
angular.module('nodejsApp')
  .controller('propertyCtrl', function ($rootScope,$scope,base,searchParam,$localStorage,property,news,ngTableParams,$modal,$filter,$location) {
    $scope.searchTmpl=1;
    $scope.propertyTmpl=1;
    $scope.searchMainType='prop';

    //$localStorage.search=_.extend($rootScope._tempParams,$location.search());;

    

  })
  .controller('propertyResultCtrl',function($rootScope,$localStorage,searchParam,$scope,district,base,property,news,ngTableParams,$modal,$filter,$location,$state){
    
    $scope.base=base;
    $rootScope.$$listeners.searchPropStart=[];
    $rootScope.$on('searchPropStart',function(){
      searchProp();
    })
    
    var searchProp=function(){
        $rootScope.progressbar.start();
         property.getSearchProp(searchParam.getPara('prop'),function(data){

            $rootScope.$broadcast('pageChange',{
                total:data.TOTAL,
                current:data.PAGE_POSITION
            })
            $scope.propertys= data.SEARCH_RESULT;
            $rootScope.progressbar.complete();
        });
    }


    $scope.showDetail=function(index){
      showPropDetail($scope.propertys[index].REFERENCE);
        
        //$state.go('property.detail',{id:$scope.propertys[index].REFERENCE});
    }

    searchProp();
  })
  .controller('propertyDtlCtrl',function($rootScope,$scope,district,base,property,news,$modal,$filter,$location,$stateParams){
    $scope.base=base;
    property.getPropertyDetail($stateParams,function(e){
      $scope.property=e[0];
      var slides = $scope.slides = [];
      _.each(e[0]['SMALL_IMAGE_LIST'],function(e){
        slides.push({
          image:base.thumbImage+e
        })
      })
    })


    $scope.myInterval = 5000;



  
  })



  .controller('indexProp',function($rootScope,$scope,district,base,property,news,$modal,$filter,$location,$stateParams){
  /*****************indexProp***********************/
     $scope.showPropDetail=function($id){
      showPropDetail($id);
    }
    $scope.getIndex=function(){
        property.getIndexProp(($scope.initSearch||{limit:12,indextype:'template2'}),function(data){
        $scope.indexProps=data;
        //$scope.htmlReady();
          angular.forEach(data,function(record,idx){
            
          })
          
      });
    }
    $scope.$watch('initSearch',function(n,o){
      $scope.getIndex();
    })

  /*****************indexProp***********************/      

   

  })
