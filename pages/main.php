<div id="masthead-container" class="whole-container">
    <div class="container">
        <div class="masthead"></div>
    </div>
</div>

<div class="container" ng-controller="MainController" ng-init="init()">
    <div class="container-box box-main margin-bottom">
        <div id="game-buttons-3" class="game-buttons">
            <div class="game-button game-button{{$index+1}} animated fadeIn" ng-repeat="casinoGame in getAgentCasinoGameList">
                <h3 ng-bind="casinoGame.gameList[0].gameName"></h3>
                <div class="game-button-play">
                    <button class="btn btn-play hvr-push" ng-cloak>{{ "Play Now" | translate}}</button>
                    <button ng-if="casinoGame.gspNo == 101" class="btn btn-play btn-list hvr-push"><i class="icon-list"></i></button>
                </div>
                <div class="game-button-overlay"></div>
            </div>
            <div class="clear"></div>
        </div>
    </div>

    <div class="container margin-bottom">
        <div class="jackpot">
            <h1 ng-cloak>{{ "Slot Games Progressive Jackpot" | translate}}</h1>
            <strong>$</strong>
            <div class="pjackpot"></div>
        </div>
    </div>

    <div class="container-box box-default margin-bottom">
        <div class="col-3 box-default-right box-promos no-margin">
            <h3 ng-cloak>{{ "Promotions" | translate}} <a href="#promotion" class="btn-more" ng-cloak>{{ "More" | translate}}</a></h3>
            <div id="promo-slider" class="owl-carousel owl-theme">
                <div class="item"><img src="common/images/promo1.png" width="315" height="286"/></div>
                <div class="item"><img src="common/images/promo1.png" width="315" height="286" /></div>
                <div class="item"><img src="common/images/promo1.png" width="315" height="286" /></div>
            </div>
        </div>
        <div class="col-3 box-default-right box-products">
            <h3 ng-cloak>{{ "Product Advantages" | translate}}</h3>
            <div class="product-items">
                <h1 ng-cloak>{{ "Product Advantages" | translate}}</h1>
                <p ng-cloak>{{ "Well-known Asian and European view sports Betting available here" | translate}} </p>
            </div>
            <div class="product-items">
                <h1 ng-cloak>{{ "Live Casino" | translate}}</h1>
                <p ng-cloak>{{ "Unforgettable experience with the best live casino games online" | translate}}</p>
            </div>
            <div class="product-items">
                <h1 ng-cloak>{{ "Slots"  | translate}}</h1>
                <p ng-cloak>{{ "Exciting animations and cool 3D Effects" | translate}}</p>
            </div>
            <div class="product-items">
                <h1 ng-cloak>{{ "Keno and Lottery"  | translate}}</h1>
                <p ng-cloak>{{ "Unforgettable experience with the best live casino games online" | translate}}</p>
            </div>
            <div class="product-items">
                <h1 ng-cloak>{{ "Single Wallet"  | translate}}</h1>
                <p ng-cloak>{{ "Exciting animations and cool 3D Effects"  | translate}}</p>
            </div>
        </div>
        <div class="col-3 box-customer" ng-cloak>
            <h3 ng-cloak>{{ "Customer Service" | translate}}</h3>
            <div class="customer-service margin-bottom">
                <div class="customer-service-button" ng-repeat="contractSns in contactSnsList" >
                    <div id="agentSns0">
                        <i class="icon-{{contractSns.snsName | lowercase}}"></i>
                        <strong ng-bind="contractSns.snsName"></strong>
                        <span ng-bind="contractSns.snsId"></span>
                        <div class="clear"></div>
                    </div>
                </div>
                <div class="customer-service-button no-border">
                    <i class="icon-livechat"></i>
                    <strong ng-cloak>{{ "Live Chat" | translate}}</strong>
                    <span ng-cloak>{{ "Click Here" | translate}}</span>
                    <div class="clear"></div>
                </div>
                <div class="clear"></div>
                <div class="customer-service-button2 border-round">
                    <table cellpadding="0" cellspacing="0">
                        <tr>
                            <td class="customer-service-title" ng-cloak>{{ "Hotline" | translate}}</td>
                            <td id="hotLine" class="customer-service-number">
                                <span ng-repeat="contracttPhone in contactPhoneList" ng-bind="contracttPhone"></span>
                            </td>
                        </tr>
                    </table>
                </div>
                <div class="customer-service-button2 border-round">
                    <table cellpadding="0" cellspacing="0">
                        <tr>
                            <td class="customer-service-title" ng-cloak>{{ "Email" | translate}}</td>
                            <td id="agentEmail" class="customer-service-detail">
                                <a ng-repeat="contracttEmail in contactEmailList" ng-href="mailto:{{contracttEmail}}" ng-bind="contracttEmail"></a>
                            </td>
                        </tr>
                    </table>
                </div>
                <div class="clear"></div>
            </div>

            <div class="service-advantages">
                <div id="transaction-slider" class="owl-carousel owl-theme">
                    <div>
                        <h3 ng-cloak>{{ "Service Advantages" | translate}}</h3>
                            <div class="service-advantages-item">
                                <h1 ng-cloak>{{ "Deposit" | translate}}</h1>
                                <div class="ave-time" ng-cloak>
                                    {{ "Average Time" | translate}} <strong>2</strong> {{ "minutes" | translate}}
                                </div>
                                <div id="depositBar" class="progressBars">
                                    <div></div>
                                </div>
                            </div>

                        <div class="service-advantages-item">
                            <h1>{{ "Withdraw" | translate}}</h1>
                            <div class="ave-time">
                                {{ "Average Time" | translate}} <strong>15</strong> {{ "minutes" | translate}}
                            </div>
                            <div id="withdrawBar" class="progressBars">
                                <div></div>
                            </div>
                        </div>
                    </div>
                    <div>
                        <h3 ng-cloak>{{ "Last Deposit" | translate}}</h3>
                        <div class="top-item-list">
                            <div id="topItems" ng-repeat="currencyDeposit in currentDepositList">
                                <span class="txtID" ng-bind="currencyDeposit.nickname"></span>
                                <span class="txtAmount" ng-bind="currencyDeposit.currencyAmount.amount | currency: cc_currency_symbol[currencyDeposit.currencyAmount.currencyIsoCd]:0"></span>
                                <span class="txtDate" ng-bind="currencyDeposit.transactionDate | userDate"></span>
                            </div>
                        </div>
                    </div>
                    <div>
                        <h3 ng-cloak>{{ "Last Withdraw" | translate}}</h3>
                        <div class="top-item-list">
                            <div id="topItems" ng-repeat="currentWithdrawal in currentWithdrawalList">
                                <span class="txtID" ng-bind="currentWithdrawal.nickname"></span>
                                <span class="txtAmount" ng-bind="currentWithdrawal.currencyAmount.amount | currency: cc_currency_symbol[currencyDeposit.currencyAmount.currencyIsoCd]:0"></span>
                                <span class="txtDate" ng-bind="currentWithdrawal.transactionDate | userDate"></span>
                            </div>
                        </div>
                    </div>
                    <div>
                        <h3 ng-cloak>{{ "Best Withdraw" | translate}}</h3>
                        <div class="top-item-list">
                            <div id="topItems" ng-repeat="topWithdrawal in topWithdrawalList">
                                <span class="txtID" ng-bind="topWithdrawal.nickname"></span>
                                <span class="txtAmount" ng-bind="topWithdrawal.currencyAmount.amount | currency: cc_currency_symbol[currencyDeposit.currencyAmount.currencyIsoCd]:0"></span>
                                <span class="txtDate" ng-bind="topWithdrawal.transactionDate | userDate"></span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>