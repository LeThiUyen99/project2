<? 
session_start();
require_once("../functions/functions.php"); 
ob_start();
require_once("../functions/function_rewrite.php");
require_once("../classes/database.php");
require_once("../functions/function_banthe.php");
require_once("../functions/pagebreak.php"); 
date_default_timezone_set('Asia/Ho_Chi_Minh');
$urlwebsite = "https://banthe24h.vn";
$phonewebsite = '1900633682';
$emailwebsite = 'info@24hpay.vn';
$domain = "banthe24h.vn";
$domainto = "banthe24h.vn";
$logger = 0;
$ver = 2;
//var_dump($_SESSION['UserInfo']);
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
$vnp_TmnCode = "HUNGHA01"; //M� website t?i VNPAY 
$vnp_HashSecret = "ZGWFAWBSJFXVRCGBWJRUUPBQZLJXBJSZ"; //Chu?i b� m?t
$vnp_Url ="https://pay.vnpay.vn/vpcpay.html";// "http://sandbox.vnpayment.vn/paymentv2/vpcpay.html";
$vnp_Returnurl="https://banthe24h.vn/thong-bao";
require_once "../lib/Mobile_Detect.php";
$detect = new Mobile_Detect;
$ismobile=0;
if ( $detect->isMobile() || $detect->isTablet() ) {
 $ismobile=1;
}
?>