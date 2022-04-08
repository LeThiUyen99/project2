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

if (isset($_GET['city_id']))
{
    $value = $_GET['city_id'];
     $db_qrcity = new db_query("SELECT cit_id, cit_name FROM city2 WHERE cit_parent = '".$value."' ORDER BY cit_order DESC,cit_name ASC ");
     While($rowcity = mysql_fetch_assoc($db_qrcity->result))
     {
     ?>
     <option class="qh_add" value="<?= $rowcity['cit_id'] ?>"><?= $rowcity['cit_name'] ?></option>
     <?
     }
    exit();
}

if (isset($_GET['city']) && isset($_GET['type']) && isset($_GET['qh']) && isset($_GET['cate']) && isset($_GET['cb']) && isset($_GET['name'])&& isset($_GET['id']))
{
    $city = $_GET['city'];
    $type = $_GET['type'];
    $qh = $_GET['qh'];
    $cate = $_GET['cate'];
    $cb = $_GET['cb'];
    $name = str_replace('_', ' ',$_GET['name']);
    $id = $_GET['id'];



    if ($city == '') { $city = '0'; }
    if ($qh == '') { $qh = '0'; }
    if ($cate == '') { $cate = '0'; }
    if ($type == 'false') { $type = '0'; }else{ $type = '1';}


     $db_check = new db_query("SELECT count(1) FROM keyword WHERE key_cate_id = '$cate' AND key_type = '$type' AND key_city_id = '$city' AND key_qh_id = '$qh' AND key_cb_id = '$cb' AND key_name = '$name' AND key_id != '$id'");
     $count = mysql_fetch_assoc($db_check->result);
      $count = $count['count(1)'];
     if ($count > 0) 
      {
        echo '<span style="font-size: 15px; color: red; text-transform: uppercase;font-weight: bold;">
* Nội dung tag bị trùng</span>';
      }else{
        echo '<span style="font-size: 15px; color: green; text-transform: uppercase;font-weight: bold;">
* Nội dung tag hợp lệ</span>';
      }
    exit();
}

$db_tag = new db_query("SELECT DISTINCT `key_name` FROM `keyword` WHERE `key_name` != ''");
$arr_tag = array();
While($row_tag = mysql_fetch_assoc($db_tag->result))
{
    $arr_tag[] = $row_tag['key_name']; 
}
$name_tag = json_encode($arr_tag);



$array_capbac = array(0 => "Chọn cấp bậc",
                      1 => "Thực tập",
                      3 => "Nhân viên",
                      5 => "Trưởng nhóm",
                      2 => "Trưởng Phòng",
                      4 => "Giám Đốc",
                      );

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
$key_id  = getValue("key_id", "int", "POST", 0);

//Lay loai modul
$queryCat   = "SELECT * FROM keyword WHERE key_id = " . intval($key_id);
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
$myform->add("key_type", "key_type", 1, 0, 0, 0, "", 0, "");

$myform->add("key_cate_id","key_cate_id",0, 0,"",0,"",0);
$myform->add("key_city_id","key_city_id",0, 0,"",0,"",0);
$myform->add("key_qh_id","key_qh_id",0, 0,"",0,"",0);

$myform->add("key_cb_id","key_cb_id",0, 0,"",0,"",0);
$myform->add("key_name","key_name",0, 0,"",0,"",0);

$myform->add("key_teaser","key_teaser",0, 0,"",0,"",0);

$myform->add("key_tit","key_tit",0, 0,"",0,"",0);
$myform->add("key_desc","key_desc",0, 0,"",0,"",0);
$myform->add("key_key","key_key",0, 0,"",0,"",0);
$myform->add("key_h1","key_h1",0, 0,"",0,"",0);


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

    if (isset($_POST['key_type'])) {
      $type = $_POST['key_type'];
    }else{
      $type = '0';
    }

    $check_sql = "SELECT count(1) FROM keyword WHERE key_name = '".$_POST['key_name']."' AND key_cate_id = '".$_POST['key_cate_id']."' AND key_city_id = '".$_POST['key_city_id']."' AND key_qh_id = '".$_POST['key_qh_id']."' AND key_cb_id = '".$_POST['key_cb_id']."' AND key_type = '".$type."' AND key_id != '".$record_id."'";

     
    $check = new db_query($check_sql);
    $count = mysql_fetch_assoc($check->result);
    $count = $count['count(1)'];

    if ($count > 0) 
    {
      echo 'Nội dung bị trùng, thao tác đã bị hủy !!!!!';
      exit();

    } 
    else {
          $i = '';
          if($key_qh_id != 0 && $key_city_id != 0 && $key_cate_id != 0 && $key_name == Null && $key_cb_id == 0 && $key_type == 0)
          {
             $i = '1';
          }
          else if($key_qh_id != 0 && $key_city_id != 0 && $key_name != Null && $key_cate_id == 0 && $key_cb_id == 0 && $key_type == 0 )
          {
             $i = '1';
          }
          else if($key_cb_id != 0 && $key_cate_id != 0 && $key_city_id != 0 && $key_name == Null && $key_qh_id == 0 && $key_type == 0)
          {
             $i = '1';
          }
          else if($key_cb_id != 0 && $key_name != Null && $key_city_id != 0 && $key_cate_id == 0 && $key_qh_id == 0 && $key_type == 0)
          {
             $i = '1';
          }
          else if($key_name != Null && $key_city_id != 0 && $key_type == 0 && $key_cate_id == 0 && $key_qh_id == 0 && $key_cb_id == 0)
          {
             $i = '1';
          }
          else if( $key_qh_id != 0 && $key_city_id != 0 && $key_cb_id == 0 && $key_cate_id == 0 && $key_name == Null && $key_type == 0)
          {
             $i = '1';
          }
          else if( $key_name != Null && $key_type == 0 && $key_cate_id == 0 && $key_qh_id == 0 && $key_city_id == 0 && $key_cb_id == 0)
          {
             $i = '1';
          }
          else if( $key_name != Null && $key_type != 0 && $key_cate_id == 0 && $key_qh_id == 0 && $key_city_id == 0 && $key_cb_id == 0)
          {
             $i = '1';
          }else{
            $i = '0';
          }

          if ($i == '1') {
            $query = $myform->generate_update_SQL($field_id,$record_id);
            $db_ex = new db_execute($query);
            $fs_redirect  = $after_save_data. "?record_id=".$record_id;
             
            redirect($fs_redirect);
            exit();
          }else{
            echo 'Nội dung tag nhập không đúng theo cấu trúc. Đề nghị xem lại cấu trúc tag !!!!!';
            exit();
          }
    }
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
$query2 = new db_query("SELECT * FROM keyword WHERE key_id = " . $record_id."");
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
// $menu 	= new menu();
// $listAll = $menu->getAllChild("categories_multi","cat_id","cat_parent_id","0","cat_type IN(".$cat_type_select.")","cat_id,cat_name,cat_order,cat_type,cat_parent_id,cat_has_child","cat_type, cat_order ASC, cat_name ASC","cat_has_child");
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN" "http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
<?=$load_header?>
<script type="text/javascript" src="/admin/resource/ckeditor/ckeditor.js?t=D03G5XL"></script>
<style type="text/css">
    .autocomplete-items div {
      padding: 3px;
      cursor: pointer;
      background-color: #f9f9f6;
      border: solid 0.5px #e9e9e9; 
    }
    .autocomplete-items div:hover {
      background-color: #e9e9e9; 
    }
</style>
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
<?=$form->text("Nhập tên Tag","key_name","key_name",$key_name,"tên tag",0,500,"",255)?>

<?=$form->checkbox("Tin không xác định", "key_type", "key_type", "1", $key_type, "không xác định", "0", "", "")?>

<script src="jquery.form.js"></script>

<tr>
    <td class="form_name"> Tỉnh thành</td>
    <td class="form_text">
        <select name="key_city_id" id="key_city_id" class="form_control" style="width:250px">
        	<option value="">Chọn địa điểm</option>
         <?
         $db_qrcity = new db_query("SELECT cit_id, cit_name FROM city ORDER BY cit_order DESC,cit_name ASC");
         While($rowcity = mysql_fetch_assoc($db_qrcity->result))
         {
         ?>
         <option value="<?= $rowcity['cit_id'] ?>" <?=($key_city_id == $rowcity['cit_id'])?'selected="selected"':''?>><?= $rowcity['cit_name'] ?></option>
         <?
         }
         ?>
        </select>
    </td>
</tr>

<tr>
    <td class="form_name">Quận huyện</td>
    <td class="form_text">
        <select name="key_qh_id" id="key_qh_id" class="form_control" style="width:250px">
            <option value="">Chọn quận huyện</option>
        <?
         $db_qrcity = new db_query("SELECT cit_id, cit_name FROM city2 WHERE cit_parent = '".$key_city_id."' ORDER BY cit_order DESC,cit_name ASC");
         While($rowcity = mysql_fetch_assoc($db_qrcity->result))
         {
         ?>
         <option class="qh_add" value="<?= $rowcity['cit_id'] ?>" <?=($key_qh_id == $rowcity['cit_id'])?'selected="selected"':''?>><?= $rowcity['cit_name'] ?></option>
         <?
         }
        ?>
        </select>
    </td>
</tr>

<tr>
    <td class="form_name"> Ngành nghề</td>
    <td class="form_text">
        <select name="key_cate_id" id="key_cate_id" class="form_control" style="width:250px">
        	<option value="">Chọn ngành nghề</option>
         <?
         $db_qrcity = new db_query("SELECT cat_id, cat_name FROM category ORDER BY cat_order DESC,cat_name ASC");
         While($rowcity = mysql_fetch_assoc($db_qrcity->result))
         {
         ?>
         <option value="<?= $rowcity['cat_id'] ?>" <?=($key_cate_id == $rowcity['cat_id'])?'selected="selected"':''?>><?= $rowcity['cat_name'] ?></option>
         <?
         }
         ?>
        </select>
    </td>
</tr>

<tr>
    <td class="form_name"> Cấp bậc</td>
    <td class="form_text">
        <select name="key_cb_id" id="key_cb_id" class="form_control" style="width:250px">
                <?
             foreach($array_capbac as $item => $type)
             {
             ?>
             <option <?= $key_cb_id == $item?"selected":"" ?> value="<?= $item ?>"><?= $type ?></option>
             <?
             }
             unset($item,$type);
             ?>
        </select>
    </td>
</tr>




<?=$form->textarea("TITLE riêng", "key_tit", "key_tit", $key_tit, "Nhập title riêng cho tag", 0, 600, 60, "", "", "")?>
<?=$form->textarea("Description riêng", "key_desc", "key_desc", $key_desc, "Nhập description riêng cho tag", 0, 600, 60, "", "", "")?>
<?=$form->textarea("Keyword riêng", "key_key", "key_key", $key_key, "Nhập keyword riêng cho tag", 0, 600, 60, "", "", "")?>
<?=$form->textarea("Thẻ H1 riêng", "key_h1", "key_h1", $key_h1, "Nhập nội dung thẻ H1 riêng cho tag", 0, 600, 60, "", "", "")?>




<?=$form->close_table();?>
<?=$form->wysiwyg("Mô tả tag", "key_teaser", $key_teaser, "../../resource/ckeditor/", "50%","600")?>
<?=$form->create_table();?>

<br/>
<br/>
<div id="check_text"></div>
<br/>
<br/>

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

<script type="text/javascript">  
    $(document).ready(function(){
        $("#key_city_id").change(function(){
            $(".qh_add").remove();
            var id = $("#key_city_id").val();
            $.get("add.php?city_id="+id, function(data){
                    $("#key_qh_id").append(data);
                });
        });

        $('#key_name').attr('autocomplete','off');
        $('.form_name').css('vertical-align','top');

        function autocomplete(inp, arr) {
          /*the autocomplete function takes two arguments,
          the text field element and an array of possible autocompleted values:*/
          var currentFocus;
          /*execute a function when someone writes in the text field:*/
          inp.addEventListener("input", function(e) {
              var a, b, i, val = this.value;
              /*close any already open lists of autocompleted values*/
              closeAllLists();
              if (!val) { return false;}
              currentFocus = -1;
              /*create a DIV element that will contain the items (values):*/
              a = document.createElement("DIV");
              a.setAttribute("id", this.id + "autocomplete-list");
              a.setAttribute("class", "autocomplete-items");
              /*append the DIV element as a child of the autocomplete container:*/
              this.parentNode.appendChild(a);
              /*for each item in the array...*/
              for (i = 0; i < arr.length; i++) {
                /*check if the item starts with the same letters as the text field value:*/
                if (arr[i].substr(0, val.length).toUpperCase() == val.toUpperCase()) {
                  /*create a DIV element for each matching element:*/
                  b = document.createElement("DIV");
                  /*make the matching letters bold:*/
                  b.innerHTML = "<strong>" + arr[i].substr(0, val.length) + "</strong>";
                  b.innerHTML += arr[i].substr(val.length);
                  /*insert a input field that will hold the current array item's value:*/
                  b.innerHTML += "<input type='hidden' value='" + arr[i] + "'>";
                  /*execute a function when someone clicks on the item value (DIV element):*/
                  b.addEventListener("click", function(e) {
                      /*insert the value for the autocomplete text field:*/
                      inp.value = this.getElementsByTagName("input")[0].value;
                      /*close the list of autocompleted values,
                      (or any other open lists of autocompleted values:*/
                      closeAllLists();
                  });
                  a.appendChild(b);
                }
              }
          });
          /*execute a function presses a key on the keyboard:*/
          inp.addEventListener("keydown", function(e) {
              var x = document.getElementById(this.id + "autocomplete-list");
              if (x) x = x.getElementsByTagName("div");
              if (e.keyCode == 40) {
                /*If the arrow DOWN key is pressed,
                increase the currentFocus variable:*/
                currentFocus++;
                /*and and make the current item more visible:*/
                addActive(x);
              } else if (e.keyCode == 38) { //up
                /*If the arrow UP key is pressed,
                decrease the currentFocus variable:*/
                currentFocus--;
                /*and and make the current item more visible:*/
                addActive(x);
              } else if (e.keyCode == 13) {
                /*If the ENTER key is pressed, prevent the form from being submitted,*/
                e.preventDefault();
                if (currentFocus > -1) {
                  /*and simulate a click on the "active" item:*/
                  if (x) x[currentFocus].click();
                }
              }
          });
          function addActive(x) {
            /*a function to classify an item as "active":*/
            if (!x) return false;
            /*start by removing the "active" class on all items:*/
            removeActive(x);
            if (currentFocus >= x.length) currentFocus = 0;
            if (currentFocus < 0) currentFocus = (x.length - 1);
            /*add class "autocomplete-active":*/
            x[currentFocus].classList.add("autocomplete-active");
          }
          function removeActive(x) {
            /*a function to remove the "active" class from all autocomplete items:*/
            for (var i = 0; i < x.length; i++) {
              x[i].classList.remove("autocomplete-active");
            }
          }
          function closeAllLists(elmnt) {
            /*close all autocomplete lists in the document,
            except the one passed as an argument:*/
            var x = document.getElementsByClassName("autocomplete-items");
            for (var i = 0; i < x.length; i++) {
              if (elmnt != x[i] && elmnt != inp) {
                x[i].parentNode.removeChild(x[i]);
              }
            }
          }
          /*execute a function when someone clicks in the document:*/
          document.addEventListener("click", function (e) {
              closeAllLists(e.target);
              });
        }

        <? echo "var arr_tag = ". $name_tag . ";\n"; ?>

        autocomplete(document.getElementById("key_name"), arr_tag);

        $("input").keyup(function(){
            var city = $("#key_city_id").val();
            var type = $("#key_type").prop('checked');
            var qh = $("#key_qh_id").val();
            var cate = $("#key_cate_id").val();
            var cb = $("#key_cb_id").val();
            var name = $("#key_name").val().replace(" ","_");

            $.get("edit.php?city="+city+"&type="+type+"&qh="+qh+"&cate="+cate+"&cb="+cb+"&name="+name+"&id="+<?=$key_id?>, function(data){
                    $("#check_text").html(data);
                });
        });

        $("input").change(function(){
            var city = $("#key_city_id").val();
            var type = $("#key_type").prop('checked');
            var qh = $("#key_qh_id").val();
            var cate = $("#key_cate_id").val();
            var cb = $("#key_cb_id").val();
            var name = $("#key_name").val().replace(" ","_");

            $.get("edit.php?city="+city+"&type="+type+"&qh="+qh+"&cate="+cate+"&cb="+cb+"&name="+name+"&id="+<?=$key_id?>, function(data){
                    $("#check_text").html(data);
                });
        });

        $("select").change(function(){
            var city = $("#key_city_id").val();
            var type = $("#key_type").prop('checked');
            var qh = $("#key_qh_id").val();
            var cate = $("#key_cate_id").val();
            var cb = $("#key_cb_id").val();
            var name = $("#key_name").val().replace(" ","_");

            $.get("edit.php?city="+city+"&type="+type+"&qh="+qh+"&cate="+cate+"&cb="+cb+"&name="+name+"&id="+<?=$key_id?>, function(data){
                    $("#check_text").html(data);
                });
        });


    });
</script>


</body>
</html>