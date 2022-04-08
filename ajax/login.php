<?
include("config.php");
if(isset($_POST) && $_SERVER['REQUEST_METHOD'] =='POST'){
    header("Access-Control-Allow-Origin: http://localhost:8888");
    header("Access-Control-Allow-Methods: POST");
    header("Access-Control-Max-Age: 3600");
    header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
$email = getValue("email","str","POST","");
$email = replaceMQ(trim($email));
$email = removeHTML($email);
$password = getValue("password","str","POST","");
$password = replaceMQ(trim($password));
$password = removeHTML($password);
//var_dump($_);die();
unset($_SESSION['UserInfo']);
if($password != "" && $email != "")
{
   $password = md5($password);
   $db_qr = new db_query("SELECT * FROM `user` WHERE UserName = '".$email."' AND Password = '".$password."'");
   
   if(mysql_num_rows($db_qr->result) > 0)
   {
      $row = mysql_fetch_assoc($db_qr->result);
      
      if((int)$row['Status'] == 1)
      {
         $ip = getUserIP();
         
         $token = create_token($row['UserId'],$ip);
         
         $profileData = array("UserId" => $row['UserId'],
                              "UserName" => $row['UserName'],
                              "EmailAddress" => $row['Email'],
                              "FullName" => $row['Name'],
                              "BankCode" => $row['BankCode'],
                              "TokentKey" => $token);
         $contentlog = "User Name Login: ".$row['UserName']." - Ip Login: ".$ip;
         savelog1("login.txt",$contentlog);
         $_SESSION['UserInfo'] = $profileData;
         $arr = array("Success"=>true);
         //var_dump($arr);die();
         echo json_encode($arr); 
      }
      else 
      {
         $arr = array("Success"=>false,
                      "message"=>"Tài khoản của bạn chưa được kích hoạt. Vui lòng kiểm tra email và kích hoạt tài khoản!");
         echo json_encode($arr);
      }
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
}
?>