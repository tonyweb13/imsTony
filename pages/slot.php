<div class="container">
    <div class="margin-top" ng-controller="TabController as tab">
        <h1 class="pageTitleImage titleSlot"></h1>
        <div class="slot-game-buttons container-box box-main box-default margin-bottom">
            <div ng-repeat="slotGame in getAgentSlotList" class="slot-game-button slot-game-button{{$index+1}}" ng-class="{ active:tab.isSet($index+1) }" ng-click="tab.setTab($index+1)">
                <h3 ng-bind="sportsGame.gameList[0].gameName"></h3>
                <button class="btn btn-play hvr-push">Play Now</button>
                <div class="slot-game-button-overlay"></div>
            </div>
            <div class="clear"></div>
        </div>

        <div ng-show="tab.isSet(1)">
            <div class="slot-container container box-default margin-bottom" ng-controller="TabController as tab">
                <ul>
                    <li ng-class="{ active:tab.isSet(1) }" ng-click="tab.setTab(1)">Top 20</li>
                    <li ng-class="{ active:tab.isSet(2) }" ng-click="tab.setTab(2)">Progressive Jackpot</li>
                    <li ng-class="{ active:tab.isSet(3) }" ng-click="tab.setTab(3)">Advance Slot</li>
                    <li ng-class="{ active:tab.isSet(4) }" ng-click="tab.setTab(4)">Bonus Slot</li>
                    <li ng-class="{ active:tab.isSet(5) }" ng-click="tab.setTab(5)">Feature Slot</li>
                    <li ng-class="{ active:tab.isSet(6) }" ng-click="tab.setTab(6)">Video Slot</li>
                    <li ng-class="{ active:tab.isSet(7) }" ng-click="tab.setTab(7)">Slot</li>
                    <li ng-class="{ active:tab.isSet(8) }" ng-click="tab.setTab(8)">Casual</li>
                    <li ng-class="{ active:tab.isSet(9) }" ng-click="tab.setTab(9)">Scratch Card</li>
                    <li ng-class="{ active:tab.isSet(10) }" ng-click="tab.setTab(10)">Video Poker</li>
                    <li ng-class="{ active:tab.isSet(11) }" ng-click="tab.setTab(11)">Table</li>
                </ul>
                <div ng-show="tab.isSet(1)" class="slot-wrapper">
                    <div class="slot-items"></div>
                </div>
                <div ng-show="tab.isSet(2)" class="slot-wrapper">
                    <div class="slot-items"></div>
                </div>
                <div ng-show="tab.isSet(3)" class="slot-wrapper">
                    <div class="slot-items"></div>
                </div>
                <div ng-show="tab.isSet(4)" class="slot-wrapper">
                    <div class="slot-items"></div>
                </div>
                <div ng-show="tab.isSet(5)" class="slot-wrapper">
                    <div class="slot-items"></div>
                </div>
                <div ng-show="tab.isSet(6)" class="slot-wrapper">
                    <div class="slot-items"></div>
                </div>
                <div ng-show="tab.isSet(7)" class="slot-wrapper">
                    <div class="slot-items"></div>
                </div>
                <div ng-show="tab.isSet(8)" class="slot-wrapper">
                    <div class="slot-items"></div>
                </div>
                <div ng-show="tab.isSet(9)" class="slot-wrapper">
                    <div class="slot-items"></div>
                </div>
                <div ng-show="tab.isSet(10)" class="slot-wrapper">
                    <div class="slot-items"></div>
                </div>
                <div ng-show="tab.isSet(11)" class="slot-wrapper">
                    <div class="slot-items"></div>
                </div>
                <div class="clear"></div>
            </div>
        </div>

        <div ng-show="tab.isSet(2)">
            <div class="slot-container container box-default margin-bottom" ng-controller="TabController as tab">
                <ul>
                    <li ng-class="{ active:tab.isSet(1) }" ng-click="tab.setTab(1)">Top 20</li>
                    <li ng-class="{ active:tab.isSet(2) }" ng-click="tab.setTab(2)">Progressive Jackpot</li>
                    <li ng-class="{ active:tab.isSet(3) }" ng-click="tab.setTab(3)">Advance Slot</li>
                    <li ng-class="{ active:tab.isSet(4) }" ng-click="tab.setTab(4)">Bonus Slot</li>
                    <li ng-class="{ active:tab.isSet(5) }" ng-click="tab.setTab(5)">Feature Slot</li>
                    <li ng-class="{ active:tab.isSet(6) }" ng-click="tab.setTab(6)">Video Slot</li>
                    <li ng-class="{ active:tab.isSet(7) }" ng-click="tab.setTab(7)">Slot</li>
                    <li ng-class="{ active:tab.isSet(8) }" ng-click="tab.setTab(8)">Casual</li>
                    <li ng-class="{ active:tab.isSet(9) }" ng-click="tab.setTab(9)">Scratch Card</li>
                    <li ng-class="{ active:tab.isSet(10) }" ng-click="tab.setTab(10)">Video Poker</li>
                    <li ng-class="{ active:tab.isSet(11) }" ng-click="tab.setTab(11)">Table</li>
                </ul>
                <div ng-show="tab.isSet(1)" class="slot-wrapper">
                    <div class="slot-items"></div>
                </div>
                <div ng-show="tab.isSet(2)" class="slot-wrapper">
                    <div class="slot-items"></div>
                </div>
                <div ng-show="tab.isSet(3)" class="slot-wrapper">
                    <div class="slot-items"></div>
                </div>
                <div ng-show="tab.isSet(4)" class="slot-wrapper">
                    <div class="slot-items"></div>
                </div>
                <div ng-show="tab.isSet(5)" class="slot-wrapper">
                    <div class="slot-items"></div>
                </div>
                <div ng-show="tab.isSet(6)" class="slot-wrapper">
                    <div class="slot-items"></div>
                </div>
                <div ng-show="tab.isSet(7)" class="slot-wrapper">
                    <div class="slot-items"></div>
                </div>
                <div ng-show="tab.isSet(8)" class="slot-wrapper">
                    <div class="slot-items"></div>
                </div>
                <div ng-show="tab.isSet(9)" class="slot-wrapper">
                    <div class="slot-items"></div>
                </div>
                <div ng-show="tab.isSet(10)" class="slot-wrapper">
                    <div class="slot-items"></div>
                </div>
                <div ng-show="tab.isSet(11)" class="slot-wrapper">
                    <div class="slot-items"></div>
                </div>
                <div class="clear"></div>
            </div>
        </div>

        <div ng-show="tab.isSet(3)">
            <div class="slot-container container box-default margin-bottom" ng-controller="TabController as tab">
                <ul>
                    <li ng-class="{ active:tab.isSet(1) }" ng-click="tab.setTab(1)">Top 20</li>
                    <li ng-class="{ active:tab.isSet(2) }" ng-click="tab.setTab(2)">Progressive Jackpot</li>
                    <li ng-class="{ active:tab.isSet(3) }" ng-click="tab.setTab(3)">Advance Slot</li>
                    <li ng-class="{ active:tab.isSet(4) }" ng-click="tab.setTab(4)">Bonus Slot</li>
                    <li ng-class="{ active:tab.isSet(5) }" ng-click="tab.setTab(5)">Feature Slot</li>
                    <li ng-class="{ active:tab.isSet(6) }" ng-click="tab.setTab(6)">Video Slot</li>
                    <li ng-class="{ active:tab.isSet(7) }" ng-click="tab.setTab(7)">Slot</li>
                    <li ng-class="{ active:tab.isSet(8) }" ng-click="tab.setTab(8)">Casual</li>
                    <li ng-class="{ active:tab.isSet(9) }" ng-click="tab.setTab(9)">Scratch Card</li>
                    <li ng-class="{ active:tab.isSet(10) }" ng-click="tab.setTab(10)">Video Poker</li>
                    <li ng-class="{ active:tab.isSet(11) }" ng-click="tab.setTab(11)">Table</li>
                </ul>
                <div ng-show="tab.isSet(1)" class="slot-wrapper">
                    <div class="slot-items"></div>
                </div>
                <div ng-show="tab.isSet(2)" class="slot-wrapper">
                    <div class="slot-items"></div>
                </div>
                <div ng-show="tab.isSet(3)" class="slot-wrapper">
                    <div class="slot-items"></div>
                </div>
                <div ng-show="tab.isSet(4)" class="slot-wrapper">
                    <div class="slot-items"></div>
                </div>
                <div ng-show="tab.isSet(5)" class="slot-wrapper">
                    <div class="slot-items"></div>
                </div>
                <div ng-show="tab.isSet(6)" class="slot-wrapper">
                    <div class="slot-items"></div>
                </div>
                <div ng-show="tab.isSet(7)" class="slot-wrapper">
                    <div class="slot-items"></div>
                </div>
                <div ng-show="tab.isSet(8)" class="slot-wrapper">
                    <div class="slot-items"></div>
                </div>
                <div ng-show="tab.isSet(9)" class="slot-wrapper">
                    <div class="slot-items"></div>
                </div>
                <div ng-show="tab.isSet(10)" class="slot-wrapper">
                    <div class="slot-items"></div>
                </div>
                <div ng-show="tab.isSet(11)" class="slot-wrapper">
                    <div class="slot-items"></div>
                </div>
                <div class="clear"></div>
            </div>
        </div>

        <div ng-show="tab.isSet(4)">
            <div class="slot-container container box-default margin-bottom" ng-controller="TabController as tab">
                <ul>
                    <li ng-class="{ active:tab.isSet(1) }" ng-click="tab.setTab(1)">Top 20</li>
                    <li ng-class="{ active:tab.isSet(2) }" ng-click="tab.setTab(2)">Progressive Jackpot</li>
                    <li ng-class="{ active:tab.isSet(3) }" ng-click="tab.setTab(3)">Advance Slot</li>
                    <li ng-class="{ active:tab.isSet(4) }" ng-click="tab.setTab(4)">Bonus Slot</li>
                    <li ng-class="{ active:tab.isSet(5) }" ng-click="tab.setTab(5)">Feature Slot</li>
                    <li ng-class="{ active:tab.isSet(6) }" ng-click="tab.setTab(6)">Video Slot</li>
                    <li ng-class="{ active:tab.isSet(7) }" ng-click="tab.setTab(7)">Slot</li>
                    <li ng-class="{ active:tab.isSet(8) }" ng-click="tab.setTab(8)">Casual</li>
                    <li ng-class="{ active:tab.isSet(9) }" ng-click="tab.setTab(9)">Scratch Card</li>
                    <li ng-class="{ active:tab.isSet(10) }" ng-click="tab.setTab(10)">Video Poker</li>
                    <li ng-class="{ active:tab.isSet(11) }" ng-click="tab.setTab(11)">Table</li>
                </ul>
                <div ng-show="tab.isSet(1)" class="slot-wrapper">
                    <div class="slot-items"></div>
                </div>
                <div ng-show="tab.isSet(2)" class="slot-wrapper">
                    <div class="slot-items"></div>
                </div>
                <div ng-show="tab.isSet(3)" class="slot-wrapper">
                    <div class="slot-items"></div>
                </div>
                <div ng-show="tab.isSet(4)" class="slot-wrapper">
                    <div class="slot-items"></div>
                </div>
                <div ng-show="tab.isSet(5)" class="slot-wrapper">
                    <div class="slot-items"></div>
                </div>
                <div ng-show="tab.isSet(6)" class="slot-wrapper">
                    <div class="slot-items"></div>
                </div>
                <div ng-show="tab.isSet(7)" class="slot-wrapper">
                    <div class="slot-items"></div>
                </div>
                <div ng-show="tab.isSet(8)" class="slot-wrapper">
                    <div class="slot-items"></div>
                </div>
                <div ng-show="tab.isSet(9)" class="slot-wrapper">
                    <div class="slot-items"></div>
                </div>
                <div ng-show="tab.isSet(10)" class="slot-wrapper">
                    <div class="slot-items"></div>
                </div>
                <div ng-show="tab.isSet(11)" class="slot-wrapper">
                    <div class="slot-items"></div>
                </div>
                <div class="clear"></div>
            </div>
        </div>

        <div ng-show="tab.isSet(5)">
            <div class="slot-container container box-default margin-bottom" ng-controller="TabController as tab">
                <ul>
                    <li ng-class="{ active:tab.isSet(1) }" ng-click="tab.setTab(1)">Top 20</li>
                    <li ng-class="{ active:tab.isSet(2) }" ng-click="tab.setTab(2)">Progressive Jackpot</li>
                    <li ng-class="{ active:tab.isSet(3) }" ng-click="tab.setTab(3)">Advance Slot</li>
                    <li ng-class="{ active:tab.isSet(4) }" ng-click="tab.setTab(4)">Bonus Slot</li>
                    <li ng-class="{ active:tab.isSet(5) }" ng-click="tab.setTab(5)">Feature Slot</li>
                    <li ng-class="{ active:tab.isSet(6) }" ng-click="tab.setTab(6)">Video Slot</li>
                    <li ng-class="{ active:tab.isSet(7) }" ng-click="tab.setTab(7)">Slot</li>
                    <li ng-class="{ active:tab.isSet(8) }" ng-click="tab.setTab(8)">Casual</li>
                    <li ng-class="{ active:tab.isSet(9) }" ng-click="tab.setTab(9)">Scratch Card</li>
                    <li ng-class="{ active:tab.isSet(10) }" ng-click="tab.setTab(10)">Video Poker</li>
                    <li ng-class="{ active:tab.isSet(11) }" ng-click="tab.setTab(11)">Table</li>
                </ul>
                <div ng-show="tab.isSet(1)" class="slot-wrapper">
                    <div class="slot-items"></div>
                </div>
                <div ng-show="tab.isSet(2)" class="slot-wrapper">
                    <div class="slot-items"></div>
                </div>
                <div ng-show="tab.isSet(3)" class="slot-wrapper">
                    <div class="slot-items"></div>
                </div>
                <div ng-show="tab.isSet(4)" class="slot-wrapper">
                    <div class="slot-items"></div>
                </div>
                <div ng-show="tab.isSet(5)" class="slot-wrapper">
                    <div class="slot-items"></div>
                </div>
                <div ng-show="tab.isSet(6)" class="slot-wrapper">
                    <div class="slot-items"></div>
                </div>
                <div ng-show="tab.isSet(7)" class="slot-wrapper">
                    <div class="slot-items"></div>
                </div>
                <div ng-show="tab.isSet(8)" class="slot-wrapper">
                    <div class="slot-items"></div>
                </div>
                <div ng-show="tab.isSet(9)" class="slot-wrapper">
                    <div class="slot-items"></div>
                </div>
                <div ng-show="tab.isSet(10)" class="slot-wrapper">
                    <div class="slot-items"></div>
                </div>
                <div ng-show="tab.isSet(11)" class="slot-wrapper">
                    <div class="slot-items"></div>
                </div>
                <div class="clear"></div>
            </div>
        </div>
    </div>
</div>