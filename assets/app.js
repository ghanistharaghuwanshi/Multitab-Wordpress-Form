var customApp = angular.module("angularApp", ["ngRoute"]);
customApp.constant('base_url', 'http://wp.ktec.co.il/wp-content/plugins/angularPlugin/assets');
customApp.config(function($routeProvider,$locationProvider, base_url) {
	$locationProvider.hashPrefix(''); 
    $routeProvider
    .when("/", {
        templateUrl : base_url+"/form.html",
        controller : "formController"
    }).when("/2", {
        templateUrl : base_url+"/form2.html",
        controller : "form2Controller"
    }).when("/3", {
        templateUrl : base_url+"/form3.html",
        controller : "form3Controller"
    }).when("/4", {
        templateUrl : base_url+"/form4.html",
        controller : "form4Controller"
    }).when("/5", {
        templateUrl : base_url+"/form5.html",
        controller : "form5Controller"
    });
   
});
customApp.controller('formController',['$scope', '$rootScope','$location',function($scope,$rootScope,$location){
  $scope.registration = function(){
        $rootScope.register = $scope.register;
        $location.path('/2');
  };
}]);
customApp.controller('form2Controller',['$scope', '$rootScope','$location',function($scope,$rootScope,$location){
  $scope.registration2 = function(){
        $rootScope.register2 = $scope.register2;
        $location.path('/3');
  };
}]);
customApp.controller('form3Controller',['$scope', '$rootScope','$location',function($scope,$rootScope,$location){
  $scope.registration3 = function(){
        $rootScope.register3 = $scope.register3;
        $location.path('/4');
  };
}]);
customApp.controller('form4Controller',['$scope', '$rootScope','$location',function($scope,$rootScope,$location){
  $scope.registration4 = function(){
        $rootScope.register4 = $scope.register4;
        $location.path('/5');
  };
}]);
customApp.controller('form5Controller',['$scope', '$rootScope','$location',function($scope,$rootScope,$location){
  console.log($rootScope.register5);
}]);

