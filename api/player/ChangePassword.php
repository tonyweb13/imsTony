<?php
include_once $_SERVER["DOCUMENT_ROOT"] . "/lib/client.php";

if(!empty($_POST)) {
    $_POST = array_map("trim",$_POST);
    $_POST = array_map("strip_tags",$_POST);
}

if($_POST["newPassword"] != $_POST["newConfirmPassword"]){
    $message="Not Matched Password";
    echo json_encode(array("status"=>$result["status"],"message"=>$message,"alert"=>true));
    exit;
}

$p = array(
    "accessToken"=>$_SESSION["accessToken"],
    "password" => hash("sha256",$_POST["password"]),
    "newPassword" => hash("sha256",$_POST["newPassword"])
);

$result = RestCurl::put("Player.svc/ChangePassword", $p);
//var_dump($result);
if($result["status"] == 200){
    $message="password change complete";
    echo json_encode(array("status"=>$result["status"],"message"=>$message,"result"=>$result["data"],"alert"=>false));
}else{
    $message=$result["data"]->errorMessage;
    echo json_encode(array("status"=>$result["status"],"message"=>$message,"alert"=>true));
}
