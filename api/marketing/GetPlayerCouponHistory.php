<?php
include_once $_SERVER["DOCUMENT_ROOT"] . "/lib/client.php";

if(!isset($_SESSION['accessToken'])){
    $message="Plese Login";
    echo json_encode(array("status"=>$result["status"],"message"=>$message,"alert"=>true));
    exit;
}

//$result = RestCurl::get("Marketing.svc/token/{$_SESSION['accessToken']}/couponHistory");
$result = RestCurl::get("Marketing.svc/token/19D2748ABD1A462D8C75105661815F7A/couponHistory");

//temp 데이터
//
//for($i=0;$i<100;$i++){
//    $data = new stdClass();
//    $data->CouponCode = "W97FT2982GD4";
//    $data->CouponName = "Test";
//    $data->CurrencyAmount =  array("currencyIsoCd"=>"USD","amount"=>200);
//    $data->ExpirationDate="";
//    $data->Status="Redeemed";
//    $list[]=$data;
//
//}
//
//
//
//$result["data"]->CouponList = (object) array_merge( (array)$result["data"]->CouponList,$list);
//var_dump($result["data"]);
if($result["status"] == 200){
    $message="success";
    echo json_encode(array("status"=>$result["status"],"message"=>$message,"result"=>$result["data"],'alert'=>false));
}else{
    $message=$result["data"]->errorMessage;
    echo json_encode(array("status"=>$result["status"],"message"=>$message,"alert"=>true));
}



