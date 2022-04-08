<?php

/**
 * @author lolkittens
 * @copyright 2018
 */

include("config.php");
//header("Content-Type: application/text; charset=utf-8");
header("Content-Type:application/json;charset=utf-8");

if(isset($_POST) && $_SERVER['REQUEST_METHOD'] =='POST'){
    
header("Access-Control-Allow-Origin: http://localhost:8999");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With"); 
    
    $response=array(
 'status' => 1,
 'status_message' =>'Employee Deleted Successfully.'
 );
 echo json_encode($response);
} else{
     $response=array(
 'status' => 0,
 'status_message' =>'Employee Deleted Successfully.'
 );
 echo json_encode($response);
}   
?>