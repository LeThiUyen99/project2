<?php
require_once("inc_security.php");
$list = new fsDataGird($field_id,$field_name,translate_text("Listing"));
$new_category_id  = array();
$class_menu     = new menu();

$array_capbac = array(0 => "Chọn cấp bậc",
                      1 => "Thực tập",
                      3 => "Nhân viên",
                      5 => "Trưởng nhóm",
                      2 => "Trưởng Phòng",
                      4 => "Giám Đốc",
                      );
  						 
$db = new db_query("SELECT * FROM " . $fs_table." ORDER BY " . $list->sqlSort() . $field_id . " DESC ");

function rewriteKey($key_id,$key_name,$key_cate_id,$cate_name,$key_city_id,$city_name,$key_qh_id,$qh_name,$key_cb_id,$cb_name,$key_type,$key_err){
  $linkrt = "";

  if ($key_err != 0) {
    $linkrt = "/home/404.php";
  }
  else if($key_qh_id != 0 && $key_city_id != 0 && $key_cate_id != 0)
  {
     $linkrt = "/tag2/viec-lam-".replaceTitle($cate_name)."-tai-".replaceTitle($qh_name)."-".replaceTitle($city_name)."-".$key_id;
  }
  else if($key_qh_id != 0 && $key_city_id != 0 && $key_name != Null)
  {
     $linkrt = "/tag6/viec-lam-".replaceTitle($key_name)."-tai-".replaceTitle($qh_name)."-".replaceTitle($city_name)."-".$key_id;
  }
  else if($key_cb_id != 0 && $key_cate_id != 0 && $key_city_id != 0)
  {
     $linkrt = "/tag3/tuyen-dung-viec-lam-".replaceTitle($cb_name)."-".replaceTitle($cate_name)."-tai-".replaceTitle($city_name)."-".$key_id;
  }
  else if($key_cb_id != 0 && $key_name != Null && $key_city_id != 0)
  {
     $linkrt = "/tag4/viec-lam-".replaceTitle($cb_name)."-".replaceTitle($key_name)."-tai-".replaceTitle($city_name)."-".$key_id;
  }
  else if($key_name != Null && $key_city_id != 0)
  {
     $linkrt = "/tag5/tuyen-dung-viec-lam-".replaceTitle($key_name)."-tai-".replaceTitle($city_name)."-".$key_id;
  }
  else if( $key_qh_id != 0 && $key_city_id != 0)
  {
     $linkrt = "/tag1/viec-lam-tai-".replaceTitle($qh_name)."-".replaceTitle($city_name)."-".$key_id;
  }
  else if( $key_name != Null && $key_type == 0)
  {
     $linkrt = "/tag7/DS-viec-lam-tuyen-dung-".replaceTitle($key_name)."-".$key_id;
  }
  else if( $key_name != Null && $key_type != 0)
  {
     $linkrt = "/tuyen-dung-viec-lam/".$key_id."-".replaceTitle($key_name);
  }
  return  $linkrt;
}


header("Content-type: application/octet-stream");
header("Content-Disposition: attachment; filename=tag.xls");
header("Pragma: no-cache");
header("Expires: 0");

   $db_qrr = new db_query("SELECT cit_id,cit_name FROM city2 ORDER BY cit_count DESC,cit_name ASC");
   $arrcity  = $db_qrr->result_array('cit_id');
   $db_qr = new db_query("SELECT cat_id,cat_name FROM category WHERE cat_active = 1 ORDER BY cat_count DESC");
   $db_cat  = $db_qr->result_array('cat_id');

  echo'<table border="1px solid black">';
  echo '<tr>';

  echo '<td><strong> ID  </strong></td>';
  echo '<td><strong> Link tag</strong></td>';
   $i=0;
   while($row = mysql_fetch_assoc($db->result)){
      $i++;
      $link = "https://timviec365.vn".rewriteKey($row['key_id'],$row['key_name'],$row['key_cate_id'],$row['key_cate_id'] != 0?$db_cat[$row['key_cate_id']]['cat_name']:"",$row['key_city_id'],$row['key_city_id'] != 0?$arrcity[$row['key_city_id']]['cit_name']:"",$row['key_qh_id'],$row['key_qh_id'] != 0?$arrcity[$row['key_qh_id']]['cit_name']:"",$row['key_cb_id'],$row['key_cb_id'] != 0?$array_capbac[$row['key_cb_id']]:"",$row['key_type'],$row['key_err']);

    echo'<table border="1px solid black">';
    echo'<tr>';
    echo'<td>'.$row['key_id'].'</td>';
    echo'<td>'.$link.'</td>';
   }
echo '</tr>';
echo '</table>';
?>
