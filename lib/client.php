<?php
session_start();
ini_set('display_errors', 1);
error_reporting(E_ALL & ~E_NOTICE & ~E_STRICT & ~E_DEPRECATED);
header('Content-type:text/html; charset=UTF-8');
header('P3P: CP="ALL CURa ADMa DEVa TAIa OUR BUS IND PHY ONL UNI PUR FIN COM NAV INT DEM CNT STA POL HEA PRE LOC OTC"');
include_once $_SERVER["DOCUMENT_ROOT"] . "/lib/detect_browser.php";
include_once $_SERVER["DOCUMENT_ROOT"] . "/lib/detect_language.php";
include_once $_SERVER["DOCUMENT_ROOT"] . "/lib/detect_mobile.php";
include_once $_SERVER["DOCUMENT_ROOT"] . "/lib/detect_country.php";
include_once $_SERVER["DOCUMENT_ROOT"] . "/lib/incapsula.php";
$mobile_detect = new Mobile_Detect;

Class RestCurl {
    public static function exec($method, $url, $obj = array()) {
        $url = "http://ims.api.int.cmt-korea.com:8091/FrontAPI/".$url;
        $agentId="CT_20000";
        $agentPw="12345" ;
        $headers = array();
        $headers[] = "AgentId: {$agentId}";
        $headers[] = "AgentPw: {$agentPw}";
        $headers[] = "Content-Type: application/json";
        $headers[] = "VisiterUrl: {$_SERVER['HTTP_HOST']}";
        $headers[] = "ServerIp: {$_SERVER['SERVER_ADDR']}";
        $headers[] = "UserIp: {$_SERVER['REMOTE_ADDR']}";


        $curl = curl_init();

        switch($method) {
            case 'GET':
                if(strrpos($url, "?") === FALSE) {
                    $url .= '?' . http_build_query($obj);
                }
                break;
            case 'POST':
                curl_setopt($curl, CURLOPT_POST, TRUE);
                curl_setopt($curl, CURLOPT_POSTFIELDS, json_encode($obj));
                break;
            case 'PUT':
            case 'DELETE':
            default:
                curl_setopt($curl, CURLOPT_CUSTOMREQUEST, strtoupper($method)); // method
                curl_setopt($curl, CURLOPT_POSTFIELDS, json_encode($obj)); // body
        }
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, TRUE);
        curl_setopt($curl, CURLOPT_HTTPHEADER,$headers);
        curl_setopt($curl, CURLOPT_CONNECTTIMEOUT, 6);
        curl_setopt($curl , CURLOPT_USERAGENT,$_SERVER["HTTP_USER_AGENT"]);
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_HEADER, TRUE);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, TRUE);

        // Exec
        $response = curl_exec($curl);
        $info = curl_getinfo($curl);
        curl_close($curl);

        // Data
        $header = trim(substr($response, 0, $info['header_size']));
        $body = substr($response, $info['header_size']);

        return array('status' => $info['http_code'], 'header' => $header, 'data' => json_decode($body));
    }
    public static function get($url, $obj = array()) {
        return RestCurl::exec("GET", $url, $obj);
    }
    public static function post($url, $obj = array()) {
        return RestCurl::exec("POST", $url, $obj);
    }
    public static function put($url, $obj = array()) {
        return RestCurl::exec("PUT", $url, $obj);
    }
    public static function delete($url, $obj = array()) {
        return RestCurl::exec("DELETE", $url, $obj);
    }
}


$channelType = "";

if($mobile_detect->isMobile()){
    $loginChannelType = 4;
}else {
    switch (browser_detection("os")) {
        case "win":
            $channelType = 1;
            break;
        case "nt":
            $channelType = 1;
            break;
        case "mac":
            $channelType = 2;
            break;
        case "unix":
            $channelType = 3;
            break;
        case "lin":
            $channelType = 3;
            break;
        default:
            $channelType = 0;
    }
}


if(empty($_SESSION["browserLanguageCd"])){
//    echo "dd";
    $client_browser = get_languages("data");
    $GetLanguage = RestCurl::get("SystemSetting.svc/languages");
    //default question language is english(100)
    $browser_language_code="100";
    if($GetLanguage["status"]==200){
        foreach($GetLanguage["data"] as $value){
            //we get the browser language
            if($value->lnBrowserCd  == $client_browser[0][0]){
                $browser_language_code=$value->languageNo;
            }if($value->languageName == $client_browser[0][0]){
                $browser_language_code=$value->languageNo;
            }else if($value->lnIso639_2  == $client_browser[0][0]){
                $browser_language_code=$value->languageNo;
            }else if($value->lnIso639_1  == $client_browser[0][0]){
                $browser_language_code=$value->languageNo;
            }else if($value->lnIso639_3  == $client_browser[0][0]){
                $browser_language_code=$value->languageNo;
            }
            if($browser_language_code != 100){
                exit;
            }
        }
        $_SESSION["browserLanguageCd"] = $browser_language_code;
    }else{
        $message=$result["data"]->errorMessage;
        echo json_encode(array("status"=>$data["status"],"message"=>$message,"alert"=>true));
    }
}




