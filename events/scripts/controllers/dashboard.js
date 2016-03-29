angular.module('eventsApp')
.controller('dashboardCtrl', function($scope,$location){
    $scope.doSomething = function(){
        alert('working');
    }
});
