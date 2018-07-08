var app = angular.module('myApp', []);

app.controller('myController', function ($scope, $sce, $http) {

	// on load variables
	$scope.showDevicesOnLoad = true;
	$scope.showDevicesOnSearch = false;
	$scope.showNoDataResult = false;
	// ends here ~ old load variables

	// search device function
	$scope.searchDevices = function () {
		$scope.searchDevice = []
		var req = {
			method: 'GET',
			url: 'https://fonoapi.freshpixl.com/v1/getdevice' + '?token=50b480d7c10f5494e7b0e9572598cd2208c8df2bd7d86512&device=' + $('.devname').val(),
		}
		$http(req).then(function (result) {
			if(result.data.length == undefined || result.data.length == 0) {
				$scope.showNoDataResult = true
				$scope.showDevicesOnLoad = false;
				$scope.showDevicesOnSearch = false;
			} else{
				for (var i = 0; i < result.data.length; i++) {
					$scope.searchDevice.push(result.data[i])
				}
				$scope.showDevicesOnLoad = false;
				$scope.showNoDataResult = false
				$scope.showDevicesOnSearch = true;
			}
		})
		

	}
	// ends here ~ search device function


	// get all devices on load function
	$scope.allBrandsName = ['nokia', 'sony','asus', 'lenovo', 'apple', 'samsung', 'redmi', 'oppo', 'alcatel', 'huawei', 'videocon']
	
	// shuffle array
	$scope.allBrandsName.sort(function(a, b){return 0.5 - Math.random()});
	// ends here ~ shuffle array

	$scope.allDevices = []
	var brandIndex = 0
	
	$scope.getAllDevices = function () {
		if ($scope.allBrandsName.length > brandIndex) {
			var req = {
				method: 'GET',
				url: 'https://fonoapi.freshpixl.com/v1/getdevice' + '?token=50b480d7c10f5494e7b0e9572598cd2208c8df2bd7d86512&device=' + $scope.allBrandsName[brandIndex],
			}
			$http(req).then(function (result) {
				for (var i = 0; i < result.data.length; i++) {
					$scope.allDevices.push(result.data[i])
				}
			})
			brandIndex++;
		}
	}
	// ends here ~ get all devices on load function


	// detects end of div on scroll reaching to bottom
	var margin = 4
	jQuery(function ($) {
		$('#completeDeviceInfoSection').on('scroll', function () {
			if (Math.round($(this).scrollTop() + $(this).innerHeight(), 10) >= Math.round($(this)[0].scrollHeight, 10) - margin) {
				$scope.getAllDevices()
			}
		})
	});
	// ends here ~ detects end of div on scroll reaching to bottom


	// get complete device info on click 
	$scope.getDeviceCompleteInfo = function (index) {
		$scope.completeDeviceInfo = $scope.allDevices[index]
	}
	// ends here ~ get complete device info on click 

	// get search complete device info on click 
	$scope.getSearchDeviceCompleteInfo = function (index) {
		$scope.completeDeviceInfo = $scope.searchDevice[index]
	}
	// ends here ~ get complete device info on click 

});