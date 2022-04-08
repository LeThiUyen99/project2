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
    
    $email = getValue("email","str","GET","");
    $email = trim(replaceMQ($email));
    $email = removeHTML($email);    
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
    if($email != ''){
        $response=APIUserGetForgotPasswordOne($token,$email);
        header("Content-Type:application/json;charset=utf-8");
        echo json_encode($response);
    }else{
        $kq=array("RepCode"=>999,"Message"=>"","data"=>"");
        echo json_encode($response);
    }
        
 }
} else{
     $kq=array("RepCode"=>999,"Message"=>"","data"=>"");
 echo json_encode($response);
}

?>