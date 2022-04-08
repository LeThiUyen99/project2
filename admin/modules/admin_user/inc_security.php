<?
$module_id = 3;
//check security...
require_once("../../resource/security/security.php");
//Check user login...
checkLogged();
//Check access module...
if(checkAccessModule($module_id) != 1) redirect($fs_denypath);

$fs_table 		= "useradmin";
$menu				= new menu();
$listAll 		= $menu->getAllRecodeNew("categories","CategoryID","",0,"Status >=0" ,"CategoryID,CategoryName,Description,Status,Code,Meta,MetaDesc","CategoryID ASC");
$user_id 		= getValue("user_id","int","SESSION");
?>