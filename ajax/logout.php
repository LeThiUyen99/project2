<?
include("config.php");
if(isset($_SESSION["UserInfo"]))
{
    unset($_SESSION["UserInfo"]);
}
$arr = array("Success"=>true);
echo json_encode($arr); 
?>