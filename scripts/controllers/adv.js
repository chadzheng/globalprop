'use strict';

/**
 * @ngdoc function
 * @name nodejsApp.controller:MainCtrl
 * @description
 * # MainCtrl
 * Controller of the nodejsApp
 */
angular.module('nodejsApp')
  .controller('advCtrl', function ($rootScope,$scope,$modal,$filter,$location,district,searchParam,usage,property,trans) {
  	searchParam.setParam('prop',$location.search());
    $scope.params=searchParam.getPara('prop');
    /* $scope.base=base;
  	adv.get(function(data){
  		$scope.advs=data['POS2'];
  		
  	}); */
	var searchTrans=function(){
        $scope.trans=[];
		searchParam.setParam('trans',$location.search());
        trans.getSearchTrans(searchParam.getPara('trans'),function(data){
            $scope.trans= data.DAYBOOK_RESULT;
        });
    }
    searchTrans();
	
	var distCache=district.get(function(data){
			distList(data);
        return data;
    });
	
	$scope.districtText=[];

    //init District
    var distList=function(dist){
        
        $scope.districtText=[];
        if (!dist){
             dist=distCache;
        }
            var defaultDis=$scope.params.district.split(",");


            dist.map(function (dis) {
                if (_.contains(defaultDis, dis.DISTRICT)){
                  dis.selected=true;
                  $scope.districtText.push(dis.C_DISTRICT);
                }
                else dis.selected=false;

              return dis;
                });
            $scope.districtText=$scope.districtText.toString();
        
        return dist;
    }
	
	$scope.propertyQuickSearch = function(){
		$scope.params.page_position=1;
		var areaRange = $scope.getRange($scope.area_range);
		$scope.params.area1 = areaRange.min;
		$scope.params.area2 = areaRange.max;
		var priceRange = $scope.getRange($scope.price_range);
		$scope.params.price1 = priceRange.min;
		$scope.params.price2 = priceRange.max;
		$location.path('/property').search($scope.params);
        
        //$localStorage.search=$scope.params;
        $rootScope.$emit('searchPropStart');
	}
	
	$scope.selectDist=function(index){

      var modalInstance = $modal.open({
        animation: true,
        templateUrl: 'DistrictQuick.html',
        controller: 'distDiaCtrl',
        size: '',
        resolve: {
          district: function(){
                return distList();
            }
          }
        
      });

      modalInstance.result.then(function(selectDist){
        $scope.districtText=[];
        $scope.params.district=[];
        angular.forEach(selectDist,function(val,key){
            $scope.districtText.push(val.C_DISTRICT);
            $scope.params.district.push(val.DISTRICT);
        });
        $scope.params.district=$scope.params.district.toString();
      })
    };
	
	$scope.$on('$locationChangeSuccess', function(){
		distList();
	});
	$scope.getRange = function(range){
		var max,min;
		if(range.indexOf("+") > 0){
			max= range;
			min= max.replace("+", ""); 
		}
		if(range.indexOf("-") > 0){
			var arr = range.split("-");
			max = arr[1];
			min = arr[0];
		}
		return {'min': min, 'max': max};
	}
  });
