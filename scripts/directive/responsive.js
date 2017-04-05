'use strict';
angular.module('nodejsApp')
.directive("responsiveMeta",function(){
    return {
        restrict: "E",
        template: function(elm,attr){

        	if (attr.responsive==true){

        		var meta='<meta name="viewport" content="width=device-width, initial-scale=1"/>';	
        	}else {
        		var meta='<meta></meta>';	
        	}
        	
        	return meta;
        },
        replace: true,
        link: function(scope, ele, attrs) {
            scope.meta2='<meta name="viewport" content="width=device-width, initial-scale=1"/>'
        }
    } 

})
.directive("responsiveCss",function(){
    return {
        restrict: "E",
        template: function(elm,attr){

        	if (attr.responsive==true){

        		var css='<link rel="stylesheet" href="styles/responsive.css">';	
        	}else {
        		var css='<link rel="stylesheet" href="styles/nonResponsive.css">';	
        	}
        	
        	return css;
        },
        replace: true,
        link: function(scope, ele, attrs) {
            
        }
    } 

})