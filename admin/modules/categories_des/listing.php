<?php
require_once("inc_security.php");

function remove_accent($mystring){
  $marTViet=array(
  "à","á","ạ","ả","ã","â","ầ","ấ","ậ","ẩ","ẫ","ă","ằ","ắ","ặ","ẳ","ẵ",
  "è","é","ẹ","ẻ","ẽ","ê","ề","ế","ệ","ể","ễ",
  "ì","í","ị","ỉ","ĩ",
  "ò","ó","ọ","ỏ","õ","ô","ồ","ố","ộ","ổ","ỗ","ơ","ờ","ớ","ợ","ở","ỡ",
  "ù","ú","ụ","ủ","ũ","ư","ừ","ứ","ự","ử","ữ",
  "ỳ","ý","ỵ","ỷ","ỹ",
  "đ",
  "À","Á","Ạ","Ả","Ã","Â","Ầ","Ấ","Ậ","Ẩ","Ẫ","Ă","Ằ","Ắ","Ặ","Ẳ","Ẵ",
  "È","É","Ẹ","Ẻ","Ẽ","Ê","Ề","Ế","Ệ","Ể","Ễ",
  "Ì","Í","Ị","Ỉ","Ĩ",
  "Ò","Ó","Ọ","Ỏ","Õ","Ô","Ồ","Ố","Ộ","Ổ","Ỗ","Ơ","Ờ","Ớ","Ợ","Ở","Ỡ",
  "Ù","Ú","Ụ","Ủ","Ũ","Ư","Ừ","Ứ","Ự","Ử","Ữ",
  "Ỳ","Ý","Ỵ","Ỷ","Ỹ",
  "Đ",
  "'");
  
  $marKoDau=array(
  "a","a","a","a","a","a","a","a","a","a","a","a","a","a","a","a","a",
  "e","e","e","e","e","e","e","e","e","e","e",
  "i","i","i","i","i",
  "o","o","o","o","o","o","o","o","o","o","o","o","o","o","o","o","o",
  "u","u","u","u","u","u","u","u","u","u","u",
  "y","y","y","y","y",
  "d",
  "A","A","A","A","A","A","A","A","A","A","A","A","A","A","A","A","A",
  "E","E","E","E","E","E","E","E","E","E","E",
  "I","I","I","I","I",
  "O","O","O","O","O","O","O","O","O","O","O","O","O","O","O","O","O",
  "U","U","U","U","U","U","U","U","U","U","U",
  "Y","Y","Y","Y","Y",
  "D",
  "");
  
  return str_replace($marTViet,$marKoDau,$mystring);

}

function replaceTitle($title){
  $title  = remove_accent($title);
  $arr_str  = array( "&lt;","&gt;","/","\\","&apos;", "&quot;","&amp;","lt;", "gt;","apos;", "quot;","amp;","&lt", "&gt","&apos", "&quot","&amp","&#34;","&#39;","&#38;","&#60;","&#62;");
  $title  = str_replace($arr_str, " ", $title);
  $title = preg_replace('/[^0-9a-zA-Z\s]+/', ' ', $title);
  //Remove double space
  $array = array(
    '    ' => ' ',
    '   ' => ' ',
    '  ' => ' ',
  );
  $title = trim(strtr($title, $array));
  $title  = str_replace(" ", "-", $title);
  $title  = urlencode($title);
  // remove cac ky tu dac biet sau khi urlencode
  $array_apter = array("%0D%0A","%","&");
  $title  = str_replace($array_apter,"-",$title);
  $title  = strtolower($title);
  return $title;
}

function rewriteCate($catid,$catname,$city,$cityname){
$linkrt = "";
if($catid == 0 && $city == 0)
{
   $linkrt = "/viec-lam-moi";
}
else if($catid != 0 && $city == 0)
{
   $linkrt = "/viec-lam-".replaceTitle($catname)."-c".$catid."v".$city;
}
else if($catid == 0 && $city != 0)
{
   $linkrt = "/viec-lam-tai-".replaceTitle($cityname)."-c".$catid."v".$city;
}
else if($catid != 0 && $city != 0)
{
   $linkrt = "/viec-lam-".replaceTitle($catname)."-tai-".replaceTitle($cityname)."-c".$catid."v".$city;
}
return  $linkrt;
}


//gọi class DataGird
$list = new fsDataGird($field_id,$field_name,translate_text("Listing"));
$new_category_id  = array();
$class_menu       = new menu();


// $list->add("cate_id","Ngành nghề","string",0,0, '');
// $list->add("cit_id","Tỉnh thành","string",0,0, '');
// $list->add("","Link dẫn","string",0,0, '');
// $list->add("key_teaser","Mô tả","string",0,0, '');
// $list->add("cate_type", "Ghim", "checkbox", 0, 0);
// $list->add("",translate_text("Sửa"),"edit");

$list->add("cate_id","Ngành nghề","string",0,0, '');
$list->add("city_id","Tỉnh thành","string",0,0, '');
$list->add("","Link dẫn","string",0,0, '');
$list->add("cate_des","Mô tả","string",0,0, '');
$list->add("",translate_text("Sửa"),"edit");


$list->quickEdit  = false;
$list->ajaxedit($fs_table);

$total      = new db_count("SELECT count(*) AS count 
                            FROM " . $fs_table);
                               
$total_row = $total->total;   
                   
$db = new db_query("SELECT * 
                   FROM " . $fs_table . "
                   ORDER BY " . $list->sqlSort() . $field_id . " ASC " . 
                   $list->limit($total_row));



?>
<!DOCTYPE html>
<head>
   <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
   <?=$load_header?>
   <?=$list->headerScript()?>
</head>
<body>
<div id="listing">
   <?=$list->showHeader($total_row)?>
   <?
   $db_qrr = new db_query("SELECT cit_id,cit_name FROM city2 ORDER BY cit_count DESC,cit_name ASC");
   $arrcity  = $db_qrr->result_array('cit_id');
   $db_qr = new db_query("SELECT cat_id,cat_name FROM category WHERE cat_active = 1 ORDER BY cat_count DESC");
   $db_cat  = $db_qr->result_array('cat_id');

   $i=0;
   while($row = mysql_fetch_assoc($db->result)){
      $i++;
      $cate = $row['cate_id'] != 0?$db_cat[$row['cate_id']]['cat_name']:"";
      $city = $row['city_id'] != 0?$arrcity[$row['city_id']]['cit_name']:"";
      $link = "https://timviec365.vn".rewriteCate($row['cate_id'],$cate,$row['city_id'],$city);


      ?>
      <?=$list->start_tr($i, $row[$field_id]);?>                                                          
         <td align="center"><?= $row['cate_id'] != 0?$db_cat[$row['cate_id']]['cat_name']:""?></td>
         <td align="center"><?= $row['city_id'] != 0?$arrcity[$row['city_id']]['cit_name']:""?></td>
         <td align="center"><a href="<?=$link ?>" target="_blank"><?=$link ?></a></td>
         <td><?= cut_string($row['cate_des'],'150','...') ?></td>


         <?=$list->showEdit($row['id'])?>                        
      <?=$list->end_tr();?>
      <?
   }
   ?>
   <?=$list->showFooter($total_row)?>
</div>
</body>
</html>