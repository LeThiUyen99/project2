<?php

/**
 * @author GallerySoft.info
 * @copyright 2018
 */

include("config.php");
//header("Content-Type: application/text; charset=utf-8");
require_once '../functions/FunctionTopup.php';
if(isset($_POST)){
    $bankCode = getValue("bankCode","str","POST","");
    $bankCode = trim(replaceMQ($bankCode));
    $bankCode =strtoupper(removeHTML($bankCode));
    
    $sodienthoai = getValue("sodienthoai","str","POST","");
    $sodienthoai = trim(replaceMQ($sodienthoai));
    $amount = getValue("amount","str","POST","");
    $amount = replaceMQ($amount);
    $amount = removeHTML($amount);
    $email = getValue("email","str","POST","");
    $email = replaceMQ($email);
    $email = removeHTML($email);
    $result=addvnpayment($bankCode,$sodienthoai,$amount,$email,$vnp_TmnCode,$vnp_Url,$vnp_HashSecret,$vnp_Returnurl);
    header("Content-Type: application/json; charset=utf-8");
    echo json_encode($result);
}

?>