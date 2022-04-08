<?
include("config.php");
$email = getValue("_emailforgot","str","POST","");
$email = replaceMQ(trim($email));
if($email != "")
{
   $db_qr = new db_query("SELECT UserId,UserName FROM `user` WHERE UserName = '".$email."' LIMIT 1");
   if(mysql_num_rows($db_qr->result) > 0)
   {
      $row = mysql_fetch_assoc($db_qr->result);
      $userid = $row['UserId'];
      $name = $row['UserName'];
      $send = 0;
      $db_qrs = new db_query("SELECT Code FROM comfirmtable WHERE UserID = '".$userid."' AND Status = 0 AND Type = 2 AND CreateDate >'".date("Y-m-d H:i:s",(time() - (60 * 60)))."' ORDER BY CreateDate DESC");
      if(mysql_num_rows($db_qrs->result) > 0)
      {
         $rows = mysql_fetch_assoc($db_qrs->result);     
         $comfirmcode = $rows['Code'];
         $send = 1;
      }
      else
      {
         $send = 1;
         $comfirmcode = rand(1000000000,9999999999);
         $CreateDate = date("Y-m-d H:i:s",time());
         $Status = 0;
         $UpdateDate = date("Y-m-d H:i:s",time());
         $db_ex2 = new db_execute("INSERT INTO comfirmtable(UserID,Code,Type,Status,Data,Description,CreateDate,UpdateDate)
                                           VALUES('".$userid."','".$comfirmcode."','2','0','','Thay doi mat khau','".$CreateDate."','".$UpdateDate."')");
      }
      if($send == 1)
      {
         $body = '<!DOCTYPE html>
                  <html xmlns="http://www.w3.org/1999/xhtml">
                  <head>
                  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
                  <title>['.$domain.'] - Xác nhận lấy lại mật khẩu</title>
                  </head><body><div style="width: 800px; margin: 0 auto;font-size:14px; background-color: #fff; border: 1px solid #cccccc; ">
                  <div style="padding:7px 15px;"><div style="padding: 5px 0px 7px 0px; border-bottom: 5px solid #d3e2ff;margin-bottom:25px;">
                  '.$domainto.'</div><b>Chức năng lấy lại mật khẩu trên '.$domain.'</b><br><br>
                  <p>Xin chào <b>'.$name.'</b>,</p><br>Bạn đã thực hiện chức năng lấy lại mật khẩu trên '.$domain.'.<br />
                  Tài khoản: '.$email.' yêu cầu thay đổi mật khẩu.<br />Bạn click vào đường dẫn dưới đây để thay đổi mật khẩu:
                  <a style="font-size:16px" target="_blank" href="'.$urlwebsite.'/user/changenewpass?c='.$comfirmcode.'&u='.md5($email).'">Link thay đổi mật khẩu mới</a>
                  <br /></div><div style="padding:7px 15px;"><p><b>Cảm ơn bạn đã sử dụng dịch vụ của Chúng tôi</b></p><p style="line-height:25px;">Để biết thêm chi tiết về dịch vụ hoặc đóng góp ý kiến cho Chúng tôi, Quý khách vui lòng liên hệ qua số điện thoại: '.$phonewebsite.' hoặc Email: '.$emailwebsite.'</p>
                  <p>Trân trọng,</p><p><b>'.$domain.'</b></p></div></div></body></html>';
         
         $body = base64_encode($body);
      CreateSendMail("support@banthe24h.vn",$email,"","","[".$domain."] - Xác nhận lấy lại mật khẩu",$body,"LAY_LAI_MAT_KHAU");
      }
      $arr = array("Success"=>true);
      echo json_encode($arr);
   }
   else
   {
      $arr = array("Success"=>false,
                   "message"=>"Địa chỉ email không tồn tại");
      echo json_encode($arr);
   }
}

?>