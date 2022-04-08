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
$new_category_id  = getValue("new_category_id", "int", "POST", 0);

//Lay loai modul
$queryCat   = "SELECT * FROM categories_multi WHERE cat_id = " . intval($new_category_id);
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
$myform->add("usc_email","usc_email",0, 0,"",1,"Bạn chưa nhập email",0,"Email đã được sử dụng");
$myform->add("usc_company","usc_company",0, 0,"",1,"Bạn chưa nhập tên công ty",0,"Tên công ty đã tồn tại");
$myform->add("usc_phone","usc_phone",0, 0,"",1,"Bạn chưa nhập hotline",0,"");
$myform->add("usc_website","usc_website",0, 0,"",0,"Bạn chưa nhập website công ty",0,"Website đã tồn tại");
$myform->add("usc_address","usc_address",0, 0,"",1,"Bạn chưa nhập địa chỉ công ty",0);
$myform->add("usc_size","usc_size",0, 0,"",0,"Bạn chưa chọn quy mô công ty",0);

#+
#+ đổi tên trường thành biến và giá trị
$myform->evaluate();
$myform1 = new generate_form();	//Call Class generate_form();
$myform1->removeHTML(0);	//Loại bỏ chức năng không cho điền tag html trong form
#+
#+ Khai bao bang du lieu
$myform1->addTable("user_company_multi");	// Add table
$myform1->add("usc_company_info","usc_company_info",0, 0,"",1,"Bạn chưa nhập giới thiệu công ty",0);
$myform1->evaluate();
#+
#+ Neu nhu co submit form
if($action == "submitForm"){
	if($array_config["image"]==1){
		$upload_pic = new upload("usc_logo", $fs_filepath, $extension_list, $limit_size);
		if ($upload_pic->file_name != ""){
			$picture = date("Y",time())."/".date("m",time())."/".date("d",time())."/".$upload_pic->file_name;
			resize_image($fs_filepath,$upload_pic->file_name,177,130,100,"");
         $usc_logo = $upload_pic->file_name;
         $myform->add("usc_logo",'usc_logo',0,1,"",0,"Bạn chưa chọn logo",0,"");
		}
		//Check Error!
	}
   if(!isValidEmail($usc_email))
   {
      $errorMsg .= "• Email nhập sai định dạng<br/>";
   }
	#+
	#+ Kiểm tra lỗi
    $errorMsg .= $myform->checkdata();
	$errorMsg .= $myform->strErrorField ;	//Check Error!
   $errorMsg .= $myform1->checkdata();
	$errorMsg .= $myform1->strErrorField ;	//Check Error!
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
$query2 = new db_query("SELECT * FROM user_company_multi WHERE usc_id = " . $record_id."");
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
<?=$form->text("Email công ty","usc_email","usc_email",$usc_email,"Email công ty",1,500,"",255)?>
<?=$form->text("Tên công ty","usc_company","usc_company",$usc_company,"Tên công ty",1,500,"",255)?>
<?=$form->text("Số điện thoại","usc_phone","usc_phone",$usc_phone,"Số điện thoại",1,500,"",255)?>
<?=$form->text("Website","usc_website","usc_website",$usc_website,"Website",0,500,"",255)?>
<?=$form->textarea("Địa chỉ công ty", "usc_address", "usc_address", $usc_address, "Địa chỉ công ty", 1, 600, 60, "", "", "")?>
<?=$form->getFile("Logo công ty", "usc_logo", "usc_logo", "Logo công ty",0, 32, "", '<font color="red">(Kích thước chuẩn 190 x 190)</font>')?>
<script src="jquery.form.js"></script>
<tr>
    <td class="form_name">Quy mô công ty</td>
    <td class="form_text">
        <select name="usc_size" id="usc_size" class="form_control">
        	<option value="">Chọn quy mô</option>
         <option value="1" <?=($usc_size == 1)?'selected="selected"':''?>>Dưới 20 nhân viên</option>
         <option value="2" <?=($usc_size == 2)?'selected="selected"':''?>>20 - 50 nhân viên</option>
         <option value="3" <?=($usc_size == 3)?'selected="selected"':''?>>50 - 100 nhân viên</option>
         <option value="4" <?=($usc_size == 4)?'selected="selected"':''?>>100 - 300 nhân viên</option>
         <option value="5" <?=($usc_size == 5)?'selected="selected"':''?>>300 - 1000 nhân viên</option>
         <option value="6" <?=($usc_size == 6)?'selected="selected"':''?>>1000 - 3000 nhân viên</option>
         <option value="7" <?=($usc_size == 7)?'selected="súelected"':''?>>Trên 3000 nhân viên</option>
        </select>
    </td>
</tr>
<?=$form->close_table();?>
<?=$form->wysiwyg("Mô tả công ty", "usc_company_info", $rows['usc_company_info'], "../../resource/ckeditor/", "50%","600")?>
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