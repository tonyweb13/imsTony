<?php
include_once $_SERVER["DOCUMENT_ROOT"] . "/lib/client2.php";

$p = array(
    "announceTypeCd" => $_GET["announceTypeCd"],
    "incluedParent" => true,
    "isPopup"=>true,
    "languageNo" => $_SESSION["browserLanguageCd"]
);

$result = RestCurl::post("Operation.svc/announcements",$p);

if($result["status"] == 200){
    $message="success";
    echo json_encode(array("status"=>$result["status"],"message"=>$message,"result"=>$result["data"],'alert'=>false));
}else{
    $message=$result["data"]->errorMessage;
    echo json_encode(array("status"=>$result["status"],"message"=>$message,"alert"=>true));
}
