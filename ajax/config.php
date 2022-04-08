<? 
session_start();
require_once("../functions/functions.php"); 
ob_start();
require_once("../functions/function_rewrite.php");
require_once("../classes/database.php");
require_once("../classes/config.php");
require_once("../functions/247.php"); 
date_default_timezone_set('Asia/Ho_Chi_Minh');
$urlwebsite = "https://banthe247.com";
$phonewebsite = '0972022116';
$emailwebsite = 'HotroBanthe247.com@gmail.com';
$domain = "banthe247.com";
$domainto = "banthe247.com";
$vnp_TmnCode = "HUNGHA08"; //M� website t?i VNPAY 
$vnp_HashSecret = "VVNZMQPXNMFOSPAQZVREBTTIABDQEGBX"; //Chu?i b� m?t
$vnp_Url ="https://pay.vnpay.vn/vpcpay.html";// "http://sandbox.vnpayment.vn/paymentv2/vpcpay.html";
$vnp_Returnurl="https://banthe247.com/thong-bao";
if(isset($_SESSION['UserInfo']))
{
    $udata = $_SESSION['UserInfo'];
    $userId = ChecktokenExpired($udata['TokentKey']);
    if($userId <=0){
        unset($_SESSION['UserInfo']);
    }
}

?>