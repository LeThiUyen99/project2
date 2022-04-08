<?
$module_id	= 27;
$module_name= "Nhà mạng";

//Declare prameter when insert data
$fs_table		= "providers";
$field_id		= "Id";
$field_name		= "Name";
$break_page		= "{---break---}";

require_once("../../resource/security/security.php");
//Check user login...
checkLogged();
//Check access module...
if(checkAccessModule($module_id) != 1) redirect($fs_denypath);
?>