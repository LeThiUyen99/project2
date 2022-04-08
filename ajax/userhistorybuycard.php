<?php

/**
 * @author lolkittens
 * @copyright 2018
 */


include("config.php");

require_once '../functions/247History.php';
if(isset($_GET)){
    //HistoryBuyCards($userId,$searchString,$telcoCode,$fromDate,$toDate)
    if(isset($_SESSION['UserInfo']))
    {
        
        $udata = $_SESSION['UserInfo'];
        $userid=$udata['UserId'];
        $searchString = getValue("searchString","str","GET","");
        $searchString = trim(replaceMQ($searchString));
        $searchString = removeHTML($searchString);    
          
        $telcoCode = getValue("telcoCode","str","GET","");
        $telcoCode = trim(replaceMQ($telcoCode));
        $fromDate = getValue("fromDate","str","GET","");
        $fromDate = replaceMQ($fromDate);
        $fromDate = removeHTML($fromDate);
          $iDisplayStart=(int)$_GET['start'];
			$iDisplayLength=(int)$_GET['length'];
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
        
        
        $data=HistoryBuyCards($userid,$searchString,$telcoCode,$fromDate,$toDate,$iDisplayStart,$iDisplayLength);
        if($data==null){
            $data=array("Serial"=>"","StrAmount"=>"","TelcoCode"=>"","CreateDate"=>"");
        }
        //var_dump($data);die();
        //$results = ["sEcho" => 1,
//        	"iTotalRecords" => count($data),
//        	"iTotalDisplayRecords" => count($data),
//        	"data" => $data ];
            $total=GetTotalHistoryBuyCards($userid,$searchString,$telcoCode,$fromDate,$toDate);
            $results = ["recordsTotal" => $total,
        	"recordsFiltered" => $total,
        	"data" => $data];
            echo json_encode($results);
    }
        
}

?>