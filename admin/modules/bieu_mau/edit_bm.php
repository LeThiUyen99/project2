<? 
require_once("inc_security_bm.php");
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
$add        = "add_bm.php";
$listing      = "listing_bm.php";
$edit       = "edit_bm.php";
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
$myform->add("bmn_name","bmn_name",0,0,"",0,"Vui lòng nhập tiêu đề",0,"");
$myform->add("bmn_cate_id","bmn_cate_id",0,0,"",0,"Vui lòng chọn danh mục biểu mẫu",0,"");
$myform->add("bmn_detail","bmn_detail",0,0,"",0,"Vui lòng nhập mô tả biểu mẫu",0,"");



#+
#+ đổi tên trường thành biến và giá trị
$myform->evaluate();

#+
#+ Neu nhu co submit form
if($action == "submitForm"){

   if($array_config["image"]==1){
    $upload_pic = new upload("bmn_avatar", $fs_filepath, $extension_list, $limit_size);
    if ($upload_pic->file_name != ""){
      $bmn_avatar = date("Y",time())."/".date("m",time())."/".date("d",time())."/".$upload_pic->file_name;
      $myform->add("bmn_avatar","bmn_avatar",0, 1,"",0,"",0,"");
      // $myform->add("new_picture","picture",0,1,"",0,"",0,"");
    }
  }
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

<?=$form->getFile("Ảnh đại diện", "bmn_avatar", "bmn_avatar", "Biểu mẫu", 0, 32, "", '<br />(Dung lượng tối đa <font color="#FF0000">'.$limit_size.' Kb</font>)')?>
<?=$form->close_table();?>
<?=$form->wysiwyg("Chi tiết bài viết", "bmn_detail", $bmn_detail, "../../resource/ckeditor/", "50%","600")?>
<?=$form->create_table();?>

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


