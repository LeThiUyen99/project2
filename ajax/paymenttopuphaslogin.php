<?php

/**
 * @author GallerySoft.info
 * @copyright 2018
 */

include("config.php");
//header("Content-Type: application/text; charset=utf-8");
require_once '../functions/247Topup.php';
if(isset($_POST)){
$telcotype = getValue("telcotype","str","POST","");
$telcotype = trim(replaceMQ($telcotype));
$telcotype = removeHTML($telcotype);
$sodienthoai = getValue("sodienthoai","str","POST","");
$sodienthoai = trim(replaceMQ($sodienthoai));
$amount = getValue("amount","str","POST","");
$amount = replaceMQ($amount);
$amount = removeHTML($amount);
$email = getValue("email","str","POST","");
$email = replaceMQ($email);
$email = removeHTML($email);
if(isset($_SESSION['UserInfo']))
{
    $udata = $_SESSION['UserInfo'];
    $email=$udata['UserName'];
    $result=array("Success"=>false,"msg"=>"l?i giao d?ch");
    
    $resulttopup=paymenttopuphaslogin($sodienthoai,$amount,$email,$telcotype);
    
    if((int)$resulttopup['errorCode']==0){
        $result=array("Success"=>true,"msg"=>"nap the thanh cong");
    }
   // header("Content-Type: application/json; charset=utf-8");
    //echo $resulttopup;
    //if(!empty($resulttopup)){
        //array('errorCode'=>278,'listCards'=>'','message'=>'không t?n t?i ngu?i dùng','transaction'=>$transaction);
        header("Content-Type:application/json;charset=utf-8");
    echo json_encode($result,JSON_UNESCAPED_UNICODE);
    
}
}

?>