<?php
include("config.php");
header("Content-Type: application/text; charset=utf-8");
$google_client_id 		= '1049266294465-dje6sdla5hm55ujqd0bgsiocmfdpmm4i.apps.googleusercontent.com';
$google_client_secret 	= 'Q1p7GVZZeD3ruz6142gqDB7X';
$google_redirect_url 	= 'http://localhost:8999/home/callback_google.php'; //path to your script
$google_developer_key 	= 'AIzaSyAE2vyTyT5HgQwqWch1lYWlQZwfL6TqoSo';
require_once '../home/Google/Google_Client.php';
require_once '../home/Google/contrib/Google_Oauth2Service.php';

$gClient = new Google_Client();
$gClient->setApplicationName('Đăng nhập Doithe66');
$gClient->setClientId($google_client_id);
$gClient->setClientSecret($google_client_secret);
$gClient->setRedirectUri($google_redirect_url);
$gClient->setDeveloperKey($google_developer_key);
$google_oauthV2 = new Google_Oauth2Service($gClient);
$result=array("errorCode"=>0) ; 
if(isset($_POST))
	{
		$Password = getValue("passwordnew","str","POST","");
   		$Password = replaceMQ(trim($Password));
   		$Password2 = getValue("passwordnew2","str","POST","");
   		$Password2 = replaceMQ(trim($Password2));
   		$Phone="1";
   		$Password = md5($Password);
               $Password2 = md5($Password2);
if (isset($_SESSION['token'])) 
{ 
     $contentlog = "user login google: token".$_SESSION['token'];
     savelog1("user.txt",$contentlog);
	//$gClient->setAccessToken($_SESSION['token']);
	$gClient->setAccessToken($_SESSION['token']);
	$user 				   = $google_oauthV2->userinfo->get();
	$user_id 				= $user['id'];
	$user_name 			= isset($user['name'])?filter_var($user['name'], FILTER_SANITIZE_SPECIAL_CHARS):'';
	$email 				= isset($user['email'])?filter_var($user['email'], FILTER_SANITIZE_EMAIL):'';
   	$time = date("Y-m-d H:i:s",time());
    $groupid = 6;
    $status = 1;
    $isadmin = 0;
    $query = "INSERT INTO user(UserName,Password,Password2,Name,Email,CreateDate,GroupId,IsAdmin,Phone,Status) 
                         VALUES('".mysql_real_escape_string($email)."','".$Password."','".$Password2."','".mysql_real_escape_string($user_name)."',
                         '".mysql_real_escape_string($email)."','".$time."','".$groupid."','".$isadmin."','".$Phone."','".$status."')";
    $db_ex = new db_execute_return();
    $last_id = $db_ex->db_execute($query);
    //echo $last_id;die();
    $result=array("errorCode"=>1);
    if($last_id > 0)
    {   		
    	$ip = getUserIP();
    	$token = create_token($last_id,$ip);
    	$profileData = array("UserId" => $last_id,
                              "UserName" => $email,
                              "EmailAddress" => $email,
                              "FullName" => $user_name,
                              "BankCode" => "",
                              "TokentKey" => $token);
        $contentlog = "User Name Login: ".$email." - Ip Login: ".$ip;
        savelog1("login.txt",$contentlog);
        $_SESSION['UserInfo'] = $profileData;
    }
     unset($_SESSION['token']);
	echo json_encode($result) ;
}
}
?>