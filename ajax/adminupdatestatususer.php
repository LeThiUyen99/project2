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
        //var_dump($_GET);die();
        //var_dump($headers);die();          
        $id = getValue("id","str","GET","");
        $id = trim(replaceMQ($id));
        $trangThai = getValue("trangThai","str","GET","");
        $trangThai = trim(replaceMQ($trangThai));
        $trangThai = removeHTML($trangThai);   
        
       
        //var_dump($fromDate,$toDate,$taiKhoan,$nhom);die();
        $kq = AdminUserManagerUpdateStatus($id,$trangThai);
        //$total=GetTotalAdminTransaction($fromDate ,$toDate,$nhom);array("tongtien"=>100,"sumprice"=>100,"total"=>100);// GetTotalAdminP300($nhom,$toDate);
        header("content-type:application/json;charset=utf-8");
        
        echo json_encode($kq,JSON_UNESCAPED_UNICODE);
    }   
    
}
?>