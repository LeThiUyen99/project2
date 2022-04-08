<?
include("inc_security.php");

//check quyền them sua xoa
checkAddEdit("delete");

#+
#+ Khai bao bien
$record_id		= getValue("record_id","str","POST","0");
$arr_record 	= explode(",", $record_id);

$returnurl 		= base64_decode(getValue("returnurl","str","GET",base64_encode("listing.php")));
$type		    	= getValue("type","str","POST","");

$total 			= 0;
	
foreach($arr_record as $i=>$record_id){
	$record_id = intval($record_id);

	$db_check   = new db_query("SELECT *
							 FROM " . $fs_table . "
							 WHERE new_id = " . $record_id);
	if($row = mysql_fetch_assoc($db_check->result)){
		//Xóa tin khoa csdl
		$sql_del = "UPDATE ". $fs_table ." SET new_update_time = ".time()." WHERE " . $field_id . " = " . $record_id;
		$db_del = new db_execute($sql_del);
		unset($db_del);
	}
	unset($db_check);

//Xoa tag
}
echo "Đã làm mới tin tuyển dụng !";
?>