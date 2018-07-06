<?php
include_once $_SERVER["DOCUMENT_ROOT"] . "/lib/client.php";

if(isset($_SESSION['accessToken'])){

    $result = RestCurl::get("Player.svc/token/{$_SESSION['accessToken']}/playerDetail");
    if($result["status"]==200){
        $message="get";
        echo json_encode(array("result"=>$result["status"],"message"=>$message,"info"=>$result["data"],'alert'=>false));
    }else if($result["status"]==400){
        $message=$result["data"]->errorMessage;
        echo json_encode(array("result"=>$result["status"],"message"=>$message,'alert'=>true));
    }
}else{
    $message="pleaseLogin";
    echo json_encode(array("result"=>$result["status"],"message"=>$message,'alert'=>true));
}
