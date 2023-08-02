angular.module('app', ['ngAnimate', 'ui.bootstrap', 'ngSanitize', 'popup'])
    .controller('appCtrl', ['$scope', '$injector', appCtrl])
    .config(['PopupSvcProvider', function(PopupSvcProvider) { //optionally configure popup svc

        PopupSvcProvider.setDefaults({
            //okText: 'Dismiss'
        });
    }]);

function appCtrl($scope, $injector) {
    var vm = this;

    vm.body = "<span class='text-success'>Hey!!</span>Modal width automatically adjust as per Message body length when you simply pass the string";
    vm.title = "Attention!";
    vm.subTitle = "You bet";

    var PopupSvc = $injector.get('PopupSvc');
    
    vm.showAndCloseSpinner = function() {
        var modal = PopupSvc.spin('Loading...');
        window.setTimeout(modal.close, 2000);
    };
    
    vm.showAndCloseSpinnerGlobal = function() {
        PopupSvc.spin('');
        window.setTimeout(PopupSvc.stopSpin, 2000);
    };

}