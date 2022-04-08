<?
include("config.php");
if(isset($_SESSION["UserInfo"]))
{
    $lg_userinfo = $_SESSION['UserInfo'];
    $lg_userid = $lg_userinfo['UserId'];
    $_oldpassword = getValue("_oldpassword","str","POST","");
    $_oldpassword = replaceMQ(trim($_oldpassword));
    $_oldpassword = removeHTML($_oldpassword);
    //var_dump($_oldpassword);die();
    $_oldpassword = md5($_oldpassword);
    $_newpassword = getValue("_newpassword","str","POST","");
    $_newpassword = replaceMQ(trim($_newpassword));
    $_newpassword = removeHTML($_newpassword);
    $_newpassword = md5($_newpassword);
    
    $db_qr = new db_query("SELECT * FROM user WHERE userid = '".$lg_userid."' AND password = '".$_oldpassword."' LIMIT 1");
    if(mysql_num_rows($db_qr->result) > 0)
    {
      $db_ex = new db_execute("UPDATE user SET password = '".mysql_real_escape_string($_newpassword)."' WHERE userid = '".$lg_userid."'");
      $arr = array("Success"=>true,
                   "status" => 1);
      echo json_encode($arr);
    }
    else
    {
      $arr = array("Success"=>true,
                   "status" => 2);
      echo json_encode($arr); 
    }
}
else
{
   $arr = array("Success"=>false);
   echo json_encode($arr); 
}
?>