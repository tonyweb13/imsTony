<?include_once $_SERVER["DOCUMENT_ROOT"] . "/lib/client.php";?>
<!DOCTYPE html>
<!--[if IE 8]>
<html class="no-js lt-ie9" xmlns:ng="http://angularjs.org" id="ng-app" ng-app="casinoApp">
<![endif]-->
<!--[if gt IE 8]><!-->
<html class="no-js" ng-app="casinoApp">
<!--<![endif]-->
<?if(isset($_SESSION['accessToken'])){?>
<head ng-controller="HeaderController" ng-init="stillLoggedIn()">
<?}else{?>
<head>
    <?}?>
    <!--[if lt IE 9]>
    <script type="text/javascript" src="/common/js/html5shiv.js"></script>
    <script type="text/javascript" src="/common/js/respond.min.js"></script>
    <![endif]-->
    <!--[if lte IE 8]>
    <script type="text/javascript" src="/common/js/es5-shim.js"></script>
    <script type="text/javascript" src="/common/js/json3.min.js"></script>
    <script type="text/javascript" src="/common/js/respond.min.js"></script>
    <script>
        document.createElement('ng-include');
        document.createElement('ng-pluralize');
        document.createElement('ng-view');
        document.createElement('ng-click');
        document.createElement('ng-repeat');
        document.createElement('ng-show');
        document.createElement('my-directive');

        // Optionally these for CSS
        document.createElement('ng:include');
        document.createElement('ng:pluralize');
        document.createElement('ng:view');
        document.createElement('ng:click');
        document.createElement('ng:repeat');
        document.createElement('ng:show');
        document.createElement('poster');
    </script>
    <![endif]-->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <title ng-cloak ng-bind="">Welcome to Play Casino</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link rel="shortcut icon" href="favicon.ico" type="image/x-icon" />
    <link rel="stylesheet" href="common/css/ticker-style.css">
    <link rel="stylesheet" href="common/css/owl.carousel.css">
    <link rel="stylesheet" href="common/css/owl.theme.css">
    <link rel="stylesheet" href="common/css/jquery.mCustomScrollbar.css" type="text/css" />
    <link rel="stylesheet" href="common/css/sweetalert.css">
    <link rel="stylesheet" href="common/css/intlTelInput.css">
    <link rel="stylesheet" href="common/css/ngDialog.css">
    <link rel="stylesheet" href="common/css/ngDialog-theme-default.css">
    <link rel="stylesheet" href="common/css/style.css">
    <script>
        var langKey = window.navigator.userLanguage || window.navigator.language;
        if(langKey == "th_TH" || langKey == "th" || langKey == "th-TH"){
            document.write('<link rel="stylesheet" type="text/css" href="http://fonts.googleapis.com/css?family=Roboto+Condensed:400,700">');
        }else if(langKey == "zh_CN" || langKey == "zh" || langKey == "zh-CN"){
            document.write('<link rel="stylesheet" type="text/css" href="http://fonts.googleapis.com/earlyaccess/cwtexfangsong.css">');
        }else if(langKey == "ko_KR" || langKey == "ko" || langKey == "ko-KR"){
            document.write('<link rel="stylesheet" type="text/css" href="http://fonts.googleapis.com/earlyaccess/jejugothic.css">');
        }else{
            document.write('<link rel="stylesheet" type="text/css" href="http://fonts.googleapis.com/css?family=Roboto+Condensed:400,700">');
        }
    </script>
</head>
<body ng-controller="CommonController"  ng-init="init();">
<div id="wrap">
    <div id="top-container" class="whole-container">
        <div class="container">
            <div class="top-announcements">
                <label ng-cloak>{{ "Announcements" | translate}}</label>
                <div class="news-ticker">
                    <ul>
                        <li ng-repeat="announcement in getAnouncementList"><i class="icon-new">N</i> <span ng-bind="announcement.title"></span> <em ng-bind="announcement.updateDate | userDateTime"></em></li>
                    </ul>
                </div>
                <div class="clear"></div>
            </div>
            <div class="top-links">
                <ul>
                    <li><i class="icon-livechat-top" ></i><span ng-cloak>{{ "Live Chat"| translate}}</span></li>
                    <li ng-cloak>{{ "Mobile" | translate}}</li>
                    <li ng-cloak>{{ "Affiliates" | translate}}</li>
                    <li class="lang-option">
                        <span ng-cloak>{{ "Language" | translate}}</span>
                        <div class="lang-active">
                            <span id="language-flag"><i class="icon-lang language-en"></i></span>
                            <span class="rotate-triangle2"></span>
                        </div>
                    </li>
                </ul>
                <div id="lang-list">
                    <ul>
                        <li ng-click="setLang('en_US')"><i class="icon-lang language-en"></i> English</li>
                        <li ng-click="setLang('th_TH')"><i class="icon-lang language-th"></i> ไทย</li>
                        <li ng-click="setLang('zh_CN')"><i class="icon-lang language-zh"></i> 中國語</li>
                        <li ng-click="setLang('ko_KR')"><i class="icon-lang language-ko"></i> 한국어</li>
                    </ul>
                </div>
                <div class="clear"></div>
            </div>
            <div class="clear"></div>
        </div>
    </div>
    <div id="header-container" class="whole-container">
        <div class="container">
            <div class="logo"><a href="/#/"><img src="common/images/logo.png" width="182" height="53"/></a></div>
            <div class="login-container" ng-controller="LoginController">
                <?if(!isset($_SESSION['accessToken'])){?>
                    <div id="guest" >
                        <form ng-submit="processForm()">
                            <label ng-cloak>{{ "ID" | translate}}</label>
                            <input type="text" name="nickname" ng-model="loginForm.nickname"  placeholder="{{ 'User ID' | translate}}" class="id" ng-cloak/>
                            <label ng-cloak>{{ "Password" | translate}}</label>
                            <input type="password" name="password" ng-model="loginForm.password"  placeholder="{{ 'Password' | translate}}" class="pw" ng-cloak/>
                            <button type="submit" class="btn-login btn-gray hvr-sweep-to-right" ng-disabled="isProcessing" ng-cloak>{{ "Login" | translate}}</button>
                        </form>
                        <button class="btn-signup hvr-sweep-to-right" ng-click="displaySignUp()" ng-cloak>{{ "Sign Up" | translate}}</button>
                        <button class="btn-forgotpass btn-gray hvr-sweep-to-right" ng-click="displayForgotPass()"><i class="icon-forgotpass"></i></button>
                    </div>
                <?}else{?>
                    <div id="user" >
                        <label>{{ "Welcome" | translate}}, <strong><?=$_SESSION['nickname']?></strong></label>
                        <div class="box-balance" ng-controller="BalanceController" ng-init="init();">
                            {{ "Balance" | translate}}
                            <strong ng-bind="mainBalance.amount | currency:cc_currency_symbol[mainBalance.currencyIsoCd]:0" ></strong>
                            <i class="icon-caret-down"></i>
                            <div class="box-balance-container">
                                <h1>{{ "Live Casino" | translate}} | {{ "Slot Games" | translate}} | {{ "Poker" | translate}}</h1>
                                <div class="box-balance-item no-border">
                                    <i class="icon-info icon-tip-wallet"></i>
                                    <div class="tooltip tooltipWallet border-round">
                                        <b>{{ "Main Wallet" | translate}}</b> {{ "is be available" | translate}} <b>{{ "Live casinos" | translate}}, {{ "Slots" | translate}}, {{ "Poker" | translate}}, {{ "K" | translate}} {{ "Sports" | translate}}</b>.
                                    </div>
                                    {{ "Main Wallet" | translate}} <strong ng-bind="mainBalance.amount | currency:cc_currency_symbol[mainBalance.currencyIsoCd]:0" ></strong>
                                </div>
                                <h2>{{ "Transfer Wallet" | translate}}</h2>
                                <div class="box-balance-item" ng-repeat="gspBalance in gspBalanceList">
                                    <span ng-bind="gspBalance.Key"></span>
                                    <strong ng-bind="gspBalance.Value.amount | currency:cc_currency_symbol[gspBalance.Value.currencyIsoCd]:0"></strong>
                                </div>
                                <div class="clear"></div>
                            </div>
                        </div>
                        <button class="btn-mywallet hvr-sweep-to-right" ng-click="openPopup()">{{ "My Wallet" | translate}}</button>
                        <button onclick="$('#walletAccount').click();" class="btn-account btn-gray hvr-sweep-to-right" ng-click="openPopup()">{{ "Account" | translate}}</button>
                        <button ng-controller="LogoutController"  class="btn-logout btn-gray hvr-sweep-to-right" ng-click="logout()" ng-disabled="isProcessing"><i class="icon-logout"></i></button>
                    </div>
                <?}?>
                <div class="clear"></div>
            </div>

            <div class="clear"></div>
        </div>
    </div>
    <div id="nav-container" class="whole-container nav-blue">
        <div class="container" ng-controller="NavController">
            <ul>
                <li><a href="/#/" ng-class="{ active: isActive('/')}" ng-cloak>{{ "Live Casino" | translate}}</a></li>
                <li><a href="#sports" ng-class="{ active: isActive('/sports')}" ng-cloak>{{ "Sports" | translate}}</a></li>
                <li><a href="#slot" ng-class="{ active: isActive('/slot')}" ng-cloak>{{ "Slot Games" | translate}}</a></li>
                <li><a href="#/" onclick="alert('Coming Soon');" ng-cloak>{{ "Keno" | translate}}</a></li>
                <li><a href="#/" onclick="alert('Coming Soon');" ng-cloak>{{ "Mini Game" | translate}}</a></li>
                <li><a href="#/" onclick="alert('Coming Soon');" class="navPoker" ng-cloak>{{ "Poker" | translate}}</a></li>
                <li><a href="#promotion" ng-class="{ active: isActive('/promotion')}" class="nav-promos nav-default" ng-cloak>{{ "Promotions" | translate}}</a></li>
                <li class="nav-deposit nav-default" ng-click="displayWallet(2)" ng-cloak>{{ "Deposit" | translate}}</li>
                <li class="nav-withdraw nav-default" ng-click="displayWallet(3)" ng-cloak>{{ "Withdraw" | translate}}</li>
                <li ng-cloak ng-show="!loggedIn" class="nav-customer nav-default" ng-click="displayCustomer(1)" ng-cloak>{{ "Customer" | translate}}</li>
                <li ng-show="loggedIn" class="nav-customer nav-default" ng-click="displayCustomer(4)" ng-cloak>{{ "Customer" | translate}}</li>
            </ul>
        </div>
    </div>

    <div class="container">
        <div ng-view></div>
    </div>
</div>

<!--SCRIPTS-->
<script src="/common/js/jquery-1.11.3.min.js"></script>
<![if !IE 8]>
<script type="text/javascript" src="/common/js/jquery-sweet-alert.min.js"></script>
<![endif]>
<script type="text/javascript" src="/common/js/jquery-browser.min.js"></script>
<script type="text/javascript" src="/common/js/jquery-moment.min.js"></script>
<script type="text/javascript" src="/common/js/jquery-moment-timezone.min.js"></script>
<script type="text/javascript" src="/common/js/jstz-1.0.4.min.js"></script>
<script type="text/javascript" src="/common/js/utill.js"></script>
<script type="text/javascript" src="/common/js/jquery-intlTelInput.js"></script>
<script type="text/javascript" src="/common/js/angular.min.js"></script>
<script type="text/javascript" src="/common/js/angular-route.min.js"></script>
<script type="text/javascript" src="/common/js/angular-cookies.min.js"></script>
<script type="text/javascript" src="/common/js/angular-translate.min.js"></script>
<script type="text/javascript" src="/common/js/angular-translate-storage-cookie.js"></script>
<script type="text/javascript" src="/common/js/angular-translate-storage-local.js"></script>
<script type="text/javascript" src="/common/js/angular-translate-loader-static-files.js"></script>
<script type="text/javascript" src="/common/js/angular-validation.js"></script>
<script type="text/javascript" src="/common/js/angular-validation-rule.js"></script>

<script type="text/javascript" src="/common/js/angular-module-currencyCode.min.js"></script>
<script type="text/javascript" src="/common/js/angular-pagination-ui-bootstrap.js"></script>
<script type="text/javascript" src="/common/js/augment.js"></script>
<script type="text/javascript" src="/common/js/ngDialog.min.js"></script>
<script type="text/javascript" src="/common/js/angular-custom.js"></script>

<script type="text/javascript" src="/common/js/jquery-easy-ticker.js"></script>
<script type="text/javascript" src="/common/js/jquery-easing.min.js"></script>
<script type="text/javascript" src="/common/js/jquery-owl-carousel.min.js"></script>
<script type="text/javascript" src="/common/js/jquery-jOdometer.min.js"></script>
<script type="text/javascript" src="/common/js/jquery-bPopup.min.js"></script>
<script type="text/javascript" src="/common/js/jquery-pagination.min.js"></script>
<script type="text/javascript" src="/common/js/jquery-placeholder.js"></script>
<script type="text/javascript" src="/common/js/jquery-mouseWheel.min.js"></script>
<script type="text/javascript" src="/common/js/jquery-datetimepicker.js"></script>
<script type="text/javascript" src="/common/js/jquery-custom-scroll-bar.min.js"></script>
<script type="text/javascript" src="/common/js/jquery-custom.js"></script>

</body>
</html>