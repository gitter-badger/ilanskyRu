/**
 * Created by savenkoff on 11.01.2015.
 */
'use strict';

var ilnDrct = angular.module('ilansky.directives',[]);

/* Валидатор E-mail дреса */
ilnDrct.directive('emailValidator', ["$http", "$timeout", function($http,$timeout) {
    return {
        require: 'ngModel',
        link: function(scope, elem, attr, ngModel) {
            var apiUrl = attr.emailValidator;






            function recAvitable(bool) {
                ngModel.$setValidity('recAvailable',bool);
            }
            ngModel.$parsers.push(function(value) {
                if (!value || value.length == 0) {
                    ngModel.$setValidity('required',false);
                    return;
                }
                recAvitable(false);
                $http.get(apiUrl,{
                    v: value
                }).success(function(data, status, headers, config) {
                    console.log('success');
                    console.log('Status');
                    console.log(status);
                    console.log('Data');
                    console.log(data);
                    recAvitable(true);
                }).error(function(data, status, headers, config) {
                    console.log('error');
                    console.log('Status');
                    console.log(status);
                    console.log('Data');
                    console.log(data);
                    recAvitable(false);
                });
                console.log(value);
                return value;
            });
        }
    }
}]);