<?
include("config.php");
$c = getValue("c","int","GET",0);
$c = (int)$c;
$u = getValue("u","str","GET","");
$u = replaceMQ(trim($u));
$kichhoat = 0;
if($c > 0 && $u != "")
{
   $db_qrus = new db_query("SELECT userid,Status FROM user WHERE UserName = '".$u."' LIMIT 1");
   if(mysql_num_rows($db_qrus->result) > 0)
   {
      $rowus = mysql_fetch_assoc($db_qrus->result);
      if($rowus['Status'] == 0)
      {
         $uid = $rowus['userid'];
         $db_qrcon = new db_query("SELECT id,Status FROM comfirmtable WHERE UserID = '".$uid."' AND Code = '".$c."' LIMIT 1");
         if(mysql_num_rows($db_qrcon->result) > 0)
         {
            $rowcon = mysql_fetch_assoc($db_qrcon->result);
            if($rowcon['Status'] == 0)
            {
               $kichhoat = 2;
               $UpdateDate = date("Y-m-d H:i:s",time());
               //Update trạng thái tài khoản thành công
               $db_exuser = new db_execute("UPDATE user SET Status = 1 WHERE UserId = '".$uid."'");
               $db_exconfirm = new db_execute("UPDATE comfirmtable SET Status = 1,UpdateDate = '".$UpdateDate."' WHERE UserID = '".$uid."' AND Code = '".$c."'");

               //đăng nhập luôn sau khi xác thực
               $db_qr = new db_query("SELECT * FROM `user` WHERE UserId = '".$uid."'");
               $row = mysql_fetch_assoc($db_qr->result);
               $ip = getUserIP();
               $token = create_token($row['UserId'],$ip);
               $profileData = array("UserId" => $row['UserId'],
                                    "UserName" => $row['UserName'],
                                    "EmailAddress" => $row['Email'],
                                    "FullName" => $row['Name'],
                                    "BankCode" => $row['BankCode'],
                                    "TokentKey" => $token);                                      
                $_SESSION['UserInfo'] = $profileData;
                $lg_userinfo = $_SESSION['UserInfo'];
                $lg_userid = $lg_userinfo['UserId'];
                $now = Checktoken($lg_userinfo['TokentKey'],$lg_userid);
                if($now == 1){ $logger = 1; }
                else{ $logger = 0; }


            }
            else
            {
               $kichhoat = 1;
            }
         }
      }
      else
      {
         $kichhoat = 1;
      }
   }
}
?>
<!DOCTYPE html>
<html>
<head>
   <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
   <title>Xác nhận đăng ký tài khoản thành công</title>
   <meta name="description" content='Xác nhận đăng ký tài khoản thành công' />
   <meta name="keywords" content='Xác nhận đăng ký tài khoản thành công' />
   <meta name="robots" content='noindex,nofollow' />
   <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
   <meta name='revisit-after' content='1 days' />
   <meta http-equiv="content-language" content="vi" />
   <meta name="author" itemprop="author" content="banthe24h.vn" />
   <meta name="google-site-verification" content="aUx6ZWFKAWgafQ1QMy6iAhA6aqaiQpet7LOH2MZ8UMk" />
   <link rel="canonical" href='https://banthe24h.vn/' />
   <link href="/favicon.ico" rel="shortcut icon" type="image/x-icon" />
   <link rel="shortcut icon" href="/images/favicon.ico" type="image/x-icon" />
      <link rel="stylesheet" href="/css/bootstrap.min.css">
  <link media="screen" rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/font-awesome/4.4.0/css/font-awesome.css" />
  <link rel="stylesheet" type="text/css" href="/css/style.min2.css" />
  <link rel="stylesheet" type="text/css" href="/css/responsive.css" />  
  <script src="/js/jquery.min.js"></script>
  <script src="/js/bootstrap.min.js"></script>
  <script src="/js/common.js"></script>
  <script src="/js/usermanager.js"></script>
</head>
<body style="cursor: pointer !important;">
   <!--header section work start-->        
   <? include("../includes/inc_header.php") ?>
   <div class="container">
   <div class="divcontent1"></div>
      <div class="row">
      <div class="col-md-8 col-xs-12 main-tintuc-left">
        <h2>Xác nhận đăng ký tài khoản </h2>
                     <div class="">
                     <?
                     if($kichhoat == 1)
                     {
                     ?>
                     <div class="alert-warning">
                        <div style="padding:15px;">
                           <h3>Chào bạn!</h3>
                           Tài khoản đã được kích hoạt
                        </div>
                     </div>
                     <?
                     }
                     else if($kichhoat == 2)
                     {
                     ?>
                     <div class="alert-success">
                        <div style="padding:15px;">
                           <h3>Chào bạn!</h3>
                           Bạn đã đăng ký tài khoản thành công
                        </div>
                     </div>
                     <?
                     }
                     ?>
      </div>
      </div>
      <? include("../includes/inc_tin_tuc_right.php") ?>
      </div>
      
   </div>
   <? include("../includes/inc_footer.php") ?>
   
</body>
</html>