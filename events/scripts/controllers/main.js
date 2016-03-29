// app main controller
angular.module('eventsApp')
.controller('mainCtrl', function($scope, $route, $routeParams, $location){
    $scope.$route = $route;
    $scope.$location = $location;
    $scope.$routeParams = $routeParams;
});
