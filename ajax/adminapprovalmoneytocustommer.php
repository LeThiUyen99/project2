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
        
        
        $findKey = getValue("findKey","str","POST","");
        $findKey = replaceMQ($findKey);
        $findKey = removeHTML($findKey);
        $tuNgay = getValue("tuNgay","str","POST","");
        $tuNgay = replaceMQ($tuNgay);
        $tuNgay = removeHTML($tuNgay);
        $denNgay = getValue("denNgay","str","POST","");
        $denNgay = replaceMQ($denNgay);
        $denNgay = removeHTML($denNgay);
        $trangThai = getValue("trangThai","int","POST",0);
        $trangThai = replaceMQ($trangThai);
        $trangThai = removeHTML($trangThai);
        $nganHang = getValue("nganHang","int","POST",0);
        $nganHang = replaceMQ($nganHang);
        $nganHang = removeHTML($nganHang);
        $start = getValue("start","int","POST",0);
        $start = replaceMQ($start);
        $start = removeHTML($start);
        $length = getValue("length","int","POST",0);
        $length = replaceMQ($length);
        $length = removeHTML($length);
        $iDisplayStart=$start;//(int)$_GET['start'];
		$iDisplayLength=$length;//(int)$_GET['length'];
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
        //var_dump($idKhachHang,$tenKhachHang,$email,$soDienThoai,$nganHang,$soTien,$noiDung);die();
        $kq = AdminApprovalMoneyToCustommer($findKey,$tuNgay,$denNgay,$trangThai,$nganHang,$iDisplayStart,$iDisplayLength);
        //var_dump($kq);die(); 
        //$total=GetTotalAdminTransaction($fromDate ,$toDate,$nhom);array("tongtien"=>100,"sumprice"=>100,"total"=>100);// GetTotalAdminP300($nhom,$toDate);
        header("content-type:application/json;charset=utf-8");
        $results = ["recordsTotal" => $kq['total'] ,
        "recordsFiltered" => $kq['total'],
        "data" => $kq['kq'] ];
        echo json_encode($results,JSON_UNESCAPED_UNICODE);
    }   
    
}


?>