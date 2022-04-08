<?
include("config.php");
$password = getValue("password","str","POST","");
$password = trim(replaceMQ($password));
$password = removeHTML($password);
$passMD5 = md5($password);
$password2 = getValue("password2","str","POST","");
$password2 = trim(replaceMQ($password2));
$password2 = removeHTML($password2);
$pass2 = md5($password2);
$UserName = getValue("UserName","str","POST","");
$UserName = trim(replaceMQ($UserName));
$UserName = removeHTML($UserName);
$UserName = mb_strtolower($UserName,'UTF-8');
$providerId = getValue("providerId","int","POST",0);
$providerId = (int)$providerId;
$amount = getValue("amount","str","POST","");
$amount = replaceMQ($amount);
$amount = removeHTML($amount);
$quantity = getValue("quantity","str","POST","");
$quantity = replaceMQ($quantity);
$quantity = removeHTML($quantity);

if($password != "" && $UserName != "" && $amount != "")
{
   $db_qr = new db_query("SELECT * FROM user WHERE email = '".$UserName."' LIMIT 1");
   if(mysql_num_rows($db_qr->result) > 0)
   {
      $row = mysql_fetch_assoc($db_qr->result);
      // if($pass2 == $row['Password2'])
      // {
         $providercode = GetProvidersById($providerId);
         $buycardlogin = GetOneCard($UserName,$passMD5,$providercode,$amount,$quantity);
         $udata = $_SESSION['UserInfo'];
         $sodu = GetSoDuByUserId($udata['UserId']);
         if($buycardlogin != null)
         {
            if(isset($buycardlogin["listCards"]))
            {
               $lstResult = $buycardlogin["listCards"];
            }
            else
            {
               $lstResult = null;
            }
         }
         $tongtien = -($sodu["DongBang"]);
         $tienconlai = $sodu["KhaDung"];
         $arr = array("Success" =>true,
                      "data" => $buycardlogin,
                      "tongtien" => $tongtien,
                      "tienconlai" => $tienconlai);
         echo json_encode($arr);
      // }
      // else
      // {
      //    $arr = array("Success"=>false,
      //                 "msg" => "Mật khẩu cấp 2 không đúng");
      //    echo json_encode($arr); 
      // }
   }
   else
   {
      $arr = array("Success"=>false,
                   "msg" => "Không tồn tại người dùng");
      echo json_encode($arr); 
   }
}
else
{
   $arr = array("Success"=>false,
                "msg" => "Giao dịch thất bại");
   echo json_encode($arr); 
}
?>