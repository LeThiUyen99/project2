<style>
#cke_cv_muctieu,#cke_cv_kynang,#cke_th_bs,#cke_kn_mota
{
   width: 80%;
   margin: 0 auto;
   position: relative;
   top: -15px;
   left: 38px;
}
.form_name
{
   width: 135px;
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
$use_create_time = time();
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
$myform->add("use_email","use_email",0, 0,"",1,"Bạn chưa nhập email",0,"Email đã tồn tại");
$myform->add("use_first_name","use_first_name",0, 0,"",1,"Bạn chưa nhập tên ứng viên",0,"");
$myform->add("use_phone","use_phone",0,0,"",1,"Bạn chưa nhập số điện thoại",0,"");
$myform->add("use_birth_day","use_birth_day",0,0,"",1,"Bạn chưa nhập ngày sinh",0,"");
$myform->add("use_gioi_tinh","use_gioi_tinh",1,0,"",1,"Bạn chưa chọn giới tính",0,"");
$myform->add("use_hon_nhan","use_hon_nhan",1,0,"",1,"Bạn chưa chọn tình trạng hôn nhân",0,"");
$myform->add("use_city","use_city",1,0,"",1,"Bạn chưa chọn tỉnh thành",0,"");
$myform->add("use_address","use_address",0,0,"",1,"Bạn chưa nhập địa chỉ",0,"");
#+ đổi tên trường thành biến và giá trị
$myform->evaluate();
$myform1 = new generate_form();
$myform1->removeHTML(0);
$myform1->addTable("cv");	
$myform1->add("cv_title","cv_title",0,0,"",1,"Bạn chưa nhập công việc mong muốn",0,"");
$myform1->add("cv_capbac_id","cv_capbac_id",1,0,0,1,"Bạn chưa chọn cấp bậc",0,"");
$myform1->add("cv_city_id","cv_city_id",1,0,0,1,"Bạn chưa chọn địa điểm làm việc",0,"");
$myform1->add("cv_cate_id","cv_cate_id",1,0,0,1,"Bạn chưa chọn ngành nghề",0,"");
$myform1->add("cv_money_id","cv_money_id",1,0,0,1,"Bạn chưa chọn mức lương mong muốn",0,"");
$myform1->add("cv_loaihinh_id","cv_loaihinh_id",1,0,0,1,"Bạn chưa chọn hình thức làm việc",0,"");
$myform1->add("cv_exp","cv_exp",1,0,0,1,"Bạn chưa chọn kinh nghiệm làm việc",0,"");
$myform1->add("cv_kynang","cv_kynang",0,0,"",0,"Bạn chưa nhập kỹ năng bản thân",0,"");
$myform1->add("cv_muctieu","cv_muctieu",0,0,"",0,"Bạn chưa nhập mục tiêu nghề nghiệp",0,"");
$myform1->evaluate();
$myform2 = new generate_form();
$myform2->removeHTML(0);
$myform2->addTable("truong_hoc");
$myform2->add("th_bc","th_bc",0,0,"",0,"",0,"");
$myform2->add("th_name","th_name",0,0,"",0,"",0,"");
$myform2->add("th_one_time","th_one_time",0,0,"",0,"",0,"");
$myform2->add("th_two_time","th_two_time",0,0,"",0,"",0,"");
$myform2->add("th_cn","th_cn",0,0,"",0,"",0,"");
$myform2->add("th_xl","th_xl",1,0,"",0,"",0,"");
$myform2->add("th_bs","th_bs",0,0,"",0,"",0,"");
$myform2->evaluate();
$myform3 = new generate_form();
$myform3->removeHTML(0);
$myform3->addTable("kinh_nghiem");
$myform3->add("kn_cv","kn_cv",0,0,"",0,"",0,"");
$myform3->add("kn_name","kn_name",0,0,"",0,"",0,"");
$myform3->add("kn_one_time","kn_one_time",0,0,"",0,"",0,"");
$myform3->add("kn_two_time","kn_two_time",0,0,"",0,"",0,"");
$myform3->add("kn_mota","kn_mota",0,0,"",0,"",0,"");
$myform3->evaluate();
$myform4 = new generate_form();
$myform4->removeHTML(0);
$myform4->addTable("ngoai_ngu");
$myform4->add("nn_id_pick","nn_id_pick",1,0,"",0,"",0,"");
$myform4->add("nn_cc","nn_cc",0,0,"",0,"",0,"");
$myform4->add("nn_sd","nn_sd",0,0,"",0,"",0,"");
$myform4->evaluate();
$dquery = "SELECT * FROM " . $fs_table . " WHERE " . $field_id . " = " . $record_id;
$dquery2 = new db_query("SELECT * FROM cv WHERE cv_user_id = " . $record_id."");
$dquery3 = new db_query("SELECT * FROM truong_hoc WHERE th_use_id = " . $record_id."");
$dquery4 = new db_query("SELECT * FROM kinh_nghiem WHERE kn_use_id = " . $record_id."");
$dquery5 = new db_query("SELECT * FROM ngoai_ngu WHERE nn_use_id = " . $record_id."");
$rows = mysql_fetch_assoc($dquery2->result);
$row3 = mysql_fetch_assoc($dquery3->result);
$row4 = mysql_fetch_assoc($dquery4->result);
$row5 = mysql_fetch_assoc($dquery5->result);
$db_data 	= new db_query($dquery);

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
#+ Neu nhu co submit form
if($action == "submitForm"){
	if($array_config["image"]==1){
		$upload_pic = new upload("use_logo", $fs_filepath, $extension_list, $limit_size);
		if ($upload_pic->file_name != ""){
			$picture = date("Y",time())."/".date("m",time())."/".date("d",time())."/".$upload_pic->file_name;
			resize_image($fs_filepath,$upload_pic->file_name,190,190,100,"");
         $use_logo = $upload_pic->file_name;
         $myform->add("use_logo",'use_logo',0,1,"",1,"Bạn chưa chọn logo",0,"");
		}
		//Check Error!
	}
	#+
	#+ Kiểm tra lỗi
   $errorMsg .= $myform->checkdata();
	$errorMsg .= $myform->strErrorField ;	//Check Error!
   $errorMsg .= $myform1->checkdata();
	$errorMsg .= $myform1->strErrorField ;	
   $errorMsg .= $myform2->checkdata();
	$errorMsg .= $myform2->strErrorField ;	//Check Error!
   $errorMsg .= $myform3->checkdata();
	$errorMsg .= $myform3->strErrorField ;	//Check Error!
   $errorMsg .= $myform4->checkdata();
	$errorMsg .= $myform4->strErrorField ;	//Check Error!

	if($errorMsg == ""){
		
		#+
		#+ Thuc hien query
      $use_birth_day2 = str_totime($_POST['use_birth_day']);
      
		$query = $myform->generate_update_SQL($field_id,$record_id);
      
      $query = str_replace($_POST['use_birth_day'],$use_birth_day2,$query);
      $th_one_time2 = str_totime($th_one_time);
      $th_two_time2 = str_totime($th_two_time);
      if(mysql_num_rows($dquery2->result) > 0)
      {
         $query1 = $myform1->generate_update_SQL("cv_user_id",$record_id);
      }
      else
      {
         $myform1->add("cv_user_id","record_id",1,1,0,0,"Bạn chưa chọn logo",0,"");
         $query1 = $myform1->generate_insert_SQL();
      }
      if(mysql_num_rows($dquery3->result) > 0)
      {
         $query2 = $myform2->generate_update_SQL("th_use_id",$record_id);
      }
      else
      {
         $myform2->add("th_use_id","record_id",1,1,0,0,"",0,"");
         $query2 = $myform2->generate_insert_SQL();
      }
      $query2 = str_replace($th_one_time,$th_one_time2,$query2);
      $query2 = str_replace($th_two_time,$th_two_time2,$query2);
      $kn_one_time2 = str_totime($kn_one_time);
      $kn_two_time2 = str_totime($kn_two_time);
      if(mysql_num_rows($dquery4->result) > 0)
      {
         $query3 = $myform3->generate_update_SQL("kn_use_id",$record_id);
      }
      else
      {
         $myform3->add("kn_use_id","record_id",1,1,0,0,"",0,"");
         $query3 = $myform3->generate_insert_SQL();
      }
      $query3 = str_replace($kn_one_time,$kn_one_time2,$query3);
      $query3 = str_replace($kn_two_time,$kn_two_time2,$query3);
      if(mysql_num_rows($dquery4->result) > 0)
      {
         $query4 = $myform4->generate_update_SQL("nn_use_id",$record_id);
      }
      else
      {
         $myform4->add("nn_use_id","record_id",1,1,0,0,"",0,"");
         $query4 = $myform4->generate_insert_SQL();
      }
		$db_ex = new db_execute($query);
      $db_ex1 = new db_execute($query1);
      $db_ex2 = new db_execute($query2);
      $db_ex3 = new db_execute($query3);
      $db_ex4 = new db_execute($query4);
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


#+
#+ Array Category
$menu 	= new menu();
$listAll = $menu->getAllChild("categories_multi","cat_id","cat_parent_id","0","cat_type IN(".$cat_type_select.")","cat_id,cat_name,cat_order,cat_type,cat_parent_id,cat_has_child","cat_type, cat_order ASC, cat_name ASC","cat_has_child");
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
<?=$form->getFile("Ảnh đại diện", "use_logo", "use_logo", "Ảnh đại diện",1, 32, "", '<font color="red">(Kích thước chuẩn 190 x 190)</font>')?>
<?=$form->text_note('Những ô dấu sao (<font class="form_asterisk">*</font>) là bắt buộc phải nhập.')?>
<?=$form->errorMsg($errorMsg)?>
<?=$form->text("Email ứng viên","use_email","use_email",$use_email,"Email ứng viên",1,250,"",255)?>
<?=$form->text("Tên ứng viên","use_first_name","use_first_name",$use_first_name,"Tên ứng viên",1,250,"",255)?>
<?=$form->text("Số điện thoại", "use_phone", "use_phone", $use_phone, "Số điện thoại", 1, 250, "", "", "", "")?>
<?=$form->text("Ngày sinh", "use_birth_day", "use_birth_day",date("d-m-Y",$use_birth_day), "Ngày sinh",1,250,"",100,"-", "")?>
<tr><td></td><td><font color="red">(VD: 10-11-1993)</font></td></tr>
<tr>
    <td class="form_name"><font class="form_asterisk">* </font>Giới tính:</td>
    <td class="form_text">
        <select name="use_gioi_tinh" id="use_gioi_tinh" class="form_control" style="width:250px">
        	<option value="">Chọn giới tính</option>
         <option value="1" <?=($use_gioi_tinh == 1)?'selected="selected"':''?>>Nam</option>
         <option value="2" <?=($use_gioi_tinh == 2)?'selected="selected"':''?>>Nữ</option>
        </select>
    </td>
</tr>
<tr>
    <td class="form_name"><font class="form_asterisk">* </font>Tình trạng hôn nhân:</td>
    <td class="form_text">
        <select name="use_hon_nhan" id="use_hon_nhan" class="form_control" style="width:250px">
        	<option value="">Chọn tình trạng hôn nhân</option>
         <option value="1" <?=($use_hon_nhan == 1)?'selected="selected"':''?>>Độc thân</option>
         <option value="2" <?=($use_hon_nhan == 2)?'selected="selected"':''?>>Đã có gia đình</option>
        </select>
    </td>
</tr>
<tr>
    <td class="form_name"><font class="form_asterisk">* </font>Chọn tỉnh thành:</td>
    <td class="form_text">
        <select name="use_city" id="use_city" class="form_control" style="width:250px">
        	<option value="">Chọn tỉnh thành</option>
         <?
         $db_qrcity = new db_query("SELECT * FROM city ORDER BY cit_order DESC,cit_name ASC");
         While($rowcity = mysql_fetch_assoc($db_qrcity->result))
         {
         ?>
         <option value="<?= $rowcity['cit_id'] ?>" <?=($use_city == $rowcity['cit_id'])?'selected="selected"':''?>><?= $rowcity['cit_name'] ?></option>
         <?
         }
         ?>
        </select>
    </td>
</tr>
<?=$form->textarea("Địa chỉ","use_address","use_address",$use_address,"Địa chỉ",1,250,60,255)?>
<?=$form->text("Công việc mong muốn", "cv_title", "cv_title",$rows['cv_title'], "Công việc mong muốn",1,250,"",100,"-", "0")?>
<tr>
    <td class="form_name"><font class="form_asterisk">* </font>Cấp bậc:</td>
    <td class="form_text">
        <select name="cv_capbac_id" id="cv_capbac_id" class="form_control" style="width:250px">
           	<option value="">Chọn cấp bậc mong muốn</option>
            <option value="1" <?=($rows['cv_capbac_id'] == 1)?'selected="selected"':''?>>Mới Tốt Nghiệp</option>
            <option value="3" <?=($rows['cv_capbac_id'] == 3)?'selected="selected"':''?>>Nhân viên</option>
            <option value="2" <?=($rows['cv_capbac_id'] == 2)?'selected="selected"':''?>>Trưởng Phòng</option>
            <option value="4" <?=($rows['cv_capbac_id'] == 4)?'selected="selected"':''?>>Giám Đốc và Cấp Cao Hơn</option>
            <option value="5" <?=($rows['cv_capbac_id'] == 5)?'selected="selected"':''?>>Trưởng nhóm</option>
        </select>
    </td>
</tr>
<tr>
    <td class="form_name"><font class="form_asterisk">* </font>Địa điểm:</td>
    <td class="form_text">
        <select name="cv_city_id" id="cv_city_id" class="form_control" style="width:250px">
        	<option value="">Chọn địa điểm</option>
         <?
         $db_qrcity = new db_query("SELECT * FROM city ORDER BY cit_order DESC,cit_name ASC");
         While($rowcity = mysql_fetch_assoc($db_qrcity->result))
         {
         ?>
         <option value="<?= $rowcity['cit_id'] ?>" <?=($rows['cv_city_id'] == $rowcity['cit_id'])?'selected="selected"':''?>><?= $rowcity['cit_name'] ?></option>
         <?
         }
         ?>
        </select>
    </td>
</tr>
<tr>
    <td class="form_name"><font class="form_asterisk">* </font>Ngành nghề:</td>
    <td class="form_text">
        <select name="cv_cate_id" id="cv_cate_id" class="form_control" style="width:250px">
        	<option value="">Chọn ngành nghề</option>
         <?
         $db_qrcity = new db_query("SELECT * FROM category ORDER BY cat_order DESC,cat_name ASC");
         While($rowcity = mysql_fetch_assoc($db_qrcity->result))
         {
         ?>
         <option value="<?= $rowcity['cat_id'] ?>" <?=($rows['cv_cate_id'] == $rowcity['cat_id'])?'selected="selected"':''?>><?= $rowcity['cat_name'] ?></option>
         <?
         }
         ?>
        </select>
    </td>
</tr>
<tr>
    <td class="form_name"><font class="form_asterisk">* </font>Mức lương:</td>
    <td class="form_text">
        <select name="cv_money_id" id="cv_money_id" class="form_control" style="width:250px">
        	<option value="">Chọn mức lương</option>
         <option value="1" <?=($rows['cv_money_id'] == 1)?'selected="selected"':''?>>Thỏa thuận</option>
         <option value="2" <?=($rows['cv_money_id'] == 2)?'selected="selected"':''?>>1 - 3 triệu</option>
         <option value="3" <?=($rows['cv_money_id'] == 3)?'selected="selected"':''?>>3 - 5 triệu</option>
         <option value="4" <?=($rows['cv_money_id'] == 4)?'selected="selected"':''?>>5 - 7 triệu</option>
         <option value="5" <?=($rows['cv_money_id'] == 5)?'selected="selected"':''?>>7 - 10 triệu</option>
         <option value="6" <?=($rows['cv_money_id'] == 6)?'selected="selected"':''?>>10 - 15 triệu</option>
         <option value="7" <?=($rows['cv_money_id'] == 7)?'selected="selected"':''?>>15 - 20 triệu</option>
         <option value="8" <?=($rows['cv_money_id'] == 8)?'selected="selected"':''?>>20 - 30 triệu</option>
         <option value="9" <?=($rows['cv_money_id'] == 9)?'selected="selected"':''?>>Trên 30 triệu</option>
        </select>
    </td>
</tr>
<tr>
    <td class="form_name"><font class="form_asterisk">* </font>Hình thức:</td>
    <td class="form_text">
      <select name="cv_loaihinh_id" id="cv_loaihinh_id" class="form_control" style="width:250px">
        	<option value="">Chọn hình thức công việc</option>
         <option value="1" <?=($rows['cv_loaihinh_id'] == 1)?'selected="selected"':''?>>Toàn thời gian cố định</option>
         <option value="2" <?=($rows['cv_loaihinh_id'] == 2)?'selected="selected"':''?>>Toàn thời gian tạm thời</option>
         <option value="3" <?=($rows['cv_loaihinh_id'] == 3)?'selected="selected"':''?>>Bán thời gian</option>
         <option value="4" <?=($rows['cv_loaihinh_id'] == 4)?'selected="selected"':''?>>Bán thời gian tạm thời</option>
         <option value="5" <?=($rows['cv_loaihinh_id'] == 5)?'selected="selected"':''?>>Hợp đồng</option>
         <option value="6" <?=($rows['cv_loaihinh_id'] == 6)?'selected="selected"':''?>>Khác</option>
      </select>
    </td>
</tr>
<tr>
    <td class="form_name"><font class="form_asterisk">* </font>Kinh nghiệm:</td>
    <td class="form_text">
      <select name="cv_exp" id="cv_exp" class="form_control" style="width:250px">
        	<option value="">Chưa có kinh nghiệm làm việc</option>
         <option value="1" <?=($rows['cv_exp'] == 1)?'selected="selected"':''?>>Dưới 1 năm</option>
         <option value="2" <?=($rows['cv_exp'] == 2)?'selected="selected"':''?>>1 năm</option>
         <option value="3" <?=($rows['cv_exp'] == 3)?'selected="selected"':''?>>2 năm</option>
         <option value="4" <?=($rows['cv_exp'] == 4)?'selected="selected"':''?>>3 năm</option>
         <option value="5" <?=($rows['cv_exp'] == 5)?'selected="selected"':''?>>4 năm</option>
         <option value="6" <?=($rows['cv_exp'] == 6)?'selected="selected"':''?>>5 năm</option>
         <option value="7" <?=($rows['cv_exp'] == 7)?'selected="selected"':''?>>Trên 5 năm</option>
      </select>
    </td>
</tr>
<?=$form->close_table();?>
<?=$form->wysiwyg("Mục tiêu nghề nghiệp:", "cv_muctieu", $rows['cv_muctieu'], "../../resource/ckeditor/", "80%","450")?>
<?=$form->wysiwyg("Kỹ năng bản thân:", "cv_kynang", $rows['cv_kynang'], "../../resource/ckeditor/", "80%","450")?>
<?=$form->create_table();?>
<?=$form->text("Bằng cấp chứng chỉ", "th_bc", "th_bc",$row3['th_bc'], "Bằng cấp chứng chỉ",0,250,"",100,"-", "0")?>
<?=$form->text("Trường học", "th_name", "th_name",$row3['th_name'], "Trường học",0,250,"",100,"-", "0")?>
<?=$form->text("Ngày bắt đầu học", "th_one_time", "th_one_time",date("d-m-Y",$row3['th_one_time']), "Ngày bắt đầu",0,250,"",100,"-", "0")?>
<tr><td></td><td><font color="red">(VD: 01-10-2012)</font></td></tr>
<?=$form->text("Ngày kết thúc học", "th_two_time", "th_two_time",date("d-m-Y",$row3['th_two_time']), "Ngày kết thúc",0,250,"",100,"-", "0")?>
<tr><td></td><td><font color="red">(VD: 01-10-2017)</font></td></tr>
<?=$form->text("Chuyên ngành học", "th_cn", "th_cn",$row3['th_cn'], "Chuyên ngành học",0,250,"",100,"", "0")?>
<tr>
    <td class="form_name">Xếp loại:</td>
    <td class="form_text">
      <select name="th_xl" id="th_xl" class="form_control" style="width:250px">
        	<option value="">Chọn xếp loại</option>
         <option value="1" <?=($row3['th_xl'] == 1)?'selected="selected"':''?>>Yếu</option>
         <option value="2" <?=($row3['th_xl'] == 2)?'selected="selected"':''?>>Trung bình</option>
         <option value="3" <?=($row3['th_xl'] == 3)?'selected="selected"':''?>>Khá</option>
         <option value="4" <?=($row3['th_xl'] == 4)?'selected="selected"':''?>>Giỏi</option>
      </select>
    </td>
</tr>
<?=$form->close_table();?>
<?=$form->wysiwyg("Thông tin bổ sung:", "th_bs", $row3['th_bs'], "../../resource/ckeditor/", "80%","450")?>
<?=$form->create_table();?>
<?=$form->text("Chức danh/vị trí", "kn_cv", "kn_cv",$row4['kn_cv'], "Chức danh/vị trí",0,250,"",100,"", "0")?>
<?=$form->text("Công ty", "kn_name", "kn_name",$row4['kn_name'], "Công ty",0,250,"",100,"", "0")?>
<?=$form->text("Ngày bắt đầu", "kn_one_time", "kn_one_time",date("d-m-Y",$row4['kn_one_time']), "Ngày bắt đầu",0,250,"",100,"-", "0")?>
<tr><td></td><td><font color="red">(VD: 01-10-2012)</font></td></tr>
<?=$form->text("Ngày kết thúc", "kn_two_time", "kn_two_time",date("d-m-Y",$row4['kn_two_time']), "Ngày kết thúc",0,250,"",100,"-", "0")?>
<tr><td></td><td><font color="red">(VD: 01-10-2017)</font></td></tr>
<?=$form->close_table();?>
<?=$form->wysiwyg("Thêm thông tin:", "kn_mota", $row4['kn_mota'], "../../resource/ckeditor/", "80%","450")?>
<?=$form->create_table();?>
<tr>
    <td class="form_name">Chọn ngôn ngữ:</td>
    <td class="form_text">
      <select name="nn_id_pick" id="nn_id_pick" class="form_control" style="width:250px">
        	<option value="">Chọn ngôn ngữ</option>
         <option value="1" <?=($row5['nn_id_pick'] == 1)?'selected="selected"':''?>>Tiếng Anh</option>
         <option value="2" <?=($row5['nn_id_pick'] == 2)?'selected="selected"':''?>>Tiếng Pháp</option>
         <option value="3" <?=($row5['nn_id_pick'] == 3)?'selected="selected"':''?>>Tiếng Nga</option>
         <option value="4" <?=($row5['nn_id_pick'] == 4)?'selected="selected"':''?>>Tiếng Hàn</option>
         <option value="5" <?=($row5['nn_id_pick'] == 5)?'selected="selected"':''?>>Tiếng Trung</option>
         <option value="6" <?=($row5['nn_id_pick'] == 6)?'selected="selected"':''?>>Tiếng Nhật</option>
      </select>
    </td>
</tr>
<?=$form->text("Chứng chỉ", "nn_cc", "nn_cc",$row5['nn_cc'], "Chứng chỉ",0,250,"",100,"", "0","")?>
<?=$form->text("Số điểm", "nn_sd", "nn_sd",$row5['nn_sd'], "Số điểm",0,250,"",100,"", "0")?>
<script src="jquery.form.js"></script>
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