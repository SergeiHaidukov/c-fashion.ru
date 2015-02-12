'use strict';
var app = angular.module('cfashion',['ui.bootstrap','ngRoute', 'ngCookies', 'ngMaterial']);

app.run(function(){
    console.log("::use::run");
  });

app.config(['$routeProvider', '$locationProvider', function($routeProvider, $locationProvider) {
    $routeProvider.when('/list', {
        templateUrl: 'partials/list.html',        
        controller: 'ProductsController'
    });    
    $routeProvider.when('/page/:id_product', {
        templateUrl: 'partials/page.html',
        controller: 'ProductsController'
    });        
    $routeProvider.when('/contact', {
        templateUrl: 'partials/contact.html',        
    });
    $routeProvider.otherwise({
        redirectTo: '/list'
    });
    //$locationProvider.html5Mode({enabled: true, requireBase: false});
    $locationProvider.hashPrefix('!');
}]);

//angular.element(document).ready(function(){        
//    console.log("::prepare");
//    
//    var $inj = angular.bootstrap(document.body, ['cfashion']);
//    var $rootScope = $inj.get("$rootScope");
//    
//    console.log("::loaded");
//    
//    $rootScope.$broadcast("init");
//    $rootScope.$digest();
//    
//    
//     console.log("::finalize");
//});




