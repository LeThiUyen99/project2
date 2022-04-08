<?
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
        $giaoDich = getValue("giaoDich","int","POST",0);
        $giaoDich = replaceMQ($giaoDich);
        $giaoDich = removeHTML($giaoDich);
        $trangthai = getValue("trangthai","int","POST",0);
        $trangthai = replaceMQ($trangthai);
        $trangthai = removeHTML($trangthai);
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
            $tg=explode('/',$tuNgay);
            
            $tuNgay=date("Y-m-d H:i:s",strtotime($tg[2].'-'.$tg[1].'-'.$tg[0].' 00:00:00'));
        }
        if($denNgay==""){
            $date=date("Y-m-d",time());
            $denNgay=date("Y-m-d H:i:s",strtotime($date.' 23:59:59'));
            
        }else{
            //$date=date("Y-m-d",strtotime($denNgay));
            $tg=explode('/',$denNgay);
            
            $denNgay=date("Y-m-d H:i:s",strtotime($tg[2].'-'.$tg[1].'-'.$tg[0].' 23:59:59'));

        }  
        
        
        $total=0;
        //var_dump($denNgay);die();
        $kq = AdminGetAllBankNet($findKey,$tuNgay,$denNgay,$giaoDich,$trangthai,$iDisplayStart,$iDisplayLength);
        //$total=GetTotalAdminTransaction($fromDate ,$toDate,$nhom);array("tongtien"=>100,"sumprice"=>100,"total"=>100);// GetTotalAdminP300($nhom,$toDate);
        header("content-type:application/json;charset=utf-8");
        $results = ["recordsTotal" => $kq['total'] ,
        "recordsFiltered" => $kq['total'],
        "data" => $kq['kq'] ];
        echo json_encode($results,JSON_UNESCAPED_UNICODE);
        
    }   
    
}
?>