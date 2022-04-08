
<?
require_once("inc_security_bm.php");
function removeTitle($string,$keyReplace){
	$string		= html_entity_decode($string, ENT_COMPAT, 'UTF-8');
	$string		= mb_strtolower($string, 'UTF-8');
	$string		= removeAccent($string);

	$string 	= trim(preg_replace("/[^A-Za-z0-9]/i"," ",$string)); // khong dau
	$string 	= str_replace(" ","-",$string);
	$string		= str_replace("--","-",$string);
	$string		= str_replace("--","-",$string);
	$string		= str_replace("--","-",$string);
	$string		= str_replace($keyReplace,"-",$string);
	return $string;
}
function isValidEmail($email) {
    return filter_var($email, FILTER_VALIDATE_EMAIL) 
        && preg_match('/@.+\./', $email);
}
function tt($variable){
	return "" . $variable . "";
}
#+
#+ Kiem tra quyen them sua xoa
checkAddEdit("add");

#+
#+ Khai bao bien
$add              = "add_bm.php";
$listing          = "listing_bm.php";
$edit				   = "edit_bm.php";
$after_save_data	= getValue("after_save_data", "str", "POST", $add);

$admin_id         = getValue("admin_id","int","SESSION");

$errorMsg 			= "";		//Warning Error!
$action				= getValue("action", "str", "POST", "");
$fs_action			= getURL();
$record_id			= getValue("record_id");

$new_strdate		= getValue("new_strdate", "str", "POST", date("d/m/Y"));
$new_strtime		= getValue("new_strtime", "str", "POST", date("H:i:s"));
$new_date			= convertDateTime($new_strdate, $new_strtime);
$new_date_last_edit = convertDateTime($new_strdate, $new_strtime);

$new_strdateht		= getValue("new_strdateht", "str", "POST", date("d/m/Y"));
$new_strtimeht		= getValue("new_strtimeht", "str", "POST", date("H:i:s"));
$new_hantuyen		= convertDateTime($new_strdateht, $new_strtimeht);
$usc_create_time = time();
$usc_pass = md5('timviec365.vn');
//Lay loai modul
$new_module_id = 1;

#+
#+ Goi class generate form
$myform = new generate_form();	//Call Class generate_form();
$myform->removeHTML(0);	//Loại bỏ chức năng không cho điền tag html trong form
#+
#+ Khai bao bang du lieu
$myform->addTable($fs_table);	// Add table
#+
#+ Khai bao thong tin cac truong
$myform->add("bmn_name","bmn_name",0, 0,"",1,"Bạn chưa nhập tên tag",0,"");
$myform->add("bmn_cate_id","bmn_cate_id",0, 0,"",1,"Bạn chưa chọn danh mục biểu mẫu",0,"");
$myform->add("bmn_teaser","bmn_teaser",0, 0,"",1,"Bạn chưa nhập mô tả bài viết",0,"");
$myform->add("bmn_description","bmn_description",0, 0,"",1,"Bạn chưa nhập chi tiết bài viết",0,"");
$myform->add("bmn_time","bmn_time",0, 0,"",0,"",0,"");



#+
#+ đổi tên trường thành biến và giá trị
$myform->evaluate();
$myform1 = new generate_form();	//Call Class generate_form();
$myform1->removeHTML(0);	//Loại bỏ chức năng không cho điền tag html trong form

#+ Neu nhu co submit form
if($action == "submitForm"){


   if($array_config["image"]==1){
		$upload_pic = new upload("bmn_avatar", $fs_filepath, $extension_list, $limit_size);
		if ($upload_pic->file_name != ""){
			$bmn_avatar = date("Y",time())."/".date("m",time())."/".date("d",time())."/".$upload_pic->file_name;
			$myform->add("bmn_avatar","bmn_avatar",0, 1,"",0,"",0,"");
		}
      else
      {
         $errorMsg .= "• Bạn chưa chọn file tải lên";
      }
	}

   	$errorMsg .= $myform->checkdata();
	$errorMsg .= $myform->strErrorField ;	//Check Error!
   
	if($errorMsg == ""){
      
		#+
		#+ Thuc hien query
		$db_ex	 		= new db_execute_return();
		$query			= $myform->generate_insert_SQL();

		$last_id 		= $db_ex->db_execute($query);
		$record_id 		= $last_id;

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
<br/>


<?=$form->text("Nhập tiêu đề biểu mẫu","bmn_name","bmn_name",$bmn_name,"tiêu đề biểu mẫu",1,500,"",255)?>
<script src="jquery.form.js"></script>

<tr>
    <td class="form_name"><font class="form_asterisk">* </font>Danh mục biểu mẫu</td>
    <td class="form_text">
        <select name="bmn_cate_id" id="bmn_cate_id" class="form_control" style="width:250px">
        	<option value="">Chọn danh mục</option>
         <?
         $db_bm = new db_query("SELECT * FROM bieu_mau ORDER BY bm_id DESC");
         While($rowbm = mysql_fetch_assoc($db_bm->result))
         {
         ?>
         <option value="<?= $rowbm['bm_id'] ?>" <?=($bmn_cate_id == $rowbm['bm_id'])?'selected="selected"':''?>><?= $rowbm['bm_cate'] ?></option>
         <?
         }
         ?>
        </select>
    </td>
</tr>

<input name="bmn_time" id="bmn_time" value="<?=time() ?>" style='display: none;' >

<?=$form->getFile("Ảnh đại diện", "bmn_avatar", "bmn_avatar", "Biểu mẫu", 0, 32, "", '<br />(Dung lượng tối đa <font color="#FF0000">'.$limit_size.' Kb</font>)')?>

<?=$form->textarea("Mô tả bài viết", "bmn_teaser", "bmn_teaser", $bmn_teaser, "nhập mô tả cho bài viết", 1, 600, 100, "", "", "")?>

<?=$form->close_table();?>
<?=$form->wysiwyg("Chi tiết bài viết", "bmn_description", $bmn_description, "../../resource/ckeditor/", "50%","600")?>
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