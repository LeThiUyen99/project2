<?php

/**
 * @author lolkittens
 * @copyright 2018
 */

include("config.php");
require_once '../functions/247API.php';
//header("Content-Type: application/text; charset=utf-8");&& $_SERVER['REQUEST_METHOD'] =='POST'


if(isset($_POST)&& $_SERVER['REQUEST_METHOD'] =='POST'){    
    header("Access-Control-Allow-Origin: http://".$host);
    header("Access-Control-Allow-Methods: POST");
    header("Access-Control-Max-Age: 3600");
    header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With"); 
    
    $bankCode = getValue("bankCode","str","GET","");
    $bankCode = trim(replaceMQ($bankCode));
    $bankCode = removeHTML($bankCode);
    $emailnhan = getValue("emailnhan","str","GET","");
    $emailnhan = trim(replaceMQ($emailnhan));
    $emailnhan = removeHTML($emailnhan);
    $providerId = getValue("providerId","int","GET",0);
    $providerId = trim(replaceMQ($providerId));
    $providerId = removeHTML($providerId);
    $amount = getValue("amount","int","GET",0);
    $amount = trim(replaceMQ($amount));
    $amount = removeHTML($amount);
    $quantity = getValue("quantity","int","GET",0);
    $quantity = trim(replaceMQ($quantity));
    $quantity = removeHTML($quantity);
    header("Content-Type: multipart/form-data;charset=utf-8");
    $headers = []; 
       foreach ($_SERVER as $name => $value) 
       { 
           if (substr($name, 0, 5) == 'HTTP_') 
           { 
               $headers[str_replace(' ', '-', ucwords(strtolower(str_replace('_', ' ', substr($name, 5)))))] = $value; 
           } 
       } 
//$value =getallheaders();
//var_dump($headers);die();
 if($headers['Host']==$host)
 {
    if(isset($headers['Token'])){
        
        $token=$headers['Token'];
        //var_dump($token);die();
        
    }else{
        //$response=array("Success"=>false,"status"=>0,"data"=>"");
        $token='';
    }
    
    if($amount > 0 && $quantity > 0 && $providerId > 0){
        $result=APIBuyCardaddvnpayment($token,$bankCode,$providerId,$emailnhan,$amount,$quantity,$vnp_TmnCode,$vnp_Url,$vnp_HashSecret,$vnp_Returnurl);
        header("Content-Type:application/json;charset=utf-8");
        echo json_encode($response,JSON_UNESCAPED_UNICODE);
    }else{
        $kq=array("RepCode" => -2, "Message"=> "lỗi giaodichj", "Link" => "");;
        echo json_encode($kq,JSON_UNESCAPED_UNICODE);
    }
    
 }
} else{
     $kq=array("RepCode" => 99, "Message"=> "lỗi giaodichj", "Link" => "");;
 echo json_encode($response);
}

?>