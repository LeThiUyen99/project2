<style>
#cke_new_description
{
   width: 80%;
   margin: 0 auto;
   position: relative;
   top: -15px;
}
</style>
<?php
require_once("inc_security.php");
function removeTitle($string,$keyReplace){
	$string		= html_entity_decode($string, ENT_COMPAT, 'UTF-8');
	$string		= mb_strtolower($string, 'UTF-8');
	$string		= removeAccent($string);
	//neu muon de co dau
	//$string 	=  trim(preg_replace("/[^A-Za-z0-9àáạảãâầấậẩẫăằắặẳẵèéẹẻẽêềếệểễìíịỉĩòóọỏõôồốộổỗơờớợởỡùúụủũưừứựửữỳýỵỷỹđÀÁẠẢÃÂẦẤẬẨẪĂẰẮẶẲẴÈÉẸẺẼÊỀẾỆỂỄÌÍỊỈĨÒÓỌỎÕÔỒỐỘỔỖƠỜỚỢỞỠÙÚỤỦŨƯỪỨỰỬỮỲÝỴỶỸ]/i"," ",$string));

	$string 	= trim(preg_replace("/[^A-Za-z0-9]/i"," ",$string));
    // khong dau
	$string 	= str_replace(" ","-",$string);
	$string		= str_replace("--","-",$string);
	$string		= str_replace("--","-",$string);
	$string		= str_replace("--","-",$string);
	$string		= str_replace($keyReplace,"-",$string);
	return $string;
}
function tt($variable){
	return "" . $variable . "";
}
#+
#+ Kiem tra quyen them sua xoa
checkAddEdit("add");

#+
#+ Khai bao bien
$add				= "add.php";
$listing			= "listing.php";
$edit				= "edit.php";
$after_save_data	= getValue("after_save_data", "str", "POST", $listing);

$errorMsg 			= "";		//Warning Error!
$action				= getValue("action", "str", "POST", "");
$fs_action			= getURL();
$record_id			= getValue("record_id");

$admin_id         = getValue("admin_id","int","SESSION");

$new_strdate		= getValue("new_strdate", "str", "POST", date("d/m/Y"));
$new_strtime		= getValue("new_strtime", "str", "POST", date("H:i:s"));
$new_date_last_edit    = convertDateTime($new_strdate, $new_strtime);

$new_strdateht		= getValue("new_strdateht", "str", "POST", date("d/m/Y"));
$new_strtimeht		= getValue("new_strtimeht", "str", "POST", date("H:i:s"));
$new_hantuyen		= convertDateTime($new_strdateht, $new_strtimeht);

#+
$new_title_rewrite 	= getValue("new_title_rewrite", "str", "POST", "");
if($new_title_rewrite == ''){
	$new_title_rewrite 	= removeTitle(getValue("new_title", "str", "POST", ""),'/');
	$new_title_rewrite 	= strtolower($new_title_rewrite);
} // End if($new_title_rewrite == ''){

$new_category_id  = getValue("new_category_id", "int", "POST", 0);

//Lay loai modul
$queryCat   = "SELECT * FROM newstable WHERE Id = " . intval($new_category_id);
$dbCat      = new db_query($queryCat);
$new_module_id = 1;
if($row = mysql_fetch_assoc($dbCat->result)){
      $new_module_id = $row['cat_type'];

}

#+
#+ Array Category
$menu 	= new menu();
$listAll = $menu->getAllRecodeNew("newstable","Id","",0,"1=1" ,"*","Id ASC");

#+
#+ Goi class generate form
$myform = new generate_form();	//Call Class generate_form();
$myform->removeHTML(0);	//Loại bỏ chức năng không cho điền tag html trong form
#+
#+ Khai bao bang du lieu
$myform->addTable($fs_table);	// Add table
#+
#+ Khai bao thong tin cac truong
$myform->add("Title","Title",0,0,"",1,translate_text("Vui lòng nhập tên tiêu đề"),0,"");
$myform->add("Type", "Type", 1, 0, 0, 1, "Loại tin", 0, "");
$myform->add("CreateDate","CreateDate",0, 0,"",1,"Ngày tạo",0,"");
$myform->add("MetaDesc","MetaDesc",0, 0,"",1,"bạn chưa nhập",0,"");
$myform->add("ImageUrl","ImageUrl",0,0,"",0,"",0,"");
$myform->add("Meta","Meta",0,0,"",1,"Bạn chưa keyword",0,"");
$myform->add("Description","Description",0,0,"",0,"",0,"");
$myform->add("PublicDate","PublicDate",0,0,"",1,"Ngày sửa",0,"");
$myform->add("SortOder","SortOder",1,0,0,0,"",0,"");
$myform->add("CreateUser","CreateUser",1,0,0,0,"",0,"");
$myform->add("IsActive", "IsActive", 1, 0, 1, 0, "", 0, "");

#+
#+ đổi tên trường thành biến và giá trị
$myform->evaluate();

#+
#+ Neu nhu co submit form
if($action == "submitForm"){

	if($array_config["image"]==1){
		$upload_pic = new upload("picture", $fs_filepath, $extension_list, $limit_size);
		if ($upload_pic->file_name != ""){
			$picture = $picture = date("Y",time())."/".date("m",time())."/".date("d",time())."/".$upload_pic->file_name;
			$myform->add("new_picture","picture",0,1,"",0,"",0,"");
		}
		//Check Error!
		$errorMsg .= $upload_pic->show_warning_error();
	}

	#+
	#+ Kiểm tra lỗi
    $errorMsg .= $myform->checkdata();
	$errorMsg .= $myform->strErrorField ;	//Check Error!

	if($errorMsg == ""){

		#+
		#+ Thuc hien query
		$query = $myform->generate_update_SQL($field_id,$record_id);
		$db_ex = new db_execute($query);

		$fs_redirect 	= $after_save_data. "?record_id=".$record_id."&category=".getValue("new_category_id","int","POST");
      redirect($fs_redirect);
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


?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN" "http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<?=$load_header?>
<script type="text/javascript" src="/admin/resource/ckeditor/ckeditor.js?t=D03G5XL"></script>
</head>
<body topmargin="0" bottommargin="0" leftmargin="0" rightmargin="0">
<? /*------------------------------------------------------------------------------------------------*/ ?>
<?=template_top(translate_text("Records Add"))?>
<? /*------------------------------------------------------------------------------------------------*/ ?>
<script src="/js/jquery-1.9.1.js"></script>
<script src="/js/bootstrap.min.js"></script> 

<link rel="stylesheet" type="text/css" href="/css/bootstrap.css" />
<script src="/Assets/js/bootstrap-datepicker.js"></script>
<link rel="stylesheet" type="text/css" href="/Assets/css/datepicker.css" />
<?
$form = new form();
$form->create_form("form_name",$fs_action,"post","multipart/form-data",'onsubmit="validateForm();return false;"  id="form_name" ');
$form->create_table();
?>
<?=$form->text_note('Những ô dấu sao (<font class="form_asterisk">*</font>) là bắt buộc phải nhập.')?>
<?=$form->errorMsg($errorMsg)?>

<?=$form->text("Tiêu đề tin","Title","Title",$Title,"Tiêu đề tin",1,500,"",255)?>
<?=$form->text("Loại tin","Type","Type",$Type,"Loại tin",1,500,"",255)?>

<?=$form->getFile("Ảnh minh họa", "ImageUrl", "ImageUrl", "Ảnh minh họa", 0, 32, "", '<br />(Dung lượng tối đa <font color="#FF0000">'.$limit_size.' Kb</font>)')?>
<?=$form->close_table();?>
<?=$form->wysiwyg("Tóm tắt", "Description", $Description, "../../resource/ckeditor/", "80%","600")?>
<?=$form->create_table();?>

<?=$form->text("Ngày Sửa", "PublicDate" . $form->ec . "CreateDate", "PublicDate" . $form->ec . "CreateDate", $CreateDate . $form->ec . $CreateDate, "Ngày (yyyy-mm-dd)" . $form->ec . "Giờ (hh:mm:ss)", 0, 70 . $form->ec . 70, $form->ec, 10 . $form->ec . 10, " - ", $form->ec, "&nbsp; <i>(Ví dụ: yyyy-mm-dd)</i>");?>
<?=$form->checkbox("Kích hoạt", "IsActive", "IsActive"."IsActive", "1", $IsActive, "Kích hoạt", "0", "", "")?>
<?=$form->close_table();?>
<?=$form->create_table();?>
<?=$form->hidden("SortOder", "SortOder", "1", "");?>
<?=$form->hidden("CreateUser", "CreateUser", "1", "");?>
<?=$form->textarea("Meta", "Meta", "Meta", $Meta, "Meta", 0, 600, 120, "", "", "")?>
<?=$form->textarea("MetaDesc", "MetaDesc", "MetaDesc", $MetaDesc, "MetaDesc", 0, 600, 120, "", "", "")?>
<?=$form->radio("Sau khi lưu dữ liệu", "add_new" . $form->ec . "return_listing" . $form->ec . "return_edit", "after_save_data", $add . $form->ec . $listing . $form->ec . $edit, $after_save_data, "Thêm mới" . $form->ec . "Quay về danh sách" . $form->ec . "Sửa bản ghi", 0, "" . $form->ec . "" . $form->ec . "");?>
<?=$form->button("submit" . $form->ec . "reset", "submit" . $form->ec . "reset", "submit" . $form->ec . "reset", "Cập nhật" . $form->ec . "Làm lại", "Cập nhật" . $form->ec . "Làm lại", 'style="background:url(' . $fs_imagepath . 'button_1.gif) no-repeat; border:none;"' . $form->ec . 'style="background:url(' . $fs_imagepath . 'button_2.gif) no-repeat; border:none;"', "");?><br />
<?=$form->hidden("action", "action", "submitForm", "");?>
<?
$form->close_table();
$form->close_form();
unset($form);
?>
<? /*------------------------------------------------------------------------------------------------*/ ?>
<script>
    $(document).ready(function () {
      $('#CreateDate').datepicker({
				format: 'yyyy-mm-dd',
                todayBtn: 'linked'
			});
            $('#PublicDate').datepicker({
				format: 'yyyy-mm-dd',
                todayBtn: 'linked'
			});
            
    });
</script>
<?=template_bottom() ?>
<? /*------------------------------------------------------------------------------------------------*/ ?>
</body>
</html>