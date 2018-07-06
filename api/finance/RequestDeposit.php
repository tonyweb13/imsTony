<?php
include_once $_SERVER["DOCUMENT_ROOT"] . "/lib/client.php";
if(!empty($_POST)) {
    $_POST = array_map("trim",$_POST);
    $_POST = array_map("strip_tags",$_POST);
}
if(!isset($_SESSION['accessToken'])){
    $message="Plese Login";
    echo json_encode(array("status"=>$result["status"],"message"=>$message,"alert"=>true));
    exit;
}

$p = array(
    "accessToken" => $_SESSION["accessToken"],
    "currencyAmount" => array("currencyNo"=>$_SESSION["currencyNo"],"amount"=>$_POST["amount"]),
    "bankNo"=> $_POST["bankNo"],
    "phone"=>$_POST["phone"],
    "bankHolder"=>$_POST["bankHolder"],
    "depositPlace"=>$_POST["depositPlace"],
    "depositType"=>$_POST["depositType"],
    "memo"=>$_POST["memo"],
);

$result = RestCurl::post("Finance.svc/requestDeposit", $p);

if($result["status"] == 200){
    $message="success";
    echo json_encode(array("status"=>$result["status"],"message"=>$message,"alert"=>false));
}else{
    $message=$result["data"]->errorMessage;
    echo json_encode(array("status"=>$result["status"],"message"=>$message,"alert"=>true));
}
