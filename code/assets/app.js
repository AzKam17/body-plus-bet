import './styles/app.css';
import './bootstrap';

import angular from 'angular';

console.log('Hello World!');

//Create AngularJS App
let app = angular.module('myApp', [
    require('angular-route')
]);
//Change the default AngularJS interpolation symbols with //
app.config(['$interpolateProvider', function($interpolateProvider) {
    $interpolateProvider.startSymbol('//');
    $interpolateProvider.endSymbol('//');
}])
.config(['$locationProvider', '$routeProvider', function($locationProvider, $routeProvider) {
    $locationProvider.html5Mode({
        enabled: true,
        requireBase: false
    });
    $routeProvider
        .when('/home', {
            //Get the template from the server url
            templateUrl: '/frags/home',
            controller: 'myCtrl'
        }).when('/about', {
            template: '<h1>About</h1>'
        })
}])

.controller('myCtrl', ['$scope', function($scope) {
    $scope.message = 'Hello World';
}]);