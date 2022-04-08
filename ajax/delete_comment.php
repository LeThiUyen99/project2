<?
require_once("../functions/functions.php"); 
require_once("../classes/database.php");

$id   = getValue("id","int","POST",0);
$id   = (int)$id;
if($id != '' && $id != '0')
{
   $db_ex = new db_execute("DELETE FROM comment WHERE CommentID = ".$id." OR parent_cm_id = ".$id."");

   echo "DELETE FROM comment WHERE CommentID = ".$id." OR parent_cm_id = ".$id."";
}
unset($id,$db_ex);

?>