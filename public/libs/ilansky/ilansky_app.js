/**
 * Created by savenkoff on 08.01.2015.
 */

'use strict';

var ilansky = angular.module('ilansky',["ilansky.controllers"]);

ilansky.config(["$httpProvider", function($httpProvider) {
    $httpProvider.defaults.headers.common['X-CSRF-TOKEN'] = $('meta[name=csrf-token]').attr('content');
}]);