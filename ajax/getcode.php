<?
include("config.php");
header("Content-Type: application/text; charset=utf-8");
$ser = 0;
if(isset($_POST))
{
   $UserName = getValue("UserName","str","POST","");
   $UserName = replaceMQ(trim($UserName));
   $UserName = mb_strtolower($UserName,'UTF-8');
   $Password = getValue("Password","str","POST","");
   $Password = replaceMQ(trim($Password));   
   $Name = getValue("Name","str","POST","");
   $Name = replaceMQ(trim($Name));
   $Email = getValue("Email","str","POST","");
   $Email = replaceMQ(trim($Email));
   $Email = mb_strtolower($Email,'UTF-8');
   $Phone = getValue("Phone","str","POST","");
   $Phone = replaceMQ(trim($Phone));
   $_captcha = getValue("_captcha","str","POST","");
   
   if($UserName != "" && $Password != ""  && $Name != "" && $Email != "" && $Phone != "" && $_captcha != "")
   { 
      $code = $_captcha;
      if(isset($_SESSION["code"]))
      {
         
         if($code == $_SESSION["code"])
         {
            $ser = 1;
            $db_qr = new db_query("SELECT userid FROM user WHERE username = '$UserName' LIMIT 1");
            if(mysql_num_rows($db_qr->result) > 0)
            {
               $ser = 2;
            }
            else
            {
               $Password = md5($Password);
               
               $time = date("Y-m-d H:i:s",time());
               $groupid = 6;
               $status = 0;
               $isadmin = 0;
               $query = "INSERT INTO user(UserName,Password,Name,Email,CreateDate,GroupId,IsAdmin,Phone,Status) 
                         VALUES('".mysql_real_escape_string($UserName)."','".$Password."','".mysql_real_escape_string($Name)."',
                         '".mysql_real_escape_string($Email)."','".$time."','".$groupid."',$isadmin,'".$Phone."','".$status."')";
               $db_ex = new db_execute_return();
               $last_id = $db_ex->db_execute($query);
               $ser = 3;
               if($last_id > 0)
               {
                  $comfirmcode = rand(100000,999999);
                  $db_ex2 = new db_execute("INSERT INTO comfirmtable(UserID,Code,Type,Status,Data,Description,CreateDate,UpdateDate)
                                           VALUES('".$last_id."','".$comfirmcode."',1,0,'','Đăng kí tài khoản','".$time."','".$time."')");
                  $body = '<!DOCTYPE html>
                  <html xmlns="http://www.w3.org/1999/xhtml">
                  <head>
                  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
                  <title>['.$domain.'] - Xác nhận đăng ký tài khoản</title>
                  </head><body><div style="width: 800px; margin: 0 auto;font-size:14px; background-color: #fff; border: 1px solid #cccccc; ">
                  <div style="padding:7px 15px;"><div style="padding: 5px 0px 7px 0px; border-bottom: 5px solid #d3e2ff;margin-bottom:25px;">
                  <a style="text-decoration:none!important">'.$domainto.'</a></div><b style="text-decoration:none">Xác thực tài khoản email đăng ký trên <a style="text-decoration:none!important">'.$domain.'</a></b><br><br><p>Xin chào <b>'.$Name.'</b>,</p>
                  <br>Bạn đã đăng ký thành công tài khoản tại website <a style="text-decoration:none!important">'.$domain.'</a> bằng email: <strong><a style="text-decoration:none!important">'.$Email.'</a></strong><br />
                  để hoàn tất việc đăng ký thành viên, bạn phải Click vào đường link dưới đây để kích hoạt thành công tài khoản.<br /><br />
                  <br /><a style="font-size:16px" target="_blank" href="'.$urlwebsite.'/User/ComfirmUserRegister?c='.$comfirmcode.'&u='.$Email.'">Link kích hoạt tài khoản</a>
                  <br /><div style="text-align:center;width:100%; font-size:22px;color:#fff;"><strong>'.$comfirmcode.'</strong></div><br /></div><div style="padding:7px 15px;"><p><b>Cảm ơn bạn đã sử dụng dịch vụ của Chúng tôi</b></p><p style="line-height:25px;">Để biết thêm chi tiết về dịch vụ hoặc đóng góp ý kiến cho Chúng tôi, Quý khách vui lòng liên hệ qua số điện thoại: '.$phonewebsite.' hoặc Email: <a style="text-decoration:none!important">'.$emailwebsite.'</a></p>
                  <p>Trân trọng,</p><p><a style="text-decoration:none!important"><b>'.$domain.'</b></a></p></div></div></body></html>';
                  //$body = mb_convert_encoding($body,'UTF-8');
                  $body = base64_encode($body);
                  CreateSendMail("support@banthe24h.vn",$Email,"","","[".$domain."] - Xác nhận đăng kí tài khoản",$body,"LAY_LAI_MAT_KHAU");
               }
            }
         } 
      }
   }
}
echo $ser;
?>