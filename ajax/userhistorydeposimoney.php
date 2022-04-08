<?php

/**
 * @author lolkittens
 * @copyright 2018
 */

include("config.php");

require_once '../functions/FunctionHistory.php';
if(isset($_GET)){
    //HistoryBuyCards($userId,$searchString,$telcoCode,$fromDate,$toDate)
    if(isset($_SESSION['UserInfo']))
    {
        
        $udata = $_SESSION['UserInfo'];
        $userid=$udata['UserId'];
        //$searchString = getValue("searchString","str","GET","");
        //$searchString = trim(replaceMQ($searchString));
        //$searchString = removeHTML($searchString);    
          
        //$statusString = getValue("statusString","str","GET","");
        //$statusString = trim(replaceMQ($statusString));
        $fromDate = getValue("fromDate","str","GET","");
        $fromDate = replaceMQ($fromDate);
        $fromDate = removeHTML($fromDate);
        $iDisplayStart = getValue("start","int","GET",0);
        $iDisplayStart =(int)$iDisplayStart;
        $iDisplayLength = getValue("length","int","GET",0);
		$iDisplayLength=(int)$iDisplayLength;
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
        
        //var_dump($_GET);die();
        //echo $userid,$searchString,$telcoCode,$fromDate,$toDate;
        
        
        $data=HistoryDeposiMoney($userid,"",$fromDate,$toDate,0,$iDisplayStart,$iDisplayLength);
        if($data==null){
            $data=array("TenNganHang"=>"","StrAmount"=>"","CreateDate"=>"");
        }
        //var_dump($data);die();
        //$results = ["sEcho" => 1,
//        	"iTotalRecords" => count($data),
//        	"iTotalDisplayRecords" => count($data),
//        	"data" => $data ];
            $total=GetTotalHistoryDeposiMoney($userid,"",$fromDate,$toDate,0);
            $results = ["recordsTotal" => $total['total'],
        	"recordsFiltered" => $total['total'],
        	"data" => $data,
            "tongtien"=>number_format($total['tongtien']) ];
            echo json_encode($results);
    }
        
}

?>