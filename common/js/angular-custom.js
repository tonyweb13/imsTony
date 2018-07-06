'use strict';

angular.module("internationalPhoneNumber", []).directive('internationalPhoneNumber', function($timeout) {
    return {
        restrict: 'A',
        require: '^ngModel',
        scope: {
            ngModel: '=',
            defaultCountry: '@'
        },
        link: function(scope, element, attrs, ctrl) {
            var handleWhatsSupposedToBeAnArray, options, read, watchOnce;
            read = function() {
                return ctrl.$setViewValue(element.val());
            };
            handleWhatsSupposedToBeAnArray = function(value) {
                if (value instanceof Array) {
                    return value;
                } else {
                    return value.toString().replace(/[ ]/g, '').split(',');
                }
            };

            options = {
                onlyCountries: void 0,
                preferredCountries: ['th', 'kr'],
                autoFormat: true,
                autoHideDialCode: true,
                responsiveDropdown: false,
                nationalMode:true,
                utilsScript: "/common/js/utill.js"
            };

            angular.forEach(options, function(value, key) {
                var option;
                if (!(attrs.hasOwnProperty(key) && angular.isDefined(attrs[key]))) {
                    return;
                }
                option = attrs[key];
                if (key === 'preferredCountries') {
                    return options.preferredCountries = handleWhatsSupposedToBeAnArray(option);
                } else if (key === 'onlyCountries') {
                    return options.onlyCountries = handleWhatsSupposedToBeAnArray(option);
                } else if (typeof value === "boolean") {
                    return options[key] = option === "true";
                } else {
                    return options[key] = option;
                }
            });
            watchOnce = scope.$watch('ngModel', function(newValue) {
                return scope.$$postDigest(function() {
                    options.defaultCountry = scope.defaultCountry;
                    if (newValue !== null && newValue !== void 0 && newValue !== '') {
                        element.val(newValue);
                    }
                    element.intlTelInput(options);
                    if (!(attrs.skipUtilScriptDownload !== void 0 || options.utilsScript)) {
                        element.intlTelInput('loadUtils', '/common/js/utill.js');
                    }
                    return watchOnce();
                });
            });
            ctrl.$formatters.push(function(value) {
                if (!value) {
                    return value;
                } else {
                    $timeout(function() {
                        return element.intlTelInput('setNumber', value);
                    }, 0);
                    return element.val();
                }
            });
            ctrl.$parsers.push(function(value) {
                if (!value) {
                    return value;
                }
                return value.replace(/[^\d]/g, '')
            });
            ctrl.$validators.internationalPhoneNumber = function(value) {
                if (!value) {
                    return value;
                } else {
                    return element.intlTelInput("isValidNumber");
                }
            };

            element.on('blur keyup change', function(event) {
                return scope.$apply(read);
            });
            return element.on('$destroy', function() {
                element.intlTelInput('destroy');
                return element.off('blur keyup change');
            });
        }
    };
});

angular.module('ngSweetAlert', [])
    .factory('SweetAlert', [ '$rootScope', function ( $rootScope ) {
        var swal = window.swal;
        //public methods
        var self = {
            swal: function ( arg1, arg2, arg3 ) {
                $rootScope.$evalAsync(function(){
                    if( typeof(arg2) === 'function' ) {
                        swal( arg1, function(isConfirm){
                            $rootScope.$evalAsync( function(){
                                arg2(isConfirm);
                            });
                        }, arg3 );
                    } else {
                        swal( arg1, arg2, arg3 );
                    }
                });
            },
            success: function(title, message) {
                $rootScope.$evalAsync(function(){
                    swal( title, message, 'success' );
                });
            },
            error: function(title, message) {
                $rootScope.$evalAsync(function(){
                    swal( title, message, 'error' );
                });
            },
            warning: function(title, message) {
                $rootScope.$evalAsync(function(){
                    swal( title, message, 'warning' );
                });
            },
            info: function(title, message) {
                $rootScope.$evalAsync(function(){
                    swal( title, message, 'info' );
                });
            }
        };
        return self;
}]);

var app = angular.module('casinoApp', ['ngSweetAlert','ngCurrencySymbol','ngRoute','ngCookies','ui.bootstrap','ngDialog','internationalPhoneNumber','pascalprecht.translate','ngCookies','validation','validation.rule'])
.config(['$translateProvider', function($translateProvider){

    $translateProvider.useStaticFilesLoader({
        prefix: 'common/js/resources/locale-',
        suffix: '.json'
    });

    //Default Browser Language
    var langKey = window.navigator.userLanguage || window.navigator.language;

        if(langKey == "th_TH" || langKey == "th" || langKey == "th-TH"){
            var langKey = "th_TH";
            $('#language-flag').html('<i class="icon-lang language-th"></i>');
        }else if(langKey == "zh_CN" || langKey == "zh" || langKey == "zh-CN"){
            var langKey = "zh_CN";
            $('#language-flag').html('<i class="icon-lang language-zh"></i>');
        }else if(langKey == "ko_KR" || langKey == "ko" || langKey == "ko-KR"){
            var langKey = "ko_KR";
            $('#language-flag').html('<i class="icon-lang language-ko"></i>');
        }else{
            var langKey = "en_US";
            $('#language-flag').html('<i class="icon-lang language-en"></i>');
        }

    // Tell the module what language to use by default
    $translateProvider.preferredLanguage(langKey);

    // Tell the module to store the language in the local storage
    $translateProvider.useLocalStorage();
    $translateProvider.useSanitizeValueStrategy('escaped');

}]);


app.isUndefinedOrNull = function(val) {
    return angular.isUndefined(val) || val === null
};

app.config(['$routeProvider', function($routeProvider) {
    $routeProvider
        .when('/', {
            templateUrl : '/pages/main.php',
            controller  : 'MainController'
        })
        .when('/slot', {
            templateUrl : '/pages/slot.php',
            controller  : 'SlotController'
        })
        .when('/sports', {
            templateUrl : '/pages/sports.php',
            controller  : 'SportsController'
        })
        .when('/promotion', {
            templateUrl : '/pages/promo.php',
            controller  : 'PromoController'
        })
        .otherwise({
            redirectTo: '/'
        });
}]);

app.service("Balance",function($rootScope,$http,$window,SweetAlert,loggedInStatus){
    return{
        getBalance: function(type){
            if(type=="all"){
                $http.get("/api/finance/GetBalance")
                    .success(function(data) {
                        if(data.status==200) {
                            $rootScope.mainBalance=data.result.mainBalance;
                            $rootScope.gspBalanceList=data.result.gspBalance;
                        }else{
                            if(data.alert){
                                if (bowser.msie && bowser.version <= 8) {
                                    alert(data.message);
                                }else{
                                    SweetAlert.swal(data.message, "Please try again", "error");
                                }
                            }
                        }
                    }).error(function(data, status) {
                        console.error('Repos error', status, data);
                    })["finally"](function(){

                });
            }else if(type=="single"){
                $http.get("/api/finance/GetMainBalance")
                    .success(function(data) {
                        if(data.status==200) {
                            $rootScope.mainBalance=data.result.mainBalance;
                        }else{
                            if(data.alert){
                                $http.get("/api/player/Logout")
                                    .success(function(data) {
                                        if (bowser.msie && bowser.version <= 8) {
                                            alert(data.message);
                                        }else{
                                            SweetAlert.swal(data.message,"", "success");
                                        }
                                        loggedInStatus.setLoggedOutStatus();
                                    })["finally"](function(){
                                    $window.location.reload();
                                });
                            }
                        }
                    }).error(function(data, status) {
                        console.error('Repos error', status, data);
                    })["finally"](function(){
                    $scope.isProcessing=false;
                });
            }
        }
    }
});


app.service('loggedInStatus', function ($rootScope) {
    return {
        setLoggedInStatus: function () {
            $rootScope.loggedIn = true;
            $rootScope.loggedOut = false;
        },
        setLoggedOutStatus: function(){
            $rootScope.loggedIn = false;
            $rootScope.loggedOut = true;
        }
    };
});


app.controller("HeaderController", function ($scope,$rootScope,loggedInStatus) {
    $scope.stillLoggedIn = function(){
        loggedInStatus.setLoggedInStatus();
    };
});

app.controller("NavController", function($scope,$rootScope,$location) {
    $scope.isActive = function (viewLocation) {
        return viewLocation === $location.path();
    };
});

app.controller("CommonController",function($rootScope,$scope,$http,$q,ccCurrencySymbol,$location,ngDialog,$translate){
    $scope.setLang = function(langKey) {

        if(langKey == "th_TH" || langKey == "th" || langKey == "th-TH"){
            $('#language-flag').html('<i class="icon-lang language-th"></i>');
        }else if(langKey == "zh_CN" || langKey == "zh" || langKey == "zh-CN"){
            $('#language-flag').html('<i class="icon-lang language-zh"></i>');
        }else if(langKey == "ko_KR" || langKey == "ko" || langKey == "ko-KR"){
            $('#language-flag').html('<i class="icon-lang language-ko"></i>');
        }else{
            $('#language-flag').html('<i class="icon-lang language-en"></i>');
        }

        // You can change the language during runtime
        $translate.use(langKey);
    };

    $rootScope.cc_currency_symbol = ccCurrencySymbol;
    $rootScope.getQuestion={};
    $rootScope.getCurency={};
    $rootScope.getCountries={};
    $rootScope.getLanguages={};
    $rootScope.getBankList={};
    $rootScope.getAgentGspList={};
    $rootScope.getAgentCasinoGameList={};
    $rootScope.getAgentSportsGameList={};
    $rootScope.getAgentSlotList={};
    $rootScope.getAgentPokerGameList={};
    $rootScope.getAgentOtherList={};
    $rootScope.getAnouncementList={};
    $scope.topWithdrawalList={};
    $scope.currentDepositList={};
    $scope.currentWithdrawalList={};
    $scope.genderList=[
        {"genderNo" : "1","genderName" : "Male"},
        {"genderNo" : "2","genderName" : "Female"}];
    $rootScope.getAgentGspList={};
    $scope.init = function(){
        $q.all([
            $http.get("/api/operation/GetAnnouncements?announceTypeCd=1", {cache: true})
            .success(function (data) {
                if (data.status == 200) {
                    $scope.getAnouncementList = data.result.announcementList;
                }
            }).error(function (data, status) {
                console.error('Repos error', status, data);
            }),
            $http.get("/api/system/GetAgentGspList", {cache: true})
            .success(function (data) {
                if (data.status == 200) {
                    //console.log(data.result);
                    $rootScope.getAgentGspList = data.result.gspList;
                    //console.log($rootScope.getAgentGspList);
                }
            }).error(function (data, status) {
                console.error('Repos error', status, data);
            }),
            $http.get("/api/system/GetAgentGspGameList", {cache: true})
            .success(function (data) {
                if (data.status == 200) {
                    if(data.result.productList[0] != undefined){$rootScope.getAgentCasinoGameList=  data.result.productList[0].gspList;}
                    if(data.result.productList[1] != undefined){$rootScope.getAgentSlotList=  data.result.productList[1].gspList;}
                    if(data.result.productList[2] != undefined){$rootScope.getAgentSportsGameList=  data.result.productList[2].gspList;}
                    if(data.result.productList[3] != undefined){$rootScope.getAgentPokerGameList=  data.result.productList[3].gspList;}
                    if(data.result.productList[4] != undefined){$rootScope.getAgentOtherList=  data.result.productList[4].gspList;}
                }
            }).error(function (data, status) {
                console.error('Repos error', status, data);
            })
        ]);


    };

    $scope.displaySignUp = function() {
        ngDialog.close();
        ngDialog.open({
            template: '/popup/signup.php',
            controller: 'SignUpController',
            className: 'ngdialog-theme-default ngdialog-signup',
            scope: $scope
        });
        $q.all([
            $http.get("/api/system/GetCurrencyList",{cache: true})
                .success(function(data) {
                    if(data.status==200) {
                        $scope.getCurency = data.result.currencyList;
                    }
                }).error(function(data, status) {
                    console.error('Repos error', status, data);
                }),
            $http.get("/api/system/GetAgentCountryList",{cache: true})
                .success(function(data) {
                    if(data.status==200) {
                        $scope.getCountries = data.result.countryList;
                    }
                }).error(function(data, status) {
                    console.error('Repos error', status, data);
                }),
            $http.get("/api/system/GetSecurityQuestionList",{cache: true})
                .success(function(data) {
                    if(data.status==200) {
                        $scope.getQuestion = data.result.securityQstList;
                    }
                }).error(function(data, status) {
                    console.error('Repos error', status, data);
                }),
            $http.get("/api/system/GetLanguageList",{cache: true})
                .success(function(data) {
                    if(data.status==200) {
                        $scope.getLanguages = data.result.languageList;
                    }
                }).error(function(data, status) {
                    console.error('Repos error', status, data);
                })
        ]);

        $scope.signup = function () {
            //Scripts
            $('.tooltip').hide();
            $('.icon-tip-currency').hover(function(){ $('.tooltipCurrency').show();}, function() {$('.tooltipCurrency').hide(); });

            $('.terms-container').hide();
            $('.link-terms').click(function() {
                $('.terms-container').fadeIn(20);
            });
            $('.terms-container h1 i').click(function() {
                $('.terms-container').fadeOut(20);
            });

            $(".terms-content").mCustomScrollbar({scrollInertia:200});
        }
    };

    $scope.displayForgotPass = function() {
        ngDialog.close();
        ngDialog.open({
            template: '/popup/forgotpass.php',
            className: 'ngdialog-theme-default ngdialog-forgotpass'
        });
    };

    $('.news-ticker').easyTicker({
        direction: 'up',
        easing: 'easeInOutBack',
        speed: 'slow',
        interval: 2000,
        height: 'auto',
        visible: 1,
        mousePause: 1
    }).data('easyTicker');

    $scope.page = $location.search();
    if($scope.page.redirectPage != undefined){
        angular.element(document).ready(function () {
            if($scope.page.redirectPage == "deposit"){
                $scope.displayWallet(2);
            }else if($scope.page.redirectPage == "withdrawal"){
                $scope.displayWallet(3);
            }
        });
    }

    $scope.displayWallet = function(tabIndex) {
        $scope.selectWalletTab=tabIndex;
        if($rootScope.loggedIn){
            ngDialog.open({
                template: '/popup/wallet.php',
                controller: 'WalletController',
                className: 'ngdialog-theme-default ngdialog-wallet',
                scope: $scope
            });
            $scope.walletPopup = function () {
                $('.tooltip').hide();
                $('.icon-tip-mainwallet').hover(function(){ $('.tooltipMainWallet').show();}, function() {$('.tooltipMainWallet').hide(); });
                $("#popup-wallet div.popup-content").mCustomScrollbar({scrollInertia:200});
            }
        }else{
            ngDialog.open({
                template: '/popup/login.php',
                controller: 'LoginController',
                className: 'ngdialog-theme-default ngdialog-login',
                scope: $scope
            });
        }
    };

    $scope.displayCustomer = function(tabIndex) {
        $scope.selectCustomerTab=tabIndex;
        ngDialog.open({
            template: '/popup/customer.php',
            controller: 'CustomerController',
            className: 'ngdialog-theme-default ngdialog-customer',
            scope: $scope
        });
        $scope.customerPopup = function () {
            $("#popup-customer div.popup-content").mCustomScrollbar({scrollInertia: 200});
            $(".partnership-banner").owlCarousel({
                autoPlay : true,
                pagination : true,
                navigation : false,
                slideSpeed : 300,
                paginationSpeed : 400,
                singleItem: true
            });
        }
    };
});

app.controller("MainController",function($rootScope,$scope,$http,$q){
    $scope.contactEmailList={};
    $scope.contactPhoneList={};
    $scope.contactSnsList={};
    $scope.page={};
    $scope.init=function() {
        $q.all([
            $http.get("/api/agent/GetAgentContactInfo", {cache: true})
            .success(function (data) {
                if (data.status == 200) {
                    $scope.contactEmailList = data.result.contactEmailList;
                    $scope.contactPhoneList = data.result.contactPhoneList;
                    $scope.contactSnsList = data.result.contactSnsList;
                }
            }).error(function (data, status) {
                console.error('Repos error', status, data);
            }),
            $http.get("/api/finance/GetPaymentTransactionHistory?count=4", {cache: true})
            .success(function (data) {
                if (data.status == 200) {
                    $scope.topWithdrawalList = data.result.topWithdrawalList;
                    $scope.currentDepositList = data.result.currentDepositList;
                    $scope.currentWithdrawalList = data.result.currentWithdrawalList;
                }
            }).error(function (data, status) {
                console.error('Repos error', status, data);
            })["finally"](function(){
                $("#transaction-slider").owlCarousel({
                    autoPlay : true,
                    pagination : true,
                    navigation : false,
                    slideSpeed : 300,
                    paginationSpeed : 400,
                    singleItem: true
                });

                $('.game-button').hover(function(){
                    $(this).find('.game-button-overlay').fadeIn('fast');
                }, function() {
                    $(this).find('.game-button-overlay').fadeOut('fast');
                });

                //deposit withdrawal progress bar
                function progressBar(percent, $element) {
                    var progressBarWidth = percent * $element.width() / 100;
                    $element.find('div').animate({ width: progressBarWidth }, 500).html(percent + "%&nbsp;");
                }
                progressBar(20, $('#depositBar'));
                progressBar(50, $('#withdrawBar'));
            })
        ]);

    };

    $("#promo-slider").owlCarousel({
        autoPlay : true,
        pagination : true,
        navigation : false,
        slideSpeed : 300,
        paginationSpeed : 400,
        singleItem: true
    });

    //Progressive Jackpot
    $('.pjackpot').jOdometer({
        increment: 0.01,
        counterStart:'8215730.24',
        counterEnd:'9211730.24',
        numbersImage: '/common/images/jodometer-numbers-gold.png',
        spaceNumbers: 0,
        formatNumber: true,
        widthNumber: 38,
        heightNumber: 60
    });
});

app.controller("ForgotPasswordController", function ($scope,$http,SweetAlert) {
    $scope.getQuestion={};
    $scope.forgotPwd={};
    $scope.getTempPwd={};
    $scope.correctInfo=false;
    $scope.isProcessing=false;

    $http.get("/api/system/GetSecurityQuestionList",{cache: true})
    .success(function(data) {
        if(data.status==200) {
            $scope.getQuestion = data.result.securityQstList;
        }
    }).error(function(data, status) {
        console.error('Repos error', status, data);
    });


    $scope.processForm = function(){
        $scope.isProcessing=true;
        var url = "/api/player/ForgotPassword";
        $http({
            method: 'POST',
            url: url,
            data: $.param($scope.forgotPwd),  // pass in data as strings
            headers: { 'Content-Type': 'application/x-www-form-urlencoded' }  // set the headers so angular passing info as form data (not request payload)
        }).success(function(data) {
            if(data.status==200) {
                $scope.getTempPwd=data.result.tempPassword;
                $scope.correctInfo=true;
            }else{
                if(data.alert){
                    if (bowser.msie && bowser.version <= 8) {
                        alert(data.message);
                    }else{
                        SweetAlert.swal(data.message, "Please try again", "error");
                    }
                }
            }
        }).error(function(data, status) {
            console.error('Repos error', status, data);
        })["finally"](function(){
            $scope.isProcessing=false;
        });
    }

});

app.controller("ForgotNicknameController", function ($scope,$http,SweetAlert) {
    $scope.forgotNick={};
    $scope.correctInfo=false;
    $scope.isProcessing=false;

    $scope.processForm = function(){
        $scope.isProcessing=true;
        var url = "/api/player/ForgotNickname";
        $http({
            method: 'POST',
            url: url,
            data: $.param($scope.forgotNick),  // pass in data as strings
            headers: { 'Content-Type': 'application/x-www-form-urlencoded' }  // set the headers so angular passing info as form data (not request payload)
        }).success(function(data) {
            if(data.status==200) {
                $scope.getNickNameList=data.result.nicknameList;
                $scope.correctInfo=true;
            }else{
                if(data.alert){
                    if (bowser.msie && bowser.version <= 8) {
                        alert(data.message);
                    }else{
                        SweetAlert.swal(data.message, "Please try again", "error");
                    }
                }
            }
        }).error(function(data, status) {
            console.error('Repos error', status, data);
        })["finally"](function(){
            $scope.isProcessing=false;
        });
    }
});




app.controller("CustomerController", function($scope) {
    //$scope.tab=1;

    $scope.isSet = function(checkTab) {
        return $scope.tab === checkTab;
    };

    $scope.setTab = function(setTab) {
        $scope.tab = setTab;
    };
});

app.controller("LogoutController",function($scope,$http,$window,SweetAlert,loggedInStatus){
    $scope.isProcessing=false;
    $scope.logout =function(){
        $scope.isProcessing=true;
        $http.get("/api/player/Logout")
        .success(function(data) {
            if(data.status==200) {
                if (bowser.msie && bowser.version <= 8) {
                    alert(data.message);
                }else{
                    SweetAlert.swal(data.message, "", "success");
                }
                loggedInStatus.setLoggedOutStatus();
                $window.location.reload();
            }else{
                if(data.alert){
                    if (bowser.msie && bowser.version <= 8) {
                        alert(data.message);
                    }else{
                        SweetAlert.swal(data.message, "Please try again", "error");
                    }
                }
            }
        }).error(function(data, status) {
            console.error('Repos error', status, data);
        })["finally"](function(){
            $scope.isProcessing=false;
        });
    }
});

app.controller("BalanceController",function($scope,$rootScope,$interval,Balance){
    if($rootScope.loggedIn){
        $scope.init = function(){
            Balance.getBalance("all");
            $interval( function(){ Balance.getBalance("single"); }, 10000);
        };
        $scope.reloadBalance = function(){
            $scope.isProcessing=true;
            Balance.getBalance("all");
        };
        $scope.loadImsBalance = function(){
            Balance.getBalance("single");
        };
    }
});

app.controller("LoginController",
    function($scope,$http,$window,SweetAlert,loggedInStatus){
        $scope.loginForm = {};
        $scope.isProcessing=false;
        $scope.processForm = function() {
            $scope.isProcessing=true;
            var width = (screen.width) ? screen.width:'';
            var height = (screen.height) ? screen.height:'';
            // check for windows off standard dpi screen res
            if (typeof(screen.deviceXDPI) == 'number') {
                width *= screen.deviceXDPI/screen.logicalXDPI;
                height *= screen.deviceYDPI/screen.logicalYDPI;
            }

            var visitorTime = moment().format("YYYY-MM-DDTHH:mm:ss.SSSZZ");
            $scope.userInfo = {"clientLocalTime":visitorTime,"screenWidth":width,screenHeight:height};
            angular.extend($scope.loginForm,$scope.userInfo);

            var url = "/api/player/Login";
            $http({
                method: 'POST',
                url: url,
                data: $.param($scope.loginForm),  // pass in data as strings
                headers: { 'Content-Type': 'application/x-www-form-urlencoded' }  // set the headers so angular passing info as form data (not request payload)
            }).success(function(data) {
                if(data.status==200) {
                    loggedInStatus.setLoggedInStatus();
                    $window.location.reload();
                }else{
                    if(data.alert){
                        if (bowser.msie && bowser.version <= 8) {
                            alert(data.message);
                        }else{
                            SweetAlert.swal(data.message, "Please try again", "error");
                        }
                    }
                }
            }).error(function(data, status) {
                console.error('Repos error', status, data);
            })["finally"](function(){
                $scope.isProcessing=false;
            });
        };
    }
);

//for SignUp
app.controller("SignUpController",function($scope,$http,$window,SweetAlert){
    $scope.isProcessing = undefined;//Disabled button after call ajax function
    $scope.signForm = {};
    $scope.userInfo = {};
    $scope.Years = {};
    $scope.isProcessing=false;
    $scope.processForm = function() {
        $scope.isProcessing=true;
        $scope.signForm.phone=$("#signUpPhone").intlTelInput("getNumber");
        var width = (screen.width) ? screen.width:'';
        var height = (screen.height) ? screen.height:'';
        // check for windows off standard dpi screen res
        if (typeof(screen.deviceXDPI) == 'number') {
            width *= screen.deviceXDPI/screen.logicalXDPI;
            height *= screen.deviceYDPI/screen.logicalYDPI;
        }
        var visitorTime = moment().format("YYYY-MM-DDTHH:mm:ss.SSSZZ");
        $scope.userInfo = {"clientLocalTime":visitorTime,"screenWidth":width,screenHeight:height};
        angular.extend($scope.signForm,$scope.userInfo);

        var url = "/api/player/SignUp";
        $http({
            method: 'POST',
            url: url,
            data: $.param($scope.signForm),  // pass in data as strings
            headers: { 'Content-Type': 'application/x-www-form-urlencoded' }  // set the headers so angular passing info as form data (not request payload)
        }).success(function(data) {
            if(data.status==200) {
                $window.location.reload();
            }else{
                if(data.alert){
                    if (bowser.msie && bowser.version <= 8) {
                        alert(data.message);
                    }else{
                        SweetAlert.swal(data.message, "Please try again", "error");
                    }
                }
            }
        }).error(function(data, status) {
            console.error('Repos error', status, data);
        })["finally"](function(){
            $scope.isProcessing=false;
        });
    };

    //var numberOfYears = (new Date()).getYear() - 18;
    //var years = $.map($(Array(numberOfYears)), function (val, i) {var year = i + 1900; if(numberOfYears <= year){return i + 1900;}}).reverse();

    var numberOfYears = new Date().getFullYear()-18;
    var numberOfRange = 90;
    var years = $.map($(Array(numberOfRange)),function(val,i){
            return numberOfYears-i;
    });

    var months = $.map($(Array(12)), function (val, i) { return i + 1; });
    var days = $.map($(Array(31)), function (val, i) { return i + 1; });

    var isLeapYear = function () {
        var year = $scope.signForm.birthYear || 0;
        return ((year % 400 === 0 || year % 100 !== 0) && (year % 4 === 0)) ? 1 : 0;
    };

    var getNumberOfDaysInMonth = function () {
        var selectMonths = $scope.signForm.birthMonth || 0;
        return 31 - ((selectMonths === 2) ? (3 - isLeapYear()) : ((selectMonths - 1) % 7 % 2));
    };

    $scope.UpdateNumberOfDays = function () {
        $scope.NumberOfDays = getNumberOfDaysInMonth();
    };

    $scope.Years = years;
    $scope.Months = months;
    $scope.Days = days;
    $scope.NumberOfDays = 31;

});

//Email Validation
app.directive('validateEmail', function() {
    var EMAIL_REGEXP = /^[_a-z0-9]+(\.[_a-z0-9]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,5})$/;

    return {
        require: 'ngModel',
        restrict: '',
        link: function(scope, elm, attrs, ctrl) {
            if (ctrl && ctrl.$validators.email) {

                ctrl.$validators.email = function(modelValue) {
                    return ctrl.$isEmpty(modelValue) || EMAIL_REGEXP.test(modelValue);
                };
            }
        }
    };
});

//Matched Password Filter
app.directive('validPasswordC', function () {
    return {
        require: 'ngModel',
        link: function (scope, elm, attrs, ctrl) {
            var original;
            ctrl.$formatters.unshift(function (modelValue) {
                original = modelValue;
                return modelValue;
            });

            ctrl.$parsers.push(function(viewValue){
                var noMatch = viewValue != scope.signUpForm.password.$viewValue;
                ctrl.$setValidity('noMatch', !noMatch);
                return viewValue;
            });
        }
    }
});

//Duplicated Id Filter
app.directive('userNameDuplicated', function ($http) {
    return {
        require: 'ngModel',
        link: function (scope, elm, attrs, ctrl) {
            var original;
            ctrl.$formatters.unshift(function (modelValue) {
                original = modelValue;
                return modelValue;
            });

            ctrl.$parsers.push(function(viewValue){
                if(viewValue != undefined) {
                    if (viewValue.length >= 4) {
                        var url = "/api/player/CheckDuplicateData";
                        $http({
                            method: 'POST',
                            url: url,
                            data: $.param({infoValue: viewValue, infoType: 1}),
                            headers: {'Content-Type': 'application/x-www-form-urlencoded'}
                        }).success(function (data) {
                            if (data.result.isDuplicate) {
                                ctrl.$setValidity('duplicated', false);
                            } else {
                                ctrl.$setValidity('duplicated', true);
                            }
                            ctrl.$setValidity('minlength', true);

                        });

                        return viewValue;
                    } else {
                        ctrl.$setValidity('minlength', false);
                        return viewValue;
                    }
                }else{
                    ctrl.$setValidity('minlength', false);
                    return viewValue;
                }
            })
        }
    };
});


app.directive('referrerCheck', function ($http) {
    return {
        require: 'ngModel',
        link: function (scope, elm, attrs, ctrl) {
            var original;
            ctrl.$formatters.unshift(function (modelValue) {
                original = modelValue;
                return modelValue;
            });

            ctrl.$parsers.push(function(viewValue){
                if(viewValue!=""){
                    if (viewValue.length >= 4) {
                        var url = "/api/player/CheckDuplicateData";
                        $http({
                            method: 'POST',
                            url: url,
                            data: $.param({infoValue: viewValue, infoType: 1}),
                            headers: {'Content-Type': 'application/x-www-form-urlencoded'}
                        }).success(function (data) {
                            if (data.result.isDuplicate) {
                                ctrl.$setValidity('duplicated', true);
                            } else {
                                ctrl.$setValidity('duplicated', false);
                            }
                        });
                        return viewValue;
                    }else{
                        ctrl.$setValidity('duplicated', false);
                        return viewValue;
                    }
                }else{
                    ctrl.$setValidity('duplicated', true);
                    ctrl.$setPristine();
                    return viewValue;
                }
            })
        }
    };
});

app.filter('userDateTime', function($filter) {
    return function (input, format, offset) {
        if(input == null){ return ""; }
        var timeFromUTC = moment.utc(input);
        var tzName  = jstz.determine().name();
        var _date = moment.tz(timeFromUTC,tzName).format("YYYY-MM-DD HH:mm:ss Z");
        return _date.toString();
    }
});

app.filter('userDate', function($filter) {
    return function (input, format, offset) {
        if(input == null){ return ""; }
        var timeFromUTC = moment.utc(input);
        var tzName  = jstz.determine().name();
        var _date = moment.tz(timeFromUTC,tzName).format("YYYY-MM-DD HH:mm");
        return _date.toString();
    }
});


app.filter('gspName', function($filter) {
    var gameName=[
    {101:"Ezugi"},
    {102:"GAMEPLAY"},
    {103:"Gold Deluxe"}
    ];

    return function (input, format, offset) {
        if(input == null){ return ""; }
        var _gspName = gameName.input;
        return _gspName.toUpperCase();
    }
});



app.controller('SlotController', function($scope) {
    $('.slot-game-button').click(function(){
        $(this).siblings('.active').removeClass('active');
        $(this).addClass('active');
    });

    //=== Slot Items ===//
    var table_data3="";

    for(var i = 0 ;i<20;i++){
        table_data3 += "<div class=\"slot-box\">";
        table_data3 += "<div class=\"slot-item\" style=\"background:url('/common/images/slot/Avalon2.png') 0 0 no-repeat #fbfbfb;\">";
        table_data3 += "<div class=\"slot-new0\"></div>";
        table_data3 += "<div class=\"slot-top02\"></div>";
        table_data3 += "<p>Avalon II</p>";
        table_data3 += "</div>";
        table_data3 += "</div>";
    }

    $(".slot-items").html(table_data3);
});

app.controller('SportsController', function($scope) {

});

app.controller('PromoController', function($scope) {

});

//Tabs
app.controller("TabController", function() {
    this.tab = 1;

    this.isSet = function(checkTab) {
        return this.tab === checkTab;
    };

    this.setTab = function(setTab) {
        this.tab = setTab;
    };
});

app.controller("PopController", function() {
    this.tab = 1;

    this.isSet = function(checkTab) {
        return this.tab === checkTab;
    };

    this.setTab = function(setTab) {
        this.tab = setTab;
    };
});


//WalletPopup
app.service('AmountService', function () {
    return {
        sumAmount: function (amount,amountSum) {
            //console.log(amountSum);
            if(amount == "NaN" || amount == "" ){
                return parseInt(amountSum);
            }
            amount= parseInt(amount)+parseInt(amountSum);
            return amount;
        },
        resetAmount: function () {
            return 0;
        }
    };
});

app.directive('format', ['$filter', function ($filter) {
    return {
        require: '?ngModel',
        link: function (scope, elem, attrs, ctrl) {
            if (!ctrl) return;


            ctrl.$formatters.unshift(function (a) {
                return $filter(attrs.format)(ctrl.$modelValue)
            });


            ctrl.$parsers.unshift(function (viewValue) {
                if (viewValue == "NaN") return 0;
                var plainNumber = viewValue.replace(/[^\d|\-+|\.+]/g, '');
                elem.val($filter(attrs.format)(plainNumber));
                return plainNumber;
            });
        }
    };
}]);

app.directive("addAmountList",function(){
    return {
        link: function(scope,element,attrs){
            scope.data = scope[attrs["addAmountList"]];
        },
        restrict: "A",
        template: "<button type='button' class='btn btn-drkgray btn-option' ng-repeat='item in data' ng-click='addAmount(item.price)'>{{item.price | number}} {{item.currency}}</button>"
    }
});

app.controller("WalletController", function($scope,$rootScope,$http,SweetAlert) {
    $rootScope.addAmountUSD = [{price : 100,currency: 'USD'},{price : 500,currency: 'USD'},{price : 1000,currency: 'USD'},{price : 5000,currency: 'USD'},{price : 10000,currency: 'USD'}];
    $rootScope.addAmountKRW = [{price : 1000,currency: 'KRW'},{price : 10000,currency: 'KRW'},{price : 500000,currency: 'KRW'},{price : 1000000,currency: 'KRW'},{price : 10000000,currency: 'KRW'}];
    $rootScope.addAmountTHB = [{price : 100,currency: 'THB'},{price : 500,currency: 'THB'},{price : 1000,currency: 'THB'},{price : 5000,currency: 'THB'},{price : 10000,currency: 'THB'}];
    $rootScope.addAmountCNY = [{price : 100,currency: 'CNY'},{price : 500,currency: 'CNY'},{price : 1000,currency: 'CNY'},{price : 5000,currency: 'CNY'},{price : 10000,currency: 'CNY'}];
    $scope.getBankList={};
    $http.get("/api/system/GetPlayerBankList")
        .success(function(data) {
            if(data.status==200) {
                $scope.getBankList = data.result.bankList;
            }else{
                if(data.alert){
                    if (bowser.msie && bowser.version <= 8) {
                        alert(data.message);
                    }else{
                        SweetAlert.swal(data.message, "Please try again", "error");
                    }
                }
            }
        }).error(function(data, status) {
            console.error('Repos error', status, data);
        })["finally"](function(){

    });

    $scope.isSet = function(checkTab) {
        return $scope.tab === checkTab;
    };

    $scope.setTab = function(setTab) {
        $scope.tab = setTab;
    };
});

app.controller("DepositController", function($scope,$http,AmountService,SweetAlert,$injector) {
    $scope.deposit={};
    $scope.deposit.amount = 0;
    angular.element('#datetimepicker').datetimepicker({dayOfWeekStart : 1, lang:'en', step:10});
    $scope.addAmount = function(sumAmount){
        $scope.deposit.amount= AmountService.sumAmount($scope.deposit.amount,sumAmount);
    };
    $scope.resetAmount = function(){
        $scope.deposit.amount= AmountService.resetAmount();
    };

    $scope.processForm = function() {
        $scope.isProcessing=true;

        var url = "/api/finance/RequestDeposit";
        $scope.deposit.phone=$("#depositPhone").intlTelInput("getNumber");
        $http({
            method: 'POST',
            url: url,
            data: $.param($scope.deposit),  // pass in data as strings
            headers: { 'Content-Type': 'application/x-www-form-urlencoded' }  // set the headers so angular passing info as form data (not request payload)
        }).success(function(data) {
            if(data.status==200) {
                if (bowser.msie && bowser.version <= 8) {
                    alert(data.message);
                }else{
                    SweetAlert.swal(data.message, "Please try again", "success");
                }
            }else{
                if(data.alert){
                    if (bowser.msie && bowser.version <= 8) {
                        alert(data.message);
                    }else{
                        SweetAlert.swal(data.message, "Please try again", "error");
                    }
                }
            }
        }).error(function(data, status) {
            console.error('Repos error', status, data);
        })["finally"](function(){
            $scope.isProcessing=false;
        });
    };

    // Injector
    var $validationProvider = $injector.get('$validation');

    $validationProvider
        .setDefaultMsg({
            required: {
                error: 'This field is required!'
            }
        });
    // Initial Value
    $scope.form = {
        requiredCallback: 'required',
        checkValid: $validationProvider.checkValid,
        submit: function () {
        },
        reset: function () {
        }
    };
});


app.controller("WithdrawalController", function($scope,$http,AmountService,SweetAlert,$injector) {
    $scope.withdrawal={};
    $scope.withdrawal.amount = 0;
    $scope.addAmount = function(sumAmount){
        $scope.withdrawal.amount= AmountService.sumAmount($scope.withdrawal.amount,sumAmount);
    };
    $scope.resetAmount = function(){
        $scope.withdrawal.amount= AmountService.resetAmount();
    };

    $scope.processForm = function() {
        $scope.isProcessing=true;
        var url = "/api/finance/RequestWithdrawal";
        $scope.withdrawal.phone=$("#withdrawalPhone").intlTelInput("getNumber");
        $http({
            method: 'POST',
            url: url,
            data: $.param($scope.withdrawal),  // pass in data as strings
            headers: { 'Content-Type': 'application/x-www-form-urlencoded' }  // set the headers so angular passing info as form data (not request payload)
        }).success(function(data) {
            if(data.status==200) {
                if (bowser.msie && bowser.version <= 8) {
                    alert(data.message);
                }else{
                    SweetAlert.swal(data.message, "Please try again", "success");
                }
            }else{
                if(data.alert){
                    if (bowser.msie && bowser.version <= 8) {
                        alert(data.message);
                    }else{
                        SweetAlert.swal(data.message, "Please try again", "error");
                    }
                }
            }
        }).error(function(data, status) {
            console.error('Repos error', status, data);
        })["finally"](function(){
            $scope.isProcessing=false;
        });
    };

    // Injector
    var $validationProvider = $injector.get('$validation');

    $validationProvider
        .setDefaultMsg({
            required: {
                error: '*'
            },
            number: {
                error: 'Please enter numbers only!'
            }
        });
    // Initial Value
    $scope.form = {
        requiredCallback: 'required',
        checkValid: $validationProvider.checkValid,
        submit: function () {
        },
        reset: function () {
        }
    };
});


app.controller("ChangePasswordController", function($scope,$http,SweetAlert) {
    $scope.changePwd={};
    $scope.processForm = function() {
        $scope.isProcessing=true;
        var url = "/api/player/ChangePassword";
        $http({
            method: 'POST',
            url: url,
            data: $.param($scope.changePwd),  // pass in data as strings
            headers: { 'Content-Type': 'application/x-www-form-urlencoded' }  // set the headers so angular passing info as form data (not request payload)
        }).success(function(data) {
            if(data.status==200) {
                if (bowser.msie && bowser.version <= 8) {
                    alert(data.message);
                }else{
                    SweetAlert.swal(data.message, "Please try again", "success");
                }
            }else{
                if(data.alert){
                    if (bowser.msie && bowser.version <= 8) {
                        alert(data.message);
                    }else{
                        SweetAlert.swal(data.message, "Please try again", "error");
                    }
                }
            }
        }).error(function(data, status) {
            console.error('Repos error', status, data);
        })["finally"](function(){
            $scope.isProcessing=false;
        });
    };
});

app.controller("CouponController", function($scope,$http,$rootScope,AmountService,SweetAlert) {
    $scope.coupone={};
    $scope.couponList={};
    $scope.filteredPage = [];
    $scope.totalItems = 0;
    $scope.currentPage = 1;
    $scope.maxSize = 5;
    $scope.numPerPage = 10;


    var url = "/api/marketing/GetPlayerCouponHistory";
    $http.get(url).success(function(data) {
        if(data.status==200) {
            $scope.couponList=data.result.CouponList;
            $rootScope.couponCount = $scope.couponList.length;
            $scope.totalItems = $scope.couponList.length;

        }else{
            if(data.alert){
                if (bowser.msie && bowser.version <= 8) {
                    alert(data.message);
                }else{
                    SweetAlert.swal(data.message, "Please try again", "error");
                }
            }
        }
    }).error(function(data, status) {
        console.error('Repos error', status, data);
    })["finally"](function(){
        $scope.numPagesCal = function() {
            return Math.ceil($scope.couponList.length / $scope.numPerPage);
        };

        $scope.numPages=$scope.numPagesCal();

        $scope.$watch('currentPage + numPerPage', function() {
            var begin = (($scope.currentPage - 1) * $scope.numPerPage)
                , end = begin + $scope.numPerPage;
            $scope.filteredPage = $scope.couponList.slice(begin, end);

        });
    });

});






app.controller("NoticeController", function($scope,$http,$rootScope,AmountService,SweetAlert) {
    $scope.noticeList={};
    $scope.filteredPage = [];
    $scope.totalItems = 0;
    $scope.currentPage = 1;
    $scope.maxSize = 5;
    $scope.numPerPage = 10;


    var url = "/api/operation/GetAnnouncements?announceTypeCd=1";
    $http.get(url).success(function(data) {
        if(data.status==200) {
            $scope.noticeList=data.result.announcementList;
            $scope.totalItems = $scope.noticeList.length;

        }else{
            if(data.alert){
                if (bowser.msie && bowser.version <= 8) {
                    alert(data.message);
                }else{
                    SweetAlert.swal(data.message, "Please try again", "error");
                }
            }
        }
    }).error(function(data, status) {
        console.error('Repos error', status, data);
    })["finally"](function(){
        $scope.numPagesCal = function() {
            return Math.ceil($scope.noticeList.length / $scope.numPerPage);
        };

        $scope.numPages=$scope.numPagesCal();

        $scope.$watch('currentPage + numPerPage', function() {
            var begin = (($scope.currentPage - 1) * $scope.numPerPage)
                , end = begin + $scope.numPerPage;
            $scope.filteredPage = $scope.noticeList.slice(begin, end);

        });
    });
});




app.controller("EventController", function($scope,$http,$rootScope,AmountService,SweetAlert) {
    $scope.eventList={};
    $scope.filteredPage = [];
    $scope.totalItems = 0;
    $scope.currentPage = 1;
    $scope.maxSize = 5;
    $scope.numPerPage = 10;


    var url = "/api/operation/GetAnnouncements?announceTypeCd=2";
    $http.get(url).success(function(data) {
        if(data.status==200) {
            $scope.eventList=data.result.announcementList;
            $scope.totalItems = $scope.eventList.length;

        }else{
            if(data.alert){
                if (bowser.msie && bowser.version <= 8) {
                    alert(data.message);
                }else{
                    SweetAlert.swal(data.message, "Please try again", "error");
                }
            }
        }
    }).error(function(data, status) {
        console.error('Repos error', status, data);
    })["finally"](function(){
        $scope.numPagesCal = function() {
            return Math.ceil($scope.eventList.length / $scope.numPerPage);
        };

        $scope.numPages=$scope.numPagesCal();

        $scope.$watch('currentPage + numPerPage', function() {
            var begin = (($scope.currentPage - 1) * $scope.numPerPage)
                , end = begin + $scope.numPerPage;
            $scope.filteredPage = $scope.eventList.slice(begin, end);

        });
    });
});



app.controller("FAQController", function($scope,$http,$rootScope,AmountService,SweetAlert) {
    $scope.faqeList={};
    $scope.filteredPage = [];
    $scope.totalItems = 0;
    $scope.currentPage = 1;
    $scope.maxSize = 5;
    $scope.numPerPage = 10;


    var url = "/api/operation/GetAnnouncements?announceTypeCd=3";
    $http.get(url).success(function(data) {
        if(data.status==200) {
            $scope.faqeList=data.result.announcementList;
            $scope.totalItems = $scope.faqeList.length;
        }else{
            if(data.alert){
                if (bowser.msie && bowser.version <= 8) {
                    alert(data.message);
                }else{
                    SweetAlert.swal(data.message, "Please try again", "error");
                }
            }
        }
    }).error(function(data, status) {
        console.error('Repos error', status, data);
    })["finally"](function(){
        $scope.numPagesCal = function() {
            return Math.ceil($scope.faqeList.length / $scope.numPerPage);
        };

        $scope.numPages=$scope.numPagesCal();

        $scope.$watch('currentPage + numPerPage', function() {
            var begin = (($scope.currentPage - 1) * $scope.numPerPage)
                , end = begin + $scope.numPerPage;
            $scope.filteredPage = $scope.faqeList.slice(begin, end);

        });
    });
});

var reviews = [{
    body: "Claritas est etiam processus dynamicus, qui sequitur mutationem consuetudium lectorum.",
    createdOn: 1397490980837
}];
app.controller('MessageController', function () {
    this.message = {};
    this.reviews = reviews;

    this.addChatMsg = function (reviews) {
        this.message.createdOn = Date.now();
        this.reviews.push(this.message);
        this.message = {};
    };
});

