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
        $type = getValue("type","int","GET",0);
        $type = trim(replaceMQ($type));
        
        $findkey = getValue("findkey","str","GET","");
        $findkey = replaceMQ($findkey);
        $findkey = removeHTML($findkey);
        $start = getValue("start","int","GET",0);
        $start = replaceMQ($start);
        $start = removeHTML($start);
        $length = getValue("length","int","GET",0);
        $length = replaceMQ($length);
        $length = removeHTML($length);
        $iDisplayStart=$start;//(int)$_GET['start'];
		$iDisplayLength=$length;//(int)$_GET['length'];
        
        
        $total=0;
        //var_dump($fromDate,$toDate,$taiKhoan,$nhom);die();
        $kq = AdminGetAllGroupProvider($findkey,$type,$iDisplayStart,$iDisplayLength);
        //$total=GetTotalAdminTransaction($fromDate ,$toDate,$nhom);array("tongtien"=>100,"sumprice"=>100,"total"=>100);// GetTotalAdminP300($nhom,$toDate);
        header("content-type:application/json;charset=utf-8");
        $results = ["recordsTotal" => $kq['total'] ,
        "recordsFiltered" => $kq['total'],
        "data" => $kq['kq'] ];
        echo json_encode($results,JSON_UNESCAPED_UNICODE);
    }   
    
}
?>