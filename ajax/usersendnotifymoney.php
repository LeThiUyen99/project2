<?php

/**
 * @author lolkittens
 * @copyright 2018
 */

include("config.php");

require_once '../functions/247User.php';
if(isset($_POST))
{
    $TransferType = getValue("TransferType","str","POST","");
    $TransferType = trim(replaceMQ($TransferType));
    $TransferType = removeHTML($TransferType);
    $TransferBank = getValue("TransferBank","str","POST","");
    $TransferBank = trim(replaceMQ($TransferBank));
    $TransferBank=removeHTML($TransferBank);   
    $CustomerName = getValue("CustomerName","str","POST","");
    $CustomerName = trim(replaceMQ($CustomerName));
    $CustomerName=removeHTML($CustomerName);
    $CustomerBN = getValue("CustomerBN","str","POST","");
    $CustomerBN = trim(replaceMQ($CustomerBN));
    $CustomerBN=removeHTML($CustomerBN);
    $ReceiveBank = getValue("ReceiveBank","str","POST","");
    $ReceiveBank = trim(replaceMQ($ReceiveBank));
    $ReceiveBank=removeHTML($ReceiveBank);
    $TransferDateStr = getValue("TransferDateStr","str","POST","");
    $TransferDateStr = trim(replaceMQ($TransferDateStr));
    $TransferDateStr=removeHTML($TransferDateStr);
    $Amount = getValue("Amount","str","POST","");
    $Amount = trim(replaceMQ($Amount));
    $Amount=removeHTML($Amount);
    $ToBankCode = getValue("ToBankCode","str","POST","");
    $ToBankCode = trim(replaceMQ($ToBankCode));
    $ToBankCode=removeHTML($ToBankCode);
    $ToBankNumber = getValue("ToBankNumber","str","POST","");
    $ToBankNumber = trim(replaceMQ($ToBankNumber));
    $ToBankNumber=removeHTML($ToBankNumber);
    if(isset($_SESSION['UserInfo']))
    {
        $udata = $_SESSION['UserInfo'];
        $userid=$udata['UserId'];
        $result=UserSendNotifyMoney($userid,$TransferType,$TransferBank,$CustomerName,$CustomerBN,$ReceiveBank,$TransferDateStr,$Amount,$ToBankCode,$ToBankNumber);

        $db_rb = new db_query("SELECT Name FROM `banktable` WHERE ID = '".$ReceiveBank."'");
        $row_rb = mysql_fetch_assoc($db_rb->result);

        $db_us = new db_query("SELECT UserName FROM `user` WHERE UserId = '".$userid."' AND `Status`=1");
        $row_us = mysql_fetch_assoc($db_us->result);



        $body = '<!DOCTYPE html>
          <html xmlns="http://www.w3.org/1999/xhtml">
          <head>
          <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
          <title>['.$domain.'] - Thông báo nạp tiền</title>
          </head><body><div style="width: 800px; margin: 0 auto;font-size:14px; background-color: #fff; border: 1px solid #cccccc; ">
          <div style="padding:7px 15px;">
            <div style="padding: 5px 0px 7px 0px; border-bottom: 5px solid #d3e2ff;margin-bottom:25px;">
                <a style="text-decoration:none!important">'.$domainto.'</a>
            </div>
            <b style="text-decoration:none">Thông báo nạp tiền trên <a style="text-decoration:none!important">'.$domain.'</a></b>
            <br><br>
            <p>Email gửi thông báo: <b>'.$row_us['UserName'].'</b></p>
            <p>Tên người chuyển: '.$CustomerName.'</p>
            <p>Ngân hàng chuyển: '.$TransferBank.'</p>
            <p>STK chuyển: '.$CustomerBN.'</p>
            <p>Số tiền chuyển: '.number_format($Amount,0,",",".").'</p>
            <p>Ngân hàng nhận: '.$row_rb['Name'].'</p> <br><br>
          </div>
          </body></html>';
          $body = base64_encode($body);
          CreateSendMail("support@banthe24h.vn","hotrocongtienhungha@gmail.com","","","[".$domain."] - Thông báo nạp tiền",$body,"LAY_LAI_MAT_KHAU");


        echo json_encode($result);
        
    }else{
        echo json_encode(array('Success'=>false,));
    }
}

?>