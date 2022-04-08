<?php

/**
 * @author lolkittens
 * @copyright 2018
 */

include("config.php");
 require_once '../functions/247Admin.php';
 
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
        
        
        $findKey = getValue("findKey","str","POST","");
        $findKey = replaceMQ($findKey);
        $findKey = removeHTML($findKey);
        $start = getValue("start","int","POST",0);
        $start = replaceMQ($start);
        $start = removeHTML($start);
        $length = getValue("length","int","POST",0);
        $length = replaceMQ($length);
        $length = removeHTML($length);
        $iDisplayStart=$start;//(int)$_GET['start'];
		$iDisplayLength=$length;//(int)$_GET['length'];
        $denNgay = getValue("denNgay","str","POST","");
        $denNgay = replaceMQ($denNgay);
        $denNgay = removeHTML($denNgay);
        $tuNgay = getValue("tuNgay","str","POST","");
        $tuNgay = replaceMQ($tuNgay);
        $tuNgay = removeHTML($tuNgay);
        if($tuNgay==""){
            $date=date("Y-m-d",time());            
            $tuNgay=date("Y-m-d H:i:s",strtotime($date.' 00:00:00'));
            
        }else{
            
            
            $tuNgay=date("Y-m-d H:i:s",strtotime($tuNgay.' 00:00:00'));
        }
        if($denNgay==""){
            $date=date("Y-m-d",time());
            $denNgay=date("Y-m-d H:i:s",strtotime($date.' 23:59:59'));
            
        }else{
            //$date=date("Y-m-d",strtotime($toDate));            
            $denNgay=date("Y-m-d H:i:s",strtotime($denNgay.' 23:59:59'));
        }
        
        $total=0;
        //var_dump($fromDate,$toDate,$taiKhoan,$nhom);die();
        $kq = AdminVnpayCardresponseDecrypt($tuNgay ,$denNgay,$findKey,$iDisplayStart,$iDisplayLength);
        //var_dump($findkey,$start,$length,$denNgay,$tuNgay,$kq);die();
        //$total=GetTotalAdminTransaction($fromDate ,$toDate,$nhom);array("tongtien"=>100,"sumprice"=>100,"total"=>100);// GetTotalAdminP300($nhom,$toDate);
        header("content-type:application/json;charset=utf-8");
        $results = ["recordsTotal" => $kq['total'] ,
        "recordsFiltered" => $kq['total'],
        "data" => $kq['kq'] ];
        echo json_encode($results,JSON_UNESCAPED_UNICODE);
    }   
    
}

?>