<?session_start()?>
<div id="popup-forgotpass">
    <!--<div class="popup-close"><i class="icon-close-popup"></i></div>-->

    <div class="popup-tabs" ng-controller="TabController as tab">
        <ul class="popTabs">
            <li ng-class="{active:tab.isSet(1)}" ng-click="tab.setTab(1)"><i class="icon-popup-forgotpass"></i>&nbsp; Forgot Password</li>
            <li ng-class="{active:tab.isSet(2)}" ng-click="tab.setTab(2)"><i class="icon-popup-forgotid"></i>&nbsp; Forgot ID</li>
        </ul>
        <div class="clear"></div>

        <div ng-show="tab.isSet(1)">
            <div class="forgotpass-form" ng-controller="ForgotPasswordController">
                <div ng-hide="correctInfo">
                    <h1>Forgot Password?</h1>
                    <h4>Enter your username and email address below and we'll send you instructions on how to reset your password.</h4>
                    <form ng-submit="processForm()" novalidate>
                        <div>
                            <label>User ID</label>
                            <p>
                                <input type="text" ng-model="forgotPwd.nickname" />
                            </p>
                            <div class="clear"></div>
                        </div>
                        <div>
                            <label>Security Question</label>
                            <p>
                                <select class="form-control" name="securityQuestionNo" ng-model="forgotPwd.securityQuestionNo"
                                        ng-options="c.questionNo as c.questionDescription for c in getQuestion">
                                    <option value="" selected="selected">Please Select Question</option>
                                </select>
                            </p>
                            <div class="clear"></div>
                        </div>
                        <div>
                            <label>Security Answer</label>
                            <p>
                                <input type="text" class="form-control" name="securityAnswer" ng-model="forgotPwd.securityAnswer"/>
                            </p>
                            <div class="clear"></div>
                        </div>
                        <button class="btn btn-dark btn-submit" ng-disabled="isProcessing">Submit</button>
                    </form>
                    <div class="clear"></div>
                </div>
                <div ng-show="correctInfo">
                    Your Temporary Password is <span ng-bind="getTempPwd"></span>
                    <div class="clear"></div>
                </div>
                <div class="clear"></div>
            </div>
        </div>
        <div ng-show="tab.isSet(2)">
            <div class="forgotpass-form" ng-controller="ForgotNicknameController">
                <div ng-hide="correctInfo">
                    <h1>Forgot User ID?</h1>
                    <h4>Enter your email address below and we'll send you instructions on how to reset your password.</h4>
                    <form ng-submit="processForm()" novalidate>
                        <div>
                            <label style="width: 77px;">Email</label>
                            <p>
                                <input type="text" ng-model="forgotNick.email" value="syoon3@aaa.com"/>
                            </p>
                        </div>
                        <button type="submit" class="btn btn-dark btn-submit" ng-disabled="isProcessing">Submit</button>
                    </form>
                    <div class="clear"></div>
                </div>
                <div ng-show="correctInfo">
                    Your ID is
                    <span ng-repeat="nickName in getNickNameList" ng-bind="nickName"></span>
                    <div class="clear"></div>
                </div>
                <div class="clear"></div>
            </div>
        </div>
    </div>
</div>