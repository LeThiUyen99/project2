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
 // End if($cat_name_rewrite == ''){
	
#+
#+ Array category	
$menu 				= new menu();
$listAll 			= $menu->getAllRecodeNew("faqs","FaqID","",0,"1=1" ,"*","FaqID ASC");//getAllChild("categories_multi","cat_id","cat_parent_id","0",$sql." AND lang_id = " . $lang_id . $sqlcategory,"cat_id,cat_name,cat_order,cat_type,cat_parent_id,cat_has_child","cat_type, cat_order ASC, cat_name ASC","cat_has_child");


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
$myform->add("Question","Question",0,0,"",1,translate_text("Vui lòng nhập tiêu đề câu hỏi"),0,"");
$myform->add("Answer","Answer",0,0,"",1,translate_text("Vui lòng nhập trả lời tóm tắt"),0,"");
$myform->add("FullAnswer","FullAnswer",0,0,"",1,translate_text("Vui lòng nhập nội dung trả lời"),0,"");
$myform->add("CreateUser","CreateUser",0,0,"",0,translate_text("Vui lòng nhập user"),0,"");
$myform->add("CreateDate","CreateDate",0,0,"",1,translate_text("Vui lòng nhập ngày tạo"),0,"");
$myform->add("MetaKeyword","MetaKeyword",0,0,"",0,translate_text("Vui lòng nhập Meta"),0,"");
$myform->add("MetaDescription","MetaDescription",0,0,"",1,translate_text("Vui lòng nhập meta desc"),0,"");
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


<?=$form->text(translate_text("Tiêu đề câu hỏi"),"Title","Title",$Title,translate_text("name"),1,250,"",255)?>


<? 
echo $form->text(translate_text("Nội dung câu hỏi"),"Question","Question",$Question,translate_text("name"),1,250,"",255);
$form->close_table();
$form->create_table();
echo $form->wysiwyg("Trả lời ngắn", "Answer", $Answer, "../../resource/ckeditor/", "99%", 300);
$form->close_table();
$form->create_table();
echo $form->wysiwyg("Trả lời đầy đủ", "FullAnswer", $FullAnswer, "../../resource/ckeditor/", "99%", 300);
$form->close_table();
$form->create_table();
echo $form->hidden("CreateUser", "CreateUser", "1", "");
echo $form->textarea("MetaKeyword", "MetaKeyword", "MetaKeyword", $MetaKeyword, "MetaKeyword", 0, 600, 120, "", "", "");
echo $form->textarea("MetaDescription", "MetaDescription", "MetaDescription", $MetaDescription, "MetaDescription", 0, 600, 120, "", "", "");
echo $form->text("Ngày tạo", "CreateDate", "CreateDate", $CreateDate, "Ngày (dd/mm/yyyy)", 0, 100, 20, 10 , " - ", 0, "&nbsp; <i>(Ví dụ: yyyy-mm-dd)</i>");

?>
<?=$form->radio("Sau khi lưu dữ liệu", "add_new" . $form->ec . "return_listing" . $form->ec . "return_edit", "after_save_data", $add . $form->ec . $listing . $form->ec . $edit, $after_save_data, "Thêm mới" . $form->ec . "Quay về danh sách" . $form->ec . "Sửa bản ghi", 0, "" . $form->ec . "" . $form->ec . "");?>
<?=$form->button("submit" . $form->ec . "reset", "submit" . $form->ec . "reset", "submit" . $form->ec . "reset", "Cập nhật" . $form->ec . "Làm lại", "Cập nhật" . $form->ec . "Làm lại", 'style="background:url(' . $fs_imagepath . 'button_1.gif) no-repeat; border:none;"' . $form->ec . 'style="background:url(' . $fs_imagepath . 'button_2.gif) no-repeat; border:none;"', "");?><br />
<?=$form->hidden("action", "action", "submitForm", "");?>
<?
$form->close_table();
$form->close_form();
unset($form);
?>
<script>
    $(document).ready(function () {
      $('#CreateDate').datepicker({
				format: 'yyyy-mm-dd',
                todayBtn: 'linked'
			});
    });
</script>
<? /*------------------------------------------------------------------------------------------------*/ ?>
<?=template_bottom() ?>
<? /*------------------------------------------------------------------------------------------------*/ ?>
</body>
</html>