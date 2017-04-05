'use strict';
angular.module('nodejsApp')
.directive("carouselElement",function(){
    return {
        restrict: "A",
        link: function(scope, ele, attrs) {
            
            if (scope.$last) {
                $('.'+attrs.startclass).jcarousel();
            }
            
        }
    } 

})
.directive("colorBox",function(){
    return {
        restrict: "AC",
        link: function(scope, ele, attrs) {
        	
        	if (typeof attrs.colorBox=='string'){
        		var obj = JSON.parse(attrs.colorBox);
        	}
        	else {
        		var obj = attrs.colorBox;
        	}
            $(ele).colorbox(obj);
            
        }
    } 

})
