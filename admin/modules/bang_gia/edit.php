<style>
#cke_1_contents
{
   height: 350px!important;
}
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
function isValidEmail($email) {
    return filter_var($email, FILTER_VALIDATE_EMAIL) 
        && preg_match('/@.+\./', $email);
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
$bg_id  = getValue("bg_id", "int", "POST", 0);

//Lay loai modul
$queryCat   = "SELECT * FROM bang_gia WHERE bg_id = " . intval($bg_id);
$dbCat      = new db_query($queryCat);
$new_module_id = 1;
if($row = mysql_fetch_assoc($dbCat->result)){
      $new_module_id = $row['cat_type'];

}
#+
#+ Goi class generate form
$myform = new generate_form();	//Call Class generate_form();
$myform->removeHTML(0);	//Loại bỏ chức năng không cho điền tag html trong form
#+
#+ Khai bao bang du lieu
$myform->addTable($fs_table);	// Add table
#+
#+ Khai bao thong tin cac truong
$myform->add("dt","dt",0, 0,"",1,"Bạn chưa nhập giá đăng tin",0);
$myform->add("dt_VAT","dt_VAT",0, 0,"",1,"Bạn chưa nhập giá đăng tin có VAT",0);
$myform->add("cam_ket","cam_ket",0, 0,"",1,"Bạn chưa nhập cam kết hồ sơ",0);
$myform->add("ghim_tin","ghim_tin",0, 0,"",0,"Bạn chưa nhập vị trí ghim tin",0);
$myform->add("banthe24h","banthe24h",0, 0,"",1,"Bạn chưa nhập banthe24h.vn",0);
$myform->add("class","class",0, 0,"",1,"Bạn chưa chọn kiểu tuyển dụng",0);

#+
#+ đổi tên trường thành biến và giá trị
$myform->evaluate();

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
      $db_ex = new db_execute("UPDATE user_company_multi SET usc_company_info = '".mysql_escape_string($usc_company_info)."' WHERE usc_id = '".$record_id."'");
		$fs_redirect 	= $after_save_data. "?record_id=".$record_id;
       
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
$query2 = new db_query("SELECT * FROM bang_gia WHERE bg_id = " . $record_id."");
$rows = mysql_fetch_assoc($query2->result);
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
#+ Array Category
$menu 	= new menu();
$listAll = $menu->getAllChild("categories_multi","cat_id","cat_parent_id","0","cat_type IN(".$cat_type_select.")","cat_id,cat_name,cat_order,cat_type,cat_parent_id,cat_has_child","cat_type, cat_order ASC, cat_name ASC","cat_has_child");
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN" "http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
<?=$load_header?>
<script type="text/javascript" src="/admin/resource/ckeditor/ckeditor.js?t=D03G5XL"></script>
</head>
<body topmargin="0" bottommargin="0" leftmargin="0" rightmargin="0">
<? /*------------------------------------------------------------------------------------------------*/ ?>
<?=template_top(translate_text("Records Add"))?>
<? /*------------------------------------------------------------------------------------------------*/ ?>
<?
$form = new form();
$form->create_form("form_name",$fs_action,"post","multipart/form-data",'onsubmit="validateForm();return false;"  id="form_name" ');
$form->create_table();
?>
<?=$form->text_note('Những ô dấu sao (<font class="form_asterisk">*</font>) là bắt buộc phải nhập.')?>
<?=$form->errorMsg($errorMsg)?>
<?=$form->text("Đăng tin chưa VAT","dt","dt",$dt,"Đăng tin chưa VAT",1,500,"",500)?>
<?=$form->text("Đăng tin có VAT","dt_VAT","dt_VAT",$dt_VAT,"Tên công ty",1,500,"",500)?>
<?=$form->textarea("Cam kết hồ sơ", "cam_ket", "cam_ket", $cam_ket, "Cam kết hồ sơ", 1, 600, 60, "", "", "")?>
<?=$form->textarea("Vị trí ghim tin", "ghim_tin", "ghim_tin", $ghim_tin, "Vị trí ghim tin", 1, 600, 60, "", "", "")?>
<?=$form->textarea("Banthe24h.vn", "banthe24h", "banthe24h", $banthe24h, "Banthe24h.vn", 1, 600, 60, "", "", "")?>

<script src="jquery.form.js"></script>
<tr>
    <td class="form_name"><font class="form_asterisk">* </font>Kiểu tuyển dụng</td>
    <td class="form_text">
        <select name="class" id="class" class="form_control">
        	<option value="">Chọn kiểu tuyển dụng</option>
         <option value="tdg" <?=($class == 'tdg')?'selected="selected"':''?>>Tuyển Dụng Gấp</option>
         <option value="tdn" <?=($class == 'tdn')?'selected="selected"':''?>>Tuyển Dụng Nhanh Nhất</option>
         <option value="tdf" <?=($class == 'tdf')?'selected="selected"':''?>>Tuyển Dụng Miến Phí</option>
        </select>
    </td>
</tr>
<?=$form->close_table();?>

<?=$form->create_table();?>

<?=$form->radio("Sau khi lưu dữ liệu", "add_new" . $form->ec . "return_listing" . $form->ec . "return_edit", "after_save_data", $add . $form->ec . $listing . $form->ec . $edit, $after_save_data, "Thêm mới" . $form->ec . "Quay về danh sách" . $form->ec . "Sửa bản ghi", 0, "" . $form->ec . "" . $form->ec . "");?>
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