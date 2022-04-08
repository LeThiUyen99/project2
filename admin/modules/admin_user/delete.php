<?
include("inc_security.php");

//check quyền them sua xoa
checkAddEdit("delete");

#+
#+ Khai bao bien
$record_id		= getValue("record_id","str","GET","0");
//var_dump($record_id);die();
$arr_record 	= explode(",", $record_id);

$returnurl 		= base64_decode(getValue("returnurl","str","GET",base64_encode("listing.php")));
$type		    	= getValue("type","str","POST","");
$new_id     	= getValue("new_id","int","POST", 0);

$total 			= 0;
	$fs_table 		= "useradmin";
    $field_id="UserId";
foreach($arr_record as $i=>$record_id){
	$record_id = intval($record_id);

	
		//Xóa tin khoa csdl
		$sql_del = "DELETE FROM ". $fs_table ." WHERE " . $field_id . " = " . $record_id;
		$db_del = new db_execute($sql_del);
		if($db_del->total > 0){
			

		}
		unset($db_del);
	
redirect($returnurl);
//Xoa tag
}
//echo "Có " . $total . " bản ghi đã được xóa !";
?>