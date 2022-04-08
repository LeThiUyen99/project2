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

$new_strdate		= getValue("CreateDate", "str", "POST", date("Y-m-d H:i:s"));
$new_strtime		= getValue("new_strtime", "str", "POST", date("H:i:s"));
$new_date_last_edit    = convertDateTime($new_strdate, $new_strtime);

$new_strdateht		= getValue("new_strdateht", "str", "POST", date("d/m/Y"));
$new_strtimeht		= getValue("new_strtimeht", "str", "POST", date("H:i:s"));
$new_hantuyen		= convertDateTime($new_strdateht, $new_strtimeht);

#+
$new_title_rewrite 	= getValue("ShortTitle", "str", "POST", "");
if($new_title_rewrite == ''){
	$new_title_rewrite 	= removeTitle(getValue("Title", "str", "POST", ""),'/');
	$new_title_rewrite 	= strtolower($new_title_rewrite);
} // End if($new_title_rewrite == ''){

$new_category_id  = getValue("categoryid", "int", "POST", 0);

//Lay loai modul
$queryCat   = "SELECT * FROM categories WHERE CategoryID >= 0 ORDER BY CategoryID DESC " ;//. intval($new_category_id);
$dbCat      = new db_query($queryCat);
$new_module_id = 1;
$listAllCat='';
while($rowcat = mysql_fetch_assoc($dbCat->result)) {
    $listAllCat[]=$rowcat;
    }
    //$listAllCat=json_decode($listAllCat,true);
if($row = mysql_fetch_assoc($dbCat->result)){
      $new_module_id = 23;//$row['cat_type'];

}

#+
#+ Array Category
$menu 	= new menu();
$listAll = $menu->getAllRecodeNewJoin("articles","Id","categories","CategoryID","a1.Id >=0" ,"a1.*,a2.CategoryName","Id ASC","categoryid");//getAllChild("categories_multi", "cat_id", "cat_parent_id", 0, "cat_active = 1 AND lang_id = " . $lang_id, "cat_id,cat_name,cat_type", "cat_order ASC,cat_name ASC", "cat_has_child", 0);

#+
#+ Goi class generate form
$myform = new generate_form();	//Call Class generate_form();
$myform->removeHTML(0);	//Loại bỏ chức năng không cho điền tag html trong form
#+
#+ Khai bao bang du lieu
$myform->addTable($fs_table);	// Add table
#+
#+ Khai bao thong tin cac truong
$myform->add("SortOder","SortOder",1,0,1,0,"",0,"");
$myform->add("categoryid", "categoryid", 1, 0, 0, 1, translate_text("Bạn chưa chọn danh mục"), 0, "");
$myform->add("Title","Title",0, 0,"",1,"Bạn chưa nhập tiêu đề tin",0,"");
$myform->add("ShortTitle","ShortTitle",0, 0,"",0," tieu de nga",0,"Tin này đã tồn tại trong CSDL");
//$myform->add("ImageUrl","ImageUrl",0,0,"",0,"",0,"");
$myform->add("Intro","Intro",0,0,"",0,"",0,"");
$myform->add("Meta","Meta",0,0,"",1,"Bạn chưa keyword",0,"");
$myform->add("MetaDesc","MetaDesc",0,0,"",1,"Bạn chưa meta desc",0,"");
$myform->add("CodeCat","CodeCat",0,0,"",1,"Bạn chưa Code cate",0,"");
$myform->add("Description","Description",0,0,"",0,"",0,"");
$myform->add("CreateDate","CreateDate",0, 0,"",1,"Ngày tạo",0,"");
$myform->add("PublicDate","PublicDate",0, 0,"",1,"Ngày sửa",0,"");
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
			$myform->add("ImageUrl","picture",0,1,"",0,"",0,"");
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
    if($row['CreateDate'] != ''){
        $new_strdate=date("Y-m-d H:i:s",strtotime(trim($row['CreateDate'])) );
    }
     if($row['PublicDate'] != ''){
        $new_strdate=date("Y-m-d H:i:s",strtotime(trim($row['PublicDate'])) );
    }
    if($row['categoryid'] !=''){
        $new_category_id=intval($row['categoryid']);
    }
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
<tr>
   <td class="form_name">
    	<font class="form_asterisk">* </font>Chọn danh mục
   </td>
    <td class="form_text">
        <select name="categoryid" id="categoryid" class="form_control">
        	<option value=""><?=tt("Chọn danh mục")?></option>
			<?
            foreach($listAllCat as $i=>$cat){
                ?>
                    <option value="<?=$cat["CategoryID"]?>" <?=$new_category_id == $cat["CategoryID"] ? 'selected' : '' ?> >
                    <?
                    
                    echo $cat["CategoryName"];
                    ?>
                    </option>
                <?
            }
            ?>
        </select>
    </td>
</tr>
<?=$form->text("Tiêu đề tin","Title","Title",$Title,"Tiêu đề tin",1,500,"",255)?>
<?=$form->text("Tiêu đề ngắn","ShortTitle","ShortTitle",$ShortTitle,"URL",1,500,"",255,"","")?>
<?=$form->getFile("Ảnh đại diện", "picture", "picture", "Ảnh minh họa", 0, 32, "", '<br />(Dung lượng tối đa <font color="#FF0000">'.$limit_size.' Kb</font>)')?>
<?=$form->close_table();?>
<?=$form->wysiwyg("Tóm tắt", "Intro", $Intro, "../../resource/ckeditor/", "80%","600")?>
<?=$form->create_table();?>
<?=$form->text("Ngày tạo", "CreateDate" . $form->ec . "PublicDate", "CreateDate" . $form->ec . "PublicDate", $new_strdate . $form->ec . $new_strdate, "Ngày (dd/mm/yyyy)" . $form->ec . "Giờ (hh:mm:ss)", 0, 70 . $form->ec . 70, $form->ec, 10 . $form->ec . 10, " - ", $form->ec, "&nbsp; <i>(Ví dụ: dd/mm/yyyy - hh:mm:ss)</i>");?>
<?=$form->checkbox("Loại bản ghi", "IsActive", "IsActive", "1", $IsActive, "Kích hoạt", "0", "", "")?>
<?=$form->hidden("CreateUser", "CreateUser", "1", "");?>
<?=$form->close_table();?>
<?=$form->wysiwyg("Mô tả chi tiết", "Description", $Description, "../../resource/ckeditor/", "99%", 300)?>
<?=$form->create_table();?>
<?=$form->hidden("SortOder", "SortOder", "1", "");?>
<?=$form->text("CatCode","CodeCat","CodeCat",$CodeCat,"CodeCat",1,500,"",255,"","")?>
<?=$form->textarea("Meta", "Meta", "Meta", $Meta, "Meta", 0, 600, 120, "", "", "")?>
<?=$form->textarea("MetaDesc", "MetaDesc", "MetaDesc", $MetaDesc, "MetaDesc", 0, 600, 120, "", "", "")?>
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