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
    
    $nhaCungCap = getValue("nhaCungCap","str","GET","");
    $nhaCungCap = trim(replaceMQ($nhaCungCap));
    $nhaCungCap = removeHTML($nhaCungCap);
    $menhGia = getValue("menhGia","str","GET","");
    $menhGia = trim(replaceMQ($menhGia));
    $menhGia = removeHTML($menhGia);
    $soLuong = getValue("soLuong","str","GET","");
    $soLuong = trim(replaceMQ($soLuong));
    $soLuong = removeHTML($soLuong);
    $matKhauCap2 = getValue("matKhauCap2","str","GET","");
    $matKhauCap2 = trim(replaceMQ($matKhauCap2));
    $matKhauCap2 = removeHTML($matKhauCap2);
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
    
    if($nhaCungCap != '' && $menhGia != '' && $soLuong !='' && $matKhauCap2 != ''){
        $response=APIUserBuyCardusePassTwo($token,$nhaCungCap,$menhGia,$soLuong,$matKhauCap2);
        header("Content-Type:application/json;charset=utf-8");
        echo json_encode($response,JSON_UNESCAPED_UNICODE);
    }else{
        $kq=array("RepCode"=>99,"Message"=>"không được để trống","data"=>"");
        echo json_encode($kq,JSON_UNESCAPED_UNICODE);
    }
    
 }
} else{
     $kq=array("RepCode"=>999,"Message"=>"","data"=>"");
 echo json_encode($response);
}

?>