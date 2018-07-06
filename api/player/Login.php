<?php
include_once $_SERVER["DOCUMENT_ROOT"] . "/lib/client.php";
if(!empty($_POST)) {
    $_POST = array_map("trim",$_POST);
    $_POST = array_map("strip_tags",$_POST);
}
//for os detect

// TODO: we will use each user browser language code
//for langause detect
$data = get_languages("data");
$browser_language = $data[0][0];

//ClientTime
$clientLocalTime = new Datetime($_POST["clientLocalTime"]);
//echo md5(hash("sha256",$_POST["password"]));
$p = array(
    "nickname" => $_POST["nickname"],
    "password" => hash("sha256",$_POST["password"]),
    "clientLocalTime" => $clientLocalTime->format("Y-m-d\TH:i:s.uO"),
    "loginChannelType" => $channelType,
    "agentUrlSeqNo" => "1",
    "screenWidth" =>$_POST["screenWidth"],
    "screenHeight" => $_POST["screenHeight"]
);

$result = RestCurl::post("Player.svc/login", $p);
//var_dump($result);
if($result["status"] == 200){
    $browser_language = $_SESSION["browserLanguageCd"];
    session_unset();
    session_regenerate_id(true);
    setcookie("nickname", $result["data"]->nickname, 0, "/");
    $_SESSION["nickname"] =  $result["data"]->nickname;
    $_SESSION["browserLanguageCd"] =  $browser_language;
    $_SESSION["agentNo"] =  $result["data"]->agentNo;
    $_SESSION["accessToken"] = $result["data"]->accessToken;
    $_SESSION["languageNo"] = $result["data"]->languageNo;
    $_SESSION["currencyNo"] = $result["data"]->currencyInfo->currencyNo;
    $_SESSION["currencyIsoCd"] = $result["data"]->currencyInfo->currencyIsoCd;
    $_SESSION["languageNo"] = $result["data"]->languageNo;
    $message="login";
    echo json_encode(array("status"=>$result["status"],"message"=>$message,"alert"=>false,"Cookie"=>session_id()));
}else{
    $message=$result["data"]->errorMessage;
    echo json_encode(array("status"=>$result["status"],"message"=>$message,"alert"=>true));
}