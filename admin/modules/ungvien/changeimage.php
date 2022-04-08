<?
include("inc_security.php");
$name = getValue("arrayB","str","POST",'');
$id  = getValue("id","str","POST",'');
if($name != '' && $id != '')
{
$db_qr = new db_query("SELECT vip_album,vip_id FROM vip WHERE vip_id = ".$id."");
$row = mysql_fetch_assoc($db_qr->result);
$arrimg = explode(";",$row['vip_album']);

$valid = array_search($name,$arrimg);
unset($arrimg[$valid]);
$strimg = implode(";",$arrimg);
$db_ex = new db_execute("UPDATE vip SET vip_album = '".$strimg."' WHERE vip_id = '".$id."'");
$fslinkimg = $fs_filepath.$name;
if(file_exists($fslinkimg))
{
  unset($fslinkimg); 
}
else
{
   echo $fslinkimg;
}
}
?>