
<?
require_once("inc_security.php");
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

function tt($variable){
	return "" . $variable . "";
}
#+
#+ Kiem tra quyen them sua xoa
checkAddEdit("add");

#+
#+ Khai bao bien
$add              = "add.php";
$listing          = "listing.php";
$edit				   = "edit.php";
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

#+
$new_title_rewrite 	= getValue("new_title_rewrite", "str", "POST", "");
if($new_title_rewrite == ''){
	$new_title_rewrite 	= removeTitle(getValue("new_title", "str", "POST", ""),'/');
	$new_title_rewrite 	= strtolower($new_title_rewrite);
} // End if($new_title_rewrite == ''){
else
{
   $new_title_rewrite 	= removeTitle(getValue("new_title_rewrite", "str", "POST", ""),'/');
	$new_title_rewrite 	= strtolower($new_title_rewrite);
}

$new_category_id  = getValue("new_category_id", "int", "POST", 0);
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
$myform->add("vip_name","vip_name",0, 0,"",1,"Bạn chưa nhập tên công ty",1,"Tên công ty đã tồn tại");
$myform->add("vip_solegan","vip_solegan",0, 0,"",1,"Bạn chưa solgen",0,"");
$myform->add("vip_mota","vip_mota",0,0,"",1,"Bạn chưa nhập mô tả",1,"Mô tả bị trùng lặp");
$myform->add("vip_title","vip_title",0,0,"",1,"Bạn chưa nhập thẻ meta title",1,"Thẻ meta title bị trùng lặp");
$myform->add("vip_description","vip_description",0,0,"",1,"Bạn chưa nhập thẻ meta description",1,"Thẻ meta description bị trùng lặp");
$myform->add("vip_keyword","vip_keyword",0,0,"",1,"Bạn chưa nhập keyword",0,"");
$myform->add("vip_loaihinh","vip_loaihinh",1,0,0,1,"Bạn chưa chọn loại hình công ty",0,"");
$myform->add("vip_quymo","vip_quymo",1,0,0,1,"Bạn chưa chọn quy mô công ty",0,"");
$myform->add("vip_phone","vip_phone",0,0,"",0,"Bạn chưa nhập số điện thoại",0,"");
$myform->add("vip_email","vip_email",0,0,"",0,"Bạn chưa nhập email",0,"");
$myform->add("vip_website","vip_website",0,0,"",0,"Bạn chưa nhập website công ty",0,"");
$myform->add("vip_address","vip_address",0,0,"",1,"Bạn chưa nhập địa chỉ công ty",0,"");
$myform->add("vip_chungtoi","vip_chungtoi",0,0,"",1,"Bạn chưa nhập giới thiệu công ty",0,"");
$myform->add("vip_dichvu","vip_dichvu",0,0,"",0,"Bạn chưa nhập sản phẩm dịch vụ",0,"");
$myform->add("vip_chinhsach","vip_chinhsach",0,0,"",0,"Bạn chưa nhập chính sách đãi ngộ",0,"");
$myform->add("vip_vanhoa","vip_vanhoa",0,0,"",0,"Bạn chưa nhập văn hóa công ty",0,"");
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
   if($array_config["image"]==1){
		$upload_pic = new upload("vip_logo", $fs_filepath, $extension_list, $limit_size);
		if ($upload_pic->file_name != ""){
			$picture = date("Y",time())."/".date("m",time())."/".date("d",time())."/".$upload_pic->file_name;
			resize_image($fs_filepath,$upload_pic->file_name,190,190,100,"");
         $vip_logo = $upload_pic->file_name;
         $myform->add("vip_logo",'vip_logo',0,1,"",1,"Bạn chưa chọn logo",0,"");
		}
      else
      {
         $errorMsg .= "• Bạn chưa chọn logo<br/>";
      }
		//Check Error!
	}
   if($array_config["image"]==1){
		$upload_pic = new upload("vip_banner", $fs_filepath, $extension_list, $limit_size);
		if ($upload_pic->file_name != ""){
			$picture = date("Y",time())."/".date("m",time())."/".date("d",time())."/".$upload_pic->file_name;
         $vip_banner = $upload_pic->file_name;
         $myform->add('vip_banner',"vip_banner",0,1,"",1,"Bạn chưa chọn banner",0,"");
			resize_image($fs_filepath,$upload_pic->file_name,1349,387,100,"");
			
		}
      else
      {
         $errorMsg .= "• Bạn chưa chọn banner<br/>";
      }
		//Check Error!
	}
   $arrayanh = getValue('arrayanh','arr','POST','');
   if($arrayanh != '')
   {
   foreach($arrayanh as $data_img){
   	$abc = saveImageFromBase64Type($data_img,$fs_filepath);
   	$adam[] = $abc["name"];   
   }
   $arralbum = implode(";",$adam);
   $arralbum = $arralbum.";";
   $myform->add('vip_album',"arralbum",0,1,"",0,"",0,"");
   }

	if($errorMsg == ""){
      
		#+
		#+ Thuc hien query
		$db_ex	 		= new db_execute_return();
		$query			= $myform->generate_insert_SQL();

		$last_id 		= $db_ex->db_execute($query);
		$record_id 		= $last_id;
		//echo $query;exit();

		$fs_redirect 	= $after_save_data. "?record_id=".$record_id."&new_category_id=".$new_category_id;
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
<?=$form->text("Tên công ty","vip_name","vip_name",$vip_name,"Tên công ty",1,500,"",255)?>
<?=$form->text("Solgen","vip_solegan","vip_solegan",$vip_solegan,"Solgen",1,500,"",255)?>
<?=$form->textarea("Mô tả công ty", "vip_mota", "vip_mota", $vip_mota, "Mô tả công ty", 1, 600, 60, "", "", "")?>
<?=$form->text("Meta Title","vip_title","vip_title",$vip_title,"Meta title",1,500,"",255)?>
<?=$form->textarea("Meta Description", "vip_description", "vip_description", $vip_description, "Meta Description", 1, 600, 60, "", "", "")?>
<?=$form->textarea("Meta Keyword", "vip_keyword", "vip_keyword", $vip_keyword, "Meta Keyword", 1, 600, 60, "", "", "")?>
<?=$form->getFile("Logo công ty", "vip_logo", "vip_logo", "Logo công ty",1, 32, "", '<font color="red">(Kích thước chuẩn 190 x 190)</font>')?>
<?=$form->getFile("Banner công ty", "vip_banner", "vip_banner", "Banner công ty",1, 32, "", '<font color="red">(Kích thước chuẩn 1349 x 387)</font>')?>
<tr>
	<td>Album ảnh</td>
	<td class="pickimg">
 	<div class="imgadd">
 		<div id="thumb-camera" class="thumb-camera sprite_ai_camera" style="display: block;"></div>
 		<span class="image-label">Đăng hình</span>
 	</div>
	<input type="file" class="pickfile" multiple name="fileupload" onchange="preview_image(event, this);"  hidden="true" />
	</td>
</tr>
<script src="jquery.form.js"></script>
<script>

$( ".imgadd" ).click(function() {
  $( ".pickfile" ).click();
});
function preview_image(e, element){
	var _URL = window.URL || window.webkitURL;
	var file, img;
	if ((file = element.files[0])) {
		img = new Image();
		img.onload = function() {
			img.src = _URL.createObjectURL(file);
		}
	}
	preview_before_upload(e, element);
}
function preview_before_upload(event, elem){
 if(typeof FileReader == "undefined") return true;
 var elem = $(elem);
 var files = event.target.files;
 for (var i=0, file; file=files[i]; i++) {
     if (file.type.match('image.*')) {
         var reader = new FileReader();
         reader.onload = (function(theFile) {
             return function(event) {
                 var image = event.target.result;
						$(".pickimg"). append("<div class='imgdiv'><img  class='imgaram' src='"+image+"' height='100' width='130' style='height: 100px !important;object-fit:cover; border:1px solid #ddd; padding:4px;margin-left:5px;border-radius:4px;'/><span class='sprite_ai_remove' onclick='deleteimage(this)'></span></div>");
						$(".pickimg").append("<input type='text' class='imgremo' value='"+image+"' name='arrayanh[]'  style='display:none;' />");
					};
         })(file);
         reader.readAsDataURL(file);
     }
 }
}

</script>
<style>
.image-label
{
	color: #6d6d6d;
	font-size: 13px;
	font-weight: bold;
	margin-left:37px;
}
.sprite_ai_camera {
  width: 57px;
  height: 47px;
  background: url("../../../images/camera.png");
  margin: 20px 41px 12px auto;
}
.titleimage
{
width: 134px!important;
margin-left: 5px!important;
margin-top: 8px!important;
font-size: 11px!important;
}
.imgadd
{
	width: 138px!important;
	height: 108px!important;
	float:left;
	position: relative;
	border: 1px solid #ddd;
	background-color: #fff;
	border-radius: 4px;
	margin-left: 5px;
	cursor: pointer;
}
.imgdiv
{
	float:left;
	position: relative;
	width:160px;
}
.sprite_ai_remove {
	cursor: pointer;
  width: 16px;
  height: 16px;
  background: url("../../../images/ai.png");
  position: absolute;
  top: -3px;
  left: 3px;
}
</style>
<tr>
    <td class="form_name"><font class="form_asterisk">* </font>Loại hình công ty</td>
    <td class="form_text">
        <select name="vip_loaihinh" id="vip_loaihinh" class="form_control">
        	<option value=""><?=tt("Chọn loại hình")?></option>
         <option value="1" <?=($vip_loaihinh == 1)?'selected="selected"':''?>>Doanh nghiệp nhà nước</option>
         <option value="2" <?=($vip_loaihinh == 2)?'selected="selected"':''?>>Công ty Nước Ngoài</option>
         <option value="3" <?=($vip_loaihinh == 3)?'selected="selected"':''?>>Công ty Cổ Phần</option>
         <option value="4" <?=($vip_loaihinh == 4)?'selected="selected"':''?>>Công ty TNHH</option>
         <option value="5" <?=($vip_loaihinh == 5)?'selected="selected"':''?>>Công ty Đại Chúng</option>
         <option value="6" <?=($vip_loaihinh == 6)?'selected="selected"':''?>>Công ty Tư Nhân</option>
         <option value="7" <?=($vip_loaihinh == 7)?'selected="selected"':''?>>Công ty Hợp Danh</option>
        </select>
    </td>
</tr>
<tr>
    <td class="form_name"><font class="form_asterisk">* </font>Quy mô công ty</td>
    <td class="form_text">
        <select name="vip_quymo" id="vip_quymo" class="form_control">
        	<option value=""><?=tt("Chọn quy mô")?></option>
         <option value="1" <?=($vip_quymo == 1)?'selected="selected"':''?>>Dưới 20 nhân viên</option>
         <option value="2" <?=($vip_quymo == 2)?'selected="selected"':''?>>20 - 50 nhân viên</option>
         <option value="3" <?=($vip_quymo == 3)?'selected="selected"':''?>>50 - 100 nhân viên</option>
         <option value="4" <?=($vip_quymo == 4)?'selected="selected"':''?>>100 - 300 nhân viên</option>
         <option value="5" <?=($vip_quymo == 5)?'selected="selected"':''?>>300 - 1000 nhân viên</option>
         <option value="6" <?=($vip_quymo == 6)?'selected="selected"':''?>>1000 - 3000 nhân viên</option>
         <option value="7" <?=($vip_quymo == 7)?'selected="selected"':''?>>Trên 3000 nhân viên</option>
        </select>
    </td>
</tr>
<script>
	var arrayB = [];
	function deleteimage(e){
		if(confirm("Bạn có muốn xóa ảnh này?")){
			$(e).parent(".imgdiv").fadeOut(300,function(){
				$(e).parent(".imgdiv").next(".imgremo").remove();
				$(e).parent(".imgdiv").remove();
				var iddel = $(e).attr("data-id");
				arrayB.push(iddel);
			});
		}
	}
</script>
<?=$form->text("Số điện thoại","vip_phone","vip_phone",$vip_phone,"Số điện thoại",0,500,"",255)?>
<?=$form->text("Website","vip_website","vip_website",$vip_website,"Website",0,500,"",255)?>
<?=$form->text("Email","vip_email","vip_email",$vip_email,"Email",0,500,"",255)?>
<?=$form->text("Địa chỉ công ty","vip_address","vip_address",$vip_address,"Địa chỉ công ty",1,600,60,255)?>
<?=$form->close_table();?>
<?=$form->wysiwyg("Giới thiệu công ty", "vip_chungtoi", $vip_chungtoi, "../../resource/ckeditor/", "50%","600")?>
<?=$form->wysiwyg("Sản phẩm dịch vụ", "vip_dichvu", $vip_dichvu, "../../resource/ckeditor/", "80%","600")?>
<?=$form->wysiwyg("Chính sách đãi ngộ", "vip_chinhsach", $vip_chinhsach, "../../resource/ckeditor/", "80%","600")?>
<?=$form->wysiwyg("Văn hóa công ty", "vip_vanhoa", $vip_vanhoa, "../../resource/ckeditor/", "80%","600")?>
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