'use strict';

/**
 * @ngdoc function
 * @name nodejsApp.controller:MainCtrl
 * @description
 * # Search
 * Controller of the nodejsApp
 */
angular.module('nodejsApp')
  .controller('searchCtrl', function ($rootScope,$scope,$localStorage,district,searchParam,base,news,$modal,$filter,$location,usage) {
    searchParam.setParam('prop',$location.search());
    $scope.params=searchParam.getPara('prop');

    

    var distCache=district.get(function(data){
			distList(data);
        return data;
    });
    var usageCache=usage.get(function(data){
            usageList(data);
        return data;
    });

    
    
    var _init=function(){
       //$scope.params=_.extend($scope.params,$location.search());
       /*
        if (!$localStorage.search){
            
            $localStorage.search=$scope.params;
            
        }
*/
        var area2='';
        if ($location.search().area2){
            var _area2=$location.search().area2;
            if (typeof _area2=='number')_area2=_area2.toString();
            area2=parseFloat(_area2.replace("+", ""));
        }


        var price2='';
        
        if ($location.search().price2){
            var _price2=$location.search().price2;
            if (typeof _price2=='number')_price2=_price2.toString();
            price2=parseFloat(_price2.replace("+", ""));
            
        }
        $scope.priceSlider = {
            1:{
                min:0,
                max:20000000,
                step:0.1,
                range:[($location.search().price1||0),(price2||20000000)]
            },
            2:{
                min:0,
                max:2000000,
                step:0.1,
                range:[($location.search().price1||0),(price2||2000000)]
            }
        };

         $scope.areaSlider = {
            min:0,
            max:6000,
            step:1,
            range:[($location.search().area1||0),(area2||6000)]
        };
    }




    _init();






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

    $scope.usageText=[];

    //init District
    var usageList=function(usage){
        
        $scope.usageText=[];
        if (!usage){
             usage=usageCache;
        }
        
            var defaultUse=$scope.params.usage.split(",");


            usage.map(function (us) {
                if (_.contains(defaultUse, us.C_USAGE)){
                  us.selected=true;
                  $scope.usageText.push(us.C_USAGE);
                }
                else us.selected=false;

              return us;
                });
            $scope.usageUsage=$scope.usageText.toString();
        

        return usage;
    }

    




    //Default Area and price
    
    
    /*****************************ACTION************************************/
    $scope.reset=function(){
         $scope.params=searchParam.reset();
        distList();
        $scope.areaSlider.range=[0,$scope.areaSlider.max];
        $scope.priceSlider[params.price_type].range=[0,$scope.priceSlider[params.price_type].max];
    }
    
    $scope.submit=function(){
        
         $scope.params.page_position=1;
        $location.path('/property').search($scope.params);
        
        //$localStorage.search=$scope.params;
        $rootScope.$emit('searchPropStart');
    }

    $scope.$watch('priceSlider[params.price_type].range',function(newValue,oldValue){
        
        //$scope.params.price1=parseInt($filter('numbertoDatabase')(newValue[0],'萬',0));   //old
        //$scope.params.price2=$filter('numbertoDatabase')(newValue[1],'萬',0,$scope.priceSlider.max); //old
        $scope.params.price1=parseInt($filter('numbertoDatabase')(newValue[0],'',0));
        $scope.params.price2=$filter('numbertoDatabase')(newValue[1],'',0,$scope.priceSlider[$scope.params.price_type].max);
         
        

    });
    $scope.$watch('params.price_type',function(n,o){

        if (n!=o){
        $scope.priceSlider[$scope.params.price_type].range=[$scope.priceSlider[$scope.params.price_type].min,$scope.priceSlider[$scope.params.price_type].max];
        angular.forEach($scope.priceSlider,function(val,key){
            $scope.priceSlider[key].range=[$scope.priceSlider[key].min,$scope.priceSlider[key].max];
            
             
        });
     }
        
    });
    $scope.$watch('areaSlider.range',function(newValue,oldValue){
        
        $scope.params.area1=parseInt($filter('numbertoDatabase')(newValue[0],'',0));

        $scope.params.area2=$filter('numbertoDatabase')(newValue[1],'',0,$scope.areaSlider.max);
        
        
    })

    $scope.$on('$locationChangeSuccess', function(){
        

            _init();
            distList();
            
        });

    $scope.selectDist=function(index){

      var modalInstance = $modal.open({
        animation: true,
        templateUrl: 'District.html',
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

    $scope.selectUsage=function(index){

      var modalInstance = $modal.open({

        animation: true,
        templateUrl: 'Usage.html',
        controller: 'usageDiaCtrl',
        size: 'sm',
        resolve: {
          usage: function(){
                return usageList();
            }
          }
        
      });

      modalInstance.result.then(function(selectUsage){
        $scope.usageText=[];
        $scope.params.usage=[];
        angular.forEach(selectUsage,function(val,key){
            $scope.usageText.push(val.C_USAGE);
            $scope.params.usage.push(val.C_USAGE);
        });
        $scope.params.usage=$scope.params.usage.toString();
      })
    };

  })
 .controller('transSearchCtrl', function ($rootScope,$scope,$localStorage,searchParam,district,base,news,$modal,$filter,$location,trans) {
    searchParam.setParam('trans',$location.search());
    $scope.params=searchParam.getPara('trans');
    
    $scope.date2Open=false;
    $scope.date1Open=false;
    var distCache=trans.getDist(function(data){
            distList(data);
        return data;
    });
    var usageCache=trans.getUsage(function(data){
            usageList(data);
        return data;
    });
    if (!$scope.params){    
        $scope.params=$rootScope._tempTransParams;
    }

    
    var _init=function(){
       // $scope.params=_.extend($rootScope._tempTransParams,$location.search());

        if (!$localStorage.searchTrans){
            
            $localStorage.searchTrans=$scope.params;
            
        }

        var area2='';
        if ($location.search().area2){
            area2=parseFloat($location.search().area2.replace("+", ""));
        }

        var price2='';
        if ($location.search().price2){
            price2=parseFloat($location.search().price2.replace("+", ""))*10000;
            
        }
        $scope.priceSlider = {
            min:0,
            max:20000000,
            step:0.1,
            range:[($location.search().price1*10000||0),(price2||20000000)]
        };

         $scope.areaSlider = {
            min:0,
            max:6000,
            step:1,
            range:[($location.search().area1||0),(area2||6000)]
        };
    }




    _init();






    $scope.districtText=[];

    //init District
    var distList=function(dist){
        
        $scope.districtText=[];
        if (!dist){
             dist=distCache;
        }
        
            var defaultDis=$scope.params.district.split(",");


            dist.map(function (dis) {
                if (_.contains(defaultDis, dis.NUMBER)){
                  dis.selected=true;
                  $scope.districtText.push(dis.DISTRICTNAME);
                }
                else dis.selected=false;

              return dis;
                });
            $scope.districtText=$scope.districtText.toString();
        

        return dist;
    }

    $scope.usageText=[];

    //init District
    var usageList=function(usage){
        
        $scope.usageText=[];
        if (!usage){
             usage=usageCache;
        }
        
            var defaultUse=$scope.params.usage.split(",");


            usage.map(function (us) {
                if (_.contains(defaultUse, us.C_USAGE)){
                  us.selected=true;
                  $scope.usageText.push(us.C_USAGE);
                }
                else us.selected=false;

              return us;
                });
            $scope.usageUsage=$scope.usageText.toString();
        

        return usage;
    }

    




    //Default Area and price
    
    
    /*****************************ACTION************************************/
    $scope.reset=function(){

         $scope.params=searchParam.reset('trans');
        distList();
        $scope.areaSlider.range=[0,$scope.areaSlider.max];
        $scope.priceSlider.range=[0,$scope.priceSlider.max];
    }
    $scope.submit=function(){

         $scope.params.page_position=1;
        $location.path('/transaction').search(searchParam.getPara('trans'));
        
        $rootScope.$emit('searchTransStart');
    }

    $scope.$watch('priceSlider.range',function(newValue,oldValue){
        
        $scope.params.price1=parseInt($filter('numbertoDatabase')(newValue[0],'萬',0));
        $scope.params.price2=$filter('numbertoDatabase')(newValue[1],'萬',0,$scope.priceSlider.max);

    });
    $scope.$watch('areaSlider.range',function(newValue,oldValue){
        
        $scope.params.area1=parseInt($filter('numbertoDatabase')(newValue[0],'',0));
        $scope.params.area2=$filter('numbertoDatabase')(newValue[1],'',0,$scope.areaSlider.max);
        
    })

    $scope.$on('$locationChangeSuccess', function(){
        

            _init();
            distList();
            
        });

    $scope.selectDist=function(index){

      var modalInstance = $modal.open({
        animation: true,
        templateUrl: 'District.html',
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
            $scope.districtText.push(val.DISTRICTNAME);
            $scope.params.district.push(val.NUMBER);
        });
        $scope.params.district=$scope.params.district.toString();
      })
    };

    $scope.selectUsage=function(index){

      var modalInstance = $modal.open({

        animation: true,
        templateUrl: 'Usage.html',
        controller: 'usageDiaCtrl',
        size: 'sm',
        resolve: {
          usage: function(){
                return usageList();
            }
          }
        
      });

      modalInstance.result.then(function(selectUsage){

        $scope.usageText=[];
        $scope.params.chi_usage=[];
        angular.forEach(selectUsage,function(val,key){
            
            $scope.usageText.push(val.C_USAGE);
            $scope.params.chi_usage.push(val.C_USAGE);
        });
        $scope.params.chi_usage=$scope.params.chi_usage.toString();
      })
    };

  })