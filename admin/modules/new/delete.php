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
$new_id     	= getValue("new_id","int","POST", 0);

$total 			= 0;
	
foreach($arr_record as $i=>$record_id){
	$record_id = intval($record_id);

	$db_check   = new db_query("SELECT new_id
							 FROM " . $fs_table . "
							 WHERE new_id = " . $record_id);
	if($row = mysql_fetch_assoc($db_check->result)){
		//Xóa tin khoa csdl
		$sql_del = "DELETE FROM ". $fs_table ." WHERE " . $field_id . " = " . $record_id;
		$db_del = new db_execute($sql_del);
		if($db_del->total > 0){
			$total +=  $db_del->total;
			
			//Xoa anh dai dien
			if($row['new_picture'] != ""){
				@unlink($fs_filepath . $row['new_picture']);
				@unlink($fs_filepath . "s_" . $row['new_picture']);
				@unlink($fs_filepath . "m_" . $row['new_picture']);
			}

		}
		unset($db_del);
	}
	unset($db_check);

//Xoa tag
}
echo "Có " . $total . " bản ghi đã được xóa !";
?>