customApp.controller('customerRegistration', ['$scope','$route','$timeout', function($scope, $route, $timeout){
	$scope.register ={
		firstname: '',
		lastname: '',
		mobile:'',
		pin:'',
	}
	$scope.onSubmit = false;
	$scope.registration = function(){
		$scope.onSubmit = true;
		$scope.Message = "Your are Successfully register !";
		$timeout(function(){
			$route.reload();
		}, 2000);
	}
}]);

customApp.controller('customerRegistration3', ['$scope','$route','$timeout', function($scope, $route, $timeout){
	$scope.register2 ={
		email: '',
	}
	$scope.onSubmit = false;
	$scope.registration3 = function(){
		$scope.onSubmit = true;
		$scope.Message = "Your are Successfully register !";
		$timeout(function(){
			$route.reload();
		}, 2000);
	}
}]);

customApp.controller('customerRegistration5', ['$scope','$route','$timeout', function($scope, $route, $timeout){
	$scope.register5 ={
		firstname: '',
		lastname: '',
		mobile:'',
		pin:'',
	}
	$scope.onSubmit = false;
	$scope.registration5 = function(){
		$scope.onSubmit = true;
		$scope.Message = "Your are Successfully register !";
		$timeout(function(){
			$route.reload();
		}, 2000);
	}
}]);

var compareTo = function() {
    return {
        require: "ngModel",
        scope: {
            otherModelValue: "=compareTo"
        },
        link: function(scope, element, attributes, ngModel) {
             
            ngModel.$validators.compareTo = function(modelValue) {
                return modelValue == scope.otherModelValue;
            };
 
            scope.$watch("otherModelValue", function() {
                ngModel.$validate();
            });
        }
    };
};
 
module.directive("compareTo", compareTo);