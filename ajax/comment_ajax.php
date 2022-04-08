<?
session_start();
require_once("../functions/functions.php"); 
require_once("../classes/database.php");

$url     = getValue("url","str","POST",'');
$parent  = getValue("parent","int","POST",0);
$comment = getValue("comment","str","POST",'');
$name    = getValue("name","str","POST",'');
$ip_cm    = getValue("ip_cm","str","POST",'');
$captcha    = getValue("cap","str","POST",'');

$comment = strip_tags($comment);
if ($captcha == $_SESSION['captcha_code']) {
	if ($url != '') {
		$query = "INSERT INTO comment(url_cm,parent_cm_id,Content,cm_user,CreateDate,ip_cm)VALUES('".$url."','".$parent."','".$comment."','".$name."','".time()."','".$ip_cm."')";

		$db_ex = new db_execute_return();

		$last_id = $db_ex->db_execute($query);	
	}
	$_SESSION['name_cm'] = $name;
	echo $last_id;
}else{
	echo 'f';
}

?>