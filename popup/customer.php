<?session_start()?>
<div id="popup-customer" ng-class="customerPopup()" ng-init="setTab(selectCustomerTab)">
    <div class="popup-tabs">
        <ul class="popTabs">
            <li id="customerNotice"         ng-class="{ active:isSet(1) }" ng-click="setTab(1)">Notice</li>
            <li id="customerEvent"          ng-class="{ active:isSet(2) }" ng-click="setTab(2)">Event</li>
            <li id="customerFAQ"            ng-class="{ active:isSet(3) }" ng-click="setTab(3)">FAQ</li>
            <li id="customer1on1"           ng-show="loggedIn" ng-class="{ active:isSet(4) }" ng-click="setTab(4)">1:1 Customer Service</li>
            <li id="customerPartnership"    ng-show="loggedIn" ng-class="{ active:isSet(5) }" ng-click="setTab(5)">Partnership</li>
        </ul>
        <div class="clear"></div>

        <div ng-show="isSet(1)" class="popup-content" ng-controller="NoticeController">
            <div class="header-row-box">
                <div class="header-title width70 text-center">Title</div>
                <div class="header-title width30 text-center">Update Date</div>
                <div class="clear"></div>
            </div>
            <div class="pagination-items margin-bottom">
                <div ng-repeat="notice in filteredPage">
                    <div class="list-row-box">
                        <div class="row-col width70 text-left paddingL10" ng-bind="notice.title" ng-click="readBoard('notice.announceNo')"></div>
                        <div class="row-col width30 text-center" ng-bind="notice.updateDate | userDateTime"></div>
                    </div>
                </div>
            </div>
            <div class="clear"></div>
            <pagination boundary-links="true" total-items="totalItems" ng-model="currentPage" items-per-page="numPerPage" class="pagination-sm" previous-text="&lsaquo;" next-text="&rsaquo;" first-text="&laquo;" last-text="&raquo;"></pagination>
            <div class="clear"></div>
        </div>
        <div ng-show="isSet(2)" class="popup-content" ng-controller="EventController">
            <div class="header-row-box">
                <div class="header-title width70 text-center">Title</div>
                <div class="header-title width30 text-center">Update Date</div>
                <div class="clear"></div>
            </div>
            <div class="pagination-items margin-bottom">
                <div ng-repeat="event in filteredPage">
                    <div class="list-row-box">
                        <div class="row-col width70 text-left paddingL10" ng-bind="event.title" ng-click="readBoard('event.announceNo')"></div>
                        <div class="row-col width30 text-center" ng-bind="event.updateDate | userDateTime"></div>
                    </div>
                </div>
            </div>
            <div class="clear"></div>
            <pagination boundary-links="true" total-items="totalItems" ng-model="currentPage" items-per-page="numPerPage" class="pagination-sm" previous-text="&lsaquo;" next-text="&rsaquo;" first-text="&laquo;" last-text="&raquo;"></pagination>
            <div class="clear"></div>
        </div>
        <div ng-show="isSet(3)" class="popup-content" ng-controller="FAQController">
            <div class="header-row-box">
                <div class="header-title width70 text-center">Title</div>
                <div class="header-title width30 text-center">Update Date</div>
                <div class="clear"></div>
            </div>
            <div class="pagination-items margin-bottom">
                <div ng-repeat="faq in filteredPage">
                    <div class="list-row-box">
                        <div class="row-col width70 text-left paddingL10" ng-bind="faq.title" ng-click="readBoard('faq.announceNo')"></div>
                        <div class="row-col width30 text-center" ng-bind="faq.updateDate | userDateTime"></div>
                    </div>
                </div>
            </div>
            <div class="clear"></div>
            <pagination boundary-links="true" total-items="totalItems" ng-model="currentPage" items-per-page="numPerPage" class="pagination-sm" previous-text="&lsaquo;" next-text="&rsaquo;" first-text="&laquo;" last-text="&raquo;"></pagination>
            <div class="clear"></div>
        </div>
        <div ng-show="isSet(4)" class="popup-content">
            <div class="header-row-box">
                <div class="header-title width60"><span><p class="text-left">Welcome to PlayCasino !!</p></span></div>
                <div class="header-title width20 text-right">Writer : <strong>PlayCasino</strong></div>
                <div class="header-title width20 text-right">Time : <strong>2014-05-09</strong></div>
                <div class="clear"></div>
            </div>

            <div class="preview-box">
                Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat. Ut wisi enim ad minim veniam, quis nostrud exerci tation ullamcorper suscipit lobortis nisl ut aliquip ex ea commodo consequat. Duis autem vel eum iriure dolor in hendrerit in vulputate velit esse molestie consequat, vel illum dolore eu feugiat nulla facilisis at vero eros et accumsan et iusto odio dignissim qui blandit praesent luptatum zzril delenit augue duis dolore te feugait nulla facilisi. Nam liber tempor cum soluta nobis eleifend option congue nihil imperdiet doming id quod mazim placerat facer possim assum. Typi non habent claritatem insitam; est usus legentis in iis qui facit eorum claritatem. Investigationes demonstraverunt lectores legere me lius quod ii legunt saepius.
            </div>

            <div ng-controller="MessageController as msgCtrl">
                <div class="message-box">
                    <div class="admin-message">
                        <div class="message-name text-left"><strong>Admin - UEFA168</strong></div>
                        <div class="message-time text-right"><em>09:59 &nbsp; 2014-05-09</em></div>
                        <div class="clear"></div>

                        <div class="admin-message-box">
                            <p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat. Ut wisi enim ad minim veniam, quis nostrud exerci tation ullamcorper suscipit lobortis nisl ut aliquip ex ea commodo consequat.</p>
                        </div>
                    </div>
                    <div class="clear"></div>

                    <div class="user-message" ng-repeat="message in msgCtrl.reviews">
                        <div class="message-name text-left"><strong>Name</strong></div>
                        <div class="message-time text-right"><em>{{message.createdOn | date:'HH:mm MM-dd-yyyy'}}</em></div>
                        <div class="clear"></div>

                        <div class="user-message-box">
                            <p>{{message.body}}</p>
                        </div>
                    </div>
                    <div class="clear"></div>
                </div>

                <div class="header-title-box">
                    <form name="messageForm" ng-submit="messageForm.$valid && msgCtrl.addChatMsg(message)" novalidate>
                            <textarea rows="8" class="width99" id="textarea"
                                      ng-model="msgCtrl.message.body" placeholder="Type your message here"></textarea>
                        <div class="text-count"><span id="textarea_feedback" class="input-textcount"></span>Remaining Characters</div>
                        <div class="btn-send"><button class="btn btn-send">SEND</button></div>
                        <div class="clear"></div>
                    </form>
                </div>
            </div>

            <div class="header-row-box">
                <div class="header-title width10 text-center">Number</div>
                <div class="header-title width70 text-center">Subject</div>
                <div class="header-title width10 text-center">Date Created</div>
                <div class="header-title width10 text-center">Views</div>
                <div class="clear"></div>
            </div>

            <div id="notice-container">
                <table cellpadding="0" cellspacing="0" width="100%">
                    <tbody>
                    <tr>
                        <td>
                            <div class="row-col width10 text-center">12</div>
                            <div class="row-col width70 text-left">Content 1</div>
                            <div class="row-col width10 text-center">2014.05.02</div>
                            <div class="row-col width10 text-center">325</div>
                            <div class="clear"></div>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <div class="row-col width10 text-center">11</div>
                            <div class="row-col width70 text-left">CJ E&M made the Top 10 in Pocket Gamerâ€™s Top 50 Developers!.</div>
                            <div class="row-col width10 text-center">2014.05.02</div>
                            <div class="row-col width10 text-center">325</div>
                            <div class="clear"></div>
                        </td>
                    </tr>
                    </tbody>
                </table>

                <div class="pagination-container">
                    <div class="pagination pagination-board">
                        <div class="my-navigation">
                            <span class="simple-pagination-previous"></span>
                            <span class="simple-pagination-page-numbers"></span>
                            <span class="simple-pagination-next"></span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="clear"></div>
        </div>
        <div ng-show="isSet(5)" class="popup-content">
            <div class="partnership-banner" class="owl-carousel owl-theme">
                <div class="item"><img src="common/images/banner-partnership1.png" /></div>
                <div class="item"><img src="common/images/banner-partnership2.png" /></div>
            </div>
            <div class="partnership-box box-default container-box width30 float-left">
                <h3>1 SUBMIT APPLICATION</h3>
                <p>Start by filling the TestCasino Affiliate Programme application form with your details today.
                    As soon as you submit it, you become part of the most rewarding affiliate program around. Join now!</p>

                <h3>2 START PROMOTING</h3>
                <p>W88 Affiliate Program offers you a vast array of advanced marketing tools to attract new Members and start promoting.</p>

                <h3>3 START MAKING MONEY</h3>
                <p class="no-margin">You profit from every player that you refer to W88. Make the most of your potential to attract as many players as you can.
                    The more you keep them coming, the higher your revenue.</p>
            </div>
            <div class="partnership-box box-default container-box width68 float-right">
                <h2>WHY JOIN OUR AFFILIATE PROGRAMME?</h2>
                <p>By becoming an affiliate of TestCasino, you can:</p>
                <ol>
                    <li>1. Earn up to 40% commission on your Revenue Share</li>
                    <li>2. Earn Lifetime revenue on referred players</li>
                    <li>3. Full cross product earnings</li>
                    <li>4. Be part of the next generation of online Sports Betting</li>
                    <li>5. Wide range of greate products</li>
                    <li>6. Full support from our dedicated affiliate managers</li>
                </ol>
                <span class="text-center">
                    <button class="btn btn-submit">CLICK HERE</button>
                </span>
            </div>
            <div class="clear"></div>
        </div>
    </div>
</div>