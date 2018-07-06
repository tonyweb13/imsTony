<?session_start()?>
<!--WalletController-->
<div id="popup-wallet" ng-class="walletPopup()" ng-init="setTab(selectWalletTab);">
    <div class="popup-tabs">
        <ul class="popTabs">
            <li id="walletMyWallet"     ng-class="{ active:isSet(1) }" ng-click="setTab(1)">My Wallet</li>
            <li id="walletDeposit"      ng-class="{ active:isSet(2) }" ng-click="setTab(2)">Deposit</li>
            <li id="walletWithdraw"     ng-class="{ active:isSet(3) }" ng-click="setTab(3)">Withdraw</li>
            <li id="walletCoupon"       ng-class="{ active:isSet(4) }" ng-click="setTab(4)">Coupon <span ng-bind="couponCount"></span></li>
            <li id="walletCash"         ng-class="{ active:isSet(5) }" ng-click="setTab(5)">Cash History</li>
            <li id="walletAccount"      ng-class="{ active:isSet(6) }" ng-click="setTab(6)">Account Details</li>
            <li id="walletResetPass"      ng-class="{ active:isSet(7) }" ng-click="setTab(7)">Reset Password</li>
        </ul>
        <div class="clear"></div>
        <div ng-show="isSet(1)" class="popup-content" ng-controller="BalanceController">
            <h1>My Wallet <button class="btn-more" ng-click="reloadBalance()" ng-disabled="isProcessing"><i class="icon-refresh"></i> Refresh</button></h1>
            <div class="wallet-items margin-top margin-bottom">
                <div class="wallet-item-box wallet-item-bg1 border-round">
                    <i class="icon-info icon-tip-mainwallet"></i>
                    <div class="tooltip tooltipMainWallet border-round">
                        <b>MainWallet</b> is be available <b>Live casinos, Slots, Poker, K Sports</b>.
                    </div>
                    <strong>Main Wallet</strong>
                    <h2  ng-bind="mainBalance.amount | currency:cc_currency_symbol[mainBalance.currencyIsoCd]:0"></h2>
                    <span ng-bind="mainBalance.currencyIsoCd"></span>
                </div>
                <div class="box-separator"></div>
                <div class="wallet-item-box wallet-item-bg{{$index+2}} border-round" ng-repeat="gspBalance in gspBalanceList">
                    <strong ng-bind="gspBalance.Key">S Sports</strong>
                    <h2 ng-bind="gspBalance.Value.amount | currency:cc_currency_symbol[gspBalance.Value.currencyIsoCd]:0">1,468,628</h2>
                    <span ng-bind="gspBalance.Value.currencyIsoCd"></span>
                </div>
                <div class="clear"></div>
            </div>
            <h1>Money Transfer</h1>
            <div class="moneyTransferBox box-gray border-round margin-top margin-bottom">
                <div class="col-4">
                    <label>From</label>
                    <select class="inputField" ng-options="Gsp as GspList">
                        <option>Please Select Game</option>
                        <option ng-repeat="" ng-bind="Gsp.gspName" value="gspNo">Single Wallet</option>

                    </select>
                </div>
                <div class="col-4">
                    <label>To</label>
                    <select class="inputField">
                        <option>ASC Sports</option>
                        <option>ASC Sports</option>
                        <option>ASC Sports</option>
                    </select>
                </div>
                <div class="col-4">
                    <label>Amount</label>
                    <input type="text" class="txtAmount inputField" />
                </div>
                <div class="col-4 text-center">
                    <label>&nbsp;</label>
                    <button class="btn btn-transfer">Transfer</button>
                </div>

                <div class="clear"></div>
                <p>The transfer amount is from Main Wallet is <strong ng-bind="mainBalance.amount | currency:cc_currency_symbol[mainBalance.currencyIsoCd]:0"></strong>.</p>
            </div>
            <h1 class="margin-top">Promotions <a href="#/promotion" class="btn-more">More</a></h1>
            <div class="container-box box-gray border-round margin-top text-center">
                <img src="common/images/promo-banner.png" height="110" width="427"/>
            </div>
        </div>
        <div ng-show="isSet(2)" class="popup-content" ng-controller="DepositController">
            <form name="depositForm" novalidate ng-submit="processForm()">
                <div class="row-box">
                    <label>Deposit Amount</label>
                    <p>
                        <input type="text" placeholder="0" ng-model="deposit.amount" class="inputField text-left" format="number" value="{{deposit.amount}}" validator="required" valid-method="blur" message-id="depositAmountWatch" />&nbsp;
                        <em add-amount-list="addAmount<?=$_SESSION["currencyIsoCd"]?>">
                        </em>
                        <em>
                        <button type="button" class="btn btn-blue btn-option ng-binding ng-scope" ng-click="resetAmount()">Clear</button>
                        </em>
                        <span id="depositAmountWatch"></span>
                    </p>
                    <div class="clear"></div>
                </div>
                <div class="row-box">
                    <label>Depositor</label>
                    <p>
                        <input type="text" ng-model="deposit.bankHolder" class="inputField" validator="required" valid-method="blur" message-id="bankHolderWatch" />
                        <span id="bankHolderWatch"></span>
                    </p>
                    <div class="clear"></div>
                </div>
                <div class="row-box">
                    <label>Date & Time</label>
                    <p>
                        <input type="text" name="DepositDate" id="datetimepicker" ng-model="deposit.depositDate"  class="inputField inputDate" validator="required" valid-method="blur" message-id="depositDateWatch" />
                        <span id="depositDateWatch"></span>
                    </p>
                    <div class="clear"></div>
                </div>
                <div class="row-box">
                    <label>Type of Deposit</label>
                    <p>
                        <select class="inputField" ng-model="deposit.depositPlace" validator="required" valid-method="blur" message-id="depositPlaceWatch">
                            <option value="" default>Select Deposit Type</option>
                            <option value="ATM">ATM</option>
                            <option value="Counter">Counter</option>
                        </select>
                        <span id="depositPlaceWatch"></span>
                    </p>
                    <div class="clear"></div>
                </div>
                <div class="row-box">
                    <label>Contact Number</label>
                    <p>
                        <input type="text" class="inputField"
                               id="depositPhone"
                               name="phone"
                               international-phone-number
                               ng-model="deposit.phone"
                               required />
                    </p>
                    <div class="clear"></div>
                </div>
                <div class="row-box">
                    <label>Comment</label>
                    <p>
                        <textarea rows="4" cols="20" ng-model="deposit.memo" class="inputTextarea" placeholder="Text is limited to 300 characters"></textarea>
                    </p>
                    <div class="clear"></div>
                </div>
                <div class="row-box-last text-center">
                    <button class="btn btn-submit" ng-disabled="isProcessing">Deposit</button>
                </div>
            </form>
        </div>
        <div ng-show="isSet(3)" class="popup-content" ng-controller="WithdrawalController">
            <form name="withdrawalForm" novalidate ng-submit="processForm()">
                <div class="popup-desc">
                    Please transfer first your game funds to main wallet. Your available balance from main wallet is <strong ng-bind="mainBalance.amount | currency:cc_currency_symbol[mainBalance.currencyIsoCd]:0"></strong>.
                </div>
                <div class="row-box">
                    <label>Withdrawal Amount</label>
                    <p>
                        <input type="text" placeholder="0" ng-model="withdrawal.amount" class="inputField text-left" format="number" value="{{withdrawal.amount}}"  validator="required, number" valid-method="blur" message-id="withdrawAmountWatch" />&nbsp;
                        <em add-amount-list="addAmount<?=$_SESSION["currencyIsoCd"]?>">
                        </em>
                        <em>
                            <button type="button" class="btn btn-blue btn-option ng-binding ng-scope" ng-click="resetAmount()">Clear</button>
                        </em>
                        <span id="withdrawAmountWatch"></span>
                    </p>
                    <div class="clear"></div>
                </div>
                <div class="row-box">
                    <label>Bank</label>
                    <p>
                        <select ng-model="withdrawal.bankNo" class="inputField" style="margin-right: 4px;"  validator="required" valid-method="blur" message-id="withdrawBankNoWatch">
                            <option value="" default>Please Select A Game</option>
                            <option value="101">AFB Sports</option>
                            <option value="105">WFT Sports</option>
                            <option value="111">Bet Radar</option>
                            <option value="555">Microgaming</option>
                            <option value="555">Gameplay</option>
                            <option value="555">Asia Gaming</option>
                            <option value="555">Gold Deluxe</option>
                            <option value="555">Ezugi</option>
                            <option value="555">Playtech</option>
                            <option value="555">Betsoft</option>
                        </select>
                        <input type="text" placeholder="Account Number" ng-model="withdrawal.bankAccountNo" class="inputField" validator="required, number" valid-method="blur" message-id="withdrawBankAcctNoWatch" />
                        <span id="withdrawBankNoWatch"></span>
                        <span id="withdrawBankAcctNoWatch"></span>
                    </p>
                    <div class="clear"></div>
                </div>
                <div class="row-box">
                    <label>Account Holder</label>
                    <p>
                        <input type="text" placeholder="Bank Account Holder Name" ng-model="withdrawal.bankHolder" class="inputField"  validator="required" valid-method="blur" message-id="withdrawBankHolderWatch" />
                        <span id="withdrawBankHolderWatch"></span>
                    </p>
                    <div class="clear"></div>
                </div>
                <div class="row-box">
                    <label>Account Info</label>
                    <p>
                        <input type="text" placeholder="Bank Account Type" ng-model="withdrawal.bankAccountType" class="inputField"  style="margin-right: 4px;" validator="required" valid-method="blur" message-id="withdrawBankAccountTypeWatch"/>
                        <input type="text" placeholder="Bank Place" ng-model="withdrawal.bankPlace" class="inputField" style="margin-right: 4px;" validator="required" valid-method="blur" message-id="withdrawBankPlaceWatch" />
                        <input type="text" placeholder="Bank Office" ng-model="withdrawal.bankOffice" class="inputField" style="margin-right: 4px;" validator="required" valid-method="blur" message-id="withdrawBankOfficeWatch" />
                        <span id="withdrawBankAccountTypeWatch"></span>
                        <span id="withdrawBankPlaceWatch"></span>
                        <span id="withdrawBankOfficeWatch"></span>
                    </p>
                    <div class="clear"></div>
                </div>
                <div class="row-box">
                    <label>Contact Number</label>
                    <p>
                        <input type="text" class="inputField"
                               id="withdrawalPhone"
                               name="phone"
                               international-phone-number
                               ng-model="withdrawal.phone"
                               required />
                    </p>
                    <div class="clear"></div>
                </div>
                <div class="row-box">
                    <label>Comment</label>
                    <p>
                        <textarea rows="4" cols="20" ng-model="withdrawal.memo" class="inputTextarea" placeholder="Text is limited to 300 characters"></textarea>
                    </p>
                    <div class="clear"></div>
                </div>

                <div class="row-box-last text-center">
                    <button class="btn btn-submit" ng-disabled="isProcessing">Withdrawal</button>
                </div>
            </form>
        </div>
        <div ng-show="isSet(4)" class="popup-content" ng-controller="CouponController">
            <div class="header-row-box">
                <div class="header-title width25 text-center">Coupon Name</div>
                <div class="header-title width20 text-center">Balance</div>
                <div class="header-title width25 text-center">Expiration Date</div>
                <div class="header-title width30 text-center">Status</div>
                <div class="clear"></div>
            </div>
            <div class="pagination-items margin-bottom">
                <div ng-repeat="coupon in filteredPage">
                    <div class="list-row-box">
                        <div class="row-col width25 text-center" ng-bind="coupon.CouponName"></div>
                        <div class="row-col width20 text-right" ng-bind="coupon.CurrencyAmount.amount | currency:cc_currency_symbol[coupon.CurrencyAmount.currencyIsoCd]:0"></div>
                        <div class="row-col width25 text-center" ng-bind="coupon.ExpirationDate"></div>
                        <div ng-if="coupon.Status=='Issued'" class="row-col width30 text-center"><button type="button" class="btn btn-blue btn-option ng-binding ng-scope" ng-click="useCoupon('coupon.CouponCode')">Use Coupon</button> </div>
                        <div ng-if="coupon.Status=='Redeemed'" class="row-col width30 text-center" ng-bind="coupon.Status"></div>
                    </div>
                </div>
            </div>

            <div class="clear"></div>
            <pagination boundary-links="true" total-items="totalItems" ng-model="currentPage" items-per-page="numPerPage" class="pagination-sm" previous-text="&lsaquo;" next-text="&rsaquo;" first-text="&laquo;" last-text="&raquo;"></pagination>


            <div class="clear"></div>
        </div>
        <div ng-show="isSet(5)" class="popup-content">
            <div class="header-row-box">
                <div class="header-title width18 text-center">Category</div>
                <div class="header-title width25 text-center">Game</div>
                <div class="header-title width25 text-center">Type</div>
                <div class="header-title width16 text-center">Balance</div>
                <div class="header-title width16 text-center">Date</div>
                <div class="clear"></div>
            </div>
            <div id="pagination-container4">
                <div class="list-items"></div>

                <div class="clear"></div>
                <div class="pagination">
                    <div class="simple-pagination-previous"></div>
                    <div class="simple-pagination-page-numbers"></div>
                    <div class="simple-pagination-next"></div>
                </div>
            </div>
            <div class="clear"></div>
        </div>
        <div ng-show="isSet(6)" class="popup-content">
            <div class="header-row-box">
                <div class="header-title width18 text-center">Category</div>
                <div class="header-title width25 text-center">Game</div>
                <div class="header-title width25 text-center">Type</div>
                <div class="header-title width16 text-center">Balance</div>
                <div class="header-title width16 text-center">Date</div>
                <div class="clear"></div>
            </div>
            <div id="pagination-container4">
                <div class="list-items"></div>

                <div class="clear"></div>
                <div class="pagination">
                    <div class="simple-pagination-previous"></div>
                    <div class="simple-pagination-page-numbers"></div>
                    <div class="simple-pagination-next"></div>
                </div>
            </div>
            <div class="clear"></div>
        </div>
        <div ng-show="isSet(7)" class="popup-content" ng-controller="ChangePasswordController">
            <form novalidate  ng-submit="processForm()">
                <div class="row-box">
                    <label style="margin-left:167px;">Current Password</label>
                    <p>
                        <input type="password" placeholder="" ng-model="changePwd.password" class="inputField" />
                    </p>
                    <div class="clear"></div>
                </div>
                <div class="row-box">
                    <label style="margin-left:167px;">New Password</label>
                    <p>
                        <input type="password" placeholder="" ng-model="changePwd.newPassword" class="inputField" />
                    </p>
                    <div class="clear"></div>
                </div>
                <div class="row-box">
                    <label style="margin-left:167px;">Confirm New Password</label>
                    <p>
                        <input type="password" placeholder=""  ng-model="changePwd.newConfirmPassword" class="inputField" />
                    </p>
                    <div class="clear"></div>
                </div>
                <div class="row-box-last text-center">
                    <button type="submit" class="btn btn-submit" ng-disabled="isProcessing">Change Password</button>
                </div>
            </form>
        </div>
    </div>
</div>
