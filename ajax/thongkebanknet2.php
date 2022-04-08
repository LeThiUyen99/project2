<?
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
        
        $status = getValue("status","int","POST",0);
        $status = replaceMQ($status);
        $status = removeHTML($status);
        
        $tuNgay = getValue("fromDate","str","POST","");
        $tuNgay = replaceMQ($tuNgay);
        $tuNgay = removeHTML($tuNgay);
        $denNgay = getValue("toDate","str","POST","");
        $denNgay = replaceMQ($denNgay);
        $denNgay = removeHTML($denNgay);
        $type = getValue("type","int","POST",0);
        $type = replaceMQ($type);
        $type = removeHTML($type);
        
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
        //var_dump($findKey,$tuNgay,$denNgay,$giaoDich,$iDisplayStart,$iDisplayLength);die();
        $kq = AdminGetAllBankNet($findKey,$tuNgay,$denNgay,$giaoDich,$iDisplayStart,$iDisplayLength);
        //$total=GetTotalAdminTransaction($fromDate ,$toDate,$nhom);array("tongtien"=>100,"sumprice"=>100,"total"=>100);// GetTotalAdminP300($nhom,$toDate);
        header("content-type:application/json;charset=utf-8");
        $results = ["recordsTotal" => $kq['total'] ,
        "recordsFiltered" => $kq['total'],
        "data" => $kq['kq'] ];
        echo json_encode($results,JSON_UNESCAPED_UNICODE);
        
    }   
    
}
?>