<? 
session_start();
require_once("../functions/functions.php"); 
ob_start();
require_once("../functions/function_rewrite.php");
require_once("../classes/database.php");
require_once("../classes/config.php");
require_once("../functions/function_banthe.php"); 
date_default_timezone_set('Asia/Ho_Chi_Minh');
$urlwebsite = "https://banthe24h.vn";
$phonewebsite = '1900633682';
$emailwebsite = 'info@24hpay.vn';
$domain = "banthe24h.vn";
$domainto = "banthe24h.vn";
$vnp_TmnCode = "HUNGHA01"; //Mã website t?i VNPAY 
$vnp_HashSecret = "ZGWFAWBSJFXVRCGBWJRUUPBQZLJXBJSZ"; //Chu?i bí m?t
$vnp_Url ="https://pay.vnpay.vn/vpcpay.html";// "http://sandbox.vnpayment.vn/paymentv2/vpcpay.html";
$vnp_Returnurl="https://banthe24h.vn/thong-bao";
if(isset($_SESSION['UserInfo']))
{
    $udata = $_SESSION['UserInfo'];
    $userId = ChecktokenExpired($udata['TokentKey']);
    if($userId <=0){
        unset($_SESSION['UserInfo']);
    }
}

?>