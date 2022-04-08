<? 
require_once("inc_security_tag.php");
function removeTitle($string,$keyReplace){
  $string   = html_entity_decode($string, ENT_COMPAT, 'UTF-8');
  $string   = mb_strtolower($string, 'UTF-8');
  $string   = removeAccent($string);
  //neu muon de co dau
  //$string   =  trim(preg_replace("/[^A-Za-z0-9àáạảãâầấậẩẫăằắặẳẵèéẹẻẽêềếệểễìíịỉĩòóọỏõôồốộổỗơờớợởỡùúụủũưừứựửữỳýỵỷỹđÀÁẠẢÃÂẦẤẬẨẪĂẰẮẶẲẴÈÉẸẺẼÊỀẾỆỂỄÌÍỊỈĨÒÓỌỎÕÔỒỐỘỔỖƠỜỚỢỞỠÙÚỤỦŨƯỪỨỰỬỮỲÝỴỶỸ]/i"," ",$string));

  $string   = trim(preg_replace("/[^A-Za-z0-9]/i"," ",$string)); // khong dau
  $string   = str_replace(" ","-",$string);
  $string   = str_replace("--","-",$string);
  $string   = str_replace("--","-",$string);
  $string   = str_replace("--","-",$string);
  $string   = str_replace($keyReplace,"-",$string);
  return $string;
}
#+
#+ Kiem tra quyen them sua xoa
checkAddEdit("edit");

#+
#+ Khai bao bien
$add        = "add_tag.php";
$listing      = "listing_tag.php";
$edit       = "edit_tag.php";
$after_save_data  = getValue("after_save_data", "str", "POST", $listing);

$errorMsg       = "";   //Warning Error!
$action       = getValue("action", "str", "POST", "");
$fs_action      = getURL();
$record_id      = getValue("record_id");

#+
$cat_name_rewrite   = getValue("cat_name_rewrite", "str", "POST", "");
if($cat_name_rewrite == ''){
  $cat_name_rewrite   = removeTitle(getValue("cat_name", "str", "POST", ""),'/');
  $cat_name_rewrite   = strtolower($cat_name_rewrite);
} // End if($cat_name_rewrite == ''){

#+
#+ Goi class generate form
$myform = new generate_form();  //Call Class generate_form();
$myform->removeHTML(0); //Loại bỏ chức năng không cho điền tag html trong form
#+
#+ Khai bao bang du lieu
$myform->addTable($fs_table); // Add table
#+
#+ Khai bao thong tin cac truong
$myform->add("bmt_name","bmt_name",0,0,"",0,"Vui lòng nhập tên tag",0,"");


#+
#+ đổi tên trường thành biến và giá trị
$myform->evaluate();

#+
#+ Neu nhu co submit form
if($action == "submitForm"){

  #+
  #+ Kiểm tra lỗi
    $errorMsg .= $myform->checkdata();
  $errorMsg .= $myform->strErrorField ; //Check Error!
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
$db_data  = new db_query($query);

if($row   = mysql_fetch_assoc($db_data->result))
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
//$sql        = " cat_type = '".$cat_type."'";

// $menu        =   new menu();
// $listAll       =   $menu->getAllChild("categories_multi","cat_id","cat_parent_id","0",$sql . " AND lang_id = " . $_SESSION["lang_id"] . $sqlcategory,"cat_id,cat_name,cat_order,cat_type,cat_parent_id,cat_has_child","cat_order ASC, cat_name ASC","cat_has_child");

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
<?
$form = new form();
$form->create_form("form_name",$fs_action,"post","multipart/form-data",'onsubmit="validateForm();return false;"  id="form_name" ');
$form->create_table();
?>
<?=$form->text_note('Những ô dấu sao (<font class="form_asterisk">*</font>) là bắt buộc phải nhập.')?>
<?=$form->errorMsg($errorMsg)?>
<br/>


<?=$form->text("Nhập tên tag","bmt_name","bmt_name",$bmt_name,"tên tag",1,500,"",255)?>
<script src="jquery.form.js"></script>


<?=$form->close_table();?>
<?=$form->create_table();?>


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


