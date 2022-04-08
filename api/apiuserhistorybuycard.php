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
    
        $findkey = getValue("findkey","str","GET","");
        $findkey = trim(replaceMQ($findkey));
        $findkey = removeHTML($findkey);    
          
        $telcoCode = getValue("telcoCode","str","GET","");
        $telcoCode = trim(replaceMQ($telcoCode));
        $telcoCode = removeHTML($telcoCode);
        $fromDate = getValue("fromDate","str","GET","");
        $fromDate = replaceMQ($fromDate);
        $fromDate = removeHTML($fromDate);
        $page = getValue("page","str","GET","");
        $page = replaceMQ($page);
        $page = removeHTML($page);
        if(isset($page) && $page ==""){
            $trang=1;
        }else{
            $trang=(int)$page;
        }
        if($fromDate==""){
            $date=date("Y-m-d",time());            
            $fromDate=date("Y-m-d H:i:s",strtotime($date.' 00:00:00'));
            
        }else{
            $date=explode("/",$fromDate);
            
            $fromDate=date("Y-m-d H:i:s",strtotime($date[2]."-".$date[1]."-".$date[0].' 00:00:00'));
        }
        
        $toDate = getValue("toDate","str","GET","");
        $toDate = replaceMQ($toDate);
        $toDate = removeHTML($toDate);
        if($toDate==""){
            $date=date("Y-m-d",time());
            $toDate=date("Y-m-d H:i:s",strtotime($date.' 23:59:59'));
            
        }else{
            //$date=date("Y-m-d",strtotime($toDate));
            $date1=explode("/",$toDate);
            $toDate=date("Y-m-d H:i:s",strtotime($date1[2]."-".$date1[1]."-".$date1[0].' 00:00:00'));
        }
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
    
        $response=APIUserHistoryBuyCard($token,$trang,$findkey,$telcoCode,$fromDate,$toDate);
        header("content-type:application/json;charset=utf-8");
        echo json_encode($response,JSON_UNESCAPED_UNICODE );
    
        
 }
} else{
     $kq=array("RepCode"=>999,"Message"=>"","data"=>"");
 echo json_encode($response);
}

?>