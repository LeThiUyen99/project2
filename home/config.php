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
$domainto = "banthe247.com";
$logger = 0;
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

$vnp_TmnCode = "HUNGHA08"; 
$vnp_HashSecret = "VVNZMQPXNMFOSPAQZVREBTTIABDQEGBX"; 
$vnp_Url = "https://pay.vnpay.vn/vpcpay.html";
$vnp_Returnurl="https://banthe247.com/thong-bao";
require_once "../classes/Mobile_Detect.php";
$detect = new Mobile_Detect;
$ismobile=0;
if ( $detect->isMobile() || $detect->isTablet() ) {
   $ismobile=1;
}
?>