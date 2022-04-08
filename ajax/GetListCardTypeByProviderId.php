<?
include("config.php");
$PrividerId = getValue("PrividerId","int","GET",0);
if($PrividerId > 0)
{
   $db_qr = new db_query("SELECT * FROM cardtype WHERE ProviderId = '".$PrividerId."' AND Status = 1");
   if(mysql_num_rows($db_qr->result) > 0)
   {
      $data = array();
      while ($row = mysql_fetch_assoc($db_qr->result))
      {
          $data[] = $row;
      }
      $arr = array("Success"=>true,
                   "data"=>$data);
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