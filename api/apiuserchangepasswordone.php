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
    
    $matKhauCu = getValue("matKhauCu","str","GET","");
    $matKhauCu = trim(replaceMQ($matKhauCu));
    $matKhauCu = removeHTML($matKhauCu);
    $matKhauMoi = getValue("matKhauMoi","str","GET","");
    $matKhauMoi = trim(replaceMQ($matKhauMoi));
    $matKhauMoi = removeHTML($matKhauMoi);

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
        if($matKhauCu != '' && $matKhauMoi != '')
        {
           $response=APIUserChangePasswordOne($token,$matKhauCu,$matKhauMoi);
            header("Content-Type:application/json;charset=utf-8");
            echo json_encode($response); 
        }else{
            echo json_encode(null);
        }
        
    }else{
        //$response=array("Success"=>false,"status"=>0,"data"=>"");
        echo json_encode(null);
    }
 }
} else{
     $kq=array("RepCode"=>999,"Message"=>"","data"=>"");
 echo json_encode($response);
}

?>