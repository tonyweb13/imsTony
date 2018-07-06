<?php
include_once $_SERVER["DOCUMENT_ROOT"] . "/lib/client.php";
if(!empty($_POST)) {
    $_POST = array_map("trim",$_POST);
    $_POST = array_map("strip_tags",$_POST);
}

$p = array(
    "accessToken" => $_SESSION["accessToken"],
    "currencyAmount" => array("currencyNo"=>$_SESSION["currencyNo"],"amount"=>$_POST["amount"]),
    "bankNo"=> $_POST["bankNo"],
    "phone"=>$_POST["phone"],
    "bankHolder"=>$_POST["bankHolder"],
    "bankAccountNo"=> $_POST["bankAccountNo"],
    "bankAccountType"=> $_POST["bankAccountType"],
    "bankPlace"=>$_POST["bankPlace"],
    "bankOffice"=>$_POST["bankOffice"],
    "memo"=>$_POST["memo"]
);



$result = RestCurl::post("Finance.svc/requestWithdrawal", $p);

if($result["status"] == 200){
    $message="success";
    echo json_encode(array("status"=>$result["status"],"message"=>$message,"alert"=>false));
}else{
    $message=$result["data"]->errorMessage;
    echo json_encode(array("status"=>$data["status"],"message"=>$message,"alert"=>true));
}