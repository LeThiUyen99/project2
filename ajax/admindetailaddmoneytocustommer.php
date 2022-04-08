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
        
        
        
        $idCongTien = getValue("idCongTien","int","POST",0);
        $idCongTien = replaceMQ($idCongTien);
        $idCongTien = removeHTML($idCongTien);
        
        
        
        $total=0;
        //var_dump($fromDate,$toDate,$taiKhoan,$nhom);die();
        //var_dump($idKhachHang,$tenKhachHang,$email,$soDienThoai,$nganHang,$soTien,$noiDung);die();
        $kq =  AdminGetDetailAddMoney($idCongTien);
        //var_dump($kq);die(); 
        //$total=GetTotalAdminTransaction($fromDate ,$toDate,$nhom);array("tongtien"=>100,"sumprice"=>100,"total"=>100);// GetTotalAdminP300($nhom,$toDate);
        header("content-type:application/json;charset=utf-8");
       
        echo json_encode($kq,JSON_UNESCAPED_UNICODE);
    }   
    
}


?>