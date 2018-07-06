<?php
include_once $_SERVER["DOCUMENT_ROOT"] . "/lib/client.php";

$user = ip_info();
$user["country_code"];

$result = RestCurl::get("SystemSetting.svc/agentCountries");

if($result["status"] == 200){
    $message="success";
    echo json_encode(array("status"=>$result["status"],"message"=>$message,"result"=>$result["data"],'alert'=>false));
}else{
    $message=$result["data"]->errorMessage;
    echo json_encode(array("status"=>$result["status"],"message"=>$message,"alert"=>true));
}
