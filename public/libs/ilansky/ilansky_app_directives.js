/**
 * Created by savenkoff on 11.01.2015.
 */
'use strict';

var ilnDrct = angular.module('ilansky.directives',[]);

/* Валидатор E-mail дреса */
ilnDrct.directive('serverValidator', ["$http", function($http) {
    return {
        require: 'ngModel',
        link: function(scope, elem, attr, ngModel) {
            if (!ngModel) return;
            var apiUrl = attr.serverValidator;
            function serverError(bool) {
                ngModel.$setValidity('serverError',bool);
            }
            ngModel.$parsers.push(function(value) {
                if (value == undefined || value == null || value.length == 0) {
                    return value;
                }
                serverError(true);
                $http.post(apiUrl,{
                    value: value
                }).success(function() {
                    serverError(true);
                }).error(function() {
                    serverError(false);
                    return undefined;
                });
                return value;
            });
        }
    }
}]);