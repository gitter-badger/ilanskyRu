/**
 * Created by savenkoff on 08.01.2015.
 */

'use strict';

var ilansky = angular.module('ilansky',["ilansky.controllers","ilansky.directives","ilansky.services"]);

ilansky.config(["$httpProvider", function($httpProvider) {
    $httpProvider.defaults.headers.common['X-CSRF-TOKEN'] = $('meta[name=csrf-token]').attr('content');
}]);

ilansky.constant("validationClassConfig", {
    validClass: "has-success",
    invalidClass: "has-error"
});