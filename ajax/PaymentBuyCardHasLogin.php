<?
include("config.php");
$emailnhan = getValue("emailnhan","str","POST","");
$emailnhan = trim(replaceMQ($emailnhan));
$emailnhan = removeHTML($emailnhan);

$providerId = getValue("providerId","int","POST",0);
$providerId = (int)$providerId;
$amount = getValue("amount","str","POST","");
$amount = replaceMQ($amount);
$amount = removeHTML($amount);
$quantity = getValue("quantity","str","POST","");
$quantity = replaceMQ($quantity);
$quantity = removeHTML($quantity);
if(isset($_SESSION['UserInfo']))
{
   $providercode = GetProvidersById($providerId);
   
   $udata = $_SESSION['UserInfo'];
   $db_qr = new db_query("SELECT * FROM user WHERE UserId = '".$udata['UserId']."' LIMIT 1");
   if(mysql_num_rows($db_qr->result) > 0)
    {
      $row = mysql_fetch_assoc($db_qr->result);
      
         $providercode = GetProvidersById($providerId);
         if((int)$udata['UserId'] != 97940){
         $token = $udata['TokentKey'];
         $buycardlogin = GetCardLogin($providercode,$amount,$quantity,$token);
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
         }else{
            $arr = array("Success"=>false,
                    "msg" => "Không tồn tại người dùng");
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
?>