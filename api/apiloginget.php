<?php

/**
 * @author lolkittens
 * @copyright 2018
 */

include("config.php");
require_once '../functions/247API.php';
//header("Content-Type: application/text; charset=utf-8");&& $_SERVER['REQUEST_METHOD'] =='POST'
//var_dump($_GET);die();

if(isset($_GET)&& $_SERVER['REQUEST_METHOD'] =='GET'){    
    header("Access-Control-Allow-Origin: https://banthe24h.vn");
    header("Access-Control-Allow-Methods: GET");
    header("Access-Control-Max-Age: 3600");
    header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With"); 
    $userName = getValue("userName","str","GET","");
    $userName = trim(replaceMQ($userName));
    $userName = removeHTML($userName);
    $password = getValue("password","str","GET","");
    $password = trim(replaceMQ($password));
    $password = removeHTML($password);
    //var_dump($_GET);die();
    $result=APILogin($userName,$password);
    //$result=json_decode($result,true);
    header("Content-Type:application/json;charset=utf-8");
    if($result['data'] != ''){
        $response=array("Success"=>true,"data"=>$result['data']);
       echo json_encode($response); 
    }else{
        echo json_encode($result);
    }
 
} else{
     $response=array("Success"=>false,"status"=>0,"data"=>"");
 echo json_encode($response);
}
?>