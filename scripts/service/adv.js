'use strict';

/**p
 * @ngdoc service
 * @name nodejsApp.adv
 * @description
 * # adv
 * Service in the nodejsApp.
 */
angular.module('nodejsApp')
	.service('adv', function adv($resource, base) {
		return $resource(base.url+'/ajax/getAdv.php',{}, {});
	});