<?
//header('Content-Type: text/html; charset=utf-8');
include("config.php");
//require_once '../functions/FunctionTopup.php';
//echo json_encode(addvnpayment("NCB","0913081236",10000,"trantronglong87@gmail.com",$vnp_TmnCode,$vnp_Url,$vnp_HashSecret,$vnp_Returnurl));
$mang1=[[1,2,3],[1,2,3]];
$mang2=[[1,2,3],[1,2,3]];
$mang3=[[1,2,3],[1,2,3]];
$mang1=array('reviewluong'=>$mang1);
$mang2=array('reviewkinhnghiem'=>$mang2);
$mang3=array('reviewbangcap'=>$mang3);
$a1=array_merge($mang1,$mang2,$mang3);
echo json_encode($a1);
//require_once '../functions/FunctionTopup.php';
//$data=updateuserinfo("U4926513","trantronglong87@gmail.com");//updateuserinfoNotConfirm(5506,"711a017894951213","TRAN TRONG LONG","Agribank","HOAN KIEM","TRAN TRONG LONG","Ha noi","09130812361");
//echo json_encode($data)
//TransferType: 1
//TransferBank: Vietcombank
//CustomerName: tran trong long
//CustomerBN: 123123123
//ReceiveBank: 1
//TransferDateStr: 15.06.2018
//Amount: 1
//ToBankCode: 1
//ToBankNumber: 4
//$data=BuyCardaddvnpayment("NCB",1,'trantronglong87@gmail.com',10000,1,"HUNGHA01","http://sandbox.vnpayment.vn/paymentv2/vpcpay.html","KEWSNQRGEZCBXMDDTQLLBXMKGVYUMVOM","http://localhost:8999/thong-bao");//UserCreateCashOut(5506,"longtt123",50000,"longtt");//AddCashOutLogToServerNusoap(50000,156770,"TRAN TRONG LONG1","HOAN KIEN","0913081236","711a017894951213","Agribank","Agribank","2018-06-15 21:42:58",5506,0,1,62000,1,"620180615214258964","trantronglong87@gmail.com");//UserCreateCashOut(5506,"longtt123",50000,"longtt");//UserPayMentUnCode(5506,4,'50000',"trantronglong87@gmail.com","tran trong long");
//echo json_encode($data);
//$data=str_replace('xmlns="url"','',$data);
//$simple_result=simplexml_load_string($data);
//$json_result=json_encode($simple_result);
//$json_result=json_decode($json_result,true);
//echo $json_result;

    
//require_once '../functions/FunctionTopup.php';
//if(isset($_SESSION['UserInfo']))
//{
//    $result=array("Success"=>false,"message"=>"l?i giao d?ch");
//    
//    $resulttopup=paymenttopuphaslogin("0913081236","10000","a@gmail.com","longtt123");
//    
//    if(isset($resulttopup)){
//        //array('errorCode'=>278,'listCards'=>'','message'=>'không t?n t?i ngu?i dùng','transaction'=>$transaction);
//         if($resulttopup['errorCode']==0){
//            $result=array("Success"=>true,"message"=>$resulttopup['message']);
//        }else{
//            $result=array("Success"=>false,"message"=>$resulttopup['message']);
//        }
//    }
//    echo json_encode($result);
//}
//echo SendNapTienDienThoai('trantronglong87@gmail.com','abc','123123','10000');

        //echo $key123;
        //$this->privateKeyBase = base64_encode($privatekey);
        
        
//function encryptOrDecrypt($mprhase, $crypt) {
//     $MASTERKEY = "KEY PHRASE!";
//     $td = mcrypt_module_open('tripledes', '', 'ecb', '');
//     $iv = mcrypt_create_iv(mcrypt_enc_get_iv_size($td), MCRYPT_RAND);
//     mcrypt_generic_init($td, $MASTERKEY, $iv);
//     if ($crypt == 'encrypt')
//     {
//         $return_value = base64_encode(mcrypt_generic($td, $mprhase));
//     }
//     else
//     {
//         $return_value = mdecrypt_generic($td, base64_decode($mprhase));
//     }
//     mcrypt_generic_deinit($td);
//     mcrypt_module_close($td);
//     return $return_value;
//} 
//$array = "";
//echo json_decode("DXRE0kkRCRmk+CgB0gJJqh4Yw+ofOyfL",true);
//require_once '../ajax/login.php';

//echo SendNapTienDienThoai('trantronglong87@gmail.com','abc','123123','10000');

        //echo $key123;
        //$this->privateKeyBase = base64_encode($privatekey);
        
        
//function encryptOrDecrypt($mprhase, $crypt) {
//     $MASTERKEY = "KEY PHRASE!";
//     $td = mcrypt_module_open('tripledes', '', 'ecb', '');
//     $iv = mcrypt_create_iv(mcrypt_enc_get_iv_size($td), MCRYPT_RAND);
//     mcrypt_generic_init($td, $MASTERKEY, $iv);
//     if ($crypt == 'encrypt')
//     {
//         $return_value = base64_encode(mcrypt_generic($td, $mprhase));
//     }
//     else
//     {
//         $return_value = mdecrypt_generic($td, base64_decode($mprhase));
//     }
//     mcrypt_generic_deinit($td);
//     mcrypt_module_close($td);
//     return $return_value;
//} 
//$array = "";
//echo json_decode("DXRE0kkRCRmk+CgB0gJJqh4Yw+ofOyfL",true);
?>