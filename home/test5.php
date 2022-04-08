<?
include("config.php");
$passMD5 = md5("anhtu1993");
$pass2 = md5("anhtu1993");
$UserName = mb_strtolower("danganhtucode@gmail.com",'UTF-8');
$providerId = 1;
$amount = 10000;
$quantity = 1;
if($UserName != "" && $amount != "")
{
   $db_qr = new db_query("SELECT * FROM user WHERE email = '".$UserName."' LIMIT 1");
   if(mysql_num_rows($db_qr->result) > 0)
   {
      $row = mysql_fetch_assoc($db_qr->result);
      if($pass2 == $row['Password2'])
      {
         $providercode = GetProvidersById($providerId);
         $buycardlogin = GetOneCard($UserName,$passMD5,$providercode,$amount,$quantity);
         $udata = $_SESSION['UserInfo'];
         $sodu = GetSoDuByUserId($udata['UserId']);
         if($buycardlogin != null)
         {
            $lstResult = $buycardlogin["listCards"];
         }
         $tongtien = -($sodu["DongBang"]);
         $tienconlai = $sodu["KhaDung"];
         $arr = array("Success" =>true,
                      "data" => $buycardlogin,
                      "tongtien" => $tongtien,
                      "tienconlai" => $tienconlai);
         echo json_encode($arr); 
      }
      else
      {
         $arr = array("Success"=>false,
                      "msg" => "Mật khẩu cấp 2 không đúng");
         echo json_encode($arr); 
      }
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