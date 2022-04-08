<?php

/**
 * @author lolkittens
 * @copyright 2018
 */

include("config.php");
 require_once '../functions/FunctionAdmin.php';
 
if(isset($_POST) && $_SERVER['REQUEST_METHOD'] =='POST')
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
        //var_dump($headers);die();          
        
        
        $userId = getValue("userId","str","POST","");
        $userId = replaceMQ($userId);
        $userId = removeHTML($userId);
        //$start = getValue("start","int","POST",0);
//        $start = replaceMQ($start);
//        $start = removeHTML($start);
//        $length = getValue("length","int","POST",0);
//        $length = replaceMQ($length);
//        $length = removeHTML($length);
//        $iDisplayStart=$start;//(int)$_GET['start'];
//		$iDisplayLength=$length;//(int)$_GET['length'];
        
        
        $total=0;
        //var_dump($fromDate,$toDate,$taiKhoan,$nhom);die();
        $kq = AdminGetDetailCustommer($userId);
        //$total=GetTotalAdminTransaction($fromDate ,$toDate,$nhom);array("tongtien"=>100,"sumprice"=>100,"total"=>100);// GetTotalAdminP300($nhom,$toDate);
        header("content-type:application/json;charset=utf-8");
        
        echo json_encode($kq['kq'],JSON_UNESCAPED_UNICODE);
    }   
    
}

?>