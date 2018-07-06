<?php
include_once $_SERVER["DOCUMENT_ROOT"] . "/lib/client.php";
$logoutTypeCd=1;
$result = RestCurl::put("Player.svc/logout/{$_SESSION["accessToken"]}/{$logoutTypeCd}");
//var_dump($result);
if($result["status"]==200){
    if(isset($_SESSION["nickname"]) && isset($_SESSION["accessToken"])){
        session_unset($_SESSION["nickname"]);
        session_unset($_SESSION["accessToken"]);
    }
    unset($_COOKIE["MemberID"]);
    setcookie("MemberID", null, -1,"/");
    setcookie(
        "PHPSESSID",
        session_id(),
        time() - 3600/*ini_get("session.cookie_lifetime"),*/,
        ini_get("session.cookie_path"),
        ini_get("session.cookie_domain"),
        ini_get("session.cookie_secure"),
        ini_get("session.cookie_httponly")
    );
    session_regenerate_id(true);
    $message="Logged out";
    echo json_encode(array("status"=>$result["status"],"message"=>$message,"alert"=>false));
}else if($result["status"]==400){
    $message=$result["data"]->errorMessage;
    echo json_encode(array("status"=>$result["status"],"message"=>$message,"alert"=>true));
}