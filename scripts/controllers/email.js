'use strict';

/**
 * @ngdoc function
 * @name nodejsApp.controller:AboutCtrl
 * @description
 * # AboutCtrl
 * Controller of the nodejsApp
 */
angular.module('nodejsApp')
  .controller('emailCtrl', function ($scope,$http,$routeParams,email,Upload,base) {
    $scope.sending=false;
    $scope.send=function(){
      if ($scope.emailForm.$valid){
        $('.email_contactBtn').button('loading');
        $scope.sending=true;
        email.sendEmail($scope.emailParams,function(e){
            $scope.sending=false;
            $('.email_contactBtn').button('reset');
            if (e.result){
              alert('已傳送電郵');
            }else {
              alert('傳送失敗');
            }
          })
      }
    }
    $scope.sendWithFile=function(){

      //console.log($scope.emailParams.file);
      if ($scope.emailForm.$valid){
        $('.email_contactBtn').button('loading');
        $scope.sending=true;
        
        Upload.upload({
          url:base.url+'/ajax/getSendEmail2.php',
          sendFieldAs:'form',
          method:'POST',
          file:$scope.emailParams.file[0],
          fields:$scope.emailParams

        }).progress(function(evt){
          //var per=parseInt(100.0*evt.loaded/evt.total);
            //console.log(per+'%'+evt.config.file.name);
        }).success(function(data,stutas,headers,config){
            $scope.sending=false;
            $('.email_contactBtn').button('reset');
            alert('已傳送電郵');
            $scope.reset();
            
        }).error(function (data, status, headers, config) {
                    $scope.sending=false;
                    $('.email_contactBtn').button('reset');
                    alert('傳送失敗');
                })
      }
      
    };
    $scope.reset=function(){
      var pageTitle=$scope.emailParams.pageTitle;
      var prop_id=$scope.emailParams.prop_id;

      var mail_type=$scope.emailParams.mail_type;
      
      $scope.emailParams={
        pageTitle:pageTitle,
        mail_type:mail_type,
        prop_id:prop_id
      };
    }
  });

