<?php

/**
 * @author lolkittens
 * @copyright 2018
 */

include("config.php");
//header("Content-Type: application/text; charset=utf-8");
require_once '../classes/IOClass/IOServices.php';
$userinfourl=$_SERVER['REQUEST_URI'];
//echo $userinfourl;
$urlfull= parse_url("https://banthe24h.vn".$userinfourl, PHP_URL_PATH);
$urluri="/vnpayreturn.ashx";
//if($urlfull != $urluri)
//{
//   header("HTTP/1.1 301 Moved Permanently"); 
//   header("Location: $urluri");
//   exit();
//}
//$contentlog = "providerCode: ".$providerCode."  - menhgiathe: ".$menhgiathe." - soluong: ".$soluong;
      savelog1("giaodichbank.txt",$urlfull);
$inputData = array();
$returnData = array();
$data = $_REQUEST;
foreach ($data as $key => $value) {
    if (substr($key, 0, 4) == "vnp_") {
        $inputData[$key] = $value;
    }
}

$vnp_SecureHash = $inputData['vnp_SecureHash'];
unset($inputData['vnp_SecureHashType']);
unset($inputData['vnp_SecureHash']);
ksort($inputData);
$i = 0;
$hashData = "";

foreach ($inputData as $key => $value) {
    if ($i == 1) {
        $hashData = $hashData . '&' . $key . "=" . $value;
    } else {
        $hashData = $hashData . $key . "=" . $value;
        $i = 1;
    }
}
$vnpTranId = $inputData['vnp_TransactionNo']; //Mã giao dịch tại VNPAY
$vnp_BankCode = $inputData['vnp_BankCode']; //Ngân hàng thanh toán
$secureHash = md5($vnp_HashSecret . $hashData);
$Status = 0;
$orderId = $inputData['vnp_TxnRef'];
$isSetReturn=true;
//var_dump($secureHash,$vnp_SecureHash);die();
try {
    //Check Orderid    
    //Kiểm tra checksum của dữ liệu
    if ($secureHash == $vnp_SecureHash) {
        $vnp_ResponseCode = $inputData["vnp_ResponseCode"];
        //Lấy thông tin đơn hàng lưu trong Database và kiểm tra trạng thái của đơn hàng, mã đơn hàng là: $orderId            
        //Việc kiểm tra trạng thái của đơn hàng giúp hệ thống không xử lý trùng lặp, xử lý nhiều lần một giao dịch
        //Giả sử: $order = mysqli_fetch_assoc($result);  
        $db_qr = new db_query("SELECT * FROM `vnpayment` WHERE OrderId = '".$orderId."'"); 
        $StatusCode = (int)($vnp_ResponseCode);
        $success = false;
        $contentlog = "tra giao dich bank ".$orderId.", so thanh toan: ".$inputData;
                        savelog1("giaodichbank.txt",$contentlog);
        if(mysql_num_rows($db_qr->result) > 0)
        {
            $row=mysql_fetch_assoc($db_qr->result);
            if($row['IsComfirm'] !=1)
            {
                $trace = rand(10000000, 99999999);
                $transAmount = $row['Amount'];
                $Signature="BA_".$trace;
                // update order id
                $updateDate=date("Y-m-d H:i:s",time());
                $db_ex = new db_execute("UPDATE vnpayment SET UpdateDate = '".$updateDate."',IsComfirm = '1',Signature = '".$Signature."',VnpTranid = '".$vnpTranId."',PayDate = '".$inputData['vnp_PayDate']."',RspCode = '".$StatusCode."' 
                                  WHERE OrderId = '".$orderId."'");
                if($db_ex->total > 0)
                {
					$datasend=$row['Data'];
                    $tg=explode(":",$datasend);
                    $tg1=floatval($tg[1]);
                    if($tg1 > 0){
                       
						if((int)$row['TransacsionType'] ==2){
                    		$tg3=floatval($tg[1]) * floatval($tg[2]);							
							$transAmount=$tg3;
						}else{
							$transAmount=$tg1;
						}
                    }
                    $user=$row['CreateUserId'];
                    $price = (float)$row['Amount'];
                    if($StatusCode==0){
                        $returnData['RspCode'] = '00';
                        $returnData['Message'] = 'Confirm Success';
                        $isSetReturn = false;
                        if($row['CreateUserId'] != 14)
                        {
                            $price =(float) (($row['Amount'] - 1900) / 1.019);
                        }
                        $TransId=v4_guid();
                        // cong tien giao dich bank ( type =5)
                        $typeTopup=5;
                        $Statustran=1;
                        $db_exTransaction = new db_execute("INSERT INTO transactiontable(TransId,ReferentId,UserID,Price,Type,CreateUserId,CreateDate,Amount,Status,Trace,UpdateUserId,UpdateDate,CurrentBalance) 
                                                   VALUES('".$TransId."','".$orderId."','".$user."','".$price."','".$typeTopup."','".$user."','".$updateDate."','".$transAmount."','".$Statustran."','".$Signature."','".$user."','".$updateDate."','0')");
                        if($db_exTransaction->total> 0){
                            $success = true;
                        }
                        $contentlog = "add transaction type 5 ".$TransId.", so tien: ".$price." userid: ".$user;
                        savelog1("giaodich.txt",$contentlog);
                    }

                    if($success){
                        switch((int)$row['TransacsionType'])
                        {
                            case 1:
                                    $resultmsg=ValidateTopupHHMessage($row['Data']);
                                    $tyletrietkhau=GetPercentByProvice($user,1,$resultmsg['provider']);
                                    $topupAmount=$resultmsg['amount'];
                                    if ($user == 14)
                                    {
                                        if($tyletrietkhau < 0.998){
                                            $tyletrietkhau = 0.998;
                                        }
                                    }
                                    $transactiontype=(int)$row['TransacsionType'];
                                    $topup_tonggiatrigiaodich = $topupAmount * $tyletrietkhau;
                                    $TransIdTopup=v4_guid();
                                    if($price >=$topup_tonggiatrigiaodich){
                                        $referenidtop=v4_guid();
                                        $db_exTransaction = new db_execute("INSERT INTO transactiontable(TransId,ReferentId,UserID,Price,Type,CreateUserId,CreateDate,Amount,Status,Trace,UpdateUserId,UpdateDate,CurrentBalance) 
                                                   VALUES('".$TransIdTopup."','".$referenidtop."','".$user."','-".$price."','".$transactiontype."','".$user."','".$updateDate."','".$transAmount."','".$Statustran."','".$Signature."','".$user."','".$updateDate."','0')");
                                        $contentlog = "tru tien topup ".$TransIdTopup.", so tien: ".$price." userid: ".$user;
                                        savelog1("giaodich.txt",$contentlog);
                                        if($db_exTransaction->total> 0){
                                            $ioservice = new IOServices();
                                            $providerio=GetProviderIOByNumber($resultmsg['phone']);
                                            $rspResult=$ioservice->TopupMobile($providerio,$resultmsg['phone'],$topupAmount,true,$trace,4);
                                            if (isset($rspResult))
                                            {
                                                 $code = (int)$rspResult['resCode'];
                                                 // update topup mobile
                                                 if ($rspResult['resCode'] == "00")
                                                 {
                                                     //send mail
                                                     SendNapTienDienThoai($row['CreateMail'],$row['CreateMail'],$row['phone'],$topupAmount);
                                                  }
                                                  
                                             }
                                             $LocalDateTime = "VNPayment";
                                            $MobileNo = $resultmsg['phone'];
                                            $Balance = 0;
                                            $Sign = $Signature;
                                            $TelcoStatus = $rspResult['resCode'];                                
                                            $VnPayDateTime = "KHO"; 
                                            $db_exTopup = new db_execute("INSERT INTO vnpaytopupmobile(Id,RespCode,MobileNo,Amount,Trace,LocalDateTime,VnPayDateTime,Balance,UserId,Sign,CreateUserId,CreateDate,TelcoStatus,ProviderCode) 
                                                   VALUES('".$orderId."','".$TelcoStatus."','".$MobileNo."','".$topupAmount."','".$trace."','".$LocalDateTime."','".$VnPayDateTime."','".$Balance."','".$userId."','".$Sign."','".$user."','".$updateDate."','".$TelcoStatus."','".$providerio."')");
                                            if($db_exTopup->total > 0){}
                                            }
                                    }
                            	break;
                            case 2:
                                    $transactiontype=(int)$row['TransacsionType'];
                                    $contentlog = "Giao dich mua the".$transactiontype;
                                    savelog1("giaodich.txt",$contentlog);
                                    $msgreturn = explode(":",$row['Data']);
                                    
                                    $provider = $msgreturn[0];
                                    $amount = $msgreturn[1];
                                    $quanlity = $msgreturn[2];
                                    $TransIdbuycard=v4_guid();
//$abc=ValidateMessage($row['Data'],$provider,$amount,$quanlity);
                                    //if(ValidateMessage($row['Data'],$provider,$amount,$quanlity))
                                    //{

                                        $tyletrietkhau = 1;//TyLeTrietKhauMuaMaThe($user,$provider);
                                        $thangdu = thangdu($amount);
                                        if((int)$thangdu > 0)
                                        {
                                            $tyletrietkhau = $tyletrietkhau + $thangdu;
                                        }
                                        if($user ==14){
                                            if($tyletrietkhau < 1){
                                                $tyletrietkhau=1;
                                            }
                                        }
                                        $tonggiatrigiaodich = $amount * $quanlity * $tyletrietkhau;
                                        $contentlog = "Gia tri giao dich $amount - $quanlity - $tyletrietkhau - $price";
                                        savelog1("giaodich.txt",$contentlog);
                                        if($price >=$tonggiatrigiaodich && $tonggiatrigiaodich > 0)
                                        {
                                            $chonKenh="KHO";
                                            $localdatatime=date("YmdHis",time());
                                            $buycard=BuyCardsWs($provider,$amount, $quanlity, $trace);
                                            $trutien=float-$price;
                                            if($buycard != null)
                                            {
                                                //date("Y-m-d H:i:s",time())
                                                $referenid=v4_guid();
                                                $db_ex2 = new db_execute("INSERT INTO transactiontable(TransId,ReferentId,UserId,Price,Amount,Type,Status,CreateDate,CreateUserId,UpdateDate,UpdateUserId,Trace,CurrentBalance) 
                                         VALUES('".$TransIdbuycard."','".$referenid."','".$user."','-".$price."','".$transAmount."','2','1','".date("Y/m/d H:i:s",time())."','".$user."','".date("Y/m/d H:i:s",time())."','".$user."','".$Signature."','0')");
                                               if($db_ex2->total > 0)
                                               {}
                                                //$db_exTransaction1 = new db_execute("INSERT INTO transactiontable(TransId,ReferentId,UserID,Price,Type,CreateUserId,CreateDate,Amount,Status,Trace,UpdateUserId,UpdateDate,CurrentBalance) 
                                                //   VALUES('".$TransIdbuycard."','".$orderId."','".$user."','".$trutien."','2','".$user."','".$updateDate."','".$transAmount."','1','".$Signature."','".$user."','".$updateDate."','0')");
                                                //$db_exTransaction1 = new db_execute("INSERT INTO transactiontable(TransId,ReferentId,UserID,Price,Type,CreateUserId,CreateDate,Amount,Status,Trace,UpdateUserId,UpdateDate,CurrentBalance) 
                                                  // VALUES('".$TransIdbuycard."','".$orderId."','".$user."','-".$price."','2','".$user."','".$updateDate."','".$transAmount."','1','".$Signature."','".$user."','".$updateDate."','0')");
                                                $contentlog = "tru tien topup ".$TransIdbuycard.", so tien: ".$price." userid: ".$user;
                                                savelog1("giaodich.txt",$contentlog);
                                                //$query="INSERT INTO transactiontable(TransId,ReferentId,UserID,Price,Type,CreateUserId,CreateDate,Amount,Status,Trace,UpdateUserId,UpdateDate,CurrentBalance)VALUES('".$TransIdbuycard."','".$orderId."','".$user."','".$trutien."','2','".$user."','".$updateDate."','".$transAmount."','1','".$Signature."','".$user."','".$updateDate."','0')";
                                                //savelog1("giaodich.text",$query);
                                                //var_dump($db_exTransaction->total,$buycard);die();
                                                if($db_exTransaction1->total> 0){
                                                    
                                                }
                                                $buycard = json_decode($buycard,true);
                                                $sothe = 1;
                                                $body="";
                                                  foreach($buycard as $item => $type)
                                                  {
                                                      $RespCode = "00";
                                                      $Amount = $amount;
                                                      $CreateDate = date("Y-m-d H:i:s",time());
                                                      $CreateUserId = $user;
                                                      $Id = v4_guid();// sprintf('{%04X%04X-%04X-%04X-%04X-%04X%04X%04X}', mt_rand(0, 65535), mt_rand(0, 65535), mt_rand(0, 65535), mt_rand(16384, 20479), mt_rand(32768, 49151), mt_rand(0, 65535), mt_rand(0, 65535), mt_rand(0, 65535));
                                                      $LocalDateTime = $localdatatime;
                                                      $PinCode = $type['PinCode'];
                                                      $Serial = $type['Serial'];
                                                      $Sign = $trace;
                                                      $TelcoStatus = 1;
                                                      $Trace = $trace;
                                                      $UserId = $user;
                                                      $VnPayDateTime = $chonKenh;
                                                      $ProviderCode = $provider;
                                                      $TransacsionID = $orderId;
                                                      
                                                      $db_ex = new db_execute("INSERT INTO vnpaycardresponse(Id,Respcode,Trace,Amount,LocalDateTime,VnPayDateTime,PinCode,Serial,UserId,Sign,CreateUserId,CreateDate,TelcoStatus,ProviderCode,TransacsionID) VALUES('".$Id."','".$RespCode."','".$Trace."','".$Amount."','".$LocalDateTime."','".$VnPayDateTime."','".$PinCode."','".$Serial."','".$UserId."','".$Sign."','".$CreateUserId."','".$CreateDate."','".$TelcoStatus."','".$ProviderCode."','".$TransacsionID."')");
                                                        $mathe = Decrypt("BMEymdHUrIgB1PfoZyQOAB5b0CoY53AZ3Apa",$type['PinCode']);
                                                        $body .= "Thẻ số ".$sothe.":<br /> Loại thẻ: ".$type['Telco']." - Mệnh giá: ".$type['Amount']." - Mã thẻ: ".$mathe." - Serial: ".$type['Serial']."<br />";
                                                        $sothe++;
                                                         unset($mathe);
                                                  }                                                  
                                                  
                                                  SendBuyCard($row['CreateMail'],$row['CreateMail'],$body);
                                            }                                            
                                        }                                    
                            break;
                        }
                    }
                }
                
            }else{
                if($isSetReturn){
                    $returnData['RspCode'] = '02';
                    $returnData['Message'] = 'Order already confirmed'; 
                }
               
            }
            
        }else{
            if($isSetReturn){
                $returnData['RspCode'] = '01';
                $returnData['Message'] = 'Order not found';
            }
        }
        $order = NULL;
        if ($order != NULL) {
            if ($order["Status"] != NULL && $order["Status"] == 0) {
                if ($params['vnp_ResponseCode'] == '00') {
                    $Status = 1;
                } else {
                    $Status = 2;
                }
                //Cài đặt Code cập nhật kết quả thanh toán, tình trạng đơn hàng vào DB
                //
                //
                //
                //Trả kết quả về cho VNPAY: Website TMĐT ghi nhận yêu cầu thành công                
                
            } 
        } 
    } else {
        $returnData['RspCode'] = '97';
        $returnData['Message'] = 'Chu ky khong hop le';
    }
} catch (Exception $e) {
    $returnData['RspCode'] = '99';
    $returnData['Message'] = 'Unknow error';
}
//Trả lại VNPAY theo định dạng JSON
echo json_encode($returnData);

?>