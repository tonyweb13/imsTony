<?php
include_once $_SERVER["DOCUMENT_ROOT"] . "/lib/client.php";

if(!empty($_POST)) {
    $_POST = array_map("trim",$_POST);
    $_POST = array_map("strip_tags",$_POST);
}

$dateOfBirth = new DateTime($_POST['birthYear']."-".$_POST['birthMonth']."-".$_POST['birthDay']);
$phone = $_POST['areaNo'].$_POST['phone'];


$clientLocalTime = new DateTime($_POST["clientLocalTime"]);

$p = array(
    "nickname" => $_POST["nickname"],
    "password" => hash("sha256",$_POST["password"]),
    "playerName" => $_POST["nickname"],
    "countryNo" => $_POST["countryNo"],
    "languageNo" => $_POST["languageNo"],
    "dateOfBirth" => $dateOfBirth->format("Y-m-d\TH:i:s.uO"),
    "email" => $_POST["email"],
    "phone" => $phone,
    "gender" => $_POST["gender"],
    "currencyNo" => $_POST["currencyNo"],
    "securityQuestionNo" => $_POST["securityQuestionNo"],
    "securityAnswer" => $_POST["securityAnswer"],
    "referrerNickName" => $_POST["referrerNickName"],
    "signupChannerType" => $channelType
);

//echo json_encode($p);
//echo json_encode(array("status"=>200,"message"=>"login","alert"=>false));
//exit;

$result = RestCurl::post("Player.svc/signup", $p);

if($result["status"] == 200){
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

    if($result["status"] == 200){
        session_unset();
        session_regenerate_id(true);
        setcookie("MemberID", $result["data"]->nickname, 0, "/");
        $_SESSION["nickname"] =  $result["data"]->nickname;
        $_SESSION["agentNo"] =  $result["data"]->agentNo;
        $_SESSION["accessToken"] = $result["data"]->accessToken;
        $_SESSION["languageNo"] = $result["data"]->languageNo;
        $_SESSION["currencyNo"] = $result["data"]->currencyInfo->currencyNo;
        $_SESSION["currencyIsoCd"] = $result["data"]->currencyInfo->currencyIsoCd;
        $_SESSION["languageNo"] = $result["data"]->languageNo;
        $message="login";
        echo json_encode(array("status"=>$result["status"],"message"=>$message,"alert"=>false));
    }else{
        $message=$result["data"]->errorMessage;
        echo json_encode(array("status"=>$result["status"],"message"=>$message,"alert"=>true));
    }
}else{
    $message=$result["data"]->errorMessage;
    echo json_encode(array("status"=>$result["status"],"message"=>$message,"alert"=>true));
}
