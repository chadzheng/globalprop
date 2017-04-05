'use strict';

/**
 * @ngdoc function
 * @name nodejsApp.controller:MainCtrl
 * @description
 * # MainCtrl
 * Controller of the nodejsApp
 */
angular.module('nodejsApp')
  .controller('IndexCtrl', function ($rootScope,$scope,adv,base,property,news,ngTableParams,$modal) {
    $scope.base=base;
  	adv.get(function(data){
  		$scope.advs=data['POS2'];
  		
  	});
  	
    /*****************indexNews***********************/  
     $scope.tableParams = new ngTableParams({
        page: 1,            // show first page
        count: 4          // count per page
    }, {
        total: 10, // length of data
        getData: function ($defer, params) {
          //console.log(params.url());
          var newsData=news.getNewsList();
          $scope.newsData=newsData;
          params.total(newsData.length);
            $defer.resolve(newsData);
        }
    })


    $scope.setSelected=function(index){
      var modalInstance = $modal.open({
        animation: true,
        templateUrl: 'myModalContent.html',
        controller: 'newsDialogCtrl',
        size: '',
        resolve: {
          news: function () {
            return $scope.newsData[index];
          }
        }
      });
    };
/*****************indexNews***********************/  
   
  })
  .controller('morCtrl', function ($rootScope,$scope,adv,base,$modal,$location,$http) {
    $scope.mor=_.extend({
      price:2000000,
      mortgagerate:70,
      principal:0,
      rate:2.25,
      period:20
    },$location.search());
    $scope.reset=function(){
        $scope.mor={
        price:2000000,
        mortgagerate:70,
        principal:0,
        rate:2.25,
        period:20
      };
      $scope.calprincipal();
    }
    $scope.calprincipal=function(){
      $scope.mor.principal=$scope.mor.price*$scope.mor.mortgagerate/100;
    }
    $scope.getCal=function(){
      console.log('test');
      $('#roughTableWrap').load(base.url+"/mortgagecal.php #roughTable",
                'price='+$scope.mor.price+'&mortgagerate='+$scope.mor.mortgagerate+'&rate='+$scope.mor.rate+'&period='+$scope.mor.period+'&principal='+$scope.mor.principal,
                function(response, status, xhr){
                }
      );
      $('#detailTableWrap').load(base.url+"/mortgagecal.php #detailTable",
                'price='+$scope.mor.price+'&mortgagerate='+$scope.mor.mortgagerate+'&rate='+$scope.mor.rate+'&period='+$scope.mor.period+'&principal='+$scope.mor.principal,
                function(response, status, xhr){
                }
      );
    }
    $scope.showDetail=function(){
      window.open("mortgageDetail.php?price="+$scope.mor.price+"&mortgagerate="+$scope.mor.mortgagerate+"&rate="+$scope.mor.rate+"&period="+$scope.mor.period,"","titlebar=no,location=no,resizable=yes, scrollbars=yes,width=700, height=700");
    }
    $scope.calprincipal();
    // $("#price").val()*$("#mortgagerate").val()/100
  });

