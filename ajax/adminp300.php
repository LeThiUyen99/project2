<?php

/**
 * @author lolkittens
 * @copyright 2018
 */
 include("config.php");
 require_once '../functions/247Admin.php';
 
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
        //var_dump($headers);die();          
        $toDate = getValue("toDate","str","GET","");
        $toDate = trim(replaceMQ($toDate));
        
        $nhom = getValue("nhom","str","GET","");
        $nhom = replaceMQ($nhom);
        $nhom = removeHTML($nhom);
        $start = getValue("start","int","GET",0);
        $start = replaceMQ($start);
        $start = removeHTML($start);
        $length = getValue("length","int","GET",0);
        $length = replaceMQ($length);
        $length = removeHTML($length);
        $iDisplayStart=$start;//(int)$_GET['start'];
		$iDisplayLength=$length;//(int)$_GET['length'];
        
        if($toDate==""){
            $date=date("Y-m-d",time());
            $toDate=date("Y-m-d H:i:s",strtotime($date.' 23:59:59'));
            
        }else{
            //$date=date("Y-m-d",strtotime($toDate));
            //$date1=explode("/",$toDate);
            $toDate=date("Y-m-d H:i:s",strtotime($toDate.':59'));
        }
        //var_dump($fromDate,$toDate,$taiKhoan,$nhom);die();
        $kq = AdminP300($nhom,$toDate,$iDisplayStart,$iDisplayLength);
        $total= GetTotalAdminP300($nhom,$toDate);
        header("content-type:application/json;charset=utf-8");
        $results = ["recordsTotal" => $total['total'] ,
        "recordsFiltered" => $total['total'],
        "data" => $kq,
        "tongtien"=>number_format($total['tongtien']) ,
        "sumprice"=>number_format($total['sumprice']) ];
        echo json_encode($results,JSON_UNESCAPED_UNICODE);
    }   
    
}
?>