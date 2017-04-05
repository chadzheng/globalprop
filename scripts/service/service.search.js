'use strict';
angular.module('nodejsApp')
	.service('searchParam', function searchParam(base,$filter) {
		var _temp={
			trans:{ //default search trans
		             district:'',
		            chi_district:'',
		            price1:0,
		            price2:'20000000+',
		            bld:'',
		            //type:1,
		            chi_usage:'',
		            date1:'',
		            date2:'',
		            page_position:1,
		            czone:'香港,九龍,新界',
		            usage:'RES',
		            sort_by:'sort_date',
		            sort_method:'d'
				},
			news:{
				page_position:1,
				limit:10000
			},
				property:{ //default search prop
		            price_type:1,
		            district:'',
		            street:'',
		            building_name:'',
		            price1:0,
		            price2:"20000000+",
		            area1:0,
		            area2:'6000+',
		            usage:'',
		            page_position:1,
		            sort_by:'sort_date',
		            sort_method:'d'

		        },
		        _initPara:function(type){
		        	
		        	if(!search.trans){
		        		angular.copy(this.trans, search.trans);
		        	}
		        	if(!search.property){
		        		angular.copy(this.property, search.property);
		        	}
		        }

		}
		var search={
				trans:false,//default search trans
		        		
				property:false, //default search prop
		        
				news:false,
		        setParam:function(type,para){
		        	
		        	if (!type) type='prop';
		        	switch(type){
		        		case 'prop':
		        			
		        			this.property=_.extend({},_temp.property,para);

		        			this.trans=false;
		        			this.news=false;
		        		break;
		        		case 'news':

		        			this.news=_.extend({},_temp.news,para);
		        			this.trans=false;
		        			this.property=false;
		        		break;
		        		case 'trans':
		        			this.trans=_.extend({},_temp.trans,para);
		        			this.property=false;
		        			this.news=false;
		        			if (!this.trans.date2){
		        				this.trans.date2=$filter('date')(new Date(), 'yyyy/MM/dd');
		        			}
		        			var prevMoth = new Date();
							  
							  prevMoth.setMonth(prevMoth.getMonth()-1);
		        			if (!this.trans.date1){
		        				this.trans.date1=$filter('date')(prevMoth, 'yyyy/MM/dd');
		        			}
		        			
		        			
		        		break;
		        	}

		        },
		        setPage:function(type,val){
		        	if (!type) type='prop';
		        	switch(type){
		        		case 'prop':
		        			this.property.page_position=val;
		        		break;
		        		case 'trans':
		        			this.trans.page_position=val;
		        		break;
		        		case 'news':

		        			this.news.page_position=val;
		        		break;
		        	}
		        },
		        getPara:function(type){
		        	if (!type) type='prop';

		        	_temp._initPara();
		        	
		        	switch(type){
		        		case 'prop':
		        			return this.property;
		        		break;
		        		case 'trans':
		        			this.trans.date2=$filter('date')(this.trans.date2, 'yyyy/MM/dd');
		        			this.trans.date1=$filter('date')(this.trans.date1, 'yyyy/MM/dd');
		        			return this.trans;
		        		break;
		        		case 'news':
		        			return this.news;
		        		break;
		        	}
		        },
		        reset:function(type){
		        	
		        	if (!type) type='prop';
		        	switch(type){
		        		case 'prop':
		        			this.property=_.extend({},_temp.property);

		        			return this.property;
		        		break;
		        		case 'trans':
		        			this.trans=_.extend({},_temp.trans);
		        			this.property=false;
		        			if (!this.trans.date2){
		        				this.trans.date2=$filter('date')(new Date(), 'yyyy/MM/dd');
		        			}
		        			var prevMoth = new Date();
							  
							  prevMoth.setMonth(prevMoth.getMonth()-1);
		        			if (!this.trans.date1){
		        				this.trans.date1=$filter('date')(prevMoth, 'yyyy/MM/dd');
		        			}
		        			return this.trans;
		        		break;
		        		case 'news':
		        			this.trans=_.extend({},_temp.news);
		        			return this.news;
		        		break;
		        	}
		        }

		      }

		 return search;
		
	});