<?session_start()?>
<div id="popup-login">
    <!--<div class="popup-close"><i class="icon-close-signup"></i></div>-->
    <div class="login-form">
        <div class="login-logo"></div>
        <h4>Please login to access your account.</h4>

        <form id="popup-login-form" class="ng-pristine ng-valid">
            <div>
                <input type="text" name="MemberID" class="login-input-user" placeholder="User ID">
            </div>
            <div>
                <input type="password" name="MemberPwd" class="login-input-pass" placeholder="Password">
            </div>
            <button class="btn btn-dark btn-submit">Login</button>
        </form>
        <p>
            <span class="link-signup" ng-click="displaySignUp()">Not yet a member? Sign Up Here!</span>
            <span class="link-forgotpassword" ng-click="displayForgotPass()">Forgot Password?</span>
        </p>
        <div class="clear"></div>
    </div>
</div>