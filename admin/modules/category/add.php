<? 
require_once("inc_security.php");

#+
#+ Kiem tra quyen them sua xoa
checkAddEdit("add");
function removeTitle($string,$keyReplace){
	$string		= html_entity_decode($string, ENT_COMPAT, 'UTF-8');
	$string		= mb_strtolower($string, 'UTF-8');
	$string		= removeAccent($string);
	//neu muon de co dau
	//$string 	=  trim(preg_replace("/[^A-Za-z0-9àáạảãâầấậẩẫăằắặẳẵèéẹẻẽêềếệểễìíịỉĩòóọỏõôồốộổỗơờớợởỡùúụủũưừứựửữỳýỵỷỹđÀÁẠẢÃÂẦẤẬẨẪĂẰẮẶẲẴÈÉẸẺẼÊỀẾỆỂỄÌÍỊỈĨÒÓỌỎÕÔỒỐỘỔỖƠỜỚỢỞỠÙÚỤỦŨƯỪỨỰỬỮỲÝỴỶỸ]/i"," ",$string));

	$string 	= trim(preg_replace("/[^A-Za-z0-9]/i"," ",$string)); // khong dau
	$string 	= str_replace(" ","-",$string);
	$string		= str_replace("--","-",$string);
	$string		= str_replace("--","-",$string);
	$string		= str_replace("--","-",$string);
	$string		= str_replace($keyReplace,"-",$string);
	return $string;
}

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

$cat_type			= getValue("cat_type","str","GET","");
if($cat_type=="") $cat_type=getValue("cat_type","str","POST","");
$sql				= "1";
if($cat_type!="") $sql=" cat_type = '" . $cat_type . "'";

#+
$cat_name_rewrite 	= getValue("cat_name_rewrite", "str", "POST", "");
if($cat_name_rewrite == ''){
	$cat_name_rewrite 	= removeTitle(getValue("cat_name", "str", "POST", ""),'/');
	$cat_name_rewrite 	= strtolower($cat_name_rewrite);
} // End if($cat_name_rewrite == ''){
	
#+
#+ Array category	
$menu 				= new menu();
$listAll 			= $menu->getAllRecodeNew("categories","CategoryID","",0,"Status >=0" ,"CategoryID,CategoryName,Description,Status,Code,Meta,MetaDesc","CategoryID ASC");//getAllChild("categories_multi","cat_id","cat_parent_id","0",$sql." AND lang_id = " . $lang_id . $sqlcategory,"cat_id,cat_name,cat_order,cat_type,cat_parent_id,cat_has_child","cat_type, cat_order ASC, cat_name ASC","cat_has_child");


#+
#+ Goi class generate form
$myform = new generate_form();	//Call Class generate_form();
$myform->removeHTML(0);	//Loại bỏ chức năng không cho điền tag html trong form
#+
#+ Khai bao bang du lieu
$myform->addTable($fs_table);	// Add table
#+
#+ Khai bao thong tin cac truong
$myform->add("CategoryName","CategoryName",0,0,"",1,translate_text("Vui lòng nhập tên danh mục"),0,"");
$myform->add("Status","Status",0,0,"",1,translate_text("Trạng thái"),0,"");
$myform->add("Description","Description",0,0,"",1,translate_text("Vui lòng nhập mô tả cho danh mục"),0,"");
$myform->add("Code","Code",0,0,"",1,translate_text("Vui lòng nhập code danh mục"),0,"");
$myform->add("Meta","Meta",0,0,"",0,translate_text("Vui lòng nhập keyword"),0,"");
$myform->add("MetaDesc","MetaDesc",0,0,"",1,translate_text("Vui lòng nhập medesc"),0,"");
#+
#+ đổi tên trường thành biến và giá trị
$myform->evaluate();

#+
#+ Neu nhu co submit form
if($action == "submitForm"){
	
	if($array_config["image"]==1){
		$upload_pic = new upload("picture", $fs_filepath, $extension_list, $limit_size);
		if ($upload_pic->file_name != ""){
			$picture = $upload_pic->file_name;
			//resize_image($fs_filepath,$upload_pic->file_name,100,100,75);
			$myform->add("cat_picture","picture",0,1,"",0,"",0,"");
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
		$db_ex	 		= new db_execute_return();
		$query			= $myform->generate_insert_SQL();
		$last_id 		= $db_ex->db_execute($query);
		$record_id 		= $last_id;
		//echo $query;exit();

		$iParent = getValue("cat_parent_id","int","POST");
		if($iParent > 0){
			$db_ex = new db_execute("UPDATE categories_multi SET cat_has_child = 1 WHERE cat_id = " . $iParent);
		}

		#+
		#+ Chuyen ve trang khac khi xu ly du lieu oki
		redirect($after_save_data."?record_id=".$record_id."&iParent=" . $iParent . "&cat_type=" . getValue("cat_type","str","POST") . "&cat_order=" . getValue("cat_order","int","POST"));
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
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN" "http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<?=$load_header?>
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

<?=$form->text(translate_text("Tên danh mục"),"CategoryName","CategoryName",$CategoryName,translate_text("Tên danh mục"),1,300,"",255)?>
<? 
echo $form->text(translate_text("Code"),"Code","Code",$Code,translate_text("name"),1,250,"",255);
$form->close_table();
$form->create_table();
echo $form->wysiwyg("Mô tả chi tiết", "Description", $Description, "../../resource/ckeditor/", "99%", 300);
$form->close_table();
$form->create_table();
echo $form->checkbox("Trạng thái", "Status", "Status", "1", $Status, "Kích hoạt", "0", "", "");
echo $form->textarea(translate_text("Keyword"), "Meta", "Meta", $Meta, translate_text("Keyword"), 1, 600, 100, "", "", "");
echo $form->textarea("Meta desc", "MetaDesc", "MetaDesc", $MetaDesc, translate_text("Metadesc"), 0, 600, 200, "", "", "");

// if($array_config["upper"]==1) echo $form->select_db_multi(translate_text("upper"), "cat_parent_id", "cat_parent_id", $listAll, "cat_id", "cat_name", $cat_parent_id, translate_text("upper"), "1", "200");
?>

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