<?
include("config.php");
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
   if($logger == 1)
   {
      $arr = array("Success"=>true,
                   "email" => $lg_userinfo['EmailAddress']);
      echo json_encode($arr); 
   }
   else
   {
      $arr = array("Success"=>false);
      echo json_encode($arr); 
   }
}
else
{
   $arr = array("Success"=>false);
   echo json_encode($arr); 
}
?>