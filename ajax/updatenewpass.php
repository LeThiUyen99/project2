<?
include("config.php");
$c = getValue("c","int","POST",0);
$c = (int)$c;
$u = getValue("u","str","POST","");
$u = replaceMQ(trim($u));
$u = removeHTML($u);
$newpass = getValue("newpass","str","POST","");
$newpass = replaceMQ(trim($newpass));
$newpass = removeHTML($newpass);
if($c > 0 && $u != "" && $newpass != "")
{
   $db_qr = new db_query("SELECT Id,Status,UserID FROM comfirmtable WHERE code = '".$c."' AND CreateDate >'".date("Y-m-d H:i:s",(time() - (60 * 60)))."' LIMIT 1");
   if(mysql_num_rows($db_qr->result) > 0)
   {
      $row = mysql_fetch_assoc($db_qr->result);
      if($row['Status'] == 0)
      {
         $db_qrs = new db_query("SELECT Email,UserName,Name,BankCode FROM user WHERE UserId = '".$row['UserID']."'");
         if(mysql_num_rows($db_qrs->result) > 0)
         {
            $rows = mysql_fetch_assoc($db_qrs->result);
            if(md5($rows['UserName']) == $u)
            {
                $db_exconfirm= new db_execute("UPDATE comfirmtable SET Status = '1' WHERE Id = '".$row['Id']."'");
               $newpassmd5 = md5($newpass);
               $ip = getUserIP();
               $token = create_token($row['UserID'],$ip);
               $db_ex = new db_execute("UPDATE `user` SET Password = '".$newpassmd5."' WHERE UserId = '".$row['UserID']."'");
               $profileData = array("UserId" => $row['UserID'],
                                    "UserName" => $rows['UserName'],
                                    "EmailAddress" => $rows['Email'],
                                    "FullName" => $rows['Name'],
                                    "BankCode" => $rows['BankCode'],
                                    "TokentKey" => $token);
               $_SESSION['UserInfo'] = $profileData;
               $arr = array("Success"=>true,
                            "message"=>"Cập nhật thành công!");
               echo json_encode($arr); 
            }
            else
            {
               $arr = array("Success"=>false,
                            "message"=>"Mã code1 sai!");
               echo json_encode($arr);
            }
         }
         else
         {
            $arr = array("Success"=>false,
                         "message"=>"Mã xác thực không đúng!");
            echo json_encode($arr);
         }
      }
      else
      {
         $arr = array("Success"=>false,
                      "message"=>"Mã code đã sử dụng!");
         echo json_encode($arr);
      }
   }
   else
   {
      $arr = array("Success"=>false,
                   "message"=>"không tồn tại mã!");
      echo json_encode($arr);
   }
}
else
{
   $arr = array("Success"=>false,
                "message"=>"Đã có lỗi xảy ra, xin vui lòng liên hệ với quản trị hệ thống!");
   echo json_encode($arr);
}
?>