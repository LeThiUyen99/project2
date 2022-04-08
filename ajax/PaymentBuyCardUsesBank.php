<?php

/**
 * @author lolkittens
 * @copyright 2018
 */
header("Content-Type: application/text; charset=utf-8");
include("config.php");
require_once '../functions/FunctionTopup.php';
if(isset($_POST)){
    $bankCode = getValue("bankCode","str","POST","");
    $bankCode = trim(replaceMQ($bankCode));
    $bankCode =strtoupper(removeHTML($bankCode));
    
    $providerId = getValue("providerId","str","POST","");
    $providerId = trim(replaceMQ($providerId));
    $amount = getValue("amount","str","POST","");
    $amount = replaceMQ($amount);
    $amount = removeHTML($amount);
    $email = getValue("email","str","POST","");
    $email = replaceMQ($email);
    $email = removeHTML($email);
    $quantity = getValue("quantity","str","POST","");
    $quantity = replaceMQ($quantity);
    $quantity = removeHTML($quantity);
    $result=BuyCardaddvnpayment($bankCode,$providerId,$email,$amount,$quantity,$vnp_TmnCode,$vnp_Url,$vnp_HashSecret,$vnp_Returnurl);
    echo json_encode($result);
}
?>