<? 
require_once("inc_security.php");

#+
#+ Kiem tra quyen them sua xoa
checkAddEdit("edit");

#+
#+ Khai bao bien
$add				= "listing.php";
$listing			= "listing.php";
$edit				= "listing.php";
$after_save_data	= getValue("after_save_data", "str", "POST", $listing);

$errorMsg 			= "";		//Warning Error!
$action				= getValue("action", "str", "POST", "");
$fs_action			= getURL();
$record_id			= getValue("record_id");

#+
#+ Goi class generate form
$myform = new generate_form();	//Call Class generate_form();
$myform->removeHTML(0);	//Loại bỏ chức năng không cho điền tag html trong form
#+
#+ Khai bao bang du lieu
$myform->addTable($fs_table);	// Add table
#+
#+ Khai bao thong tin cac truong
$myform->add("nha_mang","nha_mang",0,0,"",1,translate_text("Vui lòng nhập tênc"),0,"");
$myform->add("khuyen_mai","khuyen_mai",0,0,"",1,translate_text("Vui lòng nhập khuyến mãi"),0,"");
$myform->add("thoi_gian","thoi_gian",0,0,"",1,translate_text("Vui lòng nhập thời gian"),0,"");


#+
#+ đổi tên trường thành biến và giá trị
$myform->evaluate();

#+
#+ Neu nhu co submit form
if($action == "submitForm"){

	#+
	#+ Kiểm tra lỗi
    $errorMsg .= $myform->checkdata();
	$errorMsg .= $myform->strErrorField ;	//Check Error!
	if($errorMsg == ""){
		#+
		#+ Thuc hien query
		$query = $myform->generate_update_SQL($field_id,$record_id);
		$db_ex = new db_execute($query);
		# echo $query;exit();
			
		#+
		#+ Chuyen ve trang khac khi xu ly du lieu oki
		redirect($after_save_data . "?record_id=" . $record_id);
		exit();
	}
}

#+
#+ Khai bao ten form 
$myform->addFormname("submitForm"); //add  tên form để javacheck
#+
#+ Xử lý javascript
$myform->addjavasrciptcode('');
$myform->checkjavascript();

#+
#+ lay du lieu cua record can sua doi
$query = "SELECT * FROM " . $fs_table . " WHERE " . $field_id . " = " . $record_id;
//var_dump($query);die();
$db_data 	= new db_query($query);

if($row 	= mysql_fetch_assoc($db_data->result))
{
	foreach($row as $key=>$value)
	{
		if($key!='lang_id' && $key!='admin_id') $$key = $value;
	}
}else
{
	exit();
}

#+
#+ Array category	
//$sql				=	" cat_type = '".$cat_type."'";
$menu 				= 	new menu();
$listAll 			= 	$menu->getAllRecodeNew("categories","CategoryID","",0,"Status >=0" ,"CategoryID,CategoryName,Description,Status,Code,Meta,MetaDesc","CategoryID ASC");//getAllChild("categories_multi","cat_id","cat_parent_id","0",$sql . " AND lang_id = " . $_SESSION["lang_id"] . $sqlcategory,"cat_id,cat_name,cat_order,cat_type,cat_parent_id,cat_has_child","cat_order ASC, cat_name ASC","cat_has_child");
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN" "http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<?=$load_header?>
</head>
<body topmargin="0" bottommargin="0" leftmargin="0" rightmargin="0">
<? /*------------------------------------------------------------------------------------------------*/ ?>
<?=template_top(translate_text("Records Edit") . ": " . $row["CategoryName"])?>
<? /*------------------------------------------------------------------------------------------------*/ ?>
<?
$form = new form();
$form->create_form("form_name",$fs_action,"post","multipart/form-data",'onsubmit="validateForm();return false;"  id="form_name" ');
$form->create_table();		
?>
<?=$form->text_note('Những ô dấu sao (<font class="form_asterisk">*</font>) là bắt buộc phải nhập.')?>
<?=$form->errorMsg($errorMsg)?>


<?=$form->text(translate_text("Nhà mạng"),"nha_mang","nha_mang",$nha_mang,translate_text("nhà mạng"),1,250," ",255,"","readonly");?>

<?=$form->text(translate_text("Khuyến mại"),"khuyen_mai","khuyen_mai",$khuyen_mai,translate_text("Khuyến mại"),1,250,"",255);?>

<?=$form->text(translate_text("Thời gian"),"thoi_gian","thoi_gian",$thoi_gian,translate_text("thời gian"),1,250,"",255);?>

<?=$form->radio("Sau khi lưu dữ liệu", "return_listing", "after_save_data",$listing , $after_save_data, "Quay về danh sách", 0, "");?>
<?=$form->button("submit" . $form->ec . "reset", "submit" . $form->ec . "reset", "submit" . $form->ec . "reset", "Cập nhật" . $form->ec . "Làm lại", "Cập nhật" . $form->ec . "Làm lại", 'style="background:url(' . $fs_imagepath . 'button_1.gif) no-repeat; border:none;"' . $form->ec . 'style="background:url(' . $fs_imagepath . 'button_2.gif) no-repeat; border:none;"', "");?><br />
<?=$form->hidden("action", "action", "submitForm", "");?>
<?
$form->close_table();
$form->close_form();
unset($form);
?>
<? /*------------------------------------------------------------------------------------------------*/ ?>
<?=template_bottom() ?>
<? /*------------------------------------------------------------------------------------------------*/ ?>
</body>
</html>