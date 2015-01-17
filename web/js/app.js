'use strict';

var app = angular.module('cfashion',['ui.bootstrap','ngRoute', 'ngCookies', 'ngMaterial']);

app.config(['$routeProvider', '$locationProvider', function($routeProvider, $locationProvider) {
    $routeProvider.when('/list', {
        templateUrl: 'partials/list.html',        
        controller: 'ProductsController'
    });    
    $routeProvider.when('/page/:id_product', {
        templateUrl: 'partials/page.html',
        controller: 'ProductsController'
    });        
    $routeProvider.otherwise({
        redirectTo: '/list'
    });
    //$locationProvider.html5Mode({enabled: true, requireBase: false});
    $locationProvider.hashPrefix('!');
}]);
