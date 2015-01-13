/**
 * Created by savenkoff on 11.01.2015.
 */
'use strict';

var ilnDrct = angular.module('ilansky.directives',[]);

/* Валидатор E-mail дреса */
ilnDrct.directive('emailValidator', ["$http", "$timeout", function($http,$timeout) {
    return {
        scope: true,
        require: '?ngModel',
        link: function(scope, elem, attr, ngModel) {
            if (!ngModel) return;
            var apiUrl = attr.emailValidator;

            function recAvitable(bool) {
                ngModel.$setValidity('recAvailable',bool);
            }
            ngModel.$parsers.push(function(value) {
                if (!value || value.length == 0) {
                    return value;
                }
                recAvitable(false);
                $http.post(apiUrl,{
                    email: value
                }).success(function(data, status, headers, config) {
                    console.log(status);
                    recAvitable(true);
                }).error(function(data, status, headers, config) {
                    console.log(status);
                    recAvitable(false);
                });
                return value;
            });
        }
    }
}]);