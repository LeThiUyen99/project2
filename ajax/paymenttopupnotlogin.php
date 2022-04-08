<?php

/**
 * @author GallerySoft.info
 * @copyright 2018
 */

include("config.php");
//header("Content-Type: application/text; charset=utf-8");
require_once '../functions/FunctionTopup.php';
if(isset($_POST)){
$telcotype = getValue("telcotype","str","POST","");
$telcotype = trim(replaceMQ($telcotype));
$telcotype = removeHTML($telcotype);
$password=getValue("password","str","POST","");
$password = trim(replaceMQ($password));
$password = removeHTML($password);
$pass = md5($password);
$sodienthoai = getValue("sodienthoai","str","POST","");
$sodienthoai = trim(replaceMQ($sodienthoai));
$amount = getValue("amount","str","POST","");
$amount = replaceMQ($amount);
$amount = removeHTML($amount);
$UserName = getValue("UserName","str","POST","");
$UserName = replaceMQ($UserName);
$UserName = removeHTML($UserName);


	$result=array("Success"=>false,"msg"=>"lỗi giao dịch");

	$resulttopup=paymenttopupnotlogin($UserName, $password, $sodienthoai, $amount, $telcotype);
	if((int)$resulttopup['errorCode']==0){
	    $result=array("Success"=>true,"msg"=>"nap the thanh cong");
	}

    // $resulttopup=paymenttopupnotlogin($UserName, $password, $sodienthoai, $amount, $telcotype);
    header("Content-Type: application/json; charset=utf-8");
    echo json_encode($result);

}

?>