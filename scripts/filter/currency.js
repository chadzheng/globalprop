'use strict';
angular.module('nodejsApp')
	.filter('currencyunit',function(api){
		return function (price,obj){
			var formatMoney=function(n,c,d,t){
						if (c===true) c=0;
						
				var 	 
					    c = isNaN(c = Math.abs(c)) ? 2 : c, 
					    d = d == undefined ? "." : d, 
					    t = t == undefined ? "," : t, 
					    s = n < 0 ? "-" : "", 
					    i = parseInt(n = Math.abs(+n || 0).toFixed(c)) + "", 
					    j = (j = i.length) > 3 ? j % 3 : 0;
						
					   return s + (j ? i.substr(0, j) + t : "") + i.substr(j).replace(/(\d{3})(?=\d)/g, "$1" + t) + (c ? d + Math.abs(n - i).toFixed(c).slice(2) : "");
			}
				if (typeof obj=='undefined')obj={};
			/*
				obj={
						unit,
						showUnit,
						decimals,
						max
						moneyformat(,),
						empty,
					}

			*/
			var extra='';
			
			if (obj.max && price==obj.max){
				switch(api.lang){
					case 'c':
						extra='或以上';
					break;
					case 'e':
					break;
				}
			}

			switch(typeof price){
				case 'string':
					price=parseFloat(price.replace(/,/g, ""));
				break;
			}
			
			if (price){
				switch(obj.unit){
					case '千萬':
						price=price/1000000;		
					break;
					case '百萬':
						price=price/1000000;		
					break;
					case '十萬':
						price=price/100000;		
					break;
					case '萬':
						price=price/10000;		
					break;
					case '千':

						price=price/1000;		
					break;
					case 'K':
					case 'k':
						price=price/1000;		
					break;
					case 'M':
					case 'm':
						price=price/1000000;		
					break;
					default:
					break;
				}

				if (obj.decimals||obj.decimals===0||obj.decimals==='0'){

					price=price.toFixed(obj.decimals);
				}

				if (obj.moneyformat){
					
					price=formatMoney(price,(obj.decimals||2));
				}				
				
				

				if (obj.unit&&obj.showUnit){
					price=price+obj.unit;
				}
				if (extra)
					price+=extra;
			}else {
				if (obj.empty)
					price=(obj.empty||'---');
			}
			return price; 
		}
	})
	.filter('numbertoDatabase',function(api){
		return function (price,unit,decimals,max){

			var extra='';
			if (max && price==max){
				switch(api.lang){
					case 'c':
						extra='+';
					break;
					case 'e':
					break;
				}
			}
			switch(typeof price){
				case 'string':
					price=parseFloat(price.replace(",", ""));
				break;
			}
			
			if (price)
			switch(unit){
				case '千萬':
					price=price/1000000;		
				break;
				case '百萬':
					price=price/1000000;		
				break;
				case '十萬':
					price=price/100000;		
				break;
				case '萬':
					price=price/10000;		
				break;
				case '千':

					price=price/1000;		
				break;
				case 'K':
				case 'k':
					price=price/1000;		
				break;
				case 'M':
				case 'm':
					price=price/1000000;		
				break;
			}

			if (decimals!=''){

				price=price.toFixed(decimals);
			}
			
			if (extra)
				price+=extra;
			return price; 
		}
	})
