<?
include("inc_security.php");
$imgid = getValue("arrayB","arr","POST",'');
$vipid = getValue('idvip','int','POST',0);
if($arrayanh != '')
{
foreach($arrayanh as $data_img){
	$abc = saveImageFromBase64Type($data_img,$fs_filepath);
	$adam[] = $abc["name"];   
}
$arralbum = implode(";",$adam);
$db_ex = new db_execute("UPDATE vip SET vip_album = '".$arralbum."' WHERE vip_id = ".$vipid."");
}
?>