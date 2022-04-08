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
        $Status = getValue("Status","str","GET","");
        $Status = trim(replaceMQ($Status));
        $Status = removeHTML($Status);
        $FromDate = getValue("FromDate","str","GET","");
        $FromDate = trim(replaceMQ($FromDate));
        $FromDate = removeHTML($FromDate);  
        $ToDate = getValue("ToDate","str","GET","");
        $ToDate = trim(replaceMQ($ToDate));
        $ToDate = removeHTML($ToDate);   
        $Description = getValue("Description","str","GET","");
        $Description = replaceMQ($Description);
        $Description = removeHTML($Description);
        $Id = getValue("Id","int","GET",0);
        $Id = replaceMQ($Id);
        $Id = removeHTML($Id);
        $Type = getValue("Type","int","GET",0);
        $Type = replaceMQ($Type);
        $Type = removeHTML($Type);
        $Price = getValue("Price","str","GET","");
        $Price = replaceMQ($Price);
        $Price = removeHTML($Price);
        $GroupId = getValue("GroupId","int","GET",0);
        $GroupId = replaceMQ($GroupId);
        $GroupId = removeHTML($GroupId);
        $ProviderId = getValue("ProviderId","int","GET",0);
        $ProviderId = replaceMQ($ProviderId);
        $ProviderId = removeHTML($ProviderId);
        if($FromDate==""){
            $date=date("Y-m-d",time());            
            $FromDate=date("Y-m-d H:i:s",strtotime($date.' 00:00:00'));
            
        }else{
            //$date=explode("/",$fromDate);
            
            $FromDate=date("Y-m-d H:i:s",strtotime($FromDate));
        }
        if($ToDate==""){
            $date=date("Y-m-d",time());
            $ToDate=date("Y-m-d H:i:s",strtotime($date.' 23:59:59'));
            
        }else{
            //$date=date("Y-m-d",strtotime($toDate));
            //$date1=explode("/",$toDate);
            $ToDate=date("Y-m-d H:i:s",strtotime($ToDate));
        }
        $Status=(bool)$Status; 
        //var_dump($fromDate,$toDate,$taiKhoan,$nhom);die();
        $kq = AdminSaveGroupProvider($Id,$Type,$Price,$GroupId,$ProviderId,$Description,$FromDate,$ToDate,$Status);
        //$total=GetTotalAdminTransaction($fromDate ,$toDate,$nhom);array("tongtien"=>100,"sumprice"=>100,"total"=>100);// GetTotalAdminP300($nhom,$toDate);
        header("content-type:application/json;charset=utf-8");
        
        echo json_encode($kq,JSON_UNESCAPED_UNICODE);
    }   
    
}
?>