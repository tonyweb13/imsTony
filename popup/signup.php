<?session_start()?>
<div class="signup-form" ng-class="signup()">
    <h1>Welcome to <strong>TestCasino</strong>!</h1>
    <h4>Register Now and Enjoy our Exciting Games!</h4>

    <form name="signUpForm" novalidate ng-submit="processForm()">
        <!--<pre>{{signForm.$valid}}</pre>
        <pre>{{signUpForm.$valid}}</pre>-->
        <div class="signup-box float-left box-default-right">
        <div ng-class="{'has-error' : signUpForm.nickname.$invalid && !signUpForm.nickname.$pristine, 'no-error' : signUpForm.nickname.$valid}">
            <label><em>*</em> User ID</label>
            <input type="text" class="form-control"
                   name="nickname"
                   ng-model="signForm.nickname"
                   ng-pattern="/^[A-z][A-z]*$/"
                   maxlength="16"
                   ng-maxlength="10"
                   user-name-duplicated
                   required />
            <label class="msg">4-16 (a-z, 0-9) chars.</label>
            <span ng-show="signUpForm.nickname.$pristine && signUpForm.nickname.$dirty" class="error">User ID is required.</span>
            <span ng-show="signUpForm.nickname.$error.duplicated"  class="error">This ID is already in use.</span>
            <span ng-show="signUpForm.nickname.$error.maxlength" class="error">User ID is too long.</span>
            <span ng-show="signUpForm.nickname.$error.minlength" class="error">User ID is too short.</span>
        </div>
        <div ng-class="{'has-error' : signUpForm.password.$invalid && !signUpForm.password.$pristine, 'no-error' : signUpForm.password.$valid}">
            <label><em>*</em> Password</label>
            <input type="password" class="form-control"
                   name="password"
                   ng-model="signForm.password"
                   maxlength="16"
                   ng-minlength="6"
                   ng-maxlength="16"
                   required />
            <label class="msg">6-16 chars. only</label>
            <span ng-show="signUpForm.password.$invalid && signUpForm.password.$pristine && signUpForm.password.$dirty" class="error">Password is required.</span>
            <span ng-show="signUpForm.password.$error.minlength" class="error">Password too short</span>
            <span ng-show="signUpForm.password.$error.maxlength" class="error">6-16 chars. only</span>
        </div>
        <div ng-class="{'has-error' : signUpForm.validPwd.$invalid && !signUpForm.validPwd.$pristine, 'no-error' : signUpForm.validPwd.$valid}">
            <label><em>*</em> Confirm Password</label>
            <input type="password"
                   name="validPwd"
                   class="form-control" maxlength="16" ng-model="signForm.validPwd" ng-minlength="6" ng-maxlength="16" valid-password-c required />
            <label class="msg"></label>
            <span ng-show="signUpForm.validPwd.$valid" class="valid">Passwords Matched!</span>
            <span ng-show="signUpForm.validPwd.$invalid && signUpForm.validPwd.$pristine && signUpForm.validPwd.$dirty" class="error">Confirm your password.</span>
            <span ng-show="signUpForm.validPwd.$error.noMatch && signUpForm.validPwd.$dirty" class="error">Passwords do not match!</span>
        </div>
        <div ng-class="{'has-error' : signUpForm.playerName.$invalid && !signUpForm.playerName.$pristine, 'no-error' : signUpForm.playerName.$valid}">
            <label><em>*</em> Player Name</label>
            <input type="text" class="form-control"
                   name="playerName"
                   ng-model="signForm.playerName"
                   maxlength="20"
                   ng-minlength="4"
                   ng-maxlength="20"
                   ng-pattern="/^[A-z ][A-z ]*$/"
                   required />
            <label class="msg">Match with Bank Account</label>
            <span ng-show="signUpForm.playerName.$invalid && signUpForm.playerName.$pristine && signUpForm.playerName.$dirty" class="error">Username is required.</span>
            <span ng-show="signUpForm.playerName.$error.minlength" class="error">Username is too short.</span>
            <span ng-show="signUpForm.playerName.$error.maxlength" class="error">Username is too long.</span>
        </div>
        <div ng-class="{'has-error' : signUpForm.birthYear.$error.required && signUpForm.birthYear.$dirty || signUpForm.birthMonth.$error.required && signUpForm.birthMonth.$dirty || signUpForm.birthDay.$error.required && signUpForm.birthDay.$dirty, 'no-error' : signUpForm.birthYear.$valid && signUpForm.birthMonth.$valid && signUpForm.birthDay.$valid}">
            <label><em>*</em> Date of Birth</label>
            <p>
                <select id="birthYear" class="select_dateYear form-control"
                        name="birthYear"
                        ng-model="signForm.birthYear"
                        required ng-options="year for year in Years" ng-change="UpdateNumberOfDays()">
                    <option value="" selected="selected">Year</option>
                </select>
                <select id="birthMonth" class="select_dateMonth form-control"
                        name="birthMonth"
                        ng-model="signForm.birthMonth"
                        required ng-options="month for month in Months" ng-change="UpdateNumberOfDays()">
                    <option value="" selected="selected">Month</option>
                </select>
                <select id="birthDay" class="select_dateDay form-control"
                        name="birthDay"
                        ng-model="signForm.birthDay"
                        required
                        ng-options="day for day in Days | limitTo:NumberOfDays">
                    <option value="" selected="selected">Day</option>
                </select>
            </p>
            <label class="msg">At least 18 yrs old</label>
            <span ng-show="signUpForm.birthYear.$error.required && signUpForm.birthYear.$dirty" class="error">Please Select Date of Birth</span>
            <span ng-show="signUpForm.birthMonth.$error.required && signUpForm.birthMonth.$dirty" class="error">Please Select Date of Birth</span>
            <span ng-show="signUpForm.birthDay.$error.required && signUpForm.birthDay.$dirty" class="error">Please Select Date of Birth</span>
        </div>
        <div ng-class="{'has-error' : signUpForm.gender.$error.required && !signUpForm.gender.$pristine, 'no-error' : signUpForm.gender.$valid}">
            <label><em>*</em> Gender</label>
            <p class="select_gender" ng-repeat="gender in genderList">
                <input type="radio" ng-model="signForm.gender" name="gender" value="{{gender.genderNo}}" required  /><span ng-bind="gender.genderName"></span>
            </p>
            <span ng-show="signUpForm.gender.$error.required && signUpForm.gender.$dirty" class="error">Gender is required.</span>
        </div>
        <div ng-class="{'has-error' : signUpForm.phone.$dirty || signUpForm.phone.$invalid && !signUpForm.phone.$pristine, 'no-error' : signUpForm.phone.$valid}">
            <label><em>*</em> Phone Number</label>
            <p>
                <input type="text" class="form-control txt_phoneNo"
                       id="signUpPhone"
                       name="phone"
                       international-phone-number
                       ng-model="signForm.phone"
                       required />
            </p>
            <label class="msg">Please Enter Number</label>
            <span ng-show="signUpForm.phone.$error.required && signUpForm.phone.$error.$pristine" class="error">Invalid Phone Number!</span>
            <span ng-show="signUpForm.phone.$invalid" class="error">Invalid Phone Number!</span>
        </div>
        </div>

        <div class="signup-box float-right">
        <div ng-class="{'has-error' : signUpForm.email.$invalid && !signUpForm.email.$pristine, 'no-error' : signUpForm.email.$valid}">
            <label><em>*</em> Email</label>
            <p>
                <input type="email" validate-email name="email" ng-model="signForm.email" class="form-control" required />
            </p>
            <label class="msg">Please Enter Email.</label>
            <span ng-show="signUpForm.email.$invalid && !signUpForm.email.$pristine" class="error">Enter a valid email.</span>
            <span ng-show="signUpForm.email.$error.email" class="error">Invalid Email!</span>
        </div>
        <div ng-class="{'has-error' : signUpForm.currencyNo.$error.required && signUpForm.currencyNo.$dirty, 'no-error' : signUpForm.currencyNo.$valid}">
            <label><em>*</em> Currency</label>
            <p>
                <select class="form-control" name="currencyNo" ng-model="signForm.currencyNo" required
                        ng-options="c.currencyNo as c.currencyIsoCd for c in getCurency">
                    <option value="" selected="selected">Please Select Currency</option>
                </select>
            </p>
            <label class="msg"></label>
        <span ng-show="(signUpForm.currencyNo.$error.required && signUpForm.currencyNo.$dirty) || signUpForm.currencyNo.$pristine" class="error">
            <i class="icon-info icon-tip-currency"></i>
            <div class="tooltip tooltipCurrency border-round">
                Please select your preferred currency.<br />
                Currency chosen is not changeable.
            </div>
        </span>
        </div>
        <div ng-class="{'has-error' : signUpForm.countryNo.$error.required && signUpForm.countryNo.$dirty, 'no-error' : signUpForm.countryNo.$valid}">
            <label><em>*</em> Country</label>
            <p>
                <select class="form-control" name="countryNo" ng-model="signForm.countryNo" required
                        ng-options="c.countryNo as c.countryName for c in getCountries">
                    <option value="" selected="selected">Please Select Country</option>
                </select>
            </p>
            <label class="msg">Please Select Country</label>
            <span ng-show="signUpForm.countryNo.$error.required && signUpForm.countryNo.$dirty" class="error">Please Select Country</span>
        </div>
        <div ng-class="{'has-error' : signForm.languageNo.$error.required && signUpForm.languageNo.$dirty, 'no-error' : signUpForm.languageNo.$valid}">
            <label><em>*</em> Language</label>
            <p>
                <select class="form-control" name="languageNo" ng-model="signForm.languageNo" required
                        ng-options="c.languageNo as c.languageName for c in getLanguages">
                    <option value="" selected="selected">Please Select Language</option>
                </select>
            </p>
            <label class="msg">Please Select Language</label>
            <span ng-show="signUpForm.languageNo.$error.required && signUpForm.languageNo.$dirty" class="error">Please Select Language</span>
        </div>
        <div ng-class="{'has-error' : signUpForm.securityQuestionNo.$error.required && signUpForm.securityQuestionNo.$dirty, 'no-error' : signUpForm.securityQuestionNo.$valid}">
            <label><em>*</em> Security Question</label>
            <p>
                <select class="form-control" name="securityQuestionNo" ng-model="signForm.securityQuestionNo" required
                        ng-options="c.questionNo as c.questionDescription for c in getQuestion">
                    <option value="" selected="selected">Please Select Question</option>
                </select>
            </p>
            <label class="msg">Please Select Question.</label>
            <span ng-show="signUpForm.securityQuestionNo.$error.required && signUpForm.securityQuestionNo.$dirty" class="error">Question is required.</span>
        </div>
        <div ng-class="{'has-error' : signUpForm.securityAnswer.$invalid && !signUpForm.securityAnswer.$pristine, 'no-error' : signUpForm.securityAnswer.$valid}">
            <label><em>*</em> Security Answer</label>
            <input type="text" class="form-control" name="securityAnswer" ng-model="signForm.securityAnswer" required />
            <label class="msg">Enter Security Answer.</label>
            <span ng-show="signUpForm.securityAnswer.$invalid && signUpForm.securityAnswer.$pristine && signUpForm.securityAnswer.dirty" class="error">Answer is required.</span>
        </div>

        <div ng-class="{'has-error' : signUpForm.referrerNickName.$error.duplicated && signUpForm.referrerNickName.$dirty,
                    'not-used' : signUpForm.referrerNickName.$pristine,
                    'no-error' : signUpForm.referrerNickName.$valid}">
            <label>Referrer ID</label>
            <input type="text" class="form-control" name="referrerNickName" ng-model="signForm.referrerNickName"
                   referrer-check/>
            <label class="msg">4-16 (a-z, 0-9) chars.</label>
            <span ng-show="signUpForm.referrerNickName.$error.duplicated" class="error">We can't find ID.</span>
            <!--<tt>text = {{signUpForm.referrerNickName.text}}</tt><br/>
            <tt>myForm.input.$valid = {{signUpForm.referrerNickName.$valid}}</tt><br/>
            <tt>myForm.input.$error = {{signUpForm.referrerNickName.$error}}</tt><br/>
            <tt>myForm.$valid = {{signUpForm.referrerNickName.$valid}}</tt><br/>
            <tt>myForm.$error.required = {{!!signUpForm.referrerNickName.$error.required}}</tt><br/>-->

        </div>
        </div>
        <button id="sing-up" type="submit" class="btn btn-dark btn-register" ng-disabled="signUpForm.$invalid || isProcessing">Register</button>
    </form>

    <div class="terms-container border-round">
        <h1>Terms & Conditions <i class="icon-close-terms"></i></h1>
        <div class="terms-content border-round">
            <strong>Term Details 1</strong>
            <p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore
                magna aliquam erat volutpat. Ut wisi enim ad minim veniam, quis nostrud exerci tation ullamcorper suscipit lobortis
                nisl ut aliquip ex ea commodo consequat. Duis autem vel eum iriure dolor in hendrerit in vulputate velit esse molestie
                consequat, vel illum dolore eu feugiat nulla facilisis at vero eros et accumsan et iusto odio dignissim qui blandit
                praesent luptatum zzril delenit augue duis dolore te feugait nulla facilisi. Nam liber tempor cum soluta nobis eleifend
                option congue nihil imperdiet doming id quod mazim placerat facer possim assum. Typi non habent claritatem insitam;
                est usus legentis in iis qui facit eorum claritatem. Investigationes demonstraverunt lectores legere me lius quod ii
                legunt saepius.</p>
            <strong>Term Details 2</strong>
            <p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore
                magna aliquam erat volutpat. Ut wisi enim ad minim veniam, quis nostrud exerci tation ullamcorper suscipit lobortis
                nisl ut aliquip ex ea commodo consequat. Duis autem vel eum iriure dolor in hendrerit in vulputate velit esse molestie
                consequat, vel illum dolore eu feugiat nulla facilisis at vero eros et accumsan et iusto odio dignissim qui blandit
                praesent luptatum zzril delenit augue duis dolore te feugait nulla facilisi. Nam liber tempor cum soluta nobis eleifend
                option congue nihil imperdiet doming id quod mazim placerat facer possim assum. Typi non habent claritatem insitam;
                est usus legentis in iis qui facit eorum claritatem. Investigationes demonstraverunt lectores legere me lius quod ii
                legunt saepius.</p>
            <strong>Term Details 3</strong>
            <p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore
                magna aliquam erat volutpat. Ut wisi enim ad minim veniam, quis nostrud exerci tation ullamcorper suscipit lobortis
                nisl ut aliquip ex ea commodo consequat. Duis autem vel eum iriure dolor in hendrerit in vulputate velit esse molestie
                consequat, vel illum dolore eu feugiat nulla facilisis at vero eros et accumsan et iusto odio dignissim qui blandit
                praesent luptatum zzril delenit augue duis dolore te feugait nulla facilisi. Nam liber tempor cum soluta nobis eleifend
                option congue nihil imperdiet doming id quod mazim placerat facer possim assum. Typi non habent claritatem insitam;
                est usus legentis in iis qui facit eorum claritatem. Investigationes demonstraverunt lectores legere me lius quod ii
                legunt saepius.</p>
        </div>
    </div>

    <div class="signup-terms">
        By clicking the REGISTER button, I hereby acknowledge that I am above 18 years old and have read and accepted the terms & conditions.<br />
        To view the full terms & conditions, please <span class="link-terms">click here</span>.
    </div>
</div>

<!--<div class="signup-promos">
    <div><img src="common/images/signup-promos.png" width="180" height="180"></div>
    <div><img src="common/images/signup-promos.png" width="180" height="180"></div>
    <div><img src="common/images/signup-promos.png" width="180" height="180"></div>
</div>-->