<?php

/**
 * @author lolkittens
 * @copyright 2018
 */

include("config.php");
require_once '../functions/247API.php';
if(isset($_POST)&& $_SERVER['REQUEST_METHOD'] =='POST'){    
    header("Access-Control-Allow-Origin: http://".$host);
    header("Access-Control-Allow-Methods: POST");
    header("Access-Control-Max-Age: 3600");
    header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With"); 
    
    //$userName = getValue("userName","str","GET","");
//    $userName = trim(replaceMQ($userName));
//    $userName = removeHTML($userName);
//    $password = getValue("password","str","GET","");
//    $password = trim(replaceMQ($password));
//    $password = removeHTML($password);
//    //var_dump($_GET);die();
//    $result=APILogin($userName,$password);
//    //$result=json_decode($result,true);
//    header("Content-Type:application/json;charset=utf-8");
//    if($result['data'] != ''){
//       echo json_encode($result['data']); 
//    }else{
//        echo json_encode($result);
//    }
 //
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
        $fName = getValue("fName","str","GET","");
        $fName = trim(replaceMQ($fName));
        $fName = mysql_real_escape_string(removeHTML($fName));
        $phone = getValue("phone","str","GET","");
        $phone = trim(replaceMQ($phone));
        $phone = removeHTML($phone);        
        $bankNumber = getValue("bankNumber","str","GET","");
        $bankNumber = trim(replaceMQ($bankNumber));
        $bankNumber = removeHTML($bankNumber);
        $bankAccount = getValue("bankAccount","str","GET","");
        $bankAccount = trim(replaceMQ($bankAccount));
        $bankAccount = removeHTML($bankAccount);
        $bankCode = getValue("bankCode","str","GET","");
        $bankCode = trim(replaceMQ($bankCode));
        $bankCode = removeHTML($bankCode);
        $bankBranch = getValue("bankBranch","str","GET","");
        $bankBranch = trim(replaceMQ($bankBranch));
        $bankBranch = removeHTML($bankBranch);
        $token=$headers['Token'];
        //var_dump($token,$fName,$phone,$bankNumber,$bankAccount,$bankCode,$bankBranch);die();
        $result=APIUserUpdateInfo($token,$fName,$phone,$bankNumber,$bankAccount,$bankCode,$bankBranch);
        
        header("Content-Type:application/json;charset=utf-8");
        
           echo json_encode($result); 
       }
       else{
        echo json_encode(null);
       }
    
 }
} else{
     $kq=array("RepCode"=>99,"Message"=>"","data"=>"");
 echo json_encode($kq);
}

?>