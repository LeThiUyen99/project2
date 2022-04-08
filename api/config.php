<? 
session_start();
require_once("../functions/functions.php"); 
ob_start();
require_once("../functions/function_rewrite.php");
require_once("../classes/database.php");
require_once("../functions/247.php");
require_once("../functions/pagebreak.php"); 
date_default_timezone_set('Asia/Ho_Chi_Minh');
$urlwebsite = "https://banthe247.com";
$phonewebsite = '0972022116';
$emailwebsite = 'HotroBanthe247.com@gmail.com';
$domain = "banthe247.com";
$domainto = "banthe247.COM";
$logger = 0;
$host="banthe247.com";
if(isset($_SESSION['UserInfo']))
{
   $lg_userinfo = $_SESSION['UserInfo'];
   $lg_userid = $lg_userinfo['UserId'];
   $now = Checktoken($lg_userinfo['TokentKey'],$lg_userid);
   if($now == 1)
   {
      $logger = 1;
   }
   else
   {
      $logger = 0;
   }
}
$vnp_TmnCode = ""; //Mã website t?i VNPAY 
$vnp_HashSecret = ""; //Chu?i bí m?t
$vnp_Url = "http://sandbox.vnpayment.vn/paymentv2/vpcpay.html";
$vnp_Returnurl="http://localhost:8898/thong-bao";
require_once "../lib/Mobile_Detect.php";
$detect = new Mobile_Detect;
$ismobile=0;
if ( $detect->isMobile() || $detect->isTablet() ) {
 $ismobile=1;
}
?>