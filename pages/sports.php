<div class="container">
    <div class="margin-top" ng-controller="TabController as tab">
        <h1 class="pageTitleImage titleSports"></h1>
        <div class="sports-game-buttons container-box box-main box-default margin-bottom">
            <div ng-repeat="sportsGame in getAgentSportsGameList" class="sports-game-button sports-game-button{{$index+1}}" ng-class="{ active:tab.isSet($index+1) }" ng-click="tab.setTab($index+1)">
                <h3 ng-bind="sportsGame.gameList[0].gameName"></h3>
                <button class="btn btn-play hvr-push">Play Now</button>
                <div class="sports-game-button-overlay"></div>
            </div>
            <div class="clear"></div>
        </div>

        <div ng-show="tab.isSet(1)" class="container box-default margin-bottom">
            <img src="common/images/sportssample2.jpg" />
        </div>
        <div ng-show="tab.isSet(2)" class="container box-default margin-bottom">
            <img src="common/images/sportssample1.png" />
        </div>
        <div ng-show="tab.isSet(3)" class="container box-default margin-bottom">
            <img src="common/images/sportssample2.jpg" />
        </div>
        <div ng-show="tab.isSet(4)" class="container box-default margin-bottom">
            <img src="common/images/sportssample1.png" />
        </div>
        <div ng-show="tab.isSet(5)" class="container box-default margin-bottom">
            <img src="common/images/sportssample2.jpg" />
        </div>
    </div>
</div>