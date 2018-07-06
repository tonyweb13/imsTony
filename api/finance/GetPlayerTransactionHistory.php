<?php
include_once $_SERVER["DOCUMENT_ROOT"] . "/lib/client.php";

if(!empty($_GET)) {
    $_GET = array_map("trim",$_GET);
    $_GET = array_map("strip_tags",$_GET);
}


$endDate = new DateTime(date("Y-m-d\TH:i:s.uO"));
$startDate = new DateTime(date("Y-m-d\TH:i:s.uO"));
$startDate->modify('-1 year');

$p = array(
    "accessToken" => $_SESSION["accessToken"],
    "languageNo" => $_SESSION["browserLanguageCd"],
    "startDate" => $startDate->format("Y-m-d\TH:i:s.uO"),
    "endDate" => $endDate->format("Y-m-d\TH:i:s.uO"),
    "pageRows" => 20,
    "page" => 1
);

$result = RestCurl::post("Finance.svc/playerTransactionHistory",$p);

if($result["status"] == 200){
    $message="success";
    echo json_encode(array("status"=>$result["status"],"message"=>$message,"result"=>$result["data"],'alert'=>false));
}else{
    $message=$result["data"]->errorMessage;
    echo json_encode(array("status"=>$result["status"],"message"=>$message,"alert"=>true));
}
