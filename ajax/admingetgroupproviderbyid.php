<?php

/**
 * @author lolkittens
 * @copyright 2018
 */
 include("config.php");
 require_once '../functions/FunctionAdmin.php';
 
if(isset($_GET) && $_SERVER['REQUEST_METHOD'] =='GET')
{
    //var_dump($_GET);die();
    
    $headers = []; 
       foreach ($_SERVER as $name => $value) 
       { 
           if (substr($name, 0, 5) == 'HTTP_') 
           { 
               $headers[str_replace(' ', '-', ucwords(strtolower(str_replace('_', ' ', substr($name, 5)))))] = $value; 
           } 
       } 
       
    if(strpos($headers['Referer'],'/admin/modules'))
    {
        //var_dump($headers,$_GET);die(); 
        //["Id"]=>
//  string(1) "0"
//  ["Type"]=>
//  string(1) "3"
//  ["Price"]=>
//  string(3) "100"
//  ["Description"]=>
//  string(1) "a"
//  ["Status"]=>
//  string(5) "false"
//  ["GroupId"]=>
//  string(1) "5"
//  ["ProviderId"]=>
//  string(2) "15"
//  ["FromDate"]=>
//  string(10) "2018-06-29"
//  ["ToDate"]=>
//  string(10) "2018-06-29"         
        
        $Id = getValue("Id","int","GET",0);
        $Id = replaceMQ($Id);
        $Id = removeHTML($Id);
        
        //var_dump($fromDate,$toDate,$taiKhoan,$nhom);die();
        $kq = AdminGetGroupProviderByID($Id);
        //$total=GetTotalAdminTransaction($fromDate ,$toDate,$nhom);array("tongtien"=>100,"sumprice"=>100,"total"=>100);// GetTotalAdminP300($nhom,$toDate);
        header("content-type:application/json;charset=utf-8");
        
        echo json_encode($kq,JSON_UNESCAPED_UNICODE);
    }   
    
}
?>