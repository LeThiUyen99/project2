<?php

/**
 * @author lolkittens
 * @copyright 2018
 */

include("config.php");
require_once '../functions/FunctionAPI.php';
//header("Content-Type: application/text; charset=utf-8");&& $_SERVER['REQUEST_METHOD'] =='POST'


if(isset($_POST)&& $_SERVER['REQUEST_METHOD'] =='POST'){    
    header("Access-Control-Allow-Origin: http://".$host);
    header("Access-Control-Allow-Methods: POST");
    header("Access-Control-Max-Age: 3600");
    header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With"); 
    
    $matKhauCap1 = getValue("matKhauCap1","str","GET","");
    $matKhauCap1 = trim(replaceMQ($matKhauCap1));
    $matKhauCap1 = removeHTML($matKhauCap1);
    $matkhauCap2 = getValue("matkhauCap2","str","GET","");
    $matkhauCap2 = trim(replaceMQ($matkhauCap2));
    $matkhauCap2 = removeHTML($matkhauCap2);
    $matKhauMoiCap2 = getValue("matKhauMoiCap2","str","GET","");
    $matKhauMoiCap2 = trim(replaceMQ($matKhauMoiCap2));
    $matKhauMoiCap2 = removeHTML($matKhauMoiCap2);
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
    $response=APIGetListProvider($token);
        header("Content-Type:application/json;charset=utf-8");
        echo json_encode($response['data']);
 }
} else{
     $kq=array("RepCode"=>999,"Message"=>"","data"=>"");
 echo json_encode($response);
}

?>